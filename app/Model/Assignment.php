<?php
App::uses('AppModel', 'Model');
/**
 * Assignment Model
 *
 * @property Rfc $Rfc
 * @property Employee $Employee
 * @property Management $Management
 */
class Assignment extends AppModel {
	public $actsAs = array('Linkable','Containable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'rfc_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'employee_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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

	
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Rfc' => array(
			'className' => 'Rfc',
			'foreignKey' => 'rfc_id',
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
		'Management' => array(
			'className' => 'Management',
			'foreignKey' => 'management_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
