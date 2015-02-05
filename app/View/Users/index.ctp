<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>&nbsp;<?php echo __('Users'); ?></h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered table-condensed">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('username', __('User')); ?></th>
						<th><?php echo $this->Paginator->sort('firstname'); ?></th>
						<th><?php echo $this->Paginator->sort('lastname'); ?></th>
						<th><?php echo $this->Paginator->sort('email'); ?></th>
						<th><?php echo $this->Paginator->sort('department'); ?></th>
						<th><?php echo $this->Paginator->sort('group_id'); ?></th>

						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
				</thead>	
				<tbody>
					<?php foreach ($users as $user): ?>
					<tr>
						<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['firstname']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['lastname']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
						<td><?php echo h($user['User']['department']); ?>&nbsp;</td>
						<td><?php echo $this->Html->link(
											$user['Group']['name'], 
											array('controller' => 'groups', 'action' => 'view', 
											$user['Group']['id'])); ?></td>
						<td class="actions center">
							<?php echo $this->Charisma->iconButton(__('View'), 
								array('action' => 'view', $user['User']['id']), 
								'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>
							<?php echo $this->Charisma->iconButton(__('Edit'),
								array('action' => 'edit', $user['User']['id']), 
								'icon-edit icon-white', 'btn btn-small btn-info'); ?>
							<?php echo $this->Charisma->deleteButton(__('Delete'), 
								array('action' => 'delete', $user['User']['id']), 
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
						{:count} total, starting on record {:start}, ending on {:end}'
					)); ?>
				</div>
		</div>
	</div><!--/span-->
</div><!--/row-->

<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('New User'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Groups'), 
				array('controller' => 'groups', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Group'), 
				array('controller' => 'groups', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<?php $this->end(); ?>

