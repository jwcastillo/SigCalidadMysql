
<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i> <?php echo $title; ?></h2>
		</div>
		<div class="box-content">
			<table id="packages" class="table table-bordered table-striped table-condensed bootstrap-datatable datatable">
				<thead>
					<tr>
						<?php 
						if (!isset($columns)) {
							$columns = array(__('Id'),__('Number'),  __('Module'), __('Rfc'), __('Status'), __('Type'), 
								__('Entry Date'),__('Certified Date') ,__('QA Lead'),  __('Technical Lead'),__('Applicant'),
								__('Planning VP'), __('Project Management'),__('High Impact'),
								__('Components Amount') ) ;
						}
						
						?>
						<?php 
							foreach ($columns as $c) { 
								echo "<th>$c</th>" . PHP_EOL;
							} 
						?>
					</tr>
				</thead>   
				<tbody>
				
				</tbody>
				<tfoot>
				<tr>
					<?php 
						foreach ($columns as $c) { 
							echo '<th rowspan="1" colspan="1">' . PHP_EOL;
							echo "<input type=\"text\" name=\"$c\" value=\"$c\">" . PHP_EOL;
							echo '</th>' . PHP_EOL;
						} 
					?>
				</tr>
				</tfoot>
			</table>
		</div>
	</div><!--/span-->
</div><!--/row-->

<?php $this->append('home_menu'); ?>

<?php echo $this->MenuBuilder->build('reports-menu'); ?>
<?php echo $this->MenuBuilder->build('user-menu'); ?>

<?php $this->end(); ?>

<!-- dataTable -->
<?php echo $this->element('datatable');  ?>
<!-- Ajax fun! -->
<?php echo $this->element('packages/packages_ajax'); ?>
<!-- Package Detail with Ajax -->
<?php echo $this->element('packages/package_detail_ajax'); ?>

<?php $this->append('css'); ?>
	<!-- Chosen -->
	<?php echo $this->Html->css('chosen.min'); ?>
<?php $this->end(); ?>

<?php $this->append('script'); ?>
<!-- modal / dialog library -->
<?php echo $this->Html->script('bootstrap', array('once' => true)); ?>
<!-- jQuery Chosen -->
<?php echo $this->Html->script('chosen.jquery.min', array('once' => true)); ?>
<script type="text/javascript">
//<![CDATA[
	$(document).ready(function() {

		//oTable.column( 5 ).visible( false );

		var table = $('#packages').DataTable();

		table.column( 4 ).visible( false );

});
//]]>
</script>

<?php $this->end();?>



