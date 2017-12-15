<?php
$this->Html->addCrumb('My Booking Service', 'javascript:void(0);', array('class' => 'breadcrumblast'));
App::import('Model', 'User');
$attr = new User();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Booking Service</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Booking', '/travel_booking_services/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">
                <?php
                echo $this->Form->create('TravelBookingService', array('class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">
<?php echo $this->Form->input('structure_name', array('value' => $structure_name, 'placeholder' => 'Booking Code', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Booking Code Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>
                    </div>
                </div>
                <!-- <div class="row" id="search_panel_controls">
                     <div class="col-sm-3 col-xs-6">
                         <label for="un_member">Continent:</label>
<?php echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'value' => $continent_id)); ?>
                     </div>
                     <div class="col-sm-3 col-xs-6">
                         <label for="un_member">Country:</label>
<?php echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'value' => $country_id)); ?>
                     </div>
                     <div class="col-sm-3 col-xs-6">
                         <label for="un_member">Status:</label>
<?php echo $this->Form->input('city_status', array('options' => array('1' => 'Active', '2' => 'Inactive'), 'empty' => '--Select--', 'value' => $city_status)); ?>
                     </div>
                     <div class="col-sm-3 col-xs-6">
                         <label for="un_member">WTB Status:</label>
<?php echo $this->Form->input('wtb_status', array('options' => array('1' => 'Active', '2' => 'De-active'), 'empty' => '--Select--', 'value' => $wtb_status)); ?>
                     </div>
                     <div class="col-sm-3 col-xs-6">
                         <label for="un_member">Active:</label>
<?php echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--', 'value' => $active)); ?>
                     </div>
                     
                     <div class="col-sm-3 col-xs-6">
                         <label>&nbsp;</label>
                <?php
                echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                ?>
                     </div>
                 </div>-->
<?php echo $this->Form->end(); ?>
            </div>
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="13">Booking Information</th>                                          
                        <th data-group="group4" colspan="2">Booking Status</th>
                        <th data-group="group5" class="nodis">Action</th>
                    </tr>
                    <tr>  
                        <th data-toggle="true"  data-group="group1">Booking Id</th>
                        <th data-toggle="phone"  data-group="group1">Booking Code</th>
                        <th data-toggle="phone" data-sort-ignore="true"  data-group="group1">Supplier Code</th>                        
                        <th data-toggle="phone" data-sort-ignore="true"  data-group="group1">Booking By Agent</th>
                        <th data-toggle="phone" data-sort-ignore="true"  data-group="group1">Agent Type</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Booking Date</th>     
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Booking Total</th>  
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Modified Date</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Invoice Date</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Confirmation Date</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Invoice Code</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Voucher Code</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Information</th>                       

                        <th data-hide="phone" data-sort-ignore="true" data-group="group4">Booking Status</th>                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group4">Payment Status</th>

                        <th data-group="group5" data-hide="phone" data-sort-ignore="true" width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $status = '';
                    if (isset($TravelBookingServices) && count($TravelBookingServices) > 0):
                        foreach ($TravelBookingServices as $TravelBookingService):
                            $id = $TravelBookingService['TravelBookingService']['id'];
                            
                            ?>
                            <tr> 
                                <td><?php echo $id; ?></td>
                                <td><?php echo $TravelBookingService['TravelBookingService']['BookingCode']; ?></td>                                
                                <td><?php echo $TravelBookingService['TravelBookingService']['BookingCodeSupplier']; ?></td>                                
                                <td><?php echo $TravelBookingService['TravelBookingService']['BookByAgentId']; ?></td>
                                <td><?php echo $TravelBookingService['TravelBookingService']['BookByAgentTypeId']; ?></td>
                                <td><?php echo $TravelBookingService['TravelBookingService']['BookingDate']; ?></td>
                                <td><?php echo $TravelBookingService['TravelBookingService']['BookingTotal'];?></td>
                                <td><?php echo $TravelBookingService['TravelBookingService']['ModifiedDate']; ?></td>
                                <td><?php echo $TravelBookingService['TravelBookingService']['InvoiceDate']; ?></td>
                                <td><?php echo $TravelBookingService['TravelBookingService']['ConfirmationDate']; ?></td>
                                <td><?php echo $TravelBookingService['TravelBookingService']['InvoiceCode']; ?></td>
                                <td><?php echo $TravelBookingService['TravelBookingService']['VoucherCode']; ?></td>
                                <td><?php echo $TravelBookingService['TravelBookingService']['AdditionalInformation']; ?></td>
                                                             
                    
                                <td><?php echo $TravelBookingService['TravelBookingService']['BookingStatus']; ?></td>                               
                                <td><?php echo $TravelBookingService['TravelBookingService']['PaymentStatus']; ?></td>
                                <td>
                                   <?php
                                    //echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'dig_structures', 'action' => 'edit', 'slug' => $TravelBookingService['TravelBookingService']['structure_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                     //echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'dig_structures', 'action' => 'edit', 'slug' => $TravelBookingService['TravelBookingService']['structure_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false)); 
                                   ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="16" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Booking', '/travel_booking_services/add') ?></span>

        </div>
    </div>
</div>