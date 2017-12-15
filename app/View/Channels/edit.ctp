<?php
$this->Html->addCrumb('View / Edit Channel', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($this->data);
?>
<?php
echo $this->Form->create('Channel', array('method' => 'post', 'class' => 'form-horizontal user_form', 'id' => 'parsley_reg', 'novalidate' => true,
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
            <div class="user_actions pull-right">
                <a href="#" class="edit_form" data-toggle="tooltip" data-placement="top" title="Edit"><span class="icon-edit"></span></a> <a href="#" class="view_form" data-toggle="tooltip" data-placement="top" title="View" style="display: none;"><span class="glyphicon glyphicon-eye-open"></span></a>

            </div>
        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View / Edit Channel</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">

                    <div class="col-sm-6">    
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Channel Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['Channel']['channel_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('channel_name', array('data-required' => 'true', 'tabindex' => '1')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Channel City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['City']['city_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('city_id', array('options' => $cities, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '3')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Channel Head</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['User']['fname'] . ' ' . $this->data['User']['mname'] . ' ' . $this->data['User']['lname']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('channel_head', array('options' => $user, 'empty' => '--Select--', 'tabindex' => '5')); ?>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Channel Capacity P/D</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['Channel']['channel_leadcapacityperday']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('channel_leadcapacityperday',array('tabindex' => '2')); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="req">Channel Role</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['LookupValueChannelRole']['name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('channel_role', array('options' => $channelroles,'data-required' => 'true', 'empty' => '--Select--', 'tabindex' => '4')); ?>
                                </div>
                            </div>
                        </div>
                         <!--
                        <div class="form-group">
                            <label>Channel Description</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['Industry']['value']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('channel_industry', array('options' => $industries, 'empty' => '--Select--','data-required' => 'true', 'tabindex' => '6')); ?>
                                </div>
                            </div>
                        </div>-->
                        
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Channel Description</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable txtbox">
                                <p class="form-control-static"><?php echo $this->data['Channel']['channel_description']; ?></p>
                                <div class="hidden_control">
                                <?php
                                echo $this->Form->input('channel_description', array('type' => 'textarea', 'tabindex' => '7'));
                                ?>
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

