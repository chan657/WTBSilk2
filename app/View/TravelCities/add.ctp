<?php
$this->Html->addCrumb('Add City', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('TravelCity', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));

echo $this->Form->hidden('country_name');
echo $this->Form->hidden('country_code');
echo $this->Form->hidden('continent_name');
echo $this->Form->hidden('province_name');
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add City</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                       <div class="form-group">
                            <label for="reg_input_name" class="req">Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_name', array('data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'data-required' => 'true'));
                                ?></div>
                        </div>
                        <div class="form-group">
                                        <label for="reg_input_name" class="req">Province</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('province_id', array('options' => array(), 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?></div>
                                    </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_code', array('data-required' => 'true'));
                                ?></div>
                        </div>
                      <div class="form-group">
                            <label for="reg_input_name" class="req">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('country_id', array('options' => array(), 'empty' => '--Select--', 'data-required' => 'true'));
                                ?></div>
                        </div>  
                        <div class="form-group">
                            <label for="reg_input_name">Top City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('top_city', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'),'empty' => '--Select--'));
                                ?></div>
                        </div>
                       
                        
                       
                         
                    </div>
                    <div class="form-group">
                        <label for="reg_input_name" style="margin-left: 14px">Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10">
                            <?php
                            echo $this->Form->input('city_description', array('type' => 'textarea','style' => 'width:122%;height:100px'));
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

$this->Js->get('#TravelCityContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/TravelCity/continent_id'
                ), array(
            'update' => '#TravelCityCountryId',
            'async' => true,
            'before' => 'loading("TravelCityCountryId")',
            'complete' => 'loaded("TravelCityCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#TravelCityCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_continent_country/TravelCity/continent_id/country_id'
                ), array(
            'update' => '#TravelCityProvinceId',
            'async' => true,
            'before' => 'loading("TravelCityProvinceId")',
            'complete' => 'loaded("TravelCityProvinceId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

?>  
<script>
    $('#TravelCityContinentId').change(function(){    
      $('#TravelCityContinentName').val($('#TravelCityContinentId option:selected').text());
    });
    
    $('#TravelCityProvinceId').change(function(){    
      $('#TravelCityProvinceName').val($('#TravelCityProvinceId option:selected').text());
    });
    
    $('#TravelCityCountryId').change(function() {
            var str = $('#TravelCityCountryId option:selected').text();
            var res = str.split("-");          
            $('#TravelCityCountryCode').val(res[0]);
            $('#TravelCityCountryName').val(res[1]);
        });

    
</script>
 

