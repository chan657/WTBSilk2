<?php $this->Html->addCrumb('Reimbursement','javascript:void(0);', array('class' => 'breadcrumblast'));
		echo $this->element('Finance/top_menu');
		//pr($actionitems);
		App::import('Model','User');
		$attr = new User();
		
?>
<div class="row">
							<div class="col-sm-12">
                            	<div class="table-heading">
										<h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                echo $all_count;
                ?></span>Reimbursement</h4>
                                        <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Reimbursement','/reimbursements/add',array('class' => 'act-ico open-popup-link'));?></span>
                                        <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
									</div>
								<div class="panel panel-default">
									
									<div class="panel_controls hideform">
                                   
                                    
                                    <?php            
                    echo $this->Form->create('Reimbursement', array( 'class' => 'quick_search', 'id' => 'parsley_reg','novalidate'=>true,'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
																array('controller' => 'finances','action' => 'list_reimbursement')
																)
																);
                 
                    ?> 
										<div class="row" id="search_panel_controls">
                                        	
											
											<div class="col-sm-3 col-xs-6 adlab">
												<label for="reg_input_name" class="req">From Date:</label>
                                                <?php 
													  echo $this->Form->input('from_day', array('options'=>$fromday,'empty'=>'--Select--','value' => $from_day,'data-required' => 'true'));
													  echo $this->Form->input('from_month', array('options'=>$month,'empty'=>'--Select--','value' => $from_month,'data-required' => 'true'));
													  echo $this->Form->input('from_year', array('options'=>$year,'empty'=>'--Select--','value' => $from_year,'data-required' => 'true'));	
												 ?>
                                                
												
											</div>
                                            <div class="col-sm-3 col-xs-6 adlab">
												<label for="reg_input_name" class="req">To Date:</label>
                                                
												<?php 
														echo $this->Form->input('to_day', array('options'=>$today,'empty'=>'--Select--','value' => $to_day,'data-required' => 'true'));
														echo $this->Form->input('to_month', array('options'=>$month,'empty'=>'--Select--','value' => $to_month,'data-required' => 'true'));
														echo $this->Form->input('to_year', array('options'=>$year,'empty'=>'--Select--','value' => $to_year,'data-required' => 'true'));
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
									         
                    /*echo $this->Form->create('Finance', array('action' => 'add_reimbursement','onsubmit' => 'return ChkCheckbox()', 'class' => 'quick_search', 'id' => 'SearchForm','novalidate'=>true,'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
																
																));
                 echo $this->Form->hidden('Payment.submit',array('value' => 'submit'));
				 echo $this->Form->hidden('Payment.reimbursement_created_by',array('value' => $created_by));
				 echo $this->Form->hidden('Payment.reimbursement_from_date',array('value' => $from_year.'-'.$from_month.'-'.$from_day));
				 echo $this->Form->hidden('Payment.reimbursement_to_date',array('value' => $to_year.'-'.$to_month.'-'.$to_day));*/
                    ?> 
                    
									<table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
										<thead>
											<tr>
                                            	
												<th data-toggle="true" width="11%">Expense By</th>
                                                <th data-hide="phone" width="2%">Expense About</th>
                                                <th data-hide="phone" width="8%">Submitted Date</th>
                                                <th data-hide="phone" width="8%">Activity From</th>
                                                <th data-hide="phone" width="8%">Activity To</th>
                                                <th data-hide="phone" width="5%">Expense Level</th>
                                                <th data-hide="phone" width="8%">Expense With</th>
                                                <th data-hide="phone" width="5%">Expense Type</th>
                                                <th data-hide="phone" width="5%">Expense For</th>
                                                <th data-hide="phone" width="3%" data-sort-ignore="true">Submitted Amount</th>
                                                <th data-hide="phone" width="3%" data-sort-ignore="true">Approved Amount</th>
                                                <th data-hide="phone" width="3%" data-sort-ignore="true">Paid Amount</th>
                                                <th data-hide="all" data-sort-ignore="true">Submission Comment</th>
                                                <th data-hide="all" data-sort-ignore="true">Approval Comment</th>
                                                <th data-hide="all" data-sort-ignore="true">Release Comment</th>
											</tr>
										</thead>
										<tbody>
                                        	<?php
											//pr($actionitems);
											//echo $actionitems['Reimbursement']['reimbursement_status']; 
											$submiited_amount = 0;
											 $approved_amount = 0;
											 $paid_amount = 0;
										 if (isset($Reimbursement) && count($Reimbursement) > 0):
											 foreach ($Reimbursement as $actionitem):
											   $id = $actionitem['Reimbursement']['id'];
											   $submiited_amount = $submiited_amount+$actionitem['Reimbursement']['reimbursement_amount'];
											   $approved_amount =  $approved_amount + $actionitem['Reimbursement']['reimbursement_approved_amount'];
											   $paid_amount = $paid_amount + $actionitem['Reimbursement']['reimbursement_released_amount'];
											//   $this->Form->
										?>
										<tr>
                                        	
											                   
                                           	 <td class="tablebody" ><?php echo $attr->Username($actionitem['Reimbursement']['created_by']); ?></td>
                                            <td class="tablebody" ><?php echo $this->Html->link('Id-'.$actionitem['Reimbursement']['id'], '/reimbursements/view/' . $actionitem['Reimbursement']['id'], array('class' => 'act-ico open-popup-link add-btn','escape' => false,'data-placement' => "left", 'title' => "Action",'data-toggle' => "tooltip")); ?></td>
                                           
                                            <td class="tablebody" ><?php echo date("F j, Y",strtotime($actionitem['Reimbursement']['reimbursement_bill_submission_date']));
											 ?></td>
                                            <td class="tablebody" ><?php if($actionitem['Activity']['start_date']) echo date("F j, Y, g:i a",strtotime($actionitem['Activity']['start_date']));
										 ?></td>
                                            <td class="tablebody" ><?php if($actionitem['Activity']['end_date']) echo date("F j, Y, g:i a",strtotime($actionitem['Activity']['end_date']));?></td>
                                            <td class="tablebody" ><?php echo $actionitem['Level']['value']; ?></td>
                                            <td class="tablebody" ><?php echo $actionitem['Reimbursement']['reimbursement_with']; ?></td>
                                            <td class="tablebody" ><?php echo $actionitem['Type']['value']; ?></td>
                                           <td class="tablebody" ><?php echo  $actionitem['For']['value'];?></td>
                                            <td class="tablebody" align="right"><?php echo $actionitem['Reimbursement']['reimbursement_amount'];?></td>
                                           <td class="tablebody" align="right"><?php if($actionitem['Reimbursement']['reimbursement_approved_amount'] == '') echo '0.00'; else echo $actionitem['Reimbursement']['reimbursement_approved_amount'];?></td>
                                           <td class="tablebody" align="right"><?php if($actionitem['Reimbursement']['reimbursement_released_amount'] == '') echo '0.00'; else echo $actionitem['Reimbursement']['reimbursement_released_amount'];?></td>
                                           <td class="tablebody" ><?php echo $actionitem['Reimbursement']['reimbursement_desc'];?></td>
                                           <td class="tablebody" ><?php echo $actionitem['Reimbursement']['reimbursement_approved_comment'];?></td>
                                           <td class="tablebody" ><?php echo $actionitem['Reimbursement']['reimbursement_released_comment'];?></td>
                                               
											  </tr>
                                        <?php
                                        endforeach; ?>
                                        <tr>
                                        	<td colspan="8" data-toggle="false">&nbsp;</td>
                                            <td>Subtotal </td>
                                            <td align="right"><?php echo 'INR '.sprintf('%0.2f', $submiited_amount);?></td>
                                            <td align="right"><?php echo 'INR '.sprintf('%0.2f', $approved_amount);?></td>
                                            <td align="right"><?php echo 'INR '.sprintf('%0.2f', $paid_amount);?></td>
                                         </tr>   
                                       
                                         <?php echo $this->element('paginate');  else:
										echo '<tr><td colspan="12" class="norecords">No Records Found</td></tr>';
										   endif; ?>
                                        </tbody>
									</table>
                                    <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Reimbursement','/reimbursements/add',array('class' => 'act-ico open-popup-link'));?></span>
         <?php //echo $this->Form->end(); ?>                            
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
			alert('Please select checkbox.');
			return false;
			}
	}				
				
</script>