<?php
$this->Html->addCrumb('Edit Supplier Hotel', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($this->data);
?>

<!----------------------------start add project block------------------------------>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Supplier Hotel</h4>
        </div>


        <?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
        echo $this->Form->create('TravelHotelRoomSupplier', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
            'inputDefaults' => array(
                'label' => false,
                'div' => false,
                'class' => 'form-control',
            ),
            array('controller' => 'reports', 'action' => 'hotel_mapping_edit')
        ));
        echo $this->Form->hidden('province_name');
        echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
        //pr($this->data);
        ?>
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('supplier_code', array('id' => 'hotel_supplier_code', 'options' => $TravelSuppliers, 'empty' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Province</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('province_id', array('options' => $Provinces, 'empty' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Hotel</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_code', array('id' => 'hotel_code', 'options' => $TravelHotelLookups, 'empty' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_supplier_status', array('options' => array('1' => 'Submitted For Approval', '2' => 'Approved', '3' => 'Returned', '4' => 'Change Submitted', '5' => 'Rejected', '6' => 'Request For Allocation'), 'empty' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Exclude?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('exclude', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'), 'empty' => '--Select--'));
                                ?></div>
                        </div>


                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_country_code', array('id' => 'hotel_country_code', 'options' => $TravelCountries, 'empty' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_city_code', array('id' => 'hotel_city_code', 'options' => $TravelCities, 'empty' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supp. Hotel Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('supplier_item_code1', array('data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Active?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'), 'empty' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>


                    </div>

                    <div class="clear" style="clear: both;"></div>
                    <div style="background-color: rgb(211, 233, 237);overflow:hidden;">
                        <div class="col-sm-6" style="margin-top:10px">
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Suburb</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('hotel_suburb_id', array('options' => $TravelSuburbs, 'empty' => '--Select--','data-required' => 'true'));
                                    ?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Chain</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('hotel_chain_id', array('options' => $TravelChains, 'empty' => '--Select--','data-required' => 'true'));
                                    ?></div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="margin-top:10px">
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Area</label>
                                <span class="colon">:</span>
                                <div class="col-sm-10">
                                    <?php
                                    echo $this->Form->input('hotel_area_id', array('options' => $TravelAreas, 'empty' => '--Select--','data-required' => 'true'));
                                    ?></div>
                            </div>
                            <div class="form-group">
                                <label for="reg_input_name" class="req">Brand</label>
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
                            <label for="reg_input_name" class="req" style="width:16.5%">Mapping Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_mapping_name', array('data-required' => 'true', 'style' => 'width:132%'));
                                ?></div>
                        </div>
                    </div>

                    <div class="clear" style="clear: both;"></div>
                    <div class="row">
                        <div class="col-sm-12"><?php echo $this->Form->submit('Update', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
                            //echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
                            ?></div>
                    </div>
                </div>
            </div>	
        </div>	
        <?php echo $this->Form->end();
        ?>
    </div>	
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
    
    $('#TravelHotelRoomSupplierProvinceId').change(function(){    
      $('#TravelHotelRoomSupplierProvinceName').val($('#TravelHotelRoomSupplierProvinceId option:selected').text());
    });

</script>

<!----------------------------end add project block------------------------------>
