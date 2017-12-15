<?php
$this->Html->addCrumb('Edit City', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>

<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Edit Information</h4>
            
        </div>

        <div class="panel-body">
            <fieldset>
                <legend><span>Edit City</span></legend>
            </fieldset>
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    echo $this->Form->create('TravelCity', array('method' => 'post', 'id' => 'parsley_reg', 'class' => 'form-horizontal user_form', 'novalidate' => true,
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control',
                        ),
                        array('controller' => 'reports', 'action' => 'city_edit')
                    ));
                    echo $this->Form->hidden('country_name');
                    echo $this->Form->hidden('country_code');
                    echo $this->Form->hidden('continent_name');
                    echo $this->Form->hidden('province_name');
                    ?>
                    <div class="col-sm-6"> 
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Name</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCity']['city_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('TravelCity.city_name', array('data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>   
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCity']['continent_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('TravelCity.continent_id',array('options' => $TravelLookupContinents,'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Province</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCity']['province_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('TravelCity.province_id', array('options' => $Provinces, 'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCity']['city_status']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('TravelCity.city_status', array('options' => array(1 => 'OK',2 => 'ERROR'), 'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCity']['city_code']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('TravelCity.city_code', array('data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCity']['country_name']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('TravelCity.country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'data-required' => 'true')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Top City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCity']['top_city']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('TravelCity.top_city', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Active</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10 editable">
                                <p class="form-control-static"><?php echo $this->data['TravelCity']['active']; ?></p>
                                <div class="hidden_control">
                                    <?php echo $this->Form->input('TravelCity.active', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'), 'empty' => '--Select--', 'data-required' => 'true')); ?>
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
<?php echo $this->Form->input('TravelCity.city_description', array('type' => 'textarea','style' => 'width:122%;height:100px')); ?>
                            </div>
                        </div>
                    </div>
                    
                    <h4>Mapping Information</h4>
                    
                    <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                   
                    <tr>                        
                        <th data-toggle="phone"  data-group="group1">Supplier Code</th>                        
                        <th data-hide="phone"  data-group="group1">Mapping Status</th>                                                              
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Mapping Active?</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Mapping Excluded?</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Mapping Name</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">WTB</th> 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1">Supplier</th>  
                                            
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //pr($TravelCountrySuppliers);
                    if (isset($TravelCitySuppliers) && count($TravelCitySuppliers) > 0):
                        foreach ($TravelCitySuppliers as $TravelCitySupplier):
                            $id = $TravelCitySupplier['TravelCitySupplier']['id'];
                            $status = $TravelCitySupplier['TravelCitySupplier']['city_supplier_status'];
                            if ($status == '1')
                                $status_txt = 'Submitted For Approval';
                            elseif ($status == '2')
                                $status_txt = 'Approved';
                            elseif ($status == '3')
                                $status_txt = 'Returned';
                            elseif ($status == '4')
                                $status_txt = 'Change Submitted';
                            elseif ($status == '5')
                                $status_txt = 'Rejection';
                            elseif ($status == '6')
                                $status_txt = 'Request For Allocation';
                            else
                                $status_txt = 'Allocation';
                            ?>
                            <tr>
                              
                                <td><?php echo $TravelCitySupplier['TravelCitySupplier']['supplier_code']; ?></td>
                                <td><?php echo $status_txt; ?></td>
                                <td><?php echo $TravelCitySupplier['TravelCitySupplier']['active']; ?></td>                                                          
                               
                                <td><?php echo $TravelCitySupplier['TravelCitySupplier']['excluded']; ?></td>
                                <td><?php echo $TravelCitySupplier['TravelCitySupplier']['city_mapping_name']; ?></td>
                                <td><?php echo $TravelCitySupplier['TravelCitySupplier']['pf_city_code']; ?></td>
                                <td><?php echo $TravelCitySupplier['TravelCitySupplier']['supplier_city_code']; ?></td>
                              </tr>
                        <?php endforeach; ?>

                        <?php
                      
                    else:
                        echo '<tr><td colspan="7" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>


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
    
      $('#TravelCityCountryId').change(function() {
            var str = $('#TravelCityCountryId option:selected').text();
            var res = str.split("-");          
            $('#TravelCityCountryCode').val(res[0]);
            $('#TravelCityCountryName').val(res[1]);
        });
        
    $('#TravelCityProvinceId').change(function(){    
      $('#TravelCityProvinceName').val($('#TravelCityProvinceId option:selected').text());
    });

    
</script>


