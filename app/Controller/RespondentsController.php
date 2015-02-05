<?php
App::uses('AppController', 'Controller');
/**
 * Respondents Controller
 *
 * @property Respondent $Respondent
 * @property PaginatorComponent $Paginator
 */
class RespondentsController extends AppController {

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
		$this->Respondent->recursive = 0;
		$this->set('respondents', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Respondent->exists($id)) {
			//throw new NotFoundException(__('Invalid respondent'));
			$this->Session->setFlash(__('Invalid respondent'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}

		// Use containable for retreive related table data
		$this->Respondent->Behaviors->load('Containable');

		$options = array(
			'conditions' => array('Respondent.' . $this->Respondent->primaryKey => $id), 
			// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
			 'contain' => array('Package' => array('Module', 'Rfc'))
		);

		$this->set('respondent', $this->Respondent->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Respondent->create();
			if ($this->Respondent->save($this->request->data)) {
				$this->Session->setFlash(__('The respondent has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The respondent could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
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
		if (!$this->Respondent->exists($id)) {
			//throw new NotFoundException(__('Invalid respondent'));
			$this->Session->setFlash(__('Invalid respondent'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Respondent->save($this->request->data)) {
				$this->Session->setFlash(__('The respondent has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The respondent could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Respondent.' . $this->Respondent->primaryKey => $id));
			$this->request->data = $this->Respondent->find('first', $options);
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
		$this->Respondent->id = $id;
		if (!$this->Respondent->exists()) {
			throw new NotFoundException(__('Invalid respondent'));
			$this->Session->setFlash(__('Invalid respondent'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Respondent->delete()) {
			$this->Session->setFlash(__('The respondent has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The respondent could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
