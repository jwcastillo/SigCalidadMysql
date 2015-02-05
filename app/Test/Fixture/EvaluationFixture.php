<?php
/**
 * EvaluationFixture
 *
 */
class EvaluationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'Id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'effectiveness_evaluation' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'comment' => 'Evaluación de Efectividad', 'charset' => 'utf8'),
		'quality_assessment' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'comment' => 'Evaluación de Calidad', 'charset' => 'utf8'),
		'month' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 2, 'collate' => 'utf8_general_ci', 'comment' => 'Mes de Evaluación', 'charset' => 'utf8'),
		'year' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 4, 'collate' => 'utf8_general_ci', 'comment' => 'Año de Evaluación', 'charset' => 'utf8'),
		'employee_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index', 'comment' => 'ID del Especialista o Analista Evaluado'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Creación'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Modificación'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1),
			'worker_id' => array('column' => 'employee_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'Id' => 1,
			'effectiveness_evaluation' => 'Lorem ip',
			'quality_assessment' => 'Lorem ip',
			'month' => '',
			'year' => 'Lo',
			'employee_id' => 1,
			'created' => '2014-02-14 23:10:18',
			'modified' => '2014-02-14 23:10:18'
		),
	);

}
