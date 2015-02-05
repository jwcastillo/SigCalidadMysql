<?php
App::uses('AppController', 'Controller');
/**
 * QualityManagers Controller
 *
 * @property QualityManager $QualityManager
 * @property PaginatorComponent $Paginator
 */
class QualityManagersController extends AppController {

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
		$this->QualityManager->recursive = 0;
		$this->set('qualityManagers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->QualityManager->exists($id)) {
			//throw new NotFoundException(__('Invalid quality manager'));
			$this->Session->setFlash(__('Invalid quality manager'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->QualityManager->recursive = 0;
		$options = array('conditions' => array('QualityManager.' . $this->QualityManager->primaryKey => $id));
		$this->set('qualityManager', $this->QualityManager->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->QualityManager->create();
			if ($this->QualityManager->save($this->request->data)) {
				$this->Session->setFlash(__('The quality manager has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quality manager could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		}
		$employees = $this->QualityManager->Employee->find('list');
		$managements = $this->QualityManager->Management->find('list');
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
		if (!$this->QualityManager->exists($id)) {
			//throw new NotFoundException(__('Invalid quality manager'));
			$this->Session->setFlash(__('Invalid quality manager'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->QualityManager->save($this->request->data)) {
				$this->Session->setFlash(__('The quality manager has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quality manager could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('QualityManager.' . $this->QualityManager->primaryKey => $id));
			$this->request->data = $this->QualityManager->find('first', $options);
		}
		$employees = $this->QualityManager->Employee->find('list');
		$managements = $this->QualityManager->Management->find('list');
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
		$this->QualityManager->id = $id;
		if (!$this->QualityManager->exists()) {
			throw new NotFoundException(__('Invalid quality manager'));
			$this->Session->setFlash(__('Invalid quality manager'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->QualityManager->delete()) {
			$this->Session->setFlash(__('The quality manager has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The quality manager could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
