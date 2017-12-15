<?php
$this->Html->addCrumb('Add Suburb', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('TravelSuburb', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
));
echo $this->Form->hidden('continent_name');
echo $this->Form->hidden('city_name');
echo $this->Form->hidden('country_name');
echo $this->Form->hidden('province_name');
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Add Information</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Add Suburb</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                       <div class="form-group">
                            <label for="reg_input_name" class="req">Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('name', array('data-required' => 'true'));
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
                            <label for="reg_input_name">Top Neighborhood</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10"><?php
                                echo $this->Form->input('top_neighborhood', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'),'empty' => '--Select--'));
                                ?></div>
                        </div>                   

                    </div>
                    <div class="col-sm-6">
                        
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
                        <div class="form-group">
                            <label for="reg_input_name" class="req">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_id', array('options' => array(), 'empty' => '--Select--', 'data-required' => 'true'));
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
<br>
    <div align="center" class="col-sm-12" style="font-size: 15px; font-family: sans-serif">
        <p style="color: black; background-color: #ffff42">
        <?php echo $is_service; ?>
        </p>
    </div> 
<?php 
$data = $this->Js->get('#parsley_reg')->serializeForm(array('isForm' => true, 'inline' => true));
$this->Js->get('#TravelSuburbContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/TravelSuburb/continent_id'
                ), array(
            'update' => '#TravelSuburbCountryId',
            'async' => true,
            'before' => 'loading("TravelSuburbCountryId")',
            'complete' => 'loaded("TravelSuburbCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
$this->Js->get('#TravelSuburbCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_continent_country/TravelSuburb/continent_id/country_id'
                ), array(
            'update' => '#TravelSuburbProvinceId',
            'async' => true,
            'before' => 'loading("TravelSuburbProvinceId")',
            'complete' => 'loaded("TravelSuburbProvinceId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelSuburbCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_country_id/TravelSuburb/country_id'
                ), array(
            'update' => '#TravelSuburbCityId',
            'async' => true,
            'before' => 'loading("TravelSuburbCityId")',
            'complete' => 'loaded("TravelSuburbCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);



echo $this->Form->end(); 




?>  
<script>
    $('#TravelSuburbContinentId').change(function(){    
      $('#TravelSuburbContinentName').val($('#TravelSuburbContinentId option:selected').text());
    });
    
    $('#TravelSuburbCountryId').change(function(){    
      $('#TravelSuburbCountryName').val($('#TravelSuburbCountryId option:selected').text());
    });
    
    $('#TravelSuburbCityId').change(function(){    
      $('#TravelSuburbCityName').val($('#TravelSuburbCityId option:selected').text());
    });
    $('#TravelSuburbProvinceId').change(function(){    
      $('#TravelSuburbProvinceName').val($('#TravelSuburbProvinceId option:selected').text());
    });
    </script>
