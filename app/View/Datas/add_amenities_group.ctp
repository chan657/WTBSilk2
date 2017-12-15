<?php  echo $this->Html->css(array('/bootstrap/css/bootstrap.min','popup','font-awesome/css/font-awesome.min'));
		echo $this->Html->script(array('jquery.min','lib/chained/jquery.chained.remote.min','lib/jquery.inputmask/jquery.inputmask.bundle.min','lib/parsley/parsley.min','pages/ebro_form_validate','lib/datepicker/js/bootstrap-datepicker','lib/timepicker/js/bootstrap-timepicker.min','pages/ebro_form_extended'));
?>

<div class="pop-outer">
     <div class="pop-up-hdng">Add Amenities Group</div>


    <?php
	echo $this->Form->create('Group', array('method' => 'post','id' => 'parsley_reg','novalidate' => true,
													'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
												
						));
    ?>

  
  <div class="col-sm-12 fullrow">
   
    <div class="form-group" >
                <label for="input_name" class="req">Value</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                     echo $this->Form->input('group_name',array('data-required' => 'true'));
                    ?>

                </div>

            </div>  

       
    </div>             
        <div class="row">
        	<div class="col-sm-12">
			<?php echo $this->Form->submit('Add', array('class' => 'success btn','div' => false)); 
                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
               
                ?>
                </div>
         </div>
            
        

    <?php echo $this->Form->end();
    ?>
</div>







