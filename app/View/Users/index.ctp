<?php $this->Html->addCrumb('My Users', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Users</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add User', '/users/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('User', array('controller' => 'User', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row" id="search_panel_controls">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">User Name:</label>
                        <?php echo $this->Form->input('search_value'); ?>
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
                    <tr>
                        <th data-sort-ignore="true" data-toggle="true">Id</th>
                        <th data-sort-ignore="true" data-toggle="phone">First Name</th>
                        <th data-sort-ignore="true" data-hide="phone">Last Name</th>
                        <th data-hide="phone">User Status</th>
                        <th data-sort-ignore="true" data-hide="phone">Company Email</th>
                        <th data-sort-ignore="true" data-hide="phone">Personal Email</th>
                        <th data-sort-ignore="true" data-hide="phone">Primary Mobile No</th>
                        <th data-sort-ignore="true">Action</th>        
                    </tr>
                </thead>
                <tbody>
<?php
if (isset($users) && count($users) > 0):
    foreach ($users as $user):
        $id = $user['User']['id'];
        if ($user['User']['dummy_status'] == '1')
            $status = 'Dummy User';
        else
            $status = 'Real User';
        ?>
                            <tr>
                                <td><?php echo $id; ?></td>   
                                <td><?php echo $user['User']['fname']; ?></td>                     
                                <td data-value="yes_UN"><?php echo $user['User']['lname']; ?></td>
                                <td><?php echo $status; ?></td>   
                                <td><?php echo $user['User']['company_email_id']; ?></td>
                                <td data-value="yes_UN"><?php echo $user['User']['personal_email_id']; ?></td>
                                <td data-value="yes_UN"><?php echo $user['User']['primary_mobile_number']; ?></td>




                                <td width="10%" valign="middle" align="center">

                                    <?php
                                    echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'users', 'action' => 'edit', 'slug' => $user['User']['fname'] . '-' . $user['User']['mname'] . '-' . $user['User']['lname'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                    echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'users', 'action' => 'edit', 'slug' => $user['User']['fname'] . '-' . $user['User']['mname'] . '-' . $user['User']['lname'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));

                                    echo $this->Html->link('<span class="icon-remove"></span>', array('controller' => 'users', 'action' => 'delete', $id), array('class' => 'act-ico', 'escape' => false), "Are you sure you wish to delete this user?");

                                    /* ?><?php

                                      echo $this->Html->link('Details', array('controller' => 'users','action' => 'edit','slug' => $user['User']['fname'].'-'.$user['User']['mname'].'-'.$user['User']['lname'],'id' => base64_encode($id)), array('class' => 'btn btn-success sticky_success'));
                                      ?><?php */
                                    ?>
                                </td>
                                <!--<td>
                                <?php /* ?><?php

                                  echo $this->Html->link('Delete', array('controller' => 'users','action' => 'delete',$id), array('class' => 'btn btn-danger sticky_important'), "Are you sure you wish to delete this user?");



                                  ?><?php */ ?></td>-->
                            </tr>
                            <?php endforeach; ?>

                        <?php echo $this->element('paginate'); ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add User', '/users/add') ?></span>

        </div>
    </div>
</div>
