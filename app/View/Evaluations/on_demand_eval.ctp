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
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php //$this->append('submenu'); // FIXME: Add some links here ?>

<?php //$this->end(); ?>

<!-- Relationships -->

<!-- Has many -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo __('Packages Affected'); ?>			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php if (!empty($rfc['Package'])): ?>
				<table id="ajax-table" class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<!--<th><?php echo __('Id'); ?></th>-->
							<th><?php echo __('Number Package'); ?></th>
							<th><?php echo __('Module'); ?></th>
							<th><?php echo __('QA Lead'); ?></th>
							<th><?php echo __('Entry Date'); ?></th>
							<th><?php echo __('Start Date'); ?></th>
							<th><?php echo __('End Date'); ?></th>
							<th><?php echo __('Certified Date'); ?></th>
							<th><?php echo __('Evaluation') ?></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($rfc['Package'] as $package): ?>
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
						<td><?php echo $package['Employee']['fullname']; ?></td>
						<td><?php echo $package['entry_date']; ?></td>
						<td><?php echo $package['start_date']; ?></td>
						<td><?php echo $package['end_date']; ?></td>
						<td><?php echo $package['certified_date']; ?></td>
						<td>

						<?php 
						
						/*if (!empty($package['certified_date']) && 
							(empty($package['final_weighting']) || $package['final_weighting'] == '0,00') )

								echo '<span class="label label-success">'. __('To be evaluated') .'</span>';
							elseif ($package['final_weighting'] != '0,00' || !empty($package['final_weighting']))
								echo '<span class="label">'. __('Already evaluated') .'</span>';
							else
								echo '<span class="label label-warning">'. __('Not certified') .'</span>';*/


							if (empty($package['certified_date'])) {
								echo '<span class="label label-warning">'. __('Not certified') .'</span>';
							} else {
								// Forcing casting from string to float in final_weighting
								if (empty($package['final_weighting']) || $package['final_weighting'] + 0.00 == 0.00) {
									echo '<span class="label label-success">'. __('To be evaluated') .'</span>';
								} else {
									echo '<span class="label">'. __('Already evaluated') .'</span>';
								}
							}
						?>
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
<!-- dataTable -->
<!-- Package Detail with Ajax -->
<?php echo $this->element('details_ajax'); ?>
