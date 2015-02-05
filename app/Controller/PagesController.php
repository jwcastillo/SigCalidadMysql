<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {
public $components = array('Session', 'HighCharts.HighCharts','Common');
//Import controller
/**
 * This controller does not use a model
 *
 * @var array
 */
  public $uses = array('Employee','AbsenceType','Management','Absence','AbsenceType','Package','EvaluationState');

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *  or MissingViewException in debug mode.
 */
protected function _importantDays($interval=30){

    $this->loadModel('Holiday','Employee');
   //Dias Festivos
       ////cumpleaños y aniversarios
       /////trae los proximos aniversarios definidos en un intervalo de tiempo
       $aniversarios = $this->Employee->find('all', array(
           'fields' => array('Employee.id','Employee.name', 'Employee.lastname', 'Employee.fullname', 'Employee.entry_date','Employee.image','Employee.bc'),
           'conditions' => array('Employee.active'=>true,'DAYOFYEAR(entry_date) -DAYOFYEAR(NOW()) BETWEEN 0 AND ' . $interval ),
           //OR DAYOFYEAR(entry_date) - DAYOFYEAR(NOW())  > 351'),
           'order' => array('entry_date'),
           'limit' => 3, //int
           'recursive' => -1));
     
       $cumpleanos = $this->Employee->find('all', array(
           'fields' => array('Employee.id','Employee.name', 'Employee.lastname', 'Employee.fullname', 'birthdate','Employee.image','Employee.bc'),
           'conditions' => array('Employee.active'=>true,'DAYOFYEAR( DATE(STR_TO_DATE( birthdate, "%d-%m")))-DAYOFYEAR(  NOW() ) BETWEEN 0 AND ' . $interval ),
           //'order' => array(''),
           'limit' => 3, //int
           'recursive' => -1,
           ));


       ////feriados
       //trae los proximos feriados definidos en un intervalo de tiempo, los cumpleaños, las salidas de los empleados y sus llegadas de vacaciones
       $holidays = $this->Holiday->find('all', array(
           'fields' => array('Holiday.id','Holiday.name', 'Holiday.date'),
           'conditions' => array(' date  <= DATE_ADD( NOW( ) , INTERVAL"' . $interval .'"
           DAY )  and date > NOW( )'),
           'order' => array('Holiday.date'),
           'limit' => 5, //int
           'recursive' => -1));

   $this->set(compact('aniversarios','cumpleanos','holidays'));
}

protected function _absenceDays($interval=30, $management_id_session=null){
  $this->loadModel('Absence','Employee','AbsenceType');

  // Copying fullname field from Employee to Package
  $this->Absence->virtualFields['employee'] = $this->Employee->virtualFields['fullname'];

   $llegadas =  $this->Absence->find('all', array(
           'conditions' => array(
            'Absence.arrival_date <= DATE_ADD(NOW(),INTERVAL ' . $interval .' day)',
            'Absence.arrival_date > NOW()',
            'Absence.departure_date < NOW()',
            'Employee.active'=>true,
            'Absence.absence_type_id !=8',
            'Employee.management_id'=>$management_id_session
            ),
           'limit' => 5,
           'fields' => array('id',
           'AbsenceType.name','Absence.description','Absence.departure_date',
           'Absence.arrival_date','Employee.id', 'Employee.bc', 'Employee.name','Employee.lastname',  'Employee.image',
           'Absence.employee'), // virtual field,
           'order' => array('Absence.arrival_date')));

      $salidas =  $this->Absence->find('all', array(
          'conditions' => array(
            'Absence.departure_date <= DATE_ADD(NOW(),INTERVAL '.$interval.' day )',
            'Absence.arrival_date > NOW()',
            'Absence.absence_type_id !=8',
            'Absence.departure_date > NOW()',
            'Employee.active'=>true,
            'Employee.management_id'=>$management_id_session //$management_id_session
           ),
          'limit' => 5,
          'fields' => array('Absence.id','AbsenceType.name','Absence.description',
          'Absence.departure_date','Absence.arrival_date','Employee.id', 'Employee.bc', 'Employee.name','Employee.lastname', 
          'Employee.image', 'Absence.employee' // virtual field),
          ),
          'order' => array('Absence.departure_date'),
        )
      );
      $guardias =  $this->Absence->find('all', array(
          'conditions' => array(
            'WEEK(Absence.departure_date) >= WEEK(NOW())',
            'Absence.absence_type_id =8',
            'Employee.active'=>true,
            //'Employee.management_id'=>$management_id_session //$management_id_session
           ),
          'limit' => 4,
          'fields' => array('Absence.id','AbsenceType.name','Absence.description',
          'Absence.departure_date','Absence.arrival_date','Employee.id', 'Employee.bc', 'Employee.name','Employee.lastname','Employee.cell_phone', 
          'Employee.image', 'Absence.employee' // virtual field),
          ),
          'order' => array('Absence.departure_date'),
        )
      );

   $this->set(compact('llegadas','salidas','guardias'));
}

protected function _statusWeek($employee_id_session,$manager_id,$intervalWeek,$unassignedManagement, $unassignedEmployee, $management_id_session,$certifiedStatus,$suspendStatus){
  $this->loadModel('Package');
  $conditions[]=array();
  //trae los paquetes nuevos
   //es gerente? 
  if($this->Session->read('Auth.User.group_id')==3 || $this->Session->read('Auth.User.group_id')==2 || $this->Session->read('Auth.User.group_id')==5){
    $nuevosPaquete = $this->Package->find('count', array('conditions' => array("Package.employee_id"=>$unassignedEmployee,"Package.management_id"=> $unassignedManagement),'recursive' => -1));
    $this->set('nuevosPaquete',$nuevosPaquete);
    //
    //trae los que no estan asignados
    $sinAsignar = $this->Package->find('count', array('conditions' => array(/*"Package.certified_date"=> '0000-00-00 00:00:00',*/"Package.management_id"=> $management_id_session,"Package.employee_id"=>$unassignedEmployee/*,"Package.entry_date >= \"". date("Y-m-d", strtotime(date("Y-m-d") ."-". $intervalWeek ." day"))."\" "*/),'recursive' => -1));
    $this->set('sinAsignar',$sinAsignar);

    $sinEmpezar = $this->Package->find('count', array('conditions' => array("Package.certified_date"=> '0000-00-00 00:00:00', "Package.employee_id !="=>$unassignedEmployee, "Package.management_id"=> $management_id_session,
    "Package.package_status_id <"=>$certifiedStatus, "Package.start_date >"=> date("Y-m-d") ),'recursive' => -1));
    
    $enProceso = $this->Package->find('count', array('conditions' => array("Package.certified_date"=> '0000-00-00 00:00:00', "Package.employee_id !="=>$unassignedEmployee, "Package.management_id"=> $management_id_session,
      "Package.package_status_id <"=>$certifiedStatus /*"Package.start_date <="=> date("Y-m-d")*/ ),'recursive' => -1));
    
    $certificados = $this->Package->find('count', array('conditions' => array(/*"WEEKOFYEAR(Package.certified_date)"=> date('W') ,"YEAR(Package.certified_date)"=> date('Y'),*/"Package.management_id"=> $management_id_session,"( Package.package_status_id=" .$certifiedStatus . " OR Package.certified_date != '0000-00-00 00:00:00')"),'recursive' => -1));
   


    $paquetes=$this->Package->find('all', array('conditions' => array("Package.certified_date"=> '0000-00-00 00:00:00',"Package.employee_id !="=>$unassignedEmployee, "Package.management_id"=> $management_id_session,"Package.package_status_id
      <"=>$certifiedStatus),'recursive' => -1));
    $vencidos=0;
    foreach ($paquetes as $key => $value) {
      # code...
      $fechaFin=$value['Package']['end_date'];
      if (!is_null($value['Package']['replanning_date'])) {
              $fechaFin=$value['Package']['replanning_date'];
      }
      $timep=(int) $this->Common->timeToPercentage($value['Package']['start_date'],$fechaFin,date("Y-m-d"));


    if  ($timep>=100) {
     // debug('chivo');
    $vencidos++;
    }

  /*    debug($value['Package']['start_date']);
      debug($fechaFin);
      debug(date("Y-m-d"));

      debug($timep);
*/
    }


    //
 $suspendidos = $this->Package->countSuspended($management_id_session); 

  } else {
  //no es gerente 
  $sinEmpezar = $this->Package->find('count', array('conditions' => array("Package.certified_date"=> '0000-00-00 00:00:00', "Package.employee_id "=>$employee_id_session, 
  "Package.package_status_id <"=>$certifiedStatus, "Package.start_date >"=> date("Y-m-d") ),'recursive' => -1));
  
  //trae los que estan en proceso area
  $enProceso = $this->Package->find('count', array('conditions' => array("Package.certified_date"=> '0000-00-00 00:00:00', "Package.employee_id "=>$employee_id_session, 
    "Package.package_status_id <"=>$certifiedStatus /*"Package.start_date <="=> date("Y-m-d") */),'recursive' => -1));
  //falta validadar si el empleado no es gerente
  //trae los que estan en certificados area
  //
  $certificados = $this->Package->find('count', array('conditions' => array(/*"WEEKOFYEAR(Package.certified_date)"=> date('W') ,"YEAR(Package.certified_date)"=> date('Y'),*/"Package.employee_id "=>$employee_id_session,"( Package.package_status_id=" .$certifiedStatus . " OR Package.certified_date != '0000-00-00 00:00:00')"),'recursive' => -1));
  //
  //trae los que estan en vencidos area
  
 $paquetes=$this->Package->find('all', array('conditions' => array("Package.certified_date"=> '0000-00-00 00:00:00',"Package.employee_id !="=>$unassignedEmployee, "Package.management_id"=> $management_id_session,"Package.package_status_id
      <"=>$certifiedStatus),'recursive' => -1));

$vencidos=0;
    foreach ($paquetes as $key => $value) {
      # code...
      $fechaFin=$value['Package']['end_date'];
      if (!is_null($value['Package']['replanning_date'])) {
              $fechaFin=$value['Package']['replanning_date'];
      }
      $timep=(int) $this->Common->timeToPercentage($value['Package']['start_date'],$fechaFin,date("Y-m-d"));


    if  ($timep>100) {
     // debug('chivo');
    $vencidos++;
    }

  /*    debug($value['Package']['start_date']);
      debug($fechaFin);
      debug(date("Y-m-d"));

      debug($timep);
*/
    }




  $vencidos = $this->Package->find('count', array('conditions' => array("Package.certified_date"=> '0000-00-00 00:00:00', "Package.employee_id "=>$employee_id_session, "Package.package_status_id
      <"=>
      $certifiedStatus,"IFNULL( Package.replanning_date, Package.end_date )
      <"=>date("Y-m-d") ),'recursive' => -1));
 $suspendidos = $this->Package->countSuspended(0,$employee_id_session); 

  

 }
   //
  //trae los que estan en suspendidos area
//FIX
  if($this->Session->read('Auth.User.group_id')==2 || $this->Session->read('Auth.User.group_id')==3 || $this->Session->read('Auth.User.group_id')==5){
  //gerente
  //
  //trae los que estan en evaluacionGerencia area
  $evaluacionGerencia = $this->Package->find('count', array('conditions' => array(  "Package.management_id"=> $management_id_session,"Package.package_status_id"=>$certifiedStatus,"Package.evaluation_state_id"=>1 ),'recursive' => -1));
  $this->set('evaluacionGerencia',$evaluacionGerencia);
  //
  //trae los que estan en evaluadosGerencia area
  $evaluadosGerencia = $this->Package->find('count', array('conditions' => array(  "Package.management_id"=> $management_id_session,"Package.package_status_id"=>$certifiedStatus,"Package.evaluation_state_id"=>2  ),'recursive' => -1));
  $this->set('evaluadosGerencia',$evaluadosGerencia);
  //
  //trae los que estan en evaluacionCIT TOTAL
  /*$evaluacionCIT = $this->Package->find('count', array('conditions' => array("Package.package_status_id"=>$certifiedStatus,"Package.evaluation_state_id"=>2  ),'recursive' => -1));
  $this->set('evaluacionCIT',$evaluacionCIT);*/
  }
 
  if($this->Session->read('Auth.User.group_id')==2 || $this->Session->read('Auth.User.group_id')==3 || $this->Session->read('Auth.User.group_id')==5){
  //trae los que estan en evaluadosCIT area
  $evaluadosCITA = $this->Package->find('count', array('conditions' => array( "Package.evaluation_state_id"=>2 ),'recursive' => -1));
  $this->set('evaluadosCITA',$evaluadosCITA);
  //
  //trae los que estan en evaluadosCIT TOTAL
  $evaluadosCIT = $this->Package->find('count', array('conditions' => array( "Package.evaluation_state_id"=>3  ),'recursive' => -1));
  $this->set('evaluadosCIT',$evaluadosCIT);
  }
  $this->set(compact('sinEmpezar','enProceso','certificados','vencidos','suspendidos'));
}

protected function _notifications($employee_id_session,$manager_id,$DaysRollback,$short,$long,$medium,$DaysPromoted,$unassignedManagement, $unassignedEmployee, $management_id_session,$certifiedStatus){
  $this->loadModel('Package');
  $conditions[]=array();
  if($this->Session->read('Auth.User.group_id')==2 || $this->Session->read('Auth.User.group_id')==3 || $this->Session->read('Auth.User.group_id')==5){
  //gerente
  //paquetes promovidos 
  //paquete promovido notificacion verde
    //$conditions['Package.package_status_id <'] = $certifiedStatus; 
    $conditions['Package.management_id'] = $unassignedManagement;
    $conditions['Package.employee_id'] = $unassignedEmployee;
    $conditions['Package.entry_date >='] = date("Y-m-d", strtotime(date("Y-m-d") . " -" . $DaysRollback   . " day"));     //  CakeLog::write('debug', '1'); 
  // $conditions['DATE_FORMAT(Package.entry_date, \'%Y-%m-%d\') <']= date("Y-m-d", strtotime(date("Y-m-d") ."-". ($DaysPromoted - $DaysRollback)   ." day"));

    $pp1= $this->Package->find('count', array('conditions' => $conditions ,'recursive' => -1));
    unset($conditions['Package.entry_date >=']);
  //  unset($conditions['DATE_FORMAT(Package.entry_date, \'%Y-%m-%d\') <']);
    //paquete promovido notificacion amarillo
    
    $conditions['DATE_FORMAT(Package.entry_date, \'%Y-%m-%d\')'] = date("Y-m-d", strtotime(date("Y-m-d") ."-". ($DaysPromoted - $DaysRollback)   ." day"));
    $pp2= $this->Package->find('count', array('conditions' => $conditions ,'recursive' => -1));
    //paquete promovido notificacion rojo
    unset($conditions['DATE_FORMAT(Package.entry_date, \'%Y-%m-%d\')']);
    $conditions['Package.entry_date <'] = date("Y-m-d", strtotime(date("Y-m-d") ."-".  ($DaysPromoted - $DaysRollback)   ." day"));
    
    $pp3= $this->Package->find('count', array('conditions' => $conditions,'recursive' => -1));
  
  //paquetes sin asignar  
     //paquete sin asignar notificacion verde
    $pa1= $this->Package->find('count', array('conditions' => array("Package.employee_id"=>$unassignedEmployee, "Package.management_id"=> $management_id_session, 'DATE_FORMAT(Package.entry_date, \'%Y-%m-%d\') >='=>date("Y-m-d", strtotime(date("Y-m-d") ."-". $DaysRollback ." day")),'DATE_FORMAT(Package.entry_date, \'%Y-%m-%d\') <='=>date("Y-m-d", strtotime(date("Y-m-d")))),'recursive' => -1));
   
    $pa2= $this->Package->find('count', array('conditions' => array("Package.employee_id"=>$unassignedEmployee, "Package.management_id"=> $management_id_session, 'DATE_FORMAT(Package.entry_date, \'%Y-%m-%d\')'=>date("Y-m-d", strtotime(date("Y-m-d") ."-". ($DaysPromoted - $DaysRollback)   ." day"))),'recursive' => -1));
    $pa3= $this->Package->find('count', array('conditions' => array("Package.employee_id"=>$unassignedEmployee, "Package.management_id"=> $management_id_session, 'DATE_FORMAT(Package.entry_date, \'%Y-%m-%d\') <'=>date("Y-m-d", strtotime(date("Y-m-d") ."-".  ($DaysPromoted - $DaysRollback)   ." day"))),'recursive' => -1));
    $this->set(compact('pp1','pp2','pp3','pa1','pa2','pa3'));
  
    $enProceso2 = $this->Package->find('count', array('conditions' => array("Package.certified_date"=> '0000-00-00 00:00:00', "Package.employee_id !="=>$unassignedEmployee, "Package.management_id"=> $management_id_session,
      "Package.package_status_id <"=>$certifiedStatus),'recursive' => -1));
    
    $paquetes=$this->Package->find('all', array('conditions' => array("Package.certified_date"=> '0000-00-00 00:00:00',"Package.employee_id !="=>$unassignedEmployee, "Package.management_id"=> $management_id_session,"Package.package_status_id
      <"=>$certifiedStatus),'recursive' => -1));

$pv1=$pv2=$pv3=0;
    foreach ($paquetes as $key => $value) {
      # code...
      $fechaFin=$value['Package']['end_date'];
      if (!is_null($value['Package']['replanning_date'])) {
              $fechaFin=$value['Package']['replanning_date'];
      }
      $timep=(int) $this->Common->timeToPercentage($value['Package']['start_date'],$fechaFin,date("Y-m-d"));


    if ($timep>=100-$long && $timep<100-$medium) {
      //debug('perro');
    $pv1++;
    }
    elseif ($timep>=100-$medium && $timep<100-$short) {
      //debug('gato');

    $pv2++;
    }
    elseif ($timep>=100-$short && $timep<=100) {
      //debug('chivo');
    $pv3++;
    }

      // debug($value['Package']['number_package']);
      // debug($timep);

    }


  
     
    $certificados2 = $this->Package->find('count', array('conditions' => array("Package.management_id"=> $management_id_session,"( Package.package_status_id=" .$certifiedStatus . " OR Package.certified_date != '0000-00-00 00:00:00')"),'recursive' => -1));
  
} else {
    //no es gerente
    $enProceso2 = $this->Package->find('count', array('conditions' => array("Package.certified_date"=> '0000-00-00 00:00:00', "Package.employee_id "=>$employee_id_session, /*"Package.management_id"=> $management_id_session,*/
      "Package.package_status_id <"=>$certifiedStatus, "Package.start_date <="=> date("Y-m-d") ),'recursive' => -1));
    
    
    $paquetes=$this->Package->find('all', array('conditions' => array("Package.certified_date"=> '0000-00-00 00:00:00',"Package.employee_id "=>$employee_id_session, /*"Package.management_id"=> $management_id_session,*/"Package.package_status_id
      <"=>$certifiedStatus),'recursive' => -1));

$pv1=$pv2=$pv3=0;
    foreach ($paquetes as $key => $value) {
      # code...
      $fechaFin=$value['Package']['end_date'];
      if (!is_null($value['Package']['replanning_date'])) {
              $fechaFin=$value['Package']['replanning_date'];
      }
      $timep=(int) $this->Common->timeToPercentage($value['Package']['start_date'],$fechaFin,date("Y-m-d"));


    if ($timep>=100-$long && $timep<100-$medium) {
      //debug('perro');
    $pv1++;
    }
    elseif ($timep>=100-$medium && $timep<100-$short) {
      //debug('gato');

    $pv2++;
    }
    elseif ($timep>=100-$short && $timep<=100) {
     // debug('chivo');
    $pv3++;
    }


  /*    debug($value['Package']['start_date']);
      debug($fechaFin);
      debug(date("Y-m-d"));

      debug($timep);
*/
    }
    






  //   
    $certificados2 = $this->Package->find('count', array('conditions' => array("Package.employee_id "=>$employee_id_session,/* "Package.management_id"=> $management_id_session,*/"( Package.package_status_id=" .$certifiedStatus . " OR Package.certified_date != '0000-00-00 00:00:00')"),'recursive' => -1));
  }
  
  $this->set(compact('pv1','pv2','pv3','enProceso2','certificados2'));
  //END ESTATUS SEMANAL
 

}


  public function home() {
    
    $employee_id_session = $this->Session->read('Auth.User.employeeId');
    $management_id_session = $this->Session->read('Auth.User.management');
    $manager_id=$this->Session->read('Options.managers');

    if (!$employee_id_session) {
      $this->render('home_dev');
    }

    //el gerente del area
    $interval = $this->Session->read('Options.interval');//intervalo de tiempo para feriados
    $unassignedEmployee = $this->Session->read('Options.unassignedEmployee');
    $unassignedManagement = $this->Session->read('Options.unassignedManagement');
    $DaysRollback = $this->Session->read('Options.DaysRollback');
    $DaysPromoted = $this->Session->read('Options.DaysPromoted');
    $long = $this->Session->read('Options.long');
    $medium  = $this->Session->read('Options.medium');
    $short = $this->Session->read('Options.short');
    $intervalWeek = $this->Session->read('Options.intervalWeek'); 
    $certifiedStatus = $this->Session->read('Options.certifiedStatus');
    $suspendStatus = $this->Session->read('Options.suspendStatus');
    $this->_importantDays($interval);
    $this->_absenceDays($interval,$management_id_session);
    $this->_statusWeek($employee_id_session,$manager_id,$intervalWeek,$unassignedManagement, $unassignedEmployee, $management_id_session,$certifiedStatus,$suspendStatus);
    $this->_notifications($employee_id_session,$manager_id,$DaysRollback,$short,$long,$medium,$DaysPromoted,$unassignedManagement, $unassignedEmployee, $management_id_session,$certifiedStatus);
    $this->set(compact('manager_id','management_id_session','employee_id_session'));
    //END ESTATUS SEMANAL

  }

  public function display() {
  
    $path = func_get_args();

    $count = count($path);
    if (!$count) {
      return $this->redirect('/');
    }
    $page = $subpage = $title_for_layout = null;

    if (!empty($path[0])) {
      $page = $path[0];
    }
    if (!empty($path[1])) {
      $subpage = $path[1];
    }
    if (!empty($path[$count - 1])) {
      $title_for_layout = Inflector::humanize($path[$count - 1]);
    }
    $this->set(compact('page', 'subpage', 'title_for_layout'));

    try {
      $this->render(implode('/', $path));
    } catch (MissingViewException $e) {
      if (Configure::read('debug')) {
        throw $e;
      }
      throw new NotFoundException();
    }
  }
}