<?php
if ($this->Session->read('role_id') == '64') {
?>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Continent<span class="pull-right"></span></h4>', '/my-travel-continents', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Continent', 'escape' => false));
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
                echo $this->Html->link('<h4>Country<span class="pull-right"></span></h4>', '/my-travel-countries', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Country', 'escape' => false));
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
                echo $this->Html->link('<h4>Province<span class="pull-right"></span></h4>', '/provinces', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Province', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>City<span class="pull-right"></span></h4>', '/my-travel-cities', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'City', 'escape' => false));
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
                echo $this->Html->link('<h4>Hotel<span class="pull-right"></span></h4>', '/my-hotels', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Hotel', 'escape' => false));
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
                echo $this->Html->link('<h4>Suburb<span class="pull-right"></span></h4>', '/my-travel-suburbs', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Suburb', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Area<span class="pull-right"></span></h4>', '/my-travel-areas', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Area', 'escape' => false));
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
                echo $this->Html->link('<h4>Chain<span class="pull-right"></span></h4>', '/my-travel-chains', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Chain', 'escape' => false));
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
                echo $this->Html->link('<h4>Brand<span class="pull-right"></span></h4>', '/my-travel-brands', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Brand', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Country Mapping<span class="pull-right"></span></h4>', '/country_mapping_list', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Country Mapping', 'escape' => false));
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
                echo $this->Html->link('<h4>City Mapping<span class="pull-right"></span></h4>', '/reports/city_mapping_list', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'City Mapping', 'escape' => false));
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
                echo $this->Html->link('<h4>Hotel Mapping<span class="pull-right"></span></h4>', '/reports/hotel_mapping_list', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Hotel Mapping', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Download<span class="pull-right"></span></h4>', '/db-area', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Download', 'escape' => false));
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
                echo $this->Html->link('<h4>Supplier<span class="pull-right"></span></h4>', '/my-suppliers', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Suppliers', 'escape' => false));
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
                echo $this->Html->link('<h4>Hotel Amenity<span class="pull-right"></span></h4>', '/my-hotel-amenities', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Hotel Amenity', 'escape' => false));
                ?>
            </div>
        </div>
    </div>    
</div>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Lookups<span class="pull-right"></span></h4>', '/my-travel-lookups', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Lookups', 'escape' => false));
                ?>
            </div>
        </div>
    </div> 
</div>
        <?php
    } elseif ($this->Session->read('role_id') == '70') {
        ?>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>My Hotel Amenities<span class="pull-right"></span></h4>', '/my-hotel-amenities', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Hotel Amenities', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
</div>
        <?php        
    } elseif ($this->Session->read('role_id') == '69') {
        ?>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Continent<span class="pull-right"></span></h4>', '/my-travel-continents', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Continent', 'escape' => false));
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
                echo $this->Html->link('<h4>Country<span class="pull-right"></span></h4>', '/my-travel-countries', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Country', 'escape' => false));
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
                echo $this->Html->link('<h4>Province<span class="pull-right"></span></h4>', '/provinces', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Province', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>City<span class="pull-right"></span></h4>', '/my-travel-cities', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'City', 'escape' => false));
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
                echo $this->Html->link('<h4>Suburb<span class="pull-right"></span></h4>', '/my-travel-suburbs', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Suburb', 'escape' => false));
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
                echo $this->Html->link('<h4>Area<span class="pull-right"></span></h4>', '/my-travel-areas', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Area', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
</div>
        <?php
    } elseif ($this->Session->read('role_id') == '44') {
        ?>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Continent<span class="pull-right"></span></h4>', '/my-travel-continents', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Continent', 'escape' => false));
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
                echo $this->Html->link('<h4>Country<span class="pull-right"></span></h4>', '/my-travel-countries', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Country', 'escape' => false));
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
                echo $this->Html->link('<h4>Province<span class="pull-right"></span></h4>', '/provinces', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Province', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>City<span class="pull-right"></span></h4>', '/my-travel-cities', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'City', 'escape' => false));
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
                echo $this->Html->link('<h4>Hotel<span class="pull-right"></span></h4>', '/my-hotels', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Hotel', 'escape' => false));
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
                echo $this->Html->link('<h4>Suburb<span class="pull-right"></span></h4>', '/my-travel-suburbs', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Suburb', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Area<span class="pull-right"></span></h4>', '/my-travel-areas', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Area', 'escape' => false));
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
                echo $this->Html->link('<h4>Chain<span class="pull-right"></span></h4>', '/my-travel-chains', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Chain', 'escape' => false));
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
                echo $this->Html->link('<h4>Brand<span class="pull-right"></span></h4>', '/my-travel-brands', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Brand', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 active">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Country Mapping<span class="pull-right"></span></h4>', '/country_mapping_list', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Country Mapping', 'escape' => false));
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
                echo $this->Html->link('<h4>City Mapping<span class="pull-right"></span></h4>', '/reports/city_mapping_list', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'City Mapping', 'escape' => false));
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
                echo $this->Html->link('<h4>Hotel Mapping<span class="pull-right"></span></h4>', '/reports/hotel_mapping_list', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Hotel Mapping', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
</div>
<?php
   }
?>

