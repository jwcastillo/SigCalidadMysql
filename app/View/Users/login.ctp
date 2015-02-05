<div class="row-fluid">
	<div class="span12 center login-header">
		
	</div><!--/span-->
</div><!--/row-->

<div class="row-fluid">
	<div class="well span5 center login-box">

		<?php
			$inputProperties = array(
				'div' => 'input-prepend', 
				'class' => 'input-large span10', 
				'label' => false, 
				'between' => false, 
				'after' => false, 
				'format' => false
			);
		?>

		<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
		<?php $this->Form->inputDefaults( array_merge( $this->Charisma->getInputDefaults(), $inputProperties ) ); ?>
			<fieldset>
				<h2><?php echo __('Welcome to SIG Calidad IT') ?></h2>
				<br/>

				<?php echo $this->Session->flash(); ?>

				<?php	echo $this->Form->input('username', array('before' => '<span class="add-on"><i class="icon-user"></i></span>')); ?>
				<div class="clearfix"></div>

				<?php	echo $this->Form->input('password', array('before' => '<span class="add-on"><i class="icon-lock"></i></span>')); ?>
				<div class="clearfix"></div>

			  <p class="center span5">
					<?php echo $this->Charisma->button(__('Login'), 'submit'); ?>
			  </p>
			</fieldset>
		<?php echo $this->Form->end(); ?>

	</div><!--/span-->
</div><!--/row-->