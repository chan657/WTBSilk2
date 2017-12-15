<?php 
$this->Html->addCrumb('Invoices','javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('Payment', array('method' => 'post',
										'id' => 'parsley_reg',
										'onSubmit'=>'if(confirm("are you sure?")){return calculate();} else {return false;}',
										'novalidate' => true,
										'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
										array('controller' => 'finances','action' => 'add_reimbursement')								
															
						));
					 echo $this->Form->hidden('submit',array('value' => 'add'));
					 echo $this->Form->hidden('reimbursement_created_by',array('value' => $reimbursement_created_by));
					 echo $this->Form->hidden('reimbursement_from_date',array('value' => $reimbursement_from_date));
					 echo $this->Form->hidden('reimbursement_to_date',array('value' => $reimbursement_to_date));

						foreach($action_id as $val)
						{
						?>
                        <input type="checkbox" name='data[Payment][action_id][]' value="<?php echo $val;?>" checked="checked" style="display:none;"  />
                        
                        <?php }
						foreach($event_id as $val)
						{
						?>
                        <input type="checkbox" name='data[Payment][event_id][]' value="<?php echo $val;?>" checked="checked" style="display:none;" />
                        
                        <?php }
						?>

						<div class="row">
							<div class="col-sm-12">
								<table class="table table-striped invoice_table">
									<thead>
										<tr>
											<th>Sl.</th>
											<th>Expense Date</th>
											<th>Expense By</th>
											<th>Expense Level</th>
											<th>Expense With</th>
											<th>Expense Type</th>
                                            <th>Expense For</th>
											<th>Travel Distance (KM)</th>
                                            <th>Incurred Expense / KM</th>
                                            <th>Submitted Amount</th>
                                            <th>Approved Amount</th>
                                            <th>Paid Amount</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
									//pr($Reimbursements);
										 if (isset($Reimbursements) && count($Reimbursements) > 0):
										 $i = 1;
										 $j = 0;
										 $subtotal = 0;
											 foreach ($Reimbursements as $Reimbursement):
											   $id = $Reimbursement['Reimbursement']['id'];
											    echo $this->Form->hidden('id',array('name' => 'data[Reimbursement]['.$j.'][id]','value' => $id));
												echo $this->Form->hidden('id',array('name' => 'data[Reimbursement]['.$j.'][reimbursement_released_by_id]','value' => $user_id));
												echo $this->Form->hidden('id',array('name' => 'data[Reimbursement]['.$j.'][reimbursement_released_date]','value' => date('Y-m-d')));
												echo $this->Form->hidden('id',array('name' => 'data[Reimbursement]['.$j.'][reimbursement_status]','value' => '3'));
												echo $this->Form->hidden('id',array('name' => 'data[Reimbursement]['.$j.'][reimbursement_closed]','value' => 'Yes'));
										?>
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo date('d/m/Y',strtotime($Reimbursement['Reimbursement']['reimbursement_bill_submission_date']));?></td>
											<td><?php echo $Reimbursement['SubmittedBy']['fname'].' '.$Reimbursement['SubmittedBy']['mname'].' '.$Reimbursement['SubmittedBy']['lname'];?></td>
											<td><?php echo $Reimbursement['Level']['value'];?></td>
											<td><?php echo $Reimbursement['Reimbursement']['reimbursement_with'];?></td>
											<td><?php echo $Reimbursement['Type']['value'];?></td>
                                            <td><?php echo $Reimbursement['For']['value'];?></td>
                                            <td><?php echo $Reimbursement['Reimbursement']['reimbursement_factor_1'];?></td>
                                            <td><?php echo $Reimbursement['Reimbursement']['reimbursement_factor_2'];?></td>
                                            <td><?php echo $Reimbursement['Reimbursement']['reimbursement_amount'];?></td>
                                            <td><?php echo $Reimbursement['Reimbursement']['reimbursement_approved_amount'];?></td>
                                            <td><?php echo $this->Form->input('reimbursement_released_amount',array('id' => 'reimbursement_released_amount_'.$i,'class' => 'form-control','name' => 'data[Reimbursement]['.$j.'][reimbursement_released_amount]','onchange' => 'calculate()','value' => $Reimbursement['Reimbursement']['reimbursement_approved_amount']));?></td>
										</tr>
                                        
                                         <?php  
										 $subtotal = $subtotal+$Reimbursement['Reimbursement']['reimbursement_approved_amount'];
										 $i++;
										 $j++;
										 endforeach; 
										 echo $this->Form->hidden('count',array('id' => 'count','value' => $j));
										 endif; ?>
                                         
										
									</tbody>
									<tfoot>
										<tr>
											<td colspan="10"></td>
											<td class="col_total text-right"><strong>Subtotal</strong></td>
											<td class="col_total"><strong class="sub_total"><?php echo 'INR '.sprintf('%0.2f', $subtotal);?></strong></td>
										</tr>
										
										<tr class="grand_total">
											<td colspan="9"></td>
											<td class="col_total text-right" colspan="2">Grand Total</td>
                                            <?php echo $this->Form->hidden('payment_amount',array('value' => $subtotal));?>
											<td class="col_total"><strong class="grand_total_amt"><?php echo 'INR '.sprintf('%0.2f', $subtotal);?></strong></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
				
												<?php echo $this->Form->submit('Make A Payment', array('class' => 'success btn'));?>
											
							</div>
						</div>
                            
 <?php echo $this->Form->end();?>   
 
 <script>
function calculate(){
   var tot_amount=0;
   var count=parseInt($('#count').val());
   for(k=0;k<=count;k++)
   {
	var amount=$('#reimbursement_released_amount_'+k).val();
	var amount=parseFloat(amount);
		if(!isNaN(amount)){
		//alert(amount);
			tot_amount=(tot_amount+amount);

			$('#PaymentPaymentAmount').val(tot_amount);
			$('.sub_total').text('INR '+tot_amount.toFixed(2));
			$('.grand_total_amt').text('INR '+tot_amount.toFixed(2));
		}
   }
}
 </script>
