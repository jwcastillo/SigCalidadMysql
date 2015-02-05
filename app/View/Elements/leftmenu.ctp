<!-- left menu starts -->
<div class="span2 main-menu-span">
	<div class="well nav-collapse sidebar-nav">
		<?php echo $this->MenuBuilder->build('main-menu'); ?>
		<?php echo $this->fetch('home_menu'); ?>
		<ul class="nav nav-tabs nav-stacked actions-menu">
			<?php echo $this->fetch('submenu'); ?>
		</ul>
	</div><!--/.well -->
</div><!--/span-->
<!-- left menu ends -->