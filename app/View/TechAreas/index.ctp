<?php $this->Html->addCrumb('Payments', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>
<div class="row">
    <div class="col-md-4">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php echo $this->Html->link('<h4>Log Area<span class="pull-right">&nbsp;</span></h4>', '/log_calls', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Log Area', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
<?php echo $this->Html->link('<h4>XML Test Area<span class="pull-right">&nbsp;</span></h4>', '/xml_tests', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'XML Test Area', 'escape' => false));
?>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
<?php echo $this->Html->link('<h4>DB Area<span class="pull-right">&nbsp;</span></h4>', '/db-area', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'DB Area', 'escape' => false));
?>
            </div>
        </div>    		
    </div>           
</div>


