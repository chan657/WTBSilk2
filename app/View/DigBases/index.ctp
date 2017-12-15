<?php $this->Html->addCrumb('My Bases', 'javascript:void(0);', array('class' => 'breadcrumblast')); 
App::import('Model','User');
		$attr = new User();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Bases</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Base', '/dig_bases/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
            <div class="panel_controls hideform">
                <?php
                echo $this->Form->create('DigBase', array('controller' => 'dig_bases', 'action' => 'index','class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 
                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">
                        <?php echo $this->Form->input('base_website_url', array('value' => $base_website_url, 'placeholder' => 'Type base name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Base Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
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
                        <th data-group="group1" colspan="19">Base Information</th>                        
                        <th data-group="group2" colspan="8">Base Statistics</th>                       
                        <th data-group="group3" colspan="3">Base Status</th>
                        <th data-group="group4" class="nodis">Action</th>
                    </tr>
                    <tr>       
                        <th data-toggle="true" data-sort-ignore="true"  data-group="group1"><?php echo $this->Paginator->sort('id', 'Base Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone"  data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('base_website_url', 'Base Name'); echo ($sort == 'base_website_url') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true"  data-group="group1">Type</th>
                        <th data-hide="phone" data-sort-ignore="true"  data-group="group1">Target Geo</th>              
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Usage Type</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Channel</th>                        
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Base Link1 Category</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Base Link1 Dofollow</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Base Link2 Category</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Base Link2 Dofollow</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Base Link3 Category</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Base Link3 Dofollow</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Base Used As1</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Base Used As2</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Base Used As3</th>                                                
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Description</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Comment</th>
                        <th data-hide="all" data-sort-ignore="true" data-group="group1">Instructions</th>                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">PR</th>                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">DA</th>                                                
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">PA</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">DF</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">AA</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">CL</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">LR</th>   
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">PP</th>   
                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">System Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Usage Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Active?</th>
                        
                        <th data-group="group4" data-hide="phone" data-sort-ignore="true" width="7%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   
                    if (isset($DigBases) && count($DigBases) > 0):
                        foreach ($DigBases as $DigBase):
                            $id = $DigBase['DigBase']['id'];   
                            if($DigBase['DigBase']['base_status'] == '1')
                                $status = 'Created';
                            elseif($DigBase['DigBase']['base_status'] == '2')
                                $status = 'Approved';
                            elseif($DigBase['DigBase']['base_status'] == '3')
                                $status = 'Returned';
                            elseif($DigBase['DigBase']['base_status'] == '4')
                                $status = 'Change Submitted';
                            elseif($DigBase['DigBase']['base_status'] == '8')
                                $status = 'De-activated';
                            
                             $tr_style = '';
                             if($DigBase['DigBase']['base_dofollow'] == '1')
                                $tr_style = 'style="background-color:#CEE4F5"';
                           
                           
                            ?>
                            <tr <?php echo $tr_style;?>> 
                                <td><?php echo $id; ?></td>
                                <td>
                                    <?php echo $this->Html->link($DigBase['DigBase']['base_website_url'], $DigBase['DigBase']['base_website_url'], array('target' => '_blank')); ?></td>
                                <td><?php echo $DigBase['BaseType']['value']; ?></td>
                                <td><?php echo $DigBase['DigBaseTargetGeography']['value']; ?></td>                               
                                <td><?php echo $DigBase['DigBaseUsageType']['value']; ?></td> 
                                <td><?php if($DigBase['DigBase']['base_used_by'] > 1) echo $DigBase['DigBaseUsedBy']['channel_name']; else echo $DigBase['DigBase']['base_used_by']; ?></td> 
                                <td><?php echo $DigBase['DigBaseLinkCategory1']['value']; ?></td>
                                <td><?php echo $DigBase['BaseLink1Dofollow']['value']; ?></td>
                                <td><?php echo $DigBase['DigBaseLinkCategory2']['value']; ?></td>
                                <td><?php echo $DigBase['BaseLink2Dofollow']['value']; ?></td>
                                <td><?php echo $DigBase['DigBaseLinkCategory3']['value']; ?></td>
                                <td><?php echo $DigBase['BaseLink3Dofollow']['value']; ?></td>
                                <td><?php echo $DigBase['BaseUsedAs1']['value']; ?></td>
                                <td><?php echo $DigBase['BaseUsedAs2']['value']; ?></td>
                                <td><?php echo $DigBase['BaseUsedAs3']['value']; ?></td>
                                <td><?php echo $DigBase['DigBase']['base_description']; ?></td>
                                <td><?php echo $DigBase['DigBase']['base_comment']; ?></td>
                                <td><?php echo $DigBase['DigBase']['base_usage_instructions']; ?></td>
                                
                                <td><?php echo $DigBase['DigBase']['base_pr']; ?></td>                                                              
                                <td><?php echo $DigBase['DigBase']['base_da']; ?></td>
                                <td><?php echo $DigBase['DigBase']['base_pa']; ?></td>
                                <td><?php echo $DigBase['DigBaseDofollow']['value']; ?></td>
                                <td><?php echo $DigBase['BaseAutoApprove']['value']; ?></td>
                                <td><?php echo $DigBase['BaseWithinComment']['value']; ?></td>
                                <td><?php echo $DigBase['BaseLoginRequired']['value']; ?></td>
                                <td><?php echo $DigBase['BasePP']['value']; ?></td>
                                
                                <td><?php echo $status; ?></td>
                                <td><?php echo $DigBase['DigBaseUsageStatus']['value']; ?></td>
                                <td><?php echo $DigBase['DigBase']['active']; ?></td>
                                
                                
                                <td>
                                    <?php
                                   // if($DigBase['DigBase']['base_status'] == '2')                                     
                                     echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'dig_bases', 'action' => 'edit', 'slug' => $DigBase['BaseType']['value'], 'id' => base64_encode($id), 'mode' => '1'), array('class' => 'act-ico', 'escape' => false));
                                     echo $this->Html->link('<span class="icon-eye-open"></span>', array('controller' => 'dig_bases', 'action' => 'edit', 'slug' => $DigBase['BaseType']['value'], 'id' => base64_encode($id), 'mode' => '2'), array('class' => 'act-ico', 'escape' => false)); 
                                    
                                    ?>                                   
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="41" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Base', '/dig_bases/add') ?></span>

        </div>
    </div>
</div>