<?php  echo $this->Html->css(array('/bootstrap/css/bootstrap.min','popup'));?>
<div align="left" valign="top" class="headerText">Add Lead Status</div>
<?php echo $this->Session->flash(); ?>
<div class="content">
    <div class="tableheadbg">
        <div style="padding: 14px 30px; font-weight: bold;" >Add Information</div>
    </div>
   <?php echo $this->Form->create('LeadStatus');?>
    <div class="tableboeder" style="padding-top: 25px;">
     <div class="content_div">
        <div class="popup_left">
            <div class="div_line">
                    <div class="pop_text">Value</div>
                    <div class="colon">:</div>
                    <div class="input_div">	<?php
                        echo $this->Form->input('status', array('div' => true,'label' => false,'class' => 'inputbox', 'size' => '25', 'maxlength' => '100'));
                        ?>
                    </div>
	    </div>
	   
        </div>
    </div>


<div class="add-project-row-new">
<?php
echo $this->Form->submit('Add', array('class' => 'updateBox'));
echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'updateBox updateBox2'));
?>
        </div>
    </div>
<?php echo $this->Form->end(); ?>
</div>

