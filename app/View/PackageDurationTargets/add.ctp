<?php
$this->Html->addCrumb('Add Package Duration Target', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('PackageDurationTarget', array('method' => 'post',
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
                <legend><span>Add Package Duration Target</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">MinimumNights</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('MinimumNights', array('data-required' => 'true','type' => 'text'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">PackageSchedule</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PackageSchedule');
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name">PackageDurationTargetCode</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('PackageDurationTargetCode', array('type' => 'text'));
                                ?></div>
                        </div>
                       




                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">MaximumNights</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('MaximumNights', array('data-required' => 'true','type' => 'text'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">PackageDurationTarget</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('PackageDurationTarget', array('type' => 'text'));
                                ?></div>
                        </div> 
                        



                    </div>
                    <div style="clear: both;"></div>


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
