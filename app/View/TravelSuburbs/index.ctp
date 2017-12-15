<?php $this->Html->addCrumb('My Suburbs', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Suburbs</h4>
                    <?php if ($this->Session->read('role_id') == '64') {  ?>               
                        <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Suburb', '/travel_suburbs/add') ?></span>
                    <?php } ?>            
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('TravelSuburb', array('controller' => 'travel_suburbs', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 

                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('name', array('value' => $name, 'placeholder' => 'Type suburb name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Suburb Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
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
                        <label for="un_member">Top Neighborhood:</label>
                        <?php echo $this->Form->input('top_neighborhood', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--', 'value' => $top_neighborhood)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Active:</label>
                        <?php echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--', 'value' => $active)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Status:</label>
                        <?php echo $this->Form->input('status', array('options' => array('1' => 'Active', '2' => 'Inactive'), 'empty' => '--Select--', 'value' => $status)); ?>
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
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="500">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="7" class="nodis">Suburb Information</th>
                        <th data-group="group2" colspan="3">Suburb Status</th>
                        <th data-group="group3" class="nodis">Suburb Action</th>
                    </tr>
                    <tr>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('id', 'Suburb Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('name', 'Suburb'); echo ($sort == 'name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('continent_name', 'Continent'); echo ($sort == 'continent_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('TravelCountry.country_name', 'Country'); echo ($sort == 'TravelCountry.country_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('TravelCity.city_name', 'City'); echo ($sort == 'TravelCity.city_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>           

                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Top Neighborhood</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Description</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Status</th> 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">WTB Status</th> 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Active</th>                                                
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Action</th>   

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($TravelSuburbs) && count($TravelSuburbs) > 0):
                        foreach ($TravelSuburbs as $TravelSuburb):
                            $id = $TravelSuburb['TravelSuburb']['id'];
                            if ($TravelSuburb['TravelSuburb']['status'] == '1') {
                                $status = 'OK';
                                $tb_class = 'active';
                            } else {
                                $status = 'ERROR';
                                $tb_class = 'inactive';
                            }

                            if ($TravelSuburb['TravelSuburb']['wtb_status'] == '1') {
                                $wtb_status = 'OK';
                                $wtb_class = 'active';
                            } else {
                                $wtb_status = 'ERROR';
                                $wtb_class = 'inactive';
                            }
                            ?>
                            <tr>
                               <td><?php echo $id; ?></td>
                                <td><?php echo $TravelSuburb['TravelSuburb']['name']; ?></td>
                                <td><?php echo $TravelSuburb['TravelSuburb']['continent_name']; ?></td>
                                <td><?php echo $TravelSuburb['TravelCountry']['country_name']; ?></td>
                                <td><?php echo $TravelSuburb['TravelCity']['city_name']; ?></td>

                                <td><?php echo $TravelSuburb['TravelSuburb']['top_neighborhood']; ?></td>
                                <td><?php echo $TravelSuburb['TravelSuburb']['description']; ?></td>
                                <td class="<?php echo $tb_class; ?>"><?php echo $status; ?></td>
                                <td class="<?php echo $wtb_class; ?>"><?php echo $wtb_status; ?></td>
                                <td><?php echo $TravelSuburb['TravelSuburb']['active']; ?></td>

                                <td width="10%" valign="middle" align="center">

                                    <?php if ($this->Session->read('role_id') == '64') {
                                    if ($TravelSuburb['TravelSuburb']['status'] == '1' && $TravelSuburb['TravelSuburb']['wtb_status'] == '1' && $TravelSuburb['TravelSuburb']['active'] == 'TRUE') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_suburbs', 'action' => 'de_active/' . $id.'/FALSE'), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Deactivate', 'escape' => false));
                                    }
                                    elseif ($TravelSuburb['TravelSuburb']['status'] == '1' && $TravelSuburb['TravelSuburb']['wtb_status'] == '1' && $TravelSuburb['TravelSuburb']['active'] == 'FALSE') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_suburbs', 'action' => 'de_active/' . $id.'/TRUE'), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Activate', 'escape' => false));
                                    }
                                    if ($TravelSuburb['TravelSuburb']['status'] == '1' && $TravelSuburb['TravelSuburb']['wtb_status'] == '2') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_suburbs', 'action' => 'retry/' . $id), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    }
                                    if($TravelSuburb['TravelSuburb']['wtb_status'] == '1')
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'travel_suburbs', 'action' => 'edit', 'slug' => $TravelSuburb['TravelSuburb']['name'] . '-' . $TravelSuburb['TravelCity']['city_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                    echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'travel_suburbs', 'action' => 'edit', 'slug' => $TravelSuburb['TravelSuburb']['name'] . '-' . $TravelSuburb['TravelCity']['city_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
                                    }
                                    ?>
                                </td>


                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="11" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>


        </div>
    </div>
</div>
<?php
$this->Js->get('#TravelSuburbContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/TravelSuburb/continent_id'
                ), array(
            'update' => '#TravelSuburbCountryId',
            'async' => true,
            'before' => 'loading("TravelSuburbCountryId")',
            'complete' => 'loaded("TravelSuburbCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#TravelSuburbCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_country_id/TravelSuburb/country_id'
                ), array(
            'update' => '#TravelSuburbCityId',
            'async' => true,
            'before' => 'loading("TravelSuburbCityId")',
            'complete' => 'loaded("TravelSuburbCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
?>
