 <?php  
 echo $phone_officer['Channel']['channel_name'];
 echo $this->Form->input('lead_phone_managment',  array('div' =>false,'id' => 'lead_phone_managment', 'value' => $phone_officer['Channel']['channel_name'],
					   'label' => false, 'class' => 'inputbox', 'size' => '20', 'maxlength'=>'100','readonly' => 'readonly'));

 ?>
