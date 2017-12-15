<?php
$this->Html->addCrumb('My Levels', 'javascript:void(0);', array('class' => 'breadcrumblast'));
App::import('Model', 'User');
$attr = new User();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Topics</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Level', '/dig_levels/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">
                <?php
                echo $this->Form->create('DigLevel', array('controller' => 'dig_levels', 'action' => 'index','class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">
<?php echo $this->Form->input('level_name', array('value' => $level_name, 'placeholder' => 'Level Name', 'error' => array('class' => 'formerror'))); ?>
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
                        <th data-group="group1" colspan="16">Level Information</th>                                          
                        <th data-group="group4" colspan="2">Level Status</th>
                        <th data-group="group5" class="nodis">Action</th>
                    </tr>
                    <tr>  
                        <th data-toggle="true" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('id', 'Level Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('level_name', 'Level Name'); echo ($sort == 'level_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1">Level No.</th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1">No. Of Pattern</th>
                        <th data-toggle="phone" data-sort-ignore="true"  data-group="group1">Duration</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Review Duration</th>                          
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Pattern 1</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Pattern 2</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Pattern 3</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Pattern 4</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Pattern 5</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Pattern 6</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Pattern 7</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Pattern 8</th>                       
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Description</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Special Instruction</th>
                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group4">System Status</th>                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group4">Active?</th>

                        <th data-group="group5" data-hide="phone" data-sort-ignore="true" width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $status = '';
                    if (isset($DigLevels) && count($DigLevels) > 0):
                        foreach ($DigLevels as $DigLevel):
                            $id = $DigLevel['DigLevel']['id'];
                            if($DigLevel['DigLevel']['level_status'] == '1')
                                $status = 'CREATED';
                            elseif($DigLevel['DigLevel']['level_status'] == '2')
                                $status = 'Approved';
                            elseif($DigLevel['DigLevel']['level_status'] == '3')
                                $status = 'Returned';
                            elseif($DigLevel['DigLevel']['level_status'] == '4')
                                $status = 'Change Submitted';
                            elseif($DigLevel['DigLevel']['level_status'] == '8')
                                $status = 'De-activated';
                            ?>
                            <tr> 
                                <td><?php echo $id; ?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_name']; ?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_number']; ?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_no_of_patterns']; ?></td>                                
                                <td><?php echo $DigLevel['DigLevel']['level_duration'].' '.$DigLevel['DigLevel']['level_duration_unit']; ?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_review_duration'].' '.$DigLevel['DigLevel']['level_review_duration_unit']; ?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_pattern_1']; ?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_pattern_2'];?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_pattern_3']; ?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_pattern_4']; ?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_pattern_5']; ?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_pattern_6']; ?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_pattern_7']; ?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_pattern_8']; ?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_description']; ?></td>
                                <td><?php echo $DigLevel['DigLevel']['level_special_instruction']; ?></td>                                
                    
                                <td><?php echo $status; ?></td>                               
                                <td><?php echo $DigLevel['DigLevel']['level_active']; ?></td>
                                <td>
                                    <?php
                                           echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'dig_levels', 'action' => 'edit', 'slug' => $DigLevel['DigLevel']['level_name'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                     echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'dig_levels', 'action' => 'edit', 'slug' => $DigLevel['DigLevel']['level_name'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false)); 
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
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Level', '/dig_levels/add') ?></span>

        </div>
    </div>
</div>