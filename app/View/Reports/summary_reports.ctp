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
                            <label for="reg_input_name">Select Status (SilkRouters)</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php                              
                                echo $this->Form->input('city_status', array('options' => array('1' => 'OK','2' => 'ERROR'),'empty' => '--Select--','selected' => $city_status));
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
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <label for="reg_input_name">Select Status (WTB)</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php                              
                                echo $this->Form->input('wtb_status', array('options' => array('1' => 'OK','2' => 'ERROR'),'empty' => '--Select--','selected' => $wtb_status));
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
            <?php //echo $this->Form->submit('Delete', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php

?></div>
    </div> 
                     <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="2000">

                <thead>
                     <tr class="footable-group-row">
                        <th data-group="group1" colspan="7" class="nodis">Information</th>                        
                        <th data-group="group2" colspan="3">Status</th> 
                        <th data-group="group3" colspan="9">Counts</th>
                        
                    </tr>       
                    <tr>
                        <!--<th data-hide="phone" data-sort-ignore="true" data-group="group1"><input type="checkbox" class="mbox_select_all" name="msg_sel_all"></th>-->
                        <th data-hide="phone" data-group="group1">Id</th>
                        
                        <th data-hide="phone" data-group="group1">Continent</th>
                        <th data-hide="phone" data-group="group1">Code</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Active</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">WTB Status</th>
                        <th data-hide="phone" width="7%" data-group="group3">Country</th>
                        <th data-hide="phone" width="7%" data-group="group3">Country Mapping</th>
                        <th data-hide="phone" width="7%" data-group="group3">Hotel</th> 
                        <th data-hide="phone" width="7%" data-group="group3">Hotel Mapping</th> 
                        <th data-hide="phone" width="7%" data-group="group3">Province</th>
                        <th data-hide="phone" width="7%" data-group="group3">City</th>
                        <th data-hide="phone" width="7%" data-group="group3">City Mapping</th>
                                             
                        <th data-hide="phone" width="7%" data-group="group3">Suburb </th>
                        <th data-hide="phone" width="7%" data-group="group3">Area</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                   // pr($TravelLookupContinents);
                    $i = 1;
                    $sum = 0;
                    $sum1 = 0;
                    $sum2 = 0;
                    $sum3 = 0;
                    $sum4 = 0;
                    $sum5 = 0;
                    $sum6 = 0;
                    $sum7 = 0;
                    $sum8 = 0;
                    if (isset($TravelLookupContinents) && count($TravelLookupContinents) > 0):
                        foreach ($TravelLookupContinents as $value):                       
                         $Status = ($value['TravelLookupContinent']['continent_status'] == '1') ? 'OK' : 'ERROR';
                         $WTBStatus = ($value['TravelLookupContinent']['wtb_status'] == '1') ? 'OK' : 'ERROR';
                         $continent_id = $value['TravelLookupContinent']['id'];
                            ?>
                            <tr>
                                <!--<td class="tablebody"><?php											
                                echo $this->Form->checkbox('check', array('name' => 'data[TravelLookupContinent][check][]','class' => 'msg_select','readonly' => true,'hiddenField' => false,'value' => $value['TravelLookupContinent']['id']));
                                ?></td>-->
                                <td><?php echo $continent_id;?></td> 
                              
                                <td><?php echo $value['TravelLookupContinent']['continent_name']; ?></td>
                                <td><?php echo $value['TravelLookupContinent']['continent_code']; ?></td>
                                
                                <td><?php echo $Status; ?></td>
                                <td><?php echo $value['TravelLookupContinent']['active']; ?></td>
                                <td><?php echo $WTBStatus; ?></td>
                                <td><?php $sum5 = $sum5 + count($value['TravelCountry']);  

echo $this->Html->link(count($value['TravelCountry']), array('controller' => 'reports', 'action' => 'country_list/continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($value['TravelCitySuppliers']); ?></td>
                                <td><?php $sum6 = $sum6 + count($value['TravelCountrySupplier']);  

echo $this->Html->link(count($value['TravelCountrySupplier']), array('controller' => 'reports', 'action' => 'country_mapping_list/country_continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($value['TravelCitySuppliers']); ?></td>
                                <td><?php $sum = $sum + count($value['TravelHotelLookup']);  
                                 echo $this->Html->link(count($value['TravelHotelLookup']), array('controller' => 'reports', 'action' => 'hotel_summary/continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                
                                //echo count($value['TravelHotelLookup']); ?></td> 
                                <td><?php $sum1 = $sum1 + count($value['TravelHotelRoomSupplier']);  

                                echo $this->Html->link(count($value['TravelHotelRoomSupplier']), array('controller' => 'reports', 'action' => 'hotel_mapping_list/hotel_continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($value['TravelHotelRoomSupplier']); ?></td>
                                <td><?php $sum8 = $sum8 + count($value['Province']);  

                                echo $this->Html->link(count($value['Province']), array('controller' => 'reports', 'action' => 'province_list/continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($value['TravelHotelRoomSupplier']); ?></td>
                                <td><?php $sum7 = $sum7 + count($value['TravelCity']);  

echo $this->Html->link(count($value['TravelCity']), array('controller' => 'reports', 'action' => 'city_reports/continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($value['TravelCitySuppliers']); ?></td>
                                <td><?php $sum2 = $sum2 + count($value['TravelCitySupplier']);  

echo $this->Html->link(count($value['TravelCitySupplier']), array('controller' => 'reports', 'action' => 'city_mapping_list/city_continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($value['TravelCitySuppliers']); ?></td>
                                 
                                 
                                <td><?php $sum3 = $sum3 + count($value['TravelSuburb']);  
echo $this->Html->link(count($value['TravelSuburb']), array('controller' => 'reports', 'action' => 'suburb_list/continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($value['TravelSuburb']); ?></td> 
                                <td><?php $sum4 = $sum4 + count($value['TravelArea']);  //echo count($value['TravelArea']);
echo $this->Html->link(count($value['TravelArea']), array('controller' => 'reports', 'action' => 'area_list/continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
 ?></td> 
                               
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
                                <td  width="37%">Total</td>
                                <td width="7%"><?php echo $sum5?></td>
                                <td width="7%"><?php echo $sum6?></td>
                                
                                <td width="7%"><?php echo $sum?></td>
                                <td width="7%"><?php echo $sum1?></td>
                               
                                <td width="7%"><?php echo $sum8?></td>
                                 <td width="7%"><?php echo $sum7?></td>
                                <td width="7%"><?php echo $sum2?></td>
                                 
                                
                                
                                <td width="7%"><?php echo $sum3?></td>
                                <td  width="7%"><?php echo $sum4;?></td>
                                
                            </tr>
<tr>
                                <td  width="37%">Blank Continent</td>
                                <td width="7%"><?php 
								
								echo ($country_count) ? $this->Html->link($country_count, array('controller' => 'reports', 'action' => ''), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								
								//echo $city_mapping_count?></td>
                                <td width="7%"><?php 
								
								echo ($country_mapping_count) ? $this->Html->link($country_mapping_count, array('controller' => 'reports', 'action' => ''), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								
								//echo $city_mapping_count?></td>
                                
                                <td width="7%"><?php 
								
								echo ($hotel_count) ? $this->Html->link($hotel_count, array('controller' => 'reports', 'action' => 'hotel_summary/continent_id:0'), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								//echo $hotel_count?></td> 
                                <td width="7%"><?php echo ($hotel_mapping_count) ? 
								$this->Html->link($hotel_mapping_count, array('controller' => 'reports', 'action' => 'hotel_mapping_list/hotel_continent_id:0'), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								
								?></td> 
                                
                                <td width="7%"><?php 
								
								echo ($province_count) ? $this->Html->link($province_count, array('controller' => 'reports', 'action' => 'province_list/continent_id:0'), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								
								//echo $city_mapping_count?></td>
                                <td width="7%"><?php 
								
								echo ($city_count) ? $this->Html->link($city_count, array('controller' => 'reports', 'action' => 'city_reports/continent_id:0'), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								
								//echo $city_mapping_count?></td>
                                <td width="7%"><?php 
								
								echo ($city_mapping_count) ? $this->Html->link($city_mapping_count, array('controller' => 'reports', 'action' => 'city_mapping_list/city_continent_id:0'), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								
								//echo $city_mapping_count?></td>
                                                               
                                <td width="7%"><?php echo ($suburb_count) ? 
								$this->Html->link($suburb_count, array('controller' => 'reports', 'action' => 'suburb_list/continent_id:0'), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								
								
								?></td>
                                <td  width="7%"><?php echo ($area_count) ?
									$this->Html->link($area_count, array('controller' => 'reports', 'action' => 'area_list/continent_id:0'), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')) : '0';
								
								?></td>
                               
                            </tr>
                            <tr>
                                <td  width="37%">All Counts</td>
                                <td width="7%"><?php echo $sum5 + $country_count;?></td>
                                <td width="7%"><?php echo $sum6 + $country_mapping_count;?></td>
                                <td width="7%"><?php echo $sum + $hotel_count;?></td> 
                                <td width="7%"><?php echo $sum1 + $hotel_mapping_count;?></td> 
                                <td width="7%"><?php echo $sum8 + $province_count;?></td>
                                <td width="7%"><?php echo $sum7 + $city_count;?></td>
                                <td width="7%"><?php echo $sum2 + $city_mapping_count;?></td>
                                                               
                                <td width="7%"><?php echo $sum3 + $suburb_count;?></td>
                                <td  width="7%"><?php echo $sum4 + $area_count;?></td>
                               
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