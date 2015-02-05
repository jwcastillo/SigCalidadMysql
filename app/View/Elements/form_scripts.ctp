<?php $this->append('css'); ?>
	<!-- Chosen -->
	<?php echo $this->Html->css('chosen.min'); ?>
	<!-- Boostrap -->
	<?php echo $this->Html->css('bootstrap-switch.min'); ?>
	<!-- jQuery Uniform -->
	<?php echo $this->Html->css('uniform.default.min'); ?>
<?php $this->end(); ?>

<?php $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>
<!-- jQuery UI -->
<?php echo $this->Html->script('jquery-ui.min', array('once' => true)); ?>
<!-- jQuery Chosen -->
<?php echo $this->Html->script('chosen.jquery.min', array('once' => true)); ?>
<!-- jQuery Uniform: checkbox, radio, and file input styler -->
<?php echo $this->Html->script('jquery.uniform.min', array('once' => true)); ?>
<!-- Boostrap -->
<?php echo $this->Html->script('bootstrap', array('once' => true)); ?>
<!-- Boostrap Switch -->
<?php echo $this->Html->script('bootstrap-switch.min', array('once' => true)); ?>

<script type="text/javascript">
//<![CDATA[
	$(document).ready(function() {
		// Datepicker
		$("input.datepicker").datepicker({dateFormat : 'yy-mm-dd'});
		$("select.chosen-select").chosen();
		$('input[type="number"].spinner').spinner({min: 0, max: 100, numberFormat: "n", step: 1});

		//uniform - styler for checkbox, radio and file input
		$("input:radio, input:file").not('[data-no-uniform="true"],#uniform-is-ajax').uniform({
			'fileButtonHtml': '<?php echo __("Search") ?>', 
			'fileDefaultHtml': '<?php echo __("None") ?>', 

		});

		//chosen - improves select
		$('[data-rel="chosen"],[rel="chosen"]').chosen();

		$('div.form-actions > button[type="reset"]').click(function(){
			parent.history.back();
      return false;
		});

		$("input[type='checkbox']").bootstrapSwitch({
			'onText': '<?php echo __("Yes"); ?>', 
			'offText': '<?php echo __("No"); ?>', 
			'size': 'small', 
		});

	});
//]]>
</script>
<?php $this->end(); ?>