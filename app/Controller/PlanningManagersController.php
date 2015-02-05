<?php
App::uses('AppController', 'Controller');
/**
 * PlanningManagers Controller
 *
 * @property PlanningManager $PlanningManager
 * @property PaginatorComponent $Paginator
 */
class PlanningManagersController extends AppController {

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
		$this->PlanningManager->recursive = 0;
		$this->set('planningManagers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PlanningManager->exists($id)) {
			//throw new NotFoundException(__('Invalid planning manager'));
			$this->Session->setFlash(__('Invalid planning manager'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('PlanningManager.' . $this->PlanningManager->primaryKey => $id));
		$this->set('planningManager', $this->PlanningManager->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PlanningManager->create();
			if ($this->PlanningManager->save($this->request->data)) {
				$this->Session->setFlash(__('The planning manager has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planning manager could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
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
		if (!$this->PlanningManager->exists($id)) {
			//throw new NotFoundException(__('Invalid planning manager'));
			$this->Session->setFlash(__('Invalid planning manager'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PlanningManager->save($this->request->data)) {
				$this->Session->setFlash(__('The planning manager has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The planning manager could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('PlanningManager.' . $this->PlanningManager->primaryKey => $id));
			$this->request->data = $this->PlanningManager->find('first', $options);
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
		$this->PlanningManager->id = $id;
		if (!$this->PlanningManager->exists()) {
			throw new NotFoundException(__('Invalid planning manager'));
			$this->Session->setFlash(__('Invalid planning manager'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PlanningManager->delete()) {
			$this->Session->setFlash(__('The planning manager has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The planning manager could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
