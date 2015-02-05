<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Observation'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($observation['Observation']['id']); ?></dd>

				<dt><h4><?php echo __('Package Status'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($observation['PackageStatus']['name'], 
					array('controller' => 'package_statuses', 'action' => 'view', $observation['PackageStatus']['id'])); ?></dd>
				<dt><h4><?php echo __('Packages'); ?></h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link(
											$observation['Observation']['package'], 
											array('controller' => 'packages', 'action' => 'view', $packageId[$observation['Observation']['id']]['Packages']['id'])); ?></dd>

				<dt><h4><?php echo __('Title'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($observation['Observation']['title']); ?></dd>

				<dt><h4><?php echo __('Bc'); ?></h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link(
											$observation['Observation']['bc'], 
											array('controller' => 'employees', 'action' => 'view', $employeeId[$observation['Observation']['id']]['Employees']['id'])); ?></dd>

				<dt><h4><?php echo __('Observation'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($observation['Observation']['observation']); ?></dd>

				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($observation['Observation']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($observation['Observation']['modified']); ?></dd>

			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Observation'), 
		array('action' => 'edit',	$observation['Observation']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Observation'), 
		array('action' => 'delete', $observation['Observation']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Observations'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Observation'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Package Statuses'), 
						array('controller' => 'package_statuses', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Package Status'), 
						array('controller' => 'package_statuses', 'action' => 'add'), 'icon-plus'); ?></li>
<?php $this->end(); ?>

<!-- Relationships -->


