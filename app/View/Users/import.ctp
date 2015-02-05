<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;
				<?php echo __('Import users from LDAP'); ?>
			</h2>
		</div>
		<div class="box-content">
			<?php echo $this->Form->create('User', array('class' => 'form-horizontal')); ?>
			<?php $this->Form->inputDefaults($this->Charisma->getInputDefaults()); ?>
				<fieldset>
					<?php
						echo $this->Form->input('group');
						echo $this->Form->input('user');
					?>
				  <div class="form-actions">
						<?php //echo $this->Charisma->button(__('Save'), 'submit'); ?>
						<?php //echo $this->Charisma->button(__('Cancel'), 'reset', 'btn'); ?>
						<?php echo $this->Form->button(__('Preview'), 
							array('class' => 'btn btn-primary', 'div' => false, 'type' => 'button', 'id' => 'prevButton')); ?>
						<?php echo $this->Form->button(__('Import'), 
							array('class' => 'btn btn-primary', 'div' => false, 'type' => 'submit', 'id' => 'impoButton')); ?>
						<?php echo $this->Form->button(__('Cancel'), 
							array('class' => 'btn', 'div' => false, 'type' => 'reset', 'id' => 'cancButton')); ?>
				  </div>
				</fieldset>
			  <!--</form>-->
			<?php echo $this->Form->end(); ?>
			<table id="preview" class="table table-striped table-bordered table-condensed datatable">
				<thead>
					<tr>
						<th>Usuario</th><th>Nombre</th><th>Apellido</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</div><!--/span-->
</div><!--/row-->

<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('New User'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
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


<!-- Datatable -->
<?php echo $this->element('datatable');  ?>

<?php $this->append('script'); ?>

<script type="text/javascript">
//<![CDATA[
	$(document).ready(function() {

		$('#preview').hide();
		$('#impoButton').attr('disabled', 'disabled');

		var preview = undefined;

		$('#prevButton').click(function() {
				var ex = document.getElementById('preview');
				if ($('#UserGroup').val().length > 0 && ! $.fn.DataTable.fnIsDataTable( ex )) {
				//preview.fnDestroy();
				preview = $('#preview').dataTable ( {
					//"bServerSide": true,
					"bProcessing": true,
					"sServerMethod": "POST",
					"sAjaxSource": "<?php echo Router::url(array('controller'=>'users','action'=>'import.json'));?>",
					"sAjaxDataProp": "data",
					"fnServerParams": function ( data ) {
						data.push( { "name": "group", "value": $('#UserGroup').val() } );
						data.push( { "name": "user", "value": $('#UserUser').val() } );
					},
					"aoColumns": [
						{ "mData": "User.username" },
						{ "mData": "User.firstname" },
						{ "mData": "User.lastname" }
					],
					"fnInitComplete": function(oSettings, json) {
						$('#UserGroup').attr('disabled', 'disabled');
						$('#UserUser').attr('disabled', 'disabled');
					}
			}); // Fin $('#preview').dataTable()
			$('#preview').show();
			$('#impoButton').removeAttr('disabled');
			}
		}); // Fin $('#prevButton').click()

		$("#cancButton").click(function() {
			$('#preview').hide();
			$('#impoButton').attr('disabled', 'disabled');
			$('#UserGroup').removeAttr('disabled');
			$('#UserUser').removeAttr('disabled');
			if (typeof preview !== "undefined")
				preview.fnDestroy();
		});

		$("#UserImportForm").submit(function() {
			$('#UserGroup').removeAttr('disabled');
			$('#UserUser').removeAttr('disabled');
		});
	});
//]]>
</script>
<?php $this->end(); ?>

