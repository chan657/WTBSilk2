<?php
$this->Html->addCrumb('My Countries', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>    

<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    //echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span>My Countries</h4>
            
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        
        <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('Report', array('controller' => 'reports','action' => 'country_list','class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )
                   
                    )
                        
                        );
                ?> 

                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('TravelCountry.country_name', array('value' => $area_name, 'placeholder' => 'Type area name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Country Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
               <div class="row" id="search_panel_controls">
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Continent:</label>
                        <?php echo $this->Form->input('TravelCountry.continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'value' => $continent_id)); ?>
                    </div>
                   
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Status:</label>
                        <?php echo $this->Form->input('TravelCountry.country_status', array('options' => array('1' => 'Active', '2' => 'Inactive'), 'empty' => '--Select--', 'value' => $country_status)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">WTB Status:</label>
                        <?php echo $this->Form->input('TravelCountry.wtb_status', array('options' => array('1' => 'Active', '2' => 'De-active'), 'empty' => '--Select--', 'value' => $wtb_status)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Active:</label>
                        <?php echo $this->Form->input('TravelCountry.active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--', 'value' => $active)); ?>
                    </div>
                    
                    <div class="col-sm-3 col-xs-6">
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
      

           <?php
                echo $this->Form->create('Report', array('controller' => 'reports','action' => 'country_delete','onsubmit' => 'return ChkCheckbox()','class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
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
            
           <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="2000">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="3" class="nodis">Information</th>
                        <th data-group="group2" colspan="3">Status</th>
                        <th data-group="group3" colspan="8">Counts</th>
                        
                    </tr>
                    <tr>
                        <th data-hide="phone" width="2%" data-sort-ignore="true" data-group="group1"><input type="checkbox" class="mbox_select_all" name="msg_sel_all"></th>
                        <th data-hide="phone" data-group="group1">Id</th>
                        <th data-hide="phone" data-group="group1">Continent</th>
                        <th data-hide="phone" data-group="group1">Country</th>                        
                        
                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">WTB Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Active</th>
                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Country Mapping</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Hotel</th> 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Hotel Mapping</th>
                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Province</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">City</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">City Mapping</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Suburb</th> 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Area</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                   //pr($TravelCountries);
                    //die;
                    $i = 1;
                   $sum = 0;
                    $sum1 = 0;
                    $sum2 = 0;
                    $sum3 = 0;
                    $sum4 = 0;
                   
                    $sum6 = 0;
                    $sum7 = 0;
                    $sum8 = 0;
                    if (isset($TravelCountries) && count($TravelCountries) > 0):
                        foreach ($TravelCountries as $TravelCountry):
                            $id = $TravelCountry['TravelCountry']['id'];
                            if ($TravelCountry['TravelCountry']['country_status'] == '1') {
                                $status = 'OK';
                                $tb_class = 'active';
                            } else {
                                $status = 'ERROR';
                                $tb_class = 'inactive';
                            }

                            if ($TravelCountry['TravelCountry']['wtb_status'] == '1') {
                                $wtb_status = 'OK';
                                $wtb_class = 'active';
                            } else {
                                $wtb_status = 'ERROR';
                                $wtb_class = 'inactive';
                            }
                            ?>
                            <tr>
                                <td class="tablebody"><?php											
                                echo $this->Form->checkbox('check', array('name' => 'data[TravelCountry][check][]','class' => 'msg_select','readonly' => true,'hiddenField' => false,'value' => $id));
                                ?></td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $TravelCountry['TravelCountry']['continent_name']; ?></td>
                                <td><?php echo $TravelCountry['TravelCountry']['country_name']; ?></td>
                                
                                
                                <td class="<?php echo $tb_class; ?>"><?php echo $status; ?></td>
                                <td class="<?php echo $wtb_class; ?>"><?php echo $wtb_status; ?></td>
                                <td><?php echo $TravelCountry['TravelCountry']['active']; ?></td>
                                <td width="7%"><?php $sum6 = $sum6 + count($TravelCountry['TravelCountrySupplier']);  

echo $this->Html->link(count($TravelCountry['TravelCountrySupplier']), array('controller' => 'reports', 'action' => ''), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($TravelCountry['TravelCitySuppliers']); ?></td>
                                <td width="7%"><?php $sum = $sum + count($TravelCountry['TravelHotelLookup']);  
                                 echo $this->Html->link(count($TravelCountry['TravelHotelLookup']), array('controller' => 'reports', 'action' => 'hotel_summary/continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                
                                //echo count($TravelCountry['TravelHotelLookup']); ?></td> 
                                <td width="7%"><?php $sum1 = $sum1 + count($TravelCountry['TravelHotelRoomSupplier']);  

                                echo $this->Html->link(count($TravelCountry['TravelHotelRoomSupplier']), array('controller' => 'reports', 'action' => 'hotel_mapping_list/hotel_continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($TravelCountry['TravelHotelRoomSupplier']); ?></td>
                                <td width="7%"><?php $sum8 = $sum8 + count($TravelCountry['Province']);  

                                echo $this->Html->link(count($TravelCountry['Province']), array('controller' => 'reports', 'action' => 'province_list/continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($TravelCountry['TravelHotelRoomSupplier']); ?></td>
                                <td width="7%"><?php $sum7 = $sum7 + count($TravelCountry['TravelCity']);  

echo $this->Html->link(count($TravelCountry['TravelCity']), array('controller' => 'reports', 'action' => 'city_reports/continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($TravelCountry['TravelCitySuppliers']); ?></td>
                                <td width="7%"><?php $sum2 = $sum2 + count($TravelCountry['TravelCitySupplier']);  

echo $this->Html->link(count($TravelCountry['TravelCitySupplier']), array('controller' => 'reports', 'action' => 'city_mapping_list/city_continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($TravelCountry['TravelCitySuppliers']); ?></td>
                                 
                                 
                                <td width="7%"><?php $sum3 = $sum3 + count($TravelCountry['TravelSuburb']);  
echo $this->Html->link(count($TravelCountry['TravelSuburb']), array('controller' => 'reports', 'action' => 'suburb_list/continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
//echo count($TravelCountry['TravelSuburb']); ?></td> 
                                <td width="7%"><?php $sum4 = $sum4 + count($TravelCountry['TravelArea']);  //echo count($TravelCountry['TravelArea']);
echo $this->Html->link(count($TravelCountry['TravelArea']), array('controller' => 'reports', 'action' => 'area_list/continent_id:'.$continent_id), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
 ?></td> 
                            </tr>
                        <?php endforeach; ?>

                        <?php
                        //echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="12" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>   
        <table class="table toggle-square" style="margin-top:-16px !important">
<tbody>
<tr>
                                <td  width="44%">Total</td>
                               
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
                                <td  width="44%">Blank Country</td>
                               
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
                                <td  width="44%">All Counts</td>
                               
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
            <?php echo $this->Form->end(); ?>
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
                        var agree=confirm("WARNING! You are about to delete "+ numberOfChecked +" areas. Are you sure?");
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