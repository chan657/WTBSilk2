<?php $this->Html->addCrumb('My Suppliers', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Suppliers</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Supplier', '/travel_suppliers/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">
                <?php
                echo $this->Form->create('TravelSupplier', array('controller' => 'travel_suppliers', 'action' => 'index','class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">
                        <?php echo $this->Form->input('country_name', array('value' => $country_name, 'placeholder' => 'Type country name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Country Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>
                    </div>
                </div>
                <div class="row" id="search_panel_controls">
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Continent:</label>
                        <?php echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'value' => $continent_id)); ?>
                    </div>
                   
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Status:</label>
                        <?php echo $this->Form->input('country_status', array('options' => array('1' => 'Active', '2' => 'Inactive'), 'empty' => '--Select--', 'value' => $country_status)); ?>
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
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                     <tr class="footable-group-row">
                        <th data-group="group1" colspan="6" style="text-align:center;">Supplier Information</th>                        
                        <th data-group="group2" colspan="3" style="text-align:center;">Supplier Status</th>                       
                        <th data-group="group3" class="nodis">&nbsp;</th>
                    </tr>
                    <tr>                        
                        <th data-toggle="true"  data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('id', 'Supplier Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('supplier_name', 'Supplier'); echo ($sort == 'supplier_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('supplier_code', 'Supplier Code'); echo ($sort == 'supplier_code') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('continent_name', 'Continent'); echo ($sort == 'continent_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>                                                                  
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('country_name', 'Country'); echo ($sort == 'country_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>                                                                  
                        <th data-hide="phone"  data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('supplier_currency', 'Currency'); echo ($sort == 'supplier_currency') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>                                                                  
                       
                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">WTB Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Active</th>                                                
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Action</th>                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                  //  pr($TravelSuppliers);
                    if (isset($TravelSuppliers) && count($TravelSuppliers) > 0):
                        foreach ($TravelSuppliers as $TravelSupplier):
                            $id = $TravelSupplier['TravelSupplier']['id'];
                            if ($TravelSupplier['TravelSupplier']['country_status'] == '1') {
                                $status = 'OK';
                                $tb_class = 'active';
                            } else {
                                $status = 'ERROR';
                                $tb_class = 'inactive';
                            }
                            if ($TravelSupplier['TravelSupplier']['wtb_status'] == '1') {
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
                                <td><?php echo $TravelSupplier['TravelSupplier']['country_name']; ?></td>
                                <td><?php echo $TravelSupplier['TravelSupplier']['country_code']; ?></td>
                                <td><?php echo $TravelSupplier['TravelSupplier']['continent_name']; ?></td>                                                          
                               
                                <td><?php echo $TravelSupplier['TravelSupplier']['country_comment']; ?></td>
                                <td class="<?php echo $tb_class; ?>"><?php echo $status; ?></td>
                                <td class="<?php echo $wtb_class; ?>"><?php echo $wtb_status; ?></td>
                                <td><?php echo $TravelSupplier['TravelSupplier']['active']; ?></td>
                                
                                <td width="10%" valign="middle" align="center">

                                    <?php
                                    if ($TravelSupplier['TravelSupplier']['country_status'] == '1' && $TravelSupplier['TravelSupplier']['wtb_status'] == '1' && $TravelSupplier['TravelSupplier']['active'] == 'TRUE') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_countries', 'action' => 'de_active/' . $id.'/FALSE'), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Deactivate', 'escape' => false));
                                    }
                                    elseif($TravelSupplier['TravelSupplier']['country_status'] == '1' && $TravelSupplier['TravelSupplier']['wtb_status'] == '1' && $TravelSupplier['TravelSupplier']['active'] == 'FALSE') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_countries', 'action' => 'de_active/' . $id.'/TRUE'), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Activate', 'escape' => false));
                                    }
                                    if ($TravelSupplier['TravelSupplier']['country_status'] == '1' && $TravelSupplier['TravelSupplier']['wtb_status'] == '2') {

                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_countries', 'action' => 'retry/' . $id), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    }
                                    if($TravelSupplier['TravelSupplier']['wtb_status'] == '1')
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'travel_countries', 'action' => 'edit', 'slug' => $TravelSupplier['TravelSupplier']['country_name'] . '-' . $TravelSupplier['TravelSupplier']['continent_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                    echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'travel_countries', 'action' => 'edit', 'slug' => $TravelSupplier['TravelSupplier']['country_name'] . '-' . $TravelSupplier['TravelSupplier']['continent_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
                                    ?>
                                </td>
                                

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
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Supplier', '/travel_suppliers/add') ?></span>

        </div>
    </div>
</div>


