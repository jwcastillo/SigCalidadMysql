<?php
App::uses('AppModel', 'Model');
/**
 * Employee Model
 *
 * @property Position $Position
 * @property Management $Management
 * @property Absence $Absence
 * @property Evaluation $Evaluation
 * @property Package $Package
 * @property QualityManager $QualityManager
 * @property Task $Task
 * @property Vehicle $Vehicle
 */
class Employee extends AppModel {

	public $actsAs = array(
		'Upload.Upload' => array(
			'image' => array(
				'fields' => array(
					/*'dir' => 'image_dir',*/
					'type' => null
				),
				'mimetypes' => array('image/png', 'image/jpeg', 'image/gif'), 
				'extensions' => array('png', 'jpg', 'jpeg', 'gif'), 
				'maxSize' => 4096, 
				'deleteOnUpdate' => true, 
				'thumbnailSizes' => array('small' => '[120x120]', 'thumb' => '[50x50]'), 
				'thumbnailMethod' => 'php',
				'path' => '{ROOT}webroot{DS}files{DS}{model}{DS}',
				'pathMethod' => 'flat'
			)
		),
		'Containable'
	);

	public $virtualFields = array(
		'fullname' => 'CONCAT(SUBSTRING_INDEX(Employee.name, " ", 1), " ", 
			IF(LENGTH(SUBSTRING_INDEX(Employee.lastname, " ", 1)) <= 3, 
				Employee.lastname, 
				SUBSTRING_INDEX(Employee.lastname, " ", 1)))'
	);

	public $displayField = 'fullname';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'bc' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lastname' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ci' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'management_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'entry_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'birthdate' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'home_phone' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'work_phone' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cell_phone' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'address' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		/*'image' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Position' => array(
			'className' => 'Position',
			'foreignKey' => 'position_id',
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

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Absence' => array(
			'className' => 'Absence',
			'foreignKey' => 'employee_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Evaluation' => array(
			'className' => 'Evaluation',
			'foreignKey' => 'employee_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Package' => array(
			'className' => 'Package',
			'foreignKey' => 'employee_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'QualityManager' => array(
			'className' => 'QualityManager',
			'foreignKey' => 'employee_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Vehicle' => array(
			'className' => 'Vehicle',
			'foreignKey' => 'employee_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
			'Observation' => array(
        'className'    => 'Observation',
        'foreignKey' => false,
        'conditions' => '',
        'dependent'    => false,
        'finderQuery'   => 'select * from observations as `Observation`, employees as `Employee`  where 
                            `Employee`.`id` = {$__cakeID__$} and `Observation`.`bc` = `Employee`.`bc` COLLATE utf8_unicode_ci  '
    )

	);

	public function weighting($conditions = null) {
		/*
		SELECT `employees`.`id` , `rfcs`.`id` , `rfcs`.`weighting`
		FROM `rfcs` , `packages` , `employees`
		WHERE `packages`.`employee_id` = `employees`.`id`
		AND `rfcs`.`id` = `packages`.`rfc_id` # AND `employees`.`id` IN ( 4 )

		GROUP BY `rfcs`.`id`
		ORDER BY `employees`.`id`
		*/

		$options = array(
			'fields' => array(
				'Employee.id AS employee_id', 
				'Rfc.id AS rfc_id', 
				'Rfc.weighting AS weighting'
			), 
			'contain' => array('Rfc', 'Employee'),
			'conditions' => $conditions /*array('Package.rfc_id' => 'Rfc.id', 'Package.employee_id' => 'Employee.id', 'Employee.id' => '4')*/,
			'group' => array('Rfc.id', 'Employee.id', 'Rfc.weighting'), 
			'order' => 'Employee.id'
		);

		$result = $this->Package->find('all', $options);

		$final = array();

		foreach ($result as $key => $value) {
			if ( isset( $final[ $value['Employee']['employee_id'] ] ) )
				$final[ $value['Employee']['employee_id'] ] += $value['Rfc']['weighting'];
			else
				$final[ $value['Employee']['employee_id'] ] = $value['Rfc']['weighting'];
		}

		return $final;
	}


	public function packagesInProcess($conditions = null) {
	/*
		select id, number_package, rfc_id, management_id, employee_id, start_date, end_date, replanning_date from packages 
		where 
		package_status_id != 6 
		and management_id != 1 
		and employee_id != 1
		and rfc_id != 1
		and start_date is not null
		and end_date is not null
	*/

		App::uses('CakeSession', 'Model/Datasource');

		$certifiedStatus = CakeSession::read('Options.certifiedStatus');
		$unassignedManagement = CakeSession::read('Options.unassignedManagement');
		$unassignedEmployee = CakeSession::read('Options.unassignedEmployee');

		$this->Package->virtualFields['employee'] = $this->virtualFields['fullname'];

		$this->Package->Rfc->Behaviors->load('Containable');

		$options = array(
			'fields' => array(
				'Package.id', 
				'Package.number_package', 
				'rfc_id', 
				'Package.management_id', 
				'employee_id', 
				'employee', 
				'Rfc.name',
				'Rfc.weighting', 
				'Management.name', 
				'Module.name', 
				'start_date', 
				'end_date',
			),
			'conditions' => array(
				'NOT' => array(
					'package_status_id' =>  $certifiedStatus, 
					'Package.management_id' => $unassignedManagement, 
					'Package.employee_id' => $unassignedEmployee, 
					'start_date' => null, 
					'end_date' => null, 
				)
			), 
			'contain' => array('Employee', 'Module', 'Management', 'Rfc')
		);

		if ($conditions)
			$options['conditions'] = array_merge($conditions, $options['conditions']);

		$result =  $this->Package->find('all', $options);

		return $result;

	}

}
