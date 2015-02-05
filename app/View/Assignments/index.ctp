<?php echo $this->element('breadcrumbs');  ?>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>&nbsp;<?php echo __('Assignments'); ?></h2>
		</div>
		<div class="box-content">
			<table id="ajax-table" class="table table-striped table-bordered">
				<thead>
					<tr>
						<?php $columns = array(__('Id'), __('Rfc'), __('QA Lead'), 
							__('Start'),__('End')) ;
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

<li><?php echo $this->Charisma->iconLink(__('New Assignment'), 
		array('action' => 'add'), 
		'icon-plus'); ?>
</li>
<!-- Related -->
<li class="nav-header hidden-tablet"><?php echo __('Related') ?></li>
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
<?php echo $this->element('datatable_ajax'); ?>
<!-- Package Detail with Ajax -->
<?php echo $this->element('details_ajax'); ?>