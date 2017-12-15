<?php $this->Html->addCrumb('My PackageStandardMasters', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Areas</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Package', '/package_standard_masters/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('PackageStandardMaster', array('class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 

                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('area_name', array('value' => '', 'placeholder' => '--Input Text Area--', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <!--  <div class="row" id="search_panel_controls">
                      
                      <div class="col-sm-3 col-xs-6">
                          <label for="un_member">Continent:</label>
                <?php echo $this->Form->input('continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'value' => $continent_id)); ?>
                      </div>
  
                      <div class="col-sm-3 col-xs-6">
                          <label for="un_member">Country:</label>
                <?php echo $this->Form->input('country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'value' => $country_id)); ?>
                      </div>
  
                      <div class="col-sm-3 col-xs-6">
                          <label for="un_member">City:</label>
                <?php echo $this->Form->input('city_id', array('options' => $TravelCities, 'empty' => '--Select--', 'value' => $city_id)); ?>
                      </div>
  
                      <div class="col-sm-3 col-xs-6">
                          <label for="un_member">Suburb:</label>
                <?php echo $this->Form->input('suburb_id', array('options' => $TravelSuburbs, 'empty' => '--Select--', 'value' => $suburb_id)); ?>
                      </div>
  
  
  
                      <div class="col-sm-3 col-xs-6">
                          <label>&nbsp;</label>
                <?php
                echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
// echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm"'));
                ?>
  
                      </div>
                  </div> -->
                <?php echo $this->Form->end(); ?>
            </div>
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr>
                        
                        <th data-toggle="phone" data-sort-ignore="true">StandardPackageCode</th>
                        <th data-toggle="phone" data-sort-ignore="true">StandardPackageName</th>
                        <th data-hide="phone" data-sort-ignore="true">SellingCurrency</th>
                        <th data-hide="phone" data-sort-ignore="true">PackageTypeCode</th>
                        <th data-hide="phone" data-sort-ignore="true">NoOfCities</th>     
                        <th data-hide="phone" data-sort-ignore="true">NoOfHotels</th>
                        <th data-hide="phone" data-sort-ignore="true">PackageNoofPax</th>
                        <th data-hide="phone" data-sort-ignore="true">PackageNoofAdults</th>
                        <th data-hide="all" data-sort-ignore="true">PackageNoofChilds</th>
                        <th data-hide="all" data-sort-ignore="true">PackageNoofAdultsMax</th>
                        <th data-hide="all" data-sort-ignore="true">PackageNoofChildsMax</th>
                        <th data-hide="all" data-sort-ignore="true">PackageValidFrom</th>
                        <th data-hide="all" data-sort-ignore="true">PackageValidTo</th>
                        <th data-hide="all" data-sort-ignore="true">PackageCost</th>
                        <th data-hide="all" data-sort-ignore="true">PackageCostBuy</th>
                        <th data-hide="all" data-sort-ignore="true">PackageCurrency</th>
                        <th data-hide="all" data-sort-ignore="true">PackageCurrencyBuy</th>
                        <th data-hide="all" data-sort-ignore="true">PackageTypeInternalCode</th>
                        <th data-hide="phone" data-sort-ignore="true">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($PackageStandardMasters) && count($PackageStandardMasters) > 0):
                        foreach ($PackageStandardMasters as $PackageStandardMaster):
                            $id = $PackageStandardMaster['PackageStandardMaster']['id'];
                            ?>
                            <tr>
                                
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['StandardPackageCode']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['StandardPackageName']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['SellingCurrency']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['PackageTypeCode']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['NoOfCities']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['NoOfHotels']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['PackageNoofPax']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['PackageNoofAdults']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['PackageNoofChilds']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['PackageNoofAdultsMax']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['PackageNoofChildsMax']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['PackageValidFrom']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['PackageValidTo']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['PackageCost']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['PackageCostBuy']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['PackageCurrency']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['PackageCurrencyBuy']; ?></td>
                                <td><?php echo $PackageStandardMaster['PackageStandardMaster']['PackageTypeInternalCode']; ?></td>
                                <td>
                                    <?php
                                    echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'package_standard_masters', 'action' => 'edit/' . $id), array('class' => 'act-ico', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Edit', 'escape' => false));
                                    ?>                                   
                                </td>
                            </tr>
    <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="19" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
            <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Package', '/package_standard_masters/add') ?></span>

        </div>
    </div>
</div>
