<?php

echo $this->Html->css(array('/bootstrap/css/bootstrap.min','popup',
									
									'font-awesome/css/font-awesome.min',
									
									'/js/lib/datepicker/css/datepicker',
									'/js/lib/timepicker/css/bootstrap-timepicker.min'
									
									
									)
							);
echo $this->Html->script(array('jquery.min','lib/chained/jquery.chained.remote.min','lib/jquery.inputmask/jquery.inputmask.bundle.min','lib/parsley/parsley.min','pages/ebro_form_validate','lib/datepicker/js/bootstrap-datepicker','lib/timepicker/js/bootstrap-timepicker.min','pages/ebro_form_extended'));
		/* End */
		//pr($this->data);
		//pr($this->data);
?>

<!----------------------------start add project block------------------------------> 
<?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
echo $this->Form->create('SupportTicket', array('method' => 'post','enctype' => 'multipart/form-data', 'id' => 'parsley_reg', 'onsubmit' => 'return validation()', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
    //array('controller' => 'reimbursements', 'action' => 'add')
));
echo $this->Form->hidden('continent_id',array('value' => $continent_id,'type' => 'text'));
echo $this->Form->hidden('country_id',array('value' => $country_id,'type' => 'text'));
echo $this->Form->hidden('province_id',array('value' => $province_id,'type' => 'text'));
echo $this->Form->hidden('city_id',array('value' => $city_id,'type' => 'text'));
echo $this->Form->hidden('suburb_id',array('value' => $suburb_id,'type' => 'text'));
echo $this->Form->hidden('hotel_id',array('value' => $hotel_id,'type' => 'text'));
echo $this->Form->hidden('brand_id',array('value' => $brand_id,'type' => 'text'));
echo $this->Form->hidden('chain_id',array('value' => $chain_id,'type' => 'text'));

echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
?>
<style>
    .loader{
        width: 100%;
        opacity: 0.4;
        height: 471px;
        background-color: #000;
        position: absolute;
        z-index: 99999;
        float: left;
    }
</style>
<div class="content">
    <div class="pop-up-hdng">Create Support Ticket</div>

    <div class="col-sm-12">
        <div id="ajax"></div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="req">Screen</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('screen', array('options' => $LookupScreen, 'disabled' => 'true')); ?>
                </div>
            </div>
            <div class="form-group">
                <label>About</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php 
                    if ($screen == 10) {
                        echo $this->Form->input('about', array('options' => $SupplierHotel));                         
                    } else {
                        echo $this->Form->input('about', array('options' => $TravelHotelLookup));                         
                    }

                    ?>

                </div>

            </div>
            <div class="form-group">
                <label class="req">Urgency</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('urgency', array('options' => $LookupTicketUrgency,'class' => 'pointer', 'empty' => '--Select--', 'data-required' => 'true')); ?>            
                </div>            
            </div>

            <div class="form-group">
                <label class="req">What is the issue?</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer', array('options' => $LookupQuestion,'class' => 'pointer', 'empty' => '--Select--', 'data-required' => 'true')); ?>            
                </div>            
            </div>

            <?php if($display == true){?>

            <?php 
//pr($DataArray);
$i=1;
foreach($DataArray as $values){
    
    echo $this->Form->hidden('question_id'.$i,array('value' => $values['LookupQuestion']['question']));
    $i++;
    ?>
            <!--
            <div class="col-sm-6">
            <div class="form-group">
                <span><?php echo $values['LookupQuestion']['question'];?></span>          
                        </div>
                </div>
            -->
            <div class="form-group">

                <label class="req"><?php echo $values['LookupQuestion']['question'];?></label>          
                <span class="colon">:</span>         
    <?php 
    if($values['LookupQuestion']['id'] == '9' || $values['LookupQuestion']['id'] == '11'){
    ?>

                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer1', array('label'=> false,'id' => 'continetId','div'=>false,'options'=>$TravelLookupContinent,'empty'=>'--Select--')); ?>            
                </div>           

    <?php }
    elseif($values['LookupQuestion']['id'] == '10' || $values['LookupQuestion']['id'] == '12'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer2', array('label'=> false,'id' => 'countryId','div'=>false,'options'=>array(),'empty'=>'--Select--')); ?>            
                </div>           

    <?php
    }
    elseif($values['LookupQuestion']['id'] == '13'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer1', array('label'=> false,'id' => 'ProvinceCountry','div'=>false,'options'=>$TravelCountries,'empty'=>'--Select--')); ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '14'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer2', array('label'=> false,'id' => 'Province','div'=>false,'options'=>array(),'empty'=>'--Select--')); ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '15'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer1', array('label'=> false,'id' => 'ProvinceCity','div'=>false,'options'=>$Provinces,'empty'=>'--Select--')); ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '16'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer2', array('label'=> false,'id' => 'City','div'=>false,'options'=>array(),'empty'=>'--Select--')); ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '17'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer1', array('label'=> false,'div'=>false,'options'=>$TravelCities,'empty'=>'--Select--')); ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '19'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer1', array('label'=> false,'div'=>false,'options'=>$TravelSuburbs,'empty'=>'--Select--')); ?>            
                </div>           

    <?php
    }
    elseif($values['LookupQuestion']['id'] == '18' || $values['LookupQuestion']['id'] == '20'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer2', array('label'=> false,'div'=>false,'type' => 'text','placeholder' => 'Type the name here')); ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '21'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer1', array('label'=> false,'div'=>false,'options'=>$TechnicalIssue,'empty'=>'--Select--'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '25'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer1', array('label'=> false,'div'=>false,'type' => 'text','placeholder' => 'Type the description here'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '26'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer2', array('label'=> false,'div'=>false,'type' => 'text','placeholder' => 'Type the description here'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '28'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer1', array('label'=> false,'div'=>false,'options'=>$TravelHotelLookups,'empty'=>'--Select--'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '31'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer1', array('label'=> false,'div'=>false,'type' => 'text'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '32'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer2', array('label'=> false,'div'=>false,'type' => 'text'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '33'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer1', array('label'=> false,'div'=>false,'options'=>$TravelChains,'empty'=>'--Select--'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '34'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer2', array('label'=> false,'div'=>false,'type' => 'text'));  ?>            
                </div>           
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '42'){
    ?>

        <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer1', array('label'=> false,'div'=>false,'options'=>$AmenityCategories,'empty'=>'--Select--'));  ?>            
                </div> 
    
    <?php } elseif($values['LookupQuestion']['id'] == '43'){ ?>
    <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer2', array('label'=> false,'div'=>false,'type' => 'text'));  ?>            
                </div> 
    <?php } elseif($values['LookupQuestion']['id'] == '44'){ ?>
    <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer3', array('label'=> false,'div'=>false,'type' => 'text'));  ?>            
                </div> 
    <?php } elseif($values['LookupQuestion']['id'] == '45'){ ?>
        <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer4', array('label'=> false,'div'=>false,'type' => 'text'));  ?>            
                </div> 
    <?php } elseif($values['LookupQuestion']['id'] == '46'){ ?>
        <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer5', array('label'=> false,'div'=>false,'type' => 'text'));  ?>            
                </div> 
    <?php
    }
    elseif($values['LookupQuestion']['id'] == '57'){
        ?>


                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('answer1', array('label'=> false,'div'=>false,'options'=>$SupplierHotels,'empty'=>'--Select--'));  ?>            
                </div>           
    <?php } ?>    
            </div>
<?php
}

?>












            <div class="form-group">
                <label>How Many Hotels Here (approx)?</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->input('hotel_range', array('options' => array('0 - 5' => '0 - 5','5 - 10' => '5 - 10','10 - 20' => '10 - 20','> 20' => '> 20'),'class' => 'pointer', 'empty' => '--Select--')); ?>            
                </div>            
            </div>
            <div class="form-group">
                <label>Do you have a Screenshot?</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                    <?php echo $this->Form->file('file'); ?>            
                </div>            
            </div> 
            <div class="form-group">
                <label>Description</label>
                <span class="colon">:</span>
                <div class="col-sm-10" style="padding-top:6px;">
                <?php 
                echo $this->Form->input('description', array('type' => 'textarea','style' => 'width:100%;height:100px'));
                ?>
                    <?php echo $this->Form->submit('Add', array('class' => 'success btn', 'div' => false, 'name' => 'add','style'=>'width:20% !important')); ?>
                </div>
            </div>
            <?php }else{?>
            <?php echo $this->Form->submit('Go', array('class' => 'success btn', 'div' => false, 'name' => 'issue','style'=>'width:20% !important')); 
            }
            ?>
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
    var model = 'SupportTicket';

    var Question = function () {

        var question_id = $(this).val();
        var continent_id = $('#SupportTicketContinentId').val();
        var country_id = $('#SupportTicketCountryId').val();
        var province_id = $('#SupportTicketProvinceId').val();
        var city_id = $('#SupportTicketCityId').val();
        var suburb_id = $('#SupportTicketSuburbId').val();
        var hotel_id = $('#SupportTicketHotelId').val();
        var chain_id = $('#SupportTicketChainId').val();
        var brand_id = $('#SupportTicketBrandId').val();

        var dataString = 'question_id=' + question_id + '&model=' + model + '&continent_id=' + continent_id + '&country_id=' + country_id + '&province_id=' + province_id + '&city_id=' + city_id + '&suburb_id=' + suburb_id + '&hotel_id=' + hotel_id + '&chain_id=' + chain_id + '&brand_id=' + brand_id;
        $('#ajax').addClass('loader');
        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/get_list_question_by_question_id',
            beforeSend: function () {
                $('#SupportTicketQuestionId1').attr('disabled', 'disabled');
                $('#ajax').addClass('loader');
                //return false;
            },
            success: function (return_data) {

                $('#SupportTicketQuestionId1').removeAttr('disabled');
                $('#question_ajax').html(return_data);
                $('#SupportTicketQuestionId,#continetId,#ProvinceCountry', '#ProvinceCity').unbind('change');
                $('#SupportTicketQuestionId').bind('change', Question);
                $('#continetId').bind('change', Country);
                $('#ProvinceCountry').bind('change', ProvinceCountry);
                $('#ProvinceCity').bind('change', ProvinceCity);
                $('#ajax').removeClass('loader');
            }
        });
    }

    var Country = function () {

        var continent_id = $(this).val();
        var dataString = 'continent_id=' + continent_id + '&model=' + model;

        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/ajax_get_travel_country_by_continent_id',
            beforeSend: function () {
                $('#countryId').attr('disabled', 'disabled');
                //return false;
            },
            success: function (return_data) {
                $('#countryId').removeAttr('disabled');
                $('#countryId').html(return_data);
                $('#SupportTicketQuestionId,#continetId,#ProvinceCountry', '#ProvinceCity').unbind('change');
                $('#SupportTicketQuestionId').bind('change', Question);
                $('#continetId').bind('change', Country);

            }
        });
    }

    var ProvinceCountry = function () {

        var country_id = $(this).val();
        var dataString = 'country_id=' + country_id + '&model=' + model;

        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/ajax_get_province_by_country_id',
            beforeSend: function () {
                $('#Province').attr('disabled', 'disabled');
                //return false;
            },
            success: function (return_data) {
                $('#Province').removeAttr('disabled');
                $('#Province').html(return_data);
                $('#SupportTicketQuestionId,#continetId,#ProvinceCountry').unbind('change');
                $('#SupportTicketQuestionId').bind('change', Question);
                $('#continetId').bind('change', Country);
                $('#ProvinceCountry').bind('change', ProvinceCountry);
            }
        });
    }

    var ProvinceCity = function () {

        var province_id = $(this).val();
        var dataString = 'province_id=' + province_id + '&model=' + model;

        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/ajax_get_travel_city_by_province',
            beforeSend: function () {
                $('#City').attr('disabled', 'disabled');
                //return false;
            },
            success: function (return_data) {
                $('#City').removeAttr('disabled');
                $('#City').html(return_data);
                $('#SupportTicketQuestionId,#continetId,#ProvinceCountry', '#ProvinceCity').unbind('change');
                $('#SupportTicketQuestionId').bind('change', Question);
                $('#continetId').bind('change', Country);
                $('#ProvinceCountry').bind('change', ProvinceCountry);
                $('#ProvinceCity').bind('change', ProvinceCity);
            }
        });
    }


    $('#SupportTicketQuestionId').bind('change', Question);
    $('#continetId').bind('change', Country);
    $('#ProvinceCountry').bind('change', ProvinceCountry);
    $('#ProvinceCity').bind('change', ProvinceCity);

    function validation() {

        var QuestionId = $('#SupportTicketQuestionId').val();
        if (QuestionId == '5' || QuestionId == '6') {

            if ($('#SupportTicketHotelRange').val() == '')
            {
                alert('Please select how many hotels here');
                return false;
            }
        }
        if ($('#continetId').val() == '')
        {
            alert('Please select continent');
            return false;
        }
        if ($('#countryId').val() == '')
        {
            alert('Please select country');
            return false;
        }
        if ($('#ProvinceCountry').val() == '')
        {
            alert('Please select country');
            return false;
        }
        if ($('#Province').val() == '')
        {
            alert('Please select province');
            return false;
        }
        if ($('#ProvinceCity').val() == '')
        {
            alert('Please select province');
            return false;
        }
        if ($('#City').val() == '')
        {
            alert('Please select city');
            return false;
        }
        if ($('#SupportTicketAnswer1').val() == '')
        {
            alert('Please select answer');
            return false;
        }
        if ($('#SupportTicketAnswer2').val() == '')
        {
            alert('Please select answer');
            return false;
        }
    }

    /*
     $('#SupportTicketQuestionId').change(function() {
     var question_id = $(this).val();
     var model = 'SupportTicket';
     
     var dataString = 'question_id=' + question_id + '&model=' + model;
     //$('#ReimbursementReimbursementType2').attr('disabled', 'disabled');
     $.ajax({
     type: "POST",
     data: dataString,
     url: FULL_BASE_URL + '/all_functions/get_list_question_by_question_id',
     beforeSend: function() {
     $('#SupportTicketQuestionId1').attr('disabled', 'disabled');
     //return false;
     },
     success: function(return_data) {
     $('#SupportTicketQuestionId1').removeAttr('disabled');
     $('#question_ajax').html(return_data);
     }
     });
     
     });
     */


</script>
