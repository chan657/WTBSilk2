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
    <div class="pop-up-hdng">Edit Supplier Hotel </div>


    <?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
    echo $this->Form->create('TravelHotelRoomSupplier', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
        'inputDefaults' => array(
            'label' => false,
            'div' => false,
            'class' => 'form-control',
        ),
        array('controller' => 'mappinges', 'action' => 'edit_supplier_hotel')
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
                                echo $this->Form->input('supplier_code', array('id' => 'hotel_supplier_code','options' => $TravelSuppliers, 'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_city_code', array('id' => 'hotel_city_code','options' => $TravelCities, 'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
             <div class="form-group">
                            <label for="reg_input_name" class="req">Supp. Hotel Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('supplier_item_code1',array('data-required' => 'true'));
                                ?></div>
                        </div>
              
                        

                    </div>
                    <div class="col-sm-6">
                      
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_country_code', array('id' => 'hotel_country_code','options' => $TravelCountries, 'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Hotel</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_code', array('id' => 'hotel_code','options' => $TravelHotelLookups, 'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
                        
                       
                        
                    </div>
        
        <div class="clear" style="clear: both;"></div>
                    <div style="background-color: rgb(211, 233, 237);overflow:hidden;">
                        <div class="col-sm-6" style="margin-top:10px">
                             <div class="form-group">
                            <label for="reg_input_name">Suburb</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_suburb_id', array('options' => $TravelSuburbs, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Chain</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_chain_id', array('options' => $TravelChains, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        </div>
                        <div class="col-sm-6" style="margin-top:10px">
                            <div class="form-group">
                            <label for="reg_input_name">Area</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_area_id', array('options' => $TravelAreas, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Brand</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_brand_id', array('options' => $TravelBrands, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" style="width:16.5%">Hotel Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10" id="MappingWebsiteUrl">
                                <?php echo $HotelUrl['TravelHotelLookup']['address'] ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" style="width:16.5%">Website Url</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10" id="MappingWebsiteUrl">
                                <?php echo $this->Html->link($HotelUrl['TravelHotelLookup']['url_hotel'], $HotelUrl['TravelHotelLookup']['url_hotel'], array('target' => '_blank')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" style="width:16.5%">Mapping Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_mapping_name',array('readonly' => true,'style' => 'width:132%'));
                                ?></div>
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
