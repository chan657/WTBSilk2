<?php

 echo $this->Html->css(array('/bootstrap/css/bootstrap.min','popup',
									
									'font-awesome/css/font-awesome.min',
									
									'/js/lib/datepicker/css/datepicker',
									'/js/lib/timepicker/css/bootstrap-timepicker.min',
									'/js/lib/magnific-popup/magnific-popup'
									
									
									)
							);
echo $this->Html->script(array('jquery.min','lib/chained/jquery.chained.remote.min','lib/jquery.inputmask/jquery.inputmask.bundle.min','lib/parsley/parsley.min','pages/ebro_form_validate','lib/datepicker/js/bootstrap-datepicker','lib/timepicker/js/bootstrap-timepicker.min','pages/ebro_form_extended','lib/magnific-popup/jquery.magnific-popup.min','lib/magnific-popup/jquery.magnific-popup',));
		/* End */
?>


<!----------------------------start add project block------------------------------>
<div class="pop-outer">
     <div class="pop-up-hdng">Edit Agreement</div>


    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
	echo $this->Form->create('BuilderAgreement', array('method' => 'post','id' => 'parsley_reg','novalidate' => true,
													'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
											array('controller' => 'builders','action' => 'edit_agreement')					
						));
   // pr($lead);
    ?>

    <div class="col-sm-12">
        <div class="col-sm-6">
        	<div class="form-group">
                <label>With Company</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_company');
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Level</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_level',array('options' => $agreement_level,'empty' => '--Select--'));
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Project Coverage</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_project_id');
				   
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Marketing Partner</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_marketing_partner_id');
				 
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Commission %</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_commission_percent');
				  
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
                <label>Status</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_status',array('options' =>$agreement_status ,'empty' => '--Select--'));
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Builder Agreement Counterparty</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_counterparty_name');
                    ?>

                </div>

            </div>
            <!--<div class="form-group">
                <label>Company Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_company');
                    ?>

                </div>

            </div>-->
            <div class="form-group">
                <label>Signing Authority Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_signed_by');
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Created By</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_prepared_by_id',array('options' => $prepare_by,'empty'=>'--Select--'));
                    ?></div>
            </div>
            <div class="form-group">
                <label>Creator</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_prepared_by');
                    ?></div>
            </div>
            <!--<div class="form-group">
                <label>For Company</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_company');
                    ?></div>
            </div>-->
            <div class="form-group">
                <label>Company City</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_company_city',array('options' => $city,'empty'=>'--Select--'));
                    ?></div>
            </div>
            <div class="form-group">
                <label>Effective Date</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                <div class="input-group date ebro_datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                                    <?php

              echo $this->Form->input('builder_agreement_effective_date',  array('type' => 'text'));
           
                    ?>
                <span class="input-group-addon"><i class="icon-calendar"></i></span>
            </div>
                
                	</div>
            </div>
            <div class="form-group">
                <label>Expiry Date</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                <div class="input-group date ebro_datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                                    <?php

              echo $this->Form->input('builder_agreement_expiry_date',  array('type' => 'text'));
           
                    ?>
                <span class="input-group-addon"><i class="icon-calendar"></i></span>
            </div>
                
                	</div>
            </div>
            
            
            
            
            <div class="form-group">
                <label>Approved By</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_approved_by');
                    ?></div>
            </div>
            <div class="form-group">
                <label>Approved Date</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                <div class="input-group date ebro_datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                                    <?php

              echo $this->Form->input('builder_agreement_approved_date',  array('type' => 'text'));
           
                    ?>
                <span class="input-group-addon"><i class="icon-calendar"></i></span>
            </div>
                
                	</div>
            </div>
            <div class="form-group">
                <label>Signed By</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_signed_by');
                    ?></div>
            </div>
            <div class="form-group">
                <label>Signed Date</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                <div class="input-group date ebro_datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                                    <?php

              echo $this->Form->input('builder_agreement_signed_date',  array('type' => 'text'));
           
                    ?>
                <span class="input-group-addon"><i class="icon-calendar"></i></span>
            </div>
                
                	</div>
            </div>
            <div class="form-group">
                <label>Agreement Commission Terms</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_commission_term',array('options' => $commission_terms,'empty'=>'--Select--'));
                    ?></div>
            </div>
            
        </div>
        <div class="col-sm-6">
        <div class="form-group">
                <label>Designation</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_contact_designation');
                    ?>

                </div>

            </div>
            <div class="form-group slt-sm">
                <label>Primary Mobile</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_counterparty_primarymobile_code', array('options' => $codes, 'default' => '76','empty' => '--Select--'));
				   echo $this->Form->input('builder_agreement_counterparty_primarymobile',  array('class' => 'form-control sm rgt'));
                    ?>

                </div>

            </div>
            <div class="form-group slt-sm">
                <label>Secondary Mobile</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_counterparty_secondarymobile_code', array('options' => $codes, 'default' => '76','empty' => '--Select--'));
				   echo $this->Form->input('builder_agreement_counterparty_secondarymobile',  array('class' => 'form-control sm rgt'));
                    ?>

                </div>

            </div>
            <div class="form-group slt-sm">
                <label>Landline</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_counterparty_lan_code', array('options' => $codes, 'default' => '76','empty' => '--Select--'));
				   echo $this->Form->input('builder_agreement_counterparty_lan',  array('class' => 'form-control sm rgt'));
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Email Address</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_counterparty_email');
                    ?>

                </div>

            </div>
	    
           
            <div class="form-group">
               <label>Company Address</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	<?php
                    echo $this->Form->input('builder_agreement_contact_address');
                    ?></div>
            </div>
          <div class="form-group">
                <label>Contact Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_contact_name');
                    ?></div>
            </div>
            <div class="form-group">
               <label>Contact Designation</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	<?php
                    echo $this->Form->input('builder_agreement_contact_designation');
                    ?></div>
            </div>
            <div class="form-group slt-sm">
                <label>Contact Secondary Mobile</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_contact_primary_mobile_code', array('options' => $codes, 'default' => '76','empty' => '--Select--'));
				   echo $this->Form->input('builder_agreement_contact_primary_mobile',  array('class' => 'form-control sm rgt'));
                    ?>

                </div>

            </div>
            <div class="form-group slt-sm">
                <label>Contact Landline</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_contact_secondary_mobile_code', array('options' => $codes, 'default' => '76','empty' => '--Select--'));
				   echo $this->Form->input('builder_agreement_contact_secondary_mobile',  array('class' => 'form-control sm rgt'));
                    ?>

                </div>

            </div>
            <div class="form-group slt-sm">
                <label> Contact Primary Mobile</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_lan_country_code', array('options' => $codes, 'default' => '76','empty' => '--Select--'));
				   echo $this->Form->input('builder_agreement_lan_no',  array('class' => 'form-control sm rgt'));
                    ?>

                </div>

            </div>
          <div class="form-group">
                <label>Contact Email Address</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_contact_email');
                    ?></div>
            </div>
            <div class="form-group">
                <label>City</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_city_id',array('options' => $city,'empty' => '--Select--'));
                    ?></div>
            </div>
            <div class="form-group">
                <label>Address</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_contact_address');
                    ?></div>
            </div>
            <div class="form-group">
                <label>Proposed By</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_proposed_by');
                    ?></div>
            </div>
            <div class="form-group">
                <label>Company MOA</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_company_moa');
                    ?></div>
            </div>
            <div class="form-group">
                <label>Initiated By</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_intiated_by');
                    ?></div>
            </div>
            <div class="form-group">
                <label>Intiator</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_intiated_by_id',array('options'=>$intiate_by,'empty'=>'--Select--'));
                    ?></div>
            </div>
            <div class="form-group">
                <label>Managed By</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_managed_by');
                    ?></div>
            </div>
            <div class="form-group">
                <label>Manager</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_managed_by_id',array('options'=>$manage_by,'empty'=>'--Select--'));
                    ?></div>
            </div>
            <div class="form-group">
                <label>Agreement Remarks</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_agreement_remarks');
                    ?></div>
            </div>
        
 
           </div>
	</div>           
        <div class="row">
        	<div class="col-sm-12"><?php echo $this->Form->submit('Update', array('class' => 'close_bt success btn','div' => false, 'id' => 'udate_unit')); ?><?php
                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'mfp-close'));
               
                ?>
                
                </div>
                 </div>
            
        

    <?php echo $this->Form->end();
    ?>
</div>	
<!--<script>
	$(document).ready(function(){

	//alert(mgObj);
		$('#close_popup').click(function(){
			var magnificPopup = $.magnificPopup.instance; 
			// save instance in magnificPopup variable
			magnificPopup.close(); 
			// Close popup that is currently opened
		});
	});
</script>-->		
<!----------------------------end add project block------------------------------>
