<?php 
echo $this->Form->hidden($model.'.'.'ItemName',array('div' => false,'label' => false));
?>

<div class="form-group">
    <label for="reg_input_name">Item Code</label>
    <span class="colon">:</span>
    <div class="col-sm-10">
        <?php
        echo $this->Form->input($model.'.'.'ItemCodeId', array('options' => $DataArray,'empty' => '--Select--','div' => false,'label' => false));
        ?></div>
</div>

<script>
    $('#PackageStandardItemItemCodeId').change(function() {
            $('#PackageStandardItemItemName').val($('#PackageStandardItemItemCodeId option:selected').text());
        });
    </script>