<?php
App::uses('Vehicle', 'Model');

/**
 * Vehicle Test Case
 *
 */
class VehicleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.vehicle',
		'app.employee',
		'app.position',
		'app.management',
		'app.area',
		'app.module',
		'app.package',
		'app.package_status',
		'app.rfc',
		'app.planning_manager',
		'app.project_manager',
		'app.development_manager',
		'app.project_class',
		'app.package_class',
		'app.complexity',
		'app.unsatisfactory_quality',
		'app.unsatisfactory_production',
		'app.respondent',
		'app.evaluation_state',
		'app.final_status',
		'app.quality_manager',
		'app.task',
		'app.absence',
		'app.absence_type',
		'app.evaluation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Vehicle = ClassRegistry::init('Vehicle');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Vehicle);

		parent::tearDown();
	}

}
