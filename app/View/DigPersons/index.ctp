<?php $this->Html->addCrumb('My Persons', 'javascript:void(0);', array('class' => 'breadcrumblast')); 
App::import('Model','User');
$attr = new User();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Persons</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Person', '/dig_persons/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">
                <?php
                echo $this->Form->create('DigPersons', array('controller' => 'dig_persons', 'action' => 'index','class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">
                        <?php echo $this->Form->input('person_name', array('value' => $person_name, 'placeholder' => 'Person Name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Person Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
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
                        <th data-group="group1" colspan="11">Person Information</th>                        
                        <th data-group="group2" colspan="4">Person Logistics</th>
                        <th data-group="group3" colspan="3">Person Status</th>
                        <th data-group="group4" class="nodis">Action</th>
                    </tr>
                    <tr>         
                        <th data-toggle="true" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('id', 'Person Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('person_name', 'Person Name'); echo ($sort == 'person_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone"  data-group="group1" data-sort-ignore="true">Type</th>
                        <th data-toggle="phone"  data-group="group1" data-sort-ignore="true">Location</th>
                        <th data-toggle="phone"  data-group="group1" data-sort-ignore="true">Industry</th>
                        <th data-hide="phone"  data-group="group1" data-sort-ignore="true">Profile Type</th>
                        <th data-hide="phone"  data-group="group1" data-sort-ignore="true">Used By (Team)</th>
                        <th data-hide="phone"  data-group="group1" data-sort-ignore="true">Used By (Person)</th>   
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Description</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Comment</th>    
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Instructions</th> 
                        
                        <th data-hide="phone"  data-group="group2" data-sort-ignore="true">Email</th>  
                        <th data-hide="phone"  data-group="group2" data-sort-ignore="true">Email Credential</th>
                        <th data-hide="phone"  data-group="group2" data-sort-ignore="true">User</th>
                        <th data-hide="phone"  data-group="group2" data-sort-ignore="true">User Credential</th>
                        
                        <th data-hide="phone"  data-group="group3" data-sort-ignore="true">System Status</th>
                        <th data-hide="phone"  data-group="group3" data-sort-ignore="true">Usage Status</th>
                        <th data-hide="phone"  data-group="group3" data-sort-ignore="true">Active?</th>
                  
                        <th data-group="group4" data-hide="phone" data-sort-ignore="true" width="7%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($DigPersons) && count($DigPersons) > 0):
                        foreach ($DigPersons as $DigPerson):
                            $id = $DigPerson['DigPerson']['id'];   
                            if($DigPerson['DigPerson']['person_status'] == '1')
                                $status = 'Submitted';
                            elseif($DigPerson['DigPerson']['person_status'] == '2')
                                $status = 'Approved';
                            elseif($DigPerson['DigPerson']['person_status'] == '3')
                                $status = 'Returned';
                            elseif($DigPerson['DigPerson']['person_status'] == '4')
                                $status = 'Change Submitted';
                            elseif($DigPerson['DigPerson']['person_status'] == '5')
                                $status = 'Allocated';
                            elseif($DigPerson['DigPerson']['person_status'] == '8')
                                $status = 'De-activated';
                            ?>
                            <tr> 
                                <td><?php echo $id; ?></td>
                                <td><?php echo $DigPerson['DigPerson']['person_name']; ?></td>
                                <td><?php echo $DigPerson['DigPersonType']['value']; ?></td>
                                <td><?php echo $DigPerson['Location']['value'].': '.$DigPerson['Location']['code']; ?></td>                                
                                <td><?php echo $DigPerson['DigPersonIndustry']['value']; ?></td>
                                <td><?php echo $DigPerson['DigPersonProfileType']['value']; ?></td>
                                <td><?php if($DigPerson['DigPerson']['person_used_by_team']>0)echo $DigPerson['DigPersonUsedByTeam']['channel_name']; else echo 'All Teams'; ?></td>
                                <td><?php echo $DigPerson['DigPersonUsedByPerson']['fname'].' '.$DigPerson['DigPersonUsedByPerson']['lname']; ?></td>
                                <td><?php echo $DigPerson['DigPerson']['person_description']; ?></td>
                                <td><?php echo $DigPerson['DigPerson']['person_comment']; ?></td>
                                <td><?php echo $DigPerson['DigPerson']['person_instructions']; ?></td>
                                
                                <td><?php echo $DigPerson['DigPerson']['person_email']; ?></td>
                                <td><?php echo $DigPerson['DigPerson']['person_email_parm']; ?></td>         
                                <td><?php echo $DigPerson['DigPerson']['person_user']; ?></td>
                                <td><?php echo $DigPerson['DigPerson']['person_user_parm']; ?></td>
                                
                                <td><?php echo $status; ?></td>
                                <td><?php echo $DigPerson['DigPersonUsageStatus']['value']; ?></td>
                                <td><?php echo $DigPerson['DigPerson']['active']; ?></td>
                                                       
                               
                                <td>
                                   <?php
                                   //echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'dig_persons', 'action' => 'edit', 'slug' => $DigPerson['DigPerson']['person_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                   echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'dig_persons', 'action' => 'edit', 'slug' => $DigPerson['DigPerson']['person_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
                                   echo $this->Html->link('<span class="icon-list"></span>', '/dig_persons/action/' . $id, array('class' => 'act-ico','target' => '_blank', 'escape' => false));
                                   ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="19" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Person', '/dig_persons/add') ?></span>

        </div>
    </div>
</div>