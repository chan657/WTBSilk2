<?php
$this->Html->addCrumb('Add Channel', 'javascript:void(0);', array('class' => 'breadcrumblast'));

echo $this->Form->create('Channel', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
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
                <legend><span>Add Channel</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Channel Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('channel_name', array('data-required' => 'true', 'tabindex' => '1'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Channel City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_id', array('options' => $cities, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '3'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Channel Head</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('channel_head', array('options' => $user, 'empty' => '--Select--', 'tabindex' => '5'));
                                ?></div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name">Channel Capacity P/D</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('channel_leadcapacityperday',array('tabindex' => '2'));
                                ?></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Channel Role</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('channel_role', array('options' => $channelroles,'data-required' => 'true', 'empty' => '--Select--', 'tabindex' => '4'));
                                ?></div>
                        </div>
                      


                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Channel Description</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable txtbox">
                                <?php
                                echo $this->Form->input('channel_description', array('type' => 'textarea', 'tabindex' => '7'));
                                ?></div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-sm-1">
                    <?php
                    echo $this->Form->submit('Add', array('class' => 'btn btn-success sticky_success'));
                    ?>
                </div>
                <div class="col-sm-1">
                    <?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important')); ?>
                </div>


            </div>
        </div>
    </div>
</div>
<?php echo $this->Form->end(); ?>   
