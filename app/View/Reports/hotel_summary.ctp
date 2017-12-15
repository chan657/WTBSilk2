<?php
$this->Html->addCrumb('My Hotels', 'javascript:void(0);', array('class' => 'breadcrumblast'));
App::import('Model', 'TravelActionItem');
$TravelActionItem = new TravelActionItem();
//pr($this->params['named']);
$url = '/';
if (!empty($this->request->params['named']['continent_id'])) {
            $url .= 'continent_id:'.$this->request->params['named']['continent_id'].'/';
        }
 if (!empty($this->request->params['named']['province_id'])) {
        $url .= 'province_id:'.$this->request->params['named']['province_id'].'/';
            //$province_id = $this->request->params['named']['province_id'];
        }
        
if (!empty($this->request->params['named']['country_id'])) {
        $url .= 'country_id:'.$this->request->params['named']['country_id'];
            //$country_id = $this->request->params['named']['country_id'];
        }   

?>    

<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Hotels</h4>
            
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
<?php

                echo $this->Form->create('Report', array('controller' => 'reports','action' => 'hotel_summary','class' => 'quick_search', 'id' => 'SearchForm','type'=>'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )
                   
                    )
                        
                        );

                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'TravelHotelLookup'));
                ?> 
            <div class="panel_controls hideform">

                
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('TravelHotelLookup.hotel_name', array('value' => $hotel_name, 'placeholder' => 'Hotel id, Hotel name, hotel code, country, city or area', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Hotel Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Continent:</label>
                        <?php echo $this->Form->input('TravelHotelLookup.continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'value' => $continent_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('TravelHotelLookup.country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'value' => $country_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Province:</label>
                        <?php echo $this->Form->input('TravelHotelLookup.province_id', array('options' => $Provinces, 'empty' => '--Select--', 'value' => $province_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('TravelHotelLookup.city_id', array('options' => $TravelCities, 'empty' => '--Select--', 'value' => $city_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Suburb:</label>
                        <?php echo $this->Form->input('TravelHotelLookup.suburb_id', array('options' => $TravelSuburbs, 'empty' => '--Select--', 'value' => $suburb_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Area:</label>
                        <?php echo $this->Form->input('TravelHotelLookup.area_id', array('options' => $TravelAreas, 'empty' => '--Select--', 'value' => $area_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Chain:</label>
                        <?php echo $this->Form->input('TravelHotelLookup.chain_id', array('options' => $TravelChains, 'empty' => '--Select--', 'value' => $chain_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Brand:</label>
                        <?php echo $this->Form->input('TravelHotelLookup.brand_id', array('options' => $TravelBrands, 'empty' => '--Select--', 'value' => $brand_id)); ?>
                    </div>                
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Status:</label>
                        <?php echo $this->Form->input('TravelHotelLookup.status', array('options' => array('1' => 'Submitted For Approval', '2' => 'Approved', '3' => 'Returned', '4' => 'Change Submitted', '5' => 'Rejected', '7' => 'Duplicated'), 'empty' => '--Select--', 'value' => $status)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">WTB Status:</label>
                        <?php echo $this->Form->input('TravelHotelLookup.wtb_status', array('options' => array('1' => 'OK', '2' => 'ERROR'), 'empty' => '--Select--', 'value' => $wtb_status)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Active?</label>
                        <?php echo $this->Form->input('TravelHotelLookup.active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--', 'value' => $active)); ?>
                    </div>


                    <div class="col-sm-3 col-xs-6">
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        // echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
               
            </div>
 <?php echo $this->Form->end(); ?>
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
            <?php  if($user_id == '169'){
                echo $this->Form->submit('Delete', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
            }
?></div>
    </div> 
            
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="2000">
               
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="6" class="nodis">Hotel Information</th>
                        <th data-group="group9" colspan="6">Hotel Location</th>
                        <th data-group="group10" colspan="4">Hotel Status</th>                  
                        
                        <th data-group="group8" class="nodis">Hotel Action</th>
                    </tr>
                   
                    <tr>
                        <th data-hide="phone" data-group="group1" width="2%" data-sort-ignore="true"><input type="checkbox" class="mbox_select_all" name="msg_sel_all"></th>
                        <th data-toggle="phone" data-sort-ignore="true" width="3%" data-group="group1"><?php echo $this->Paginator->sort('id', 'Id');
                echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-group="group8" data-hide="phone" data-sort-ignore="true" width="3%">Action</th>
                        <th data-hide="phone" data-group="group9" width="7%" data-sort-ignore="true"><?php echo $this->Paginator->sort('continent_name', 'Cont.');
                echo ($sort == 'continent_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-group="group9" width="8%" data-sort-ignore="true"><?php echo $this->Paginator->sort('country_name', 'Country');
                echo ($sort == 'country_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-group="group9" width="7%" data-sort-ignore="true"><?php echo $this->Paginator->sort('province_name', 'Prov.');
                echo ($sort == 'province_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-group="group9" width="8%" data-sort-ignore="true"><?php echo $this->Paginator->sort('city_name', 'City');
                echo ($sort == 'city_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-group="group9" width="7%" data-sort-ignore="true"><?php echo $this->Paginator->sort('suburb_name', 'Suburb');
                echo ($sort == 'suburb_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-group="group9" width="7%" data-sort-ignore="true"><?php echo $this->Paginator->sort('area_name', 'Area');
                echo ($sort == 'area_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" width="10%" data-group="group1"><?php echo $this->Paginator->sort('hotel_name', 'Hotel');
                echo ($sort == 'address') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" width="19%" data-group="group1"><?php echo $this->Paginator->sort('address', 'Hotel Address');                        
                echo ($sort == 'hotel_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-group="group1" width="3%" data-sort-ignore="true"><?php echo $this->Paginator->sort('hotel_code', 'Hotel Code');
                echo ($sort == 'hotel_code') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>                    
                        <th data-hide="phone" data-group="group1" width="7%" data-sort-ignore="true"><?php echo $this->Paginator->sort('brand_name', 'Brand');
                echo ($sort == 'brand_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-group="group1" width="7%" data-sort-ignore="true"><?php echo $this->Paginator->sort('chain_name', 'Chain');
                echo ($sort == 'chain_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                       
                        


                        <th data-hide="phone" data-group="group10" width="5%" data-sort-ignore="true">Local</th>
                        <th data-hide="phone" data-group="group10" width="2%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group10" width="5%" data-sort-ignore="true">Active?</th>
                        <th data-hide="phone" data-group="group10" width="5%" data-sort-ignore="true">No. Of Mapping</th>
                        <th data-hide="phone" data-group="group10" width="5%" data-sort-ignore="true">Pending Action</th>
                         

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
                                <td valign="middle" align="center">

                                    <?php  if($user_id == '169'){                                   
                                    echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'travel_hotel_lookups', 'action' => 'hotel_edit/' . $id,), array('class' => 'act-ico', 'escape' => false));
                                    echo $this->Html->link('<span class="icon-remove"></span>', array('controller' => 'travel_hotel_lookups', 'action' => 'delete', $id), array('class' => 'act-ico', 'escape' => false), "Are you sure you wish to delete this hotel?");
                                    }
                                    ?>
                                </td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['continent_name']; ?></td>                                 
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['country_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['province_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['city_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['suburb_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['area_name']; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_name']; ?></td>               
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['address']; ?></td>                                  
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_code']; ?></td>                                                               
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['brand_name']; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['chain_name']; ?></td>

                                
                                

                                <td class="sub-tablebody"><?php echo $status_txt; ?></td>
                                <td class="sub-tablebody"><?php echo $wtb_status; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['active']; ?></td>   
                                <td class="sub-tablebody"><?php if(count($TravelHotelLookup['TravelHotelRoomSupplier']) > 0) echo $this->Html->link(count($TravelHotelLookup['TravelHotelRoomSupplier']), array('controller' => 'travel_hotel_lookups', 'action' => 'view_mapping/' . $id), array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)); else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0'; ?></td>
                                <td class="sub-tablebody"><?php if(count($TravelHotelLookup['HotelPending']) > 0 || $mappingcount > 0) echo $this->Html->link(count($TravelHotelLookup['HotelPending']) + $mappingcount, array('controller' => 'reports', 'action' => 'view_action/' . $id.'/'.$TravelHotelLookup['TravelHotelRoomSupplier'][0]['id']), array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)); else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0'; ?></td>

                                

                            </tr>
                        <?php endforeach; ?>

                        <?php
                        
                    else:
                        echo '<tr><td colspan="43" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>           
            <?php echo $this->Form->end(); 
            echo $this->element('paginate');
            ?>
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