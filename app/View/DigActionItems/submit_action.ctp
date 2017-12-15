<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'todc-bootstrap.min',
    'font-awesome/css/font-awesome.min',
    '/js/lib/datepicker/css/datepicker',
    '/js/lib/timepicker/css/bootstrap-timepicker.min'
        )
);
echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));


//pr($DigActionItems);
/* End */
?>
<input type="hidden" id="hidden_site_baseurl" value="<?php echo $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : ''); ?>"  />

<!----------------------------start add project block------------------------------>
<div class="content">
    <div class="pop-up-hdng">Add Action | Base | Waiting for Approval
    </div>


    <?php
    echo $this->Form->create('DigActionItem', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true, 'onsubmit' => 'return validation()',
        'inputDefaults' => array(
            'label' => false,
            'div' => false,
            'class' => 'form-control',
        )
    ));
    ?>
    <div class="col-sm-12 spacer">

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
echo $this->Form->input('lookup_return_id', array('id' => 'return_id', 'options' => $returns, 'empty' => '--Select--'));
?></div>
                </div>
                <div class="form-group" id="rejection" style="display: none;">
                    <label class="bgr">Reason for Rejection</label>
                    <span class="colon">:</span>
                    <div class="col-sm-10">	<?php echo $this->Form->input('lookup_rejection_id', array('id' => 'rejections_id', 'options' => $rejections, 'empty' => '--Select--')); ?>
                    </div>
                </div>
            </div>
    </div>

    <div class="col-sm-12 spacer">
        <div class="col-sm-12 spacer">
            <div class="lf-space"><?php
    echo $this->Form->input('other_return', array('div' => array('id' => 'other_return', 'style' => 'display:none;'), 'type' => 'textarea'));

    echo $this->Form->input('other_rejection', array('div' => array('id' => 'other', 'style' => 'display:none;'), 'label' => false, 'type' => 'textarea'));
    ?></div>
        </div>
    </div>

    <div class="row spacer">
        <div class="col-sm-12">
<?php echo $this->Form->submit('Add Action', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
?>
        </div>
    </div>
<?php echo $this->Form->end();?>
</div>	

<script>

    $('#type_id').change(function() {
        var type = $(this).val();
        if (type == 3) {

            $('#return').css('display', 'block');
            $('#other_return').css('display', 'block');
            $('#rejection').css('display', 'none');
            $('#other_rejection').css('display', 'none');
        }
        else if (type == 5) {
            $('#rejection').css('display', 'block');
            $('#other_rejection').css('display', 'block');
            $('#other_return').css('display', 'none');
            $('#return').css('display', 'none');

        }
        else {
            $('#return').css('display', 'none');
            $('#other_return').css('display', 'none');
            $('#rejection').css('display', 'none');
            $('#other_rejection').css('display', 'none');
        }
    });

    function validation() {

        var return_id = $('#return_id').val();
        var rejections_id = $('#rejections_id').val();
        var type_id = $('#type_id').val();

        if (type_id == '3') {
            if (return_id == '') {
                alert('Please select reason return');
                return false;
            }
            else {
                if ($('#DigActionItemOtherReturn').val() == '')
                {
                    alert('Please type return description');
                    return false;
                }
            }
        }
        else if (type_id == '5') {
            if (rejections_id == '') {
                alert('Please select reason rejection');
                return false;
            }
            else {
                if ($('#DigActionItemOtherRejection').val() == '')
                {
                    alert('Please type rejection description');
                    return false;
                }
            }
        }
    }
</script>	
<!----------------------------end add project block------------------------------>
