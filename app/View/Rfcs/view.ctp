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
				<dd>&nbsp;<?php echo $this->Html->link($rfc['Rfc']['id'], 
					array('action' => 'view', $rfc['Rfc']['id'])); ?></dd>

				<dt><h4><?php echo __('Name'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($rfc['Rfc']['name']); ?></dd>

				<dt><h4><?php echo __('Description'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($rfc['Rfc']['description']); ?></dd>

				<dt><h4><?php echo __('Planning VP'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($rfc['PlanningManager']['name'], 
					array('controller' => 'planning_managers', 'action' => 'view', $rfc['PlanningManager']['id'])); ?></dd>
				<dt><h4><?php echo __('Project Management'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($rfc['ProjectManager']['name'], 
					array('controller' => 'project_managers', 'action' => 'view', $rfc['ProjectManager']['id'])); ?></dd>
				<dt><h4><?php echo __('Technology VP'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($rfc['DevelopmentManager']['name'], 
					array('controller' => 'development_managers', 'action' => 'view', $rfc['DevelopmentManager']['id'])); ?></dd>
				<dt><h4><?php echo __('Project Class'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($rfc['ProjectClass']['name'], 
					array('controller' => 'project_classes', 'action' => 'view', $rfc['ProjectClass']['id'])); ?></dd>
			
				<dt><h4><?php echo __('Postimplantation'); ?></h4></dt>
				<dd id="RfcWPost_"  >&nbsp;

				<?php 
					if ($rfc['Rfc']['w_post']){
						echo __('Yes');
					
					}
					else{
				
						echo __('No');
					}
						
				?>
				</dd>
				<div class="hiddenField">
				<dt><h4><?php echo __('Package Class'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($rfc['PackageClass']['name'], 
					array('controller' => 'package_classes', 'action' => 'view', $rfc['PackageClass']['id'])); ?></dd>

				<dt ><h4><?php echo __('Start Date'); ?></h4></dt>
				<dd >&nbsp;<?php echo h($rfc['Rfc']['w_start_date']); ?></dd>

				<dt ><h4><?php echo __('End Date'); ?></h4></dt>
				<dd >&nbsp;<?php echo h($rfc['Rfc']['w_end_date']); ?></dd>

				<dt ><h4><?php echo __('Architecture'); ?></h4></dt>
				<dd >&nbsp;<?php echo h($rfc['Rfc']['architecture']); ?></dd>
			
				<dt ><h4><?php echo __('Participation Functional'); ?></h4></dt>
				<dd >&nbsp;
				<?php 
					if ($rfc['Rfc']['w_participation_functional'])
						echo __('Yes');
					else
						echo __('No');
				?>
				</dd>
				<dt ><h4><?php echo __('Participation Accounting'); ?></h4></dt>
				<dd >&nbsp;
				<?php 
					if ($rfc['Rfc']['w_participation_accounting'])
						echo __('Yes');
					else
						echo __('No');
				?>
				</dd>
				<dt ><h4><?php echo __('Work Queue'); ?></h4></dt>
				<dd >&nbsp;
				<?php 
					if ($rfc['Rfc']['w_priority'])
						echo __('Yes');
					else
						echo __('No');
				?>
				</dd>
				</div>
				

				
				<dt><h4><?php echo __('Weighting'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($rfc['Rfc']['weighting']); ?></dd>
				<dt><h4><?php echo __('Complexity'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($rfc['Complexity']['name'], 
					array('controller' => 'complexities', 'action' => 'view', $rfc['Complexity']['id'])); ?></dd>

				<dt><h4><?php echo __('Remaining'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($rfc['Rfc']['remaining']); ?></dd>
				<dt><h4><?php echo __('High Impact'); ?></h4></dt>
				<dd>&nbsp;
				<?php 
					if ($rfc['Rfc']['high_impact'])
						echo __('Yes');
					else
						echo __('No');
				?>
				</dd>
				<dt><h4><?php echo __('Closed'); ?></h4></dt>
				<dd>&nbsp;
				<?php 
					if ($rfc['Rfc']['closed'])
						echo __('Yes');
					else
						echo __('No');
				?>
				</dd>

				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($rfc['Rfc']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($rfc['Rfc']['modified']); ?></dd>

			</dl>
			<div class="form-actions">
			<?php 
				echo $this->Form->create('Rfc', array('class' => 'clean-form', 'action' => 'computeWeighting'));
					$this->Form->inputDefaults($this->Charisma->getInputDefaults());
					echo $this->Form->input('id', array('type' => 'hidden', 'value' => $rfc['Rfc']['id']));
					echo $this->Charisma->button(__('Compute Weighting'), 'submit'); 
				echo $this->Form->end(); 
			?>
			</div>
			<?php 
					if ($rfc['Rfc']['closed'])
					echo $this->Html->link('&Pi;', 
						array('controller' => 'evaluations', 'action' => 'unCertify', 'rfc' => $rfc['Rfc']['id']), 
						array('escape' => false)); 
			?>	
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Rfc'), 
		array('action' => 'edit',	$rfc['Rfc']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Rfc'), 
		array('action' => 'delete', $rfc['Rfc']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Rfcs'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Rfc'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Planning Managers'), 
						array('controller' => 'planning_managers', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Planning Manager'), 
						array('controller' => 'planning_managers', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Project Managers'), 
						array('controller' => 'project_managers', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Project Manager'), 
						array('controller' => 'project_managers', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Development Managers'), 
						array('controller' => 'development_managers', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Development Manager'), 
						array('controller' => 'development_managers', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Project Classes'), 
						array('controller' => 'project_classes', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Project Class'), 
						array('controller' => 'project_classes', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Package Classes'), 
						array('controller' => 'package_classes', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Package Class'), 
						array('controller' => 'package_classes', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Complexities'), 
						array('controller' => 'complexities', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Complexity'), 
						array('controller' => 'complexities', 'action' => 'add'), 'icon-plus'); ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Packages'), 
						array('controller' => 'packages', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Package'), 
						array('controller' => 'packages', 'action' => 'add'), 'icon-plus'); ?></li>
<?php $this->end(); ?>

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
							<th><?php echo __('Entry Date'); ?></th>
							<th><?php echo __('Start Date'); ?></th>
							<th><?php echo __('End Date'); ?></th>
							<th><?php echo __('Certified Date'); ?></th>
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

<?php echo $this->element('postjs'); ?>
