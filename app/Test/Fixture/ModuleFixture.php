<?php
/**
 * ModuleFixture
 *
 */
class ModuleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'key' => 'unique', 'collate' => 'utf8_general_ci', 'comment' => 'Nombre del Módulo de Harvest', 'charset' => 'utf8'),
		'area_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'comment' => 'Id del Área de Negocio'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Creación'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Modificación'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'name' => array('column' => 'name', 'unique' => 1),
			'name_2' => array('column' => 'name', 'unique' => 1)
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
			'name' => 'Lorem ipsum dolor sit amet',
			'area_id' => 1,
			'created' => '2014-05-21 15:40:58',
			'modified' => '2014-05-21 15:40:58'
		),
	);

}
