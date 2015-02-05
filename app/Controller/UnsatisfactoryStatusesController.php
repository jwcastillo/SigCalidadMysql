<?php
App::uses('AppController', 'Controller');
/**
 * UnsatisfactoryStatuses Controller
 *
 * @property UnsatisfactoryStatus $UnsatisfactoryStatus
 * @property PaginatorComponent $Paginator
 */
class UnsatisfactoryStatusesController extends AppController {

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
		$this->UnsatisfactoryStatus->recursive = 0;
		$this->set('unsatisfactoryStatuses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UnsatisfactoryStatus->exists($id)) {
			//throw new NotFoundException(__('Invalid unsatisfactory status'));
			$this->Session->setFlash(__('Invalid unsatisfactory status'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}

		// Use containable for retreive related table data
		$this->UnsatisfactoryStatus->Behaviors->load('Containable');

		$options = array(
			'conditions' => array('UnsatisfactoryStatus.' . $this->UnsatisfactoryStatus->primaryKey => $id), 
			// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
			'contain' => array('Package' => array('Module', 'Rfc'))
		);

		$this->set('unsatisfactoryStatus', $this->UnsatisfactoryStatus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UnsatisfactoryStatus->create();
			if ($this->UnsatisfactoryStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The unsatisfactory status has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unsatisfactory status could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		}
		$packages = $this->UnsatisfactoryStatus->Package->find('list');
		$this->set(compact('packages'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UnsatisfactoryStatus->exists($id)) {
			//throw new NotFoundException(__('Invalid unsatisfactory status'));
			$this->Session->setFlash(__('Invalid unsatisfactory status'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UnsatisfactoryStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The unsatisfactory status has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The unsatisfactory status could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('UnsatisfactoryStatus.' . $this->UnsatisfactoryStatus->primaryKey => $id));
			$this->request->data = $this->UnsatisfactoryStatus->find('first', $options);
		}
		$packages = $this->UnsatisfactoryStatus->Package->find('list');
		$this->set(compact('packages'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UnsatisfactoryStatus->id = $id;
		if (!$this->UnsatisfactoryStatus->exists()) {
			throw new NotFoundException(__('Invalid unsatisfactory status'));
			$this->Session->setFlash(__('Invalid unsatisfactory status'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UnsatisfactoryStatus->delete()) {
			$this->Session->setFlash(__('The unsatisfactory status has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The unsatisfactory status could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
