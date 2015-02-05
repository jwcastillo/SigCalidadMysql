<?php $management_id_session1=implode("|",$management_id_session); ?>

<div class="well span3 top-block" >
	<span class="icon32 icon-color icon-edit"></span>

	<?php if(in_array($employee_id_session,$manager_id)) {?>
	<div>
		<?php echo $this->Html->link(__('In progress'), 
			array('controller' => 'packages', 'action' =>  'process',1, $management_id_session1));
		?>
	</div>
	<?php
		echo $this->Charisma->spanLink($enProceso2,
			array("controller" => "packages", "action" => "process", 1, $management_id_session1), 
			'notification'
			);
	?>

	<?php } else { ?>
		<div>
			<?php echo $this->Html->link(__('In progress'), 
			array('controller' => 'packages',"action" =>  'process', 1, $management_id_session1, $employee_id_session));?>
		</div>
		<?php
			echo $this->Charisma->spanLink($enProceso2,
				array("controller" => "packages", "action" => "process", 1, $management_id_session1, $employee_id_session), 
				'notification', array('data-rel' => 'tooltip', 'data-original-title'=> $enProceso2)
			);
		?>

	<?php }	 ?>
</div>
