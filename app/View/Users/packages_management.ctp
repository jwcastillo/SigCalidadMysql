<?php echo $this->element('breadcrumbs');  ?>
<?php echo $this->Html->script('jquery-1.10.2.min'); ?>
<script type="text/javascript">
	/*$(function () {
    	// Radialize the colors
		Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
		    return {
		        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
		        stops: [
		            [0, color],
		            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
		        ]
		    };
		});
	});*/
</script>
<!--<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well">
			<h2><i class="icon-list-alt"></i> Stack Example</h2>
		</div>
		<div class="box-content">
			 <div id="stackchart" class="center" style="height:300px;"></div>
		</div>
	</div>
</div>--><!--/row-->
<div class="row-fluid sortable">
	<div class="box span6">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Packages per management'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
					<div id="piewrapper" style="display: block; float: left; width:90%; margin-bottom: 5px;"></div>
						<!--<div class="clear"></div>-->
						<?php echo $this->HighCharts->render('Pie Chart'); ?>

			</div>									 
		</div>
	</div><!--/span-->
	<div class="box span6">
	</div>
</div><!--/row-->

<?php $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min'); ?>

<?php $this->end(); ?>