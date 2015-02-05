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
			<?php echo $this->Form->create('Evaluation', array('class' => 'form-horizontal')); ?>
			<?php $this->Form->inputDefaults($this->Charisma->getInputDefaults()); ?>
				<fieldset>
					<?php
						if ($isManager) {
							echo $this->Form->input('by_management',
							 array('type' => 'checkbox', 'checked' => $ByManagement) );
							echo $this->Form->input('management_id', 
								array_merge($this->Charisma->getSelectOptions(), array('disabled' => !$ByManagement) ) );
							echo $this->Form->input('employee_id', 
								array_merge($this->Charisma->getSelectOptions(), array('disabled' => $ByManagement) ) );
						}
						echo $this->Form->input('year', array_merge(
							array(
								'type' => 'date',
								'dateFormat' => 'Y',
								'minYear' => date('Y') - 5,
								'maxYear' => date('Y'),
								'orderYear' => 'asc'
								),
							$this->Charisma->getSelectOptions()
						));
					?>
					<div class="form-actions">
						<?php echo $this->Charisma->button(__('View'), 'submit'); ?>
						<?php echo $this->Charisma->button(__('Cancel'), 'reset', 'btn'); ?>
					</div>
				</fieldset>
				<?php echo $this->Form->end(); ?>

				<?php if (isset($evaluations)) { ?>
				<table class="table table-striped table-bordered">
					<thead>
						<!--<th><?php //echo __('QA Lead'); ?></th>-->
						<?php if ($isManager && $ByManagement): ?>
							<th><?php echo __('QA Lead'); ?></th>
							<!--<th><?php //echo __('Management'); ?></th>-->
						<?php endif; ?>
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
							<?php if ($isManager && $ByManagement): ?>
								<td><?php echo h($eval['Evaluation']['employee']); ?>&nbsp;</td>
								<!--<td><?php //echo h($eval['Management']['name']); ?>&nbsp;</td>-->
							<?php endif; ?>
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

<?php $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>

<script type="text/javascript">
//<![CDATA[
	$(document).ready(function() {

		employee = $('#EvaluationEmployeeId');
		management = $('#EvaluationManagementId');

		/*management.prop( "disabled", false ).trigger("chosen:updated");
		employee.prop( "disabled", true ).trigger("chosen:updated");
		$('#EvaluationByManagement').bootstrapSwitch('state', true, true);*/

		$('#EvaluationByManagement').on('switchChange.bootstrapSwitch', function(event, state) {
			 if(this.checked) {
					employee.prop( "disabled", true ).trigger("chosen:updated");
					management.prop( "disabled", false ).trigger("chosen:updated");
				} else {
					management.prop( "disabled", true ).trigger("chosen:updated");
					employee.prop( "disabled", false ).trigger("chosen:updated");
				}
		});
	});
//]]>
</script>

<?php $this->end();?>
