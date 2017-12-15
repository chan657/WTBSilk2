<?php
$this->Html->addCrumb('View Duplicate City Supplier Mapping', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('DuplicateMappinge', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
    array('controller' => 'mappinges', 'action' => 'edit_duplicate_supplier_city')
));
App::import('Model','User');
$attr = new User();
//pr($this->data);
echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));

?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">View Duplicate City Supplier Mapping</h4>
        </div>
        <div class="panel-body">
           
            <div class="row">               
                <div class="col-sm-12" id="city">
                    <div class="col-sm-6">
                        
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('supplier_code', array('id' => 'city_supplier_code','options' => $TravelSuppliers, 'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_wtb_code', array('id' => 'pf_city_code','options' => $TravelCities, 'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
                      

                    </div>
                    <div class="col-sm-6">
                       
                        <div class="form-group">
                            <label for="reg_input_name" class="req">WTB Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('country_wtb_code', array('id' => 'city_country_code','options' => $TravelCountries, 'empty' => '--Select--','disabled' => true));
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name" class="req">Supplier City Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $this->Form->input('city_supplier_code',array('readonly' => true));
                                ?></div>
                        </div>
                    </div>
                </div>             
                
                <div class="clear" style="clear: both; margin-bottom: 10px;"></div>
                <div class="col-sm-12">
                <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="3000">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="4" class="nodis">Mapping Information</th>                       
                        <th data-group="group2" colspan="2">Mapping City Code</th>
                        <th data-group="group3" colspan="2">Mapping Logistics </th>                       
                        <th data-group="group4" class="nodis">Action</th>
                    </tr>
                    <tr>
                        <th data-toggle="true" data-group="group1" width="20%">Mapping Name</th>                       
                        <th data-hide="phone" data-group="group1" width="10%">Mapping Status</th>
                        <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true">Mapping Active?</th>
                        <th data-hide="phone" data-group="group1" width="10%"  data-sort-ignore="true">Mapping Excluded?</th>    
                        
                        <th data-hide="phone" data-group="group2" width="8%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group2" width="8%" data-sort-ignore="true">Supplier</th>
                        
                        <th data-hide="phone" data-group="group3" width="12%" data-sort-ignore="true">Created By</th>
                        <th data-hide="phone" data-group="group3" width="12%" data-sort-ignore="true">Approved By</th>
                        
                        <th data-group="group4" data-hide="phone" data-sort-ignore="true" width="3%">Action</th>        
                    </tr>
                </thead>
                <tbody>
<?php


	//pr($Mappinges);


if (isset($Mappinges) && count($Mappinges) > 0):
    foreach ($Mappinges as $Mappinge):
        $id = $Mappinge['TravelCitySupplier']['id'];
        
       
        // table of travel_action_item_types
        $status = $Mappinge['TravelCitySupplier']['city_supplier_status'];
        if($status == '1')
            $status_txt = 'Submitted For Approval';
        elseif($status == '2')
            $status_txt = 'Approved';
        elseif($status == '3')
           $status_txt = 'Returned';
        elseif($status == '4')
           $status_txt = 'Change Submitted';
        elseif($status == '5')
           $status_txt = 'Rejection';
        elseif($status == '6')
           $status_txt = 'Request For Allocation';
        else
            $status_txt = 'Allocation';
        
        if($Mappinge['TravelCitySupplier']['city_supplier_approve'] == '1')
            $approved_txt = 'TRUE';
        else 
            $approved_txt = 'FALSE';
        
        if($Mappinge['TravelCitySupplier']['excluded'] == '1')
            $excluded_txt = 'TRUE';
        else 
            $excluded_txt = 'FALSE';
        
        if($id == $this->data['DuplicateMappinge']['duplicate_id'])
            $tr_style = 'style="background-color:#5DD0ED"';
        else
            $tr_style = 'style="background-color:#FFFFFF"';
        ?>
                            <tr <?php echo $tr_style;?>>
                                <td class="tablebody"><?php echo $Mappinge['TravelCitySupplier']['city_mapping_name']; ?></td>
                                
                                <td class="tablebody"><?php echo $status_txt; ?></td>
                                <td class="tablebody"><?php echo $approved_txt; ?></td>
                                <td class="tablebody"><?php echo $excluded_txt; ?></td>
                                
                                
                                <td class="sub-tablebody"><?php echo $Mappinge['TravelCitySupplier']['pf_city_code']; ?></td>
                                <td class="sub-tablebody"><?php echo $Mappinge['TravelCitySupplier']['supplier_city_code']; ?></td>
                                
                                <td class="sub-tablebody"><?php echo $attr->Username($Mappinge['TravelCitySupplier']['created_by']).' '.$Mappinge['TravelCitySupplier']['created']; ?></td>
                                <td class="sub-tablebody"><?php if($Mappinge['TravelCitySupplier']['approved_by']) echo $attr->Username($Mappinge['TravelCitySupplier']['approved_by']).' '.$Mappinge['TravelCitySupplier']['approved_date']; ?></td> 
                                
                             
                                <td width="10%" valign="middle" align="center">
                                    <?php 
                                        $options=array($id=>'');
                                        $attributes=array('legend'=>false, 'hiddenField' => false,'label' => false,'div' => false);
                                        echo $this->Form->radio('duplicate_id',$options,$attributes);
                                        ?>                       
                                </td>
                            </tr>
        <?php endforeach; ?>

                        <?php
                       // echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="7" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>                 
                </div>
                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12">
                    <div class="row">  
                        
                        <div class="col-sm-2">
                            <?php
                            echo $this->Form->submit('Update Mapping', array('class' => 'btn btn-success sticky_success','name' => 'add','style' => 'width:78%'));
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

$this->Js->get('#country_supplier_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_by_country/Mapping/country_supplier_code'
                ), array(
            'update' => '#pf_country_code',
            'async' => true,
            'before' => 'loading("pf_country_code")',
            'complete' => 'loaded("pf_country_code")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#city_supplier_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_by_city/Mapping/city_supplier_code'
                ), array(
            'update' => '#city_country_code',
            'async' => true,
            'before' => 'loading("city_country_code")',
            'complete' => 'loaded("city_country_code")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#hotel_supplier_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_by_city/Mapping/hotel_supplier_code'
                ), array(
            'update' => '#hotel_country_code',
            'async' => true,
            'before' => 'loading("hotel_country_code")',
            'complete' => 'loaded("hotel_country_code")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
/*
$this->Js->get('#city_country_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_country_by_city/Mapping/city_country_code'
                ), array(
            'update' => '#pf_city_code',
            'async' => true,
            'before' => 'loading("pf_city_code")',
            'complete' => 'loaded("pf_city_code")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#city_country_code')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_country_by_city/Mapping/city_country_code'
                ), array(
            'update' => '#pf_city_code',
            'async' => true,
            'before' => 'loading("pf_city_code")',
            'complete' => 'loaded("pf_city_code")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
 * 
 */
?>

<script>
    var FULL_BASE_URL = $('#hidden_site_baseurl').val();
        $('#MappingMappingType').change(function(){
        var value = $(this).val();
        if(value == '1'){
            $('#country').css('display','block');
            $('#city').css('display','none');
            $('#hotel').css('display','none');
            $('.search_result').css('display','none');
        }
        else if(value == '2'){
            $('#city').css('display','block');
            $('#country').css('display','none');
            $('#hotel').css('display','none');
            $('.search_result').css('display','block');
        }
        else if(value == '3'){
            $('#hotel').css('display','block');
            $('#country').css('display','none');
            $('#city').css('display','none');
            $('.search_result').css('display','none');
        }
    });
    
    
    $('#city_country_code').change(function() {
        var country_id = $(this).val();
        var supplier_code = $('#city_supplier_code').val();
        var dataString = 'country_id=' + country_id + '&supplier_code='+supplier_code;
       
        $('#pf_city_code').attr('disabled', 'true');
        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/get_supplier_country_by_city',
            beforeSend: function() {
                
                $('#pf_city_code').attr('disabled', 'true');
            },
            success: function(return_data) {
                $('#pf_city_code').removeAttr('disabled', 'false');
                $('#pf_city_code').html(return_data);
            }
        });

    });
    
    $('#hotel_country_code').change(function() {
        var country_id = $(this).val();
        var supplier_code = $('#hotel_supplier_code').val();
        var dataString = 'country_id=' + country_id + '&supplier_code='+supplier_code;
       
        $('#hotel_city_code').attr('disabled', 'true');
        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/get_hotel_supplier_country_by_city',
            beforeSend: function() {
                
                $('#hotel_city_code').attr('disabled', 'true');
            },
            success: function(return_data) {
                $('#hotel_city_code').removeAttr('disabled', 'false');
                $('#hotel_city_code').html(return_data);
            }
        });

    });
    
    $('#hotel_city_code').change(function() {
        var city_code = $('#hotel_city_code').val();
        var country_code = $('#hotel_country_code').val();
        var supplier_code = $('#hotel_supplier_code').val();
        var dataString = 'country_code=' + country_code + '&supplier_code='+supplier_code+ '&city_code='+city_code;
       
        $('#hotel_code').attr('disabled', 'true');
        $.ajax({
            type: "POST",
            data: dataString,
            url: FULL_BASE_URL + '/all_functions/get_hotel_by_city_country_supplier',
            beforeSend: function() {
                
                $('#hotel_code').attr('disabled', 'true');
            },
            success: function(return_data) {
                $('#hotel_code').removeAttr('disabled', 'false');
                $('#hotel_code').html(return_data);
            }
        });

    });
    
    $('.sticky_success').click(function(){
        var value= $(this).attr('name');
        $('#MappingOperation').val(value);
    });
</script>
