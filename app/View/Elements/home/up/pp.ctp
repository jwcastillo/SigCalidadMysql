

	<div class="well span3 top-block">
		<span class="icon32 icon-red icon-inbox"></span>
		<div>
			<?php echo $this->Html->link(__('Promoted'),
				array('controller' => 'packages',"action" =>  'promoted'));
			?>
		</div>
		<?php
			echo $this->Charisma->spanLink($pp3,
			array("controller" => "packages", "action" =>"promoted", 3 ), 
			'notification red'
			);
		?>
		<?php
			echo $this->Charisma->spanLink($pp2,
			array("controller" => "packages", "action" =>"promoted", 2 ), 
			'notification yellow'
			);
		?>
		<?php
			echo $this->Charisma->spanLink($pp1,
			array("controller" => "packages", "action" =>"promoted", 1), 
			'notification green'
			);
		?>
	
	</div>

