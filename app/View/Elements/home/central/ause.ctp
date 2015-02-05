<div class="box span4">
	<div class="box-header well">
		<h2>
			<i class="icon-th"></i>&nbsp;<?php echo __('Notifications') ?>
		</h2>
	</div>
	<!--/box-header well-->
	<div class="box-content">
		<ul class="nav nav-tabs" id="tabs" data-tabs="tabs">
			<li>
				<a href="#salidas" data-toggle="tab"><?php echo __('Departure') ?></a>
			</li>
			<li>
				<a href="#llegadas" data-toggle="tab"><?php echo __('Arrival') ?></a>
			</li>
			<li class="active">
				<a href="#guardias" data-toggle="tab"><?php echo __('Guards') ?></a>
			</li>
		</ul>
		<div id="myTabContent" class="tab-content">

			<div class="tab-pane" id="salidas">
				<ul class="dashboard-list">
					<?php foreach ($salidas as $ss): ?>
					<li>
						<div class="pull-left">
							<?php 
								echo $this->Html->link(
									$this->Html->image("/files/employee/thumb_". $ss['Employee']['image'], array('class' => 'dashboard-avatar')),
									array('controller' => 'absences', 'action' => 'view', $ss['Absence']['id']), 
									array('escape' => false)
								);
							?>
						</div>
						<div >
							<?php echo $this->Html->tag('strong', __('Name') . ':'); ?>
							<?php 
								echo $this->Html->link(
									//$ss['Employee']['name']. ' '. $ss['Employee']['lastname'],
									$ss['Absence']['employee'], 
									array('controller' => 'employees', 'action' => 'view', $ss['Employee']['id'])
								);
							?>
							<br/>

							<?php echo $this->Html->tag('strong', __('Date') . ':') ?>
							<?php echo $this->Time->format('d-m-Y', h($ss['Absence']['departure_date'])); ?>
							<br/>
	
							<?php //echo $this->Html->tag('strong', __('Assigned packages') . ':') ?>
							<?php //echo h($ss[0]['asignados']); ?>
							<br/>

							<span class="label label-warning">
								<?php echo h($ss['AbsenceType']['name']); ?>
							</span>
						</div>
						<div class="clear"></div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<div class="tab-pane" id="llegadas">
				<ul class="dashboard-list">
					<?php foreach ($llegadas as $l): ?>
						<li>
						<div class="pull-left">

							<?php 
								echo $this->Html->link(
									$this->Html->image("/files/employee/thumb_". $l['Employee']['image'], array('class' => 'dashboard-avatar')),
									array('controller' => 'absences', 'action' => 'view', $l['Absence']['id']), 
									array('escape' => false)
								);
							?>

						</div>

							<div >
							<?php echo $this->Html->tag('strong', __('Name') . ':'); ?>
							<?php 
								echo $this->Html->link(
									//$l['Employee']['name']. ' '. $l['Employee']['lastname'],
									$l['Absence']['employee'], 
									array('controller' => 'employees', 'action' => 'view', $l['Employee']['id'])
								);
							?>
				<br/>
							<?php echo $this->Html->tag('strong', __('Date') . ':') ?>
							<?php echo $this->Time->format('d-m-Y', h($l['Absence']['arrival_date'])); ?>
						</div>
					
										<br/>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>

					<div class="tab-pane active" id="guardias">
				<ul class="dashboard-list">
					<?php 


					foreach ($guardias as $gu): ?>

					<li>
						<div class="pull-left">
							<?php 
								echo $this->Html->link(
									$this->Html->image("/files/employee/thumb_". $gu['Employee']['image'], array('class' => 'dashboard-avatar')),
									array('controller' => 'absences', 'action' => 'view', $gu['Absence']['id']), 
									array('escape' => false)
								);
							?>
						</div>
						<div >
							<?php echo $this->Html->tag('strong', __('Name') . ':'); ?>
							<?php 
								echo $this->Html->link(
									//$ss['Employee']['name']. ' '. $ss['Employee']['lastname'],
									$gu['Absence']['employee'], 
									array('controller' => 'employees', 'action' => 'view', $gu['Employee']['id'])
								);
							?>
							<br/>

							<?php echo $this->Html->tag('strong', __('Cell Phone') . ':') ?>
							<?php echo h($gu['Employee']['cell_phone']); ?>

							<br/>
							<?php echo h($gu['Absence']['description']); ?>
							<br/>
							<?php
							if ($this->Time->format('z', h($gu['Absence']['arrival_date'])) >= $this->Time->format('z', date("y-m-d")) && $this->Time->format('z', h($gu['Absence']['departure_date'])) <= $this->Time->format('z', date("y-m-d")) ) {
								echo $this->Html->tag('strong', __('In progress')) ;
							} else {
								 echo $this->Html->tag('strong', __('Next')) ;
							}

							?>
							<br/>
							
							
	
							<?php //echo $this->Html->tag('strong', __('Assigned packages') . ':') ?>
							<?php //echo h($ss[0]['asignados']); ?>
							<br/>

						
						</div>
						<div class="clear"></div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div><!--/myTabContent-->
	</div> <!--/boxconten-->
</div><!--/span4-->
