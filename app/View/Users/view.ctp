<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('User'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
				<dt><h4><?php echo __('Id'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($user['User']['id']); ?></dd>

				<dt><h4><?php echo __('Username'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($user['User']['username']); ?></dd>

				<dt><h4><?php echo __('Firstname'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($user['User']['firstname']); ?></dd>

				<dt><h4><?php echo __('Lastname'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($user['User']['lastname']); ?></dd>

				<dt><h4><?php echo __('Email'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($user['User']['email']); ?></dd>

				<dt><h4><?php echo __('Department'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($user['User']['department']); ?></dd>

				<dt><h4><?php echo __('Password'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($user['User']['password']); ?></dd>

				<dt><h4><?php echo __('Group'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($user['Group']['name'], 
					array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?></dd>
				<dt><h4><?php echo __('Created'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($user['User']['created']); ?></dd>

				<dt><h4><?php echo __('Modified'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($user['User']['modified']); ?></dd>

			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('Edit User'), 
		array('action' => 'edit',	$user['User']['id']), 
		'icon-pencil'); ?>
</li>

<li><?php echo $this->Charisma->deleteLink(__('Delete User'), 
		array('action' => 'delete', $user['User']['id']), 
		'icon-trash'); ?>
</li>
					
<li><?php echo $this->Charisma->iconLink(__('List Users'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink( __('New User'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
		<li><?php echo $this->Charisma->iconLink(__('List Groups'), 
						array('controller' => 'groups', 'action' => 'index'), 
						'icon-align-justify'); ?></li>
		<li><?php echo $this->Charisma->iconLink(
					__('New Group'), 
						array('controller' => 'groups', 'action' => 'add'), 'icon-plus'); ?></li>
<?php $this->end(); ?>

<!-- Relationships -->


