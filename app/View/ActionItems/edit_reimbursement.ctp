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
     <div class="pop-up-hdng">Edit Reimbursement <span class="old_client"><?php echo date('d/m/Y',strtotime($this->data['Reimbursement']['created']))?></span></div>


    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
	echo $this->Form->create('Reimbursement', array('method' => 'post','id' => 'parsley_reg','novalidate' => true,
													'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
													array('controller' => 'action_items','action' => 'edit_reimbursement')	
						));
   echo $this->Form->hidden('base_url',array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
  
   
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
            
            
           </div>
          <div class="col-sm-12 fullrow">
          <div class="form-group">
            <label>Expense Description</label>
            <span class="colon">:</span>
            <div class="col-sm-10">
            <?php echo $this->Form->input('reimbursement_desc', array('type' => 'textarea'));?>
            </div>
            </div> 
            </div>
           <div class="row">
        	<div class="col-sm-12"><?php echo $this->Form->submit('Update', array('class' => 'success btn','div' => false, 'id' => 'udate_unit')); ?><?php
                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
               
                ?></div>
                 </div>
	</div>
            
        

    <?php echo $this->Form->end();
    ?>
</div>	

<script>
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
</script>
		
<!----------------------------end add project block------------------------------>
