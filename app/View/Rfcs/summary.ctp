<?php echo $this->element('breadcrumbs');  ?>

<?php

$totalComponents = 0;
$totalPackages = 0;
$totalPostImplatation = 0;
$analysts = array();
$startDate = '2037-01-01'; // I won't work here by that date
$certifiedDate = $endDate = '1970-01-01'; // This place didn't have computers yet
if (!empty($rfc['Package'])) {
	
	foreach ($rfc['Package'] as $package) {

		$analysts[] = $package['analyst'];
		$totalComponents += $package['components_amount'];
		$totalPackages++;
		
		if (isset($package['parent_id']))
			$totalPostImplatation++;

		if ($this->Charisma->lowerEqual($package['start_date'], $startDate))
			$startDate = $this->Charisma->deleteMinutes($package['start_date']);

		$auxEndDate = $package['replanning'] ? $package['replanning_date'] : $package['end_date'];

		$auxEndDate = $this->Charisma->deleteMinutes($auxEndDate);

		if ($this->Charisma->greaterEqual($auxEndDate, $endDate))
			$endDate = $auxEndDate;

		if ($this->Charisma->greaterEqual($package['certified_date'], $certifiedDate))
			$certifiedDate = $this->Charisma->deleteMinutes($package['certified_date']);

	}

	$analysts = array_unique($analysts);

}

?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Rfc'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($rfc['Rfc']['id']); ?></dd>

				<dt><h4><?php echo __('Name'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($rfc['Rfc']['name']); ?></dd>

				<dt><h4><?php echo __('Description'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($rfc['Rfc']['description']); ?></dd>

				<dt><h4><?php echo __('Planning VP'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($rfc['PlanningManager']['name'], 
					array('controller' => 'planning_managers', 'action' => 'view', $rfc['PlanningManager']['id'])); ?></dd>

				<dt><h4><?php echo __('Technology VP'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($rfc['DevelopmentManager']['name'], 
					array('controller' => 'development_managers', 'action' => 'view', $rfc['DevelopmentManager']['id'])); ?></dd>
				
				<dt><h4><?php echo __('Project Management'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($rfc['ProjectManager']['name'], 
					array('controller' => 'project_managers', 'action' => 'view', $rfc['ProjectManager']['id'])); ?></dd>
				
				<dt><h4><?php echo __('Project Class'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($rfc['ProjectClass']['name'], 
					array('controller' => 'project_classes', 'action' => 'view', $rfc['ProjectClass']['id'])); ?></dd>
				
				<dt><h4><?php echo __('Package Class'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($rfc['PackageClass']['name'], 
					array('controller' => 'package_classes', 'action' => 'view', $rfc['PackageClass']['id'])); ?></dd>

				<dt><h4><?php echo __('Complexity'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($rfc['Complexity']['name'], 
					array('controller' => 'complexities', 'action' => 'view', $rfc['Complexity']['id'])); ?></dd>
				
				<dt><h4><?php echo __('Weighting'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($rfc['Rfc']['weighting']); ?></dd>

				<dt><h4><?php echo __('Remaining'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($rfc['Rfc']['remaining']); ?></dd>

				<dt><h4><?php echo __('Closed'); ?></h4></dt>
				<dd>&nbsp;
				<?php 
					if ($rfc['Rfc']['closed'])
						echo __('Yes');
					else
						echo __('No');
				?>
				</dd>

				<dt><h4><?php echo __('Packages Amount'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($totalPackages); ?></dd>

				<dt><h4><?php echo __('Post-implantation Packages'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($totalPostImplatation); ?></dd>

				<dt><h4><?php echo __('Components Amount'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($totalComponents); ?></dd>

				<dt><h4><?php echo __('Start Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($startDate); ?></dd>

				<dt><h4><?php echo __('End Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($endDate); ?></dd>

				<dt><h4><?php echo __('Certified Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($certifiedDate); ?></dd>

				<dt><h4><?php echo __('Analysts'); ?></h4></dt>
				<dd>&nbsp;<?php echo implode(' / ', $analysts); ?></dd>

			</dl>
			<div class="form-actions">
			<?php 
				echo $this->Charisma->iconButton(__('Finish'), 
					array('controller' => 'rfcs', 'action' => 'view', $rfc['Rfc']['id']), 
					'icon-fire icon-white', 'btn btn-small btn-inverse');
			?>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php //$this->append('submenu'); // FIXME: Add some links here ?>

<?php //$this->end(); ?>

<!-- Relationships -->

<!-- Has many -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Packages Affected'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($rfc['Package'])): ?>
				<table id="packages" class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<!--<th><?php echo __('Id'); ?></th>-->
							<th><?php echo __('Number Package'); ?></th>
							<th><?php echo __('Module'); ?></th>
							<th><?php echo __('QA Lead'); ?></th>
							<th><?php echo __('Components Amount'); ?></th>
							<th><?php echo __('Overfulfillment Effectiveness'); ?></th>
							<th><?php echo __('Deviation Effectiveness'); ?></th>
							<th><?php echo __('Weighting'); ?></th>
							<th><?php echo __('Final Weighting'); ?></th>
							<th><?php echo __('Effectiveness Evaluation'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($rfc['Package'] as $package): ?>
					<tr>
						<!--<td><?php echo $package['id']; ?></td>-->
						<td>
							<?php 
								echo $this->Html->link($package['number_package'],
									array('controller'=>'packages','action'=>'view', $package['id']),
									array('class' => 'ajax-view')
								);
								//echo $package['number_package'];
							?>
						</td>
						<td><?php echo $package['Module']['name']; ?></td>
						<td><?php echo $package['Employee']['fullname']; ?></td>
						<td>&nbsp;<?php echo h($package['components_amount']); ?></td>
						<td>&nbsp;<?php echo $this->Number->toPercentage($package['overfulfillment_effectiveness']); ?></td>
						<td>&nbsp;<?php echo $this->Number->toPercentage($package['deviation_effectiveness']); ?></td>
						<td>&nbsp;<?php echo $this->Number->toPercentage($package['weighting']); ?></td>
						<td>&nbsp;<?php echo h($package['final_weighting']); ?></td>
						<td>&nbsp;<?php echo $this->Number->toPercentage($package['effectiveness_evaluation']); ?></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<!-- dataTable -->
<!-- Package Detail with Ajax -->
<?php echo $this->element('packages/package_detail_ajax'); ?>


<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Rfc'), 
		array('action' => 'edit',	$rfc['Rfc']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Rfc'), 
		array('action' => 'delete', $rfc['Rfc']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Rfcs'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Rfc'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Planning Managers'), 
						array('controller' => 'planning_managers', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Planning Manager'), 
						array('controller' => 'planning_managers', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Project Managers'), 
						array('controller' => 'project_managers', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Project Manager'), 
						array('controller' => 'project_managers', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Development Managers'), 
						array('controller' => 'development_managers', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Development Manager'), 
						array('controller' => 'development_managers', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Project Classes'), 
						array('controller' => 'project_classes', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Project Class'), 
						array('controller' => 'project_classes', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Package Classes'), 
						array('controller' => 'package_classes', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Package Class'), 
						array('controller' => 'package_classes', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Complexities'), 
						array('controller' => 'complexities', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Complexity'), 
						array('controller' => 'complexities', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Packages'), 
						array('controller' => 'packages', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Package'), 
						array('controller' => 'packages', 'action' => 'add'), 'icon-plus'); ?></li>
<?php $this->end(); ?>

<!-- Relationships -->

