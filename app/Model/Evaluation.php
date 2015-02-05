<?php
App::uses('AppModel', 'Model');
/**
 * Evaluation Model
 *
 * @property Employee $Employee
 */
class Evaluation extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'effectiveness_evaluation' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'quality_assessment' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'month' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'year' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
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
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
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


	function monthlyEvaluation($month, $year, $management_id) {

		$count = $this->find('count', array('conditions' => array(
				'month' => $month, 
				'year' => $year, 
				'management_id' => $management_id
			),
			'recursive' => -1
		));

		if ($count > 0) return false;

		$select = <<< EOT
			SELECT 

			employee_id, 
			SUM(effectiveness_evaluation) AS `effectiveness_evaluation`, 
			SUM(quality_assessment) AS `quality_assessment`, 
			`month`, `year`, management_id

			FROM

			(
				SELECT 
				employee_id, 
				( AVG(`effectiveness_evaluation`) / AVG(`final_weighting`) ) AS `effectiveness_evaluation`,
				0 AS `quality_assessment`,
				MONTH(certified_date) AS `month`,
				YEAR(certified_date) AS `year`,
				management_id
				FROM packages
				WHERE 
				package_status_id = 6
				AND effectiveness_evaluation IS NOT NULL
				AND certified_date IS NOT NULL
				AND final_weighting IS NOT NULL
				AND final_weighting != 0
				AND effec_eval_date IS NOT NULL
				AND MONTH(certified_date) = $month AND YEAR(certified_date) = $year
				AND management_id = $management_id
				GROUP BY employee_id

				UNION

				SELECT 
				employee_id, 
				0 AS `effectiveness_evaluation`,
				( AVG(`quality_assessment`) / AVG(`final_weighting`) ) AS `quality_assessment`,
				MONTH(qual_eval_date) AS `month`,
				YEAR(qual_eval_date) AS `year`,
				management_id
				FROM packages
				WHERE 
				package_status_id = 6
				AND qual_eval_date IS NOT NULL
				AND final_weighting IS NOT NULL
				AND final_weighting != 0
				AND MONTH(qual_eval_date) = $month AND YEAR(qual_eval_date) = $year
				AND management_id = $management_id
				GROUP BY employee_id

			) AS temp
			GROUP BY employee_id, month, year

EOT;
		

		$result = $this->query($select);




		$result = array_map(
			//Inline anonymous function to nest flat result
			function($elem) { 
			

			

				return array('Evaluation' => Hash::merge($elem['temp'], $elem[0])); 
			},
			$result
		);
		

		
		return $result;
	}

}