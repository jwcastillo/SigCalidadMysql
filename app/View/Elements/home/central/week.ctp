	<div class="box span4">
		<div class="box-header well" data-original-title>
			<h2>
				<i class="icon-list"></i><?php echo __('Package Status'); ?>
			</h2>
		</div>
		<div class="box-content">
			<ul class="dashboard-list">

			<?php		

		  if($this->Session->read('Auth.User.group_id')==2 || $this->Session->read('Auth.User.group_id')==3 || $this->Session->read('Auth.User.group_id')==5) { ?>	
		 <!--  	<li>
						<?php //echo $this->element('home/central/week/pre');  ?>
				</li> -->
				<li>
						<?php echo $this->element('home/central/week/new');  ?>
				</li>
				<li>
						<?php echo $this->element('home/central/week/sa');  ?>
				</li>
				<?php }?>
				<li>
						<?php echo $this->element('home/central/week/se');  ?>
				</li>
				<li>
						<?php echo $this->element('home/central/week/ep');  ?>
				</li>
				<li>
						<?php echo $this->element('home/central/week/ce');  ?>
				</li>
				<li>
					<?php echo $this->element('home/central/week/ve');  ?>
				</li>
				
				<?php  if($this->Session->read('Auth.User.group_id')==2 || $this->Session->read('Auth.User.group_id')==3 || $this->Session->read('Auth.User.group_id')==5){ ?>	
				<li>
					<?php echo $this->element('home/central/week/eg');  ?>
				</li>
				<li>
					<?php echo $this->element('home/central/week/e2g');  ?>
				</li>
				<li>
					<?php echo $this->element('home/central/week/su');  ?>
				</li>
				<?php  if($this->Session->read('Auth.User.group_id')==2 || $this->Session->read('Auth.User.group_id')==3 || $this->Session->read('Auth.User.group_id')==5){ ?>	
				<li>
					<?php echo $this->element('home/central/week/cita');  ?>
				</li>
				<li>
					<?php echo $this->element('home/central/week/cit');  ?>
				</li>
			<?php }}?>

			</ul>
		</div>
	</div><!--/span4-->
	
