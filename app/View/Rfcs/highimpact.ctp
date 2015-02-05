<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>&nbsp;<?php echo __('Rfcs'); ?></h2>
		</div>
		<div class="box-content">
			<table id="ajax-table" class="table table-striped table-bordered">
				<thead>
					<tr>
						<?php $columns = array(__('Id'), __('Name'), __('Planning VP'), 
							__('Technology VP'), __('Project Management'),
							__('Project Class'), __('Package Class'), __('Complexity'), 
							__('Weighting'),__('High Impact')) ;
						?>
						<?php 
							foreach ($columns as $c) { 
								echo "<th>$c</th>" . PHP_EOL;
							} 
						?>
					</tr>
				</thead>	
				<tbody>

				</tbody>
				<tfoot>
				<tr>
					<?php 
						/*foreach ($columns as $c) { 
							echo '<th rowspan="1" colspan="1">' . PHP_EOL;
							echo "<input type=\"text\" name=\"$c\" value=\"$c\">" . PHP_EOL;
							echo '</th>' . PHP_EOL;
						} */
					?>
				</tr>
				</tfoot>
			</table>

			</div>
		</div>
	</div><!--/span-->
</div><!--/row-->

<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('New Rfc'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
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

<!-- dataTable -->
<?php echo $this->element('datatable');  ?>
<!-- Ajax fun! -->
<?php echo $this->element('datatable_ajax'); ?>
<!-- Package Detail with Ajax -->
<?php echo $this->element('details_ajax'); ?>