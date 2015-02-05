<?php echo "<?php echo \$this->element('breadcrumbs');  ?>".PHP_EOL; ?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i>&nbsp;<?php echo "<?php echo __('{$singularHumanName}'); ?>"; ?></h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl class="view">
<?php
foreach ($fields as $field) {
	$isKey = false;
	if (!empty($associations['belongsTo'])) {
		foreach ($associations['belongsTo'] as $alias => $details) {
			if ($field === $details['foreignKey']) {
				$isKey = true;
				echo "\t\t\t\t<dt><h4><?php echo __('" . Inflector::humanize(Inflector::underscore($alias)) . "'); ?><h4></dt>".PHP_EOL;
				echo "\t\t\t\t<dd>&nbsp;<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], 
					array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?></dd>".PHP_EOL;
				break;
			}
		}
	}
	if ($isKey !== true) {
		echo "\t\t\t\t<dt><h4><?php echo __('" . Inflector::humanize($field) . "'); ?></h4></dt>".PHP_EOL;
		echo "\t\t\t\t<dd>&nbsp;<?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?></dd>\n".PHP_EOL;
	}
}
?>
			</dl>
			</div>									 
		</div>
	</div><!--/span-->
</div><!--/row-->
<!-- Actions -->
<?php 
	echo "<?php \$this->append('submenu'); ?>".PHP_EOL;
	echo "<li class=\"nav-header hidden-tablet\"><?php echo __('Actions') ?></li>".PHP_EOL;
?>

<li><?php echo "<?php echo \$this->Charisma->iconLink(__('Edit " . $singularHumanName . "'), 
	\tarray('action' => 'edit',	\${$singularVar}['{$modelClass}']['{$primaryKey}']), 
	\t'icon-pencil'); ?>".PHP_EOL; ?></li>

<li><?php echo "<?php echo \$this->Charisma->deleteLink(__('Delete " . $singularHumanName . "'), 
	\tarray('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), 
	\t'icon-trash'); ?>".PHP_EOL; ?></li>
					
<li><?php echo "<?php echo \$this->Charisma->iconLink(__('List " . $pluralHumanName . "'), 
	\tarray('action' => 'index'), 
	\t'icon-align-justify'); ?>".PHP_EOL; ?></li>

<li><?php echo "<?php echo \$this->Charisma->iconLink( __('New " . $singularHumanName . "'), 
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

				echo "\t\t<li><?php echo \$this->Charisma->iconLink(__('List " . Inflector::humanize($details['controller']) . "'), 
					\tarray('controller' => '{$details['controller']}', 'action' => 'index'), 
					\t'icon-align-justify'); ?></li>".PHP_EOL;

				echo "\t\t<li><?php echo \$this->Charisma->iconLink(
					__('New " . Inflector::humanize(Inflector::underscore($alias)) . "'), 
					\tarray('controller' => '{$details['controller']}', 'action' => 'add'), 'icon-plus'); ?></li>".PHP_EOL;

				$done[] = $details['controller'];
			}
		}
	}

	echo "<?php \$this->end(); ?>".PHP_EOL 
?>

<!-- Relationships -->

<?php
if (!empty($associations['hasOne'])) :
	foreach ($associations['hasOne'] as $alias => $details): ?>
<!-- Has one -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo "<?php echo __('Related " . Inflector::humanize($details['controller']) . "'); ?>"; ?>
			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
			<dl>
			<?php
				foreach ($details['fields'] as $field) {
					echo "\t\t<dt><h4><?php echo __('" . Inflector::humanize($field) . "'); ?></dt>".PHP_EOL;
					echo "\t\t<dd><?php echo \${$singularVar}['{$alias}']['{$field}']; ?>&nbsp;</dd>".PHP_EOL;
				}
			?>
			</dl>
			</div>
		</div>
	</div>
</div>

<?php
	endforeach;
endif;
?>

<?php

if (empty($associations['hasMany'])) {
	$associations['hasMany'] = array();
}
if (empty($associations['hasAndBelongsToMany'])) {
	$associations['hasAndBelongsToMany'] = array();
}
$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
foreach ($relations as $alias => $details):
	$otherSingularVar = Inflector::variable($alias);
	$otherPluralHumanName = Inflector::humanize($details['controller']);
?>
<!-- Has many -->
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-th"></i> 
				<?php echo "<?php echo __('Related " . $otherPluralHumanName . "'); ?>"; ?>
			</h2>
		</div>
		<div class="box-content">
			<div class="row-fluid">
				<?php echo "<?php if (!empty(\${$singularVar}['{$alias}'])): ?>".PHP_EOL; ?>
				<table class="table table-bordered table-striped table-condensed">
					<thead>
						<tr>
<?php
								foreach ($details['fields'] as $field) {
									echo "\t\t\t\t\t\t\t<th><?php echo __('" . Inflector::humanize($field) . "'); ?></th>".PHP_EOL;
								}
							?>
							<th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
						</tr>
					</thead>
					<tbody>
<?php
							echo "\t\t\t\t\t<?php foreach (\${$singularVar}['{$alias}'] as \${$otherSingularVar}): ?>".PHP_EOL;
								echo "\t\t\t\t\t<tr>".PHP_EOL;
									foreach ($details['fields'] as $field) {
										echo "\t\t\t\t\t\t<td><?php echo \${$otherSingularVar}['{$field}']; ?></td>".PHP_EOL;
									}

									echo "\t\t\t\t\t\t<td class=\"actions center\">".PHP_EOL;

									echo "\t\t\t\t\t\t\t<?php echo \$this->Charisma->iconButton(__('View'), 
										array('controller' => '{$details['controller']}', 
										'action' => 'view', \${$otherSingularVar}['{$details['primaryKey']}']), 
										'icon-zoom-in icon-white', 'btn btn-small btn-success'); ?>".PHP_EOL;

									echo "\t\t\t\t\t\t\t<?php echo \$this->Charisma->iconButton(__('Edit'),
										array('controller' => '{$details['controller']}', 'action' => 
											'edit', \${$otherSingularVar}['{$details['primaryKey']}']),
										'icon-edit icon-white', 'btn btn-small btn-info'); ?>".PHP_EOL;

									echo "\t\t\t\t\t\t\t<?php echo \$this->Charisma->deleteButton(__('Delete'), 
										array('controller' => '{$details['controller']}', 'action' => 'delete', 
										\${$otherSingularVar}['{$details['primaryKey']}']), 
										'icon-trash icon-white', 'btn btn-small btn-danger'); ?>".PHP_EOL;

									echo "\t\t\t\t\t\t</td>".PHP_EOL;

								echo "\t\t\t\t\t</tr>".PHP_EOL;

						echo "\t\t\t\t\t<?php endforeach; ?>".PHP_EOL;
						?>
					</tbody>
				</table>
				<?php echo "<?php endif; ?>".PHP_EOL; ?>
			</div>
		</div>
	</div>
</div>
<?php endforeach; ?>