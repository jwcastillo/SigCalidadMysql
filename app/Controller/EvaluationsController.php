<?php
App::uses('AppController', 'Controller');
/**
 * Evaluations Controller
 *
 * @property Evaluation $Evaluation
 * @property PaginatorComponent $Paginator
 */
class EvaluationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler', 'DataTable');

/**
 * index method
 *
 * @return void
 */
	public function index() {

		$this->paginate = array(
			'fields' => array(
				'Evaluation.id',
				'Evaluation.effectiveness_evaluation', 
				'Evaluation.quality_assessment', 
				'Evaluation.month', 
				'Evaluation.year', 
				'Evaluation.employee', 
				'Management.name'
			),
			'link' => array('Employee', 'Management')
		);

		$this->Evaluation->Behaviors->load('Linkable');

		$this->Evaluation->virtualFields['employee'] = $this->Evaluation->Employee->virtualFields['fullname'];

		if ($this->request->is('ajax')) {
			$this->RequestHandler->setContent('json', 'application/json' );

			// Setting month names
			$response = $this->DataTable->getResponse();
			$aaData = array();
			foreach ($response['aaData'] as $row) {
				$row[3] = $this->Common->monthNames($row[3]);
				$aaData[] = $row;

			}
			$response['aaData'] = $aaData;

			$this->set('response', $response);
			$this->set('_serialize','response');
		}
	}

	public function filter($data, $conditions) {
		
		$return = array();
		// Foreach del arreglo de resultados
		foreach ($data as $row) {
			// For each de cada tabla Employee, Package
			foreach ($row as $table => $fields) {

				$tempRow = array();
				
				foreach ($fields as $key => $value) {
					
					if (isset($conditions["$table.$key"]) && $conditions["$table.$key"] == $value)
						$tempRow = $row;

					if (isset($conditions["$table.$key>="]) && $conditions["$table.$key>="] >= $value)
						$tempRow = $row;

					if (isset($conditions["$table.$key<="]) && $conditions["$table.$key<="] >= $value)
						$tempRow  = $row;

					if (isset($conditions["$table.$key!="]) && $conditions["$table.$key!="] >= $value)
						$tempRow = $row;

					
					} // End fields
					
					if (!empty($tempRow))
						$return[] = $tempRow;

			} // End row

		} // End data
		return $return;
	} // End function

/**
 * index2 method
 *
 * @return void
 */
	public function index2() {
		$this->Evaluation->recursive = 0;

		$perro = $this->Paginator->paginate();

		$conditions['Evaluation.management_id'] = 2;

		$gato = $this->filter($perro, $conditions);

		$conditions = array();

		$conditions['Evaluation.employee_id'] = 4;

		$gato = $this->filter($gato, $conditions);
		//
		//$gato = $this->filter($perro, $conditions);

		//debug($gato);

		//$gato = $perro;

		$this->set('evaluations', $gato);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Evaluation->exists($id)) {
			//throw new NotFoundException(__('Invalid evaluation'));
			$this->Session->setFlash(__('Invalid evaluation'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('Evaluation.' . $this->Evaluation->primaryKey => $id));
		$this->set('evaluation', $this->Evaluation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Evaluation->create();
			if ($this->Evaluation->save($this->request->data)) {
				$this->Session->setFlash(__('The evaluation has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evaluation could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		}
		$employees = $this->Evaluation->Employee->find('list');
		$managements = $this->Evaluation->Management->getList();
		$this->set(compact('employees', 'managements'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Evaluation->exists($id)) {
			//throw new NotFoundException(__('Invalid evaluation'));
			$this->Session->setFlash(__('Invalid evaluation'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Evaluation->save($this->request->data)) {
				$this->Session->setFlash(__('The evaluation has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evaluation could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Evaluation.' . $this->Evaluation->primaryKey => $id));
			$this->request->data = $this->Evaluation->find('first', $options);
		}
		$employees = $this->Evaluation->Employee->find('list');
		$managements = $this->Evaluation->Management->getList();
		$this->set(compact('employees', 'managements'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Evaluation->id = $id;
		if (!$this->Evaluation->exists()) {
			throw new NotFoundException(__('Invalid evaluation'));
			$this->Session->setFlash(__('Invalid evaluation'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Evaluation->delete()) {
			$this->Session->setFlash(__('The evaluation has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The evaluation could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function compute() {

		if ($this->request->is('post')) {

			$certifiedStatus = $this->Session->read('Options.certifiedStatus');

			$management_id = $this->request->data('Evaluation.management');
			$month = $this->request->data('Evaluation.month.month');
			$currentMonth = date('m');
			// If month is from past year
			$year = ($currentMonth - $month < 0) ? date('Y') - 1 : date('Y');
					
			$result = $this->Evaluation->monthlyEvaluation($month, $year, $management_id);
					
			
			if ($result && $this->Evaluation->saveAll($result)) {
				$this->Session->setFlash(__('The evaluation has been computed.'), 'flash', array ('class' => 'success'));
				//return $this->redirect(array('action' => 'index'));
				return $this->redirect(array('action' => 'summary', $month, $year, $management_id));
			} else {
				if (!$result) {
					$this->Session->setFlash(__('That evaluation was already computed.'), 'flash', array ('class' => 'warning'));
					return $this->redirect(array('action' => 'summary', $month, $year, $management_id));
					$this->summary($month, $year, $management_id);
				}
				else{
					$this->Session->setFlash(__('The evaluation could not be computed. Please, try again.'), 'flash', array ('class' => 'error'));
				}
			}
		}
		$this->loadModel('Management');

		$options['conditions'] = array('Management.id' => $this->Session->read('Auth.User.management'));
		$managements = $this->Management->getList($options);

		$currentMonth = date('m');
		$monthNames = $this->monthNames();
	
		$lastEvaluationMonths = $this->Session->read('Options.lastEvaluationMonths');
		$months = $this->getLastMonths($monthNames, $currentMonth, $lastEvaluationMonths);
		$this->set(compact('managements', 'months'));
	}

	public function summary($month, $year, $management_id) {

		$this->Evaluation->virtualFields['employee'] = $this->Evaluation->Employee->virtualFields['fullname'];

		$options = array(
			'fields' => array(
				'employee',
				'month', 
				'year',
				'effectiveness_evaluation', 
				'quality_assessment', 
				'Management.id',
				'Management.name', 
				'Employee.id',
			),
			'conditions' => array(
				'Evaluation.management_id' => $management_id,
				'year' => $year, 
				'month' => $month
			),
			'contain' => array('Employee', 'Management')
		);

		$evaluations = $this->Evaluation->find('all', $options);

		$this->set(compact('evaluations'));
	}

	public function monthNames() {
		return array(
			1 => __('January'),
			2 => __('February'),
			3 => __('March'),
			4 => __('April'),
			5 => __('May'),
			6 => __('June'),
			7 => __('July'),
			8 => __('August'),
			9 => __('September'),
			10 => __('October'),
			11 => __('November'),
			12 => __('December')
		);
	}

	function getLastMonths($months, $currentMonth, $count){
		

		$output1 = array_slice($months, $currentMonth-1, null, true); 
		
		$output2 = array_slice($months, 0, $currentMonth-1, true); 
		
		$new = $output1 + $output2;
		return array_slice($new, -$count, $count, true);

		/*$arraySize = sizeof($months);
		$offset = (-$arraySize - $count + $currentMonth) % ($arraySize - 1);
		$temp1 = array_slice($months, $offset, $count, true);
		$left =  $count - sizeof($temp1);
		$temp2 = array_slice($months, 0, $left, true);
		return $temp1 + $temp2;*/
	}

	public function yearlyEvaluation() {

		$ByManagement = true;

		if ($this->request->is(array('post', 'put'))) {

			$management_id = $this->request->data('Evaluation.management_id');

			$year = $this->request->data('Evaluation.year');

			$options = array(
				'fields' => array(
					'employee_id', 
					'month', 
					'year',
					'effectiveness_evaluation', 
					'quality_assessment', 
					'Evaluation.employee', 
					'Management.name', 
					'Management.alias'
				),
				'conditions' => array(
					//'employee_id' => $employee_id, 
					//'Evaluation.management_id' => $management_id, 
					'year' => $year
				),
				//'recursive' => -1
				'link' => array('Employee', 'Management')
			);

			$this->Evaluation->virtualFields['employee'] = $this->Evaluation->Employee->virtualFields['fullname'];

			if (!isset($management_id)) {

				$employee_id = $this->request->data('Evaluation.employee_id') ? 
					$this->request->data('Evaluation.employee_id') : 
					$this->Session->read('Auth.User.employeeId');

					$this->request->data['Evaluation']['employee_id'] = $employee_id;

					$ByManagement = false;

				$options['conditions']['employee_id'] = $employee_id;
			} else {
				$options['conditions']['Evaluation.management_id'] = $management_id;
				$this->request->data['Evaluation']['Evaluation.management_id'] = $management_id;
			}

			$evaluations = $this->Evaluation->find('all', $options);

			if (!empty($evaluations)) {
				$this->set(compact('evaluations'));
			} else {
				$this->Session->setFlash(__('The evaluation could not be retrieved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
	
		}
		$current_employee_id = $this->Session->read('Auth.User.employeeId');
		$managers = $this->Session->read('Options.managers');

		$management_id = $this->Session->read('Auth.User.management');

		$eOptions['conditions'] = array(
			'management_id' => $management_id, 
			'Employee.id !=' => $managers
		);

		$mOptions['conditions'] = array(
			'management_id' => $management_id
		);

		$isManager = in_array($current_employee_id, $managers);

		$employees = $this->Evaluation->Employee->find('list', $eOptions);

		$managements = $this->Evaluation->Management->getList($mOptions);

		$this->set('ByManagement', $ByManagement);

		$this->set(compact('employees', 'managements', 'isManager'/*, 'ByManagement'*/));
	}

	private function __test_send_email() {
		//$this->autoRender = false;
		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail('smtp');
		$email->from(array('jvalecillos@bancaribe.com.ve' => 'APP TEST'));
		$email->to('jwcastillo@gmail.com');
		$email->subject('Subject of testing');
		$email->send('Message of testing');
	}

	public function onDemandEval($id=null) {
		
		$this->loadModel('Package'); $this->loadModel('Rfc');

		if (!$this->Package->exists($id)) {
			// @TODO: Redictect to not yet evaluated index page
			throw new NotFoundException(__('Invalid package'));
		}

		if ($this->request->is('get')) {

			$options = array(
				'conditions' => array('Package.' . $this->Package->primaryKey => $id),
				'recursive' => -1
			);
			
			$thisPackage = $this->Package->find('first', $options);

			$this->Rfc->Behaviors->load('Containable');

			$rOptions = array(
				'conditions' => array(
					'Rfc.' . $this->Rfc->primaryKey => $thisPackage['Package']['rfc_id'],
					//'Rfc.closed' => false,
				 ),
				// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
				 'contain' => array('Package' => array('Module', 'Employee'), 'ProjectClass', 'PackageClass', 'Complexity')
			);

			$rfc = $this->Rfc->find('first', $rOptions);

			$this->set(compact('rfc'));

		} else {
			// Very package data
			$temp = $this->__checkEvalCond ( $this->request->data('Evaluation.id') );

			// FIXME: if ($rfc['Rfc']['closed'])

			if (empty($temp['error'])){

				$packages = array();
				$tempP = null;
				
				// Instantiation // mention within cron function
				
				// Call a method from another controller
				foreach ($temp['packages'] as $pId) {
					$packages[] = $tempP = $this->Common->certifyPackage($pId);

					$title = 'EVALUACION DE EFECTIVIDAD';
					$this->Common->writeObservation(
						$tempP['Package']['package_status_id'], 
						$tempP['Package']['number_package'], 
						$title, 
						$this->Session->read('Auth.User.username'), 
						'EVALUACION DE EFECTIVIDAD' //$p['Package']['observations'] // FIXME: Add proper observation
					);
				}

				// Saving Packages
				$this->Package->saveAll($packages);
				// Computing Rfc

				$rfc = $this->Common->computeWeighting( $this->request->data('Evaluation.id') );

				if (!is_null($rfc) && $rfc != -1)
					$this->Rfc->saveAll($rfc);

				$rOptions = array(
				'conditions' => array(
					'Rfc.' . $this->Rfc->primaryKey => $this->request->data('Evaluation.id'),
					//'Rfc.closed' => false,
				 ),
				// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
				 'contain' => array('Package' => array('Module', 'Employee'), 'ProjectClass', 'PackageClass', 'Complexity')
				);

				$rfc = $this->Rfc->find('first', $rOptions);

				$this->set(compact('rfc'));
				$this->render('preview');
			} else {
				//$packagesIds = $temp['packages'];
				$packagesErrors = $temp['error'];

				$rOptions = array(
				'conditions' => array(
					'Rfc.' . $this->Rfc->primaryKey => $this->request->data('Evaluation.id'),
					//'Rfc.closed' => false,
				 ),
				// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
				 'contain' => array('Package' => array('Module', 'Employee'), 'ProjectClass', 'PackageClass', 'Complexity')
				);

				$rfc = $this->Rfc->find('first', $rOptions);

				$this->set(compact('rfc', 'packagesErrors'));

				$this->Session->setFlash(__('The packages need some data to be computed. Please, complete it and try again.'), 'flash', array ('class' => 'error'));

				$this->render('complete_data');
			}
		}

	}

	public function checkEvalCond($id=null) {
		$this->__checkEvalCond($id);
	}

	private function __checkEvalCond($id=null) {
	 $this->loadModel('Rfc');
		$this->Rfc->Behaviors->load('Containable');
		$rOptions = array(
				'conditions' => array(
					'Rfc.id' => $id,
					//'Rfc.closed' => false,
				 ),
				// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
				 'contain' => array('Package' => array('Module', 'Employee'), 'ProjectClass', 'PackageClass', 'Complexity')
			);

			$rfc = $this->Rfc->find('first', $rOptions);

			$return['packages'] = array();
			$return['error'] = array();
			
			foreach ($rfc['Package'] as $package) {

				$certifiedStatus = $this->Session->read('Options.certifiedStatus');

				if (/*!empty($package['certified_date']) &&*/
					// Forcing casting from string to float in final_weighting
					( empty($package['final_weighting']) || $package['final_weighting'] + 0.00 == 0.00 
						|| empty($package['effec_eval_date']) ) ) { 

					if (empty($package['weighting']) || $package['weighting']=='0' || $package['weighting']==0)
							$return['error'][$package['id']][] = __('Weighting');

						if (empty($package['certified_date']) || $package['certified_date']=='0000-00-00')
							$return['error'][$package['id']][] = __('Certified Date');
						
						if(empty($package['start_date']) || $package['start_date']=='0000-00-00')
							$return['error'][$package['id']][] = __('Start Date');
						
						if(empty($package['end_date']) || $package['end_date']=='0000-00-00')
							$return['error'][$package['id']][] =  __('End Date');
						
						if(empty($package['assignment_date']) || $package['assignment_date']=='0000-00-00')
							$return['error'][$package['id']][] =  __('Assignment Date');
						
						if($package['replanning'])
							if(empty($package['replanning_date']) || $package['replanning_date']=='0000-00-00')
								$return['error'][$package['id']][] =  __('Replanning Date');
				}
				
				if( !isset($return['error'][$package['id']]) )
							$return['packages'][] = $package['id'];

			}
			return $return;

			//$this->render('index');

	}

	public function completePackage($id = null) {

		$this->loadModel('Package');
		$this->set('saved', false);
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Package->save($this->request->data)) {
				$this->Session->setFlash(__('The package has been saved.'), 'flash', array ('class' => 'success'));
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The package could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Package.' . $this->Package->primaryKey => $id));
			$this->request->data = $this->Package->find('first', $options);
		}

		$this->layout = ($this->request->is("ajax")) ? "ajax" : "charisma";
	}

	public function unCertify() {

		$idPackage = isset($this->request->params['named']['package']) ? $this->request->params['named']['package'] : null;

		$idRfc = isset($this->request->params['named']['rfc']) ? $this->request->params['named']['rfc'] : null;

		$this->Common->unCertify($idPackage, $idRfc);

		exit;

	}

}
