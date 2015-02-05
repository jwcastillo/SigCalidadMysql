<?php
App::uses('FinalStatus', 'Model');

/**
 * FinalStatus Test Case
 *
 */
class FinalStatusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.final_status',
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
		'app.evaluation_state'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FinalStatus = ClassRegistry::init('FinalStatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FinalStatus);

		parent::tearDown();
	}

}
