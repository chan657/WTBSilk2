<?php
$this->Html->addCrumb('View / Edit Account', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($this->data);
?>
<?php
echo $this->Form->create('DigAccount', array('method' => 'post', 'class' => 'form-horizontal user_form', 'id' => 'parsley_reg', 'novalidate' => true,
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
            <h4 class="panel-title">View / Edit Information</h4>
          
        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View / Edit Account</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">

                    <div class="col-sm-6">    
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Base Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigBase']['base_website_url']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('account_base_id', array('options' => $DigBases, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '1')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Public URL</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigAccount']['account_public_url']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('account_public_url', array('data-required' => 'true','tabindex' => '3')); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Example Profile URL</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigAccount']['account_ex_profile_url']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('account_ex_profile_url', array('data-required' => 'true','tabindex' => '5')); ?>
                                </div>
                            </div>
                        </div>
                        <h4>Account Statistics </h4>
                        <div class="form-group">
                            <label>Account PR</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigAccount']['account_profile_pr']; ?></p>
                                <div class="hidden_control">
                                    <?php  echo $this->Form->input('account_profile_pr',array('tabindex' => '6')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Account PA</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigAccount']['account_profile_pa']; ?></p>
                                <div class="hidden_control">
                                    <?php  echo $this->Form->input('account_profile_pa',array('tabindex' => '8')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Usage Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigAccountUsage']['value']; ?></p>
                                <div class="hidden_control">
                                    <?php  echo $this->Form->input('account_usage_status', array('options' => $DigAccountUsages, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '10')); ?>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Person Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigPerson']['person_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('account_person_id', array('options' => $DigPersons, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '2')); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="req">Profile URL</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigAccount']['account_profile_url']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('account_profile_url', array('data-required' => 'true','tabindex' => '4')); ?>
                                </div>
                            </div>
                        </div>
                         <h4>&nbsp;</h4>
                         <h4>&nbsp;</h4>
                        <div class="form-group">
                            <label class="req">Account DA</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigAccount']['account_profile_da']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('account_profile_da', array('data-required' => 'true','tabindex' => '7')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="req">Account DF</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigPersonDF']['value']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('account_profile_df', array('options' => $DigAccountDofollows, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '9')); ?>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="req">Active?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['DigAccount']['active']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--','tabindex' => '11')); ?>
                                </div>
                            </div>
                        </div>
                  
                        
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Account Description</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable txtbox">
                                <p class="form-control-static"><?php echo $this->data['DigAccount']['account_description']; ?></p>
                                <div class="hidden_control">
                                <?php
                                 echo $this->Form->input('account_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '12'));
                                ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Account Comment</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable txtbox">
                                <p class="form-control-static"><?php echo $this->data['DigAccount']['account_usage_comment']; ?></p>
                                <div class="hidden_control">
                                <?php
                                 echo $this->Form->input('account_usage_comment', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '13'));
                                ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Account Instructions</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable txtbox">
                                <p class="form-control-static"><?php echo $this->data['DigAccount']['account_instructions']; ?></p>
                                <div class="hidden_control">
                                <?php
                                 echo $this->Form->input('account_instructions', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '14'));
                                ?>
                                </div>
                            </div>
                        </div>
                        <h4>Person Profile Picture</h4>
     <div class="form-group">
         <label>Profile</label>
                                                <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px; float: left;">
<?php
$imagePath = $this->webroot . 'uploads/DigPersons';

if ($this->data['DigPerson']['upload_picture']) {    
    $logo_image2 = $imagePath . '/' . $this->data['DigPerson']['upload_picture'];
} else {
    $logo_image2 = $imagePath . '/noimage.png' ;
}

?>
                                                        <img src="<?php echo $logo_image2; ?>" height="200" width="170" />
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
                        <?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end(); ?>

