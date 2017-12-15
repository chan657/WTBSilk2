<?php
echo $this->Form->input('secondary_code', array('label' => false,'class'=>'inputformadd','div'=>false,'options' => $codes));
				    echo $this->Form->input('lead_secondaryphonenumber',  array('div' =>true,
                           'label' => false, 'class' => 'inputbox', 'size' => '20', 'maxlength'=>'100'));
				    ?>