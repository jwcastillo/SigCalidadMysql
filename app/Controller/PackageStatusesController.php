<?php
App::uses('AppController', 'Controller');
/**
 * PackageStatuses Controller
 *
 * @property PackageStatus $PackageStatus
 * @property PaginatorComponent $Paginator
 */
class PackageStatusesController extends AppController {

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
		$this->PackageStatus->recursive = 0;
		$this->set('packageStatuses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PackageStatus->exists($id)) {
			//throw new NotFoundException(__('Invalid package status'));
			$this->Session->setFlash(__('Invalid package status'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}

		// Use containable for retreive related table data
		$this->PackageStatus->Behaviors->load('Containable');

		$options = array(
			'conditions' => array('PackageStatus.' . $this->PackageStatus->primaryKey => $id), 
			// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
			'contain' => array('Package' => array('Module', 'Rfc'))
		);

		$this->set('packageStatus', $this->PackageStatus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PackageStatus->create();
			if ($this->PackageStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The package status has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The package status could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
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
		if (!$this->PackageStatus->exists($id)) {
			//throw new NotFoundException(__('Invalid package status'));
			$this->Session->setFlash(__('Invalid package status'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PackageStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The package status has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The package status could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('PackageStatus.' . $this->PackageStatus->primaryKey => $id));
			$this->request->data = $this->PackageStatus->find('first', $options);
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
		$this->PackageStatus->id = $id;
		if (!$this->PackageStatus->exists()) {
			throw new NotFoundException(__('Invalid package status'));
			$this->Session->setFlash(__('Invalid package status'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PackageStatus->delete()) {
			$this->Session->setFlash(__('The package status has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The package status could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
