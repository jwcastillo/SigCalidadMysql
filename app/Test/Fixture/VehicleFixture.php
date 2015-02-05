<?php
/**
 * VehicleFixture
 *
 */
class VehicleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'model' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => 'Modelo del Vehiculo', 'charset' => 'utf8'),
		'color' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => 'Color del Vehículo', 'charset' => 'utf8'),
		'plate' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => 'Placa del vehiculo', 'charset' => 'utf8'),
		'employee_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index', 'comment' => 'ID del Dueño del Vehículo'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Creación'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Modificación'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'plate' => array('column' => 'plate', 'unique' => 1),
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
			'model' => 'Lorem ipsum dolor sit amet',
			'color' => 'Lorem ipsum dolor sit amet',
			'plate' => 'Lorem ipsum dolor sit amet',
			'employee_id' => 1,
			'created' => '2014-02-14 23:10:09',
			'modified' => '2014-02-14 23:10:09'
		),
	);

}
