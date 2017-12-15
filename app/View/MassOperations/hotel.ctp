<?php

$this->Html->addCrumb('Mass Update For Hotel Table', 'javascript:void(0);', array('class' => 'breadcrumblast'));

echo $this->Form->create('MassOperation', array('class' => 'quick_search', 'id' => 'parsley_reg', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    )
        )
);

echo $this->Form->hidden('continent_name');
echo $this->Form->hidden('continent_code');
echo $this->Form->hidden('country_name');
echo $this->Form->hidden('country_code');
echo $this->Form->hidden('province_name');
echo $this->Form->hidden('city_name');
echo $this->Form->hidden('city_code');
echo $this->Form->hidden('suburb_name');
echo $this->Form->hidden('area_name');
echo $this->Form->hidden('sequence_no',array('value' => $sequence_no));
?> 
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
echo $this->Paginator->counter(array('format' => '{:count}'));
?></span> Hotels</h4>


        </div>
        <div class="panel panel-default">
            <h4>Update Fields</h4>
            <div class="panel_controls hideform">


                <div class="row spe-row">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member" class="req">Continent:</label>
<?php echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--','data-required' => 'true','onchange' => 'chkBottonEvnt()')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member" class="req">Country:</label>
<?php echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--','data-required' => 'true','onchange' => 'chkBottonEvnt()')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member" class="req">Province:</label>
<?php echo $this->Form->input('province_id', array('options' => $Provinces, 'empty' => '--Select--','data-required' => 'true','onchange' => 'chkBottonEvnt()')); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member" class="req">City:</label>
<?php echo $this->Form->input('city_id', array('options' => $TravelCities, 'empty' => '--Select--','data-required' => 'true','onchange' => 'chkBottonEvnt()')); ?>
                    </div> 
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member" class="req">Suburb:</label>
<?php echo $this->Form->input('suburb_id', array('options' => $TravelSuburbs, 'empty' => '--Select--','onchange' => 'chkBottonEvnt()')); ?>
                    </div>                     
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member" class="req">Area:</label>
<?php echo $this->Form->input('area_id', array('options' => $TravelAreas, 'empty' => '--Select--','onchange' => 'chkBottonEvnt()')); ?>
                    </div>                     
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Active:</label>
<?php echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE','FALSE' => 'FALSE'), 'empty' => '--Select--','onchange' => 'chkBottonEvnt()')); ?>
                    </div>
                    
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Sequ. No.:</label>
                        
                            <?php echo $this->Form->input('seq_no', array('id' => 'sequence_no','data-required' => 'true','value' => $sequence_no,'disabled' => 'true','style' => 'width:72%')); ?>
                    
                    
                </div>  
                    </div> 
            </div>

            <div class="row" style="padding: 15px;">
                <div class="col-sm-12">
<?php 
if($update == true)
echo $this->Form->submit('WTB Update', array('class' => 'success btn', 'div' => false, 'id' => 'udate', 'name' => 'update','value' => 'Update','style' => 'width:10%'));
if($local_udate == true)
echo $this->Form->submit('Local Update', array('class' => 'success btn', 'div' => false, 'id' => 'local_udate', 'name' => 'local_update','value' => 'local_update','style' => 'width:10%'));
   
echo $this->Form->submit('SQL Generate', array('class' => 'success btn','style' =>'width:10%', 'div' => false, 'id' => 'generate', 'name' => 'generate', 'value' => 'Generate'));
?>

                </div>
            </div> 

            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="800">

                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="6" class="nodis">Hotel Information</th>
                        <th data-group="group9" colspan="6">Hotel Location</th>
                        <th data-group="group10" colspan="3">Hotel Status</th>                  


                    </tr>

                    <tr>
                        <th data-hide="phone" data-group="group1" width="2%" data-sort-ignore="true"><input type="checkbox" class="mbox_select_all" name="msg_sel_all" onclick="chkBottonEvnt()">  Exclude</th>
                        <th data-toggle="phone" data-sort-ignore="true" width="3%" data-group="group1"><?php echo $this->Paginator->sort('id', 'Id');
echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>";
?></th>
                        <th data-hide="phone" data-group="group9" width="10%" data-sort-ignore="true"><?php echo $this->Paginator->sort('continent_name', 'Continent');
echo ($sort == 'continent_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>";
?></th>
                        <th data-hide="phone" data-group="group9" width="10%" data-sort-ignore="true"><?php echo $this->Paginator->sort('country_name', 'Country');
echo ($sort == 'country_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>";
?></th>
                        <th data-hide="phone" data-group="group9" width="10%" data-sort-ignore="true"><?php echo $this->Paginator->sort('province_name', 'Province');
echo ($sort == 'province_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>";
?></th>
                        <th data-hide="phone" data-group="group9" width="8%" data-sort-ignore="true"><?php echo $this->Paginator->sort('city_name', 'City');
                            echo ($sort == 'city_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>";
?></th>
                        <th data-hide="phone" data-group="group9" width="8%" data-sort-ignore="true"><?php echo $this->Paginator->sort('suburb_name', 'Suburb');
                            echo ($sort == 'suburb_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>";
?></th>
                        <th data-hide="phone" data-group="group9" width="5%" data-sort-ignore="true"><?php echo $this->Paginator->sort('area_name', 'Area');
                            echo ($sort == 'area_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>";
?></th>
                        <th data-toggle="phone" data-sort-ignore="true" width="10%" data-group="group1"><?php echo $this->Paginator->sort('hotel_name', 'Hotel');
                            echo ($sort == 'hotel_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>";
?></th>
                        <th data-toggle="phone" data-group="group1" width="3%" data-sort-ignore="true"><?php echo $this->Paginator->sort('hotel_code', 'Hotel Code');
                            echo ($sort == 'hotel_code') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>";
?></th>                    
                        <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true"><?php echo $this->Paginator->sort('brand_name', 'Brand');
                            echo ($sort == 'brand_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>";
?></th>
                        <th data-hide="phone" data-group="group1" width="10%" data-sort-ignore="true"><?php echo $this->Paginator->sort('chain_name', 'Chain');
                            echo ($sort == 'chain_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>";
?></th>




                        <th data-hide="phone" data-group="group10" width="5%" data-sort-ignore="true">Silkrouters</th>
                        <th data-hide="phone" data-group="group10" width="2%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group10" width="2%" data-sort-ignore="true">Active</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    //pr($TravelHotelLookups);
                    //die;
                    $secondary_city = '';
                    //$selected = '';
            

                    if (isset($TravelHotelLookups) && count($TravelHotelLookups) > 0):
                        foreach ($TravelHotelLookups as $TravelHotelLookup):

                            $id = $TravelHotelLookup['TravelHotelLookup']['id'];

                            $status = $TravelHotelLookup['TravelHotelLookup']['status'];
                            if ($status == '1')
                                $status_txt = 'Submitted For Approval';
                            elseif ($status == '2')
                                $status_txt = 'Approved';
                            elseif ($status == '3')
                                $status_txt = 'Returned';
                            elseif ($status == '4')
                                $status_txt = 'Change Submitted';
                            elseif ($status == '5')
                                $status_txt = 'Rejected';
                            elseif ($status == '7')
                                $status_txt = 'Duplicated';
                            else
                                $status_txt = 'Allocation';

                            if ($TravelHotelLookup['TravelHotelLookup']['wtb_status'] == '1')
                                $wtb_status = 'OK';
                            else
                                $wtb_status = 'ERROR';
                            ?>
                    <tr>
                        <td class="tablebody"><?php
                                
                              
                                    if(in_array($id, $selected))
                                            $sele_check = 'checked';
                                    else
                                        $sele_check = '';
                                   
                               //else $selected='';
                            echo $this->Form->checkbox('check', array('name' => 'data[MassOperation][check][]', 'class' => 'msg_select','onclick' => 'chkBottonEvnt()', 'readonly' => true, 'hiddenField' => false, 'value' => $id,$sele_check));
                            ?> </td>
                        <td class="tablebody"><?php echo $id; ?></td>
                        <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['continent_name']; ?></td>                                 
                        <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['country_name']; ?></td>
                        <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['province_name']; ?></td>
                        <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['city_name']; ?></td>
                        <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['suburb_name']; ?></td>
                        <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['area_name']; ?></td>
                        <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_name']; ?></td>               
                        <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['hotel_code']; ?></td>                                                               
                        <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['brand_name']; ?></td>
                        <td class="tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['chain_name']; ?></td>




                        <td class="sub-tablebody"><?php echo $status_txt; ?></td>
                        <td class="sub-tablebody"><?php echo $wtb_status; ?></td>
                        <td class="sub-tablebody"><?php echo $TravelHotelLookup['TravelHotelLookup']['active']; ?></td>   
                    </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="43" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>           

        </div>
    </div>
</div>

<?php echo $this->Form->end(); 
$data = $this->Js->get('#parsley_reg')->serializeForm(array('isForm' => true, 'inline' => true));

$this->Js->get('#MassOperationContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/MassOperation/continent_id'
                ), array(
            'update' => '#MassOperationCountryId',
            'async' => true,
            'before' => 'loading("MassOperationCountryId")',
            'complete' => 'loaded("MassOperationCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);
/*
 * Get sates by country code
 */

$this->Js->get('#MassOperationCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_continent_country/MassOperation/continent_id/country_id'
                ), array(
            'update' => '#MassOperationProvinceId',
            'async' => true,
            'before' => 'loading("MassOperationProvinceId")',
            'complete' => 'loaded("MassOperationProvinceId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#MassOperationProvinceId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_province/MassOperation/province_id'
                ), array(
            'update' => '#MassOperationCityId',
            'async' => true,
            'before' => 'loading("MassOperationCityId")',
            'complete' => 'loaded("MassOperationCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#MassOperationCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_suburb_by_country_id_and_city_id/MassOperation/country_id/city_id'
                ), array(
            'update' => '#MassOperationSuburbId',
            'async' => true,
            'before' => 'loading("MassOperationSuburbId")',
            'complete' => 'loaded("MassOperationSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#MassOperationSuburbId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_area_by_suburb_id/MassOperation/suburb_id'
                ), array(
            'update' => '#MassOperationAreaId',
            'async' => true,
            'before' => 'loading("MassOperationAreaId")',
            'complete' => 'loaded("MassOperationAreaId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

?>
<script>
    $('#MassOperationContinentId').change(function () {
        var str = $('#MassOperationContinentId option:selected').text();
        var res = str.split("-");
        $('#MassOperationContinentCode').val(res[0]);
        $('#MassOperationContinentName').val(res[1]);
    });

    $('#MassOperationCountryId').change(function () {
        var str = $('#MassOperationCountryId option:selected').text();
        var res = str.split("-");
        $('#MassOperationCountryCode').val(res[0]);
        $('#MassOperationCountryName').val(res[1]);
    });

    $('#MassOperationCityId').change(function () {
        var str = $('#MassOperationCityId option:selected').text();
        var res = str.split("-");
        $('#MassOperationCityCode').val(res[0]);
        $('#MassOperationCityName').val(res[1]);
    });

    $('#MassOperationProvinceId').change(function () {
        $('#MassOperationProvinceName').val($('#MassOperationProvinceId option:selected').text());
    });

    $('#MassOperationSuburbId').change(function () {
        $('#MassOperationSuburbName').val($('#MassOperationSuburbId option:selected').text());
    });
    
    $('#MassOperationAreaId').change(function () {
        $('#MassOperationAreaName').val($('#MassOperationAreaId option:selected').text());
    });
    
    $('.mbox_select_all').click(function () {
        var $this = $(this);

        $('#resp_table').find('.msg_select').filter(':visible').each(function () {
            if ($this.is(':checked')) {
                $(this).prop('checked', true).closest('tr').addClass('active')
            } else {
                $(this).prop('checked', false).closest('tr').removeClass('active')
            }
        })

    });

    function chkBottonEvnt() {
        $('#udate').css('display', 'none');
        $('#local_udate').css('display', 'none');
        $('#generate').css('display', 'block');
    }

  
</script>
