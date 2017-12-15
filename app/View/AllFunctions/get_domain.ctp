<?php
echo $this->Form->input($model.'.domain_id',array('type'=>'select','label' => 'DOMAIN','options'=>$domain,'empty'=>'--Select--', 'div' => array('id' => 'domain_ajax')));
?>