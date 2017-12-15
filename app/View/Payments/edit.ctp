<?php $this->Html->addCrumb('View / Edit City','javascript:void(0);', array('class' => 'breadcrumblast'));
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
                                                <legend><span>View / Edit City</span></legend>
                                            </fieldset>
                                        <div class="row">
                                            <div class="col-sm-12">
                                            <?php
                echo $this->Form->create('City', array('method' => 'post','class' => 'form-horizontal user_form','id' => 'parsley_reg','novalidate' => true,
                                                        'inputDefaults' => array(
                                                                        'label' => false,
                                                                        'div' => false,
                                                                        'class' => 'form-control',
                                                                    )
                            ));
						 echo $this->Form->input('id', array('type' => 'hidden'));
            
            
            ?>
                                                 <div class="col-sm-6"> 
                                                 <div class="form-group">
                                                        <label for="reg_input_name" class="req">Status</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php if($this->data['City']['city_status'] == '1') echo 'Active'; else echo 'Inactive';?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('city_status',   array('options' => array('1' =>'Active','2' =>'Inactive'),'empty'=>'--Select--','data-required' => 'true')); ?>
                                                            </div>
                                                        </div>
                                                    </div>   
                                                    
                                               
                                                    
                                                    
                                                    
                                                    
                                                  
                                                   </div>  
                                                    <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="reg_input_name" class="req">City Name</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['City']['city_name'];?></p>
                                                            <div class="hidden_control">
                                                                <?php echo $this->Form->input('city_name',array('data-required' => 'true')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Group Name</label>
                                                        <span class="colon">:</span>
                                                        <div class="col-sm-10 editable">
                                                            <p class="form-control-static"><?php echo $this->data['City']['city_description'];?></p>
                                                            <div class="hidden_control">
                                                                <?php  echo $this->Form->input('city_description',array('type' => 'textarea')); ?>
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


