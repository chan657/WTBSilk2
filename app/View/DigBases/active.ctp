<?php
$this->Html->addCrumb('Active Base', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DigBase', array('enctype' => 'multipart/form-data', 'method' => 'post',
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
            <h4 class="panel-title">Active Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Active Base</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Website Url</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_website_url', array('readonly' => 'true'));
                                ?></div>
                        </div>
                      
                     
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Target Geography</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_target_geography', array('options' => $DigBaseTargetGeographies, 'empty' => '--Select--', 'disabled' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Base Why</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_why', array('options' => $DigBaseWhies,'empty' => '--Select--','disabled' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Base PR</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_pr', array('readonly' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Base DA</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_da', array('readonly' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Link1 Category</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_link1_category', array('options' =>$DigBaseLinkCategories, 'empty' => '--Select--','disabled' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Link2 Category</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                               echo $this->Form->input('base_link2_category', array('options' => $DigBaseLinkCategories, 'empty' => '--Select--','disabled' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Link3 Category</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_link3_category', array('options' => $DigBaseLinkCategories, 'empty' => '--Select--','disabled' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Base Usage</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_usage', array('options' => $DigBaseUsages,'empty' => '--Select--','disabled' => 'true'));
                                ?></div>
                        </div>




                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Base Type</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_type', array('options' => $DigBaseTypes, 'empty' => '--Select--','disabled' => 'true'));
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name">Base Dofollow</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('base_dofollow', array('options' => $DigBaseDofollows, 'empty' => '--Select--','disabled' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Base PA</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('base_pa',array('readonly' => 'true'));
                                ?></div>
                        </div>                                           
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Auto Approved</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_auto_approved',array('readonly' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Link Within Comment</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_link_within_comment',array('readonly' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Link1 Dofollow</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                               echo $this->Form->input('base_link1_dofollow',array('readonly' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Link2 Dofollow</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_link2_dofollow',array('readonly' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Link3 Dofollow</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('base_link3_dofollow',array('readonly' => 'true'));
                                ?></div>
                        </div>
                        
                    </div>
                   
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Usage Instructions</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('base_usage_instructions', array('type' => 'textarea', 'style' => 'width:122%;height:100px','readonly' => 'true'));
                            ?></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Base Comment</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('base_comment', array('type' => 'textarea', 'style' => 'width:122%;height:100px','readonly' => 'true'));
                            ?></div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Base Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('base_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px','readonly' => 'true'));
                            ?></div>
                    </div>
                                                
                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Action', array('class' => 'btn btn-success sticky_success'));
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




