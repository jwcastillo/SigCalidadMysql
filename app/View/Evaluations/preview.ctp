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
				<dd>&nbsp;
				<?php 
					if ($rfc['Rfc']['closed'])
						echo __('Yes');
					else
						echo __('No');
				?>
				</dd>

			</dl>
			<div class="form-actions">
			<?php 
				echo $this->Charisma->iconButton(__('Finish'), 
					array('controller' => 'rfcs', 'action' => 'view', $rfc['Rfc']['id']), 
					'icon-fire icon-white', 'btn btn-small btn-inverse');
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
				<table id="packages" class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
							<!--<th><?php echo __('Id'); ?></th>-->
							<th><?php echo __('Number Package'); ?></th>
							<th><?php echo __('Module'); ?></th>
							<th><?php echo __('QA Lead'); ?></th>
							<th><?php echo __('Overfulfillment Effectiveness'); ?></th>
							<th><?php echo __('Deviation Effectiveness'); ?></th>
							<th><?php echo __('Weighting'); ?></th>
							<th><?php echo __('Final Weighting'); ?></th>
							<th><?php echo __('Effectiveness Evaluation'); ?></th>
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
								//echo $package['number_package'];
							?>
						</td>
						<td><?php echo $package['Module']['name']; ?></td>
						<td><?php echo $package['Employee']['fullname']; ?></td>
						<td>&nbsp;<?php echo $this->Number->toPercentage($package['overfulfillment_effectiveness']); ?></td>
						<td>&nbsp;<?php echo $this->Number->toPercentage($package['deviation_effectiveness']); ?></td>
						<td>&nbsp;<?php echo $this->Number->toPercentage($package['weighting']); ?></td>
						<td>&nbsp;<?php echo h($package['final_weighting']); ?></td>
						<td>&nbsp;<?php echo $this->Number->toPercentage($package['effectiveness_evaluation']); ?></td>
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
<?php echo $this->element('packages/package_detail_ajax'); ?>
