<?php
App::uses('AppController', 'Controller');
/**
 * Assignments Controller
 *
 * @property Assignment $Assignment
 * @property PaginatorComponent $Paginator
 */
class AssignmentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','RequestHandler', 'DataTable','Common');

/**
 * index method
 *
 * @return void
 */
	public function index($vencidos=0) {
	/*	$this->Assignment->recursive = 0;
		$this->set('assignments', $this->Paginator->paginate());*/
		$DaysSla = $this->Session->read('Options.daySla');
		$conditions['Assignment.management_id']= $this->Session->read('Auth.User.management');
		$conditions['Assignment.status']= 0;
		if($vencidos==1){
		$conditions['Assignment.status']= 1;

		}
		if($vencidos==2){
		$conditions['DATE_FORMAT(Assignment.start_date, \'%Y-%m-%d\') <'] =date("Y-m-d", strtotime(date("Y-m-d")));
		$conditions['ADDDATE(DATE_FORMAT(Assignment.start_date, \'%Y-%m-%d\'),'. $DaysSla .') >='] =date("Y-m-d", strtotime(date("Y-m-d")));
		}
		if($vencidos==3){
		$conditions['ADDDATE(DATE_FORMAT(Assignment.start_date, \'%Y-%m-%d\'),'. $DaysSla .') <'] =date("Y-m-d", strtotime(date("Y-m-d")));
		}
		
			$options = array(
			'fields' => array(
				'Assignment.id', 
				'Rfc.name',
				'Assignment.employee',
				'Assignment.start_date', 
				'Assignment.end_date', 

				/*'Management.name'*/
			),
			//'link' => array('Module', 'Employee', 'PackageStatus', 'Rfc', 'EvaluationState','Management')
			'link' => array(
				'Employee' => array('fields' => array('id', 'name')), 
				'Rfc' => array('fields' => array('id', 'name')), 
				'Management' => array('fields' => array('id', 'name'))
			),

			'conditions' => $conditions,
		);

		$managers = $this->Session->read('Options.managers');
		// If it is a employee show him only his packages
		if (!in_array($this->Session->read('Auth.User.employeeId'), $managers) ) {
			$options['conditions']['Assignment.employee_id'] = $this->Session->read('Auth.User.employeeId');
		}

		$this->paginate = $options;
		$this->Assignment->virtualFields['employee'] = $this->Assignment->Employee->virtualFields['fullname'];
		if ($this->request->is('ajax')) {
			$this->RequestHandler->setContent('json', 'application/json' );
			$this->set('response', $this->DataTable->getResponse());
			$this->set('_serialize','response');
		}

		//$this->set('assignments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Assignment->exists($id)) {
			//throw new NotFoundException(__('Invalid assignment'));
			$this->Session->setFlash(__('Invalid assignment'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('Assignment.' . $this->Assignment->primaryKey => $id));
		$this->set('assignment', $this->Assignment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Assignment->create();
			$rfcId = $this->request->data['Assignment']['rfc_id'];

			if ($this->Assignment->save($this->request->data)) {

				// TODO: How this must behave in case of failure?
				$this->Common->add_mtproject($rfcId,1);
				$this->Session->setFlash(__('The assignment has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assignment could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		}
		$rfcs = $this->Assignment->Rfc->find('list');
		$employees = $this->Assignment->Employee->find('list');
		$managements = $this->Assignment->Management->find('list');
		$this->set(compact('rfcs', 'employees', 'managements'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Assignment->exists($id)) {
			//throw new NotFoundException(__('Invalid assignment'));
			$this->Session->setFlash(__('Invalid assignment'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$rfcId = $this->request->data['Assignment']['rfc_id'];
			if ($this->Assignment->save($this->request->data)) {
				$this->Common->add_mtproject($rfcId,1);

				$this->Session->setFlash(__('The assignment has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The assignment could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Assignment.' . $this->Assignment->primaryKey => $id));
			$this->request->data = $this->Assignment->find('first', $options);
		}
		$rfcs = $this->Assignment->Rfc->find('list');
		$employees = $this->Assignment->Employee->find('list');
		$managements = $this->Assignment->Management->find('list');
		$this->set(compact('rfcs', 'employees', 'managements'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Assignment->id = $id;
		if (!$this->Assignment->exists()) {
			throw new NotFoundException(__('Invalid assignment'));
			$this->Session->setFlash(__('Invalid assignment'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Assignment->delete()) {
			$this->Session->setFlash(__('The assignment has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The assignment could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
