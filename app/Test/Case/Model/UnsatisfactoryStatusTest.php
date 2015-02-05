<?php
App::uses('UnsatisfactoryStatus', 'Model');

/**
 * UnsatisfactoryStatus Test Case
 *
 */
class UnsatisfactoryStatusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.unsatisfactory_status',
		'app.package',
		'app.module',
		'app.area',
		'app.management',
		'app.employee',
		'app.position',
		'app.absence',
		'app.absence_type',
		'app.evaluation',
		'app.quality_manager',
		'app.task',
		'app.vehicle',
		'app.history',
		'app.package_status',
		'app.rfc',
		'app.planning_manager',
		'app.project_manager',
		'app.development_manager',
		'app.project_class',
		'app.package_class',
		'app.complexity',
		'app.respondent',
		'app.evaluation_state',
		'app.final_status',
		'app.packages_unsatisfactory_status'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UnsatisfactoryStatus = ClassRegistry::init('UnsatisfactoryStatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UnsatisfactoryStatus);

		parent::tearDown();
	}

}
