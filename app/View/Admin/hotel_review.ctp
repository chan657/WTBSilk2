<?php

$this->Html->addCrumb('Add Hotel Mapping', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->Form->create('SupplierHotel', array('method' => 'post',
    'id' => 'parsley_reg',
    'novalidate' => true,
    'onsubmit' => 'return Validate()',
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
));
echo $this->Form->hidden('supplier_hotel_id',array('value' => $SupplierHotels['SupplierHotel']['id'],'type' => 'text'));
echo $this->Form->hidden('hotel_id',array('value' => $TravelHotelLookups['TravelHotelLookup']['id'],'type' => 'text'));
echo $this->Form->hidden('province_id',array('value' => $TravelHotelLookups['TravelHotelLookup']['province_id'],'type' => 'text'));
echo $this->Form->hidden('suburb_id',array('value' => $TravelHotelLookups['TravelHotelLookup']['suburb_id'],'type' => 'text'));
echo $this->Form->hidden('chain_id',array('value' => $TravelHotelLookups['TravelHotelLookup']['chain_id'],'type' => 'text'));
echo $this->Form->hidden('brand_id',array('value' => $TravelHotelLookups['TravelHotelLookup']['brand_id'],'type' => 'text'));
echo $this->Form->hidden('status',array('value' => $TravelHotelLookups['TravelHotelLookup']['status'],'type' => 'text'));
echo $this->Form->hidden('wtb_status',array('value' => $TravelHotelLookups['TravelHotelLookup']['wtb_status'],'type' => 'text'));
echo $this->Form->hidden('active',array('value' => $TravelHotelLookups['TravelHotelLookup']['active'],'type' => 'text'));
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Hotel Mapping</h4>
        </div>
        <div class="panel-body">

            <div class="row">

                <div class="col-sm-12"  style="background-color: rgb(211, 233, 237);overflow:hidden;">
                    <div class="col-sm-6">
                        <h4>Supplier Hotel : <?php echo strtoupper($SupplierHotels['SupplierHotel']['hotel_name']);?></h4>
                        <div class="form-group">
                            <label for="reg_input_name" class="bgr">Id</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierHotels['SupplierHotel']['id'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierHotels['SupplierHotel']['continent_name'];
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierHotels['SupplierHotel']['city_name'];
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h4>&nbsp;</h4>
                        <div class="form-group">
                            <label for="reg_input_name">Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo '<b>'.$SupplierHotels['SupplierHotel']['hotel_code'].'</b>';
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $SupplierHotels['SupplierHotel']['country_name'];
                                ?></div>
                        </div>



                    </div>
                    <div class="form-group">
                            <label for="reg_input_name">Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $address;
                                ?></div>
                        </div>
                </div>
                <div class="col-sm-12"  style="background-color: rgb(238, 221, 255);overflow:hidden;">
                    <div class="col-sm-6">
                        <h4>WTB Hotel : <?php echo strtoupper($TravelHotelLookups['TravelHotelLookup']['hotel_name']);?></h4>
                        <div class="form-group">
                            <label for="reg_input_name" class="bgr">Id</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo '<b>'.$TravelHotelLookups['TravelHotelLookup']['id'].'</b>';
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Continent</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelHotelLookups['TravelHotelLookup']['continent_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Province</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelHotelLookups['TravelHotelLookup']['province_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Suburb</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelHotelLookups['TravelHotelLookup']['suburb_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Chain</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelHotelLookups['TravelHotelLookup']['chain_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                $status = $TravelHotelLookups['TravelHotelLookup']['status'];
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
                            echo $status_txt;
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Active</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelHotelLookups['TravelHotelLookup']['active'];
                                ?></div>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <h4>&nbsp;</h4>
                        <div class="form-group">
                            <label for="reg_input_name">Code</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelHotelLookups['TravelHotelLookup']['hotel_code'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Country</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelHotelLookups['TravelHotelLookup']['country_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">City</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelHotelLookups['TravelHotelLookup']['city_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Area</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelHotelLookups['TravelHotelLookup']['area_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">Brand</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelHotelLookups['TravelHotelLookup']['brand_name'];
                                ?></div>
                        </div>
                        <div class="form-group">
                            <label for="reg_input_name">WTB Status</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                $wtb_status = $TravelHotelLookups['TravelHotelLookup']['wtb_status'];
                                echo ($wtb_status == '1') ? 'OK' : 'ERROR';
                                ?></div>
                        </div>

                    </div>
                    <div class="form-group">
                            <label for="reg_input_name">Address</label>
                            <span class="colon">:</span>
                            <div class="col-sm-10">
                                <?php
                                echo $TravelHotelLookups['TravelHotelLookup']['location'].$TravelHotelLookups['TravelHotelLookup']['address'];
                                ?></div>
                        </div>
                </div>   
                <div class="clear" style="clear: both;"></div>
                <div class="col-sm-12">
                    <div class="row">  

                        <div class="col-sm-2">
                            <?php
                            echo $this->Form->submit('Add', array('class' => 'btn btn-success sticky_success','name' => 'add','style' => 'width:100%;float:left'));                            
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
?>
<script>
    function Validate() {
        if ($('#SupplierHotelProvinceId').val() == '')
        {
            alert('Province did not blank');
            return false;
        }
        if ($('#SupplierHotelSuburbId').val() == '')
        {
            alert('Province did not blank');
            return false;
        }
        if ($('#SupplierHotelChainId').val() == '')
        {
            alert('Province did not blank');
            return false;
        }
        if ($('#SupplierHotelBrandId').val() == '')
        {
            alert('Province did not blank');
            return false;
        }
        if ($('#SupplierHotelStatus').val() != '2')
        {
            alert('Hotel Status Should be Approved.');
            return false;
        }
        if ($('#SupplierHotelWtbStatus').val() != '1')
        {
            alert('WTB status should be OK.');
            return false;
        }
        if ($('#SupplierHotelActive').val() == 'FALSE')
        {
            alert('Active should be TRUE.');
            return false;
        }
    }
</script>
