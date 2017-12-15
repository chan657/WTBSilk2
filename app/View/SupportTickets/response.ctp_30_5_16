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
//pr($this->data);
?>

<!----------------------------start add project block------------------------------>
<?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
echo $this->Form->create('SupportTicket', array('method' => 'post', 'enctype' => 'multipart/form-data', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
        //array('controller' => 'reimbursements', 'action' => 'add')
));
//echo $this->Form->text('answer', array('value' => $this->data['SupportTicket']['answer']));
echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
?>
<style type="text/css">
        .group{
            overflow: hidden;
            margin-bottom: 10px;
            padding: 15px;
        }
        .blue{
            background-color: rgb(211, 233, 237);
        }
        .grey{
             background-color: #F5F5F5;
        }
</style>        
<div class="content">
    <div class="pop-up-hdng">Respond to Support Ticket</div>

    <div class="col-sm-12">
        <div class="group blue">
        <div class="form-group">
            <label>The Issue</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
<?php echo $this->data['Answer']['question']; ?>            
            </div>            
        </div>

        <div class="form-group">
            <label><?php echo $this->data['SupportTicket']['question_id1']; ?>  </label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
<?php echo $this->data['SupportTicket']['answer1']; ?>            
            </div>            
        </div>

        <div class="form-group">
            <label><?php echo $this->data['SupportTicket']['question_id2']; ?>  </label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
<?php echo $this->data['SupportTicket']['answer2']; ?>    

            </div>            
        </div>
        
        
        <div class="form-group">
            <label>How Many Hotels Here (approx)?</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
<?php echo $this->data['SupportTicket']['hotel_range']; ?>                       
            </div>            
        </div>
        <div class="form-group">
                        <label>Comments</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php echo $this->data['SupportTicket']['description']; ?>            
                        </div>            
                    </div>
        <div class="form-group">
                        <label>Attachments</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">

                            <?php if ($this->data['SupportTicket']['file'] <> '') { ?> 
                                <a href="<?php echo $this->webroot . 'uploads/SpportTicket/' . $this->data['SupportTicket']['file']; ?>" download>Click here to download...</a>
                            <?php }
                            else
                                echo 'No file';
                            ?>
                        </div>            
                    </div>
       </div> 
        <div class="form-group">
            <label class="req">What's the Issue?</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
<?php echo $this->Form->input('response_issue_id', array('options' => $LookupResponseIssues, 'empty' => '--Select--', 'data-required' => 'true')); ?>                       
            </div>            
        </div>
        <div class="form-group">
            <label class="req">Issue Level Assessment</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
<?php echo $this->Form->input('response_level_assessment', array('options' => array('Correct' => 'Correct','Incorrect' => 'Incorrect'), 'empty' => '--Select--', 'data-required' => 'true')); ?>                       
            </div>            
        </div>
        <div class="form-group">
            <label class="req">What's the Solution?</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
<?php echo $this->Form->input('response', array('options' => $solution, 'empty' => '--Select--', 'data-required' => 'true')); ?>                       
            </div>            
        </div>
                <?php
                if($this->data['SupportTicket']['answer'] == '1' || $this->data['SupportTicket']['answer'] == '2' || $this->data['SupportTicket']['answer'] == '3'
                        || $this->data['SupportTicket']['answer'] == '4' || $this->data['SupportTicket']['answer'] == '5' || $this->data['SupportTicket']['answer'] == '6' || $this->data['SupportTicket']['answer'] == '27'){
                    ?>
        <div class="form-group">
            <label class="req">Continent</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
<?php echo $this->Form->input('continent', array('options' => $TravelLookupContinent, 'empty' => '--Select--', 'data-required' => 'true')); ?>                       
            </div>            
        </div>
        <div class="form-group">
            <label class="req">Country</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
<?php echo $this->Form->input('country', array('options' => array(), 'empty' => '--Select--', 'data-required' => 'true')); ?>                       
            </div>            
        </div>
        <div class="form-group">
            <label>Province</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
<?php echo $this->Form->input('province', array('options' => array(), 'empty' => '--Select--')); ?>                       
            </div>            
        </div>
        <div class="form-group">
            <label>City</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
<?php echo $this->Form->input('city', array('options' => array(), 'empty' => '--Select--')); ?>                       
            </div>            
        </div>
        <div class="form-group">
            <label>Suburb</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
<?php echo $this->Form->input('suburb', array('options' => array(), 'empty' => '--Select--')); ?>                       
            </div>            
        </div>
        <div class="form-group">
            <label>Area</label>
            <span class="colon">:</span>
            <div class="col-sm-10" style="padding-top:6px;">
<?php echo $this->Form->input('area', array('options' => array(), 'empty' => '--Select--')); ?>                       
            </div>            
        </div>
        
        <?php
                }
             else{   
                
                
                foreach ($DataArray as $values) {
                    ?>
            <!--
            <div class="col-sm-6">
            <div class="form-group">
                <span><?php echo $values['LookupQuestion']['question']; ?></span>          
                        </div>
                </div>
            -->
            <div class="form-group">

                <label class="req"><?php echo $values['LookupQuestion']['question']; ?></label>          
                <span class="colon">:</span>         
    <?php
            if ($values['LookupQuestion']['id'] == '21') {
                        ?>


                    <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('response1', array('label' => false, 'div' => false, 'options' => $TechnicalIssue, 'empty' => '--Select--', 'data-required' => 'true')); ?>            
                    </div>           
        <?php
    } elseif ($values['LookupQuestion']['id'] == '25') {
        ?>


                    <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('response1', array('label' => false, 'div' => false, 'type' => 'text', 'placeholder' => 'Type the description here', 'data-required' => 'true')); ?>            
                    </div>           
                    <?php
                } elseif ($values['LookupQuestion']['id'] == '26') {
                    ?>


                    <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('response2', array('label' => false, 'div' => false, 'type' => 'text', 'placeholder' => 'Type the description here', 'data-required' => 'true')); ?>            
                    </div>           
                    <?php
                }
                ?>


            </div>
                <?php
            }
            }
            
            ?>
             <div class="form-group">
                <label>Do you have a Screenshot?</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->file('response_file'); ?>            
                </div>            
            </div> 
            <div class="form-group">
                <label>Comments</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                <?php 
                echo $this->Form->input('response_comment', array('type' => 'textarea','style' => 'width:100%;height:100px'));
                ?>
                <?php echo $this->Form->submit('Add', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit','style'=>'width:20% !important')); ?>
                </div>
            </div>

    </div>

    <!--     <div class="col-sm-12">
             <div style="clear: both;"></div>
                <div id="question_ajax"></div>
         </div>-->
    <div class="col-sm-12 fullrow evt">

    </div>
    <!--     <div class="row">
            <div class="col-sm-12" style="text-align:center;"><?php
            ?></div>
        </div> -->

</div>	
<?php echo $this->Form->end();
?>
<script>
    var FULL_BASE_URL = $('#hidden_site_baseurl').val(); // For base path of value;
    var answer = $('#SupportTicketAnswer').val();
    var model = 'SupportTicket';

    //if (answer == '1' || answer == '2') {
        $('#SupportTicketContinent').change(function() {
            var continent_id = $(this).val();            
            var dataString = 'continent_id=' + continent_id + '&model=' + model;
            //$('#ReimbursementReimbursementType2').attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                data: dataString,
                url: FULL_BASE_URL + '/all_functions/ajax_get_travel_country_by_continent_id',
                beforeSend: function() {
                    $('#SupportTicketCountry').attr('disabled', 'disabled');
                    //return false;
                },
                success: function(return_data) {
                    $('#SupportTicketCountry').removeAttr('disabled');
                    $('#SupportTicketCountry').html(return_data);
                }
            });
        });
        
      $('#SupportTicketCountry').change(function() {

        var country_id = $(this).val();       
        var dataString = 'country_id=' + country_id + '&model=' + model;

        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/ajax_get_province_by_country_id',
            
            beforeSend: function() {
                $('#SupportTicketProvince').attr('disabled', 'disabled');
                //return false;
            },
            success: function(return_data) {
            $('#SupportTicketProvince').removeAttr('disabled');
            $('#SupportTicketProvince').html(return_data);	 
            }
        });      
     });
     
     $('#SupportTicketProvince').change(function() {

        var province_id = $(this).val();       
        var dataString = 'province_id=' + province_id + '&model=' + model;

        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/ajax_get_travel_city_by_province',
            
            beforeSend: function() {
                $('#SupportTicketCity').attr('disabled', 'disabled');
                //return false;
            },
            success: function(return_data) {
            $('#SupportTicketCity').removeAttr('disabled');
                $('#SupportTicketCity').html(return_data);
            }
        });      
      });
      
      $('#SupportTicketCity').change(function() {

        var city_id = $(this).val();       
        var dataString = 'city_id=' + city_id + '&model=' + model;

        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/ajax_get_travel_suburb_by_city',
            
            beforeSend: function() {
                $('#SupportTicketSuburb').attr('disabled', 'disabled');
                //return false;
            },
            success: function(return_data) {
            $('#SupportTicketSuburb').removeAttr('disabled');
                $('#SupportTicketSuburb').html(return_data);
            }
        });      
      });
      
      $('#SupportTicketSuburb').change(function() {

        var suburb_id = $(this).val();       
        var dataString = 'suburb_id=' + suburb_id + '&model=' + model;

        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/ajax_get_travel_area_by_suburb',
            
            beforeSend: function() {
                $('#SupportTicketArea').attr('disabled', 'disabled');
                //return false;
            },
            success: function(return_data) {
                $('#SupportTicketArea').removeAttr('disabled');
                $('#SupportTicketArea').html(return_data);
            }
        });      
      });
    //}






</script>