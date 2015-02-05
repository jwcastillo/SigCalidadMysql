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
	<meta name="author" content="Jose Valecillos">

	<!-- The styles -->
	<style type="text/css">
	  body {
	  background-image: url('img/bg1.jpg');
	 
		padding-bottom: 40px;
	  }
	  .login-box{

	  	opacity: 0.85;
	  }
	
	</style>


	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('charisma/bootstrap-cerulean');
		echo $this->Html->css('charisma/bootstrap-responsive');
		echo $this->Html->css('charisma/charisma-app');
		echo $this->Html->css('cake.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>

	<!-- Disable Compatibility View in IE -->
	<!--[if IE]>
	<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
	<![endif]-->

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <?php echo $this->Html->script('html5shiv', array('once' => true)); ?>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">
		
</head>

<body>

	<div class="container-fluid">
		<div class="row-fluid">

			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<?php echo $this->fetch('content'); ?>

		</div><!--/fluid-row-->
		
	</div><!--/.fluid-container-->

	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<?php echo $this->fetch('script'); ?>
</body>
</html>