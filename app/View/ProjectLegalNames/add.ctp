<?php  echo $this->Html->css(array('/bootstrap/css/bootstrap.min','popup','font-awesome/css/font-awesome.min'));
	   echo $this->Html->script(array('jquery.min','lib/chained/jquery.chained.remote.min','lib/jquery.inputmask/jquery.inputmask.bundle.min','lib/parsley/parsley.min','pages/ebro_form_validate','lib/datepicker/js/bootstrap-datepicker','lib/timepicker/js/bootstrap-timepicker.min','pages/ebro_form_extended'));
?>
<?php 

//$this->Html->addCrumb('Add Contact','javascript:void(0);', array('class' => 'breadcrumblast'));

echo $this->Form->create('ProjectLegalName', array('method' => 'post','id' => 'parsley_reg','novalidate' => true,
													'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																)
						));
			echo $this->Form->hidden('base_url',array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));					
				
						?>
                        

<div class="content">
     <div class="pop-up-hdng">Add Legal Name</div>

                    <div class="row">
                        <div class="col-sm-12">
                                    
                                       <div class="col-sm-6">
                                       
                                       			<div class="form-group">
													<label for="reg_input_name" class="req">Project Name</label>
                                                    <span class="colon">:</span>
													<div class="col-sm-10"> <?php  echo $this->Form->input('project_legal_names_project_id',array('options' => $projects,'empty' => '--Select--','data-required' => 'true','tabindex' => '1'));?></div>
												</div>
                                                <div class="form-group">
													<label for="reg_input_name" class="req">Legal Name</label>
                                                    <span class="colon">:</span>
													<div class="col-sm-10"> <?php  echo $this->Form->input('project_legal_names_builder_legal_id',array('options' => array(),'empty' => '--Select--','data-required' => 'true','tabindex' => '3'));?></div>
												</div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                        	
                                            <div class="form-group">
													<label for="reg_input_name" class="req">Builder Name</label>
                                                    <span class="colon">:</span>
													<div class="col-sm-10" id="ajax_builder"> <?php  echo $this->Form->input('project_legal_names_builder_id',array('options' => array(),'empty' => '--Select--','data-required' => 'true','tabindex' => '2'));?></div>
												</div>
                                          </div>
                                       
                                       </div>
                                      
                                     		<div class="col-sm-12" id="legal_name_details" style="clear:both;">
                                                
                                            </div>
                                        </div>
                                   
                                   <div class="row">
        	<div class="col-sm-12"><?php echo $this->Form->submit('Add', array('class' => 'success btn','div' => false, 'id' => 'udate_unit')); ?><?php
                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
               
                ?></div>
                 </div>
                            </div>
                           
 <?php echo $this->Form->end();?>   
<script>
var FULL_BASE_URL = $('#hidden_site_baseurl').val();

$('#ProjectLegalNameProjectLegalNamesProjectId').change(function(){
			var project_id = $(this).val();
			var dataString = 'project_id=' + project_id;
			$('#ProjectLegalNameProjectLegalNamesBuilderId').attr('disabled', 'disabled');
			$('.success').attr('disabled','true');
			 $.ajax({
				type: "POST",
				data: dataString,
				url: FULL_BASE_URL + '/all_functions/get_list_builder_by_project_id',
				 beforeSend: function() {
					$('#ProjectLegalNameProjectLegalNamesBuilderId').attr('disabled', 'disabled');
					$('.success').attr('disabled','true');
				},
				success: function(return_data) {
				   $('#ProjectLegalNameProjectLegalNamesBuilderId').removeAttr('disabled');
				   $('.success').removeAttr('disabled','false');
				   $('#ProjectLegalNameProjectLegalNamesBuilderId').html(return_data);
				}
			});  
			
		});
		
$('#ProjectLegalNameProjectLegalNamesBuilderId').change(function(){
			var builder_id = $(this).val();
			var dataString = 'builder_id=' + builder_id;
			$('#ProjectLegalNameProjectLegalNamesBuilderLegalId').attr('disabled', 'disabled');
			$('.success').attr('disabled','true');
			 $.ajax({
				type: "POST",
				data: dataString,
				url: FULL_BASE_URL + '/all_functions/get_builder_legal_name_by_builder_id',
				 beforeSend: function() {
					$('#ProjectLegalNameProjectLegalNamesBuilderLegalId').attr('disabled', 'disabled');
					$('.success').attr('disabled','true');
				},
				success: function(return_data) {
				   $('#ProjectLegalNameProjectLegalNamesBuilderLegalId').removeAttr('disabled');
				   $('.success').removeAttr('disabled','false');
				   $('#ProjectLegalNameProjectLegalNamesBuilderLegalId').html(return_data);
				}
			});  
			
		});
		
$('#ProjectLegalNameProjectLegalNamesBuilderLegalId').change(function(){
			var legal_name_id = $(this).val();
			var dataString = 'legal_name_id=' + legal_name_id;
			$('#legal_name_details').addClass('loader');
			$('.success').attr('disabled','true');
			 $.ajax({
				type: "POST",
				data: dataString,
				url: FULL_BASE_URL + '/all_functions/get_builder_builder_legal_name_details_by_legal_id',
				 beforeSend: function() {
					$('#legal_name_details').addClass('loader');
					$('.success').attr('disabled','true');
				},
				success: function(return_data) {
				   $('#legal_name_details').removeClass('loader');
				   $('.success').removeAttr('disabled','false');
				   $('#legal_name_details').html(return_data);
				}
			});  
			
		});		
</script>