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
     <div class="pop-up-hdng">Add Agreement</div>


    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
	echo $this->Form->create('BuilderAgreement', array('method' => 'post','id' => 'parsley_reg','novalidate' => true,
													'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
											array('controller' => 'builders','action' => 'add_agreement')					
						));
   // pr($lead);
    ?>

    <div class="col-sm-12 spacer">
        <div class="col-sm-6">
        <h4>Agreement Details</h4>
        	<div class="form-group">
                <label>Agreement Done With</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_done_with_id',array('options' => $agreement_done_with,'empty' => '--Select--'));
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Marketing Partner Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_level',array('options' => $marketings_partners,'empty' => '--Select--'));
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Agreement Level</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_level',array('options' => $agreement_level,'empty' => '--Select--'));
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>For Company</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_company',array('options' => $for_company,'empty' => '--Select--'));
				   
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Agreement Status</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_status',array('options' => $agreement_status,'empty' => '--Select--'));
				 
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Agreement Remarks</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_remarks');
				 
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Prepared By</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_proposed_by');
                    ?></div>
            </div>
            <div class="form-group">
                <label>Managed By</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_managed_by');
                    ?></div>
            </div>
        </div>
        <div class="col-sm-6">
        <h4>&nbsp;</h4>
        	<div class="form-group">
                <label>Agreement Proposed By</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_proposed_by');
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Builder Legal Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_legal_names_id', array('options' => $builder_legal_names,'empty' => '--Select--'));
				 
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Marketing Partner Legal Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_counterparty_secondarymobile_code', array('options' => $marketings_partners_legal_name,'empty' => '--Select--'));
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Project(s) Covered</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_counterparty_lan_code');
				 
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>For Company City</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_company_city',array('options' => $city,'empty' => '--Select--'));
                    ?>

                </div>

            </div>
	    	<div class="form-group">
                <label>Commission Based On</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_commission_based_on',array('options' =>$commission_based_on ,'empty' => '--Select--'));
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Initiated By</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_intiated_by');
                    ?></div>
            </div>
           </div>
    </div>
    <div class="col-sm-12 spacer">    
            <div class="col-sm-12"><h4>Agreement Contact Details</h4></div>
            <div class="col-sm-6">
            <div class="form-group">
                <label>Contact Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_contact_id',array('options' => $agreement_contacts,'empty' => '--Select--'));
				  
                    ?>

                </div>

            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label>Designation</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo 'test';
				 
                    ?>

                </div>

            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label>Primary Mobile</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                     echo 'test';
				 
                    ?>

                </div>

            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label>Secondary Mobile</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo 'test';
				 
                    ?>

                </div>

            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label>Email Address</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo 'test';
				 
                    ?>

                </div>

            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label>Location</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo 'test';
				 
                    ?>

                </div>

            </div>
            </div>
    </div>
    <div class="col-sm-12 spacer">
            <div class="col-sm-12"><h4>Agreement Terms Details </h4></div>
            <div class="col-sm-6">
            <div class="form-group">
                <label>Commission Percentage</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_commission_percent');
				  
                    ?>

                </div>

            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <label>Commission Terms</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_commission_term',array('options' => $commission_terms,'empty'=>'--Select--'));
                    ?></div>
            </div>
            </div>
    </div>
    <div class="col-sm-12 spacer">
            <div class="col-sm-12"><h4>Agreement Logistics</h4></div>
            <div class="col-sm-6">
            	<div class="form-group">
                <label>Preparation Group</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_prepared_by_id',array('options' => $prepare_by,'empty'=>'--Select--'));
                    ?></div>
            </div>
            </div>
            <div class="col-sm-6">
            	<div class="form-group">
                <label>Initiation Group</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_intiated_by_id',array('options'=>$intiate_by,'empty'=>'--Select--'));
                    ?></div>
            </div>
            </div>
            <div class="col-sm-6">
            	<div class="form-group">
                <label>Manager Group</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_managed_by_id',array('options'=>$manage_by,'empty'=>'--Select--'));
                    ?></div>
            </div>
            </div>
    </div>
        
        
	           
        <div class="row spacer">
        	<div class="col-sm-12"><?php echo $this->Form->submit('Add', array('class' => 'success btn','div' => false, 'id' => 'udate_unit')); ?><?php
                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
               
                ?></div>
                 </div>
            
        

    <?php echo $this->Form->end();
    ?>
</div>			
<!----------------------------end add project block------------------------------>
