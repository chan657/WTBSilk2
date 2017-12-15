<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'font-awesome/css/font-awesome.min',
    '/js/lib/datepicker/css/datepicker',
    '/js/lib/timepicker/css/bootstrap-timepicker.min'
        )
);
echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));
/* End */
//pr($this->data);
?>

<!----------------------------start add project block------------------------------>

<div class="pop-outer">
    <div class="pop-up-hdng">Mapping Information [SUPPLIER HOTEL: <?php echo $hotel_supplier_id; ?>]</div>
    <div class="col-sm-12">
        <?php if (count($TravelHotelRoomSuppliers) > 0) { ?>
             <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="500">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="1" class="nodis">Information</th> 
                      
                        <th data-group="group2" colspan="3">WTB</th>
                                              
                        <th data-group="group3" colspan="3">SUPPLIER</th>
                        
                    </tr>
                    <tr>                        
                        <th data-toggle="phone"  data-group="group1">Mapping Info</th>                        
                                                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Hotel</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Country</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">City</th>
                                                                                 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Hotel</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Country</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">City</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    //pr($TravelCountrySuppliers);
                    if (isset($TravelHotelRoomSuppliers) && count($TravelHotelRoomSuppliers) > 0):
                        foreach ($TravelHotelRoomSuppliers as $TravelHotelRoomSupplier):
                            $id = $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['id'];
                            $status = $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_supplier_status'];
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
                            $supplier_hotel_name = $this->Custom->getHotelNameSupplier($TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_supplier_id']);
                            $supplier_country_name = $this->Custom->getCountryNameSupplier($TravelHotelRoomSupplier['TravelHotelRoomSupplier']['supplier_item_code4']);                            
                            $supplier_country_id = $this->Custom->getCountryIdSupplier($TravelHotelRoomSupplier['TravelHotelRoomSupplier']['supplier_item_code4']);                                                                                    
                            $supplier_city_name = $this->Custom->getCityNameSupplier($TravelHotelRoomSupplier['TravelHotelRoomSupplier']['supplier_item_code3']);                            
                            $supplier_city_id = $this->Custom->getCityIdSupplier($TravelHotelRoomSupplier['TravelHotelRoomSupplier']['supplier_item_code3']);                                                        
                            $hotel_address = $this->Custom->getHotalAddress($TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_id']);                            
                            $supplier_hotel_address = $this->Custom->getHotelAddressSupplier($TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_supplier_id']);                                                                                    
                            ?>
                            <tr>

                                <td><?php echo "ID : ".$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['id']."<br>". "SUPPLIER : ".$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['supplier_code']."<br>". "STATUS : ".$status_txt."<br>". "ACTIVE : ".$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['active']."<br>". "EXCLUDED : ".$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['excluded']."<br>". "CREATED BY : "."<br>".$this->Custom->Username($TravelHotelRoomSupplier['TravelHotelRoomSupplier']['created_by'])."<br>". "CREATED ON : ".$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['created']."<br>". "MODIFIED ON : ".$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['modified']; ?></td>
                              
                                <td><?php echo $this->Html->link($TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_name'], array('controller' => 'reports', 'action' => 'hotel_summary/id:'.$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')); ?>
                                    <?php echo "<br>". "WTB CODE: ".$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_code']."<br>". "WTB ID: ".$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_id']."<br>". "<br>". "WTB ADDRESS: ". "<br>". $hotel_address; ?></td>                                
                                
                                <td><?php echo $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_country_name']."<br>". $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_country_code']."<br>". $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_country_id']; ?></td>
                                <td><?php echo $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_city_name']."<br>". $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_city_code']."<br>". $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_city_id']; ?></td>
                                                              
                                <td><?php echo $this->Html->link($supplier_hotel_name, array('controller' => 'admin', 'action' => 'supplier_hotels/id:'.$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_supplier_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')); ?>
                                    <?php echo "<br>". "SUPPLIER CODE: ".$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['supplier_item_code1']."<br>". "SUPPLIER ID: ".$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_supplier_id']."<br>". "<br>". "SUPPLIER ADDRESS: ". "<br>". $supplier_hotel_address; ?></td>
                                
                                <td><?php echo $supplier_country_name."<br>". "COUNTRY CODE: ".$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['supplier_item_code4']."<br>". "COUNTRY ID: ".$supplier_country_id; ?></td>
                                <td><?php echo $supplier_city_name."<br>". "CITY CODE: ".$TravelHotelRoomSupplier['TravelHotelRoomSupplier']['supplier_item_code3']."<br>". "CITY ID: ".$supplier_city_id; ?></td>
                            </tr>
                        <?php endforeach; ?>

                        <?php
                    else:
                        echo '<tr><td colspan="7" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
        <?php } ?>
    </div>

</div>	

