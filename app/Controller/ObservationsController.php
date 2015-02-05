<?php
App::uses('AppController', 'Controller');
/**
 * Observations Controller
 *
 * @property Observation $Observation
 * @property PaginatorComponent $Paginator
 */
class ObservationsController extends AppController {

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
		$this->Observation->recursive = 0;
		$package= array();
		$observations = $this->Paginator->paginate();
		foreach ($observations as $key => $value) {
			
			$packageId[$value['Observation']['id']] = $this->Observation->getPackageId($value['Observation']['id']);
			$employeeId[$value['Observation']['id']] = $this->Observation->getEmployeeId($value['Observation']['id']);
		}
		

		$this->set(compact('observations','packageId','employeeId'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Observation->exists($id)) {
			//throw new NotFoundException(__('Invalid observation'));
			$this->Session->setFlash(__('Invalid observation'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$options = array('conditions' => array('Observation.' . $this->Observation->primaryKey => $id));
		
		$observation = $this->Observation->find('first', $options);
		$packageId[$observation['Observation']['id']] = $this->Observation->getPackageId($observation['Observation']['id']);
		$employeeId[$observation['Observation']['id']] = $this->Observation->getEmployeeId($observation['Observation']['id']);
		$this->set(compact('observation','packageId','employeeId'));
}
/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Observation->create();
			if ($this->Observation->save($this->request->data)) {

				$this->Session->setFlash(__('The observation has been saved.'), 'flash', array ('class' => 'success'));

				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The observation could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		}
		$packageStatuses = $this->Observation->PackageStatus->find('list');
		$this->set(compact('packageStatuses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Observation->exists($id)) {
			//throw new NotFoundException(__('Invalid observation'));
			$this->Session->setFlash(__('Invalid observation'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Observation->save($this->request->data)) {

				$this->Session->setFlash(__('The observation has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The observation could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Observation.' . $this->Observation->primaryKey => $id));
			$this->request->data = $this->Observation->find('first', $options);
		}
		$packageStatuses = $this->Observation->PackageStatus->find('list');
		$this->set(compact('packageStatuses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Observation->id = $id;
		if (!$this->Observation->exists()) {
			throw new NotFoundException(__('Invalid observation'));
			$this->Session->setFlash(__('Invalid observation'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Observation->delete()) {
			$this->Session->setFlash(__('The observation has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The observation could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	} 



public function viewSuspended($management_id=NULL, $employee_id=NULL, $package=NULL) {

	$managers = $this->Session->read('Options.managers');

		if ($management_id==NULL){
				$management_id = (isset($management_id)) ? $management_id : $this->Session->read('Auth.User.management');
		}
		else{
			$management_id=explode("|", $management_id);			
		}

		$employee_bc='0';
		if ($employee_id){
			$employee_bc=$this->Session->read('Auth.User.username');
		}

	$conditions[]=array();
	$conditions['observation.title LIKE']='%SUSPENDIDO%';
	$conditions['observation.disable']=0;
	
	if (in_array($this->Session->read('Auth.User.employeeId'), $managers) ) {
		$query_parts = array();
		
		foreach ($management_id as $key => $value) {
				$query_parts[]="observation.title LIKE '%#".$value."%'";
		}
			
		$string = ' ('. implode(' OR ', $query_parts). ')' ;
		$conditions[]=$string;
	}
	else{
		
		if ($employee_bc){
			$conditions['observation.bc LIKE']= "%$employee_bc%";
		}
	}

	if ($package){
			$conditions['observation.package LIKE']="%$package%";
	}
	$options = array('conditions' => $conditions);
	$observations = $this->Observation->find('all', $options);
	$this->paginate = $options;
	$this->set('observations', $this->Paginator->paginate());

	$this->render('index');


}	






//FIXME
function perro($columnNames, $values, $type = 'OR') {

	$return = array();

	foreach ($columnNames as $key => $column) {
		if (!isset($return["$column LIKE"]))
			$return["$column LIKE"] = $value[$key];
		else
			$return[$type]["$column LIKE"] = $value[$key];
	}

	return $return;

}



}

?>