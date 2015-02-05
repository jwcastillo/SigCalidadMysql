<h1><?php echo sprintf('%s - %s', $package['Package']['number_package'], $package['Module']['name']) ?></h1>

<p class="lead"><?php echo __('This package has been assigned to: ') . $package['Package']['employee'] ?></p>


<p><strong><?php echo __('Start Date'); ?>&nbsp;</strong><?php echo h($package['Package']['start_date']); ?></p>

<p><strong><?php echo __('End Date'); ?>&nbsp;</strong><?php echo h($package['Package']['end_date']); ?></p>

<p><strong><?php echo __('Management'); ?>&nbsp;</strong><?php echo h($package['Management']['name']); ?></p>

<p><strong><?php echo __('Rfc'); ?>&nbsp;</strong><?php echo h($package['Rfc']['name']); ?></p>

<p><strong><?php echo __('Type'); ?>&nbsp;</strong><?php echo h($package['Package']['type']); ?></p>

<p><strong><?php echo __('Technical Lead'); ?>&nbsp;</strong><?php echo h($package['Package']['analyst']); ?></p>

<p><strong><?php echo __('Applicant'); ?>&nbsp;</strong><?php echo h($package['Package']['applicant']); ?></p>

<p><strong><?php echo __('Components'); ?>&nbsp;</strong><?php echo h($package['Package']['components']); ?></p>

<p><strong><?php echo __('Components Amount'); ?>&nbsp;</strong><?php echo h($package['Package']['components_amount']); ?></p>

<p><strong><?php echo __('Weighting'); ?>&nbsp;</strong><?php echo h($package['Package']['weighting']); ?></p>

<?php $this->append('panel'); ?>
<p>
  <?php echo sprintf(__('To learn more about this package click %s'), 
     $this->Html->link(__('here') . '&raquo;', 
        array('controller' => 'packages', 'action' => 'view', 'full_base' => true, $package['Package']['id']))
    ); 
  ?>
</p>
<?php $this->end(); ?>
