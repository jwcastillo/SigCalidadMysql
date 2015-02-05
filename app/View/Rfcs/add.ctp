<?php echo $this->element('form_scripts'); ?>

<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;
				<?php echo __('Add Rfc'); ?>
			</h2>
		</div>
		<div class="box-content">
		<div class="view">
			<?php echo $this->Form->create('Rfc', array('class' => 'form-horizontal')); ?>
			<?php $this->Form->inputDefaults($this->Charisma->getInputDefaults()); ?>
				<fieldset>
					<?php
						echo $this->Form->input('name');
						echo $this->Form->input('description', $this->Charisma->getTextAreaOptions());
						echo $this->Form->input('planning_manager_id', $this->Charisma->getSelectOptionsLabel( __('Planning VP') ) );
						echo $this->Form->input('development_manager_id', $this->Charisma->getSelectOptionsLabel( __('Technology VP') ) );
						echo $this->Form->input('project_manager_id', $this->Charisma->getSelectOptionsLabel( __('Project Management') ) );
						echo $this->Form->input('project_class_id', $this->Charisma->getSelectOptions());
						
						echo $this->Form->input('w_post', $this->Charisma->getSelectOptionsLabel( __('Postimplantation') ) );
						echo '<div id="hiddenField">';
						echo $this->Form->input('package_class_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('w_start_date',$this->Charisma->getDateOptionsLabel( __('Start Date') ) );
						echo $this->Form->input('w_end_date',$this->Charisma->getDateOptionsLabel( __('End Date') ) );
										
						echo $this->Form->input('architecture', 
						array_merge($this->Charisma->getSelectOptions(), compact('selected'))
						);

						echo $this->Form->input('w_participation_functional', $this->Charisma->getSelectOptionsLabel( __('Participation Functional') ) );
						echo $this->Form->input('w_participation_accounting', $this->Charisma->getSelectOptionsLabel( __('Participation Accounting') ) );
						echo $this->Form->input('w_priority', $this->Charisma->getSelectOptionsLabel( __('Work Queue') ) );
						
						echo '</div>';
						echo $this->Form->input('weighting');
						echo $this->Form->input('complexity_id', $this->Charisma->getSelectOptions());
						echo $this->Form->input('high_impact', $this->Charisma->getSelectOptionsLabel( __('High Impact') ) );
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
		array('action' => 'delete', $this->Form->value('Rfc.Id')), 
		'icon-trash'); ?>
</li>

<li><?php echo $this->Charisma->iconLink(
		__('List Rfcs'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo  __('Related') ?></li>
<li><?php echo $this->Charisma->iconLink(
				__('List Planning Managers'), 
				array('controller' => 'planning_managers', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Planning Manager'), 
				array('controller' => 'planning_managers', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Project Managers'), 
				array('controller' => 'project_managers', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Project Manager'), 
				array('controller' => 'project_managers', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Development Managers'), 
				array('controller' => 'development_managers', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Development Manager'), 
				array('controller' => 'development_managers', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Project Classes'), 
				array('controller' => 'project_classes', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Project Class'), 
				array('controller' => 'project_classes', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Package Classes'), 
				array('controller' => 'package_classes', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Package Class'), 
				array('controller' => 'package_classes', 'action' => 'add'), 
				'icon-plus'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('List Complexities'), 
				array('controller' => 'complexities', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Complexity'), 
				array('controller' => 'complexities', 'action' => 'add'), 
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
<?php echo $this->element('postjs'); ?>

<?php $this->append('script'); ?>
<!-- jQuery -->
<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>

<script type="text/javascript">
//<![CDATA[
	$(document).ready(function() {

		var loadUrl = "<?php echo Router::url(array('controller'=>'project_managers', 'action'=>'getList', 'ext' => 'json'));?>";

		projectManager = $("select#RfcProjectManagerId");
		developmentManager = $("select#RfcDevelopmentManagerId");

		developmentManager.val(-1).trigger("chosen:updated");
		projectManager.empty().trigger("chosen:updated");

		developmentManager.chosen().change(function() {
			developmentManagerId = this.value
			
			$.ajax({
				type: 'POST',
				url: loadUrl,
				data: {'developmentManagerId': developmentManagerId},
				success: function( data, status, xhr ) {
					projectManager.empty();
					$.each(data, function(index,item) {
					 projectManager.append('<option value="' + item.value + '">' + item.label + '</option>');
					});
					projectManager.trigger("chosen:updated");
				},
				/*error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert(textStatus);
				},*/
				dataType: "json"
			});

		});

	});
//]]>
</script>

<?php $this->end();?>

