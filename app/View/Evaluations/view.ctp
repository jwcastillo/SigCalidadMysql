<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Evaluation'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($evaluation['Evaluation']['id']); ?></dd>

				<dt><h4><?php echo __('Effectiveness Evaluation'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($evaluation['Evaluation']['effectiveness_evaluation']); ?></dd>

				<dt><h4><?php echo __('Quality Assessment'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($evaluation['Evaluation']['quality_assessment']); ?></dd>

				<dt><h4><?php echo __('Month'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($evaluation['Evaluation']['month']); ?></dd>

				<dt><h4><?php echo __('Year'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($evaluation['Evaluation']['year']); ?></dd>

				<dt><h4><?php echo __('QA Lead'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($evaluation['Employee']['fullname'], 
					array('controller' => 'employees', 'action' => 'view', $evaluation['Employee']['id'])); ?></dd>
				<dt><h4><?php echo __('Management Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($evaluation['Evaluation']['management_id']); ?></dd>

				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($evaluation['Evaluation']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($evaluation['Evaluation']['modified']); ?></dd>

			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Evaluation'), 
		array('action' => 'edit',	$evaluation['Evaluation']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Evaluation'), 
		array('action' => 'delete', $evaluation['Evaluation']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Evaluations'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Evaluation'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Employees'), 
						array('controller' => 'employees', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Employee'), 
						array('controller' => 'employees', 'action' => 'add'), 'icon-plus'); ?></li>
<?php $this->end(); ?>

<!-- Relationships -->


