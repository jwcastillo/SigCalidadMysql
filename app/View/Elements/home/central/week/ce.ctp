<?php $management_id_session=implode("|",$management_id_session);?>
					<?php if(in_array($employee_id_session,$manager_id)){ ?>

				<a href= <?php echo $this->Html->url(array("controller" => "packages", "action" => "process",2,$management_id_session)); ?> data-rel="tooltip">
						<?php }	
		else { ?>
<a href= <?php echo $this->Html->url(array("controller" => "packages", "action" => "process",2,$management_id_session,$employee_id_session)); ?> data-rel="tooltip">
		<?php }	 ?>
						<i class="icon-check">
						</i>
						<span class="green">
							<?php echo $certificados; ?>
						</span>
						Certificados
					</a>
