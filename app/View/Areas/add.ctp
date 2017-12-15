<?php
$this->Html->addCrumb('Add Area', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('Area', array('method' => 'post',
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
                <legend><span>Add Area</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('area_status', array('options' => array('1' => 'Active', '2' => 'Inactive'), 'empty' => '--Select--', 'data-required' => 'true'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('area_name', array('data-required' => 'true'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('city_id', array('options' => $cities, 'empty' => '--Select--', 'data-required' => 'true'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Suburb</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('suburb_id', array('options' => array(), 'empty' => '--Select--', 'data-required' => 'true'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Rating</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('area_rating', array('type' => 'text'));
                                ?></div>
                        </div>




                        <div class="form-group">
                            <label for="reg_input_name">Description</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
<?php
echo $this->Form->input('area_description', array('type' => 'textarea'));
?></div>
                        </div>



                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name">Economic Parameters</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
echo $this->Form->input('area_economicparameters', array('type' => 'text'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Political Parameters</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
echo $this->Form->input('area_politicalparameters', array('type' => 'text'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Population Parameter</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('area_populationparameter', array('type' => 'text'));
?></div>
                        </div>
                        <div class="form-group slt-sm">
                            <label for="reg_input_name">Investment Environment</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('area_investmentenvironment', array('type' => 'text'));
?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Infrastructure Growth Potential</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('area_infrastructuregrowthpotential', array('type' => 'text'));
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
                            <?php echo $this->Form->end(); ?>   
                            <?php
                            $this->Js->get('#AreaCityId')->event('change', $this->Js->request(array(
                                        'controller' => 'all_functions',
                                        'action' => 'get_suburb_by_city/Area/city_id'
                                            ), array(
                                        'update' => '#AreaSuburbId',
                                        'async' => true,
                                        'before' => 'loading("AreaSuburbId")',
                                        'complete' => 'loaded("AreaSuburbId")',
                                        'method' => 'post',
                                        'dataExpression' => true,
                                        'data' => $this->Js->serializeForm(array(
                                            'isForm' => true,
                                            'inline' => true
                                        ))
                                    ))
                            );
                            ?>
