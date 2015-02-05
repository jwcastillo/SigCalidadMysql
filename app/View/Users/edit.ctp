<?php echo $this->element('form_scripts'); ?>

<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;
				<?php echo __('Edit User'); ?>
			</h2>
		</div>
		<div class="box-content">
			<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
			<?php $this->Form->inputDefaults($this->Charisma->getInputDefaults()); ?>
				<fieldset>
					<?php
						echo $this->Form->input('id');
						echo $this->Form->input('username');
						echo $this->Form->input('firstname');
						echo $this->Form->input('lastname');
						echo $this->Form->input('email');
						echo $this->Form->input('department');
						echo $this->Form->input('password');
						echo $this->Form->input('group_id', $this->Charisma->getSelectOptions());
					?>
				  <div class="form-actions">
						<?php echo $this->Charisma->button(__('Save'), 'submit'); ?>
						<?php echo $this->Charisma->button(__('Cancel'), 'reset', 'btn'); ?>
				  </div>
				</fieldset>
			  <!--</form>-->
			<?php echo $this->Form->end(); ?>
		</div>
	</div><!--/span-->
</div><!--/row-->

<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->deleteLink(__('Delete'), 
		array('action' => 'delete', $this->Form->value('User.id')), 
		'icon-trash'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
		__('List Users'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo  __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Groups'), 
				array('controller' => 'groups', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Group'), 
				array('controller' => 'groups', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<?php $this->end(); ?>
