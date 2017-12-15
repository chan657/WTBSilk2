<?php
$this->Html->addCrumb('Draft Task', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DigMediaTask', array('enctype' => 'multipart/form-data', 'method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
//pr($this->data);

echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
echo $this->Form->hidden('task_target_content_file1', array('value' => $this->data['DigMediaTask']['task_target_content_file1']));
echo $this->Form->hidden('task_target_content_file2', array('value' => $this->data['DigMediaTask']['task_target_content_file2']));
echo $this->Form->hidden('task_target_content_file3', array('value' => $this->data['DigMediaTask']['task_target_content_file3']));
echo $this->Form->hidden('task_target_content_file4', array('value' => $this->data['DigMediaTask']['task_target_content_file4']));
echo $this->Form->hidden('task_target_content_file5', array('value' => $this->data['DigMediaTask']['task_target_content_file5']));
echo $this->Form->hidden('task_target_content_file6', array('value' => $this->data['DigMediaTask']['task_target_content_file6']));
echo $this->Form->hidden('task_target_content_file7', array('value' => $this->data['DigMediaTask']['task_target_content_file7']));
echo $this->Form->hidden('task_target_content_file8', array('value' => $this->data['DigMediaTask']['task_target_content_file8']));
echo $this->Form->hidden('task_target_content_file9', array('value' => $this->data['DigMediaTask']['task_target_content_file9']));
echo $this->Form->hidden('task_target_content_file10', array('value' => $this->data['DigMediaTask']['task_target_content_file10']));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Draft Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Draft Task</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Product Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_product_id', array('options' => $DigMediaProducts, 'data-required' => 'true', 'empty' => '--Select--','tabindex' => '1'));
                                ?>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Customer Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_customer_name', array('data-required' => 'true','tabindex' => '3'));
                                ?></div>
                        </div>
                        <div class="form-group" >
                            <label for="reg_input_name" class="req">Start Date</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                                    <?php
                                    echo $this->Form->input('task_start_date', array('type' => 'text', 'data-date-format' => 'yyyy-mm-dd', 'data-date-autoclose' => 'true','tabindex' => '5'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>


                            </div>
                        </div>
                        <div class="form-group slt-sm">
                            <label for="reg_input_name">Duration Unit</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_duration', array('class' => 'form-control sm rgt', 'tabindex' => '7', 'style' => 'float:left;'));
                                echo $this->Form->input('task_duration_unit', array('options' => $DigMediaLookupDurationUnits, 'empty' => '--Select--', 'tabindex' => '8', 'style' => 'float:left;'));
                                ?></div>
                        </div>
                        <div class="form-group slt-sm">
                            <label for="reg_input_name">Review Duration Unit</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_review_duration', array('class' => 'form-control sm rgt', 'tabindex' => '18', 'style' => 'float:left;'));
                                echo $this->Form->input('task_review_duration_unit', array('options' => $DigMediaLookupDurationUnits, 'empty' => '--Select--', 'tabindex' => '17', 'style' => 'float:left;'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Task Urgency</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_urgency', array('options' => $DigMediaLookupUrgencies, 'empty' => '--Select--', 'data-required' => 'true'));
                                ?></div>
                        </div>




                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Inbound</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_inbound', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'disabled' => array('FALSE')));
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name">Customer Location</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('task_customer_location', array('options' => $countires, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group imp">
                            <label for="input_name" class="req">Start Time</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group bootstrap-timepicker">
                                    <?php
                                    echo $this->Form->input('start_time', array('type' => 'text', 'id' => 'start_time'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-time"></i></span>
                                </div>

                            </div>
                            <br class="spacer" />
                        </div>
                        <div class="form-group">                            
                            <span style="color:#771D5A; font-size:18px;">
                                <div id="DelivaryDate"><?php echo $this->data['DigMediaTask']['task_delivary_date'];?></div></span>
                        </div>
                        <div class="form-group">
                            <span style="color:#771D5A; font-size:18px;">
                                <div id="ReviewDuration"><?php echo $this->data['DigMediaTask']['task_customer_delivery_date'];?></div></span>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Task Allocated To</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_allocated_to', array('options' => $Users, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Task Reviewed By</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_reviewed_by', array('options' => $Users, 'empty' => '--Select--'));
                                ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Task Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('task_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Task Special Instruction</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('task_special_instruction', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                            ?></div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel-group" id="accordion1">                                                       

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title fpt">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseOne">
                                                Uploads Area 
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="acc1_collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-sm-12">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="reg_input_name" style="margin-left: 14px">Delivery Format</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            echo $this->Form->input('task_delivary_format', array('type' => 'file'));
                                                            ?></div><div id="AjaxDeliveryFormat"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reg_input_name" style="margin-left: 14px">Content File1</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            echo $this->Form->input('task_target_content_file1', array('type' => 'file'));
                                                            ?></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reg_input_name" style="margin-left: 14px">Content File2</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            echo $this->Form->input('task_target_content_file2', array('type' => 'file'));
                                                            ?></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reg_input_name" style="margin-left: 14px">Content File3</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            echo $this->Form->input('task_target_content_file3', array('type' => 'file'));
                                                            ?></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reg_input_name" style="margin-left: 14px">Content File4</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            echo $this->Form->input('task_target_content_file4', array('type' => 'file'));
                                                            ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label for="reg_input_name" style="margin-left: 14px">Content File5</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            echo $this->Form->input('task_target_content_file5', array('type' => 'file'));
                                                            ?></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reg_input_name" style="margin-left: 14px">Content File6</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            echo $this->Form->input('task_target_content_file6', array('type' => 'file'));
                                                            ?></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reg_input_name" style="margin-left: 14px">Content File7</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            echo $this->Form->input('task_target_content_file7', array('type' => 'file'));
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reg_input_name" style="margin-left: 14px">Content File8</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            echo $this->Form->input('task_target_content_file8', array('type' => 'file'));
                                                            ?></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reg_input_name" style="margin-left: 14px">Content File9</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            echo $this->Form->input('task_target_content_file9', array('type' => 'file'));
                                                            ?></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reg_input_name" style="margin-left: 14px">Content File10</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                            <?php
                                                            echo $this->Form->input('task_target_content_file10', array('type' => 'file'));
                                                            ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                              
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title fpt">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseTwo">
                                                Link Information
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="acc1_collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-sm-12">
                                                <div class="form-control-static">
                                                    <div class="table-heading disimp">
                                                        <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php echo count($DigMediaLinks); ?>
                                                            <?php echo $this->Html->link('Add Link', '/dig_media_links/add/'.$this->data['DigMediaTask']['id'], array('class' => 'open-popup-link add-btn')); ?>
                                                            </span>Link Details</h4></div><table class="table toggle-square responsive_table" data-filter="#table_search" data-page-size="40">
                                                        <thead>
                                                            <tr>
                                                                <th data-toggle="true">Name</th>
                                                                <th data-hide="phone">Tier</th>
                                                                <th data-hide="phone">Type</th>
                                                                <th data-hide="phone">Start Date</th>
                                                                <th data-hide="phone">No. Of Links</th>
                                                                <th data-hide="phone">Target Url</th>
                                                                <th data-hide="phone">Target Anchors</th>
                                                                <th data-hide="phone">Target Tags</th>                                                                
                                                                <th data-hide="all" data-sort-ignore="true">Main Html</th>
                                                                <th data-hide="all" data-sort-ignore="true">Related Html</th>
                                                                <th data-hide="all" data-sort-ignore="true">Url Html</th>
                                                                <th data-hide="all" data-sort-ignore="true">Special Instructions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>  
                                                            <?php
	//pr($DigMediaLinks);
                                                            if (count($DigMediaLinks) && !empty($DigMediaLinks)) {
                                                                foreach ($DigMediaLinks as $DigMediaLink) {
                                                                   // pr($DigMediaLink['DigMediaLookupLinkTier']);
                                                                    ?> 
                                                                    <tr>
                                                                        <td><?php echo $DigMediaLink['DigMediaLink']['link_name'] ?></td>
                                                                        <td><?php echo $DigMediaLink['DigMediaLookupLinkTier']['value']; ?></td>
                                                                        <td><?php echo $DigMediaLink['DigMediaLookupLinkType']['value']; ?></td>
                                                                        <td><?php echo $DigMediaLink['DigMediaLink']['link_start_date'] ?></td>
                                                                        <td><?php echo $DigMediaLink['DigMediaLink']['link_number'] ?></td>
                                                                        <td><?php echo $DigMediaLink['DigMediaLink']['link_target_url']; ?></td>
                                                                        <td><?php echo $DigMediaLink['DigMediaLink']['link_target_anchors']; ?></td>
                                                                        <td><?php echo $DigMediaLink['DigMediaLink']['link_target_tags']; ?></td>
                                                                        <td><?php echo $DigMediaLink['DigMediaLink']['link_main_html']; ?></td>
                                                                        <td><?php echo $DigMediaLink['DigMediaLink']['link_related_html']; ?></td>
                                                                        <td><?php echo $DigMediaLink['DigMediaLink']['link_url_html']; ?></td>                                                                        
                                                                        <td><?php echo $DigMediaLink['DigMediaLink']['link_special_instruction']; ?></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>   
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <?php if(count($DigMediaLinks)>0){ ?>
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Open Task', array('class' => 'btn btn-success sticky_success'));
                            ?>
                        </div>
                        <div class="col-sm-1">
                            <?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important')); ?>
                        </div>
                        <?php }  else {?>
                            
                        <?php echo 'Task cannot be open. Please insert at-least one link.';}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();

$this->Js->get('#DigMediaTaskTaskProductId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_dig_product_description_by_proId/DigMediaTask/task_product_id'
                ), array(
            'update' => '#DigMediaTaskTaskDescription',
            'async' => true,
            'before' => 'loading("DigMediaTaskTaskDescription")',
            'complete' => 'loaded("DigMediaTaskTaskDescription")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#DigMediaTaskTaskProductId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_dig_product_format_by_product_id/DigMediaTask/task_product_id'
                ), array(
            'update' => '#AjaxDeliveryFormat',
            'async' => true,
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
?>  

<script>
    $('#DigMediaTaskTaskDurationUnit').change(function() {

        var unit = $(this).val();
        // var duration = $('#DigMediaTaskTaskDuration').val();
        var duration = parseInt($("#DigMediaTaskTaskDuration").val(), 10);
        //  alert(days);
        var start_date = $('#DigMediaTaskTaskStartDate').val();
        var time = $('#start_time').val();

        var hrs = Number(time.match(/^(\d+)/)[1]);
        var mnts = Number(time.match(/:(\d+)/)[1]);
        var format = time.match(/\s(.*)$/)[1];
        if (format == "PM" && hrs < 12)
            hrs = hrs + 12;
        if (format == "AM" && hrs == 12)
            hrs = hrs - 12;
        var hours = hrs.toString();
        var minutes = mnts.toString();
        if (hrs < 10)
            hours = "0" + hours;
        if (mnts < 10)
            minutes = "0" + minutes;
        var start_time = hours + ":" + minutes + ":00";
        // alert(start_time);
        var date = new Date(start_date + 'T' + start_time);

        if (unit == 'Days')
            date.setDate(date.getDate() + duration);
        else if (unit == 'Hours') {
            duration = duration * 60;
            date.setMinutes(date.getMinutes() + duration);
        }
        else if (unit == 'Weeks') {
            date.setWeek(date.getWeeks() + duration);
            // date.setWeeks('weeks', duration);
        }
        else if (unit == 'Months') {
            date.setMonth(date.getMonth() + duration);
            // date.setWeeks('weeks', duration);
        }

        $('#DelivaryDate').text(date);
        //  alert(date)      
    });

    $('#DigMediaTaskTaskReviewDurationUnit').change(function() {

        var unit = $(this).val();
        // var duration = $('#DigMediaTaskTaskDuration').val();
        var duration = parseInt($("#DigMediaTaskTaskReviewDuration").val(), 10);
        //  alert(days);
        var start_date = $('#DigMediaTaskTaskStartDate').val();
        var time = $('#start_time').val();

        var hrs = Number(time.match(/^(\d+)/)[1]);
        var mnts = Number(time.match(/:(\d+)/)[1]);
        var format = time.match(/\s(.*)$/)[1];
        if (format == "PM" && hrs < 12)
            hrs = hrs + 12;
        if (format == "AM" && hrs == 12)
            hrs = hrs - 12;
        var hours = hrs.toString();
        var minutes = mnts.toString();
        if (hrs < 10)
            hours = "0" + hours;
        if (mnts < 10)
            minutes = "0" + minutes;
        var start_time = hours + ":" + minutes + ":00";
        // alert(start_time);
        var date = new Date(start_date + 'T' + start_time);

        if (unit == 'Days')
            date.setDate(date.getDate() + duration);
        else if (unit == 'Hours') {
            duration = duration * 60;
            date.setMinutes(date.getMinutes() + duration);
        }
        else if (unit == 'Weeks') {
            date.setWeek(date.getWeeks() + duration);
            // date.setWeeks('weeks', duration);
        }
        else if (unit == 'Months') {
            date.setMonth(date.getMonth() + duration);
            // date.setWeeks('weeks', duration);
        }

        $('#ReviewDuration').text(date);
        //  alert(date)      
    });
</script>



