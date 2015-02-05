<?php
App::uses('AppController', 'Controller');
/**
 * Histories Controller
 *
 * @property History $History
 * @property PaginatorComponent $Paginator
 */
class HistoriesController extends AppController {

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
		$this->History->recursive = 0;
		$package= array();
		$histories = $this->Paginator->paginate();
		foreach ($histories as $key => $value) {
			$packageId[$value['History']['id']] = $this->History->getPackageId($value['History']['id']);
		}
		
		$this->set(compact('histories','packageId'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->History->exists($id)) {
			//throw new NotFoundException(__('Invalid history'));
			$this->Session->setFlash(__('Invalid history'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('History.' . $this->History->primaryKey => $id));
		$history = $this->History->find('first', $options);
		$packageId[$history['History']['id']] = $this->History->getPackageId($history['History']['id']);
		$this->set(compact('history','packageId'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->History->create();
			if ($this->History->save($this->request->data)) {
				$this->Session->setFlash(__('The history has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The history could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
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
		if (!$this->History->exists($id)) {
			//throw new NotFoundException(__('Invalid history'));
			$this->Session->setFlash(__('Invalid history'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->History->save($this->request->data)) {
				$this->Session->setFlash(__('The history has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The history could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('History.' . $this->History->primaryKey => $id));
			$this->request->data = $this->History->find('first', $options);
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
		$this->History->id = $id;
		if (!$this->History->exists()) {
			throw new NotFoundException(__('Invalid history'));
			$this->Session->setFlash(__('Invalid history'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->History->delete()) {
			$this->Session->setFlash(__('The history has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The history could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
