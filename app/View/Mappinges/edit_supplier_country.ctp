<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'font-awesome/css/font-awesome.min',
    '/js/lib/datepicker/css/datepicker',
    '/js/lib/timepicker/css/bootstrap-timepicker.min'
        )
);
echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));
/* End */
//pr($this->data);
?>

<!----------------------------start add project block------------------------------>

<div class="pop-outer">
    <div class="pop-up-hdng">Edit Supplier Country </div>


    <?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
    echo $this->Form->create('TravelCountrySupplier', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
        'inputDefaults' => array(
            'label' => false,
            'div' => false,
            'class' => 'form-control',
        ),
        array('controller' => 'mappinges', 'action' => 'edit_supplier_country')
    ));
    echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
    //pr($this->data);
    ?>

    <div class="col-sm-12">
        <div class="col-sm-6">

            <div class="form-group">
                <label for="reg_input_name" class="req">Supplier</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('supplier_code', array('id' => 'country_supplier_code', 'options' => $TravelSuppliers, 'empty' => '--Select--','disabled' => true));
                    ?></div>
            </div>
            <div class="form-group">
                <label for="reg_input_name" class="req">Mapping Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('country_mapping_name', array('readonly' => true));
                    ?></div><span class="icon-info-sign" style="color: #5DD0ED;" data-toggle="tooltip"  data-placement="left" title="Example: RezLive | Slovakia"></span>
            </div>

        </div>
        <div class="col-sm-6">

            <div class="form-group">
                <label for="reg_input_name" class="req">WTB Country</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('pf_country_code', array('id' => 'pf_country_code', 'options' => $TravelCountries, 'empty' => '--Select--','disabled' => true));
                    ?></div>
            </div>
            <div class="form-group">
                <label for="reg_input_name" class="req">Supplier Country Code</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <?php
                    echo $this->Form->input('supplier_country_code',array('data-required' => 'true'));
                    ?></div><span class="icon-info-sign" style="color: #5DD0ED;" data-toggle="tooltip"  data-placement="left" title="Please check the Country data provided by your supplier for this code. IMPORTANT: This code may be different from WTB Country code."></span>
            </div>
        </div>
        <div class="clear" style="clear: both;"></div>
        <div class="row">
            <div class="col-sm-12"><?php echo $this->Form->submit('Update', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
                    echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
                    ?></div>
        </div>
    </div>
    <?php echo $this->Form->end();
    ?>
</div>	

<script>

    var FULL_BASE_URL = $('#hidden_site_baseurl').val(); // For base path of value;
    $('#country_supplier_code').change(function() {
        var supplier_code = $(this).val();
        var model = 'TravelCountrySupplier';

        var dataString = 'supplier_code=' + supplier_code;
        $('#pf_country_code').attr('disabled', 'disabled');
        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/get_supplier_by_country',
            beforeSend: function() {
                $('#pf_country_code').attr('disabled', 'disabled');
                //return false;
            },
            success: function(return_data) {
                $('#pf_country_code').removeAttr('disabled');
                $('#pf_country_code').html(return_data);
            }
        });

    });
   
</script>

<!----------------------------end add project block------------------------------>
