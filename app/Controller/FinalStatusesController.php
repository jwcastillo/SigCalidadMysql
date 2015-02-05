<?php
App::uses('AppController', 'Controller');
/**
 * FinalStatuses Controller
 *
 * @property FinalStatus $FinalStatus
 * @property PaginatorComponent $Paginator
 */
class FinalStatusesController extends AppController {

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
		$this->FinalStatus->recursive = 0;
		$this->set('finalStatuses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FinalStatus->exists($id)) {
			//throw new NotFoundException(__('Invalid final status'));
			$this->Session->setFlash(__('Invalid final status'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}

		// Use containable for retreive related table data
		$this->FinalStatus->Behaviors->load('Containable');

		$options = array(
			'conditions' => array('FinalStatus.' . $this->FinalStatus->primaryKey => $id), 
			// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
			'contain' => array('Package' => array('Module', 'Rfc'))
		);

		$this->set('finalStatus', $this->FinalStatus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FinalStatus->create();
			if ($this->FinalStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The final status has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The final status could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
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
		if (!$this->FinalStatus->exists($id)) {
			//throw new NotFoundException(__('Invalid final status'));
			$this->Session->setFlash(__('Invalid final status'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FinalStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The final status has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The final status could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('FinalStatus.' . $this->FinalStatus->primaryKey => $id));
			$this->request->data = $this->FinalStatus->find('first', $options);
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
		$this->FinalStatus->id = $id;
		if (!$this->FinalStatus->exists()) {
			throw new NotFoundException(__('Invalid final status'));
			$this->Session->setFlash(__('Invalid final status'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FinalStatus->delete()) {
			$this->Session->setFlash(__('The final status has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The final status could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
