<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Position'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($position['Position']['id']); ?></dd>

				<dt><h4><?php echo __('Name'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($position['Position']['name']); ?></dd>

				<dt><h4><?php echo __('Mission'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($position['Position']['mission']); ?></dd>

				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($position['Position']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($position['Position']['modified']); ?></dd>

			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Position'), 
		array('action' => 'edit',	$position['Position']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Position'), 
		array('action' => 'delete', $position['Position']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Positions'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Position'), 
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


<!-- Has many -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Related Employees'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($position['Employee'])): ?>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th><?php echo __('Id'); ?></th>
							<th><?php echo __('Bc'); ?></th>
							<th><?php echo __('Name'); ?></th>
							<th><?php echo __('Lastname'); ?></th>
							<th><?php echo __('Type'); ?></th>
							<th><?php echo __('Active'); ?></th>
							<th><?php echo __('Company'); ?></th>
							<th><?php echo __('Email'); ?></th>

							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($position['Employee'] as $employee): ?>
					<tr>
						<td><?php echo $employee['id']; ?></td>
						<td><?php echo $employee['bc']; ?></td>
						<td><?php echo $employee['name']; ?></td>
						<td><?php echo $employee['lastname']; ?></td>
						<td><?php echo $employee['type']; ?></td>
						<td><?php echo $employee['active']; ?></td>
						<td><?php echo $employee['company']; ?></td>
						<td><?php echo $employee['email']; ?></td>

						<td class="actions center">
							<?php echo $this->Charisma->iconButton(__('View'), 
										array('controller' => 'employees', 
										'action' => 'view', $employee['id']), 
										'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>
							<?php echo $this->Charisma->iconButton(__('Edit'),
										array('controller' => 'employees', 'action' => 
											'edit', $employee['id']),
										'icon-edit icon-white', 'btn btn-small btn-info'); ?>
							<?php echo $this->Charisma->deleteButton(__('Delete'), 
										array('controller' => 'employees', 'action' => 'delete', 
										$employee['id']), 
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
