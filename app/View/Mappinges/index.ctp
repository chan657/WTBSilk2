<?php
$this->Html->addCrumb('Mapping', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->element('Mapping/top_menu');
?>    
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> Mapping</h4>

            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Mapping', '/mappinges/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('Mappinge', array('controller' => 'mappings', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));

                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'Mappinge'));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('search', array('value' => $search, 'placeholder' => 'Type country name / city name / hotel name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Supplier:</label>
                        <?php echo $this->Form->input('supplier_code', array('options' => $TravelSuppliers, 'empty' => '--Select--', 'value' => $supplier_code)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Type:</label>
                        <?php echo $this->Form->input('mapping_type', array('options' => $TravelMappingTypes, 'empty' => '--Select--', 'value' => $mapping_type)); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('country_wtb_code', array('options' => $TravelCountries, 'empty' => '--Select--', 'value' => $country_wtb_code)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Province:</label>
                        <?php echo $this->Form->input('province_id', array('options' => $Provinces, 'empty' => '--Select--', 'value' => $province_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('city_wtb_code', array('options' => $TravelCities, 'empty' => '--Select--', 'value' => $city_wtb_code)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Hotel:</label>
                        <?php echo $this->Form->input('hotel_wtb_code', array('options' => $TravelHotelLookups, 'empty' => '--Select--', 'value' => $hotel_wtb_code)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Status:</label>
                        <?php echo $this->Form->input('status', array('options' => $TravelActionItemTypes, 'empty' => '--Select--', 'value' => $status)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">WTB Status:</label>
                        <?php echo $this->Form->input('wtb_status', array('options' => array('1' => 'OK', '2' => 'ERROR'), 'empty' => '--Select--', 'value' => $wtb_status)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Active:</label>
                        <?php echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--', 'value' => $active)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Exclude:</label>
                        <?php echo $this->Form->input('exclude', array('options' => array('1' => 'TRUE', '2' => 'FALSE'), 'empty' => '--Select--', 'value' => $exclude)); ?>
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

            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="1000">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="7" class="nodis">Mapping Information</th>
                        <th data-group="group2" colspan="2">Country Code</th>
                        <th data-group="group3" colspan="2">City Code</th>
                        <th data-group="group4" colspan="2">Hotel Code</th>

                        <th data-group="group5" class="nodis">Action</th>
                    </tr>
                    <tr>
                        <th data-toggle="true" data-group="group1" data-sort-ignore="true" width="8%"><?php echo $this->Paginator->sort('TravelSupplier.supplier_name', 'Supplier');
                echo ($sort == 'TravelSupplier.supplier_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-group="group1" data-sort-ignore="true" width="10%"><?php echo $this->Paginator->sort('mapping_type', 'Type');
                echo ($sort == 'mapping_type') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="true" data-group="group1" data-sort-ignore="true" width="20%">Target</th>
                        <th data-hide="phone" data-group="group1" data-sort-ignore="true" width="5%"><?php echo $this->Paginator->sort('status', 'Status');
                echo ($sort == 'status') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-group="group1" data-sort-ignore="true" width="5%">WTB Status</th>
                        <th data-hide="phone" data-group="group1" width="5%" data-sort-ignore="true">Active?</th>
                        <th data-hide="phone" data-group="group1" width="5%"  data-sort-ignore="true">Excluded?</th>    
                        <th data-hide="all" data-group="group1" data-sort-ignore="true">Mapping Name</th>
                        <th data-hide="phone" data-group="group2" width="3%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group2" width="3%" data-sort-ignore="true">Supplier</th>
                        <th data-hide="phone" data-group="group3" width="3%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group3" width="3%" data-sort-ignore="true">Supplier</th>
                        <th data-hide="phone" data-group="group4" width="3%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group4" width="3%" data-sort-ignore="true">Supplier</th>
                        <th data-group="group5" data-hide="phone" data-sort-ignore="true">Action</th>        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //pr($Mappinges);
                    //die;
                    $target = '';
                    $id = '';
                    $province_id = '';

                    if (isset($Mappinges) && count($Mappinges) > 0):
                        foreach ($Mappinges as $Mappinge):
                            //$id = $Mappinge['Mappinge']['id'];
                            $mapping_type = $Mappinge['Mappinge']['mapping_type'];

                            if ($mapping_type == '1') { //country
                                $approved = $Mappinge['TravelCountrySupplier']['active'];
                                $excluded = $Mappinge['TravelCountrySupplier']['excluded'];
                                $wtb_status = $Mappinge['TravelCountrySupplier']['wtb_status'];
                                $silkrouters_status = $Mappinge['TravelCountrySupplier']['country_suppliner_status'];
                                $table = 'TravelCountrySupplier';
                                $id = $Mappinge['TravelCountrySupplier']['id'];
                                $mapping_name = $Mappinge['TravelCountrySupplier']['country_mapping_name'];
                            } elseif ($mapping_type == '2') { //city
                                $approved = $Mappinge['TravelCitySupplier']['active'];
                                $excluded = $Mappinge['TravelCitySupplier']['excluded'];
                                $wtb_status = $Mappinge['TravelCitySupplier']['wtb_status'];
                                $silkrouters_status = $Mappinge['TravelCitySupplier']['city_supplier_status'];
                                $table = 'TravelCitySupplier';
                                $id = $Mappinge['TravelCitySupplier']['id'];
                                $mapping_name = $Mappinge['TravelCitySupplier']['city_mapping_name'];
                            } elseif ($mapping_type == '3') { //Hotel
                                $approved = $Mappinge['TravelHotelRoomSupplier']['active'];
                                $excluded = $Mappinge['TravelHotelRoomSupplier']['excluded'];
                                $wtb_status = $Mappinge['TravelHotelRoomSupplier']['wtb_status'];
                                $province_id = $Mappinge['TravelHotelRoomSupplier']['province_id'];
                                $silkrouters_status = $Mappinge['TravelHotelRoomSupplier']['hotel_supplier_status'];
                                $table = 'TravelHotelRoomSupplier';
                                $id = $Mappinge['TravelHotelRoomSupplier']['id'];
                                $mapping_name = $Mappinge['TravelHotelRoomSupplier']['hotel_mapping_name'];
                            }
                            //echo $mapping_name;
                            if ($mapping_name <> '') {
                                $arr = explode('-', $mapping_name);
                                $target = end($arr);
                            }
                            // table of travel_action_item_types
                            $status = $Mappinge['Mappinge']['status'];
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
                            elseif ($status == '7')
                                $status_txt = 'Approved [R]';
                            else
                                $status_txt = 'Allocation';


                            if ($Mappinge['Mappinge']['exclude'] == '1')
                                $excluded_txt = 'TRUE';
                            else
                                $excluded_txt = 'FALSE';

                            if ($wtb_status == '1')
                                $wtb_status_txt = 'OK';
                            else
                                $wtb_status_txt = 'ERROR';
                            ?>
                            <tr>
                                <td class="tablebody"><?php echo $Mappinge['TravelSupplier']['supplier_name']; ?></td>
                                <td class="tablebody"><?php echo $Mappinge['TravelMappingType']['value']; ?></td>
                                <td class="tablebody"><?php if ($target <> '') echo $this->Html->link($target, array('controller' => 'mappinges', 'action' => 'view_mapping/' . $id . '/' . $table), array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)); ?></td>
                                <td class="tablebody"><?php echo $status_txt; ?></td>
                                <td class="tablebody"><?php echo $wtb_status_txt; ?></td>
                                <td class="tablebody"><?php echo $approved; ?></td>
                                <td class="tablebody"><?php echo $excluded_txt; ?></td>
                                <td class="tablebody"><?php echo $mapping_name; ?></td>
                                <td class="sub-tablebody"><?php echo $Mappinge['Mappinge']['country_wtb_code']; ?></td>
                                <td class="sub-tablebody"><?php echo $Mappinge['Mappinge']['country_supplier_code']; ?></td>
                                <td class="sub-tablebody"><?php echo $Mappinge['Mappinge']['city_wtb_code']; ?></td>
                                <td class="sub-tablebody"><?php echo $Mappinge['Mappinge']['city_supplier_code']; ?></td> 
                                <td class="sub-tablebody"><?php echo $Mappinge['Mappinge']['hotel_wtb_code']; ?></td>
                                <td class="sub-tablebody"><?php echo $Mappinge['Mappinge']['hotel_supplier_code']; ?></td>
                                <td width="10%" valign="middle" align="center">

                                    <?php
                                    if ($silkrouters_status == '2' && $wtb_status == '2') {
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'mappinges', 'action' => 'edit/' . $id . '/' . $table), array('class' => 'act-ico', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Mapping', 'escape' => false));
                                    } elseif ($silkrouters_status == '2' && $wtb_status == '1' && $approved == 'TRUE') {
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'mappinges', 'action' => 'de_active_mapping/' . $id . '/' . $table . '/FALSE'), array('class' => 'act-ico', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Deactivate Mapping', 'escape' => false));
                                    } elseif ($silkrouters_status == '2' && $wtb_status == '1' && $approved == 'FALSE') {
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'mappinges', 'action' => 'de_active_mapping/' . $id . '/' . $table . '/TRUE'), array('class' => 'act-ico', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Activate Mapping', 'escape' => false));
                                    }
                                    if ($excluded == 'TRUE')
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'mappinges', 'action' => 'exclude_mapping/' . $id . '/' . $table . '/FALSE'), array('class' => 'act-ico', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Exclude Mapping', 'escape' => false));
                                    else
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'mappinges', 'action' => 'exclude_mapping/' . $id . '/' . $table . '/TRUE'), array('class' => 'act-ico', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Include Mapping', 'escape' => false));

                                    /*
                                     * edit condition
                                     */
                                    if(in_array($province_id, $mapping_edit_permission)){
                                       
                                    if ($silkrouters_status == '2' && $wtb_status == '1') {
                                        if ($mapping_type == '1') { //country
                                            //echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'mappinges', 'action' => 'edit_supplier_country/' . $id), array('class' => 'act-ico open-popup-link add-btn', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Edit Country Supplier', 'escape' => false));
                                        } elseif ($mapping_type == '2') { //city
                                            //echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'mappinges', 'action' => 'edit_supplier_city/' . $id), array('class' => 'act-ico open-popup-link add-btn', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Edit City Supplier', 'escape' => false));
                                        } elseif ($mapping_type == '3') { //Hotel
                                            echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'mappinges', 'action' => 'edit_supplier_hotel/' . $id), array('class' => 'act-ico open-popup-link add-btn', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Edit Hotel Supplier', 'escape' => false));
                                        }
                                    }
                                    }
                                    ?>
                                </td>

                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="14" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Mapping', '/mappinges/add') ?></span>

        </div>
    </div>
</div>
<?php
$data = $this->Js->get('#SearchForm')->serializeForm(array('isForm' => true, 'inline' => true));


$this->Js->get('#MappingeCountryWtbCode')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_country_code/Mappinge/country_wtb_code'
                ), array(
            'update' => '#MappingeProvinceId',
            'async' => true,
            'before' => 'loading("MappingeProvinceId")',
            'complete' => 'loaded("MappingeProvinceId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);


$this->Js->get('#MappingeProvinceId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_city_code_by_province_id/Mappinge/province_id'
                ), array(
            'update' => '#MappingeCityWtbCode',
            'async' => true,
            'before' => 'loading("MappingeCityWtbCode")',
            'complete' => 'loaded("MappingeCityWtbCode")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#MappingeCityWtbCode')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_hotel_by_city/Mappinge/city_wtb_code'
                ), array(
            'update' => '#MappingeHotelWtbCode',
            'async' => true,
            'before' => 'loading("MappingeHotelWtbCode")',
            'complete' => 'loaded("MappingeHotelWtbCode")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
?>

