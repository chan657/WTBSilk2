<?php
$this->Html->addCrumb('My Fetch Area', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->element('FetchAreas/top_menu');
?>


<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Fetch Area</h4>
          
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('TravelFetchTable', array( 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )
                    ),ARRAY('controller' => 'admin', 'action' => 'fetch_hotels')
                        );
           
                ?> 
             
                <div class="row" id="search_panel_controls">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Supplier:</label>
                        <?php echo $this->Form->input('supplier_id', array('type' => 'select', 'options' => $TravelSuppliers, 'empty' => '--Select--', 'value' => $supplier_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Fetch Type:</label>
                        <?php echo $this->Form->input('type_id', array('type' => 'select', 'options' => array('1' => 'Hotel','2' => 'Country','3' => 'City'), 'empty' => '--Select--', 'value' => $type_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Fetch By:</label>
                        <?php echo $this->Form->input('user_id', array('options' => $users, 'empty' => '--Select--', 'value' => $user_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('country_id', array('options' => $SupplierCountries, 'empty' => '--Select--', 'value' => $country_id)); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('city_id', array('options' => $SupplierCities, 'empty' => '--Select--', 'value' => $city_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Status</label>
                        <?php echo $this->Form->input('status', array('options' => array('1' => 'OK', '2' => 'ERROR'), 'empty' => '--Select--', 'value' => $status)); ?>
                    </div>
                   
                    

                    <div class="col-sm-3 col-xs-6">
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        // echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
<?php echo $this->Form->end(); ?>
            </div>
          
            <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr>
                        <th data-toggle="true">Id</th>
                        <th data-hide="phone">Supplier</th>
                        <th data-hide="phone">Date</th>
                        <th data-hide="phone">Fetched Type</th>
                        <th data-hide="phone">Fetched By</th>
                       
                        <th data-hide="phone">Country</th>
                        <th data-hide="phone">City</th>
                        <th data-hide="phone">Fetched Volume</th>
                        <th data-hide="phone">Inserted Volume</th>
                        <th data-hide="phone">Status</th>
                          
                    </tr>
                </thead>
                <tbody>
<?php

if (isset($TravelFetchTables) && count($TravelFetchTables) > 0):
    foreach ($TravelFetchTables as $TravelFetchTable):
        $id = $TravelFetchTable['TravelFetchTable']['id'];

        $type = $TravelFetchTable['TravelFetchTable']['type_id'];
        if($type == '1'){
            $type = 'Hotel';
            $isertVolumUrl = 'supplier_hotels/fetch_id:' . $id;
        }
        elseif($type == '2'){
            $type = 'Country';
            $isertVolumUrl = 'supplier_country/fetch_id:' . $id;
        }
        elseif($type == '3'){
            $type = 'City';
            $isertVolumUrl = 'supplier_city/fetch_id:' . $id;
        }
         $status = ($TravelFetchTable['TravelFetchTable']['status'] == '1') ? 'OK' : 'ERROR';
        ?>
                    <tr>
                        <td><?php echo $id;?></td>
                        <td><?php echo $this->Custom->getSupplierCode($TravelFetchTable['TravelFetchTable']['supplier_id']); ?></td>
                        <td><?php echo $TravelFetchTable['TravelFetchTable']['created']; ?></td>
                        <td><?php echo $type; ?></td>
                        <td><?php echo $this->Custom->Username($TravelFetchTable['TravelFetchTable']['user_id']); ?></td>
                        
                        <td><?php if($TravelFetchTable['TravelFetchTable']['country_id']) echo $this->Custom->getSupplierCountryName($TravelFetchTable['TravelFetchTable']['country_id']); ?></td>
                        <td><?php if($TravelFetchTable['TravelFetchTable']['city_id']) echo $this->Custom->getSupplierCityName($TravelFetchTable['TravelFetchTable']['city_id']);?></td>
                        <td><?php echo $TravelFetchTable['TravelFetchTable']['total_volume']; ?></td>
                        <td><?php  if($TravelFetchTable['TravelFetchTable']['inserted_volume'] > 0){ 
                               
                                echo $this->Html->link($TravelFetchTable['TravelFetchTable']['inserted_volume'], array('controller' => 'admin', 'action' => $isertVolumUrl), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')); 
                        }
                            else echo '&nbsp;0'; ?></td>
                        <td><?php echo $status; ?></td>
                    </tr>
        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="25" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
           


        </div>
    </div>
</div>
<?php
$this->Js->get('#TravelFetchTableCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_city_by_country_id/TravelFetchTable/country_id'
                ), array(
            'update' => '#TravelFetchTableCityId',
            'async' => true,
            'before' => 'loading("TravelFetchTableCityId")',
            'complete' => 'loaded("TravelFetchTableCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
?>