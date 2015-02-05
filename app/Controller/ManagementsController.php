<?php
App::uses('AppController', 'Controller');
/**
 * Managements Controller
 *
 * @property Management $Management
 * @property PaginatorComponent $Paginator
 */
class ManagementsController extends AppController {

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
		$this->Management->recursive = 0;
		$this->set('managements', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Management->exists($id)) {
			//throw new NotFoundException(__('Invalid management'));
			$this->Session->setFlash(__('Invalid management'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array(
			'contain' => array('Area', 'Employee', 'QualityManager'), 
			'conditions' => array('Management.' . $this->Management->primaryKey => $id)
		);
		$this->set('management', $this->Management->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Management->create();
			if ($this->Management->save($this->request->data)) {
				$this->Session->setFlash(__('The management has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The management could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
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
		if (!$this->Management->exists($id)) {
			//throw new NotFoundException(__('Invalid management'));
			$this->Session->setFlash(__('Invalid management'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Management->save($this->request->data)) {
				$this->Session->setFlash(__('The management has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The management could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array(
			'contain' => array('Area', 'Employee', 'QualityManager'), 
			'conditions' => array('Management.' . $this->Management->primaryKey => $id)
		);
			$this->request->data = $this->Management->find('first', $options);
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
		$this->Management->id = $id;
		if (!$this->Management->exists()) {
			throw new NotFoundException(__('Invalid management'));
			$this->Session->setFlash(__('Invalid management'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Management->delete()) {
			$this->Session->setFlash(__('The management has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The management could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
