<?php
/**
 * AssignmentFixture
 *
 */
class AssignmentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'rfc_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'employee_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'management_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 1, 'unsigned' => false),
		'date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'rfc_id' => 1,
			'employee_id' => 1,
			'management_id' => 1,
			'status' => 1,
			'date' => '2014-09-01 16:11:30',
			'created' => '2014-09-01 16:11:30',
			'modified' => '2014-09-01 16:11:30'
		),
	);

}
