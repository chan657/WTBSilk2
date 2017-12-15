<?php
$this->Html->addCrumb('My Groups', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($areas);
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Areas</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Group', '/users/group_add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('GroupsUser', array('controller' => 'users', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row" id="search_panel_controls">


                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Group Name:</label>
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
                        <th data-toggle="true">Id</th>
                        <th data-toggle="phone">Group Name</th>
                        <th data-toggle="phone">Industry</th>
                        <th data-hide="phone,tablet">Role Field Name</th>
                        <th data-hide="phone,tablet">Channel Field Name</th>

                        <th data-hide="phone" data-sort-ignore="true">Action</th>        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($groups) && count($groups) > 0):
                        foreach ($groups as $group):
                            $id = $group['GroupsUser']['id'];
                            ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $group['GroupsUser']['name']; ?></td>
                                <td><?php echo $group['Industry']['value']; ?></td>
                                <td><?php echo $group['GroupsUser']['role_field']; ?></td>                     
                                <td><?php echo $group['GroupsUser']['channel_field']; ?></td>

                                <td width="10%" valign="middle" align="center">

                                    <?php
                                    echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'users', 'action' => 'group_edit', 'slug' => $group['GroupsUser']['name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                    echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'users', 'action' => 'group_edit', 'slug' => $group['GroupsUser']['name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
                                    ?>
                                </td>

                            </tr>
        <?php endforeach; ?>

                        <?php //echo $this->element('paginate'); ?>
                    <?php endif; ?>
                </tbody>
            </table>
           <!-- <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Group', '/users/group_add') ?></span>-->

        </div>
    </div>
</div>
