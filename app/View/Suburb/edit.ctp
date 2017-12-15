<?php $this->Html->addCrumb('View / Edit Suburb','javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($this->data);
?>

							<div class="col-sm-12" id="mycl-det">
                                <div class="panel panel-default">
                                <div class="panel-heading">
                                        <h4 class="panel-title">View / Edit Information</h4>
                                        <div class="user_actions pull-right">
                                                        <a href="#" class="edit_form" data-toggle="tooltip" data-placement="top" title="Edit"><span class="icon-edit"></span></a> <a href="#" class="view_form" data-toggle="tooltip" data-placement="top" title="View" style="display: none;"><span class="glyphicon glyphicon-eye-open"></span></a>
                                                        
                                                    </div>
                                    </div>
                          
                                    <div class="panel-body">
                                            <fieldset>
                                                <legend><span>View / Edit Suburb</span></legend>
                                            </fieldset>
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <?php
                echo $this->Form->create('Suburb', array('method' => 'post','class' => 'form-horizontal user_form',
                                                        'inputDefaults' => array(
                                                                        'label' => false,
                                                                        'div' => false,
                                                                        'class' => 'form-control',
                                                                    )
                            ));
            
            
            ?>
                                                 <div class="col-sm-6">    
                                                    <div class="form-group">
                                                        <label>Suburb Name</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Suburb']['suburb_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('suburb_name'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Suburb City</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['City']['city_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php   echo $this->Form->input('city_id',   array('options' => $cities,'empty'=>'Select'));?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Suburb Rating</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Suburb']['suburb_rating'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('suburb_rating'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Suburb Status</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Suburb']['suburb_status'];?></p>
                                                            <div class="hidden_control">
                                                                <?php   echo $this->Form->input('suburb_status',  array('options' => $status,'empty' => '--Select--')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Suburb Description</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Suburb']['suburb_description'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('suburb_description', array('type'=>'textarea')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    
                                                    
                                                  
                                                   </div>  
                                                    <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Suburb Economic Parameters</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Suburb']['suburb_economicparameters'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('suburb_economicparameters'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Suburb Political Parameters</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Suburb']['suburb_politicalparameters'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('suburb_politicalparameters');	 ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Suburb Population Parameter</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Suburb']['suburb_populationparameter'];?></p>
                                                            <div class="hidden_control">
                                                                <?php   echo $this->Form->input('suburb_populationparameter'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Suburb Investment Environment</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Suburb']['suburb_investmentenvironment'];?></p>
                                                            <div class="hidden_control">
                                                                <?php   echo $this->Form->input('suburb_investmentenvironment'); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Suburb Infrastructure Growth Potential</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['Suburb']['suburb_infrastructuregrowthpotential'];?></p>
                                                            <div class="hidden_control">
                                                                <?php   echo $this->Form->input('suburb_infrastructuregrowthpotential'); ?>
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


