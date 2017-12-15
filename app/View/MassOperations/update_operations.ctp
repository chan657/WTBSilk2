<?php
$this->Html->addCrumb('Update Operations', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('InsertTable', array('method' => 'post',
    'id' => 'parsley_reg',
    'enctype' => 'multipart/form-data',
    'name' => 'fom',
    'onSubmit' => 'return valiDate()',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
));

echo $this->Form->hidden('continent_name');
echo $this->Form->hidden('continent_code');
echo $this->Form->hidden('province_name');
echo $this->Form->hidden('update_country_code');
echo $this->Form->hidden('update_country_name');
echo $this->Form->hidden('city_code');
echo $this->Form->hidden('city_name');
echo $this->Form->hidden('sequence_no',array('value' => $sequence_no));
echo $this->Form->hidden('tot_cnt',array('value' => $tot_cnt));
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Update Operations</h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req"  style="margin-left: 14px;">Select Table</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php
                                echo $this->Form->input('table', array('options' => array('TravelCity' => 'City', 'TravelHotelLookup' => 'Hotel', 'TravelSuburb' => 'Suburb', 'TravelArea' => 'Area'), 'empty' => '--Select--', 'data-required' => 'true','onchange' => 'chkProceedBottonEvnt()'));
                                ?>
                            </div>
                        </div>
                        <div class="form-group" id="common"  style="<?php echo $common; ?>">
                            <label for="reg_input_name"  style="margin-left: 14px;">Select City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php
                                echo $this->Form->input('update_city_id', array('options' => $TravelCities, 'empty' => '--Select--','onchange' => 'chkProceedBottonEvnt()'));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req"  style="margin-left: 14px;">Select Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php
                                echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'data-required' => 'true','onchange' => 'chkProceedBottonEvnt()'));
                                ?>
                            </div>
                        </div>                          
                    </div>
                </div>
                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12" id="update"  style="<?php echo $update; ?>">
                    <h4>Update fields</h4>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name"  style="margin-left: 14px;">Select Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php
                                echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--','onchange' => 'chkBottonEvnt()'));
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" style="margin-left: 14px;">Select Province</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php
                                echo $this->Form->input('province_id', array('options' => $Provinces, 'empty' => '--Select--','onchange' => 'chkBottonEvnt()'));
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name"  style="margin-left: 14px;">Active</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php
                                echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'), 'empty' => '--Select--','onchange' => 'chkBottonEvnt()'));
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" style="margin-left: 14px;">Select Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php
                                echo $this->Form->input('update_country_id', array('options' => $TravelCountries, 'empty' => '--Select--','onchange' => 'chkBottonEvnt()'));
                                ?>
                            </div>
                        </div> 
                        <div class="form-group"  style="<?php echo $city; ?>">
                            <label for="reg_input_name" style="margin-left: 14px;">Select City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php
                                echo $this->Form->input('city_id', array('options' => $UpdateTravelCities, 'empty' => '--Select--','onchange' => 'chkBottonEvnt()'));
                                ?>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="reg_input_name" style="margin-left: 14px;">Sequence No.</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                 <?php echo $this->Form->input('seq', array('value' => $sequence_no,'disabled' => 'true')); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear" style="clear: both;"></div>
                <div class="form-group" id="list_city" style="<?php echo $list_city; ?>">
                    <div class="col-sm-12">
                        <div class="checkbox three-column">
                            <div class="list-checkbox checkboxBlank">
                                <?php
                                echo $this->Form->input('city_id', array(
                                    'label' => false,
                                    'div' => array('class' => 'list-checkbox checkboxBlank'),
                                    'type' => 'select',
                                    'multiple' => 'checkbox',
                                    'options' => $TravelCities,
                                    'selected' => $selected,
                                    'onClick' => 'chkBottonEvnt()',
                                    'hiddenField' => false
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-1" id="proceed" style="<?php echo $proceed; ?>">
                            <?php
                            echo $this->Form->submit('Proceed', array('class' => 'btn btn-success sticky_success', 'name' => 'proceed'));
                            ?>
                        </div>
                        <div class="col-sm-1" id="local_update" style="<?php echo $local_update; ?>">
                            <?php
                            echo $this->Form->submit('Local Update', array('class' => 'btn btn-success sticky_success', 'name' => 'update','style' =>'width:100%'));
                            ?>
                        </div>
                        <div class="col-sm-2" id="generate" style="<?php echo $generate; ?>">
                            <?php
                            echo $this->Form->submit('SQL Generate', array('class' => 'btn btn-success sticky_success','style' =>'width:100%', 'name' => 'generate', 'value' => 'Generate'));
                            ?>
                        </div>
                        <div class="col-sm-2" id="wtb_update" style="<?php echo $wtb_update; ?>">
                            <?php
                            echo $this->Form->submit('WTB Update', array('class' => 'btn btn-success sticky_success','style' =>'width:100%', 'name' => 'wtb_update', 'value' => 'Generate'));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();

$data = $this->Js->get('#parsley_reg')->serializeForm(array('isForm' => true, 'inline' => true));

$this->Js->get('#InsertTableContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/InsertTable/continent_id'
                ), array(
            'update' => '#InsertTableUpdateCountryId',
            'async' => true,
            'before' => 'loading("InsertTableUpdateCountryId")',
            'complete' => 'loaded("InsertTableUpdateCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
/*
 * Get sates by country code
 */

$this->Js->get('#InsertTableUpdateCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_continent_country/InsertTable/continent_id/update_country_id'
                ), array(
            'update' => '#InsertTableProvinceId',
            'async' => true,
            'before' => 'loading("InsertTableProvinceId")',
            'complete' => 'loaded("InsertTableProvinceId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#InsertTableProvinceId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_province/InsertTable/province_id'
                ), array(
            'update' => '#InsertTableCityId',
            'async' => true,
            'before' => 'loading("InsertTableCityId")',
            'complete' => 'loaded("InsertTableCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
?>
<script>
    $('#InsertTableContinentId').change(function() {
            var str = $('#InsertTableContinentId option:selected').text();
            var res = str.split("-");          
            $('#InsertTableContinentCode').val(res[0]);
            $('#InsertTableContinentName').val(res[1]);
        });
     $('#InsertTableCityId').change(function() {
            var str = $('#InsertTableCityId option:selected').text();
            var res = str.split("-");          
            $('#InsertTableCityCode').val(res[0]);
            $('#InsertTableCityName').val(res[1]);
        });
     $('#InsertTableUpdateCountryId').change(function() {
            var str = $('#InsertTableUpdateCountryId option:selected').text();
            var res = str.split("-");          
            $('#InsertTableUpdateCountryCode').val(res[0]);
            $('#InsertTableUpdateCountryName').val(res[1]);
        });   

    $('#InsertTableProvinceId').change(function() {
        $('#InsertTableProvinceName').val($('#InsertTableProvinceId option:selected').text());
    });
    
    function chkBottonEvnt() {
        $('#proceed').css('display', 'none');
        $('#local_udate').css('display', 'none');
        $('#wtb_update').css('display', 'none');
        $('#generate').css('display', 'block');
    }
    
    function chkProceedBottonEvnt() {
        $('#proceed').css('display', 'block');
        $('#common').css('display', 'none');
        $('#update').css('display', 'none');
        $('#list_city').css('display', 'none');
        $('#local_udate').css('display', 'none');
        $('#wtb_update').css('display', 'none');
        $('#generate').css('display', 'none');
    }
</script>
