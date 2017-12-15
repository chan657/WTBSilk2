<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'todc-bootstrap.min',
    'font-awesome/css/font-awesome.min',
    '/js/lib/datepicker/css/datepicker',
    '/js/lib/timepicker/css/bootstrap-timepicker.min'
        )
);
echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));

/* End */
?>
<input type="hidden" id="hidden_site_baseurl" value="<?php echo $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : ''); ?>"  />

<!----------------------------start add project block------------------------------>
<div class="content">
    <div class="pop-up-hdng">
        <span class="heading_text">Add Action | <?php echo $this->data['Agent']['agent_name'];?> | Waiting for Allocation</span>
    </div>

    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
    echo $this->Form->create('TravelActionItem', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true, 'onsubmit' => 'return validation()',
        'inputDefaults' => array(
            'label' => false,
            'div' => false,
            'class' => 'form-control',
        )
    ));
    ?>
    <div class="col-sm-12 spacer">

        <div class="col-sm-6">


            <div class="form-group">
                <label class="bgr req">Choose Action Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('type_id', array('id' => 'type_id', 'options' => $type, 'empty' => '--Select--', 'data-required' => 'true'));
                    ?>
                </div>
            </div>

        </div>
        <div class="col-sm-6 allocation" style="display:none;">
            <div class="form-group">
                <label class="bgr req">Reason Allocation</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	<?php
                    echo $this->Form->input('reason_allocation_id', array('data-required' => 'true', 'options' => $allocation_reason, 'empty' => '--Select--'));
                    ?></div>
            </div>
        </div>
        <div class="col-sm-12 spacer allocation" style="display:none;">

            <div class="lf-space">
                <?php echo $this->Form->input('description', array('type' => 'textarea')); ?>
            </div>
        </div>
        <div class="fullwidth allocation" style="display:none;">
            <h4>Add Activity</h4>
            <div class="col-sm-6 zindexm">
                <div class="form-group" >
                    <label class="req">Start Date</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                            <?php
                            echo $this->Form->input('Event.date1', array('id' => 'start_date', 'type' => 'text', 'data-required' => 'true', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true'));
                            ?>
                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        </div>


                    </div>
                </div>
                <div class="form-group imp">
                    <label class="req">Start Time</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <div class="input-group bootstrap-timepicker">
                            <?php
                            echo $this->Form->input('Event.start_time', array('type' => 'text', 'id' => 'start_time', 'data-required' => 'true'));
                            ?>
                            <span class="input-group-addon"><i class="icon-time"></i></span>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label for="input_name" class="req">Activity Level</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('Event.activity_level', array('options' => $activity_levels, 'empty' => '--Select--', 'data-required' => 'true'));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input_name" class="req">Activity Type</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('Event.activity_type', array('options' => $activity_types, 'empty' => '--Select--', 'data-required' => 'true'));
                        ?>
                    </div>
                </div>

            </div>
            <div class="col-sm-6 zindexm">
                <div class="form-group" >
                    <label class="req">End Date</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                            <?php
                            echo $this->Form->input('Event.date2', array('id' => 'end_date', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'data-required' => 'true'));
                            ?>
                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                        </div>


                    </div>
                </div>
                <div class="form-group imp">
                    <label class="req">End Time</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <div class="input-group bootstrap-timepicker">
                            <?php
                            echo $this->Form->input('Event.end_time', array('type' => 'text', 'id' => 'end_time', 'data-required' => 'true'));
                            ?>
                            <span class="input-group-addon"><i class="icon-time"></i></span>
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <label for="input_name" class="req">Activity With</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('Event.agent_id', array('options' => $agents, 'empty' => '--Select--', 'data-required' => 'true'));
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input_name" class="req">Details</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('Event.event_type_desc', array('options' => $activity_deatils, 'empty' => '--Select--', 'data-required' => 'true'));
                        ?>
                    </div>
                </div>
            </div>
        </div>                                                    
    </div>


    <div class="col-sm-12 spacer allocation" style="display:none;">

            <div class="lf-space">
                <?php echo $this->Form->input('Event.event_level_desc', array('type' => 'textarea')); ?>
            </div>
        </div>

    <div class="row spacer">
        <div class="col-sm-12">
            <?php echo $this->Form->submit('Add Action', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
            echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
            ?>
        </div>
    </div>
    <?php echo $this->Form->end();
    ?>
</div>	

<script type="text/javascript">

    $(document).ready(function() {

        var FULL_BASE_URL = $('#hidden_site_baseurl').val();
        $('#type_id').change(function() {
            var val = $(this).val();
            if (val == '6') {
                $('.allocation').css('display', 'block');
            }
            else
                $('.allocation').css('display', 'none');
        });

    });
    function validation() {

    }
</script>		
<!----------------------------end add project block------------------------------>
