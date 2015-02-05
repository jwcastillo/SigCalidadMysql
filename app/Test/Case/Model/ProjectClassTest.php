<?php
App::uses('ProjectClass', 'Model');

/**
 * ProjectClass Test Case
 *
 */
class ProjectClassTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.project_class',
		'app.rfc',
		'app.planning_manager',
		'app.project_manager',
		'app.development_manager',
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
		$this->ProjectClass = ClassRegistry::init('ProjectClass');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProjectClass);

		parent::tearDown();
	}

}
