<?php
$this->Html->addCrumb('DB Area', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DownloadTable', array('method' => 'post',
    'id' => 'parsley_reg',
    'name' => 'fom',
    //'onSubmit' => 'return valiDate()',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
));


if ($operation == '2') { // download
    $download = 'block';

    if ($table == 'TravelCity') {
        $country = 'block';
        $download = 'none';
        $city = 'none';
        $city_mapping = 'none';
        $country_mapping = 'none';
        $hotel = 'none';
        $common = 'none';
        $hotel_mapping = 'none';
    } elseif ($table == 'Province') {
        $country = 'block';
        $download = 'none';
        $city = 'none';
        $city_mapping = 'none';
        $country_mapping = 'none';
        $hotel = 'none';
        $common = 'none';
        $hotel_mapping = 'none';
    } elseif ($table == 'TravelHotelLookup') {
        $country = 'block';
        $city = 'block';
        $hotel = 'block';
        $city_mapping = 'none';
        $country_mapping = 'none';
        $hotel_mapping = 'none';
    } elseif ($table == 'TravelHotelRoomSupplier') {
        $country_mapping = 'block';
        $city_mapping = 'block';
        $hotel_mapping = 'block';
        $country = 'none';
        $city = 'none';
        $hotel = 'none';
    } else {
        $download = 'none';
        $country = 'none';
        $city = 'none';
        $city_mapping = 'none';
        $country_mapping = 'none';
        $hotel = 'none';
        $common = 'none';
        $hotel_mapping = 'none';
    }
} elseif ($operation == '3') { // data count
    $download = 'none';
    if ($table == 'TravelCity') {
        $country = 'block';
        $download = 'none';
        $city = 'none';
        $city_mapping = 'none';
        $country_mapping = 'none';
        $hotel = 'none';
        $common = 'none';
        $hotel_mapping = 'none';
    } elseif ($table == 'Province') {
        $country = 'block';
        $download = 'none';
        $city = 'none';
        $city_mapping = 'none';
        $country_mapping = 'none';
        $hotel = 'none';
        $common = 'none';
        $hotel_mapping = 'none';
    } else if ($table == 'TravelHotelLookup') {
        $country = 'block';
        $common = 'block';
        $city = 'block';
        $hotel = 'block';
        $city_mapping = 'none';
        $country_mapping = 'none';
        $hotel_mapping = 'none';
    } elseif ($table == 'TravelHotelRoomSupplier') {
        $country_mapping = 'block';
        $city_mapping = 'block';
        $common = 'block';
        $hotel_mapping = 'block';
        $country = 'none';
        $city = 'none';
        $hotel = 'none';
    } else {
        $download = 'none';
        $country = 'none';
        $city = 'none';
        $city_mapping = 'none';
        $country_mapping = 'none';
        $hotel = 'none';
        $common = 'none';
        $hotel_mapping = 'none';
    }
} else {
    $download = 'none';
    $country = 'none';
    $city = 'none';
    $city_mapping = 'none';
    $country_mapping = 'none';
    $hotel = 'none';
    $common = 'none';
    $hotel_mapping = 'none';
}
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">DB Area</h4>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req"  style="margin-left: 14px;">Select Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php
                                // 'TravelHotelLookup' => 'Hotel', 'TravelCountry' => 'Country', 'TravelCity' => 'City', 'TravelCountrySupplier' => 'Mapping Country', 'TravelCitySupplier' => 'Mapping City', 'TravelHotelRoomSupplier' => 'Mapping Hotel'
                                echo $this->Form->input('type_id', array('options' => array('1' => 'Business' ,'2' => 'Lookup'), 'empty' => '--Select--', 'data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req" style="margin-left: 14px;">Operations</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
<?php
echo $this->Form->input('operation', array('options' => array('1' => 'Table Structure', '2' => 'Data Download', '3' => 'Data Count'), 'empty' => '--Select--', 'data-required' => 'true'));
?></div>
                        </div>
                        <div class="form-group city" style="display:<?php echo $city; ?>">
                            <label for="reg_input_name" style="margin-left: 14px;">Select City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
<?php
echo $this->Form->input('city_id', array('options' => $DataArray, 'empty' => '--Select--'));
?></div>
                        </div>
                        <div class="form-group country_mapping" style="display:<?php echo $country_mapping; ?>">
                            <label for="reg_input_name" style="margin-left: 14px;">Select Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
<?php
echo $this->Form->input('hotel_country_id', array('options' => $TravelCountries, 'empty' => '--Select--'));
?></div>
                        </div>
                        <div class="form-group hotel_mapping" style="display:<?php echo $hotel_mapping; ?>">
                            <label for="reg_input_name" style="margin-left: 14px;">System Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
<?php
echo $this->Form->input('TravelHotelRoomSupplier.hotel_supplier_status', array('options' => array('1' => 'Submitted For Approval', '2' => 'Approved', '3' => 'Returned', '4' => 'Change Submitted', '5' => 'Rejection'), 'empty' => '--All--'));
?></div>
                        </div>
                        <div class="form-group hotel" style="display:<?php echo $hotel; ?>">
                            <label for="reg_input_name" style="margin-left: 14px;">System Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
<?php
echo $this->Form->input('TravelHotelLookup.status', array('options' => array('1' => 'Submitted For Approval', '2' => 'Approved', '3' => 'Returned', '4' => 'Change Submitted', '5' => 'Rejection'), 'empty' => '--All--'));
?></div>
                        </div>



                        <div class="form-group common" style="display:<?php echo $common; ?>">
                            <label for="reg_input_name" style="margin-left: 14px;">WTB Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
<?php
echo $this->Form->input('wtb_status', array('options' => array('1' => 'OK', '2' => 'ERROR'), 'empty' => '--All--'));
?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Select Table</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
<?php
// 'TravelHotelLookup' => 'Hotel', 'TravelCountry' => 'Country', 'TravelCity' => 'City', 'TravelCountrySupplier' => 'Mapping Country', 'TravelCitySupplier' => 'Mapping City', 'TravelHotelRoomSupplier' => 'Mapping Hotel'
echo $this->Form->input('table', array('options' => $tableOption, 'empty' => '--Select--', 'data-required' => 'true'));
?></div>
                        </div>
                        <div class="form-group country" style="display:<?php echo $country; ?>">
                            <label for="reg_input_name">Select Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
<?php
echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--'));
?></div>
                        </div>
                        
                        <div class="form-group city_mapping" style="display:<?php echo $city_mapping; ?>">
                            <label for="reg_input_name">Select City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
<?php
echo $this->Form->input('hotel_city_id', array('options' => $DataArray, 'empty' => '--Select--'));
?></div>
                        </div>
                        <div class="form-group common" style="display:<?php echo $common; ?>">
                            <label for="reg_input_name">Active</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
<?php
echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--All--'));
?></div>
                        </div>

                        <div class="form-group download" style="display:<?php echo $download; ?>">
                            <label for="reg_input_name">Start on</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
<?php
echo $this->Form->input('offset');
?></div>
                        </div>
                    </div>
                </div>
                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-1">
<?php
echo $this->Form->submit('Proceed', array('class' => 'btn btn-success sticky_success'));
?>
                        </div>

                    </div>

                </div>
                <div class="clear" style="clear: both; margin-bottom: 15px"></div>
<?php if (count($structure) > 0 && !empty($structure)) { ?>
                    <div class="col-sm-12">
                        <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="500">
                            <thead>
                                <tr>
                                    <th data-toggle="true">Field Name</th>
                                    <th data-toggle="phone">Type</th>
                                    <th data-toggle="phone">Null</th>
                                    <th data-toggle="phone">Default</th>
                                    <th data-toggle="phone">Length</th>
                                    <th data-toggle="phone">Collate</th>
                                    <th data-toggle="phone">Charset</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php foreach ($structure as $key => $value) { ?>
                                    </tr>
                                <td><?php echo $key; ?></td>

                                    <?php foreach ($value as $ke => $val) { ?>
                                    <td><?php echo $val; ?></td>
        <?php }
        ?></tr>

                                <?php
                            }
                            ?>

                            </tbody>


                        </table>
                    </div>
    <?php
}
if ($counts) {
    ?>

                    <div class="col-sm-12">
                        <h4><span style="color:#771D5A"><div id="input_quilifier_text">Data Count = <?php echo $counts; ?></div></span></h4>
                    </div>
<?php } ?>

            </div>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();

$this->Js->get('#DownloadTableTypeId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_table_by_type_id/DownloadTable'
                ), array(
            'update' => '#DownloadTableTable',
            'async' => true,
            'before' => 'loading("DownloadTableTable")',
            'complete' => 'loaded("DownloadTableTable")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#DownloadTableCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_country_id/DownloadTable/country_id'
                ), array(
            'update' => '#DownloadTableCityId',
            'async' => true,
            'before' => 'loading("DownloadTableCityId")',
            'complete' => 'loaded("DownloadTableCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#DownloadTableHotelCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_country_id/DownloadTable/hotel_country_id'
                ), array(
            'update' => '#DownloadTableHotelCityId',
            'async' => true,
            'before' => 'loading("DownloadTableHotelCityId")',
            'complete' => 'loaded("DownloadTableHotelCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
?>   
<script>
    $('#DownloadTableOperation').change(function() {
        $('#DownloadTableCountryId').val('');
        $('#DownloadTableCityId').val('');
        $('#TravelHotelLookupStatus').val('');
        $('#DownloadTableActive').val('');
        $('#DownloadTableWtbStatus').val('');
        $('#TravelHotelRoomSupplierHotelSupplierStatus').val('');
        $('#DownloadTableHotelCountryId').val('');
        $('#DownloadTableHotelCityId').val('');

        var value = $(this).val();
        var table = $('#DownloadTableTable').val();
        if (value == '2') {
            $('.download').css('display', 'block');

            if (table == 'TravelCity') {
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }
            else if (table == 'Province') {
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }

            else if (table == 'TravelHotelLookup') {
                $('.country').css('display', 'block');
                $('.common').css('display', 'block');
                $('.city').css('display', 'block');
                $('.hotel').css('display', 'block');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');

            }
            else if (table == 'TravelHotelRoomSupplier') {
                $('.country_mapping').css('display', 'block');
                $('.common').css('display', 'block');
                $('.city_mapping').css('display', 'block');
                $('.hotel_mapping').css('display', 'block');
                $('.country').css('display', 'none');
                $('.city').css('display', 'none');
                $('.hotel').css('display', 'none');

            }
            else {
                $('.download').css('display', 'block');
                $('.country').css('display', 'none');
                $('.city').css('display', 'none');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }
        }
        else if (value == '3') {
            $('.download').css('display', 'none');
            if (table == 'TravelCity') {
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }
            else if (table == 'Province') {
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }
            else if (table == 'TravelHotelLookup') {
                $('.country').css('display', 'block');
                $('.city').css('display', 'block');
                $('.hotel').css('display', 'block');
                $('.common').css('display', 'block');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');

            }
            else if (table == 'TravelHotelRoomSupplier') {
                $('.country_mapping').css('display', 'block');
                $('.city_mapping').css('display', 'block');
                $('.hotel_mapping').css('display', 'block');
                $('.common').css('display', 'block');
                $('.country').css('display', 'none');
                $('.city').css('display', 'none');
                $('.hotel').css('display', 'none');

            }
            else {
                $('.download').css('display', 'none');
                $('.country').css('display', 'none');
                $('.city').css('display', 'none');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }
        }
        else {
            $('.download').css('display', 'none');
            $('.country').css('display', 'none');
            $('.city').css('display', 'none');
            $('.country_mapping').css('display', 'none');
            $('.city_mapping').css('display', 'none');
            $('.hotel').css('display', 'none');
            $('.common').css('display', 'none');
            $('.hotel_mapping').css('display', 'none');
        }
    });

    $('#DownloadTableTable').change(function() {
        $('#DownloadTableCountryId').val('');
        $('#DownloadTableCityId').val('');
        $('#TravelHotelLookupStatus').val('');
        $('#DownloadTableActive').val('');
        $('#DownloadTableWtbStatus').val('');
        $('#TravelHotelRoomSupplierHotelSupplierStatus').val('');
        $('#DownloadTableHotelCountryId').val('');
        $('#DownloadTableHotelCityId').val('');
        var table = $(this).val();
        var value = $('#DownloadTableOperation').val();
        if (value == '2') {
            $('.download').css('display', 'block');

            if (table == 'TravelCity') {
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }
            else if (table == 'Province') {
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }

            else if (table == 'TravelHotelLookup') {
                $('.country').css('display', 'block');
                $('.city').css('display', 'block');
                $('.common').css('display', 'block');
                $('.hotel').css('display', 'block');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }
            else if (table == 'TravelHotelRoomSupplier') {
                $('.country_mapping').css('display', 'block');
                $('.city_mapping').css('display', 'block');
                $('.common').css('display', 'block');
                $('.hotel_mapping').css('display', 'block');
                $('.country').css('display', 'none');
                $('.city').css('display', 'none');
                $('.hotel').css('display', 'none');

            }
            else {
                $('.download').css('display', 'none');
                $('.country').css('display', 'none');
                $('.city').css('display', 'none');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }
        }
        else if (value == '3') {
            $('.download').css('display', 'none');
            if (table == 'TravelCity') {
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }
            else if (table == 'Province') {
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }
            else if (table == 'TravelHotelLookup') {
                $('.country').css('display', 'block');
                $('.city').css('display', 'block');
                $('.hotel').css('display', 'block');
                $('.common').css('display', 'block');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }
            else if (table == 'TravelHotelRoomSupplier') {
                $('.country_mapping').css('display', 'block');
                $('.city_mapping').css('display', 'block');
                $('.hotel_mapping').css('display', 'block');
                $('.common').css('display', 'block');
                $('.country').css('display', 'none');
                $('.city').css('display', 'none');
                $('.hotel').css('display', 'none');

            }
            else {
                $('.download').css('display', 'none');
                $('.country').css('display', 'none');
                $('.city').css('display', 'none');
                $('.country_mapping').css('display', 'none');
                $('.city_mapping').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.hotel_mapping').css('display', 'none');
            }
        }
        else {
            $('.download').css('display', 'none');
            $('.country').css('display', 'none');
            $('.city').css('display', 'none');
            $('.country_mapping').css('display', 'none');
            $('.city_mapping').css('display', 'none');
            $('.hotel').css('display', 'none');
            $('.common').css('display', 'none');
            $('.hotel_mapping').css('display', 'none');
        }

    });

    function valiDate()
    {
        var table = $('#DownloadTableTable').val();
        var Operation = $('#DownloadTableOperation').val();
        
         if(document.fom.DownloadTableTypeId.value=="")
	{
		alert("Select type");
		document.fom.DownloadTableTypeId.focus();
		return false;
	}

        if (document.fom.DownloadTableTable.value == "")
        {
            alert("Select table");
            document.fom.DownloadTableTable.focus();
            return false;
        }

        if (document.fom.DownloadTableOperation.value == "")
        {
            alert("Select operation");
            document.fom.DownloadTableOperation.focus();
            return false;
        }
        if (Operation == '2' || Operation == '3') {

            if (table == 'TravelCity' || table == 'TravelHotelLookup' || table == 'Province') {
                if (document.fom.DownloadTableCountryId.value == "")
                {
                    alert("Select country");
                    document.fom.DownloadTableCountryId.focus();
                    return false;
                }
            }
        }

    }
</script>


