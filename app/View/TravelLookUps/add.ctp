<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">My Travel Look Ups Table</h4>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-sm-12">
                        <div class="panel-group" id="accordion2">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseOne">
                                            Lookup For Travel Cities
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="30%">City Name</th>
                                                <th width="30%">Country Code</th>
                                                <th width="20%">State Code</th>
                                                <th width="30%">City URL</th>
                                                
                                                <th width="10%">Action</th>
                                            </tr>
                                            <?php
                                            $i = 1;
                                            if (isset($TravelCities) && count($TravelCities) > 0):
                                                foreach ($TravelCities as $TravelCity):
                                                    $id = $TravelCity['TravelCity']['id'];
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $TravelCity['TravelCity']['city_name']; ?></td>
                                                        <td><?php echo $TravelCity['TravelCity']['country_code']; ?></td>
                                                        <td><?php echo $TravelCity['TravelCity']['state_code']; ?></td>
                                                        <td><?php echo $TravelCity['TravelCity']['city_url']; ?></td>
                                                        <td>
                                                            <?php
                                                            echo $this->Html->link('Edit', '/look_ups/edit_project_phase/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                            ?>
                                                        </td>
                                                    </tr>

        <?php
        $i++;
    endforeach;
endif;
?>
                                        </table>

                                            <?php
                                            echo $this->Html->link('Add', '/look_ups/add_project_phase/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                            ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwo">
                                            Lookup For Travel Countries
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="35%">Country Name</th>
                                                <th width="35%">Capital City</th>
                                                <th width="13%">Action</th>
                                            </tr>
<?php
$i = 1;
if (isset($TravelCountries) && count($TravelCountries) > 0):
    foreach ($TravelCountries as $TravelCountry):
        $id = $TravelCountry['TravelCountry']['id'];
        ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $TravelCountry['TravelCountry']['country_name']; ?></td>
                                                        <td><?php echo $TravelCountry['TravelCountry']['capital_city']; ?></td>

                                                        <td>
        <?php
        echo $this->Html->link('Edit', '/look_ups/edit_project_marketing/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
        ?>
                                                        </td>
                                                    </tr>

                                                            <?php
                                                            $i++;
                                                        endforeach;
                                                    endif;
                                                    ?>
                                        </table>
                                            <?php
                                            echo $this->Html->link('Add', '/look_ups/add_project_marketing/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                            ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseThree">
                                            Lookup For Travel City Suppliers
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="35%">Supplier Code</th>
                                                <th width="35%">Supplier City Code</th>
                                                <th width="13%">Action</th>
                                            </tr>
<?php
$i = 1;
if (isset($TravelCitySuppliers) && count($TravelCitySuppliers) > 0):
    foreach ($TravelCitySuppliers as $TravelCitySupplier):
        $id = $TravelCitySupplier['TravelCitySupplier']['id'];
        ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $TravelCitySupplier['TravelCitySupplier']['supplier_code']; ?></td>
                                                        <td><?php echo $TravelCitySupplier['TravelCitySupplier']['supplier_city_code']; ?></td>
                                                        
                                                        <td>
                                                    <?php
                                                    echo $this->Html->link('Edit', '/look_ups/edit_project_category/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                    ?>
                                                        </td>
                                                    </tr>

                                                            <?php
                                                            $i++;
                                                        endforeach;
                                                    endif;
                                                    ?>
                                        </table>
<?php
echo $this->Html->link('Add', '/look_ups/add_project_category/', array('class' => 'btn btn-success sticky_success open-popup-link'));
?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseFour">
                                            Lookup For Travel Country Suppliers
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseFour" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="35%">Supplier Code</th>
                                                <th width="35%">Supplier Country Code</th>
                                                <th width="13%">Action</th>
                                            </tr>
<?php
$i = 1;
if (isset($TravelCountrySuppliers) && count($TravelCountrySuppliers > 0)):
    foreach ($TravelCountrySuppliers as $TravelCountrySupplier):
        $id = $TravelCountrySupplier['$TravelCountrySupplier']['id'];
        ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $TravelCountrySupplier['$TravelCountrySupplier']['supplier_code']; ?></td>
                                                        <td><?php echo $TravelCountrySupplier['$TravelCountrySupplier']['supplier_country_code']; ?></td>

                                                        <td>
                                                    <?php
                                                    echo $this->Html->link('Edit', '/look_ups/edit_project_unit_type/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                    ?>
                                                        </td>
                                                    </tr>

        <?php
        $i++;
    endforeach;
endif;
?>
                                        </table>                                          

<?php
echo $this->Html->link('Add', '/look_ups/add_project_unit_type/', array('class' => 'btn btn-success sticky_success open-popup-link'));
?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseFive">
                                            Travel Currency By Country For Suppliers
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseFive" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="35%">Supplier Country Code</th>
                                                <th width="35%">Supplier Currency Code</th>
                                                <th width="13%">Action</th>
                                            </tr>
<?php
$i = 1;
if (isset($TravelCurrencyByCountryForSuppliers) && count($TravelCurrencyByCountryForSuppliers > 0)):
    foreach ($TravelCurrencyByCountryForSuppliers as $TravelCurrencyByCountryForSupplier):
        $id = $TravelCurrencyByCountryForSupplier['TravelCurrencyByCountryForSupplier']['id'];
        ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $TravelCurrencyByCountryForSupplier['TravelCurrencyByCountryForSupplier']['supplier_country_code']; ?></td>
                                                        <td><?php echo $TravelCurrencyByCountryForSupplier['TravelCurrencyByCountryForSupplier']['supplier_currency_code']; ?></td>

                                                        <td>
                                                    <?php
                                                    echo $this->Html->link('Edit', '/look_ups/edit_project_unit_type_qualifier1/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                    ?>
                                                        </td>
                                                    </tr>

        <?php
        $i++;
    endforeach;
endif;
?>
                                        </table>                                          

                                                    <?php
                                                    echo $this->Html->link('Add', '/look_ups/add_project_unit_type_qualifier1/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseSix">
                                           Travel Currency For Suppliers
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseSix" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="35%">Supplier Code</th>
                                                <th width="35%">Supplier Currency Code</th>
                                                <th width="13%">Action</th>
                                            </tr>
<?php
$i = 1;
if (isset($TravelCurrencyForSuppliers) && count($TravelCurrencyForSuppliers > 0)):
    foreach ($TravelCurrencyForSuppliers as $TravelCurrencyForSupplier):
        $id = $TravelCurrencyForSupplier['TravelCurrencyForSupplier']['id'];
        ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $TravelCurrencyForSupplier['TravelCurrencyForSupplier']['supplier_code']; ?></td>
                                                        <td><?php echo $TravelCurrencyForSupplier['TravelCurrencyForSupplier']['supplier_currency_code']; ?></td>

                                                        <td>
                                                    <?php
                                                    echo $this->Html->link('Edit', '/look_ups/edit_project_unit_type_qualifier2/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                    ?>
                                                        </td>
                                                    </tr>

        <?php
        $i++;
    endforeach;
endif;
?>
                                        </table>                                          

                                                    <?php
                                                    echo $this->Html->link('Add', '/look_ups/add_project_unit_type_qualifier2/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseSeven">
                                            Lookup For Travel Hotel Room Suppliers
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseSeven" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="15%">Hotel Code</th>
                                                <th width="15%">Room Code</th>
                                                <th width="15%">Room Type</th>
                                                <th width="15%">Supplier Code</th>
                                                <th width="15%">Hotel Status</th>
                                                <th width="13%">Action</th>
                                            </tr>
<?php
$i = 1;
if (isset($TravelHotelRoomSuppliers) && count($TravelHotelRoomSuppliers > 0)):
    foreach ($TravelHotelRoomSuppliers as $TravelHotelRoomSupplier):
        $id = $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['id'];
        ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_code']; ?></td>
                                                        <td><?php echo $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['room_code']; ?></td>
                                                        <td><?php echo $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['room_type']; ?></td>
                                                        <td><?php echo $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['supplier_code']; ?></td>
                                                        <td><?php echo $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_status']; ?></td>

                                                        <td>
                                                    <?php
                                                    echo $this->Html->link('Edit', '/look_ups/edit_project_unit_type_qualifier3/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                    ?>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                    $i++;
                                                endforeach;
                                            endif;
                                            ?>
                                        </table>                                          

                                                    <?php
                                                    echo $this->Html->link('Add', '/look_ups/add_project_unit_type_qualifier3/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseEight">
                                            Lookup For Travel Hotels
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseEight" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="10%">Hotel Code</th>
                                                <th width="15%">Language Code</th>
                                                <th width="15%">Hotel Name</th>
                                                <th width="10%">Hotel Comment</th>
                                                <th width="15%">Country Name</th>
                                                <th width="15%">City Name</th>
                                                <th width="13%">Action</th>
                                            </tr>
<?php
$i = 1;
if (isset($TravelHotelLookups) && count($TravelHotelLookups > 0)):
    foreach ($TravelHotelLookups as $TravelHotelLookup):
        $id = $TravelHotelLookup['TravelHotelLookup']['id'];
        ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_code']; ?></td>
                                                        <td><?php echo $TravelHotelLookup['TravelHotelLookup']['language_code']; ?></td>
                                                        <td><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_name']; ?></td>
                                                        <td><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_comment']; ?></td>
                                                        <td><?php echo $TravelHotelLookup['TravelHotelLookup']['country_name']; ?></td>
                                                        <td><?php echo $TravelHotelLookup['TravelHotelLookup']['city_name']; ?></td>
                                                        

                                                        <td>
                                                    <?php
                                                    echo $this->Html->link('Edit', '/look_ups/edit_project_unit_type_qualifier4/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                    ?>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                    $i++;
                                                endforeach;
                                            endif;
                                            ?>
                                        </table>                                          

                                                    <?php
                                                    echo $this->Html->link('Add', '/look_ups/add_project_unit_type_qualifier4/', array('class' => 'btn btn-success sticky_success open-popup-link'));
                                                    ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseNine">
                                            Lookup For Travel Hotel Room
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseNine" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="10%">Room Code</th>
                                                <th width="10%">Room Title</th>
                                                <th width="10%">Hotel Code</th>
                                                <th width="10%">Language Code</th>
                                                <th width="10%">Area Code</th>
                                                <th width="10%">City Code</th>
                                                <th width="10%">Country Code</th>
                                                
                                                <th width="13%">Action</th>
                                            </tr>
<?php
$i = 1;
if (isset($TravelHotelRoomlookups) && count($TravelHotelRoomlookups > 0)):
    foreach ($TravelHotelRoomlookups as $TravelHotelRoomlookup):
        $id = $TravelHotelRoomlookup['TravelHotelRoomlookup']['id'];
        ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $TravelHotelRoomlookup['TravelHotelRoomlookup']['room_code']; ?></td>
                                                        <td><?php echo $TravelHotelRoomlookup['TravelHotelRoomlookup']['room_title']; ?></td>
                                                        <td><?php echo $TravelHotelRoomlookup['TravelHotelRoomlookup']['hotel_code']; ?></td>
                                                        <td><?php echo $TravelHotelRoomlookup['TravelHotelRoomlookup']['language_code']; ?></td>
                                                        <td><?php echo $TravelHotelRoomlookup['TravelHotelRoomlookup']['area_code']; ?></td>
                                                        <td><?php echo $TravelHotelRoomlookup['TravelHotelRoomlookup']['city_code']; ?></td>
                                                        <td><?php echo $TravelHotelRoomlookup['TravelHotelRoomlookup']['country_code']; ?></td>

                                                        <td align="center" valign="middle">
        <?php
        echo $this->Html->link('Edit', '/look_ups/edit_project_unit_type_qualifier5/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
        ?>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                    $i++;
                                                endforeach;
                                            endif;
                                            ?>
                                        </table>                                          

<?php
echo $this->Html->link('Add', '/look_ups/add_project_unit_type_qualifier5/', array('class' => 'btn btn-success sticky_success open-popup-link'));
?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTen">
                                            Travel Nationality For Suppliers
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseTen" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="35%">Supplier Code</th>
                                                <th width="35%">Supplier Nationality Code</th>
                                                <th width="13%">Action</th>
                                            </tr>
<?php
$i = 1;
if (isset($TravelNationalityForSuppliers) && count($TravelNationalityForSuppliers) > 0):
    foreach ($TravelNationalityForSuppliers as $TravelNationalityForSupplier):
        $id = $TravelNationalityForSupplier['TravelNationalityForSupplier']['id'];
        ?>
                                                    <tr>
                                                        <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                                                        <td align="left" valign="left" class="tablebody"><?php echo $TravelNationalityForSupplier['TravelNationalityForSupplier']['supplier_code']; ?></td>
                                                        <td align="left" valign="left" class="tablebody"><?php echo $TravelNationalityForSupplier['TravelNationalityForSupplier']['supplier_nationality_code']; ?></td>


                                                        <td align="center" valign="middle">
        <?php
        echo $this->Html->link('Edit', '/look_ups/edit_project_type/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
        ?>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                    $i++;
                                                endforeach;
                                            endif;
                                            ?>
                                        </table>                                          

<?php
echo $this->Html->link('Add', '/look_ups/add_project_type/', array('class' => 'btn btn-success sticky_success open-popup-link'));
?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseEleven">
                                            Lookup For Travel Suppliers
                                        </a>
                                    </h4>
                                </div>
                                <div id="acc2_collapseEleven" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <table class="table">
                                            <tr>
                                                <th width="10%">ID</th>
                                                <th width="10%">Supplier Name</th>
                                                <th width="10%">Country Code</th>
                                                <th width="10%">Address</th>
                                                <th width="10%">Phone</th>
                                                <th width="10%">Fax</th>
                                                <th width="10%">Contact</th>
                                                <th width="10%">Email</th>
                                                <th width="13%">Action</th>
                                            </tr>
<?php
$i = 1;
if (isset($TravelSuppliers) && count($TravelSuppliers) > 0):
    foreach ($TravelSuppliers as $TravelSupplier):
        $id = $TravelSupplier['TravelSupplier']['id'];
        ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $TravelSupplier['TravelSupplier']['supplier_name']; ?></td>
                                                        <td><?php echo $TravelSupplier['TravelSupplier']['country_code']; ?></td>
                                                        <td><?php echo $TravelSupplier['TravelSupplier']['address']; ?></td>
                                                        <td><?php echo $TravelSupplier['TravelSupplier']['phone']; ?></td>
                                                        <td><?php echo $TravelSupplier['TravelSupplier']['fax']; ?></td>
                                                        <td><?php echo $TravelSupplier['TravelSupplier']['contact_r']; ?></td>
                                                        <td><?php echo $TravelSupplier['TravelSupplier']['email_r']; ?></td>

                                                        <td align="center" valign="middle">
        <?php
        echo $this->Html->link('Edit', '/look_ups/edit_project_qualities/' . $id, array('class' => 'btn btn-success sticky_success open-popup-link'));
        ?>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                    $i++;
                                                endforeach;
                                            endif;
                                            ?>
                                        </table>                                          

<?php
echo $this->Html->link('Add', '/look_ups/add_project_qualities/', array('class' => 'btn btn-success sticky_success open-popup-link'));
?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

