<?php
App::uses('AppController', 'Controller');
/**
 * Employees Controller
 *
 * @property Employee $Employee
 * @property PaginatorComponent $Paginator
 */
class EmployeesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Common', 'RequestHandler', 'DataTable', 'HighCharts.HighCharts');

/**
 * index method
 *
 * @return void
 */
	public function index() {
			$this->paginate = array(
			'fields' => array(
				'Employee.id', 
				'Employee.bc',
				'Employee.fullname', 
				'Position.name', 
				'Employee.ci', 
				'Management.name', 
				'Employee.type',  
				'Employee.company', 
				'Employee.email',
				'Employee.email_work'
			),
			'link' => array(
				'Position', 
				'Management'
			),
		);
		$this->Employee->Behaviors->load('Linkable');

		if ($this->request->is('ajax')) {
			$this->RequestHandler->setContent('json', 'application/json' );

			$this->set('response', $this->DataTable->getResponse());
			$this->set('_serialize','response');
		}
	}

/**
 * index method
 *
 * @return void
 */
	public function index2() {
		$this->Employee->recursive = 0;
		$this->set('employees', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Employee->exists($id)) {
			//throw new NotFoundException(__('Invalid employee'));
			$this->Session->setFlash(__('Invalid employee'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		//$options = array('conditions' => array('Employee.' . $this->Employee->primaryKey => $id));

		// Use containable for retreive related table data
		$this->Employee->Behaviors->load('Containable');

		$options = array(
			'conditions' => array(
				'Employee.' . $this->Employee->primaryKey => $id,
				//'Rfc.closed' => false,
			 ),
			// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
			 'contain' => array('Package' => array('Module', 'Rfc'), 'Position', 'Management', 
			 	'Absence' => array('AbsenceType'), 'Evaluation', 'QualityManager', 
			 	'Vehicle')
		);

		$this->set('employee', $this->Employee->find('first', $options));

		$this->layout = ($this->request->is("ajax")) ? "ajax" : "charisma";
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Employee->create();
			if ($this->Employee->save($this->request->data)) {
				$this->Session->setFlash(__('The employee has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The employee could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		}
		$positions = $this->Employee->Position->find('list');
		$managements = $this->Employee->Management->find('list');
		$this->set(compact('positions', 'managements'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Employee->exists($id)) {
			//throw new NotFoundException(__('Invalid employee'));
			$this->Session->setFlash(__('Invalid employee'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {

			if ($this->Employee->save($this->request->data)) {
				$this->Session->setFlash(__('The employee has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The employee could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Employee.' . $this->Employee->primaryKey => $id));
			$this->request->data = $this->Employee->find('first', $options);
		}
		$positions = $this->Employee->Position->find('list');
		$managements = $this->Employee->Management->find('list');
		$this->set(compact('positions', 'managements'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Employee->id = $id;
		if (!$this->Employee->exists()) {
			throw new NotFoundException(__('Invalid employee'));
			$this->Session->setFlash(__('Invalid employee'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Employee->delete()) {
			$this->Session->setFlash(__('The employee has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The employee could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * image method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
		public function image($id = null) {
			if (!$this->Employee->exists($id)) {
				//throw new NotFoundException(__('Invalid employee'));
				$this->Session->setFlash(__('Invalid employee'), 
					'flash', array ('class' => 'error'));
				return $this->redirect(array('action' => 'index'));
			}
			if ($this->request->is(array('post', 'put'))) {
				// Unique file name
				if (isset($this->request->data[$this->modelClass]['image'])) {
					$filename = $this->request->data[$this->modelClass]['image']['name'];
					$ext = preg_replace('/^.*\.([^.]+)$/D', '$1', $filename); // Extract extension
					$this->request->data[$this->modelClass]['image']['name'] = String::uuid() . ".$ext";
				}

				if ($this->Employee->save($this->request->data)) {
					$this->Session->setFlash(__('The employee has been saved.'), 'flash', array ('class' => 'success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The employee could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
				}
			} else {
				$options = array('conditions' => array('Employee.' . $this->Employee->primaryKey => $id));
				$this->request->data = $employee = $this->Employee->find('first', $options);
				$this->set('employee', $employee);
			}
		}

/**
 * Workload method
 *
 * @return void
 */
	public function workload($management_id = null) {

		return $this->redirect(array('controller' => 'charts', 'action' => 'workload', $management_id));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function toggleActivation($id = null) {
		if (!$this->Employee->exists($id)) {
			//throw new NotFoundException(__('Invalid employee'));
			$this->Session->setFlash(__('Invalid employee'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		
		$options = array('conditions' => array('Employee.' . $this->Employee->primaryKey => $id));
		$employee = $this->Employee->find('first', $options);

		$employee['Employee']['active'] = ! $employee['Employee']['active'];

		if ($this->Employee->save($employee)) {
			$this->Session->setFlash(__('The employee has been saved.'), 'flash', array ('class' => 'success'));
			return $this->redirect(array('action' => 'view', $id));
		} else {
			$this->Session->setFlash(__('The employee could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'view', $id));
		}

		$positions = $this->Employee->Position->find('list');
		$managements = $this->Employee->Management->find('list');
		$this->set(compact('positions', 'managements'));
	}

	private function assignmentsSchedule($management_id = null, $employee_id = null) {
		
		$this->loadModel('Assignment');

		$this->Assignment->Behaviors->load('Containable');

		$aux = array('fields' => array('id', 'name'));

		$options = array(
			'fields' => array(
				'Assignment.id', 
				'Rfc.name', 
				'Assignment.start_date', 
				'Assignment.end_date', 
				'Assignment.employee',
				'Assignment.employee_id',
			),
			'contain' => array(
				'Rfc' => array('fields' => array('id', 'name')), 
				'Employee' => array('fields' => array('id', 'name', 'management_id'))
			), 
			//'conditions' => array()
		);

		$this->Assignment->virtualFields['employee'] = $this->Employee->virtualFields['fullname'];

		if ($management_id) 
			$options['conditions']['Employee.management_id'] = $management_id;

		if ($employee_id) 
			$options['conditions']['Assignment.employee_id'] = $employee_id;

		$assignments1 = $this->Assignment->find('all', $options);

		$assigments2 = array();
		// Flat array and change column names
		foreach ($assignments1 as $assignment) {
			// Converting dates
			$startDate = date('D M d Y H:i:s O', 
				strtotime( $assignment['Assignment']['start_date'] ) );
			$endDate = date('D M d Y H:i:s O', 
				strtotime( $assignment['Assignment']['end_date'] ) );
			// Setting bar color
			$color = 'ganttYellow';
			// Values for Gantt Plugin
			$values = array(
				'from' => "/Date($startDate)/", 
				'to' => "/Date($endDate)/", 
				'label' =>  $assignment['Rfc']['name'], 
				'customClass' => $color, 
				'desc' => sprintf(__('Assignment') . ': <strong>%s</strong><br/><i>%s</i>', 
					$assignment['Rfc']['id'], $assignment['Rfc']['name']), 
				'dataObj' => Router::url(array('plugin' => false, 
					'controller' => 'assignments', 'action'=> 'view', $assignment['Assignment']['id'])), 
				'start_date' => $assignment['Assignment']['start_date']
			);
			// Adding values for return array
			$assigments2[ $assignment['Assignment']['employee_id'] ][] = $values;
		}

		return $assigments2;
	}

	private function absencesSchedule($management_id = null, $employee_id = null) {

		$this->loadModel('Absence');

		$this->Absence->Behaviors->load('Containable');

		$aux = array('fields' => array('id', 'name'));

		$options = array(
			'fields' => array(
				'Absence.id', 
				'AbsenceType.name', 
				'Absence.description',
				'Absence.departure_date', 
				'Absence.arrival_date', 
				'Absence.employee',
				'Absence.employee_id',
			),
			'contain' => array(
				'AbsenceType' => array('fields' => array('id', 'name')), 
				'Employee' => array('fields' => array('id', 'name', 'management_id'))
			), 
			//'conditions' => array()
		);

		$this->Absence->virtualFields['employee'] = $this->Absence->Employee->virtualFields['fullname'];

		if ($management_id) 
			$options['conditions']['Employee.management_id'] = $management_id;

		if ($employee_id) 
			$options['conditions']['Absence.employee_id'] = $employee_id;

		$absences1 = $this->Absence->find('all', $options);

		$absences2 = array();
		// Flat array and change column names
		foreach ($absences1 as $absence) {
			// Converting dates
			$startDate = date('D M d Y H:i:s O', 
				strtotime( $absence['Absence']['departure_date'] ) );
			$endDate = date('D M d Y H:i:s O', 
				strtotime( $absence['Absence']['arrival_date'] ) );
			// Setting bar color
			$color = 'ganttViolet';
			// Values for Gantt Plugin
			$values = array(
				'from' => "/Date($startDate)/", 
				'to' => "/Date($endDate)/", 
				'label' =>  $absence['AbsenceType']['name'], 
				'customClass' => $color, 
				'desc' => sprintf(__('Absence') . ': <strong>%s</strong><br/><i>%s</i>', 
					$absence['AbsenceType']['name'], $absence['Absence']['description']), 
				'dataObj' => Router::url(array('plugin' => false, 
					'controller' => 'absences', 'action'=> 'view', $absence['Absence']['id'])), 
				'start_date' => $absence['Absence']['departure_date']
			);
			// Adding values for return array
			$absences2[ $absence['Absence']['employee_id'] ][] = $values;
		}

		return $absences2;
	}

	public function packagesSchedule($management_id = null) {

		$managers = $this->Session->read('Options.managers');

		$conditions = array(
			'Package.management_id' => $management_id, 
			'NOT' => array('Employee.id' => $managers)
		);

		$packages1 = $this->Employee->packagesInProcess($conditions);

		$packages2 = array();

		// Flat array and change column names
		foreach ($packages1 as $package) {
			// Converting dates
			$startDate = date('D M d Y H:i:s O', 
				strtotime( $package['Package']['start_date'] ) );
			$endDate = date('D M d Y H:i:s O', 
				strtotime( $package['Package']['end_date'] ) );

			$weighting = $package['Rfc']['weighting'];
			// Setting bar color
			if ($weighting >= 4 )
				$color = 'ganttRed';
			elseif ($weighting >= 1)
				$color = 'ganttOrange';
			else
				$color = 'ganttGreen';

			$rfc_id = $package['Rfc']['id'];
			$rfc_name = $package['Rfc']['name'];

			$id = $package['Package']['id'];

			// Values for Gantt Plugin
			$values = array(
				'from' => "/Date($startDate)/", 
				'to' => "/Date($endDate)/", 
				'label' =>  $package['Package']['number_package'], 
				'customClass' => $color, 
				'desc' => sprintf('Rfc: <strong>%s</strong><br/><i>%s</i>', 
					$rfc_id, $rfc_name), 
				'dataObj' => Router::url(array('plugin' => false, 
					'controller' => 'packages', 'action'=>'view', $id)),
				'module_name' => $package['Module']['name'], 
			);
			// Adding values for return array
			$packages2[ $package['Package']['employee_id'] ][] = $values;
		}

		return $packages2;
	}


	public function schedule($management_id = null) {

		$management_id = (isset($management_id)) ? $management_id : $this->Session->read('Auth.User.management');

		$managers = $this->Session->read('Options.managers');
		// Get absences
		$absences = $this->absencesSchedule($management_id);

		// Get assignments
		$assignments = $this->assignmentsSchedule($management_id);

		$conditions = array(
			'Employee.management_id' => $management_id, 
			'NOT' => array('Employee.id' => $managers)
		);

		$packages = $this->packagesSchedule($management_id);

		$employees = $this->Employee->find( 'list', array('conditions' => $conditions) );


		$result = array();
		$lastEmployee = null;
		$lastEmployeeId = null;
		$lastMonth = date('Y-m-d', strtotime("-30 days"));
		// Formmating array to suit jquery.gantt needs

		foreach ($employees as $employee_id => $employee_name) {

			if (isset($packages[$employee_id])) {

				foreach ($packages[$employee_id] as $package) {
					
					$name = ($lastEmployee == $employee_name) ? " " : $employee_name;
					
					$number_package = $package['label'];
					$module_name = $package['module_name'];
					
					$desc = sprintf('<strong>%s</strong>&nbsp;-&nbsp;<i class="muted">%s</i>', $number_package, $module_name);

					$result[] = array(
						'name' => $name, 
						'desc' => $desc, 
						'values' => array($package),
					);

					$lastEmployee = $employee_name;
				}
			}

			if (isset($absences[$employee_id])) {
								
				foreach ($absences[$employee_id] as $absence) {
					
					$name = ($lastEmployee == $employee_name) ? " " : $employee_name;
					
					$desc = sprintf('<strong><i>%s</i></strong>', __('Absence'));

					if ( $this->Common->greaterEqual($absence['start_date'], $lastMonth) ) {
						$result[] = array(
							'name' => $name, 
							'desc' => $desc, 
							'values' => array($absence),
						);
					
						$lastEmployee = $employee_name;

					}
				}
			}

			if (isset($assignments[$employee_id])) {
				// Adding Absences if present
				foreach ($assignments[$employee_id] as $assignment) {
					
					$name = ($lastEmployee == $employee_name) ? " " : $employee_name;
					
					$desc = sprintf('<strong><i>%s</i></strong>', __('Assignment'));

					//if ( $this->Common->greaterEqual($assignment['start_date'], $lastMonth) ) {
						$result[] = array(
							'name' => $name, 
							'desc' => $desc, 
							'values' => array($assignment),
						);
					
						$lastEmployee = $employee_name;

					//}
				}
			}
		}

		$this->set('gantt', $result);

	}

}
