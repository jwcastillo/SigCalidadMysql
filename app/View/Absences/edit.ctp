<?php echo $this->element('form_scripts'); ?>

<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;
				<?php echo __('Edit Absence'); ?>
			</h2>
		</div>
		<div class="box-content">
			<?php echo $this->Form->create('Absence', array('class' => 'form-horizontal')); ?>
			<?php $this->Form->inputDefaults($this->Charisma->getInputDefaults()); ?>
				<fieldset>
					<?php
						echo $this->Form->input('id');
						echo $this->Form->input('employee_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('absence_type_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('description', $this->Charisma->getTextAreaOptions());
						echo $this->Form->input('departure_date', $this->Charisma->getDateOptions());
						echo $this->Form->input('arrival_date', $this->Charisma->getDateOptions());
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
		array('action' => 'delete', $this->Form->value('Absence.id')), 
		'icon-trash'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
		__('List Absences'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo  __('Related') ?></li>
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
				__('List Absence Types'), 
				array('controller' => 'absence_types', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Absence Type'), 
				array('controller' => 'absence_types', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<?php $this->end(); ?>
