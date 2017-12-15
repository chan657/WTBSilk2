<?php
$url = $this->here;
$arr = explode("/", $url);
$page_url = end($arr);
$aaray = explode(':', $page_url);
$cur_page = $aaray[0];
?>
<div class="row">
    <div class="col-md-4 <?php if ($cur_page == 'proj_highendresidential') { ?>active <?php } ?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
                <?php
                
                echo $this->Html->link('<h4>Supplier Countries<span class="pull-right">'.$SupplierCountryCount.'</span></h4>', '/admin/supplier_country', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Projects', 'escape' => false));
                //echo $this->Html->link('<p>Yes <span class="badge pull-right bg-white text-success">'.$highend_yes.'</span> </p>', '/my-projects/proj_highendresidential:1', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Approved','escape' => false));
                //echo $this->Html->link('<p>No <span class="badge pull-right bg-white text-success">'.$highend_no.'</span> </p>', '/my-projects/proj_highendresidential:2', array('data-toggle' => 'tooltip','data-placement' => 'right','title' => 'Pending','escape' => false));
                ?>
            </div>
        </div>


    </div>
    <div class="col-md-4 <?php if ($cur_page == 'category_id') { ?>active<?php } ?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
<?php echo $this->Html->link('<h4>Supplier Cities<span class="pull-right">'.$SupplierCityCount.'</span></h4>', '/admin/supplier_city', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Projects', 'escape' => false));
?>
            </div>
        </div>
    </div>
    <div class="col-md-4 <?php if ($cur_page == 'category_id') { ?>active<?php } ?>">
        <div class="info-box  bg-info  text-white" id="initial-tour">
            <div class="info-icon bg-info-dark">
                <span aria-hidden="true" class="icon icon-layers"></span>
            </div>
            <div class="info-details">
<?php echo $this->Html->link('<h4>Supplier Hotels<span class="pull-right">'.$SupplierHotelCount.'</span></h4>', '/admin/supplier_hotels', array('data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => 'My Projects', 'escape' => false));
?>
            </div>
        </div>
    </div>
</div> 