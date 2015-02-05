<?php $management_id_session1=implode("|",$management_id_session);?>
					<a href= <?php echo $this->Html->url(array('controller' => 'packages',"action" =>  'promoted', -1,$management_id_session1 ), array());?>>
						<i class="icon-share">
						</i>
						<span class="red">
							<?php echo $sinAsignar; ?>
						</span>
						Sin Asignar
					</a>

				