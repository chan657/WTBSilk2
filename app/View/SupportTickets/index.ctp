<?php $this->Html->addCrumb('Support Ticket', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>
    <div align="center" class="col-sm-12" style="font-size: 15px; font-family: sans-serif" >
    <p style="color: black; background-color: #f2d7d5"><strong>
       <?php if($msg_flag == 'Y'){ 
                echo $msg;
        }                
       ?>
     </strong></p>
    </div> 
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span>Support Ticket</h4>
           
           
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('SupportTicket', array('controller' => 'travel_areas', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 

                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('about', array('placeholder' => 'Type raised about', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                    <div class="row" id="search_panel_controls">
                    
					<div class="col-sm-3 col-xs-6">
                        <label for="un_member">Continent:</label>
                        <?php echo $this->Form->input('continent_id', array('options' => $TravelLookupContinentsSearch, 'empty' => '--Select--', 'value' => $continent_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('country_id', array('options' => $TravelCountriesSearch, 'empty' => '--Select--', 'value' => $country_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Province:</label>
                        <?php echo $this->Form->input('province_id', array('options' => $ProvincesSearch, 'empty' => '--Select--', 'value' => $province_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('city_id', array('options' => $TravelCitiesSearch, 'empty' => '--Select--', 'value' => $city_id)); ?>
                    </div>
					
					
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Raised By:</label>
                        <?php echo $this->Form->input('created_by', array('options' => $users, 'empty' => '--Select--')); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Raised From:</label>
                        <?php echo $this->Form->input('screen', array('options' => $LookupScreen, 'empty' => '--Select--')); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Topic:</label>
                        <?php echo $this->Form->input('answer', array('options' => $LookupQuestion, 'empty' => '--Select--')); ?>
                    </div>

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Urgency:</label>
                        <?php echo $this->Form->input('urgency', array('options' => $LookupTicketUrgency, 'empty' => '--Select--')); ?>
                    </div>
                        
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Status:</label>
                        <?php echo $this->Form->input('status', array('options' => $LookupTicketStatus, 'empty' => '--Select--')); ?>
                    </div>



                    <div class="col-sm-3 col-xs-6">
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Filter', array('div' => false,'name' => 'search', 'class' => 'btn btn-default btn-sm"'));
// echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>
            
           <?php 
            echo $this->Form->create('SupportTicket', array('action' => 'index','onsubmit' => 'return ChkCheckbox()','class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )              
                   
                    )
                    
                        
                        );
            
            echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
          if ($self_id == '169') {
/*
              if($sql_generate == true)
          echo $this->Form->submit('SQL Generate', array('class' => 'success btn', 'div' => false,'id' => 'sql_generate', 'name' => 'sql_generate','style' => 'width:10%;margin-left:10px'));
 */
 
           if($update == true)
            echo $this->Form->submit('Update', array('class' => 'success btn', 'div' => false,'id' =>'update', 'name' => 'update','style' => 'width:10%;margin-left:10px'));
         
?>
            <div class="row" style="padding:15px">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">What's the Issue?</label>
                        <?php echo $this->Form->input('response_issue_id', array('options' => $LookupResponseIssue, 'empty' => '--Select--', 'data-required' => 'true')); ?> 
                    </div>                
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Issue Level Assessment:</label>
                        <?php echo $this->Form->input('response_level_assessment', array('options' => array('Correct' => 'Correct','Incorrect' => 'Incorrect'), 'empty' => '--Select--','onchange' => 'chkBottonEvnt()', 'data-required' => 'true')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">What's the Solution?:</label>
                        <?php echo $this->Form->input('response', array('options' => $solution, 'empty' => '--Select--', 'data-required' => 'true','onchange' => 'chkBottonEvnt()')); ?>                       
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Continent:</label>
                        <?php echo $this->Form->input('continent', array('options' => $TravelLookupContinent, 'empty' => '--Select--', 'data-required' => 'true','onchange' => 'chkBottonEvnt()')); ?>                       
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('country', array('options' => $TravelCountries, 'empty' => '--Select--', 'data-required' => 'true','onchange' => 'chkBottonEvnt()')); ?>                       
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Province:</label>
                       <?php echo $this->Form->input('province', array('options' => $Provinces, 'empty' => '--Select--','onchange' => 'chkBottonEvnt()')); ?>                       
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('city', array('options' => $TravelCities, 'empty' => '--Select--','onchange' => 'chkBottonEvnt()')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Suburb:</label>
                        <?php echo $this->Form->input('suburb', array('options' => $TravelSuburbs, 'empty' => '--Select--','onchange' => 'chkBottonEvnt()')); ?> 
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Area:</label>
                        <?php echo $this->Form->input('area', array('options' => $TravelAreas, 'empty' => '--Select--','onchange' => 'chkBottonEvnt()')); ?>  
                    </div>
            </div>
          <?php }?>
            
            <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="500">
               <thead>
                <tr>
                    <?php if ($self_id == '169') {?>
                    <th data-hide="phone" data-group="group1" width="2%" data-sort-ignore="true"><input type="checkbox" class="mbox_select_all" name="msg_sel_all" onclick="chkBottonEvnt()">  Include</th>
                    <?php }?>
                    <th>Ticket #</th>
                    <th>Related Ticket #</th>                    
                    <th class="hidden-sm hidden-xs">Raised By</th>
                    <th class="hidden-sm hidden-xs">Last Updated On</th>
                    <th class="hidden-sm hidden-xs">Raised From</th> 
                    <th class="hidden-sm hidden-xs">Raised About</th> 
                    <th class="hidden-sm hidden-xs">Topic</th>
                    <th>Urgency</th>
                    <th>Last Action By</th>
                    <th>Next Action By</th>
                    <th>Assessment</th>                    
                    <th>Current Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($SupportTickets) && count($SupportTickets) > 0):
                        foreach ($SupportTickets as $SupportTicket):
                            $id = $SupportTicket['SupportTicket']['id'];   
                            $status = $SupportTicket['SupportTicket']['status'];
                            if(in_array($id, $selected))
                                            $sele_check = 'checked';
                                    else
                                        $sele_check = '';
                            ?>
                            <tr>
                                <?php if ($self_id == '169') {?>
                               <td class="tablebody"><?php											
                                echo $this->Form->checkbox('check', array('name' => 'data[SupportTicket][check][]','class' => 'msg_select','onclick' => 'chkBottonEvnt()','readonly' => true,'hiddenField' => false,'value' => $id,$sele_check));
                                ?></td> 
                                <?php }?>
                               <td><?php echo $id; ?></td>
                               <td>
                                    <?php echo $this->Html->link($SupportTicket['SupportTicket']['related_ticket_id'], array('controller' => 'support_tickets', 'action' => 'view/'.$SupportTicket['SupportTicket']['related_ticket_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')); ?>                                   
                               </td>
                                <td><?php echo $this->Custom->Username($SupportTicket['SupportTicket']['created_by']); ?></td>
                                <td><?php echo $SupportTicket['SupportTicket']['modified']; ?></td>
                                <td><?php echo $SupportTicket['LookupScreen']['value']; ?></td>
                                <td><?php echo $SupportTicket['SupportTicket']['about']; ?></td>

                                <td><?php echo $SupportTicket['Answer']['question']; ?></td>
                                <td><?php echo $SupportTicket['LookupTicketUrgency']['value']; ?></td>
                                <td><?php echo ($SupportTicket['SupportTicket']['last_action_by']) ? $this->Custom->Username($SupportTicket['SupportTicket']['last_action_by']) : ''; ?></td>                               
                                <td><?php echo ($SupportTicket['SupportTicket']['next_action_by']) ? $this->Custom->Username($SupportTicket['SupportTicket']['next_action_by']) : ''; ?></td>

                                <td><?php 

                                echo $SupportTicket['SupportTicket']['response_level_assessment']; 
                                ?>
                                </td>
                                <td><?php echo $SupportTicket['LookupTicketStatus']['value']; ?></td>
                                <td width="10%" valign="middle" align="center">
                                    <?php
                                    
                                    
                                    if(($SupportTicket['SupportTicket']['last_action_by'] == $self_id || $SupportTicket['SupportTicket']['approved_by'] == $self_id) && ($SupportTicket['SupportTicket']['status'] == '1' || $SupportTicket['SupportTicket']['status'] == '2'  || $SupportTicket['SupportTicket']['status'] == '3')){
                                        echo $this->Html->link('<span class="icon-eye-open"></span>', '/support_tickets/view/'.$id,array('class' => 'add-btn','target' => '_blank','escape' => false));                                   
                                    }                                    
                                    else
                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/support_tickets/view/'.$id,array('class' => 'add-btn','target' => '_blank','escape' => false));                                   
                           
                       
                                    ?>
                                   
                                </td>


                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="11" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
            </tbody>
            </table>
            <?php echo $this->Form->end(); ?>


        </div>
    </div>
</div>


<?php
/*
 * Get sates by country code
 */
$data = $this->Js->get('#SearchForm')->serializeForm(array('isForm' => true, 'inline' => true));

$this->Js->get('#SupportTicketContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/SupportTicket/continent_id'
                ), array(
            'update' => '#SupportTicketCountryId',
            'async' => true,
            'before' => 'loading("SupportTicketCountryId")',
            'complete' => 'loaded("SupportTicketCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
/*
 * Get sates by country code
 */
$this->Js->get('#SupportTicketCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_continent_country/SupportTicket/continent_id/country_id'
                ), array(
            'update' => '#SupportTicketProvinceId',
            'async' => true,
            'before' => 'loading("SupportTicketProvinceId")',
            'complete' => 'loaded("SupportTicketProvinceId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#SupportTicketProvinceId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_province/SupportTicket/province_id'
                ), array(
            'update' => '#SupportTicketCityId',
            'async' => true,
            'before' => 'loading("SupportTicketCityId")',
            'complete' => 'loaded("SupportTicketCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#SupportTicketCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_suburb_by_country_id_and_city_id/SupportTicket/country_id/city_id'
                ), array(
            'update' => '#TravelHotelLookupSuburbId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupSuburbId")',
            'complete' => 'loaded("TravelHotelLookupSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
$this->Js->get('#TravelHotelLookupSuburbId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_area_by_suburb_id/SupportTicket/suburb_id'
                ), array(
            'update' => '#TravelHotelLookupAreaId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupAreaId")',
            'complete' => 'loaded("TravelHotelLookupAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelHotelLookupChainId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_brand_by_chain_id/SupportTicket/chain_id'
                ), array(
            'update' => '#TravelHotelLookupBrandId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupBrandId")',
            'complete' => 'loaded("TravelHotelLookupBrandId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);




?>

<script>
    
    
     var FULL_BASE_URL = $('#hidden_site_baseurl').val(); // For base path of value;
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
    
    
    $('.mbox_select_all').click(function () {
        var $this = $(this);

        $('#resp_table').find('.msg_select').filter(':visible').each(function () {
            if ($this.is(':checked')) {
                $(this).prop('checked', true).closest('tr').addClass('active')
            } else {
                $(this).prop('checked', false).closest('tr').removeClass('active')
            }
        })

    });
    
    function ChkCheckbox(){
        
            var solution = $('#SupportTicketResponse').val();
                if($('#SupportTicketResponseLevelAssessment').val() == ''){
                    bootbox.alert('Please select issue level assessment.');
			return false;
                }
                if($('#SupportTicketResponse').val() == ''){
                    bootbox.alert('Please select solution.');
			return false;
                }
                if($('#SupportTicketContinent').val() == ''){
                    bootbox.alert('Please select continent.');
			return false;
                }
                if($('#SupportTicketCountry').val() == ''){
                    bootbox.alert('Please select country.');
			return false;
                }
                if($('#SupportTicketProvince').val() == ''){
                    bootbox.alert('Please select province.');
			return false;
                }
                if($('#SupportTicketCity').val() == ''){
                    bootbox.alert('Please select city.');
			return false;
                }
                /*
                if($('#SupportTicketSuburb').val() == ''){
                    bootbox.alert('Please select suburb.');
			return false;
                }
                if($('#SupportTicketArea').val() == ''){
                    bootbox.alert('Please select area.');
			return false;
                }
                */
		if ($("input:checked").length == 0){
			bootbox.alert('No check box are selected.');
			return false;
			}
                else{        
                    
                       var numberOfChecked = $('input:checkbox:checked').length;
                       //alert("WARNING! You are about to delete "+ numberOfChecked +" hotels. Are you sure?");
                        var agree=confirm("WARNING! You are about to update "+ numberOfChecked +" tickets. Are you sure?");
                         //bootbox.confirm("Are you sure?", function(result) {
                            if (agree)
                            return true ;
                        else
                            return false ;
					//bootbox.alert("Confirm result: "+result);
				//}); 
                                               
                }
		
		//return validation();
		
		
	}
         function chkBottonEvnt() {
        $('#update').css('display', 'block');
        //$('#sql_generate').css('display', 'block');
    }
    </script>

    