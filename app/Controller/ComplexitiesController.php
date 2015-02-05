<?php
App::uses('AppController', 'Controller');
/**
 * Complexities Controller
 *
 * @property Complexity $Complexity
 * @property PaginatorComponent $Paginator
 */
class ComplexitiesController extends AppController {

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
		$this->Complexity->recursive = 0;
		$this->set('complexities', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Complexity->exists($id)) {
			//throw new NotFoundException(__('Invalid complexity'));
			$this->Session->setFlash(__('Invalid complexity'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('Complexity.' . $this->Complexity->primaryKey => $id));
		$this->set('complexity', $this->Complexity->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Complexity->create();
			if ($this->Complexity->save($this->request->data)) {
				$this->Session->setFlash(__('The complexity has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The complexity could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
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
		if (!$this->Complexity->exists($id)) {
			//throw new NotFoundException(__('Invalid complexity'));
			$this->Session->setFlash(__('Invalid complexity'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Complexity->save($this->request->data)) {
				$this->Session->setFlash(__('The complexity has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The complexity could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Complexity.' . $this->Complexity->primaryKey => $id));
			$this->request->data = $this->Complexity->find('first', $options);
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
		$this->Complexity->id = $id;
		if (!$this->Complexity->exists()) {
			throw new NotFoundException(__('Invalid complexity'));
			$this->Session->setFlash(__('Invalid complexity'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Complexity->delete()) {
			$this->Session->setFlash(__('The complexity has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The complexity could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
