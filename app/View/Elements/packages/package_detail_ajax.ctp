
<!-- Package detail modal div -->
<div class="modal hide fade" id="package-detail">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
		<h3><?php echo __('Package'); ?></h3>
	</div>
	<div id="package-detail-body" class="modal-body">
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal"><?php echo __('Close'); ?></a>
	</div>
</div>

<?php $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>
<!-- modal / dialog library -->
<?php echo $this->Html->script('bootstrap', array('once' => true)); ?>
<script type="text/javascript">
//<![CDATA[
	$(document).ready(function() {

		$.ajaxSetup ({
			cache: false
		});

		$('#packages').on('click', 'a.ajax-view', function(e) {
			e.preventDefault();
			$('div#package-detail').modal('show');
			var ajax_load = '<?php echo $this->Html->image("charisma/ajax-loaders/ajax-loader-7.gif", 
				array("alt" => __("Loading..."), "class" => "center")); ?>';
			//	load() functions
			var loadUrl = $(this).attr('href');
			$("div#package-detail > .modal-body").html(ajax_load).load(loadUrl + " .view");
			// Save previous content
			var close = '<a href="#" class="btn" data-dismiss="modal"><?php echo __('Close'); ?></a>';
			// Load ajax content and restore previous content
			$("div#package-detail > .modal-footer").html(ajax_load).load(loadUrl + " .form-actions > .btn", 
				function(){
      		$(this).append(close)
      	}
      );
		});

	});
//]]>
</script>

<?php $this->end();?>