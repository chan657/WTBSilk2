<?php
$this->Html->addCrumb('Edit Hotel', 'javascript:void(0);', array('class' => 'breadcrumblast'));

?>
    <div align="center" class="col-sm-12" style="font-size: 15px; font-family: sans-serif">
        <p style="color: black; background-color: #ffff42">
        <?php echo $is_service; ?>
        </p>
    </div> 
<div class="col-sm-12" id="mycl-det">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Edit Hotel</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('TravelHotelLookup', array('enctype' => 'multipart/form-data', 'method' => 'post', 'id' => 'wizard_b','onsubmit' => 'return imageValidate()', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                            
                        )
                    ));
                    echo $this->Form->hidden('full_img1', array('value' => $this->data['TravelHotelLookup']['full_img1']));
                    echo $this->Form->hidden('full_img2', array('value' => $this->data['TravelHotelLookup']['full_img2']));
                    echo $this->Form->hidden('full_img3', array('value' => $this->data['TravelHotelLookup']['full_img3']));
                    echo $this->Form->hidden('full_img4', array('value' => $this->data['TravelHotelLookup']['full_img4']));
                    echo $this->Form->hidden('full_img5', array('value' => $this->data['TravelHotelLookup']['full_img5']));
                    echo $this->Form->hidden('full_img6', array('value' => $this->data['TravelHotelLookup']['full_img6']));
                    echo $this->Form->hidden('thumb_img1', array('value' => $this->data['TravelHotelLookup']['thumb_img1']));
                    echo $this->Form->hidden('thumb_img2', array('value' => $this->data['TravelHotelLookup']['thumb_img2']));
                    echo $this->Form->hidden('thumb_img3', array('value' => $this->data['TravelHotelLookup']['thumb_img3']));
                    echo $this->Form->hidden('thumb_img4', array('value' => $this->data['TravelHotelLookup']['thumb_img4']));
                    echo $this->Form->hidden('thumb_img5', array('value' => $this->data['TravelHotelLookup']['thumb_img5']));
                    echo $this->Form->hidden('thumb_img6', array('value' => $this->data['TravelHotelLookup']['thumb_img6']));
                    //echo $this->Form->hidden('continent_name');
                    //echo $this->Form->hidden('continent_code');
                    //echo $this->Form->hidden('country_code');
                    echo $this->Form->hidden('country_name');
                    echo $this->Form->hidden('city_name');
                    echo $this->Form->hidden('suburb_name');
                    echo $this->Form->hidden('area_name');
                    echo $this->Form->hidden('chain_name');
                    echo $this->Form->hidden('brand_name');
                    echo $this->Form->hidden('city_code');
                    //echo $this->Form->hidden('province_name');
					
				$dataShow = 	$this->request->data;
                    ?>

                    <style>
					.btn{
						    width: 110px;
					}
					#main_content{
						    margin-left: 20px;
					}
					label{
						width: 100% !important;
						text-align: center;
					}
					.fileupload{
						    text-align: center;
					}
					</style>
                    <fieldset class="nopdng">
						<div class="row" >
							<div class="col-sm-12">
								<h4 align="center"><strong><?php echo $dataShow['TravelHotelLookup']['hotel_name']?> (Hotel Code: <?php echo $dataShow['TravelHotelLookup']['hotel_code']?>)</strong></h4>
								<h5 align="center"><?php echo $dataShow['TravelHotelLookup']['address']?></h5>
							</div>
						</div>
					
                        <div class="row" style="display:none">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <h4>Hotel Basic Information</h4>
                                    <div class="form-group">
                                        <label for="input_name" class="req">Hotel Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('hotel_name', array('data-required' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Continent</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'data-required' => 'true','disabled'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Province</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('province_id', array('options' => $Provinces, 'empty' => '--Select--', 'data-required' => 'true','disabled'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Suburb</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('suburb_id', array('options' => $TravelSuburbs, 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Chain</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('chain_id', array('options' => $TravelChains, 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?></div>
                                    </div>                                                                                                                            
                                

                                </div>




                                <div class="col-sm-6">
                                    <h4>&nbsp;</h4>
                                    <div class="form-group">
                                        <label for="input_name" class="req">Hotel Code</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('hotel_code', array('readonly' => true));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Country</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'data-required' => 'true','disabled'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">City</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('city_id', array('options' => $TravelCities, 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Area</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('area_id', array('options' => $TravelAreas, 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Brand</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('brand_id', array('options' => $TravelBrands, 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?></div>
                                    </div>
                                   
                                    <div class="form-group int-sm">
                                        <label>Location</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">  <?php
                                            echo $this->Form->input('gps_prm_1', array('class' => 'form-control decimal','placeholder' => 'GPS Parameter 1','style' => 'width:47%'));
                                            echo $this->Form->input('gps_prm_2', array('class' => 'form-control decimal','placeholder' => 'GPS Parameter 2','style' => 'width:47%'));
                                            ?></div>
                                    </div>                                 
                                                                                                

                                </div></div>
                                <br class="spacer" />
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('address', array('type' => 'textarea'));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('hotel_comment', array('type' => 'textarea','style' => 'width:100%;height:100px'));
                                            ?>
                                        </div>
                                    </div>
                                    
                                    <div style="clear: both;"></div>
				
						</div>
						</div>
                               

                                <div class="row" id="fr-select">
                                    <div class="col-sm-6 uploadfile">
                                        
                                            <div class="col-sm-12 editable txtbox">
                                                <label>Hotel Photo 1 - (FEATURED IMAGE)</label>
                                               
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width:400px;height:300px">
                                                        <?php
                                                        if ($this->data['TravelHotelLookup']['full_img1']) {                                                            
                                                            $image1 = $this->data['TravelHotelLookup']['full_img1'];
                                                        } else {
                                                            $image1 = $this->webroot . "img/no_img_180.png";
                                                        }
                                                        ?>
                                                        <img src="" height="300" width="400" />

                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 400px; height:300px"></div>
                                                    <div>
                                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[TravelHotelLookup][image1]" id="image1" data-require="true" />

                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                      
                                     
                                            <div class="col-sm-12 editable txtbox">
                                                <label>Hotel Photo 3 - (Property Image 2)</label>
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width:400px;height:300px">
                                                        <?php
                                                        if ($this->data['TravelHotelLookup']['full_img3']) {
                                                            
                                                            $image3 = $this->data['TravelHotelLookup']['full_img3'];
                                                        } else {
                                                            $image3 = $this->webroot . "img/no_img_180.png";
                                                        }
                                                        ?>
                                                        <img  height="300" width="400" />

                                                    </div>
                                                  <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 400px; height:300px"></div>
                                                    <div>
                                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[TravelHotelLookup][image3]" id="image3" />

                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
											</div>
                                       
                                            <div class="col-sm-12 editable txtbox">
                                                <label>Hotel Photo 5 - (Facilities Image 1)</label>                                               
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width:400px;height:300px">
                                                        <?php
                                                        if ($this->data['TravelHotelLookup']['full_img5']) {
                                                           
                                                            $image5 = $this->data['TravelHotelLookup']['full_img5'];
                                                        } else {
                                                            $image5 = $this->webroot . "img/no_img_180.png";
                                                        }
                                                        ?>
                                                        <img  height="300" width="400" />

                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 400px; height:300px"></div>
                                                    <div>
                                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[TravelHotelLookup][image5]" id="image5" />

                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                       
                                      
                                        


                                    </div>

                                    <div class="col-sm-6 uploadfile">
                                    
                                            <div class="col-sm-12 editable txtbox">
                                                <label>Hotel Photo 2 - (Property Image 1)</label>                                               
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width:400px;height:300px">

<?php
if ($this->data['TravelHotelLookup']['full_img2']) {
    
    $image2 = $this->data['TravelHotelLookup']['full_img2'];
} else {
    $image2 = $this->webroot . "img/no_img_180.png";
}
?>
                                                        <img  height="300" width="400" /></div>
                                                  <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 400px; height:300px">


                                                    </div>
                                                    <div>
                                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[TravelHotelLookup][image2]" id="image2" />

                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
                                            </div>

                                       
                                            <div class="col-sm-12 editable txtbox">
                                                <label>Hotel Photo 4 - (Property Image 3)</label>                                              
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width:400px;height:300px" >
                                                        <?php
                                                        if ($this->data['TravelHotelLookup']['full_img4']) {
                                                           
                                                            $image4 = $this->data['TravelHotelLookup']['full_img4'];
                                                        } else {
                                                            $image4 = $this->webroot . "img/no_img_180.png";
                                                        }
                                                        ?>
                                                        <img  height="300" width="400" />

                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 400px; height:300px"></div>
                                                    <div>
                                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[TravelHotelLookup][image4]" id="image4" />

                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                       
                                            <div class="col-sm-12 editable txtbox">
                                                <label>Hotel Photo 6 - (Facilities Image 2)</label>                                               
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width:400px;height:300px">
                                                        <?php
                                                        if ($this->data['TravelHotelLookup']['full_img6']) {
                                                            
                                                            $image6 = $this->data['TravelHotelLookup']['full_img6'];
                                                        } else {
                                                            $image6 = $this->webroot . "img/no_img_180.png";
                                                        }
                                                        ?>
                                                        <img  height="300" width="400" />

                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 400px; height:300px"></div>
                                                    <div>
                                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[TravelHotelLookup][image6]" id="image6" />

                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                         
								</div>
			<?php for ($x = 7; $x <= 20; $x++) { 
                                    
                              If ($x == 7) {
                                    $y = '- (Facilities Image 3)';
                              } elseif ($x == 8) {
                                    $y = '- (Facilities Image 4)';                                   
                              } elseif ($x == 9) {
                                    $y = '- (Facilities Image 5)';                                    
                              } elseif ($x == 10) {
                                    $y = '- (Dining Image 1)';                                   
                              } elseif ($x == 11) {
                                    $y = '- (Dining Image 2)';  
                              } elseif ($x == 12) {
                                    $y = '- (Dining Image 3)';                                                                    
                              } elseif ($x == 13) {
                                    $y = '- (Room Image 1)';                                                                    
                              } elseif ($x == 14) {
                                    $y = '- (Room Image 2)';                                                                    
                              } elseif ($x == 15) {
                                    $y = '- (Room Image 3)';                                                                    
                              } elseif ($x == 16) {
                                    $y = '- (Room Image 4)';                                                                    
                              } elseif ($x == 17) {
                                    $y = '- (Room Image 5)';                                  
                              } elseif ($x == 18) {
                                    $y = '- (Other Image 1)';                                  
                              } elseif ($x == 19) {
                                    $y = '- (Other Image 2)';                                  
                              } elseif ($x == 20) {
                                    $y = '- (Other Image 3)';
                              }
                        ?>                
							<div class="col-sm-6 uploadfile">
									
                                            <div class="col-sm-12 editable txtbox">
                                                <label>Hotel Photo <?php echo $x?><?php echo $y?></label>
                                                
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    <div class="fileupload-new img-thumbnail" style="width:400px;height:300px">
                                                        <?php
                                                        if ($this->data['TravelHotelLookup']['full_img'.$x]) {
                                                            
                                                            $image = $this->data['TravelHotelLookup']['full_img'.$x];
                                                        } else {
                                                            $image = $this->webroot . "img/no_img_180.png";
                                                        }
                                                        ?>
                                                        <img  height="300" width="400" />

                                                    </div>
                                                    <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 400px; height:300px"></div>
                                                    <div>
                                                        <span class="btn btn-default btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                                            <input type="file" name="data[TravelHotelLookup][image<?php echo $x?>]" id="image<?php echo $x?>" />

                                                        </span>
                                                        <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                         
								</div>
																			
					<?php } ?>
                                    
                                   
                                   

                                </div>
                                <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit('Submit', array('class' => 'btn btn-success sticky_success'));
                                ?>
                                <!--<button type="submit" id="update_buttn" disabled="disabled" class="btn btn-success sticky_success">Update</button>-->

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
$data = $this->Js->get('#wizard_a')->serializeForm(array('isForm' => true, 'inline' => true));

$this->Js->get('#TravelHotelLookupContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/TravelHotelLookup/continent_id'
                ), array(
            'update' => '#TravelHotelLookupCountryId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupCountryId")',
            'complete' => 'loaded("TravelHotelLookupCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelHotelLookupProvinceId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_province/TravelHotelLookup/province_id'
                ), array(
            'update' => '#TravelHotelLookupCityId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupCityId")',
            'complete' => 'loaded("TravelHotelLookupCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelHotelLookupCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_suburb_by_country_id_and_city_id/TravelHotelLookup/country_id/city_id'
                ), array(
            'update' => '#TravelHotelLookupSuburbId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupSuburbId")',
            'complete' => 'loaded("TravelHotelLookupSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelHotelLookupSuburbId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_area_by_suburb_id/TravelHotelLookup/suburb_id'
                ), array(
            'update' => '#TravelHotelLookupAreaId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupAreaId")',
            'complete' => 'loaded("TravelHotelLookupAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelHotelLookupChainId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_brand_by_chain_id/TravelHotelLookup/chain_id'
                ), array(
            'update' => '#TravelHotelLookupBrandId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupBrandId")',
            'complete' => 'loaded("TravelHotelLookupBrandId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelHotelLookupCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_continent_country/TravelHotelLookup/continent_id/country_id'
                ), array(
            'update' => '#TravelHotelLookupProvinceId',
            'async' => true,
            'before' => 'loading("TravelHotelLookupProvinceId")',
            'complete' => 'loaded("TravelHotelLookupProvinceId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
?>
<script>
    $(document).ready(function() {
        $('#TravelHotelLookupContinentId').change(function() {
            $('#TravelHotelLookupContinentName').val($('#TravelHotelLookupContinentId option:selected').text());
        });
        
        $('#TravelHotelLookupCountryId').change(function() {
            $('#TravelHotelLookupCountryName').val($('#TravelHotelLookupCountryId option:selected').text());
        });
          
        $('#TravelHotelLookupSuburbId').change(function() {
            $('#TravelHotelLookupSuburbName').val($('#TravelHotelLookupSuburbId option:selected').text());
        });
        
        $('#TravelHotelLookupAreaId').change(function() {
            $('#TravelHotelLookupAreaName').val($('#TravelHotelLookupAreaId option:selected').text());
        });
        
        $('#TravelHotelLookupChainId').change(function() {
            $('#TravelHotelLookupChainName').val($('#TravelHotelLookupChainId option:selected').text());
        });
        
        $('#TravelHotelLookupBrandId').change(function() {
            $('#TravelHotelLookupBrandName').val($('#TravelHotelLookupBrandId option:selected').text());
        });
        
        $('#TravelHotelLookupProvinceId').change(function() {
            $('#TravelHotelLookupProvinceName').val($('#TravelHotelLookupProvinceId option:selected').text());
        });
        
        $('.decimal').change(function(event) {        
        this.value = parseFloat(this.value).toFixed(7);
       
    });
    
    $('#TravelHotelLookupCityId').change(function() {
            var str = $('#TravelHotelLookupCityId option:selected').text();
            var res = str.split("-");          
            $('#TravelHotelLookupCityCode').val(res[0]);
            $('#TravelHotelLookupCityName').val(res[1]);
        });
        
        $('#TravelHotelLookupCountryId').change(function() {
            var str = $('#TravelHotelLookupCountryId option:selected').text();
            var res = str.split("-");          
            $('#TravelHotelLookupCountryCode').val(res[0]);
            $('#TravelHotelLookupCountryName').val(res[1]);
        });
        
        $('#TravelHotelLookupContinentId').change(function() {
            var str = $('#TravelHotelLookupContinentId option:selected').text();
            var res = str.split("-");          
            $('#TravelHotelLookupContinentCode').val(res[0]);
            $('#TravelHotelLookupContinentName').val(res[1]);
        });
    
    $('#TravelHotelLookupNoRoom').change(function(event) {
        //alert('asd');
        this.value = parseFloat(this.value).toFixed(0);
        //  this.value = this.value.replace (/(\.\d\d)\d+|([\d.]*)[^\d.]/, '$1$2');
    })
    

    });
    
       function imageValidate(){
       if ($('#image1').get(0).files.length === 0) {
           bootbox.alert('Please select Picture 1 (Featured Image).');
           
            return false;
        }
   } 

</script>    

