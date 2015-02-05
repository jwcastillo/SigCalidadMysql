<?php echo $this->element('form_scripts'); ?>

<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;
				<?php echo __('Add Employee'); ?>
			</h2>
		</div>
		<div class="box-content">
			<?php echo $this->Form->create('Employee', array('type' => 'file', 'class' => 'form-horizontal')); ?>
			<?php $this->Form->inputDefaults($this->Charisma->getInputDefaults()); ?>
				<fieldset>
					<?php
						echo $this->Form->input('bc');
						echo $this->Form->input('name');
						echo $this->Form->input('lastname');
						echo $this->Form->input('position_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('ci');
						echo $this->Form->input('management_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('entry_date', $this->Charisma->getDateOptions());
						echo $this->Form->input('birthdate', $this->Charisma->getDateOptions());
						echo $this->Form->input('home_phone');
						echo $this->Form->input('work_phone');
						echo $this->Form->input('cell_phone');
						echo $this->Form->input('address');
						echo $this->Form->input('type');
						echo $this->Form->input('active');
						echo $this->Form->input('company');
						echo $this->Form->input('email');
						echo $this->Form->input('email_work');
						//echo $this->Form->input('image', array('type' => 'file'));
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
		array('action' => 'delete', $this->Form->value('Employee.id')), 
		'icon-trash'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
		__('List Employees'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo  __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Positions'), 
				array('controller' => 'positions', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Position'), 
				array('controller' => 'positions', 'action' => 'add'), 
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
				__('List Absences'), 
				array('controller' => 'absences', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Absence'), 
				array('controller' => 'absences', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Evaluations'), 
				array('controller' => 'evaluations', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Evaluation'), 
				array('controller' => 'evaluations', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Packages'), 
				array('controller' => 'packages', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Package'), 
				array('controller' => 'packages', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Quality Managers'), 
				array('controller' => 'quality_managers', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Quality Manager'), 
				array('controller' => 'quality_managers', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Tasks'), 
				array('controller' => 'tasks', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Task'), 
				array('controller' => 'tasks', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Vehicles'), 
				array('controller' => 'vehicles', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Vehicle'), 
				array('controller' => 'vehicles', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<?php $this->end(); ?>


<?php $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>
<!-- jQuery UI -->
<?php echo $this->Html->script('jquery-ui.min', array('once' => true)); ?>

<script type="text/javascript">
//<![CDATA[
	$(document).ready(function() {
		// Datepicker
		$("input#EmployeeBirthdate").datepicker( "destroy" ).datepicker({dateFormat : 'mm-dd'});

	});
//]]>
</script>
<?php $this->end(); ?>
