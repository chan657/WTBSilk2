<?php
$this->Html->addCrumb('View / Edit Group', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>
<?php
echo $this->Form->create('GroupsUser', array('method' => 'post','id' => 'parsley_reg','novalidate' => true, 'class' => 'form-horizontal user_form',
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
    array('controller' => 'users', 'action' => 'group_edit')
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
                <legend><span>View / Edit Group</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">    
                        <div class="form-group">
                            <label class="req">Group Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['GroupsUser']['name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('name', array('tabindex' => '1','data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-6">    
                        <div class="form-group">
                            <label class="req">Industry</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['Industry']['value']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('industry', array('options' => $industries, 'empty' => '--Select--', 'data-required' => 'true', 'tabindex' => '2')); ?>
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


