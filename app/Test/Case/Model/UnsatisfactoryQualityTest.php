<?php
App::uses('UnsatisfactoryQuality', 'Model');

/**
 * UnsatisfactoryQuality Test Case
 *
 */
class UnsatisfactoryQualityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.unsatisfactory_quality',
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
		'app.unsatisfactory_production',
		'app.respondent',
		'app.evaluation_state',
		'app.final_status',
		'app.packages_unsatisfactory_quality'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UnsatisfactoryQuality = ClassRegistry::init('UnsatisfactoryQuality');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UnsatisfactoryQuality);

		parent::tearDown();
	}

}
