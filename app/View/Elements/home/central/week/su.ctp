<?php $management_id_session=implode("|",$management_id_session);?>
				
	<?php if(in_array($employee_id_session,$manager_id)){ ?>
					<a href= <?php echo $this->Html->url(array("controller" => "observations", "action" => "viewSuspended",$management_id_session)); ?> data-rel="tooltip">
				

						<?php }	
		else { ?>
	<a href= <?php echo $this->Html->url(array("controller" => "observations", "action" => "viewSuspended",0,$employee_id_session)); ?> data-rel="tooltip">

		<?php }	 ?>
						<i class="icon-stop">
						</i>
						<span class="yellow">
							<?php echo $suspendidos; ?>
						</span>
						Suspendidos
					</a>
			