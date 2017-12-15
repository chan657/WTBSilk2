<?php
$this->Html->addCrumb('View / Edit Province', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">View / Edit Information</h4>
            
        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>View / Edit Province</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('Province', array('method' => 'post', 'id' => 'parsley_reg', 'class' => 'form-horizontal user_form', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        )
                    ));
                    echo $this->Form->hidden('continent_name');
                    echo $this->Form->hidden('continent_code');
                    echo $this->Form->hidden('country_code');
                    echo $this->Form->hidden('country_name');
         
                    ?>
                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['Province']['name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('name', array('data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['Province']['country_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        
                                                          
                    </div>  
                    <div class="col-sm-6">  
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['Province']['continent_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('continent_id',array('options' => $TravelLookupContinents,'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Top Province</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['Province']['top_province']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('top_province', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'), 'empty' => '--Select--')); ?>
                                </div>
                            </div>
                        </div>
                                               
                    </div>
                    <div class="form-group">
                        <label style="margin-left: 14px">Description</label>
                        <span class="colon">:</span>
                        <div class="col-sm-10 editable">
                            <p class="form-control-static"><?php echo $this->data['Province']['description']; ?></p>
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
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$this->Js->get('#ProvinceContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/Province/continent_id'
                ), array(
            'update' => '#ProvinceCountryId',
            'async' => true,
            'before' => 'loading("ProvinceCountryId")',
            'complete' => 'loaded("ProvinceCountryId")',
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
    $('#ProvinceCountryId').change(function() {
            var str = $('#ProvinceCountryId option:selected').text();
            var res = str.split("-");          
            $('#ProvinceCountryCode').val(res[0]);
            $('#ProvinceCountryName').val(res[1]);
        });
        
        $('#ProvinceContinentId').change(function() {
            var str = $('#ProvinceContinentId option:selected').text();
            var res = str.split("-");          
            $('#ProvinceContinentCode').val(res[0]);
            $('#ProvinceContinentName').val(res[1]);
        });
    </script>



