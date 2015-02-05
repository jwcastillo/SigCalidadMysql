<?php //$this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>

<?php 
	$this->Paginator->options(array(
		'update' => '#ajax-table',
		'evalScripts' => true
	));
 ?>
<?php //$this->end(); ?>
