<?php
 echo $this->Form->input($model.'.state_id',array('type'=>'select','label' => 'STATE','options'=>$state,'empty'=>'--Select--', 'div' => array('id' => 'state_ajax')));
?>