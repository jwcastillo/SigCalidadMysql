<?php echo $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>
<!-- jQury Migrate -->
<?php echo $this->Html->script('jquery-migrate.min', array('once' => true)); ?>
<!-- jQuery UI -->
<?php echo $this->Html->script('jquery-ui.min', array('once' => true)); ?>
<!-- transition / effect library -->
<?php echo $this->Html->script('bootstrap', array('once' => true)); ?>
<!-- alert enhancer library -->
<?php //echo $this->Html->script('charisma/bootstrap-alert'); ?>
<!-- modal / dialog library -->
<?php //echo $this->Html->script('charisma/bootstrap-modal'); ?>
<!-- scrolspy library -->
<?php //echo $this->Html->script('charisma/bootstrap-scrollspy'); ?>
<!-- library for creating tabs -->
<?php //echo $this->Html->script('charisma/bootstrap-tab'); ?>
<!-- library for advanced tooltip -->
<?php //echo $this->Html->script('charisma/bootstrap-tooltip'); ?>
<!-- popover effect library -->
<?php //echo $this->Html->script('charisma/bootstrap-popover'); ?>
<!-- button enhancer library -->
<?php //echo $this->Html->script('charisma/bootstrap-button'); ?>
<!-- autocomplete library -->
<?php //echo $this->Html->script('charisma/bootstrap-typeahead'); ?>
<!-- chart libraries end -->
<!-- select or dropdown enhancer -->
<?php echo $this->Html->script('chosen.jquery.min'); ?>
<!-- notification plugin -->
<?php echo $this->Html->script('jquery.noty'); ?>
<!-- for iOS style toggle switch -->
<!-- Aplicacion js -->
<?php  echo $this->Html->script('charisma'); ?>
	
<?php $this->end();?>

<!-- content starts -->
<!-- panel starts -->
<?php echo $this->element('home/up');  ?>
<!-- panel ends -->
<!-- central starts -->	
<?php echo $this->element('home/central');  ?>
<!-- central ends -->		
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