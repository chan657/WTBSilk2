<?php
$this->Html->addCrumb('View / Edit Area', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($this->data);
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">View / Edit Information</h4>
        
        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View / Edit Area</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('TravelArea', array('method' => 'post', 'id' => 'parsley_reg', 'class' => 'form-horizontal user_form', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
                    echo $this->Form->hidden('city_name');
                    echo $this->Form->hidden('continent_name');
                    echo $this->Form->hidden('country_name');
                    echo $this->Form->hidden('suburb_name');
                    echo $this->Form->hidden('province_name');
                    ?>
                    <div class="col-sm-6"> 
                           
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelArea']['area_name']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('area_name', array('data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelArea']['country_name']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelArea']['city_name']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('city_id', array('options' => $TravelCities, 'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Top Area</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelArea']['top_area']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('top_area',array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'),'empty' => '--Select--')); ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>  
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelArea']['continent_name']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                        <label for="reg_input_name" class="req">Province</label>
                                        <span class="colon">:</span>
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('province_id', array('options' => $Provinces, 'empty' => '--Select--', 'data-required' => 'true'));
                                            ?></div>
                                    </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Suburb</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelArea']['suburb_name']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('suburb_id', array('options' => $TravelSuburbs, 'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                       
                         

                    </div>
                    <div class="form-group">
                        <label style="margin-left: 14px">Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10 editable">
                            <p class="form-control-static"><?php echo $this->data['TravelArea']['area_description']; ?></p>
                            <div class="hidden_control">
<?php echo $this->Form->input('area_description', array('type' => 'textarea','style' => 'width:122%;height:100px')); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form_submit clearfix" style="display:none">
                        <div class="row">
                            <div class="col-sm-1">
<?php
echo $this->Form->submit('Update', array('class' => 'btn btn-success sticky_success'));
?>
                            </div>
                            <div class="col-sm-1">
<?php echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-danger sticky_important')); ?>
                            </div>


                        </div>

                    </div>
<?php 
echo $this->Form->end(); 

$data = $this->Js->get('#parsley_reg')->serializeForm(array('isForm' => true, 'inline' => true));

$this->Js->get('#TravelAreaContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/TravelArea/continent_id'
                ), array(
            'update' => '#TravelAreaCountryId',
            'async' => true,
            'before' => 'loading("TravelAreaCountryId")',
            'complete' => 'loaded("TravelAreaCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#TravelAreaCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_country_id/TravelArea/country_id'
                ), array(
            'update' => '#TravelAreaCityId',
            'async' => true,
            'before' => 'loading("TravelAreaCityId")',
            'complete' => 'loaded("TravelAreaCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
$this->Js->get('#TravelAreaCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_continent_country/TravelArea/continent_id/country_id'
                ), array(
            'update' => '#TravelAreaProvinceId',
            'async' => true,
            'before' => 'loading("TravelAreaProvinceId")',
            'complete' => 'loaded("TravelAreaProvinceId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);


$this->Js->get('#TravelAreaCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_suburb_by_country_id_and_city_id/TravelArea/country_id/city_id'
                ), array(
            'update' => '#TravelAreaSuburbId',
            'async' => true,
            'before' => 'loading("TravelAreaSuburbId")',
            'complete' => 'loaded("TravelAreaSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
?>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#TravelAreaContinentId').change(function(){    
      $('#TravelAreaContinentName').val($('#TravelAreaContinentId option:selected').text());
    });
    $('#TravelAreaCountryId').change(function(){    
      $('#TravelAreaCountryName').val($('#TravelAreaCountryId option:selected').text());
    });
    
    $('#TravelAreaCityId').change(function(){    
      $('#TravelAreaCityName').val($('#TravelAreaCityId option:selected').text());
    });
    
    $('#TravelAreaSuburbId').change(function(){    
      $('#TravelAreaSuburbName').val($('#TravelAreaSuburbId option:selected').text());
    });
    
    $('#TravelAreaProvinceId').change(function(){    
      $('#TravelAreaProvinceName').val($('#TravelAreaProvinceId option:selected').text());
    });
</script>


