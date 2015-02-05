<?php
App::uses('AppModel', 'Model');
/**
 * Management Model
 *
 * @property Area $Area
 * @property Employee $Employee
 * @property Package $Package
 * @property QualityManager $QualityManager
 */
class Management extends AppModel {

	public $actsAs = array('Linkable','Containable');

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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Area' => array(
			'className' => 'Area',
			'foreignKey' => 'management_id',
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
		'Employee' => array(
			'className' => 'Employee',
			'foreignKey' => 'management_id',
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
			'foreignKey' => 'management_id',
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
			'foreignKey' => 'management_id',
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


	public function getList($otherOptions = null) {
		$options['joins'] = array(
			array('table' => 'quality_managers',
				'alias' => 'QualityManager',
				'type' => 'INNER',
				'conditions' => array(
					'Management.id = QualityManager.management_id',
				)
			)
		);

		$options['order'] = array('Management.id');

		$options = (isset($otherOptions)) ? array_merge_recursive($options, $otherOptions) : $options;

		$this->recursive = -1;

		return $this->find('list', $options);
	}

}
