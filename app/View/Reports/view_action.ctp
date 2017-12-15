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
App::import('Model', 'User');
$attr = new User();

?>

<!----------------------------start add project block------------------------------>

<div class="pop-outer">
    
    <div class="col-sm-12">
        <?php if (count($TravelActionItems) > 0) { ?>
        <div class="pop-up-hdng">Hotel Action Information</div>
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr>                        
                        <th>Action Id</th>                        
                        <th data-hide="phone">Level</th>                                                              
                        <th data-hide="phone" data-sort-ignore="true">About</th>
                        <th data-hide="phone" data-sort-ignore="true">Active?</th>
                        <th data-hide="phone" data-sort-ignore="true">Action Date</th>
                        <th data-hide="phone" data-sort-ignore="true">Source</th> 
                        <th data-hide="phone" data-sort-ignore="true">Last By</th>  
                        <th data-hide="phone" data-sort-ignore="true">Current Type</th>  
                        <th data-hide="phone" data-sort-ignore="true">Next By</th>  
                    </tr>
                </thead>
                <tbody>
                    <?php                  
                        foreach ($TravelActionItems as $TravelActionItem):
                            $id = $TravelActionItem['TravelActionItem']['id'];
                            $about = $TravelActionItem['TravelHotelLookup']['hotel_name'];
                            ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $TravelActionItem['TravelActionItemLevel']['value']; ?></td>
                                <td><?php echo $about; ?></td>
                                <td><?php echo $TravelActionItem['TravelActionItem']['action_item_active']; ?></td>                                                         
                                <td><?php echo date('d/m/Y', strtotime($TravelActionItem['TravelActionItem']['created'])); ?></td>
                                <td><?php echo $TravelActionItem['TravelRole']['role_name']; ?></td>
                                <td><?php echo $attr->Username($TravelActionItem['TravelActionItem']['created_by']); ?></td>
                                <td><?php echo $TravelActionItem['TravelActionType']['value']; ?></td>
                                <td><?php echo $attr->Username($TravelActionItem['TravelActionItem']['next_action_by']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                  
                </tbody>
            </table>
        <?php } ?>
        
        <?php if (count($HotelMappingAction) > 0) { ?>
        <div class="pop-up-hdng">Mapping Action Information</div>
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr>                        
                        <th>Action Id</th>                        
                        <th data-hide="phone">Level</th>                                                              
                        <th data-hide="phone" data-sort-ignore="true">About</th>
                        <th data-hide="phone" data-sort-ignore="true">Active?</th>
                        <th data-hide="phone" data-sort-ignore="true">Action Date</th>
                        <th data-hide="phone" data-sort-ignore="true">Source</th> 
                        <th data-hide="phone" data-sort-ignore="true">Last By</th>  
                        <th data-hide="phone" data-sort-ignore="true">Current Type</th>  
                        <th data-hide="phone" data-sort-ignore="true">Next By</th>  
                    </tr>
                </thead>
                <tbody>
                    <?php                   
                        foreach ($HotelMappingAction as $TravelActionItem):
                            $id = $TravelActionItem['TravelActionItem']['id'];
                            $about = $TravelActionItem['TravelHotelLookup']['hotel_name'];
                            ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $TravelActionItem['TravelActionItemLevel']['value']; ?></td>
                                <td><?php echo $about; ?></td>
                                <td><?php echo $TravelActionItem['TravelActionItem']['action_item_active']; ?></td>                                                         
                                <td><?php echo date('d/m/Y', strtotime($TravelActionItem['TravelActionItem']['created'])); ?></td>
                                <td><?php echo $TravelActionItem['TravelRole']['role_name']; ?></td>
                                <td><?php echo $attr->Username($TravelActionItem['TravelActionItem']['created_by']); ?></td>
                                <td><?php echo $TravelActionItem['TravelActionType']['value']; ?></td>
                                <td><?php echo $attr->Username($TravelActionItem['TravelActionItem']['next_action_by']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    
                </tbody>
            </table>
        <?php } ?>
    </div>

</div>	

