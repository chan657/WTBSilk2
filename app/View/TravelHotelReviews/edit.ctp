<?php
$this->Html->addCrumb('Edit Hotel', 'javascript:void(0);', array('class' => 'breadcrumblast'));
if($actio_itme_id <> '')
    $screen = '7';
else 
    $screen = '1';


?>

    <div align="center" valign="center" class="col-sm-12" style="font-size: 15px; font-family: sans-serif" >
        <p style="color: black; background-color: #ffff42">
        <?php echo $is_service; ?>
        </p>
    </div> 




<div class="col-sm-12" id="mycl-det">
    <div class="table-heading">
        <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Open New Ticket', '/support_tickets/add/'.$screen.'/'.$this->data['TravelHotelLookup']['id'],array('class' => 'act-ico open-popup-link add-btn','escape' => false,'data-placement' => "left", 'title' => "Create New Ticket",'data-toggle' => "tooltip")) ?></span>
    </div>
    <div class="panel panel-default">

        <div class="panel-body">
          
            <fieldset>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('TravelHotelLookup', array('enctype' => 'multipart/form-data', 'method' => 'post', 'id' => 'wizard_b', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',

                        ) 
                    ));

                    echo $this->Form->hidden('action_type', array('value' => '0', 'id' => 'ActionType'));
                    
                    echo $this->Form->hidden('hotel_img1', array('value' => $this->data['TravelHotelLookup']['hotel_img1']));
                    echo $this->Form->hidden('hotel_img2', array('value' => $this->data['TravelHotelLookup']['hotel_img2']));
                    echo $this->Form->hidden('hotel_img3', array('value' => $this->data['TravelHotelLookup']['hotel_img3']));
                    echo $this->Form->hidden('hotel_img4', array('value' => $this->data['TravelHotelLookup']['hotel_img4']));
                    echo $this->Form->hidden('hotel_img5', array('value' => $this->data['TravelHotelLookup']['hotel_img5']));
                    echo $this->Form->hidden('hotel_img6', array('value' => $this->data['TravelHotelLookup']['hotel_img6']));
                    echo $this->Form->hidden('logo', array('value' => $this->data['TravelHotelLookup']['logo']));
                    echo $this->Form->hidden('logo1', array('value' => $this->data['TravelHotelLookup']['logo1']));

                    //echo $this->Form->hidden('continent_name');
                    //echo $this->Form->hidden('continent_code');
                    //echo $this->Form->hidden('country_code');
                    //echo $this->Form->hidden('country_name');
                    echo $this->Form->hidden('city_name');
                    echo $this->Form->hidden('suburb_name');
                    echo $this->Form->hidden('area_name');
                    echo $this->Form->hidden('chain_name');
                    echo $this->Form->hidden('brand_name');
                    echo $this->Form->hidden('city_code');
                    //echo $this->Form->hidden('province_name');

                    $dataShow = 	$this->request->data;
                    
                    ?>

						<div class="row" >
							<div class="col-sm-12">
								<h4 align="center"><strong><?php echo $dataShow['TravelHotelLookup']['hotel_name']?></strong></h4>
								<h4 align="center"><strong>(Hotel Id: <?php echo $dataShow['TravelHotelLookup']['id']?>) / (Hotel Code: <?php echo $dataShow['TravelHotelLookup']['hotel_code']?>)</strong></h4>                                                                
								<h5 align="center"><?php echo "Location: ".$dataShow['TravelHotelLookup']['continent_name']." / ".$dataShow['TravelHotelLookup']['country_name']." / ".$dataShow['TravelHotelLookup']['province_name']." / ".$dataShow['TravelHotelLookup']['city_name']?></h5>
								<h5 align="center"><?php echo "Address: ".$dataShow['TravelHotelLookup']['address']?></h5>                                                                
							</div>
						</div>  




















                    <h4>Amenity Information</h4>
                    <fieldset class="nopdng">

                            <div align="center" valign="center" class="col-sm-12">
                                <p>
                                <h2>Amenity Information</h2><br>
                                </p>
                            </div>                         
                        
                        <div class="row">

                            <div class="col-sm-12">

                                <div class="row form-wrap">

                                    <div class="col-sm-12">
                                        <?php
//	pr($amenity);  
                                       
                                        if (count($categories) && !empty($categories)) {
                                            foreach ($categories as $val) {
                                                ?>
                                                <h4><?php echo $val['TravelLookupAmenityCategorie']['value']; ?></h4>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="checkbox five-column"><?php foreach ($val['Hotel_Amenity'] as $amenities) { ?>
                                                                <div class="list-checkbox">
                                                                    <input type="checkbox" id="TravelHotelAmenitieAmenityTypeId" value="<?php echo $amenities['id'] ?>" <?php if (in_array($amenities['id'], $amenity)) { ?> checked="checked" <?php } ?> class="form-control" name="data[TravelHotelAmenitie][amenity_type_id][]">	
                                                                    <label for="TravelHotelAmenitieAmenityTypeId">	<?php echo $amenities['value'] ?></label>
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
                                /*echo $this->Form->submit('Submit', array('class' => 'btn btn-success sticky_success'));*/
                                echo $this->Form->button('Next',array(
                                        'type' => 'button',
                                        'class' => 'btn btn-danger nextLink',
                                        'nextId' => 'steps-uid-1-t-1'
                                    ));
                                ?>
                            </div>



                        </div>
                    </fieldset>

                    <h4>Hotel Review Information</h4>
                    <fieldset class="nopdng">

                            <div align="center" valign="center" class="col-sm-12">
                                <p>
                                <h2>Hotel Review Information</h2><br>
                                </p>
                            </div>  
                        
                        <div class="row">

                            <div class="col-sm-12">

                                <div class="row form-wrap">

                                    <div class="col-sm-12" align="center">
                                        <?php
//	pr($amenity);  
                                        if (count($reviewtopics) && !empty($reviewtopics)) {
                                            foreach ($reviewtopics as $reviewtopic) {                                            
                                                ?>
												<hr>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="checkbox one-column">
                                                            <div class="list-checkbox">
                                                                    <input type="checkbox" id="TravelHotelReviewItemReviewTopicId" value="<?php echo $reviewtopic['TravelLookupReviewTopic']['id'] ?>" <?php if (in_array($reviewtopic['TravelLookupReviewTopic']['id'], $reviewlist)) { ?> checked="checked" <?php } ?> class="form-control" name="data[TravelHotelReviewItem][review_topic_id][]">
                                                                    <label for="TravelHotelReviewItemReviewTopicId">	<?php echo $reviewtopic['TravelLookupReviewTopic']['value'] ?></label>
                                                                </div> 
                                                            <?php foreach ($review as $reviews) {  
                                                                $value_review_score = '0.0';
                                                                $value_no_of_reviews = '0';															
                                                                if ($reviewtopic['TravelLookupReviewTopic']['id'] ==  $reviews['TravelHotelReviewItem']['review_topic_id']) { 
                                                                    $value_review_score = $reviews['TravelHotelReviewItem']['review_score'];
                                                                    $value_no_of_reviews = $reviews['TravelHotelReviewItem']['no_of_reviews'];
																	break;
                                                                }
															}	
                                                            ?>																
                                                            <div>
                                                                <label for="TravelHotelReviewItemReviewScore" >Review Score :</label>
																<span  style ="vertical-align:middle">
                                                                <div class="col-sm-1">
                                                                    <input type="textbox" size="15" id="TravelHotelReviewItemReviewScore" value="<?php echo $value_review_score ?>" class="form-control convertReviewScore" name="data[TravelHotelReviewItem][review_score][]">
                                                                </div>
																</span>
                                                            </div> 
                                                            <div>
                                                                <label for="TravelHotelReviewItemNoOfReviews" >No of Reviews :</label>
																<span  style = "vertical-align:middle">
                                                                <div class="col-sm-1">
                                                                    <input type="textbox" size="15" id="TravelHotelReviewItemNoOfReviews" value="<?php echo $value_no_of_reviews ?>" class="form-control" name="data[TravelHotelReviewItem][no_of_reviews][]">
                                                                </div>
																</span>
                                                            </div>                                                          
                                                        </div>
                                                    </div>
													<hr>
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
                               /* echo $this->Form->submit('Submit', array('class' => 'btn btn-success sticky_success'));*/
                               echo $this->Form->button('Prev',array(
                                    'type' => 'button',
                                    'class' => 'btn btn-success prevLink',
                                    'prevId' => 'steps-uid-1-t-0'
                                )); 
                                ?>
                             </div>
                             <div class="col-sm-1">
                             <?php
                               echo $this->Form->button('Next',array(
                                    'type' => 'button',
                                    'class' => 'btn btn-danger nextLink',
                                    'nextId' => 'steps-uid-1-t-2'
                                ));
                                ?>
                            </div>



                        </div>
                    </fieldset>
                    
                    <h4>Other Information</h4>
                    <fieldset class="nopdng">   

                            <div align="center" valign="center" class="col-sm-12">
                                <p>
                                <h2>Other Information</h2><br>
                                </p>
                            </div> 
                                                
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="input_name" class="req">Hotel Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('hotel_name', array('data-required' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Former Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('hotel_former_name', array());
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
                                            echo $this->Form->input('chain_id', array('options' => $TravelChains, 'empty' => '--Select--', 'data-required' => 'false'));
                                            ?></div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Zip Code</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('post_code', array());
                                            ?></div>
                                    </div>                                                                                                                            
                                

                                </div>




                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="input_name" class="req">Display Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('hotel_display_name', array());
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Property Type</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('property_type', array('options' => $TravelLookupPropertyTypes, 'empty' => '--Select--', 'data-required' => 'true'));
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
                                            echo $this->Form->input('brand_id', array('options' => $TravelBrands, 'empty' => '--Select--', 'data-required' => 'false'));
                                            ?></div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="reg_input_name" class="req">Star</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                                $options = array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7');
                                                $attributes = array('legend' => false, 'hiddenField' => false, 'label' => false, 'div' => false, 'class' => 'attrInputs');
                                                echo $this->Form->radio('star', $options, $attributes);
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

                                                    <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->button('Prev',array(
                                    'type' =>'button',
                                    'class' => 'btn btn-success prevLink',
                                    'prevId' => 'steps-uid-1-t-1'
                                ));
                                ?>
                            </div>
                            <div class="col-sm-1">
                               <?php
                                echo $this->Form->submit('Submit', array('class' => 'btn btn-danger sticky_success'));
                                ?>
                                <!--<button type="submit" id="update_buttn" disabled="disabled" class="btn btn-success sticky_success">Update</button>-->

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
$data = $this->Js->get('#wizard_b')->serializeForm(array('isForm' => true, 'inline' => true));

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
    });
    // click on next link
    $(document).on('click','.nextLink',function() {
        var nextLinkedDivId = $(this).attr('nextId');
        $("#"+nextLinkedDivId).click();
    });
    $(document).on('click','.prevLink',function() {
        var prevLinkDivId = $(this).attr('prevId');
        $("#"+prevLinkDivId).click();
    });
    $(".convertReviewScore").blur(function() {
        var currentValue = parseFloat($(this).val());
        if(currentValue != '' || currentValue !=0) {
            $(this).val(currentValue.toFixed(1));
        }

    });


    });





















</script>    

