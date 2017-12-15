<?php
$this->Html->addCrumb('My Topics', 'javascript:void(0);', array('class' => 'breadcrumblast'));
App::import('Model', 'User');
$attr = new User();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Topics</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Topic', '/dig_topics/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">
                <?php
                echo $this->Form->create('DigTopic', array('controller' => 'dig_topics', 'action' => 'index','class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">
<?php echo $this->Form->input('topic_name', array('value' => $topic_name, 'placeholder' => 'Topic Name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Lot Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
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
                        <th data-group="group1" colspan="10">Lot Information</th>                        
                        
                        <th data-group="group4" colspan="2">Lot Status</th>
                        <th data-group="group5" class="nodis">Action</th>
                    </tr>
                    <tr>  
                        <th data-toggle="true" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('id', 'Topic Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('topic_name', 'Topic Name'); echo ($sort == 'topic_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1">Topic Channel</th>
                        <th data-toggle="phone" data-sort-ignore="true"  data-group="group1">Topic Keywords</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Topic Related Keywords</th>     
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Topic Anchors Raw</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Topic Anchors Polished</th>                      
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Topic Related Anchors Raw</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Topic Related Anchors Polished</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Topic Tags Raw</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Topic Tags Polished</th>

                        <th data-hide="phone" data-sort-ignore="true" data-group="group4">System Status</th>
                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group4">Active?</th>

                        <th data-group="group5" data-hide="phone" data-sort-ignore="true" width="7%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($DigTopics) && count($DigTopics) > 0):
                        foreach ($DigTopics as $DigTopic):
                            $id = $DigTopic['DigTopic']['id'];
                            if($DigTopic['DigTopic']['topic_status'] == '1')
                                $status = 'CREATED';
                            elseif($DigTopic['DigTopic']['topic_status'] == '2')
                                $status = 'Approved';
                            elseif($DigTopic['DigTopic']['topic_status'] == '3')
                                $status = 'Returned';
                            elseif($DigTopic['DigTopic']['topic_status'] == '4')
                                $status = 'Change Submitted';
                            elseif($DigTopic['DigTopic']['topic_status'] == '8')
                                $status = 'De-activated';
                            ?>
                            <tr> 
                                <td><?php echo $id; ?></td>
                                <td><?php echo $DigTopic['DigTopic']['topic_name']; ?></td>
                                <td><?php if($DigTopic['DigTopic']['topic_channel'] > 1) echo $DigTopic['Channel']['channel_name']; else echo $DigTopic['DigTopic']['topic_channel']; ?></td> 
                                
                                <td><?php echo $DigTopic['DigTopic']['topic_keywords']; ?></td>
                                <td><?php echo $DigTopic['DigTopic']['topic_related_keywords']; ?></td>
                                <td><?php echo $DigTopic['DigTopic']['topic_anchors_raw'];?></td>
                                <td><?php echo $DigTopic['DigTopic']['topic_anchors_polished']; ?></td>
                                <td><?php echo $DigTopic['DigTopic']['topic_related_anchors_raw']; ?></td>
                                <td><?php echo $DigTopic['DigTopic']['topic_related_anchors_polished']; ?></td>
                                <td><?php echo $DigTopic['DigTopic']['topic_tags_raw']; ?></td>
                                <td><?php echo $DigTopic['DigTopic']['topic_tags_polished']; ?></td>                                
                                
                                

                                <td><?php echo $status; ?></td>
                               
                                <td><?php echo $DigTopic['DigTopic']['active']; ?></td>
                                <td>
                                    <?php
                                   echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'dig_topics', 'action' => 'edit', 'slug' => $DigTopic['DigTopic']['topic_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                   echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'dig_topics', 'action' => 'edit', 'slug' => $DigTopic['DigTopic']['topic_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false));
                                   ?>                             
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="13" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Topic', '/dig_topics/add') ?></span>

        </div>
    </div>
</div>