<?php 
$this->Html->addCrumb('Add City','javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('City', array('method' => 'post',
										'id' => 'parsley_reg',
										'novalidate' => true,
										'inputDefaults' => array(
																	'label' => false,
																	'div' => false,
																	'class' => 'form-control',
																),
															
						));
					
	
						
						?>
                            <div class="col-sm-12" id="mycl-det">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Add Information</h4>
                                    </div>
                                    <div class="panel-body">
                                        <fieldset>
                                            <legend><span>Add City</span></legend>
                                        </fieldset>
                                        <div class="row">
                                        	<div class="col-sm-12">
                                            	<div class="col-sm-6">
                                                <div class="form-group">
													<label for="reg_input_name" class="req">Status</label>
                                                    <span class="colon">:</span>
													<div class="col-sm-10">
													<?php
														 echo $this->Form->input('city_status',   array('options' => array('1' =>'Active','2' =>'Inactive'),'empty'=>'--Select--','data-required' => 'true'));
														
															?></div>
												</div>
                                            	
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                            </div>
                                            	<div class="col-sm-6">
                                                <div class="form-group">
													<label for="reg_input_name" class="req">City Name</label>
                                                    <span class="colon">:</span>
													<div class="col-sm-10">
													<?php
														 echo $this->Form->input('city_name',array('data-required' => 'true'));
														
															?></div>
												</div>
                                                <div class="form-group">
													<label for="reg_select_name">City Description</label>
                                                    <span class="colon">:</span>
													<div class="col-sm-10">
													<?php
														echo $this->Form->input('city_description',array('type' => 'textarea'));
														
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
