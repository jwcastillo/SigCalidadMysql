<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Unsatisfactory Status'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($unsatisfactoryStatus['UnsatisfactoryStatus']['id']); ?></dd>

				<dt><h4><?php echo __('Type'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($unsatisfactoryStatus['UnsatisfactoryStatus']['type']); ?></dd>

				<dt><h4><?php echo __('Name'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($unsatisfactoryStatus['UnsatisfactoryStatus']['name']); ?></dd>

				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($unsatisfactoryStatus['UnsatisfactoryStatus']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($unsatisfactoryStatus['UnsatisfactoryStatus']['modified']); ?></dd>

			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Unsatisfactory Status'), 
		array('action' => 'edit',	$unsatisfactoryStatus['UnsatisfactoryStatus']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Unsatisfactory Status'), 
		array('action' => 'delete', $unsatisfactoryStatus['UnsatisfactoryStatus']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Unsatisfactory Statuses'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Unsatisfactory Status'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Packages'), 
						array('controller' => 'packages', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Package'), 
						array('controller' => 'packages', 'action' => 'add'), 'icon-plus'); ?></li>
<?php $this->end(); ?>

<!-- Relationships -->


<!-- Has many -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Related Packages'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($unsatisfactoryStatus['Package'])): ?>
				<table id="ajax-table" class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<!--<th><?php echo __('Id'); ?></th>-->
							<th><?php echo __('Number Package'); ?></th>
							<th><?php echo __('Module'); ?></th>
							<th><?php echo __('Rfc'); ?></th>
							<th><?php echo __('Entry Date'); ?></th>
							<th><?php echo __('Start Date'); ?></th>
							<th><?php echo __('End Date'); ?></th>
							<th><?php echo __('Certified Date'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($unsatisfactoryStatus['Package'] as $package): ?>
					<tr>
						<!--<td><?php echo $package['id']; ?></td>-->
						<td>
							<?php 
								echo $this->Html->link($package['number_package'],
									array('controller'=>'packages','action'=>'view', $package['id']),
									array('class' => 'ajax-view')
								);
							?>
						</td>
						<td><?php echo $package['Module']['name']; ?></td>
						<td><?php echo $package['Rfc']['name']; ?></td>
						<td><?php echo $package['entry_date']; ?></td>
						<td><?php echo $package['start_date']; ?></td>
						<td><?php echo $package['end_date']; ?></td>
						<td><?php echo $package['certified_date']; ?></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
