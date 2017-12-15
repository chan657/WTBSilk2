<?php
$this->Html->addCrumb('View / Edit Suburb', 'javascript:void(0);', array('class' => 'breadcrumblast'));
//pr($this->data);
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">View / Edit Information</h4>
            
        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View / Edit Suburb</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('TravelSuburb', array('method' => 'post', 'id' => 'parsley_reg', 'class' => 'form-horizontal user_form', 'novalidate' => true,
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
                    <div class="col-sm-6"> 
                           
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelSuburb']['name']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('name', array('data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCountry']['country_name']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Top Neighborhood</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelSuburb']['top_neighborhood']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('top_neighborhood',array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'),'empty' => '--Select--')); ?>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelSuburb']['continent_name']; ?></p>
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
                            <label for="reg_input_name" class="req">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCity']['city_name']; ?></p>
                                <div class="hidden_control">
<?php echo $this->Form->input('city_id', array('options' => $TravelCities, 'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <div class="form-group">
                        <label style="margin-left: 14px">Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10 editable">
                            <p class="form-control-static"><?php echo $this->data['TravelSuburb']['description']; ?></p>
                            <div class="hidden_control">
<?php echo $this->Form->input('description', array('type' => 'textarea','style' => 'width:122%;height:100px')); ?>
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
echo $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

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


