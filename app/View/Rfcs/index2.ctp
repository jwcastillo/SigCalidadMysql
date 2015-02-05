<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>&nbsp;<?php echo __('Rfcs'); ?></h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('name'); ?></th>
						<th><?php echo $this->Paginator->sort('planning_manager_id'); ?></th>
						<th><?php echo $this->Paginator->sort('project_manager_id'); ?></th>
						<th><?php echo $this->Paginator->sort('development_manager_id'); ?></th>
						<th><?php echo $this->Paginator->sort('project_class_id'); ?></th>
						<th><?php echo $this->Paginator->sort('package_class_id'); ?></th>
						<th><?php echo $this->Paginator->sort('complexity_id'); ?></th>
						<th><?php echo $this->Paginator->sort('weighting'); ?></th>

			
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
				</thead>	
				<tbody>
					<?php foreach ($rfcs as $rfc): ?>
					<tr>
						<td><?php echo h($rfc['Rfc']['id']); ?>&nbsp;</td>
						<td><?php echo h($rfc['Rfc']['name']); ?>&nbsp;</td>
						<td><?php echo $this->Html->link(
											$rfc['PlanningManager']['name'], 
											array('controller' => 'planning_managers', 'action' => 'view', 
											$rfc['PlanningManager']['id'])); ?></td>
						<td><?php echo $this->Html->link(
											$rfc['ProjectManager']['name'], 
											array('controller' => 'project_managers', 'action' => 'view', 
											$rfc['ProjectManager']['id'])); ?></td>
						<td><?php echo $this->Html->link(
											$rfc['DevelopmentManager']['name'], 
											array('controller' => 'development_managers', 'action' => 'view', 
											$rfc['DevelopmentManager']['id'])); ?></td>
						<td><?php echo $this->Html->link(
											$rfc['ProjectClass']['name'], 
											array('controller' => 'project_classes', 'action' => 'view', 
											$rfc['ProjectClass']['id'])); ?></td>
						<td><?php echo $this->Html->link(
											$rfc['PackageClass']['name'], 
											array('controller' => 'package_classes', 'action' => 'view', 
											$rfc['PackageClass']['id'])); ?></td>
						<td><?php echo $this->Html->link(
											$rfc['Complexity']['name'], 
											array('controller' => 'complexities', 'action' => 'view', 
											$rfc['Complexity']['id'])); ?></td>
						<td><?php echo h($rfc['Rfc']['weighting']); ?>&nbsp;</td>

						<td class="actions center">
							<?php echo $this->Charisma->iconButton(__('View'), 
								array('action' => 'view', $rfc['Rfc']['id']), 
								'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>
							<?php echo $this->Charisma->iconButton(__('Edit'),
								array('action' => 'edit', $rfc['Rfc']['id']), 
								'icon-edit icon-white', 'btn btn-small btn-info'); ?>
							<?php echo $this->Charisma->deleteButton(__('Delete'), 
								array('action' => 'delete', $rfc['Rfc']['id']), 
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

<li><?php echo $this->Charisma->iconLink(__('New Rfc'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Planning Managers'), 
				array('controller' => 'planning_managers', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Planning Manager'), 
				array('controller' => 'planning_managers', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Project Managers'), 
				array('controller' => 'project_managers', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Project Manager'), 
				array('controller' => 'project_managers', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Development Managers'), 
				array('controller' => 'development_managers', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Development Manager'), 
				array('controller' => 'development_managers', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Project Classes'), 
				array('controller' => 'project_classes', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Project Class'), 
				array('controller' => 'project_classes', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Package Classes'), 
				array('controller' => 'package_classes', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Package Class'), 
				array('controller' => 'package_classes', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Complexities'), 
				array('controller' => 'complexities', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Complexity'), 
				array('controller' => 'complexities', 'action' => 'add'), 
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
<?php $this->end(); ?>