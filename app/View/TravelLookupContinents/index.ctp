<?php $this->Html->addCrumb('My Continents', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Continents</h4>
                    <?php if ($this->Session->read('role_id') == '64') {  ?>          
                        <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Continent', '/travel_lookup_continents/add') ?></span>
                    <?php } ?>
        <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>

        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">
                <?php
                echo $this->Form->create('TravelLookupContinent', array('controller' => 'travel_lookup_continents', 'action' => 'index','class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">
                        <?php echo $this->Form->input('continent_name', array('value' => $continent_name, 'placeholder' => 'Type continent name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Continent Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>
                    </div>
                </div>
                <div class="row" id="search_panel_controls">
                                      
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Status:</label>
                        <?php echo $this->Form->input('continent_status', array('options' => array('1' => 'Active', '2' => 'Inactive'), 'empty' => '--Select--', 'value' => $continent_status)); ?>
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
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
            <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="100">
                <thead>
                     <tr class="footable-group-row">
                        <th data-group="group1" colspan="2" style="text-align:center;">Continent Information</th>                        
                        <th data-group="group2" colspan="3" style="text-align:center;">Continent Status</th>                       
                        <th data-group="group3" class="nodis">&nbsp;</th>
                    </tr>
                    <tr>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('id', 'Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('continent_name', 'Continent');echo ($sort == 'continent_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>";?></th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1">WTB Continent Code</th>                                          
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Local</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">WTB</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Active?</th>                                                
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Action</th>                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                  //  pr($TravelCountries);
                    if (isset($TravelLookupContinents) && count($TravelLookupContinents) > 0):
                        foreach ($TravelLookupContinents as $TravelLookupContinent):
                            $id = $TravelLookupContinent['TravelLookupContinent']['id'];
                            if ($TravelLookupContinent['TravelLookupContinent']['continent_status'] == '1') {
                                $status = 'OK';
                                $tb_class = 'active';
                            } else {
                                $status = 'ERROR';
                                $tb_class = 'inactive';
                            }
                            if ($TravelLookupContinent['TravelLookupContinent']['wtb_status'] == '1') {
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
                                <td><?php echo $TravelLookupContinent['TravelLookupContinent']['continent_name']; ?></td>
                                <td><?php echo $TravelLookupContinent['TravelLookupContinent']['continent_code']; ?></td>                                                              
                                <td class="<?php echo $tb_class; ?>"><?php echo $status; ?></td>
                                <td class="<?php echo $wtb_class; ?>"><?php echo $wtb_status; ?></td>
                                <td><?php echo $TravelLookupContinent['TravelLookupContinent']['active']; ?></td>
                                
                                <td width="10%" valign="middle" align="center">

                                    <?php if ($this->Session->read('role_id') == '64') {

                                    if ($TravelLookupContinent['TravelLookupContinent']['continent_status'] == '1' && $TravelLookupContinent['TravelLookupContinent']['wtb_status'] == '1' && $TravelLookupContinent['TravelLookupContinent']['active'] == 'TRUE') {
                                       // echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'de_active', 'slug' => $TravelLookupContinent['TravelLookupContinent']['continent_name'] , 'id' => $id, 'type' => '1'), array('class' => 'act-ico', 'escape' => false));
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'de_active/' . $id.'/FALSE'), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Deactivate', 'escape' => false));
                                    }
                                    elseif($TravelLookupContinent['TravelLookupContinent']['continent_status'] == '1' && $TravelLookupContinent['TravelLookupContinent']['wtb_status'] == '1' && $TravelLookupContinent['TravelLookupContinent']['active'] == 'FALSE'){
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'de_active/' . $id.'/TRUE'), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Activate', 'escape' => false));
                                    }
                                    if ($TravelLookupContinent['TravelLookupContinent']['continent_status'] == '1' && $TravelLookupContinent['TravelLookupContinent']['wtb_status'] == '2') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'retry/' . $id), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    }
                                    if($TravelLookupContinent['TravelLookupContinent']['wtb_status'] == '1'){
                                    echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'edit', 'slug' => $TravelLookupContinent['TravelLookupContinent']['continent_name'] , 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                    
                                    }
                                    echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'edit', 'slug' => $TravelLookupContinent['TravelLookupContinent']['continent_name'] , 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
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


