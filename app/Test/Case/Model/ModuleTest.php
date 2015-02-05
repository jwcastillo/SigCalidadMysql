<?php
App::uses('Module', 'Model');

/**
 * Module Test Case
 *
 */
class ModuleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.module',
		'app.area',
		'app.management',
		'app.employee',
		'app.position',
		'app.absence',
		'app.absence_type',
		'app.evaluation',
		'app.package',
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
		'app.observation',
		'app.history',
		'app.unsatisfactory_status',
		'app.packages_unsatisfactory_status',
		'app.quality_manager',
		'app.vehicle'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Module = ClassRegistry::init('Module');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Module);

		parent::tearDown();
	}

}
