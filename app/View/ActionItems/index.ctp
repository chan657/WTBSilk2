<?php
$this->Html->addCrumb('My Actions', 'javascript:void(0);', array('class' => 'breadcrumblast'));

if ($this->Session->read("role_id") == '15')
    echo $this->element('Action/accounts_menu');
else
    echo $this->element('Action/top_menu');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Actions</h4>
<!--<span class="badge badge-circle add-client nomrgn">
<i class="icon-plus" ></i> <?php echo $this->Html->link('Add Client', '/lead/add'); ?></span>-->
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('ActionItem', array('controller' => 'action_items', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'ActionItens'));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('global_search', array('placeholder' => 'Type client or builer or project name')); ?>
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
                        <?php echo $this->Form->input('action_item_level_id', array('options' => $action_level, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Action Type:</label>
                        <?php echo $this->Form->input('type_id', array('options' => $action_type, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Last Action Date:</label>
                        <?php echo $this->Form->input('created', array('id' => 'date', 'type' => 'text')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Last Action Source::</label>
                        <?php echo $this->Form->input('action_item_source', array('options' => array(), 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Last Action By:</label>
                        <?php echo $this->Form->input('created_by_id', array('options' => array(), 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Last Action Status:</label>
                        <?php echo $this->Form->input('lead_status', array('options' => $status, 'empty' => '--Select--')); ?>
                    </div>


                    <div class="col-sm-3 col-xs-6 spacer">
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        // echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr class="footable-group-row" style="display:none;">
                        <th data-group="group1" colspan="8" class="nodis">Action Information</th>
                        <th data-group="group2" colspan="6">Action Interests</th>
                        <th data-group="group3" colspan="6">Action Logistics</th>
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
                        <th data-group="group1" data-hide="phone" width="7%" valign="middle" align="left">Current Status</th>
                        <th data-group="group1" data-hide="phone" width="7%" valign="middle" align="left">Next By</th>
                        <th data-group="group1" data-hide="phone" width="5%" valign="middle" align="left">SC No.</th>



                        <th data-group="group3" data-sort-ignore="true" data-hide="all" align="left">Phone Office</th>
                        <th data-group="group3" data-sort-ignore="true" data-hide="all" align="left">Primary Manager</th>
                        <th data-group="group3" data-sort-ignore="true" data-hide="all" align="left">Secondary Manager</th>
                        <th data-group="group3" data-sort-ignore="true" data-hide="all" align="left">Associate</th>
                        <th data-group="group3" data-sort-ignore="true" data-hide="all" align="left">Reason for return</th>
                        <th data-group="group3" data-sort-ignore="true" data-hide="all" align="left">Farther details on return</th>

                        <th data-group="group4" data-sort-ignore="true" width="6%" data-hide="phone" valign="middle" align="center">Action</th>        
                    </tr>
                </thead>
                <tbody>
                    <?php
//pr($leads);
                    $i = 1;
                    $about = '';
                    if (isset($actionitems) && count($actionitems) > 0):
                        foreach ($actionitems as $actionitem):
                            $id = $actionitem['ActionItem']['id'];
                            if ($actionitem['Lead']['lead_fname'] <> '')
                                $about = $actionitem['Lead']['lead_fname'] . ' ' . $actionitem['Lead']['lead_lname'];
                            else if ($actionitem['ActionBuilder']['builder_name'] <> '')
                                $about = $actionitem['ActionBuilder']['builder_name'];
                            else if ($actionitem['ActionProject']['project_name'] <> '')
                                $about = $actionitem['ActionProject']['project_name'];
                            else if ($actionitem['BuilderContact']['builder_contact_name'] <> '')
                                $about = $actionitem['BuilderContact']['builder_contact_name'];
                            else if ($actionitem['ActionItem']['project_contact_id'] <> '')
                                $about = 'Project Contact- ' . $actionitem['ActionItem']['project_contact_id'];
                            else if ($actionitem['ActionItem']['event_id'] <> '')
                                $about = 'Activity Id - ' . $actionitem['ActionItem']['event_id'];
                            else if ($actionitem['ActionItem']['project_unit_id'] <> '')
                                $about = $actionitem['ProjectUnit']['unit_name'];
                            else if ($actionitem['ActionItem']['builder_legalname_id'] <> '')
                                $about = $actionitem['BuilderLegalName']['builder_legal_names_name'];
                            else if ($actionitem['ActionItem']['project_legalname_id'] <> '')
                                $about = $actionitem['ProjectBuilderLegalName']['builder_legal_names_name'];
                            else if ($actionitem['ActionItem']['marketing_partner_id'] <> '')
                                $about = $actionitem['MarketingPartner']['marketing_partner_display_name'];
                            else if ($actionitem['ActionItem']['deal_id'] <> '')
                                $about = $actionitem['DealClient']['lead_fname'] . ' ' . $actionitem['DealClient']['lead_lname'];
                            else if ($actionitem['ActionItem']['owner_id'] <> '')
                                $about = $actionitem['Owner']['owner_name'];
                            else if ($actionitem['ActionItem']['consultant_id'] <> '')
                                $about = $actionitem['Consultant']['consultant_name'];
                            else if ($actionitem['ActionItem']['property_id'] <> '')
                                $about = $actionitem['Property']['prop_name'];
                            ?>
                            <tr>
                                <td class="tablebody" valign="middle" align="left"><?php echo $actionitem['ActionItem']['parent_action_item_id']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $id; ?></td>                    
                                <td class="tablebody" valign="middle" align="left"><?php echo $actionitem['ActionItemLevel']['level']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $about; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $actionitem['ActionItem']['action_item_active']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo date('d/m/Y', strtotime($actionitem['ActionItem']['created'])); ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $actionitem['Role']['role_name']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $actionitem['LastActionBy']['fname'] . ' ' . $actionitem['LastActionBy']['lname']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $actionitem['ActionStatus']['value']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $actionitem['NextActionBy']['fname'] . ' ' . $actionitem['NextActionBy']['lname']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $actionitem['ActionItem']['screen_no']; ?></td>

                                <td class="sub-tablebody"><?php echo $actionitem['PhoneOfficer']['fname'] . ' ' . $actionitem['PhoneOfficer']['mname'] . ' ' . $actionitem['PhoneOfficer']['lname']; ?></td>
                                <td class="sub-tablebody"><?php echo $actionitem['PrimaryManage']['fname'] . ' ' . $actionitem['PrimaryManage']['lname']; ?></td>
                                <td class="sub-tablebody"><?php echo $actionitem['SecondaryManage']['fname'] . ' ' . $actionitem['SecondaryManage']['lname']; ?></td>
                                <td class="sub-tablebody"><?php echo $actionitem['Associate']['fname'] . ' ' . $actionitem['Associate']['mname'] . ' ' . $actionitem['Associate']['lname']; ?></td>
                                <td class="sub-tablebody"><?php echo $returns[$actionitem['ActionItem']['lookup_return_id']]; ?></td>
                                <td class="sub-tablebody"><?php echo $actionitem['ActionItem']['other_return']; ?></td>




                                <td align="center" valign="middle">



                                    <?php
                                    if ($actionitem['ActionItem']['type_id'] == '7' && $actionitem['ActionItem']['action_item_level_id'] == '9') {
                                        echo $this->Html->link('<span class="icon-list"></span>', '/action_items/even_action/' . $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));

                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/action_items/edit_reimbursement/' . $actionitem['ActionItem']['event_id'], array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                                    } else if ($actionitem['ActionItem']['action_item_level_id'] == '9' && $actionitem['ActionItem']['type_id'] == '6') {
                                        echo '';
                                    } else if (($actionitem['ActionItem']['action_item_status'] == '21' || $actionitem['ActionItem']['action_item_status'] == '17') && $actionitem['ActionItem']['action_item_level_id'] == '15') {
                                        echo $this->Html->link('<span class="icon-list"></span>', '/action_items/report_transaction/' . $id . '/' . $actionitem['ActionItem']['deal_id'], array('class' => 'act-ico open-popup-link', 'escape' => false, 'data-placement' => "left", 'title' => "Report A Transaction", 'data-toggle' => "tooltip"));
                                    } else if ($actionitem['ActionItem']['action_item_status'] == '22' && $actionitem['ActionItem']['action_item_level_id'] == '15') {
                                        echo $this->Html->link('<span class="icon-list"></span>', '/action_items/action_approve/' . $id . '/' . $actionitem['ActionItem']['deal_id'], array('class' => 'act-ico', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip", 'target' => '_blank'));
                                    } else if ($actionitem['ActionItem']['action_item_status'] == '7' && $actionitem['ActionItem']['action_item_level_id'] == '15') {
                                        echo $this->Html->link('<span class="icon-list"></span>', '/action_items/action_submission_approve/' . $id . '/' . $actionitem['ActionItem']['deal_id'], array('class' => 'act-ico', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip", 'target' => '_blank'));
                                    } else if ($actionitem['ActionItem']['type_id'] != '8' || $actionitem['ActionItem']['action_item_level_id'] == '1' || $actionitem['ActionItem']['action_item_level_id'] == '10') {
                                        echo $this->Html->link('<span class="icon-list"></span>', '/action_items/add/' . $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                                    }






                                    if ($actionitem['ActionItem']['action_item_level_id'] == '2' || $actionitem['ActionItem']['action_item_level_id'] == '6') {
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'builders', 'action' => 'edit', 'slug' => $actionitem['ActionBuilder']['builder_name'], 'id' => base64_encode($actionitem['ActionItem']['builder_id']) . '_' . $id), array('class' => 'act-ico', 'escape' => false, 'target' => '_blank'));
                                    }
                                    if ($actionitem['ActionItem']['action_item_level_id'] == '16' || $actionitem['ActionItem']['action_item_level_id'] == '6') { // owner
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'owners', 'action' => 'edit', 'slug' => $actionitem['Owner']['owner_name'], 'id' => base64_encode($actionitem['ActionItem']['owner_id']) . '_' . $id), array('class' => 'act-ico', 'escape' => false, 'target' => '_blank'));
                                    }
                                    if ($actionitem['ActionItem']['action_item_level_id'] == '17' || $actionitem['ActionItem']['action_item_level_id'] == '6') { // consultant
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'consultants', 'action' => 'edit', 'slug' => $actionitem['Consultant']['consultant_name'], 'id' => base64_encode($actionitem['ActionItem']['consultant_id']) . '_' . $id), array('class' => 'act-ico', 'escape' => false, 'target' => '_blank'));
                                    }
                                    if ($actionitem['ActionItem']['action_item_level_id'] == '18' || $actionitem['ActionItem']['action_item_level_id'] == '6') { // property
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'properties', 'action' => 'edit', 'slug' => $actionitem['Property']['prop_name'], 'id' => base64_encode($actionitem['ActionItem']['property_id']) . '_' . $id), array('class' => 'act-ico', 'escape' => false, 'target' => '_blank'));
                                    }
                                    if ($actionitem['ActionItem']['action_item_level_id'] == '3') {
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'projects', 'action' => 'edit', 'slug' => $actionitem['ActionProject']['project_name'] . '-' . $actionitem['ActionBuilder']['builder_name'], 'id' => base64_encode($actionitem['ActionItem']['project_id']) . '_' . $id), array('class' => 'act-ico', 'escape' => false, 'target' => '_blank'));
                                    }
                                    if ($actionitem['ActionItem']['action_item_level_id'] == '5') { // Builder Contact
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'builder_contacts', 'action' => 'edit', 'slug' => $actionitem['BuilderContact']['builder_contact_name'], 'id' => base64_encode($actionitem['ActionItem']['builder_contact_id']) . '_' . $id), array('class' => 'act-ico open-popup-link add-btn', 'escape' => false));
                                    }
                                    if (($actionitem['ActionItem']['action_item_level_id'] == '1' || $actionitem['ActionItem']['action_item_level_id'] == '10') && $actionitem['ActionItem']['type_id'] <> '18') {
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'leads', 'action' => 'edit', 'slug' => $actionitem['Lead']['lead_fname'] . '-' . $actionitem['Lead']['lead_lname'], 'id' => base64_encode($actionitem['ActionItem']['lead_id']) . '_' . $id), array('class' => 'act-ico', 'escape' => false, 'target' => '_blank'));
                                    }
                                    if (($actionitem['ActionItem']['action_item_level_id'] == '15') && $actionitem['ActionItem']['type_id'] == '18') {
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/leads/action_transaction_edit/' . $actionitem['ActionItem']['deal_id'] . '_' . $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false));
                                    }
                                    if ($actionitem['ActionItem']['action_item_level_id'] == '11') {
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/projects/edit_unit/' . $actionitem['ActionItem']['project_unit_id'] . '_' . $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false));
                                    }
                                    if ($actionitem['ActionItem']['action_item_level_id'] == '14') { // marketing partner
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'marketing_partners', 'action' => 'edit', 'slug' => $actionitem['MarketingPartner']['marketing_partner_display_name'], 'id' => base64_encode($actionitem['ActionItem']['marketing_partner_id']) . '_' . $id), array('class' => 'act-ico', 'escape' => false));
                                    }
                                    if ($actionitem['ActionItem']['action_item_level_id'] == '7') {
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/projects/edit_contact/' . $actionitem['ActionItem']['project_contact_id'] . '_' . $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false));
                                    }
                                    if ($actionitem['ActionItem']['action_item_level_id'] == '12') { // builder legal name
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/builder_legal_names/edit/' . base64_encode($actionitem['ActionItem']['builder_legalname_id']) . '_' . $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false));
                                    }
                                    ?>


                                </td>
                            </tr>

        <?php
        $i++;
    endforeach;
    ?>

                        <?php echo $this->element('paginate'); ?>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

