<?php
App::uses('AppController', 'Controller');
/**
 * Absences Controller
 *
 * @property Absence $Absence
 * @property PaginatorComponent $Paginator
 */
class AbsencesController extends AppController {

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
				'Absence.id', 
				'Absence.description', 
				'AbsenceType.name', 
				'Absence.employee', 
				'Absence.departure_date', 
				'Absence.arrival_date'
			),
			'link' => array(
				'Employee' /*=> array('fields' => array('id', 'name'))*/, 
				'AbsenceType' => array('fields' => array('id', 'name'))
			)
		);

		$this->Absence->Behaviors->load('Linkable');

		$this->Absence->virtualFields['employee'] = $this->Absence->Employee->virtualFields['fullname'];

		if ($this->request->is('ajax')) {
			$this->RequestHandler->setContent('json', 'application/json' );

			$this->set('response', $this->DataTable->getResponse());
			$this->set('_serialize','response');
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
		if (!$this->Absence->exists($id)) {
			//throw new NotFoundException(__('Invalid absence'));
			$this->Session->setFlash(__('Invalid absence'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('Absence.' . $this->Absence->primaryKey => $id));
		$this->set('absence', $this->Absence->find('first', $options));

		$this->layout = ($this->request->is("ajax")) ? "ajax" : "charisma";
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Absence->create();
			if ($this->Absence->save($this->request->data)) {
				$this->Session->setFlash(__('The absence has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The absence could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		}
		$employees = $this->Absence->Employee->find('list');
		$absenceTypes = $this->Absence->AbsenceType->find('list');
		$this->set(compact('employees', 'absenceTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Absence->exists($id)) {
			//throw new NotFoundException(__('Invalid absence'));
			$this->Session->setFlash(__('Invalid absence'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Absence->save($this->request->data)) {
				$this->Session->setFlash(__('The absence has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The absence could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Absence.' . $this->Absence->primaryKey => $id));
			$this->request->data = $this->Absence->find('first', $options);
		}
		$employees = $this->Absence->Employee->find('list');
		$absenceTypes = $this->Absence->AbsenceType->find('list');
		$this->set(compact('employees', 'absenceTypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Absence->id = $id;
		if (!$this->Absence->exists()) {
			throw new NotFoundException(__('Invalid absence'));
			$this->Session->setFlash(__('Invalid absence'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Absence->delete()) {
			$this->Session->setFlash(__('The absence has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The absence could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
