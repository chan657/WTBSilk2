<?php
$this->Html->addCrumb('Mismatch Hotel By Country', 'javascript:void(0);', array('class' => 'breadcrumblast'));
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
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Mismatched Hotels By Country</h4>
        </div>
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req"  style="margin-left: 14px;">Select Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-8">
                                <?php
                                // 'TravelHotelLookup' => 'Hotel', 'TravelCountry' => 'Country', 'TravelCity' => 'City', 'TravelCountrySupplier' => 'Mapping Country', 'TravelCitySupplier' => 'Mapping City', 'TravelHotelRoomSupplier' => 'Mapping Hotel'
                                echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'data-required' => 'true','selected' => $country_id));
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
                    
                     <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="2000">
                <thead>         
                    <tr>
                        <th data-hide="phone" data-sort-ignore="true">Id</th>
                        <th data-hide="phone" data-sort-ignore="true">Country Name</th>
                       
                        <th data-hide="phone" data-sort-ignore="true">City Name</th>
                        <th data-hide="phone" data-sort-ignore="true">City Id</th>
                        <th data-hide="phone" data-sort-ignore="true">City Code</th>
                        
                        <th data-hide="phone" data-sort-ignore="true">Hotel Count</th>                        
                        <th data-hide="phone" data-sort-ignore="true">Action</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php
                   
                    $i = 1;
                    $sum = 0;
             
                    if (isset($TravelHotelLookups) && count($TravelHotelLookups) > 0):
                        foreach ($TravelHotelLookups as $value):                       
                         
                            ?>
                            <tr>
                                <td><?php echo $i;?></td> 
                                <td><?php echo $value['TravelHotelLookup']['country_name']; ?></td>
                               
                                <td><?php echo $value['TravelHotelLookup']['city_name'].' ('.$value['TravelCity']['country_name'].',' .$value['TravelCity']['continent_name'].')'; ?></td>
                                <td><?php echo $value['TravelHotelLookup']['city_id']; ?></td>
                                <td><?php echo $value['TravelHotelLookup']['city_code']; ?></td>
                                
                                <td><?php $sum = $sum + $value[0]['cnt']; 
                                
                                echo $this->Html->link($value[0]['cnt'], array('controller' => 'reports', 'action' => 'hotel_summary/city_id:'.$value['TravelHotelLookup']['city_id'].'/country_id:'.$value['TravelHotelLookup']['country_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                ?></td> 
                                
                                <td>
                                    
                                    <?php  if($user_id == '169'){ 
                                        echo $this->Html->link('Mass Update', '/mass_operations/hotel/city_id:'.$value['TravelHotelLookup']['city_id'].'/country_id:'.$value['TravelHotelLookup']['country_id'].'/province_id:'.$useless.'/suburb_id:'.$useless.'/area_id:'.$useless,array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                    }    
                                    ?>
                                    
                                </td>
                            </tr>
                        <?php 
                        $i++;
                        endforeach; ?>
                            <tr>
                                <td  colspan="5">Total</td>
                                <td colspan="2"><?php echo $sum?></td> 
                                
                            </tr>

                        <?php
                       
                    else:
                        echo '<tr><td colspan="3" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
                </div>
                              
            
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();

?>