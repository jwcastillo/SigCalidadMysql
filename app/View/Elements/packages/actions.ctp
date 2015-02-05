<div class="form-actions">

<?php

	$unassignedEmployee = $this->Session->read('Options.unassignedEmployee');
	$unassignedManagement = $this->Session->read('Options.unassignedManagement');
	$certifiedStatus = $this->Session->read('Options.certifiedStatus');
	$current_employee_id = $this->Session->read('Auth.User.employeeId');
	$management = $package['Management']['id'];
	$employee = $package['Employee']['id'];

	$managers = $this->Session->read('Options.managers');

	/*if ($package['Package']['package_status_id'] != $certifiedStatus ) {*/
	if (in_array($this->Session->read('Auth.User.employeeId'), $managers) ) {

		if ($management == $unassignedManagement || $employee == $unassignedEmployee) {
			echo $this->Charisma->iconButton(__('Management'), 
				array('action' => 'setManagement', $package['Package']['id']),
				'icon-eye-open icon-white', 'btn btn-small btn-success') . '&nbsp;';

			if ($management != $unassignedManagement)
				echo $this->Charisma->iconButton(__('Especialist'), 
					array('action' => 'setEspecialist', $package['Package']['id']), 
					'icon-user icon-white', 'btn btn-small btn-info');
		} else {
			// FIXME: Does replanning be allowed after end date?

			if ($package['Package']['package_status_id'] != $certifiedStatus) {

				echo $this->Charisma->iconButton(__('Replan'), 
					array('action' => 'replan', $package['Package']['id']), 
					'icon-time icon-white', 'btn btn-small btn-warning');
			}
		} 

		if ( $package['Package']['package_status_id'] == $certifiedStatus  &&
			empty($package['Package']['effec_eval_date']) ) {

			echo $this->Charisma->iconButton(__('Evaluate'), 
				array('controller' => 'evaluations', 'action' => 'onDemandEval', $package['Package']['id']), 
				'icon-ok-circle icon-white', 'btn btn-small btn-danger');
		}

		if ($package['Package']['package_status_id'] == $certifiedStatus &&
			empty($package['Package']['qual_eval_date']) ) {

			echo $this->Charisma->iconButton(__('Quality'), 
			array('action' => 'setQualityValues', $package['Package']['id']), 
			'icon-flag icon-white', 'btn btn-small btn-inverse'); 
		}

		if ($package['Package']['package_status_id'] != $certifiedStatus &&
			empty($package['Package']['qual_eval_date']) ) {

			echo $this->Charisma->iconButton(__('Suspend'), 
			array('action' => 'suspend', $package['Package']['id']), 
			'icon-step-backward icon-white', 'btn btn-small btn-inverse'); 
		}

		if ($package['Package']['package_status_id'] != $certifiedStatus) {

			echo $this->Charisma->iconButton(__('Status'), 
				array('action' => 'changeStatus', $package['Package']['id']), 
				'icon-road icon-white', 'btn btn-small btn-primary');
		}

	} else {
		// Check wether or not the packege belongs to the current user
		if ($package['Package']['package_status_id'] != $certifiedStatus && $employee == $current_employee_id) {

			echo $this->Charisma->iconButton(__('Status'), 
				array('action' => 'changeStatus', $package['Package']['id']), 
				'icon-road icon-white', 'btn btn-small btn-primary');
		}

	}
	
?>
</div>