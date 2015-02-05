<?php
App::uses('AppController', 'Controller');
/**
 * DevelopmentManagers Controller
 *
 * @property DevelopmentManager $DevelopmentManager
 * @property PaginatorComponent $Paginator
 */
class DevelopmentManagersController extends AppController {

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
		$this->DevelopmentManager->recursive = 0;
		$this->set('developmentManagers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DevelopmentManager->exists($id)) {
			//throw new NotFoundException(__('Invalid development manager'));
			$this->Session->setFlash(__('Invalid development manager'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('DevelopmentManager.' . $this->DevelopmentManager->primaryKey => $id));
		$this->set('developmentManager', $this->DevelopmentManager->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DevelopmentManager->create();
			if ($this->DevelopmentManager->save($this->request->data)) {
				$this->Session->setFlash(__('The development manager has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The development manager could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
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
		if (!$this->DevelopmentManager->exists($id)) {
			//throw new NotFoundException(__('Invalid development manager'));
			$this->Session->setFlash(__('Invalid development manager'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DevelopmentManager->save($this->request->data)) {
				$this->Session->setFlash(__('The development manager has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The development manager could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('DevelopmentManager.' . $this->DevelopmentManager->primaryKey => $id));
			$this->request->data = $this->DevelopmentManager->find('first', $options);
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
		$this->DevelopmentManager->id = $id;
		if (!$this->DevelopmentManager->exists()) {
			throw new NotFoundException(__('Invalid development manager'));
			$this->Session->setFlash(__('Invalid development manager'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DevelopmentManager->delete()) {
			$this->Session->setFlash(__('The development manager has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The development manager could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	public function getList() {
		$projectManagerId = $this->request->data('projectManagerId');

		$options = array(
			'fields' => array(
				'DevelopmentManager.id', 
				'DevelopmentManager.name', 
			), 
			'contain' => array('ProjectManager'),
		);

		if ($projectManagerId) {
			$options['conditions'] = array(
				'ProjectManager.id' => $projectManagerId, 
			);
		}

		$list = $this->DevelopmentManager->find('all', $options);

		$result = array();
		foreach ($list as $e) {
			$result[] = array(
				'label' => $e['DevelopmentManager']['name'], 
				'value' => $e['DevelopmentManager']['id']
			);
		}

		$this->RequestHandler->setContent('json', 'application/json' );

		$this->set('response', $result);
		$this->set('_serialize','response');
	}

}
