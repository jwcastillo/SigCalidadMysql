<?php $management_id_session=implode("|",$management_id_session);?>
					<?php if(in_array($employee_id_session,$manager_id)){ ?>

					<a href= <?php echo $this->Html->url(array("controller" => "packages", "action" => "process",3,$management_id_session)); ?> data-rel="tooltip">

						<?php }	
		else { ?>
		<a href= <?php echo $this->Html->url(array("controller" => "packages", "action" => "process",3,$management_id_session,$employee_id_session )); ?> data-rel="tooltip">

					<?php }	 ?>
						<i class="icon-warning-sign">
						</i>
						<span class="red">
							<?php echo $vencidos; ?>
						</span>
						Vencidos
					</a>
			