<?php

App::uses('HttpSocket', 'Network/Http');
App::uses('Xml', 'Utility');
App::uses('CakeLog', 'Log');

class CommonComponent extends Component{

  private $model;
  private $controller;
  public $components = array('Session');
  
  public function initialize(Controller $controller){
    $this->controller = $controller;
    $modelName = $this->controller->modelClass;
    $this->model = $this->controller->{$modelName};

    CakeLog::config('rest', array(
    	'engine' => 'File'
    ));
  }
    
	public function writeObservation($status,$number_package,$title=null,$bc,$observations=null) {
		//$this->loadModel('Observation');
		$model = ClassRegistry::init('Observation');
		$model->create();
		$observation = array(
				'Observation' => array(
					'package_status_id' => $status, 
					'package' => $number_package, 
					'title' => $title,
					'bc' => $bc, 
					'observation' =>$observations
				)
		);
		return $model->save($observation);
	}


public function certifyPackage($id=null) {
		$model = ClassRegistry::init('Package');

		$certifiedStatus = $this->Session->read('Options.certifiedStatus');
		$avgDevLowComplex = $this->Session->read('Options.averageDeviationLowComplexity');
		$avgDevMeanComplex = $this->Session->read('Options.averageDeviationMeanComplexity');
		$avgDevHighComplex = $this->Session->read('Options.averageDeviationHighComplexity');
		$maxAvgDevEffect = $this->Session->read('Options.maxAverageDeviationEffectiveness');
		$maxAvgOverEffect = $this->Session->read('Options.maxAverageOverfulfillmentEffectiveness');
		$maxDayOverEffect = $this->Session->read('Options.maxDayOverfulfillmentEffectiveness');
		$avgOnAutoAssignComplPkg = $this->Session->read('Options.averageOnAutoAssignedCompliancePackage');
		$options = array(
			'conditions' => array('Package.' . $model->primaryKey => $id), 
			'contain' => array('Rfc')
		);
		$package = $model->find('first', $options);
		
		// If already certified date setted
		if (empty($package['Package']['certified_date']) || $package['Package']['certified_date'] == '0000-00-00')
			$package['Package']['certified_date'] = $certifiedDate = date('Y-m-d');
		else
			 $certifiedDate = $this->deleteMinutes($package['Package']['certified_date']);


		// FIXME: Check whether this status would be previously set
		$package['Package']['package_status_id'] = $certifiedStatus;
		$startDate = $this->deleteMinutes($package['Package']['start_date']);

		// In case it was assigned after certification
		if ( $this->greaterEqual($package['Package']['assignment_date'], $package['Package']['entry_date']) )
			$package['Package']['assignment_date'] = $package['Package']['entry_date'];

		$entryDate = $this->deleteMinutes($package['Package']['entry_date']);

		$replanningDate = $this->deleteMinutes($package['Package']['replanning_date']);
		$endDate = $this->deleteMinutes($package['Package']['end_date']);
		$replanning = $package['Package']['replanning'];
		$trial_days = $package['Package']['trial_days'];
		$holidays = $this->getHolidays();
		// cantidad de dias laborables entre start y certified

		$package['Package']['certification_days'] = $this->getWorkingDays($entryDate, $certifiedDate, $holidays);
		// cantidad de dias laborables entre start y certified
		$package['Package']['ttc'] = $this->getWorkingDays($startDate, $certifiedDate, $holidays);
		// Dias laborales entre start date y end date
		$package['Package']['ttp'] = $this->getWorkingDays($startDate, 
			($replanning) ? $replanningDate : $endDate, $holidays);

		$effectivity = $package['Package']['ttp'] - $package['Package']['ttc'];

		if ($effectivity > 0) {

			if ($replanning || $trial_days > $maxDayOverEffect /*|| $model->suspended($package['Package']['number_package'])*/ )
				$package['Package']['overfulfillment_effectiveness'] = 0;
			else
				//(TTC - TTP) < 0; ((TTC - TTP) * (-1) * (4)) > 20; =20; =Resultado de la Operación
				$package['Package']['overfulfillment_effectiveness'] = ($effectivity <= $maxDayOverEffect) ?

				($maxAvgOverEffect / $maxDayOverEffect * abs($effectivity)) :
				($maxAvgOverEffect);

			// There wasn't deviation
			$package['Package']['deviation_effectiveness'] = 0;

		} elseif ($effectivity < 0) {
			//(TTC - TTP) > 0; ((TTC - TTP) * El parámetro de desviación de proyectos Altos, Medios o Bajos) > 60; =60; = Resultado de la Operación
			$rfcComp = $package['Rfc']['complexity_id'];
			
			switch ($rfcComp) {
				case '4':
					$coeff = abs($effectivity) * $avgDevHighComplex;
					break;
				case '3':
					$coeff = abs($effectivity) * $avgDevMeanComplex;
					break;
				default:
					$coeff = abs($effectivity) * $avgDevLowComplex;
					break;
			}

			if ($coeff <= ($maxAvgDevEffect)) 
				$package['Package']['deviation_effectiveness'] = $coeff;
			else 
				$package['Package']['deviation_effectiveness'] = $maxAvgDevEffect;

			// There wasn't overfulfillment
			$package['Package']['overfulfillment_effectiveness'] = 0;
		} else {
			// There wasn't overfulfillment_effectiveness neither deviation_effectiveness
			$package['Package']['overfulfillment_effectiveness'] = $package['Package']['deviation_effectiveness'] = 0;
		}

		if ($package['Package']['auto_assign'])
			$package['Package']['overfulfillment_effectiveness'] += $avgOnAutoAssignComplPkg; // averageOnAutoAssignedCompliancePackage

		$package['Package']['effec_eval_date'] = date('Y-m-d H:i:s');

		return $package;
	}

	public function unCertify($idPackage = null, $idRfc = null) {

		$mRfc = ClassRegistry::init('Rfc');

		$mPackage = ClassRegistry::init('Package');

		if (is_null($idRfc) && !is_null($idPackage)) {

			$options = array('conditions' => array('Package.' . $mPackage->primaryKey => $idPackage));
			$package = $mPackage->find('first', $options);

			debug($package);

			if (empty($package))
				return false;

			$rfcId = $package['Rfc']['id'];

		} elseif (!is_null($idRfc)) {

			$rfcId = $idRfc;

		}

		$mRfc->Behaviors->load('Containable');

		$options = array(
			'conditions' => array('Rfc.' . $mRfc->primaryKey => $rfcId), 
			'contain' => array('Package')
		);

		$rfc = $mRfc->find('first', $options);

		if (empty($rfc))
			return false;

		foreach ($rfc['Package'] as $key => $package) {
			// Not certified neither evaluated
			$rfc['Package'][$key]['certification_days'] = null;
			$rfc['Package'][$key]['ttc'] = null;
			$rfc['Package'][$key]['ttp'] = null;
			$rfc['Package'][$key]['deviation_effectiveness']  = null;
			$rfc['Package'][$key]['overfulfillment_effectiveness'] = null;
			$rfc['Package'][$key]['final_weighting'] = null;
			$rfc['Package'][$key]['effec_eval_date'] = null;
		}

		$rfc['Rfc']['remaining'] = 0;
		$rfc['Rfc']['closed'] = 0;

		return $mRfc->saveAll($rfc);

	}

	public function getHolidays(){
		$model = ClassRegistry::init('Holidays');
		//$this->loadModel('Holidays');
		$holidays = $model->find('list', array('fields' => array('date'), 'order' => array('date')));
		return array_values($holidays);
	}

	public function greaterEqual($firstDate, $secondDate) {
		return $this->deleteMinutes($firstDate) >= $this->deleteMinutes($secondDate);
	}

	public function lowerEqual($firstDate, $secondDate) {
		return $this->deleteMinutes($firstDate) <= $this->deleteMinutes($secondDate);
	}

	public function deleteMinutes($date){

		return date("Y-m-d", strtotime($date));

	}
	//devuelve el porcentage de tiempo trascurrido entre dos fechas dando la fecha de inicio la fecha fin y el tiempo que se usa de pivote para calcular
	//si el valor forward es falso se calcula el porcentage de tiempo restante para finalizar
	public function timeToPercentage($startDate,$endDate,$dateToCalculate,$forward = true) {

		if ($forward){
			return $this->getWorkingDays($startDate,$dateToCalculate,$this->getHolidays()) * 100 / $this->getWorkingDays($startDate,$endDate,$this->getHolidays());}
		else
			return $this->getWorkingDays($dateToCalculate,$endDate,$this->getHolidays()) * 100 / $this->getWorkingDays($startDate,$endDate,$this->getHolidays());
	}
	
	public function search($array, $key, $value)
	{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, $this->search($subarray, $key, $value));
        }
    	}

    	return $results;
		}

		public function filter($data, $conditions) {
		
		$return = array();
		// Foreach del arreglo de resultados
		foreach ($data as $row) {
			// For each de cada tabla Employee, Package
			foreach ($row as $table => $fields) {

				$tempRow = array();
				
				foreach ($fields as $key => $value) {
					
					if (isset($conditions["$table.$key"]) && $conditions["$table.$key"] == $value)
						$tempRow = $row;

					if (isset($conditions["$table.$key>="]) && $conditions["$table.$key>="] >= $value)
						$tempRow = $row;

					if (isset($conditions["$table.$key<="]) && $conditions["$table.$key<="] >= $value)
						$tempRow  = $row;

					if (isset($conditions["$table.$key!="]) && $conditions["$table.$key!="] >= $value)
						$tempRow = $row;

					
					} // End fields
					
					if (!empty($tempRow))
						$return[] = $tempRow;

			} // End row

		} // End data
		return $return;
	} // End function

	
/*
//Example:

$arr = array(0 => array(id=>1,name=>"cat 1"),
             1 => array(id=>2,name=>"cat 2"),
             2 => array(id=>3,name=>"cat 1"));

print_r(search($arr, 'name', 'cat 1'));
*/
	

	//echo getWorkingDays("2008-12-22","2009-01-02",$holidays)
	// => will return 7

/**
 * Returns the no. of business days between two dates and it skips the holidays
 *
 * @param string Start date eg. 2008-12-25
 * @param string End Date eg. 2008-12-26
 * @param array Holidays eg. array("2008-12-25","2008-12-26","2009-01-01")
 * @return int business days between two dates
 */
	public function getWorkingDays($startDate,$endDate,$holidays){
		// do strtotime calculations just once
		$endDate = strtotime($endDate);
		$startDate = strtotime($startDate);


		//The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
		//We add one to inlude both dates in the interval.
		$days = abs($endDate - $startDate) / 86400 + 1;
		//$days = floor($days);

		$no_full_weeks = floor($days / 7);
		$no_remaining_days = fmod($days, 7);

		//It will return 1 if it's Monday,.. ,7 for Sunday
		$the_first_day_of_week = date("N", $startDate);
		$the_last_day_of_week = date("N", $endDate);

		//---->The two can be equal in leap years when february has 29 days, the equal sign is added here
		//In the first case the whole interval is within a week, in the second case the interval falls in two weeks.
		if ($the_first_day_of_week <= $the_last_day_of_week) {
			if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;
			if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;
		}
		else {
			// (edit by Tokes to fix an edge case where the start day was a Sunday
			// and the end day was NOT a Saturday)

			// the day of the week for start is later than the day of the week for end
			if ($the_first_day_of_week == 7) {
				// if the start date is a Sunday, then we definitely subtract 1 day
				$no_remaining_days--;

				if ($the_last_day_of_week == 6) {
					// if the end date is a Saturday, then we subtract another day
					$no_remaining_days--;
				}
			}
			else {
				// the start date was a Saturday (or earlier), and the end date was (Mon..Fri)
				// so we skip an entire weekend and subtract 2 days
				$no_remaining_days -= 2;
			}
		}

		//The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder
		//---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it
		$workingDays = $no_full_weeks * 5;
		if ($no_remaining_days > 0 )
		{
			$workingDays += $no_remaining_days;
		}

		//We subtract the holidays
		foreach($holidays as $holiday){
			$time_stamp=strtotime($holiday);
			//If the holiday doesn't fall in weekend
			if ($startDate <= $time_stamp && $time_stamp <= $endDate && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)
				$workingDays--;
		}

		return $workingDays;
	}

	public function computeWeighting($id) {
		$model = ClassRegistry::init('Rfc');

		$certifiedStatus = $this->Session->read('Options.certifiedStatus');

		$maxAvgOverEffec = $this->Session->read('Options.maxAverageOverfulfillmentEffectiveness');

		$model->id = $id;
		// FIXME: Why?. This is failing against Assignment member
		$model->contain(array('Package'));
		$rfc = $model->read();


		// Return if this Rfc is closed
		if ($rfc['Rfc']['closed'])
			return -1;
		
		if ($rfc['Rfc']['remaining'] == 0)
			$rfcWeighting = $rfc['Rfc']['weighting'];
		else
			$rfcWeighting = $rfc['Rfc']['remaining'];

		$allPackages = sizeof($rfc['Package']);
		$totalPackageWeighting = 0;
		$certifiedPackages = array();

		// Get certified packages and sum weighting of every not yet evaluated package
		foreach ($rfc['Package'] as $key => $package) {
			// Not certified neither evaluated
			if ($package['package_status_id'] == $certifiedStatus && $package['final_weighting'] == 0){
				$certifiedPackages[$key] = $package;
			}
			// Not evaluated
			if ($package['final_weighting'] == 0){
				$totalPackageWeighting += $package['weighting'];
			}
		}

		$computed = 0;
		// Compute final_weighting for every certified package
		foreach ($certifiedPackages as $key => $package) {
			$rfc['Package'][$key]['final_weighting'] = $package['weighting'] * $rfcWeighting / $totalPackageWeighting;
			// Rfc Scale
			$currentRealWeighting = $rfc['Package'][$key]['final_weighting'];
			// Weighting for all processed packages
			$computed += $currentRealWeighting;

			//Evaluación Efectividad : (100 – Desviación de Efectividad + Sobrecumplimiento de Efectividad) * Ponderación

			$effectEval = 
				(100 - $package['deviation_effectiveness'] + 
				$package['overfulfillment_effectiveness']) * 
				$currentRealWeighting;

			// FIXME: This is an error
			/*if ($effectEval >= $maxAvgOverEffec) {
				$rfc['Package'][$key]['effectiveness_evaluation'] = $maxAvgOverEffec;
			} else {
				$rfc['Package'][$key]['effectiveness_evaluation'] = $effectEval;
			}*/

			$rfc['Package'][$key]['effectiveness_evaluation'] = $effectEval;
		}

		// If at least one package was processed
		if ($computed != 0)
			// Update remaining weighting for next call
			$rfc['Rfc']['remaining'] = $rfc['Rfc']['weighting'] - $computed;

		if (sizeof($certifiedPackages) == $allPackages)
			$rfc['Rfc']['closed'] = TRUE;

		return $rfc;
	}

	public function monthNames($n = null) {

		$m = array(
			 1 => __('January'),
			 2 => __('February'),
			 3 => __('March'),
			 4 => __('April'),
			 5 => __('May'),
			 6 => __('June'),
			 7 => __('July'),
			 8 => __('August'),
			 9 => __('September'),
			10 => __('October'),
			11 => __('November'),
			12 => __('December')
		);

		$pos = intval($n);

		if ($pos > 0) {
			return $m[$n];
		} else
			return $m;
	}

	protected function _mtRequest($data, $link, $type = 'get', $format = 'json') {


		// Setting format for request
		if ($format == 'xml') {
			$xmlObject = Xml::fromArray($data);
			$data = $xmlObject->asXML();

			$request = array(
				'header' => array('Content-Type' => 'application/xml')
			);

			$link .= '.xml';

		} elseif ($format == 'json') {
			$data = json_encode($data);

			$request = array(
				'header' => array('Content-Type' => 'application/json')
			);
			$link .= '.json';
		}

		$httpSocket = new HttpSocket();

		// Sending request according to type
		switch ($type) {
			case 'get':
				$response = $httpSocket->get($link, $data, $request);
				break;
			case 'post':
				$response = $httpSocket->post($link, $data, $request);
				break;
			case 'put':
				$response = $httpSocket->put($link, $data, $request);
				break;
			case 'delete':
				$response = $httpSocket->delete($link, $data, $request);
				break;
			default:
				$response = null;
				break;
		}

		// Writing request on log file
		$this->restLog($httpSocket->request, 'request');
		//debug($httpSocket->request);

		if (!is_null($response)) {
			// Writing response on log file
			$this->restLog($response->body, 'response');
			return json_decode($response->body, true);

		} else {
			// Writing response on log file
			$this->restLog($response, 'response');
			return $response; // null
		}
		
	}

	protected function _mtProjectAction($data = null, $action = 'index', $id = null) {
		// remotely post the information to the server
		//$link =  "http://" . $_SERVER['HTTP_HOST'] . $this->webroot.'rest_phones.json';
		$methodologyUrl = $this->Session->read('Options.methodologyUrl');
		$base = $methodologyUrl;
		
		switch ($action) {
			case 'add':
				$link = $base . 'mt_proyects';
				return $this->_mtRequest($data, $link, 'post');
				break;
			case 'edit':
				$link = $base . "mt_proyects/$id";
				return $this->_mtRequest($data, $link, 'put');
				break;
			case 'delete':
				$link = $base . "mt_proyects/$id";
				return $this->_mtRequest($data, $link, 'delete');
				break;
			case 'view':
				$link = $base . "mt_proyects/$id";
				return $this->_mtRequest($data, $link, 'get');
				break;
			case 'viewRfc':
					$link = $base . "mt_proyects/viewRfc/$id";
					return $this->_mtRequest($data, $link, 'get');
					break;
			default:
				$link = $base . 'mt_proyects';
				return $this->_mtRequest($data, $link, 'get');
				break;
		}
	}

	public function add_mtproject($rfcId,$assig=null) {

		$mRfc = ClassRegistry::init('Rfc');

		$mRfc->Behaviors->load('Containable');
		if(isset($assig)){
			$options = array(
			'conditions' => array('Rfc.' . $mRfc->primaryKey => $rfcId), 
			'contain' => array('Assignment' => array('Employee')));

		}else{
		$options = array(
			'conditions' => array('Rfc.' . $mRfc->primaryKey => $rfcId), 
			'contain' => array('Package' => array('Employee'))
		);
	}

		$rfc = $mRfc->find('first', $options);

		// There isn't such rfc
		if (empty($rfc))
			return false;

		// We are ok, that rfc exists. Let's create a mt_project
		$ccs = array();
		$username = false;
		if (isset($assig)) {
					$username = $rfc['Assignment'][0]['Employee']['bc'];
		
		} else {
			
			$size = sizeof($rfc['Package']);

			foreach ($rfc['Package'] as $key => $package) {
				$ccs[] = $package['number_package'];

				if(!$username)
					$username = $package['Employee']['bc'];
			}

			$ccs = implode(',', $ccs);
		}
		$data['MtProyect'] = array(
				//'id' => $id, 
				//'mt_user_id' => '1',
				'rfc' => $rfc['Rfc']['id'],
				'name' => $rfc['Rfc']['name'],
				'description' => $rfc['Rfc']['description'],
				'username' => $username,
				'ccs' => $ccs,
				'high_impact'  => $rfc['Rfc']['high_impact']
		);

		$mt_prev = $this->_mtProjectAction(null, 'viewRfc', $rfcId);

		if (is_array($mt_prev) && isset($mt_prev['MtProyect']))
			$data['MtProyect'] = array_merge($mt_prev['MtProyect'], $data['MtProyect']);

		$id = isset($data['MtProyect']['id']) ? $data['MtProyect']['id'] : null;

		if ( !isset($data['MtProyect']['general_status']) || is_null($data['MtProyect']['general_status']) )
			$data['MtProyect']['general_status'] = 0;
		if ( !isset($data['MtProyect']['high_impact']) || is_null($data['MtProyect']['high_impact']) )
			$data['MtProyect']['high_impact'] = 0;
		if ( !isset($data['MtProyect']['mt_status_proyect_id']) || is_null($data['MtProyect']['mt_status_proyect_id']) )
			$data['MtProyect']['mt_status_proyect_id'] = 2;

		if (is_numeric($id)) {

			$mt = $this->_mtProjectAction($data, 'edit', $id);

		} else {

			$mt = $this->_mtProjectAction($data, 'add');
		} // if id

		if (isset($mt['MtProyect'])) {
			$rfc['Rfc']['mtp_id'] = $mt['MtProyect']['id'];
			return $mRfc->save($rfc);
		}
		
	}

	/**
	* Returns the version of Internet Explorer or false
	*/
	public function isIE(){

		$isIE = preg_match("/MSIE ([0-9]{1,}[\.0-9]{0,})/",$_SERVER['HTTP_USER_AGENT'],$version);
		if($isIE){
			return $version[1];
		}
		return $isIE;
	}

	protected function restLog($message = null, $type = '') {
		$text = PHP_EOL . <<<TEXT
########## %s ##########
%s
###########################
TEXT;
		
		if (isset($message['auth']))
			unset($message['auth']);

		$message =  Debugger::exportVar($message, 25);
		$text = sprintf( $text, strtoupper($type), $message );
		CakeLog::write('rest', $text);
	}

	/*

	array(
		'MtProyect' => array(
			'mt_user_id' => '1',
			'rfc' => '12',
			'name' => 'demo',
			'description' => 'demo',
			'username' => 'bc213316',
			'ccs' => '111111'
		)
	)

	{
		"MtProyect":{
			"mt_user_id":"1",
			"rfc":"12",
			"name":"demo",
			"description":"demo",
			"username":"bc213316",
			"ccs":"111111"
		}
	}
	*/	

}