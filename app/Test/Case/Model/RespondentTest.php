<?php
App::uses('Respondent', 'Model');

/**
 * Respondent Test Case
 *
 */
class RespondentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.respondent',
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
		$this->Respondent = ClassRegistry::init('Respondent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Respondent);

		parent::tearDown();
	}

}
