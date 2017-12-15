<?php
$this->Html->addCrumb('My Supplier Hotels', 'javascript:void(0);', array('class' => 'breadcrumblast'));
App::import('Model', 'TravelActionItem');
$TravelActionItem = new TravelActionItem();
//pr($this->params['named']);
if(isset($this->request->params['named']['id']))
    $supplier_hotel_id = $this->request->params['named']['id'];
else
    $supplier_hotel_id = $id;
$screen = '10';        
?>    

<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Supplier Hotel</h4>
           
        </div>
        <div class="panel panel-default">

            <div class="row" style="padding: 15px;">
        <div class="col-sm-12">
        </div>
        <div class="table-heading">
             
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Open New Ticket', '/support_tickets/add/'.$screen.'/'.$passed_supplier_hotel_id.'/'.$passed_ticket_id.'/'.$passed_wtb_continent_id.'/'.$passed_wtb_country_id.'/'.$passed_wtb_province_id.'/'.$passed_wtb_city_id,array('class' => 'act-ico open-popup-link add-btn','escape' => false,'data-placement' => "left", 'title' => "Create New Ticket",'data-toggle' => "tooltip")) ?></span>
          
        </div>        
    </div> 
        <?php   ?>     
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="500">
               
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="6" class="nodis">Hotel Information</th>
                        <th data-group="group9" colspan="6">Hotel Location</th>
                        <th data-group="group10" colspan="4">Hotel Status</th>                  
                        
                        <th data-group="group8" class="nodis">Hotel Action</th>
                    </tr>
                   
                    <tr>
                        <th data-hide="phone" data-group="group1" width="2%" data-sort-ignore="true"><input type="checkbox" class="mbox_select_all" name="msg_sel_all"></th>
                        <th data-toggle="phone" data-sort-ignore="true" width="3%" data-group="group1">Id</th>
                        <th data-hide="phone" data-group="group9" width="5%" data-sort-ignore="true">Supplier</th>                        
                        <th data-hide="phone" data-group="group9" width="10%" data-sort-ignore="true">Country</th>
                        <th data-hide="phone" data-group="group9" width="5%" data-sort-ignore="true">Country Code</th>                        
                        <th data-hide="phone" data-group="group9" width="8%" data-sort-ignore="true">City</th>
                        <th data-hide="phone" data-group="group9" width="5%" data-sort-ignore="true">City Code</th>                        
                        <th data-toggle="phone" data-sort-ignore="true" width="10%" data-group="group9">Hotel</th>
                        <th data-toggle="phone" data-group="group9" width="3%" data-sort-ignore="true">Hotel Code</th>                    
                        <th data-hide="phone" data-group="group9" width="40%" data-sort-ignore="true">Hotel Address</th>
                        <th data-hide="phone" data-group="group9" width="5%" data-sort-ignore="true">Duplicate of Hotel</th>                        
                        <th data-hide="phone" data-group="group10" width="10%" data-sort-ignore="true">Hotel Status</th>                        
                        <th data-hide="phone" data-group="group10" width="5%" data-sort-ignore="true">No. Of Mapping</th>
                        <th data-group="group8" data-hide="phone" data-sort-ignore="true" width="7%">Action</th> 

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
	//pr($SupplierHotels);
        //die;
                    $secondary_city = '';

                    if (isset($SupplierHotels) && count($SupplierHotels) > 0):
                        foreach ($SupplierHotels as $SupplierHotel):
                        
                            $mappingcount = $TravelActionItem->HotelMappingPending($SupplierHotel['TravelHotelRoomSupplier'][0]['id']);
                            $mappingcount = 10;
                                                
                            $id = $SupplierHotel['SupplierHotel']['id'];

                            $status = $SupplierHotel['SupplierHotel']['status'];
                            if ($status == '1')
                                $status_txt = 'Fetched';
                            elseif ($status == '2')
                                $status_txt = 'Mapping Request Submitted';
                            elseif ($status == '3')
                                $status_txt = 'Mapping Approved';
                            elseif ($status == '4')
                                $status_txt = 'Creation Request Submitted';
                            elseif ($status == '5')
                                $status_txt = 'Created';
                            elseif ($status == '6')
                                $status_txt = 'Submitted For Review';
                            elseif ($status == '7')
                                $status_txt = 'Mapping Approved (R)';
                            elseif ($status == '8')
                                $status_txt = 'Mapping Rejected';    
                            elseif ($status == '9')
                                $status_txt = 'Marked as Duplicate'; 
                            elseif ($status == '10')
                                $status_txt = 'Hotel Not Found'; 
                            elseif ($status == '11')
                                $status_txt = 'Hotel Not Found in City/Country';                             
                            else
                                $status_txt = 'Unknown';

                            if ($SupplierHotel['SupplierHotel']['wtb_status'] == '1')
                                $wtb_status = 'OK';
                            else
                                $wtb_status = 'ERROR';
                            ?>
                            <tr>
                                <td class="tablebody"><?php											
                                echo $this->Form->checkbox('check', array('name' => 'data[SupplierHotel][check][]','class' => 'msg_select','readonly' => true,'hiddenField' => false,'value' => $id));
                                ?></td>
                                <td class="tablebody"><?php echo $id; ?></td>                             
                                <td class="sub-tablebody"><?php echo $SupplierHotel['SupplierHotel']['supplier_code']; ?></td>                                 
                                <td class="sub-tablebody"><?php echo $SupplierHotel['SupplierHotel']['country_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $SupplierHotel['SupplierHotel']['country_code']; ?></td>
                                <td class="sub-tablebody">
				<a href="<?php echo $this->webroot .'admin/supplier_hotels/supplier_id:'.$SupplierHotel['SupplierHotel']['supplier_id'].'/country_id:'.$SupplierHotel['SupplierHotel']['country_id'].'/city_id:'.$SupplierHotel['SupplierHotel']['city_id'] ?>" target="_blank"><?php echo $SupplierHotel['SupplierHotel']['city_name']; ?></a>                                
                                </td>
                                <td class="sub-tablebody"><?php echo $SupplierHotel['SupplierHotel']['city_code']; ?></td>                                
                                <td class="tablebody"><?php echo $SupplierHotel['SupplierHotel']['hotel_name']; ?></td>               
                                <td class="tablebody"><?php echo $SupplierHotel['SupplierHotel']['hotel_code']; ?></td>                                                              
                                <td class="tablebody"><?php echo $SupplierHotel['SupplierHotel']['address']; ?></td>
                                <td class="tablebody">
                                    <?php echo $this->Html->link($SupplierHotel['SupplierHotel']['duplicate_of'], array('controller' => 'admin', 'action' => 'supplier_hotels/id:'.$SupplierHotel['SupplierHotel']['duplicate_of']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')); ?>
                                </td>
                                <td class="sub-tablebody"><?php echo $status_txt; ?></td>
                                <td class="sub-tablebody"><?php 
                                
                                if(count($SupplierHotel['TravelHotelRoomSupplier']) > 0) echo $this->Html->link(count($SupplierHotel['TravelHotelRoomSupplier']), array('controller' => 'travel_hotel_lookups', 'action' => 'view_supplier_mapping/' . $id), array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)); else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0';
                                ?></td>

                                <td valign="middle" align="center">

                                    <?php 
//                                    if($user_id == '169'){                                    
                                        if ($role_id == '64' || $role_id == '61') {                                    
                                            echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'admin', 'action' => 'hotel_mapping/' . $id.'/'.$SupplierHotel['SupplierHotel']['supplier_id'].'/'.$SupplierHotel['SupplierHotel']['country_id'].'/'.$SupplierHotel['SupplierHotel']['country_code'].'/'.$SupplierHotel['SupplierHotel']['city_id'].'/'.$wtb_continent_id.'/'.$wtb_country_id.'/'.$wtb_province_id.'/'.$wtb_city_id), array('class' => 'act-ico','target' => '_blank', 'escape' => false));
//                                          echo $this->Html->link('<span class="icon-remove"></span>', array('controller' => 'travel_hotel_lookups', 'action' => 'delete', $id), array('class' => 'act-ico', 'escape' => false), "Are you sure you wish to delete this hotel?");
                                    }
                                    ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>

                        <?php
                        //echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="43" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>           
            <?php echo $this->Form->end(); ?>
            <div class="clear" style="clear: both; margin-bottom: 10px;"></div>
            <?php if($display == 'TRUE'){ ?>
                <div class="col-sm-12" style="background-color: rgb(100, 233, 300);overflow:hidden;padding: 15px">
                    <h4>Existing Hotels for this WTB HOTEL</h4>
                    <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="3000">
                        <thead>         
                            <tr class="footable-group-row">
                                <th data-group="group1" colspan="9" class="nodis">Hotel Information</th>

                                <th data-group="group2" colspan="5">Hotel Information</th>

                               
                            </tr>
                            <tr>
                                <th data-toggle="true" data-group="group1" width="5%">Id</th>  
                                <th data-hide="phone" data-group="group1" width="10%"  data-sort-ignore="true">Continent Name</th> 
                                <th data-hide="phone" data-group="group1" width="10%">Country Name</th> 
                                <th data-hide="phone" data-group="group1" width="10%">Country Code</th>
                                <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">City Name</th>
                                <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">City Code</th>
                                <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">Hotel Name</th>
                                <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">Hotel Code</th>
                                <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">No. Of Mapping</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Suburb</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Area</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Chain</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Brand</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Address</th>
                                
                            </tr>
                        </thead>
                        <tbody>
<?php

if (isset($DuplicateData) && count($DuplicateData) > 0):
    foreach ($DuplicateData as $SupplierHotel):
        $id = $SupplierHotel['SupplierHotel']['id'];
        
        if($id)
            $tr_style = 'style="background-color:#5DD0ED"';
        else
            $tr_style = 'style="background-color:#FFFFFF"';
        ?>
                            <tr>
                                <td class="tablebody"><?php echo $id; ?></td>
                                <td class="tablebody"><?php echo $SupplierHotel['SupplierHotel']['continent_name']; ?></td> 
                                <td class="tablebody"><?php echo $SupplierHotel['SupplierHotel']['country_name']; ?></td>                                                                                            
                                <td class="tablebody"><?php echo $SupplierHotel['SupplierHotel']['country_code']; ?></td>                                                                                            
                                <td class="tablebody"><?php echo $SupplierHotel['SupplierHotel']['city_name']; ?></td>
                                <td class="tablebody"><?php echo $SupplierHotel['SupplierHotel']['city_code']; ?></td>
                                <td class="tablebody"><?php echo $SupplierHotel['SupplierHotel']['hotel_name']; ?></td>
                                <td class="tablebody"><?php echo $SupplierHotel['SupplierHotel']['hotel_code']; ?></td>
                                <td class="tablebody"><?php echo count($SupplierHotel['TravelHotelRoomSupplier']); ?></td>
                                <td class="sub-tablebody"><?php echo $SupplierHotel['SupplierHotel']['suburb_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $SupplierHotel['SupplierHotel']['area_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $SupplierHotel['SupplierHotel']['chain_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $SupplierHotel['SupplierHotel']['brand_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $SupplierHotel['SupplierHotel']['address']; ?></td>
                                
                            </tr>
        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="7" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                        </tbody>
                    </table>                 
                </div>
            <?php }?>
            
            
        </div>
    </div>
</div>

            <div class="col-sm-12" style="background-color: rgb(188, 255, 255);overflow:hidden;padding: 15px">
                <h4>SUPPLIER CITY <strong>[<?php echo $SupplierHotel['SupplierHotel']['country_name']; ?> ->> <?php echo $SupplierHotel['SupplierHotel']['city_name']; ?>]</strong> is MATCHED with following WTB CITIES:</h4>
             <table border="0" cellpadding="0" cellspacing="0"  class="table toggle-square myclitb" data-filter="#table_search" data-page-size="500">
               
                <thead>
                          
                    <tr>
                        <th data-hide="phone" width="2%" data-sort-ignore="true">Mapping Id.</th>
                        <th data-toggle="phone" data-sort-ignore="true" >Mapping Name</th> 
                        <th data-toggle="phone"  data-sort-ignore="true">WTB Country</th>    
                        <th data-toggle="phone"  data-sort-ignore="true">WTB Province</th> 
                        <th data-toggle="phone"  data-sort-ignore="true">WTB City</th>
			<th data-toggle="phone"  data-sort-ignore="true">City Id</th>
                        <th data-toggle="phone"  data-sort-ignore="true">City Code</th>
                        <th data-hide="phone"  data-sort-ignore="true">Local Status</th>                                                              
                        <th data-hide="phone" data-sort-ignore="true">Active?</th>
                        <th data-hide="phone" data-sort-ignore="true">WTB Status</th>
                        <th data-hide="phone" data-sort-ignore="true">Excluded?</th>                                                      
                        <th data-hide="phone" data-sort-ignore="true">Hotels</th>                         
                    </tr>
                </thead>
                <tbody>
                    <?php
                   if (isset($travelCities) && count($travelCities) > 0): 
							$i = 1;
                        foreach ($travelCities as $TravelCity):
                           
                            $id = $TravelCity['TravelCity']['id'];
                            $status = $TravelCity['TravelCity']['city_status'];
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
                            
                           $wtb_status = ($TravelCity['TravelCity']['wtb_status'] == '1') ? "OK" : "ERROR";
                            ?>
                            <tr>
                                <td class="tablebody"><?php echo $TravelCity['TravelCitySupplier']['id'] ;  ?></td>
                                <td><?php echo $TravelCity['TravelCitySupplier']['city_mapping_name']; ?></td>
                                <td><?php echo $TravelCity['TravelCountry']['country_name']; ?></td>
                                <td><?php echo $TravelCity['Province']['name']; ?></td>
                                <td><?php echo $TravelCity['TravelCity']['city_name'] ?></td> 
				<td><?php echo $TravelCity['TravelCity']['id'] ?></td>                                                      
                                <td><?php echo $TravelCity['TravelCity']['city_code']; ?></td>
                                <td><?php echo $status_txt; ?></td>
                                <td><?php echo $TravelCity['TravelCitySupplier']['active']; ?></td> 
                                <td><?php echo $wtb_status; ?></td>
                                <td><?php echo $TravelCity['TravelCitySupplier']['excluded']; ?></td>
                                <td>
                                      <a href="<?php echo $this->webroot .'reports/hotel_summary/city_id:'.$TravelCity['TravelCity']['id'].'/province_id:'.$TravelCity['TravelCity']['province_id'].'/country_id:'.$TravelCity['TravelCity']['country_id'].'/continent_id:'.$TravelCity['TravelCity']['continent_id'] ?>" target="_blank"><?php echo count($TravelCity['TravelHotelLookup']); ?></a> 
                                </td>                                
                                
                            </tr>
                        <?php $i++; endforeach; ?>
                            
                        <?php
                       
                    else:
                        echo '<tr><td colspan="9" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>  

                
</div>
<?php
/*
 * Get sates by country code
 */
$data = $this->Js->get('#SearchForm')->serializeForm(array('isForm' => true, 'inline' => true));

/*

$this->Js->get('#SupplierHotelContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/SupplierHotel/continent_id'
                ), array(
            'update' => '#SupplierHotelCountryId',
            'async' => true,
            'before' => 'loading("SupplierHotelCountryId")',
            'complete' => 'loaded("SupplierHotelCountryId")',
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
/*
$this->Js->get('#SupplierHotelCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_continent_country/SupplierHotel/continent_id/country_id'
                ), array(
            'update' => '#SupplierHotelProvinceId',
            'async' => true,
            'before' => 'loading("SupplierHotelProvinceId")',
            'complete' => 'loaded("SupplierHotelProvinceId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#SupplierHotelProvinceId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_all_travel_city_by_province/SupplierHotel/province_id'
                ), array(
            'update' => '#SupplierHotelCityId',
            'async' => true,
            'before' => 'loading("SupplierHotelCityId")',
            'complete' => 'loaded("SupplierHotelCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#SupplierHotelCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_all_travel_suburb_by_country_id_and_city_id/SupplierHotel/country_id/city_id'
                ), array(
            'update' => '#SupplierHotelSuburbId',
            'async' => true,
            'before' => 'loading("SupplierHotelSuburbId")',
            'complete' => 'loaded("SupplierHotelSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
$this->Js->get('#SupplierHotelSuburbId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_all_travel_area_by_suburb_id/SupplierHotel/suburb_id'
                ), array(
            'update' => '#SupplierHotelAreaId',
            'async' => true,
            'before' => 'loading("SupplierHotelAreaId")',
            'complete' => 'loaded("SupplierHotelAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#SupplierHotelChainId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_brand_by_chain_id/SupplierHotel/chain_id'
                ), array(
            'update' => '#SupplierHotelBrandId',
            'async' => true,
            'before' => 'loading("SupplierHotelBrandId")',
            'complete' => 'loaded("SupplierHotelBrandId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

*/


?>
<script>
    
    $('.mbox_select_all').click(function () {
					var $this = $(this);
					
					$('#resp_table').find('.msg_select').filter(':visible').each(function() {
						if($this.is(':checked')) {
							$(this).prop('checked',true).closest('tr').addClass('active')
						} else {
							$(this).prop('checked',false).closest('tr').removeClass('active')
						}
					})
					
				});
                                
    function ChkCheckbox(){
	
		if ($("input:checked").length == 0){
			bootbox.alert('No check box are selected.');
			return false;
			}
                else{        
                    
                       var numberOfChecked = $('input:checkbox:checked').length;
                       //alert("WARNING! You are about to delete "+ numberOfChecked +" hotels. Are you sure?");
                        var agree=confirm("WARNING! You are about to delete "+ numberOfChecked +" hotels. Are you sure?");
                         //bootbox.confirm("Are you sure?", function(result) {
                            if (agree)
                            return true ;
                        else
                            return false ;
					//bootbox.alert("Confirm result: "+result);
				//}); 
                                               
                }
		
		//return validation();
		
		
	}
    </script>