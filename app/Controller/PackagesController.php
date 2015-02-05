<?php
App::uses('AppController', 'Controller');
/**
 * Packages Controller
 *
 * @property Package $Package
 * @property PaginatorComponent $Paginator
 */
class PackagesController extends AppController {
			


/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler', 'DataTable', 'HighCharts.HighCharts','Common');

/**
 * index method
 *
 * @return void
 */
	public function index2() {
		$this->Package->recursive = 0;
		$this->set('packages', $this->Paginator->paginate());
	}

/**
 * index2 method
 *
 * @return void
 */
	
	public function index() {

		$options = array(
			'fields' => array(
				'Package.id', 
				'Package.number_package', 
				'Module.name',
				'Package.employee',
				'PackageStatus.name',
				'Rfc.name',
				'Package.entry_date',
				'Package.type',
				'Package.start_date',
				'Package.end_date',
				'Package.replanning_date',
				'Package.certified_date',
				'EvaluationState.name',
				/*'Management.name'*/
			),
			//'link' => array('Module', 'Employee', 'PackageStatus', 'Rfc', 'EvaluationState','Management')
			'link' => array(
				'Module' => array('fields' => array('id', 'name')), 
				'Employee' => array('fields' => array('id', 'name')), 
				'PackageStatus' => array('fields' => array('id', 'name')), 
				'Rfc' => array('fields' => array('id', 'name')), 
				'EvaluationState' => array('fields' => array('id', 'name')), 
				'Management' => array('fields' => array('id', 'name'))
			),

			'conditions' => array('Package.management_id' => $this->Session->read('Auth.User.management')) 
		);

		$managers = $this->Session->read('Options.managers');
		// If it is a employee show him only his packages
		if (!in_array($this->Session->read('Auth.User.employeeId'), $managers) ) {
			$options['conditions']['Package.employee_id'] = $this->Session->read('Auth.User.employeeId');
		}

		$this->paginate = $options;

		$this->Package->virtualFields['employee'] = $this->Package->Employee->virtualFields['fullname'];

		if ($this->request->is('ajax')) {
			$this->RequestHandler->setContent('json', 'application/json' );


			$this->set('response', $this->DataTable->getResponse());
			$this->set('_serialize','response');
		}

	}


public function reports($certified = 0) {

		$this->Package->Behaviors->load('Containable');

		$this->Package->Rfc->Behaviors->load('Containable');

		$aux = array('fields' => array('id', 'name'));

		$management_id = $this->Session->read('Auth.User.management');

		if ($management_id)
			$conditions['Package.management_id'] = $this->Session->read('Auth.User.management');

		if($certified ==1 ) {
			$title = __('Certified Packages');
			$conditions['Package.package_status_id'] = $this->Session->read('Options.certifiedStatus');
		} else {
			$title = __('Packages in Progress');
			$conditions['Package.package_status_id <'] = $this->Session->read('Options.certifiedStatus');
			$conditions['Package.employee_id !='] = $this->Session->read('Options.unassignedEmployee');
		}

		$this->paginate = array(
			'fields' => array(
				'Package.id', 
				'Package.number_package', 
				'Module.name', 
				'Rfc.name', 
				'PackageStatus.name', 
				'Package.type', 
				'Package.entry_date',
				'Package.certified_date',
				'Package.employee',
				'Package.analyst', 
				'Package.applicant', 				
				'Package.PlanningManager', 
				'Package.ProjectManager', 
				'Rfc.high_impact', 
				'Package.components_amount', 
			), 
		// FIXME: Bind model dynamicly http://mark-story.com/posts/view/using-bindmodel-to-get-to-deep-relations
		'link' => array(
			'Rfc' => array('ProjectManager' => $aux, 'PlanningManager' => $aux, 'fields' => $aux['fields']), 
			'Module' => $aux, 
			'Employee' => $aux,
			'PackageStatus' => $aux,
			'Management' => $aux,
			),

			'conditions' => $conditions,
		);

		$this->Package->virtualFields['employee'] = $this->Package->Employee->virtualFields['fullname'];

		$this->Package->virtualFields['PlanningManager'] = 'PlanningManager.name';

		$this->Package->virtualFields['ProjectManager'] = 'ProjectManager.name';

		//debug($this->Package->find('all', $this->paginate));

		if ($this->request->is('ajax')) {
			$this->RequestHandler->setContent('json', 'application/json' );

			// Converting High Impact field
			$response = $this->DataTable->getResponse();
			$aaData = array();
			foreach ($response['aaData'] as $row) {
				$row[13] = $row[13] ? __('Yes') : __('No');
				$aaData[] = $row;

			}
			$response['aaData'] = $aaData;

			$this->set('response', $response);
			$this->set('_serialize','response');
		}

		$this->set('title', $title);
}

/**
 * evaluation method
 *
 * @return void
 */
	public function evaluation() {
		$this->paginate = array(
			'fields' => array(
				'Package.id', 
				'Package.number_package', 
				'Module.name',
				'Package.employee',
				'PackageStatus.name',
				'Rfc.name',
				'Package.type',
				'Package.entry_date',
				'Package.management_entry_date',
				'Package.assignment_date',
				'Package.start_date',
				'Package.end_date',
				'Package.replanning_date',
				'Package.certified_date',
				'Package.weighting',
				'Package.final_weighting',
				'Package.trial_days',
				'Package.certification_days',
				'Package.ttc',
				'Package.ttp',
				'Package.auto_assign',
				'Package.overfulfillment_effectiveness',
				'Package.deviation_effectiveness',
				'Package.effectiveness_evaluation',
				/*'EvaluationState.name',
				'Management.name'*/
			),
			//'link' => array('Module', 'Employee', 'PackageStatus', 'Rfc', 'EvaluationState','Management')
			'link' => array(
				'Module' => array('fields' => array('id', 'name')), 
				'Employee' => array('fields' => array('id', 'name')), 
				'PackageStatus' => array('fields' => array('id', 'name')), 
				'Rfc' => array('fields' => array('id', 'name')), 
				'EvaluationState' => array('fields' => array('id', 'name')), 
				'Management' => array('fields' => array('id', 'name'))
			),

			'conditions' => array('Package.management_id' => $this->Session->read('Options.managers'),
			'Package.package_status_id' => $this->Session->read('Options.certifiedStatus') ), 'order' => array('Package.certified_date')
		);

		$this->Package->virtualFields['employee'] = $this->Package->Employee->virtualFields['fullname'];

		if ($this->request->is('ajax')) {
			$this->RequestHandler->setContent('json', 'application/json' );


			$this->set('response', $this->DataTable->getResponse());
			$this->set('_serialize','response');
		} else {
			// Normal request

			/*$this->Package->recursive = 0;
			$this->set('packages', $this->Paginator->paginate());*/
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
		if (!$this->Package->exists($id)) {
			throw new NotFoundException(__('Invalid package'));
		}

		$options = array('conditions' => array('Package.' . $this->Package->primaryKey => $id));
		
		$package = $this->Package->find('first', $options);
		
		$this->set(compact('package'));
		
		$this->layout = ($this->request->is("ajax")) ? "ajax" : "charisma";
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Package->create();
			if ($this->Package->save($this->request->data)) {
				$this->Session->setFlash(__('The package has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The package could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		}
		$modules = $this->Package->Module->find('list');
		$employees = $this->Package->Employee->find('list');
		$packageStatuses = $this->Package->PackageStatus->find('list');
		$rfcs = $this->Package->Rfc->find('list');
		$respondents = $this->Package->Respondent->find('list');
		$evaluationStates = $this->Package->EvaluationState->find('list');
		$finalStatuses = $this->Package->FinalStatus->find('list');
		$managements = $this->Package->Management->find('list');
		//$unsatisfactoryStatuses = $this->Package->UnsatisfactoryStatus->find('list');
		$unsatisfactoryStatuses = $this->Package->UnsatisfactoryStatus->getOptList();
		$this->set(compact('modules', 'employees', 'packageStatuses', 'rfcs', 'respondents', 'evaluationStates', 'finalStatuses', 'managements', 'unsatisfactoryStatuses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Package->exists($id)) {
			//throw new NotFoundException(__('Invalid package'));
			$this->Session->setFlash(__('Invalid package'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Package->save($this->request->data)) {
				$this->Session->setFlash(__('The package has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The package could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('Package.' . $this->Package->primaryKey => $id));
			$this->request->data = $this->Package->find('first', $options);
		}
		$modules = $this->Package->Module->find('list');
		$employees = $this->Package->Employee->find('list');
		$packageStatuses = $this->Package->PackageStatus->find('list');
		$rfcs = $this->Package->Rfc->find('list');
		$respondents = $this->Package->Respondent->find('list');
		$evaluationStates = $this->Package->EvaluationState->find('list');
		$finalStatuses = $this->Package->FinalStatus->find('list');
		$managements = $this->Package->Management->find('list');
		//$unsatisfactoryStatuses = $this->Package->UnsatisfactoryStatus->find('list');
		$unsatisfactoryStatuses = $this->Package->UnsatisfactoryStatus->getOptList();
		$this->set(compact('modules', 'employees', 'packageStatuses', 'rfcs', 'respondents', 'evaluationStates', 'finalStatuses', 'managements', 'unsatisfactoryStatuses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Package->id = $id;
		if (!$this->Package->exists()) {
			throw new NotFoundException(__('Invalid package'));
			$this->Session->setFlash(__('Invalid package'), 
				'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Package->delete()) {
			$this->Session->setFlash(__('The package has been deleted.'), 'flash', array ('class' => 'block'));
		} else {
			$this->Session->setFlash(__('The package could not be deleted. Please, try again.'), 'flash', array ('class' => 'error'));
		}
		return $this->redirect(array('action' => 'index'));
	}
/**
 * promoted method
 *
 * @param int $range
 * @param int $management_id
 * @return void
 */

public function promoted($range = 0,$management_id=NULL, $employee_id = NULL) {
		$manager_id=$this->Session->read('Options.managers');
		$certifiedStatus = $this->Session->read('Options.certifiedStatus');

		$conditions[]=array();
		if ($management_id==NULL){
			$management_id=$this->Session->read('Options.unassignedManagement');
		}else{
			$management_id=explode("|", $management_id);
			//$conditions['Package.certified_date'] = '0000-00-00 00:00:00'; 
		}
 
		if ($employee_id==NULL){
			$employee_id=$this->Session->read('Options.unassignedEmployee');
		}else{
			$employee_id=explode("|", $employee_id);
		}
	
		 $DaysRollback = $this->Session->read('Options.DaysRollback');
		 $DaysPromoted = $this->Session->read('Options.DaysPromoted');

			if (in_array($this->Session->read('Auth.User.employeeId'),$manager_id))
		{
			
			$conditions['Package.management_id'] = $management_id;
		}

		
		switch ($range) {
			case 0:
				$conditions['Package.employee_id'] = $employee_id;
				
			//debug($conditions);			

			break;
			case 1:
					//$conditions['Package.package_status_id <'] = $certifiedStatus; 
					$conditions['Package.employee_id'] = $employee_id;
					$conditions['Package.entry_date >='] = date("Y-m-d", strtotime(date("Y-m-d") . " -" . $DaysRollback   . " day"));			//  CakeLog::write('debug', '1'); 
					//$conditions['DATE_FORMAT(Package.entry_date, \'%Y-%m-%d\') <']= date("Y-m-d", strtotime(date("Y-m-d") ."-". ($DaysPromoted - $DaysRollback)   ." day"));
			break;
			case 2:
				//$conditions['Package.package_status_id <'] = $certifiedStatus; 
				$conditions['Package.employee_id'] = $employee_id;
				$conditions['DATE_FORMAT(Package.entry_date, \'%Y-%m-%d\')'] = date("Y-m-d", strtotime(date("Y-m-d") ."-". ($DaysPromoted - $DaysRollback)   ." day"));
			break;
			case 3:
				//$conditions['Package.package_status_id <'] = $certifiedStatus; 
				$conditions['Package.employee_id'] = $employee_id;
				$conditions['Package.entry_date <'] = date("Y-m-d", strtotime(date("Y-m-d") ."-".  ($DaysPromoted - $DaysRollback)   ." day"));

			break;
			case 3:
			$conditions['Package.employee_id'] != $this->Session->read('Options.unassignedEmployee');
			$conditions['Package.certified_date'] = '0000-00-00 00:00:00';
  	$conditions['Package.package_status_id'] < $certifiedStatus;
  		 $conditions['Package.start_date'] > date("Y-m-d");

			break;
			default:
				$conditions['Package.employee_id'] = $employee_id;

				//$conditions['Package.package_status_id <'] = $certifiedStatus;
			break;
		}


		$this->paginate = array(
			'fields' => array(
				'Package.id', 
				'Package.number_package', 
				'Module.name',
				'Package.employee',
				'PackageStatus.name',
				'Rfc.name',
				'Package.entry_date',
				'Package.type',
				'Package.start_date',
				'Package.end_date',
				'Package.replanning_date',
				'Package.certified_date',
				/*'EvaluationState.name',
				'Management.name'*/
			),
			//'link' => array('Module', 'Employee', 'PackageStatus', 'Rfc', 'EvaluationState','Management')
			'link' => array(
				'Module' => array('fields' => array('id', 'name')), 
				'Employee' => array('fields' => array('id', 'name')), 
				'PackageStatus' => array('fields' => array('id', 'name')), 
				'Rfc' => array('fields' => array('id', 'name')), 
				'EvaluationState' => array('fields' => array('id', 'name')), 
				'Management' => array('fields' => array('id', 'name'))
			),
			'conditions' => $conditions,
		'order' => array('Package.certified_date DESC'),
    //'group' => array('Model.field'),
		);

		$this->Package->virtualFields['employee'] = $this->Package->Employee->virtualFields['fullname'];

		if ($this->request->is('ajax'))
		{
			$this->RequestHandler->setContent('json', 'application/json' );
			$this->set('response', $this->DataTable->getResponse());
			$this->set('_serialize','response');
		} else {
			// Normal request
			//$this->Package->recursive = 0;
			$packages = $this->Paginator->paginate();
			//$this->set('packages', $this->Paginator->paginate());
			$columns = array(__('Id'), __('Number'), __('Module'), 
							__('QA Lead'), __('Status'), 
							__('Rfc'), __('Income'), __('Type'), 
							__('Start'), __('End'), __('Replanning'), __('Certified')) ;

			$this->set(compact('packages', 'range', 'management_id','employee_id','columns'));
		}

		$this->render('index');
	}


	public function process($range = 0,$management_id=NULL, $employee_id=NULL ) {
		$manager_id=$this->Session->read('Options.managers');
		$long = $this->Session->read('Options.long');
		$medium = $this->Session->read('Options.medium');
		$short = $this->Session->read('Options.short');
		$certifiedStatus = $this->Session->read('Options.certifiedStatus');
		$suspendedStatus = $this->Session->read('Options.suspendEdstatus');
		$conditions[]=array();
		
		if ($management_id==NULL){
			$management_id=$this->Session->read('Options.unassignedManagement');
		}else{
			$management_id=explode("|", $management_id);
		}
 
		if ($employee_id==NULL){
			$employee_id=$this->Session->read('Options.unassignedEmployee');
		}else{
			$employee_id=explode("|", $employee_id);
		}

		if (in_array($this->Session->read('Auth.User.employeeId'),$manager_id))
		{
			//$conditions['Package.employee_id !='] = $employee_id;
			$conditions['Package.management_id'] = $management_id;
		}
		else{
			$conditions['Package.employee_id'] = $employee_id;
		}



			switch ($range) {
				case 0:
				//sin arrancar notificacion
					$conditions['Package.package_status_id <'] = $certifiedStatus; 
					$conditions['Package.certified_date'] = '0000-00-00 00:00:00'; 
					$conditions['Package.start_date >'] = date("Y-m-d");
										
				break;
				case 1:
				//en proceso notificacion
					//$conditions['Package.start_date <='] = date("Y-m-d");
					$conditions['Package.package_status_id <'] = $certifiedStatus; 
					$conditions['Package.certified_date'] = '0000-00-00 00:00:00'; 

				break;
				case 2:
					//$conditions['Package.package_status_id '] = $certifiedStatus;
					$conditions['AND']['OR']['Package.certified_date !='] = '0000-00-00 00:00:00';
				//	$conditions['OR']['Package.certified_date'] = '0000-00-00 00:00:00';
					$conditions['AND']['OR']['Package.package_status_id'] = $certifiedStatus;

					
				break;
				case 3:
					$conditions['IFNULL( Package.replanning_date, Package.end_date )  <'] = date("Y-m-d");
					$conditions['Package.package_status_id <'] = $certifiedStatus;
					$conditions['Package.certified_date'] = '0000-00-00 00:00:00';

				break;
				case 4:
					$conditions['Package.package_status_id'] = $suspendedStatus;
				break;
				case 5:
					$conditions['Package.certified_date'] = '0000-00-00 00:00:00'; 
					$conditions['Package.package_status_id <'] = $certifiedStatus;


				

 
				break;
				case 6:
					$conditions['Package.certified_date'] = '0000-00-00 00:00:00'; 
					$conditions['Package.package_status_id <'] = $certifiedStatus;
				


				break;
				case 7:
					$conditions['Package.certified_date'] = '0000-00-00 00:00:00'; 
					$conditions['Package.package_status_id <'] = $certifiedStatus;

					



				break;
				case 8:
					$conditions['Package.certified_date'] = '0000-00-00 00:00:00'; 
					$conditions['Package.package_status_id <'] = $certifiedStatus;

				break;
				case 9:
					$conditions['Package.evaluation_state_id'] =1 ;
					$conditions['Package.package_status_id '] = $certifiedStatus; 

				break;
				case 10:
					$conditions['Package.evaluation_state_id'] =2 ;
					$conditions['Package.package_status_id '] = $certifiedStatus; 

				break;
				case 11:
					$conditions['Package.evaluation_state_id'] =3 ;
					$conditions['Package.package_status_id '] = $certifiedStatus; 

				break;
				case 12:
					$conditions['Package.certified_date'] = '0000-00-00 00:00:00'; 
					$conditions['Package.package_status_id <'] = $certifiedStatus;
					$conditions['Package.start_date >'] = date("Y-m-d");

				break;
				default:
					//CakeLog::write('debug', 'default');
				break;
	}
if ( $range ==9 || $range==2 || $range==10 || $range==11){
	$this->paginate = array(
			'fields' => array(
				'Package.id', 
				'Package.number_package', 
				'Module.name',
				'Package.employee',
				'PackageStatus.name',
				'Rfc.name',
				'Package.entry_date',
				'Package.type',
				'Package.start_date',
				'Package.end_date',
				'Package.replanning_date',
				'Package.certified_date',
				'EvaluationState.name',
				/*'Management.name'*/
			),
			//'link' => array('Module', 'Employee', 'PackageStatus', 'Rfc', 'EvaluationState','Management')
			'link' => array(
				'Module' => array('fields' => array('id', 'name')), 
				'Employee' => array('fields' => array('id', 'name')), 
				'PackageStatus' => array('fields' => array('id', 'name')), 
				'Rfc' => array('fields' => array('id', 'name')), 
				'EvaluationState' => array('fields' => array('id', 'name')), 
				'Management' => array('fields' => array('id', 'name'))
			),
			'conditions' => $conditions
		);

	$columns = array(__('Id'), __('Number'), __('Module'), 
							__('QA Lead'), __('Status'), 
							__('Rfc'), __('Income'), __('Type'), 
							__('Start'), __('End'), __('Replanning'), __('Certified'), __('Evaluation')) ;
			$this->set(compact('packages', 'range', 'management_id','employee_id','manager_id','EvaluationState_id','columns'));
	
}
	else{

$this->paginate = array(
			'fields' => array(
				'Package.id', 
				'Package.number_package', 
				'Module.name',
				'Package.employee',
				'PackageStatus.name',
				'Rfc.name',
				'Package.entry_date',
				'Package.type',
				'Package.start_date',
				'Package.end_date',
				'Package.replanning_date',
				/*'Management.name'*/
			),
			//'link' => array('Module', 'Employee', 'PackageStatus', 'Rfc', 'EvaluationState','Management')
			'link' => array(
				'Module' => array('fields' => array('id', 'name')), 
				'Employee' => array('fields' => array('id', 'name')), 
				'PackageStatus' => array('fields' => array('id', 'name')), 
				'Rfc' => array('fields' => array('id', 'name')), 
				'Management' => array('fields' => array('id', 'name'))
			),
			'conditions' => $conditions
		);
	$columns = array(__('Id'), __('Number'), __('Module'), 
							__('QA Lead'), __('Status'), 
							__('Rfc'), __('Income'), __('Type'), 
							__('Start'), __('End'), __('Replanning')) ;
			$this->set(compact('packages', 'range', 'management_id','employee_id','manager_id','columns'));
	
	}

		$this->Package->virtualFields['employee'] = $this->Package->Employee->virtualFields['fullname'];

		

		if ($this->request->is('ajax'))
		{

			$this->RequestHandler->setContent('json', 'application/json' );
			$response = $this->DataTable->getResponse();
						if ($range==3)
						{
							$aaData0 = array(); 
		 				 foreach ($response['aaData'] as $row) {
		      # code...
		    			  $fechaFin=$row[9];
		  				   if (!empty($row[10])) {
						              $fechaFin=$row[10];
						      }
		  				$timep=(int) $this->Common->timeToPercentage($row[8],$fechaFin,date("Y-m-d"));


		   				 if  ($timep>=100) {
		      			    $aaData0[] = $row;
		    				
		    			}
						}
					 if ($range ==3){
				    	$response['aaData'] = $aaData0;
								$response['iTotalDisplayRecords'] = sizeof($aaData0);
				    }
					}
				if ($range>=5 && $range<=8) {
					$aaData = $aaData2 = $aaData3 = $aaData4 = array();
					foreach ($response['aaData'] as $row) {
						
				      $fechaFin=$row[9];
				     
				      if (!empty($row[10])) {
				              $fechaFin=$row[10];
				      }
				      $timep=(int) $this->Common->timeToPercentage($row[8],$fechaFin,date("Y-m-d"));
						//debug($timep,false);
				   	if ($range==5) {

							if ($timep>=100-$long && $timep<100-$medium) {
							//		debug("perro",false);
				      $aaData[] = $row;
				    	}
				   }
				   	if ($range==6) {
				    	if ($timep>=100-$medium && $timep<100-$short) {
				    		//debug("gatos",false);
				      $aaData2[] = $row;
				    	}
				    }
				  	if ($range==7) {  
				    	if ($timep>=100-$short && $timep<=100) {
				    	//	debug(100-$short,false);
				     $aaData3[] = $row;
				    	}
				    }
				    if ($range==8) {  
				    	if ($timep>=100-$long && $timep<=100) {
				    	//	debug("rana",false);
				     	$aaData4[] = $row;
				    	}
				    }

				}		    
					
					  if ($range==5) {
						$response['aaData'] = $aaData;
						$response['iTotalDisplayRecords'] = sizeof($aaData);
				   }
				   	if ($range==6) {
				   $response['aaData'] = $aaData2;
				   $response['iTotalDisplayRecords'] = sizeof($aaData2);

				    }
				  	if ($range==7) {  
				    $response['aaData'] = $aaData3;
				    $response['iTotalDisplayRecords'] = sizeof($aaData3);
				    }
				    if ($range==8) {  
				   $response['aaData'] = $aaData4;
				   $response['iTotalDisplayRecords'] = sizeof($aaData4);
				    }
		    
				}
			

			$this->set('response', $response);
			$this->set('_serialize','response');
		} 

		$this->render('index');

		}


	private $default_fields = array(
		'Package.id', 
		'Package.number_package', 
		'Package.entry_date', 
		'Package.management_entry_date', 
		'Package.type', 
		'Package.analyst', 
		'Package.applicant', 
		'Package.components', 
		'Package.components_amount',
		//'Package.observations',
		'Package.current_stage',
		'Package.management_id',
		'Module.name', 
		'PackageStatus.name', 
		'Rfc.name', 
		'Management.name', 
		'Employee.name',
	);

/**
 * setManagement method
 *
 * @param int $id
 * @return void
 */
	public function setManagement($id) {
		if (!$this->Package->exists($id)) {
			//throw new NotFoundException(__('Invalid package'));
			$this->Session->setFlash(__('The package could not be found.'), 'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}

		$options = array(
			'fields' => array_merge($this->default_fields, array('Respondent.name')), 
			'contain' => array('Module', 'Employee', 'PackageStatus', 'Rfc', 'Respondent', 'Management'),
			'conditions' => array('Package.' . $this->Package->primaryKey => $id)
		);

		if ($this->request->is(array('post', 'put'))) {
			// Setting Management Date
			$this->request->data['Package']['management_entry_date'] = date('Y-m-d H:i:s');
			// Setting manager
			$this->request->data['Package']['manager_id'] = $this->Session->read('Auth.User.employeeId');
			$management_id = (isset($management_id)) ? $management_id : $this->Session->read('Auth.User.management');
			$title = 'ASIGNADO PAQUETE A LA GERENCIA #'. $management_id[0];
			$this->Common->writeObservation(
				1, // FIXME: Put this status in Options' table
				$this->request->data['Package']['number_package'], 
				$title, 
				$this->Session->read('Auth.User.username'), 
				'ASIGNADO A GERENCIA #' . $this->request->data['Package']['management_id']
			);


			if ($this->Package->save($this->request->data)) {
				$this->Session->setFlash(__('The package has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The package could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$package = $this->request->data = $this->Package->find('first', $options);
		}
		$managements = $this->Package->Management->getList();
		$this->set(compact('package', 'managements'));
	}

/**
 * setEspecialist method
 *
 * @param int $id
 * @return void
 */
	public function setEspecialist($id) {
		if (!$this->Package->exists($id)) {
			$this->Session->setFlash(__('The package could not be found.'), 'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}


		$options = array(
			'fields' => array_merge($this->default_fields,
				array(
					'Package.number_package', 
					'Package.type', 
					'Package.entry_date', 
					'Package.start_date', 
					'Package.end_date', 
					'Package.weighting', 
					'Package.employee_id', 
					'Package.rfc_id', 
					'Package.package_status_id',
					'Package.auto_assign' 
				)
			),
			'contain' => array('Module', 'Employee', 'PackageStatus', 'Rfc', 'Management'),
			'conditions' => array('Package.' . $this->Package->primaryKey => $id)
		);

		if ($this->request->is(array('post', 'put'))) {
			// Setting Assignment Date
			$this->request->data['Package']['assignment_date'] = $assignmentDate = date('Y-m-d');

			$startDate = $this->Common->deleteMinutes( $this->request->data('Package.start_date') );

			$entryDate = $this->Common->deleteMinutes( $this->request->data('Package.entry_date') );

			$holidays = $this->Common->getholidays();

			$this->request->data['Package']['trial_days'] = $this->Common->getWorkingDays($entryDate, $startDate, $holidays);
			
			$management_id = (isset($management_id)) ? $management_id : $this->Session->read('Auth.User.management');

			$title = 'ASIGNADO ESPECIALISTA ' . $this->request->data['Package']['employee_id'] . ' DE GERENCIA #'.$management_id[0]; // FIXME: Add name
			$this->Common->writeObservation(
				1, // FIXME: Put this status in Options' table
				$this->request->data['Package']['number_package'], 
				$title, 
				$this->Session->read('Auth.User.username'), 
				$this->request->data['Package']['observations']
			);

			$rfcId = $this->request->data['Package']['rfc_id'];


			if ($this->Package->save($this->request->data)) {
				// TODO: How this must behave in case of failure?
				$this->Common->add_mtproject($rfcId);
				//De-activate if it was assigned
				$this->loadModel('Assignment');
				$this->Assignment->recursive = -1;
				$pre = $this->Assignment->findByRfcId($rfcId,array('id','rfc_id'));
				if (!empty($pre)) {
					$pre['Assignment']['status'] = true;
					$this->Assignment->save($pre);
				}
	
				$this->Session->setFlash(__('The package has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'view',$id));
			} else {
				$package = $this->request->data = $this->Package->find('first', $options);
				$this->Session->setFlash(__('The package could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {		
			$package = $this->request->data = $this->Package->find('first', $options);
		}

						

		$uManag = $this->Session->read('Options.unassignedManagement');

		if ($package['Package']['management_id'] == $uManag) {
			$this->Session->setFlash(__('A Management must be setted first.'), 'flash', array ('class' => 'error'));

			return $this->redirect(array('action' => 'view',$id));
		}

		$managers = $this->Session->read('Options.managers');

		//$e_options['fields'] = array('id', 'fullname');
		$e_options['conditions'] = array(
			'management_id' => $package['Package']['management_id'],
			'NOT' => array('Employee.id' => $managers)
		);

		$employees = $this->Package->Employee->find('list', $e_options);
		//debug($employees);

		// Ignoring suspended or eliminated packages
		$suspendedStatus = $this->Session->read('Options.suspendedStatus');
		$eliminatedStatus = $this->Session->read('Options.eliminatedStatus');

		$psOptions['conditions'] = array('NOT' => array('id' => array($suspendedStatus, $eliminatedStatus)));
		$packageStatuses = $this->Package->PackageStatus->find('list', $psOptions);
		
		$rfcs = $this->Package->Rfc->find('list', 
			array('conditions' => array('OR' => array(
				array('Rfc.closed' => FALSE),
				array('Rfc.id' => $package['Package']['rfc_id'])
		)), 'order' => 'Rfc.created DESC'));

		$types =  array('Normal' => 'Normal', 'Emergencia' => 'Emergencia');
		$this->set(compact('package', 'employees', 'packageStatuses', 'rfcs', 'types'));
}

	/**
	 * replan method
	 *
	 * @param int $id
	 * @return void
	 */

	public function replan($id) {
		if (!$this->Package->exists($id)) {
			$this->Session->setFlash(__('The package could not be found.'), 'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}

		$options = array(
			'fields' => array_merge($this->default_fields,
				array(
					'Package.number_package', 
					'Package.type', 
					'Package.employee', // virtual field
					'Package.start_date', 
					'Package.end_date', 
					'Package.replanning_date', 
					'Package.weighting', 
					'Package.employee_id', 
					'Package.rfc_id', 
					'Package.package_status_id', 
				)
			),
			'contain' => array('Module', 'Employee', 'PackageStatus', 'Rfc', 'Respondent', 'Management'),
			'conditions' => array('Package.' . $this->Package->primaryKey => $id)
		);

		// Copying fullname field from Employee to Package
		$this->Package->virtualFields['employee'] = $this->Package->Employee->virtualFields['fullname'];

		if ($this->request->is(array('post', 'put'))) {

			// Setting replaning data
			
			$this->request->data['Package']['replanning'] = TRUE;

			$replanningDate = $endDate = $this->request->data['Package']['replanning_date'];
			$endDate = $this->request->data['Package']['end_date'];

			$holidays = $this->Common->getholidays();

			$this->request->data['Package']['replanning_days'] = 
				$this->Common->getWorkingDays($endDate, $replanningDate, $holidays) - 1;
				$management_id = (isset($management_id)) ? $management_id : $this->Session->read('Auth.User.management');
				$title = 'REPLANIFICADO PAQUETE DE GERENCIA #'.$management_id[0];
				$this->Common->writeObservation(
				$this->request->data['Package']['package_status_id'], 
				$this->request->data['Package']['number_package'], 
				$title, 
				$this->Session->read('Auth.User.username'), 
				$this->request->data['Package']['observations']
			);

			if ($this->Package->save($this->request->data)) {
				$this->Session->setFlash(__('The package has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The package could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$package = $this->request->data = $this->Package->find('first', $options);
			//debug($package);
		}

		$uEmpl = $this->Session->read('Options.unassignedEmployee');

		if ($package['Package']['employee_id'] == $uEmpl) {
			$this->Session->setFlash(__('A Employee must be assigned first.'), 'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'view',$id));
		}

		//$employee = $this->Package->Employee->find('list');
		$packageStatuses = $this->Package->PackageStatus->find('list');
		$rfcs = $this->Package->Rfc->find('list');
		$types =  array('Normal', 'Emergencia');
		$this->set(compact('package', /*'employee',*/ 'packageStatuses', 'rfcs','types'));

	}

/**
 * changeStatus method
 *
 * @param int $id
 * @return void
 */
	public function changeStatus($id) {

		if (!$this->Package->exists($id)) {
			$this->Session->setFlash(__('The package could not be found.'), 'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}

		$options = array(
			'fields' => array_merge($this->default_fields,
				array(
					'Package.number_package', 
					'Package.type', 
					'Package.start_date', 
					'Package.end_date', 
					'Package.replanning_date', 
					'Package.weighting', 
					'Package.employee_id', 
					'Package.rfc_id', 
					'Package.package_status_id', 
					)
				),
			'contain' => array('Module', 'Employee', 'PackageStatus', 'Rfc', 'Management'),
			'conditions' => array('Package.' . $this->Package->primaryKey => $id)
			);

		
		$managers = $this->Session->read('Options.managers');

		$certifiedStatus = $this->Session->read('Options.certifiedStatus');
		$suspendedStatus = $this->Session->read('Options.suspendedStatus');
		$eliminatedStatus = $this->Session->read('Options.eliminatedStatus');

		if ($this->request->is(array('post', 'put'))) {
			// If certified then set that date

			if ( $this->request->data['Package']['package_status_id'] == $eliminatedStatus || 
				$this->request->data['Package']['package_status_id'] == $suspendedStatus ) {

				if (in_array($this->Session->read('Auth.User.employeeId'), $managers) ) {

					if ($this->request->data['Package']['package_status_id'] == $eliminatedStatus ) {
						$this->_suspendOrEliminatedStatus($id,false);
						$this->Session->setFlash(__('The package has been eliminated.'), 'flash', array ('class' => 'block'));
						return $this->redirect(array('action' => 'index'));
					}

					if($this->request->data['Package']['package_status_id'] == $suspendedStatus) {
						$this->_suspendOrEliminatedStatus($id);
						$this->Session->setFlash(__('The package has been suspend.'), 'flash', array ('class' => 'block'));
						return $this->redirect(array('action' => 'index'));
					}
				} else {
					$this->Session->setFlash(__('You not have permissions for suspend or eliminate packages.'), 'flash', array ('class' => 'error'));
					return $this->redirect(array('action' => 'view',$id));
				}
			} else {
				$management_id = (isset($management_id)) ? $management_id : $this->Session->read('Auth.User.management');
				if ($this->request->data('Package.package_status_id') == $certifiedStatus){
					$status=$certifiedStatus;
					$title='CERTIFICADO PAQUETE DE GERENCIA #'.$management_id[0];
					$this->Common->writeObservation($status,$this->Package->field('number_package'),$title,$this->Session->read('Auth.User.username'),$this->request->data('Package.observations'));

					$this->request->data = $perro = $this->Common->certifyPackage($id);
					//$package['Package']['observations'] = $this->request->data['Package']['observations'];
				} else {
					$title = 'CAMBIO DE ESTADO PAQUETE DE GERENCIA #'.$management_id[0];
					$this->Common->writeObservation(
						$this->request->data['Package']['package_status_id'], 
						$this->request->data['Package']['number_package'], 
						$title, 
						$this->Session->read('Auth.User.username'), 
						$this->request->data['Package']['observations']
						);
				}
			}

			if ($this->Package->save($this->request->data)) {
				$this->Session->setFlash(__('The package has been saved.'), 'flash', array ('class' => 'success'));

				return $this->redirect(array('action' => 'view',$id));
			} else {
				$this->Session->setFlash(__('The package could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}

		} else {
			$package = $this->request->data = $this->Package->find('first', $options);
		}
		
		if (in_array($this->Session->read('Auth.User.employeeId'), $managers) ) {
			$psOptions = array(
				'conditions' => array(
					'NOT' => array( 'id' => $certifiedStatus )
				)
			);
			$packageStatuses = $this->Package->PackageStatus->find('list', $psOptions);
		} else {
			$psOptions = array(
				'conditions' => array(
					'NOT' => array( 'id' => array($certifiedStatus, $suspendedStatus, $eliminatedStatus) )
				)
			);
			$packageStatuses = $this->Package->PackageStatus->find('list', $psOptions);

			// Check wether or not the packege belongs to the current user
			if ( isset($package['Package']) && isset($package['Package']['employee_id']) ) {

				if ($this->Session->read('Auth.User.employeeId') != $package['Package']['employee_id']) {
					$this->Session->setFlash(__('You are not authorized to change this package.'), 'flash', array ('class' => 'block'));
					return $this->redirect(array('action' => 'index'));
				}
			}
		}

		$this->set(compact('package', 'employee', 'packageStatuses', 'rfcs', 'projectClasses', 'packageClasses', 'types'));
	}

	public function suspend($id = null) {

		if (!$this->Package->exists($id)) {
			$this->Session->setFlash(__('The package could not be found.'), 'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}

		$options = array(
			'fields' => array_merge($this->default_fields,
				array(
					'Package.number_package', 
					'Package.type', 
					'Package.start_date', 
					'Package.end_date', 
					'Package.replanning_date', 
					'Package.weighting', 
					'Package.employee_id', 
					'Package.rfc_id', 
					'Package.package_status_id', 
					)
				),
			'contain' => array('Module', 'Employee', 'PackageStatus', 'Rfc', 'Management'),
			'conditions' => array('Package.' . $this->Package->primaryKey => $id)
			);

		$certifiedStatus = $this->Session->read('Options.certifiedStatus');

		if ($this->request->is(array('post', 'put'))) {
		
			$managers = $this->Session->read('Options.managers');
			
			if (in_array($this->Session->read('Auth.User.employeeId'), $managers) ) {

				$this->_suspendOrEliminatedStatus($id);
				$this->Session->setFlash(__('The package has been suspend.'), 'flash', array ('class' => 'block'));
				$referer = $this->request->data('Package.referer');
				return $this->redirect($referer);

			} else {
				$this->Session->setFlash(__('You not have permissions for suspend or eliminate packages.'), 'flash', array ('class' => 'error'));
				//return $this->redirect(array('action' => 'view',$id));
				$referer = $this->request->data('Package.referer');
				return $this->redirect($referer);
			}

		} else {
			$package = $this->request->data = $this->Package->find('first', $options);
		}
		
		// For recording the refering page.
		$referer = $this->referer(array('action' => 'index'), true);
		$this->set(compact('package', 'employee', 'rfcs', 'projectClasses', 'packageClasses', 'types', 'referer'));
	}

	private function _suspendOrEliminatedStatus($id = null, $suspended = true) {
		
		$suspendedStatus = $this->Session->read('Options.suspendedStatus');
		$eliminatedStatus = $this->Session->read('Options.eliminatedStatus');
		$options = array('conditions' => array('Package.' . $this->Package->primaryKey => $id));
		$package = $this->Package->find('first', $options);
		if($this->Package->delete($id)){
			$management_id = (isset($management_id)) ? $management_id : $this->Session->read('Auth.User.management');
		
			
			if ($suspended) {
				$status = $suspendedStatus;
				$title='SUSPENDIDO PAQUETE DE GERENCIA #' . $management_id[0];
			} else {

				$status = $eliminatedStatus;
				$title = 'ELIMINADO PAQUETE DE GERENCIA #' . $management_id[0];
			}
		
			$this->Common->writeObservation(
				$status,
				$package['Package']['number_package'], 
				$title,
				$this->Session->read('Auth.User.username'), 
				$this->request->data('Package.observations')
			);
		}
	}
	
	public function setQualityValues($id = null) {
		if (!$this->Package->exists($id)) {
			$this->Session->setFlash(__('The package could not be found.'), 'flash', array ('class' => 'error'));
			return $this->redirect(array('action' => 'index'));
		}

		$options = array(
			'fields' => array_merge($this->default_fields,
				array(
					'Package.assignment_date',
					'Package.start_date', 
					'Package.end_date', 
					'Package.employee', // virtual field
					'Package.replanning_date', 
					'Package.certified_date',
					'Package.weighting', 
					'Package.final_weighting', 
					'Package.package_status_id',
					'Package.overfulfillment_quality',
					'Package.deviation_quality',
				)
			),
			'contain' => array('Module', 'Employee', 'PackageStatus', 'Rfc', 'Management', 'UnsatisfactoryStatus'),
			'conditions' => array('Package.' . $this->Package->primaryKey => $id)
		);
		// Copying fullname field from Employee to Package
		$this->Package->virtualFields['employee'] = $this->Package->Employee->virtualFields['fullname'];

		if ($this->request->is(array('post', 'put'))) {
			// Compute quality_assessment
			$p = $this->request->data;
			if ($p['Package']['final_weighting'] != 0.00 && $p['Package']['final_weighting'] != '0.00') {
				$this->request->data['Package']['quality_assessment'] =
					(100 - $p['Package']['deviation_quality'] + 
					$p['Package']['overfulfillment_quality']) * $p['Package']['final_weighting'];

				$manager_id=$this->Session->read('Options.managers');
				$this->request->data['Package']['qual_eval_date'] = date('Y-m-d H:i:s');
				$management_id = (isset($management_id)) ? $management_id : $this->Session->read('Auth.User.management');
				$title = 'CALCULO DE VALORES DE CALIDAD PAQUETE DE LA GERENCIA #'.$management_id[0] ;
				$this->Common->writeObservation(
						$p['Package']['package_status_id'], 
						$p['Package']['number_package'], 
						$title, 
						$this->Session->read('Auth.User.username'), 
						$this->request->data['Package']['observations']
						);
				//FIXME: Get this value from Option's table
				$this->request->data['Package']['evaluation_state_id'] = 2;
			}
			
			if ($this->Package->save(($this->request->data))) {
				$this->Session->setFlash(__('The package has been saved.'), 'flash', array ('class' => 'success'));
				return $this->redirect(array('action' => 'view',$id));
			} else {
				$package = $this->request->data = $this->Package->find('first', $options);
				$unsatisfactory_type = array('N' => __('Not Applicable'), 'P' => __('Production'), 'Q' => __('Quality'));
				$this->Session->setFlash(__('The package could not be saved. Please, try again.'), 'flash', array ('class' => 'error'));
			}
		} else {
			$package = $this->request->data = $this->Package->find('first', $options);
			$unsatisfactoryStatuses = $this->Package->UnsatisfactoryStatus->getOptList();
		}

		$this->set(compact('package', 'unsatisfactoryStatuses'));
	}

	public function charts($c = null) {
		
		//$this->sendMail();
		
		return $this->redirect(array('controller' => 'charts', 'action' => 'packages', $c));

	}

	public function getList() {
		$term = $this->request->data('term');
		//debug($term, false);

		$options = array(
			'fields' => array(
				'Package.id', 
				'Package.number_package', 
				'Rfc.name', 
				'Module.name'
			), 
			'contain' => array('Module', 'Rfc'),
			'conditions' => array(
				'OR' => array(
					'Package.id LIKE' => "%$term%", 
					'Package.number_package LIKE' => "%$term%", 
					//'Rfc.name LIKE' => "%$term%", 
					'Module.name LIKE' => "%$term%", 
				)
			)
		);

		$packages = $this->Package->find('all', $options);

		$result = array();
		foreach ($packages as $p) {
			$result[] = array(
				'label' => 
					/*$p['Package']['id'] . ' - ' .*/ 
					$p['Package']['number_package']  . ' - ' .  
					$p['Module']['name'] /*. ' - ' . $p['Rfc']['name']*/, 
				'value' => $p['Package']['id']
			);
			//$result[] = $p['Package']['number_package'];
		}

		$this->RequestHandler->setContent('json', 'application/json' );

		$this->set('response', $result);
		$this->set('_serialize','response');
	}

	private function sendMail() {
	
		$id = 347;

		$options = array(
			'fields' => array_merge($this->default_fields,
				array(
					'Package.number_package', 
					'Package.type', 
					'Package.employee', // virtual field
					'Package.start_date', 
					'Package.end_date', 
					'Package.replanning_date', 
					'Package.weighting', 
					'Package.employee_id', 
					'Package.rfc_id', 
					'Package.package_status_id', 
				)
			),
			'contain' => array('Module', 'Employee', 'PackageStatus', 'Rfc', 'Respondent', 'Management'),
			'conditions' => array('Package.' . $this->Package->primaryKey => $id)
		);

		// Copying fullname field from Employee to Package
		$this->Package->virtualFields['employee'] = $this->Package->Employee->virtualFields['fullname'];

		$package = $this->request->data = $this->Package->find('first', $options);

		App::uses('CakeEmail', 'Network/Email');
		
		$Email = new CakeEmail();
		$Email->config('default');
		$Email->viewVars(array('package' => $package));
		//$Email->helpers(array('Html', 'Custom', 'Text'));
		$Email->template('assignment', 'bancaribe');
		//$Email->from(array('calidadit@bancaribe.com.ve' => 'Bancaribe'));
		$Email->emailFormat('html');
		$Email->to('jcastillo@bancaribe.com.ve')
		->subject('About')
		->send('My message');
	}

}