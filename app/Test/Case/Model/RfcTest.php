<?php
App::uses('Rfc', 'Model');

/**
 * Rfc Test Case
 *
 */
class RfcTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.rfc',
		'app.planning_manager',
		'app.project_manager',
		'app.development_manager',
		'app.project_class',
		'app.package_class',
		'app.complexity',
		'app.mtp',
		'app.assignment',
		'app.employee',
		'app.position',
		'app.management',
		'app.area',
		'app.module',
		'app.package',
		'app.package_status',
		'app.respondent',
		'app.evaluation_state',
		'app.final_status',
		'app.observation',
		'app.history',
		'app.unsatisfactory_status',
		'app.packages_unsatisfactory_status',
		'app.quality_manager',
		'app.absence',
		'app.absence_type',
		'app.evaluation',
		'app.vehicle'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Rfc = ClassRegistry::init('Rfc');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Rfc);

		parent::tearDown();
	}

}
