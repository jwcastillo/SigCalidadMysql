<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Absence Type'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($absenceType['AbsenceType']['id']); ?></dd>

				<dt><h4><?php echo __('Name'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($absenceType['AbsenceType']['name']); ?></dd>

				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($absenceType['AbsenceType']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($absenceType['AbsenceType']['modified']); ?></dd>

			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Absence Type'), 
		array('action' => 'edit',	$absenceType['AbsenceType']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Absence Type'), 
		array('action' => 'delete', $absenceType['AbsenceType']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Absence Types'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Absence Type'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Absences'), 
						array('controller' => 'absences', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Absence'), 
						array('controller' => 'absences', 'action' => 'add'), 'icon-plus'); ?></li>
<?php $this->end(); ?>

<!-- Relationships -->


<!-- Has many -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Related Absences'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($absenceType['Absence'])): ?>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th><?php echo __('Id'); ?></th>
							<th><?php echo __('Employee Id'); ?></th>
							<th><?php echo __('Absence Type Id'); ?></th>
							<th><?php echo __('Description'); ?></th>
							<th><?php echo __('Departure Date'); ?></th>
							<th><?php echo __('Arrival Date'); ?></th>
							<th><?php echo __('Created'); ?></th>
							<th><?php echo __('Modified'); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($absenceType['Absence'] as $absence): ?>
					<tr>
						<td><?php echo $absence['id']; ?></td>
						<td><?php echo $absence['employee_id']; ?></td>
						<td><?php echo $absence['absence_type_id']; ?></td>
						<td><?php echo $absence['description']; ?></td>
						<td><?php echo $absence['departure_date']; ?></td>
						<td><?php echo $absence['arrival_date']; ?></td>
						<td><?php echo $absence['created']; ?></td>
						<td><?php echo $absence['modified']; ?></td>
						<td class="actions center">
							<?php echo $this->Charisma->iconButton(__('View'), 
										array('controller' => 'absences', 
										'action' => 'view', $absence['id']), 
										'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>
							<?php echo $this->Charisma->iconButton(__('Edit'),
										array('controller' => 'absences', 'action' => 
											'edit', $absence['id']),
										'icon-edit icon-white', 'btn btn-small btn-info'); ?>
							<?php echo $this->Charisma->deleteButton(__('Delete'), 
										array('controller' => 'absences', 'action' => 'delete', 
										$absence['id']), 
										'icon-trash icon-white', 'btn btn-small btn-danger'); ?>
						</td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
