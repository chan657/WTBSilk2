<div align="left" valign="top" class="headerText">Edit Lead Urgency</div>
<?php echo $this->Session->flash(); ?>
<div class="content">
    <div class="tableheadbg">
        <div style="padding: 14px 30px; font-weight: bold;" >View Information</div>
    </div>
   <?php echo $this->Form->create('LookupValueLeadsUrgency');?>
    <div class="tableboeder" style="padding-top: 25px;">
     <div class="content_div">
        <div class="popup_left">
            <div class="div_line">
                    <div class="pop_text">Value</div>
                    <div class="colon">:</div>
                    <div class="input_div">	<?php
                        echo $this->Form->input('value', array('div' => true,'label' => false,'class' => 'inputbox', 'size' => '25', 'maxlength' => '100'));
                        ?>
                    </div>
	    </div>
	   
        </div>
    </div>


<div class="add-project-row-new">
<?php
echo $this->Form->submit('Update', array('class' => 'updateBox'));
echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'updateBox updateBox2'));
?>
        </div>
    </div>
<?php echo $this->Form->end(); ?>
</div>

