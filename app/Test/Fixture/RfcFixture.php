<?php
/**
 * RfcFixture
 *
 */
class RfcFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Nombre del Proyecto o Requerimiento', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Descripción del Proyecto o Requerimiento', 'charset' => 'utf8'),
		'planning_manager_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index', 'comment' => 'ID del Gerente de Proyecto'),
		'project_manager_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index', 'comment' => 'ID del Gerente de Desarrollo'),
		'development_manager_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index', 'comment' => 'ID del Jefe del Gerente de Desarrollo'),
		'project_class_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index', 'comment' => 'ID Clase de Proyecto'),
		'package_class_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true, 'key' => 'index', 'comment' => 'ID Clase de Paquete'),
		'complexity_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index', 'comment' => 'ID Complejidad del RFC'),
		'weighting' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false, 'comment' => 'Ponderación del RFC'),
		'remaining' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '10,2', 'unsigned' => false),
		'mtp_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'high_impact' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'closed' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'Estatus'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Creación'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Modificación'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'planning_manager_id' => array('column' => 'planning_manager_id', 'unique' => 0),
			'project_manager_id' => array('column' => 'project_manager_id', 'unique' => 0),
			'development_manager_id' => array('column' => 'development_manager_id', 'unique' => 0),
			'project_class_id' => array('column' => 'project_class_id', 'unique' => 0),
			'packages_class_id' => array('column' => 'package_class_id', 'unique' => 0),
			'complexity_id' => array('column' => 'complexity_id', 'unique' => 0)
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
			'description' => 'Lorem ipsum dolor sit amet',
			'planning_manager_id' => 1,
			'project_manager_id' => 1,
			'development_manager_id' => 1,
			'project_class_id' => 1,
			'package_class_id' => 1,
			'complexity_id' => 1,
			'weighting' => '',
			'remaining' => '',
			'mtp_id' => 1,
			'high_impact' => 1,
			'closed' => 1,
			'created' => '2014-09-05 09:42:06',
			'modified' => '2014-09-05 09:42:06'
		),
	);

}
