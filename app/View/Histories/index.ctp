<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>&nbsp;<?php echo __('Histories'); ?></h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('Id'); ?></th>
						<th><?php echo $this->Paginator->sort('number_package'); ?></th>
						<th><?php echo $this->Paginator->sort('stage_name'); ?></th>
						<th><?php echo $this->Paginator->sort('change_date'); ?></th>
						<th><?php echo $this->Paginator->sort('bc'); ?></th>
						<th><?php echo $this->Paginator->sort('action'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
				</thead>	
				<tbody>
					<?php foreach ($histories as $history): ?>
					<tr>
						<td><?php echo h($history['History']['id']); ?>&nbsp;</td>
						<td><?php echo $this->Html->link(
											$history['History']['number_package'], 
											array('controller' => 'packages', 'action' => 'view', $packageId[$history['History']['id']]['Packages']['id'])); ?></td>
						<td><?php echo h($history['History']['stage_name']); ?>&nbsp;</td>
						<td><?php echo h($history['History']['change_date']); ?>&nbsp;</td>
						<td><?php echo h($history['History']['bc']); ?>&nbsp;</td>
						<td><?php echo h($history['History']['action']); ?>&nbsp;</td>
						<td><?php echo h($history['History']['created']); ?>&nbsp;</td>
						<td><?php echo h($history['History']['modified']); ?>&nbsp;</td>
						<td class="actions center">
							<?php echo $this->Charisma->iconButton(__('View'), 
								array('action' => 'view', $history['History']['id']), 
								'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>
							<?php echo $this->Charisma->iconButton(__('Edit'),
								array('action' => 'edit', $history['History']['id']), 
								'icon-edit icon-white', 'btn btn-small btn-info'); ?>
							<?php echo $this->Charisma->deleteButton(__('Delete'), 
								array('action' => 'delete', $history['History']['id']), 
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

<li><?php echo $this->Charisma->iconLink(__('New History'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
<?php $this->end(); ?>
