<?php
App::uses('AppController', 'Controller');
/**
 * Modules Controller
 *
 * @property Module $Module
 * @property PaginatorComponent $Paginator
 */
class ModulesController extends AppController {

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
		$this->Module->recursive = 0;
		$this->set('modules', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Module->exists($id)) {
			//throw new NotFoundException(__('Invalid module'));
			$this->Session->setFlash(__('Invalid module'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}

		// Use containable for retreive related table data
		$this->Module->Behaviors->load('Containable');

		$options = array(
			'conditions' => array(
				'Module.' . $this->Module->primaryKey => $id,
			 ),
			// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
			 'contain' => array('Package' => array('Module', 'Rfc'), 'Area')
		);

		$this->set('module', $this->Module->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Module->create();
			if ($this->Module->save($this->request->data)) {
				$this->Session->setFlash(__('The module has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The module could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		}
		$areas = $this->Module->Area->find('list');
		$this->set(compact('areas'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Module->exists($id)) {
			//throw new NotFoundException(__('Invalid module'));
			$this->Session->setFlash(__('Invalid module'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Module->save($this->request->data)) {
				$this->Session->setFlash(__('The module has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The module could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Module.' . $this->Module->primaryKey => $id));
			$this->request->data = $this->Module->find('first', $options);
		}
		$areas = $this->Module->Area->find('list');
		$this->set(compact('areas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Module->id = $id;
		if (!$this->Module->exists()) {
			throw new NotFoundException(__('Invalid module'));
			$this->Session->setFlash(__('Invalid module'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Module->delete()) {
			$this->Session->setFlash(__('The module has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The module could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
