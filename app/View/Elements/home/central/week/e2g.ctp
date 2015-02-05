<?php $management_id_session=implode("|",$management_id_session);?>
					<a href= <?php echo $this->Html->url(array("controller" => "packages", "action" => "process",10,$management_id_session)); ?> data-rel="tooltip">
						<i class="icon-thumbs-up">
						</i>
						<span class="green">
							<?php echo $evaluadosGerencia; ?>
						</span>
						Evaluados Gerente Área
					</a>
				