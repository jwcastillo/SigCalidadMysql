<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Employee'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">

				<ul class="thumbnails gallery">
					<li class="thumbnail employees">
						<?php echo $this->Html->image("/files/employee/small_". $employee['Employee']['image']); ?>
					</li>
				</ul>

				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($employee['Employee']['id'], 
					array('action' => 'view', $employee['Employee']['id'])); ?></dd>

				<dt><h4><?php echo __('Bc'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['bc']); ?></dd>

				<dt><h4><?php echo __('Name'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['name']); ?></dd>

				<dt><h4><?php echo __('Lastname'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['lastname']); ?></dd>

				<dt><h4><?php echo __('Position'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($employee['Position']['name'], 
					array('controller' => 'positions', 'action' => 'view', $employee['Position']['id'])); ?></dd>
				<dt><h4><?php echo __('Ci'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['ci']); ?></dd>

				<dt><h4><?php echo __('Management'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($employee['Management']['name'], 
					array('controller' => 'managements', 'action' => 'view', $employee['Management']['id'])); ?></dd>
				<dt><h4><?php echo __('Entry Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['entry_date']); ?></dd>

				<dt><h4><?php echo __('Birthdate'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['birthdate']); ?></dd>

				<dt><h4><?php echo __('Home Phone'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['home_phone']); ?></dd>

				<dt><h4><?php echo __('Work Phone'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['work_phone']); ?></dd>

				<dt><h4><?php echo __('Cell Phone'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['cell_phone']); ?></dd>

				<dt><h4><?php echo __('Address'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['address']); ?></dd>

				<dt><h4><?php echo __('Type'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['type']); ?></dd>

				<dt><h4><?php echo __('Active'); ?></h4></dt>
				<dd>&nbsp;
				<?php 
					if ($employee['Employee']['active'])
						echo __('Yes');
					else
						echo __('No');
				?>
				</dd>

				<dt><h4><?php echo __('Company'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['company']); ?></dd>

				<dt><h4><?php echo __('Email'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['email']); ?></dd>

				<dt><h4><?php echo __('Work Email'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['email_work']); ?></dd>

				<!--<dt><h4><?php echo __('Image'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['image']); ?></dd>-->

				<!--<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['modified']); ?></dd>-->

			</dl>
			<div class="form-actions">
			<?php
				echo $this->Charisma->iconButton(__('Change Image'), 
					array('action' => 'image', $employee['Employee']['id']), 
					'icon-user icon-white', 'btn btn-small btn-info');
			?>
			<?php
				echo $this->Charisma->iconButton(__('(De) Activate'), 
					array('action' => 'toggleActivation', $employee['Employee']['id']), 
					'icon-check icon-white', 'btn btn-small btn-primary');
			?>
			</div>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Employee'), 
		array('action' => 'edit',	$employee['Employee']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Employee'), 
		array('action' => 'delete', $employee['Employee']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Employees'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Employee'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Positions'), 
						array('controller' => 'positions', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Position'), 
						array('controller' => 'positions', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Managements'), 
						array('controller' => 'managements', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Management'), 
						array('controller' => 'managements', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Absences'), 
						array('controller' => 'absences', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Absence'), 
						array('controller' => 'absences', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Evaluations'), 
						array('controller' => 'evaluations', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Evaluation'), 
						array('controller' => 'evaluations', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Packages'), 
						array('controller' => 'packages', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Package'), 
						array('controller' => 'packages', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Quality Managers'), 
						array('controller' => 'quality_managers', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Quality Manager'), 
						array('controller' => 'quality_managers', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Tasks'), 
						array('controller' => 'tasks', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Task'), 
						array('controller' => 'tasks', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Vehicles'), 
						array('controller' => 'vehicles', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Vehicle'), 
						array('controller' => 'vehicles', 'action' => 'add'), 'icon-plus'); ?></li>
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
				<?php if (!empty($employee['Absence'])): ?>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th><?php echo __('Id'); ?></th>
							<th><?php echo __('Absence Type'); ?></th>
							<th><?php echo __('Description'); ?></th>
							<th><?php echo __('Departure Date'); ?></th>
							<th><?php echo __('Arrival Date'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($employee['Absence'] as $absence): ?>
					<tr>
						<td><?php echo $this->Html->link($absence['id'], 
							array('controller' => 'absences', 
							'action' => 'view', $absence['id'])); ?></td>
						<!--<td><?php echo $absence['absence_type_id']; ?></td>-->
						<td><?php echo $this->Html->link(
											$absence['AbsenceType']['name'], 
											array('controller' => 'absence_types', 'action' => 'view', 
											$absence['AbsenceType']['id'])); ?></td>
						<td><?php echo $absence['description']; ?></td>
						<td><?php echo $absence['departure_date']; ?></td>
						<td><?php echo $absence['arrival_date']; ?></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<!-- Has many -->
<!--<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Related Evaluations'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($employee['Evaluation'])): ?>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th><?php echo __('Id'); ?></th>
							<th><?php echo __('Effectiveness Evaluation'); ?></th>
							<th><?php echo __('Quality Assessment'); ?></th>
							<th><?php echo __('Month'); ?></th>
							<th><?php echo __('Year'); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($employee['Evaluation'] as $evaluation): ?>
					<tr>
						<td><?php echo $evaluation['id']; ?></td>
						<td><?php echo $evaluation['effectiveness_evaluation']; ?></td>
						<td><?php echo $evaluation['quality_assessment']; ?></td>
						<td><?php echo $evaluation['month']; ?></td>
						<td><?php echo $evaluation['year']; ?></td>
						<td class="actions center">
							<?php echo $this->Charisma->iconButton(__('View'), 
										array('controller' => 'evaluations', 
										'action' => 'view', $evaluation['id']), 
										'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>
						</td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>-->

<!-- Has many -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Related Packages'); ?>&nbsp;</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($employee['Package'])): ?>
				<table id="ajax-table" class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<!--<th><?php echo __('Id'); ?></th>-->
							<th><?php echo __('Number Package'); ?></th>
							<th><?php echo __('Module'); ?></th>
							<th><?php echo __('Rfc'); ?></th>
							<th><?php echo __('Entry Date'); ?></th>
							<th><?php echo __('Start Date'); ?></th>
							<th><?php echo __('End Date'); ?></th>
							<th><?php echo __('Certified Date'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($employee['Package'] as $package): ?>
					<tr>
						<!--<td><?php echo $package['id']; ?></td>-->
						<td>
							<?php 
								echo $this->Html->link($package['number_package'],
									array('controller'=>'packages','action'=>'view', $package['id']),
									array('class' => 'ajax-view')
								);
							?>
						</td>
						<td><?php echo $package['Module']['name']; ?></td>
						<td><?php echo $package['Rfc']['name']; ?></td>
						<td><?php echo $package['entry_date']; ?></td>
						<td><?php echo $package['start_date']; ?></td>
						<td><?php echo $package['end_date']; ?></td>
						<td><?php echo $package['certified_date']; ?></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<!-- Package Detail with Ajax -->
<?php echo $this->element('details_ajax'); ?>

<!-- Has many -->
<!--<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Related Quality Managers'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($employee['QualityManager'])): ?>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th><?php echo __('Id'); ?></th>
							<th><?php echo __('Management Id'); ?></th>
							<th class="actions"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($employee['QualityManager'] as $qualityManager): ?>
					<tr>
						<td><?php echo $qualityManager['id']; ?></td>
						<td><?php echo $qualityManager['management_id']; ?></td>
						<td class="actions center">
							<?php echo $this->Charisma->iconButton(__('View'), 
										array('controller' => 'quality_managers', 
										'action' => 'view', $qualityManager['id']), 
										'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>
						</td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>-->
<!-- Has many -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Related Vehicles'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($employee['Vehicle'])): ?>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<th><?php echo __('Id'); ?></th>
							<th><?php echo __('Model'); ?></th>
							<th><?php echo __('Color'); ?></th>
							<th><?php echo __('Plate'); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($employee['Vehicle'] as $vehicle): ?>
					<tr>
						<td><?php echo $this->Html->link($vehicle['id'], 
							array('controller' => 'vehicles', 
							'action' => 'view', $vehicle['id'])); ?></td>
						<td><?php echo $vehicle['model']; ?></td>
						<td><?php echo $vehicle['color']; ?></td>
						<td><?php echo $vehicle['plate']; ?></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
