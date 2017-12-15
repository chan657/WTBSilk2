<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'font-awesome/css/font-awesome.min',
    '/js/lib/datepicker/css/datepicker',
    '/js/lib/timepicker/css/bootstrap-timepicker.min'
        )
);
echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));

/* End */
//pr($this->data);
?>

<!----------------------------start add project block------------------------------>

<div class="content">
    <div class="pop-up-hdng">Add Link</div>


<?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
echo $this->Form->create('DigMediaLink', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),

));
echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
echo $this->Form->hidden('start_date',array('type' => 'text'));
?>

    <div class="col-sm-12">
        <div class="col-sm-6">
            <div class="form-group">
                <label  for="input_name">Link Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
<?php echo $this->Form->input('link_name'); ?>
                </div>
            </div>
            <div class="form-group">
                <label  for="input_name">Link Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
<?php echo $this->Form->input('link_type_id',array('options' => $DigMediaLookupLinkTypes,'empty' => '--Select--')); ?>
                </div>
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
                <label  for="input_name">Duration</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
<?php echo $this->Form->input('link_duration', array('class' => 'form-control sm rgt', 'tabindex' => '18', 'style' => 'float:left;width:49%'));
                                echo $this->Form->input('link_duration_unit', array('options' => $DigMediaLookupDurationUnits, 'empty' => '--Select--', 'tabindex' => '17', 'style' => 'float:left;margin-left:4px;width:49%')); ?>
                </div>
            </div>
            <div class="form-group">
                <label  for="input_name">No. of links</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
<?php echo $this->Form->input('link_number',array('type' => 'text')); ?>
                </div>
            </div>
            
            <div class="form-group">
                <label  for="input_name">Target Anchors</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
<?php echo $this->Form->input('link_target_anchors',array('type' => 'text')); ?>
                </div>
            </div>
        </div> 
        <div class="col-sm-6">
            <div class="form-group">
                <label  for="input_name">Tier</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
<?php echo $this->Form->input('link_tier_id',array('options' => $DigMediaLookupLinkTiers,'empty' => '--Select--')); ?>
                </div>
            </div>
            <div class="form-group">
                <label for="input_name">Start Date</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                    <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
                    <?php
                    echo $this->Form->input('link_start_date', array('type' => 'text', 'data-date-format' => 'yyyy-mm-dd', 'data-date-autoclose' => 'true'));
                    ?>
                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group">                            
                            <span style="color:#771D5A; font-size:18px;">
                                <div id="DelivaryDate"></div></span>
                        </div>
            <div class="form-group">
                <label  for="input_name">No Of Bonus</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
<?php echo $this->Form->input('link_bonus_number'); ?>
                </div>
            </div>
            <div class="form-group">
                <label  for="input_name">Target Tags</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
<?php echo $this->Form->input('link_target_tags'); ?>
                </div>
            </div>
        </div>          
    </div>
    <div style="clear:both"></div>
    <div class="col-sm-12 fullrow">

        <div class="form-group">
            <label>Target Url</label>
            <span class="colon">:</span>
            <div class="col-sm-10">
<?php echo $this->Form->input('link_target_url', array('type' => 'textarea')); ?>
            </div>
        </div>
        <div class="form-group">
            <label>Main Html</label>
            <span class="colon">:</span>
            <div class="col-sm-10">
<?php echo $this->Form->input('link_main_html', array('type' => 'textarea')); ?>
            </div>
        </div>
        <div class="form-group">
            <label>Related Html</label>
            <span class="colon">:</span>
            <div class="col-sm-10">
<?php echo $this->Form->input('link_related_html', array('type' => 'textarea')); ?>
            </div>
        </div>
        <div class="form-group">
            <label>Url Html</label>
            <span class="colon">:</span>
            <div class="col-sm-10">
<?php echo $this->Form->input('link_url_html', array('type' => 'textarea')); ?>
            </div>
        </div>
        <div class="form-group">
            <label>Special Instruction</label>
            <span class="colon">:</span>
            <div class="col-sm-10">
<?php echo $this->Form->input('link_special_instruction', array('type' => 'textarea')); ?>
            </div>
        </div>
    </div>  
    <div class="row">
        <div class="col-sm-12"><?php echo $this->Form->submit('Add', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
?></div>
    </div>           


                <?php echo $this->Form->end();
                ?>
</div>	

<script>
    $('#DigMediaLinkLinkDurationUnit').change(function() {

        var unit = $(this).val();
        // var duration = $('#DigMediaTaskTaskDuration').val();
        var duration = parseInt($("#DigMediaLinkLinkDuration").val(), 10);
        //  alert(days);
        var start_date = $('#DigMediaLinkLinkStartDate').val();
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
        var StartDate = start_date + ' ' + start_time;
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

        $('#DelivaryDate').text(date);
        $('#DigMediaLinkStartDate').val(StartDate);
        //  alert(date)      
    });
    
    </script>

