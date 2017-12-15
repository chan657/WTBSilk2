<?php $this->Html->addCrumb('Payments','javascript:void(0);', array('class' => 'breadcrumblast'));
		echo $this->element('Payment/top_menu');
		//pr($actionitems);
		App::import('Model','User');
		$attr = new User();
		
?>
<div class="row">
							<div class="col-sm-12">
                            	<div class="table-heading">
										<h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                echo $all_count;
                ?></span>Payments</h4>
                                        <!--<span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Payment','/payments/add')?></span>-->
                                        <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
									</div>
								<div class="panel panel-default">
									
									<div class="panel_controls hideform">
                                   
                                    
                                    <?php            
                    echo $this->Form->create('Reimbursement', array( 'class' => 'quick_search', 'id' => 'parsley_reg','onsubmit' => 'return validation()','novalidate'=>true,'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
																
																)
																);
                 
                    ?> 
										<div class="row" id="search_panel_controls">
                                        	<div class="col-sm-3 col-xs-6">
												<label for="reg_input_name" class="req">Submitted By:</label>
												<?php echo $this->Form->input('created_by', array('options'=>$primary_manager,'empty'=>'--Select--', 'value' => $created_by,'data-required' => 'true')); ?>
											</div>
											
											<div class="col-sm-3 col-xs-6 adlab">
												<label for="reg_input_name" class="req">From Date:</label>
                                                <?php 
													  echo $this->Form->input('from_day', array('options'=>$fromday,'empty'=>'--Day--','value' => $from_day,'data-required' => 'true'));
													  echo $this->Form->input('from_month', array('options'=>$month,'empty'=>'--Month--','value' => $from_month,'data-required' => 'true'));
													  echo $this->Form->input('from_year', array('options'=>$year,'empty'=>'--Year--','value' => $from_year,'data-required' => 'true'));	
												 ?>
                                                
												
											</div>
                                            <div class="col-sm-3 col-xs-6 adlab">
												<label for="reg_input_name" class="req">To Date:</label>
                                                
												<?php 
														echo $this->Form->input('to_day', array('options'=>$today,'empty'=>'--Day--','value' => $to_day,'data-required' => 'true'));
														echo $this->Form->input('to_month', array('options'=>$month,'empty'=>'--Month--','value' => $to_month,'data-required' => 'true'));
														echo $this->Form->input('to_year', array('options'=>$year,'empty'=>'--Year--','value' => $to_year,'data-required' => 'true'));
												 ?>
											</div>
                                            
                                      		
                                            <div class="col-sm-3 col-xs-6">
												<label for="un_member">Status:</label>
												<?php echo $this->Form->input('reimbursement_status', array('options'=>array('3'=>'Paid','2'=>'Pending'),'empty'=>'--Select--', 'value' => $reimbursement_status)); ?>
											</div>
                                            
                                            <br clear="all">
											<div class="col-sm-3 col-xs-6">
												<label>&nbsp;</label>
                                                <?php
											   echo $this->Form->submit('Search', array('div' => false, 'class' => 'btn btn-default btn-sm'));            
					   							?>
												
											</div>
										</div>
                                         <?php echo $this->Form->end(); ?>
									</div>
                                    <?php   
									         
                    echo $this->Form->create('Reimbursement', array('action' => 'add_payment','onsubmit' => 'return ChkCheckbox()', 'class' => 'quick_search', 'id' => 'SearchForm','novalidate'=>true,'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
																
																));
                 echo $this->Form->hidden('Payment.submit',array('value' => 'submit'));
				 echo $this->Form->hidden('Payment.reimbursement_created_by',array('value' => $created_by));
				 echo $this->Form->hidden('Payment.reimbursement_from_date',array('value' => $from_year.'-'.$from_month.'-'.$from_day));
				 echo $this->Form->hidden('Payment.reimbursement_to_date',array('value' => $to_year.'-'.$to_month.'-'.$to_day));
                    ?> 
                    <span class="badge badge-circle add-client btm-btn payment-btn"><i class="icon-plus"></i> <?php echo $this->Form->submit('Payment',array('class' => 'btn btn-default btn-sm'))?></span>
									<table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
										<thead>
											<tr>
                                            	<th class="nolink" data-sort-ignore="true"><!--<input type="checkbox" class="mbox_select_all" name="msg_sel_all">--></th>
												<th data-toggle="true">Parent Id</th>
												<th data-hide="phone">Action Id</th>
                                                <th data-hide="phone">Level</th>
                                                <th data-hide="phone">About</th>
                                                <th data-hide="phone">Expense By</th>
                                                <th data-hide="phone">Expense Level</th>
                                                <th data-hide="phone">Expense With</th>
                                                <th data-hide="phone">Expense Type</th>
                                                <th data-hide="phone">Expense For</th>
                                                 <th data-hide="phone">Submitted Amount</th>
                                                 <th data-hide="phone">Approved Amount</th>
                                                 <th data-hide="phone">Paid Amount</th>
                                                 <th data-hide="all" data-sort-ignore="true">Submission Comment</th>
                                                 <th data-hide="all" data-sort-ignore="true">Approval Comment</th>
                                                 <th data-hide="all" data-sort-ignore="true">Release Comment</th>
											</tr>
										</thead>
										<tbody>
                                        	<?php
											//echo $actionitems['Reimbursement']['reimbursement_status']; 
											$submiited_amount = 0;
											 $approved_amount = 0;
											 $paid_amount = 0;
										 if (isset($actionitems) && count($actionitems) > 0):
											 foreach ($actionitems as $actionitem):
											   $id = $actionitem['ActionItem']['id'];
											   $submiited_amount = $submiited_amount+$actionitem['Reimbursement']['reimbursement_amount'];
											   $approved_amount =  $approved_amount + $actionitem['Reimbursement']['reimbursement_approved_amount'];
											   $paid_amount = $paid_amount + $actionitem['Reimbursement']['reimbursement_released_amount'];
											//   $this->Form->
										?>
										<tr>
                                        	<td class="nolink"><?php
											 if($actionitem['Reimbursement']['reimbursement_status'] == '3')
											 	echo $this->Form->checkbox('msg_sel', array('disabled' => true,'class' => 'mbox_msg_select','hiddenField' => false,'value' => $id.'_'.$actionitem['ActionItem']['event_id']));
											else
												echo $this->Form->checkbox('msg_sel', array('name' => 'data[Payment][msg_sel][]','checked' => true,'readonly' => true,'class' => 'mbox_msg_select','hiddenField' => false,'value' => $id.'_'.$actionitem['ActionItem']['event_id']));
												?></td>
											<td class="tablebody" ><?php echo $actionitem['ActionItem']['parent_action_item_id'];?></td>
                                            <td class="tablebody" ><?php echo $id;?></td>                    
                                            <td class="tablebody" ><?php echo $actionitem['ActionItemLevel']['level']; ?></td>
                                            <td class="tablebody" ><?php echo $this->Html->link('Id-'.$actionitem['ActionItem']['event_id'], '/reimbursements/view/' . $actionitem['ActionItem']['event_id'], array('class' => 'act-ico open-popup-link add-btn','escape' => false,'data-placement' => "left", 'title' => "Action",'data-toggle' => "tooltip")); ?></td>
                                            <td class="tablebody" ><?php echo $attr->Username($actionitem['Reimbursement']['created_by']); ?></td>
                                            <td class="tablebody" ><?php echo $activity_levels[$actionitem['Reimbursement']['reimbursement_level']]; ?></td>
                                            <td class="tablebody" ><?php echo $actionitem['Reimbursement']['reimbursement_with']; ?></td>
                                            <td class="tablebody" ><?php echo $reimburse_type[$actionitem['Reimbursement']['reimbursement_type_1']]; ?></td>
                                           <td class="tablebody" ><?php echo  $reimburse_for[$actionitem['Reimbursement']['reimbursement_type_2']];?></td>
                                            <td class="tablebody" align="right" ><?php echo $actionitem['Reimbursement']['reimbursement_amount'];?></td>
                                           <td class="tablebody" align="right"><?php if($actionitem['Reimbursement']['reimbursement_approved_amount'] == '') echo '0.00'; else echo $actionitem['Reimbursement']['reimbursement_approved_amount'];?></td>
                                           <td class="tablebody" align="right"><?php if($actionitem['Reimbursement']['reimbursement_released_amount'] == '') echo '0.00'; else echo $actionitem['Reimbursement']['reimbursement_released_amount'];?></td>
                                           <td class="tablebody" ><?php echo $actionitem['Reimbursement']['reimbursement_desc'];?></td>
                                           <td class="tablebody" ><?php echo $actionitem['Reimbursement']['reimbursement_approved_comment'];?></td>
                                           <td class="tablebody" ><?php echo $actionitem['Reimbursement']['reimbursement_released_comment'];?></td>
                                               
											  </tr>
                                        <?php
                                        endforeach; ?>
                                        <tr>
                                        	<td colspan="9">&nbsp;</td>
                                            <td data-toggle="no">Subtotal </td>
                                            <td align="right"><?php echo 'INR '.sprintf('%0.2f', $submiited_amount);?></td>
                                            <td align="right"><?php echo 'INR '.sprintf('%0.2f', $approved_amount);?></td>
                                            <td align="right"><?php echo 'INR '.sprintf('%0.2f', $paid_amount);?></td>
                                         </tr>   
                                       
                                         <?php   else:
										echo '<tr><td colspan="13" class="norecords">No Records Found</td></tr>';
										   endif; ?>
                                        </tbody>
									</table>
                                    <span class="badge badge-circle add-client btm-btn"><i class="icon-plus"></i> <?php echo $this->Form->submit('Payment',array('class' => 'btn btn-default btn-sm'))?></span>
         <?php echo $this->Form->end(); ?>     
         		<?php echo $this->element('paginate');?>                       
								</div>
							</div>
						</div>
<script>
	$('.mbox_msg_select').on('click',function() {
					if($(this).is(':checked')) {
						$(this).closest('tr').addClass('active')
					} else {
						$(this).closest('tr').removeClass('active')
					}
				});
	$('.mbox_select_all').click(function () {
					var $this = $(this);
					
					$('#resp_table').find('.mbox_msg_select').filter(':visible').each(function() {
						if($this.is(':checked')) {
							$(this).prop('checked',true).closest('tr').addClass('active')
						} else {
							$(this).prop('checked',false).closest('tr').removeClass('active')
						}
					})
					
				});	
				
	function ChkCheckbox(){
	
		if ($("input:checked").length == 0){
			bootbox.alert('No reimbursement are pending.');
			return false;
			}
		
		return validation();
		
		
	}
	
	function validation(){
		
		var submitted_by = $('#ReimbursementCreatedBy').val();
		var from_day = $('#ReimbursementFromDay').val();
		var from_month = $('#ReimbursementFromMonth').val();
		var from_year = $('#ReimbursementFromYear').val();
		var to_day = $('#ReimbursementToDay').val();
		var to_month = $('#ReimbursementToMonth').val();
		var to_year = $('#ReimbursementToYear').val();
		
		
		
		
		if(submitted_by == ''){
			bootbox.alert('Select Submitted By');
			return false;
		}
		
		if(from_day == '' || from_month == '' ||  from_year ==''){
			bootbox.alert('Select From Date.');
			return false;
		}
		
		if(to_day == '' || to_month == '' ||  to_year ==''){
			bootbox.alert('Select To Date.');
			return false;
		}
		var from_date = from_year+'-'+from_month+'-'+from_day;
		var date1 = Date.parse(from_date);
		var date2 = Date.parse(to_year+'-'+to_month+'-'+to_day);
		
		if (date1 > date2) {
			bootbox.alert('To Date should be greater than to From Date.');
			return false;
		}
		
	}	


				
</script>
