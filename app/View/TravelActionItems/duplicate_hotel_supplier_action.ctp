<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'todc-bootstrap.min',
    'font-awesome/css/font-awesome.min',
    '/js/lib/datepicker/css/datepicker',
    '/js/lib/timepicker/css/bootstrap-timepicker.min','style','/js/lib/FooTable/css/footable.core'
        )
);
 echo $this->Html->script(array('jquery.min','/bootstrap/js/bootstrap.min','lib/FooTable/js/footable',
									'lib/FooTable/js/footable.sort',
									'lib/FooTable/js/footable.filter',
									'lib/FooTable/js/footable.paginate',
									'pages/ebro_responsive_table'));


//pr($actionitems);
/* End */
?>
<input type="hidden" id="hidden_site_baseurl" value="<?php echo $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : ''); ?>"  />

<!----------------------------start add project block------------------------------>
<div class="content">
    <div class="pop-up-hdng">
        <span class="heading_text">Add Action | Duplicate Hotel | Waiting for Approval : <span style="color: red; font-weight: bold;"><?php echo $TravelHotelLookups['TravelHotelLookup']['hotel_code'].' - '.$TravelHotelLookups['TravelHotelLookup']['hotel_name']?></span></span>
    </div>
    <div class="panel-heading">
            <h4 class="panel-title">Previously Entire Mapping Details </h4>
        </div>


    <?php
    //echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
    echo $this->Form->create('TravelActionItem', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true, 'onsubmit' => 'return validation()',
        'inputDefaults' => array(
            'label' => false,
            'div' => false,
            'class' => 'form-control',
        )
    ));
   App::import('Model','User');
$attr = new User();
    ?>
    <div class="col-sm-12 spacer">
       <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="500">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="5" class="nodis">Mapping Information</th>                       
                        <th data-group="group2" colspan="2">Mapping City Code</th>
                        <th data-group="group3" colspan="2">Mapping Hotel Code</th>
                        <th data-group="group4" colspan="2">Mapping Logistics </th>                       
                        
                    </tr>
                    <tr>
                        <th data-toggle="true" data-group="group1" width="20%">Mapping Name</th> 
                        <th data-toggle="true" data-group="group1" width="5%">Hotel Id</th>
                        <th data-hide="phone" data-group="group1" width="8s%">Mapping Status</th>
                        <th data-hide="phone" data-group="group1" width="5%" data-sort-ignore="true">Mapping Active?</th>
                        <th data-hide="phone" data-group="group1" width="5%"  data-sort-ignore="true">Mapping Excluded?</th>    
                        
                        <th data-hide="phone" data-group="group2" width="5%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group2" width="8%" data-sort-ignore="true">Supplier</th>
                        
                        <th data-hide="phone" data-group="group3" width="5%" data-sort-ignore="true">WTB</th>
                        <th data-hide="phone" data-group="group3" width="8%" data-sort-ignore="true">Supplier</th>
                        
                        <th data-hide="phone" data-group="group4" width="12%" data-sort-ignore="true">Created By</th>
                        <th data-hide="phone" data-group="group4" width="12%" data-sort-ignore="true">Approved By</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
<?php


	//pr($Mappinges);
$id = '';
$status = '';
$mapping_name = '';
$city_wtb = '';
$city_supplier = '';
$approve = '';
$excluded = '';
$created_by = '';
$approve_by = '';
$hotel_wtb = '';
$hotel_supplier = '';

if (isset($Mappinge) && count($Mappinge) > 0):
   
    

         $id = $Mappinge['TravelHotelRoomSupplier']['id'];
         $status = $Mappinge['TravelHotelRoomSupplier']['hotel_supplier_status'];
         $approve = $Mappinge['TravelHotelRoomSupplier']['hotel_supplier_approve'];
         $mapping_name = $Mappinge['TravelHotelRoomSupplier']['hotel_mapping_name'];
         $hotel_wtb = $Mappinge['TravelHotelRoomSupplier']['hotel_code'];
         $hotel_id = $Mappinge['TravelHotelRoomSupplier']['hotel_id'];
         $hotel_supplier = $Mappinge['TravelHotelRoomSupplier']['supplier_item_code1'];
         $city_wtb = $Mappinge['TravelHotelRoomSupplier']['hotel_city_code'];
         $city_supplier = $Mappinge['TravelHotelRoomSupplier']['supplier_item_code3'];
         $created_by = $attr->Username($Mappinge['TravelHotelRoomSupplier']['created_by']).' '.$Mappinge['TravelHotelRoomSupplier']['created'];
        if($Mappinge['TravelHotelRoomSupplier']['approved_by']) 
            $approve_by = $attr->Username($Mappinge['TravelHotelRoomSupplier']['approved_by']).' '.$Mappinge['TravelHotelRoomSupplier']['approved_date'];
     
        
       
        // table of travel_action_item_types
        
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
        
        if($approve == '1')
            $approved_txt = 'TRUE';
        else 
            $approved_txt = 'FALSE';
        
        if($excluded == '1')
            $excluded_txt = 'TRUE';
        else 
            $excluded_txt = 'FALSE';
        
        
        ?>
                            <tr>
                                <td class="tablebody"><?php echo $mapping_name; ?></td>
                                <td class="tablebody"><?php echo $hotel_id; ?></td>
                                <td class="tablebody"><?php echo $status_txt; ?></td>
                                <td class="tablebody"><?php echo $approved_txt; ?></td>
                                <td class="tablebody"><?php echo $excluded_txt; ?></td>
                                
                                
                                <td class="sub-tablebody"><?php echo $city_wtb; ?></td>
                                <td class="sub-tablebody"><?php echo $city_supplier; ?></td>
                                
                                <td class="sub-tablebody"><?php echo $hotel_wtb; ?></td>
                                <td class="sub-tablebody"><?php echo $hotel_supplier; ?></td>
                                
                                <td class="sub-tablebody"><?php echo $created_by; ?></td>
                                <td class="sub-tablebody"><?php echo $approve_by; ?></td> 
                    
                            </tr>
        

                        <?php
                        //echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="11" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table>  
        <div class="col-sm-6">


            <div class="form-group">
                <label class="bgr req">Choose Action Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
                    echo $this->Form->input('type_id', array('id' => 'type_id', 'options' => $type, 'empty' => '--Select--', 'data-required' => 'true'));
                    ?>
                </div>
            </div>
        </div>  

        <div class="col-sm-6">     
            <div class="form-group" id="return" style="display: none;">
                <label>Reason for Return</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	<?php
                    echo $this->Form->input('lookup_rejection_id', array('id' => 'return_id', 'options' => $returns, 'empty' => '--Select--'));
                    ?></div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 spacer">
        <div class="lf-space">
            <?php
            echo $this->Form->input('other_rejection', array('div' => array('id' => 'other_return', 'style' => 'display:none;'), 'type' => 'textarea'));
            ?>
        </div>
    </div>


    <div class="row spacer">
        <div class="col-sm-12">
            <div class="col-sm-12">
                <?php echo $this->Form->submit('Add Action', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
                ?>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end();
    ?>
</div>	

<!----------------------------end add project block------------------------------>

<script>

    $('#type_id').change(function() {
        var type = $(this).val();
        if (type == 5) {

            $('#return').css('display', 'block');
            $('#other_return').css('display', 'block');
        }
        else {
            $('#return').css('display', 'none');
            $('#other_return').css('display', 'none');
        }
    });

    function validation() {

        var return_id = $('#return_id').val();
        var type_id = $('#type_id').val();

        if (type_id == '5') {
            if (return_id == '') {
                alert('Please select reason rejection');
                return false;
            }
            else {
                if ($('#TravelActionItemOtherReturn').val() == '')
                {
                    alert('Please type rejection description');
                    return false;
                }
            }
        }
    }
</script>
