<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>

<html>
<head>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->

	<!-- Disable Compatibility View in IE -->
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
	<![endif]-->
	
	<title>
		<?php echo __('SIG Calidad IT') ?>
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="Jose Valecillos, José Castillo">

	<!-- The styles -->
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');

		echo $this->Html->css('charisma/bootstrap-cerulean');
		echo $this->Html->css('charisma/bootstrap-responsive');
		echo $this->Html->css('charisma/charisma-app');
		echo $this->Html->css('charisma/colorbox');
		echo $this->Html->css('charisma/opa-icons');
		echo $this->Html->css('jquery-ui.min');

		echo $this->Html->css('cake.min');
		echo $this->fetch('css');
	?>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <?php echo $this->Html->script('html5shiv', array('once' => true)); ?>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
</head>

<body>

	<?php echo $this->element('topbar');  ?>

	<div class="container-fluid">
		<div class="row-fluid">

			<?php echo $this->element('leftmenu');  ?>

			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
				<!-- content starts -->

				<div>
					<ul class="breadcrumb">
						<?php echo $this->Html->getCrumbs('<span class="divider">/</span>', 
							array('text' => '<i class="icon-home"></i><span>&nbsp;'.__('Dashboard').'</span>', 
								'url' => '/', 
								'escape' => false));
							//echo $this->Breadcrumbs->getCrumbs();
						?>
					</ul>
				</div>

				<?php echo $this->Session->flash(); ?>
				<?php echo $this->Session->flash('auth'); ?>

				<?php echo $this->fetch('content'); ?>
				<!-- content ends -->
			</div><!--/#content.span10-->
		</div><!--/fluid-row-->
		
		<hr>

		<footer>
			<?php echo $this->Html->tag ('span', '&copy; ' .  $this->Html->link(
				'Bancaribe - Calidad IT',
				'http://www.bancaribe.com.ve/',
				array('target' => '_blank', 'escape' => false)),
			array('class' => 'pull-left'));
			?>
			
			
		<!-- FIX -->
		<?php echo $this->Html->link(
				$this->Html->image('redmine-32x32.png', array('alt' => 'Reporta las Fallas', 'border' => '0')),
				$this->Session->read('Options.Redmine'),
				array('target' => '_blank', 'escape' => false, 'class' => 'pull-left')
				);
				?>


			<?php echo $this->Html->link(
				$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
				'http://www.cakephp.org/',
				array('target' => '_blank', 'escape' => false, 'class' => 'pull-right')
				);
				?>
			</footer>

			
			
		</div><!--/.fluid-container-->

		<!--<div class='green-table'>
			<?php //echo $this->element('sql_dump'); ?>
		</div>-->
	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<?php echo $this->fetch('script'); ?>
</body>
</html>