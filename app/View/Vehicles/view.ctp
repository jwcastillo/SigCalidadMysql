<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Vehicle'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($vehicle['Vehicle']['id']); ?></dd>

				<dt><h4><?php echo __('Model'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($vehicle['Vehicle']['model']); ?></dd>

				<dt><h4><?php echo __('Color'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($vehicle['Vehicle']['color']); ?></dd>

				<dt><h4><?php echo __('Plate'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($vehicle['Vehicle']['plate']); ?></dd>

				<dt><h4><?php echo __('Employee'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($vehicle['Employee']['name'], 
					array('controller' => 'employees', 'action' => 'view', $vehicle['Employee']['id'])); ?></dd>
				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($vehicle['Vehicle']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($vehicle['Vehicle']['modified']); ?></dd>

			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Vehicle'), 
		array('action' => 'edit',	$vehicle['Vehicle']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Vehicle'), 
		array('action' => 'delete', $vehicle['Vehicle']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Vehicles'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Vehicle'), 
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
<?php $this->end(); ?>

<!-- Relationships -->


