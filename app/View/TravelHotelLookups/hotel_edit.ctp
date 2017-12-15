<?php
$this->Html->addCrumb('Edit Hotel', 'javascript:void(0);', array('class' => 'breadcrumblast'));

?>

<div class="col-sm-12" id="mycl-det">
    <div class="table-heading">
             
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Open New Ticket', '/support_tickets/add/1/'.$this->data['TravelHotelLookup']['id'],array('class' => 'act-ico open-popup-link add-btn','escape' => false,'data-placement' => "left", 'title' => "Open New Ticket",'data-toggle' => "tooltip")) ?></span>
          
        </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Primary Information</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('TravelHotelLookup', array('enctype' => 'multipart/form-data', 'method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
         
                    echo $this->Form->hidden('continent_name');
                    echo $this->Form->hidden('continent_code');
                    echo $this->Form->hidden('country_code');
                    echo $this->Form->hidden('country_name');
                    echo $this->Form->hidden('city_name');
                    echo $this->Form->hidden('suburb_name');
                    echo $this->Form->hidden('area_name');
                    echo $this->Form->hidden('chain_name');
                    echo $this->Form->hidden('brand_name');
                    echo $this->Form->hidden('city_code');
                    echo $this->Form->hidden('province_name');
                    ?> 
                    
                   
                   
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6">                                   
                                    <div class="form-group">
                                        <label for="input_name" class="req">Hotel Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('hotel_name', array('data-required' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Continent</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Province</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('province_id', array('options' => $Provinces, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Suburb</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('suburb_id', array('options' => $TravelSuburbs, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Chain</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('chain_id', array('options' => $TravelChains, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Property Type</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('property_type', array('options' => $TravelLookupPropertyTypes, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                    
                                   

                                    <div class="form-group">
                                        <label for="input_name">Post Code</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('post_code', array());
                                            ?></div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="input_name" class="req">Status</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('status', array('options' => array('1' => 'Submitted For Approval', '2' => 'Approved', '3' => 'Returned', '4' => 'Change Submitted', '5' => 'Rejected', '7' => 'Duplicated'), 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?></div>
                                    </div>                                    
                                </div>

                                <div class="col-sm-6">
                                    
                                    <div class="form-group">
                                        <label for="input_name" class="req">Hotel Code</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('hotel_code', array('data-required' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Country</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">City</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('city_id', array('options' => $TravelCities, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                     <div class="form-group">
                                        <label for="reg_input_name">Area</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('area_id', array('options' => $TravelAreas, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Brand</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('brand_id', array('options' => $TravelBrands, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>   
                                    
                                    <div class="form-group">
                                        <label for="reg_input_name">Rate Type </label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('rate_type', array('options' => $TravelLookupRateTypes, 'empty' => '--Select--','disabled'));
                                            ?></div>
                                    </div>  

                                    <div class="form-group int-sm">
                                        <label>Location</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">  <?php
                                            echo $this->Form->input('gps_prm_1', array('class' => 'form-control decimal','placeholder' => 'GPS Parameter 1','style' => 'width:47%'));
                                            echo $this->Form->input('gps_prm_2', array('class' => 'form-control decimal','placeholder' => 'GPS Parameter 2','style' => 'width:47%'));
                                            ?></div>
                                    </div>   
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Active?</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?></div>
                                    </div>
                                </div>
                                <br class="spacer" />
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('address', array('type' => 'textarea'));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('hotel_comment', array('type' => 'textarea','style' => 'width:100%;height:100px'));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              <div style="clear: both"></div>
                                    <div class="col-sm-12">
                                    <h4>Mapping Information</h4>
                    
                    <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                   
                    <tr>                        
                        <th data-toggle="phone"  data-group="group1">Supplier Code</th>                        
                        <th data-hide="phone"  data-group="group1">Mapping Status</th>                                                              
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Mapping Active?</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Mapping Excluded?</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Mapping Name</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">WTB</th> 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Supplier</th>  
                                            
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //pr($TravelCountrySuppliers);
                    if (isset($this->data['TravelHotelRoomSupplier']) && count($this->data['TravelHotelRoomSupplier']) > 0):
                        foreach ($this->data['TravelHotelRoomSupplier'] as $TravelHotelRoomSupplier):
                       // pr($TravelHotelRoomSupplier);
                            $id = $TravelHotelRoomSupplier['id'];
                            $status = $TravelHotelRoomSupplier['hotel_status'];
                            if ($status == '1')
                                $status_txt = 'Submitted For Approval';
                            elseif ($status == '2')
                                $status_txt = 'Approved';
                            elseif ($status == '3')
                                $status_txt = 'Returned';
                            elseif ($status == '4')
                                $status_txt = 'Change Submitted';
                            elseif ($status == '5')
                                $status_txt = 'Rejection';
                            elseif ($status == '6')
                                $status_txt = 'Request For Allocation';
                            else
                                $status_txt = 'Allocation';
                            ?>
                            <tr>
                              
                                <td><?php echo $TravelHotelRoomSupplier['supplier_code']; ?></td>
                                <td><?php echo $status_txt; ?></td>
                                <td><?php echo $TravelHotelRoomSupplier['active']; ?></td>                                                          
                               
                                <td><?php echo $TravelHotelRoomSupplier['excluded']; ?></td>
                                <td><?php echo $TravelHotelRoomSupplier['hotel_mapping_name']; ?></td>
                                <td><?php echo $TravelHotelRoomSupplier['hotel_code']; ?></td>
                                <td><?php echo $TravelHotelRoomSupplier['supplier_item_code1']; ?></td>
                              </tr>
                        <?php endforeach; ?>

                        <?php
                      
                    else:
                        echo '<tr><td colspan="7" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
                                    </div>
                        </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Update', array('class' => 'btn btn-success sticky_success'));
                            ?>
                        </div>              
                    </div>
                   

                
<?php echo $this->Form->end(); ?>
                </div>
            </div>

        </div>
    </div>
</div>


<?php
$data = $this->Js->get('#parsley_reg')->serializeForm(array('isForm' => true, 'inline' => true));

$this->Js->get('#TravelHotelLookupContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_all_travel_country_by_continent_id/TravelHotelLookup/continent_id'
                ), array(
            'update' => '#TravelHotelLookupCountryId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupCountryId")',
            'complete' => 'loaded("TravelHotelLookupCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelHotelLookupProvinceId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_province/TravelHotelLookup/province_id'
                ), array(
            'update' => '#TravelHotelLookupCityId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupCityId")',
            'complete' => 'loaded("TravelHotelLookupCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelHotelLookupCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_suburb_by_country_id_and_city_id/TravelHotelLookup/country_id/city_id'
                ), array(
            'update' => '#TravelHotelLookupSuburbId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupSuburbId")',
            'complete' => 'loaded("TravelHotelLookupSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelHotelLookupSuburbId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_area_by_suburb_id/TravelHotelLookup/suburb_id'
                ), array(
            'update' => '#TravelHotelLookupAreaId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupAreaId")',
            'complete' => 'loaded("TravelHotelLookupAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelHotelLookupChainId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_brand_by_chain_id/TravelHotelLookup/chain_id'
                ), array(
            'update' => '#TravelHotelLookupBrandId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupBrandId")',
            'complete' => 'loaded("TravelHotelLookupBrandId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelHotelLookupCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_continent_country/TravelHotelLookup/continent_id/country_id'
                ), array(
            'update' => '#TravelHotelLookupProvinceId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupProvinceId")',
            'complete' => 'loaded("TravelHotelLookupProvinceId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
?>
<script>
    $(document).ready(function() {
        
          
        $('#TravelHotelLookupSuburbId').change(function() {
            $('#TravelHotelLookupSuburbName').val($('#TravelHotelLookupSuburbId option:selected').text());
        });
        
        $('#TravelHotelLookupAreaId').change(function() {
            $('#TravelHotelLookupAreaName').val($('#TravelHotelLookupAreaId option:selected').text());
        });
        
        $('#TravelHotelLookupChainId').change(function() {
            $('#TravelHotelLookupChainName').val($('#TravelHotelLookupChainId option:selected').text());
        });
        
        $('#TravelHotelLookupBrandId').change(function() {
            $('#TravelHotelLookupBrandName').val($('#TravelHotelLookupBrandId option:selected').text());
        });
        $('#TravelHotelLookupProvinceId').change(function() {
            $('#TravelHotelLookupProvinceName').val($('#TravelHotelLookupProvinceId option:selected').text());
        });
        
        $('.decimal').change(function(event) {        
        this.value = parseFloat(this.value).toFixed(7);
       
    });
    
    $('#TravelHotelLookupCityId').change(function() {
            var str = $('#TravelHotelLookupCityId option:selected').text();
            var res = str.split("-");          
            $('#TravelHotelLookupCityCode').val(res[0]);
            $('#TravelHotelLookupCityName').val(res[1]);
        });
        
        $('#TravelHotelLookupCountryId').change(function() {
            var str = $('#TravelHotelLookupCountryId option:selected').text();
            var res = str.split("-");          
            $('#TravelHotelLookupCountryCode').val(res[0]);
            $('#TravelHotelLookupCountryName').val(res[1]);
        });
        
        $('#TravelHotelLookupContinentId').change(function() {
            var str = $('#TravelHotelLookupContinentId option:selected').text();
            var res = str.split("-");          
            $('#TravelHotelLookupContinentCode').val(res[0]);
            $('#TravelHotelLookupContinentName').val(res[1]);
        });
    
  
    });

</script>    

