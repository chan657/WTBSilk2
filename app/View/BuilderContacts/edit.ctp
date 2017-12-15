<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup', 'font-awesome/css/font-awesome.min'));
echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));
?>
<?php
echo $this->Form->create('BuilderContact', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
?>



<div class="pop-outer">
    <div class="pop-up-hdng">Edit Contact Details</div>


    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6">

                <?php if ($this->data['BuilderContact']['contact_type'] == '2') { ?>
                    <div class="form-group">
                        <label for="reg_input_name" class="req">Builder Name</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10"> <?php echo $this->Form->input('builder_contact_builder_id', array('class' => 'form-control builder_text', 'empty' => '--Select--', 'options' => $builder, 'data-required' => 'true', 'tabindex' => '1')); ?></div>
                    </div>
                <?php
                } else if ($this->data['BuilderContact']['contact_type'] == '1') {
                    ?>
                    <div class="form-group">
                        <label for="reg_input_name" class="req">Partner Name</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10"> <?php echo $this->Form->input('BuilderContact.builder_partner_id', array('empty' => '--Select--', 'options' => $partners, 'tabindex' => '1')); ?></div>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <label for="reg_input_name" class="req">Contact Name</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"> <?php echo $this->Form->input('builder_contact_name', array('class' => 'form-control data_required', 'tabindex' => '3', 'data-required' => 'true')); ?></div>
                </div>

                <div class="form-group slt-sm">
                    <label for="reg_input_name" class="req">Primary Mobile</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('builder_contact_mobile_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--', 'tabindex' => '5'));
                        echo $this->Form->input('builder_contact_mobile_no', array('class' => 'form-control sm rgt', 'tabindex' => '6', 'data-required' => 'true'));
                        ?></div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">  <?php echo $this->Form->input('builder_contact_email', array('tabindex' => '9')); ?></div>
                </div>
                <div class="form-group">
                    <label for="reg_input_name" class="req">For Company</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"><?php echo $this->Form->input('builder_contact_company', array('options' => $for_company, 'empty' => '--Select--', 'tabindex' => '11', 'data-required' => 'true')); ?></div>
                </div>
                <!--<h4>Contact Logistics</h4>
                
                <div class="form-group">
                                                                        <label>Initiation Group</label>
                    <span class="colon">:</span>
                                                                        <div class="col-sm-10"><?php echo $this->Form->input('builder_contact_intiated_by_id', array('options' => $contact_initiated, 'empty' => '--Select--', 'tabindex' => '13')); ?></div>
                                                                </div>
                <div class="form-group">
                                                                        <label>Manager Group</label>
                    <span class="colon">:</span>
                                                                        <div class="col-sm-10"><?php echo $this->Form->input('builder_contact_managed_by_id', array('options' => $contact_managed, 'empty' => '--Select--', 'tabindex' => '15')); ?></div>
                                                                </div>-->





            </div>

            <div class="col-sm-6">

                <div class="form-group">
                    <label for="reg_input_name" class="req">Contact Level</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">  <?php echo $this->Form->input('builder_contact_level', array('options' => $contact_level, 'empty' => '--Select--', 'tabindex' => '2', 'data-required' => 'true')); ?></div>
                </div>
                <div class="form-group">
                    <label for="reg_input_name" class="req">Designation</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('builder_contact_designation', array('class' => 'form-control', 'tabindex' => '4', 'data-required' => 'true'));
                        ?></div>
                </div>
                <div class="form-group slt-sm">
                    <label>Secondary Mobile</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">  <?php
                        echo $this->Form->input('builder_contact_secondary_mobile_country_code', array('options' => $codes, 'default' => '76', 'empty' => '--Select--', 'tabindex' => '7'));
                        echo $this->Form->input('builder_contact_secondary_mobile_no', array('class' => 'form-control sm rgt', 'tabindex' => '8'));
                        ?></div>
                </div>  

                <div class="form-group">
                    <label for="reg_input_name" class="req">Location</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">  <?php echo $this->Form->input('builder_contact_location', array('options' => $city, 'empty' => '--Select--', 'tabindex' => '10', 'data-required' => 'true')); ?></div>
                </div>
                <div class="form-group">
                    <label for="input_name">For Company City</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"><?php echo $this->Form->input('builder_contact_company_city', array('options' => $city, 'empty' => '--Select--', 'tabindex' => '12')); ?></div>
                </div>
                <!--  <h4>&nbsp;</h4>
                  
            <div class="form-group">
                                                                          <label>Initiated  By</label>
                      <span class="colon">:</span>
                                                                          <div class="col-sm-10"><?php echo $this->Form->input('builder_contact_intiated_by', array('options' => $user_by, 'empty' => '--Select--', 'tabindex' => '14')); ?></div>
                                                                  </div>
            <div class="form-group">
                                                                          <label>Managed By</label>
                      <span class="colon">:</span>
                                                                          <div class="col-sm-10"> <?php echo $this->Form->input('builder_contact_managed_by', array('options' => $user_by, 'empty' => '--Select--', 'tabindex' => '16')); ?></div>
                                                                  </div>
                -->






            </div>


        </div>
    </div>
    <div class="row">
        <div class="col-sm-12"><?php echo $this->Form->submit('Update', array('class' => 'btn btn-success sticky_success', 'div' => false, 'id' => 'udate_unit')); ?><?php
            echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
            ?></div>
    </div>
</div>                              

<?php echo $this->Form->end(); ?>   
<?php
/*
  $this->Js->get('#BuilderContactBuilderContactLocation')->event('change', $this->Js->request(array(
  'controller' => 'all_functions',
  'action' => 'get_list_initiated_by_city'
  ), array(
  'update' => '#BuilderContactBuilderContactIntiatedBy',
  'async' => true,
  'before' => 'loading("BuilderContactBuilderContactIntiatedBy")',
  'complete'	 => 'loaded("BuilderContactBuilderContactIntiatedBy")',
  'method' => 'post',
  'dataExpression' => true,
  'data' => $this->Js->serializeForm(array(
  'isForm' => true,
  'inline' => true
  ))
  ))
  );
  $this->Js->get('#BuilderContactBuilderContactLocation')->event('change', $this->Js->request(array(
  'controller' => 'all_functions',
  'action' => 'get_list_managed_by_city'
  ), array(
  'update' => '#BuilderContactBuilderContactManagedBy',
  'async' => true,
  'before' => 'loading("BuilderContactBuilderContactManagedBy")',
  'complete'	 => 'loaded("BuilderContactBuilderContactManagedBy")',
  'method' => 'post',
  'dataExpression' => true,
  'data' => $this->Js->serializeForm(array(
  'isForm' => true,
  'inline' => true
  ))
  ))
  );
 */
?>