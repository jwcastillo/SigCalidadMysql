<li class="nav-header hidden-tablet"><?php echo __('User Menu') ?></li>

<li><?php echo $this->Charisma->iconLink(
	__('List Absences'), 
	array('controller' => 'absences', 'action' => 'index'), 
	'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
	__('List Evaluations'), 
	array('controller' => 'evaluations', 'action' => 'index'), 
	'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
	__('List Holidays'), 
	array('controller' => 'holidays', 'action' => 'index'), 
	'icon-align-justify'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
	__('List Packages'), 
	array('controller' => 'packages', 'action' => 'index'), 
	'icon-th-list'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
	__('List Rfcs'), 
	array('controller' => 'rfcs', 'action' => 'index'), 
	'icon-th-list'); ?>
</li>

<!-- Workload of his area -->

</li>