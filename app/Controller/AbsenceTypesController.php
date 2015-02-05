<?php
App::uses('AppController', 'Controller');
/**
 * AbsenceTypes Controller
 *
 * @property AbsenceType $AbsenceType
 * @property PaginatorComponent $Paginator
 */
class AbsenceTypesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->AbsenceType->recursive = 0;
		$this->set('absenceTypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AbsenceType->exists($id)) {
			//throw new NotFoundException(__('Invalid absence type'));
			$this->Session->setFlash(__('Invalid absence type'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('AbsenceType.' . $this->AbsenceType->primaryKey => $id));
		$this->set('absenceType', $this->AbsenceType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AbsenceType->create();
			if ($this->AbsenceType->save($this->request->data)) {
				$this->Session->setFlash(__('The absence type has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The absence type could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->AbsenceType->exists($id)) {
			//throw new NotFoundException(__('Invalid absence type'));
			$this->Session->setFlash(__('Invalid absence type'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AbsenceType->save($this->request->data)) {
				$this->Session->setFlash(__('The absence type has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The absence type could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('AbsenceType.' . $this->AbsenceType->primaryKey => $id));
			$this->request->data = $this->AbsenceType->find('first', $options);
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
		$this->AbsenceType->id = $id;
		if (!$this->AbsenceType->exists()) {
			throw new NotFoundException(__('Invalid absence type'));
			$this->Session->setFlash(__('Invalid absence type'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AbsenceType->delete()) {
			$this->Session->setFlash(__('The absence type has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The absence type could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
