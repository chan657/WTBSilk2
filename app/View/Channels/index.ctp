<?php $this->Html->addCrumb('My Channels', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Channels</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Channel', '/channels/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('Channel', array('controller' => 'Channels', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row" id="search_panel_controls">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Channel Name:</label>
                        <?php echo $this->Form->input('search_value'); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Channel Name:</label>
                        <?php echo $this->Form->input('channel_name', array('options' => $channel_name, 'empty' => 'Select')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Channel City:</label>
                        <?php echo $this->Form->input('city_id', array('options' => $channel_city, 'empty' => 'Select')); ?>
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
                        <th data-toggle="phone">Channel Name</th>
                        <th data-hide="phone,tablet">Channel Description</th>

                        <th data-hide="phone">Channel City</th>
                        <th data-hide="phone,tablet">Channel Head</th>
                        <th data-hide="phone,tablet">Channel Roll</th>
                        <th data-hide="phone" data-sort-ignore="true">Action</th>        
                    </tr>
                </thead>
                <tbody>
<?php
if (isset($channels) && count($channels) > 0):
    foreach ($channels as $channel):
        $id = $channel['Channel']['id'];
        ?>
                            <tr>
                                <td><?php echo $id; ?></td>   
                                <td><?php echo $channel['Channel']['channel_name']; ?></td>                     
                                <td><?php echo $channel['Channel']['channel_description']; ?></td>
                                <td><?php echo $channel['City']['city_name']; ?></td>
                                <td><?php echo $channel['User']['fname'] . ' ' . $channel['User']['fname']; ?></td>
                                <td><?php echo $channel['LookupValueChannelRole']['name']; ?></td>




                                <td width="10%" valign="middle" align="center">

        <?php
        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'channels', 'action' => 'edit', 'slug' => $channel['Channel']['channel_name'] . '-' . $channel['City']['city_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
        echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'channels', 'action' => 'edit', 'slug' => $channel['Channel']['channel_name'] . '-' . $channel['City']['city_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
         echo $this->Html->link('<span class="icon-remove"></span>', array('controller' => 'channels','action' => 'delete',$id), array('class' => 'act-ico','escape' => false),"Are you sure you wish to delete this channel?");
        ?>
                                </td>

                            </tr>
                                    <?php endforeach; ?>

    <?php
    echo $this->element('paginate');
else:
    echo '<tr><td colspan="6" class="norecords">No Records Found</td></tr>';

endif;
?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Channel', '/channels/add') ?></span>

        </div>
    </div>
</div>
