<li class="nav-header hidden-tablet"><?php echo __('Admin') ?></li>

<li><?php echo $this->Charisma->iconLink(
	__('List Groups'), 
	array('controller' => 'groups', 'action' => 'index'), 
	'icon-th-list'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
	__('List Users'), 
	array('controller' => 'users', 'action' => 'index'), 
	'icon-user'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
	__('Manage permissions'), 
	array('plugin' => 'acl_manager', 'controller' => 'acl', 'action' => 'permissions'), 
	'icon-lock'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
	__('List Options'), 
	array('controller' => 'options', 'action' => 'index'), 
	'icon-wrench'); ?>
</li>