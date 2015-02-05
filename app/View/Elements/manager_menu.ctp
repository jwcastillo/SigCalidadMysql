
<li class="nav-header hidden-tablet">Reportes</li>

	<li><?php echo $this->Charisma->iconLink(
				__('Report of Packages'), 
				array('plugin' => null, 'controller' => 'packages', 'action' => 'reports'), 
				'icon-list-alt'); ?>
			</li>
				<li><?php echo $this->Charisma->iconLink(
				__('Report of Certified Packages '), 
				array('plugin' => null, 'controller' => 'packages', 'action' => 'reports',1), 
				'icon-list-alt'); ?>
			</li>
					<li><?php echo $this->Charisma->iconLink(
				__('Report of High Impact '), 
				array('plugin' => null, 'controller' => 'rfc', 'action' => 'highimpact'), 
				'icon-list-alt'); ?>
			</li>

	<li class="nav-header hidden-tablet"><?php echo __('Manager Menu') ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Absences'), 
			array('controller' => 'absences', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Absence Types'), 
			array('controller' => 'absence_types', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Areas'), 
			array('controller' => 'areas', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Complexities'), 
			array('controller' => 'complexities', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Development Managers'), 
			array('controller' => 'development_managers', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Employees'), 
			array('controller' => 'employees', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Evaluations'), 
			array('controller' => 'evaluations', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Evaluation States'), 
			array('controller' => 'evaluation_states', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Final Statuses'), 
			array('controller' => 'final_statuses', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Html->link(
			$this->Html->tag('i', '', array('class' => 'icon-align-justify')) .  
			$this->Html->tag('span', ' ' . __('List Groups'), array('class' => 'hidden-tablet')), 
			array('action' => 'index'), array('escape' => false)); ?>	</li>
	<li><?php echo $this->Charisma->iconLink(__('List Managements'), 
			array('controller' => 'managements', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Modules'), 
			array('controller' => 'modules', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Packages'), 
			array('controller' => 'packages', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Package Classes'), 
			array('controller' => 'package_classes', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Package Statuses'), 
			array('controller' => 'package_statuses', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Planning Managers'), 
			array('controller' => 'planning_managers', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Positions'), 
			array('controller' => 'positions', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Project Classes'), 
			array('controller' => 'project_classes', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Project Managers'), 
			array('controller' => 'project_managers', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Respondents'), 
			array('controller' => 'respondents', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Rfcs'), 
			array('controller' => 'rfcs', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Charisma->iconLink(__('List Unsatisfactory Productions'), 
			array('controller' => 'unsatisfactory_productions', 'action' => 'index'), 
			'icon-align-justify'); ?></li>

	<li><?php echo $this->Charisma->iconLink(__('List Unsatisfactory Qualities'), 
			array('controller' => 'unsatisfactory_qualities', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	<li><?php echo $this->Html->link(
			$this->Html->tag('i', '', array('class' => 'icon-align-justify')) .  
			$this->Html->tag('span', ' ' . __('List Users'),
			array('class' => 'hidden-tablet')), 
			array('controller' => 'users', 'action' => 'index'), 
			array('escape' => false)); ?></li>

	<li><?php echo $this->Charisma->iconLink(__('List Vehicles'), 
			array('controller' => 'vehicles', 'action' => 'index'), 
			'icon-align-justify'); ?></li>
	
		<!-- Menu lateral Fin -->