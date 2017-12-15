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
?>

<!----------------------------start add project block------------------------------>

<div class="pop-outer">
     <div class="pop-up-hdng">Edit Reimbusement </div>


    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
	echo $this->Form->create('Reimbursement', array('method' => 'post','id' => 'parsley_reg','novalidate' => true,
													'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
													array('controller' => 'reimbursements','action' => 'edit')	
						));
   echo $this->Form->hidden('base_url',array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
   
   	echo $this->Form->hidden('reimbursement_with', array('readonly' => true));
  
   
    ?>
 
<div class="col-sm-12">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="input_name" class="req">Activity Level</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('reimbursement_level',array('options' => $activity_levels,'empty' => '--Select--','data-required' => 'true'));
                    ?>
            
                </div>
            
            </div>
            <div class="form-group">
                <label for="input_name" class="req">Expense Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                <?php
                echo $this->Form->input('reimbursement_type_1', array('options' => $reimburse_type,  'empty' => '--Select--','data-required' => 'true'));
                ?>
                </div>
                
                </div>
            <div class="form-group">
                <label>Distance(KM)</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                <?php
                echo $this->Form->input('reimbursement_factor_1',array('onchange' => 'totalCalculate()'));
                ?>
                </div>
            </div>
            <div class="form-group">
                <label>Total Amount</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                <?php
                echo $this->Form->input('reimbursement_amount',array('onchange' => 'totalCalculate()','readonly' => true));
                ?>
                </div>
                
            </div>
            <div class="form-group">
                <label>Bill Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                <?php
                echo $this->Form->input('reimbursement_bill_type', array('options' => $bill_type,  'empty' => '--Select--'));
                ?>
                </div>
                
            </div> 
        </div>
        <div class="col-sm-6">
            <div class="form-group">
            <label for="input_name" class="req">Activity With</label>
            <span class="colon">:</span>
            <div class="col-sm-10"><?php
			echo $this->Form->input('with_1',array('readonly' => true,'value' => $this->data['Reimbursement']['reimbursement_with']));
            echo $this->Form->input('with_2',array('options' => array(),'empty' => '--Select--','style' => 'display:none;'));
            ?>
            
            </div>
            
            </div>
            <div class="form-group">
            <label for="input_name" class="req">Expense For</label>
            <span class="colon">:</span>
            <div class="col-sm-10">
            <?php
            echo $this->Form->input('reimbursement_type_2', array('options' => $reimburse_for,  'empty' => '--Select--','data-required' => 'true'));
            ?>
            </div>
            
            </div>
            <div class="form-group">
            <label>Incurred /KM</label>
            <span class="colon">:</span>
            <div class="col-sm-10">
            <?php 
            echo $this->Form->input('reimbursement_factor_2',array('onchange' => 'totalCalculate()'));
            ?>
            </div>
            </div>
            <div class="form-group">
                            <label>Submission Date</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('reimbursement_bill_submission_date',array('type' => 'text','readonly' => true));
                            ?>
                            </div>
                            
                            </div>
            <div class="form-group">
                <label>Bill Status</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
                <?php
                echo $this->Form->input('reimbursement_bill_status', array('options' => $bill_status,  'empty' => '--Select--'));
                ?>
                </div>
                
           </div>
           </div>
           <div class="row">
        	<div class="col-sm-12"><?php echo $this->Form->submit('Add', array('class' => 'success btn','div' => false, 'id' => 'udate_unit')); ?><?php
                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
               
                ?></div>
                 </div>
	</div>
            
        

    <?php echo $this->Form->end();
    ?>
</div>	

<script>
function totalCalculate()
    {
		var factor1=$('#ReimbursementReimbursementFactor1').val();
		var factor2=$('#ReimbursementReimbursementFactor2').val();
		var expense_for = $('#ReimbursementReimbursementType2').val();
		var expense_type = $('#ReimbursementReimbursementType1').val();
			
		if(expense_type == 1 || expense_type == 4 || expense_type == 6){ //case 1
			$('#ReimbursementReimbursementAmount').attr('readonly', true);	
		
			if(expense_for == 44 || expense_for == 60){
				$('#ReimbursementReimbursementFactor2').attr('readonly', true);	
				$('#ReimbursementReimbursementFactor1').attr('readonly', false);	
				$('#ReimbursementReimbursementFactor2').val('2');
				var total = parseFloat(factor1 * factor2);
				$('#ReimbursementReimbursementAmount').val(total);
				
				
				}
			else if(expense_for == 45 || expense_for == 61){
				$('#ReimbursementReimbursementFactor2').attr('readonly', true);	
				$('#ReimbursementReimbursementFactor1').attr('readonly', false);	
				$('#ReimbursementReimbursementFactor2').val('6');
				var total = parseFloat(factor1 * factor2);
				$('#ReimbursementReimbursementAmount').val(total);
				}
			else{
				//$('#ReimbursementReimbursementFactor1').val(0);
				$('#ReimbursementReimbursementFactor2').val('');
				//$('#ReimbursementReimbursementAmount').val(0);
				$('#ReimbursementReimbursementFactor1').attr('readonly', false);
				$('#ReimbursementReimbursementFactor2').attr('readonly', false);
				$('#ReimbursementReimbursementAmount').attr('readonly', false);	
				
			}	
				
					
			
			
		}

		else if(expense_type == 1)
		{
			
			$('#ReimbursementReimbursementFactor2').attr('readonly', true);	
			$('#ReimbursementReimbursementFactor1').attr('readonly', true);	
			$('#ReimbursementReimbursementAmount').attr('readonly', false);	
			//$('#ReimbursementReimbursementAmount').val(factor2);
		}
		else	
			$('#ReimbursementReimbursementAmount').val(0);
		
		
		

		/*	
		if(factor1 == null && factor1 == '')
			$('#ReimbursementReimbursementAmount').val(factor2);
		else
		{	

			var total = parseFloat(factor1 * factor2);
			$('#ReimbursementReimbursementAmount').val(total);
		}
		*/
	}
var FULL_BASE_URL = $('#hidden_site_baseurl').val(); // For base path of value;
$('#ReimbursementReimbursementType1').change(function(){
			var type_id = $(this).val();
			var model = 'Reimbursement';
			
			if(type_id == 1)
				$('#ReimbursementReimbursementFactor2').val('2');
			else
				$('#ReimbursementReimbursementFactor2').val('');	
			var dataString = 'type_id=' + type_id + '&model='+model;
			$('#ReimbursementReimbursementType2').attr('disabled', 'disabled');
			 $.ajax({
				type: "POST",
				data: dataString,
				url: FULL_BASE_URL + '/all_functions/get_type_2_by_type1_id',
				 beforeSend: function() {
					 $('#ReimbursementReimbursementType2').attr('disabled', 'disabled');
					//return false;
				},
				success: function(return_data) {
				   $('#ReimbursementReimbursementType2').removeAttr('disabled');
				   $('#ReimbursementReimbursementType2').html(return_data);
				}
			});  
			
		});
$('#ReimbursementReimbursementLevel').change(function(){
			var level_id = $(this).val();
			var model = 'Reimbursement';
			
			
			var dataString = 'level_id=' + level_id + '&model='+model;
			$('#ReimbursementWith1').css('display', 'none');
			$('#ReimbursementWith2').css('display', 'block');
			$('#ReimbursementWith2').attr('disabled', 'disabled');
			 $.ajax({
				type: "POST",
				data: dataString,
				url: FULL_BASE_URL + '/all_functions/get_activity_with_by_activity_level',
				 beforeSend: function() {
					 $('#ReimbursementWith2').attr('disabled', 'disabled');
					//return false;
				},
				success: function(return_data) {
				   $('#ReimbursementWith2').removeAttr('disabled');
				   $('#ReimbursementWith2').html(return_data);
				}
			});  
			
		});	
$('#ReimbursementWith2').change(function(){
		$('#ReimbursementReimbursementWith').val($('option:selected', $(this)).text());
	});		
</script>
		
<!----------------------------end add project block------------------------------>
