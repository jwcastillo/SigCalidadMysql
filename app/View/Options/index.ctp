<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>&nbsp;<?php echo __('Options'); ?></h2>
		</div>
		<div class="box-content">
			<table id="ajax-table" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th><?php echo __('Id'); ?></th>
						<th><?php echo __('Key'); ?></th>
						<th><?php echo __('Value'); ?></th>
						<th><?php echo __('Description'); ?></th>
					</tr>
				</thead>	
				<tbody>
				</tbody>
				<tfoot>
				</tfoot>
			</table>
		</div>
	</div><!--/span-->
</div><!--/row-->

<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('New Option'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<!--<li class="nav-header hidden-tablet"><?php //echo __('Related') ?></li>-->
<?php $this->end(); ?>

<!-- dataTable -->
<?php echo $this->element('datatable');  ?>
<!-- Ajax fun! -->
<?php echo $this->element('datatable_ajax'); ?>
<!-- Package Detail with Ajax -->
<?php echo $this->element('details_ajax'); ?>
