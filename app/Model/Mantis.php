<?php
App::uses('AppModel', 'Model');
/**
 * Matis Model
 *
 */
class Mantis extends AppModel {

/**
 * The name of the DataSource connection that this Model uses
 *
 * The value must be an attribute name that you defined in `app/Config/database.php`
 * or created using `ConnectionManager::create()`.
 *
 * @var string
 * @link http://book.cakephp.org/2.0/en/models/model-attributes.html#usedbconfig
 */
	public $useDbConfig = 'soap';

/**
 * Custom database table name, or null/false if no table association is desired.
 *
 * @var string
 * @link http://book.cakephp.org/2.0/en/models/model-attributes.html#usetable
 */
	public $useTable = false;

}