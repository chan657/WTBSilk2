<?php
$this->Html->addCrumb('Add Person', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DigPerson', array('enctype' => 'multipart/form-data', 'method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));

echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Person</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    
                    <div class="col-sm-6">
                        

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Person Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                 echo $this->Form->input('person_name', array('data-required' => 'true', 'tabindex' => '1'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Location</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('person_location', array('options' => $codes, 'empty' => '--Select--','data-required' => 'true', 'tabindex' => '3'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Used By (Team)</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('person_used_by_team', array('options' => $DigPersonUsedByTeams, 'empty' => '--Select--','data-required' => 'true', 'tabindex' => '5'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Profile Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('person_profile_type', array('options' => $DigPersonProfileTypes, 'empty' => '--Select--', 'tabindex' => '7'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Active?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'), 'empty' => '--Select--', 'tabindex' => '9'));
                                ?></div>
                        </div>
                        <h4>Person Logistics</h4>
                        <div class="form-group">
                            <label for="reg_input_name">Email</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                 echo $this->Form->input('person_email',array( 'tabindex' => '10'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">User</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('person_user',array( 'tabindex' => '12'));
                                ?></div>
                        </div>
                        <h4>Person Profile Picture</h4>
                         <div class="form-group">
                                            <div class="col-sm-10 editable txtbox">
                                                <label>Profile</label>
                                                <span class="colon">:</span>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px; float: left;">
                                                        <?php
                                                       
                                                            $image1 = $this->webroot . "img/no_img_180.png";
                                                       
                                                        ?>
                                                        <img src="<?php echo $image1; ?>" height="200" width="170" />

                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px; float: left; "></div>
                                                    <div style="width:100%;">
                                                        <span class="btn btn-default btn-file" style="margin-left: 15px; "><span class="fileupload-new">Select</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[DigPerson][upload_picture]" />

                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"  style="margin-left: 15px;">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                    
   
                    </div>
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('person_type', array('options' => $DigPersonTypes, 'empty' => '--Select--','data-required' => 'true','tabindex' => '2'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Industry</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('person_industry', array('options' => $DigPersonIndustries, 'empty' => '--Select--','data-required' => 'true','tabindex' => '4'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Used By (Person)</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('person_used_by_person', array('options' => $DigPersonUsedByPersons, 'empty' => '--Select--','data-required' => 'true','tabindex' => '6'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Usage Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('person_usage_status', array('options' => $DigPersonUsages, 'empty' => '--Select--','tabindex' => '8'));
                                ?></div>
                        </div>
                        <h4>&nbsp;</h4>
                        <h4>&nbsp;</h4>
                        <div class="form-group">
                            <label for="reg_input_name">Email Credential</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('person_email_parm',array('tabindex' => '11'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">User Credential</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('person_user_parm',array('tabindex' => '13'));
                                ?></div>
                        </div>
                       
                       
                        
                    </div>
                              <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Instructions</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('person_instructions', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '14'));
                            ?></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Comment</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('person_comment', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '15'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('person_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px','tabindex' => '16'));
                            ?></div>
                    </div>
                    <div style ="clear:both"></div>
                                                                    
                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Submit', array('class' => 'btn btn-success sticky_success'));
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
</div>




