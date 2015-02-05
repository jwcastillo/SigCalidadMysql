
<?php $management_id_session1=implode("|",$management_id_session);?>

  <div class="well span3 top-block" >
    <span class="icon32 icon-color icon-check"></span>

    <?php if(in_array($employee_id_session,$manager_id)) { ?>
      <div>
        <?php echo $this->Html->link(__('Certificated'),
          array('controller' => 'packages',"action" =>  'process',2, $management_id_session1));
        ?>
      </div>
         <?php
          echo $this->Charisma->spanLink($certificados2,
          array("controller" => "packages", "action" =>"process", 2 , 
          $management_id_session1), 
          'notification'
          );
        ?>



    <?php } 
    else { ?>
      <div>
        <?php echo $this->Html->link(__('Certificated'),
          array('controller' => 'packages',"action" =>  'process',2, $management_id_session1,$employee_id_session));
        ?>
      </div>
      
       <?php
          echo $this->Charisma->spanLink($certificados2,
          array("controller" => "packages", "action" =>"process", 2 , 
          $management_id_session1,$employee_id_session), 
          'notification'
          );
        ?>
    <?php }  ?>
  </div>
