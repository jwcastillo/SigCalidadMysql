<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;<?php echo sprintf(__("%s permissions"), $aroAlias); ?></h2>
		</div>
		<div class="box-content">
			<?php echo $this->Form->create('Perms'); ?>
			<?php $this->Form->inputDefaults($this->Charisma->getInputDefaults()); ?>
			<p class="center">
			<?php
				echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
			?>
			</p>
			<div class="pagination pagination-centered">
				<ul>
				<?php 
					echo $this->Paginator->prev(__('Prev'), array('tag' => 'li'), null, 
						array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'prev disabled'));
					echo $this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 'currentClass'=> 'active', 'separator' => ''));
					echo $this->Paginator->next(__('Next'), array('tag' => 'li'), null, 
						array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'next disabled'));
				?>
				</ul>
			</div>
			<table class="table table-bordered table-striped table-condensed acl">
			<thead>
			<?php $groups = array(); ?>
			<tr>
				<th><?php echo __('Action') ?></th>
				<?php foreach ($aros as $aro): ?>
				<?php $aro = array_shift($aro); ?>
				<?php $groups[] = h($aro[$aroDisplayField]); ?>
				<th><?php echo h($aro[$aroDisplayField]); ?></th>
				<?php endforeach; ?>
			</tr>
			</thead>
			<tbody>
			<?php $x = 0; ?>
			<?php
			$uglyIdent = Configure::read('AclManager.uglyIdent'); 
			$lastIdent = null;
			foreach ($acos as $id => $aco) {
				$action = $aco['Action'];
				$alias = $aco['Aco']['alias'];
				$ident = substr_count($action, '/'); ?>
				<?php 
					if($ident == 1):
						$x++; 
						if ($x % 2 == 0):
				?>
				<tr>
					<th><strong><?php echo __('Action') ?></strong></td>
					<?php foreach ($groups as $g): ?>
						<td><strong><?php echo $g; ?></strong></td>
					<?php endforeach; ?>
				</tr>
				<?php endif; ?>
				<?php endif; ?>
				<tr>
				<td><?php echo ($ident == 1 ? "<strong>" : "" ) . ($uglyIdent ? str_repeat("&nbsp;&nbsp;", $ident) : "") . h($alias) . ($ident == 1 ? "</strong>" : "" ); ?></td>
				<?php foreach ($aros as $aro): 
					$inherit = $this->Form->value("Perms." . str_replace("/", ":", $action) . ".{$aroAlias}:{$aro[$aroAlias]['id']}-inherit");
					$allowed = $this->Form->value("Perms." . str_replace("/", ":", $action) . ".{$aroAlias}:{$aro[$aroAlias]['id']}"); 
					$value = $inherit ? 'inherit' : null; 
					$icon = $this->Html->image(($allowed ? 'test-pass-icon.png' : 'test-fail-icon.png')); ?>
					<td>
					<?php 
						echo $icon . " ";
						echo $this->Form->select("Perms." . str_replace("/", ":", $action) . ".{$aroAlias}:{$aro[$aroAlias]['id']}", 
							array(array('inherit' => __('Inherit'), 'allow' => __('Allow'), 'deny' => __('Deny'))), 
							array_merge($this->Charisma->getSelectOptions(), array('empty' => __('No change'), 'value' => $value)) ); 
					?>
					</td>
				<?php endforeach; ?>
				</tr>
			<?php } ?>
			</tbody>
			</table>
			<p class="center">
			<?php echo $this->Form->button(__('Save'), 
							array('class' => 'btn btn-primary', 'div' => false, 'type' => 'submit')); ?>
			</p>
			<p class="center">
			<?php
				echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
			?>
			</p>
			<div class="pagination pagination-centered">
				<ul>
				<?php 
					echo $this->Paginator->prev(__('Prev'), array('tag' => 'li'), null, 
						array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'prev disabled'));
					echo $this->Paginator->numbers(array('tag' => 'li', 'currentTag' => 'a', 'currentClass'=> 'active', 'separator' => ''));
					echo $this->Paginator->next(__('Next'), array('tag' => 'li'), null, 
						array('tag' => 'li', 'disabledTag' => 'a', 'class' => 'next disabled'));
				?>
				</ul>
			</div>
		</div>
	</div><!--/span-->
</div><!--/row-->

<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Manage'); ?></li>
<?php 
$aroModels = Configure::read("AclManager.aros");
if ($aroModels > 1): 
	foreach ($aroModels as $aroModel): ?>
		<li>
			<?php echo $this->Html->link(
								$this->Html->tag('i', '', array('class' => ' icon-pencil')) .  
								$this->Html->tag('span', ' ' . __($aroModel), array('class' => 'hidden-tablet')), 
								array('aro' => $aroModel), array('escape' => false)); ?>
		</li>
	<?php endforeach; ?>
<?php endif; ?>

<li class="nav-header hidden-tablet"><?php echo __('Actions'); ?></li>

<li><?php echo $this->Charisma->iconLink(
				__('Manage permissions'), 
				array('action' => 'permissions'), 
				'icon-lock'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
				__('Update ACOs'), 
				array('action' => 'update_acos'), 
				'icon-refresh'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
				__('Update AROs'), 
				array('action' => 'update_aros'), 
				'icon-refresh'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
				__('Drop ACOs/AROs'), 
				array('action' => 'drop'), 
				'icon-remove'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
				__('Drop permissions'), 
				array('action' => 'drop_perms'), 
				'icon-remove'); ?>
</li>

<?php $this->end(); ?>

<?php $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>
<!-- jQuery noty -->
<?php echo $this->Html->script('jquery.noty.packaged.min', array('once' => true)); ?>

<script type="text/javascript">
//<![CDATA[
	$(document).ready(function() {

		var url = "<?php echo Router::url(array('plugin' => false, 
			'controller' => 'users', 'action'=> 'updatePermissions'));?>";

		var failIcon = '<?php echo $this->webroot; ?>img/test-fail-icon.png';
		var passIcon = '<?php echo $this->webroot; ?>img/test-pass-icon.png';

		$('form#PermsPermissionsForm select').focus(function() {
			$(this).attr('prevValue', $(this).val());
		});

		$('form#PermsPermissionsForm select').change(function(event) {

			var select = $(this);
			var image = select.prev();
			var prev = $(this).attr("prevValue");

			if ( ! $(this).val() ) return false;

			$.ajax({
				type: 'POST',
				url: url, // This is the url that will be requested

				// This is an object of values that will be passed as GET variables and 
				// available inside changeStatus.php as $_GET['selectFieldValue'] etc...
				data: select.serializeArray(),

				// This is what to do once a successful request has been completed - if 
				// you want to do nothing then simply don't include it. But I suggest you 
				// add something so that your use knows the db has been updated
				success: function(data) { 
					//alert(data.status);
					if (data.status == 'error') {
						select.val(prev);
					}
					/*if (data.status == 'success') {
						alert(data.message);
					}*/

					if (data.data.message)
							//alert(data.data.message);
						noty({
							type: data.status, 
							text: data.data.message,
							timeout: 700
						});

					if (data.data.check && image.attr('src') == failIcon) 
						image.attr('src', passIcon);
					
					if (!data.data.check && image.attr('src') != failIcon) 
						image.attr('src', failIcon);
				},
				dataType: 'json'
			}); // End of ajax

		}); // End of change

	}); // End of ready
//]]>
</script>
<?php $this->end(); ?>
