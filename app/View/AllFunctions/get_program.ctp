<?php
echo $this->Form->input($model.'.program_id',array('type'=>'select','label' => 'PROGRAM','options'=>$program,'empty'=>'--Select--', 'div' => array('id' => 'program_ajax')));
?>