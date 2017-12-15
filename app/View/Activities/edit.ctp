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
     <div class="pop-up-hdng">Edit Activity For | <?php echo $this->data['Lead']['lead_fname'].' '.$this->data['Lead']['lead_lname']; ?></div>


    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
	echo $this->Form->create('Activity', array('method' => 'post','id' => 'parsley_reg','novalidate' => true,
													'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																)
						));
   // pr($lead);
    ?>

    <div class="col-sm-12">
        <div class="col-sm-6">
        
       
            <div class="form-group">
                <label>Activity Date</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                <div class="input-group date ebro_datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                                    <?php

              echo $this->Form->input('activity_date',  array('type' => 'text','value' => date('d-m-Y',strtotime($this->data['Activity']['activity_date']))));
           
                    ?>
													<span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                </div>
                
                	</div>
            </div>


            <div class="form-group">
                <label>Activity Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('activity_type');
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>The Activity</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
		echo $this->Form->input('activity');
                   
                    ?>

                </div>

            </div>
        </div>
        <div class="col-sm-6">
	    <div class="form-group imp">
               <label>Activity Time</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
				<div class="input-group bootstrap-timepicker">
                                                   <?php
                   echo $this->Form->input('activity_time',  array('type' => 'text','id'=>'tp-default')); 
                    ?>
                                                    <span class="input-group-addon"><i class="icon-time"></i></span>
                                                </div>
				
				</div>
            </div>
           
            <div class="form-group">
               <label>Activity Level</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	<?php
                    echo $this->Form->input('activity_level');
                    ?></div>
            </div>
          <div class="form-group">
                <label>Activity By</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('Activity');
                    ?></div>
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
