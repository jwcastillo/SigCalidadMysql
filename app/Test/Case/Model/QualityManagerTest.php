<?php
App::uses('QualityManager', 'Model');

/**
 * QualityManager Test Case
 *
 */
class QualityManagerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.quality_manager',
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
		'app.unsatisfactory_production',
		'app.respondent',
		'app.evaluation_state',
		'app.final_status',
		'app.unsatisfactory_quality',
		'app.packages_unsatisfactory_quality',
		'app.absence',
		'app.absence_type',
		'app.evaluation',
		'app.task',
		'app.vehicle'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QualityManager = ClassRegistry::init('QualityManager');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QualityManager);

		parent::tearDown();
	}

}
