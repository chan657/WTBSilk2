<?php
$this->Html->addCrumb('My Actions', 'javascript:void(0);', array('class' => 'breadcrumblast'));
/*
  if ($this->Session->read("role_id") == '15')
  echo $this->element('Action/accounts_menu');
  else
  echo $this->element('Action/top_menu');
 * 
 */
App::import('Model', 'User');
$attr = new User();

?>
        
    <div align="center" class="col-sm-12" style="font-size: 15px; font-family: sans-serif" >
    <p style="color: black; background-color: #f2d7d5"><strong>
       <?php if($msg_flag == 'Y'){ 
                echo $msg;
        }                
       ?>
     </strong></p>
    </div> 

<div class="row">
    <div class="col-sm-12">


        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Actions</h4>

            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('TravelActionItem', array('class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' =>
                    array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                    ))
                );
                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'TravelActionItens'));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('global_search', array('placeholder' => 'Action id or hotel name or mapping name')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Action Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        // echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                
                <div class="row" id="search_panel_controls">
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Action Level:</label>
                <?php echo $this->Form->input('level_id', array('options' => $action_level, 'empty' => '--Select--')); ?>
                    </div>
                   
                   
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Last Action By:</label>
                <?php echo $this->Form->input('created_by', array('options' => $user_list, 'empty' => '--Select--')); ?>
                    </div>
                  


                    <div class="col-sm-3 col-xs-6 spacer">
                        <label>&nbsp;</label>
                <?php
                echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm', 'name' => 'filter'));
                ?>

                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="500">
                <thead>
                    <tr class="footable-group-row" style="display:none;">
                        <th data-group="group1" colspan="11" class="nodis">Action Information</th>
                       
                        <th data-group="group3" colspan="3">Action Logistics</th>
                        <th data-group="group4" class="nodis">Action Action</th>
                    </tr>
                    <tr>
                        <th data-group="group1" data-toggle="true" width="5%" valign="middle" align="left">Parent Id</th>
                        <th data-group="group1" data-toggle="true" width="5%" valign="middle" align="left">Action Id</th>
                        <th data-group="group1" data-hide="phone" width="2%" valign="middle" align="left">Level</th>
                        <th data-group="group1" data-hide="phone" width="9%" valign="middle" align="left">About</th>
                        <th data-group="group1" data-hide="phone" width="3%" valign="middle" align="left">Active?</th>
                        <th data-group="group1" data-hide="phone" width="5%" valign="middle" align="left">Action Date</th>
                        <th data-group="group1" data-hide="phone" width="5%" valign="middle" align="left">Source</th>
                        <th data-group="group1" data-hide="phone" width="7%" valign="middle" align="left">Last By</th>
                        <th data-group="group1" data-hide="phone" width="7%" valign="middle" align="left">Current Type</th>
                        <th data-group="group1" data-hide="phone" width="7%" valign="middle" align="left">Next By</th>
                        <th data-group="group1" data-sort-ignore="true" data-hide="phone" width="5%" valign="middle" align="left">SC No.</th>

                        <th data-group="group3" data-sort-ignore="true" data-hide="all" align="left">Reason for return</th>
                        <th data-group="group3" data-sort-ignore="true" data-hide="all" align="left">Farther details on return</th>
                        <th data-group="group3" data-sort-ignore="true" data-hide="all" align="left">Reason for review</th>
                        
                        <th data-group="group4" data-sort-ignore="true" width="6%" data-hide="phone" valign="middle" align="center">Action</th>        
                    </tr>
                </thead>
                <tbody>
                    <?php
//pr($leads);
                    $i = 1;
                    $about = '';
                    if (isset($travel_actionitems) && count($travel_actionitems) > 0):
                        foreach ($travel_actionitems as $tarvel_actionitem):
                            $id = $tarvel_actionitem['TravelActionItem']['id'];
                            if ($tarvel_actionitem['TravelActionItem']['agent_id'])
                                $about = $tarvel_actionitem['Agent']['agent_name'];
                            elseif($tarvel_actionitem['TravelActionItem']['country_supplier_id'])
                                $about = $tarvel_actionitem['TravelCountrySupplier']['country_mapping_name'];
                            elseif($tarvel_actionitem['TravelActionItem']['city_supplier_id'])
                                $about = $tarvel_actionitem['TravelCitySupplier']['city_mapping_name'];
                            elseif($tarvel_actionitem['TravelActionItem']['hotel_supplier_id'])
                                $about = $tarvel_actionitem['TravelHotelRoomSupplier']['hotel_mapping_name'];
                            elseif($tarvel_actionitem['TravelActionItem']['duplicate_city_supplier_id'])
                                $about = $tarvel_actionitem['DuplicateMappinge']['mapping_name'];
                            elseif($tarvel_actionitem['TravelActionItem']['hotel_id'])
                                $about = $tarvel_actionitem['TravelHotelLookup']['hotel_name'];
                            ?>
                            <tr>
                                <td class="tablebody" valign="middle" align="left"><?php echo $tarvel_actionitem['TravelActionItem']['parent_action_item_id']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $id; ?></td>                    
                                <td class="tablebody" valign="middle" align="left"><?php echo $tarvel_actionitem['TravelActionItemLevel']['value']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $about; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $tarvel_actionitem['TravelActionItem']['action_item_active']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo date('d/m/Y', strtotime($tarvel_actionitem['TravelActionItem']['created'])); ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $tarvel_actionitem['TravelRole']['role_name']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $attr->Username($tarvel_actionitem['TravelActionItem']['created_by']); ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $tarvel_actionitem['TravelActionType']['value']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $attr->Username($tarvel_actionitem['TravelActionItem']['next_action_by']); ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $tarvel_actionitem['TravelActionItem']['screen_no']; ?></td>

                                <td class="sub-tablebody"><?php echo $tarvel_actionitem['LookupReturn']['value']; ?></td>
                                <td class="sub-tablebody"><?php echo $tarvel_actionitem['TravelActionItem']['other_return']; ?></td>
                                <td class="sub-tablebody"><?php echo $tarvel_actionitem['TravelActionItem']['note']; ?></td>
                                
                                <td align="center" valign="middle">
                                    <?php
                                    if ($tarvel_actionitem['TravelActionItem']['level_id'] == '1') { // agent
                                        if ($tarvel_actionitem['TravelActionItem']['type_id'] <> '3')
                                        echo $this->Html->link('<span class="icon-list"></span>', '/travel_action_items/agent_action/' . $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'agents', 'action' => 'edit', 'slug' => $tarvel_actionitem['Agent']['agent_name'], 'id' => base64_encode($tarvel_actionitem['TravelActionItem']['agent_id']) . '_' . $id), array('class' => 'act-ico', 'escape' => false, 'target' => '_blank'));
                                    }
                                    elseif($tarvel_actionitem['TravelActionItem']['country_supplier_id'] && ($tarvel_actionitem['TravelActionItem']['type_id'] =='1' || $tarvel_actionitem['TravelActionItem']['type_id'] =='4' || $tarvel_actionitem['TravelActionItem']['type_id'] =='8')){
                                         echo $this->Html->link('<span class="icon-list"></span>', '/travel_action_items/submit_action/' . $id, array('class' => 'act-ico', 'escape' => false, 'target' => '_blank', 'data-placement' => "left", 'title' => "Edit", 'data-toggle' => "tooltip"));
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/mappinges/edit_supplier_country/' .$tarvel_actionitem['TravelActionItem']['country_supplier_id'].'_'. $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                   
                                    }
                                    elseif($tarvel_actionitem['TravelActionItem']['city_supplier_id'] && ($tarvel_actionitem['TravelActionItem']['type_id'] =='1' || $tarvel_actionitem['TravelActionItem']['type_id'] =='4' || $tarvel_actionitem['TravelActionItem']['type_id'] =='8')){
                                         echo $this->Html->link('<span class="icon-list"></span>', '/travel_action_items/submit_action/' . $id, array('class' => 'act-ico', 'escape' => false, 'target' => '_blank', 'data-placement' => "left", 'title' => "Edit", 'data-toggle' => "tooltip"));
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/mappinges/edit_supplier_city/' .$tarvel_actionitem['TravelActionItem']['city_supplier_id'].'_'. $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                   
                                    }
                                    elseif($tarvel_actionitem['TravelActionItem']['hotel_supplier_id'] && ($tarvel_actionitem['TravelActionItem']['type_id'] =='1' || $tarvel_actionitem['TravelActionItem']['type_id'] =='4' || $tarvel_actionitem['TravelActionItem']['type_id'] =='8' || $tarvel_actionitem['TravelActionItem']['type_id'] =='9')){
                                         echo $this->Html->link('<span class="icon-list"></span>', '/travel_action_items/submit_action/' . $id, array('class' => 'act-ico', 'escape' => false, 'target' => '_blank', 'data-placement' => "left", 'title' => "Edit", 'data-toggle' => "tooltip"));
                                        //echo $this->Html->link('<span class="icon-pencil"></span>', '/mappinges/edit_supplier_hotel/' .$tarvel_actionitem['TravelActionItem']['hotel_supplier_id'].'_'. $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                   
                                    }
                                    elseif($tarvel_actionitem['TravelActionItem']['country_supplier_id'] && $tarvel_actionitem['TravelActionItem']['type_id'] =='3'){
                                       //  echo $this->Html->link('<span class="icon-list"></span>', '/travel_action_items/submit_action/' . $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/mappinges/edit_supplier_country/' .$tarvel_actionitem['TravelActionItem']['country_supplier_id'].'_'. $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                   
                                    }
                                    elseif($tarvel_actionitem['TravelActionItem']['city_supplier_id'] && $tarvel_actionitem['TravelActionItem']['type_id'] =='3'){
                                        // echo $this->Html->link('<span class="icon-list"></span>', '/travel_action_items/submit_action/' . $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/mappinges/edit_supplier_city/' .$tarvel_actionitem['TravelActionItem']['city_supplier_id'].'_'. $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                   
                                    }
                                    elseif($tarvel_actionitem['TravelActionItem']['hotel_supplier_id'] && $tarvel_actionitem['TravelActionItem']['type_id'] =='3'){
                                         //echo $this->Html->link('<span class="icon-list"></span>', '/travel_action_items/submit_action/' . $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/mappinges/edit_supplier_hotel/' .$tarvel_actionitem['TravelActionItem']['hotel_supplier_id'].'_'. $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                   
                                    }
                                    elseif($tarvel_actionitem['TravelActionItem']['duplicate_city_supplier_id'] && $tarvel_actionitem['TravelActionItem']['level_id']=='5' && ($tarvel_actionitem['TravelActionItem']['type_id'] =='1' || $tarvel_actionitem['TravelActionItem']['type_id'] =='4')){
                                         echo $this->Html->link('<span class="icon-list"></span>', '/travel_action_items/duplicate_city_supplier_action/' . $id.'/'.$tarvel_actionitem['TravelActionItem']['duplicate_city_supplier_id'], array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/mappinges/edit_duplicate_supplier_city/' .$tarvel_actionitem['TravelActionItem']['duplicate_city_supplier_id'].'_'. $id, array('class' => 'act-ico', 'escape' => false, 'target' => '_blank', 'data-placement' => "left", 'title' => "Edit", 'data-toggle' => "tooltip"));
                   
                                    }
                                    elseif($tarvel_actionitem['TravelActionItem']['duplicate_city_supplier_id'] && $tarvel_actionitem['TravelActionItem']['level_id']=='6' && ($tarvel_actionitem['TravelActionItem']['type_id'] =='1' || $tarvel_actionitem['TravelActionItem']['type_id'] =='4')){
                                         echo $this->Html->link('<span class="icon-list"></span>', '/travel_action_items/duplicate_hotel_supplier_action/' . $id.'/'.$tarvel_actionitem['TravelActionItem']['duplicate_city_supplier_id'], array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/mappinges/edit_duplicate_supplier_hotel/' .$tarvel_actionitem['TravelActionItem']['duplicate_city_supplier_id'].'_'. $id, array('class' => 'act-ico', 'escape' => false, 'target' => '_blank', 'data-placement' => "left", 'title' => "Edit", 'data-toggle' => "tooltip"));
                   
                                    }
                                    elseif($tarvel_actionitem['TravelActionItem']['hotel_id'] && $tarvel_actionitem['TravelActionItem']['level_id']=='7'){
                                        if($tarvel_actionitem['TravelActionItem']['type_id'] =='2' || $tarvel_actionitem['TravelActionItem']['type_id'] =='4' || $tarvel_actionitem['TravelActionItem']['type_id'] =='1' || $tarvel_actionitem['TravelActionItem']['type_id'] =='9')
                                         echo $this->Html->link('<span class="icon-list"></span>', '/travel_action_items/hotel_action/' . $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/travel_hotel_lookups/edit/' .$tarvel_actionitem['TravelActionItem']['hotel_id'].'_'. $id, array('class' => 'act-ico', 'escape' => false, 'target' => '_blank', 'data-placement' => "left", 'title' => "Edit", 'data-toggle' => "tooltip"));
                   
                                    }
                                    ?>
                                </td>
                            </tr>

                            <?php
                            $i++;
                        endforeach;

                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="14" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

