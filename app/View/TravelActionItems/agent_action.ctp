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
if ($this->data['TravelActionItem']['type_id'] == '6')
    $heading = 'Allocation';
else
    $heading = 'Approval';
//pr($this->data);
/* End */
?>
<input type="hidden" id="hidden_site_baseurl" value="<?php echo $this->request->base . ((!is_null($this->params['language'])) ? '/' . $this->params['language'] : ''); ?>"  />

<!----------------------------start add project block------------------------------>
<div class="content">
    <div class="pop-up-hdng">
        <span class="heading_text">Add Action | Agent - <?php echo $this->data['Agent']['agent_name']; ?> | Waiting for <?php echo $heading; ?></span>
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
    <div class="col-sm-12 spacer" <?php if ($this->data['TravelActionItem']['type_id'] <> '6') { ?> style="display:none" <?php } ?>>

        <div class="col-sm-6">
            <h4>Primary Information</h4>
            <div class="form-group">
                <label class="bgr">Submitted By</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
    echo $attr->Username($this->data['TravelActionItem']['created_by']);
    ?>

                </div>
            </div>
            <div class="form-group">
                <label class="bgr">Agent Name</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
    echo $this->data['ActionAgent']['Agent']['agent_name'];
    ?>

                </div>
            </div>
            <div class="form-group">
                <label class="bgr">Procurement Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
    echo $this->data['ActionAgent']['ProcurementType']['value'];
    ?>

                </div>
            </div>
            <div class="form-group">
                <label class="bgr">Business Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
    echo $this->data['ActionAgent']['AgentBusinessType']['value'];
    ?>

                </div>
            </div>
            <!--  <div class="form-group">
                  <label>MultiCity?</label>
                  <span class="colon">:</span>
                  <div class="col-sm-10 padding"><?php
    if ($this->data['ActionAgent']['Agent']['agent_multicity'])
        echo 'YES';
    else
        echo 'NO';
    ?>
  
                  </div>
              </div>-->

            <h4>Activity Details</h4>
            <div class="form-group">
                <label class="bgr">Activity From</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
            echo date("F j, Y, g:i a", strtotime($this->data['AgentEvent']['Event']['start_date']));
    ?>

                </div>
            </div>
            <div class="form-group">
                <label class="bgr">Activity Level</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
            echo $this->data['AgentEvent']['ActivityLevel']['value'];
    ?>

                </div>
            </div>
            <div class="form-group">
                <label class="bgr">Activity Type</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
            echo $this->data['AgentEvent']['ActivityType']['value'];
    ?>

                </div>
            </div>
            <div class="form-group">
                <label class="bgr">Activity Description</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
            echo $this->data['AgentEvent']['Event']['event_level_desc'];
    ?>

                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <h4>&nbsp;</h4>
            <div class="form-group">
                <label class="bgr">Submitted Date</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding">	
<?php echo date("F j, Y, g:i a", strtotime($this->data['TravelActionItem']['created'])); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="bgr">Primary City</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
echo $this->data['ActionAgent']['PrimaryCity']['city_name'];
?>

                </div>
            </div>
            <div class="form-group">
                <label class="bgr">Nature Of Business</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
echo $this->data['ActionAgent']['AgentBusinessNature']['value'];
?>

                </div>
            </div>
            <div class="form-group">
                <label class="bgr">Status</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
echo $this->data['ActionAgent']['AgentStatus']['value'];
?>

                </div>
            </div>
            <h4>&nbsp;</h4>
            <div class="form-group">
                <label class="bgr">Activity To</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
echo date("F j, Y, g:i a", strtotime($this->data['AgentEvent']['Event']['end_date']));
?>

                </div>
            </div>
            <div class="form-group">
                <label class="bgr">Activity With</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
echo $this->data['ActionAgent']['Agent']['agent_name'];
?>

                </div>
            </div>
            <div class="form-group">
                <label class="bgr">Activity Details</label>
                <span class="colon">:</span>
                <div class="col-sm-10 padding"><?php
echo $this->data['AgentEvent']['Details']['value'];
?>

                </div>
            </div>

        </div>

    </div>
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
            <div class="form-group rejection" style="display: none;">
                <label class="bgr">Reason for Rejection</label>
                <span class="colon">:</span>
                <div class="col-sm-10">	
<?php echo $this->Form->input('lookup_rejection_id', array('id' => 'rejections_id', 'options' => $rejections, 'empty' => '--Select--')); ?>
                </div>
            </div>
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
echo $this->Form->input('other_rejection', array('type' => 'textarea', 'class' => 'form-control rejection', 'style' => 'display:none;'));
?>
        </div>
    </div>


    <div class="row spacer">
        <div class="col-sm-12"><div class="col-sm-12">
<?php echo $this->Form->submit('Add Action', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'reset btn'));
?>
            </div>
        </div>
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
            }

            else if (type == '5') { //rejection
                $('.rejection').css('display', 'block');
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

    }


</script>		
<!----------------------------end add project block------------------------------>
