<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-repeat"></i>&nbsp;<?php echo sprintf(__('Acl Manager %s'), Configure::read('AclManager.version')); ?></h2>
		</div>
		<div class="box-content">
			<p>This plugin allows you to easily manage your permissions. To use it you need to set up your Acl environment.</p>
			<p>Note: This plugin has only been designed to work with Actions as authorizer ($this->Auth->autorize = 'Actions').</p>
			<p>&nbsp;</p>
		</div>
	</div><!--/span-->
</div><!--/row-->

<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions'); ?></li>

<li><?php echo $this->Charisma->iconLink(
				__('Manage permissions'), 
				array('action' => 'permissions'), 
				'icon-lock'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
				__('Update ACOs'), 
				array('action' => 'update_acos'), 
				'icon-refresh'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
				__('Update AROs'), 
				array('action' => 'update_aros'), 
				'icon-refresh'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
				__('Drop ACOs/AROs'), 
				array('action' => 'drop'), 
				'icon-remove'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
				__('Drop permissions'), 
				array('action' => 'drop_perms'), 
				'icon-remove'); ?>
</li>

<?php $this->end(); ?>
