<div class="row">
             <div class="col-md-4 active">
                <div class="info-box  bg-info  text-white" id="initial-tour">
                    <div class="info-icon bg-info-dark">
                        <span aria-hidden="true" class="icon icon-layers"></span>
                    </div>
                    <div class="info-details">
        <?php
        echo $this->Html->link('<h4>Reports<span class="pull-right"></span></h4>', '/admin/reports', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Reports', 'escape' => false));       
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
        echo $this->Html->link('<h4>Administration<span class="pull-right"></span></h4>', '/admin/administration', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Administration', 'escape' => false));        
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
        echo $this->Html->link('<h4>Data<span class="pull-right"></span></h4>', '/admin/data', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Data', 'escape' => false));        
        ?>
                    </div>
                </div>
            </div>
         </div>
