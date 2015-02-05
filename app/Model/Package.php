<?php
App::uses('AppModel', 'Model');
/**
 * Package Model
 *
 * @property Module $Module
 * @property Employee $Employee
 * @property PackageStatus $PackageStatus
 * @property Rfc $Rfc
 * @property UnsatisfactoryProduction $UnsatisfactoryProduction
 * @property Respondent $Respondent
 * @property EvaluationState $EvaluationState
 * @property FinalStatus $FinalStatus
 * @property Management $Management
 * @property UnsatisfactoryQuality $UnsatisfactoryQuality
 */
class Package extends AppModel {

	public $displayField = 'number_package';

	public $actsAs = array('Linkable','Containable');

	public $order = "Package.id DESC";

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'respondent_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'evaluation_state_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'final_status_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Module' => array(
			'className' => 'Module',
			'foreignKey' => 'module_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Employee' => array(
			'className' => 'Employee',
			'foreignKey' => 'employee_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Manager' => array(
			'className' => 'Employee',
			'foreignKey' => 'manager_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PackageStatus' => array(
			'className' => 'PackageStatus',
			'foreignKey' => 'package_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Rfc' => array(
			'className' => 'Rfc',
			'foreignKey' => 'rfc_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Respondent' => array(
			'className' => 'Respondent',
			'foreignKey' => 'respondent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'EvaluationState' => array(
			'className' => 'EvaluationState',
			'foreignKey' => 'evaluation_state_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FinalStatus' => array(
			'className' => 'FinalStatus',
			'foreignKey' => 'final_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Management' => array(
			'className' => 'Management',
			'foreignKey' => 'management_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);



	public $hasMany = array(
		'Observation' => array(
        'className'    => 'Observation',
        'foreignKey' => false,
        'conditions' => '',
        'dependent'    => false,
        'finderQuery'   => 'select * from observations as `Observation`, packages as `Package`  where 
                            `Package`.`id` = {$__cakeID__$} and `Observation`.`package` = `Package`.`number_package` '
    ),
     'History' => array(
        'className'    => 'History',
        'foreignKey' => false,
        'conditions' => ' ',
        'dependent'    => false,
        'finderQuery'   => 'select * from histories as `History`, packages as `Package` where
                            `Package`.`id` = {$__cakeID__$} and `History`.`number_package` = `Package`.`number_package` order by History.change_date '
    )
	);


	/**
	 * hasAndBelongsToMany associations
	 *
	 * @var array
	 */
		public $hasAndBelongsToMany = array(
			'UnsatisfactoryStatus' => array(
				'className' => 'UnsatisfactoryStatus',
				'joinTable' => 'packages_unsatisfactory_statuses',
				'foreignKey' => 'package_id',
				'associationForeignKey' => 'unsatisfactory_status_id',
				'unique' => 'keepExisting',
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'finderQuery' => '',
			)
		);



	public function packagesPerMonth($year = NULL, $date = 'entry_date', $conditions = array(), $pending = false) {

		/* 
		SELECT YEAR(entry_date) AS Year, 
			COUNT(CASE WHEN MONTH(entry_date)=1 THEN ID END) AS Jan, 
			COUNT(CASE WHEN MONTH(entry_date)=2 THEN ID END) AS Feb, 
			COUNT(CASE WHEN MONTH(entry_date)=3 THEN ID END) AS Mar, 
			COUNT(CASE WHEN MONTH(entry_date)=4 THEN ID END) AS Apr, 
			COUNT(CASE WHEN MONTH(entry_date)=5 THEN ID END) AS May, 
			COUNT(CASE WHEN MONTH(entry_date)=6 THEN ID END) AS Jun, 
			COUNT(CASE WHEN MONTH(entry_date)=7 THEN ID END) AS Jul, 
			COUNT(CASE WHEN MONTH(entry_date)=8 THEN ID END) AS Aug, 
			COUNT(CASE WHEN MONTH(entry_date)=9 THEN ID END) AS Sep, 
			COUNT(CASE WHEN MONTH(entry_date)=10 THEN ID END) AS Oct, 
			COUNT(CASE WHEN MONTH(entry_date)=11 THEN ID END) AS Nov, 
			COUNT(CASE WHEN MONTH(entry_date)=12 THEN ID END) AS `Dec` 
			FROM `db_sigcalidad`.`packages` AS `Package` 
		WHERE 1 = 1 
		GROUP BY YEAR(entry_date) 
		ORDER BY `Package`.`id` DESC 
		*/

		/*

		SELECT YEAR(entry_date) AS Year, MONTH(entry_date) AS Month, Count(*) 
		FROM `db_sigcalidad`.`packages` AS `Package` 
		WHERE 1 = 1 
		GROUP BY MONTH(entry_date), YEAR(entry_date) 

		*/

		/*$fields = array(
			"YEAR($date)",
			"COUNT(CASE WHEN MONTH($date)=1 THEN ID END) AS JAN",
			"COUNT(CASE WHEN MONTH($date)=2 THEN ID END) AS FEB",
			"COUNT(CASE WHEN MONTH($date)=3 THEN ID END) AS MAR",
		);*/

		//$date = 'entry_date';

		$this->recursive = -1;

		$mons = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 
			7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');

		$currentMonth = date('m');

		$fields = array();
		$fields[] = "YEAR($date) AS Year";
		foreach ($mons as $key => $value) {
			if ($pending)
				$fields[] = "COUNT(CASE WHEN (MONTH($date)<=$key AND (MONTH( certified_date ) > $key OR MONTH( certified_date )=0) AND $currentMonth >= $key ) THEN ID END) AS `$value`";
				//$fields[] = "COUNT(CASE WHEN (MONTH($date)<=$key AND MONTH(certified_date)>$key) THEN ID END) AS `$value`";
			else
				$fields[] = "COUNT(CASE WHEN MONTH($date)=$key THEN ID END) AS `$value`";
		}

		if (isset($year))
			$conditions = array_merge($conditions, array("YEAR($date)" => $year));
		else
			// TODO: Check whether this conditions is mandatory or not
			$conditions = array_merge($conditions, array('NOT' => array("YEAR($date)" => 0)));

		$group = "YEAR($date)";

		$options = array('fields' => $fields, 'group' => $group, 'conditions' => $conditions);

		$result = $this->find('all', $options);

		$result = Hash::combine($result, '{n}.{n}.Year', '{n}.{n}');
		$result = Hash::remove($result, '{n}.Year');

		return $result;
	}

	public function trialAvg($year = NULL, $conditions = array()) {

		/*
			SELECT 
			AVG( trial_days ) AS trial_days_avg, 
			MONTH( start_date ) AS `month` 
			FROM packages 
			WHERE start_date IS NOT NULL 
			GROUP BY MONTH( start_date )
			ORDER BY MONTH( start_date )
		*/

		if (isset($year))
			$conditions['YEAR( start_date )'] = $year;

		// FIXME: This is a hack for incoherent date
		$conditions['MONTH( start_date ) <='] = date('m') + 1;

		$conditions['NOT'] = array(
			'start_date' => NULL, 
			'trial_days' => NULL, 
			'Package.entry_date' => '0000-00-00 00:00:00', 
			//'start_date' => NULL
		);

		$options = array(
			'fields' => array(
				'AVG( trial_days ) AS trial_days_avg', 
				'MONTH( start_date ) AS month', 
			),
			'conditions' => $conditions, 
			'group' => 'MONTH( start_date )', 
			'order' => 'MONTH( start_date )',
			'contain' => ('Rfc')
		);

		return $this->averageQuery($options, 'trial_days_avg');
	}

	public function ttcAvg($year = NULL, $conditions = array()) {

		/*
			select avg(ttc), month(certified_date) 
			from packages, rfcs 
			where packages.rfc_id = rfcs.id 
			and rfcs.package_class_id = 1
			and year(certified_date) = 2014
			and ttc is not null
			and package_status_id = 6
			and final_weighting != 0
			group by month(certified_date)
			order by month(certified_date)
		*/

		App::uses('CakeSession', 'Model/Datasource');
		$certifiedStatus = CakeSession::read('Options.certifiedStatus');

		if (isset($year))
			$conditions['YEAR( certified_date )'] = $year;

		// FIXME: This is a hack for incoherent date
		$conditions['MONTH( certified_date ) <='] = date('m') + 1;

		$conditions['package_status_id'] = $certifiedStatus;

		// FIXME: This has to be dynamic
		//$conditions['Rfc.package_class_id'] = 1;

		$conditions['NOT'] = array(
			'ttc' => NULL, 
			'final_weighting' => 0, 
		);

		$options = array(
			'fields' => array(
				'AVG(ttc) AS ttc', 
				'MONTH( certified_date ) AS month', 
			),
			'conditions' => $conditions, 
			'group' => 'MONTH( certified_date )', 
			'order' => 'MONTH( certified_date )', 
			'contain' => ('Rfc')
		);

		return $this->averageQuery($options, 'ttc');
	}

	public function certificationDaysAvg($year = NULL, $conditions = array()) {

		/*
			select avg(certification_days), month(certified_date) 
			from packages, rfcs 
			where packages.rfc_id = rfcs.id 
			and rfcs.package_class_id = 1
			and year(certified_date) = 2014
			and certification_days is not null
			and package_status_id = 6
			and final_weighting != 0
			group by month(certified_date)
			order by month(certified_date)
		*/

		App::uses('CakeSession', 'Model/Datasource');
		$certifiedStatus = CakeSession::read('Options.certifiedStatus');

		if (isset($year))
			$conditions['YEAR( certified_date )'] = $year;

		// FIXME: This is a hack for incoherent date
		$conditions['MONTH( certified_date ) <='] = date('m') + 1;

		$conditions['package_status_id'] = $certifiedStatus;

		// FIXME: This has to be dynamic
		//$conditions['Rfc.package_class_id'] = 1;

		$conditions['NOT'] = array(
			'certification_days' => NULL, 
			'final_weighting' => 0, 
		);

		$options = array(
			'fields' => array(
				'AVG(certification_days) AS certification_days', 
				'MONTH( certified_date ) AS month', 
			),
			'conditions' => $conditions, 
			'group' => 'MONTH( certified_date )', 
			'order' => 'MONTH( certified_date )', 
			'contain' => ('Rfc')
		);

		return $this->averageQuery($options, 'certification_days');
	}

	public function ttpAvg($year = NULL, $conditions = array()) {

		/*
			select avg(ttp), month(certified_date) 
			from packages, rfcs 
			where packages.rfc_id = rfcs.id 
			and rfcs.package_class_id = 1
			and year(certified_date) = 2014
			and ttp is not null
			and package_status_id = 6
			and final_weighting != 0
			group by month(certified_date)
			order by month(certified_date)
		*/

		App::uses('CakeSession', 'Model/Datasource');
		$certifiedStatus = CakeSession::read('Options.certifiedStatus');

		if (isset($year))
			$conditions['YEAR( certified_date )'] = $year;

		// FIXME: This is a hack for incoherent date
		$conditions['MONTH( certified_date ) <='] = date('m') + 1;

		$conditions['package_status_id'] = $certifiedStatus;

		// FIXME: This has to be dynamic
		//$conditions['Rfc.package_class_id'] = 1;

		$conditions['NOT'] = array(
			'ttp' => NULL, 
			'final_weighting' => 0, 
		);

		$options = array(
			'fields' => array(
				'AVG(ttp) AS ttp', 
				'MONTH( certified_date ) AS month', 
			),
			'conditions' => $conditions, 
			'group' => 'MONTH( certified_date )', 
			'order' => 'MONTH( certified_date )', 
			'contain' => ('Rfc')
		);

		return $this->averageQuery($options, 'ttp');
	}

	private function averageQuery($options = null, $field = null) {
		if (isset($options) && isset($field)) {
			$this->recursive = -1;

			$result = $this->find('all', $options);

			$result = Hash::combine($result, '{n}.{n}.month', "{n}.{n}.$field");

			// Filling months without packages
			$zeros = array_fill_keys(range(1,12), 0.0);

			$result = array_map('floatval', $result);

			$result = array_replace($zeros, $result);

			return $result;
		}
	}

	public function packagesPerEmployee($conditions = array(), $eConditions = array(), $grouping = false) {

		/*
			SELECT employee_id, 
			COUNT(CASE WHEN type='Normal' THEN ID END) AS Normal,
			COUNT(CASE WHEN type='Emergencia' THEN ID END) AS Emergencia
			FROM `packages`
			GROUP BY employee_id");
		*/

		/*
			SELECT type, 
			COUNT(CASE WHEN employee_id=1 THEN ID END) AS `1`,
			COUNT(CASE WHEN employee_id=2 THEN ID END) AS `2`,
			COUNT(CASE WHEN employee_id=3 THEN ID END) AS `3`,
			COUNT(CASE WHEN employee_id=4 THEN ID END) AS `4`
			FROM `packages`
			GROUP BY type
		*/

		$this->recursive = -1;

		$employees = $this->Employee->find('list', array('conditions' => $eConditions));

		$fields = array();
		foreach ($employees as $key => $value) {
			$fields[] = "COUNT(CASE WHEN employee_id=$key THEN ID END) AS `$key`";
		}
		
		$group = null;

		if ($grouping) {
			$fields[] = "type";
			$group = 'type';
			$conditions = array_merge(array('type' => array('Normal', 'Emergencia')), $conditions);
		}

		$options = array('fields' => $fields, 'group' => $group, 'conditions' => $conditions);

		$result = $this->find('all', $options);

		if ($grouping) 
			$result = Hash::combine($result, '{n}.{s}.{s}', '{n}.{n}');
		else
			$result = $result[0][0];

		return $result;
	}

	public function history($id = null) {

		$this->id = $id;
		$package = $this->read();

		$history = ClassRegistry::init('History');

		$options['conditions'] = array('number_package' => 
			$package['Package']['number_package'] ? $package['Package']['number_package'] : null);

		return $history->find('all', $options);
	}

	public function observations($id = null) {
		$this->id = $id;
		$package = $this->read();

		$observations = ClassRegistry::init('Observations');

		$options['conditions'] = array('package' => 
			$package['Package']['number_package'] ? $package['Package']['number_package'] : null);

		return $observations->find('all', $options);
	}

	public function suspended($package_number = null) {

		$observations = ClassRegistry::init('Observations');

		App::uses('CakeSession', 'Model/Datasource');
		$suspendedStatus = CakeSession::read('Options.suspendedStatus');

		$options['conditions'] = array(
			'package' => $package_number, 
			'package_status_id' => $suspendedStatus
		);

		$result = $observations->find('first', $options);

		return !is_null($result) && !empty($result);

	}

//FIXME
public function listObservations($suspended=FALSE, $management_id=NULL, $employee_bc=NULL, $package=NULL ) {
	$observations = ClassRegistry::init('Observations');

	$conditions[]=array();

	if ($suspended) {
		$conditions['Observations.title LIKE']='%SUSPENDIDO%';
		$conditions['Observations.disable']=0;

	}

	if ($management_id){

		$query_parts = array();
		
		foreach ($management_id as $key => $value) {
				$query_parts[]="Observations.title LIKE '%#".$value."%'";
		}
			
		$string = ' ('. implode(' OR ', $query_parts). ')' ;
		$conditions[]=$string;
	}

	if ($employee_bc){
		$conditions['Observations.bc LIKE']= "%$employee_bc%";
	}

	if ($package){
			$conditions['Observations.package LIKE']="%$package%";
	}
	$options = array('conditions' => $conditions);

	return $observations->find('all', $options);
	}

public function countSuspended($management_id=NULL, $employee_id=NULL) {
		App::uses('CakeSession', 'Model/Datasource');

	$managers = CakeSession::read('Options.managers');

		if ($management_id==NULL || $management_id==0){

				$management_id = (isset($management_id)) ? $management_id : CakeSession::read('Auth.User.management');
		}
		
		$employee_bc=NULL;
		if ($employee_id!=NULL){
			
			$employee_bc=CakeSession::read('Auth.User.username');
		}

	if (in_array(CakeSession::read('Auth.User.employeeId'), $managers) ) {
			
			return count($this->listObservations(TRUE,$management_id));
	}
	else {
				return count($this->listObservations(TRUE,NULL,$employee_bc));
	}

	}	

	public function allSuspended() {

		$observations = ClassRegistry::init('Observations');

		App::uses('CakeSession', 'Model/Datasource');
		$suspendedStatus = CakeSession::read('Options.suspendedStatus');

		$options['conditions'] = array(
			'package_status_id' => $suspendedStatus,
			'disable' => 0
		);

		$obSuspended = $observations->find('all', $options);

		return $packagesIds = Hash::extract($obSuspended, '{n}.{s}.id');

		//debug($packagesIds);

		/*return $this->find('all', array(
			'conditions' => array('number_package' => $packagesIds
			)
		));*/
	}
}
