<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Package'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['Package']['id'], 
					array('action' => 'view', $package['Package']['id'])); ?></dd>

				<dt><h4><?php echo __('Number Package'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['number_package']); ?></dd>

				<dt><h4><?php echo __('Module'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['Module']['name'], 
					array('controller' => 'modules', 'action' => 'view', $package['Module']['id'])); ?></dd>
				<dt><h4><?php echo __('QA Lead'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['Employee']['fullname'], 
					array('controller' => 'employees', 'action' => 'view', $package['Employee']['id'])); ?></dd>
				<dt><h4><?php echo __('Package Status'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['PackageStatus']['name'], 
					array('controller' => 'package_statuses', 'action' => 'view', $package['PackageStatus']['id'])); ?></dd>
				<dt><h4><?php echo __('Rfc'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['Rfc']['name'], 
					array('controller' => 'rfcs', 'action' => 'view', $package['Rfc']['id'])); ?></dd>
				<dt><h4><?php echo __('Entry Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['entry_date']); ?></dd>

				<dt><h4><?php echo __('Management Entry Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['management_entry_date']); ?></dd>

				<dt><h4><?php echo __('Assignment Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['assignment_date']); ?></dd>

				<dt><h4><?php echo __('Type'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['type']); ?></dd>

				<dt><h4><?php echo __('Technical Lead'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['analyst']); ?></dd>

				<dt><h4><?php echo __('Applicant'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['applicant']); ?></dd>

				<dt><h4><?php echo __('Components'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['components']); ?></dd>

				<dt><h4><?php echo __('Components Amount'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['components_amount']); ?></dd>

				<dt><h4><?php echo __('Start Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['start_date']); ?></dd>

				<dt><h4><?php echo __('End Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['end_date']); ?></dd>

				<dt><h4><?php echo __('Replanning Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['replanning_date']); ?></dd>

				<dt><h4><?php echo __('Certified Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['certified_date']); ?></dd>

				<dt><h4><?php echo __('Overfulfillment Effectiveness'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['overfulfillment_effectiveness']); ?></dd>

				<dt><h4><?php echo __('Deviation Effectiveness'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['deviation_effectiveness']); ?></dd>

				<dt><h4><?php echo __('Overfulfillment Quality'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['overfulfillment_quality']); ?></dd>

				<dt><h4><?php echo __('Deviation Quality'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['deviation_quality']); ?></dd>

				<dt><h4><?php echo __('Weighting'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['weighting']); ?></dd>

				<dt><h4><?php echo __('Final Weighting'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['final_weighting']); ?></dd>

				<dt><h4><?php echo __('Effectiveness Evaluation'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['effectiveness_evaluation']); ?></dd>

				<dt><h4><?php echo __('Quality Assessment'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['quality_assessment']); ?></dd>

				<dt><h4><?php echo __('Replanning'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['replanning']); ?></dd>

				<dt><h4><?php echo __('Replanning Days'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['replanning_days']); ?></dd>
<!-- FIX -->
<!-- 				<dt><h4><?php // echo __('Trial Days'); ?></h4></dt>
				 -->				
				<dt><h4><?php echo __('Días para el inicio de certificación'); ?></h4></dt>

				 <dd>&nbsp;<?php echo h($package['Package']['trial_days']); ?></dd>

				<dt><h4><?php echo __('Certification Days'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['certification_days']); ?></dd>

				<dt><h4><?php echo __('Ttc'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['ttc']); ?></dd>

				<dt><h4><?php echo __('Ttp'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['ttp']); ?></dd>

				<dt><h4><?php echo __('Manager'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Manager']['name']); ?></dd>

				<dt><h4><?php echo __('Respondent'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['Respondent']['name'], 
					array('controller' => 'respondents', 'action' => 'view', $package['Respondent']['id'])); ?></dd>
				<dt><h4><?php echo __('Evaluation State'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['EvaluationState']['name'], 
					array('controller' => 'evaluation_states', 'action' => 'view', $package['EvaluationState']['id'])); ?></dd>
				<dt><h4><?php echo __('Current Stage'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['current_stage']); ?></dd>

				<dt><h4><?php echo __('Final Status'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['FinalStatus']['name'], 
					array('controller' => 'final_statuses', 'action' => 'view', $package['FinalStatus']['id'])); ?></dd>
				<dt><h4><?php echo __('Management'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['Management']['name'], 
					array('controller' => 'managements', 'action' => 'view', $package['Management']['id'])); ?></dd>
				<dt><h4><?php echo __('Packages Postimplantation'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['packages_postimplantation']); ?></dd>

				<dt><h4><?php echo __('Auto Assign'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['auto_assign']); ?></dd>

				<dt><h4><?php echo __('Effec Eval Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['effec_eval_date']); ?></dd>

				<dt><h4><?php echo __('Qual Eval Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['qual_eval_date']); ?></dd>

				<dt><h4><?php echo __('Parent'); ?></h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['Package']['parent_id'], 
					array('action' => 'view', $package['Package']['parent_id'])); ?></dd>

				<dt><h4><?php echo __('Methodology'); ?></h4></dt>
				<dd>&nbsp;
				<?php 
					if (isset($package['Rfc']['mtp_id']) && !empty($package['Rfc']['mtp_id']))
						// FIXME: Put that path in Options' table
						echo $this->Html->link($package['Rfc']['mtp_id'], 
							$this->Session->read('Options.mtweblink') . 'StageDevelopments/initialFace0/' . $package['Rfc']['mtp_id'], 
							array('target' => '_blank')  );
				?>
				</dd>



				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['modified']); ?></dd>

			</dl>
			<?php echo $this->element('packages/actions') ?>
			</div>
			<?php 
					if (!empty($package['Package']['effec_eval_date']))
					echo $this->Html->link('&Pi;', 
						array('controller' => 'evaluations', 'action' => 'unCertify', 'package' => $package['Package']['id']), 
						array('escape' => false)); 
			?>		 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Package'), 
		array('action' => 'edit',	$package['Package']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Package'), 
		array('action' => 'delete', $package['Package']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Packages'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Package'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Modules'), 
						array('controller' => 'modules', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Module'), 
						array('controller' => 'modules', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Employees'), 
						array('controller' => 'employees', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Employee'), 
						array('controller' => 'employees', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Package Statuses'), 
						array('controller' => 'package_statuses', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Package Status'), 
						array('controller' => 'package_statuses', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Rfcs'), 
						array('controller' => 'rfcs', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Rfc'), 
						array('controller' => 'rfcs', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Respondents'), 
						array('controller' => 'respondents', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Respondent'), 
						array('controller' => 'respondents', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Evaluation States'), 
						array('controller' => 'evaluation_states', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Evaluation State'), 
						array('controller' => 'evaluation_states', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Final Statuses'), 
						array('controller' => 'final_statuses', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Final Status'), 
						array('controller' => 'final_statuses', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Managements'), 
						array('controller' => 'managements', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Management'), 
						array('controller' => 'managements', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Observations'), 
						array('controller' => 'observations', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Observation'), 
						array('controller' => 'observations', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Histories'), 
						array('controller' => 'histories', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New History'), 
						array('controller' => 'histories', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Unsatisfactory Statuses'), 
						array('controller' => 'unsatisfactory_statuses', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Unsatisfactory Status'), 
						array('controller' => 'unsatisfactory_statuses', 'action' => 'add'), 'icon-plus'); ?></li>
<?php $this->end(); ?>

<!-- Relationships -->


<!-- Has many -->

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Observations'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($package['Observation'])): ?>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th><?php echo __('Title'); ?></th>
							<th><?php echo __('Respondent'); ?></th>
							<th><?php echo __('Observation'); ?></th>
							<th><?php echo __('Date'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($package['Observation'] as $o): ?>
					<tr>
						<td><?php echo $o['title']; ?></td>
						<td><?php echo $o['bc']; ?></td>
						<td><?php echo $o['observation']; ?></td>
						<td><?php echo $o['created']; ?></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('History'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($package['History'])): ?>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th><?php echo __('Action'); ?></th>
							<th><?php echo __('Stage'); ?></th>
							<th><?php echo __('Respondent'); ?></th>
							<th><?php echo __('Date'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($package['History'] as $h): ?>
					<tr>
						<td><?php echo $h['action']; ?></td>
						<td><?php echo $h['stage_name']; ?></td>
						<td><?php echo $h['bc']; ?></td>
						<td><?php echo $h['change_date']; ?></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<!-- Has many -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Related Unsatisfactory Statuses'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($package['UnsatisfactoryStatus'])): ?>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th><?php echo __('Type'); ?></th>
							<th><?php echo __('Name'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($package['UnsatisfactoryStatus'] as $unsatisfactoryStatus): ?>
					<tr>
						<td><?php echo $unsatisfactoryStatus['type']; ?></td>
						<td><?php echo $unsatisfactoryStatus['name']; ?></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>