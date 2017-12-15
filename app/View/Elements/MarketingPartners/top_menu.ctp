<?php
$url = $this->here;
$arr = explode("/", $url);
$page_url = end($arr);
$aaray = explode(':', $page_url);
$cur_page = $aaray[0];
?>
<div class="row">
    <div class="col-md-4 <?php if ($cur_page == 'my-builders' || $cur_page == 'builder_approved') { ?>active<?php } ?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>All Partners<span class="pull-right">' . $all_count . '</span></h4>', '/my-builders', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
                echo $this->Html->link('<p>Approved <span class="badge pull-right bg-white text-success">' . $approve . '</span> </p>', '/my-builders/builder_approved:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
                echo $this->Html->link('<p>Pending <span class="badge pull-right bg-white text-success">' . $pending . '</span> </p>', '/my-builders/builder_approved:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Builders', 'escape' => false));
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-4 <?php if ($cur_page == 'builder_residential') { ?>active<?php } ?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                echo $this->Html->link('<h4>Multicities<span class="pull-right">' . $multicity_count . '</span></h4>', '/my-builders', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Residential', 'escape' => false));
               
                ?>
            </div>
        </div>


    </div>
    <div class="col-md-4 <?php if ($cur_page == 'builder_commercial') { ?>active<?php } ?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
<?php
echo $this->Html->link('<h4>With Agreements<span class="pull-right">0</span></h4>', '/my-builders', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Commercial', 'escape' => false));
echo $this->Html->link('<p>Yes <span class="badge pull-right bg-white text-success">0</span> </p>', '/my-builders/builder_commercial:1', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Approved', 'escape' => false));
echo $this->Html->link('<p>No <span class="badge pull-right bg-white text-success">0</span> </p>', '/my-builders/builder_commercial:2', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'Pending', 'escape' => false));
?>
            </div>
        </div>


    </div>
</div>
