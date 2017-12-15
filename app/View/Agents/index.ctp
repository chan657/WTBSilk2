<?php
$this->Html->addCrumb('My Agents', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->element('Agent/top_menu');
?>    
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Agents</h4>

            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Agent', '/agents/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('Agent', array('controller' => 'agents', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'Agent'));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('agent_name', array('value' => $agent_name, 'placeholder' => 'Type agent name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Agent Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('agent_incorporated_in_country', array('options' => $countries, 'empty' => '--Select--', 'value' => $agent_incorporated_in_country)); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('agent_primary_city', array('options' => $city, 'empty' => '--Select--', 'value' => $agent_primary_city)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Suburb:</label>
                        <?php echo $this->Form->input('agent_suburb', array('options' => $suburbs, 'empty' => '--Select--', 'value' => $agent_suburb)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Area:</label>
                        <?php echo $this->Form->input('agent_area', array('options' => $areas, 'empty' => '--Select--', 'value' => $agent_area)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Status:</label>
                        <?php echo $this->Form->input('agent_status', array('options' => $LookupAgentStatuses, 'empty' => '--Select--', 'value' => $agent_status)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Procurement:</label>
                        <?php echo $this->Form->input('agent_procurement_type', array('options' => $ProcurementTypes, 'empty' => '--Select--', 'value' => $agent_procurement_type)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Nature of Business:</label>
                        <?php echo $this->Form->input('agent_nature_of_business', array('options' => $NatureOfBusinesses, 'empty' => '--Select--', 'value' => $agent_nature_of_business)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Multicity:</label>
                        <?php echo $this->Form->input('agent_multicity', array('options' => $LookupValueStatuses, 'empty' => '--Select--', 'value' => $agent_multicity)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Business Type:</label>
                        <?php echo $this->Form->input('agent_business_type', array('options' => $AgentBusinessTypes, 'empty' => '--Select--', 'value' => $agent_business_type)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Source:</label>
                        <?php echo $this->Form->input('agent_source', array('options' => $AgentSourcees, 'empty' => '--Select--', 'value' => $agent_source)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">XML?</label>
                        <?php echo $this->Form->input('agent_xml', array('options' => $LookupValueStatuses, 'empty' => '--Select--', 'value' => $agent_xml)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Whitelabelling?</label>
                        <?php echo $this->Form->input('agent_whitelabel', array('options' => $LookupValueStatuses, 'empty' => '--Select--', 'value' => $agent_whitelabel)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Sales Manager:</label>
                        <?php echo $this->Form->input('primary_sales_manager', array('options' => array(), 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Operations Manager:</label>
                        <?php echo $this->Form->input('primary_opration_manager', array('options' => array(), 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Accounts Manager:</label>
                        <?php echo $this->Form->input('primary_accounts_manager', array('options' => array(), 'empty' => '--Select--')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Transactions Manager:</label>
                        <?php echo $this->Form->input('primary_transaction_manager', array('options' => array(), 'empty' => '--Select--')); ?>
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

                    <tr>
                        <th data-toggle="true" width="15%">Agent Name</th>
                        <th data-toggle="phone" width="7%">Approval Status</th>
                        <th data-hide="phone" width="5%">Procurement Type</th>
                        <th data-hide="phone" width="5%">Country</th>
                        <th data-hide="phone" width="5%">Primary City</th>  
                        <th data-hide="phone" width="13%">Nature of Business</th>
                        <th data-hide="phone" width="6%">Multicity Operations?</th>
                        <th data-hide="phone" width="10%">Website</th>
                        <th data-hide="all" data-sort-ignore="true">Corporate Address</th>
                        <th data-hide="all" data-sort-ignore="true">Secondary Cities</th>
                        <th data-hide="all" data-sort-ignore="true">Registration Note</th>
                        <th data-hide="all" data-sort-ignore="true">Description</th>    
                        <th data-hide="all" data-sort-ignore="true">Sales Manager</th>
                        <th data-hide="all" data-sort-ignore="true">Sales Manager</th>
                        <th data-hide="all" data-sort-ignore="true">Accounts Manager</th>
                        <th data-hide="all" data-sort-ignore="true">Transactions Manager</th>
                        <th data-hide="phone" data-sort-ignore="true" width="5%">Action</th>        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
//	pr($builders);
                    $secondary_city = '';

                    if (isset($Agents) && count($Agents) > 0):
                        foreach ($Agents as $Agent):
                            $id = $Agent['Agent']['id'];
                            if ($Agent['SecondaryCity']['city_name'])
                                $secondary_city .= $Agent['SecondaryCity']['city_name'] . ',';
                            if ($Agent['TertiaryCity']['city_name'])
                                $secondary_city .= $Agent['TertiaryCity']['city_name'] . ',';
                            if ($Agent['City4']['city_name'])
                                $secondary_city .= $Agent['City4']['city_name'] . ',';
                            if ($Agent['City5']['city_name'])
                                $secondary_city .= $Agent['City5']['city_name'] . ',';
                            if($Agent['Agent']['agent_multicity'])
                                $agent_multicity = 'Yes';
                            else 
                                $agent_multicity = 'No';
                            ?>
                            <tr>
                                <td class="tablebody"><?php echo $Agent['Agent']['agent_name']; ?></td>
                                <td class="tablebody"><?php echo $Agent['AgentStatus']['value']; ?></td>
                                <td class="tablebody"><?php echo $Agent['ProcurementType']['value']; ?></td>
                                <td class="tablebody"><?php echo $Agent['AgentCountry']['name']; ?></td>
                                <td class="tablebody"><?php echo $Agent['PrimaryCity']['city_name']; ?></td>
                                <td class="tablebody"><?php echo $Agent['AgentBusinessNature']['value']; ?></td>
                                <td class="tablebody"><?php echo $agent_multicity; ?></td>
                                <td class="tablebody"><?php echo $Agent['Agent']['agent_website']; ?></td>

                                
                                <td class="tablebody"><?php echo $Agent['Agent']['agent_corporate_address']; ?></td> 
                                <td class="tablebody"><?php echo $secondary_city; ?></td>
                                <td class="tablebody"><?php echo $Agent['Agent']['agent_registration_note']; ?></td>
                                <td class="tablebody"><?php echo $Agent['Agent']['agent_description']; ?></td>
                                <td class="tablebody">&nbsp;</td>
                                <td class="tablebody">&nbsp;</td>
                                <td class="tablebody">&nbsp;</td>
                                <td class="tablebody">&nbsp;</td>
                                <td width="10%" valign="middle" align="center">

        <?php
        if ($Agent['Agent']['agent_status'] == '1') {
            echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'agents', 'action' => 'action_transaction', $id), array('class' => 'act-ico open-popup-link', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
        }
        if ($Agent['Agent']['agent_approved'] == '1') {
            echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'agents', 'action' => 'edit', 'slug' => $Agent['Agent']['agent_name'] . '-' . $Agent['PrimaryCity']['city_name'], 'id' => base64_encode($id)), array('class' => 'act-ico', 'escape' => false, 'data-placement' => "left", 'title' => "Edit", 'data-toggle' => "tooltip"));
        }
        echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'agents', 'action' => 'view', 'slug' => $Agent['Agent']['agent_name'] . '-' . $Agent['PrimaryCity']['city_name'], 'id' => base64_encode($id)), array('class' => 'act-ico', 'escape' => false, 'data-placement' => "left", 'title' => "View", 'data-toggle' => "tooltip"));
        ?>
                                </td>

                            </tr>
    <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="10" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Agent', '/agents/add') ?></span>

        </div>
    </div>
</div>
<?php
/*
 * Get sates by country code
 */
$this->Js->get('#AgentAgentPrimaryCity')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Agent/agent_primary_city'
                ), array(
            'update' => '#AgentAgentSuburb',
            'async' => true,
            'before' => 'loading("AgentAgentSuburb")',
            'complete' => 'loaded("AgentAgentSuburb")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#AgentAgentSuburb')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_suburb/Agent/agent_suburb'
                ), array(
            'update' => '#AgentAgentArea',
            'async' => true,
            'before' => 'loading("AgentAgentArea")',
            'complete' => 'loaded("AgentAgentArea")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
?>

