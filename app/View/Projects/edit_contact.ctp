<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'todc-bootstrap.min',
    'font-awesome/css/font-awesome.min',
    '/img/flags/flags',
    'retina',
    'theme/color_1',
        )
);

echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));
/*
  echo $this->Html->script(array('jquery.min','lib/chained/jquery.chained.remote.min','retina.min','pages/ebro_wizard','common','tinynav','jquery.sticky','lib/navgoco/jquery.navgoco.min','lib/jMenu/js/jMenu.jquery','lib/jquery.inputmask/jquery.inputmask.bundle.min','lib/parsley/parsley.min','pages/ebro_form_validate','lib/datepicker/js/bootstrap-datepicker','lib/timepicker/js/bootstrap-timepicker.min','pages/ebro_form_extended','lib/typeahead/typeahead.min','lib/typeahead/hogan-2.0.0','ebro_common'));
 */
/* End */
?>


<!----------------------------start add project block------------------------------>
<div class="content">
    <div class="pop-up-hdng">Edit Contact</div>


<?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
echo $this->Form->create('ProjectContact', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
    array('controller' => 'projects', 'action' => 'edit_contact')
));
echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
?>
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-6">

                <h4>Contact Details</h4>
                <div class="form-group">
                    <label for="reg_input_name" class="req">Project Name</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"> <?php echo $this->Form->input('project_contact_project_id', array('empty' => '--Select--', 'options' => $projects, 'data-required' => 'true', 'tabindex' => '1')); ?></div>
                </div>
                <div class="form-group">
                    <label for="reg_input_name" class="req">Contact Name</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"> <?php echo $this->Form->input('project_contact_builder_contact_id', array('options' => $contacts, 'empty' => '--Select--', 'tabindex' => '3', 'data-required' => 'true')); ?></div>
                </div>
            </div>
            <div class="col-sm-6">
                <h4>&nbsp;</h4>
                <div class="form-group">
                    <label for="reg_input_name" class="req">Builder Name</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10"> <?php echo $this->Form->input('project_contact_builder_id', array('empty' => '--Select--', 'options' => $builder, 'data-required' => 'true', 'tabindex' => '2')); ?></div>
                </div>
                <div class="form-group">
                    <label>Role In Project</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">  <?php echo $this->Form->input('project_contact_project_role', array('options' => $project_role, 'empty' => '--Select--', 'tabindex' => '2', 'data-required' => 'true')); ?></div>
                </div>
            </div>


        </div>

    </div>
    <div id="contact_details">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="bgr">Primary Mobile</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php echo $this->data['PrimaryMobileCountry']['code'] . ' ' . $this->data['BuilderContact']['builder_contact_mobile_no']; ?></div>
            </div>
            <div class="form-group">
                <label class="bgr">Email Address</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php echo $this->data['BuilderContact']['builder_contact_email']; ?></div>
            </div>
            <div class="form-group">
                <label class="bgr">For Company</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php echo $this->data['ForCompany']['value']; ?></div>
            </div>
        </div>
        <div class="col-sm-6">

            <div class="form-group">
                <label>Secondary Mobile</label>
                <span class="colon">:</span>
                <div class="col-sm-10"> <?php echo $this->data['SecondMobileCountry']['code'] . ' ' . $this->data['BuilderContact']['builder_contact_secondary_mobile_no']; ?></div>
            </div>
            <div class="form-group">
                <label>Location</label>
                <span class="colon">:</span>
                <div class="col-sm-10"> <?php echo $this->data['Location']['city_name']; ?></div>
            </div>
            <div class="form-group">
                <label>For Company City</label>
                <span class="colon">:</span>
                <div class="col-sm-10"> <?php echo $this->data['ForCompanyCity']['city_name']; ?></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
<?php echo $this->Form->submit('Update', array('class' => 'success btn', 'div' => false)); ?>
<?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn')); ?>

        </div>
    </div>



<?php echo $this->Form->end();
?>
</div>	

<script>
    var FULL_BASE_URL = $('#hidden_site_baseurl').val();

    $('#ProjectContactProjectContactBuilderId').change(function() {
        var builder_id = $(this).val();
        var dataString = 'builder_id=' + builder_id;
        $('#ProjectContactProjectContactBuilderContactId').attr('disabled', 'true');
        $('.success').attr('disabled', 'true');
        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/get_contactbuilder_by_builderid',
            beforeSend: function() {
                $('#ProjectContactProjectContactBuilderContactId').attr('disabled', 'true');
                $('.success').attr('disabled', 'true');
            },
            success: function(return_data) {
                $('#ProjectContactProjectContactBuilderContactId').removeAttr('disabled', 'false');
                $('.success').removeAttr('disabled', 'false');
                $('#contact_details').text('');
                $('#ProjectContactProjectContactBuilderContactId').html(return_data);
            }
        });
    });

    $('#ProjectContactProjectContactBuilderContactId').change(function() {
        var contact_id = $(this).val();
        if (contact_id != '') {
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
        }
        else
        {
            $('#contact_details').html('');
        }

    });
</script>
