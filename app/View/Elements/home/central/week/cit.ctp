<?php $management_id_session=implode("|",$management_id_session);?>
						<a href= <?php echo $this->Html->url(array("controller" => "packages", "action" => "process",11,$management_id_session)); ?> data-rel="tooltip">
						<i class="icon-certificate">
						</i>
						<span class="green">
							<?php echo $evaluadosCIT; ?>
						</span>
						Evaluados Gerente Calidad IT J
					</a>
				