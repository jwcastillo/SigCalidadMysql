<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('History'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($history['History']['id']); ?></dd>

				<dt><h4><?php echo __('Number Package'); ?></h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link(
											$history['History']['number_package'], 
											array('controller' => 'packages', 'action' => 'view', $packageId[$history['History']['id']]['Packages']['id'])); ?></dd>
				<dt><h4><?php echo __('Stage Name'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($history['History']['stage_name']); ?></dd>

				<dt><h4><?php echo __('Change Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($history['History']['change_date']); ?></dd>

				<dt><h4><?php echo __('Bc'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($history['History']['bc']); ?></dd>

				<dt><h4><?php echo __('Action'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($history['History']['action']); ?></dd>

				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($history['History']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($history['History']['modified']); ?></dd>

			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit History'), 
		array('action' => 'edit',	$history['History']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete History'), 
		array('action' => 'delete', $history['History']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Histories'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New History'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
<?php $this->end(); ?>

<!-- Relationships -->


