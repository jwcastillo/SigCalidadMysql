
<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>&nbsp;<?php echo __('Packages'); ?></h2>
		</div>
		<div class="box-content">
			<table id="packages" class="table table-striped table-bordered table-condensed">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('number_package', __('Number')); ?></th>
						<th><?php echo $this->Paginator->sort('module_id'); ?></th>
						<th><?php echo $this->Paginator->sort('employee_id'); ?></th>
						<th><?php echo $this->Paginator->sort('package_status_id', __('Status')); ?></th>
						<th><?php echo $this->Paginator->sort('rfc_id'); ?></th>
						<th><?php echo $this->Paginator->sort('entry_date', __('Arrived')); ?></th>
						<th><?php echo $this->Paginator->sort('type'); ?></th>
						<!--<th><?php echo $this->Paginator->sort('start_date', __('Start')); ?></th>
						<th><?php echo $this->Paginator->sort('end_date', __('End')); ?></th>
						<th><?php echo $this->Paginator->sort('replanning_date', __('Replanning')); ?></th>-->
						<!--<th><?php echo $this->Paginator->sort('evaluation_stage_id', __('Evaluation')); ?></th>-->
						<th><?php echo $this->Paginator->sort('current_stage', __('Stage')); ?></th>
						<th><?php echo $this->Paginator->sort('management_id'); ?></th>
						<th class="actions"><?php echo __('Actions'); ?></th>
					</tr>
				</thead>	
				<tbody>
					<?php foreach ($packages as $package): ?>
					<tr>
						<!--<td><?php echo h($package['Package']['number_package']); ?>&nbsp;</td>-->
						<td><?php echo $this->Html->link(
											h($package['Package']['number_package']), 
											array('action' => 'view', $package['Package']['id']), 
											array('class' => 'ajax-view')); ?></td>
						<td><?php echo $this->Html->link(
											$package['Module']['name'], 
											array('controller' => 'modules', 'action' => 'view', 
											$package['Module']['id'])); ?></td>
						<td><?php echo $this->Html->link(
											$package['Employee']['name'], 
											array('controller' => 'employees', 'action' => 'view', 
											$package['Employee']['id'])); ?></td>
						<td><?php echo $this->Html->link(
											$package['PackageStatus']['name'], 
											array('controller' => 'package_statuses', 'action' => 'view', 
											$package['PackageStatus']['id'])); ?></td>
						<td><?php echo $this->Html->link(
											$package['Rfc']['name'], 
											array('controller' => 'rfcs', 'action' => 'view', 
											$package['Rfc']['id'])); ?></td>
						<td><?php echo h($package['Package']['entry_date']); ?>&nbsp;</td>
						<td><?php echo h($package['Package']['type']); ?>&nbsp;</td>
						<!--<td><?php echo h($package['Package']['start_date']); ?>&nbsp;</td>
						<td><?php echo h($package['Package']['end_date']); ?>&nbsp;</td>
						<td><?php echo h($package['Package']['replanning_date']); ?>&nbsp;</td>-->
						<!--<td><?php echo $this->Html->link(
											$package['EvaluationState']['name'], 
											array('controller' => 'evaluation_states', 'action' => 'view', 
											$package['EvaluationState']['id'])); ?></td>-->
						<td><?php echo h($package['Package']['current_stage']); ?>&nbsp;</td>
						<td><?php echo $this->Html->link(
											$package['Management']['name'], 
											array('controller' => 'managements', 'action' => 'view', 
											$package['Management']['id'])); ?></td>
						<td class="actions center">
							<?php echo $this->Charisma->iconButton(__('Set Management'), 
								array('action' => 'setManagement', $package['Package']['id']),
								'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>

							<?php echo $this->Charisma->iconButton(__('Set Especialist'), 
								array('action' => 'setEspecialist', $package['Package']['id']), 
								'icon-edit icon-white', 'btn btn-small btn-info'); ?>

							<?php echo $this->Charisma->iconButton(__('Replanning'), 
								array('action' => 'replan', $package['Package']['id']), 
								'icon-calendar icon-white', 'btn btn-small btn-warning'); ?>

							<?php echo $this->Charisma->iconButton(__('Change Status'), 
								array('action' => 'changeStatus', $package['Package']['id']), 
								'icon-certificate icon-white', 'btn btn-small btn-primary'); ?>

							<?php echo $this->Charisma->iconButton(__('Set Quality Values'), 
								array('action' => 'setQualityValues', $package['Package']['id']), 
								'icon-fire icon-white', 'btn btn-small btn-inverse'); ?>
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

<li><?php echo $this->Charisma->iconLink(__('New Package'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Modules'), 
				array('controller' => 'modules', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Module'), 
				array('controller' => 'modules', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
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
				__('List Package Statuses'), 
				array('controller' => 'package_statuses', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Package Status'), 
				array('controller' => 'package_statuses', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Rfcs'), 
				array('controller' => 'rfcs', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Rfc'), 
				array('controller' => 'rfcs', 'action' => 'add'), 
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
				__('List Unsatisfactory Qualities'), 
				array('controller' => 'unsatisfactory_qualities', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Unsatisfactory Quality'), 
				array('controller' => 'unsatisfactory_qualities', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Unsatisfactory Productions'), 
				array('controller' => 'unsatisfactory_productions', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Unsatisfactory Production'), 
				array('controller' => 'unsatisfactory_productions', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Respondents'), 
				array('controller' => 'respondents', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Respondent'), 
				array('controller' => 'respondents', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Evaluation States'), 
				array('controller' => 'evaluation_states', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Evaluation State'), 
				array('controller' => 'evaluation_states', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Final Statuses'), 
				array('controller' => 'final_statuses', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Final Status'), 
				array('controller' => 'final_statuses', 'action' => 'add'), 
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
<?php $this->end(); ?>

<?php echo $this->element('packages/package_detail_ajax'); ?>
