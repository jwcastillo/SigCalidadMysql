<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>&nbsp;<?php echo __('Employees'); ?></h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('bc'); ?></th>
						<th><?php echo $this->Paginator->sort('fullname'); ?></th>
						<th><?php echo $this->Paginator->sort('position_id'); ?></th>
						<th><?php echo $this->Paginator->sort('ci'); ?></th>
						<th><?php echo $this->Paginator->sort('management_id'); ?></th>
						<th><?php echo $this->Paginator->sort('type'); ?></th>
						<th><?php echo $this->Paginator->sort('active'); ?></th>
						<th><?php echo $this->Paginator->sort('company'); ?></th>
						<th><?php echo $this->Paginator->sort('email'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
				</thead>	
				<tbody>
					<?php foreach ($employees as $employee): ?>
					<tr>
						<td><?php echo h($employee['Employee']['id']); ?>&nbsp;</td>
						<td><?php echo h($employee['Employee']['bc']); ?>&nbsp;</td>
						<td><?php echo h($employee['Employee']['fullname']); ?>&nbsp;</td>
						<td><?php echo $this->Html->link(
											$employee['Position']['name'], 
											array('controller' => 'positions', 'action' => 'view', 
											$employee['Position']['id'])); ?></td>
						<td><?php echo h($employee['Employee']['ci']); ?>&nbsp;</td>
						<td><?php echo $this->Html->link(
											$employee['Management']['name'], 
											array('controller' => 'managements', 'action' => 'view', 
											$employee['Management']['id'])); ?></td>
						<td><?php echo h($employee['Employee']['type']); ?>&nbsp;</td>
						<td><?php echo h($employee['Employee']['active']); ?>&nbsp;</td>
						<td><?php echo h($employee['Employee']['company']); ?>&nbsp;</td>
						<td><?php echo h($employee['Employee']['email']); ?>&nbsp;</td>
						<td class="actions center">
							<?php echo $this->Charisma->iconButton(__('View'), 
								array('action' => 'view', $employee['Employee']['id']), 
								'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>
							<?php echo $this->Charisma->iconButton(__('Edit'),
								array('action' => 'edit', $employee['Employee']['id']), 
								'icon-edit icon-white', 'btn btn-small btn-info'); ?>
							<?php echo $this->Charisma->deleteButton(__('Delete'), 
								array('action' => 'delete', $employee['Employee']['id']), 
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

<li><?php echo $this->Charisma->iconLink(__('New Employee'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Positions'), 
				array('controller' => 'positions', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Position'), 
				array('controller' => 'positions', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Managements'), 
				array('controller' => 'managements', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Management'), 
				array('controller' => 'managements', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Absences'), 
				array('controller' => 'absences', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Absence'), 
				array('controller' => 'absences', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Evaluations'), 
				array('controller' => 'evaluations', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Evaluation'), 
				array('controller' => 'evaluations', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Packages'), 
				array('controller' => 'packages', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Package'), 
				array('controller' => 'packages', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Quality Managers'), 
				array('controller' => 'quality_managers', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Quality Manager'), 
				array('controller' => 'quality_managers', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Tasks'), 
				array('controller' => 'tasks', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Task'), 
				array('controller' => 'tasks', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Vehicles'), 
				array('controller' => 'vehicles', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Vehicle'), 
				array('controller' => 'vehicles', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<?php $this->end(); ?>
