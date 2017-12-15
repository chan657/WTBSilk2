<?php $this->Html->addCrumb('Edit Event', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>

<!----------------------------start add project block------------------------------>
<div class="content">



    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
    echo $this->Form->create('Event', array('action' => 'edit', 'method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
        'inputDefaults' => array(
            'label' => false,
            'div' => false,
            'class' => 'form-control',
        )
    ));


    $start_date = date('d-m-Y', strtotime($this->data['Event']['start_date']));
    $end_date = date('d-m-Y', strtotime($this->data['Event']['end_date']));

    if ($this->data['Event']['activity_past'] == 'Yes') {

        $past_div = 'style="display:inline-table"';
        $present_div = 'style="display:none"';
    } else {
        $present_div = 'style="display:inline-table"';
        $past_div = 'style="display:none"';
    }
    ?>
    <input type="hidden" id="hidden_site_baseurl" value="<?php echo $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : ''); ?>"  />
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-12" id="mycl-det">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit Event</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tbb_a">Primary Information</a></li>
                                    <li><a data-toggle="tab" href="#tbb_b">Reimbursement Details</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div id="tbb_a" class="tab-pane active">

                                        <p>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="reg_input_name" class="req">Past Event?</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10 txtbox"> <?php
    echo $this->Form->input('activity_past', array('id' => 'activity_past', 'options' => array('Yes' => 'Yes', 'No' => 'No'), 'data-required' => 'true'));
    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" >      
                                            <div class="form-group" >
                                                <label for="reg_input_name" class="req">Start Date</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true" <?php echo $present_div; ?> >
<?php
echo $this->Form->input('start_date_present', array('id' => 'dpd1', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $start_date));
?>
                                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                    </div>
                                                    <div class="input-group date ebro_datepicker event_date_past_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true" <?php echo $past_div; ?> >
                                                        <?php
                                                        echo $this->Form->input('start_date_past', array('id' => 'start_date_past', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $start_date));
                                                        ?>
                                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                    </div>                            

                                                </div>
                                            </div>
                                            <div class="form-group imp">
                                                <label for="input_name" class="req">From</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <div class="input-group bootstrap-timepicker">
<?php
echo $this->Form->input('start_time', array('type' => 'text', 'id' => 'start_time', 'value' => date('g:i A', strtotime($this->data['Event']['start_date']))));
?>
                                                        <span class="input-group-addon"><i class="icon-time"></i></span>
                                                    </div>

                                                </div>
                                                <br class="spacer" />
                                            </div>
                                            <div class="form-group">
                                                <label for="input_name" class="req">Activity Level</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php
echo $this->Form->input('activity_level', array('id' => 'activity_level', 'options' => $activity_levels, 'empty' => '--Select--', 'data-required' => 'true'));
?>
                                                </div>

                                            </div>
                                            <div class="form-group activity_type">
                                                <label for="input_name" class="req">Activity Type</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php echo $this->Form->input('activity_type', array('options' => $activity_types, 'empty' => '--Select--'));
?>
                                                </div>

                                            </div>
                                            <div class="form-group attended1">
                                                <label>Attended By 1</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php
echo $this->Form->input('event_attended_by_1', array('options' => $attendes, 'class' => 'form-control client', 'empty' => '--Select--'));
?>
                                                </div>
                                            </div>
                                            <div class="form-group attended23">
                                                <label>Attended By 2</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('event_attended_by_2', array('options' => $attendes, 'class' => 'form-control client pre_bootbox_custom', 'empty' => '--Select--'));
                                                    ?>
                                                </div>
                                            </div>   
                                        </div>
                                        <div class="col-sm-6">      
                                            <div class="form-group" >
                                                <label for="input_name" class="req">End Date</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <div class="input-group date ebro_datepicker event_date_present_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true" <?php echo $present_div; ?> >
<?php
echo $this->Form->input('end_date_present', array('id' => 'dpd2', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $end_date, 'onchange' => 'fllowupdate(this.value)'));
?>
                                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                    </div>
                                                    <div class="input-group date ebro_datepicker event_date_past_div" data-date-format="dd-mm-yyyy" data-date-autoclose="true" <?php echo $past_div; ?> >
                                                        <?php
                                                        echo $this->Form->input('end_date_past', array('id' => 'end_date_past', 'type' => 'text', 'data-date-format' => 'dd-mm-yyyy', 'data-date-autoclose' => 'true', 'value' => $end_date, 'onchange' => 'fllowupdate(this.value)'));
                                                        ?>
                                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                    </div>                                

                                                </div>
                                            </div>
                                            <div class="form-group imp">
                                                <label for="input_name" class="req">To</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <div class="input-group bootstrap-timepicker">
                                                        <?php
                                                        echo $this->Form->input('end_time', array('type' => 'text', 'id' => 'end_time', 'value' => date('g:i A', strtotime($this->data['Event']['end_date']))));
                                                        ?>
                                                        <span class="input-group-addon"><i class="icon-time"></i></span>
                                                    </div>

                                                </div>
                                                <br class="spacer" />
                                            </div>  
                                            <div class="form-group activity_with">
                                                <label for="input_name" class="req">Activity With</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">

<?php
if ($this->data['Event']['activity_level'] == '3')
    echo $this->Form->input('project_id', array('id' => 'project_id', 'options' => $projects, 'div' => array('class' => 'project_id with'), 'empty' => '--Select--'));
else if ($this->data['Event']['activity_level'] == '2')
    echo $this->Form->input('builder_id', array('id' => 'builder_id', 'options' => $builders, 'div' => array('class' => 'builder_id with'), 'empty' => '--Select--'));
else if ($this->data['Event']['activity_level'] == '1')
    echo $this->Form->input('lead_id', array('id' => 'lead_id', 'options' => $clients, 'div' => array('class' => 'lead_id_div with'), 'empty' => '--Select--'));
?>


                                                </div>
                                            </div>
                                            <div class="form-group activity_type">
                                                <label for="input_name" class="req">Details</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
                                                    <?php
                                                    echo $this->Form->input('event_type_desc', array('options' => $activity_details, 'empty' => '--Select--', 'data-required' => true));
                                                    ?>


                                                </div>
                                            </div> 
                                            <div class="form-group site_project_id">
                                                <label>Project Site</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php
echo $this->Form->input('site_visit_project_id', array('options' => $projects, 'empty' => '--Select--'));
?>
                                                </div>
                                            </div>
                                            <div class="form-group attended23">
                                                <label>Attended By 3</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10">
<?php
echo $this->Form->input('event_attended_by_3', array('options' => $attendes, 'class' => 'form-control client', 'empty' => '--Select--'));
?>
                                                </div>
                                            </div>

                                            <!--<div class="form-group activity_completed">
                                                <label>Completed?</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10 checkbox-cont"><?php
$options = array('1' => 'Yes', '2' => 'No');

$attributes = array('legend' => false, 'escape' => false, 'hiddenField' => false, 'class' => 'completed');

echo $this->Form->radio('activity_completed', $options, $attributes);
?>
                                        
                                                </div>
                                                
                                            </div>-->

                                        </div>     
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="input_name" class="req">Describe</label>
                                                <span class="colon">:</span>
                                                <div class="col-sm-10 txtbox">
                                            <?php echo $this->Form->input('event_level_desc', array('type' => 'textarea', 'data-required' => true)); ?>
                                                </div>
                                            </div>
                                        </div>

<?php echo $this->Form->submit('Update', array('class' => 'success btn', 'div' => false)); ?>
                                        </p>
                                    </div>
                                    <div id="tbb_b" class="tab-pane">

                                        <p>
<!--<span class="badge badge-circle add-client nomrgn">
<i class="icon-plus" ></i>

                                                    <?php echo $this->Html->link('Add Reimbursement', '/reimbursements/add' . $this->data['Event']['id'], array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)); ?></span>-->

                                        <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                                            <thead>
                                                <tr>
                                                    <th>Sl.</th>
                                                    <th>Expense Date</th>
                                                    <th>Expense By</th>
                                                    <th>Expense Level</th>
                                                    <th>Expense With</th>
                                                    <th>Expense Type</th>
                                                    <th>Expense For</th>
                                                    <th>Expense Factor1</th>
                                                    <th>Expense Factor1</th>
                                                    <th>Expense Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
//pr($Reimbursements);
if (isset($Reimbursements) && count($Reimbursements) > 0):
    $i = 1;
    foreach ($Reimbursements as $Reimbursement):
        $id = $Reimbursement['Reimbursement']['id'];
        ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo date('d/m/Y', strtotime($Reimbursement['Reimbursement']['created'])); ?></td>
                                                            <td><?php echo $Reimbursement['SubmittedBy']['fname'] . ' ' . $Reimbursement['SubmittedBy']['mname'] . ' ' . $Reimbursement['SubmittedBy']['lname']; ?></td>
                                                            <td><?php echo $Reimbursement['Level']['value']; ?></td>
                                                            <td><?php echo $Reimbursement['Reimbursement']['reimbursement_with']; ?></td>
                                                            <td><?php echo $Reimbursement['Type']['value']; ?></td>
                                                            <td><?php echo $Reimbursement['For']['value']; ?></td>
                                                            <td><?php echo $Reimbursement['Reimbursement']['reimbursement_factor_1']; ?></td>
                                                            <td><?php echo $Reimbursement['Reimbursement']['reimbursement_factor_2']; ?></td>
                                                            <td><?php echo $Reimbursement['Reimbursement']['reimbursement_amount']; ?></td>
                                                            <td><?php echo $this->Html->link('<span class="icon-pencil"></span>', '/reimbursements/edit/' . $id, array('class' => 'act-ico open-popup-link', 'escape' => false)); ?></td>
                                                        </tr>

        <?php
        $i++;
    endforeach;
endif;
?>

                                            </tbody>
                                        </table>

                                        </p>
                                        <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Reimbursement', '/reimbursements/add/' . $this->data['Event']['id'], array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)); ?></span>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div></div>
    </div>


<?php echo $this->Form->end();
?>
</div>	


<script type="text/javascript">


    $(document).ready(function(e) {

        var FULL_BASE_URL = $('#hidden_site_baseurl').val(); // For base path of value;



        $('#activity_level').change(function() {
            var type_id = $(this).val();
            var model = 'Event';
            var dataString = 'type_id=' + type_id;
            $('#EventEventTypeDesc').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                data: dataString,
                url: FULL_BASE_URL + '/all_functions/get_activity_desc_by_typeId',
                beforeSend: function() {
                    $('#EventEventTypeDesc').attr('disabled', 'disabled');
                    //return false;
                },
                success: function(return_data) {
                    $('#EventEventTypeDesc').removeAttr('disabled');
                    $('#EventEventTypeDesc').html(return_data);
                }
            });

        });


        $('.next_tab').click(function(event) {
            //alert('asd');
            $('.nav li:first').removeClass('active');
            href_id = $(this).attr('href');
            //alert($(this).attr('href').nav li > a);
            //$( "li.item-a" ).closest( "li" ).addClass('active');
            $('a').attr('href,#tbb_b').closest("li").addClass('active');
            //$('.nav > a:#tbb_b').closest( "li" ).addClass('active');
            //$(this).addClass('active');
            //alert(class);
        });

        /************************Total Amount ************************/



        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        //newDate.setDate(newDate.getDate() + 1);
        // alert(setDate(now + 1));
        /************************Present event ***************************/

        var checkin = $('#dpd1').datepicker({
            startDate: '-0m',
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {


            $('#dpd2').val($('#dpd1').val());
            $('#start_date').val($('#dpd1').val());
            $('#endt_date').val($('#dpd1').val());

            /*
             if (ev.date.valueOf() > checkout.date.valueOf()) {
             var newDate = new Date(ev.date);
             newDate.setDate(newDate.getDate() + 1);
             checkout.setValue(newDate);
             }
             */
            checkin.hide();
            //$('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
            startDate: '-0m',
            onRender: function(date) {
                return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            $('#start_date').val($('#dpd2').val());
            $('#end_date').val($('#dpd2').val());

            //$('#ReimbursementReimbursementBillSubmissionDate').val($('#dpd2').val());
            checkout.hide();
        }).data('datepicker');




        /************************past event ***************************/


        var start_date_past = $('#start_date_past').datepicker({
            endDate: '-0m',
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            $('#end_date_past').val($('#start_date_past').val());
            $('#start_date').val($('#start_date_past').val());
            $('#end_date').val($('#start_date_past').val());
            start_date_past.hide();
            //$('#end_date_past')[0].focus();
        }).data('datepicker');

        var end_date_past = $('#end_date_past').datepicker({
            endDate: '-0m',
            onRender: function(date) {

                return date.valueOf() <= start_date_past.date.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            $('#start_date').val($('#end_date_past').val());
            $('#end_date').val($('#end_date_past').val());

            //$('#ReimbursementReimbursementBillSubmissionDate').val($('#end_date_past').val());
            //$('#ReimbursementReimbursementBillSubmissionDate').val($('#end_date_past').val());
            end_date_past.hide();
        }).data('datepicker');

        $('#activity_past').change(function() {
            var value = $(this).val();
            if (value == 'Yes')
            {
                $('#event_id').css('display', 'block');
                $('.event_date_present_div').css('display', 'none');
                $('.event_date_past_div').css('display', 'inline-table');
                //alert('sdf');
                //$('#EventActivityCompleted2').removeAttr('checked');
                //$('#EventActivityCompleted2').removeAttr('checked');	
                $("#EventActivityCompleted1").prop("checked", true);
                $('#EventActivityCompleted2').attr('disabled', false);
                $('#EventActivityCompleted1').attr('disabled', false);
                $('#start_date_past').val('');
                $('#end_date_past').val('');

            }
            else {
                $('#event_id').css('display', 'block');
                $('.event_date_past_div').css('display', 'none');
                $('.event_date_present_div').css('display', 'inline-table');
                //$('#EventActivityCompleted1').attr('checked','');
                $("#EventActivityCompleted2").prop("checked", true);
                $('#EventActivityCompleted2').attr('disabled', true);
                $('#EventActivityCompleted1').attr('disabled', true);
                //$('#EventActivityCompleted2').attr('checked','checked');
                //$('#EventActivityCompleted1').removeAttr('checked');
                $('#dpd1').val('');
                $('#dpd2').val('');

            }
        });

    });

</script>		
<!----------------------------end add project block------------------------------>
