<?php

 echo $this->Html->css(array('/bootstrap/css/bootstrap.min','popup',
									
									'font-awesome/css/font-awesome.min',
									
									'/js/lib/datepicker/css/datepicker',
									'/js/lib/timepicker/css/bootstrap-timepicker.min'
									
									
									)
							);
echo $this->Html->script(array('jquery.min','lib/chained/jquery.chained.remote.min','lib/jquery.inputmask/jquery.inputmask.bundle.min','lib/parsley/parsley.min','pages/ebro_form_validate','lib/datepicker/js/bootstrap-datepicker','lib/timepicker/js/bootstrap-timepicker.min','pages/ebro_form_extended'));							

//pr($actionitems);
		/* End */
?>
<input type="hidden" id="hidden_site_baseurl" value="<?php echo $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : ''); ?>"  />

<!----------------------------start add project block------------------------------>
<div class="content">
     <div class="pop-up-hdng">
		<span class="heading_text">Add Action | Reimbursement | Waiting for Approval</span>
       
        </div>


    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
	echo $this->Form->create('ActionItem', array('method' => 'post','id' => 'parsley_reg','novalidate' => true,'onsubmit' => 'return validation()',
													'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																	
																),
														array('controller' => 'ActionItem','action' => 'even_action')		
						));
						
    ?>
    	<div class="col-sm-12 spacer">
        <div class="col-sm-6">
        
       
            <div class="form-group">
                <label class="bgr">Choose Action Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                     echo $this->Form->input('type_id',  array('id' => 'type_id','options' => $type,'empty' => '--Select--'));
                    ?>

                </div>

            </div>
            
			

            
            
        </div>
         <div class="col-sm-6">
         
         	<div class="form-group" id="rejection" style="display: none;">
               <label class="bgr">Reason for Rejection</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	<?php
                    echo $this->Form->input('lookup_rejection_id',  array('id' => 'rejections_id','options' => $rejections,'empty' => '--Select--'));?>
				</div>
            </div>
            <div class="form-group" id="return" style="display: none;">
               <label>Reason for Return</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	<?php
                     echo $this->Form->input('lookup_return_id',  array('id' => 'return_id','options' => $returns,'empty' => '--Select--'));
				
				
				
                    ?></div>
            </div>
            <div class="form-group">
               <label class="bgr">&nbsp;</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	
                   &nbsp;
				</div>
            </div>
         </div>                                                   
        
    	</div>
        <div class="col-sm-6">
        	<div class="form-group reimbuesement" style="display: none;">
               <label class="bgr">Submitted Amount</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	<?php
                   echo $Reimbursements['Reimbursement']['reimbursement_amount'];?>
				</div>
            </div>
	    	
           <div class="form-group reimbuesement" style="display: none;">
               <label class="bgr">Submitted Date</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	<?php
                   echo date('d/m/Y',strtotime($Reimbursements['Reimbursement']['created']));?>
				</div>
            </div>
            
            
           </div>
        <div class="col-sm-6">
        <div class="form-group reimbuesement" style="display: none;">
               <label class="bgr">Approval Amount</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	<?php echo $this->Form->input('Reimbursement.reimbursement_approved_amount',array('value' => $Reimbursements['Reimbursement']['reimbursement_amount']));
                  ?>
				</div>
            </div>
            <div class="form-group reimbuesement" style="display: none;">
               <label class="bgr">Submitted by</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	<?php
                   echo $Reimbursements['SubmittedBy']['fname'].' '.$Reimbursements['SubmittedBy']['mname'].' '.$Reimbursements['SubmittedBy']['lname'];?>
				</div>
            </div>
        
        </div>
        
        
    
    	
        
           <div class="col-sm-12 spacer">
           	
           	<div class="lf-space"><?php
			echo $this->Form->input('Reimbursement.reimbursement_approved_comment',  array('div' =>array('class' => 'reimbuesement', 'style' => 'display:none;'),'type'=>'textarea'));
				echo $this->Form->input('other_return',  array('div' =>array('id' => 'other_return', 'style' => 'display:none;'),'type'=>'textarea'));
				
				echo $this->Form->input('other_rejection',  array('div' =>array('id' => 'other', 'style' => 'display:none;'),'label' => false, 'type'=>'textarea'));
                    ?></div>
           </div>
	
    
    <div class="row spacer">
    	<div class="col-sm-12"><div class="col-sm-12"><?php echo $this->Form->submit('Add Action', array('class' => 'success btn','div' => false, 'id' => 'udate_unit')); ?><?php
                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
               
                ?></div></div>
                 </div>
            
        

    <?php echo $this->Form->end();
    ?>
</div>	

<script type="text/javascript">




    $(document).ready(function(){
		
         var FULL_BASE_URL = $('#hidden_site_baseurl').val();
		 
        
          
			
             $('#type_id').change(function(){
                    var type = $(this).val();
                    if (type == 9) {
                         $('#div_line').css('display','none');
						  $('#rejection').css('display','block');
                         $('#remarks').val('');
                         $('#pri_mang').css('display','none');
						 $('#return').css('display','none');
                        $('.reimbuesement').css('display','none');
                     
                    }
					
                   
					if(type == 8){
						 $('#return').css('display','block');
						 $('#div_line').css('display','none');
						 $('#calling_div').css('display','none');
						 $('#secondary_manager_id').css('display','none');
						 $('#rejection').css('display','none');
						 $('.reimbuesement').css('display','none');
					}
					
					if(type == 6){
						 
						  $('.reimbuesement').css('display','block');	
						  $('#return').css('display','none');
						  $('#rejection').css('display','none');
					}
					
                  
                });
				
			$('#return_id').change(function(){
				var value =	$(this).val();
				if(value == 10){
					 $('#other_return').css('display','block');
					  $('#other').css('display','none');
				}
				else{
					$('#other_return').css('display','none');
				}
				
			});
				
			$('#rejections_id').change(function(){
				var value =	$(this).val();
				if(value == 10){
					
					 $('#other').css('display','block');
					 $('#other_return').css('display','none');
				}
				else{
					$('#other').css('display','none');
				}
				
			});	
               
        });
function validation(){
	var value = $('#rejections_id').val();
	if(value == 10)
		{
			if($('#ActionItemOtherRejection').val() == '')
				{
				 	alert('Please type resion description');
					return false;
				}
		}
}		


</script>		
<!----------------------------end add project block------------------------------>
