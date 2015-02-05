
<?php echo $this->element('breadcrumbs');  ?>

<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i> <?php echo __('Packages'); ?></h2>
		</div>
		<div class="box-content">
			<table id="packages" class="table table-bordered table-striped table-condensed bootstrap-datatable datatable">
				<thead>
					<tr>
						<?php $columns = array(__('Id'), __('Number'), __('Module'), 
							__('QA Lead'), __('Status'), 
							__('Rfc'), __('Income'), __('Type'), 
							__('Start'), __('End'), __('Replanning'), __('Certified')) ;
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
						foreach ($columns as $c) { 
							echo '<th rowspan="1" colspan="1">' . PHP_EOL;
							echo "<input type=\"text\" name=\"$c\" value=\"$c\">" . PHP_EOL;
							echo '</th>' . PHP_EOL;
						} 
					?>
				</tr>
				</tfoot>
			</table>
		</div>
	</div><!--/span-->
</div><!--/row-->

<!-- Actions -->
<?php $this->append('submenu'); ?>
<li class="nav-header hidden-tablet"><?php echo __('Actions') ?></li>

<li><?php echo $this->Charisma->iconLink(__('New Package'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
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

<!-- dataTable -->
<?php echo $this->element('datatable');  ?>
<!-- Ajax fun! -->
<?php echo $this->element('packages/packages_ajax'); ?>
<!-- Package Detail with Ajax -->
<?php echo $this->element('packages/package_detail_ajax'); ?>
