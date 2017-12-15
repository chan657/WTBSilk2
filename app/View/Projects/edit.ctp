<?php
$this->Html->addCrumb('Edit Project', 'javascript:void(0);', array('class' => 'breadcrumblast'));
$role_id = $this->Session->read("role_id");
if (($this->data['Project']['proj_active_primary'] == '1' || $action_type == '0')) {
    $proj_active_primary = true;
    $label_active_primary = 'Waiting...';
} else {
    $proj_active_primary = false;
    $label_active_primary = 'Update';
}

if (($this->data['Project']['proj_active_details'] == '1' || $action_type == '1')) {
    $proj_active_details = true;
    $label_active_details = 'Waiting...';
} else {
    $proj_active_details = false;
    $label_active_details = 'Update';
}

if (($this->data['Project']['proj_active_amenities'] == '1' || $action_type == '3')) {
    $proj_active_amenities = true;
    $label_active_amenities = 'Waiting...';
} else {
    $proj_active_amenities = false;
    $label_active_amenities = 'Update';
}
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Information</h4>
        </div>
        <div class="panel-body edtpro">
            <fieldset>
                <legend><span>Edit Project</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('Project', array('method' => 'post', 'id' => 'wizard_b', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
                    // echo $this->Form->input('Amenity.amenity_id',array('value'=>''));
                    echo $this->Form->hidden('action_type', array('value' => '0', 'id' => 'ActionType'));
                    
                    if ($actio_itme_id) {
                        if ($screen_position == 'SC-1') {
                            echo $this->Form->hidden('stpes', array('value' => 'steps-uid-1-t-0'));
                            $proj_active_primary = false;
                            $label_active_primary = 'Update';
                            $proj_active_amenities = true;
                            $label_active_amenities = 'Waiting...';
                            $proj_active_details = true;
                            $label_active_details = 'Waiting...';
                        } else if ($screen_position == 'SC-2') {
                            echo $this->Form->hidden('stpes', array('value' => 'steps-uid-1-t-1'));
                        
                            $proj_active_details = false;
                            $label_active_details = 'Update';
                            $proj_active_primary = true;
                            $label_active_primary = 'Waiting...';
                            $proj_active_amenities = true;
                            $label_active_amenities = 'Waiting...';
                        } else if ($screen_position == 'SC-4') {
                            echo $this->Form->hidden('stpes', array('value' => 'steps-uid-1-t-3'));
                            $proj_active_amenities = false;
                            $label_active_amenities = 'Update';
                            $proj_active_primary = true;
                            $label_active_primary = 'Waiting...';
                            $proj_active_details = true;
                            $label_active_details = 'Waiting...';
                        }
                    }
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
                                                if ($this->data['Project']['proj_completionyear'] <> '')
                                                    $proj_completionyear = date('d-m-Y', strtotime($this->data['Project']['proj_completionyear']));
                                                else
                                                    $proj_completionyear = NULL;
                                                echo $this->Form->input('proj_completionyear', array('type' => 'text', 'value' => $proj_completionyear));
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
                                        <div class="col-sm-10"> <?php echo $this->Form->input('builder_id', array('options' => $builders, 'empty' => '--Select--', 'class' => 'form-control', 'onchange' => 'filterPreferences(this.value,\'ProjectSecondaryBuilderId\',\'ProjectTertiaryBuilderId\')', 'tabindex' => '8')); ?></div>
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
                                            ?></div>
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
                                            echo $this->Form->input('proj_areaofland', array('type' => 'text', 'class' => 'form-control sm rgt', 'tabindex' => '19'));
                                            echo $this->Form->input('proj_landoption', array('label' => false, 'options' => $area_units, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>

                                    <div class="form-group int-sm">
                                        <label>Landmark Distance</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">  <?php
                                            echo $this->Form->input('proj_distancefromcentrallandmark', array('type' => 'text', 'class' => 'form-control sm rgt', 'tabindex' => '19'));
                                            echo $this->Form->input('proj_distanceoption', array('label' => false, 'options' => $distance_units, 'empty' => '--Select--'));
                                            ?></div>
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
                                            ?></div>
                                    </div>


                                </div>

                            </div>


                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit($label_active_primary, array('class' => 'btn btn-success sticky_success', 'disabled' => $proj_active_primary));
                                ?>
                                <!--<button type="submit" id="update_buttn" disabled="disabled" class="btn btn-success sticky_success">Update</button>-->

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

                                                <?php echo $this->Form->input('primary_builder', array('options' => $builders, 'readonly' => 'readonly', 'value' => $this->data['Project']['builder_id'], 'id' => 'primary_builder', 'disabled' => 'disabled')); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php echo $this->Form->input('secondary_builder_id', array('options' => $builders, 'empty' => '--Secondary Builder--', 'class' => 'form-control', 'onchange' => 'filterPreferences(this.value,\'ProjectBuilderId\',\'ProjectTertiaryBuilderId\')', 'tabindex' => '8', 'disabled' => array($this->data['Project']['builder_id']))); ?>
                                            </div>
                                            <div class="col-sm-3">
                                                <?php echo $this->Form->input('tertiary_builder_id', array('options' => $builders, 'empty' => '--Tertiary Builder--', 'class' => 'form-control city_custom', 'onchange' => 'filterPreferences(this.value,\'ProjectBuilderId\',\'ProjectSecondaryBuilderId\')', 'tabindex' => '8', 'disabled' => array($this->data['Project']['builder_id']))); ?>
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
                                        ?></div>
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
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit($label_active_details, array('class' => 'btn btn-success sticky_success', 'disabled' => $proj_active_details));
                                ?>
                            </div>



                        </div>
                    </fieldset>
                    <h4>Project Units</h4>
                    <fieldset class="nopdng">
                        <div class="row">

                            <div class="col-sm-12">

                                <div class="form-control-static">
                                    <div class="table-heading disimp">
                                        <h4 class="table-heading-title"><!--<span class="badge badge-circle badge-success"> <?php echo count($this->data['BuilderContact']) ?></span>-->Unit Details</h4><span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i>
                                            <?php echo $this->Html->link('Add Unit', '/projects/add_unit/' . $this->data['Project']['id'], array('class' => 'open-popup-link add-btn')); ?>

                                        </span></div><table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">

                                        <thead>
                                            <tr class="footable-group-row">
                                                <th data-group="group1" colspan="4" class="nodis">Unit Information</th>
                                                <th data-group="group2" colspan="2">Unit Basic Cost</th>
                                                <th data-group="group3" colspan="2">Agreement Value</th>
                                                <th data-group="group4" colspan="2">All Inclusive Cost</th>
                                                <th data-group="group5" colspan="3">Unit Cost</th>
                                                <th data-group="group6" colspan="4">Lump sum cost (Pre-agreement)</th>
                                                <th data-group="group7" class="nodis">Action</th>
                                            </tr>
                                            <tr>
                                                <th data-group="group1" data-toggle="true" width="10%" valign="middle" align="left">Unit Type</th>
                                                <th data-group="group1" width="10%" valign="middle" align="left">Display Name</th>
                                                <th data-group="group1" width="5%" valign="middle" align="left">Tower / Phase</th>
                                                <th data-group="group1" width="5%" valign="middle" align="left">Unit Price</th>


                                                <th data-group="group2" data-sort-ignore="true" width="1%" data-hide="phone" align="left">Lowest</th>
                                                <th data-group="group2" data-sort-ignore="true" width="1%" data-hide="phone" align="left">Highest</th>


                                                <th data-group="group3" data-sort-ignore="true" data-hide="phone" align="left">Lowest</th>
                                                <th data-group="group3" data-sort-ignore="true" data-hide="phone" align="left">Highest</th>
                                                <th data-group="group4" data-sort-ignore="true" data-hide="phone" align="left">Lowest</th>
                                                <th data-group="group4" data-sort-ignore="true" data-hide="phone" align="left">Highest</th>
                                                <th data-group="group5" data-sort-ignore="true" data-hide="all" align="left">Floor Rise / Sq Ft </th>
                                                <th data-group="group5" data-sort-ignore="true" data-hide="all" align="left">PLC / Sq Ft</th>
                                                <th data-group="group5" data-sort-ignore="true" data-hide="all" align="left">Sale Pattern</th>
                                                <th data-group="group6" data-sort-ignore="true" data-hide="all" align="left">Amenities Cost</th>
                                                <th data-group="group6" data-sort-ignore="true" data-hide="all" align="left">Car Parking Cost </th>
                                                <th data-group="group6" data-sort-ignore="true" data-hide="all" align="left">Infrastructure Cost</th>
                                                <th data-group="group6" data-sort-ignore="true" data-hide="all" align="left">Other Cost</th>



                                                <th data-group="group7" data-sort-ignore="true" width="5%" data-hide="phone" valign="middle" align="center">Action</th>        
                                            </tr>
                                        </thead>

                                        <tbody>  
                                            <?php
                                            if (count($this->data['ProjectUnit']) && !empty($this->data['ProjectUnit'])) {
                                                foreach ($this->data['ProjectUnit'] as $unit) {
                                                    ?> 
                                                    <tr>
                                                        <td class="tablebody" valign="middle" align="left"><?php if ($unit['unit_type']) echo $unit_type[$unit['unit_type']]; ?></td>
                                                        <td class="tablebody" valign="middle" align="left"><?php echo $unit['unit_name'] ?></td>
                                                        <td class="tablebody" valign="middle" align="left"><?php echo $unit['unit_tower_phase'] ?></td>
                                                        <td class="tablebody" valign="middle" align="left"><?php echo $unit['unit_sellable_area_highest_size'] ?></td>
                                                        <td data-value="yes_UN" class="sub-tablebody"><?php echo $unit['basic_cost'] ?></td>
                                                        <td data-value="yes_UN" class="sub-tablebody"><?php echo $unit['high_basic_cost']; ?></td>

                                                        <td data-value="yes_UN" class="sub-tablebody"><?php echo $unit['agreement_cost']; ?></td>
                                                        <td data-value="yes_UN" class="sub-tablebody"><?php echo $unit['high_agreement_cost']; ?></td>

                                                        <td data-value="yes_UN" class="sub-tablebody"><?php echo $unit['payable_cost']; ?></td>
                                                        <td data-value="yes_UN" class="sub-tablebody"><?php echo $unit['high_payable_cost']; ?></td>

                                                        <td data-value="yes_UN" class="sub-tablebody"><?php echo $unit['unit_floor_charges_sq_ft']; ?></td>
                                                        <td data-value="yes_UN" class="sub-tablebody"><?php echo $unit['unit_plc_charges_sq_ft']; ?></td>
                                                        <td data-value="yes_UN" class="sub-tablebody"><?php echo $unit['unit_price_on_sellable_or_carpet']; ?></td>

                                                        <td data-value="yes_UN" class="sub-tablebody"><?php echo $unit['unit_amenities_cost']; ?></td>
                                                        <td data-value="yes_UN" class="sub-tablebody"><?php echo $unit['unit_car_parking_cost']; ?></td>
                                                        <td data-value="yes_UN" class="sub-tablebody"><?php echo $unit['unit_infra_pre_agreement_cost']; ?></td>
                                                        <td data-value="yes_UN" class="sub-tablebody"><?php echo $unit['unit_other_pre_agreement_cost']; ?></td>

                                                        <td><?php
                                                            if ($unit['unit_approved'] == '1')
                                                                echo $this->Html->link('<span class="icon-pencil"></span>', '/projects/edit_unit/' . $unit['id'], array('class' => 'act-icon open-popup-link add-btn', 'escape' => false));
                                                            ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>   
                                    </table></div>

                            </div>
                        </div>
                    </fieldset>
                    <h4>Project Amenities</h4>
                    <fieldset class="nopdng">
                        <div class="row">

                            <div class="col-sm-12">

                                <div class="row form-wrap">

                                    <div class="col-sm-12">
                                        <?php
//	pr($amenity);  
                                       
                                        if (count($groups) && !empty($groups)) {
                                            foreach ($groups as $val) {
                                                ?>
                                                <h4><?php echo $val['Group']['group_name']; ?></h4>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="checkbox three-column"><?php foreach ($val['Amnity'] as $amenities) { ?>
                                                                <div class="list-checkbox">
                                                                    <input type="checkbox" id="AmenityAmenityId" value="<?php echo $amenities['id'] ?>" <?php if (in_array($amenities['id'], $amenity)) { ?> checked="checked" <?php } ?> class="form-control" name="data[Amenity][amenity_id][]">	
                                                                    <label for="AmenityAmenityId">	<?php echo $amenities['amenity_name'] ?></label>
                                                                </div>

                                                            <?php }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>


                                    </div>


                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit($label_active_amenities, array('class' => 'btn btn-success sticky_success', 'disabled' => $proj_active_amenities));
                                ?>
                            </div>



                        </div>
                    </fieldset>

                    <h4>Project Contacts</h4>
                    <fieldset class="nopdng">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">

                                    <div class="col-sm-12">

                                        <div class="form-control-static">
                                            <div class="table-heading disimp">
                                                <h4 class="table-heading-title"><!--<span class="badge badge-circle badge-success"> <?php echo count($this->data['BuilderContact']) ?></span>-->Contact Details</h4><span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i>
                                                    <?php echo $this->Html->link('Add Contact', '/projects/add_contact/' . $this->data['Project']['id'], array('class' => 'open-popup-link add-btn')); ?>

                                                </span></div><table class="table toggle-square responsive_table" data-filter="#table_search" data-page-size="40">
                                                <thead>
                                                    <tr>
                                                        <th data-toggle="true">Project Name</th>
                                                        <th data-hide="phone">Contact Name</th>
                                                        <th data-hide="phone">Designation</th>
                                                        <th data-hide="phone">Primary Mobile</th>
                                                        <th data-hide="phone">Secondary Mobile</th>

                                                        <th data-hide="phone">Email Address</th>
                                                        <th data-hide="phone">Location</th>
                                                        <th data-hide="phone">Role</th>


<!--<th data-hide="all" data-sort-ignore="true">Managed By</th>
<th data-hide="all" data-sort-ignore="true">Manager</th>
<th data-hide="all" data-sort-ignore="true">Created By</th>
<th data-hide="all" data-sort-ignore="true">Creator</th>
<th data-hide="all" data-sort-ignore="true">For Company</th>
<th data-hide="all" data-sort-ignore="true">For Company City</th>
<th data-hide="all" data-sort-ignore="true">Approved By</th>
<th data-hide="all" data-sort-ignore="true">Approved Date</th>
<th data-hide="all" data-sort-ignore="true">Address of Contact</th>-->
                                                        <th data-hide="phone" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>  
                                                    <?php
                                                    $contact_name = '';
                                                    $contact_designation = '';
                                                    $primary_mobile = '';
                                                    $secondary_mobile = '';
                                                    $land_line = '';
                                                    $email = '';
                                                    $location = '';



                                                    if (count($this->data['ProjectContact']) && !empty($this->data['ProjectContact'])) {
                                                        foreach ($this->data['ProjectContact'] as $ProjectContact) {

                                                            if (count($builder_contacts) && !empty($builder_contacts)) {
                                                                foreach ($builder_contacts as $builder_contact) {

                                                                    if ($builder_contact['BuilderContact']['id'] == $ProjectContact['project_contact_builder_contact_id']) {

                                                                        $contact_name = $builder_contact['BuilderContact']['builder_contact_name'];
                                                                        $contact_designation = $builder_contact['BuilderContact']['builder_contact_designation'];
                                                                        $primary_mobile = $codes[$builder_contact['BuilderContact']['builder_contact_mobile_country_code']] . ' ' . $builder_contact['BuilderContact']['builder_contact_mobile_no'];
                                                                        $secondary_mobile = $codes[$builder_contact['BuilderContact']['builder_contact_secondary_mobile_country_code']] . ' ' . $builder_contact['BuilderContact']['builder_contact_secondary_mobile_no'];

                                                                        $email = $builder_contact['BuilderContact']['builder_contact_email'];
                                                                        $location = $city[$builder_contact['BuilderContact']['builder_contact_location']];
                                                                        $company = $builder_contact['BuilderContact']['builder_contact_company'];
                                                                        $company_city = $city[$builder_contact['BuilderContact']['builder_contact_company_city']];
                                                                        $contact_address = $builder_contact['BuilderContact']['builder_contact_address'];
                                                                    }
                                                                }
                                                            }
                                                            ?> 
                                                            <tr>
                                                                <td><?php echo $this->data['Project']['project_name']; ?></td>
                                                                <td><?php echo $contact_name ?></td>
                                                                <td><?php echo $contact_designation; ?></td>
                                                                <td><?php echo $primary_mobile; ?></td>
                                                                <td><?php echo $secondary_mobile; ?></td>

                                                                <td><?php echo $email; ?></td>
                                                                <td><?php echo $location; ?></td>
                                                                <td><?php echo $projec_role[$ProjectContact['project_contact_project_role']]; ?></td>

                                <!--<td><?php echo $ProjectContact['project_contact_managed_by']; ?></td>
                                <td><?php echo $project_managed[$ProjectContact['project_contact_managed_by_id']]; ?></td>
                                <td><?php echo $projec_prepared[$ProjectContact['project_contact_prepared_by_id']]; ?></td>
                                <td><?php echo $ProjectContact['project_contact_prepared_by']; ?></td>
                                <td><?php echo $company; ?></td>
                                <td><?php echo $company_city; ?></td>
                                <td><?php echo $ProjectContact['project_contact_approved_by']; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($ProjectContact['project_contact_approved_date'])); ?></td>
                                <td><?php echo $contact_address; ?></td>-->
                                                                <td><?php
                                                                    if ($ProjectContact['project_contact_approved'] == 1)
                                                                        echo $this->Html->link('<span class="icon-pencil"></span>', '/projects/edit_contact/' . $ProjectContact['id'], array('class' => 'act-icon open-popup-link add-btn', 'escape' => false));
                                                                    ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </tbody>   
                                            </table></div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </fieldset>
                    <h4>Project Legal Name</h4>
                    <fieldset class="nopdng">
                        <div class="row">

                            <div class="col-sm-12">

                                <div class="form-control-static">
                                    <div class="table-heading disimp">
                                        <h4 class="table-heading-title">Legal Name Details</h4><span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i>
                                            <?php echo $this->Html->link('Add Legal Name', '/project_legal_names/add/' . $this->data['Project']['id'], array('class' => 'open-popup-link add-btn')); ?>

                                        </span></div><table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="40">
                                        <thead>
                                            <tr>
                                                <th data-toggle="true" width="7%">Project Name</th>
                                                <th data-toggle="true" width="7%">Builder Name</th>
                                                <th data-hide="phone" width="7%">Contact Name</th>
                                                <th data-hide="phone" width="5%">Legal Name</th>
                                                <th data-hide="phone" width="6%">City</th>
                                                <th data-hide="phone" width="8%">Address</th>

                                                <th data-hide="phone" data-sort-ignore="true" width="1%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>  
                                            <?php
// pr($project_legal_names);
                                            if (count($project_legal_names) && !empty($project_legal_names)):
                                                foreach ($project_legal_names as $ProjectLegalName):

                                                    $id = $ProjectLegalName['ProjectLegalName']['id'];
                                                    ?> 
                                                    <tr>
                                                        <td><?php echo $ProjectLegalName['Project']['project_name']; ?></td>
                                                        <td><?php echo $ProjectLegalName['Builder']['builder_name']; ?></td>
                                                        <td><?php echo $ProjectLegalName['BuilderContact']['builder_contact_name']; ?></td>
                                                        <td><?php echo $ProjectLegalName['BuilderLegalName']['builder_legal_names_name']; ?></td>
                                                        <td><?php echo $ProjectLegalName['Location']['city_name']; ?></td>
                                                        <td><?php echo $ProjectLegalName['BuilderLegalName']['builder_legal_names_address']; ?></td>


                                                        <td>
                                                            <?php
                                                            if ($ProjectLegalName['ProjectLegalName']['project_legal_names_approved'] == 1) {

                                                                echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'builder_contacts', 'action' => 'edit', 'slug' => $ProjectLegalName['BuilderLegalName']['builder_legal_names_name'] . '-' . $ProjectLegalName['Location']['city_name'], 'id' => base64_encode($id)), array('class' => 'open-popup-link add-btn act-ico', 'escape' => false));
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>

                                                <?php
                                            else:
                                                echo '<tr><td colspan="7" class="norecords">No Records Found</td></tr>';

                                            endif;
                                            ?>

                                        </tbody>   
                                    </table></div>

                            </div>
                        </div>
                    </fieldset>





                    <?php echo $this->Form->end(); ?>
<!--<div class="actions clearfix"><ul aria-label="Pagination" role="menu"><li class="last_step" style="display: block;" aria-hidden="false"><?php echo $this->Form->button('Update', array('class' => 'btn btn-success sticky_success', 'id' => 'update_buttn')); ?> </li></ul></div>-->
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
        var ProjectStpes = $('#ProjectStpes').val();
        $('#' + ProjectStpes).click();

        var FULL_BASE_URL = $('#hidden_site_baseurl').val();

        $('#update_buttn').click(function() {
            $('#wizard_b').submit();
        });

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

        $('#ProjectProjAreaofland').change(function(event) {
            this.value = parseFloat(this.value).toFixed(2);
            //  this.value = this.value.replace (/(\.\d\d)\d+|([\d.]*)[^\d.]/, '$1$2');
        });
        $('#ProjectProjDistancefromcentrallandmark').change(function(event) {
            this.value = parseFloat(this.value).toFixed(2);
            //  this.value = this.value.replace (/(\.\d\d)\d+|([\d.]*)[^\d.]/, '$1$2');
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