<?php
$this->Html->addCrumb('View / Edit Owner Company', 'javascript:void(0);', array('class' => 'breadcrumblast'));
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
                <legend><span>View / Edit Owner Company</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('TravelOwnerCompany', array('method' => 'post', 'id' => 'parsley_reg', 'class' => 'form-horizontal user_form', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
                    ?>
                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php
                    if ($this->data['TravelOwnerCompany']['owner_company_status'] == '1')
                        echo 'Active';
                    else
                        echo 'Inactive';
                    ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('owner_company_status', array('options' => array('1' => 'Active', '2' => 'Inactive'), 'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>   

                        
                        <div class="form-group">
                            <label for="reg_input_name">HQ</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelOwnerCompany']['owner_company_hq']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('owner_company_hq'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Presence</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelOwnerCompany']['owner_company_presence']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('owner_company_presence'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">VC1</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelOwnerCompany']['owner_company_vc1']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('owner_company_vc1'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">VC3</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelOwnerCompany']['owner_company_vc3']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('owner_company_vc3'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">VC5</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelOwnerCompany']['owner_company_vc5']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('owner_company_vc5'); ?>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelOwnerCompany']['owner_company_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('owner_company_name', array('data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Category</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelOwnerCompany']['owner_company_category']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('owner_company_category'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Top Company</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelOwnerCompany']['top_owner_company']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('top_owner_company', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">VC2</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelOwnerCompany']['owner_company_vc2']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('owner_company_vc2'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">VC4</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelOwnerCompany']['owner_company_vc4']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('owner_company_vc4'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name">Active</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelOwnerCompany']['owner_company_active']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('owner_company_active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--')); ?>
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
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>



