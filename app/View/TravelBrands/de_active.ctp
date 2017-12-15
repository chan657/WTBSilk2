<?php
$this->Html->addCrumb('Activate / Deactivate Brand', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('TravelBrand', array('method' => 'post',
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
            <h4 class="panel-title">Activate / Deactivate Brand</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Activate / Deactivate Brand</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                <div class="form-group">
                            <label for="reg_input_name" class="req" style="margin-left: 13px;">Choose Action</label>
                            <span class="colon">:</span>
                            <div class="col-sm-4"><?php
                                echo $this->Form->input('brand_active', array('options' => array('TRUE' => 'Activate', 'FALSE' => 'Deactivate'), 'empty' => '--Select--', 'disabled' => $Types, 'selected' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                    </div>
                <div class="col-sm-12 toggle" style="display: none;">
                    <div class="col-sm-6">
                       <div class="form-group">
                            <label for="reg_input_name">Brand</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('brand_name', array('readonly' => true));
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('brand_country_id', array('options' => $TravelCountries, 'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Chain</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('brand_chain_id',array('options' => $TravelChains,'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="reg_input_name">Local Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('brand_status', array('options' => array('1' => 'OK','2' => 'ERROR'),'empty' => '--Select--', 'disabled' => 'true'));
                                ?></div>
                        </div> 
                      <div class="form-group">
                            <label for="reg_input_name">Top Brand?</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('top_brand', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'),'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
                       
                        

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name">Owner Company</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('brand_owner_company',array('readonly' => true));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('brand_hq_city_id',array('options' => $TravelCities,'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Segment</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('brand_segment',array('options' => $TravelLookupBrandSegments,'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">WTB Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('wtb_status', array('options' => array('1' => 'OK', '2' => 'ERROR'),'empty' => '--Select--', 'disabled' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Presence</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('brand_presence',array('options' => $TravelLookupBrandPresences,'empty' => '--Select--','disabled' => true));
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
<script>
    $("#TravelBrandBrandActive").change(function(){
        $(".toggle").toggle();
    });
</script>

 

