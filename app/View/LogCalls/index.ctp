<?php
$this->Html->addCrumb('Log Call', 'javascript:void(0);', array('class' => 'breadcrumblast'));
App::import('Model','User');
$attr = new User();

?>    
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span>Log Call</h4>

            
            
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('LogCall', array('class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'Builder'));
                ?> 
      
<?php echo $this->Form->end(); ?>
            </div>

            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="1000">
                <thead>
                   
                    <tr>
                        <th data-toggle="true" width="5%"  data-sort-ignore="true"><?php echo $this->Paginator->sort('id', 'Log Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="true" width="10%" data-sort-ignore="true">Log Call Nature</th>
                        <th data-hide="phone" width="10%" data-sort-ignore="true">Log Call Type</th>
                        <th data-hide="phone" width="13%" data-sort-ignore="true">Log Call By</th>
                        <th data-hide="phone" width="10%" data-sort-ignore="true">Log Call Counterparty</th>
                        <th data-hide="phone" width="10%" data-sort-ignore="true">Log Call Screen</th>
                        <th data-hide="phone" width="10%" data-sort-ignore="true">Log Call Time</th>
                        <th data-hide="phone" width="13%" data-sort-ignore="true">Log Call Status Code</th>
                        <th data-hide="all">Log Call Status Message</th>
                        <th data-hide="all">Log Call Parms</th>                          
                    </tr>
                </thead>
                <tbody>
<?php
$i = 1;
//	pr($builders);
$secondary_city = '';

if (isset($LogCalls) && count($LogCalls) > 0):
    foreach ($LogCalls as $LogCall):

        ?>
                            <tr>
                                <td class="tablebody"><?php echo $LogCall['LogCall']['id']; ?></td>
                                <td class="tablebody"><?php echo $LogCall['LogCall']['log_call_nature']; ?></td>
                                <td class="tablebody"><?php echo $LogCall['LogCall']['log_call_type']; ?></td>
                                <td class="tablebody"><?php echo $attr->Username($LogCall['LogCall']['log_call_by']); ?></td>
                                <td class="tablebody"><?php echo $LogCall['LogCall']['log_call_counterparty']; ?></td>
                                <td class="tablebody"><?php echo $LogCall['LogCall']['log_call_screen']; ?></td>
                                <td class="tablebody"><?php 
                                    echo  AppModel::ConvertGMTToLocalTimezone($LogCall['LogCall']['created'],'Asia/Calcutta');
                            ?></td>
                                <td class="tablebody"><?php echo $LogCall['LogCall']['log_call_status_code']; ?></td> 
                                <td class="tablebody"><?php echo $LogCall['LogCall']['log_call_status_message']; ?></td>
                                <td class="tablebody"><?php echo htmlentities($LogCall['LogCall']['log_call_parms']); ?></td>
                                
                              
                            </tr>
                    <?php endforeach; ?>
                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="10" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>          

        </div>
    </div>
</div>

