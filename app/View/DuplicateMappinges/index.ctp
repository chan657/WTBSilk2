<?php
$this->Html->addCrumb('Duplicate Mapping', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->element('Mapping/top_menu');
?>    
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span>Duplicate Mapping</h4>

           
            <!--<span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>-->
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('Mappinge', array('controller' => 'agents', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'Mappinge'));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('hotel_wtb_code', array('value' => $hotel_wtb_code, 'placeholder' => 'Type hotel code', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Hotel Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Supplier:</label>
                        <?php echo $this->Form->input('supplier_code', array('options' => $TravelSuppliers, 'empty' => '--Select--', 'value' => $supplier_code)); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('country_wtb_code', array('options' => $TravelCountries, 'empty' => '--Select--', 'value' => $country_wtb_code)); ?>
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
                        <label for="un_member">Exclude:</label>
                        <?php echo $this->Form->input('exclude', array('options' => array('1' => 'True','2' => 'False'), 'empty' => '--Select--', 'value' => $exclude)); ?>
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

            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="5" class="nodis">Duplicate Information</th>
                        
                        <th data-group="group2" colspan="2">City Code</th>
                        <th data-group="group3" colspan="2">Hotel Code</th>
                       
                    </tr>
                    <tr>
                        <th data-toggle="true" data-group="group1" width="15%">Duplicate About</th>
                        <th data-toggle="true" data-group="group1" width="15%">Duplicate Reference</th>
                        <th data-hide="phone" data-group="group1" width="8%">Duplicate Type</th>
                        <th data-hide="phone" data-group="group1" width="8%">Duplicate Status</th>                           
                        <th data-hide="all" data-group="group1" data-sort-ignore="true">Rejection</th>
                       
                        <th data-hide="phone" data-group="group2" width="8%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group2" width="8%" data-sort-ignore="true">Supplier</th>
                        <th data-hide="phone" data-group="group3" width="8%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group3" width="8%" data-sort-ignore="true">Supplier</th>
                           
                    </tr>
                </thead>
                <tbody>
<?php


//pr($DuplicateMappinges);


if (isset($DuplicateMappinges) && count($DuplicateMappinges) > 0):
    foreach ($DuplicateMappinges as $DuplicateMappinge):
        $id = $DuplicateMappinge['DuplicateMappinge']['id'];
        
 
        // table of travel_action_item_types
        $status = $DuplicateMappinge['DuplicateMappinge']['status'];
        if($status == '1')
            $status_txt = 'Submitted For Approval';
        elseif($status == '2')
            $status_txt = 'Approved';
        elseif($status == '3')
           $status_txt = 'Returned';
        elseif($status == '4')
           $status_txt = 'Change Submitted';
        elseif($status == '5')
           $status_txt = 'Rejection';
        elseif($status == '6')
           $status_txt = 'Request For Allocation';
        else
            $status_txt = 'Allocation'; 
        
       
     
        
        if($DuplicateMappinge['DuplicateMappinge']['mapping_type'] == '2'){
            $duplicate_referencce = $DuplicateMappinge['DuplicateTravelCitySupplier']['city_mapping_name'];
            $type = 'Duplicate City';
        }
        elseif($DuplicateMappinge['DuplicateMappinge']['mapping_type'] == '3'){
            $duplicate_referencce = $DuplicateMappinge['DuplicateTravelHoelSupplier']['hotel_mapping_name'];
            $type = 'Duplicate Hotel';
        }
        
        
        ?>
                            <tr>
                                <td class="tablebody"><?php echo $DuplicateMappinge['DuplicateMappinge']['mapping_name']; ?></td>
                                <td class="tablebody"><?php echo $duplicate_referencce; ?></td>
                                <td class="tablebody"><?php echo $type; ?></td>
                                <td class="tablebody"><?php echo $status_txt; ?></td>                                                     
                                <td class="tablebody"><?php echo $DuplicateMappinge['DuplicateMappinge']['description']; ?></td>                               
                                <td class="sub-tablebody"><?php echo $DuplicateMappinge['DuplicateMappinge']['city_wtb_code']; ?></td>
                                <td class="sub-tablebody"><?php echo $DuplicateMappinge['DuplicateMappinge']['city_supplier_code']; ?></td> 
                                <td class="sub-tablebody"><?php echo $DuplicateMappinge['DuplicateMappinge']['hotel_wtb_code'];; ?></td>
                                <td class="sub-tablebody"><?php echo $DuplicateMappinge['DuplicateMappinge']['hotel_supplier_code']; ?></td>
                             
                

                            </tr>
        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="9" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>
            

        </div>
    </div>
</div>
<?php
/*
 * Get sates by country code
 */
$this->Js->get('#MappingeCountryWtbCode')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_country/Mappinge/country_wtb_code'
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

