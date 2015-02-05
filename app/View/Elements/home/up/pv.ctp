
<?php $management_id_session1=implode("|",$management_id_session);?>

	<div title="Paquetes por Vencer" class="well span3 top-block" >
		<span class="icon32 icon-color  icon-calendar"></span>
		
		<?php if(in_array($employee_id_session,$manager_id)) { ?>
<div>
		<?php echo $this->Html->link(__('About to Expire / Expired'),
			array('controller' => 'packages',"action" =>  'process',8,$management_id_session1));
		?>
		</div>
		<?php
			echo $this->Charisma->spanLink($pv3,
			array("controller" => "packages", "action" =>"process", 7 , 
			$management_id_session1), 
			'notification red'
			);
		?>
		<?php
			echo $this->Charisma->spanLink($pv2,
			array("controller" => "packages", "action" =>"process", 6 , 
			$management_id_session1), 
			'notification yellow'
			);
		?>
		<?php
			echo $this->Charisma->spanLink($pv1,
			array("controller" => "packages", "action" =>"process", 5 , 
			$management_id_session1), 
			'notification green'
			);
		?>
	


		<?php }	
		else { ?>
<div>
	<?php echo $this->Html->link(__('About to Expire / Expired'),
		array('controller' => 'packages',"action" =>  'process',8,$management_id_session1,$employee_id_session));
		?>
		</div>
	<?php
			echo $this->Charisma->spanLink($pv3,
			array("controller" => "packages", "action" =>"process", 7 , 
			$management_id_session1,$employee_id_session), 
			'notification red'
			);
		?>
		<?php
			echo $this->Charisma->spanLink($pv2,
			array("controller" => "packages", "action" =>"process", 6 , 
			$management_id_session1,$employee_id_session), 
			'notification yellow'
			);
		?>
		<?php
			echo $this->Charisma->spanLink($pv1,
			array("controller" => "packages", "action" =>"process", 5 , 
			$management_id_session1,$employee_id_session), 
			'notification green'
			);
		?>

	
<?php 
	} ?>
	</div>
	
