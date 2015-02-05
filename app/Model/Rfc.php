<?php
App::uses('AppModel', 'Model');
/**
 * Rfc Model
 *
 * @property PlanningManager $PlanningManager
 * @property ProjectManager $ProjectManager
 * @property DevelopmentManager $DevelopmentManager
 * @property ProjectClass $ProjectClass
 * @property PackageClass $PackageClass
 * @property Complexity $Complexity
 * @property Mtp $Mtp
 * @property Assignment $Assignment
 * @property Package $Package
 */
class Rfc extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'project_class_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'package_class_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'complexity_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'high_impact' => array(
			'boolean' => array(
				'rule' => array('boolean'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'closed' => array(
			'boolean' => array(
				'rule' => array('boolean'),
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
		'PlanningManager' => array(
			'className' => 'PlanningManager',
			'foreignKey' => 'planning_manager_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProjectManager' => array(
			'className' => 'ProjectManager',
			'foreignKey' => 'project_manager_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'DevelopmentManager' => array(
			'className' => 'DevelopmentManager',
			'foreignKey' => 'development_manager_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProjectClass' => array(
			'className' => 'ProjectClass',
			'foreignKey' => 'project_class_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PackageClass' => array(
			'className' => 'PackageClass',
			'foreignKey' => 'package_class_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Complexity' => array(
			'className' => 'Complexity',
			'foreignKey' => 'complexity_id',
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
		'Assignment' => array(
			'className' => 'Assignment',
			'foreignKey' => 'rfc_id',
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
			'foreignKey' => 'rfc_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
