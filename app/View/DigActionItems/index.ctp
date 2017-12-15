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
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Actions</h4>

            
        </div>
        <div class="panel panel-default">
            
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr class="footable-group-row" style="display:none;">
                        <th data-group="group1" colspan="7" class="nodis">Action Information</th>
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
                        <th data-group="group1" data-hide="phone" width="7%" valign="middle" align="left">Current Type</th>
                        <th data-group="group1" data-hide="phone" width="7%" valign="middle" align="left">Next By</th>
                        
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
                    if (isset($DigActionItems) && count($DigActionItems) > 0):
                        foreach ($DigActionItems as $DigActionItem):
                            $id = $DigActionItem['DigActionItem']['id'];
                            if ($DigActionItem['DigActionItem']['base_id'])
                                $about = $DigActionItem['DigBase']['base_website_url'];
                            
                            ?>
                            <tr>
                                <td class="tablebody" valign="middle" align="left"><?php echo $DigActionItem['DigActionItem']['parent_action_item_id']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $id; ?></td>                    
                                <td class="tablebody" valign="middle" align="left"><?php echo $DigActionItem['DigActionItemLevel']['value']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $about; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $DigActionItem['DigActionItem']['action_item_active']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo date('d/m/Y', strtotime($DigActionItem['DigActionItem']['created'])); ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $DigActionItem['DigRole']['role_name']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $attr->Username($DigActionItem['DigActionItem']['created_by']); ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $DigActionItem['DigActionType']['value']; ?></td>
                                <td class="tablebody" valign="middle" align="left"><?php echo $attr->Username($DigActionItem['DigActionItem']['next_action_by']); ?></td>
                               

                                <td class="sub-tablebody"><?php echo $DigActionItem['LookupReturn']['value']; ?></td>
                                <td class="sub-tablebody"><?php echo $DigActionItem['DigActionItem']['other_return']; ?></td>

                                <td align="center" valign="middle">
                                    <?php
                                    if ($DigActionItem['DigActionItem']['level_id'] == '1') { // Base
                                        if ($DigActionItem['DigActionItem']['type_id'] <> '3')
                                        echo $this->Html->link('<span class="icon-list"></span>', '/dig_action_items/submit_action/' . $id, array('class' => 'act-ico open-popup-link add-btn', 'escape' => false, 'data-placement' => "left", 'title' => "Action", 'data-toggle' => "tooltip"));
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'dig_bases', 'action' => 'edit/'.$DigActionItem['DigActionItem']['base_id'] . '_' . $id), array('class' => 'act-ico', 'escape' => false, 'target' => '_blank'));
                                    }
                                 
                                    ?>
                                </td>
                            </tr>

                            <?php
                            $i++;
                        endforeach;

                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="20" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

