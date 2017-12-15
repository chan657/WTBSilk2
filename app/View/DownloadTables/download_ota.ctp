<?php
$this->Html->addCrumb('Download Section', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DownloadTable', array('method' => 'post',
    'id' => 'parsley_reg',
    'name' => 'fom',
    'onSubmit' => 'return valiDate()',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
));


if($operation == '2'){ // download
    $download = 'block';
    
    if($table == 'TravelCity'){
        $country = 'block';
        $download = 'none';    
        $city = 'none';       
        $hotel = 'none';
        $common = 'none';   
        $chain = 'none';
    }
    else if($table == 'Province'){
        $country = 'block';
        $download = 'none';    
        $city = 'none';       
        $hotel = 'none';
        $common = 'none';   
        $chain = 'none';
        $suburb = 'none';
    }
    else if($table == 'TravelHotelLookup'){
        $country = 'block';
        $common = 'none';
        $city = 'block';
        $hotel = 'block';
        $chain = 'none';
    }
    else if($table == 'TravelSuburb'){
        $country = 'block';
        $common = 'block';
        $city = 'block';
        $hotel = 'none';
        $chain = 'none';
    }
    else if($table == 'TravelArea'){
        $country = 'block';
        $common = 'none';
        $city = 'block';
        $suburb = 'block';
        $hotel = 'none';
        $chain = 'none';
    }
    else if($table == 'TravelBrand'){
        $chain = 'block';
        $common = 'none';
        $country = 'none';
        $city = 'none';
        $suburb = 'none';
        $hotel = 'none';
        
    }

     else{
        $download = 'none';
        $chain = 'none';
        $country = 'none';
        $city = 'none';
        $city_mapping = 'none';
        $country_mapping = 'none';
        $hotel = 'none';
        $common = 'none';  
        $suburb = 'none';
        $hotel_mapping = 'none';
    }
    
    
}
elseif ($operation == '3') { // data count
   $download = 'none';
    if($table == 'TravelCity'){
        $country = 'block';
        $download = 'none';    
        $city = 'none';
        $suburb = 'none';
        $chain = 'none';
        $hotel = 'none';
        $common = 'none';       
    }
    else if($table == 'Province'){
        $country = 'block';
        $download = 'none';    
        $city = 'none';       
        $hotel = 'none';
        $common = 'none';   
        $chain = 'none';
        $suburb = 'none';
    }
    else if($table == 'TravelHotelLookup'){
        $country = 'block';
        $common = 'none';
        $city = 'block';
        $hotel = 'block';
        $chain = 'none';
    }
    else if($table == 'TravelSuburb'){
        $country = 'block';
        $common = 'block';
        $suburb = 'none';
        $chain = 'none';
        $city = 'block';
        $hotel = 'none';
    }
    else if($table == 'TravelArea'){
        $country = 'block';
        $common = 'none';
        $city = 'block';
        $suburb = 'block';
        $hotel = 'none';
        $chain = 'none';
    }
    else if($table == 'TravelBrand'){
        $chain = 'block';
        $country = 'none';
        $common = 'none';
        $city = 'none';
        $suburb = 'none';
        $hotel = 'none';
    }

    else{
        $download = 'none';
        $country = 'none';
        $city = 'none';
        $chain = 'none';
        $hotel = 'none';
        $common = 'none'; 
        $suburb = 'none'; 
 
    }
    
}
else{
    $download = 'none';
    $country = 'none';
    $city = 'none';
    $chain = 'none';
    $hotel = 'none';
    $suburb = 'none'; 
    $common = 'none';
 
}
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Download Section</h4>
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
                            <label for="reg_input_name" class="req" style="margin-left: 14px;">Operation</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php
                                echo $this->Form->input('operation', array('options' => array('2' => 'Data Download', '3' => 'Data Count'), 'empty' => '--Select--', 'data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group country" style="display:<?php echo $country;?>">
                            <label for="reg_input_name" class="req" style="margin-left: 14px;">Select Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php                                
                                echo $this->Form->input('country_id', array('options' => $TravelCountries,'empty' => '--Select--' ));
                                ?></div>
                        </div>
                 
                        <div class="form-group suburb" style="display:<?php echo $suburb;?>">
                            <label for="reg_input_name" style="margin-left: 14px;">Select Suburb</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php                                
                                echo $this->Form->input('suburb_id', array('options' => $Suburbs,'empty' => '--Select--' ));
                                ?></div>
                        </div>
                        <div class="form-group chain" style="display:<?php echo $chain;?>">
                            <label for="reg_input_name" style="margin-left: 14px;">Select Chain</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php                                
                                echo $this->Form->input('brand_chain_id', array('options' => $Chains,'empty' => '--Select--' ));
                                ?></div>
                        </div>
                        <div class="form-group hotel" style="display:<?php echo $hotel;?>">
                            <label for="reg_input_name" style="margin-left: 14px;">Select Chain</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php                                
                                echo $this->Form->input('chain_id', array('options' => $Chains,'empty' => '--Select--' ));
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
                           
                        <div class="form-group city" style="display:<?php echo $city;?>">
                            <label for="reg_input_name">Select City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php                                
                                echo $this->Form->input('city_id', array('options' =>$DataArray,'empty' => '--Select--' ));
                                ?></div>
                        </div>
              
                        <div class="form-group hotel" style="display:<?php echo $hotel;?>">
                            <label for="reg_input_name">Select Area</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php                                
                                echo $this->Form->input('area_id', array('options' => $Areas,'empty' => '--Select--' ));
                                ?></div>
                        </div>
                        <div class="form-group hotel" style="display:<?php echo $hotel;?>">
                            <label for="reg_input_name">Select Brand</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php                                
                                echo $this->Form->input('brand_id', array('options' => $Brands,'empty' => '--Select--' ));
                                ?></div>
                        </div>
                        
                        <div class="form-group download" style="display:<?php echo $download;?>">
                            <label for="reg_input_name">Start on</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php
                                echo $this->Form->input('offset');
                                ?>
                            </div>
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
              <?php
                if($counts){
                ?>                
                <div class="col-sm-12">
                    <h4><span style="color:#771D5A"><div id="input_quilifier_text">Data Count = <?php echo $counts;?></div></span></h4>
                </div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();

$data = $this->Js->get('#parsley_reg')->serializeForm(array('isForm' => true, 'inline' => true));

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
$this->Js->get('#DownloadTableCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_suburb_by_country_id_and_city_id/DownloadTable/country_id/city_id'
                ), array(
            'update' => '#DownloadTableSuburbId',
            'async' => true,
            'before' => 'loading("DownloadTableSuburbId")',
            'complete' => 'loaded("DownloadTableSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
$this->Js->get('#DownloadTableHotelCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_suburb_by_country_id_and_city_id/DownloadTable/hotel_country_id/hotel_city_id'
                ), array(
            'update' => '#DownloadTableSuburbId',
            'async' => true,
            'before' => 'loading("DownloadTableSuburbId")',
            'complete' => 'loaded("DownloadTableSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
$this->Js->get('#DownloadTableSuburbId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_area_by_suburb_id/DownloadTable/suburb_id'
                ), array(
            'update' => '#DownloadTableAreaId',
            'async' => true,
            'before' => 'loading("DownloadTableAreaId")',
            'complete' => 'loaded("DownloadTableAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#DownloadTableChainId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_brand_by_chain_id/DownloadTable/chain_id'
                ), array(
            'update' => '#DownloadTableBrandId',
            'async' => true,
            'before' => 'loading("DownloadTableBrandId")',
            'complete' => 'loaded("DownloadTableBrandId")',
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

            
        var value = $(this).val();
        var table = $('#DownloadTableTable').val();
        if (value == '2') {
            $('.download').css('display', 'block');
            
            if(table == 'TravelCity'){
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.chain').css('display', 'none');
            }
           else if(table == 'Province'){
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.chain').css('display', 'none');
            }
            
            else if(table == 'TravelHotelLookup'){
                $('.country').css('display', 'block');               
                $('.city').css('display', 'block');
                $('.chain').css('display', 'none');
                $('.suburb').css('display', 'block');
                $('.hotel').css('display', 'block');
                     
                
            }
            else if(table == 'TravelSuburb'){
                $('.country').css('display', 'block');               
                $('.city').css('display', 'block');
                $('.hotel').css('display', 'none');
                $('.suburb').css('display', 'none');
                $('.chain').css('display', 'none');
                
            }
            else if(table == 'TravelArea'){
                $('.country').css('display', 'block');               
                $('.city').css('display', 'block');
                $('.suburb').css('display', 'block');
                $('.hotel').css('display', 'none'); 
                $('.chain').css('display', 'none');
                
            }
            else if(table == 'TravelBrand'){
                $('.chain').css('display', 'block'); 
                $('.country').css('display', 'none');               
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none');
                $('.hotel').css('display', 'none');                               
            }
    
            else{
                $('.download').css('display', 'block');
                $('.country').css('display', 'none');
                $('.chain').css('display', 'none');
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
               
            }
        }
        else if(value == '3'){
            $('.download').css('display', 'none');
            if(table == 'TravelCity'){
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                
            }
            else if(table == 'Province'){
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.chain').css('display', 'none');
            }
            else if(table == 'TravelHotelLookup'){
                $('.country').css('display', 'block');
                $('.city').css('display', 'block');
                $('.chain').css('display', 'none');
                $('.hotel').css('display', 'block');
                $('.suburb').css('display', 'block');
                $('.common').css('display', 'block');
                
                
            }
            else if(table == 'TravelSuburb'){
                $('.country').css('display', 'block');               
                $('.city').css('display', 'block');
                $('.hotel').css('display', 'none');
                $('.suburb').css('display', 'none');       
                $('.chain').css('display', 'none');
            }
            else if(table == 'TravelArea'){
                $('.country').css('display', 'block');               
                $('.city').css('display', 'block');
                $('.suburb').css('display', 'block');
                $('.hotel').css('display', 'none');                      
                $('.chain').css('display', 'none');
            }
            else if(table == 'TravelBrand'){
                $('.chain').css('display', 'block'); 
                $('.country').css('display', 'none');               
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none');
                $('.hotel').css('display', 'none');                               
            }

         else{
            $('.download').css('display', 'none');
            $('.chain').css('display', 'none'); 
             $('.country').css('display', 'none');
            $('.city').css('display', 'none');
            $('.suburb').css('display', 'none');          
            $('.hotel').css('display', 'none');
            $('.common').css('display', 'none');
            
         }
        }
        else {
            $('.download').css('display', 'block');
            $('.country').css('display', 'none');
            $('.city').css('display', 'none');
            $('.suburb').css('display', 'none');            
            $('.hotel').css('display', 'none');
            $('.common').css('display', 'none');
            $('.chain').css('display', 'none'); 
           
        }
    });
    
    $('#DownloadTableTable').change(function() {
        $('#DownloadTableCountryId').val('');
        $('#DownloadTableCityId').val('');
        $('#TravelHotelLookupStatus').val('');
        $('#DownloadTableActive').val('');
        $('#DownloadTableWtbStatus').val('');
        $('#TravelHotelRoomSupplierHotelSupplierStatus').val('');
       
        $('#DownloadTableHotelCityId').val('');
        var table = $(this).val();
        var value = $('#DownloadTableOperation').val();
        if (value == '2') {
            $('.download').css('display', 'block');
            
            if(table == 'TravelCity'){
                $('.country').css('display', 'block');               
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.chain').css('display', 'none');
            }
            else if(table == 'Province'){
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.chain').css('display', 'none');
            }
            else if(table == 'TravelHotelLookup'){
                $('.country').css('display', 'block');
                $('.city').css('display', 'block');
                $('.chain').css('display', 'none');
                $('.common').css('display', 'block');
                $('.hotel').css('display', 'block');
                $('.suburb').css('display', 'block');
            }
            else if(table == 'TravelSuburb'){
                $('.country').css('display', 'block');               
                $('.city').css('display', 'block');
                $('.hotel').css('display', 'none');
                $('.suburb').css('display', 'none');       
                $('.chain').css('display', 'none');
            }
            else if(table == 'TravelArea'){
                $('.country').css('display', 'block');               
                $('.city').css('display', 'block');
                $('.suburb').css('display', 'block');
                $('.hotel').css('display', 'none');                      
                $('.chain').css('display', 'none');
            }
            else if(table == 'TravelBrand'){
                $('.chain').css('display', 'block'); 
                $('.country').css('display', 'none');               
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none');
                $('.hotel').css('display', 'none');                               
            }
     
            else{
                $('.download').css('display', 'block');
                $('.country').css('display', 'none');
                $('.chain').css('display', 'none'); 
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none');                
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
             
            }
        }
        else if(value == '3'){
            $('.download').css('display', 'none');
            if(table == 'TravelCity'){
                $('.country').css('display', 'block');
                $('.chain').css('display', 'none'); 
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none'); 
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                
            }
            else if(table == 'Province'){
                $('.country').css('display', 'block');
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none');
                $('.hotel').css('display', 'none');
                $('.common').css('display', 'none');
                $('.chain').css('display', 'none');
            }
            else if(table == 'TravelHotelLookup'){
                $('.country').css('display', 'block');
                $('.city').css('display', 'block');
                $('.chain').css('display', 'none');
                $('.hotel').css('display', 'block');
                $('.common').css('display', 'block');
                $('.suburb').css('display', 'block'); 
                
       
            }
            else if(table == 'TravelSuburb'){
                $('.country').css('display', 'block');               
                $('.city').css('display', 'block');
                $('.hotel').css('display', 'none');   
                $('.suburb').css('display', 'none'); 
                $('.chain').css('display', 'none');
            }
            else if(table == 'TravelArea'){
                $('.country').css('display', 'block');               
                $('.city').css('display', 'block');
                $('.suburb').css('display', 'block'); 
                $('.hotel').css('display', 'none');                      
                $('.chain').css('display', 'none');
            }
            else if(table == 'TravelBrand'){
                $('.chain').css('display', 'block'); 
                $('.country').css('display', 'none');               
                $('.city').css('display', 'none');
                $('.suburb').css('display', 'none');
                $('.hotel').css('display', 'none');                               
            }

         else{
            $('.download').css('display', 'none');
            $('.chain').css('display', 'none');
            $('.country').css('display', 'none');
            $('.city').css('display', 'none');
            $('.suburb').css('display', 'none');
            $('.hotel').css('display', 'none');
            $('.common').css('display', 'none');
            $('.hotel_mapping').css('display', 'none');
         }
        }
        else {
            $('.download').css('display', 'block');
            $('.chain').css('display', 'none');
            $('.country').css('display', 'none');
            $('.city').css('display', 'none');
            $('.suburb').css('display', 'none');
            $('.hotel').css('display', 'none');
            $('.common').css('display', 'none');           
        }
        
    });
    
    function valiDate()
{
    var table = $('#DownloadTableTable').val();
    
    if(document.fom.DownloadTableTypeId.value=="")
	{
		alert("Select type");
		document.fom.DownloadTableTypeId.focus();
		return false;
	}
    
    if(document.fom.DownloadTableTable.value=="")
	{
		alert("Select table");
		document.fom.DownloadTableTable.focus();
		return false;
	}
    
    if(document.fom.DownloadTableOperation.value=="")
	{
		alert("Select operation");
		document.fom.DownloadTableOperation.focus();
		return false;
	}
    
    if(table == 'TravelCity' || table == 'TravelSuburb' || table == 'TravelArea' || table == 'TravelHotelLookup'  || table == 'Province'){
	 if(document.fom.DownloadTableCountryId.value=="")
	{
		alert("Select country");
		document.fom.DownloadTableCountryId.focus();
		return false;
	}
    }

}
</script>


