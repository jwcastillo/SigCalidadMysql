<?php echo $this->element('form_scripts'); ?>

<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;
				<?php echo __('Edit Module'); ?>
			</h2>
		</div>
		<div class="box-content">
			<?php echo $this->Form->create('Module', array('class' => 'form-horizontal')); ?>
			<?php $this->Form->inputDefaults($this->Charisma->getInputDefaults()); ?>
				<fieldset>
					<?php
						echo $this->Form->input('id');
						echo $this->Form->input('name');
						echo $this->Form->input('area_id', $this->Charisma->getSelectOptions());
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
		array('action' => 'delete', $this->Form->value('Module.id')), 
		'icon-trash'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
		__('List Modules'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo  __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Areas'), 
				array('controller' => 'areas', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Area'), 
				array('controller' => 'areas', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Packages'), 
				array('controller' => 'packages', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Package'), 
				array('controller' => 'packages', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<?php $this->end(); ?>
