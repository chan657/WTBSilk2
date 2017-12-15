<?php
$url = $this->here;
$arr = explode("/", $url);
$page_url = end($arr);
$aaray = explode(':', $page_url);
$cur_page = $aaray[0];
?>
<div class="row">

    <div class="col-md-4 <?php if ($cur_page == 'active' || $cur_page == 'owner_approved') { ?>active<?php } ?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Hotels<span class="pull-right">' . $hotel_count . '</span></h4>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Hotels', 'escape' => false));
                echo $this->Html->link('<p>Active <span class="badge pull-right bg-white text-success">' . $active_count . '</span> </p>', '/my-hotels/active:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Active', 'escape' => false));
                echo $this->Html->link('<p>Mapped <span class="badge pull-right bg-white text-success">' . $mapped_count . '</span> </p>', '/my-mappings/mapping_type:3', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Mapped', 'escape' => false));
                echo $this->Html->link('<p>Direct <span class="badge pull-right bg-white text-success">' . $direct_count . '</span> </p>', '/my-hotels/contract_status:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Direct', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-4 <?php if ($cur_page == 'continent_code') { ?>active<?php } ?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Hotels<span class="pull-right">' . $hotel_count . '</span></h4>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Hotels', 'escape' => false));
                echo $this->Html->link('<p>APAC <span class="badge pull-right bg-white text-success">' . $apac_count . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'APAC', 'escape' => false));
                echo $this->Html->link('<p>Middle East <span class="badge pull-right bg-white text-success">' . $midd_east_count . '</span> </p>', '/my-hotels/continent_code:ME', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Middle East', 'escape' => false));
                echo $this->Html->link('<p>Europe <span class="badge pull-right bg-white text-success">' . $europe_count . '</span> </p>', '/my-hotels/continent_code:EU', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Europe', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-4 <?php if ($cur_page == 'owner_commercial') { ?>active<?php } ?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Hotels<span class="pull-right">' . $hotel_count . '</span></h4>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Hotels', 'escape' => false));
                echo $this->Html->link('<p>4 & 5 Stars <span class="badge pull-right bg-white text-success">' . $four_five_star . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => '4 & 5 Stars', 'escape' => false));
                echo $this->Html->link('<p>3 Stars <span class="badge pull-right bg-white text-success">' . $three_star_count . '</span> </p>', '/my-hotels/star:3', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => '3 Stars', 'escape' => false));
                echo $this->Html->link('<p>Below 3 Stars <span class="badge pull-right bg-white text-success">' . $below_three_star_count . '</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Below 3 Stars', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 <?php if ($cur_page == 'owner_highendresidential') { ?>active<?php } ?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Thailand Hotels<span class="pull-right">' . $thailand_count . '</span></h4>', '/my-hotels/country_code:TH', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Thailand Hotels', 'escape' => false));
                echo $this->Html->link('<p>Bangkok <span class="badge pull-right bg-white text-success">' . $bangkok_count . '</span> </p>', '/my-hotels/city_code:BKK', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Bangkok', 'escape' => false));
                echo $this->Html->link('<p>Pattaya <span class="badge pull-right bg-white text-success">' . $pattaya_count . '</span> </p>', '/my-hotels/city_code:PYX', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Pattaya', 'escape' => false));
                echo $this->Html->link('<p>Phuket <span class="badge pull-right bg-white text-success">' . $phuket_count . '</span> </p>', '/my-hotels/city_code:HKT', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Phuket', 'escape' => false));
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
                echo $this->Html->link('<h4>India Hotels<span class="pull-right">' . $india_count . '</span></h4>', '/my-hotels/country_code:IN', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'India Hotels', 'escape' => false));
                echo $this->Html->link('<p>Goa <span class="badge pull-right bg-white text-success">0</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Goa', 'escape' => false));
                echo $this->Html->link('<p>Kerala <span class="badge pull-right bg-white text-success">0</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Kerala', 'escape' => false));
                echo $this->Html->link('<p>Rajasthan <span class="badge pull-right bg-white text-success">0</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Rajasthan', 'escape' => false));
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
                echo $this->Html->link('<h4>UAE Hotels<span class="pull-right">' . $uae_count . '</span></h4>', '/my-hotels/country_code:AE', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'UAE Hotels', 'escape' => false));
                echo $this->Html->link('<p>Dubai <span class="badge pull-right bg-white text-success">' . $dubai_count . '</span> </p>', '/my-hotels/city_code:DUA', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Dubai', 'escape' => false));
                echo $this->Html->link('<p>Sharjah <span class="badge pull-right bg-white text-success">' . $sharjah_count . '</span> </p>', '/my-hotels/city_code:SHH', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Sharjah', 'escape' => false));
                echo $this->Html->link('<p>Abu Dhabi <span class="badge pull-right bg-white text-success">' . $abu_dhabi_count . '</span> </p>', '/my-hotels/city_code:AUH', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Abu Dhabi', 'escape' => false));
                ?>
            </div>
        </div>


    </div>	

</div> 
<div class="row">
    <div class="col-md-4 <?php if ($cur_page == 'owner_highendresidential') { ?>active<?php } ?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Australasia Hotels<span class="pull-right">0</span></h4>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Australasia Hotels', 'escape' => false));
                echo $this->Html->link('<p>New Zealand <span class="badge pull-right bg-white text-success">' . $new_zealand_count . '</span> </p>', '/my-hotels/country_code:NZ', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'New Zealand', 'escape' => false));
                echo $this->Html->link('<p>Sydney <span class="badge pull-right bg-white text-success">0</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Sydney', 'escape' => false));
                echo $this->Html->link('<p>Melbourne <span class="badge pull-right bg-white text-success">' . $melbourne_count . '</span> </p>', '/my-hotels/city_code:9AJ', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Melbourne', 'escape' => false));
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
                echo $this->Html->link('<h4>Far East Hotels<span class="pull-right">0</span></h4>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Far East Hotels', 'escape' => false));
                echo $this->Html->link('<p>Malaysia <span class="badge pull-right bg-white text-success">' . $malaysia_count . '</span> </p>', '/my-hotels/country_code:MY', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Malaysia', 'escape' => false));
                echo $this->Html->link('<p>Indonesia <span class="badge pull-right bg-white text-success">0</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Indonesia', 'escape' => false));
                echo $this->Html->link('<p>Singapore <span class="badge pull-right bg-white text-success">' . $singapore_count . '</span> </p>', '/my-hotels/country_code:SG', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Singapore', 'escape' => false));
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
                echo $this->Html->link('<h4>Other Top Destinations<span class="pull-right">0</span></h4>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Other Top Destinations', 'escape' => false));
                echo $this->Html->link('<p>Maldives <span class="badge pull-right bg-white text-success">' . $maldives_count . '</span> </p>', '/my-hotels/country_code:MV', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Maldives', 'escape' => false));
                echo $this->Html->link('<p>Sri Lanka <span class="badge pull-right bg-white text-success">' . $srilanka_count . '</span> </p>', '/my-hotels/country_code:LK', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Sri Lanka', 'escape' => false));
                echo $this->Html->link('<p>Hong Kong <span class="badge pull-right bg-white text-success">0</span> </p>', '#', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Hong Kong', 'escape' => false));
                ?>
            </div>
        </div>
    </div>	
</div>