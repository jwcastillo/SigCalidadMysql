<?php
App::uses('AppModel', 'Model');
/**
 * UnsatisfactoryStatus Model
 *
 * @property Package $Package
 */
class UnsatisfactoryStatus extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'type' => array(
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Package' => array(
			'className' => 'Package',
			'joinTable' => 'packages_unsatisfactory_statuses',
			'foreignKey' => 'unsatisfactory_status_id',
			'associationForeignKey' => 'package_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);



	public function getOptList() {

		/*$counties = array(
			'Country Name 1' => array(
				'county_1_id' => 'County 1 Name',
				'county_2_id' => 'County 2 Name',
				'county_3_id' => 'County 3 Name',
			),
			'Country Name 2' => array(
				'county_4_id' => 'County 4 Name',
				'county_5_id' => 'County 5 Name',
				'county_6_id' => 'County 6 Name',
			),
		);*/
		
		$partial = $this->find('all', array(
			'fields' => array('UnsatisfactoryStatus.type', 'UnsatisfactoryStatus.name'),
			)
		);

		$result = array();

		foreach ($partial as $key => $value) {
			$result[$value['UnsatisfactoryStatus']['type']][$key+1] = $value['UnsatisfactoryStatus']['name'];
		}

		return $result;
	}

}
