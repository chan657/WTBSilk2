<?php
$this->Html->addCrumb('Add Structure', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DigStructure', array( 'method' => 'post',
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
                <legend><span>Add Structure</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Structure Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('structure_name', array('data-required' => 'true', 'tabindex' => '1'));
                                ?></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="reg_input_name">Level 1</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('structure_level_1',array('options' => $DigLevels,'empty' => '--Select--', 'tabindex' => '3'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Level 3</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('structure_level_3',array('options' => $DigLevels,'empty' => '--Select--', 'tabindex' => '5'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Level 5</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('structure_level_5',array('options' => $DigLevels,'empty' => '--Select--', 'tabindex' => '7'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Level 7</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('structure_level_7',array('options' => $DigLevels,'empty' => '--Select--', 'tabindex' => '9'));
                                ?></div>
                        </div>
                        
                      
                         <div class="form-group slt-sm">
                            <label for="reg_input_name">Review Duration</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('structure_review_duration', array('class' => 'form-control sm rgt', 'tabindex' => '11', 'style' => 'float:left;'));
                        echo $this->Form->input('structure_review_duration_unit', array('options' => $DigMediaLookupDurationUnits, 'empty' => '--Select--', 'tabindex' => '12', 'style' => 'float:left;margin-left:4px'));
                        ?></div>
                        </div>
                         <div class="form-group">
                            <label for="reg_input_name">Active?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('structure_active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--', 'tabindex' => '15'));
                                ?></div>
                        </div>
                     
                        
                        
                        </div>
                       
                       
                       

                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name">No. Of Levels</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('structure_no_of_levels',array('tabindex' => '2'));
                                ?></div>
                        </div>
                       
                        <div class="form-group">
                            <label for="reg_input_name">Level 2</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('structure_level_2',array('options' => $DigLevels,'empty' => '--Select--', 'tabindex' => '4'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Level 4</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('structure_level_4',array('options' => $DigLevels,'empty' => '--Select--', 'tabindex' => '6'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Level 6</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('structure_level_6',array('options' => $DigLevels,'empty' => '--Select--', 'tabindex' => '8'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Level 8</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('structure_level_8',array('options' => $DigLevels,'empty' => '--Select--', 'tabindex' => '10'));
                                ?></div>
                        </div>
                         <div class="form-group slt-sm">
                            <label for="reg_input_name">Duration Unit</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                        <?php
                        echo $this->Form->input('structure_duration', array('class' => 'form-control sm rgt', 'tabindex' => '13', 'style' => 'float:left;'));
                        echo $this->Form->input('structure_duration_unit', array('options' => $DigMediaLookupDurationUnits, 'empty' => '--Select--', 'tabindex' => '14', 'style' => 'float:left;margin-left:4px'));
                        ?></div>
                        </div>
                        
                       
                      
                       
                        </div>
                    <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Description</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('structure_description', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '16'));
                                                ?></div>
                                        </div>
                    <div class="form-group">
                                            <label for="reg_input_name" style="margin-left: 14px">Special Instruction</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('structure_special_instruction', array('type' => 'textarea', 'style' => 'width:122%;height:100px', 'tabindex' => '17'));
                                                ?></div>
                                        </div>
                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Submit', array('name' => 'add','class' => 'btn btn-success sticky_success','value' =>'add'));
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





