<?php
$this->Html->addCrumb('Add Task', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DigMediaTask', array('enctype' => 'multipart/form-data', 'method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));

echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
echo $this->Form->hidden('start_date', array('type' => 'text'));
echo $this->Form->hidden('product');
echo $this->Form->hidden('channel_name');
echo $this->Form->hidden('topic_name');
echo $this->Form->hidden('user_fname');
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Task</span></legend>
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
                         <div class="form-group">
                            <label for="input_name" class="req">Start Date</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                    <?php
                                    echo $this->Form->input('task_start_date', array('type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true','tabindex' => '5'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Task Channel</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_channel', array('options' => $Channels, 'data-required' => 'true', 'empty' => '--Select--','tabindex' => '7'));
                                ?>

                            </div>
                        </div>
                       
                        <!--
                        <div class="form-group slt-sm">
                            <label for="reg_input_name">Duration Unit</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('task_duration', array('class' => 'form-control sm rgt', 'tabindex' => '18', 'style' => 'float:left;'));
                        echo $this->Form->input('task_duration_unit', array('options' => $DigMediaLookupDurationUnits, 'empty' => '--Select--', 'tabindex' => '17', 'style' => 'float:left;margin-left:4px'));
                        ?></div>
                        </div>
                        <div class="form-group slt-sm">
                            <label for="reg_input_name">Review Duration Unit</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('task_review_duration', array('class' => 'form-control sm rgt', 'tabindex' => '18', 'style' => 'float:left;'));
                        echo $this->Form->input('task_review_duration_unit', array('options' => $DigMediaLookupDurationUnits, 'empty' => '--Select--', 'tabindex' => '17', 'style' => 'float:left;margin-left:4px'));
                        ?></div>
                        </div>
                        -->
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Task Urgency</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_urgency', array('options' => $DigMediaLookupUrgencies, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '9'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Task Main URL</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_main_url',array('tabindex' => '11'));
                                ?></div>
                        </div>




                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Inbound</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_inbound', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'),'tabindex' => '2', 'disabled' => array('FALSE')));
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name">Customer Location</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('task_customer_location', array('options' => $countires, 'empty' => '--Select--','tabindex' => '4'));
                                ?></div>
                        </div>


                        <div class="form-group imp">
                            <label for="input_name" class="req">Start Time</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <div class="input-group bootstrap-timepicker">
                                    <?php
                                    echo $this->Form->input('start_time', array('type' => 'text', 'id' => 'start_time','tabindex' => '6'));
                                    ?>
                                    <span class="input-group-addon"><i class="icon-time"></i></span>
                                </div>

                            </div>
                            <br class="spacer" />
                        </div> 
                        <!--
                        <div class="form-group">                            
                            <span style="color:#771D5A; font-size:18px;">
                                <div id="DelivaryDate"></div></span>
                        </div>
                        <div class="form-group">
                            <span style="color:#771D5A; font-size:18px;">
                                <div id="ReviewDuration"></div></span>
                        </div>
                        -->
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Task Allocated To</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_allocated_to', array('options' => $Users, 'empty' => '--Select--','tabindex' => '8'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Task Reviewed By</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_reviewed_by', array('options' => $Users, 'empty' => '--Select--','tabindex' => '10'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Task Shortened URL</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('task_shortened_url',array('tabindex' => '12'));
                                ?></div>
                        </div>
                    </div>
                </div>
                <!--
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
                -->
                <div style="clear: both;"></div>
                <div class="col-sm-12">

                    <div class="panel-group" id="accordion2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title fpt">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc1_collapseOne">
                                       Task Topic
                                    </a>
                                </h4>
                            </div>
                            <div id="acc1_collapseOne" class="panel-collapse collapse">
                                <div class="panel-body">
                                    
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task Topic</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-4">
                                                <?php
                                                echo $this->Form->input('task_topic_id', array('options' => $DigTopics, 'empty' => '--Select--'));
                                                ?></div>
                                        </div>
                                        <div id="AjaxDeliveryFormat"></div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title fpt">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc1_collapseThree">
                                     Task  Structure
                                    </a>
                                </h4>
                            </div>
                            <div id="acc1_collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">
                                    
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Structure</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-4">
                                                <?php
                                                echo $this->Form->input('task_structure_id', array('options' => $DigStructures, 'empty' => '--Select--'));
                                                ?></div>
                                        </div>
                                        <div id="AjaxStructure"></div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title fpt">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc1_collapseTwo">
                                        Task Content 
                                    </a>
                                </h4>
                            </div>
                            <div id="acc1_collapseTwo" class="panel-collapse collapse">
                                <div class="panel-body">
                                                                          
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task URL Description 1</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('task_url_description1', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                                                ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task URL Description 2</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('task_url_description2', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                                                ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task URL Description 3</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('task_url_description3', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                                                ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task Spintax 1 (About Me Article)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('task_spintax1', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                                                ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task Spintax 2 (High PR Article)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('task_spintax2', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                                                ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task Spintax 3 (Tier-2 Article1)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('task_spintax3', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                                                ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task Spintax 4 (Tier-2 Article2)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('task_spintax4', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                                                ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task Spintax 5 (Tier-3 Article1)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('task_spintax5', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                                                ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task Spintax 6 (Blog Comment)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('task_spintax6', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                                                ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task Spintax 7 (Forum Comment)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('task_spintax7', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                                                ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task Spintax 8 (Image Comment)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('task_spintax8', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                                                ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task Spintax 9 (Guestbook Comment)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('task_spintax9', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                                                ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Task Spintax 10 (Video Comment)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('task_spintax10', array('type' => 'textarea', 'style' => 'width:122%;height:100px'));
                                                ?></div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="clear: both;"></div>

                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Save Draft', array('class' => 'btn btn-success sticky_success'));
                            ?>
                        </div>
                        <div class="col-sm-1">
                            <?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();
/*
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
  'action' => 'get_dig_topic_html_by_topic_id/DigMediaTask/task_topic_id'
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
 * 
 */

$this->Js->get('#DigMediaTaskTaskTopicId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_dig_topic_html_by_topic_id/DigMediaTask/task_topic_id'
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

$this->Js->get('#DigMediaTaskTaskStructureId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_level_pattern_html_by_structure_id/DigMediaTask/task_structure_id'
                ), array(
            'update' => '#AjaxStructure',
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
        //  alert(start_date);
        var DigMediaTaskStartDate = start_date + ' ' + start_time;
        var date = new Date(start_date + 'T' + start_time);

        if (unit == 'Days')
            date.setDate(date.getDate() + duration);
        else if (unit == 'Hours') {
            duration = duration * 60;
            date.setMinutes(date.getMinutes() + duration);
        }
        else if (unit == 'Weeks') {
            duration = duration * 7;
            date.setDate(date.getDate() + duration);
        }
        else if (unit == 'Months') {
            date.setMonth(date.getMonth() + duration);
            // date.setWeeks('weeks', duration);
        }
        // dateFormat(date, "mm/dd/yy, h:MM:ss TT");
        // var a = dateFormat(date, "mm/dd/yy, h:MM:ss TT"); 
        // alert(date);
        $('#DelivaryDate').text(date);
        $('#DigMediaTaskStartDate').val(DigMediaTaskStartDate);
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
            duration = duration * 7;
            date.setDate(date.getDate() + duration);
        }
        else if (unit == 'Months') {
            date.setMonth(date.getMonth() + duration);
            // date.setWeeks('weeks', duration);
        }

        $('#ReviewDuration').text(date);
        //  alert(date)      
    });

    
     $('#DigMediaTaskTaskProductId').change(function(){    
      $('#DigMediaTaskProduct').val($('#DigMediaTaskTaskProductId option:selected').text());
    });
    
    $('#DigMediaTaskTaskChannel').change(function(){    
      $('#DigMediaTaskChannelName').val($('#DigMediaTaskTaskChannel option:selected').text());
    });
    
    $('#DigMediaTaskTaskTopicId').change(function(){    
      $('#DigMediaTaskTopicName').val($('#DigMediaTaskTaskTopicId option:selected').text());
    });
    
    $('#DigMediaTaskTaskAllocatedTo').change(function(){    
      var val = $('#DigMediaTaskTaskAllocatedTo option:selected').text();
      var res = val.split(" ");
      $('#DigMediaTaskUserFname').val(res[0]);
      
    });
    
</script>



