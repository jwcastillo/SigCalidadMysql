<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>&nbsp;<?php echo __('Absences'); ?></h2>
		</div>
		<div class="box-content">
			<table id="ajax-table" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th><?php echo __('Id'); ?></th>
						<th><?php echo __('Description'); ?></th>
						<th><?php echo __('Absence Type'); ?></th>
						<th><?php echo __('Employee'); ?></th>
						<th><?php echo __('Departure Date'); ?></th>
						<th><?php echo __('Arrival Date'); ?></th>
					</tr>
				</thead>	
				<tbody>
				</tbody>
			</table>
		</div>
	</div><!--/span-->
</div><!--/row-->

<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('New Absence'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Employees'), 
				array('controller' => 'employees', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Employee'), 
				array('controller' => 'employees', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Absence Types'), 
				array('controller' => 'absence_types', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Absence Type'), 
				array('controller' => 'absence_types', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<?php $this->end(); ?>

<!-- dataTable -->
<?php echo $this->element('datatable');  ?>
<!-- Ajax fun! -->
<?php echo $this->element('datatable_ajax'); ?>
<!-- Package Detail with Ajax -->
<?php echo $this->element('details_ajax'); ?>