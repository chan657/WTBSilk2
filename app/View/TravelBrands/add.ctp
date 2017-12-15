<?php
$this->Html->addCrumb('Add Brand', 'javascript:void(0);', array('class' => 'breadcrumblast'));
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
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Brand</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                       <div class="form-group">
                            <label for="reg_input_name" class="req">Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('brand_name', array('data-required' => 'true'));
                                ?></div>
                        </div>

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('brand_country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Chain</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('brand_chain_id',array('options' => array(),'empty' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                        
                        <div class="form-group">
                            <label for="reg_input_name">Presence</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('brand_presence',array('options' => $TravelLookupBrandPresences,'empty' => '--Select--'));
                                ?></div>
                        </div> 
                     
                        

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name">Owner Company</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('brand_owner_company');
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('brand_hq_city_id',array('options' => array(),'empty' => '--Select--','data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Top Brand</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('top_brand', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'),'empty' => '--Select--'));
                                ?></div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="reg_input_name">Segment</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('brand_segment',array('options' => $TravelLookupBrandSegments,'empty' => '--Select--'));
                                ?></div>
                        </div>
                         
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('description', array('type' => 'textarea','style' => 'width:122%;height:100px'));
                            ?></div>
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
<?php 
echo $this->Form->end(); 
$data = $this->Js->get('#parsley_reg')->serializeForm(array('isForm' => true, 'inline' => true));

$this->Js->get('#TravelBrandBrandCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_country_id/TravelBrand/brand_country_id'
                ), array(
            'update' => '#TravelBrandBrandHqCityId',
            'async' => true,
            'before' => 'loading("TravelBrandBrandHqCityId")',
            'complete' => 'loaded("TravelBrandBrandHqCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelBrandBrandHqCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_chain_by_city_id/TravelBrand/brand_hq_city_id'
                ), array(
            'update' => '#TravelBrandBrandChainId',
            'async' => true,
            'before' => 'loading("TravelBrandBrandChainId")',
            'complete' => 'loaded("TravelBrandBrandChainId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

?>  
<script>
    $('#TravelBrandBrandCountryId').change(function(){    
      $('#TravelBrandBrandCountryName').val($('#TravelBrandBrandCountryId option:selected').text());
    });
    
    $('#TravelBrandBrandHqCityId').change(function(){    
      $('#TravelBrandBrandHqCityName').val($('#TravelBrandBrandHqCityId option:selected').text());
    });
    
    $('#TravelBrandBrandChainId').change(function(){    
      $('#TravelBrandBrandChainName').val($('#TravelBrandBrandChainId option:selected').text());
    });
    
</script>
 

