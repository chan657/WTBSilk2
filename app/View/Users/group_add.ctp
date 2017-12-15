<?php
$this->Html->addCrumb('Add Group', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('GroupsUser', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
    array('controller' => 'users', 'action' => 'group_add')
));
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Group</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Group Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('name',array('tabindex' => '1','data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Channel Field Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('channel_field',array('tabindex' => '3','data-required' => 'true'));
                                ?>
                            </div><span class="example_txt">eg. phone_channel_id</span>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="req">Industry</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('industry', array('options' => $industries, 'empty' => '--Select--','data-required' => 'true', 'tabindex' => '2'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Role Field Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('role_field',array('tabindex' => '4','data-required' => 'true'));
                                ?>
                            </div><span class="example_txt">eg. phone_role_id</span>
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
