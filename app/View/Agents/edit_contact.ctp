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
     <div class="pop-up-hdng">Edit Contact</div>


    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
	echo $this->Form->create('BuilderContact', array('method' => 'post','id' => 'parsley_reg','novalidate' => true,
													'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
											array('controller' => 'builders','action' => 'edit_contact')					
						));
   // pr($lead);
    ?>

    <div class="col-sm-12">
        <div class="col-sm-6">
        	<div class="form-group">
                <label>Contact Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_name');
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Designation</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_designation');
                    ?>

                </div>

            </div>
            <div class="form-group slt-sm">
                <label>Primary Mobile</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_mobile_country_code', array('options' => $codes, 'default' => '76','empty' => '--Select--'));
				   echo $this->Form->input('builder_contact_mobile_no',  array('class' => 'form-control sm rgt'));
                    ?>

                </div>

            </div>
            <div class="form-group slt-sm">
                <label>Secondary Mobile</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_secondary_mobile_country_code', array('options' => $codes, 'default' => '76','empty' => '--Select--'));
				   echo $this->Form->input('builder_contact_secondary_mobile_no',  array('class' => 'form-control sm rgt'));
                    ?>

                </div>

            </div>
            <div class="form-group slt-sm">
                <label>Landline</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_lan_no_country_code', array('options' => $codes, 'default' => '76','empty' => '--Select--'));
				   echo $this->Form->input('builder_contact_lan_no',  array('class' => 'form-control sm rgt'));
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Email Address</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_email');
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Location</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_location');
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Level</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_level',array('options' => $contact_level,'empty' => '--Select--'));
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Status</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_status',array('options' => $contact_status,'empty' => '--Select--'));
                    ?>

                </div>

            </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group">
                <label>Initiated By</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_intiated_by');
                    ?>

                </div>

            </div>
            <div class="form-group">
                <label>Intiator</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_intiated_by_id',array('options' => $contact_initiated,'empty' => '--Select--'));
                    ?>

                </div>

            </div>
	    
           
            <div class="form-group">
               <label>Managed By</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	<?php
                    echo $this->Form->input('builder_contact_managed_by');
                    ?></div>
            </div>
          <div class="form-group">
                <label>Manager</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_managed_by_id',array('options' => $contact_managed,'empty' => '--Select--'));
                    ?></div>
            </div>
            <div class="form-group">
               <label>Created By</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	<?php
                    echo $this->Form->input('builder_contact_prepared_by');
                    ?></div>
            </div>
          <div class="form-group">
                <label>Creator</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_prepared_by_id',array('options' => $contact_prepared,'empty' => '--Select--'));
                    ?></div>
            </div>
            <div class="form-group">
                <label>For Company</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_company');
                    ?></div>
            </div>
            <div class="form-group">
                <label>For Company City</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_company_city',array('options' => $city,'empty' => '--Select--'));
                    ?></div>
            </div>
            <div class="form-group">
                <label>Approved By</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('builder_contact_approved_by');
                    ?></div>
            </div>
            <div class="form-group">
                <label>Approved Date</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                <div class="input-group date ebro_datepicker" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                                    <?php

              echo $this->Form->input('builder_contact_approved_date',  array('type' => 'text','value' => date('d-m-Y',strtotime($this->data['BuilderContact']['builder_contact_approved_date']))));
           
                    ?>
                <span class="input-group-addon"><i class="icon-calendar"></i></span>
            </div>
                
                	</div>
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
