<?php
App::uses('AppController', 'Controller');
/**
 * ProjectManagers Controller
 *
 * @property ProjectManager $ProjectManager
 * @property PaginatorComponent $Paginator
 */
class ProjectManagersController extends AppController {

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
		$this->ProjectManager->recursive = 0;
		$this->set('projectManagers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProjectManager->exists($id)) {
			//throw new NotFoundException(__('Invalid project manager'));
			$this->Session->setFlash(__('Invalid project manager'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('ProjectManager.' . $this->ProjectManager->primaryKey => $id));
		$this->set('projectManager', $this->ProjectManager->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProjectManager->create();
			if ($this->ProjectManager->save($this->request->data)) {
				$this->Session->setFlash(__('The project manager has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project manager could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
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
		if (!$this->ProjectManager->exists($id)) {
			//throw new NotFoundException(__('Invalid project manager'));
			$this->Session->setFlash(__('Invalid project manager'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProjectManager->save($this->request->data)) {
				$this->Session->setFlash(__('The project manager has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project manager could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('ProjectManager.' . $this->ProjectManager->primaryKey => $id));
			$this->request->data = $this->ProjectManager->find('first', $options);
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
		$this->ProjectManager->id = $id;
		if (!$this->ProjectManager->exists()) {
			throw new NotFoundException(__('Invalid project manager'));
			$this->Session->setFlash(__('Invalid project manager'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProjectManager->delete()) {
			$this->Session->setFlash(__('The project manager has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The project manager could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	public function getList() {
		$developmentManagerId = $this->request->data('developmentManagerId');

		$options = array(
			'fields' => array(
				'ProjectManager.id', 
				'ProjectManager.name', 
			), 
			'contain' => array('DevelopmentManager'),
		);

		if (isset($developmentManagerId) && !empty($developmentManagerId)) {
			$options['conditions'] = array(
				'DevelopmentManager.id' => $developmentManagerId, 
			);
		}

		$list = $this->ProjectManager->find('all', $options);

		$result = array();
		foreach ($list as $e) {
			$result[] = array(
				'label' => $e['ProjectManager']['name'], 
				'value' => $e['ProjectManager']['id']
			);
		}

		$this->RequestHandler->setContent('json', 'application/json' );

		$this->set('response', $result);
		$this->set('_serialize','response');
	}



}
