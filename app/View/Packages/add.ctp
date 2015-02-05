<?php echo $this->element('form_scripts'); ?>

<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;
				<?php echo __('Add Package'); ?>
			</h2>
		</div>
		<div class="box-content">
			<?php echo $this->Form->create('Package', array('class' => 'form-horizontal')); ?>
			<?php $this->Form->inputDefaults($this->Charisma->getInputDefaults()); ?>
				<fieldset>
					<?php
						echo $this->Form->input('number_package');
						echo $this->Form->input('module_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('employee_id', $this->Charisma->getSelectOptionsLabel( __('QA Lead') ));
						echo $this->Form->input('package_status_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('rfc_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('entry_date', $this->Charisma->getDateOptions());
						echo $this->Form->input('management_entry_date', $this->Charisma->getDateOptions());
						echo $this->Form->input('assignment_date', $this->Charisma->getDateOptions());
						echo $this->Form->input('type');
						echo $this->Form->input('analyst', $this->Charisma->getInputDefaultsLabel( __('Technical Lead') ));
						echo $this->Form->input('applicant');
						echo $this->Form->input('components');
						echo $this->Form->input('components_amount');
						echo $this->Form->input('start_date', $this->Charisma->getDateOptions());
						echo $this->Form->input('end_date', $this->Charisma->getDateOptions());
						echo $this->Form->input('replanning_date', $this->Charisma->getDateOptions());
						echo $this->Form->input('certified_date', $this->Charisma->getDateOptions());
						//echo $this->Form->input('observations', $this->Charisma->getTextAreaOptions());
						echo $this->Form->input('overfulfillment_effectiveness');
						echo $this->Form->input('deviation_effectiveness');
						echo $this->Form->input('overfulfillment_quality');
						echo $this->Form->input('deviation_quality');
						echo $this->Form->input('weighting');
						echo $this->Form->input('final_weighting');
						echo $this->Form->input('effectiveness_evaluation');
						echo $this->Form->input('quality_assessment');
						echo $this->Form->input('replanning');
						echo $this->Form->input('replanning_days');
						echo $this->Form->input('trial_days');
						echo $this->Form->input('certification_days');
						echo $this->Form->input('ttc');
						echo $this->Form->input('ttp');
						echo $this->Form->input('manager');
						echo $this->Form->input('unsatisfactory_production_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('respondent_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('evaluation_state_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('current_stage');
						echo $this->Form->input('final_status_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('management_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('packages_postimplantation');
						echo $this->Form->input('auto_assign');
						echo $this->Form->input('UnsatisfactoryQuality', $this->Charisma->getSelectOptions());
					?>
				  <div class="form-actions">
						<?php echo $this->Charisma->button(__('Save'), 'submit'); ?>
						<?php echo $this->Charisma->button(__('Cancel'), 'reset', 'btn'); ?>
				  </div>
				</fieldset>
			  <!--</form>-->
			<?php echo $this->Form->end(); ?>
		</div>
	</div><!--/span-->
</div><!--/row-->

<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->deleteLink(__('Delete'), 
		array('action' => 'delete', $this->Form->value('Package.id')), 
		'icon-trash'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
		__('List Packages'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo  __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Modules'), 
				array('controller' => 'modules', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Module'), 
				array('controller' => 'modules', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Employees'), 
				array('controller' => 'employees', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Employee'), 
				array('controller' => 'employees', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Package Statuses'), 
				array('controller' => 'package_statuses', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Package Status'), 
				array('controller' => 'package_statuses', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Rfcs'), 
				array('controller' => 'rfcs', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Rfc'), 
				array('controller' => 'rfcs', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Unsatisfactory Productions'), 
				array('controller' => 'unsatisfactory_productions', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Unsatisfactory Production'), 
				array('controller' => 'unsatisfactory_productions', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Respondents'), 
				array('controller' => 'respondents', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Respondent'), 
				array('controller' => 'respondents', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Evaluation States'), 
				array('controller' => 'evaluation_states', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Evaluation State'), 
				array('controller' => 'evaluation_states', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Final Statuses'), 
				array('controller' => 'final_statuses', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Final Status'), 
				array('controller' => 'final_statuses', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Managements'), 
				array('controller' => 'managements', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Management'), 
				array('controller' => 'managements', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Unsatisfactory Qualities'), 
				array('controller' => 'unsatisfactory_qualities', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Unsatisfactory Quality'), 
				array('controller' => 'unsatisfactory_qualities', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<?php $this->end(); ?>
