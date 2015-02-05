<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>&nbsp;<?php echo __('Observations'); ?></h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('package_status_id'); ?></th>
						<th><?php echo $this->Paginator->sort('package'); ?></th>
						<th><?php echo $this->Paginator->sort('title'); ?></th>
						<th><?php echo $this->Paginator->sort('bc'); ?></th>
						<th><?php echo $this->Paginator->sort('observation'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
				</thead>	
				<tbody>
					<?php foreach ($observations as $observation): ?>
					<tr>
						<td><?php echo h($observation['Observation']['id']); ?>&nbsp;</td>
						<td><?php echo $this->Html->link(
											$observation['PackageStatus']['name'], 
											array('controller' => 'package_statuses', 'action' => 'view', 
											$observation['PackageStatus']['id'])); ?></td>
						<td><?php 

						if(isset($packageId[$observation['Observation']['id']]['Packages']['id'])){
													echo $this->Html->link(
											$observation['Observation']['package'], 
											array('controller' => 'packages', 'action' => 'view', $packageId[$observation['Observation']['id']]['Packages']['id']));}else{
echo h($observation['Observation']['package']);
											
										} ?></td>
						<td><?php echo h($observation['Observation']['title']); ?>&nbsp;</td>
						<td><?php 

						if(isset($employeeId[$observation['Observation']['id']]['Employees']['id'])){
													echo $this->Html->link(
											$observation['Observation']['bc'], 
						array('controller' => 'employees', 'action' => 'view', $employeeId[$observation['Observation']['id']]['Employees']['id']));}else{
echo h($observation['Observation']['bc']);
											
										} ?></td>
						<td><?php echo h($observation['Observation']['observation']); ?>&nbsp;</td>
						<td><?php echo h($observation['Observation']['created']); ?>&nbsp;</td>
						<td><?php echo h($observation['Observation']['modified']); ?>&nbsp;</td>
						<td class="actions center">
							<?php echo $this->Charisma->iconButton(__('View'), 
								array('action' => 'view', $observation['Observation']['id']), 
								'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>
							<?php echo $this->Charisma->iconButton(__('Edit'),
								array('action' => 'edit', $observation['Observation']['id']), 
								'icon-edit icon-white', 'btn btn-small btn-info'); ?>
							<?php echo $this->Charisma->deleteButton(__('Delete'), 
								array('action' => 'delete', $observation['Observation']['id']), 
								'icon-trash icon-white', 'btn btn-small btn-danger'); ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<div class="pagination pagination-centered">
			 <ul>
			 <?php
					echo $this->Paginator->prev(__('Prev'), 
				 	array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'prev disabled'));
					echo $this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 
				 	'currentClass'=> 'active', 'separator' => ''));
					echo $this->Paginator->next(__('Next'), 
				 	array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'next disabled'));
				?>
			 </ul>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<?php echo $this->Paginator->counter(__(
						'Page {:page} of {:pages}, showing {:current} records out of
						{:count} total, starting on record {:start}, ending on {:end}')); ?>
				</div>
				<div class="span12 center"></div>
			</div>
		</div>
	</div><!--/span-->
</div><!--/row-->

<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('New Observation'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Package Statuses'), 
				array('controller' => 'package_statuses', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Package Status'), 
				array('controller' => 'package_statuses', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<?php $this->end(); ?>
