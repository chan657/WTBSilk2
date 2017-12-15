<?php $this->Html->addCrumb('My Areas', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Areas</h4>
                    <?php if ($this->Session->read('role_id') == '64') {  ?>               
                        <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Area', '/travel_areas/add') ?></span>
                    <?php } ?>                        
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('TravelArea', array('controller' => 'travel_areas', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 

                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('area_name', array('value' => $area_name, 'placeholder' => 'Type area name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Area Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">
                    
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Continent:</label>
                        <?php echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'value' => $continent_id)); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'value' => $country_id)); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('city_id', array('options' => $TravelCities, 'empty' => '--Select--', 'value' => $city_id)); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Suburb:</label>
                        <?php echo $this->Form->input('suburb_id', array('options' => $TravelSuburbs, 'empty' => '--Select--', 'value' => $suburb_id)); ?>
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
            <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="500">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="8" class="nodis">Area Information</th>
                        <th data-group="group2" colspan="3">Area Status</th>
                        <th data-group="group3" class="nodis">Area Action</th>
                    </tr>
                    <tr>
                        <th data-toggle="true" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('id', 'Area Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('area_name', 'Area'); echo ($sort == 'area_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('suburb_name', 'Suburb'); echo ($sort == 'suburb_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('continent_name', 'Continent'); echo ($sort == 'continent_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('country_name', 'Country'); echo ($sort == 'country_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('city_name', 'City'); echo ($sort == 'city_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>                  

                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Top Area</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Description</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">WTB Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Active</th>

                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Action</th>   

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($TravelAreas) && count($TravelAreas) > 0):
                        foreach ($TravelAreas as $TravelArea):
                            $id = $TravelArea['TravelArea']['id'];
                            if ($TravelArea['TravelArea']['area_status'] == '1') {
                                $status = 'OK';
                                $tb_class = 'active';
                            } else {
                                $status = 'ERROR';
                                $tb_class = 'inactive';
                            }

                            if ($TravelArea['TravelArea']['wtb_status'] == '1') {
                                $wtb_status = 'OK';
                                $wtb_class = 'active';
                            } else {
                                $wtb_status = 'ERROR';
                                $wtb_class = 'inactive';
                            }
                            ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo str_replace('?', '', $TravelArea['TravelArea']['area_name']); ?></td>
                                <td><?php echo $TravelArea['TravelArea']['suburb_name']; ?></td>
                                <td><?php echo $TravelArea['TravelArea']['continent_name']; ?></td>
                                <td><?php echo $TravelArea['TravelArea']['country_name']; ?></td>
                                <td><?php echo $TravelArea['TravelArea']['city_name']; ?></td>

                                <td><?php echo $TravelArea['TravelArea']['top_area']; ?></td>
                                <td><?php echo $TravelArea['TravelArea']['area_description']; ?></td>
                                <td class="<?php echo $tb_class; ?>"><?php echo $status; ?></td>
                                <td class="<?php echo $wtb_class; ?>"><?php echo $wtb_status; ?></td>
                                <td><?php echo $TravelArea['TravelArea']['area_active']; ?></td>
                                
                                <td width="10%" valign="middle" align="center">

                                    <?php if ($this->Session->read('role_id') == '64') {
                                    if ($TravelArea['TravelArea']['area_status'] == '1' && $TravelArea['TravelArea']['wtb_status'] == '1' && $TravelArea['TravelArea']['area_active'] == 'TRUE') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_areas', 'action' => 'de_active/' . $id.'/FALSE'), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Deactivate', 'escape' => false));
                                    }
                                    elseif ($TravelArea['TravelArea']['area_status'] == '1' && $TravelArea['TravelArea']['wtb_status'] == '1' && $TravelArea['TravelArea']['area_active'] == 'FALSE') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_areas', 'action' => 'de_active/' . $id.'/TRUE'), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Activate', 'escape' => false));
                                    }
                                    if ($TravelArea['TravelArea']['area_status'] == '1' && $TravelArea['TravelArea']['wtb_status'] == '2') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_areas', 'action' => 'retry/' . $id), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    }
                                    if($TravelArea['TravelArea']['wtb_status'] == '1')
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'travel_areas', 'action' => 'edit', 'slug' => $TravelArea['TravelArea']['area_name'] . '-' . $TravelArea['TravelArea']['city_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                    echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'travel_areas', 'action' => 'edit', 'slug' => $TravelArea['TravelArea']['area_name'] . '-' . $TravelArea['TravelArea']['city_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
                                    }
                                    ?>
                                </td>


                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="12" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>


        </div>
    </div>
</div>
<?php
$data = $this->Js->get('#SearchForm')->serializeForm(array('isForm' => true, 'inline' => true));

$this->Js->get('#TravelAreaContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/TravelArea/continent_id'
                ), array(
            'update' => '#TravelAreaCountryId',
            'async' => true,
            'before' => 'loading("TravelAreaCountryId")',
            'complete' => 'loaded("TravelAreaCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#TravelAreaCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_country_id/TravelArea/country_id'
                ), array(
            'update' => '#TravelAreaCityId',
            'async' => true,
            'before' => 'loading("TravelAreaCityId")',
            'complete' => 'loaded("TravelAreaCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelAreaCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_suburb_by_country_id_and_city_id/TravelArea/country_id/city_id'
                ), array(
            'update' => '#TravelAreaSuburbId',
            'async' => true,
            'before' => 'loading("TravelAreaSuburbId")',
            'complete' => 'loaded("TravelAreaSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
?>
