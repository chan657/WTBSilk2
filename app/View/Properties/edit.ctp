<?php
$this->Html->addCrumb('Edit Property', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Edit Property</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('Property', array('enctype' => 'multipart/form-data','method' => 'post', 'id' => 'wizard_a', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
                    echo $this->Form->hidden('prop_picture_1', array('value' => $this->data['Property']['prop_picture_1']));
                    echo $this->Form->hidden('prop_picture_2', array('value' => $this->data['Property']['prop_picture_2']));
                    echo $this->Form->hidden('prop_picture_3', array('value' => $this->data['Property']['prop_picture_3']));
                    echo $this->Form->hidden('prop_picture_4', array('value' => $this->data['Property']['prop_picture_4']));
                    echo $this->Form->hidden('prop_picture_5', array('value' => $this->data['Property']['prop_picture_5']));
                    ?>

                    <h4>Primary Information</h4>
                    <fieldset class="nopdng">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <h4>Property Basic Information</h4>

                                    <div class="form-group ">
                                        <label for="reg_input_name" class="req">City</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('city_id', array('options' => $city, 'empty' => '--Select--',));
                                            ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="input_name" class="req">Property Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_name', array());
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Source From</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_sourced_from', array('options' => $prop_sourced_from, 'empty' => '--Select--')); ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Suburb</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('suburb_id', array('options' => array(), 'empty' => '--Select--',)); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Neighborhood</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('neighborhood'); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Type</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_type', array('options' => $types, 'empty' => '--Select--')); ?></div>
                                    </div>
                                    <div class="form-group int-sm">
                                        <label>Buildup Area</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">  <?php
                                            echo $this->Form->input('prop_builtup_area', array('class' => 'form-control sm rgt', 'tabindex' => '19', 'type' => 'text'));
                                            echo $this->Form->input('proj_landoption', array('label' => false, 'options' => array('Square Foots' => 'Square Foots'),'default' => 'Square Foots', 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Property Age</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_age', array('options' => $prop_age, 'empty' => '--Select--', 'class' => 'form-control', 'tabindex' => '8')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Floor No.</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_floor'); ?></div>
                                    </div>
                                    <div class="form-group ">
                                        <label>Facing</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_facing', array('options' => $prop_facing, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="reg_input_name" class="req">Bathroom</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_bathrooms');
                                            ?>
                                        </div>
                                    </div>





                                </div>

                                <div class="col-sm-6">
                                    <h4>&nbsp;</h4>

                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Owner Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('owner_id', array('options' => $owners, 'empty' => '--Select--', 'class' => 'form-control', 'onchange' => 'filterPreferences(this.value,\'ProjectSecondaryBuilderId\',\'ProjectTertiaryBuilderId\')', 'tabindex' => '8')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Consultant Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('consultant_id', array('options' => $consultants, 'empty' => '--Select--', 'class' => 'form-control', 'onchange' => 'filterPreferences(this.value,\'ProjectSecondaryBuilderId\',\'ProjectTertiaryBuilderId\')', 'tabindex' => '8')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Sourced For</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_sourced_for', array('options' => $prop_sourced_for, 'empty' => '--Select--')); ?></div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="reg_input_name" class="req">Area</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('area_id', array('options' => array(), 'empty' => '--Select--',));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label>Unit Type</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_unit_type', array('options' => $unit_type, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label >Category</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_category', array('options' => array(), 'empty' => '--Select--')); ?></div>
                                    </div>



                                    <div class="form-group int-sm">
                                        <label>Carpet Area</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">  <?php
                                            echo $this->Form->input('prop_carpet_area', array('class' => 'form-control sm rgt', 'tabindex' => '19', 'type' => 'text'));
                                            echo $this->Form->input('proj_landoption', array('label' => false, 'options' => array('Square Foots' => 'Square Foots'),'default' => 'Square Foots', 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Ownership Structure</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_ownership', array('options' => $prop_ownership, 'empty' => '--Select--', 'class' => 'form-control', 'tabindex' => '8')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Total No. Of Floor</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_total_floors'); ?></div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="reg_input_name" class="req">Furnishing</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_furnishing', array('options' => $prop_furnishing, 'empty' => '--Select--',));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label>Parking</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_parking');
                                            ?></div>
                                    </div>





                                </div>
                                <br class="spacer" />
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Property Address</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('prop_exact_address', array('type' => 'textarea'));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Property Description</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('prop_description', array('type' => 'textarea'));
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Remarks</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('prop_otheremarks', array('type' => 'textarea'));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <h4>Property Details</h4>
                    <fieldset class="nopdng">
                        <div class="row">
                            <div class="col-sm-12">

                                <h4>Property Information</h4>
                                <div class="col-sm-6">







                                    <div class="form-group ">
                                        <label>PSF</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_psf');
                                            ?></div>
                                    </div>
                                    <div class="form-group ">
                                        <label>RSF</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_rsf');
                                            ?></div>
                                    </div>
                                    <div class="form-group ">
                                        <label>Rent Deposit</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_rental_deposit');
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Availability</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_availability', array('options' => $prop_availability, 'empty' => '--Select--')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Distance Option</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_distanceoption'); ?></div>
                                    </div>

                                </div>
                                <div class="col-sm-6">








                                    <div class="form-group int-sm">
                                        <label>Total Price</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                             echo $this->Form->input('prop_builtup_area', array('class' => 'form-control sm rgt', 'tabindex' => '19', 'type' => 'text'));
                                            echo $this->Form->input('prop_total_price', array('label' => false, 'options' => array('Lakhs' => 'Lakhs','Crores' => 'Crores'), 'empty' => '--Select--'));
                                            
                                            ?></div>
                                    </div>

                                    <div class="form-group int-sm">
                                        <label>Total Rent</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                             echo $this->Form->input('prop_builtup_area', array('class' => 'form-control sm rgt', 'tabindex' => '19', 'type' => 'text'));
                                            echo $this->Form->input('prop_total_rent', array('label' => false, 'options' => array('Thousand' => 'Thousand','Lakhs' => 'Lakhs'), 'empty' => '--Select--'));
                                       
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Negotiable</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_negotiable', array('options' => $prop_negotiable, 'empty' => '--Select--')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nearest Landmark</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_nearlandmark'); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Distance From C/L</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_distancefromcentrallandmark'); ?></div>
                                    </div>

                                </div>
                                <h4>Commission</h4>
                                <div class="col-sm-6">
                                    <div class="form-group ">
                                        <label>Commission Event</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_commission_event', array('options' => $prop_commission_event, 'empty' => '--Select--'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Based On</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_commission_based_on', array('options' => $prop_commission_based_on, 'empty' => '--Select--')); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_commission_amount'); ?></div>
                                    </div>







                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Type</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_commission_type', array('options' => $prop_commission_type, 'empty' => '--Select--')); ?></div>
                                    </div>
                                    <div class="form-group percsym">
                                        <label>Commission %  </label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"><div class="input-group"><?php echo $this->Form->input('prop_commission_percents', array('tabindex' => '17')); ?><span class="input-group-addon">%</span></div></div>
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <label for="reg_input_name" class="req">Commission Rent</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_commission_rentx', array('options' => $prop_commission_rentx, 'empty' => '--Select--')); ?></div>
                                    </div>



                                </div>
                                <div style="clear: both;"></div>
                                <h4>Ratings</h4>
                                <div class="col-sm-6">


                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Overall</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_rating_overall'); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Value For Money</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_rating_value_for_money'); ?></div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="reg_input_name" class="req">Neighbor Hood</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_rating_neighborhood');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label>Roads</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_rating_roads');
                                            ?></div>
                                    </div>

                                    <div class="form-group ">
                                        <label>Safety</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_rating_safety');
                                            ?></div>
                                    </div>

                                    <div class="form-group ">
                                        <label>Cleanliness</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_rating_cleanliness');
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Markets</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_rating_markets'); ?></div>
                                    </div>

                                </div>

                                <div class="col-sm-6">


                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Public Transport</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_rating_public_transport'); ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Parking</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_rating_parking'); ?></div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="reg_input_name" class="req">Connectivity</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_rating_connectivity');
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label>Traffic</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_rating_traffic');
                                            ?></div>
                                    </div>

                                    <div class="form-group ">
                                        <label>Schools</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_rating_schools');
                                            ?></div>
                                    </div>

                                    <div class="form-group ">
                                        <label>Restaurants</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('prop_rating_restaurants');
                                            ?></div>
                                    </div>

                                    <div class="form-group">
                                        <label>Hospitals</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10"> <?php echo $this->Form->input('prop_rating_hospitals'); ?></div>
                                    </div>

                                </div>

                                <div style="clear: both;"></div>
                                <h4>Upload Pictures</h4>       
                                <div class="form-group">
                                    <label>Pictures</label>
                                    <span class="colon">:</span>
                                    <div class="col-sm-10 editable txtbox">
                                        <div class="row" id="fr-select">
                                            <div class="col-sm-6 uploadfile">
                                               
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
                                                        
                                                        <?php 
                                                    
                                                      if ($this->data['Property']['prop_picture_1']) {
                                                                 $imagePath = $this->webroot . 'uploads/properties';
                                                                    //$imagePath = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . '/uploads/properties';
                                                                    $image1 = $imagePath . '/' . $this->data['Property']['prop_picture_1'];
                                                                } else {
                                                                    $image1 = $this->webroot . "img/no_img_180.png";
                                                                }
                                                                $htmlAttributes = array(
                                                                    'alt' => $this->data['Property']['prop_name'],
                                                                    'class' => ""
                                                                );
                                                              //  echo  $this->Image->resize($image1, 80, 50, true, true, array(), true, array(), false, false);
                                                    
                                                 ?>
                                                        <img src="<?php echo $image1; ?>" height="200" width="170" />
                                                  
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px"></div>
                                                    <div>
                                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[Property][image1]" />
                                                           
                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
                                                
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
                                                        
                                                        <?php 
                                                    
                                                      if ($this->data['Property']['prop_picture_2']) {
                                                                 $imagePath = $this->webroot . 'uploads/properties';
                                                                    //$imagePath = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . '/uploads/properties';
                                                                    $image2 = $imagePath . '/' . $this->data['Property']['prop_picture_2'];
                                                                } else {
                                                                    $image2 = $this->webroot . "img/no_img_180.png";
                                                                }
                                                                $htmlAttributes = array(
                                                                    'alt' => $this->data['Property']['prop_name'],
                                                                    'class' => ""
                                                                );
                                                              //  echo  $this->Image->resize($image1, 80, 50, true, true, array(), true, array(), false, false);
                                                    
                                                 ?>
                                                        <img src="<?php echo $image2; ?>" height="200" width="170" />
                                                    
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px"></div>
                                                    <div>
                                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[Property][image2]" />
                                                        
                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
                                                
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
                                                        
                                                        <?php 
                                                    
                                                      if ($this->data['Property']['prop_picture_3']) {
                                                                 $imagePath = $this->webroot . 'uploads/properties';
                                                                    //$imagePath = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . '/uploads/properties';
                                                                    $image3 = $imagePath . '/' . $this->data['Property']['prop_picture_3'];
                                                                } else {
                                                                    $image3 = $this->webroot . "img/no_img_180.png";
                                                                }
                                                                $htmlAttributes = array(
                                                                    'alt' => $this->data['Property']['prop_name'],
                                                                    'class' => ""
                                                                );
                                                              //  echo  $this->Image->resize($image1, 80, 50, true, true, array(), true, array(), false, false);
                                                    
                                                 ?>
                                                        <img src="<?php echo $image3; ?>" height="200" width="170" />
                                                    
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px"></div>
                                                    <div>
                                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[Property][image3]" />
                                                        
                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
                                                
                                            

                                            </div>
                                            <div class="col-sm-6 uploadfile">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
                                                        
                                                        <?php 
                                                    
                                                      if ($this->data['Property']['prop_picture_4']) {
                                                                 $imagePath = $this->webroot . 'uploads/properties';
                                                                    //$imagePath = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . '/uploads/properties';
                                                                    $image4 = $imagePath . '/' . $this->data['Property']['prop_picture_4'];
                                                                } else {
                                                                    $image4 = $this->webroot . "img/no_img_180.png";
                                                                }
                                                                $htmlAttributes = array(
                                                                    'alt' => $this->data['Property']['prop_name'],
                                                                    'class' => ""
                                                                );
                                                              //  echo  $this->Image->resize($image1, 80, 50, true, true, array(), true, array(), false, false);
                                                    
                                                 ?>
                                                        <img src="<?php echo $image4; ?>" height="200" width="170" />
                                                    
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px"></div>
                                                    <div>
                                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[Property][image4]" />
                                                        
                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
                                                        <?php 
                                                    
                                                      if ($this->data['Property']['prop_picture_5']) {
                                                                 $imagePath = $this->webroot . 'uploads/properties';
                                                                    //$imagePath = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . '/uploads/properties';
                                                                    $image5 = $imagePath . '/' . $this->data['Property']['prop_picture_5'];
                                                                } else {
                                                                    $image5 = $this->webroot . "img/no_img_180.png";
                                                                }
                                                                $htmlAttributes = array(
                                                                    'alt' => $this->data['Property']['prop_name'],
                                                                    'class' => ""
                                                                );
                                                              //  echo  $this->Image->resize($image1, 80, 50, true, true, array(), true, array(), false, false);
                                                    
                                                 ?>
                                                        <img src="<?php echo $image5; ?>" height="200" width="170" />
                                                    
                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px"></div>
                                                    <div>
                                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[Property][image5]" />
                                                        
                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>

                                            </div>
                                          
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


$this->Js->get('#PropertyCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_suburb_by_city/Property/city_id'
                ), array(
            'update' => '#PropertySuburbId',
            'async' => true,
            'before' => 'loading("PropertySuburbId")',
            'complete' => 'loaded("PropertySuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#PropertySuburbId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_area_by_suburb/Property/suburb_id'
                ), array(
            'update' => '#PropertyAreaId',
            'async' => true,
            'before' => 'loading("PropertyAreaId")',
            'complete' => 'loaded("PropertyAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#PropertyPropType')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_property_category_by_type_id/Property/prop_type'
                ), array(
            'update' => '#PropertyPropCategory',
            'async' => true,
            'before' => 'loading("PropertyPropCategory")',
            'complete' => 'loaded("PropertyPropCategory")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

?>
