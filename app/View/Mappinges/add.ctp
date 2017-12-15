<?php
$this->Html->addCrumb('Add Mapping', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('Mapping', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
     
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
));
App::import('Model','User');
$attr = new User();
echo $this->Form->hidden('operation');
echo $this->Form->hidden('hotel_province_name');
echo $this->Form->hidden('city_province_name');
echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));


if($mapping_type == '1'){ //country
    $style_country = 'block';
    $style_city = 'none';
    $style_hotel = 'none';
    
}
elseif ($mapping_type == '2') { //city
    $style_city = 'block';
    $style_country = 'none';
    $style_hotel = 'none';
    $search_result = 'block';
}
elseif ($mapping_type == '3') { //hotel
    $style_hotel = 'block';
    $search_result = 'block';
    $style_city = 'none';
    $style_country = 'none';
}
else{
    $style_city = 'none';
    $style_country = 'none';
    $style_hotel = 'none';
    $search_result = 'none';
}
if($user_id == '166')  //infra mapping
    $diabled_mapping_type = array('1','4');
else
    $diabled_mapping_type = array('1','4');
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Mapping</h4>
        </div>
        <div class="panel-body">
           
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="reg_input_name" class="req"  style="margin-left: 14px;">Mapping Type</label>
                        <span class="colon">:</span>
                        <div class="col-sm-4">
                            <?php
                            echo $this->Form->input('mapping_type', array('options' => $TravelMappingTypes, 'empty' => '--Select--', 'data-required' => 'true','disabled' => $diabled_mapping_type));
                            ?></div>
                    </div>
                </div>
                <div class="col-sm-12" id="country" style="display: <?php echo $style_country?>">
                    <div class="col-sm-6">
                       
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('country_supplier_code', array('id' => 'country_supplier_code','options' => $TravelSuppliers, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">SUPP Country Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('supplier_country_code');
                                ?></div><span class="icon-info-sign" style="color: #5DD0ED;" data-toggle="tooltip"  data-placement="left" title="Please check the Country data provided by your supplier for this code. IMPORTANT: This code may be different from WTB Country code."></span>
                        </div>
                        <!--
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Mapping Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('country_mapping_name',array('placeholder' => 'SUPP NAME | COUNTRY NAME'));
                                ?></div><span class="icon-info-sign" style="color: #5DD0ED;" data-toggle="tooltip"  data-placement="left" title="Example: RezLive | Slovakia"></span>
                        </div>-->

                    </div>
                    <div class="col-sm-6">
                      
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('pf_country_code', array('id' => 'pf_country_code','options' => $country_wtb_country, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-sm-12" id="city" style="display: <?php echo $style_city?>">
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_supplier_code', array('id' => 'city_supplier_code','options' => $TravelSuppliers, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Province</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('city_province_id', array('id' => 'city_province_id','options' => $Provinces,'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier City Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('supplier_city_code');
                                ?></div>
                        </div>
                        
                      

                    </div>
                    <div class="col-sm-6">
                       
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_country_code', array('id' => 'city_country_code','options' => $city_wtb_country, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('pf_city_code', array('id' => 'pf_city_code','options' => $city_wtb_city, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        
                        
                    </div>
                </div>
                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12" id="hotel" style="display: <?php echo $style_hotel?>">
                    <div class="col-sm-6">
                      
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_supplier_code', array('id' => 'hotel_supplier_code','options' => $TravelSuppliers, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Province</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('hotel_province_id', array('id' => 'hotel_province_id','options' => $Provinces,'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Hotel</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_code', array('id' => 'hotel_code','options' => $hotel_list, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        
                                       
                    </div>
                    <div class="col-sm-6">                      
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_country_code', array('id' => 'hotel_country_code','options' => $city_wtb_country, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_city_code', array('id' => 'hotel_city_code','options' => $hotel_city, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier Hotel Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('supplier_item_code1');
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
                        <div class="col-sm-6"  style="margin-top:10px">
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
                            <label for="reg_input_name" style="margin-left:15px;">Hotel Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10" id="MappingHotelAddress" style="margin-top:7px">
                               <?php echo $address;?>
                               </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" style="margin-left:15px;">Website Url</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10" id="MappingWebsiteUrl" style="margin-top:7px">
                                <?php echo $this->Html->link($website_url, $website_url, array('target' => '_blank')); ?>
                               </div>
                        </div>
                        </div>
                </div>
                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-2 search_result" style="display:<?php echo $search_result?>">
                            <?php
                            echo $this->Form->submit('Check Existing Entries', array('class' => 'btn btn-success sticky_success duplicate','id' => 'search_mapping','name' => 'search_mapping','style' => 'width:100%'));
                            ?>
                        </div>   
                        
                    </div>

                </div>
                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12" style="display:<?php echo $search_result?>; margin-top:10px;">
                <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="3000">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="4" class="nodis">Mapping Information</th>                       
                        <th data-group="group2" colspan="2">Mapping City Code</th>
                        <th data-group="group3" colspan="2">Mapping Hotel Code</th>
                        <th data-group="group4" colspan="2">Mapping Logistics </th>                       
                        <th data-group="group5" class="nodis">Action</th>
                    </tr>
                    <tr>
                        <th data-toggle="true" data-group="group1" width="20%">Mapping Name</th>                       
                        <th data-hide="phone" data-group="group1" width="8s%">Mapping Status</th>
                        <th data-hide="phone" data-group="group1" width="5%" data-sort-ignore="true">Mapping Active?</th>
                        <th data-hide="phone" data-group="group1" width="5%"  data-sort-ignore="true">Mapping Excluded?</th>    
                        
                        <th data-hide="phone" data-group="group2" width="5%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group2" width="8%" data-sort-ignore="true">Supplier</th>
                        
                        <th data-hide="phone" data-group="group3" width="5%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group3" width="8%" data-sort-ignore="true">Supplier</th>
                        
                        <th data-hide="phone" data-group="group4" width="12%" data-sort-ignore="true">Created By</th>
                        <th data-hide="phone" data-group="group4" width="12%" data-sort-ignore="true">Approved By</th>
                        
                        <th data-group="group5" data-hide="phone" data-sort-ignore="true" width="3%">Action</th>        
                    </tr>
                </thead>
                <tbody>
<?php


	//pr($Mappinges);
$id = '';
$status = '';
$mapping_name = '';
$city_wtb = '';
$city_supplier = '';
$approve = '';
$excluded = '';
$created_by = '';
$approve_by = '';
$hotel_wtb = '';
$hotel_supplier = '';

if (isset($Mappinges) && count($Mappinges) > 0):
    foreach ($Mappinges as $Mappinge):
    
     if($mapping_type == '2'){
        $id = $Mappinge['TravelCitySupplier']['id'];
        $status = $Mappinge['TravelCitySupplier']['city_supplier_status'];
        $mapping_name = $Mappinge['TravelCitySupplier']['city_mapping_name'];
        $city_wtb = $Mappinge['TravelCitySupplier']['pf_city_code'];
        $city_supplier = $Mappinge['TravelCitySupplier']['supplier_city_code'];
        $approve = $Mappinge['TravelCitySupplier']['active'];
        $excluded = $Mappinge['TravelCitySupplier']['excluded'];
        $created_by = $attr->Username($Mappinge['TravelCitySupplier']['created_by']).' '.$Mappinge['TravelCitySupplier']['created'];
        if($Mappinge['TravelCitySupplier']['approved_by']) 
            $approve_by = $attr->Username($Mappinge['TravelCitySupplier']['approved_by']).' '.$Mappinge['TravelCitySupplier']['approved_date'];
        
     }
     elseif($mapping_type == '3'){
         $id = $Mappinge['TravelHotelRoomSupplier']['id'];
         $status = $Mappinge['TravelHotelRoomSupplier']['hotel_supplier_status'];
         $approve = $Mappinge['TravelHotelRoomSupplier']['hotel_supplier_approve'];
         $mapping_name = $Mappinge['TravelHotelRoomSupplier']['hotel_mapping_name'];
         $hotel_wtb = $Mappinge['TravelHotelRoomSupplier']['hotel_code'];
         $hotel_supplier = $Mappinge['TravelHotelRoomSupplier']['supplier_item_code1'];
         $city_wtb = $Mappinge['TravelHotelRoomSupplier']['hotel_city_code'];
         $city_supplier = $Mappinge['TravelHotelRoomSupplier']['supplier_item_code3'];
         $created_by = $attr->Username($Mappinge['TravelHotelRoomSupplier']['created_by']).' '.$Mappinge['TravelHotelRoomSupplier']['created'];
        if($Mappinge['TravelHotelRoomSupplier']['approved_by']) 
            $approve_by = $attr->Username($Mappinge['TravelHotelRoomSupplier']['approved_by']).' '.$Mappinge['TravelHotelRoomSupplier']['approved_date'];
     }
        
       
        // table of travel_action_item_types
        
        if($status == '1')
            $status_txt = 'Submitted For Approval';
        elseif($status == '2')
            $status_txt = 'Approved';
        elseif($status == '3')
           $status_txt = 'Returned';
        elseif($status == '4')
           $status_txt = 'Change Submitted';
        elseif($status == '5')
           $status_txt = 'Rejection';
        elseif($status == '6')
           $status_txt = 'Request For Allocation';
        else
            $status_txt = 'Allocation';
        
        if($approve == '1')
            $approved_txt = 'TRUE';
        else 
            $approved_txt = 'FALSE';
        
        if($excluded == '1')
            $excluded_txt = 'TRUE';
        else 
            $excluded_txt = 'FALSE';
        
        
        ?>
                            <tr>
                                <td class="tablebody"><?php echo $mapping_name; ?></td>
                                
                                <td class="tablebody"><?php echo $status_txt; ?></td>
                                <td class="tablebody"><?php echo $approved_txt; ?></td>
                                <td class="tablebody"><?php echo $excluded_txt; ?></td>
                                
                                
                                <td class="sub-tablebody"><?php echo $city_wtb; ?></td>
                                <td class="sub-tablebody"><?php echo $city_supplier; ?></td>
                                
                                <td class="sub-tablebody"><?php echo $hotel_wtb; ?></td>
                                <td class="sub-tablebody"><?php echo $hotel_supplier; ?></td>
                                
                                <td class="sub-tablebody"><?php echo $created_by; ?></td>
                                <td class="sub-tablebody"><?php echo $approve_by; ?></td> 
                                
                             
                                <td width="10%" valign="middle" align="center">
                                    <?php 
                                        $options=array($id=>'');
                                        $attributes=array('legend'=>false, 'hiddenField' => false,'label' => false,'div' => false,'class' => 'attrInputs');
                                        echo $this->Form->radio('duplicate',$options,$attributes);
                                        ?>
                                 

                                </td>

                            </tr>
        <?php endforeach; ?>

                        <?php
                        //echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="11" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>
               
                </div>
                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12">
                <div class="row">
                        <div class="col-sm-2" id="add_mapping">
                            <?php
                            echo $this->Form->submit('Add Mapping', array('class' => 'btn btn-success sticky_success validation','name' => 'add','style' => 'width:100%'));
                            ?>
                        </div>
                        <div class="col-sm-2"  style="display:<?php echo $search_result?>;">
                            <?php echo $this->Form->submit('Report Duplicate', array('class' => 'btn btn-success sticky_success duplicate','id' => 'duplicate_bttn','name' => 'duplicate','style' => 'width:100%')); ?>
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

$this->Js->get('#country_supplier_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_by_country/Mapping/country_supplier_code'
                ), array(
            'update' => '#pf_country_code',
            'async' => true,
            'before' => 'loading("pf_country_code")',
            'complete' => 'loaded("pf_country_code")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#city_supplier_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_by_city/Mapping/city_supplier_code'
                ), array(
            'update' => '#city_country_code',
            'async' => true,
            'before' => 'loading("city_country_code")',
            'complete' => 'loaded("city_country_code")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#hotel_supplier_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_by_city/Mapping/hotel_supplier_code'
                ), array(
            'update' => '#hotel_country_code',
            'async' => true,
            'before' => 'loading("hotel_country_code")',
            'complete' => 'loaded("hotel_country_code")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#hotel_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_suburb_by_hotel_code/Mapping/hotel_code'
                ), array(
            'update' => '#MappingHotelSuburbId',
            'async' => true,
            'before' => 'loading("MappingHotelSuburbId")',
            'complete' => 'loaded("MappingHotelSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#hotel_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_area_by_hotel_code/Mapping/hotel_code'
                ), array(
            'update' => '#MappingHotelAreaId',
            'async' => true,
            'before' => 'loading("MappingHotelAreaId")',
            'complete' => 'loaded("MappingHotelAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#hotel_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_chain_by_hotel_code/Mapping/hotel_code'
                ), array(
            'update' => '#MappingHotelChainId',
            'async' => true,
            'before' => 'loading("MappingHotelChainId")',
            'complete' => 'loaded("MappingHotelChainId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#hotel_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_brand_by_hotel_code/Mapping/hotel_code'
                ), array(
            'update' => '#MappingHotelBrandId',
            'async' => true,
            'before' => 'loading("MappingHotelBrandId")',
            'complete' => 'loaded("MappingHotelBrandId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#hotel_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_website_by_hotel_code/Mapping/hotel_code'
                ), array(
            'update' => '#MappingWebsiteUrl',
            'async' => true,
            'before' => 'loading("MappingWebsiteUrl")',
            'complete' => 'loaded("MappingWebsiteUrl")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#hotel_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_hotel_address_by_hotel_code/Mapping/hotel_code'
                ), array(
            'update' => '#MappingHotelAddress',
            'async' => true,
            'before' => 'loading("MappingHotelAddress")',
            'complete' => 'loaded("MappingHotelAddress")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#hotel_country_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_country_code/Mapping/hotel_country_code'
                ), array(
            'update' => '#hotel_province_id',
            'async' => true,
            'before' => 'loading("hotel_province_id")',
            'complete' => 'loaded("hotel_province_id")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#city_country_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_country_code/Mapping/city_country_code'
                ), array(
            'update' => '#city_province_id',
            'async' => true,
            'before' => 'loading("city_province_id")',
            'complete' => 'loaded("city_province_id")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#city_province_id')->event('change', $this->Js->request(array(
                            'controller' => 'all_functions',
                            'action' => 'get_city_code_by_province_id/Mapping/city_province_id'
                                ), array(
                            'update' => '#pf_city_code',
                            'async' => true,
                            'before' => 'loading("pf_city_code")',
                            'complete' => 'loaded("pf_city_code")',
                            'method' => 'post',
                            'dataExpression' => true,
                            'data' => $this->Js->serializeForm(array(
                                    'isForm' => true,
                                    'inline' => true
                                ))
                        ))
                );
/*
$this->Js->get('#city_country_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_country_by_city/Mapping/city_country_code'
                ), array(
            'update' => '#pf_city_code',
            'async' => true,
            'before' => 'loading("pf_city_code")',
            'complete' => 'loaded("pf_city_code")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#city_country_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_country_by_city/Mapping/city_country_code'
                ), array(
            'update' => '#pf_city_code',
            'async' => true,
            'before' => 'loading("pf_city_code")',
            'complete' => 'loaded("pf_city_code")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
 * 
 */
?>   
<script>
    var FULL_BASE_URL = $('#hidden_site_baseurl').val();
       // $('.search_result').css('display','none');
        $('#MappingMappingType').change(function(){
        var value = $(this).val();
        if(value == '1'){
            $('#country').css('display','block');
            $('#city').css('display','none');
            $('#hotel').css('display','none');
            $('.search_result').css('display','none');
            $('#add_mapping').css('display','block');
        }
        else if(value == '2'){
            $('#city').css('display','block');
            $('#country').css('display','none');
            $('#hotel').css('display','none');
            $('.search_result').css('display','block');
            $('#add_mapping').css('display','none');
        }
        else if(value == '3'){
            $('#hotel').css('display','block');
            $('#country').css('display','none');
            $('#city').css('display','none');
            $('.search_result').css('display','block');
            $('#add_mapping').css('display','none');
        }
    });
    
    /*
    $('#city_country_code').change(function() {
        var country_id = $(this).val();
        var supplier_code = $('#city_supplier_code').val();
        var dataString = 'country_id=' + country_id + '&supplier_code='+supplier_code;
       
        $('#pf_city_code').attr('disabled', 'true');
        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/get_supplier_country_by_city',
            beforeSend: function() {
                
                $('#pf_city_code').attr('disabled', 'true');
            },
            success: function(return_data) {
                $('#pf_city_code').removeAttr('disabled', 'false');
                $('#pf_city_code').html(return_data);
            }
        });

    });
    */
    
    $('#hotel_province_id').change(function() {
        var province_id = $(this).val();
        var country_id = $('#hotel_country_code').val();
        var supplier_code = $('#hotel_supplier_code').val();
        var dataString = 'country_id=' + country_id + '&supplier_code='+supplier_code + '&province_id='+province_id;
       
        $('#hotel_city_code').attr('disabled', 'true');
        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/get_hotel_supplier_country_by_city',
            beforeSend: function() {
                
                $('#hotel_city_code').attr('disabled', 'true');
            },
            success: function(return_data) {
                $('#hotel_city_code').removeAttr('disabled', 'false');
                $('#hotel_city_code').html(return_data);
            }
        });
    });
    
    $('#hotel_city_code').change(function() {
        var city_code = $('#hotel_city_code').val();
        var country_code = $('#hotel_country_code').val();
        var supplier_code = $('#hotel_supplier_code').val();
        var dataString = 'country_code=' + country_code + '&supplier_code='+supplier_code+ '&city_code='+city_code;
       
        $('#hotel_code').attr('disabled', 'true');
        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/get_hotel_by_city_country_supplier',
            beforeSend: function() {
                
                $('#hotel_code').attr('disabled', 'true');
            },
            success: function(return_data) {
                $('#hotel_code').removeAttr('disabled', 'false');
                $('#hotel_code').html(return_data);
            }
        });

    });
    
    $('.sticky_success').click(function(){
        var value= $(this).attr('name');
        $('#MappingOperation').val(value);
    });
    
    $('.validation').click(function(){
       var type = $('#MappingMappingType').val();
       if(type == '1'){           
            if($("#country_supplier_code").val() == "") {
              alert('Select supplier');
              return false;
            }
            if($("#pf_country_code").val() == "") {
              alert('Select country');
              return false;
            }
            if($("#MappingSupplierCountryCode").val() == "") {
              alert('Supplier country code can not be blank');
              return false;
            }
       }
       else if(type == '2'){           
            if($("#city_supplier_code").val() == "") {
              alert('Select supplier');
              return false;
            }
            if($("#city_country_code").val() == "") {
              alert('Select country');
              return false;
            }
            if($("#city_province_id").val() == "") {
              alert('Select province');
              return false;
            }
            if($("#pf_city_code").val() == "") {
              alert('Select city');
              return false;
            }
            if($("#MappingSupplierCityCode").val() == "") {
              alert('Supplier city code can not be blank');
              return false;
            }
       }
       else if(type == '3'){
            if($("#hotel_supplier_code").val() == "") {
              alert('Select supplier');
              return false;
            }
            if($("#hotel_country_code").val() == "") {
              alert('Select country');
              return false;
            }
            if($("#hotel_province_id").val() == "") {
              alert('Select province');
              return false;
            }
            if($("#hotel_city_code").val() == "") {
              alert('Select city');
              return false;
            }
            if($("#hotel_code").val() == "") {
              alert('Select hotel');
              return false;
            }
            if($("#MappingSupplierItemCode1").val() == "") {
              alert('Supplier hotel code can not be blank');
              return false;
            }
            if($("#MappingHotelSuburbId").val() == "") {
              alert('Select suburb');
              return false;
            }
            if($("#MappingHotelAreaId").val() == "") {
              alert('Select area');
              return false;
            }
            if($("#MappingHotelChainId").val() == "") {
              alert('Select chain');
              return false;
            }
            if($("#MappingHotelBrandId").val() == "") {
              alert('Select brand');
              return false;
            }
            
       }
    });
    
    $('.duplicate').click(function(){
       var type = $('#MappingMappingType').val();
       if(type == '1'){           
            if($("#country_supplier_code").val() == "") {
              alert('Select supplier');
              return false;
            }
            if($("#pf_country_code").val() == "") {
              alert('Select country');
              return false;
            }
            if($("#MappingSupplierCountryCode").val() == "") {
              alert('Supplier country code can not be blank');
              return false;
            }
       }
       else if(type == '2'){           
            if($("#city_supplier_code").val() == "") {
              alert('Select supplier');
              return false;
            }
            if($("#city_country_code").val() == "") {
              alert('Select country');
              return false;
            }
            
            if($("#pf_city_code").val() == "") {
              alert('Select city');
              return false;
            }
            if($("#MappingSupplierCityCode").val() == "") {
              alert('Supplier city code can not be blank');
              return false;
            }
       }
       else if(type == '3'){
            if($("#hotel_supplier_code").val() == "") {
              alert('Select supplier');
              return false;
            }
            if($("#hotel_country_code").val() == "") {
              alert('Select country');
              return false;
            }
           
            if($("#hotel_city_code").val() == "") {
              alert('Select city');
              return false;
            }
            if($("#hotel_code").val() == "") {
              alert('Select hotel');
              return false;
            }
            if($("#MappingSupplierItemCode1").val() == "") {
              alert('Supplier hotel code can not be blank');
              return false;
            }
            
            
       }
    });
    
    
    $('#duplicate_bttn').click(function(){
        if($('.attrInputs:checked').length<=0)
            {
             alert("No radio checked");
             return false;
            }
    });
    
    $('#hotel_province_id').change(function() {
            $('#MappingHotelProvinceName').val($('#hotel_province_id option:selected').text());
        });
        
    $('#city_province_id').change(function() {
            $('#MappingCityProvinceName').val($('#city_province_id option:selected').text());
        });    
    
 

    
    
  
        
</script>
