<?php
$this->Html->addCrumb('My Areas', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>    

<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    //echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span>My Areas</h4>
            
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        
        <div class="panel_controls hideform">

                <?php
                echo $this->Form->create('Report', array('controller' => 'reports','action' => 'area_list','class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )
                   
                    )
                        
                        );
                ?> 

                <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('TravelArea.area_name', array('value' => $area_name, 'placeholder' => 'Type area name', 'error' => array('class' => 'formerror'))); ?>
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <?php
                        echo $this->Form->submit('Area Search', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <div class="row" id="search_panel_controls">
                    
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Continent:</label>
                        <?php echo $this->Form->input('TravelArea.continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'value' => $continent_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('TravelArea.country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'value' => $country_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Province:</label>
                        <?php echo $this->Form->input('TravelArea.province_id', array('options' => $Provinces, 'empty' => '--Select--', 'value' => $province_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('TravelArea.city_id', array('options' => $TravelCities, 'empty' => '--Select--', 'value' => $city_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Suburb:</label>
                        <?php echo $this->Form->input('TravelArea.suburb_id', array('options' => $TravelSuburbs, 'empty' => '--Select--', 'value' => $suburb_id)); ?>
                    </div>


                    <div class="col-sm-3 col-xs-6">
                        <label>&nbsp;</label>
                        <?php
                        echo $this->Form->submit('Filter', array('div' => false, 'class' => 'btn btn-default btn-sm"'));
                        echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-default btn-sm"'));
                        ?>

                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
      

           <?php
                echo $this->Form->create('Report', array('controller' => 'reports','action' => 'area_delete','onsubmit' => 'return ChkCheckbox()','class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )
                   
                    )
                        
                        );
              ?>
            <div class="row" style="padding: 15px;">
        <div class="col-sm-12">
            <?php if($user_id == '169'){ 
                echo $this->Form->submit('Delete', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
            }?>
                            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> 
                                    <?php if($user_id == '169' || $user_id == '209'){
                                       echo $this->Html->link('Add Area','/travel_areas/add', array('escape' => false,'target' => '_blank')); ?><?php
                                    }           
                                    ?>
                            </span>            
        </div>
    </div> 
            
          <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="2000">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="8" class="nodis">Area Information</th>
                        <th data-group="group2" colspan="3">Area Status</th>
                        <th data-group="group3" class="nodis">Area Action</th>
                    </tr>
                    <tr>
                        <th data-hide="phone" width="2%" data-sort-ignore="true" data-group="group1"><input type="checkbox" class="mbox_select_all" name="msg_sel_all"></th>
                        <th data-hide="phone" data-group="group1">Id</th>
                        <th data-hide="phone" data-group="group1">Continent</th>
                        <th data-hide="phone" data-group="group1">Country</th>                        
                        <th data-hide="phone" data-group="group1">Province</th>
                        <th data-hide="phone" data-group="group1">City</th>                  
                        <th data-toggle="phone" data-group="group1">Suburb</th>
                        <th data-toggle="phone" data-group="group1">Area</th>
                        
                        
                        

                        
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">WTB Status</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Active</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Hotel Count</th> 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Action</th>   

                    </tr>
                </thead>
                <tbody>
                    <?php
                    //pr($TravelAreas);
                    //die;
                    $sum = 0;
                    if (isset($TravelAreas) && count($TravelAreas) > 0):
                        foreach ($TravelAreas as $TravelArea):
                            $id = $TravelArea['TravelArea']['id'];
                            if ($TravelArea['TravelArea']['area_status'] == '1') {
                                $status = 'OK';
                                $tb_class = 'active';
                            } else {
                                $status = 'ERROR';
                                $tb_class = 'inactive';
                            }

                            if ($TravelArea['TravelArea']['wtb_status'] == '1') {
                                $wtb_status = 'OK';
                                $wtb_class = 'active';
                            } else {
                                $wtb_status = 'ERROR';
                                $wtb_class = 'inactive';
                            }
                            ?>
                            <tr>
                                <td class="tablebody"><?php											
                                echo $this->Form->checkbox('check', array('name' => 'data[TravelArea][check][]','class' => 'msg_select','readonly' => true,'hiddenField' => false,'value' => $id));
                                ?></td>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $TravelArea['TravelArea']['continent_name']; ?></td>
                                <td><?php echo $TravelArea['TravelArea']['country_name']; ?></td>
                                <td><?php echo $TravelArea['TravelArea']['province_name']; ?></td>
                                <td><?php echo $TravelArea['TravelArea']['city_name']; ?></td>
                                <td><?php echo $TravelArea['TravelArea']['suburb_name']; ?></td>
                                <td><?php echo str_replace('?', '', $TravelArea['TravelArea']['area_name']); ?></td>
                            
                                <td class="<?php echo $tb_class; ?>"><?php echo $status; ?></td>
                                <td class="<?php echo $wtb_class; ?>"><?php echo $wtb_status; ?></td>
                                <td><?php echo $TravelArea['TravelArea']['area_active']; ?></td>
                                <td><?php 
                                $sum = $sum + count($TravelArea['TravelHotelLookup']); 
                                //echo count($TravelSuburb['TravelHotelLookup']);
                                echo $this->Html->link(count($TravelArea['TravelHotelLookup']), array('controller' => 'reports', 'action' => 'hotel_summary/area_id:'.$TravelArea['TravelArea']['id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                ?></td>
                               
                                <td width="10%" valign="middle" align="center">

                                    <?php if($user_id == '169'){                                    
                                        echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'reports', 'action' => 'area_edit/' . $id,), array('class' => 'act-ico', 'escape' => false));
                                        echo $this->Html->link('<span class="icon-remove"></span>', array('controller' => 'reports', 'action' => 'delete_area', $TravelArea['TravelArea']['id']), array('class' => 'act-ico', 'escape' => false), "Are you sure you wish to delete this area?");
                                        echo $this->Html->link('Mass Update', '/mass_operations/hotel/city_id:'.$TravelArea['TravelArea']['city_id'].'/country_id:'.$TravelArea['TravelArea']['country_id'].'/province_id:'.$TravelArea['TravelArea']['province_id'].'/continent_id:'.$TravelArea['TravelArea']['continent_id'].'/suburb_id:'.$TravelArea['TravelArea']['suburb_id'].'/area_id:'.$TravelArea['TravelArea']['id'],array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));                                                                            
                                    }
                                    ?> 
                                </td>


                            </tr>
                        <?php endforeach; ?>

                        <?php
                        //echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="12" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>   
        <table class="table toggle-square" style="margin-top:-16px !important">
<tbody>
                            <tr>
                                <td  width="63.29%">Total</td>
                               
                                <td width="7%"><?php echo $sum?></td> 
                                
                                
                                <td  width="7%">&nbsp;</td>
                            </tr>

</tbody>
            </table>
            <?php echo $this->Form->end(); ?>
        </div> 
    
</div>


<?php
$data = $this->Js->get('#SearchForm')->serializeForm(array('isForm' => true, 'inline' => true));

$this->Js->get('#TravelAreaContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/TravelArea/continent_id'
                ), array(
            'update' => '#TravelAreaCountryId',
            'async' => true,
            'before' => 'loading("TravelAreaCountryId")',
            'complete' => 'loaded("TravelAreaCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#TravelAreaCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_country_id/TravelArea/country_id'
                ), array(
            'update' => '#TravelAreaCityId',
            'async' => true,
            'before' => 'loading("TravelAreaCityId")',
            'complete' => 'loaded("TravelAreaCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelAreaCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_continent_country/Report/continent_id/country_id'
                ), array(
            'update' => '#TravelAreaProvinceId',
            'async' => true,
            'before' => 'loading("TravelAreaProvinceId")',
            'complete' => 'loaded("TravelAreaProvinceId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);

$this->Js->get('#TravelAreaCityId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_suburb_by_country_id_and_city_id/TravelArea/country_id/city_id'
                ), array(
            'update' => '#TravelAreaSuburbId',
            'async' => true,
            'before' => 'loading("TravelAreaSuburbId")',
            'complete' => 'loaded("TravelAreaSuburbId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);


?>
<script>
    
    $('.mbox_select_all').click(function () {
					var $this = $(this);
					
					$('#resp_table').find('.msg_select').filter(':visible').each(function() {
						if($this.is(':checked')) {
							$(this).prop('checked',true).closest('tr').addClass('active')
						} else {
							$(this).prop('checked',false).closest('tr').removeClass('active')
						}
					})
					
				});
                                
    function ChkCheckbox(){
	
		if ($("input:checked").length == 0){
			bootbox.alert('No check box are selected.');
			return false;
			}
                else{        
                    
                       var numberOfChecked = $('input:checkbox:checked').length;
                       //alert("WARNING! You are about to delete "+ numberOfChecked +" hotels. Are you sure?");
                        var agree=confirm("WARNING! You are about to delete "+ numberOfChecked +" areas. Are you sure?");
                         //bootbox.confirm("Are you sure?", function(result) {
                            if (agree)
                            return true ;
                        else
                            return false ;
					//bootbox.alert("Confirm result: "+result);
				//}); 
                                               
                }
		
		//return validation();
		
		
	}
    </script>