<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>&nbsp;<?php echo __('Employees Schedule'); ?></h2>
		</div>
		<div class="box-content">
				<?php 
					if (!isset($gantt) || empty($gantt)):
				?>
				<div class="alert alert-error">
					<button data-dismiss="alert" class="close" type="button">×</button>
					<?php echo __('No data was found that meets the used conditions'); ?>
				</div>
			<?php else: ?>
				<div class="gantt"></div>
			<?php endif; ?>
		</div>
	</div><!--/span-->
</div><!--/row-->

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

<!-- Package detail modal div -->
<div class="modal hide fade" id="details">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3><?php echo /*$this->Charisma->camelToTitle(__($this->name));*/ __('Details') ?></h3>
	</div>
	<div id="detail-body" class="modal-body">
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal"><?php echo __('Close'); ?></a>
	</div>
</div>

<?php $this->append('css'); ?>
	<?php echo $this->Html->css('jquery.gantt'); ?>
<?php $this->end(); ?>

<?php $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>
<!-- jQuery.Gantt -->
<?php echo $this->Html->script('jquery.gantt/jquery.fn.gantt.min', array('once' => true)); ?>

<script type="text/javascript">
//<![CDATA[
	$(function() {

		$(".gantt").gantt({
			source: <?php echo json_encode($gantt); ?>,
			navigate: "scroll",
			maxScale: "months",
			minScale: "days",
			itemsPerPage: 20,
			months: <?php echo json_encode(array_values($this->Charisma->monthNames())); ?>, 
			dow: <?php echo json_encode(array_values($this->Charisma->daysNames(null, 1))); ?>, 
			waitText: '<?php echo __("Loading...") ?>',
			onItemClick: function(data) {
				
				$('div#details').modal('show');
				var ajax_load = '<?php echo $this->Html->image("charisma/ajax-loaders/ajax-loader-7.gif", 
					array("alt" => __("Loading..."), "class" => "center")); ?>';
				//	load() functions
				var loadUrl = data;
				$("div#details > .modal-body").html(ajax_load).load(loadUrl + " .view");
				// Save previous content
				var close = '<a href="#" class="btn" data-dismiss="modal"><?php echo __('Close'); ?></a>';
				// Load ajax content and restore previous content
				$("div#details > .modal-footer").html(ajax_load).load(loadUrl + " .form-actions > *", 
					function(){
						$(this).append(close)
					}
				);
			} 
		});

	});
//]]>
</script>

<?php $this->end();?>