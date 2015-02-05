<?php
App::uses('AppController', 'Controller');
/**
 * PackageClasses Controller
 *
 * @property PackageClass $PackageClass
 * @property PaginatorComponent $Paginator
 */
class PackageClassesController extends AppController {

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
		$this->PackageClass->recursive = 0;
		$this->set('packageClasses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PackageClass->exists($id)) {
			//throw new NotFoundException(__('Invalid package class'));
			$this->Session->setFlash(__('Invalid package class'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('PackageClass.' . $this->PackageClass->primaryKey => $id));
		$this->set('packageClass', $this->PackageClass->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PackageClass->create();
			if ($this->PackageClass->save($this->request->data)) {
				$this->Session->setFlash(__('The package class has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The package class could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
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
		if (!$this->PackageClass->exists($id)) {
			//throw new NotFoundException(__('Invalid package class'));
			$this->Session->setFlash(__('Invalid package class'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PackageClass->save($this->request->data)) {
				$this->Session->setFlash(__('The package class has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The package class could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('PackageClass.' . $this->PackageClass->primaryKey => $id));
			$this->request->data = $this->PackageClass->find('first', $options);
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
		$this->PackageClass->id = $id;
		if (!$this->PackageClass->exists()) {
			throw new NotFoundException(__('Invalid package class'));
			$this->Session->setFlash(__('Invalid package class'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PackageClass->delete()) {
			$this->Session->setFlash(__('The package class has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The package class could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
