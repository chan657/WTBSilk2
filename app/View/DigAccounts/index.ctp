<?php
$this->Html->addCrumb('My Accounts', 'javascript:void(0);', array('class' => 'breadcrumblast'));
App::import('Model', 'User');
$attr = new User();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Accounts</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add/'.$base_id) ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">
                <?php
                echo $this->Form->create('DigAccount', array('controller' => 'dig_accounts', 'action' => 'index','class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">
<?php echo $this->Form->input('base_website_url', array('value' => $base_website_url, 'placeholder' => 'Base Name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Account Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>
                    </div>
                </div>
                <!-- <div class="row" id="search_panel_controls">
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
<?php echo $this->Form->input('city_status', array('options' => array('1' => 'Active', '2' => 'Inactive'), 'empty' => '--Select--', 'value' => $city_status)); ?>
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
                 </div>-->
<?php echo $this->Form->end(); ?>
            </div>
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="9">Account Information</th>                                                                     
                        <th data-group="group3" colspan="8">Account Logistics</th>
                        <th data-group="group4" colspan="3">Account Status</th>
                        <th data-group="group5" class="nodis">Action</th>
                    </tr>
                    <tr>  
                        <th data-toggle="phone" data-sort-ignore="true"  data-group="group1"><?php echo $this->Paginator->sort('id', 'Account Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true"  data-group="group1"><?php echo $this->Paginator->sort('DigBase.base_website_url', 'Base Name'); echo ($sort == 'DigBase.base_website_url') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true"  data-group="group1">Person Name</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Used By</th>     
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Managed By</th>

                        
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Example Profile URL</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Description</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Comment</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Instructions</th>


                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Email</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">User</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Credential</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Profile URL</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Public URL</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">PP</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Followed By</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Following</th>

                        <th data-hide="phone" data-sort-ignore="true" data-group="group4">System Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group4">Usage Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group4">Active?</th>

                        <th data-group="group5" data-hide="phone" data-sort-ignore="true" width="7%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   // pr($DigAccounts);
                    if (isset($DigAccounts) && count($DigAccounts) > 0):
                        foreach ($DigAccounts as $DigAccount):
                            $id = $DigAccount['DigAccount']['id'];
                            if($DigAccount['DigAccount']['account_status'] == '1')
                                $status = 'Submitted';
                            elseif($DigAccount['DigAccount']['account_status'] == '2')
                                $status = 'Approved';
                            elseif($DigAccount['DigAccount']['account_status'] == '3')
                                $status = 'Returned';
                            elseif($DigAccount['DigAccount']['account_status'] == '4')
                                $status = 'Change Submitted';
                            elseif($DigAccount['DigAccount']['account_status'] == '8')
                                $status = 'De-activated';
                            ?>
                            <tr> 
                                <td><?php echo $id; ?></td>
                                <td><?php echo $DigAccount['DigBase']['base_website_url']; ?></td>
                                <td><?php echo $DigAccount['DigPerson']['person_name']; ?></td>
                                <td><?php if($DigAccount['DigAccount']['account_team_id']>0)echo $DigAccount['DigUsedByTeam']['channel_name']; else echo 'All Teams'; ?></td>                                
                                <td><?php echo $DigAccount['DigUsedByPerson']['fname'].' '.$DigAccount['DigUsedByPerson']['lname']; ?></td>
                                
                                <td><?php echo $DigAccount['DigAccount']['account_ex_profile_url']; ?></td>
                                <td><?php echo $DigAccount['DigAccount']['account_description']; ?></td>
                                <td><?php echo $DigAccount['DigAccount']['account_usage_comment']; ?></td>
                                <td><?php echo $DigAccount['DigAccount']['account_instructions']; ?></td>


                                <td><?php echo $DigAccount['DigAccount']['account_parm1']; ?></td>
                                <td><?php echo $DigAccount['DigAccount']['account_parm2']; ?></td>
                                <td><?php echo $DigAccount['DigAccount']['account_parm3']; ?></td>
                                <td><?php if($DigAccount['DigAccount']['account_profile_url']) echo $this->Html->link('Click Here', $DigAccount['DigAccount']['account_profile_url'], array('target' => '_blank')); ?></td>
                                <td><?php if($DigAccount['DigAccount']['account_public_url']) echo $this->Html->link('Click Here', $DigAccount['DigAccount']['account_public_url'], array('target' => '_blank')); ?></td>                                
                                <td><?php echo $DigAccount['BasePP']['value']; ?></td>
                                <td><?php echo $DigAccount['DigAccount']['total_followers']; ?></td>
                                <td><?php echo $DigAccount['DigAccount']['total_following']; ?></td>

                                <td><?php echo $status; ?></td>
                                <td><?php echo $DigAccount['DigAccountUsage']['value']; ?></td>
                                <td><?php echo $DigAccount['DigAccount']['active']; ?></td>
                                <td>
                                    <?php
                                    //echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'dig_accounts', 'action' => 'edit', 'slug' => $DigAccount['DigPerson']['person_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                    echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'dig_accounts', 'action' => 'edit', 'slug' => $DigAccount['DigPerson']['person_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
                                    echo $this->Html->link('<span class="icon-list"></span>', '/dig_accounts/account_edit/' . $id, array('class' => 'act-ico','target' => '_blank', 'escape' => false));
                                   ?>                               
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="22" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Account', '/dig_accounts/add/'.$base_id) ?></span>

        </div>
    </div>
</div>