<?php

 echo $this->Html->css(array('/bootstrap/css/bootstrap.min','popup')
							);

?>

<!----------------------------start add project block------------------------------>
<div class="pop-outer">
     <div class="pop-up-hdng">Quick Edit Client</div>


    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
	echo $this->Form->create('Lead', array('action' => 'quick_edit','method' => 'post','id' => 'parsley_reg','novalidate' => true,
													'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																)
						));
  
  
   
    ?>
		<div class="col-sm-12">
           <div class="col-sm-6">
                <div class="form-group">
                   <label>City</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                     <?php
                       echo $this->Form->input('city_id',  array('options'=>$city));
                        ?>
                    
                    </div>
                </div>
                <div class="form-group slt-sm">
                                                        <label for="reg_input_name">Primary Contact No</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        <?php
                    echo $this->Form->input('lead_primary_phone_country_code', array('options' => $codes, 'default' => '76','empty' => '--Select--'));
                       echo $this->Form->input('lead_primaryphonenumber',  array('class' => 'form-control sm rgt'));
                                                            
                                                                ?></div>
                                                    </div>
        	</div>
          <div class="col-sm-6">
          <div class="form-group">
               <label>First Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
				 <?php
                   echo $this->Form->input('lead_fname'); 
                    ?>
				
				</div>
            </div>
          </div>
        </div>    
        
        
               
        <div class="row">
        	<div class="col-sm-12 flr"><?php echo $this->Form->submit('Add', array('class' => 'success btn','div' => false, 'id' => 'udate_unit')); ?><?php
                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
               
                ?></div>

               
                 </div>
            
        

    <?php echo $this->Form->end();
    ?>
</div>	

		
<!----------------------------end add project block------------------------------>
