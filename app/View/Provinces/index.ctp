<?php $this->Html->addCrumb('My Provinces', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Provinces</h4>
                    <?php if ($this->Session->read('role_id') == '64') {  ?>             
                        <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Province', '/provinces/add') ?></span>
                    <?php } ?>                        
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">
                <?php
                echo $this->Form->create('Province', array('controller' => 'provinces', 'action' => 'index','class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">
                        <?php echo $this->Form->input('name', array('value' => $name, 'placeholder' => 'Type province name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Province Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
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
                        <label for="un_member">Status:</label>
                        <?php echo $this->Form->input('status', array('options' => array('1' => 'OK', '2' => 'ERROR'), 'empty' => '--Select--', 'value' => $status)); ?>
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
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
            <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="1000">
                <thead>
                     <tr class="footable-group-row">
                        <th data-group="group1" colspan="4" class="nodis">Province Information</th>                        
                        <th data-group="group2" colspan="3">Province Status</th>                       
                        <th data-group="group3" class="nodis">Province Action</th>
                    </tr>
                    <tr>           
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('id', 'Province Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('name', 'Province'); echo ($sort == 'name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>                        
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('continent_name', 'Continent'); echo ($sort == 'continent_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>                   
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('country_name', 'Country'); echo ($sort == 'country_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>                                                                
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">WTB Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Active</th>                                                
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Action</th>                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($Provinces) && count($Provinces) > 0):
                        foreach ($Provinces as $Province):
                            $id = $Province['Province']['id'];
                            if ($Province['Province']['status'] == '1') {
                                $status = 'OK';
                                $tb_class = 'active';
                            } else {
                                $status = 'ERROR';
                                $tb_class = 'inactive';
                            }
                            if ($Province['Province']['wtb_status'] == '1') {
                                $wtb_status = 'OK';
                                $wtb_class = 'active';
                            }
                            else{
                                $wtb_status = 'ERROR';
                                $wtb_class = 'inactive';
                            }
                            ?>
                            <tr>
                              
                                <td><?php echo $id; ?></td>
                                <td><?php echo $Province['Province']['name']; ?></td>                                
                                <td><?php echo $Province['Province']['continent_name']; ?></td>
                                <td><?php echo $Province['Province']['country_name']; ?></td>                             
                              
                                <td class="<?php echo $tb_class; ?>"><?php echo $status; ?></td>
                                <td class="<?php echo $wtb_class; ?>"><?php echo $wtb_status; ?></td>
                                <td><?php echo $Province['Province']['active']; ?></td>
                                
                                <td width="10%" valign="middle" align="center">

                                    <?php if ($this->Session->read('role_id') == '64') {
                                    if ($Province['Province']['status'] == '1' && $Province['Province']['wtb_status'] == '1' && $Province['Province']['active'] == 'TRUE') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'provinces', 'action' => 'de_active/' . $id.'/FALSE'), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Deactivate', 'escape' => false));
                                    }
                                    elseif ($Province['Province']['status'] == '1' && $Province['Province']['wtb_status'] == '1' && $Province['Province']['active'] == 'FALSE') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'provinces', 'action' => 'de_active/' . $id.'/TRUE'), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Activate', 'escape' => false));
                                    }
                                    if ($Province['Province']['status'] == '1' && $Province['Province']['wtb_status'] == '2') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'provinces', 'action' => 'retry/' . $id), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    }
                                    if($Province['Province']['wtb_status'] == '1')
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'provinces', 'action' => 'edit', 'slug' => $Province['Province']['name'] . '-' . $Province['TravelLookupContinent']['continent_name']. '-' . $Province['TravelCountry']['country_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                    echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'provinces', 'action' => 'edit', 'slug' => $Province['Province']['name'] . '-' . $Province['TravelLookupContinent']['continent_name']. '-' . $Province['TravelCountry']['country_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
                                    }
                                    ?>
                                </td>
                                

                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="13" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>


        </div>
    </div>
</div>
<?php
$this->Js->get('#ProvinceContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/Province/continent_id'
                ), array(
            'update' => '#ProvinceCountryId',
            'async' => true,
            'before' => 'loading("ProvinceCountryId")',
            'complete' => 'loaded("ProvinceCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
?>

