<?php
$this->Html->addCrumb('Add Owner Company', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('TravelOwnerCompany', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
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
                <legend><span>Add Owner Company</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('owner_company_status', array('options' => array('1' => 'Active', '2' => 'Inactive'), 'empty' => '--Select--', 'data-required' => 'true'));
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name">HQ</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('owner_company_hq');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Presence</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('owner_company_presence');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">VC1</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('owner_company_vc1');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">VC3</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('owner_company_vc3');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">VC5</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('owner_company_vc5');
                                ?></div>
                        </div>
                        

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('owner_company_name', array('data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Category</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('owner_company_category');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Top Company</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('top_owner_company', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'),'empty' => '--Select--'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">VC2</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('owner_company_vc2');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">VC4</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('owner_company_vc4');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Active</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('owner_company_active', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'),'empty' => '--Select--'));
                                ?></div>
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
    </div>
</div>
<?php 
echo $this->Form->end(); 

?>  

