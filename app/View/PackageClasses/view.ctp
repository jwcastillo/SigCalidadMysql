<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Package Class'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($packageClass['PackageClass']['id']); ?></dd>

				<dt><h4><?php echo __('Name'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($packageClass['PackageClass']['name']); ?></dd>

				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($packageClass['PackageClass']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($packageClass['PackageClass']['modified']); ?></dd>

			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Package Class'), 
		array('action' => 'edit',	$packageClass['PackageClass']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Package Class'), 
		array('action' => 'delete', $packageClass['PackageClass']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Package Classes'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Package Class'), 
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
<?php $this->end(); ?>

<!-- Relationships -->


<!-- Has many -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Related Rfcs'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($packageClass['Rfc'])): ?>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th><?php echo __('Id'); ?></th>
							<th><?php echo __('Name'); ?></th>
							<th><?php echo __('Description'); ?></th>
							<th><?php echo __('Planning Manager Id'); ?></th>
							<th><?php echo __('Project Manager Id'); ?></th>
							<th><?php echo __('Development Manager Id'); ?></th>
							<th><?php echo __('Project Class Id'); ?></th>
							<th><?php echo __('Package Class Id'); ?></th>
							<th><?php echo __('Complexity Id'); ?></th>
							<th><?php echo __('Weighting'); ?></th>
							<th><?php echo __('Remaining'); ?></th>
							<th><?php echo __('Closed'); ?></th>
							<th><?php echo __('Created'); ?></th>
							<th><?php echo __('Modified'); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($packageClass['Rfc'] as $rfc): ?>
					<tr>
						<td><?php echo $rfc['id']; ?></td>
						<td><?php echo $rfc['name']; ?></td>
						<td><?php echo $rfc['description']; ?></td>
						<td><?php echo $rfc['planning_manager_id']; ?></td>
						<td><?php echo $rfc['project_manager_id']; ?></td>
						<td><?php echo $rfc['development_manager_id']; ?></td>
						<td><?php echo $rfc['project_class_id']; ?></td>
						<td><?php echo $rfc['package_class_id']; ?></td>
						<td><?php echo $rfc['complexity_id']; ?></td>
						<td><?php echo $rfc['weighting']; ?></td>
						<td><?php echo $rfc['remaining']; ?></td>
						<td><?php echo $rfc['closed']; ?></td>
						<td><?php echo $rfc['created']; ?></td>
						<td><?php echo $rfc['modified']; ?></td>
						<td class="actions center">
							<?php echo $this->Charisma->iconButton(__('View'), 
										array('controller' => 'rfcs', 
										'action' => 'view', $rfc['id']), 
										'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>
							<?php echo $this->Charisma->iconButton(__('Edit'),
										array('controller' => 'rfcs', 'action' => 
											'edit', $rfc['id']),
										'icon-edit icon-white', 'btn btn-small btn-info'); ?>
							<?php echo $this->Charisma->deleteButton(__('Delete'), 
										array('controller' => 'rfcs', 'action' => 'delete', 
										$rfc['id']), 
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
