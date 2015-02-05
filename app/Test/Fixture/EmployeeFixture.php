<?php
/**
 * EmployeeFixture
 *
 */
class EmployeeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'bc' => array('type' => 'string', 'null' => false, 'length' => 8, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => 'Número de Colaborador', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => 'Nombre del Colaborador', 'charset' => 'utf8'),
		'lastname' => array('type' => 'string', 'null' => false, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => 'Apellido del Colaborador', 'charset' => 'utf8'),
		'position_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index', 'comment' => 'ID del Cargo que Desempeña'),
		'ci' => array('type' => 'string', 'null' => false, 'length' => 10, 'collate' => 'utf8_general_ci', 'comment' => 'Cédula de Identidad', 'charset' => 'utf8'),
		'management_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'entry_date' => array('type' => 'date', 'null' => false, 'default' => '0000-00-00', 'comment' => 'Fecha de Ingreso al Banco'),
		'birthdate' => array('type' => 'string', 'null' => false, 'length' => 6, 'collate' => 'utf8_general_ci', 'comment' => 'Fecha de Cumpleaños', 'charset' => 'utf8'),
		'home_phone' => array('type' => 'string', 'null' => false, 'length' => 11, 'collate' => 'utf8_general_ci', 'comment' => 'Número de Teléfono', 'charset' => 'utf8'),
		'work_phone' => array('type' => 'string', 'null' => false, 'length' => 11, 'collate' => 'utf8_general_ci', 'comment' => 'Número de Teléfono del Trabajo', 'charset' => 'utf8'),
		'cell_phone' => array('type' => 'string', 'null' => false, 'length' => 11, 'collate' => 'utf8_general_ci', 'comment' => 'Número de Celular', 'charset' => 'utf8'),
		'address' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'comment' => 'Dirección de Residencia', 'charset' => 'utf8'),
		'type' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => 'Tipo de Empleado', 'charset' => 'utf8'),
		'active' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 2, 'collate' => 'utf8_general_ci', 'comment' => 'Activo', 'charset' => 'utf8'),
		'company' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'utf8_general_ci', 'comment' => 'Compañia a la que pertenece', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => 'Emails', 'charset' => 'utf8'),
		'image' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Creación'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Modificación'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'bc' => array('column' => 'bc', 'unique' => 1),
			'mail' => array('column' => 'email', 'unique' => 1),
			'bc_2' => array('column' => array('bc', 'ci', 'email'), 'unique' => 1),
			'position_id' => array('column' => 'position_id', 'unique' => 0),
			'management_id' => array('column' => 'management_id', 'unique' => 0)
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
			'bc' => 'Lorem ',
			'name' => 'Lorem ipsum dolor sit amet',
			'lastname' => 'Lorem ipsum dolor sit amet',
			'position_id' => 1,
			'ci' => 'Lorem ip',
			'management_id' => 1,
			'entry_date' => '2014-02-14',
			'birthdate' => 'Lore',
			'home_phone' => 'Lorem ips',
			'work_phone' => 'Lorem ips',
			'cell_phone' => 'Lorem ips',
			'address' => 'Lorem ipsum dolor sit amet',
			'type' => 'Lorem ipsum dolor sit amet',
			'active' => '',
			'company' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'image' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-02-14 23:10:51',
			'modified' => '2014-02-14 23:10:51'
		),
	);

}
