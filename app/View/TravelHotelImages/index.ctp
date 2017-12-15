<?php
$this->Html->addCrumb('My Hotel Images', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//echo $this->element('Hotel/top_menu');
?> 



<div class="row">

				
    <div class="col-sm-12">


 
                <?php
                echo $this->Form->create('TravelHotelLookup', array('paramType' => 'querystring' , 'url' => '/travel_hotel_images/index', 'class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                ),array('controller' => 'travel_hotel_images'),
                    ));
                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'TravelHotelLookup'));
                ?> 


                

                    
                    
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Continent:</label>
                        <?php echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'value' => $continent_id, 'data-required' => 'true')); ?>
                    </div>                    
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'value' => $country_id, 'data-required' => 'true')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Province:</label>
                        <?php echo $this->Form->input('province_id', array('options' => $Provinces, 'empty' => '--Select--', 'value' => $province_id, 'data-required' => 'true')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('city_id', array('options' => $TravelCities, 'empty' => '--Select--', 'value' => $city_id, 'data-required' => 'true')); ?>
                    </div>
					
					 <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Image Status:</label>
                        <?php echo $this->Form->input('is_image', array('options' => $ImageStatus, 'empty' => '--Select--', 'value' => $is_image, 'data-required' => 'true')); ?>
                    </div>
					
					<div class="col-sm-3 col-xs-6">
                        <label for="un_member">Mapping Status:</label>
                        <?php echo $this->Form->input('mapping_status', array('options' => $MappingStatus, 'empty' => '--Select--', 'value' => $mapping_status, 'data-required' => 'true')); ?>
                    </div>
</br>  
                    <div align="center" class="col-sm-12 col-xs-6">
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Fetch Hotels', array('div' => false,'label' => false,'name' => 'fetch_hotel', 'class' => 'success btn','style' => 'margin-left:-16px;width:10%;margin-top: 0px;'));
// echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>

              
            </div>
                 <?php echo $this->Form->end(); ?>

     
</br>       


    <div style="padding-left: 20px;" align="center" class="col-sm-12">

            <table width="800" style="margin-left:auto;margin-right:auto cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="1000">
                <thead>
                    <tr>
                        <th data-toggle="true" data-sort-ignore="true" width="4%" data-group="group1">Id</th>
                        <th data-toggle="phone" data-sort-ignore="true" width="13%" data-group="group1">Name</th>
                        <th data-hide="phone" data-group="group1" width="12%" data-sort-ignore="true">Suburb</th>
                        <th data-hide="phone" data-group="group1" width="8%" data-sort-ignore="true">Area</th>
                        <th width="33%" data-group="group1" data-sort-ignore="true">Address</th>
                        <th width="7%" data-group="group1" data-sort-ignore="true">GPS Parm1</th>
                        <th width="7%" data-group="group1" data-sort-ignore="true">GPS Parm2</th>
                        <th data-toggle="phone" data-sort-ignore="true" width="4%" data-group="group1">Site</th>                        
                        <th width="4%" data-group="group1" data-sort-ignore="true">Image?</th>
                        <th data-group="group2" data-hide="phone" data-sort-ignore="true" width="8%">Action</th> 

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
	//pr($TravelHotelLookups);
                    $secondary_city = '';
//echo count($TravelHotelLookups);
                    if (isset($TravelHotelLookups) && count($TravelHotelLookups) > 0):
                        foreach ($TravelHotelLookups as $TravelHotelLookup):
                            $id = $TravelHotelLookup['TravelHotelLookup']['id'];
                            if($TravelHotelLookup['TravelHotelLookup']['is_image'] == 'Y')
                                $image_flag = 'Yes';
                            else 
                                $image_flag = 'No';
                            ?>
                            <tr>
                                <td class="tablebody"><?php echo $id; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_name']; ?></td>   
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['suburb_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['area_name']; ?></td>
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['address']; ?></td>               
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['gps_prm_1']; ?></td>               
                                <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['gps_prm_2']; ?></td>               
                                <td class="tablebody"><?php 
                                echo $this->Html->link('Link', $TravelHotelLookup['TravelHotelLookup']['url_hotel'],array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));                                
                                //echo $TravelHotelLookup['TravelHotelLookup']['url_hotel']; ?></td>
                                <td class="tablebody"><?php echo $image_flag; ?></td>               
                                <td valign="middle" align="center">

                                    <?php
									if($TravelHotelLookup['TravelHotelLookup']['is_image'] == 'Y'){
										 echo $this->Html->link('<span class="icon-eye-open"></span>', 'view/' . $id , array('class' => 'act-ico','target' => '_blank', 'escape' => false));
									}else{
									 echo $this->Html->link('<span class="icon-pencil"></span>', 'edit/' . $id."/continent_id:$continent_id/country_id:$country_id/province_id:$province_id/city_id:$city_id/is_image:$is_image/mapping_status:$mapping_status" , array('class' => 'act-ico','target' => '_blank', 'escape' => false));	
									}
                                
                                   
                                    
                                    //echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'travel_hotel_lookups', 'action' => 'hotel_edit/' . $id,), array('class' => 'act-ico', 'escape' => false));
                                    //echo $this->Html->link('<span class="icon-remove"></span>', array('controller' => 'travel_hotel_lookups', 'action' => 'delete', $id), array('class' => 'act-ico', 'escape' => false), "Are you sure you wish to delete this hotel?");
                                    ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="10" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>          

</div>


<?php echo $this->Form->end(); ?>
    
<?php

/*
 * Get sates by country code
 */
$data = $this->Js->get('#SearchForm')->serializeForm(array('isForm' => true, 'inline' => true));

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
$this->Js->get('#TravelHotelLookupCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_image_province_by_continent_country/TravelHotelLookup/continent_id/country_id'
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

$this->Js->get('#TravelHotelLookupCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_city_code/TravelHotelLookup'
                ), array(
            'update' => '#TravelHotelLookupSupplierCityCode',
            'async' => true,
            'before' => 'loading("TravelHotelLookupSupplierCityCode")',
            'complete' => 'loaded("TravelHotelLookupSupplierCityCode")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
?>
