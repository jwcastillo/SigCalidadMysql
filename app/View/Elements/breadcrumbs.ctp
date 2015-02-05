<?php 

	if ($this->action != 'index') {

		$link = array('plugin' => $this->params['plugin'] , 'controller' => $this->params['controller'], 'action' => 'index');

		$this->Html->addCrumb(__($this->Charisma->camelToTitle($this->name)), $link);

		$this->Html->addCrumb(__($this->Charisma->camelToTitle(Inflector::humanize($this->action))));
	} else {
		$this->Html->addCrumb(__($this->Charisma->camelToTitle($this->name)));	
	}
?>