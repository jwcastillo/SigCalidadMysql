<?php
App::uses('AppController', 'Controller');
/**
 * ProjectClasses Controller
 *
 * @property ProjectClass $ProjectClass
 * @property PaginatorComponent $Paginator
 */
class ProjectClassesController extends AppController {

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
		$this->ProjectClass->recursive = 0;
		$this->set('projectClasses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProjectClass->exists($id)) {
			//throw new NotFoundException(__('Invalid project class'));
			$this->Session->setFlash(__('Invalid project class'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('ProjectClass.' . $this->ProjectClass->primaryKey => $id));
		$this->set('projectClass', $this->ProjectClass->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProjectClass->create();
			if ($this->ProjectClass->save($this->request->data)) {
				$this->Session->setFlash(__('The project class has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project class could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
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
		if (!$this->ProjectClass->exists($id)) {
			//throw new NotFoundException(__('Invalid project class'));
			$this->Session->setFlash(__('Invalid project class'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProjectClass->save($this->request->data)) {
				$this->Session->setFlash(__('The project class has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project class could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('ProjectClass.' . $this->ProjectClass->primaryKey => $id));
			$this->request->data = $this->ProjectClass->find('first', $options);
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
		$this->ProjectClass->id = $id;
		if (!$this->ProjectClass->exists()) {
			throw new NotFoundException(__('Invalid project class'));
			$this->Session->setFlash(__('Invalid project class'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProjectClass->delete()) {
			$this->Session->setFlash(__('The project class has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The project class could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
