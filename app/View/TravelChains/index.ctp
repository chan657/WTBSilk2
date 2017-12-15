<?php $this->Html->addCrumb('My Chains', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Chains</h4>
                    <?php if ($this->Session->read('role_id') == '64') {  ?>             
                        <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Chain', '/travel_chains/add') ?></span>
                    <?php } ?>            
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('TravelChain', array('controller' => 'travel_chains', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 

                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('chain_name', array('value' => $chain_name, 'placeholder' => 'Type chain name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Chain Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('chain_home_country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'value' => $chain_country)); ?>
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
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="9" class="nodis">Chain Information</th>
                        <th data-group="group2" colspan="3">Chain Status</th>
                        <th data-group="group3" class="nodis">Chain Action</th>
                    </tr>
                    <tr>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('id', 'Chain Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('chain_name', 'Chain'); echo ($sort == 'chain_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Owner Company</th>                      
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('TravelCity.city_name', 'City'); echo ($sort == 'TravelCity.city_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('TravelCountry.country_name', 'Country'); echo ($sort == 'TravelCountry.country_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Presence</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Segment</th>
                        <th data-hide="phone"data-sort-ignore="true" data-group="group1">Top Chain</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Description</th>
                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">WTB Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Active</th>

                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Action</th>   

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($TravelChains) && count($TravelChains) > 0):
                        foreach ($TravelChains as $TravelChain):
                            $id = $TravelChain['TravelChain']['id'];
                            if ($TravelChain['TravelChain']['chain_status'] == '1') {
                                $status = 'OK';
                                $tb_class = 'active';
                            } else {
                                $status = 'ERROR';
                                $tb_class = 'inactive';
                            }

                            if ($TravelChain['TravelChain']['wtb_status'] == '1') {
                                $wtb_status = 'OK';
                                $wtb_class = 'active';
                            } else {
                                $wtb_status = 'ERROR';
                                $wtb_class = 'inactive';
                            }
                            ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $TravelChain['TravelChain']['chain_name']; ?></td>
                                <td><?php echo $TravelChain['TravelChain']['chain_owner_company']; ?></td>
                                <td><?php echo $TravelChain['TravelCity']['city_name']; ?></td>
                                <td><?php echo $TravelChain['TravelCountry']['country_name']; ?></td>
                                <td><?php echo $TravelChain['TravelLookupChainPresence']['value']; ?></td>
                                <td><?php echo $TravelChain['TravelLookupChainSegment']['value']; ?></td>
                                <td><?php echo $TravelChain['TravelChain']['top_chain']; ?></td>
                                <td><?php echo $TravelChain['TravelChain']['description']; ?></td>
                                <td class="<?php echo $tb_class; ?>"><?php echo $status; ?></td>
                                <td class="<?php echo $wtb_class; ?>"><?php echo $wtb_status; ?></td>
                                <td><?php echo $TravelChain['TravelChain']['chain_active']; ?></td>

                                <td width="10%" valign="middle" align="center">

                                    <?php if ($this->Session->read('role_id') == '64') {
                                    if ($TravelChain['TravelChain']['chain_status'] == '1' && $TravelChain['TravelChain']['wtb_status'] == '1' && $TravelChain['TravelChain']['chain_active'] == 'TRUE') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_chains', 'action' => 'de_active/' . $id.'/FALSE'), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Deactivate', 'escape' => false));
                                    }
                                    elseif ($TravelChain['TravelChain']['chain_status'] == '1' && $TravelChain['TravelChain']['wtb_status'] == '1' && $TravelChain['TravelChain']['chain_active'] == 'FALSE') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_chains', 'action' => 'de_active/' . $id.'/TRUE'), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Activate', 'escape' => false));
                                    }
                                    if ($TravelChain['TravelChain']['chain_status'] == '1' && $TravelChain['TravelChain']['wtb_status'] == '2') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_chains', 'action' => 'retry/' . $id), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    }
                                    if($TravelChain['TravelChain']['wtb_status'] == '1')
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'travel_chains', 'action' => 'edit', 'slug' => $TravelChain['TravelChain']['chain_name'] . '-' . $TravelChain['TravelCountry']['country_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                    echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'travel_chains', 'action' => 'edit', 'slug' => $TravelChain['TravelChain']['chain_name'] . '-' . $TravelChain['TravelCountry']['country_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
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

