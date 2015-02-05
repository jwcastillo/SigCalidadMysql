<div class="alert alert-<?php echo isset($class) ? $class : 'block'; ?>">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<!--<strong>Heads up!</strong>--> <?php echo h($message); ?>
</div>