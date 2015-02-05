<?php
App::uses('DevelopmentManager', 'Model');

/**
 * DevelopmentManager Test Case
 *
 */
class DevelopmentManagerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.development_manager',
		'app.rfc',
		'app.planning_manager',
		'app.project_manager',
		'app.project_class',
		'app.package_class',
		'app.complexity',
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
		'app.package_status',
		'app.unsatisfactory_quality',
		'app.unsatisfactory_production',
		'app.respondent',
		'app.evaluation_state',
		'app.final_status'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DevelopmentManager = ClassRegistry::init('DevelopmentManager');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DevelopmentManager);

		parent::tearDown();
	}

}
