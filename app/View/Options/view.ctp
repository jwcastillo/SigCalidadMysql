<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('Option'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($option['Option']['id'], 
					array('action' => 'view', $option['Option']['id'])); ?></dd>

				<dt><h4><?php echo __('Key'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($option['Option']['key']); ?></dd>

				<dt><h4><?php echo __('Value'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($option['Option']['value']); ?></dd>

				<dt><h4><?php echo __('Description'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($option['Option']['description']); ?></dd>

			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit Option'), 
		array('action' => 'edit',	$option['Option']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete Option'), 
		array('action' => 'delete', $option['Option']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Options'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New Option'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
<?php $this->end(); ?>

<!-- Relationships -->


