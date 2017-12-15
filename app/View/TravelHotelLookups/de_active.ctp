<?php
$this->Html->addCrumb('Activate / Deactivate Hotel', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('TravelHotelLookup', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));

echo $this->Form->hidden('brand_hq_city_name');
echo $this->Form->hidden('brand_country_name');
echo $this->Form->hidden('brand_chain_name');
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Activate / Deactivate Hotel</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Activate / Deactivate Hotel</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                <div class="form-group">
                            <label for="reg_input_name" class="req" style="margin-left: 13px;">Choose Action</label>
                            <span class="colon">:</span>
                            <div class="col-sm-4"><?php
                                echo $this->Form->input('active', array('options' => array('TRUE' => 'Activate', 'FALSE' => 'Deactivate'), 'empty' => '--Select--', 'disabled' => $Types, 'selected' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                    </div>
                <div class="col-sm-12 toggle" style="display: none;">
                     <div class="col-sm-6">
                                    
                                    <div class="form-group">
                                        <label for="input_name">Hotel Name</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('hotel_name', array('readonly' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Continent</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'disabled' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Province</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('province_id', array('options' => $Provinces, 'empty' => '--Select--', 'disabled' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Suburb</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('suburb_id', array('options' => $TravelSuburbs, 'empty' => '--Select--', 'disabled' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Chain</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('chain_id', array('options' => $TravelChains, 'empty' => '--Select--', 'disabled' => 'true'));
                                            ?></div>
                                    </div>
                                    
                                    
                                    

                                    <div class="form-group">
                                        <label for="input_name">Hotel Url</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('url_hotel', array('readonly' => true));
                                            ?></div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="input_name">Post Code</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('post_code', array('readonly' => true));
                                            ?></div>
                                    </div> 
                                    <div class="form-group">
                                        <label for="input_name">Hotel Group</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('hotel_group', array('readonly' => true));
                                            ?></div>
                                    </div>                                  


                                </div>
                    <div class="col-sm-6">
                                   
                                    <div class="form-group">
                                        <label for="input_name">Hotel Code</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('hotel_code', array('readonly' => true));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Country</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'disabled' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">City</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('city_id', array('options' => $TravelCities, 'empty' => '--Select--', 'disabled' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Area</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('area_id', array('options' => $TravelAreas, 'empty' => '--Select--', 'disabled' => 'true'));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="reg_input_name">Brand</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('brand_id', array('options' => $TravelBrands, 'empty' => '--Select--', 'disabled' => 'true'));
                                            ?></div>
                                    </div>
                                                                       

                                    <div class="form-group">
                                        <label for="reg_input_name">Star</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            $options = array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7');
                                            $attributes = array('legend' => false, 'hiddenField' => false, 'label' => false, 'div' => false, 'class' => 'attrInputs','disabled' => true);
                                            echo $this->Form->radio('star', $options, $attributes);
                                            //  echo $this->Form->input('star');
                                            ?></div>
                                    </div>
                                    <div class="form-group int-sm">
                                        <label>Location</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">  <?php
                                            echo $this->Form->input('gps_prm_1', array('class' => 'form-control decimal','placeholder' => 'GPS Parameter 1','style' => 'width:47%','readonly' => true));
                                            echo $this->Form->input('gps_prm_2', array('class' => 'form-control decimal','placeholder' => 'GPS Parameter 2','style' => 'width:47%','readonly' => true));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input_name">No. Of Rooms</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('no_room', array('readonly' => true));
                                            ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input_name">Top Hotel</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            $options = array('TRUE' => 'True', 'FALSE' => 'False');
                                            $attributes = array('legend' => false, 'hiddenField' => false, 'label' => false, 'div' => false, 'class' => 'attrInputs','disabled' => true);
                                            echo $this->Form->radio('top_hotel', $options, $attributes);
                                            ?>
                                        </div>
                                    </div>                                                             

                                </div>
                    <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('address', array('type' => 'textarea','readonly' => true));
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Description</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10 editable txtbox">
                                            <?php
                                            echo $this->Form->input('hotel_comment', array('type' => 'textarea','readonly' => true,'style' => 'width:100%;height:100px'));
                                            ?>
                                        </div>
                                    </div>
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
<script>
    $("#TravelHotelLookupActive").change(function(){
        $(".toggle").toggle();
    });
</script>

 

