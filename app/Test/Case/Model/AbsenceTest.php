<?php
App::uses('Absence', 'Model');

/**
 * Absence Test Case
 *
 */
class AbsenceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.absence',
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
		'app.evaluation',
		'app.vehicle',
		'app.absence_type'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Absence = ClassRegistry::init('Absence');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Absence);

		parent::tearDown();
	}

}
