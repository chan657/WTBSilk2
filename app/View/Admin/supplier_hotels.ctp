<?php
$this->Html->addCrumb('My Supplier Hotels', 'javascript:void(0);', array('class' => 'breadcrumblast'));
echo $this->element('FetchAreas/top_menu');
?>


<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span> My Fetch Area</h4>
                    <?php if ($role_id == '64') {    ?>                           
                        <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Supplier Hotel', '/admin/add_hotel') ?></span>
                    <?php } ?>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">
		
		<div class="panel_controls hideform">
		   <?php
                echo $this->Form->create('SupplierHotel', array('paramType' => 'querystring',  'class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )));
             
                ?> 
		
			<div class="row" id="search_panel_controls">
                   
				<div class="col-sm-3 col-xs-6">
					<label for="un_member">Supplier:</label>
					<?php echo $this->Form->input('supplier_id', array('options' => $TravelSuppliers, 'empty' => '--Select--')); ?>
				</div>
				
				<div class="col-sm-3 col-xs-6">
					<label for="un_member">Country:</label>
					<?php echo $this->Form->input('country_id', array('options' => $SupplierCountries, 'empty' => '--Select--','data-required' => 'false')); ?>
				</div>				
			
				<div class="col-sm-3 col-xs-6">
					<label for="un_member">City:</label>
					<?php
							echo $this->Form->input('city_id', array('options' => array(), 'empty' => '--Select--', 'data-required' => 'true'));
							?>
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
		</div>
		
            <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="1000">
                <thead>
                  
                    <tr>
                        <th data-toggle="true" data-sort-ignore="true" width="3%" data-group="group1"><?php echo $this->Paginator->sort('id', 'Hotel Id');
                echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-sort-ignore="true" width="15%" data-group="group1"><?php echo $this->Paginator->sort('hotel_name', 'Hotel Name');
                echo ($sort == 'hotel_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-group="group1" width="30%" data-sort-ignore="true"><?php echo $this->Paginator->sort('address', 'Sup. Hotel Address');
                        echo ($sort == 'hotel_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-toggle="phone" data-group="group1" width="10%" data-sort-ignore="true"><?php echo $this->Paginator->sort('hotel_code', 'Sup. Hotel Code');
                echo ($sort == 'hotel_code') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>                    
                       
                        <th data-hide="phone" data-group="group9" width="10%" data-sort-ignore="true"><?php echo $this->Paginator->sort('country_name', 'Sup. Country');
                echo ($sort == 'country_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-group="group9" width="10%" data-sort-ignore="true"><?php echo $this->Paginator->sort('country_code', 'Sup. Country Code');
                echo ($sort == 'country_code') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        
                        <th data-hide="phone" data-group="group9" width="8%" data-sort-ignore="true"><?php echo $this->Paginator->sort('city_name', 'Sup. City');
                echo ($sort == 'city_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                 <th data-hide="phone" data-group="group9" width="8%" data-sort-ignore="true"><?php echo $this->Paginator->sort('city_code', 'Sup. City Code');
                echo ($sort == 'city_code') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>"  : " <i class='icon-sort'></i>"; ?></th>
                        

                        <th data-hide="phone" data-group="group10" width="5%" data-sort-ignore="true">Duplicate of</th>
                        <th data-hide="phone" data-group="group10" width="5%" data-sort-ignore="true">Status</th>
                        <th data-hide="phone" data-group="group10" width="5%" data-sort-ignore="true">No. Of Mapping</th>
                   
                        <th data-group="group8" data-hide="phone" data-sort-ignore="true" width="7%">Action</th> 

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
	//pr($SupplierHotels);
                    $secondary_city = '';

                    if (isset($SupplierHotels) && count($SupplierHotels) > 0):
                        foreach ($SupplierHotels as $SupplierHotel):
                            $id = $SupplierHotel['SupplierHotel']['id'];

                           
                            ?>
                            <tr>
                                <td class="tablebody"><?php echo $id; ?></td>
                                <td class="tablebody"><?php echo $SupplierHotel['SupplierHotel']['hotel_name']; ?></td>               
                                <td class="tablebody"><?php echo $SupplierHotel['SupplierHotel']['address']; ?></td>                                  
                                <td class="tablebody"><?php echo $SupplierHotel['SupplierHotel']['hotel_code']; ?></td>                                                               
                               
                                <td class="sub-tablebody"><?php echo $SupplierHotel['SupplierHotel']['country_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $SupplierHotel['SupplierHotel']['country_code']; ?></td>
                              
                                <td class="sub-tablebody"><?php echo $SupplierHotel['SupplierHotel']['city_name']; ?></td>
                                <td class="sub-tablebody"><?php echo $SupplierHotel['SupplierHotel']['city_code']; ?></td>

                                <td class="tablebody">
                                    <?php echo $this->Html->link($SupplierHotel['SupplierHotel']['duplicate_of'], array('controller' => 'admin', 'action' => 'supplier_hotels/id:'.$SupplierHotel['SupplierHotel']['duplicate_of']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank')); ?>
                                </td>
                                
                                <td class="sub-tablebody"><?php echo $SupplierHotel['TravelSupplierStatus']['value']; ?></td>
                                <td class="tablebody"><?php 
                                
                                if(count($SupplierHotel['TravelHotelRoomSupplier']) > 0) echo $this->Html->link(count($SupplierHotel['TravelHotelRoomSupplier']), array('controller' => 'travel_hotel_lookups', 'action' => 'view_supplier_mapping/' . $id), array('class' => 'act-ico open-popup-link add-btn', 'escape' => false)); else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0';
                                ?></td>

                                <td valign="middle" align="center">

                                    <?php if ($role_id == '64' || $role_id == '65' || $role_id == '28') {
                                    if($SupplierHotel['SupplierHotel']['status'] == '1' || $SupplierHotel['SupplierHotel']['status'] == '5')
                                        echo $this->Html->link('<span class="icon-list"></span>', array('controller' => 'admin', 'action' => 'hotel_mapping/' . $id), array('class' => 'act-ico','target' => '_blank', 'escape' => false));
                                    
                                    } ?> 
                                </td>

                            </tr>
                        <?php endforeach; ?>

                        <?php
                        echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="43" class="norecords">No Records Found</td></tr>';

                    endif;
                    ?>
                </tbody>
            </table> 
            <?php if ($role_id == '64') {    ?>        
                <span class="badge badge-circle add-client"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Supplier Hotel', '/admin/add_hotel') ?></span>
            <?php } ?>

        </div>
    </div>
</div>
 <?php 

$this->Js->get('#SupplierHotelCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_supplier_city_by_country_id/SupplierHotel/country_id'
                ), array(
            'update' => '#SupplierHotelCityId',
            'async' => true,
            'before' => 'loading("SupplierHotelCityId")',
            'complete' => 'loaded("SupplierHotelCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);