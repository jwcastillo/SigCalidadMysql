<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Absence'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($absence['Absence']['id']); ?></dd>

				<dt><h4><?php echo __('Employee'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($absence['Employee']['name'], 
					array('controller' => 'employees', 'action' => 'view', $absence['Employee']['id'])); ?></dd>
				<dt><h4><?php echo __('Absence Type'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($absence['AbsenceType']['name'], 
					array('controller' => 'absence_types', 'action' => 'view', $absence['AbsenceType']['id'])); ?></dd>
				<dt><h4><?php echo __('Description'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($absence['Absence']['description']); ?></dd>

				<dt><h4><?php echo __('Departure Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($absence['Absence']['departure_date']); ?></dd>

				<dt><h4><?php echo __('Arrival Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($absence['Absence']['arrival_date']); ?></dd>

				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($absence['Absence']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($absence['Absence']['modified']); ?></dd>

			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Absence'), 
		array('action' => 'edit',	$absence['Absence']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Absence'), 
		array('action' => 'delete', $absence['Absence']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Absences'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Absence'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Employees'), 
						array('controller' => 'employees', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Employee'), 
						array('controller' => 'employees', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Absence Types'), 
						array('controller' => 'absence_types', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Absence Type'), 
						array('controller' => 'absence_types', 'action' => 'add'), 'icon-plus'); ?></li>
<?php $this->end(); ?>

<!-- Relationships -->


