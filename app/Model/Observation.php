<?php
App::uses('AppModel', 'Model');
/**
 * Observation Model
 *
 * @property PackageStatus $PackageStatus
 */
class Observation extends AppModel {

public $actsAs = array('Linkable','Containable');
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'packages' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			
			//'notEmpty' => array(
				//'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			//),
		),
		'bc' => array(
		//	'notEmpty' => array(
				//'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
		//	),
		),
		'observation' => array(
			//'notEmpty' => array(
				//'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
		//	),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'PackageStatus' => array(
			'className' => 'PackageStatus',
			'foreignKey' => 'package_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),

	/*	'Package' => array(
        'className'    => 'Package',
        'foreignKey' => false,
        //'conditions' => 'DISTINCT(id)',
        'dependent'    => false,
        'fields' => 'id, DISTINCT(number_package)',
        'recursive' => 0,
         'limit' => 1, //int
    //'page' => n, //int
    //'offset' => n, //int
    //'callbacks' => true //other possible values are false, 'before', 'after'
        'finderQuery'   => 'select id, number_package from  packages as `Package`, observations as `Observation`  where 
                               `Observation`.`id` = {$__cakeID__$} and `Observation`.`package` = `Package`.`number_package` '   */
    //),
/*    'Employee' => array(
        'className'    => 'Employee',
        'foreignKey' => false,
        'conditions' => '',
        'dependent'    => false
      //  'finderQuery'   => 'select * from  employees as `Employee`, observations as `Observation`  where 
        //                    `Observation`.`id` = {$__cakeID__$} and `Observation`.`bc` = `Employee`.`bc` '
    )*/
	);

	public function getPackageId($id = null) {
		$this->id = $id;
		$observation = $this->read();
		$packages = ClassRegistry::init('Packages');

		App::uses('CakeSession', 'Model/Datasource');
		
		$fields = array();
		$fields[] = "id";
		$conditions = array('Packages.number_package' => $observation['Observation']['package']);

		$options = array('fields' => $fields, 'conditions' => $conditions);

		$result = $packages->find('first', $options);


		return $result;
		
		
	}
	public function getEmployeeId($id = null) {
		$this->id = $id;
		$observation = $this->read();
		$employee = ClassRegistry::init('Employees');

		App::uses('CakeSession', 'Model/Datasource');
		
		$fields = array();
		$fields[] = "id";
		$conditions = array('Employees.bc' => $observation['Observation']['bc']);

		$options = array('fields' => $fields, 'conditions' => $conditions);

		$result = $employee->find('first', $options);
	
		return $result;
		
		
	}
}
