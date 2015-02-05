<?php echo $this->element('form_scripts'); ?>

<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;
				<?php echo __('Edit Package'); ?>
			</h2>
		</div>
		<div class="box-content">
			<div class="view">
				<?php 
					echo $this->Form->create('Package', array('class' => 'form-horizontal', 'default' => false));
					$this->Form->inputDefaults($this->Charisma->getInputDefaults()); 
				?>
				<fieldset>
					<?php
						echo $this->Form->input('id');
						echo $this->Form->input('weighting');
						echo $this->Form->input('start_date', $this->Charisma->getDateOptions());
						echo $this->Form->input('end_date', $this->Charisma->getDateOptions());
						echo $this->Form->input('assignment_date', $this->Charisma->getDateOptions());
						echo $this->Form->input('replanning');
						echo $this->Form->input('replanning_date', $this->Charisma->getDateOptions());
						echo $this->Form->input('certified_date', $this->Charisma->getDateOptions());
					?>
					</fieldset>
				</div>
				<div class="form-actions">
					<?php 
						echo $this->Charisma->button(__('Save'), 'submit');
						echo $this->Charisma->button(__('Cancel'), 'reset', 'btn');
						echo $this->Form->end(); 
					?><!--</form>-->
				</div>
		</div>
	</div><!--/span-->
</div><!--/row-->

<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->deleteLink(__('Delete'), 
		array('action' => 'delete', $this->Form->value('Package.id')), 
		'icon-trash'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
		__('List Packages'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo  __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Modules'), 
				array('controller' => 'modules', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Module'), 
				array('controller' => 'modules', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Employees'), 
				array('controller' => 'employees', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Employee'), 
				array('controller' => 'employees', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Package Statuses'), 
				array('controller' => 'package_statuses', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Package Status'), 
				array('controller' => 'package_statuses', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Rfcs'), 
				array('controller' => 'rfcs', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Rfc'), 
				array('controller' => 'rfcs', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Unsatisfactory Productions'), 
				array('controller' => 'unsatisfactory_productions', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Unsatisfactory Production'), 
				array('controller' => 'unsatisfactory_productions', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Respondents'), 
				array('controller' => 'respondents', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Respondent'), 
				array('controller' => 'respondents', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Evaluation States'), 
				array('controller' => 'evaluation_states', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Evaluation State'), 
				array('controller' => 'evaluation_states', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Final Statuses'), 
				array('controller' => 'final_statuses', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Final Status'), 
				array('controller' => 'final_statuses', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Managements'), 
				array('controller' => 'managements', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Management'), 
				array('controller' => 'managements', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Unsatisfactory Qualities'), 
				array('controller' => 'unsatisfactory_qualities', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Unsatisfactory Quality'), 
				array('controller' => 'unsatisfactory_qualities', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<?php $this->end(); ?>