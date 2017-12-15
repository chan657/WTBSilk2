<div class="row">
    <div class="col-md-4">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Country <span class="pull-right">'.$country_all_count.'</span></h4>', '/my-travel-countries', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'All Agents', 'escape' => false));
              
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
                <?php
                echo $this->Html->link('<h4>City<span class="pull-right">'.$city_all_count.'</span></h4>', '/my-travel-cities', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Residential', 'escape' => false));
               
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
                <?php
                echo $this->Html->link('<h4>Hotel<span class="pull-right">'.$hotel_all_count.'</span></h4>', '/my-hotels', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Residential', 'escape' => false));
               
                ?>
            </div>
        </div>


    </div>

</div>
