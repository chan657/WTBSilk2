<?php $this->Html->addCrumb('My Tasks', 'javascript:void(0);', array('class' => 'breadcrumblast')); 
App::import('Model','User');
		$attr = new User();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Tasks</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Task', '/dig_media_tasks/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">
                <?php
                echo $this->Form->create('DigMediaTask', array('controller' => 'dig_media_tasks', 'action' => 'index','class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">
                        <?php echo $this->Form->input('task_name', array('value' => $task_name, 'placeholder' => 'Task name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Task Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
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
                        <th data-group="group1" colspan="5">Task Information</th>                        
                        <th data-group="group2" colspan="4">Task Logistics</th>                       
                        <th data-group="group3" colspan="2">Task Status</th>
                        <th data-group="group4" class="nodis">Action</th>
                    </tr>
                    <tr>           
                        <th data-toggle="true" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('id', 'Task Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('DigTopic.topic_name', 'Task Topic'); echo ($sort == 'DigTopic.topic_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('task_name', 'Task Name'); echo ($sort == 'task_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1">Task Main URL</th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1">Delivery Date</th>
                                     
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Channel</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Allocated To</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Reviewed By</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Review Grade</th>                                                
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Delivery Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Task Status</th>
                        <th data-group="group4" data-hide="phone" data-sort-ignore="true" width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($DigMediaTasks) && count($DigMediaTasks) > 0):
                        foreach ($DigMediaTasks as $DigMediaTask):
                            $id = $DigMediaTask['DigMediaTask']['id'];   
                            
                            if($DigMediaTask['DigMediaTask']['task_status'] == '1')
                                $task_status = 'Save Draft';
                            elseif($DigMediaTask['DigMediaTask']['task_status'] == '2')
                                $task_status = 'Open Task';
                            ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $DigMediaTask['DigTopic']['topic_name'];?></td>
                                <td><?php echo $DigMediaTask['DigMediaTask']['task_name']; ?></td>
                                <td><?php echo $DigMediaTask['DigMediaTask']['task_main_url'];?></td>                                
                                <td><?php echo $DigMediaTask['DigMediaTask']['task_delivary_date']; ?></td>
                                <td><?php if($DigMediaTask['DigMediaTask']['task_channel'] > 1) echo $DigMediaTask['Channel']['channel_name']; else echo $DigMediaTask['DigMediaTask']['task_channel']; ?></td> 
                              
                                <td><?php echo $attr->Username($DigMediaTask['DigMediaTask']['task_allocated_to']); ?></td>
                                <td><?php echo $attr->Username($DigMediaTask['DigMediaTask']['task_reviewed_by']); ?></td>
                                <td><?php echo $DigMediaTask['DigMediaTask']['task_review_grade']; ?></td>
                                <td><?php echo $DigMediaTask['DigMediaTask']['task_customer_delivery_status']; ?></td>
                                <td><?php echo $task_status; ?></td>
                                <td>
                                    <?php
                                      echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'dig_media_tasks', 'action' => 'draft/' . $id), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Draft', 'escape' => false));      
                                      echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'dig_media_tasks', 'action' => 'add_person/' . $id), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Add Person', 'escape' => false));      
                                      ?>                                   
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="12" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Task', '/dig_media_tasks/add') ?></span>

        </div>
    </div>
</div>