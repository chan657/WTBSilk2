<?php
$this->Html->addCrumb('My Hotels', 'javascript:void(0);', array('class' => 'breadcrumblast'));
App::import('Model', 'TravelActionItem');
$TravelActionItem = new TravelActionItem();
//pr($this->params['named']);
if(isset($this->request->params['named']['id']))
    $hotel_id = $this->request->params['named']['id'];
else
    $hotel_id = $id;
$screen = '8';        
?>    

<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Hotels</h4>
           
        </div>
        <div class="panel panel-default">

           <?php
                echo $this->Form->create('Report', array('controller' => 'reports','action' => 'hotel_delete','onsubmit' => 'return ChkCheckbox()','class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )
                   
                    )
                        
                        );
              ?>
            <div class="row" style="padding: 15px;">
        <div class="col-sm-12">
            <?php if($user_id == '169'){ 
            echo $this->Form->submit('Delete', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit'));
            echo $this->Html->link('Duplicate Hotel','/reports/support_hotel_summary/'.$hotel_id, array('class' => 'success btn', 'escape' => false,'style' => 'width:11%'));
            }
            ?>
        </div>
        <div class="table-heading">
             
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Open New Ticket', '/support_tickets/add/'.$screen.'/'.$hotel_id,array('class' => 'act-ico open-popup-link add-btn','escape' => false,'data-placement' => "left", 'title' => "Create New Ticket",'data-toggle' => "tooltip")) ?></span>
          
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
                        <th data-hide="phone" data-group="group9" width="10%" data-sort-ignore="true">Continent</th>
                        <th data-hide="phone" data-group="group9" width="10%" data-sort-ignore="true">Country</th>
                        <th data-hide="phone" data-group="group9" width="10%" data-sort-ignore="true">Province</th>
                        <th data-hide="phone" data-group="group9" width="8%" data-sort-ignore="true">City</th>
                        <th data-hide="phone" data-group="group9" width="8%" data-sort-ignore="true">Suburb</th>
                        <th data-hide="phone" data-group="group9" width="5%" data-sort-ignore="true">Area</th>
                        <th data-toggle="phone" data-sort-ignore="true" width="10%" data-group="group1">Hotel</th>
                        <th data-toggle="phone" data-group="group1" width="3%" data-sort-ignore="true">Hotel Code</th>                    
                        <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">Brand</th>
                        <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">Chain</th>

                        <th data-hide="phone" data-group="group10" width="5%" data-sort-ignore="true">Silkrouters</th>
                        <th data-hide="phone" data-group="group10" width="2%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group10" width="5%" data-sort-ignore="true">Active?</th>
                        <th data-hide="phone" data-group="group10" width="5%" data-sort-ignore="true">No. Of Mapping</th>
                        <th data-hide="phone" data-group="group10" width="5%" data-sort-ignore="true">Pending Action</th>
                        <th data-group="group8" data-hide="phone" data-sort-ignore="true" width="7%">Action</th> 

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
	//pr($TravelHotelLookups);
        //die;
                    $secondary_city = '';

                    if (isset($TravelHotelLookups) && count($TravelHotelLookups) > 0):
                        foreach ($TravelHotelLookups as $TravelHotelLookup):
                        
                            $mappingcount = $TravelActionItem->HotelMappingPending($TravelHotelLookup['TravelHotelRoomSupplier'][0]['id']);
                            $id = $TravelHotelLookup['TravelHotelLookup']['id'];

                            $status = $TravelHotelLookup['TravelHotelLookup']['status'];
                            if ($status == '1')
                                $status_txt = 'Submitted For Approval';
                            elseif ($status == '2')
                                $status_txt = 'Approved';
                            elseif ($status == '3')
                                $status_txt = 'Returned';
                            elseif ($status == '4')
                                $status_txt = 'Change Submitted';
                            elseif ($status == '5')
                                $status_txt = 'Rejected';
                            elseif ($status == '7')
                                $status_txt = 'Duplicated';
                            else
                                $status_txt = 'Allocation';

                            if ($TravelHotelLookup['TravelHotelLookup']['wtb_status'] == '1')
                                $wtb_status = 'OK';
                            else
                                $wtb_status = 'ERROR';
                            ?>
                            <tr>
                                <td class="tablebody"><?php											
                                echo $this->Form->checkbox('check', array('name' => 'data[TravelHotelLookup][check][]','class' => 'msg_select','readonly' => true,'hiddenField' => false,'value' => $id));
                                ?></td>
                                <td class="tablebody"><?php echo $id; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['continent_name']; ?></td>                                 
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['country_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['province_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['city_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['suburb_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['area_name']; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_name']; ?></td>               
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_code']; ?></td>                                                               
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['brand_name']; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['chain_name']; ?></td>

                                <td class="sub-tablebody"><?php echo $status_txt; ?></td>
                                <td class="sub-tablebody"><?php echo $wtb_status; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['active']; ?></td>   
                                <td class="sub-tablebody"><?php if(count($TravelHotelLookup['TravelHotelRoomSupplier']) > 0) echo $this->Html->link(count($TravelHotelLookup['TravelHotelRoomSupplier']), array('controller' => 'travel_hotel_lookups', 'action' => 'view_mapping/' . $id), array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)); else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0'; ?></td>
                                <td class="sub-tablebody"><?php if(count($TravelHotelLookup['HotelPending']) > 0 || $mappingcount > 0) echo $this->Html->link(count($TravelHotelLookup['HotelPending']) + $mappingcount, array('controller' => 'reports', 'action' => 'view_action/' . $id.'/'.$TravelHotelLookup['TravelHotelRoomSupplier'][0]['id']), array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)); else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0'; ?></td>

                                <td valign="middle" align="center">

                                    <?php if($user_id == '169'){                                    
                                    echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'travel_hotel_lookups', 'action' => 'hotel_edit/' . $id,), array('class' => 'act-ico', 'escape' => false));
                                    echo $this->Html->link('<span class="icon-remove"></span>', array('controller' => 'travel_hotel_lookups', 'action' => 'delete', $id), array('class' => 'act-ico', 'escape' => false), "Are you sure you wish to delete this hotel?");
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
    foreach ($DuplicateData as $TravelHotelLookup):
        $id = $TravelHotelLookup['TravelHotelLookup']['id'];
        
        if($id)
            $tr_style = 'style="background-color:#5DD0ED"';
        else
            $tr_style = 'style="background-color:#FFFFFF"';
        ?>
                            <tr>
                                <td class="tablebody"><?php echo $id; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['continent_name']; ?></td> 
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['country_name']; ?></td>                                                                                            
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['country_code']; ?></td>                                                                                            
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['city_name']; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['city_code']; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_name']; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_code']; ?></td>
                                <td class="tablebody"><?php echo count($TravelHotelLookup['TravelHotelRoomSupplier']); ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['suburb_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['area_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['chain_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['brand_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['address']; ?></td>
                                
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


<?php
/*
 * Get sates by country code
 */
$data = $this->Js->get('#SearchForm')->serializeForm(array('isForm' => true, 'inline' => true));

/*

$this->Js->get('#TravelHotelLookupContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/TravelHotelLookup/continent_id'
                ), array(
            'update' => '#TravelHotelLookupCountryId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupCountryId")',
            'complete' => 'loaded("TravelHotelLookupCountryId")',
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

$this->Js->get('#TravelHotelLookupProvinceId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_all_travel_city_by_province/TravelHotelLookup/province_id'
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
            'action' => 'get_all_travel_suburb_by_country_id_and_city_id/TravelHotelLookup/country_id/city_id'
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
            'action' => 'get_all_travel_area_by_suburb_id/TravelHotelLookup/suburb_id'
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