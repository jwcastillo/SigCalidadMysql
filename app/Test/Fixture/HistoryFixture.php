<?php
/**
 * HistoryFixture
 *
 */
class HistoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'Id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'number_package' => array('type' => 'integer', 'null' => true, 'default' => null),
		'stage_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'change_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'bc' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'action' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 128, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'Id', 'unique' => 1)
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
			'number_package' => 1,
			'stage_name' => 'Lorem ipsum dolor sit amet',
			'change_date' => '2014-02-14 23:10:22',
			'bc' => 'Lorem ipsum dolor sit amet',
			'action' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-02-14 23:10:22',
			'modified' => '2014-02-14 23:10:22'
		),
	);

}
