<?php
App::uses('AppController', 'Controller');
/**
 * Rfcs Controller
 *
 * @property Rfc $Rfc
 * @property PaginatorComponent $Paginator
 */
class RfcsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Common', 'RequestHandler', 'DataTable', 'Rest');

/**
 * index2 method
 *
 * @return void
 */
	public function index2() {
			$this->paginate = array(
			'fields' => array(
				'Rfc.id', 
				'Rfc.name', 
				'Rfc.description',
				'PlanningManager.name',
				'ProjectManager.name',
				'DevelopmentManager.name',
				'ProjectClass.name',
				'PackageClass.name',
				'Complexity.name',
				'Rfc.weighting',
			),

			'contain' => array(
				'PlanningManager', 
				'ProjectManager', 
				'DevelopmentManager', 
				'ProjectClass', 
				'PackageClass', 
				'Complexity'
			),
			'order' => array('Rfc.created DESC')
			//'conditions' => array('Package.management_id' => 5) 
		);
		$this->Rfc->Behaviors->load('Containable');
		$this->set('rfcs', $this->Paginator->paginate());
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
			$this->paginate = array(
			'fields' => array(
				'Rfc.id', 
				'Rfc.name', 
				'PlanningManager.name',
				'ProjectManager.name',
				'DevelopmentManager.name',
				'ProjectClass.name',
				'PackageClass.name',
				'Complexity.name',
				'Rfc.weighting',
				'Rfc.high_impact'
			),
			'link' => array(
				'PlanningManager', 
				'ProjectManager', 
				'DevelopmentManager', 
				'ProjectClass', 
				'PackageClass', 
				'Complexity'
			),
				'order' => array('Rfc.created DESC')
		);
		$this->Rfc->Behaviors->load('Linkable');

		if ($this->request->is('ajax')) {
			$this->RequestHandler->setContent('json', 'application/json' );

			$this->set('response', $this->DataTable->getResponse());
			$this->set('_serialize','response');
		} else {
			// REST logic goes here
			// if (isset($this->request->params['ext']))
			$rfcs = $this->Rfc->find('all', $this->paginate);
			$this->set(array(
				'rfcs' => $rfcs,
				'_serialize' => array('rfcs')
			));
		}
	}
public function highimpact() {
			$conditions['Rfc.high_impact']=1;

			$this->paginate = array(
			'fields' => array(
				'Rfc.id', 
				'Rfc.name', 
				'PlanningManager.name',
				'ProjectManager.name',
				'DevelopmentManager.name',
				'ProjectClass.name',
				'PackageClass.name',
				'Complexity.name',
				'Rfc.weighting',
				'Rfc.high_impact'
			),
			'link' => array(
				'PlanningManager', 
				'ProjectManager', 
				'DevelopmentManager', 
				'ProjectClass', 
				'PackageClass', 
				'Complexity'
			),
			'conditions' => $conditions,
				'order' => array('Rfc.created DESC')
		);
		$this->Rfc->Behaviors->load('Linkable');

		if ($this->request->is('ajax')) {
			$this->RequestHandler->setContent('json', 'application/json' );

			$this->set('response', $this->DataTable->getResponse());
			$this->set('_serialize','response');
		} else {
			// REST logic goes here
			// if (isset($this->request->params['ext']))
			$rfcs = $this->Rfc->find('all', $this->paginate);
			$this->set(array(
				'rfcs' => $rfcs,
				'_serialize' => array('rfcs')
			));
		}
	}
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Rfc->exists($id)) {
			//throw new NotFoundException(__('Invalid rfc'));
			$this->Session->setFlash(__('Invalid rfc'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		// Use containable for retreive related table data
		$this->Rfc->Behaviors->load('Containable');

		$rOptions = array(
			'conditions' => array(
				'Rfc.' . $this->Rfc->primaryKey => $id,
				//'Rfc.closed' => false,
			 ),
			// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
			 'contain' => array('Package' => array('Module', 'Employee'), 'ProjectClass', 'PackageClass', 'Complexity', 
				'PlanningManager', 'ProjectManager', 'DevelopmentManager')
		);

		$rfc = $this->Rfc->find('first', $rOptions);

		//debug($rfc);
		//debug($this->Common->test());

		$this->set(compact('rfc'));

		$this->layout = ($this->request->is("ajax")) ? "ajax" : "charisma";
		// REST logic goes here
		$this->set('_serialize', array('rfc'));
		 /*$this->set(array(
			'rfc' => $rfc,
			'_serialize' => array('rfc')
		 ));*/

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {

		$message = '';
		$type = '';

		if ($this->request->is('post')) {
			$this->Rfc->create();

			$data = $this->Rest->getRequestData();

			if ($data && $this->Rfc->save($data)) {

				$message = __('The rfc has been saved.');
				$type = 'success';

				if (!$this->Rest->isApi()) {
					$this->Session->setFlash($message, 'flash', array ('class' => 'success'));
					return $this->redirect(array('action' => 'index'));
				}

			} else {
				$message = __('The rfc could not be saved. Please, try again.');
				$type = 'error';

				if (!$this->Rest->isApi()) {
					$this->Session->setFlash($message, 'flash', array ('class' => 'error'));
				}

			}
		}
		$architectures =  array('No Aplica' => 'No Aplica', 'Nueva' => 'Nueva', 'Modificada' => 'Modificada');

		$planningManagers = $this->Rfc->PlanningManager->find('list');
		$projectManagers = $this->Rfc->ProjectManager->find('list');
		$developmentManagers = $this->Rfc->DevelopmentManager->find('list');
		$projectClasses = $this->Rfc->ProjectClass->find('list');
		$packageClasses = $this->Rfc->PackageClass->find('list');
		$complexities = $this->Rfc->Complexity->find('list');
		$options_rq_low_limit= $this->Session->read('Options.rq_low_limit');
		$options_pj_low_limit= $this->Session->read('Options.pj_low_limit');
		$options_pj_average_limit= $this->Session->read('Options.pj_average_limit');
		$options_pj_high_limit= $this->Session->read('Options.pj_high_limit');
		$options_rq_average_limit= $this->Session->read('Options.rq_average_limit');
		$options_rq_high_limit= $this->Session->read('Options.rq_high_limit');
		$options_new_architecture= $this->Session->read('Options.new_architecture');
		$options_used_architecture= $this->Session->read('Options.used_architecture');
		$options_pf= $this->Session->read('Options.pf');
		$options_pc= $this->Session->read('Options.pc');
		$options_priority= $this->Session->read('Options.priority');
		$options_postimplementation= $this->Session->read('Options.postimplementation');
		$options_default= $this->Session->read('Options.default');
		$options_average_day_pj= $this->Session->read('Options.average_day_pj');
		$options_average_day_rq= $this->Session->read('Options.average_day_rq');

		$this->set(compact('rfc','architectures','planningManagers', 'projectManagers', 'developmentManagers', 'projectClasses', 'packageClasses', 'complexities','options_rq_low_limit'
,'options_pj_low_limit' ,'options_pj_average_limit' ,'options_pj_high_limit' ,'options_rq_average_limit' ,'options_rq_high_limit' ,'options_new_architecture' ,'options_used_architecture' ,'options_pf'
,'options_pc' ,'options_priority' ,'options_postimplementation' ,'options_default' ,'options_average_day_pj' ,'options_average_day_rq'));

		//$this->RequestHandler->setContent('json', 'application/json' );

		$this->set(array(
			'message' => $message,
			'type' => $type, 
			'rfc' => array('id' => $this->Rfc->getInsertID()),
			'_serialize' => array('message', 'rfc', 'type')
		));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {

		$message = '';
		$rfc='';
		if (!$this->Rfc->exists($id)) {
			//throw new NotFoundException(__('Invalid rfc'));
			$message = __('Invalid rfc');
			$this->Session->setFlash($message, 
				'flash', array ('class' => 'error'));
			if (!$this->Rest->isApi())
				return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {

			$data = ($this->Rest->isApi() && $this->request->params['ext'] =='json') 
				? $this->request->input('json_decode', true) : $this->request->data;

			if ($data && $this->Rfc->save($data)) {
				$message = __('The rfc has been saved.');

				if (!$this->Rest->isApi()) {
					$this->Session->setFlash($message, 'flash', array ('class' => 'success'));
					return $this->redirect(array('action' => 'index'));
				}

			} else {
				$message = __('The rfc could not be saved. Please, try again.');

				if (!$this->Rest->isApi()) {
					$this->Session->setFlash($message, 'flash', array ('class' => 'error'));
				}

			}

		} else {
			$options = array('conditions' => array('Rfc.' . $this->Rfc->primaryKey => $id));
			$rfc = $this->request->data = $this->Rfc->find('first', $options);

				
		}
		$planningManagers = $this->Rfc->PlanningManager->find('list');
		$projectManagers = $this->Rfc->ProjectManager->find('list');
		$developmentManagers = $this->Rfc->DevelopmentManager->find('list');
		$projectClasses = $this->Rfc->ProjectClass->find('list');
		$packageClasses = $this->Rfc->PackageClass->find('list');
		$complexities = $this->Rfc->Complexity->find('list');
		$architectures =  array('No Aplica' => 'No Aplica', 'Nueva' => 'Nueva', 'Modificada' => 'Modificada');
		$options_1= $this->Session->read('Options.DaysPromoted');

		$options_rq_low_limit= $this->Session->read('Options.rq_low_limit');
		$options_pj_low_limit= $this->Session->read('Options.pj_low_limit');
		$options_pj_average_limit= $this->Session->read('Options.pj_average_limit');
		$options_pj_high_limit= $this->Session->read('Options.pj_high_limit');
		$options_rq_average_limit= $this->Session->read('Options.rq_average_limit');
		$options_rq_high_limit= $this->Session->read('Options.rq_high_limit');
		$options_new_architecture= $this->Session->read('Options.new_architecture');
		$options_used_architecture= $this->Session->read('Options.used_architecture');
		$options_pf= $this->Session->read('Options.pf');
		$options_pc= $this->Session->read('Options.pc');
		$options_priority= $this->Session->read('Options.priority');
		$options_postimplementation= $this->Session->read('Options.postimplementation');
		$options_default= $this->Session->read('Options.default');
		$options_average_day_pj= $this->Session->read('Options.average_day_pj');
		$options_average_day_rq= $this->Session->read('Options.average_day_rq');

		$this->set(compact('rfc','architectures','planningManagers', 'projectManagers', 'developmentManagers', 'projectClasses', 'packageClasses', 'complexities','options_rq_low_limit'
,'options_pj_low_limit' ,'options_pj_average_limit' ,'options_pj_high_limit' ,'options_rq_average_limit' ,'options_rq_high_limit' ,'options_new_architecture' ,'options_used_architecture' ,'options_pf'
,'options_pc' ,'options_priority' ,'options_postimplementation' ,'options_default' ,'options_average_day_pj' ,'options_average_day_rq'));
		if ($this->Rest->isApi()) {
			$this->set(array(
				'message' => $message,
				'rfc' => array('id' => $id), 
				'_serialize' => array('message', 'rfc')
			));
		}
		
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {

		$message = '';

		$this->Rfc->id = $id;

		if (!$this->Rfc->exists($id)) {
			$message = __('Invalid rfc');
			
			if (!$this->Rest->isApi()) {
				$this->Session->setFlash($message, 'flash', array ('class' => 'error'));
				return $this->redirect(array('action' => 'index'));
			}
		}

		$this->request->onlyAllow('post', 'delete');
		if ($this->Rfc->delete()) {
			$message = __('The rfc has been deleted.');

			if (!$this->Rest->isApi()) {
				$this->Session->setFlash($message, 'flash', array ('class' => 'block'));
			}

		} else {
			$message = __('The rfc could not be deleted. Please, try again.');

			if (!$this->Rest->isApi()) {
				$this->Session->setFlash($message, 'flash', array ('class' => 'block'));
			}
		}
		if (!$this->Rest->isApi())
			return $this->redirect(array('action' => 'index'));

		$this->set(array(
			'message' => $message,
			'_serialize' => array('message')
		));
	}


	public function computeWeighting() {

		if ($this->request->is(array('post', 'put'))) {

			$id = $this->request->data['Rfc']['id'];
			
			$rfc = $this->Common->computeWeighting($id);

			if (!is_null($rfc) && $rfc != -1)
				//$result = $this->Rfc->saveAll($rfc);
				$result = ($this->Rfc->saveAll($rfc)) ? 1 : 0;
			else
				$result = -1;

			switch ($result) {
				case 1:
					$this->setPackageObservations($rfc);
					$this->Session->setFlash(__('The packages weight has been computed.'), 'flash', array ('class' => 'block'));
					return $this->redirect(array('action' => 'summary', $id));
					break;
				case 0:
					$this->Session->setFlash(__('The packages weight could not be computed.'), 'flash', array ('class' => 'error'));
					break;	
				default:
					$this->Session->setFlash(__('The packages weight were computed already.'), 'flash', array ('class' => 'error'));	
					break;
			}
			return $this->redirect(array('action' => 'view', $id));
		}
		$this->autoRender = false;
		return $this->redirect(array('action' => 'index'));
	}

public function getDiferenceDates() {
	
		
		
		$fi=date($_POST['fi']);
		$ff=date($_POST['ff']);
		$startDate = $this->Common->deleteMinutes($fi);

		$endDate = $this->Common->deleteMinutes($ff);

		
		$holidays = $this->Common->getholidays();

		$result= $this->Common->getWorkingDays($startDate, $endDate, $holidays);


		$this->RequestHandler->setContent('json', 'application/json' );

		$this->set('response', $result);
		$this->set('_serialize','response');
	
	}

	private function setPackageObservations($rfc = null) {

		if (!is_null($rfc) && isset($rfc['Package'])) {
			
			foreach ($rfc['Package'] as $p) {
				$title = 'EVALUACION DE EFECTIVIDAD';
				
				return $this->Common->writeObservation(
					$p['package_status_id'], 
					$p['number_package'], 
					$title, 
					$this->Session->read('Auth.User.username'), 
					'EVALUACION DE EFECTIVIDAD' //$p['Package']['observations'] // FIXME: Add proper observation
				);
			}

		} else {
			return false;
		}

	}

	public function summary($id) {

		$this->Rfc->Behaviors->load('Containable');

		$rOptions = array(
			'conditions' => array(
				'Rfc.' . $this->Rfc->primaryKey => $id,
				//'Rfc.closed' => false,
			 ),
			// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
			 'contain' => array('Package' => array('Module', 'Employee'), 'ProjectClass', 'PackageClass', 'Complexity', 
				'PlanningManager', 'ProjectManager', 'DevelopmentManager')
		);

		$rfc = $this->Rfc->find('first', $rOptions);

		$this->set(compact('rfc'));
	}

	public function getList() {
		$rfcId = $this->request->data('rfcId');

		$options = array(
			'fields' => array(
				'Rfc.id', 
				'Rfc.name', 
			), 
			'contain' => array('ProjectManager'),
			'conditions' => array(
				'OR' => array(
					array('Rfc.closed' => FALSE),
				)
			), 
			'order' => 'Rfc.created DESC'
		);

		if ($rfcId) {
			$options['conditions']['OR'][] = array('Rfc.id' => $rfcId);
		}

		$list = $this->Rfc->find('all', $options);

		$result = array();
		foreach ($list as $e) {
			$result[] = array(
				'label' => $e['Rfc']['name'], 
				'value' => $e['Rfc']['id']
			);
		}

		$this->RequestHandler->setContent('json', 'application/json' );

		$this->set('response', $result);
		$this->set('_serialize','response');
	}



		



}
	/*public function test() {
		debug($this->Common->add_project());
		exit;
		//$this->render('index');
	}*/



/*

{
	"Rfc": {
		"id":"10",
		"name":"Requerimiento - Optimizar consultas Conexi\u00f3n Bancaribe Bancaribe"
	}
}

{
	"Rfc":
	{
		"name":"hola",
		"description":"dola",
		"planning_manager_id":"3",
		"project_manager_id":"4",
		"development_manager_id":"2",
		"project_class_id":"4",
		"package_class_id":"5",
		"complexity_id":"4",
		"weighting":"1"
	}
}

*/
