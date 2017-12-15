<?php
$this->Html->addCrumb('Re-try Province', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('Province', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));

echo $this->Form->hidden('country_name');
echo $this->Form->hidden('continent_name');
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Re-try Operation</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Re-try Province</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                       <div class="form-group">
                            <label for="reg_input_name" class="req">Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('name', array('readonly' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--' , 'disabled' => 'true'));
                                ?></div>
                        </div> 
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'disabled' => 'true'));
                                ?></div>
                        </div>
                       <div class="form-group">
                            <label for="reg_input_name">Top Province</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('top_province', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'),'empty' => '--Select--', 'disabled' => 'true'));
                                ?></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('description', array('type' => 'textarea','style' => 'width:122%;height:100px','readonly' => true));
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
<?php 
echo $this->Form->end(); 
?>  

 

