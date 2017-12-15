<?php $this->Html->addCrumb('View / Edit Project','javascript:void(0);', array('class' => 'breadcrumblast'));
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
                                                <legend><span>View Project</span></legend>
                                            </fieldset>
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <?php
                echo $this->Form->create('Project', array('method' => 'post','class' => 'form-horizontal user_form',
                                                        'inputDefaults' => array(
                                                                        'label' => false,
                                                                        'div' => false,
                                                                        'class' => 'form-control',
																		
                                                                    )
                            ));
			
            
            
            ?>
                                                 <div class="col-sm-6">    
                                                    
                                                    <div class="form-group">
                                                        <label>Builder Name</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Builder']['builder_name'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group">
                                                        <label>Suburb</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Suburb']['suburb_name'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                          <div class="form-group">
                                                        <label>Type</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Type']['name'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Category</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Category']['name'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Expected Completion</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable"> 
                                                       <p class="form-control-static"><?php echo $this->data['Project']['proj_completionyear'];?></p>
                                                         
                                                        
                                                                                        
                                                                                        
                                                                                        </div>
                                                    </div>
                                         
                                                    <div class="form-group">
                                                        <label>No of Buildings</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Project']['no_of_buildings'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group int-sm">
                                                        <label>Landmark Distance</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Project']['proj_distancefromcentrallandmark'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Legal Approval status</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Project']['legal_approval_status'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Project Website</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Project']['proj_website'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Marketing Status</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Project']['proj_website'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                   </div>  
                                                  
                                                  
                                                  
                                                  
                                                  
                                                  
                                                  
                                                    <div class="col-sm-6">
                                                        	<div class="form-group">
                                                        <label>Project Name</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Project']['project_name'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label>City</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['City']['city_name'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Area</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Area']['area_name'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Phase</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Phase']['name'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Quality</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Quality']['name'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group int-sm">
                                                        <label>Area of Land</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Project']['proj_areaofland'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>No of Stories</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Project']['proj_storeys'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Construction status</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['ConstructionStatus']['value'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Bank Finance Status</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['FinanceStatus']['value'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Marketing Partners</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Project']['proj_marketing_partner'];?></p>
                                                            
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
																	Project Contacts
																</a>
															</h4>
														</div>
														<div id="acc1_collapseOne" class="panel-collapse collapse">
															<div class="form-group">
                                                       
                                                        <div class="col-sm-12">
                                                        	
                                                            <div class="form-control-static">
                                                            <div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"><!--<span class="badge badge-circle badge-success"> <?php echo count($this->data['BuilderContact'])?></span>-->Contact Details</h4></div><table class="table toggle-square responsive_table" data-filter="#table_search" data-page-size="40">
				<thead>
					<tr>
						<th data-toggle="true">Contact Id</th>
						<th data-hide="phone">Contact Name</th>
						<th data-hide="phone">Designation</th>
						<th data-hide="phone">Primary Mobile</th>
						<th data-hide="phone">Secondary Mobile</th>
                        <th data-hide="phone">Landline</th>
						<th data-hide="phone">Email Address</th>
						<th data-hide="phone">Location</th>
						<th data-hide="phone">Project Role</th>
                        <th data-hide="phone">Status</th>
						
                        <th data-hide="all" data-sort-ignore="true">Managed By</th>
						<th data-hide="all" data-sort-ignore="true">Manager</th>
						<th data-hide="all" data-sort-ignore="true">Created By</th>
                        <th data-hide="all" data-sort-ignore="true">Creator</th>
                        <th data-hide="all" data-sort-ignore="true">For Company</th>
						<th data-hide="all" data-sort-ignore="true">For Company City</th>
						<th data-hide="all" data-sort-ignore="true">Approved By</th>
                        <th data-hide="all" data-sort-ignore="true">Approved Date</th>
						<th data-hide="all" data-sort-ignore="true">Address of Contact</th>
                        
					</tr>
                  </thead>
                  <tbody>  
						 <?php 
						 $contact_name = '';
						 $contact_designation='';
						 $primary_mobile = '';
						 $secondary_mobile = '';
						 $land_line = '';
						 $email = '';
						 $location = '';
					//	 pr($builder_contacts);
						 
						 
						 if(count($this->data['ProjectContact']) && !empty($this->data['ProjectContact'])){
								foreach($this->data['ProjectContact'] as $ProjectContact){
								
								if(count($builder_contacts) && !empty($builder_contacts)){
									foreach($builder_contacts as $builder_contact)
									{
										
										if($builder_contact['BuilderContact']['id'] == $ProjectContact['project_contact_builder_contact_id']){
											
											$contact_name = $builder_contact['BuilderContact']['builder_contact_name'];
											$contact_designation = $builder_contact['BuilderContact']['builder_contact_designation'];
											$primary_mobile = $codes[$builder_contact['BuilderContact']['builder_contact_mobile_country_code']].' '.$builder_contact['BuilderContact']['builder_contact_mobile_no'];
											$secondary_mobile = $codes[$builder_contact['BuilderContact']['builder_contact_secondary_mobile_country_code']].' '.$builder_contact['BuilderContact']['builder_contact_secondary_mobile_no'];
											$land_line =  $codes[$builder_contact['BuilderContact']['builder_contact_lan_no_country_code']].' '.$builder_contact['BuilderContact']['builder_contact_lan_no'];
											$email = $builder_contact['BuilderContact']['builder_contact_email'];
											$location = $builder_contact['BuilderContact']['builder_contact_location'];
											$company = $builder_contact['BuilderContact']['builder_contact_company'];
											$company_city = $city[$builder_contact['BuilderContact']['builder_contact_company_city']];
											$contact_address = $builder_contact['BuilderContact']['builder_contact_address'];
										}
									}
								}
						?> 
						<tr>
                            <td><?php echo $ProjectContact['id'];?></td>
                            <td><?php echo $contact_name?></td>
                            <td><?php echo $contact_designation;?></td>
                            <td><?php echo $primary_mobile ;?></td>
                            <td><?php echo $secondary_mobile;?></td>
                            <td><?php echo $land_line;?></td>
                            <td><?php echo $email;?></td>
                            <td><?php echo $location;?></td>
                            <td><?php echo $projec_role[$ProjectContact['project_contact_project_role']];?></td>
                            <td><?php echo $ProjectContact['project_contact_status'];?></td>
                            <td><?php echo $ProjectContact['project_contact_managed_by'];?></td>
                            <td><?php echo $project_managed[$ProjectContact['project_contact_managed_by_id']];?></td>
                            <td><?php echo $projec_prepared[$ProjectContact['project_contact_prepared_by_id']];?></td>
                            <td><?php echo $ProjectContact['project_contact_prepared_by'];?></td>
                            <td><?php echo $company;?></td>
                            <td><?php echo $company_city;?></td>
                            <td><?php echo $ProjectContact['project_contact_approved_by'];?></td>
                            <td><?php echo date("d/m/Y", strtotime($ProjectContact['project_contact_approved_date']));?></td>
                            <td><?php echo $contact_address;?></td>
                            
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
																	Project Agreements
																</a>
															</h4>
														</div>
														<div id="acc1_collapseTwo" class="panel-collapse collapse">
															<div class="form-group">
                                                       
                                                        <div class="col-sm-12">
                                                        	
                                                            <div class="form-control-static">
                                                            <div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"><!--<span class="badge badge-circle badge-success"> <?php echo count($this->data['BuilderContact'])?></span>-->Agreement Details</h4></div><table class="table toggle-square responsive_table" data-filter="#table_search" data-page-size="40">
				<thead>
					<tr>
						<th data-toggle="true">Agreement Id</th>
						<th data-hide="phone">Done With</th>
						<th data-hide="phone">Counterparty</th>
						<th data-hide="phone">Level</th>
						<th data-hide="phone">Project Coverage</th>
                        <th data-hide="phone">Marketing Partner</th>
						<th data-hide="phone">Commission %</th>
                        <th data-hide="phone">Commission Based On</th>
						<th data-hide="phone">Status</th>
						<th data-hide="all" data-sort-ignore="true">Project Agreement Counterparty</th>
						<th data-hide="all" data-sort-ignore="true">Company Name</th>
                        <th data-hide="all" data-sort-ignore="true">Company Type</th>
						<th data-hide="all" data-sort-ignore="true">Signing Authority Name</th>
						<th data-hide="all" data-sort-ignore="true">Designation</th>
                        <th data-hide="all" data-sort-ignore="true">Primary Mobile</th>
                        <th data-hide="all" data-sort-ignore="true">Secondary Mobile</th>
						<th data-hide="all" data-sort-ignore="true">Landline</th>
						<th data-hide="all" data-sort-ignore="true">Email Address</th>
                        <th data-hide="all" data-sort-ignore="true">Company Address</th>
						<th data-hide="all" data-sort-ignore="true">Project Agreement Contact</th>
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
                        
                 	</tr>
                  </thead>
                  <tbody>  
						<?php if(count($this->data['ProjectAgreement']) && !empty($this->data['ProjectAgreement'])){
								foreach($this->data['ProjectAgreement'] as $ProjectAgreement){
								
								if(count($builder_agreements) && !empty($builder_agreements)){
									foreach($builder_agreements as $builder_agreement)
									{
										
										if($builder_agreement['BuilderAgreement']['id'] == $ProjectAgreement['project_agreement_builder_agreement_id']){
											
											$company_name = $builder_agreement['BuilderAgreement']['builder_agreement_company'];
											$company_city = $city[$builder_agreement['BuilderAgreement']['builder_agreement_company_city']];
										
											$land_line =  $codes[$builder_agreement['BuilderAgreement']['builder_agreement_lan_country_code']].' '.$builder_agreement['BuilderAgreement']['builder_agreement_lan_no'];
											$initiated = $builder_agreement['BuilderAgreement']['builder_agreement_intiated_by'];
											$initiated_by = $builder_agreement['BuilderAgreement']['builder_agreement_intiated_by_id'];
											
											$company = $builder_contact['BuilderContact']['builder_contact_company'];
											$company_city = $city[$builder_contact['BuilderContact']['builder_contact_company_city']];
											$contact_address = $builder_contact['BuilderContact']['builder_contact_address'];
										}
									}
								}
						?> 
						<tr>
						<td><?php echo $ProjectAgreement['id'];?></td>
						<td><?php echo $ProjectAgreement['project_agreement_done_with'];?></td>
                        <td><?php //echo $ProjectAgreement[$BuilderAgreement['builder_agreement_level']];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_project_id'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_marketing_partner_id'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_commission_percent'];?></td>
                        <td><?php //echo $commission_based_on[$BuilderAgreement['builder_agreement_commission_based_on']];?></td>
                        <td><?php //echo $agreement_status[$BuilderAgreement['builder_agreement_status']];?></td>
                        <td><?php echo $ProjectAgreement['project_agreement_status'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_company'];?></td>
                        <td><?php echo $company_name;?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_signed_by'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_contact_designation'];?></td>
                        <td><?php //echo $codes[$BuilderAgreement['builder_agreement_counterparty_primarymobile_code']].' '.$BuilderAgreement['builder_agreement_counterparty_primarymobile'];?></td>
                        <td><?php //echo $codes[$BuilderAgreement['builder_agreement_counterparty_secondarymobile_code']].' '.$BuilderAgreement['builder_agreement_counterparty_secondarymobile'];?></td>
                        <td><?php echo $land_line;?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_counterparty_email'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_contact_address'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_contact_name'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_contact_name'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_contact_designation'];?></td>
                        <td><?php //echo $codes[$BuilderAgreement['builder_agreement_contact_primary_mobile_code']].' '.$BuilderAgreement['builder_agreement_contact_primary_mobile'];?></td>
                        <td><?php //echo $codes[$BuilderAgreement['builder_agreement_contact_secondary_mobile_code']].' '.$BuilderAgreement['builder_agreement_contact_secondary_mobile'];?></td>
                        <td><?php //echo $codes[$BuilderAgreement['builder_agreement_lan_country_code']].' '.$BuilderAgreement['builder_agreement_lan_no'];?></td>
						<td><?php //echo $BuilderAgreement['builder_agreement_contact_email'];?></td>
                        <td><?php //echo $city[$BuilderAgreement['builder_agreement_city_id']];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_contact_address'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_proposed_by'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_company_moa'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_intiated_by'];?></td>
                        <td><?php //echo $intiate_by[$BuilderAgreement['builder_agreement_intiated_by_id']];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_managed_by'];?></td>
                        <td><?php //echo $manage_by[$BuilderAgreement['builder_agreement_managed_by_id']];?></td>
                        <td><?php //echo $prepare_by[$BuilderAgreement['builder_agreement_prepared_by_id']];?></td>
						<td><?php //echo $BuilderAgreement['builder_agreement_prepared_by'];?></td>
						<td><?php //echo $BuilderAgreement['builder_agreement_company'];?></td>
						<td><?php //echo $city[$BuilderAgreement['builder_agreement_company_city']];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_effective_date'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_expiry_date'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_approved_by'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_approved_date'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_signed_by'];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_signed_date'];?></td>
                        <td><?php //echo $commission_terms[$BuilderAgreement['builder_agreement_commission_term']];?></td>
                        <td><?php //echo $BuilderAgreement['builder_agreement_remarks'];?></td>
                         
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
																	JVs & Builders 
																</a>
															</h4>
														</div>
														<div id="acc1_collapseThree" class="panel-collapse collapse">
															<div class="panel-body">
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Primary Builder</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        <div class="form-group">
                                                        	<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php																	
																	echo $this->data['Builder']['builder_name'];?></p>
                                                            
                                                        </div>
                                                        	
                                                        	
                                                        </div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Secondary Builder</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        <div class="form-group">
                                                        	<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php																	
																		
																	echo $this->data['SecondaryBuilder']['builder_name'].','.$this->data['TertiaryBuilder']['builder_name'];?></p>
                                                            
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
																	Main USP
																</a>
															</h4>
														</div>
														<div id="acc1_collapseFour" class="panel-collapse collapse">
															<div class="panel-body">
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>USP 1</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        <div class="form-group">
                                                        	<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php																	
																	echo $this->data['Project']['proj_usp1'];?></p>
                                                            
                                                        </div>
                                                        	
                                                        	
                                                        </div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>USP 2</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        	<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Project']['proj_usp2'];?></p>
                                                            
                                                        </div>
                                                        		
                                                        		
                                                        	</div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>USP 3</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Project']['proj_usp3'];?></p>
                                                            
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
																	Project Amenities
																</a>
															</h4>
														</div>
														<div id="acc1_collapseFive" class="panel-collapse collapse">
															<div class="panel-body">
                                                                <div class="col-sm-12">
                                                        	
                                                            <div class="form-control-static">
                                                            <div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"><!--<span class="badge badge-circle badge-success"> <?php echo count($this->data['BuilderContact'])?></span>-->Amenity Details</h4></div><table class="table" data-filter="#table_search" data-page-size="40">
				
                  <tbody>  
						<?php if(count($amenities) && !empty($amenities)){
								foreach ($amenities as $key => $amenitie) {
								
								
						?> 
						<tr>
						<td><?php echo $amenities[$key]['Group']['group_name']; ?></td>
                        <td><?php echo $amenities[$key][0]['amenity_name']; ?></td>
				
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
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseSix">
																	Project Rating
																</a>
															</h4>
														</div>
														<div id="acc1_collapseSix" class="panel-collapse collapse">
															<div class="panel-body">
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Rating</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        <div class="form-group">
                                                        	<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php																	
																	echo $this->data['Project']['proj_rating'].' -> '.rating_range($this->data['Project']['proj_rating']);?></p>
                                                            
                                                        </div>
                                                        	
                                                        	
                                                        </div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Builder Brand</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        	<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Project']['proj_ratingbuilderbrand'].' -> '.rating_range($this->data['Project']['proj_ratingbuilderbrand']);?></p>
                                                            <div class="hidden_control">
                                                               <?php echo $this->Form->input('proj_ratingbuilderbrand'); ?>
                                                            </div>
                                                        </div>
                                                        		
                                                        		
                                                        	</div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Location</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Project']['proj_ratinglocation'].' -> '.rating_range($this->data['Project']['proj_ratinglocation']);?></p>
                                                            <div class="hidden_control">
                                                               <?php echo $this->Form->input('proj_ratinglocation'); ?>
                                                            </div>
                                                        </div>
                                                        	
                                                        		
                                                       	 	</div>
                                                        </div>	
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Rate</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Project']['proj_ratingrate'].' -> '.rating_range($this->data['Project']['proj_ratingrate']);?></p>
                                                            <div class="hidden_control">
                                                               <?php echo $this->Form->input('proj_ratingrate'); ?>
                                                            </div>
                                                        </div>
                                                        	
                                                        		
                                                       	 	</div>
                                                        </div>	
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Appreciation Potential</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Project']['proj_ratingappreciationpotential'].' -> '.rating_range($this->data['Project']['proj_ratingappreciationpotential']);?></p>
                                                            <div class="hidden_control">
                                                               <?php echo $this->Form->input('proj_ratingappreciationpotential'); ?>
                                                            </div>
                                                        </div>
                                                        	
                                                        		
                                                       	 	</div>
                                                        </div>	
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Availability</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Project']['proj_ratingavailability'].' -> '.rating_range($this->data['Project']['proj_ratingavailability']);?></p>
                                                            <div class="hidden_control">
                                                               <?php echo $this->Form->input('proj_ratingavailability'); ?>
                                                            </div>
                                                        </div>
                                                        	
                                                        		
                                                       	 	</div>
                                                        </div>	
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Amenities</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Project']['proj_ratingamenities'].' -> '.rating_range($this->data['Project']['proj_ratingamenities']);?></p>
                                                            <div class="hidden_control">
                                                               <?php echo $this->Form->input('proj_ratingamenities'); ?>
                                                            </div>
                                                        </div>
                                                        	
                                                        		
                                                       	 	</div>
                                                        </div>	
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Vastu Compliancy</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Project']['proj_ratingvastucompliancy'].' -> '.rating_range($this->data['Project']['proj_ratingvastucompliancy']);?></p>
                                                            
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
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseSeven">
																	Unit
																</a>
															</h4>
														</div>
														<div id="acc1_collapseSeven" class="panel-collapse collapse">
															<div class="panel-body">
                                                                <div class="col-sm-12">
                                                        	
                                                            <div class="form-control-static">
                                                            <div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"><!--<span class="badge badge-circle badge-success"> <?php echo count($this->data['BuilderContact'])?></span>-->Unit Details</h4></div><table class="table toggle-square responsive_table" data-filter="#table_search" data-page-size="40">
				<thead>
					<tr>
						<th data-toggle="true">Type</th>
						<th data-hide="phone">Rate</th>
						<th data-hide="phone">Sellable (lowest size)</th>
						<th data-hide="phone">Sellable (highest size)</th>
						<th data-hide="phone">Carpet (lowest size)</th>
                        <th data-hide="phone">Carpet (highest size)</th>
						<th data-hide="phone">Basic cost</th>
                        <th data-hide="phone">FLR Rise</th>
						<th data-hide="phone">PLC</th>
						<th data-hide="all" data-sort-ignore="true">Other</th>
						<th data-hide="all" data-sort-ignore="true">Agreement</th>
                        <th data-hide="all" data-sort-ignore="true">Down %</th>
						<th data-hide="all" data-sort-ignore="true">Due IN (Days)</th>
                       
                 	</tr>
                  </thead>
                  <tbody>  
						<?php 
					//	pr($this->data['ProjectUnit']);
						if(count($this->data['ProjectUnit']) && !empty($this->data['ProjectUnit'])){
								foreach($this->data['ProjectUnit'] as $unit){
								
						?> 
						<tr>
						<td><?php echo $unit['unit_type'] ?></td>
						<td><?php echo $unit['unit_price'] ?></td>
                        <td><?php echo $unit['unit_sellable_area_lowest_size']?></td>
                        <td><?php echo $unit['unit_sellable_area_highest_size']?></td>
                        <td><?php echo $unit['units_carpet_area_lowest_size']?></td>
                        <td><?php echo $unit['unit_carpet_area_highest_size'];?></td>
                        <td><?php echo $unit['unit_total_basic_cost'];?></td>
                        <td><?php echo $unit['unit_flr_rise'];?></td>
                        <td><?php echo $unit['unit_plc'];?></td>
                        <td><?php echo $unit['unit_total_other_costs'];?></td>
                        <td><?php echo $unit['unit_agreement_value'];?></td>
                        <td><?php echo $unit['unit_brokerage_commission_percentage'];?></td>
                       	<td><?php echo $unit['unit_brokerage_commission_percentage'];?></td>
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
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseEight">
																	Download Links
																</a>
															</h4>
														</div>
														<div id="acc1_collapseEight" class="panel-collapse collapse">
															<div class="panel-body">
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Brochure</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        <div class="form-group">
                                                        	<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php																	
																	echo $this->data['Project']['proj_rebrandedbrochure'];echo $this->Html->link('Dowload', '#', array('class' => 'add-btn'));?></p>
                                                            
                                                        </div>
                                                        	

                                                        	
                                                        </div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Floor Plan</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        	<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Project']['proj_floorplans'];  echo $this->Html->link('Dowload', '#', array('class' => 'add-btn'));?></p>
                                                            
                                                        </div>
                                                        		
                                                        		
                                                        	</div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Location Map</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Project']['proj_locationmaps'];echo $this->Html->link('Dowload', '#', array('class' => 'add-btn'));?></p>
                                                            
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

