<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Reports</h4>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-12">
                    <?php
$this->Html->addCrumb('Reports', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('Report', array('method' => 'post',
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



?>
                    <div class="col-sm-6">
                        
                       <div class="form-group">
                            <label for="reg_input_name" class="req">Select Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php
                                // 'TravelHotelLookup' => 'Hotel', 'TravelCountry' => 'Country', 'TravelCity' => 'City', 'TravelCountrySupplier' => 'Mapping Country', 'TravelCitySupplier' => 'Mapping City', 'TravelHotelRoomSupplier' => 'Mapping Hotel'
                                echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'data-required' => 'true','selected' => $country_id));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Select Status (SilkRouters)</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php                              
                                echo $this->Form->input('city_status', array('options' => array('1' => 'OK','2' => 'ERROR'),'empty' => '--Select--','selected' => $city_status));
                                ?></div>
                        </div>
                        
               
                    </div>
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <label for="reg_input_name">Select Status (WTB)</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php                              
                                echo $this->Form->input('wtb_status', array('options' => array('1' => 'OK','2' => 'ERROR'),'empty' => '--Select--','selected' => $wtb_status));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Active?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php                              
                                echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE' , 'FALSE' => 'FALSE'),'empty' => '--Select--','selected' => $active));
                                ?></div>
                        </div>
                    </div>
                    <div class="clear" style="clear: both;"></div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-1">
                                    <?php
                                    echo $this->Form->submit('Go', array('class' => 'btn btn-success sticky_success'));
                                    ?>
                                </div>
                            </div>
                        </div> 
                
                    <div style="clear:both; margin-top: 15px;"></div>
                    <?php
echo $this->Form->end();

                echo $this->Form->create('Report', array('controller' => 'reports','action' => 'city_delete','onsubmit' => 'return ChkCheckbox()','class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )
                   
                    )
                        
                        );
              ?>
                    <div class="row" style="padding: 10px;">
        <div class="col-sm-12">
                    <?php if ($this->Session->read('role_id') == '64') {
                echo $this->Form->submit('Delete', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
            }
?></div>
    </div> 
                     <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="2000">

                <thead>
                     <tr class="footable-group-row">
                        <th data-group="group1" colspan="7" class="nodis">Information</th>                        
                        <th data-group="group2" colspan="3">Status</th> 
                        <th data-group="group3" colspan="5">Counts</th>
                        <th data-group="group4" class="nodis">Action</th>
                    </tr>       
                    <tr>
                        <th data-hide="phone" data-sort-ignore="true" width="2%" data-group="group1"><input type="checkbox" class="mbox_select_all" name="msg_sel_all"></th>
                        <th data-hide="phone" data-group="group1" width="3%">Id</th>
                        
                        <th data-hide="phone" data-group="group1" width="5%" >Country</th>
                        
                        <th data-hide="phone" data-group="group1" width="7%" >City</th>
                        <th data-hide="phone" data-group="group1" width="4%" >City Code</th>
                        <th data-hide="phone" data-sort-ignore="true" width="4%" data-group="group2">Status</th>
                        <th data-hide="phone" data-sort-ignore="true" width="4%" data-group="group2">Active</th>
                        <th data-hide="phone" data-sort-ignore="true" width="4%" data-group="group2">WTB Status</th>
                        <th data-hide="phone" width="7%" data-group="group3" width="4%">City Mapping</th>
                        <th data-hide="phone" width="7%" data-group="group3" width="3%">Hotel</th> 
                        
                        <th data-hide="phone" width="7%" data-group="group3" width="3%">Hotel Mapping</th>                      
                        <th data-hide="phone" width="7%" data-group="group3" width="3%">Suburb Count</th>
                        <th data-hide="phone" width="7%" data-group="group3" width="3%">Area Count</th>
                        <th data-hide="phone" data-sort-ignore="true" width="20%" data-group="group4">Action</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //pr($TravelCities);
//die;
                    $i = 1;
                    $sum = 0;
                    $sum1 = 0;
                    $sum2 = 0;
                    $sum3 = 0;
                    $sum4 = 0;
                    $sum5 = 0;
                    $useless = 888888;
                            
                    $blankcity_id = 0;
                    if (isset($TravelCities) && count($TravelCities) > 0):
                        foreach ($TravelCities as $value):                       
                         $CityStatus = $value['TravelCity']['city_status'] ? 'OK' : 'ERROR';
                         $WTBStatus = $value['TravelCity']['wtb_status'] ? 'OK' : 'ERROR';
                            ?>
                            <tr>
                                <td class="tablebody"><?php											
                                echo $this->Form->checkbox('check', array('name' => 'data[TravelCity][check][]','class' => 'msg_select','readonly' => true,'hiddenField' => false,'value' => $value['TravelCity']['id']));
                                ?></td>
                                <td><?php echo $value['TravelCity']['id'];?></td> 
                              
                                <td><?php echo $value['TravelCity']['country_name']; ?></td>
                            
                                <td><?php echo $value['TravelCity']['city_name']; ?></td>
                                
                                <td><?php echo $value['TravelCity']['city_code']; ?></td>
                                <td><?php echo $CityStatus; ?></td>
                                <td><?php echo $value['TravelCity']['active']; ?></td>
                                <td><?php echo $WTBStatus; ?></td>
                                <td><?php $sum2 = $sum2 + count($value['TravelCitySuppliers']);  

echo $this->Html->link(count($value['TravelCitySuppliers']), array('controller' => 'reports', 'action' => 'city_mapping_list/city_id:'.$value['TravelCity']['id'].'/province_id:'.$value['TravelCity']['province_id'].'/city_country_id:'.$value['TravelCity']['country_id'].'/city_continent_id:'.$value['TravelCity']['continent_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($value['TravelCitySuppliers']); ?></td>
                                <td><?php $sum = $sum + count($value['TravelHotelLookup']);  
                                 echo $this->Html->link(count($value['TravelHotelLookup']), array('controller' => 'reports', 'action' => 'hotel_summary/city_id:'.$value['TravelCity']['id'].'/province_id:'.$value['TravelCity']['province_id'].'/country_id:'.$value['TravelCity']['country_id'].'/continent_id:'.$value['TravelCity']['continent_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                
                                //echo count($value['TravelHotelLookup']); ?></td> 
                               
                                <td><?php $sum1 = $sum1 + count($value['TravelHotelRoomSupplier']);  

                                echo $this->Html->link(count($value['TravelHotelRoomSupplier']), array('controller' => 'reports', 'action' => 'hotel_mapping_list/hotel_city_id:'.$value['TravelCity']['id'].'/province_id:'.$value['TravelCity']['province_id'].'/hotel_country_id:'.$value['TravelCity']['country_id'].'/hotel_continent_id:'.$value['TravelCity']['continent_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($value['TravelHotelRoomSupplier']); ?></td> 
                                 
                                <td><?php $sum3 = $sum3 + count($value['TravelSuburb']);  
echo $this->Html->link(count($value['TravelSuburb']), array('controller' => 'reports', 'action' => 'suburb_list/city_id:'.$value['TravelCity']['id'].'/province_id:'.$value['TravelCity']['province_id'].'/country_id:'.$value['TravelCity']['country_id'].'/continent_id:'.$value['TravelCity']['continent_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($value['TravelSuburb']); ?></td> 
                                <td><?php $sum4 = $sum4 + count($value['TravelArea']);  //echo count($value['TravelArea']);
echo $this->Html->link(count($value['TravelArea']), array('controller' => 'reports', 'action' => 'area_list/city_id:'.$value['TravelCity']['id'].'/province_id:'.$value['TravelCity']['province_id'].'/country_id:'.$value['TravelCity']['country_id'].'/continent_id:'.$value['TravelCity']['continent_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
 ?></td> 
                                <td>
                    <?php if ($this->Session->read('role_id') == '64') {
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'reports', 'action' => 'city_edit/' . $value['TravelCity']['id']), array('class' => 'act-ico', 'escape' => false));
                                        echo $this->Html->link('<span class="icon-remove"></span>', array('controller' => 'reports', 'action' => 'delete', $value['TravelCity']['id']), array('class' => 'act-ico', 'escape' => false), "Are you sure you wish to delete this city?");
                                        echo $this->Html->link('Hotel Count','/reports/mismatch_hotel_count/'.$value['TravelCity']['country_id'].'/'.$value['TravelCity']['id'], array('class' => 'act-ico open-popup-link add-btn','escape' => false,'data-placement' => "left", 'title' => "Hotel Count",'data-toggle' => "tooltip"));
                                        echo $this->Html->link('Mass Update', '/mass_operations/hotel/city_id:'.$value['TravelCity']['id'].'/country_id:'.$value['TravelCity']['country_id'].'/province_id:'.$useless.'/suburb_id:'.$useless.'/area_id:'.$useless,array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                    } else {
                                        echo $this->Html->link('Mismatched Hotel Count','/reports/mismatch_hotel_count/'.$value['TravelCity']['country_id'].'/'.$value['TravelCity']['id'], array('class' => 'act-ico open-popup-link add-btn','escape' => false,'data-placement' => "left", 'title' => "Hotel Count",'data-toggle' => "tooltip"));
                                    }
?>
                                    
                                </td>
                            </tr>
                        <?php 
                        $i++;
                        endforeach;
endif; ?>
                            </tbody>
            </table>

<table class="table toggle-square" style="margin-top:-16px !important">
<tbody>
<tr>
                                <td  width="39%">Total</td>
                                <td width="7%"><?php echo $sum2?></td>
                                <td width="6%"><?php echo $sum?></td> 
                                <td width="6%"><?php echo $sum1?></td>
                                
                                <td width="6%"><?php echo $sum3?></td>
                                <td  width="6%"><?php echo $sum4;?></td>
                                <td  width="25%">&nbsp;</td>
                            </tr>
<tr>
                                <td  width="39%">Blank City</td>
                                
                                <td width="7%"><?php 
								
								echo ($city_mapping_count) ? $this->Html->link($city_mapping_count, array('controller' => 'reports', 'action' => 'city_mapping_list/city_id:0/city_country_id:'.$country_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								
								//echo $city_mapping_count?></td>
                                <td width="6%"><?php 
								
								echo ($hotel_count) ? $this->Html->link($hotel_count, array('controller' => 'reports', 'action' => 'hotel_summary/city_id:0/country_id:'.$country_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								//echo $hotel_count?></td> 
                                <td width="6%"><?php echo ($hotel_mapping_count) ? 
								$this->Html->link($hotel_mapping_count, array('controller' => 'reports', 'action' => 'hotel_mapping_list/hotel_city_id:0/hotel_country_id:'.$country_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								
								?></td>                                
                                <td width="6%"><?php echo ($suburb_count) ? 
								$this->Html->link($suburb_count, array('controller' => 'reports', 'action' => 'suburb_list/city_id:0/country_id:'.$country_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								
								
								?></td>
                                <td  width="6%"><?php echo ($area_count) ?
									$this->Html->link($area_count, array('controller' => 'reports', 'action' => 'area_list/city_id:0/country_id:'.$country_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								
								?></td>
                                <td>
                    <?php if ($this->Session->read('role_id') == '64') {
                                    
                                   echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'reports', 'action' => 'city_edit/' . $blankcity_id), array('class' => 'act-ico', 'escape' => false));
                                   echo $this->Html->link('<span class="icon-remove"></span>', array('controller' => 'reports', 'action' => 'delete', $blankcity_id), array('class' => 'act-ico', 'escape' => false), "Are you sure you wish to delete this city?");
                                   echo $this->Html->link('Hotel Count','/reports/mismatch_hotel_count/'.$country_id.'/'.$blankcity_id, array('class' => 'act-ico open-popup-link add-btn','escape' => false,'data-placement' => "left", 'title' => "Hotel Count",'data-toggle' => "tooltip"));
                                   echo $this->Html->link('Mass Update', '/mass_operations/hotel/city_id:'.$blankcity_id.'/country_id:'.$country_id.'/province_id:'.$useless.'/suburb_id:'.$useless.'/area_id:'.$useless,array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
}
?>
                                    
                                </td>
                            </tr>
<?php
if (isset($miss_match) && count($miss_match) > 0):
                        foreach ($miss_match as $value): 
                            $sum5 = $sum5 + $value[0]['cnt'];

endforeach; 
endif;
?>
                            <tr>
                                <td  width="39%">Mismatch Counts</td>
                                
                                <td width="7%">&nbsp;</td>
                                <td width="6%"><?php 
                                    echo $this->Html->link($sum5, array('controller' => 'reports', 'action' => 'mismatch_hotel'), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
?></td> 
                                <td width="6%">&nbsp;</td>                                
                                <td width="6%">&nbsp;</td>
                                <td  width="6%">&nbsp;</td>
                                <td  width="25%">&nbsp;</td>
                            </tr>
                            <tr>
                                <td  width="39%">All Counts</td>
                                
                                <td width="7%"><?php echo $sum2 + $city_mapping_count;?></td>
                                <td width="6%"><?php echo $sum + $sum5 + $hotel_count;?></td> 
                                <td width="6%"><?php echo $sum1 + $hotel_mapping_count;?></td>                                
                                <td width="6%"><?php echo $sum3 + $suburb_count;?></td>
                                <td  width="6%"><?php echo $sum4 + $area_count;?></td>
                                <td  width="25%">&nbsp;</td>
                            </tr>

</tbody>
            </table>
                           
                                        <?php
echo $this->Form->end();

?>
                </div>
                              
            
            </div>
        </div>
    </div>
</div>
<?php
$data = $this->Js->get('#parsley_reg')->serializeForm(array('isForm' => true, 'inline' => true));
$this->Js->get('#ReportContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/Report/continent_id'
                ), array(
            'update' => '#ReportCountryId',
            'async' => true,
            'before' => 'loading("ReportCountryId")',
            'complete' => 'loaded("ReportCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#ReportCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_continent_country/Report/continent_id/country_id'
                ), array(
            'update' => '#ReportProvinceId',
            'async' => true,
            'before' => 'loading("ReportProvinceId")',
            'complete' => 'loaded("ReportProvinceId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
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
                        var agree=confirm("WARNING! You are about to delete "+ numberOfChecked +" cities. Are you sure?");
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