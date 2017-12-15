<?php
$this->Html->addCrumb('Include / Exclude Mapping', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('Mapping', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
 ));
echo $this->Form->hidden('operation',array('value' => $mapping_type));
echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));

if ($mapping_type == '1') { //country
    $style_country = 'block';
    $style_city = 'none';
    $style_hotel = 'none';
} elseif ($mapping_type == '2') { //city
    $style_city = 'block';
    $style_country = 'none';
    $style_hotel = 'none';
    $search_result = 'block';
} elseif ($mapping_type == '3') { //hotel
    $style_hotel = 'block';
    $search_result = 'block';
    $style_city = 'none';
    $style_country = 'none';
} else {
    $style_city = 'none';
    $style_country = 'none';
    $style_hotel = 'none';
    $search_result = 'none';
}
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Include / Exclude Mapping</h4>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-12">
                <div class="form-group">
                            <label for="reg_input_name" class="req" style="margin-left: 28px;">Choose Action</label>
                            <span class="colon">:</span>
                            <div class="col-sm-4"><?php
                                echo $this->Form->input('excluded', array('options' => array('TRUE' => 'Activate', 'FALSE' => 'Deactivate'), 'empty' => '--Select--', 'disabled' => $Types, 'selected' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                    </div>
                 <div class="col-sm-12 toggle" style="display: none;">
                <div class="col-sm-12" id="country" style="display: <?php echo $style_country ?>">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('TravelCountrySupplier.supplier_code', array('id' => 'country_supplier_code', 'options' => $TravelSuppliers, 'empty' => '--Select--','disabled' => true));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">SUPP Country Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('TravelCountrySupplier.supplier_country_code',array('readonly' => true));
?></div><span class="icon-info-sign" style="color: #5DD0ED;" data-toggle="tooltip"  data-placement="left" title="Please check the Country data provided by your supplier for this code. IMPORTANT: This code may be different from WTB Country code."></span>
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('TravelCountrySupplier.pf_country_code', array('id' => 'pf_country_code', 'options' => $TravelCountries, 'empty' => '--Select--','disabled' => true));
?></div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-12" id="city" style="display: <?php echo $style_city ?>">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('TravelCitySupplier.supplier_code', array('id' => 'city_supplier_code', 'options' => $TravelSuppliers, 'empty' => '--Select--','disabled' => true));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('TravelCitySupplier.pf_city_code', array('id' => 'pf_city_code', 'options' => $TravelCities, 'empty' => '--Select--','disabled' => true));
?></div>
                        </div>


                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('TravelCitySupplier.city_country_code', array('id' => 'city_country_code', 'options' => $TravelCountries, 'empty' => '--Select--','disabled' => true));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier City Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('TravelCitySupplier.supplier_city_code',array('readonly' => true));
?></div>
                        </div>
                    </div>
                </div>
                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12" id="hotel" style="display: <?php echo $style_hotel ?>">
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('TravelHotelRoomSupplier.supplier_code', array('id' => 'hotel_supplier_code', 'options' => $TravelSuppliers, 'empty' => '--Select--','disabled' => true));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('TravelHotelRoomSupplier.hotel_city_code', array('id' => 'hotel_city_code', 'options' => $TravelCities, 'empty' => '--Select--','disabled' => true));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier Hotel Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('TravelHotelRoomSupplier.supplier_item_code1',array('readonly' => true));
?></div>
                        </div>

                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('TravelHotelRoomSupplier.hotel_country_code', array('id' => 'hotel_country_code', 'options' => $TravelCountries, 'empty' => '--Select--','disabled' => true));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Hotel</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('TravelHotelRoomSupplier.hotel_code', array('id' => 'hotel_code', 'options' => $TravelHotelLookups, 'empty' => '--Select--','disabled' => true));
?></div>
                        </div>

                    </div>
                </div>

                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-2" id="add_mapping">
<?php
echo $this->Form->submit('Add Action', array('class' => 'btn btn-success sticky_success', 'name' => 'add', 'style' => 'width:100%'));
?>
                        </div>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();
?>
<script>
    $("#MappingExcluded").change(function(){
        $(".toggle").toggle();
    });
</script>

