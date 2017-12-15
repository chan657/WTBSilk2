<?php
$this->Html->addCrumb('View / Edit City', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">View / Edit Information</h4>
            <div class="user_actions pull-right">
                <a href="#" class="edit_form" data-toggle="tooltip" data-placement="top" title="Edit"><span class="icon-edit"></span></a> <a href="#" class="view_form" data-toggle="tooltip" data-placement="top" title="View" style="display: none;"><span class="glyphicon glyphicon-eye-open"></span></a>
            </div>
        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View / Edit City</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('TravelCity', array('method' => 'post', 'id' => 'parsley_reg', 'class' => 'form-horizontal user_form', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
                   echo $this->Form->hidden('country_name');
                    echo $this->Form->hidden('continent_name');
                    ?>
                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCity']['city_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('city_name', array('data-required' => 'true','tabindex' => '1')); ?>
                                </div>
                            </div>
                        </div>   

                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCity']['country_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'data-required' => 'true','tabindex' => '3')); ?>
                                </div>
                            </div>
                        </div>
                    
                        
                    </div>  
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCity']['continent_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('continent_id',array('options' => $TravelLookupContinents,'empty' => '--Select--', 'data-required' => 'true','tabindex' => '2')); ?>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="reg_input_name">Top City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCity']['top_city']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('top_city', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--','tabindex' => '4')); ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label style="margin-left: 14px">Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10 editable">
                            <p class="form-control-static"><?php echo $this->data['TravelCity']['city_description']; ?></p>
                            <div class="hidden_control">
<?php echo $this->Form->input('city_description', array('type' => 'textarea','style' => 'width:122%;height:100px','tabindex' => '5')); ?>
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
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
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

?>  
<script>
    $('#TravelCityContinentId').change(function(){    
      $('#TravelCityContinentName').val($('#TravelCityContinentId option:selected').text());
    });
    
    $('#TravelCityCountryId').change(function(){    
      $('#TravelCityCountryName').val($('#TravelCityCountryId option:selected').text());
    });

    
</script>


