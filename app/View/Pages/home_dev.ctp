<?php echo $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>
<!-- jQury Migrate -->
<?php echo $this->Html->script('jquery-migrate.min', array('once' => true)); ?>
<!-- jQuery UI -->
<?php echo $this->Html->script('jquery-ui.min', array('once' => true)); ?>
<!-- transition / effect library -->
<?php echo $this->Html->script('bootstrap', array('once' => true)); ?>
<!-- chart libraries end -->
<!-- select or dropdown enhancer -->
<?php echo $this->Html->script('chosen.jquery.min'); ?>
<!-- notification plugin -->
<?php echo $this->Html->script('jquery.noty'); ?>
<!-- for iOS style toggle switch -->
<!-- Aplicacion js -->
<?php  echo $this->Html->script('charisma'); ?>
	
<?php $this->end();?>


<!-- chart starts -->	
<?php echo $this->element('home/charts');  ?>
<!-- chart ends -->		

<!-- content ends -->

<!-- Home menu -->

<?php $this->append('home_menu'); ?>

<?php echo $this->MenuBuilder->build('manager-menu'); ?>
<?php echo $this->MenuBuilder->build('evaluation-menu'); ?>
<?php echo $this->MenuBuilder->build('reports-menu'); ?>
<?php echo $this->MenuBuilder->build('user-menu'); ?>
<?php echo $this->MenuBuilder->build('security-menu'); ?>

<?php $this->end(); ?>

<!-- Home menu ends -->	