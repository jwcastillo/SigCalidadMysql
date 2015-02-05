<?php echo $this->element('form_scripts'); ?>

<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">
	<div class="box span6">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-search"></i>&nbsp;<?php echo __('Package'); ?>
			</h2>
		</div>
		<div class="box-content">
			<dl class="view">
				<dt><h4><?php echo __('Number Package'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['number_package']); ?></dd>

				<dt><h4><?php echo __('Module'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['Module']['name'], 
					array('controller' => 'modules', 'action' => 'view', $package['Module']['id'])); ?></dd>

				<dt><h4><?php echo __('QA Lead'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['Package']['employee'], 
					array('controller' => 'employees', 'action' => 'view', $package['Employee']['id'])); ?></dd>

				<dt><h4><?php echo __('Package Status'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['PackageStatus']['name'], 
					array('controller' => 'package_statuses', 'action' => 'view', $package['PackageStatus']['id'])); ?></dd>

				<dt><h4><?php echo __('Rfc'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['Rfc']['name'], 
					array('controller' => 'rfcs', 'action' => 'view', $package['Rfc']['id'])); ?></dd>

				<dt><h4><?php echo __('Entry Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['entry_date']); ?></dd>

				<dt><h4><?php echo __('Management Entry Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['management_entry_date']); ?></dd>

				<dt><h4><?php echo __('Assignment Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['assignment_date']); ?></dd>

				<dt><h4><?php echo __('Start Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['start_date']); ?></dd>

				<dt><h4><?php echo __('End Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['end_date']); ?></dd>

				<dt><h4><?php echo __('Replanning Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['replanning_date']); ?></dd>

				<dt><h4><?php echo __('Certified Date'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['certified_date']); ?></dd>

				<dt><h4><?php echo __('Components'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['components']); ?></dd>

				<dt><h4><?php echo __('Components Amount'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['components_amount']); ?></dd>

				<dt><h4><?php echo __('Weighting'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['weighting']); ?></dd>

				<dt><h4><?php echo __('Final Weighting'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['final_weighting']); ?></dd>

				<dt><h4><?php echo __('Current State'); ?></h4></dt>
				<dd>&nbsp;<?php echo h($package['Package']['current_stage']); ?></dd>

				<dt><h4><?php echo __('Management'); ?><h4></dt>
				<dd>&nbsp;<?php echo $this->Html->link($package['Management']['name'], array('controller' => 'managements', 'action' => 'view', $package['Management']['id'])); ?></dd>
			</dl>
		</div>
	</div><!--/span-->

<div class="box span6">
	<div data-original-title="" class="box-header well">
		<h2><i class="icon-edit"></i>&nbsp;<?php echo __('Set Quality Values'); ?>
	</div>
	<div class="box-content">
	<?php echo $this->Form->create('Package', array('class' => 'form-horizontal')); ?>
	<?php $this->Form->inputDefaults($this->Charisma->getInputDefaults()); ?>
		<fieldset>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('overfulfillment_quality');
				echo $this->Form->input('deviation_quality');
				echo $this->Form->input('UnsatisfactoryStatus', $this->Charisma->getSelectOptions());
				echo $this->Form->input('final_weighting', array('type' => 'hidden'));
				echo $this->Form->input('number_package', array('type' => 'hidden'));
				echo $this->Form->input('parent');
				echo $this->Form->input('parent_id', array('type' => 'hidden'));
				echo $this->Form->input('package_status_id', array('type' => 'hidden'));
				echo $this->Form->input('observations', array('type' => 'textarea'), array(
    'textarea' => 'autogrow'));
			?>
			<div class="form-actions">
				<?php echo $this->Charisma->button(__('Save'), 'submit'); ?>
				<?php echo $this->Charisma->button(__('Cancel'), 'reset', 'btn'); ?>
			</div>
		</fieldset>
	<?php echo $this->Form->end(); ?>
	<!--</form>-->
	</div>
</div>

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
				__('List Unsatisfactory Qualities'), 
				array('controller' => 'unsatisfactory_qualities', 'action' => 'index'), 
				'icon-align-justify'); ?>
</li>
<li><?php echo $this->Charisma->iconLink(
				__('New Unsatisfactory Quality'), 
				array('controller' => 'unsatisfactory_qualities', 'action' => 'add'), 
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
<?php $this->end(); ?>

<?php $this->append('script'); ?>

<?php echo $this->Html->script('jquery-1.10.2.min', array('once' => true)); ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	/* Parent package */

	var loadUrl = "<?php echo Router::url(array('controller'=>'packages', 'action'=>'getList.json'));?>";

	var cache = {};

	$("input#PackageParent").autocomplete({
		minLength: 2,
		source: function( request, response ) {

			var term = request.term;
			if ( term in cache ) {
				response( cache[ term ] );
				return;
			}

			$.post( loadUrl, request, function( data, status, xhr ) {
				cache[ term ] = data;
				response( data );
			}, 'json');
		},

		select: function(e, ui) {
		    e.preventDefault() // <--- Prevent the value from being inserted.
		    $("input#PackageParentId").val(ui.item.value);

		    $(this).val(ui.item.label);
		}

	});


	/* Unsatisfactory Statuses */

	var sel = $( 'select#UnsatisfactoryStatusUnsatisfactoryStatus' );

	if (sel.val()) {
		flag = false;
		length = sel.val().length;

		if (sel.val().indexOf('1') != -1)
			flag = true;

	} else {
		flag = true;
		length = 1;
		sel.val(['1']);
		sel.trigger("chosen:updated");
	}

	sel.chosen().change(function() {

		if ($(this).val()) {
			currentLength = $(this).val().length;
			currentElements = $(this).val();
		}
		else
			currentLength = 0;

		if (flag && (length < currentLength)) {
			currentElements = currentElements.splice(- 1, 1);
			flag = false;
			length = currentLength - 1;
			$(this).val(currentElements);
			$(this).trigger("chosen:updated");
		}

		if (currentElements.indexOf('1') != -1 || (currentLength == 0 && !flag) ) {
			flag = true;
			length = 1;
			currentElements = ['1'];
			$(this).val(currentElements);
			$(this).trigger("chosen:updated");
		}

	});
	
});

//]]>
</script>
<?php $this->end(); ?>