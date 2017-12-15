<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup', 'font-awesome/css/font-awesome.min'));
echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));
?>
<?php
//$this->Html->addCrumb('Add Contact','javascript:void(0);', array('class' => 'breadcrumblast'));

echo $this->Form->create('BuilderLegalName', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
?>


<div class="pop-outer">
    <div class="pop-up-hdng">Edit Legal Name</div>




    <div class="row">
        <div class="col-sm-12">



            <div class="col-sm-6">


                <div class="form-group">
                    <label for="reg_input_name" class="req">Builder Name</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"> <?php echo $this->Form->input('builder_legal_names_builder_id', array('options' => $builder, 'data-required' => 'true', 'tabindex' => '1')); ?></div>
                </div>
                <div class="form-group">
                    <label for="reg_input_name" class="req">Legal Name</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"> <?php echo $this->Form->input('builder_legal_names_name', array('data-required' => 'true', 'tabindex' => '3')); ?></div>
                </div>
                <div class="form-group">
                    <label for="reg_input_name" class="req">Entity Type</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"> <?php echo $this->Form->input('builder_legal_names_entity_type', array('options' => $entity_types, 'empty' => '--Select--')); ?></div>
                </div>
            </div>

            <div class="col-sm-6">

                <div class="form-group">
                    <label class="required">Contact Name</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"> <?php echo $this->Form->input('builder_legal_names_contact_id', array('tabindex' => '2', 'options' => $contact_name, 'empty' => '--Select--')); ?></div>
                </div>
                <div class="form-group">
                    <label class="required">City</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"> <?php echo $this->Form->input('builder_legal_names_city_id', array('tabindex' => '3', 'options' => $city, 'empty' => '--Select--')); ?></div>
                </div>	
                <div class="form-group">
                    <label for="reg_input_name" class="req">Address</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"> <?php echo $this->Form->input('builder_legal_names_address', array('type' => 'textarea', 'data-required' => 'true')); ?></div>
                </div>   
            </div>

        </div>

        <div class="col-sm-12" id="contact_details" style="clear:both;">
            <?php if(count($contact_details) > 0 || !empty($contact_details)){?>
            <div class="col-sm-6">

                <div class="form-group">
                    <label>Primary Mobile</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10" style="padding-top:6px;"><?php echo $contact_details[0]['PrimaryMobileCountry']['code'] . ' ' . $contact_details[0]['BuilderContact']['builder_contact_mobile_no']; ?></div>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10" style="padding-top:6px;"><?php echo $contact_details[0]['BuilderContact']['builder_contact_email']; ?></div>
                </div>
                <div class="form-group">
                    <label>For Company</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10" style="padding-top:6px;"><?php echo $contact_details[0]['ForCompany']['value']; ?></div>
                </div>
            </div>
            <div class="col-sm-6">

                <div class="form-group">
                    <label>Secondary Mobile</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10" style="padding-top:6px;"> <?php echo $contact_details[0]['SecondMobileCountry']['code'] . ' ' . $contact_details[0]['BuilderContact']['builder_contact_secondary_mobile_no']; ?></div>
                </div>
                <div class="form-group">
                    <label>Location</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10" style="padding-top:6px;"> <?php echo $contact_details[0]['Location']['city_name']; ?></div>
                </div>
                <div class="form-group">
                    <label>For Company City</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10" style="padding-top:6px;"> <?php echo $contact_details[0]['ForCompanyCity']['city_name']; ?></div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12"><?php echo $this->Form->submit('Add', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
            echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
            ?></div>
    </div>
</div>

<?php echo $this->Form->end(); ?>   
<script>
    var FULL_BASE_URL = $('#hidden_site_baseurl').val();
    $('#BuilderLegalNameBuilderLegalNamesContactId').change(function() {
        var contact_id = $(this).val();
        var dataString = 'contact_id=' + contact_id;
        $('#contact_details').addClass('loader');
        $('.success').attr('disabled', 'true');
        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/get_builder_contact_details',
            beforeSend: function() {
                $('#contact_details').addClass('loader');
                $('.success').attr('disabled', 'true');
            },
            success: function(return_data) {
                $('#contact_details').removeClass('loader');
                $('.success').removeAttr('disabled', 'false');
                $('#contact_details').html(return_data);
            }
        });

    });
</script>