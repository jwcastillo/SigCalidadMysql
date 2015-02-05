<?php echo $this->element('breadcrumbs');  ?>
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
				<dd>&nbsp;<?php echo h($rfc['Rfc']['closed']); ?></dd>

			</dl>
			<div class="form-actions">
			<?php 
				echo $this->Form->create('Evaluation', array('class' => 'clean-form'));
					$this->Form->inputDefaults($this->Charisma->getInputDefaults());
					echo $this->Form->input('id', array('type' => 'hidden', 'value' => $rfc['Rfc']['id']));
					echo $this->Charisma->button(__('Continue'), 'submit');
				echo $this->Form->end();
			?>
			</div><!--/form-actions-->
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->

<!-- Relationships -->

<!-- Has many -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Packages with incomplete data'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<table id="ajax-table" class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<!--<th><?php echo __('Id'); ?></th>-->
							<th><?php echo __('Number Package'); ?></th>
							<th><?php echo __('Module'); ?></th>
							<th><?php echo __('QA Lead'); ?></th>
							<th><?php echo __('Errors'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $packagesInfo = Hash::combine($rfc['Package'], '{n}.id', '{n}'); ?>
						<?php foreach ($packagesErrors as $key => $value) { ?>
							<tr>
								<td>
								<?php 
									echo $this->Html->link($packagesInfo[$key]['number_package'],
										array('controller'=>'evaluations','action'=>'completePackage', $key),
										array('class' => 'ajax-view')
									);
								?>
								</td>
								<td><?php echo $packagesInfo[$key]['Module']['name']; ?></td>
								<td><?php echo $packagesInfo[$key]['Employee']['fullname']; ?></td>
								<td>
									<?php foreach ($value as $error) {
										//echo "$error ; ";
										echo '<span class="label label-warning">'. $error .'</span>&nbsp;';
									} ?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- dataTable -->
<!-- Package Detail with Ajax -->
<?php echo $this->element('details_ajax'); ?>

<?php $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>
<!-- modal / dialog library -->
<?php echo $this->Html->script('bootstrap', array('once' => true)); ?>


<script type="text/javascript">
//<![CDATA[

$(document).ajaxComplete(function() {

	$('div.modal-footer > button[type="submit"]').click(function( event ) {
		//alert( "Handler for .submit() called." );

		jQuery.ajax({
			type:'POST',
			async: true,
			cache: false,
			url: "<?php echo Router::Url(array('controller' => 'evaluations', 'action' => 'completePackage', $this->params['pass'][0])); ?>",
			success: function(response) {

				$('div#details').modal('hide');
				$('form#EvaluationOnDemandEvalForm').trigger('submit');
			},
			data:jQuery('form').serialize()
		});

		event.preventDefault();
	});


});
//]]>
</script>

<?php $this->end();?>

