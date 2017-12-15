<?php
$this->Html->addCrumb('Add Project', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Project</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('Project', array('method' => 'post', 'id' => 'wizard_a', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
                    ?>

                    <h4>Primary Information</h4>
                    <fieldset class="nopdng">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <h4>Project Basic Information</h4>

                                    <div class="form-group ">
                                        <label for="reg_input_name" class="req">City</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('city_id', array('options' => $city, 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input_name" class="req">Project Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('project_name', array('data-required' => 'true'));
                                            ?></div>
                                    </div>


                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Suburb</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('suburb_id', array('options' => $suburbs, 'empty' => '--Select--', 'data-required' => 'true')); ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label >Category</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('category_id', array('options' => $categories, 'empty' => '--Select--')); ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label>Type</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('type_id', array('options' => $types, 'empty' => '--Select--')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>No of Buildings</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('no_of_buildings'); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label >Expected Completion</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <div class="input-group date ebro_datepicker hidden_control" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
                                                <?php
                                                echo $this->Form->input('proj_completionyear', array('type' => 'text'));
                                                ?>
                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                            </div></div>
                                    </div>

                                    <div class="form-group">
                                        <label>Near Landmark</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('proj_nearlandmark'); ?></div>
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <h4>&nbsp;</h4>

                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Builder Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('builder_id', array('options' => array(), 'empty' => '--Select--', 'data-required' => 'true', 'class' => 'form-control', 'onchange' => 'filterPreferences(this.value,\'ProjectSecondaryBuilderId\',\'ProjectTertiaryBuilderId\')', 'tabindex' => '8')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Project Website</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('proj_website'); ?></div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="reg_input_name" class="req">Area</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('area_id', array('options' => $areas, 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label>Phase</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('phase_id', array('options' => $phase, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                    <div class="form-group ">
                                        <label>Quality</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('quality_id', array('options' => $qualities, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                    <div class="form-group ">
                                        <label>No of Stories</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('proj_storeys');
                                            ?></div>
                                    </div>
                                    <div class="form-group int-sm">
                                        <label>Area of Land</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">  <?php
                                            echo $this->Form->input('proj_areaofland', array('class' => 'form-control sm rgt', 'tabindex' => '19', 'type' => 'text'));
                                            echo $this->Form->input('proj_landoption', array('label' => false, 'options' => $area_units, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>

                                    <div class="form-group int-sm">
                                        <label>Landmark Distance</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">  
                                            <?php
                                            echo $this->Form->input('proj_distancefromcentrallandmark', array('class' => 'form-control sm rgt', 'tabindex' => '19', 'type' => 'text'));
                                            echo $this->Form->input('proj_distanceoption', array('label' => false, 'options' => $distance_units, 'empty' => '--Select--'));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <br class="spacer" />
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Project Description</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('proj_description', array('type' => 'textarea'));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <h4>Project Details</h4>
                    <fieldset class="nopdng">
                        <div class="row">
                            <div class="col-sm-12">

                                <h4>Project Information</h4>
                                <div class="form-group">
                                    <label>All Stakeholders</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10 editable txtbox">
                                        <div class="row" id="fr-select">
                                            <div class="col-sm-3">

                                                <?php echo $this->Form->input('primary_builder', array('options' => $builders, 'readonly' => 'readonly', 'id' => 'primary_builder', 'disabled' => 'disabled')); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php echo $this->Form->input('secondary_builder_id', array('options' => array(), 'empty' => '--Secondary Builder--', 'class' => 'form-control', 'onchange' => 'filterPreferences(this.value,\'ProjectBuilderId\',\'ProjectTertiaryBuilderId\')', 'tabindex' => '8')); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php echo $this->Form->input('tertiary_builder_id', array('options' => array(), 'empty' => '--Tertiary Builder--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'ProjectBuilderId\',\'ProjectSecondaryBuilderId\')', 'tabindex' => '8')); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php echo $this->Form->input('proj_marketing_partner', array('options' => $marketing_partners, 'empty' => '--Marketing Partner--')); ?>
                                            </div>
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <label>Current Status</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10 editable txtbox">
                                        <div class="row" id="fr-select">
                                            <div class="col-sm-3">

                                                <?php echo $this->Form->input('legal_approval_status', array('options' => $legal_approval, 'empty' => '--Legal Approval Status--')); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php echo $this->Form->input('proj_marketing_status', array('options' => $marketing_status, 'empty' => '--Marketing Status--')); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php echo $this->Form->input('construction_status', array('options' => $constructions, 'empty' => '--Construction Status--')); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php echo $this->Form->input('bank_finance_status', array('options' => $bank_finance, 'empty' => '--Bank Finance Status--')); ?>
                                            </div>
                                        </div></div>
                                </div>
                                <div class="form-group">
                                    <label>Project Type</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10 editable txtbox">
                                        <div class="row" id="fr-select">
                                            <div class="col-sm-3">

                                                <?php echo $this->Form->input('proj_residential', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Residential--')); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php echo $this->Form->input('proj_highendresidential', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--High End--')); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php echo $this->Form->input('proj_commercial', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Commercial--')); ?>
                                            </div>

                                        </div></div>
                                </div>
                                <h4>Main USP</h4>
                                <div class="form-group">
                                    <label>USP 1 </label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10 editable txtbox">
                                        <?php
                                        echo $this->Form->input('proj_usp1');
                                        ?></div>
                                </div>
                                <div class="form-group">
                                    <label>USP 2 </label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10 editable txtbox">
                                        <?php
                                        echo $this->Form->input('proj_usp2');
                                        ?></div>
                                </div>
                                <div class="form-group">
                                    <label>USP 3 </label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10 editable txtbox">
                                        <?php
                                        echo $this->Form->input('proj_usp3');
                                        ?>
                                    </div>
                                </div>        


                                <h4>Ratings</h4>
                                <div class="form-group">
                                    <label for="reg_input_name">Ratings</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10 editable txtbox">
                                        <div class="row" id="fr-select">
                                            <div class="col-sm-3">
                                                <?php
                                                echo $this->Form->input('proj_rating', array('value' => '100000', 'readonly' => 'readonly'));
                                                ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php
                                                echo $this->Form->input('proj_ratingbuilderbrand', array('value' => '100000', 'readonly' => 'readonly'));
                                                ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php
                                                echo $this->Form->input('proj_ratinglocation', array('value' => '100000', 'readonly' => 'readonly'));
                                                ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php
                                                echo $this->Form->input('proj_ratingrate', array('value' => '100000', 'readonly' => 'readonly'));
                                                ?></div>
                                            <div class="col-sm-3">
                                                <?php
                                                echo $this->Form->input('proj_ratingappreciationpotential', array('value' => '100000', 'readonly' => 'readonly'));
                                                ?></div>
                                            <div class="col-sm-3">
                                                <?php
                                                echo $this->Form->input('proj_ratingavailability', array('value' => '100000', 'readonly' => 'readonly'));
                                                ?></div> 
                                            <div class="col-sm-3">
                                                <?php
                                                echo $this->Form->input('proj_ratingamenities', array('value' => '100000', 'readonly' => 'readonly'));
                                                ?></div>
                                            <div class="col-sm-3">
                                                <?php
                                                echo $this->Form->input('proj_ratingvastucompliancy', array('value' => '100000', 'readonly' => 'readonly'));
                                                ?></div>

                                        </div></div>
                                </div>
                                <h4>Upload / Download Links</h4>       
                                <div class="form-group">
                                    <label>Upload</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10 editable txtbox">
                                        <div class="row" id="fr-select">
                                            <div class="col-sm-6 uploadfile">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="input-group">
                                                        <div class="form-control">
                                                            <i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
                                                        </div>
                                                        <div class="input-group-btn">
                                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                            <span class="btn btn-default btn-file">
                                                                <span class="fileupload-new">Select file</span>
                                                                <span class="fileupload-exists">Change</span>
                                                                <?php echo $this->Form->input('proj_rebrandedbrochure', array('type' => 'file')); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-6 uploadfile">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="input-group">
                                                        <div class="form-control">
                                                            <i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
                                                        </div>
                                                        <div class="input-group-btn">
                                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                            <span class="btn btn-default btn-file">
                                                                <span class="fileupload-new">Select file</span>
                                                                <span class="fileupload-exists">Change</span>
                                                                <?php echo $this->Form->input('proj_floorplans', array('type' => 'file')); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-6 uploadfile">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="input-group">
                                                        <div class="form-control">
                                                            <i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span>
                                                        </div>
                                                        <div class="input-group-btn">
                                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                            <span class="btn btn-default btn-file">
                                                                <span class="fileupload-new">Select file</span>
                                                                <span class="fileupload-exists">Change</span>
                                                                <?php echo $this->Form->input('proj_locationmaps', array('type' => 'file')); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div></div>
                                </div>


                            </div>
                        </div>
                    </fieldset>
                    <h4>Project Units</h4>
                    <fieldset class="nopdng">
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="cont-det">
                                    <p>Do you have unit details?</p>
                                    <?php echo $this->Form->checkbox('is_unit', array('id' => 'is_unit')); ?>
                                    <label>Yes</label> 
                                </div>
                                <div class="row form-wrap">
                                    <div class="inactive-form" id="inactive_unit"></div>
                                    <div class="col-sm-6">
                                        <h4>Unit Details</h4>
                                        <div class="form-group">
                                            <label>Project Name</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"> <?php echo $this->Form->input('project_text', array('class' => 'form-control project_text', 'readonly' => 'readonly')); ?></div>
                                        </div>

                                    </div> 
                                    <div class="col-sm-6">
                                        <h4>&nbsp;</h4>
                                        <div class="form-group">
                                            <label class="required">Unit Type</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('ProjectUnit.unit_type', array('options' => $unit_type, 'empty' => '--Select--')); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 spacer">
                                        <div class="form-group">
                                            <label>Unit Description</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10 editable txtbox">
                                                <?php echo $this->Form->input('ProjectUnit.unit_description', array('type' => 'textarea')); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Unit Remarks</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10 editable txtbox">
                                                <?php echo $this->Form->input('ProjectUnit.unit_other_remarks', array('type' => 'textarea')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 spacer">
                                        <h4>Define Unit Name</h4>
                                        <div class="form-group five-column">
                                            <div class="col-sm-12">
                                                <?php
                                                echo $this->Form->input('ProjectUnit.unit_type_qualifier_1', array('options' => $unit_qualifier1, 'empty' => '--Qualifier 1--'));
                                                echo $this->Form->input('ProjectUnit.unit_type_qualifier_2', array('options' => $unit_qualifier2, 'empty' => '--Qualifier 2--'));
                                                echo $this->Form->input('ProjectUnit.unit_type_qualifier_3', array('options' => $unit_qualifier3, 'empty' => '--Qualifier 3--'));
                                                echo $this->Form->input('ProjectUnit.unit_type_qualifier_4', array('options' => $unit_qualifier4, 'empty' => '--Qualifier 4--'));
                                                echo $this->Form->input('ProjectUnit.unit_type_qualifier_5', array('options' => $unit_qualifier5, 'empty' => '--Qualifier 5--'));
                                                ?>
                                                <?php echo $this->Form->button('Generate', array('type' => 'button', 'class' => 'btn btn-default btn-sm', 'id' => 'generate_qualifier')); ?>

                                            </div>
                                        </div>
                                        <h4><span style="color:#771D5A"><div id="input_quilifier_text"></div></span></h4>
                                    </div>
                                    <div class="col-sm-6">        
                                        <h4>Define Unit Structure</h4>
                                        <div class="form-group">
                                            <label>Total Units</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_total_units_in_project', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Sellable (Lowest)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_sellable_area_lowest_size', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Carpet (Lowest)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.units_carpet_area_lowest_size', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Average Loading</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_loading_factor'); ?></div>
                                        </div>
                                        <h4>Define Unit Cost / Sq Ft </h4>    
                                        <div class="form-group">
                                            <label>Basic Price / Sq Ft</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_total_basic_cost', array('class' => 'form-control rgt')); ?></div>
                                        </div> 
                                        <div class="form-group">
                                            <label>Floor Rise / Sq Ft </label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_floor_charges_sq_ft', array('class' => 'form-control rgt')); ?></div>
                                        </div>   
                                        <div class="form-group">
                                            <label>PLC / Sq Ft</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_plc_charges_sq_ft', array('class' => 'form-control rgt')); ?></div>
                                        </div> 
                                        <div class="form-group">
                                            <label>Total cost / sq ft</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_floor_rise_or_plc', array('class' => 'form-control rgt')); ?></div>
                                        </div>




                                    </div>
                                    <div class="col-sm-6">
                                        <h4>&nbsp;</h4> 
                                        <div class="form-group">
                                            <label>Available </label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_total_units_currently_available', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Sellable (Highest)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_sellable_area_highest_size', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Carpet (Highest)</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_carpet_area_highest_size', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Unit Status</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_total_units_currently_available', array('options' => array('1' => 'Yes', '2' => 'No'), 'empty' => '--Select--')); ?></div>
                                        </div>         
                                        <h4>&nbsp;</h4> 
                                        <div class="form-group">
                                            <label>Other Charges / Sq Ft</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_other_cost_per_sq_ft', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Floor Rise From</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_floor_rise_or_plc_from'); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>PLC From</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_floor_rise_or_plc_from'); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>On Sellable / Carpet</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_total_other_costs', array('class' => 'form-control rgt')); ?></div>
                                        </div>     



                                    </div>
                                    <div class="col-sm-12 spacer">
                                        <div class="form-group">
                                            <label class="flex-lbl" ><h4>Average Basic Cost of a Flat on the Ground Floor</h4> </label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-4 value"><h4>$1000</h4></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4>Define Unit Cost Lump sum (Pre-Agreement)</h4>
                                        <div class="form-group">
                                            <label>Amenities Cost </label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_amenities_cost', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Infrastructure Cost</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_infra__pre_agreement_cost', array('class' => 'form-control rgt')); ?></div>
                                        </div>    
                                    </div>
                                    <div class="col-sm-6">
                                        <h4>&nbsp;</h4>
                                        <div class="form-group">
                                            <label>Car Parking Cost </label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_car_parking_cost', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Other Cost</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_other_pre_agreement_cost', array('class' => 'form-control rgt')); ?></div>
                                        </div>  
                                        <div class="form-group">
                                            <label>Total Lump Sum Cost</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">$100</div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 spacer">
                                        <div class="form-group">
                                            <label class="flex-lbl"><h4>Average Agreement Value of a Flat on the Ground Floor</h4></label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-4 value"><h4>$1000</h4></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4>Defines Taxes & Duties</h4>
                                        <div class="form-group">
                                            <label>Stamp Duty %  </label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_stamp_duty', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Service Tax % </label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_service_tax', array('class' => 'form-control rgt')); ?></div>
                                        </div>    
                                    </div>
                                    <div class="col-sm-6">
                                        <h4>&nbsp;</h4>
                                        <div class="form-group">
                                            <label>VAT % </label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_vat', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Registration</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_registration_cost', array('class' => 'form-control rgt')); ?></div>
                                        </div>  
                                    </div>
                                    <div class="col-sm-12 spacer">
                                        <div class="form-group">
                                            <label class="flex-lbl"><h4>Average Post-Tax Total Cost of a Flat on the Ground Floor</h4></label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-4 value"><h4>$1000</h4></div>
                                        </div>
                                    </div>  
                                    <div class="col-sm-6">
                                        <h4>Define Unit Cost Lump sum (Post-Agreement)</h4>
                                        <div class="form-group">
                                            <label>Society / Maint</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_societies_cost', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Other Infra Charges </label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_other_infra_charges', array('class' => 'form-control rgt')); ?></div>
                                        </div>    
                                    </div>
                                    <div class="col-sm-6">
                                        <h4>&nbsp;</h4>
                                        <div class="form-group">
                                            <label>Legal Charges</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_legal_cost', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Other Charges</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_other_charges', array('class' => 'form-control rgt')); ?></div>
                                        </div>  
                                    </div>      
                                    <div class="col-sm-12 spacer">
                                        <div class="form-group">
                                            <label class="flex-lbl"><h4>Average Total Payable Amount for a Flat on the Ground Floor</h4></label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-4 value"><h4>$1000</h4></div>
                                        </div>
                                    </div>      
                                    <div class="col-sm-6">
                                        <h4>Downpayment Required</h4>
                                        <div class="form-group">
                                            <label>Booking Amount</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_iniitial_booking_amount', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Percent Lumpsum</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_downpayment_on_percent_or_lumpsum', array('class' => 'form-control rgt')); ?></div>
                                        </div>  

                                        <div class="form-group">
                                            <label>Total Downpayment</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_total_downpayment_required', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <h4>Second Payment Required</h4>
                                        <div class="form-group">
                                            <label>Percent Lumpsum</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_second_payment_on_percent_or_lumpsum', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Second Payment</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_total_second_payment_required', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <h4>Third Payment Required</h4>   

                                        <div class="form-group">
                                            <label>Percent Lumpsum</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_third_payment_on_percent_or_lumpsum', array('class' => 'form-control rgt')); ?></div>
                                        </div>

                                        <div class="form-group">
                                            <label>Third Payment</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_total_third_payment_required', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <h4>Define Commission Structure</h4>   
                                        <div class="form-group">
                                            <label>Commission % </label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_commission_percent', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Based on</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_commission_based_on', array('options' => $based_on, 'empty' => '--Select--')); ?></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h4>&nbsp;</h4>
                                        <div class="form-group int-sm">
                                            <label>Booking Amount Due</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php
                                                echo $this->Form->input('ProjectUnit.unit_initial_booking_payment_due', array('class' => 'form-control sm rgt', 'tabindex' => '19'));
                                                echo $this->Form->input('ProjectUnit.unit_initial_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'empty' => '--Select--'));
                                                ?></div>
                                        </div>



                                        <div class="form-group">
                                            <label>Attached to</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_downpayment_attached_to_construction', array('options' => $attach_to, 'empty' => '--Select--')); ?></div>
                                        </div>  
                                        <div class="form-group int-sm">
                                            <label>Downpayment Due</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php
                                                echo $this->Form->input('ProjectUnit.unit_downpayment_amount_due_in', array('class' => 'form-control sm rgt', 'tabindex' => '19'));
                                                echo $this->Form->input('ProjectUnit.unit_downpayment_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'empty' => '--Select--'));
                                                ?></div>
                                        </div>

                                        <h4>&nbsp;</h4>
                                        <div class="form-group">
                                            <label>Attached to </label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_second_payment_attached_to_construction', array('options' => $attach_to, 'empty' => '--Select--')); ?></div>
                                        </div>
                                        <div class="form-group int-sm">
                                            <label>Second Payment Due</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php
                                                echo $this->Form->input('ProjectUnit.unit_second_payment_amount_due_in', array('class' => 'form-control sm rgt', 'tabindex' => '19'));
                                                echo $this->Form->input('ProjectUnit.unit_second_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'empty' => '--Select--'));
                                                ?></div>
                                        </div>  

                                        <h4>&nbsp;</h4> 
                                        <div class="form-group">
                                            <label>Attached to</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_third_payment_attached_to_construction', array('options' => $attach_to, 'empty' => '--Select--')); ?></div>
                                        </div>
                                        <div class="form-group int-sm">
                                            <label>Third Payment Due</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php
                                                echo $this->Form->input('ProjectUnit.unit_third_party_amount_due_in', array('class' => 'form-control sm rgt', 'tabindex' => '19'));
                                                echo $this->Form->input('ProjectUnit.unit_third_party_option', array('label' => false, 'options' => array('Days' => 'Days', 'Months' => 'Months'), 'empty' => '--Select--'));
                                                ?></div>
                                        </div>

                                        <h4>&nbsp;</h4>  
                                        <div class="form-group">
                                            <label>Commission Event</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_commission_event', array('options' => $commission_event, 'empty' => '--Select--')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Applied To</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"><?php echo $this->Form->input('ProjectUnit.unit_commission_applied_to', array('class' => 'form-control rgt')); ?></div>
                                        </div>
                                    </div>       
                                    <div class="col-sm-12 spacer">
                                        <div class="form-group">
                                            <label class="flex-lbl"><h4>Average Total Commission for a Flat Sale on the Ground Floor</h4></label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-4 value"><h4>$1000</h4></div>
                                        </div>
                                    </div>      




                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <h4>Project Amenities</h4>
                    <fieldset class="nopdng">
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="cont-det">
                                    <p>Do you have amenities details?</p>
                                    <?php echo $this->Form->checkbox('is_amenity', array('id' => 'is_amenity')); ?>
                                    <label>Yes</label> 
                                </div>
                                <div class="row form-wrap">
                                    <div class="inactive-form" id="inactive_amenity"></div>
                                    <div class="col-sm-12">
                                        <?php
                                        if (count($groups) && !empty($groups)) {
                                            foreach ($groups as $val) {
                                                ?>
                                                <h4><?php echo $val['Group']['group_name']; ?></h4>
                                                <div class="form-group">



                                                                        <!--<label><?php echo $val['Group']['group_name']; ?></label>
                    <span class="colon">:</span>-->
                                                    <div class="col-sm-12"><div class="checkbox three-column"><?php
                                                            foreach ($val['Amnity'] as $amenities) {
                                                                echo $this->Form->input('Amenity.amenity_id', array('type' => 'checkbox',
                                                                    'label' => $amenities['amenity_name'],
                                                                    'name' => 'data[Amenity][amenity_id][]',
                                                                    'div' => array('class' => 'list-checkbox'),
                                                                    'value' => $amenities['id'],
                                                                    'hiddenField' => false));
                                                                // echo $amenities['amenity_name']',';
                                                            }
                                                            ?></div></div>
                                                </div>
                                            <?php }
                                        }
                                        ?>


                                    </div>


                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <h4>Project Contacts</h4>
                    <fieldset class="nopdng">
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="cont-det">
                                    <p>Do you have contact details?</p>
<?php echo $this->Form->checkbox('is_contact', array('id' => 'is_contact')); ?>
                                    <label>Yes</label> 
                                </div>
                                <div class="row form-wrap">
                                    <div class="inactive-form" id="inactive_contact"></div>
                                    <div class="col-sm-6">

                                        <h4>Contact Details</h4>
                                        <div class="form-group">
                                            <label>Project Name</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"> <?php echo $this->Form->input('project_text', array('class' => 'form-control project_text', 'readonly' => 'readonly')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="required">Contact Role</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10"> <?php echo $this->Form->input('ProjectContact.project_contact_project_role', array('options' => $projec_role, 'empty' => '--Select--', 'class' => 'form-control data_required')); ?></div>
                                        </div>






                                    </div>

                                    <div class="col-sm-6">
                                        <h4>&nbsp;</h4>
                                        <div class="form-group">
                                            <label class="required">Builder Name</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('ProjectContact.project_contact_builder_id', array('options' => array(), 'empty' => '--Select--')); ?></div>
                                        </div>
                                        <div class="form-group">
                                            <label class="required">Contact Name</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">
                                                <?php
                                                echo $this->Form->input('ProjectContact.project_contact_builder_contact_id', array('options' => array(), 'empty' => '--Select--', 'class' => 'form-control data_required'));
                                                ?></div>
                                        </div>




                                    </div>
                                    <div id="ajax_contact_details_div"></div>

                                    <div class="col-sm-12 spacer">
                                        <div class="form-group">
                                            <label>Contact Remarks</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10 editable txtbox">
<?php echo $this->Form->input('ProjectContact.project_contact_remarks', array('type' => 'textarea')); ?>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Manager Group</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('ProjectContact.project_contact_managed_by_id', array('options' => $contact_managed, 'empty' => '--Select--')); ?></div>
                                        </div>


                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Managed By</label>
                                            <span class="colon">:</span>
                                            <div class="col-sm-10">  <?php echo $this->Form->input('ProjectContact.project_contact_prepared_by', array('options' => array(), 'empty' => '--Select--')); ?></div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>




<?php echo $this->Form->end(); ?>
                </div>
            </div>

        </div>
    </div>


</div>
<?php
$this->Js->get('#ProjectCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_pribuilder_by_cityid'
                ), array(
            'update' => '#ProjectBuilderId',
            'async' => true,
            'before' => 'loading("ProjectBuilderId")',
            'complete' => 'loaded("ProjectBuilderId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#ProjectCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_secobuilder_by_cityid'
                ), array(
            'update' => '#ProjectSecondaryBuilderId',
            'async' => true,
            'before' => 'loading("ProjectSecondaryBuilderId")',
            'complete' => 'loaded("ProjectSecondaryBuilderId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#ProjectCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_tertibuilder_by_cityid'
                ), array(
            'update' => '#ProjectTertiaryBuilderId',
            'async' => true,
            'before' => 'loading("ProjectTertiaryBuilderId")',
            'complete' => 'loaded("ProjectTertiaryBuilderId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#ProjectCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_builder_by_cityid/Project'
                ), array(
            'update' => '#ProjectContactProjectContactBuilderId',
            'async' => true,
            'before' => 'loading("ProjectContactProjectContactBuilderId")',
            'complete' => 'loaded("ProjectContactProjectContactBuilderId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#ProjectCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Project/city_id'
                ), array(
            'update' => '#ProjectSuburbId',
            'async' => true,
            'before' => 'loading("ProjectSuburbId")',
            'complete' => 'loaded("ProjectSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#ProjectSuburbId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_suburb/Project/suburb_id'
                ), array(
            'update' => '#ProjectAreaId',
            'async' => true,
            'before' => 'loading("ProjectAreaId")',
            'complete' => 'loaded("ProjectAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#ProjectContactProjectContactBuilderId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_contactbuilder_by_builderid'
                ), array(
            'update' => '#ProjectContactProjectContactBuilderContactId',
            'async' => true,
            'before' => 'loading("ProjectContactProjectContactBuilderContactId")',
            'complete' => 'loaded("ProjectContactProjectContactBuilderContactId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#ProjectCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_list_projectmanaged_by_city'
                ), array(
            'update' => '#ProjectContactProjectContactPreparedBy',
            'async' => true,
            'before' => 'loading("ProjectContactProjectContactPreparedBy")',
            'complete' => 'loaded("ProjectContactProjectContactPreparedBy")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

/* $this->Js->get('#ProjectCityId')->event('change', 
  $this->Js->request(array(
  'controller'=>'project',
  'action'=>'get_list_by_city_2'
  ), array(
  'update'=>'#ProjectBuilderId',
  'async' => true,
  'method' => 'post',
  'dataExpression'=>true,
  'data'=> $this->Js->serializeForm(array(
  'isForm' => true,
  'inline' => true
  ))
  ))
  ); */
?>
<script>

    $(document).ready(function() {

        var FULL_BASE_URL = $('#hidden_site_baseurl').val();

        $("#is_unit").bind('click', function() {
            if ($(this).is(":checked")) {
                $("#inactive_unit").hide();
            }
            else {
                $("#inactive_unit").show();
            }
        });
        $("#is_contact").bind('click', function() {
            if ($(this).is(":checked")) {
                $("#inactive_contact").hide();
            }
            else {
                $("#inactive_contact").show();
            }
        });

        $('#generate_qualifier').click(function() {
            var qualifier1 = $('#UnitUnitTypeQualifier1 option:selected').text();
            var qualifier2 = $('#UnitUnitTypeQualifier2 option:selected').text();
            var qualifier3 = $('#UnitUnitTypeQualifier3 option:selected').text();
            var qualifier4 = $('#UnitUnitTypeQualifier4 option:selected').text();
            var qualifier5 = $('#UnitUnitTypeQualifier5 option:selected').text();
            $('#input_quilifier_text').text(qualifier1 + ' ' + qualifier2 + ' ' + qualifier3 + ' ' + qualifier4 + ' ' + qualifier5);

        });

        $("#is_amenity").bind('click', function() {
            if ($(this).is(":checked")) {
                $("#inactive_amenity").hide();
            }
            else {
                $("#inactive_amenity").show();
            }
        });


        $('#ProjectBuilderId').click(function() {

            if ($('#ProjectCityId').val() == "")
            {
                bootbox.alert('City can not be blank');
                return false;
            }
        });

        $('#ProjectSuburbId').click(function() {

            if ($('#ProjectCityId').val() == "")
            {
                bootbox.alert('City can not be blank');
                return false;
            }
        });

        $('#ProjectAreaId').click(function() {
            if ($('#ProjectCityId').val() == '' || $('#ProjectSuburbId').val() == '')
            {
                bootbox.alert('City & suburb can not be blank');
                return false;
            }
        });

        $('#ProjectBuilderId').change(function() {
            $('#primary_builder').val($(this).val());
        });


        $('#is_contact').change(function() {
            if ($(this).is(":checked") == true) {
                $(".required").addClass("req");
                //$( ".data_required" ).attr("data-required", "true");
                $('#wizard_a').attr('onsubmit', 'return validation_chk()');
                //$( ".data_required" ).addClass( "form-control parsley-validated parsley-error" );

            }
            else
            {
                $(".required").removeClass("req").addClass("required");
                //$(".data_required").removeAttr("data-required");
                $("#wizard_a").removeAttr("onsubmit");
                //	$( ".data_required" ).removeClass( "parsley-validated parsley-error" );
                //$( ".required" ).removeClass( "req" ).addClass( "required" );
            }

        });

        $('#ProjectProjectName').blur(function() {
            $('.project_text').val($(this).val());

        });


        /**
         * listing project by city_id in project details page. 
         */

        $('#ProjectContactProjectContactBuilderContactId').change(function() {
            var contact_id = $(this).val();
            if (contact_id != '' || contact_id != null) {
                var dataString = 'contact_id=' + contact_id;
                //  $('#ProjectId').attr('disabled', 'disabled');
                $.ajax({
                    type: "POST",
                    data: dataString,
                    url: FULL_BASE_URL + '/all_functions/get_builder_contact_details',
                    beforeSend: function() {
                        // $('#ProjectId').attr('disabled', 'disabled');
                        //return false;
                    },
                    success: function(return_data) {
                        // $('#ProjectId').removeAttr('disabled');
                        $('#ajax_contact_details_div').html(return_data);
                    }
                });
            }
            else
            {
                $('#ajax_contact_details_div').html('');
            }
        });

        $('.city_custom').click(function(e) {
            var id = $(this).parent().prev('div').find('select').attr('id');
            var pref = $('#' + id).val();

            if (pref == '' || pref == null) {
                e.preventDefault();
                bootbox.dialog({
                    message: "Please select preference",
                    title: "Message",
                    buttons: {
                        success: {
                            label: "Got It!",
                            className: "btn-success",
                            callback: function() {
                            }
                        },
                        main: {
                            label: "More Info!",
                            className: "btn-primary",
                            callback: function() {
                                bootbox.alert('Information-<strong>Goes here..</strong>');
                            }
                        }
                    }

                });
            }

        });

    });
    function validation_chk(e) {

        if ($('#BuilderContactBuilderContactLevel').val() == "")
        {
            bootbox.alert('Contact level can not be blank');
            return false;
        }

        if ($('#BuilderContactBuilderContactName').val() == "")
        {
            bootbox.alert('Contact name can not be blank');
            return false;
        }

        if ($('#BuilderContactBuilderContactDesignation').val() == "")
        {
            bootbox.alert('Contact designation can not be blank');
            return false;
        }
        if ($('#BuilderContactBuilderContactLocation').val() == "")
        {
            bootbox.alert('Contact location can not be blank');
            return false;
        }
        if ($('#BuilderContactBuilderContactCompany').val() == "")
        {
            bootbox.alert('Contact company can not be blank');
            return false;
        }
        if ($('#BuilderContactBuilderContactCompanyCity').val() == "")
        {
            bootbox.alert('Contact company city can not be blank');
            return false;
        }


        var initiated = $('#BuilderContactBuilderContactIntiatedById').val();
        var managed = $('#BuilderContactBuilderContactManagedById').val();
        if (initiated != '')
        {
            var initiated_by = $('#BuilderContactBuilderContactIntiatedBy').val();
            if (initiated_by == '') {
                bootbox.alert('Please select initiated by!');
                return false;
            }
        }
        if (managed != '')
        {
            var managed_by = $('#BuilderContactBuilderContactManagedBy').val();
            if (managed_by == '') {
                bootbox.alert('Please select managed by!');
                return false;
            }
        }


    }

</script>