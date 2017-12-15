<?php

$this->Html->addCrumb('Hotel Mapping', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create(null, array(
    'url' => array('controller' => 'admin', 'action' => 'add_hotel_mapping'),'method' => 'get'
));
/*
echo $this->Form->create('Test', array('/admin/add_country_mapping','method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
    array('controller' => 'admin', 'action' => 'add')
));
 * 
 */
echo $this->Form->hidden('Common.supplier_hotel_id',array('value' => $this->data['SupplierHotel']['id']));
echo $this->Form->hidden('Common.wtb_passed_continent_id',array('value' => $wtb_continent_id));
echo $this->Form->hidden('Common.wtb_passed_country_id',array('value' => $wtb_country_id));
echo $this->Form->hidden('Common.wtb_passed_province_id',array('value' => $wtb_province_id));
echo $this->Form->hidden('Common.wtb_passed_city_id',array('value' => $wtb_city_id));

echo $this->Form->hidden('Common.supplier_passed_id',array('value' => $supplier_id));
echo $this->Form->hidden('Common.supplier_passed_country_id',array('value' => $supplier_country_id));
echo $this->Form->hidden('Common.supplier_passed_city_id',array('value' => $supplier_city_id));
//echo $this->Form->hidden('Common.wtb_passed_continent_id',$wtb_continent_id);
//echo $this->Form->hidden('Common.wtb_passed_continent_id','wtb_continent_id');
//echo $this->Form->hidden('Common.wtb_passed_continent_id',array('value' => 'wtb_continent_id'));
//echo $this->Form->hidden('Common.wtb_passed_continent_id',array('value' => $this->data['SupplierHotel']['wtb_continent_id']));
?>
<style>
    .form-group{
        margin-left: -15px;
        margin-right: -15px;
        margin-bottom: 6px;
        overflow: hidden;
        z-index: 1;
        position: relative;
        clear: both;
    }
</style>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Hotel Mapping</h4>
        </div>
        <div class="panel-body">           
            <div class="row">                
                <div class="col-sm-12"  style="background-color: rgb(211, 233, 237);overflow:hidden;">
                    <div class="col-sm-6">                        
                        <div class="form-group">
                            <label for="reg_input_name" class="bgr">Id</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['SupplierHotel']['id'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['SupplierHotel']['country_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['SupplierHotel']['city_name'];
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Hotel</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['SupplierHotel']['hotel_name'];
                                ?></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['SupplierHotel']['continent_name'];
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['SupplierHotel']['country_code'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">City Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->data['SupplierHotel']['city_code'];
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo '<b>'.$this->data['SupplierHotel']['hotel_code'].'</b>';
                                ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="reg_input_name">Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $address;
                                ?></div>
                        </div>
                </div>      


				<?PHP if($check_mapp == 'TRUE'){?>
            <div class="col-sm-12" style="background-color: rgb(188, 255, 255);overflow:hidden;padding: 15px">
                <h4>Searching for a [MATCH] in the following [WTB CITIES]:</h4>
             <table border="0" cellpadding="0" cellspacing="0"  class="table toggle-square myclitb" data-filter="#table_search" data-page-size="500">
               
                <thead>
                          
                    <tr>
                        <th data-hide="phone" width="2%" data-sort-ignore="true">Mapping Id.</th>
                        <th data-toggle="phone" data-sort-ignore="true" >Mapping Name</th> 
                        <th data-toggle="phone"  data-sort-ignore="true">WTB Country</th>    
                        <th data-toggle="phone"  data-sort-ignore="true">WTB Province</th> 
                        <th data-toggle="phone"  data-sort-ignore="true">WTB City</th>
						<th data-toggle="phone"  data-sort-ignore="true">WTB City Id</th>
                        <th data-toggle="phone"  data-sort-ignore="true">WTB City Code</th>
                        <th data-hide="phone"  data-sort-ignore="true">Mapping Status</th>                                                              
                        <th data-hide="phone" data-sort-ignore="true">Mapping Active?</th>
                        <th data-hide="phone" data-sort-ignore="true">WTB Status</th>
                        <th data-hide="phone" data-sort-ignore="true">Mapping Excluded?</th>                                                      
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
			 <?php } ?>
				
				
				
				
				
				
                
                
                <div class="clear" style="clear: both; margin-bottom: 10px;"></div>
                <div class="col-sm-12" style="background-color: rgb(100, 233, 300);overflow:hidden;padding: 15px">
                    <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="3000">
                        <thead>         
                            <tr class="footable-group-row">
                                <th data-group="group1" colspan="9" class="nodis">Hotel Information</th>

                                <th data-group="group2" colspan="3">Hotel Information</th>

                                <th data-group="group4" class="nodis">Hotel Action</th>
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
                                <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">Status</th>                                
                                <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">No. Of Mappings</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Suburb</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Area</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Chain</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Brand</th>
                                <th data-hide="all" data-group="group2" data-sort-ignore="true">Address</th>
                                <th data-group="group4" data-hide="phone" data-sort-ignore="true" width="3%">Action</th>        
                            </tr>
                        </thead>
                        <tbody>
<?php

if (isset($TravelHotelLookups) && count($TravelHotelLookups) > 0):
    foreach ($TravelHotelLookups as $TravelHotelLookup):
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
                                
                                <td class="tablebody">
                                <?php
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
                                echo $status_txt;
                                //echo $status;
                                 ?></td>
                                
                                <td class="tablebody"><?php echo count($TravelHotelLookup['TravelHotelRoomSupplier']); ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['suburb_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['area_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['chain_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['brand_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['address']; ?></td>
                                <td width="10%" valign="middle" align="center">
                                    <?php 
                                    if(count($TravelHotelLookup['TravelHotelRoomSupplier'])==0){
                                        $options=array($id=>'');
                                        $attributes=array('legend'=>false, 'hiddenField' => false,'label' => false,'div' => false,'class' => 'attrInputs');
                                        echo $this->Form->radio('Common.hotel_id',$options,$attributes);
                                    }
                                        ?>                                
                                </td>
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
                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12">
                    <div class="row">  

                        <div class="col-sm-2">
                            <?php
                            //echo $this->Html->link('Proceed to Mapped', '/admin/add_country_mapping/'.$this->data['SupplierCountry']['id'], array('class' => 'btn btn-success', 'escape' => false));        
                            //echo $this->Html->link('Proceed to Mapped', array('/admin/add_country_mapping'), array('class' => 'btn btn-success sticky_success', 'escape' => false));
                            echo $this->Form->submit('Proceed To Map', array('class' => 'btn btn-success sticky_success','id' => 'ClickRadioMandatory','name' => 'mapped','style' => 'width:100%;float:left'));
                            //echo $this->Form->submit('Submit Insert', array('class' => 'btn btn-success sticky_success','name' => 'add','style' => 'width:100%;float:left;'));
                            ?>
                        </div>
                        <div class="col-sm-2">
                            <?php
                            //echo $this->Form->submit('Proceed to Mapped', array('class' => 'btn btn-success sticky_success','name' => 'add','style' => 'width:100%;float:left'));
                            echo $this->Form->submit('Submit For Insert', array('class' => 'btn btn-success sticky_success','name' => 'inserted','style' => 'width:100%;float:left;','onclick' => "return confirm('Are you sure you want to create support ticket?')"));
                            ?>
                        </div>
                        <div class="col-sm-2">
                            <?php
                            echo $this->Form->submit('Submit For Review', array('class' => 'btn btn-success sticky_success','name' => 'review','style' => 'width:100%;float:left'));
                            //echo $this->Html->link('Submit For Review', array('controller' => 'admin','action' => 'hotel_review'),array('class' => 'btn btn-success sticky_success','style' => 'width:100%;float:left'));
                            //echo $this->Form->submit('Proceed to Mapped', array('class' => 'btn btn-success sticky_success','name' => 'add','style' => 'width:100%;float:left'));
                            //echo $this->Form->submit('Submit For Review', array('class' => 'btn btn-success sticky_success','name' => 'review','style' => 'width:100%;float:left;'));
                            ?>
                        </div>
                        <div class="col-sm-2">
<?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important')); ?>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();
?>
