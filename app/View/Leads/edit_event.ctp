<?php

 echo $this->Html->css(array('/bootstrap/css/bootstrap.min','popup',
									
									'font-awesome/css/font-awesome.min',
									
									'/js/lib/datepicker/css/datepicker',
									'/js/lib/timepicker/css/bootstrap-timepicker.min'
									
									
									)
							);
echo $this->Html->script(array('jquery.min','lib/chained/jquery.chained.remote.min','lib/jquery.inputmask/jquery.inputmask.bundle.min','lib/parsley/parsley.min','pages/ebro_form_validate','lib/datepicker/js/bootstrap-datepicker','lib/timepicker/js/bootstrap-timepicker.min','pages/ebro_form_extended'));
		/* End */
?>

<!----------------------------start add project block------------------------------>
<div class="pop-outer">
     <div class="pop-up-hdng">Edit Event</div>


    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
	echo $this->Form->create('Event', array('method' => 'post','id' => 'parsley_reg','novalidate' => true,
													'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
											array('controller' => 'leads','action' => 'edit_event')					
						));
   // pr($lead);
    ?>

    <div class="col-sm-12">
        <div class="col-sm-6">
        <div class="form-group">
                <label for="input_name" class="req">Event Date</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                <div class="input-group date ebro_datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                                    <?php

              echo $this->Form->input('event_date',  array('type' => 'text','data-required' => 'true','value' => date("d-m-Y", strtotime($this->data['Event']['start_date']))));
           
                    ?>
													<span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                </div>
                
                	</div>
            </div>
        <div class="form-group imp">
               <label>Start Time</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
				<div class="input-group bootstrap-timepicker">
                                                   <?php
                   echo $this->Form->input('start_time',  array('type' => 'text','id'=>'start_time','value' =>  date("g:i A", strtotime($this->data['Event']['start_date'])))); 
                    ?>
                                                    <span class="input-group-addon"><i class="icon-time"></i></span>
                                                </div>
				
				</div>
            </div>
            
            
            
        </div>
        <div class="col-sm-6">
        <div class="form-group">
                <label for="input_name" class="req">Activity Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('activity_type',array('options' => $activity_types,'empty' => '--Select--','data-required' => 'true'));
                    ?>

                </div>

            </div>
	    <div class="form-group imp">
               <label>End Time</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                <div class="input-group bootstrap-timepicker">
                                                   <?php
                   echo $this->Form->input('end_time',  array('type' => 'text','id'=>'end_time','value' =>  date("g:i A", strtotime($this->data['Event']['end_date'])))); 
                    ?>
                                                    <span class="input-group-addon"><i class="icon-time"></i></span>
                                                </div>
				
				
				</div>
            </div>
           
            
          
           </div>
	</div>   
    <div class="col-sm-12 fullrow">
    <div class="form-group" >
                <label for="input_name" class="req">Description</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('event_description',array('type' => 'textarea','data-required' => 'true'));
                    ?>

                </div>

            </div>   
    </div>             
        <div class="row">
        	<div class="col-sm-12"><?php echo $this->Form->submit('Update', array('class' => 'success btn','div' => false, 'id' => 'udate_unit')); ?><?php
                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
               
                ?></div>
                 </div>
            
        

    <?php echo $this->Form->end();
    ?>
</div>			
<!----------------------------end add project block------------------------------>
