<?php
echo $this->Html->css('main');
echo $this->Html->css('jquery.fancybox');
echo $this->Html->script('jquery-1.10.2.min');
echo $this->Html->script('jquery.fancybox');
?>
<style>
    .add-project-row{
        padding: 10px 0 8px 30px;
        height: 28px;
    }

    .inputbox{
        padding: 0 0 0 0;
    }
    .colon{float: left;}
</style>
<!--<div align="left" valign="top" class="headerText"> Edit Unit</div>-->
<?php echo $this->Session->flash(); ?>

<!----------------------------start add project block------------------------------>
<div>
     <div class="tableheadbg">
        <span class="heading_text">Edit Unit For | <?php echo $this->data['Project']['project_name']; ?></span>
    </div>


    <?php
    echo $this->Form->create('Unit', array('enctype' => 'multipart/form-data'));
    
    ?>

    <div class="tableboeder popup_fr">
        <div class="popup_left">

            <div class="div_line">
                <div class="pop_text">Rate</div>
                <div class="colon">:</div>
                <div class="input_div">	<?php
                    echo $this->Form->input('unit_price', array('div' => true,
                        'label' => false,
                        'class' => 'inputbox', 'size' => '25', 'maxlength' => '100', 'onKeyUp' => 'basic_cose()'));
                    ?></div>
            </div>


            <div class="div_line">
                <div class="pop_text">Carpet (Lowest)</div>
                <div class="colon">:</div>
                <div class="input_div"><?php
                    echo $this->Form->input('units_carpet_area_lowest_size', array('div' => true,
                        'label' => false,
                        'class' => 'inputbox', 'size' => '25', 'maxlength' => '100'));
                    ?>

                </div>

            </div>
            <div class="div_line">
                <div class="pop_text">Carpet (Highest)</div>
                <div class="colon">:</div>
                <div class="input_div"><?php
                    echo $this->Form->input('unit_carpet_area_highest_size', array('div' => true,
                        'label' => false,
                        'class' => 'inputbox', 'size' => '25', 'maxlength' => '100'));
                    ?>

                </div>

            </div>
            <div class="div_line">
                <div class="pop_text">PLC</div>
                <div class="colon">:</div>
                <div class="input_div"><?php
                    echo $this->Form->input('unit_plc', array('div' => true,
                        'label' => false,
                        'class' => 'inputbox', 'size' => '25', 'maxlength' => '100'
                    ));
                    ?></div>

            </div>
            <div class="div_line">
                <div class="pop_text">Amenities</div>
                <div class="colon">:</div>
                <div class="input_div"><?php
                    echo $this->Form->input('unit_amenities', array('div' => false,
                        'label' => false,
                        'class' => 'inputbox', 'size' => '1', 'maxlength' => '100', 'onKeyUp' => 'agreement()'));
                    ?></div>

            </div>

            <div class="div_line">
               <div class="pop_text">Due In (Days)</div>
                <div class="colon">:</div>
                <div class="input_div"><?php
                    echo $this->Form->input('unit_due_days', array('div' => true,
                        'label' => false,
                        'class' => 'inputbox', 'size' => '25', 'maxlength' => '100'));
                    ?></div>
            </div>
            <div class="div_line">
               <div class="pop_text">Down % </div>
                <div class="colon">:</div>
                <div class="input_div"><?php
                    echo $this->Form->input('unit_brokerage_commission_percentage', array('div' => true,
                        'label' => false,
                        'class' => 'inputbox', 'size' => '25', 'maxlength' => '100'));
                    ?></div>

            </div>
        </div>


        <div class="popup_right">
            <div class="div_line">
               <div class="pop_text">Unit Type</div>
                <div class="colon">:</div>
                <div class="input_div">	<?php
                    echo $this->Form->input('unit_type', array('div' => true,
                        'label' => false,
                        'class' => 'inputbox', 'size' => '25', 'maxlength' => '100', 'readonly' => 'readonly'));
                    ?></div>
            </div>
            <div class="div_line">
                <div class="pop_text">Sellable(Lowest)</div>
                <div class="colon">:</div>
                <div class="input_div"><?php
                    echo $this->Form->input('unit_sellable_area_lowest_size', array('div' => true,
                        'label' => false,
                        'class' => 'inputbox', 'size' => '25', 'maxlength' => '100', 'onKeyUp' => 'basic_cose()'));
                    ?></div>
            </div>
            <div class="div_line">
                 <div class="pop_text">Sellable (Highest)</div>
                <div class="colon">:</div>
                <div class="input_div"><?php
                    echo $this->Form->input('unit_sellable_area_highest_size', array('div' => true,
                        'label' => false,
                        'class' => 'inputbox', 'size' => '25', 'maxlength' => '100', 'onKeyUp' => 'basic_cose()'));
                    ?></div>

            </div>
            <div class="div_line">
               <div class="pop_text">Basic cost</div>
                <div class="colon">:</div>
                <div class="input_div"><?php
                    echo $this->Form->input('unit_total_basic_cost', array('div' => true,
                        'label' => false,
                        'class' => 'inputbox', 'id' => 'basic_cost', 'size' => '25', 'maxlength' => '100', 'readonly' => 'readonly', 'onBlur' => 'agreement()'));
                    ?>
                </div>
            </div>
            <div class="div_line">
                <div class="pop_text">FLR Rise</div>
                  <div class="colon">:</div>
                <div class="input_div"><?php
                    echo $this->Form->input('unit_flr_rise', array('div' => true,
                        'label' => false,
                        'class' => 'inputbox', 'size' => '20', 'maxlength' => '100'));
                    ?></div>

            </div>


            <div class="div_line">
               <div class="pop_text">Other</div>
                <div class="colon">:</div>
                <div class="input_div"><?php
                    echo $this->Form->input('unit_total_other_costs', array('div' => false,
                        'label' => false,
                        'class' => 'inputbox', 'size' => '1', 'maxlength' => '100', 'onKeyUp' => 'agreement()'));
                    ?></div>

            </div>
            <div class="div_line">
               <div class="pop_text">Agreement Value</div>
                <div class="colon">:</div> 
                <div class="input_div"><?php
                    echo $this->Form->input('unit_agreement_value', array('div' => false,
                        'label' => false,
                        'class' => 'inputbox', 'size' => '1', 'maxlength' => '100', 'readonly' => 'readonly'));
                    ?></div>

            </div>
<div class="div_line">
                     <div class="pop_text">&nbsp;</div>
                    <div class="input_div">
            <div class="buttons">
                
                <?php echo $this->Form->submit('Update Unit', array('class' => 'updateBox','div' => false, 'id' => 'udate_unit')); ?>

                <?php
                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'updateBox updateBox2'));
                //  echo $this->Html->link($this->Html->image("btn-reset.gif"), array(), array('escape' => false, 'onclick'=>'document.UserAddForm.reset();return false;', 'div' => false));
                ?>
                     </div>
                 </div>
            </div>
        </div>

    </div>

    <?php echo $this->Form->end();
    ?>
</div>			
<!----------------------------end add project block------------------------------>
<script>
    $(document).ready(function() {

        $('#basic_cost').focus(function() {
            //  var UnitPrice = $.isNumeric($("#UnitUnitPrice").val())
            var UnitPrice = parseFloat($('#UnitUnitPrice').val());
            var SellableAreaLowestSize = parseFloat($('#UnitUnitSellableAreaLowestSize').val());
            var SellableAreaHighestSize = parseFloat($('#UnitUnitSellableAreaHighestSize').val());
            var basic_cost = parseFloat(((SellableAreaLowestSize + SellableAreaHighestSize) / 2) * UnitPrice);
            // alert(basic_cost);
            $(this).val(basic_cost);

            //alert(UnitPrice);
        });
        $('#UnitUnitAgreementValue').focus(function() {
            var basic_cost = parseFloat($('#basic_cost').val());
            var UnitAmenitie = parseFloat($('#UnitUnitAmenities').val());
            var UnitOther = parseFloat($('#UnitUnitTotalOtherCosts').val());
            var agreement = parseFloat(basic_cost + UnitAmenitie + UnitOther);
            $(this).val(agreement);

        });


    });
    function basic_cose() {
        var UnitPrice = parseFloat($('#UnitUnitPrice').val());
        var SellableAreaLowestSize = parseFloat($('#UnitUnitSellableAreaLowestSize').val());
        var SellableAreaHighestSize = parseFloat($('#UnitUnitSellableAreaHighestSize').val());
        var basic_cost = parseFloat(((SellableAreaLowestSize + SellableAreaHighestSize) / 2) * UnitPrice);
        $('#basic_cost').val(basic_cost);
    }

    function agreement() {
        var basic_cost = parseFloat($('#basic_cost').val());
        var UnitAmenitie = parseFloat($('#UnitUnitAmenities').val());
        var UnitOther = parseFloat($('#UnitUnitTotalOtherCosts').val());
        var agreement = parseFloat(basic_cost + UnitAmenitie + UnitOther);
        $('#UnitUnitAgreementValue').val(agreement);

    }
</script>