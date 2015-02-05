<?php
/**
 * PackageFixture
 *
 */
class PackageFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'number_package' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'Número de Paquete'),
		'module_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index', 'comment' => 'ID del Modulo al que pertenece'),
		'employee_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index', 'comment' => 'ID del Especialista o Análista del Calidad'),
		'package_status_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index', 'comment' => 'ID del Estatus del Paquete'),
		'rfc_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index', 'comment' => 'ID del Proyecto o Requerimiento al que pertenece'),
		'entry_date' => array('type' => 'datetime', 'null' => true, 'default' => null, 'key' => 'index', 'comment' => 'Fecha de Entrada'),
		'management_entry_date' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => 'Fecha Entrada Según Gerente de Área'),
		'assignment_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'type' => array('type' => 'string', 'null' => true, 'default' => 'Normal', 'length' => 12, 'collate' => 'utf8_general_ci', 'comment' => 'Tipo (Normal o Emergencia)', 'charset' => 'utf8'),
		'analyst' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 150, 'collate' => 'utf8_general_ci', 'comment' => 'Analista de Desarrollo Según Service Desk', 'charset' => 'utf8'),
		'applicant' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 150, 'collate' => 'utf8_general_ci', 'comment' => 'Usuario Solicitante', 'charset' => 'utf8'),
		'components' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Tipos de Componentes en el Paquete', 'charset' => 'utf8'),
		'components_amount' => array('type' => 'integer', 'null' => true, 'default' => null, 'comment' => 'Cantidad de Componentes'),
		'start_date' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => 'Fecha de Inicio'),
		'end_date' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => 'Fecha Fin'),
		'replanning_date' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => 'Fecha Replanificacion'),
		'certified_date' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Certificación'),
		'overfulfillment_effectiveness' => array('type' => 'float', 'null' => true, 'default' => '0', 'comment' => 'Sobrecumplimiento en Efectividad'),
		'deviation_effectiveness' => array('type' => 'float', 'null' => true, 'default' => '0', 'comment' => 'Desviación de Efectividad'),
		'overfulfillment_quality' => array('type' => 'float', 'null' => true, 'default' => '0', 'comment' => 'Sobrecumplimiento en Calidad'),
		'deviation_quality' => array('type' => 'float', 'null' => true, 'default' => '0', 'comment' => 'Desviación en Calidad'),
		'weighting' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2', 'comment' => 'Ponderación'),
		'final_weighting' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'effectiveness_evaluation' => array('type' => 'float', 'null' => true, 'default' => '0', 'comment' => 'Evaluación de efectividad'),
		'quality_assessment' => array('type' => 'float', 'null' => true, 'default' => '0', 'comment' => 'Evaluación de Calidad'),
		'replanning' => array('type' => 'boolean', 'null' => true, 'default' => null, 'comment' => 'Replanificación'),
		'replanning_days' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 3, 'comment' => 'Días de Replanificación'),
		'trial_days' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 4, 'comment' => 'Días para Inicio de Atención'),
		'certification_days' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 4, 'comment' => 'Días de Certificación'),
		'ttc' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 3, 'comment' => 'Tiempo Total Calidad'),
		'ttp' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 3, 'comment' => 'Tiempo Total Planificado'),
		'manager' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'utf8_general_ci', 'comment' => 'Gerente', 'charset' => 'utf8'),
		'respondent_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'key' => 'index', 'comment' => 'ID del Área Responsable en Caso de Rollback'),
		'evaluation_state_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'key' => 'index', 'comment' => 'ID del Estado de la Evaluación'),
		'current_stage' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Estado del Paquete', 'charset' => 'utf8'),
		'final_status_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 10, 'key' => 'index', 'comment' => 'ID del Estatus Final del Paquete'),
		'management_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index', 'comment' => 'ID de la Gerencia'),
		'packages_postimplantation' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 10, 'key' => 'index', 'comment' => 'Número de Paquete de PostImplantación'),
		'auto_assign' => array('type' => 'boolean', 'null' => true, 'default' => '0', 'comment' => 'Auto-Asignación de Paquete'),
		'effec_eval_date' => array('type' => 'date', 'null' => true, 'default' => null, 'comment' => 'Fecha Evaluación de Efectividad'),
		'qual_eval_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Creación'),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null, 'comment' => 'Fecha de Modificación'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'package_status_id' => array('column' => 'package_status_id', 'unique' => 0),
			'worker_id' => array('column' => 'employee_id', 'unique' => 0),
			'module_id' => array('column' => 'module_id', 'unique' => 0),
			'respondent_id' => array('column' => 'respondent_id', 'unique' => 0),
			'final_status_id' => array('column' => 'final_status_id', 'unique' => 0),
			'evaluation_state_id' => array('column' => 'evaluation_state_id', 'unique' => 0),
			'rfc_id' => array('column' => 'rfc_id', 'unique' => 0),
			'management_id' => array('column' => 'management_id', 'unique' => 0),
			'date_income' => array('column' => array('entry_date', 'management_entry_date'), 'unique' => 0),
			'packages_postimplantation' => array('column' => 'packages_postimplantation', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'number_package' => 1,
			'module_id' => 1,
			'employee_id' => 1,
			'package_status_id' => 1,
			'rfc_id' => 1,
			'entry_date' => '2014-05-15 09:28:15',
			'management_entry_date' => '2014-05-15',
			'assignment_date' => '2014-05-15',
			'type' => 'Lorem ipsu',
			'analyst' => 'Lorem ipsum dolor sit amet',
			'applicant' => 'Lorem ipsum dolor sit amet',
			'components' => 'Lorem ipsum dolor sit amet',
			'components_amount' => 1,
			'start_date' => '2014-05-15',
			'end_date' => '2014-05-15',
			'replanning_date' => '2014-05-15',
			'certified_date' => '2014-05-15 09:28:15',
			'overfulfillment_effectiveness' => 1,
			'deviation_effectiveness' => 1,
			'overfulfillment_quality' => 1,
			'deviation_quality' => 1,
			'weighting' => 1,
			'final_weighting' => 1,
			'effectiveness_evaluation' => 1,
			'quality_assessment' => 1,
			'replanning' => 1,
			'replanning_days' => 1,
			'trial_days' => 1,
			'certification_days' => 1,
			'ttc' => 1,
			'ttp' => 1,
			'manager' => 'Lorem ipsum dolor sit amet',
			'respondent_id' => 1,
			'evaluation_state_id' => 1,
			'current_stage' => 'Lorem ipsum dolor sit amet',
			'final_status_id' => 1,
			'management_id' => 1,
			'packages_postimplantation' => 1,
			'auto_assign' => 1,
			'effec_eval_date' => '2014-05-15',
			'qual_eval_date' => '2014-05-15',
			'created' => '2014-05-15 09:28:15',
			'modified' => '2014-05-15 09:28:15'
		),
	);

}
