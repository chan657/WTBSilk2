<?php
echo $this->Form->input('lead_associate',  array('div' =>true,
					   'label' => false,  'options' => $associate,'empty' => '--Select--',
					   
					   'class' => 'inputformadd', 'size' => '1', 'maxlength'=>'100'));

?>