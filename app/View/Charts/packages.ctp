<?php echo $this->element('breadcrumbs');  ?>

<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>

<div class="row-fluid sortable">

<div class="box span6">
	<div data-original-title="" class="box-header well">
		<h2><i class="icon-edit"></i>&nbsp;<?php echo __('News and Certified'); ?>
	</div>
	<div class="box-content">
		<div id="columnwrapper1" style="display: block; float: left; width:90%; margin-bottom: 5px;"></div>
		<?php echo $this->HighCharts->render('Column Chart 1'); ?>
	</div>
</div>

<div class="box span6">
	<div data-original-title="" class="box-header well">
		<h2><i class="icon-edit"></i>&nbsp;<?php echo __('Certified Packages'); ?>
	</div>
	<div class="box-content">
		<div id="columnwrapper2" style="display: block; float: left; width:90%; margin-bottom: 5px;"></div>
		<?php echo $this->HighCharts->render('Column Chart 2'); ?>
	</div>
</div>

</div><!--/row-->

<div class="row-fluid sortable">

<div class="box span6">
	<div data-original-title="" class="box-header well">
		<h2><i class="icon-edit"></i>&nbsp;<?php echo __('Pending Packages'); ?>
	</div>
	<div class="box-content">
		<div id="columnwrapper3" style="display: block; float: left; width:90%; margin-bottom: 5px;"></div>
		<?php echo $this->HighCharts->render('Column Chart 3'); ?>
	</div>
</div>

<div class="box span6">
	<div data-original-title="" class="box-header well">
		<h2><i class="icon-edit"></i>&nbsp;<?php echo __('Entries per Month'); ?>
	</div>
	<div class="box-content">
		<div id="columnwrapper4" style="display: block; float: left; width:90%; margin-bottom: 5px;"></div>
		<?php echo $this->HighCharts->render('Column Chart 4'); ?>
	</div>
</div>

</div><!--/row-->

<div class="row-fluid sortable">

<div class="box span12">
	<div data-original-title="" class="box-header well">
		<h2><i class="icon-edit"></i>&nbsp;<?php echo __('Certified per Employee'); ?>
	</div>
	<div class="box-content">
		<div id="columnwrapper5" style="display: block; float: left; width:100%; margin-bottom: 5px;"></div>
		<?php echo $this->HighCharts->render('Column Chart 5'); ?>
	</div>
</div>

</div><!--/row-->

<div class="row-fluid sortable">

<div class="box span12">
	<div data-original-title="" class="box-header well">
		<h2><i class="icon-edit"></i>&nbsp;<?php echo __('Current Workload'); ?>
	</div>
	<div class="box-content">
		<div id="columnwrapper6" style="display: block; float: left; width:100%; margin-bottom: 5px;"></div>
		<?php echo $this->HighCharts->render('Column Chart 6'); ?>
	</div>
</div>

</div><!--/row-->

<div class="row-fluid sortable">

<div class="box span12">
	<div data-original-title="" class="box-header well">
		<h2><i class="icon-edit"></i>&nbsp;<?php echo __('Trial Days Average'); ?>
	</div>
	<div class="box-content">
		<div id="columnwrapper7" style="display: block; float: left; width:100%; margin-bottom: 5px;"></div>
		<?php echo $this->HighCharts->render('Column Chart 7'); ?>
	</div>
</div>

</div><!--/row-->




<?php $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>
<script type="text/javascript">
//<![CDATA[
	$(document).ready(function() {

		$.ajaxSetup ({
			cache: false
		});

	var loadUrl = "<?php echo Router::url(array('controller'=>'employees',
			'action'=>'workload'));?>";

	$("div.sortable:last").append($('<div class="box span6">').load(loadUrl + " .box-header, .box-content"));

	

	});
//]]>
</script>

<?php $this->end();?>

<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('New Management'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
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
<?php $this->end(); ?>