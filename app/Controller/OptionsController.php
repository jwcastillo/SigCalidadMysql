<?php
App::uses('AppController', 'Controller');
/**
 * Options Controller
 *
 * @property Option $Option
 * @property PaginatorComponent $Paginator
 */
class OptionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler', 'DataTable');

/**
 * index method
 *
 * @return void
 */
	public function index() {

		$this->paginate = array(
			'fields' => array('Option.id','Option.key', 'Option.value', 'Option.description')
		);

		$this->Option->recursive = -1;

		if ($this->request->is('ajax')) {
			$this->RequestHandler->setContent('json', 'application/json' );

			$this->set('response', $this->DataTable->getResponse());
			$this->set('_serialize','response');
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Option->exists($id)) {
			//throw new NotFoundException(__('Invalid option'));
			$this->Session->setFlash(__('Invalid option'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('Option.' . $this->Option->primaryKey => $id));
		$this->set('option', $this->Option->find('first', $options));

		$this->layout = ($this->request->is("ajax")) ? "ajax" : "charisma";
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Option->create();
			if ($this->Option->save($this->request->data)) {
				$this->Session->setFlash(__('The option has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The option could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
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
		if (!$this->Option->exists($id)) {
			//throw new NotFoundException(__('Invalid option'));
			$this->Session->setFlash(__('Invalid option'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Option->save($this->request->data)) {
				$this->Session->setFlash(__('The option has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The option could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Option.' . $this->Option->primaryKey => $id));
			$this->request->data = $this->Option->find('first', $options);
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
		$this->Option->id = $id;
		if (!$this->Option->exists()) {
			throw new NotFoundException(__('Invalid option'));
			$this->Session->setFlash(__('Invalid option'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Option->delete()) {
			$this->Session->setFlash(__('The option has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The option could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function test() {
		
		$this->loadModel('Mantis');

		$result = $this->Mantis->query('mc_version', array());

		debug($result, true);

		//exit;

	}

}
