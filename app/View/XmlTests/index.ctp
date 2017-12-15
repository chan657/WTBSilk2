<?php
$this->Html->addCrumb('XML Test', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('Test', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
));
echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">XML Test</h4>
        </div>
        <div class="panel-body">
           
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="reg_input_name" class="req"  style="margin-left: 14px;">Mapping Type</label>
                        <span class="colon">:</span>
                        <div class="col-sm-4">
                            <?php
                            echo $this->Form->input('mapping_type',array('id' => 'mapping_type','options' => array('1' => 'Mapping Country','2' => 'Mapping City', '3' => 'Mapping Hotel'),'empty' => '--select--'));
                            ?></div>
                    </div>
                </div>
                <div class="col-sm-12" id="country" style="display: none;">
                    <div class="col-sm-6">
                       
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('country_supplier_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">SUPP Country Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('supplier_country_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Active</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('country_active');
                                ?></div>
                        </div>

                    </div>
                    <div class="col-sm-6">

                         <div class="form-group">
                            <label for="reg_input_name" class="req">Country Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('pf_country_code');
                                ?></div>
                        </div>
                      
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Exclude</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('country_exclude');
                                ?></div>
                        </div>
                       
                    
                    </div>
                </div>
                <div class="col-sm-12" id="city" style="display: none;">
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_supplier_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">City Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('pf_city_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">SUPP Country Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('supplier_city_country_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Active</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_active');
                                ?></div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                       
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_country_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">SUPP City Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('supplier_city_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Exclude</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_exclude');
                                ?></div>
                        </div>
                    </div>
                </div>
                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12" id="hotel" style="display: none;">
                    <div class="col-sm-6">
                      
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_supplier_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">City Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_city_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">SUPP City Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_supplier_hotel_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">SUPP Hotel Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_supplier_city_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Active</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_active');
                                ?></div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                      
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_country_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Hotel Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">SUPP Country Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_supplier_country_code');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Exclude</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('hotel_exclude');
                                ?></div>
                        </div>
                    </div>
                </div>
                 <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-1">
                            <?php
                            echo $this->Form->submit('Add', array('class' => 'btn btn-success sticky_success'));
                            ?>
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
    $('#mapping_type').change(function(){
        var value = $(this).val();
        if(value == '1'){
            $('#country').css('display','block');
            $('#city').css('display','none');
            $('#hotel').css('display','none');
        }
        else if(value == '2'){
            $('#city').css('display','block');
            $('#country').css('display','none');
            $('#hotel').css('display','none');
        }
        else if(value == '3'){
            $('#hotel').css('display','block');
            $('#country').css('display','none');
            $('#city').css('display','none');
        }
    });
</script>

