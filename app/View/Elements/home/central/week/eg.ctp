<?php $management_id_session=implode("|",$management_id_session);?>
					<a href= <?php echo $this->Html->url(array("controller" => "packages", "action" => "process",9,$management_id_session)); ?> data-rel="tooltip">
						<i class="icon-eye-close">
						</i>
						<span class="blue">
							<?php echo $evaluacionGerencia; ?>
						</span>
						Evaluación Gerente Área
					</a>
		