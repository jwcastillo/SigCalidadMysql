<?php echo $this->element('breadcrumbs');  ?>

<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>

<?php //debug($charts) ?>

<?php foreach ($charts as $chart) { ?>

<?php extract($chart, EXTR_OVERWRITE); ?>

<div class="row-fluid sortable">

<div class="box span12">
	<div data-original-title="" class="box-header well">
		<h2><i class="icon-edit"></i>&nbsp;<?php echo $title; ?>
	</div>
	<div class="box-content">
		<div id="<?php echo $wrapper ?>" style="display: block; float: left; width:100%; padding-bottom: 5px;"></div>
		<?php echo $this->HighCharts->render($chartName); ?>
	</div>
</div>

</div><!--/row-->

<?php } ?>

<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Charts') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Trial Days'), 
		array('action' => 'trialDays'), 
		'icon-time'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(__('Certification Days'), 
		array('action' => 'certificationDays'), 
		'icon-time'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(__('TTC vs TTP'), 
		array('action' => 'ttcVsTtp'), 
		'icon-time'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(__('Package'), 
		array('action' => 'packages'), 
		'icon-gift'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(__('Others'), 
		array('action' => 'others'), 
		'icon-list-alt'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(__('Employees Schedule'), 
		array('controller' => 'employees', 'action' => 'schedule'), 
		'icon-tasks'); ?>
</li>

<?php $this->end(); ?>