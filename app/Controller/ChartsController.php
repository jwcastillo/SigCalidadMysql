<?php
App::uses('AppController', 'Controller');
/**
 * Charts Controller
 *
 * @property Chart $Chart
 * @property PaginatorComponent $Paginator
 */
class ChartsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Common', 'RequestHandler', 'DataTable', 'HighCharts.HighCharts');

	private $ColumnParams = array(
		'renderTo' => 'columnwrapper',  // div to display chart inside
		'legendEnabled' => TRUE,
		'tooltipEnabled' => FALSE,
		'chartTheme'	=>	'grid',
		'exportingEnabled' => TRUE,
		'creditsEnabled' => FALSE,
	);


	public function index() {
		$this->others();
	}

/**
 * Workload method
 *
 * @return void
 */
	public function workload($management_id = null) {

		if (extract($this->weighting(true, $management_id)) >= 2) {

			$total = array_sum($weightings);

			$this->set(compact('employees', 'weightings', 'total'));
		}

		$this->layout = ($this->request->is("ajax")) ? "ajax" : "charisma";
	}

	private function weighting($justPending = false, $management_id = null, $year = null, $withPackages = false) {

		$this->loadModel('Employee');

		$certifiedStatus = $this->Session->read('Options.certifiedStatus');

		$uManagement = $this->Session->read('Options.unassignedManagement');

		$managers = $this->Session->read('Options.managers');

		$management_id = (isset($management_id)) ? $management_id : $this->Session->read('Auth.User.management');

		// Searching for employees
		array_push($managers, $uManagement);

		$eConditions = array(
			//'management_id' => $management_id, 
			'active' => true, 
			'NOT' => array('Employee.id' => $managers)
		);

		if ($management_id)
			$eConditions['management_id'] = $management_id;
		
		$employees = $this->Employee->find('list', array('conditions' => $eConditions));

		$year = (isset($year)) ? $year : date('Y');

		// Searching for weightings
		$conditions = array('Employee.id' => array_keys($employees));

		if ($justPending) 
			$conditions['Package.package_status_id !='] = $certifiedStatus;
		else {
			$conditions['Package.package_status_id'] = $certifiedStatus;
			$conditions['YEAR(certified_date)'] = $year;
		}

		$weightings = $this->Employee->weighting($conditions);

		// Filling weightings of employees without packages
		$zeros = array_fill_keys(array_keys($employees), 0.0);

		$weightings = array_map('floatval', $weightings);

		$weightings = array_replace($zeros, $weightings);
		
		// Searching for packages
		if ($withPackages) {

			$pConditions = $conditions;

			unset($pConditions['Employee.id']);
			$pConditions['employee_id'] = array_keys($employees);

			$packages = $this->Employee->Package->packagesPerEmployee($pConditions, $eConditions);

			$packages = array_map('intval', $packages);
			// Getting just values
			$packages = array_values($packages);

		}

		// Getting just values
		$employees = array_values($employees);
		$weightings = array_values($weightings);

		return compact(array('employees', 'weightings', 'packages'));

	}

	private $monthlyColumnParams = array(
		'renderTo' => 'columnwrapper',  // div to display chart inside
		//'chartWidth' => 520,
		//'chartHeight' => 270,
		'legendEnabled' => TRUE,
		'tooltipEnabled' => FALSE,
		'xAxisCategories' => array(
			'Jan', 'Feb', 'Mar', 'Apr',
			'May', 'Jun', 'Jul', 'Aug',
			'Sep', 'Oct', 'Nov', 'Dec'
		),
		'enableAutoStep' 		 => FALSE,
		'chartTheme'	=>	'grid',
		'exportingEnabled' => TRUE,
		'creditsEnabled' => FALSE,
	);

	function beforeFilter() {
       parent::beforeFilter();
       $this->monthlyColumnParams['xAxisCategories'] = array_values($this->Common->monthNames(null, 3));
   }

	public function packages($c = null) {
		$this->loadModel('Package');
		// Set layout
		$this->layout = ($this->request->is("ajax")) ? "ajax" : "charisma";

		if (!isset($c)) {
			$charts[] = $this->certifiedAndNews();
			$charts[] = $this->certifiedPerMonth();
			$charts[] = $this->pendingPerMonth();
			$charts[] = $this->entriesPerMonth();
			//$charts[] = $this->certifiedPerEmployee();
			$charts[] = $this->weightingChart(true, null, true);
			//$charts[] = $this->trialDaysAvg();
		} else {

			switch ($c) {
				case 1:
					$charts[] = $this->certifiedAndNews();
					break;
				case 2:
					$charts[] = $this->certifiedPerMonth();
					break;
				case 3:
					$charts[] = $this->pendingPerMonth();
					break;
				case 4:
					$charts[] = $this->entriesPerMonth();
					break;
				case 5:
					$charts[] = $this->certifiedPerEmployee();
					break;
				case 6:
					$charts[] = $this->weightingChart(true, null, true);
					break;
				case 7:
					$charts[] = $this->trialDaysAvg();
					break;
				default:
					exit;
					break;
			}
		}

		$this->set('charts', $charts);
		$this->render('multiple');
	}

	public function certificationDays() {
		
		$charts[] = $this->ttcChart('ttcAvg1', 'lineWrapper1', null, null, false, false);

		$charts[] = $this->ttcChart('ttcAvg2', 'lineWrapper2', null, null, true, false);

		$charts[] = $this->ttcChart('ttcAvg3', 'lineWrapper3', null, null, false, true);

		$charts[] = $this->ttcChart('ttcAvg4', 'lineWrapper4', null, null, true, true);

		$this->set('charts', $charts);

		$this->render('multiple');
	}

	public function trialDays() {
		
		$charts[] = $this->trialDaysChart('trialAvg1', 'lineWrapper1', null, null, false, false);

		$charts[] = $this->trialDaysChart('trialAvg2', 'lineWrapper2', null, null, true, false);

		$charts[] = $this->trialDaysChart('trialAvg3', 'lineWrapper3', null, null, false, true);

		$charts[] = $this->trialDaysChart('trialAvg4', 'lineWrapper4', null, null, true, true);

		$this->set('charts', $charts);

		$this->render('multiple');
	}

	public function ttcVsTtp() {
		
		$charts[] = $this->ttcVsttpChart('ttcAvg1', 'lineWrapper1', null, null, false, false);

		$charts[] = $this->ttcVsttpChart('ttcAvg2', 'lineWrapper2', null, null, true, false);

		$charts[] = $this->ttcVsttpChart('ttcAvg3', 'lineWrapper3', null, null, false, true);

		$charts[] = $this->ttcVsttpChart('ttcAvg4', 'lineWrapper4', null, null, true, true);

		$this->set('charts', $charts);

		$this->render('multiple');
	}

	public function others() {
		
		$charts[] = $this->currentPackages();
		$charts[] = $this->certifiedPerEmployee();
		$charts[] = $this->weightingChart(false, null, true);

		$this->set('charts', $charts);

		$this->render('multiple');
	}

	public function certifiedAndNews($year = null) {

		$chartName = 'Column Chart 1';

		$wrapper = 'columnwrapper1';

		$title = __('News and Certified');

		$yAxisTitleText = __('Packages');

		$mychart = $this->HighCharts->create( $chartName, 'column' );

		$this->HighCharts->setChartParams(
			$chartName,
			array_merge($this->monthlyColumnParams, 
				array(
					'renderTo' => $wrapper, 
					'title' => $title,
					'yAxisTitleText' => $yAxisTitleText
				)
			)
		);

		$year = (isset($year)) ? $year : date('Y');
		$certifiedStatus = $this->Session->read('Options.certifiedStatus');
		$aCondition = array('package_status_id' => $certifiedStatus);

		$news = $this->Package->packagesPerMonth($year, 'entry_date'/*, array('NOT' => $aCondition)*/);
		$certified = $this->Package->packagesPerMonth($year, 'certified_date', $aCondition);

		$series1 = $this->HighCharts->addChartSeries();
		$series2 = $this->HighCharts->addChartSeries();

		$data1 = Hash::map($news, '{n}.{s}', 'intval');
		$data2 = Hash::map($certified, '{n}.{s}', 'intval');

		$series1->addName(__('New Pakages'))->addData($data1);
		$series2->addName(__('Certified Packages'))->addData($data2);

		$mychart->addSeries($series1);
		$mychart->addSeries($series2);

		// return parameters for later rendering
		return compact('title', 'wrapper', 'chartName');
	}

	private function certifiedPerMonth($year = null) {

		$certifiedStatus = $this->Session->read('Options.certifiedStatus');
		$conditions = array('package_status_id' => $certifiedStatus);

		return $this->monthlyManagementsChart('Column Chart 2', 'columnwrapper2', __('Certified'), 
			null, null, 'certified_date', $conditions, $year);
	}

	private function pendingPerMonth($year = null) {

		$certifiedStatus = $this->Session->read('Options.certifiedStatus');
		//$conditions = array('NOT' => array('package_status_id' => $certifiedStatus));
		$conditions = array();

		return $this->monthlyManagementsChart('Column Chart 3', 'columnwrapper3', __('Pending'), 
			null, 'line', 'entry_date', $conditions, $year, true);
	}

	private function entriesPerMonth($year = null) {
		
		return $this->monthlyManagementsChart('Column Chart 4', 'columnwrapper4', __('Entries'), 
			null, null, 'entry_date', array(), $year);
	}

	private function monthlyManagementsChart($chartName = 'Column Chart', $wrapper = 'columnwrapper', $title = null, 
		$yAxisTitleText = null, $type = null, $date = 'entry_date', $conditions = array(), $year = null, $pending = false) {

		$title = ($title) ? $title : __('Trial Days Average');

		$yAxisTitleText = ($yAxisTitleText) ? $yAxisTitleText : __('Packages');

		$type = $type ? $type : 'column';

		$mychart = $this->HighCharts->create( $chartName, $type );

		$this->HighCharts->setChartParams(
			$chartName,
			array_merge($this->monthlyColumnParams, 
				array(
					'renderTo' => $wrapper, 
					'title' => $title,
					'yAxisTitleText' => $yAxisTitleText
				)
			)
		);

		$managements = $this->Package->Management->getList(array('fields' => 'alias'));

		$year = (isset($year)) ? $year : date('Y');

		foreach ($managements as $key => $value) {
			$result = $this->Package->packagesPerMonth($year, $date, 
				array_merge($conditions, array('management_id' => $key)), 
				$pending
			);
			$data = Hash::map($result, '{n}.{s}', 'intval');

			$series = $this->HighCharts->addChartSeries();
			$series->addName($value)->addData($data);
			$mychart->addSeries($series);
		}

		// return parameters for later rendering
		return compact('title', 'wrapper', 'chartName');

	}

	private function certifiedPerEmployee($management_id = null, $month = null, $year = null) {

		$this->loadModel('Package');

		$chartName = 'Column Chart 5';

		$wrapper = 'columnwrapper5';

		$title = __('Certified Packages per Employee');

		$yAxisTitleText = __('Packages');

		$management_id = (isset($management_id)) ? $management_id : $this->Session->read('Auth.User.management');

		$managers = $this->Session->read('Options.managers');

		$eConditions = array(
			//'management_id' => $management_id, 
			'NOT' => array('Employee.id' => $managers)
		);

		if ($management_id)
			$eConditions['management_id'] = $management_id;

		$employees = $this->Package->Employee->find('list', array('conditions' => $eConditions));

		$mychart = $this->HighCharts->create( $chartName, 'column' );

		$this->HighCharts->setChartParams(
			$chartName,
			array_merge($this->monthlyColumnParams, 
				array(
					'renderTo' => $wrapper, 
					'title' => $title,
					'xAxisCategories' => array_values($employees),
					'plotOptionsSeriesStacking' => 'normal',
					'yAxisTitleText' => $yAxisTitleText, 
				)
			)
		);

		//$month = (isset($month)) ? $month : date('m');
		$year = (isset($year)) ? $year : date('Y');
		$certifiedStatus = $this->Session->read('Options.certifiedStatus');

		$conditions['package_status_id'] = $certifiedStatus;
		if (isset($month))
			$conditions['MONTH(certified_date)'] = $month;
		$conditions['YEAR(certified_date)'] = $year;

		$packages = $this->Package->packagesPerEmployee($conditions, $eConditions, true);

		foreach ($packages as $key => $value) {
			$value = Hash::map($value, '{n}.{n}', 'intval');
			$series = $this->HighCharts->addChartSeries();
			$series->addName($key)->addData($value);
			$mychart->addSeries($series);
		}
		// return parameters for later rendering
		return compact('title', 'wrapper', 'chartName');
	}


	private function weightingChart($justPending = false, $year = null, $withPackages = false) {

		$z = $this->weighting($justPending, null, $year, $withPackages);

		if (extract($z, EXTR_OVERWRITE) == 3) {

			$chartName = 'Column Chart 6' . rand();

			$wrapper = 'columnwrapper6' . rand();

			if ($justPending) 
				$title = __('Current Workload');
			else 
				$title = __('Completated Workload');

			$yAxisTitleText = __('Workload');

			$mychart = $this->HighCharts->create( $chartName, 'column' );

			$this->HighCharts->setChartParams(
				$chartName,
				array_merge($this->ColumnParams, 
				array(
					'title' => $title, 
					'renderTo' => $wrapper, 
					'xAxisCategories' => array_values($employees),
					'yAxisTitleText' => $yAxisTitleText, 
				))
			);

			$series = $this->HighCharts->addChartSeries();
			$series->addName(__('Weighting'))->addData(array_values($weightings));
			$mychart->addSeries($series);

			$series = $this->HighCharts->addChartSeries();
			$series->addName(__('Packages'))->addData(array_values($packages));
			$mychart->addSeries($series);

			// return parameters for later rendering
			return compact('title', 'wrapper', 'chartName');
		}
	}

	private function trialDaysChart($chartName = 'Column Chart', $wrapper = 'columnwrapper', $title = null, $yAxisTitleText = null, 
		$useAllPackageClasses = false, $useAllManagements = false, $year = null) {

		$this->loadModel('Package');

		$title = ($title) ? $title : __('Trial Days Average');

		$yAxisTitleText = ($yAxisTitleText) ? $yAxisTitleText : __('Days');

		$mychart = $this->HighCharts->create( $chartName, 'line' );

		$this->HighCharts->setChartParams(
			$chartName,
			array_merge($this->monthlyColumnParams, 
				array(
					'renderTo' => $wrapper, 
					'title' => $title,
					'yAxisTitleText' => $yAxisTitleText
				) 
			)
		);

		if (!$useAllPackageClasses) {
			
			$package_classes = $this->Package->Rfc->PackageClass->find('list', array(
				'fields' => array('type'),
				'conditions' => array('id !=' => 5) ));

			$package_classes = $this->groupKeyByValues($package_classes);

		} else {
				$package_classes = $this->Package->Rfc->PackageClass->find('list', 
					array('conditions' => array('id !=' => 5) ));
		}

		if (!$useAllManagements) {
			$managements = $this->Package->Management->getList(array('fields' => 'alias'));
			$managements = array('Calidad IT' =>  array_keys($managements));
		} else {
			$managements = $this->Package->Management->getList(array('fields' => 'alias'));
		}

		$year = (isset($year)) ? $year : date('Y');

		foreach ($managements as $key => $value) {

			$management_name = $useAllManagements ? $value: $key;
			$management_keys = $useAllManagements ? $key : $value;

			foreach ($package_classes as $pkey => $pvalue) {

			$package_class_name = $useAllPackageClasses ? $pvalue: $pkey;
			$package_class_keys = $useAllPackageClasses ? $pkey: $pvalue;

				$result = $this->Package->trialAvg($year, 
					array(
						'management_id' => $management_keys, 
						'package_class_id' => $package_class_keys //$pkey
					)
				);
				$data = array_values($result);

				$series = $this->HighCharts->addChartSeries();
				$series->addName("$management_name - $package_class_name")->addData($data);
				$mychart->addSeries($series);
			}

		}

		// return parameters for later rendering
		return compact('title', 'wrapper', 'chartName');
	}

	private function groupKeyByValues($target) {
		$result = array();
		foreach ($target as $key => $value) {
			$result[$value][] = $key;
		}
		return $result;
	}

	private function ttcChart($chartName = 'Column Chart', $wrapper = 'columnwrapper', $title = null, $yAxisTitleText = null, 
		$useAllPackageClasses = false, $useAllManagements = false, $year = null) {
		
		$this->loadModel('Package');
		
		$title = ($title) ? $title : __('Certification Days Average');

		$yAxisTitleText = ($yAxisTitleText) ? $yAxisTitleText : __('Days');

		$mychart = $this->HighCharts->create( $chartName, 'line' );

		$this->HighCharts->setChartParams(
			$chartName,
			array_merge($this->monthlyColumnParams, 
				array(
					'renderTo' => $wrapper, 
					'title' => $title,
					'yAxisTitleText' => $yAxisTitleText
				)
			)
		);

		if (!$useAllPackageClasses) {
			
			$package_classes = $this->Package->Rfc->PackageClass->find('list', array(
				'fields' => array('type'),
				'conditions' => array('id !=' => 5) ));

			$package_classes = $this->groupKeyByValues($package_classes);

		} else {
				$package_classes = $this->Package->Rfc->PackageClass->find('list', 
					array('conditions' => array('id !=' => 5) ));
		}

		if (!$useAllManagements) {
			$managements = $this->Package->Management->getList(array('fields' => 'alias'));
			$managements = array('Calidad IT' =>  array_keys($managements));
		} else {
			$managements = $this->Package->Management->getList(array('fields' => 'alias'));
		}

		$year = (isset($year)) ? $year : date('Y');

		foreach ($managements as $key => $value) {

			$management_name = $useAllManagements ? $value: $key;
			$management_keys = $useAllManagements ? $key : $value;

			foreach ($package_classes as $pkey => $pvalue) {

			$package_class_name = $useAllPackageClasses ? $pvalue: $pkey;
			$package_class_keys = $useAllPackageClasses ? $pkey: $pvalue;

				$result = $this->Package->certificationDaysAvg($year, 
					array(
						'management_id' => $management_keys, 
						'package_class_id' => $package_class_keys //$pkey
					)
				);
				$data = array_values($result);

				$series = $this->HighCharts->addChartSeries();
				$series->addName("$management_name - $package_class_name")->addData($data);
				$mychart->addSeries($series);
			}

		}
		// return parameters for later rendering
		return compact('title', 'wrapper', 'chartName');
	}

	private function ttcVsttpChart($chartName = 'Column Chart', $wrapper = 'columnwrapper', $title = null, $yAxisTitleText = null, 
		$useAllPackageClasses = false, $useAllManagements = false, $year = null) {
		
		$this->loadModel('Package');
		
		$title = ($title) ? $title : __('TTC vs TTP');

		$yAxisTitleText = ($yAxisTitleText) ? $yAxisTitleText : __('Days');

		$mychart = $this->HighCharts->create( $chartName, 'line' );

		$this->HighCharts->setChartParams(
			$chartName,
			array_merge($this->monthlyColumnParams, 
				array(
					'renderTo' => $wrapper, 
					'title' => $title,
					'yAxisTitleText' => $yAxisTitleText
				)
			)
		);

		if (!$useAllPackageClasses) {
			
			$package_classes = $this->Package->Rfc->PackageClass->find('list', array(
				'fields' => array('type'),
				'conditions' => array('id !=' => 5) ));

			$package_classes = $this->groupKeyByValues($package_classes);

		} else {
				$package_classes = $this->Package->Rfc->PackageClass->find('list', 
					array('conditions' => array('id !=' => 5) ));
		}

		if (!$useAllManagements) {
			$managements = $this->Package->Management->getList(array('fields' => 'alias'));
			$managements = array('Calidad IT' =>  array_keys($managements));
		} else {
			$managements = $this->Package->Management->getList(array('fields' => 'alias'));
		}

		$year = (isset($year)) ? $year : date('Y');

		foreach ($managements as $key => $value) {

			$management_name = $useAllManagements ? $value: $key;
			$management_keys = $useAllManagements ? $key : $value;

			foreach ($package_classes as $pkey => $pvalue) {

			$package_class_name = $useAllPackageClasses ? $pvalue: $pkey;
			$package_class_keys = $useAllPackageClasses ? $pkey: $pvalue;

				$result = $this->Package->ttcAvg($year, 
					array(
						'management_id' => $management_keys, 
						'package_class_id' => $package_class_keys //$pkey
					)
				);
				
				$data = array_values($result);

				$series = $this->HighCharts->addChartSeries();
				$series->addName("$management_name - $package_class_name - TTC")->addData($data);

				$mychart->addSeries($series);

				$result = $this->Package->ttcAvg($year, 
					array(
						'management_id' => $management_keys, 
						'package_class_id' => $package_class_keys //$pkey
					)
				);
				
				$data = array_values($result);

				$series = $this->HighCharts->addChartSeries();
				$series->addName("$management_name - $package_class_name - TTP")->addData($data);

				$mychart->addSeries($series);
			}

		}
		// return parameters for later rendering
		return compact('title', 'wrapper', 'chartName');
	}

/**
 * Current Packages for all managements
 *
 * @return void
 */
	private function currentPackages() {

		//FIXME: This functions is cumbersome, It could be shorter and easier

		$this->loadModel('Management');

		$this->Management->Behaviors->load('Containable');

		$certifiedStatus = $this->Session->read('Options.certifiedStatus');
		$user_management = $this->Session->read('Auth.User.management');
		$unassignedManagement = $this->Session->read('Options.unassignedManagement');

		$managements = $this->Management->getList();
		$managements = array_keys($managements);
		$managements[] = $unassignedManagement;

		$options = array(
			'fields' => array(
				'Management.id', 
				'Management.name',
				'Management.alias'
			),
			'contain' => array(
				'Package' => array('fields' => array('id', 'number_package')), 
			), 
			'conditions' => array('Management.id' => $managements)
		);

		if (isset($certifiedStatus))
			$options = Hash::insert($options, 'contain.Package.conditions', 
				array('Package.package_status_id !=' => $certifiedStatus));

		// Pie chart

		$result = $this->Management->find('all', $options);

		$total = Hash::apply($result, '{n}.Package.{n}', 'sizeof');

		$result = Hash::extract($result, '{n}.{s}');

		$data = array();
		$last_key = null;
		foreach ($result as $key => $value) {
			if (($key % 2) == 0) {
				$name = (isset($value['alias'])) ? $value['alias'] : $value['name'];
				$management = $value['id'];
				$last_key = $key;
			} else {
				$percent = /*($total!=0) ?*/ sizeof($value) /** 100 / $total : 0*/;
				if ($management == $user_management || (is_array($user_management) && in_array($management, $user_management)))
					$data[] = array ('name' => $name, 'y' => $percent, 'sliced' => true, 'selected' => true);
				else
					$data[] = array($name, $percent);
			}
		}

		$chartData = $data;

		$chartName = 'Pie Chart';

		$wrapper = 'piewrapper';

		$title = __('Pending Packages per Management');

		$pieChart = $this->HighCharts->create( $chartName, 'pie' );

		$this->HighCharts->setChartParams(
			$chartName,
			array(
				'renderTo' => $wrapper,  // div to display chart inside
				/*'chartWidth' => 500,
				'chartHeight' => 700,*/
				'chartTheme' => 'grid',
				'title' => $title,
				'tooltipEnabled' => TRUE,
				'plotOptionsPieDataLabelsEnabled' => FALSE,
				'plotOptionsPieShowInLegend' => TRUE,
				'exportingEnabled' => TRUE,
				'creditsEnabled' => FALSE,
			)
		);

		$series = $this->HighCharts->addChartSeries();

		$series->addName(__('Packages'))->addData($chartData);

		$pieChart->addSeries($series);

		// return parameters for later rendering
		return compact('title', 'wrapper', 'chartName');
	}

	private function fixTrialDays() {

		// Fix trial days

		$this->loadModel('Package');

		$options = array(
			'fields' => array('Package.id', 'Package.trial_days', 'Package.entry_date', 'Package.start_date'),
			'conditions' => array(
				'NOT' => array(
					'trial_days' => null,
					'Package.entry_date' => '0000-00-00 00:00:00',
					'start_date' => null
				)
			),
			'recursive' => -1
		);

		$packages = $this->Package->find('all', $options);

		$result = array();

		$holidays = $this->Common->getholidays();

		foreach ($packages as $p) {
			
			$startDate = $this->Common->deleteMinutes( $p['Package']['start_date'] );
			$entryDate = $this->Common->deleteMinutes( $p['Package']['entry_date'] );

			$current_trial_days = $p['Package']['trial_days'];

			$trial_date = $this->Common->getWorkingDays($entryDate, $startDate, $holidays);

			if ($current_trial_days != $trial_date) {
					/*$result[] = array(
						'id' => $p['Package']['id'], 
						'number_package' => $p['Package']['number_package'], 
						'current' => $p['Package']['trial_days'], 
						'new' => $trial_date
					);*/

					$p['Package']['trial_days'] = intval($trial_date);
					
					$result[] =  $p;
				}
		}

		debug(count($result));

		debug($this->Package->saveAll($result));

		$this->render('single_chart');
	}

	public function fixCertificationDays() {
		
		// Fix trial days

		$this->loadModel('Package');

		$options = array(
			'fields' => array(
				'Package.id', 
				'number_package', 
				'Package.entry_date', 
				'Package.assignment_date', 
				'Package.start_date', 
				'certified_date', 
				'assignment_date', 
				'certification_days'
			),
			'conditions' => array(
				'package_status_id' => 6, 
				'YEAR(entry_date)' => 2014, 
				'NOT' => array(
					'trial_days' => null,
					'Package.entry_date' => '0000-00-00 00:00:00',
					'start_date' => null, 
					'final_weighting' => 0
				)
			),
			'recursive' => -1
		);

		$packages = $this->Package->find('all', $options);

		$result = array();

		$holidays = $this->Common->getholidays();

		debug($holidays);

		foreach ($packages as $p) {
			
			$certifiedDate = $this->Common->deleteMinutes($p['Package']['certified_date']);

			$entryDate =  $this->Common->deleteMinutes($p['Package']['entry_date']);

			$old_certification_days = $p['Package']['certification_days'];

			$new_certification_days = $this->Common->getWorkingDays($entryDate, $certifiedDate, $holidays);

			if ($old_certification_days != $new_certification_days) {
				/*$result[] = array(
					'id' => $p['Package']['id'], 
					'number_package' => $p['Package']['number_package'], 
					'entry_date' => $p['Package']['entry_date'], 
					'certified_date' => $p['Package']['certified_date'], 
					'old' => $old_certification_days, 
					'new' => $new_certification_days
				);*/

				$p['Package']['certification_days'] = intval($new_certification_days);
					
				$result[] =  $p;
			}
		}

		debug(count($result));
		//debug($result);

		debug($this->Package->saveAll($result));

		$this->render('single_chart');
	}


		public function checkDates() {
		
		// Fix trial days

		$this->loadModel('Package');

		$options = array(
			'fields' => array(
				'Package.id', 
				'number_package', 
				'Package.entry_date', 
				'Package.assignment_date', 
				'Package.start_date', 
				'certified_date', 
				'assignment_date', 
				'certification_days'
			),
			'conditions' => array(
				'package_status_id' => 6, 
				'YEAR(entry_date)' => 2014, 
				'NOT' => array(
					'trial_days' => null,
					'Package.entry_date' => '0000-00-00 00:00:00',
					'start_date' => null, 
					'final_weighting' => 0
				)
			),
			'recursive' => -1
		);

		$packages = $this->Package->find('all', $options);

		$result = array();

		$holidays = $this->Common->getholidays();

		//debug($holidays);

		foreach ($packages as $p) {
			
			$certifiedDate = $this->Common->deleteMinutes($p['Package']['certified_date']);

			$entryDate =  $this->Common->deleteMinutes($p['Package']['entry_date']);

			$assignmentDate = $this->Common->deleteMinutes($p['Package']['assignment_date']);

			$startDate = $this->Common->deleteMinutes($p['Package']['start_date']);

			if ( $this->Common->greaterEqual($assignmentDate, $certifiedDate ) ) {
				$result[] = array(
					'id' => $p['Package']['id'], 
					'number_package' => $p['Package']['number_package'], 
					'entry_date' => $entryDate, 
					'assignment_date' => $assignmentDate,
					'certified_date' => $certifiedDate,  
				);

				//$p['Package']['certification_days'] = intval($new_certification_days);
					
				//$result[] =  $p;
			}
		}

		debug(count($result));
		debug($result);

		//debug($this->Package->saveAll($result));

		$this->render('single_chart');
	}

}
