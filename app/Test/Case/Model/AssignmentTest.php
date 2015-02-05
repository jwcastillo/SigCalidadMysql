<?php
App::uses('Assignment', 'Model');

/**
 * Assignment Test Case
 *
 */
class AssignmentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.assignment',
		'app.rfc',
		'app.planning_manager',
		'app.project_manager',
		'app.development_manager',
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
		'app.vehicle',
		'app.observation',
		'app.package_status',
		'app.respondent',
		'app.evaluation_state',
		'app.final_status',
		'app.history',
		'app.unsatisfactory_status',
		'app.packages_unsatisfactory_status'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Assignment = ClassRegistry::init('Assignment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Assignment);

		parent::tearDown();
	}

}
