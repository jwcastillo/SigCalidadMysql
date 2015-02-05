<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>&nbsp;<?php echo __('Quality Managers'); ?></h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('employee_id'); ?></th>
						<th><?php echo $this->Paginator->sort('management_id'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
				</thead>	
				<tbody>
					<?php foreach ($qualityManagers as $qualityManager): ?>
					<tr>
						<td><?php echo h($qualityManager['QualityManager']['id']); ?>&nbsp;</td>
						<td><?php echo $this->Html->link(
											$qualityManager['Employee']['fullname'], 
											array('controller' => 'employees', 'action' => 'view', 
											$qualityManager['Employee']['id'])); ?></td>
						<td><?php echo $this->Html->link(
											$qualityManager['Management']['name'], 
											array('controller' => 'managements', 'action' => 'view', 
											$qualityManager['Management']['id'])); ?></td>
						<td><?php echo h($qualityManager['QualityManager']['created']); ?>&nbsp;</td>
						<td><?php echo h($qualityManager['QualityManager']['modified']); ?>&nbsp;</td>
						<td class="actions center">
							<?php echo $this->Charisma->iconButton(__('View'), 
								array('action' => 'view', $qualityManager['QualityManager']['id']), 
								'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>
							<?php echo $this->Charisma->iconButton(__('Edit'),
								array('action' => 'edit', $qualityManager['QualityManager']['id']), 
								'icon-edit icon-white', 'btn btn-small btn-info'); ?>
							<?php echo $this->Charisma->deleteButton(__('Delete'), 
								array('action' => 'delete', $qualityManager['QualityManager']['id']), 
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

<li><?php echo $this->Charisma->iconLink(__('New Quality Manager'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Employees'), 
				array('controller' => 'employees', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Employee'), 
				array('controller' => 'employees', 'action' => 'add'), 
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
				__('List Tasks'), 
				array('controller' => 'tasks', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Task'), 
				array('controller' => 'tasks', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<?php $this->end(); ?>
