<?php $management_id_session1=implode("|",$management_id_session);

?>
						<?php   if(in_array($employee_id_session,$manager_id)){ ?>

												<a href= <?php echo $this->Html->url(array("controller" => "packages", "action" => "process",1,$management_id_session1)); ?> data-rel="tooltip">

								<?php } else { ?>
											
											<a href= <?php echo $this->Html->url(array("controller" => "packages", "action" => "process",1,$management_id_session1,$employee_id_session)); ?> data-rel="tooltip">
								
							<?php 	}		?>
						<i class="icon-edit">
						</i>
						<span class="yellow">
							<?php echo $enProceso; ?>
						</span>
						En Proceso
					</a>

