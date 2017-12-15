<?php
echo $this->Html->css(array('/bootstrap/css/bootstrap.min', 'popup',
    'font-awesome/css/font-awesome.min',
    '/js/lib/datepicker/css/datepicker',
    '/js/lib/timepicker/css/bootstrap-timepicker.min'
        )
);
echo $this->Html->script(array('jquery.min', 'lib/chained/jquery.chained.remote.min', 'lib/jquery.inputmask/jquery.inputmask.bundle.min', 'lib/parsley/parsley.min', 'pages/ebro_form_validate', 'lib/datepicker/js/bootstrap-datepicker', 'lib/timepicker/js/bootstrap-timepicker.min', 'pages/ebro_form_extended'));
/* End */
//pr($this->data);
?>

<!----------------------------start add project block------------------------------>

<div class="pop-outer">
    <div class="pop-up-hdng">Add Lot </div>
<?php
//echo $this->Form->create('Remark', array('enctype' => 'multipart/form-data'));
echo $this->Form->create('DigPatternLot', array('method' => 'post', 'id' => 'parsley_reg', 'novalidate' => true,
    'inputDefaults' => array(
        'label' => false,
        'div' => false,
        'class' => 'form-control',
    ),
    array('controller' => 'dig_patterns', 'action' => 'add_lot')
));
echo $this->Form->hidden('base_url', array('id' => 'hidden_site_baseurl', 'value' => $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : '')));

?>

    <div class="col-sm-12">
        <div class="col-sm-6">
            <div class="form-group">
                <label  for="input_name" class="req">Lot</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
<?php echo $this->Form->input('lot_id', array('options' => $DigLots,'empty' => '--Select--',  'data-required' => 'true')); ?>
                </div>
            </div>
        </div> 
        <div class="col-sm-6">
             <div class="form-group">
                <label  for="input_name" class="req">Channel</label>
                <span class="colon">:</span>
                <div class="col-sm-10">
<?php echo $this->Form->input('channel_id', array('options' => $Channels,'empty' => '--Select--', 'data-required' => 'true')); ?>
                </div>
            </div>
        </div>     
    </div>
 
    <div class="row">
        <div class="col-sm-12"><?php echo $this->Form->submit('Add', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
?></div>
    </div>           
 <?php echo $this->Form->end(); ?>
</div>	


<!----------------------------end add project block------------------------------>
