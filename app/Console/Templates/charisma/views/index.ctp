<?php echo "<?php echo \$this->element('breadcrumbs');  ?>".PHP_EOL; ?>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>&nbsp;<?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
<?php foreach ($fields as $field): ?>
						<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
<?php endforeach; ?>
						<th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
					</tr>
				</thead>	
				<tbody>
<?php
					echo "\t\t\t\t\t<?php foreach (\${$pluralVar} as \${$singularVar}): ?>".PHP_EOL;
					echo "\t\t\t\t\t<tr>".PHP_EOL;
						foreach ($fields as $field) {
							$isKey = false;
							if (!empty($associations['belongsTo'])) {
								foreach ($associations['belongsTo'] as $alias => $details) {
									if ($field === $details['foreignKey']) {
										$isKey = true;
										echo "\t\t\t\t\t\t<td><?php echo \$this->Html->link(
											\${$singularVar}['{$alias}']['{$details['displayField']}'], 
											array('controller' => '{$details['controller']}', 'action' => 'view', 
											\${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?></td>".PHP_EOL;
										break;
									}
								}
							}
							if ($isKey !== true) {
								echo "\t\t\t\t\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>".PHP_EOL;
							}
						}

						echo "\t\t\t\t\t\t<td class=\"actions center\">".PHP_EOL;

							echo "\t\t\t\t\t\t\t<?php echo \$this->Charisma->iconButton(__('View'), 
								array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), 
								'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>".PHP_EOL;

							echo "\t\t\t\t\t\t\t<?php echo \$this->Charisma->iconButton(__('Edit'),
								array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), 
								'icon-edit icon-white', 'btn btn-small btn-info'); ?>".PHP_EOL;

							echo "\t\t\t\t\t\t\t<?php echo \$this->Charisma->deleteButton(__('Delete'), 
								array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), 
								'icon-trash icon-white', 'btn btn-small btn-danger'); ?>".PHP_EOL;

						echo "\t\t\t\t\t\t</td>".PHP_EOL;

					echo "\t\t\t\t\t</tr>".PHP_EOL;

					echo "\t\t\t\t\t<?php endforeach; ?>".PHP_EOL;
				?>
				</tbody>
			</table>
			<div class="pagination pagination-centered">
			 <ul>
			 <?php
				 echo "<?php".PHP_EOL;
				 echo "\t\t\t\t\techo \$this->Paginator->prev(__('Prev'), 
				 	array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'prev disabled'));".PHP_EOL;
				 echo "\t\t\t\t\techo \$this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 
				 	'currentClass'=> 'active', 'separator' => ''));".PHP_EOL;
				 echo "\t\t\t\t\techo \$this->Paginator->next(__('Next'), 
				 	array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'next disabled'));".PHP_EOL;
				 echo "\t\t\t\t?>".PHP_EOL;
			 ?>
			 </ul>
			</div>
			<div class="row-fluid">
				<div class="span12">
<?php 
						echo "\t\t\t\t\t<?php echo \$this->Paginator->counter(__(
						'Page {:page} of {:pages}, showing {:current} records out of
						{:count} total, starting on record {:start}, ending on {:end}')); ?>".PHP_EOL;
					?>
				</div>
				<div class="span12 center"></div>
			</div>
		</div>
	</div><!--/span-->
</div><!--/row-->

<!-- Actions -->
<?php 
	echo "<?php \$this->append('submenu'); ?>".PHP_EOL;
	echo "<li class=\"nav-header hidden-tablet\"><?php echo __('Actions') ?></li>".PHP_EOL;
?>

<li><?php echo "<?php echo \$this->Charisma->iconLink(__('New " . $singularHumanName . "'), 
	\tarray('action' => 'add'), 
	\t'icon-plus'); ?>".PHP_EOL; ?></li>
<!-- Related -->
<?php 
	echo "<li class=\"nav-header hidden-tablet\"><?php echo __('Related') ?></li>".PHP_EOL;
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