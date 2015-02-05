
<!--<div class="row-fluid">

	<div class="span12 well sortable">

		<h4><?php echo __('Packages'); ?></h4>

	<?php 

		if( $this->Session->read('Auth.User.group_id')==3 || 
			$this->Session->read('Auth.User.group_id')==2 || 
			$this->Session->read('Auth.User.group_id')==5 ) { 
			
			echo $this->element('home/up/pp');
			echo $this->element('home/up/pa');
		}

		echo $this->element('home/up/ppo');  
		echo $this->element('home/up/pv'); 
		echo $this->element('home/up/pc');  
	?>

	</div>

</div>-->


<div class="row-fluid sortable">

	<div class="box span12">

	<div data-original-title="" class="box-header well">
		<h2><i class="icon-th"></i>&nbsp;<?php echo __('Packages') ?></h2>
	</div>

	<div class="sortable ui-sortable" style="padding: 10px;">

	<?php 

		if( $this->Session->read('Auth.User.group_id')==3 || 
			$this->Session->read('Auth.User.group_id')==2 || 
			$this->Session->read('Auth.User.group_id')==5 ) { 
			
			echo $this->element('home/up/pp');
			echo $this->element('home/up/pa');
		}

		echo $this->element('home/up/ppo');  
		echo $this->element('home/up/pv'); 
		echo $this->element('home/up/pc');  
	?>

	</div>

</div>