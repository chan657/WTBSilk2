<?php $this->Html->addCrumb('View Client','javascript:void(0);', array('class' => 'breadcrumblast'));?>
							<div class="col-sm-12" id="mycl-det">
                                <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h4 class="panel-title">View Information</h4>
                                        
                                    </div>
                          
                                    <div class="panel-body">
                                            <fieldset>
                                                <legend><span>View Client</span></legend>
                                            </fieldset>
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <?php
                echo $this->Form->create('Lead', array('method' => 'post','class' => 'form-horizontal user_form',
                                                        'inputDefaults' => array(
                                                                        'label' => false,
                                                                        'div' => false,
                                                                        'class' => 'form-control',
                                                                    )
                            ));
            
            
            ?>
                                                 <div class="col-sm-6">    
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['City']['city_name'];?></p>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Created By</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['User']['fname'].' '.$this->data['User']['lname'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('created_by',  array('options'=>$created_by)); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Urgency</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Urgency']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php   echo $this->Form->input('lead_urgency',  array('options' => $urgencies,'empty' => 'Select')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Lead']['lead_fname'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('lead_fname'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group slt-sm">
                                                        <label>Primary Contact No</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['PrimaryCode']['value'].': '.$this->data['PrimaryCode']['code'].' '.$this->data['Lead']['lead_primaryphonenumber'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('lead_primary_phone_country_code', array('div' => false,'id' => 'LeadPrimaryCode','options' => $codes,'default' => '76','empty' => '--Select--'));
				   echo $this->Form->input('lead_primaryphonenumber',  array('div' => false,'class' => 'form-control sm rgt')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Location</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php  echo $this->data['Country']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('lead_country',  array('options' => $countires,'empty' => 'Select')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Status']['status'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('lead_status',  array('options' => $status,'empty' => 'Select','default' => '1','disabled' => array('2','3','4','5','6','7','8'))); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Progress</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Progress']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('lead_progress',  array('options' =>$lead_progrss,'empty' => 'Select')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Category</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['category']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php   echo $this->Form->input('lead_category',  array('options'=>$categories,'empty'=>'Select','default' => '1','disabled' => array('2','3'))); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Industry</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['industry']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php   echo $this->Form->input('lead_industry',  array('options' => $industry, 'default' => '1','disabled' => array('2','3'))); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group slt-sm">
                                                        <label>Budget</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php  echo $this->data['courrency']['value'].' '.$this->data['Lead']['lead_budget'];?></p>
                                                            <div class="hidden_control">
                                                                <?php   echo $this->Form->input('lead_budget_unit', array('options' => $courrency,'empty' => '--Select--'));
					echo $this->Form->input('lead_budget',  array('class' => 'form-control sm rgt')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   </div>  
                                                    <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Creation Type</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['CreationType']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_creation_type',  array('options' => $creation_types,'empty' => 'Select')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Phone Officer</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['PhoneOfficer']['fname'].' '.$this->data['PhoneOfficer']['mname'].' '.$this->data['PhoneOfficer']['lname'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_phoneofficer',  array('options' => $phone_officer,'id' => 'phone_officer_id'));
					   
				echo $this->Form->input('ajax_lead_phoneofficer',  array('div' =>array('id' => 'phone_div_id','style' => 'display:none'),'options' => array()));	 ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Importance</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Importance']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('lead_importance',  array('options' => $importance,'empty' => 'Select')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php  echo $this->data['Lead']['lead_lname'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_lname'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group slt-sm">
                                                        <label>Secondary Contact No</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php  echo $this->data['SecondaryCode']['value'].': '.$this->data['SecondaryCode']['code'].' '.$this->data['Lead']['lead_secondaryphonenumber'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_secondary_phone_country_code', array('div' =>false,'id' => 'LeadSecondaryCode','options' => $codes,'default' => '76','empty' => '--Select--'));
				    echo $this->Form->input('lead_secondaryphonenumber',  array('div' =>false,'class' => 'form-control sm rgt')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Lead']['lead_emailid'];;?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_emailid'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Type']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_type',  array('options' => $types,'empty' => 'Select')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Special</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php  echo $this->data['Special']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_special_client_status',  array('options' => array('1' => 'Yes','2' =>'No'),'empty' => 'Select')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Source</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Source']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_source',  array('options' => $source,'empty' => 'Select','default' => '1','disabled' => array('2'))); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Segment</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Segment']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('lead_segment',  array('options' => $segment,'empty' => 'Select','default' => '1'));?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Closure Probability</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['ClosurProbability']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('lead_closureprobabilityinnext1Month',  array('options' => $closureprobabilities,'empty' => 'Select','default' => '6','disabled' => array('1','2','3','4','5')));	 ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                   
                                                    </div>
                                                    
                                                        <div class="col-sm-12">
                                                        	<div class="form-group">
                                                        <label>Residential Address</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable txtbox">
                                                            <p class="form-control-static"><?php echo $this->data['Lead']['lead_streetaddress'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_streetaddress',  array('type'=>'textarea')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    		<div class="form-group">
                                                        <label>Client Description</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable txtbox">
                                                            <p class="form-control-static"><?php echo $this->data['Lead']['lead_description'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_description',  array('type'=>'textarea')); ?>
                                                            </div>
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
																	Lead Preferences
																</a>
															</h4>
														</div>
														<div id="acc1_collapseOne" class="panel-collapse collapse">
															<div class="panel-body">
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Suburb</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        <div class="form-group">
                                                        	<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php																	
																	echo $this->data['Suburb']['suburb_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_suburb1',  array('options' => $suburbs, 'empty' => '--Preference 1--', 'class' => 'form-control city_bootbox_custom','onchange' => 'filterPreferences(this.value,\'LeadLeadSuburb2\',\'LeadLeadSuburb3\')')); ?>
                                                            </div>
                                                        </div>
                                                        	<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php 
																	echo $this->data['Suburb2']['suburb_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_suburb2',  array('options' => $suburbs, 'empty' => '--Preference 2--','class' => 'form-control pre_bootbox_custom','onchange' => 'filterPreferences(this.value,\'LeadLeadSuburb1\',\'LeadLeadSuburb3\')')); ?>
                                                            </div>
                                                        </div>
                                                        	<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php 																	
																	echo $this->data['Suburb3']['suburb_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_suburb3',  array('options' => $suburbs, 'empty' => '--Preference 3--','class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadLeadSuburb1\',\'LeadLeadSuburb2\')')); ?>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Area</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        	<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['AreaPreference']['area_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_areapreference1',  array('options' => $areas, 'empty' => '--Preference 1--', 'onchange' => 'filterPreferences(this.value,\'LeadLeadAreapreference2\',\'LeadLeadAreapreference3\')')); ?>
                                                            </div>
                                                        </div>
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php 																	
																	echo $this->data['AreaPreference2']['area_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_areapreference2',  array('options' => $areas, 'empty' => '--Preference 2--','class' => 'form-control pre_bootbox_custom','onchange' => 'filterPreferences(this.value,\'LeadLeadAreapreference1\',\'LeadLeadAreapreference3\')')); ?>
                                                            </div>
                                                        </div>
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php 
																	
																	echo $this->data['AreaPreference3']['area_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_areapreference3',  array('options' => $areas, 'empty' => '--Preference 3--','class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadLeadAreapreference1\',\'LeadLeadAreapreference2\')')); ?>
                                                            </div>
                                                        </div>
                                                        	</div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Builder</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
      														<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Builder']['builder_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('builder_id1',  array( 'options' => $builders, 'empty' => '--Preference 1--', 'onchange' => 'filterPreferences(this.value,\'LeadBuilderId2\',\'LeadBuilderId3\')')); ?>
                                                            </div>
                                                        </div>
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Builder2']['builder_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('builder_id2',  array('options' => $builders, 'empty' => '--Preference 2--','class' => 'form-control pre_bootbox_custom','onchange' => 'filterPreferences(this.value,\'LeadBuilderId1\',\'LeadBuilderId3\')')); ?>
                                                            </div>
                                                        </div>
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php 
																	echo $this->data['Builder3']['builder_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('builder_id3',  array('options' => $builders, 'empty' => '--Preference 3--','class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadBuilderId1\',\'LeadBuilderId2\')')); ?>
                                                            </div>
                                                        </div>
                                                       	 	</div>
                                                        </div>	
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Project</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        	<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php 
																	echo $this->data['Project']['project_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('proj_id1',  array('options'=>$projects,'empty' => '--Preference 1--','onchange' => 'filterPreferences(this.value,\'LeadProjId2\',\'LeadProjId3\')')); ?>
                                                            </div>
                                                        </div>
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php 
																	
																	echo $this->data['Project2']['project_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('proj_id2',  array('options'=>$projects,'empty' => '--Preference 2--','class' => 'form-control pre_bootbox_custom','onchange' => 'filterPreferences(this.value,\'LeadProjId1\',\'LeadProjId3\')')); ?>
                                                            </div>
                                                        </div>
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php 
																	echo $this->data['Project3']['project_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('proj_id3',  array('options'=>$projects,'empty' => '--Preference 3--','class' => 'form-control pre_bootbox_custom','onchange' => 'filterPreferences(this.value,\'LeadProjId1\',\'LeadProjId2\')')); ?>
                                                            </div>
                                                        </div>
                                                        	</div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Unit</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        	<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Unit']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('lead_unit_id_1',  array('options' => $unit, 'empty' => '--Preference 1--','onchange' => 'filterPreferences(this.value,\'LeadLeadUnitId2\',\'LeadLeadUnitId3\')')); ?>
                                                            </div>
                                                        </div>
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['Unit2']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_unit_id_2',  array('options' => $unit, 'empty' => '--Preference 2--','class' => 'form-control pre_bootbox_custom','onchange' => 'filterPreferences(this.value,\'LeadLeadUnitId1\',\'LeadLeadUnitId3\')')); ?>
                                                            </div>
                                                        </div>
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php 
																	echo $this->data['Unit3']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_unit_id_3',  array('options' => $unit, 'empty' => '--Preference 3--','class' => 'form-control pre_bootbox_custom','onchange' => 'filterPreferences(this.value,\'LeadLeadUnitId1\',\'LeadLeadUnitId2\')')); ?>
                                                            </div>
                                                        </div>
                                                        	</div>
                                                        </div>
                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                               		 <div class="form-group">
                                                        <label>Project Type</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10">
                                                        	<div class="form-group">
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php 
																	echo $this->data['ProjectType']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_unit_id_1',  array('options' => $unit, 'empty' => '--Preference 1--','onchange' => 'filterPreferences(this.value,\'LeadLeadUnitId2\',\'LeadLeadUnitId3\')')); ?>
                                                            </div>
                                                        </div>
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['ProjectType2']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_unit_id_2',  array('options' => $unit, 'empty' => '--Preference 2--','class' => 'form-control pre_bootbox_custom', 'onchange' => 'filterPreferences(this.value,\'LeadLeadUnitId1\',\'LeadLeadUnitId3\')')); ?>
                                                            </div>
                                                        </div>
                                                        		<div class="col-sm-4 col-xs-12 editable">
                                                            <p class="form-control-static"><?php
																	echo $this->data['ProjectType3']['value'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('lead_unit_id_3',  array('options' => $unit, 'empty' => '--Preference 3--','class' => 'form-control pre_bootbox_custom','onchange' => 'filterPreferences(this.value,\'LeadLeadUnitId1\',\'LeadLeadUnitId2\')'));
							    ?> 
                                                            </div>
                                                        </div>
                                                        	</div>
                                                        </div>
                                                    </div>
                                                                </div>															</div>
														</div>
													</div>
													<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title fpt">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseTwo">
																	Lead Remarks
																</a>
															</h4>
														</div>
														<div id="acc1_collapseTwo" class="panel-collapse collapse">
															<div class="form-group">
                                                       
                                                        <div class="col-sm-12 editable">
                                                        	
                                                            <div class="form-control-static">
                                                            <div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php echo count($this->data['Remark'])?></span> Remark Details</h4></div><table class="table">
				
					<tr>
						<th data-toggle="true" width="6%">Remark Id</th>
						<th data-hide="phone" width="10%">Associated Event Id</th>
						<th data-hide="phone" width="13%">Remark Date</th>
						<th data-hide="phone" width="10%">Remark By</th>
						<th data-hide="phone" width="50%">The Remark</th>
							
						
					</tr>
						 <?php
						
					 if(count($this->data['Remark'])){
					 foreach($this->data['Remark'] as $remark ){?>
						<tr style="background-color:#FFF;">
						<td class="borderRightNone" align="left"><b><?php echo $remark['id'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $remark['activity_id'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo date("d/m/Y h:i A", strtotime($remark['remarks_date']));?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $created_by[$remark['remarks_by']];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $remark['remarks'];?></b></td>
						
						</tr>
					<?php }
					}
					 ?>
				</table></div>
                                                            <div class="hidden_control">
                                                               <div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php  echo count($this->data['Remark']);?></span> Remark Details</h4>
                                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i>
                                                                <?php
                                                                 echo $this->Html->link('Add Remark', '/remarks/add/'.$this->data['Lead']['id'],array('class' => 'open-popup-link add-btn'));?>
                                                                
                                                                </span>
                                                            </div><table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="40">
				<thead>
					<tr>
						<th data-toggle="true">Remark Id1</th>
						<th data-hide="phone">Associated Event Id</th>
						<th data-hide="phone">Remark Date</th>
						<th data-hide="phone">Remark By</th>
						<th data-hide="all">The Remark</th>
							
						
					</tr>
                    </thead>
                    <tbody>
						 <?php
						
					 if(count($this->data['Remark'])){
					 foreach($this->data['Remark'] as $remark ){?>
						<tr>
						<td><?php echo $remark['id'];?></td>
						<td><?php echo $remark['activity_id'];?></td>
						<td><?php echo date("d/m/Y h:i A", strtotime($remark['remarks_date']));?></td>
						<td><?php echo $created_by[$remark['remarks_by']];?></td>
						<td><?php echo $remark['remarks'];?></td>
						
						</tr>
					<?php }
					}
					 ?>
                     </tbody>
				</table>
                                                           
                												
                                                                       
                                                                 
                                                            </div>
                                                        </div>
                                                    </div>
													</div>
													
												</div>
                                                	<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title fpt">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseThree">
																	Lead Events
																</a>
															</h4>
														</div>
														<div id="acc1_collapseThree" class="panel-collapse collapse">
															<div class="form-group">
                                                       
                                                        <div class="col-sm-12 editable">
                                                            <div class="form-control-static">
                                                            <div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php echo count($this->data['Activity'])?></span> Event Details</h4></div>
                                                            <table class="table">
		
					 <tr class="table-header">
						<th>Event Id</td>
						<th>Event Type</th>
						<th>Event Created Date</th>
						<th>Event Created By</th>
						<th>Event Date</th>
						<th>Event Attended By</th>	
						<th>The Event</th>
						
					 </tr>
					 <?php
					// pr($this->data);
					 if(count($this->data['Activity'])){
					 foreach($this->data['Activity'] as $activity ){?>
						<tr>
						<td class="borderRightNone"><b><?php echo $activity['id'];?></b></td>
						<td class="borderRightNone"><b><?php echo $activity['activity_type'];?></b></td>
						<td class="borderRightNone"><b><?php echo date("d/m/Y", strtotime($activity['activity_date']));?></b></td>
						<td class="borderRightNone"><b><?php echo $this->data['User']['fname'].' '.$this->data['User']['lname'];?></b></td>
						<td class="borderRightNone"><b><?php echo date("d/m/Y", strtotime($activity['created']));?></b></td>
						<td class="borderRightNone"><b><?php echo $activity['activity_by'];?></b></td>
						<td class="borderRightNone"><b><?php echo $activity['activity'];?></b></td>
						
						</tr>
					<?php }
					}
					 ?>
					
				</table></div>
                                                            <div class="hidden_control">
                                                               <div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php echo count($this->data['Activity'])?></span> Event Details</h4>
                                                                <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i>
                                                                <?php 
																		 echo $this->Html->link('Add Event', '/activities/add/'.$this->data['Lead']['id'], array('class' => 'open-popup-link add-btn'));
                                                                       
                                                                        
                                                                        ?>
                                                                
                                                                </span>
                                                            </div><table class="table">
		
					 <tr class="table-header">
						<th>Event Id</th>
						<th>Event Type</th>
						<th>Event Created Date</th>
						<th>Event Created By</th>
						<th>Event Date</th>
						<th>Event Attended By</th>	
						<th>The Event</th>
                        <th>Action</th>
						
					 </tr>
					 <?php
					// pr($this->data);
					 if(count($this->data['Activity'])){
					 foreach($this->data['Activity'] as $activity ){?>
						<tr style="background-color:#FFF;">
						<td class="borderRightNone" align="left"><b><?php echo $activity['id'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $activity['activity_type'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo date("d/m/Y", strtotime($activity['activity_date']));?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $this->data['User']['fname'].' '.$this->data['User']['lname'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo date("d/m/Y", strtotime($activity['created']));?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $activity['activity_by'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $activity['activity'];?></b></td>
						<td>
							<?php echo $this->Html->link('<span class="icon-pencil"></span>', '/activities/edit/' . $activity['id'],array('class' => 'act-ico open-popup-link add-btn','escape' => false)) ?>
						</td>
						</tr>
					<?php }
					}
					 ?>
					
				</table>
                                                           
                												
                                                                        
                                                                 
                                                            </div>
                                                        </div>
                                                    </div>
													</div>
													
												</div>
                                                	<div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title fpt">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseFour">
																	Lead Action History
																</a>
															</h4>
														</div>
														<div id="acc1_collapseFour" class="panel-collapse collapse">
															<div class="form-group">
                                                       
                                                        <div class="col-sm-12 editable">
                                                            <div class="form-control-static"><div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php echo count($this->data['Action'])?></span> Action Details</h4>
                                                                </div><table class="table">
					<!--<tr>
                                                <td colspan="9" align="left"><span style="font-size: 14px; color: #6b3800; font-weight:bold;">Action Details | <?php echo $this->data['Lead']['lead_fname'].' '.$this->data['Lead']['lead_lname'];?></span></td>
                                        </tr>-->
					 <tr class="table-header">
						<th class="borderRightNone" align="left">Action Id</th>
						<th align="left">Action Parent Id</th>
						<th align="left">Action Level</th>
						<th align="left">Action Type</th>
						<th align="left">Action Status</th>
						<th align="left">Action Date</th>
						<th align="left">Action Source</th>
						<th align="left">Action By</th>
						<th align="left">The Action</th>	
						
					 </tr>
					 <?php
					// pr($created_by);
					 if(count($this->data['Action'])){
					 foreach($this->data['Action'] as $actions ){?>
					<tr style="background-color:#FFF;">
						
						<td class="borderRightNone" align="left"><b><?php echo $actions['id'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $actions['parent_action_item_id'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $action_level[$actions['action_item_level_id']];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $action_type[$actions['type_id']];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $action_status[$actions['action_item_status']];?></b></td>	
						<td class="borderRightNone" align="left"><b><?php echo date("d/m/Y", strtotime($actions['created']));?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $source[$actions['action_item_source']];?></b></td>	
						<td class="borderRightNone" align="left"><b><?php echo $created_by[$actions['created_by']];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $actions['description'];?></b></td>
						
					</tr>
					<?php }
					}
					 ?>
					
				</table></div>
                                                            <div class="hidden_control">
                                                               <div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php echo count($this->data['Action'])?></span> Action Details</h4>
                                                                </div><table class="table">
					<!--<tr>
                                                <td colspan="9" align="left"><span style="font-size: 14px; color: #6b3800; font-weight:bold;">Action Details | <?php echo $this->data['Lead']['lead_fname'].' '.$this->data['Lead']['lead_lname'];?></span></td>
                                        </tr>-->
					 <tr class="table-header">
						<th class="borderRightNone" align="left">Action Id</th>
						<th align="left">Action Parent Id</th>
						<th align="left">Action Level</th>
						<th align="left">Action Type</th>
						<th align="left">Action Status</th>
						<th align="left">Action Date</th>
						<th align="left">Action Source</th>
						<th align="left">Action By</th>
						<th align="left">The Action</th>	
						
					 </tr>
					 <?php
					// pr($created_by);
					 if(count($this->data['Action'])){
					 foreach($this->data['Action'] as $actions ){?>
					<tr style="background-color:#FFF;">
						
						<td class="borderRightNone" align="left"><b><?php echo $actions['id'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $actions['parent_action_item_id'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $action_level[$actions['action_item_level_id']];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $action_type[$actions['type_id']];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $action_status[$actions['action_item_status']];?></b></td>	
						<td class="borderRightNone" align="left"><b><?php echo date("d/m/Y", strtotime($actions['created']));?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $source[$actions['action_item_source']];?></b></td>	
						<td class="borderRightNone" align="left"><b><?php echo $created_by[$actions['created_by']];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $actions['description'];?></b></td>
						
					</tr>
					<?php }
					}
					 ?>
					
				</table>
                                                           
                												
                                                                 
                                                            </div>
                                                        </div>
                                                    </div>
													</div>
                                                    		
													
												</div>
                                                <div class="panel panel-default">
														<div class="panel-heading">
															<h4 class="panel-title fpt">
																<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseFive">
																	Lead Management
																</a>
															</h4>
														</div>
														<div id="acc1_collapseFive" class="panel-collapse collapse">
															<div class="form-group">
                                                       
                                                        <div class="col-sm-12 editable">
                                                            <div class="form-control-static"><div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"> Action Details | <?php echo $this->data['Lead']['lead_fname'].' '.$this->data['Lead']['lead_lname'];?></h4>
                                                                </div><table class="table">
					<!--<tr>
                                                <td colspan="9" align="left"><span style="font-size: 14px; color: #6b3800; font-weight:bold;">Action Details | <?php echo $this->data['Lead']['lead_fname'].' '.$this->data['Lead']['lead_lname'];?></span></td>
                                        </tr>-->
					 <tr class="table-header">
						<th class="borderRightNone" align="left">Associate</th>
						<th align="left">Channel</th>
						<th align="left">Primary Manager</th>
						<th align="left">Secondary Manager</th>
						
					 </tr>
					 <?php
					// pr($this->data);
					?>
					<tr style="background-color:#FFF;">
						
						<td class="borderRightNone" align="left"><b><?php echo $this->data['Associate']['fname'].' '.$this->data['Associate']['mname'].' '.$this->data['Associate']['lname'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $this->data['Channel']['channel_name'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $this->data['PrimaryManage']['fname'].' '.$this->data['PrimaryManage']['lname'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $this->data['SecondaryManage']['fname'].' '.$this->data['SecondaryManage']['lname'];?></b></td>
						
						
					</tr>
				      </table></div>
                                                            <div class="hidden_control">
                                                               <div class="table-heading disimp">
                                                            	<h4 class="table-heading-title"><span class="badge badge-circle badge-success"> 18</span> Action Details | <?php echo $this->data['Lead']['lead_fname'].' '.$this->data['Lead']['lead_lname'];?></h4>
                                                                </div><table class="table">
					<!--<tr>
                                                <td colspan="9" align="left"><span style="font-size: 14px; color: #6b3800; font-weight:bold;">Action Details | <?php echo $this->data['Lead']['lead_fname'].' '.$this->data['Lead']['lead_lname'];?></span></td>
                                        </tr>-->
					 <tr class="table-header">
						<th class="borderRightNone" align="left">Associate</th>
						<th align="left">Channel</th>
						<th align="left">Primary Manager</th>
						<th align="left">Secondary Manager</th>
						
					 </tr>
					 <?php
					// pr($this->data);
					?>
					<tr style="background-color:#FFF;">
						
						<td class="borderRightNone" align="left"><b><?php echo $this->data['Associate']['fname'].' '.$this->data['Associate']['mname'].' '.$this->data['Associate']['lname'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $this->data['Channel']['channel_name'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $this->data['PrimaryManage']['fname'].' '.$this->data['PrimaryManage']['lname'];?></b></td>
						<td class="borderRightNone" align="left"><b><?php echo $this->data['SecondaryManage']['fname'].' '.$this->data['SecondaryManage']['lname'];?></b></td>
						
						
					</tr>
				      </table>
                                                           
                												
                                                                 
                                                            </div>
                                                        </div>
                                                    </div>
													</div>
                                                    		
													
												</div>
											</div>
											
										</div>
									</div>
								
							
						
                                                    
                                                    
                                                    <div class="form_submit clearfix" style="display:none">
                                                    <div class="row">
                                                <div class="col-sm-1">
                                                    <?php 
                                                    echo $this->Form->submit('Update', array('class' => 'btn btn-success sticky_success'));
                                                    
                                                    ?>
                                                </div>
                                                <div class="col-sm-1">
                                                    <?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important'));?>
                                                </div>
                                                
                                                
                                            </div>
                                                        
                                                    </div>
                                                   
                                            
                                         <?php echo $this->Form->end(); ?>
                                    </div>
                                </div>
                            </div>
						</div>
                        </div>

