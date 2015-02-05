<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Assignment'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($assignment['Assignment']['id']); ?></dd>

				<dt><h4><?php echo __('Rfc'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($assignment['Rfc']['name'], 
					array('controller' => 'rfcs', 'action' => 'view', $assignment['Rfc']['id'])); ?></dd>
				<dt><h4><?php echo __('Management'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($assignment['Management']['name'], 
					array('controller' => 'managements', 'action' => 'view', $assignment['Management']['id'])); ?></dd>	
				<dt><h4><?php echo __('Employee'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($assignment['Employee']['fullname'], 
					array('controller' => 'employees', 'action' => 'view', $assignment['Employee']['id'])); ?></dd>
		


				<dt><h4><?php echo __('Start'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($assignment['Assignment']['start_date']); ?></dd>
				<dt><h4><?php echo __('End'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($assignment['Assignment']['end_date']); ?></dd>

				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($assignment['Assignment']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($assignment['Assignment']['modified']); ?></dd>

			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- <div class="row-fluid sortable">

<div class="box span12">
	<div data-original-title="" class="box-header well">
		<h2><i class="icon-tasks"></i>&nbsp;<?php echo __('Schedule'); ?></h2>
	</div>
	<div id="schedule" class="box-content">
	</div>
</div>
</div> -->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Assignment'), 
		array('action' => 'edit',	$assignment['Assignment']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Assignment'), 
		array('action' => 'delete', $assignment['Assignment']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Assignments'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Assignment'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Rfcs'), 
						array('controller' => 'rfcs', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Rfc'), 
						array('controller' => 'rfcs', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Employees'), 
						array('controller' => 'employees', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Employee'), 
						array('controller' => 'employees', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Managements'), 
						array('controller' => 'managements', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Management'), 
						array('controller' => 'managements', 'action' => 'add'), 'icon-plus'); ?></li>

<?php $this->end(); ?>



<!-- Relationships -->


