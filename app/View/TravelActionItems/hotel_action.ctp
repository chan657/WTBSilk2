<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'todc-bootstrap.min',
    'font-awesome/css/font-awesome.min',
    '/js/lib/datepicker/css/datepicker',
    '/js/lib/timepicker/css/bootstrap-timepicker.min'
        )
);
echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));
App::import('Model', 'User');
$attr = new User();

?>
<input type="hidden" id="hidden_site_baseurl" value="<?php echo $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : ''); ?>"  />

<!----------------------------start add project block------------------------------>
<div class="content">
    <div class="pop-up-hdng">
        <span class="heading_text">Add Action | Hotel | Waiting for Approval</span>
    </div>


    <?php
    echo $this->Form->create('TravelActionItem', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true, 'onsubmit' => 'return validation()',
        'inputDefaults' => array(
            'label' => false,
            'div' => false,
            'class' => 'form-control',
        )
    ));
    ?>
      <div class="col-sm-12 spacer">

        <div class="col-sm-6">
            <h4>Action Information</h4>
            <div class="form-group">
                <label class="bgr req">Action Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10"><?php
echo $this->Form->input('type_id', array('id' => 'type_id', 'options' => $type, 'empty' => '--Select--', 'data-required' => 'true'));
?>

                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <h4>&nbsp;</h4>       
            <div class="form-group return" style="display: none;">
                <label>Reason for Return</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	
<?php echo $this->Form->input('lookup_return_id', array('id' => 'return_id', 'options' => $returns, 'empty' => '--Select--'));
?>
                </div>
            </div>
        </div>

    </div>



    <div class="col-sm-12 spacer">
        <div class="lf-space">
<?php
echo $this->Form->input('other_return', array('type' => 'textarea', 'class' => 'form-control return', 'style' => 'display:none;'));
echo $this->Form->input('note', array('type' => 'textarea', 'class' => 'form-control note', 'style' => 'display:none;'));

?>
        </div>
        <?php if(count($TravelHotelRoomSuppliers)>0){?>
        
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
                    if (isset($TravelHotelRoomSuppliers) && count($TravelHotelRoomSuppliers) > 0):
                        foreach ($TravelHotelRoomSuppliers as $TravelHotelRoomSupplier):
                            $id = $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['id'];
                            $status = $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_status'];
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
                              
                                <td><?php echo $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['supplier_code']; ?></td>
                                <td><?php echo $status_txt; ?></td>
                                <td><?php echo $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['active']; ?></td>                                                          
                               
                                <td><?php echo $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['excluded']; ?></td>
                                <td><?php echo $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_mapping_name']; ?></td>
                                <td><?php echo $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['hotel_code']; ?></td>
                                <td><?php echo $TravelHotelRoomSupplier['TravelHotelRoomSupplier']['supplier_item_code1']; ?></td>
                              </tr>
                        <?php endforeach; ?>

                        <?php
                      
                    else:
                        echo '<tr><td colspan="7" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
        <?php }?>
        
        
    </div>


    <div class="row spacer">
        <div class="col-sm-12"><div class="col-sm-12">
<?php echo $this->Form->submit('Add Action', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
?>
            </div>
        </div>
    </div>
<br>
    <div align="center" class="col-sm-12" style="font-size: 15px; font-family: sans-serif">
        <p style="color: black; background-color: #ffff42">
        <?php echo $is_service; ?>
        </p>
    </div> 


<?php echo $this->Form->end();
?>
</div>	

<script type="text/javascript">




    $(document).ready(function() {

        var FULL_BASE_URL = $('#hidden_site_baseurl').val();




        $('#type_id').change(function() {
            var type = $(this).val();
            if (type == '3') { //return
                $('.rejection').css('display', 'none');
                $('.return').css('display', 'block');
                $('.note').css('display', 'none');
            }

            else if (type == '5') { //rejection
                $('.rejection').css('display', 'block');
                $('.return').css('display', 'none');
                $('.note').css('display', 'none');
            }
            else if (type == '9') { //rejection
                $('.note').css('display', 'block');
                $('.rejection').css('display', 'none');
                $('.return').css('display', 'none');
            }
            else {
                $('.rejection').css('display', 'none');
                $('.return').css('display', 'none');
            }

        });

    });
    function validation() {


        var rejections_id = $('#rejections_id').val();
        var return_id = $('#return_id').val();
        var type_id = $('#type_id').val();

        if (type_id == '3' || type_id == '5') {
            if (rejections_id != '' || return_id != '') {
                if (rejections_id == '10' && type_id == '5')
                {
                    if ($('#TravelActionItemOtherRejection').val() == '')
                    {
                        alert('Please type resion description.');
                        return false;
                    }
                }

                else if (return_id == '10' && type_id == '3') {
                    if ($('#TravelActionItemOtherReturn').val() == '')
                    {
                        alert('Please type return description.');
                        return false;
                    }
                }
            }
            else{
                alert('Please select dropdown.');
                        return false;
            }
        }
        else if(type_id == '9')
        {
            if ($('#TravelActionItemNote').val() == '')
                    {
                        alert('Please type description for review.');
                        return false;
                    }
        }
    }


</script>		
<!----------------------------end add project block------------------------------>
