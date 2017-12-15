<?php $this->Html->addCrumb('WTB Error', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>
<div class="row">
    <div class="col-sm-12"> 
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span>WTB Error</h4>
           
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
<!--
            <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('TravelWtbError', array('controller' => 'travel_suburbs', 'action' => 'index', 'class' => 'quick_search', 'id' => 'SearchForm', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
                ?> 

                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('name', array('value' => $name, 'placeholder' => 'Type suburb name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Suburb Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">
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
                        <label for="un_member">Top Neighborhood:</label>
                        <?php echo $this->Form->input('top_neighborhood', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--', 'value' => $top_neighborhood)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Active:</label>
                        <?php echo $this->Form->input('active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--', 'value' => $active)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Status:</label>
                        <?php echo $this->Form->input('status', array('options' => array('1' => 'Active', '2' => 'Inactive'), 'empty' => '--Select--', 'value' => $status)); ?>
                    </div>




                    <div class="col-sm-3 col-xs-6">
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
// echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div> -->
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="500">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="9" class="nodis">Suburb Information</th>
                        
                    </tr>
                    <tr>
                        <th data-toggle="phone" data-sort-ignore="true" width="5%" data-group="group1"><?php echo $this->Paginator->sort('id', 'Error Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" width="10%" data-group="group1"><?php echo $this->Paginator->sort('error_topic', 'Error Topic'); echo ($sort == 'error_topic') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" width="8%" data-group="group1"><?php echo $this->Paginator->sort('error_by', 'Error By'); echo ($sort == 'error_by') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" width="10%" data-group="group1"><?php echo $this->Paginator->sort('error_time', 'Error Time'); echo ($sort == 'error_time') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" width="8%" data-group="group1"><?php echo $this->Paginator->sort('fixed_by', 'Fixed By'); echo ($sort == 'fixed_by') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>           

                        <th data-hide="phone" data-sort-ignore="true" width="10%" data-group="group1">Fixed Time</th>
                        <th data-hide="phone" data-sort-ignore="true" width="5%" data-group="group1">Log Id</th>
                        <th data-hide="phone" data-sort-ignore="true" width="5%" data-group="group1">Status</th> 
                        <th data-hide="phone" data-sort-ignore="true" width="15%" data-group="group1">Error Entity</th> 
                        <th data-hide="phone" data-sort-ignore="true" width="5%" data-group="group1">Action</th>  

                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($TravelWtbErrors) && count($TravelWtbErrors) > 0):
                        foreach ($TravelWtbErrors as $TravelWtbError):
                            $id = $TravelWtbError['TravelWtbError']['id'];
                            $error_entity = $TravelWtbError['TravelWtbError']['error_entity'];
                            $error_type = $TravelWtbError['TravelWtbError']['error_type'];
							$page_url = $TravelWtbError['TravelWtbError']['page_url'];
                            ?>
                            <tr>
                               <td><?php echo $id; ?></td>
                                <td><?php echo $TravelWtbError['TravelLookupErrorTopic']['value']; ?></td>
                                <td><?php echo $this->Custom->Username($TravelWtbError['TravelWtbError']['error_by']); ?></td>
                                <td><?php echo $TravelWtbError['TravelWtbError']['error_time']; ?></td>
                                <td><?php if($TravelWtbError['TravelWtbError']['fixed_by']) echo $this->Custom->Username($TravelWtbError['TravelWtbError']['fixed_by']); ?></td>

                                <td><?php echo $TravelWtbError['TravelWtbError']['fixed_time']; ?></td>
                                <td><?php echo $TravelWtbError['TravelWtbError']['log_id']; ?></td>
                                
                                <td><?php echo $TravelWtbError['TravelLookupErrorStatus']['value']; ?></td>

                                <td width="10%" valign="middle" align="center">

                                    <?php
                                    if($error_type == '1') //continent
                                        echo $this->Custom->getContinentName($error_entity);
                                    elseif($error_type == '2') //Country
                                        echo $this->Custom->getCountryName($error_entity);
                                    elseif($error_type == '3') //Province
                                        echo $this->Custom->getProvinceName($error_entity);
                                    elseif($error_type == '4') //City
                                        echo $this->Custom->getCitytName($error_entity);
                                    elseif($error_type == '5') //Suburb
                                        echo $this->Custom->getSuburbName($error_entity);
                                    elseif($error_type == '6') //Area
                                        echo $this->Custom->getAreaName($error_entity);
                                    elseif($error_type == '7') //Chain
                                        echo $this->Custom->getChainName($error_entity);
                                    elseif($error_type == '8') //Brand
                                        echo $this->Custom->getBrandName($error_entity);
                                    elseif($error_type == '9') //Hotel
                                        echo $this->Custom->getHotelName($error_entity);
                                    elseif($error_type == '10') //Hotel MApping
                                         echo $this->Custom->getHotelMappingName($error_entity);
                                    elseif($error_type == '11') //Country MApping
                                         echo $this->Custom->getCountryMappingName($error_entity);
                                    elseif($error_type == '12') //City MApping
                                        echo $this->Custom->getCityMappingName($error_entity);  
									elseif($error_type == '13') //Hotal Review
                                        echo $this->Custom->getHotalName($error_entity);  										
                                       ?>
                                </td>
                                <td>
                                    <?php if($TravelWtbError['TravelWtbError']['error_status'] == '1'){
                                        if($error_type == '1') //continent
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'retry/' . $error_entity), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    elseif($error_type == '2') //Country
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'retry/' . $error_entity), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    elseif($error_type == '3') //Province
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'retry/' . $error_entity), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    elseif($error_type == '4') //City
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'retry/' . $error_entity), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    elseif($error_type == '5') //Suburb
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'retry/' . $error_entity), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    elseif($error_type == '6') //Area
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'retry/' . $error_entity), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    elseif($error_type == '7') //Chain
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'retry/' . $error_entity), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    elseif($error_type == '8') //Brand
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_lookup_continents', 'action' => 'retry/' . $error_entity), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    elseif($error_type == '9') //Hotel
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_hotel_lookups', 'action' => 'retry/' . $error_entity.'/'.$id), array('class' => 'act-ico','data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                    elseif($error_type == '10') //Hotel MApping
                                         echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'mappinges', 'action' => 'edit/' . $error_entity . '/TravelHotelRoomSupplier'), array('class' => 'act-ico', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Mapping', 'escape' => false));
                                    elseif($error_type == '11') //Country MApping
                                         echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'mappinges', 'action' => 'edit/' . $error_entity . '/TravelHotelRoomSupplier'), array('class' => 'act-ico', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Mapping', 'escape' => false));
                                    elseif($error_type == '12') //City MApping
                                         echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'mappinges', 'action' => 'edit/' . $error_entity . '/TravelHotelRoomSupplier'), array('class' => 'act-ico', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Mapping', 'escape' => false));
                                    elseif($error_type == '13') //City MApping
                                         echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'travel_hotel_reviews', 'action' =>$page_url.'/wtb_error_id:'.$id), array('class' => 'act-ico', 'data-toggle' => 'tooltip', 'data-placement' => 'left', 'title' => 'Re-try Operation', 'escape' => false));
                                        
                                    }
                                    ?>
                                </td>


                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="11" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
            

        </div>
    </div>
</div>

