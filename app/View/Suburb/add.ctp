<?php 
$this->Html->addCrumb('Add Suburb','javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('Suburb', array('method' => 'post',
										'id' => 'parsley_reg',
										'novalidate' => true,
										'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																)
						));
	
						
						?>
                            <div class="col-sm-12" id="mycl-det">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Add Information</h4>
                                    </div>
                                    <div class="panel-body">
                                        <fieldset>
                                            <legend><span>Add Suburb</span></legend>
                                        </fieldset>
                                        <div class="row">
                                        	<div class="col-sm-12">
                                            	<div class="col-sm-6">
                                            	<div class="form-group">
													<label for="reg_input_name" class="req">Suburb Name</label>
                                                    <span class="colon">:</span>
													<div class="col-sm-10">
													<?php
														 echo $this->Form->input('suburb_name');
														
															?></div>
												</div>
                                                <div class="form-group">
													<label for="reg_input_name">Suburb City</label>
                                                    <span class="colon">:</span>
													<div class="col-sm-10">
													<?php
														echo $this->Form->input('city_id',   array('options' => $cities,'empty'=>'Select'));
														
															?></div>
												</div>
                                                <div class="form-group">
													<label for="reg_input_name">Suburb Rating</label>
                                                    <span class="colon">:</span>
													<div class="col-sm-10">
													<?php
														echo $this->Form->input('suburb_rating',   array('options' => $cities,'empty'=>'Select'));
														
															?></div>
												</div>
                                                <div class="form-group">
													<label for="reg_input_name">Suburb Status</label>
                                                    <span class="colon">:</span>
													<div class="col-sm-10">
													<?php
														echo $this->Form->input('suburb_status',  array('options' => $status,'empty' => '--Select--'));
														
															?></div>
												</div>
                                                <div class="form-group">
													<label for="reg_input_name">Suburb Description</label>
                                                    <span class="colon">:</span>
													<div class="col-sm-10">
													<?php
														echo $this->Form->input('suburb_description',  array('type' =>'textarea'));
														
															?></div>
												</div>
                                                
                                                
                                                
                                            </div>
                                            	<div class="col-sm-6">
												<div class="form-group">
													<label for="reg_input_name">Suburb Economic Parameters</label>
													<span class="colon">:</span>
													<div class="col-sm-10"><?php
														echo $this->Form->input('suburb_economicparameters');
														
															?></div>
												</div>
                                                <div class="form-group">
													<label for="reg_input_name">Suburb Political Parameters</label>
													<span class="colon">:</span>
													<div class="col-sm-10"><?php
														 echo $this->Form->input('suburb_politicalparameters');
														
															?></div>
												</div>
                                                <div class="form-group">
													<label for="reg_input_name">Suburb Population Parameter</label>
													<span class="colon">:</span>
													<div class="col-sm-10"><?php
														  echo $this->Form->input('suburb_populationparameter');
														
															?></div>
												</div>
                                                
                                                <div class="form-group slt-sm">
													<label for="reg_input_name">Suburb Investment Environment</label>
													<span class="colon">:</span>
													<div class="col-sm-10"><?php
														 echo $this->Form->input('suburb_investmentenvironment');
														
															?></div>
												</div>
                                                <div class="form-group">
													<label for="reg_input_name">Suburb Infrastructure Growth Potential</label>
													<span class="colon">:</span>
													<div class="col-sm-10"><?php
														 echo $this->Form->input('suburb_infrastructuregrowthpotential');
														
															?></div>
												</div>
                                                
                                            </div>
                                            	
                                        		<div class="row">
											<div class="col-sm-1">
												<?php 
												echo $this->Form->submit('Add', array('class' => 'btn btn-success sticky_success'));
												
												?>
											</div>
											<div class="col-sm-1">
												<?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important'));?>
											</div>
											
											
										</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
 <?php echo $this->Form->end();?>   
