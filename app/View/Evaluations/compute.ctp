<?php echo $this->element('form_scripts'); ?>

<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i>&nbsp;
				<?php echo __('Compute Evaluation'); ?>
			</h2>
		</div>
		<div class="box-content">
			<?php echo $this->Form->create('Evaluation', array('class' => 'form-horizontal')); ?>
			<?php $this->Form->inputDefaults($this->Charisma->getInputDefaults()); ?>
				<fieldset>
					<?php
						echo $this->Form->input('management', $this->Charisma->getSelectOptions());
						echo $this->Form->input('month', array_merge(
							array(
								'type' => 'date',
								'dateFormat' => 'M',
								'monthNames' => $months
								),
							$this->Charisma->getSelectOptions()
						));
					?>
					<div class="form-actions">
						<?php echo $this->Charisma->button(__('Compute'), 'submit'); ?>
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

<li><?php echo $this->Charisma->iconLink(
		__('List Evaluations'), 
		array('action' => 'index'), 
		'icon-align-justify'); ?>
</li>

<?php $this->end(); ?>
