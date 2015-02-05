<?php
App::uses('AppController', 'Controller');
/**
 * EvaluationStates Controller
 *
 * @property EvaluationState $EvaluationState
 * @property PaginatorComponent $Paginator
 */
class EvaluationStatesController extends AppController {

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
		$this->EvaluationState->recursive = 0;
		$this->set('evaluationStates', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EvaluationState->exists($id)) {
			//throw new NotFoundException(__('Invalid evaluation state'));
			$this->Session->setFlash(__('Invalid evaluation state'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}

		// Use containable for retreive related table data
		$this->EvaluationState->Behaviors->load('Containable');

		$options = array(
			'conditions' => array('EvaluationState.' . $this->EvaluationState->primaryKey => $id), 
			// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
			'contain' => array('Package' => array('Module', 'Rfc'))
		);

		$this->set('evaluationState', $this->EvaluationState->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EvaluationState->create();
			if ($this->EvaluationState->save($this->request->data)) {
				$this->Session->setFlash(__('The evaluation state has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evaluation state could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
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
		if (!$this->EvaluationState->exists($id)) {
			//throw new NotFoundException(__('Invalid evaluation state'));
			$this->Session->setFlash(__('Invalid evaluation state'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EvaluationState->save($this->request->data)) {
				$this->Session->setFlash(__('The evaluation state has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The evaluation state could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('EvaluationState.' . $this->EvaluationState->primaryKey => $id));
			$this->request->data = $this->EvaluationState->find('first', $options);
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
		$this->EvaluationState->id = $id;
		if (!$this->EvaluationState->exists()) {
			throw new NotFoundException(__('Invalid evaluation state'));
			$this->Session->setFlash(__('Invalid evaluation state'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EvaluationState->delete()) {
			$this->Session->setFlash(__('The evaluation state has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The evaluation state could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
