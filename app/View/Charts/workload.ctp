<?php echo $this->element('breadcrumbs');  ?>
<?php 

//debug($employees); debug($weightings);

?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-tasks"></i>&nbsp;<?php echo __('Workload') . ' (' . __('Weighting') . ')'; ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php foreach ($employees as $key => $employee) { ?>
					<h3><?php echo $employee ?> - <?php echo $weightings[$key] ?></h3>
					<?php 
						$percent = ($total != 0) ? $weightings[$key] * 100 / $total : 0; 
						if ($percent <= 25)
							$progress_class = 'progress-info';
						elseif ($percent > 25 && $percent <= 50)
							$progress_class = 'progress-success';
						elseif ($percent > 50 && $percent <= 75)
							$progress_class = 'progress-warning';
						else 
							$progress_class = 'progress-danger';
					?>
					<div class="progress progress-striped <?php echo $progress_class ?> active">
						<div style="width: <?php echo $percent ?>%;" class="bar" 
							data-rel="tooltip" title="<?php echo number_format($percent, 2) ?>%">
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

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

<?php //$this->append('script'); ?>
<?php echo $this->Html->script('charisma/bootstrap-tooltip'); ?>
<script type="text/javascript">
//<![CDATA[
	$(document).ready(function(){
		//tooltip
		$('[rel="tooltip"],[data-rel="tooltip"]').tooltip({"placement":"bottom",delay: { show: 400, hide: 200 }});
	});
//]]>
</script>
<?php //echo $this->end();?>
