<?php
$this->Html->addCrumb('My Duplicate Hotels', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>    
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-body">
<div class="row">
    <div class="col-sm-12">
        
        

       <?php
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
                            <label for="reg_input_name">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php                              
                                echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents,'empty' => '--Select--','selected' => $continent_id));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Province</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php                              
                                echo $this->Form->input('province_id', array('options' => $Provinces,'empty' => '--Select--','selected' => $province_id));
                                ?></div>
                        </div>
               
                    </div>
                    <div class="col-sm-6">                        
                        <div class="form-group">
                            <label for="reg_input_name">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php                              
                                echo $this->Form->input('country_id', array('options' =>$TravelCountries,'empty' => '--Select--','selected' => $country_id));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php                              
                                echo $this->Form->input('city_id', array('options' => $TravelCities,'empty' => '--Select--','selected' => $city_id));
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
                    <?php  echo $this->Form->end();?>
            <div class="row" style="padding: 15px;">

    </div> 
            <?php
            if (isset($TravelHotelLookups) && count($TravelHotelLookups) > 0):
                        foreach ($TravelHotelLookups as $TravelHotelLookup): 
                            $hotel_name = $TravelHotelLookup['TravelHotelLookup']['hotel_name'];
                            $continent_id = $TravelHotelLookup['TravelHotelLookup']['continent_id'];
                            $country_id = $TravelHotelLookup['TravelHotelLookup']['country_id'];
                            $province_id = $TravelHotelLookup['TravelHotelLookup']['province_id'];
                            $city_id = $TravelHotelLookup['TravelHotelLookup']['city_id'];
                            echo '<h4>'.$hotel_name.'</h4>';
                            $duplicateHotel = $this->Custom->getDuplicateHotel($continent_id,$country_id,$province_id,$city_id,$hotel_name);
                          // echo count($duplicateHotel);
                            if(count($duplicateHotel)){
                            ?>
                             <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="2000">
               
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="6" class="nodis">Hotel Information</th>
                        <th data-group="group9" colspan="6">Hotel Location</th>
                        <th data-group="group10" colspan="4">Hotel Status</th>                  
                       
                    </tr>
                   
                    <tr>                        
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
                        
                       

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
	//pr($TravelHotelLookups);
        //die;
                   

                    if (isset($duplicateHotel) && count($duplicateHotel) > 0):
                        foreach ($duplicateHotel as $TravelHotelLookup):                        
                           
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
                                

                            </tr>
                        <?php endforeach; ?>

                        <?php
                        
                    else:
                        echo '<tr><td colspan="43" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>    
                    
                    <?php
                            }
                        endforeach;
            
            ?>
          
            <?php //echo $this->Form->end(); 
            echo $this->element('paginate');
            endif;
            ?>
       
    </div>
</div>
</div></div>
    </div>

<?php
/*
 * Get sates by country code
 */
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
/*
 * Get sates by country code
 */
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

$this->Js->get('#ReportProvinceId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_province/Report/province_id'
                ), array(
            'update' => '#ReportCityId',
            'async' => true,
            'before' => 'loading("ReportCityId")',
            'complete' => 'loaded("ReportCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);




?>
