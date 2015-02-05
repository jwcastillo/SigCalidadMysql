<div id="charts"></div>

<?php $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>
<script type="text/javascript">
//<![CDATA[
	$(document).ready(function() {

		$.ajaxSetup ({
			cache: false
		});

		var ajax_load = '<?php echo $this->Html->image("charisma/ajax-loaders/ajax-loader-7.gif", 
			array("alt" => __("Loading..."), "class" => "center")); ?>';
		//	load() functions
		var loadUrl = "<?php echo Router::url(array('controller'=>'packages',
			'action'=>'charts'));?>";
		/*$("div#charts").append(ajax_load).load(loadUrl);*/3

	

		
		$("div#charts").load(loadUrl + "#home");

	/*	var loadUrl = "<?php echo Router::url(array('controller'=>'employees',
			'action'=>'workload'));?>";

		$("div.sortable:last").append($('<div class="box span6">').load(loadUrl + " .box-header, .box-content"));
*/
		$("input#search").autocomplete({
				source: <?php echo json_encode($this->Charisma->controllerLinks()); ?>,
				select: function(event, ui) {
					/* Prevent the input from being populated: */
					event.preventDefault();
					/* Use ui.item.value to access the id */
					window.location.href = ui.item.value;
				},
				autoFocus: true
		});

	});
//]]>
</script>

<?php $this->end();?>