<?php echo "<?php echo \$this->element('form_scripts'); ?>".PHP_EOL; ?>

<?php echo "<?php echo \$this->element('breadcrumbs');  ?>".PHP_EOL; ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;
				<?php printf("<?php echo __('%s %s'); ?>".PHP_EOL, Inflector::humanize($action), $singularHumanName); ?>
			</h2>
		</div>
		<div class="box-content">
			<?php echo "<?php echo \$this->Form->create('{$modelClass}', array('class' => 'form-horizontal')); ?>".PHP_EOL; ?>
			<?php echo "<?php \$this->Form->inputDefaults(\$this->Charisma->getInputDefaults()); ?>".PHP_EOL; ?>
				<fieldset>
					<?php echo "<?php".PHP_EOL;
							foreach ($fields as $field) {
								if (strpos($action, 'add') !== false && $field == $primaryKey) {
									continue;
								} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
									if (strpos($field, 'date') !== false)
										echo "\t\t\t\t\t\techo \$this->Form->input('{$field}', \$this->Charisma->getDateOptions());".PHP_EOL;
									elseif (strpos($field, '_id') !== false)
										echo "\t\t\t\t\t\techo \$this->Form->input('{$field}', \$this->Charisma->getSelectOptions());".PHP_EOL;
									else
										echo "\t\t\t\t\t\techo \$this->Form->input('{$field}');".PHP_EOL;
								}
							}
							if (!empty($associations['hasAndBelongsToMany'])) {
								foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
									echo "\t\t\t\t\t\techo \$this->Form->input('{$assocName}', \$this->Charisma->getSelectOptions());".PHP_EOL;
								}
							}
							echo "\t\t\t\t\t?>".PHP_EOL;?>
				  <div class="form-actions">
						<?php echo "<?php echo \$this->Charisma->button(__('Save'), 'submit'); ?>".PHP_EOL ?>
						<?php echo "<?php echo \$this->Charisma->button(__('Cancel'), 'reset', 'btn'); ?>".PHP_EOL ?>
				  </div>
				</fieldset>
			  <!--</form>-->
			<?php echo "<?php echo \$this->Form->end(); ?>".PHP_EOL; ?>
		</div>
	</div><!--/span-->
</div><!--/row-->

<!-- Actions -->
<?php 
	echo "<?php \$this->append('submenu'); ?>".PHP_EOL;
	echo "<li class=\"nav-header hidden-tablet\"><?php echo __('Actions') ?></li>".PHP_EOL;
?>

<li><?php echo "<?php echo \$this->Charisma->deleteLink(__('Delete'), 
	\tarray('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), 
	\t'icon-trash'); ?>".PHP_EOL; ?></li>

<li><?php echo "<?php echo \$this->Charisma->iconLink(
	\t__('List " . $pluralHumanName . "'), 
	\tarray('action' => 'index'), 
	\t'icon-align-justify'); ?>".PHP_EOL; ?></li>
<!-- Related -->
<?php 
	echo "<li class=\"nav-header hidden-tablet\"><?php echo  __('Related') ?></li>".PHP_EOL;
?>
<?php
	$done = array();
	foreach ($associations as $type => $data) {
		foreach ($data as $alias => $details) {
			if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {

				echo "<li><?php echo \$this->Charisma->iconLink(
				__('List " . Inflector::humanize($details['controller']) . "'), 
				array('controller' => '{$details['controller']}', 'action' => 'index'), 
				'icon-align-justify'); ?>".PHP_EOL."</li>".PHP_EOL;

				echo "<li><?php echo \$this->Charisma->iconLink(
				__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), 
				array('controller' => '{$details['controller']}', 'action' => 'add'), 
				'icon-plus'); ?>".PHP_EOL."</li>".PHP_EOL;

				$done[] = $details['controller'];
			}
		}
	}
	echo "<?php \$this->end(); ?>".PHP_EOL 
?>
