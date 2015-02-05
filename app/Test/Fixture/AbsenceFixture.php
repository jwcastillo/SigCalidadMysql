<?php
/**
 * AbsenceFixture
 *
 */
class AbsenceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'employee_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index', 'comment' => 'ID del Colaborador'),
		'absence_type_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index', 'comment' => 'ID del Tipo de Ausencia'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Descripción', 'charset' => 'utf8'),
		'departure_date' => array('type' => 'date', 'null' => false, 'default' => null, 'comment' => 'Fecha de Salida'),
		'arrival_date' => array('type' => 'date', 'null' => false, 'default' => null, 'comment' => 'Fecha de Llegada'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Creación'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fceha de Modificación'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'absence_type_id' => array('column' => 'absence_type_id', 'unique' => 0),
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
			'id' => 1,
			'employee_id' => 1,
			'absence_type_id' => 1,
			'description' => 'Lorem ipsum dolor sit amet',
			'departure_date' => '2014-02-14',
			'arrival_date' => '2014-02-14',
			'created' => '2014-02-14 23:10:04',
			'modified' => '2014-02-14 23:10:04'
		),
	);

}
