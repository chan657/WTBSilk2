<?php
$this->Html->addCrumb('My Properties', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//echo $this->element('Project/top_menu');
?>


<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Properties</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Property', '/properties/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('Property', array('controller' => 'properties', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'Property'));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('global_search', array('value' => $global_search, 'placeholder' => 'Type project name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Property Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                  
                </div>
                <div class="row" id="search_panel_controls">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('city_id', array('id' => 'city_id', 'type' => 'select', 'options' => $city, 'empty' => '--Select--', 'value' => $city_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Suburb:</label>
                        <?php echo $this->Form->input('suburb_id', array('type' => 'select', 'options' => $suburbs, 'empty' => '--Select--', 'value' => $suburb_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Area:</label>
                        <?php echo $this->Form->input('area_id', array('options' => $areas, 'empty' => '--Select--', 'value' => $area_id)); ?>
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
                        <th data-toggle="true">Property Name</th>
                       
                        <th data-hide="phone">Approval Status</th>
                        <th data-hide="phone">City</th>
                        <th data-hide="phone">Suburb</th>
                        <th data-hide="phone">Area</th>

                        <th data-hide="phone">Category</th>

                        <th data-sort-ignore="true" data-hide="phone">Unit Type</th>
                        <th data-sort-ignore="true" data-hide="phone">Type</th>
                        <th data-sort-ignore="true" data-hide="phone">Total Price</th>

                        <th data-sort-ignore="true" data-hide="all">Buildup Area</th>
                        <th data-sort-ignore="true" data-hide="all">Carpet Area</th>
                        <th data-sort-ignore="true" data-hide="all">Sourced From</th>
                        <th data-sort-ignore="true" data-hide="all">Sourced For</th>
                        <th data-sort-ignore="true" data-hide="all">Property Age</th>
                        <th data-sort-ignore="true" data-hide="all">Floor No.</th>
                        <th data-sort-ignore="true" data-hide="all">Total No. Of Floor</th>
                        <th data-sort-ignore="true" data-hide="all">Ownership</th>
                        <th data-sort-ignore="true" data-hide="all">Furnishing</th>
                        <th data-sort-ignore="true" data-hide="all">Bathroom</th>
                        <th data-sort-ignore="true" data-hide="all">Facing</th>
                        <th data-sort-ignore="true" data-hide="all">Parking</th>
                        <th data-sort-ignore="true" data-hide="all">Description</th>
                        <th data-sort-ignore="true" data-hide="phone">Action</th>        
                    </tr>
                </thead>
                <tbody>
<?php
$i = 1;
$secondary_city = '';

if (isset($properties) && count($properties) > 0):
    foreach ($properties as $property):
        $id = $property['Property']['id'];

       
        if ($property['Property']['prop_approved'] == 1)
            $approved = 'Approved';
        else
            $approved = 'Pending';
        ?>
                            <tr>
                                <td><?php echo $property['Property']['prop_name']; ?></td>
                                
                                <td><?php echo $approved ?></td>
                                <td><?php echo $property['City']['city_name']; ?></td>
                                <td><?php echo $property['Suburb']['suburb_name'] ?></td>
                                <td><?php echo $property['Area']['area_name']; ?></td>

                                <td><?php echo $property['Category']['value']; ?></td>

                                <td><?php echo $property['UnitType']['value']; ?></td>
                                <td><?php echo $property['Type']['value']; ?></td>
                                <td><?php echo $property['Property']['prop_total_price']; ?></td>

                                <td><?php echo $property['Property']['prop_builtup_area']; ?></td>
                                <td><?php echo $property['Property']['prop_carpet_area']; ?></td>

                                <td><?php echo $property['Property']['prop_sourced_from'] ?></td>
                                <td><?php echo $property['Property']['prop_sourced_for']; ?></td>
                                <td><?php echo $property['Property']['prop_age'] ?></td>
                                <td><?php echo $property['Property']['prop_floor'] ?></td>
                                <td><?php echo $property['Property']['prop_total_floors'] ?></td>
                                <td><?php echo $property['Property']['prop_ownership'] ?></td>
                                <td><?php echo $property['Property']['prop_furnishing']; ?></td>
                                <td><?php echo $property['Property']['prop_bathrooms'] ?></td>
                                <td><?php echo $property['Property']['prop_facing'] ?></td>
                                <td><?php echo $property['Property']['prop_parking'] ?></td>
                                <td><?php echo $property['Property']['prop_description'] ?></td>
                                <td width="10%" valign="middle" align="center">

                                    <?php
                                    if($property['Property']['prop_approved'] == 1){
                                    echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'properties', 'action' => 'edit', 'slug' => $property['Property']['prop_name'] . '-' . $property['City']['city_name'] , 'id' => base64_encode($id)), array('class' => 'act-ico', 'escape' => false));
                                     }

                                   // echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'properties', 'action' => 'view', 'slug' => $property['Property']['prop_name'] . '-' . $property['City']['city_name'], 'id' => base64_encode($id)), array('class' => 'act-ico', 'escape' => false));
                                    ?>
                                </td>

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
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Property', '/properties/add') ?></span>


        </div>
    </div>
</div>

<?php
$this->Js->get('#city_id')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Project/city_id'
                ), array(
            'update' => '#ProjectSuburbId',
            'async' => true,
            'before' => 'loading("ProjectSuburbId")',
            'complete' => 'loaded("ProjectSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#city_id')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_city', 'Project'
                ), array(
            'update' => '#ProjectAreaId',
            'async' => true,
            'before' => 'loading("ProjectAreaId")',
            'complete' => 'loaded("ProjectAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#ProjectSuburbId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_suburb/Project/suburb_id'
                ), array(
            'update' => '#ProjectAreaId',
            'async' => true,
            'before' => 'loading("ProjectAreaId")',
            'complete' => 'loaded("ProjectAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true,
            ))
        ))
);
$this->Js->get('#city_id')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_builder_by_cityid', 'Project'
                ), array(
            'update' => '#ProjectBuilderId',
            'async' => true,
            'before' => 'loading("ProjectBuilderId")',
            'complete' => 'loaded("ProjectBuilderId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true,
            ))
        ))
);
?>
