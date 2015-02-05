<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Quality Manager'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($qualityManager['QualityManager']['id']); ?></dd>

				<dt><h4><?php echo __('Employee'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($qualityManager['Employee']['fullname'], 
					array('controller' => 'employees', 'action' => 'view', $qualityManager['Employee']['id'])); ?></dd>
				<dt><h4><?php echo __('Management'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($qualityManager['Management']['name'], 
					array('controller' => 'managements', 'action' => 'view', $qualityManager['Management']['id'])); ?></dd>
				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($qualityManager['QualityManager']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($qualityManager['QualityManager']['modified']); ?></dd>

			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Quality Manager'), 
		array('action' => 'edit',	$qualityManager['QualityManager']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Quality Manager'), 
		array('action' => 'delete', $qualityManager['QualityManager']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Quality Managers'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Quality Manager'), 
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
		<li><?php echo $this->Charisma->iconLink(__('List Managements'), 
						array('controller' => 'managements', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Management'), 
						array('controller' => 'managements', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Tasks'), 
						array('controller' => 'tasks', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Task'), 
						array('controller' => 'tasks', 'action' => 'add'), 'icon-plus'); ?></li>
<?php $this->end(); ?>

<!-- Relationships -->


<!-- Has many -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Related Tasks'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($qualityManager['Task'])): ?>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th><?php echo __('Id'); ?></th>
							<th><?php echo __('Employee Id'); ?></th>
							<th><?php echo __('Quality Manager Id'); ?></th>
							<th><?php echo __('Title'); ?></th>
							<th><?php echo __('Sumary'); ?></th>
							<th><?php echo __('Status'); ?></th>
							<th><?php echo __('Observation'); ?></th>
							<th><?php echo __('Created'); ?></th>
							<th><?php echo __('Modified'); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($qualityManager['Task'] as $task): ?>
					<tr>
						<td><?php echo $task['id']; ?></td>
						<td><?php echo $task['employee_id']; ?></td>
						<td><?php echo $task['quality_manager_id']; ?></td>
						<td><?php echo $task['title']; ?></td>
						<td><?php echo $task['sumary']; ?></td>
						<td><?php echo $task['status']; ?></td>
						<td><?php echo $task['observation']; ?></td>
						<td><?php echo $task['created']; ?></td>
						<td><?php echo $task['modified']; ?></td>
						<td class="actions center">
							<?php echo $this->Charisma->iconButton(__('View'), 
										array('controller' => 'tasks', 
										'action' => 'view', $task['id']), 
										'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>
							<?php echo $this->Charisma->iconButton(__('Edit'),
										array('controller' => 'tasks', 'action' => 
											'edit', $task['id']),
										'icon-edit icon-white', 'btn btn-small btn-info'); ?>
							<?php echo $this->Charisma->deleteButton(__('Delete'), 
										array('controller' => 'tasks', 'action' => 'delete', 
										$task['id']), 
										'icon-trash icon-white', 'btn btn-small btn-danger'); ?>
						</td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
