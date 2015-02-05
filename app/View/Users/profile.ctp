<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo __('User'); ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<?php if (isset($employee) && !empty($employee)) { ?>
			<ul class="thumbnails gallery">
				<li class="thumbnail employees">
					<?php echo $this->Html->image("/files/employee/small_". $employee['Employee']['image']); ?>
				</li>
			</ul>
			<?php } ?>
			<dl class="view">

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

				<dt><h4><?php echo __('Group'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($user['Group']['name'], 
					array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?></dd>

				<?php if (isset($employee) && !empty($employee)) { ?>

				<dt><h4><?php echo __('Position'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($employee['Position']['name'], 
					array('controller' => 'positions', 'action' => 'view', $employee['Position']['id'])); ?></dd>

				<dt><h4><?php echo __('Management'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($employee['Management']['name'], 
					array('controller' => 'managements', 'action' => 'view', $employee['Management']['id'])); ?></dd>
				<dt><h4><?php echo __('Entry Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['entry_date']); ?></dd>

				<dt><h4><?php echo __('Email'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($employee['Employee']['email']); ?></dd>

				<?php } ?>

			</dl>
			<?php echo $this->Charisma->iconButton(__('Go back'), 
							'/',
							'icon icon-white icon-undo', 'btn btn-small btn-success'); ?>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->


<!-- Relationships -->


