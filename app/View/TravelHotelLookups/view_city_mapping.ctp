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
    <div class="pop-up-hdng">Mapping Information</div>
    <div class="col-sm-12">
        
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr>                        
                        <th data-toggle="phone"  data-group="group1">Supplier Code</th>                        
                        <th data-hide="phone"  data-group="group1">Mapping Status</th>                                                              
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Mapping Active?</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Mapping Excluded?</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Mapping Name</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">WTB</th> 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Supplier</th>  

                    </tr>
                </thead>
                <tbody>
                    <?php
                    //pr($TravelCountrySuppliers);
                    if (isset($TravelCitySuppliers) && count($TravelCitySuppliers) > 0):
                        foreach ($TravelCitySuppliers as $TravelCitySupplier):
                            $id = $TravelCitySupplier['TravelCitySupplier']['id'];
                            $status = $TravelCitySupplier['TravelCitySupplier']['city_supplier_status'];
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
                            ?>
                            <tr>

                                <td><?php echo $TravelCitySupplier['TravelCitySupplier']['supplier_code']; ?></td>
                                <td><?php echo $status_txt; ?></td>
                                <td><?php echo $TravelCitySupplier['TravelCitySupplier']['active']; ?></td>                                                          

                                <td><?php echo $TravelCitySupplier['TravelCitySupplier']['excluded']; ?></td>
                                <td><?php echo $TravelCitySupplier['TravelCitySupplier']['city_mapping_name']; ?></td>
                                <td><?php echo $TravelCitySupplier['TravelCitySupplier']['pf_city_code']; ?></td>
                                <td><?php echo $TravelCitySupplier['TravelCitySupplier']['supplier_city_code']; ?></td>
                            </tr>
                        <?php endforeach; ?>

                        <?php
                    else:
                        echo '<tr><td colspan="7" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
       
    </div>

</div>	

