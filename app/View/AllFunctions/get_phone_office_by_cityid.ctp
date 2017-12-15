<?php
echo $this->Form->input('lead_phoneofficer',  array('div' =>true,
					   'label' => false,  'options' => $phone_officer,'empty' => '--Select--',
					   
					   'class' => 'inputformadd', 'size' => '1', 'maxlength'=>'100'));

?>