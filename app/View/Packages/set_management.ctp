<?php echo $this->element('form_scripts'); ?>

<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">

	<div class="box span6">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;<?php echo __('Set Management'); ?></h2>
		</div>
	<div class="box-content">
		<?php echo $this->Form->create('Package', array('class' => 'form-horizontal')); ?>
		<?php $this->Form->inputDefaults($this->Charisma->getInputDefaults()); ?>
			<fieldset>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('number_package', array('type' => 'hidden')); 
					echo $this->Form->input('management_id', $this->Charisma->getSelectOptions()); 
				?>
			  <div class="form-actions">
					<?php echo $this->Charisma->button(__('Save'), 'submit'); ?>
					<?php echo $this->Charisma->button(__('Cancel'), 'reset', 'btn'); ?>
			  </div>
			</fieldset>
		<?php echo $this->Form->end(); ?>
		</div>
	</div>

	<div class="box span6">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;<?php echo __('Pakage'); ?></h2>
		</div>
		<div class="box-content">
			<dl class="view">

				<dt><h4><?php echo __('Number Package'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['number_package']); ?></dd>

				<dt><h4><?php echo __('Module'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['Module']['name'], 
				array('controller' => 'modules', 'action' => 'view', $package['Module']['id'])); ?></dd>

				<dt><h4><?php echo __('Package Status'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['PackageStatus']['name'], 
				array('controller' => 'package_statuses', 'action' => 'view', $package['PackageStatus']['id'])); ?></dd>

				<dt><h4><?php echo __('Entry Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['entry_date']); ?></dd>

				<dt><h4><?php echo __('Type'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['type']); ?></dd>

				<dt><h4><?php echo __('Technical Lead'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['analyst']); ?></dd>

				<dt><h4><?php echo __('Applicant'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['applicant']); ?></dd>

				<dt><h4><?php echo __('Components'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['components']); ?></dd>

				<dt><h4><?php echo __('Components Amount'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['components_amount']); ?></dd>

				<dt><h4><?php echo __('Current State'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['current_stage']); ?></dd>

			</dl>
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
				__('List Complexities'), 
				array('controller' => 'complexities', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Complexity'), 
				array('controller' => 'complexities', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Project Classes'), 
				array('controller' => 'project_classes', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Project Class'), 
				array('controller' => 'project_classes', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Package Classes'), 
				array('controller' => 'package_classes', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Package Class'), 
				array('controller' => 'package_classes', 'action' => 'add'), 
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
<?php $this->end(); ?>
