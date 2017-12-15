<?php $this->Html->addCrumb('View Builder','javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($this->data);
function rating_range($num){
    switch($num){
        case in_array($num, range(0, 20000)):
                    return 'Poor';
                    break;
        case in_array($num, range(20001, 40000)):
                    return 'Average';
                    break;
        case in_array($num, range(40001, 60000)):
                    return 'Above Average';
                    break;
        case in_array($num, range(60001, 75000)):
                    return 'Great';
                    break;
        case in_array($num, range(75001, 90000)):
                    return 'Outstanding';
                    break;
        case in_array($num, range(90001, 100000)):
                    return 'Out of the World';
                    break;
                
                
        default: //default
            return "within no range";
            break;       
    }
}
?>


							<div class="col-sm-12" id="mycl-det">
                                <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h4 class="panel-title">View Information</h4>
                                        
                                    </div>
                          
                                    <div class="panel-body">
                                            <fieldset>
                                                <legend><span>View  Builder</span></legend>
                                            </fieldset>
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <?php
                echo $this->Form->create('Builder', array('method' => 'post','class' => 'form-horizontal user_form','id' => 'builder',
                                                        'inputDefaults' => array(
                                                                        'label' => false,
                                                                        'div' => false,
                                                                        'class' => 'form-control',
																		
                                                                    )
                            ));
					
            if($this->data['Builder']['builder_approved'] == 1)	
											$approved = 'Approved'	;
									else
									   		$approved = 'Pending'	;
            
            ?>
                                                 <div class="col-sm-6">    
                                                    <div class="form-group">
                                                        <label>Approval Status</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                            <p class="form-control-static"><?php echo $approved;?></p>
                                                            <!--<div class="hidden_control">
                                                                <?php  echo $approved ; ?>
                                                            </div>-->
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label>Website</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->Html->link($this->data['Builder']['builder_website'],$this->data['Builder']['builder_website'],array('target' => '_blank','escape' => false)); $this->data['Builder']['builder_website'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group slt-sm">
                                                        <label>Board Number</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['BoardNumber']['code'].' '.$this->data['Builder']['builder_boardnumber'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                   </div>  
                                                    <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Builder Name</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Builder']['builder_name'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Primary City</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['City']['city_name'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Board Email</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Builder']['builder_boardemail'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    </div>
                                                    
                                                       <div class="col-sm-12">
                                                        	<div class="form-group">
                                                        <label>Corporate Address</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable txtbox">
                                                            <p class="form-control-static"><?php echo $this->data['Builder']['builder_corporateaddress'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    		<div class="form-group">
                                                        <label>Builder Description</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable txtbox">
                                                            <p class="form-control-static"><?php echo $this->data['Builder']['builder_description'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                        </div>
                                                   
													
														
									
									
										<div class="row">
											<div class="col-sm-12">
												<div class="panel-group" id="accordion1">
                                                <div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title fpt">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseOne">
																	Builder Contacts
																</a>
															</h4>
														</div>
														<div id="acc1_collapseOne" class="panel-collapse collapse">
															<div class="form-group">
                                                       
                                                        <div class="col-sm-12">
                                                        	
                                                            <div class="form-control-static">
                                                            <div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"><!--<span class="badge badge-circle badge-success"> <?php echo count($this->data['BuilderContact'])?></span>-->Contact Details</h4><span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i>
                                                                <?php
                                                                echo $this->Html->link('Add Contact', '/builder/add_contact/'.$this->data['Builder']['id'],array('class' => 'open-popup-link add-btn'));?>
                                                                
                                                                </span></div><table class="table toggle-square responsive_table" data-filter="#table_search" data-page-size="40">
				<thead>
					<tr>
						<th data-toggle="true">Contact Id</th>
						<th data-hide="phone">Contact Name</th>
						<th data-hide="phone">Designation</th>
						<th data-hide="phone">Primary Mobile</th>
						<th data-hide="phone">Secondary Mobile</th>
                        
						<th data-hide="phone">Email Address</th>
						<th data-hide="phone">Location</th>
						<th data-hide="phone">Level</th>
                        
						<th data-hide="all" data-sort-ignore="true">Initiated By</th>
						<th data-hide="all" data-sort-ignore="true">Intiator</th>
                        <th data-hide="all" data-sort-ignore="true">Managed By</th>
						<th data-hide="all" data-sort-ignore="true">Manager</th>
						
                        <th data-hide="all" data-sort-ignore="true">For Company</th>
						<th data-hide="all" data-sort-ignore="true">For Company City</th>
						<th data-hide="all" data-sort-ignore="true">Approved By</th>
                        <th data-hide="all" data-sort-ignore="true">Approved Date</th>
						<th data-hide="all" data-sort-ignore="true">Address of Contact</th>
                        <th data-hide="phone" data-sort-ignore="true">Action</th>
					</tr>
                  </thead>
                  <tbody>  
						 <?php if(count($this->data['BuilderContact']) && !empty($this->data['BuilderContact'])){
								foreach($this->data['BuilderContact'] as $BuilderContact){
						?> 
						<tr>
                            <td><?php echo $BuilderContact['id'];?></td>
                            <td><?php echo $BuilderContact['builder_contact_name'];?></td>
                            <td><?php echo $BuilderContact['builder_contact_designation'];?></td>
                            <td><?php echo $codes[$BuilderContact['builder_contact_mobile_country_code']] .' '.$BuilderContact['builder_contact_mobile_no'] ;?></td>
                            <td><?php echo $BuilderContact['builder_contact_secondary_mobile_country_code'].' '.$BuilderContact['builder_contact_secondary_mobile_no'];?></td>
                         
                            <td><?php echo $BuilderContact['builder_contact_email'];?></td>
                            <td><?php echo $BuilderContact['builder_contact_location'];?></td>
                            <td><?php echo $contact_level[$BuilderContact['builder_contact_level']];?></td>
                          
                            <td><?php echo $BuilderContact['builder_contact_intiated_by'];?></td>
                            <td><?php echo $contact_initiated[$BuilderContact['builder_contact_intiated_by_id']];?></td>
                            <td><?php echo $BuilderContact['builder_contact_managed_by'];?></td>
                         
                            <td><?php echo $BuilderContact['builder_contact_approved_by'];?></td>
                            <td><?php echo $BuilderContact['builder_contact_company'];?></td>
                            <td><?php echo $city[$BuilderContact['builder_contact_company_city']];?></td>
                            <td><?php echo $BuilderContact['builder_contact_approved_by'];?></td>
                            <td><?php echo date("d/m/Y", strtotime($BuilderContact['builder_contact_approved_date']));?></td>
                            <td><?php echo $BuilderContact['builder_contact_email'];?></td>
                            <td><?php 
							
							echo $this->Html->link('<span class="icon-pencil"></span>', '/builder/edit_contact/'.$BuilderContact['id'], array('class' => 'act-ico open-popup-link add-btn','escape' => false));
							?></td>
						</tr>
                        <?php }
						}?>
					
                  </tbody>   
				</table></div>
                                                            
                                                        </div>
                                                    </div>
													</div>
													
												</div>
													
													
                                                    
                                                    <div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title fpt">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseTwo">
																	Builder Agreements
																</a>
															</h4>
														</div>
														<div id="acc1_collapseTwo" class="panel-collapse collapse">
															<div class="form-group">
                                                       
                                                        <div class="col-sm-12">
                                                        	
                                                            <div class="form-control-static">
                                                            <div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"><!--<span class="badge badge-circle badge-success"> <?php echo count($this->data['BuilderContact'])?></span>-->Agreement Details</h4><span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i>
                                                                <?php
                                                                echo $this->Html->link('Add Agreement', '/builder/add_agreement/'.$this->data['Builder']['id'],array('class' => 'open-popup-link add-btn'));?>
                                                                
                                                                </span></div><table class="table toggle-square responsive_table" data-filter="#table_search" data-page-size="40">
				<thead>
					<tr>
						<th data-toggle="true">Agreement Id</th>
						<th data-hide="phone">With Company</th>
						<th data-hide="phone">Level</th>
						<th data-hide="phone">Project Coverage</th>
						<th data-hide="phone">Marketing Partner</th>
                        <th data-hide="phone">Commission %</th>
						<th data-hide="phone">Commission Based On</th>
						<th data-hide="phone">Status</th>
						<th data-hide="all" data-sort-ignore="true">Builder Agreement Counterparty</th>
						<th data-hide="all" data-sort-ignore="true">Company Name</th>
                        <th data-hide="all" data-sort-ignore="true">Company Type</th>
						<th data-hide="all" data-sort-ignore="true">Signing Authority Name</th>
						<th data-hide="all" data-sort-ignore="true">Designation</th>
                        <th data-hide="all" data-sort-ignore="true">Primary Mobile</th>
                        <th data-hide="all" data-sort-ignore="true">Secondary Mobile</th>
						<th data-hide="all" data-sort-ignore="true">Landline</th>
						<th data-hide="all" data-sort-ignore="true">Email Address</th>
                        <th data-hide="all" data-sort-ignore="true">Company Address</th>
						<th data-hide="all" data-sort-ignore="true">Builder Agreement Contact</th>
                        <th data-hide="all" data-sort-ignore="true">Contact Name</th>
                        <th data-hide="all" data-sort-ignore="true">Designation</th>
                        <th data-hide="all" data-sort-ignore="true">Primary Mobile</th>
                        <th data-hide="all" data-sort-ignore="true">Secondary Mobile</th>
                        <th data-hide="all" data-sort-ignore="true">Landline</th>
                        <th data-hide="all" data-sort-ignore="true">Email Address</th>
                        <th data-hide="all" data-sort-ignore="true">City</th>
                        <th data-hide="all" data-sort-ignore="true">Address</th>
                        <th data-hide="all" data-sort-ignore="true">Proposed By</th>
                        <th data-hide="all" data-sort-ignore="true">Company MOA</th>
                        <th data-hide="all" data-sort-ignore="true">Initiated By</th>
                        <th data-hide="all" data-sort-ignore="true">Intiator</th>
                        <th data-hide="all" data-sort-ignore="true">Managed By</th>
                        <th data-hide="all" data-sort-ignore="true">Manager</th>
                        <th data-hide="all" data-sort-ignore="true">Created By</th>
                        <th data-hide="all" data-sort-ignore="true">Creator</th>
                        <th data-hide="all" data-sort-ignore="true">For Company</th>
                        <th data-hide="all" data-sort-ignore="true">Company City</th>
                        <th data-hide="all" data-sort-ignore="true">Effective Date</th>
                        <th data-hide="all" data-sort-ignore="true">Expiry Date</th>
                        <th data-hide="all" data-sort-ignore="true">Approved By</th>
                        <th data-hide="all" data-sort-ignore="true">Approved Date</th>
                        <th data-hide="all" data-sort-ignore="true">Signed By</th>
                        <th data-hide="all" data-sort-ignore="true">Signed Date</th>
                        <th data-hide="all" data-sort-ignore="true">Agreement Commission Terms</th>
                        <th data-hide="all" data-sort-ignore="true">Agreement Remarks</th>
                         <th data-hide="phone" data-sort-ignore="true">Action</th>
                 	</tr>
                  </thead>
                  <tbody>  
						<?php if(count($this->data['BuilderAgreement']) && !empty($this->data['BuilderAgreement'])){
								foreach($this->data['BuilderAgreement'] as $BuilderAgreement){
						?> 
						<tr>
						<td><?php echo $BuilderAgreement['id'];?></td>
						<td><?php echo $BuilderAgreement['builder_agreement_company'];?></td>
                        <td><?php echo $agreement_level[$BuilderAgreement['builder_agreement_level']];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_project_id'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_marketing_partner_id'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_commission_percent'];?></td>
                        <td><?php echo $commission_based_on[$BuilderAgreement['builder_agreement_commission_based_on']];?></td>
                        <td><?php echo $agreement_status[$BuilderAgreement['builder_agreement_status']];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_counterparty_name'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_company'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_contact_intiated_by'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_signed_by'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_contact_designation'];?></td>
                        <td><?php echo $codes[$BuilderAgreement['builder_agreement_counterparty_primarymobile_code']].' '.$BuilderAgreement['builder_agreement_counterparty_primarymobile'];?></td>
                        <td><?php echo $codes[$BuilderAgreement['builder_agreement_counterparty_secondarymobile_code']].' '.$BuilderAgreement['builder_agreement_counterparty_secondarymobile'];?></td>
                        <td><?php echo $codes[$BuilderAgreement['builder_agreement_counterparty_lan_code']].' '.$BuilderAgreement['builder_agreement_counterparty_lan'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_counterparty_email'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_contact_address'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_contact_name'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_contact_name'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_contact_designation'];?></td>
                        <td><?php echo $codes[$BuilderAgreement['builder_agreement_contact_primary_mobile_code']].' '.$BuilderAgreement['builder_agreement_contact_primary_mobile'];?></td>
                        <td><?php echo $codes[$BuilderAgreement['builder_agreement_contact_secondary_mobile_code']].' '.$BuilderAgreement['builder_agreement_contact_secondary_mobile'];?></td>
                        <td><?php echo $codes[$BuilderAgreement['builder_agreement_lan_country_code']].' '.$BuilderAgreement['builder_agreement_lan_no'];?></td>
						<td><?php echo $BuilderAgreement['builder_agreement_contact_email'];?></td>
                        <td><?php echo $city[$BuilderAgreement['builder_agreement_city_id']];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_contact_address'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_proposed_by'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_company_moa'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_intiated_by'];?></td>
                        <td><?php echo $intiate_by[$BuilderAgreement['builder_agreement_intiated_by_id']];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_managed_by'];?></td>
                        <td><?php echo $manage_by[$BuilderAgreement['builder_agreement_managed_by_id']];?></td>
                        <td><?php echo $prepare_by[$BuilderAgreement['builder_agreement_prepared_by_id']];?></td>
						<td><?php echo $BuilderAgreement['builder_agreement_prepared_by'];?></td>
						<td><?php echo $BuilderAgreement['builder_agreement_company'];?></td>
						<td><?php echo $city[$BuilderAgreement['builder_agreement_company_city']];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_effective_date'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_expiry_date'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_approved_by'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_approved_date'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_signed_by'];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_signed_date'];?></td>
                        <td><?php echo $commission_terms[$BuilderAgreement['builder_agreement_commission_term']];?></td>
                        <td><?php echo $BuilderAgreement['builder_agreement_remarks'];?></td>
                         <td><?php 
							
							echo $this->Html->link('<span class="icon-pencil"></span>', '/builder/edit_agreement/'.$BuilderAgreement['id'], array('class' => 'act-ico open-popup-link add-btn','escape' => false));
							?></td>
						</tr>
					<?php }
					}
					
					?>
                  </tbody>   
				</table></div>
                                                            
                                                        </div>
                                                    </div>
													</div>
													
												</div>
                                                    
                                                    <div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title fpt">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseThree">
																	Builder Multicity Operations
																</a>
															</h4>
														</div>
														<div id="acc1_collapseThree" class="panel-collapse collapse">
															<div class="panel-body">
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Primary City</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        <div class="form-group">
                                                        	<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php																	
																	echo $this->data['City']['city_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('builder_primarycity',  array('options' => $city, 'empty' => '--Select--')); ?>
                                                            </div>
                                                        </div>
                                                        	
                                                        	
                                                        </div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Secondary City</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        <div class="form-group">
                                                        	<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php																	
																	$secondary_city = '';
																	
																	if($this->data['SecondaryCity']['city_name'])
																		$secondary_city .= $this->data['SecondaryCity']['city_name'].',';
																	if($this->data['TertiaryCity']['city_name'])
																		$secondary_city .= $this->data['TertiaryCity']['city_name'].',';
																	if($this->data['City4']['city_name'])
																		$secondary_city .= $this->data['City4']['city_name'].',';
																	if($this->data['City5']['city_name'])
																		$secondary_city .= $this->data['City5']['city_name'].',';
																									
																	
																
																
																
																
																
																	echo $secondary_city;?></p>
                                                            
                                                        </div>
                                                        
                                                        	
                                                        	
                                                        </div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                
                                                                
                                                                															</div>
														</div>
													</div>
                                                    
                                                    <div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title fpt">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseFour">
																	Builder Construction Capabilities
																</a>
															</h4>
														</div>
														<div id="acc1_collapseFour" class="panel-collapse collapse">
															<div class="panel-body">
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Residential</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        <div class="form-group">
                                                        	<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php																	
																	echo $this->data['Residental']['value'];?></p>
                                                            
                                                        </div>
                                                        	
                                                        	
                                                        </div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>High End Residential</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        	<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Highend']['value'];?></p>
                                                            
                                                        </div>
                                                        		
                                                        		
                                                        	</div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Commercial</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Commercial']['value'];?></p>
                                                            
                                                        </div>
                                                        	
                                                        		
                                                       	 	</div>
                                                        </div>	
                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                															</div>
														</div>
													</div>
                                                    <div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title fpt">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseFive">
																	Builder Rating
																</a>
															</h4>
														</div>
														<div id="acc1_collapseFive" class="panel-collapse collapse">
															<div class="panel-body">
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Rating</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        <div class="form-group">
                                                        	<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php																	
																	echo $this->data['Builder']['builder_rating'].' -> '.rating_range($this->data['Builder']['builder_rating']);?></p>
                                                            
                                                        </div>
                                                        	
                                                        	
                                                        </div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Brand Recognition</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        	<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Builder']['builder_brandrecognition'].' -> '.rating_range($this->data['Builder']['builder_brandrecognition']);?></p>
                                                            
                                                        </div>
                                                        		
                                                        		
                                                        	</div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Quality of Construction</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Builder']['builder_qualityofconstruction'].' -> '.rating_range($this->data['Builder']['builder_qualityofconstruction']);?></p>
                                                            
                                                        </div>
                                                        	
                                                        		
                                                       	 	</div>
                                                        </div>	
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Timely Delivery</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Builder']['builder_timelydelivery'].' -> '.rating_range($this->data['Builder']['builder_timelydelivery']);?></p>
                                                            
                                                        </div>
                                                        	
                                                        		
                                                       	 	</div>
                                                        </div>	
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Past Track Record</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Builder']['builder_pasttrackrecord'].' -> '.rating_range($this->data['Builder']['builder_pasttrackrecord']);?></p>
                                                            
                                                        </div>
                                                        	
                                                        		
                                                       	 	</div>
                                                        </div>	
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Professionalism</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Builder']['builder_professionalismandtransparency'].' -> '.rating_range($this->data['Builder']['builder_professionalismandtransparency']);?></p>
                                                            
                                                        </div>
                                                        	
                                                        		
                                                       	 	</div>
                                                        </div>	
                                                    </div>
                                                                </div>
                                                                
                                                                
                                                                															</div>
														</div>
													</div>
                                                	
                                                	
                                                
											</div>
											
										</div>
									</div>
								
							
						
                                                    
                                                    
                                                    
                                                    <?php echo $this->Form->end(); ?>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>

