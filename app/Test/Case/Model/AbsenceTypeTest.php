<?php
App::uses('AbsenceType', 'Model');

/**
 * AbsenceType Test Case
 *
 */
class AbsenceTypeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.absence_type',
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
		'app.vehicle'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AbsenceType = ClassRegistry::init('AbsenceType');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AbsenceType);

		parent::tearDown();
	}

}
