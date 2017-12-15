<?php if ($this->Session->read('role_id') == '64') {
?>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Insert Operations<span class="pull-right"></span></h4>', '/mass_operations/insert_operations', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Insert Operations', 'escape' => false));
                ?>
            </div>
        </div>
    </div>

    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Update Operations<span class="pull-right"></span></h4>', '/mass_operations/update_operations', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Update Operations', 'escape' => false));
                ?>
            </div>
        </div>
    </div>          
</div>
        <?php        
    } else {
        ?>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Insert Operations<span class="pull-right"></span></h4>', '/mass_operations/insert_operations', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Insert Operations', 'escape' => false));
                ?>
            </div>
        </div>
    </div>

         
</div>
        <?php        
    }
        ?>
    <div align="center" class="col-sm-12" style="font-size: 15px; font-family: sans-serif">
        <p style="color: black; background-color: #ffff42">
        <?php echo $is_service; ?>
        </p>
    </div> 