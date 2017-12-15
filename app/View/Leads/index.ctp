<?php
$this->Html->addCrumb('My Clients', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->element('Lead/top_menu');
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Clients</h4>
            <span class="badge badge-circle add-client nomrgn">
                <i class="icon-plus" ></i> <?php echo $this->Html->link('Add Client', '/leads/add'); ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('Lead', array('controller' => 'Lead', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'Lead'));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('global_search', array('value' => $global_search, 'placeholder' => 'Type client or buider or project name or contact no.', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Client Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('city_id', array('options' => $city, 'empty' => '--Select--', 'value' => $search_city_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Suburb:</label>
                        <?php echo $this->Form->input('lead_suburb1', array('options' => $suburbs, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Area:</label>
                        <?php echo $this->Form->input('lead_areapreference1', array('options' => $areas, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Builder:</label>
                        <?php echo $this->Form->input('builder_id', array('options' => $builder, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Project:</label>
                        <?php echo $this->Form->input('project_id', array('options' => $project, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Unit:</label>
                        <?php echo $this->Form->input('lead_unit_id_1', array('options' => $unit, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Project Type:</label>
                        <?php echo $this->Form->input('lead_typeofprojectpreference1', array('options' => $type_preference, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Segment:</label>
                        <?php echo $this->Form->input('lead_segment', array('options' => $segment, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Importance:</label>
                        <?php echo $this->Form->input('lead_importance', array('options' => $importance, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Urgency:</label>
                        <?php echo $this->Form->input('lead_urgency', array('options' => $urgencies, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Type:</label>
                        <?php echo $this->Form->input('lead_type', array('options' => $led_type, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Special:</label>
                        <?php echo $this->Form->input('lead_special_client_status', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Action Status:</label>
                        <?php echo $this->Form->input('lead_status', array('options' => $status, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Progress:</label>
                        <?php echo $this->Form->input('lead_progress', array('options' => $lead_progrss, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Channel:</label>
                        <?php echo $this->Form->input('lead_channel', array('options' => $channels, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Closure %:</label>
                        <?php echo $this->Form->input('lead_closureprobabilityinnext1Month', array('options' => $closureprobabilities, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Primary:</label>
                        <?php echo $this->Form->input('lead_managerprimary', array('options' => $primary_manager, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Secondary:</label>
                        <?php echo $this->Form->input('lead_managersecondary', array('options' => $primary_manager, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Associate:</label>
                        <?php echo $this->Form->input('lead_associate', array('options' => $associate, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Phone Officer:</label>
                        <?php echo $this->Form->input('lead_phoneofficer', array('options' => $phone_officer, 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Source:</label>
                        <?php echo $this->Form->input('lead_source', array('options' => $source, 'empty' => '--Select--')); ?>
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
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="4" class="nodis">Client Information</th>
                        <th data-group="group2" colspan="7">Client Preference</th>
                        <th data-group="group3" colspan="2">Client Logistics</th>
                        <th data-group="group4" class="nodis">Client Action</th>
                    </tr>
                    <tr>
                        <th data-group="group1" data-toggle="true" width="14%" valign="middle" align="left">Client Name</th>
                        <th data-group="group1" width="5%" valign="middle" align="left">Arrival Date</th>
                        <th data-group="group1" width="5%" valign="middle" align="left">Status</th>
                        <th data-group="group1" width="6%" valign="middle" align="left">Closure %</th>


                        <th data-group="group2" data-sort-ignore="true" width="1%" data-hide="phone" align="left">Suburb</th>
                        <th data-group="group2" data-sort-ignore="true" width="1%" data-hide="phone" align="left">Area</th>
                        <th data-group="group2" data-sort-ignore="true" width="8%" data-hide="phone" align="left">Builder</th>
                        <th data-group="group2" data-sort-ignore="true" width="8%" data-hide="phone" align="left">Project</th>
                        <th data-group="group2" data-sort-ignore="true" width="1%" data-hide="phone" align="left">Unit</th>
                        <th data-group="group2" data-sort-ignore="true" width="1%" data-hide="phone" align="left">Project Type</th>
                        <th data-group="group2" data-sort-ignore="true" width="3%" data-hide="phone" align="left">Budget</th>

                        <th data-group="group3" data-sort-ignore="true" data-hide="all" align="left">Primary Manager </th>
                        <th data-group="group3" data-sort-ignore="true" data-hide="all" align="left">Secondary Manager</th>



                        <th data-group="group4" data-sort-ignore="true" width="7%" data-hide="phone" valign="middle" align="center">Action</th>        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //pr($leads);
                    $i = 1;
                    if (isset($leads) && count($leads) > 0):
                        foreach ($leads as $lead):
                            $id = $lead['Lead']['id'];
                            ?>
                            <tr>
                                <td class="tablebody" valign="middle" align="left"><?php echo $lead['Lead']['lead_fname'] . ' ' . $lead['Lead']['lead_lname']; ?></td>     
                                <td class="tablebody" valign="middle" align="left"><?php echo date('d/m/Y', strtotime($lead['Lead']['created'])); ?></td>                
                                <td class="tablebody" valign="middle" align="left"><?php echo $lead['Status']['status']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $lead['ClosurProbability']['value']; ?></td>


                                <td data-value="yes_UN" class="sub-tablebody"><?php echo $lead['Suburb']['suburb_name']; ?></td>
                                <td data-value="yes_UN" class="sub-tablebody"><?php echo $lead['AreaPreference']['area_name']; ?></td>
                                <td data-value="yes_UN" class="sub-tablebody"><?php echo $lead['Builder']['builder_name']; ?></td>
                                <td data-value="yes_UN" class="sub-tablebody"><?php echo $lead['Project']['project_name']; ?></td>
                                <td data-value="yes_UN" class="sub-tablebody"><?php echo $lead['Unit']['value']; ?></td>
                                <td data-value="yes_UN" class="sub-tablebody"><?php echo $lead['ProjectType']['value']; ?></td>
                                <td data-value="yes_UN" class="sub-tablebody"><?php echo $lead['Lead']['lead_budget'] . ' ' . $lead['courrency']['value']; ?></td>

                                <td data-value="yes_UN" class="sub-tablebody"><?php echo $lead['PrimaryManage']['fname'] . ' ' . $lead['PrimaryManage']['lname']; ?></td>
                                <td data-value="yes_UN" class="sub-tablebody"><?php echo $lead['SecondaryManage']['fname'] . ' ' . $lead['SecondaryManage']['lname']; ?></td>

                                <td align="center" valign="middle">



                                    <?php
                                    if ($lead['Lead']['lead_status'] == '4') {
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'leads', 'action' => 'action_transaction', $id), array('class' => 'act-ico', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));

                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'leads', 'action' => 'edit', 'slug' => $lead['Lead']['lead_fname'] . '-' . $lead['Lead']['lead_lname'] . '-' . $lead['City']['city_name'], 'id' => base64_encode($id)), array('class' => 'act-ico', 'escape' => false, 'data-placement' => "left", 'title' => "Edit", 'data-toggle' => "tooltip"));
                                    }

                                    echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'leads', 'action' => 'view', 'slug' => $lead['Lead']['lead_fname'] . '-' . $lead['Lead']['lead_lname'] . '-' . $lead['City']['city_name'], 'id' => base64_encode($id)), array('class' => 'act-ico', 'escape' => false, 'data-placement' => "left", 'title' => "View", 'data-toggle' => "tooltip"));

                                    // echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'leads','action' => 'action',$id), array('class' => 'act-ico open-popup-link add-btn','escape' => false,'data-placement' => "left", 'title' => "Action",'data-toggle' => "tooltip"));
                                    ?>
                                </td>
                            </tr>

                            <?php
                            $i++;
                        endforeach;
                        ?>

                        <?php echo $this->element('paginate'); ?>
                        <?php
                    else:
                        echo '<tr><td colspan="14" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client">
                <i class="icon-plus" ></i> <?php echo $this->Html->link('Add Client', '/leads/add'); ?></span>
        </div>
    </div>
</div>



<?php
$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_project_by_city/Lead'
                ), array(
            'update' => '#LeadProjectId',
            'async' => true,
            'before' => 'loading("LeadProjectId")',
            'complete' => 'loaded("LeadProjectId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Lead/city_id'
                ), array(
            'update' => '#LeadLeadSuburb1',
            'async' => true,
            'before' => 'loading("LeadLeadSuburb1")',
            'complete' => 'loaded("LeadLeadSuburb1")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_city', 'Lead'
                ), array(
            'update' => '#LeadLeadAreapreference1',
            'async' => true,
            'before' => 'loading("LeadLeadAreapreference1")',
            'complete' => 'loaded("LeadLeadAreapreference1")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#LeadCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_builder_by_cityid', 'Lead'
                ), array(
            'update' => '#LeadBuilderId',
            'async' => true,
            'before' => 'loading("LeadBuilderId")',
            'complete' => 'loaded("LeadBuilderId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true,
            ))
        ))
);
$data = $this->Js->get('#SearchForm')->serializeForm(array('isForm' => true, 'inline' => true));

$this->Js->get('#LeadLeadSuburb1')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_suburb/Lead/lead_suburb1'
                ), array(
            'update' => '#LeadLeadAreapreference1',
            'async' => true,
            'before' => 'loading("LeadLeadAreapreference1")',
            'complete' => 'loaded("LeadLeadAreapreference1")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
// echo $this->Js->writeBuffer(); 
?>




