<?php $management_id_session1=implode("|",$management_id_session);?>

	<div class="well span3 top-block">
		<span class="icon32 icon-color icon-share"></span>
		<div>
			<?php echo $this->Html->link(__('Unassigned'),
			array('controller' => 'packages',"action" =>  'promoted', 0 , $management_id_session1));
			?>
		</div>
		<?php
			echo $this->Charisma->spanLink($pa3,
			array("controller" => "packages", "action" =>"promoted", 3 , 
			$management_id_session1), 
			'notification red'
			);
		?>
		<?php
			echo $this->Charisma->spanLink($pa2,
			array("controller" => "packages", "action" =>"promoted", 2 , 
			$management_id_session1), 
			'notification yellow'
			);
		?>
		<?php
			echo $this->Charisma->spanLink($pa1,
			array("controller" => "packages", "action" =>"promoted", 1 , 
			$management_id_session1), 
			'notification green'
			);
		?>
	</div>
