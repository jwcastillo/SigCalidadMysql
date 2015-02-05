<?php echo $this->element('form_scripts'); ?>

<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;
				<?php echo __('Retreive Evaluation'); ?>
			</h2>
		</div>
		<div class="box-content">
				<?php if (isset($evaluations)) { ?>
				<table class="table table-striped table-bordered">
					<thead>
						<th><?php echo __('QA Lead'); ?></th>
						<th><?php echo __('Management'); ?></th>
						<th><?php echo __('Effectiveness Evaluation'); ?></th>
						<th><?php echo __('Quality Assessment'); ?></th>
						<th><?php echo __('Month'); ?></th>
						<th><?php echo __('Year'); ?></th>
					</thead>
					<tbody>
						<?php 
							$x = 0;
							$y = 0;
							$sum_effec_eval = 0;
							$sum_qual_asses = 0; 
						?>
						<?php foreach ($evaluations as $eval) { ?>
						<tr>
							<td><?php echo $this->Html->link(
												$eval['Evaluation']['employee'], 
												array('controller' => 'employees', 'action' => 'view', 
												$eval['Employee']['id'])); ?></td>
							<td><?php echo $this->Html->link(
												$eval['Management']['name'], 
												array('controller' => 'managements', 'action' => 'view', 
												$eval['Management']['id'])); ?></td>
							<td><?php echo $this->Number->toPercentage($eval['Evaluation']['effectiveness_evaluation']); ?>&nbsp;</td>
							<td><?php echo $this->Number->toPercentage($eval['Evaluation']['quality_assessment']); ?>&nbsp;</td>
							<td><?php echo $this->Charisma->monthNames($eval['Evaluation']['month']); ?>&nbsp;</td>
							<td><?php echo h($eval['Evaluation']['year']); ?>&nbsp;</td>
						</tr>
						<?php 
							$sum_effec_eval += $eval['Evaluation']['effectiveness_evaluation'];
							$sum_qual_asses += $eval['Evaluation']['quality_assessment']; 

							if ($eval['Evaluation']['effectiveness_evaluation'] != 0)
								$x++;
							if ($eval['Evaluation']['quality_assessment'] != 0)
								$y++;

						?>
						<?php } ?>
					</tbody>
				</table>
				<dl class="view">
					<dt><h4><?php echo __('Effectiveness Evaluation'); ?></h4></dt>
					<dd>&nbsp;<?php echo $this->Number->toPercentage(($x != 0) ? $sum_effec_eval / $x : 0); ?></dd>

					<dt><h4><?php echo __('Quality Assessment'); ?></h4></dt>
					<dd>&nbsp;<?php echo $this->Number->toPercentage(($x != 0) ? $sum_qual_asses / $y : 0); ?></dd>
				</dl>
				<?php } ?>
				<?php echo $this->Charisma->iconButton(__('Go back'), 
								array('action' => 'compute'),
								'icon icon-white icon-undo', 'btn btn-small btn-success'); ?>
				</div>
		</div>
	</div><!--/span-->
</div><!--/row-->

<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->deleteLink(__('Delete'), 
		array('action' => 'delete', $this->Form->value('Evaluation.Id')), 
		'icon-trash'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
		__('List Evaluations'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo  __('Related') ?></li>
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
<?php $this->end(); ?>
