<?php
$this->Html->addCrumb('My Suburbs', 'javascript:void(0);', array('class' => 'breadcrumblast'));
?>    

<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    //echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span>My Suburbs</h4>
            
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel_controls hideform">
<?php
                echo $this->Form->create('Report', array('controller' => 'reports','action' => 'suburb_list','class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )
                   
                    )
                        
                        );
                echo $this->Form->hidden('model_name', array('id' => 'model_name', 'value' => 'TravelHotelLookup'));
                ?> 
         <div class="row spe-row">
                    <div class="col-sm-4 col-xs-8">

                        <?php echo $this->Form->input('TravelSuburb.name', array('value' => $name, 'placeholder' => 'Type suburb name', 'error' => array('class' => 'formerror'))); ?>
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
                        <?php echo $this->Form->input('TravelSuburb.continent_id', array('options' => $TravelLookupContinents, 'empty' => '--Select--', 'value' => $continent_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Country:</label>
                        <?php echo $this->Form->input('TravelSuburb.country_id', array('options' => $TravelCountries, 'empty' => '--Select--', 'value' => $country_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Province:</label>
                        <?php echo $this->Form->input('TravelSuburb.province_id', array('options' => $Provinces, 'empty' => '--Select--', 'value' => $province_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">City:</label>
                        <?php echo $this->Form->input('TravelSuburb.city_id', array('options' => $TravelCities, 'empty' => '--Select--', 'value' => $city_id)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">WTB Status:</label>
                        <?php echo $this->Form->input('TravelSuburb.wtb_status', array('options' => array('1' => 'Active', '2' => 'Inactive'), 'empty' => '--Select--', 'value' => $wtb_status)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Active:</label>
                        <?php echo $this->Form->input('TravelSuburb.active', array('options' => array('TRUE' => 'TRUE', 'FALSE' => 'FALSE'), 'empty' => '--Select--', 'value' => $active)); ?>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Status:</label>
                        <?php echo $this->Form->input('TravelSuburb.status', array('options' => array('1' => 'Active', '2' => 'Inactive'), 'empty' => '--Select--', 'value' => $status)); ?>
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
           <?php 
                echo $this->Form->create('Report', array('controller' => 'reports','action' => 'suburb_delete','onsubmit' => 'return ChkCheckbox()','class' => 'quick_search', 'id' => 'SearchForm', 'type' => 'post', 'novalidate' => true, 'inputDefaults' => array(
                        'label' => false,
                        'div' => false,
                        'class' => 'form-control',
                )
                   
                    )
                        
                        );
                
              ?>
            <div-1 class="row" style="padding: 15px;">
        <div class="col-sm2">
            <?php if($user_id == '169'){ 
                echo $this->Form->submit('Delete', array('class' => 'success btn', 'div' => false, 'id' => 'udate_unit')); ?><?php
            }?>
                            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> 
                                    <?php if($user_id == '169' || $user_id == '209'){
                                       echo $this->Html->link('Add Suburb','/travel_suburbs/add', array('escape' => false,'target' => '_blank')); ?><?php
                                    }           
                                    ?>
                            </span>            
        </div>
 
    </div> 
            
          <table border="0" cellpadding="0" cellspacing="0" id="resp_table" class="table toggle-square myclitb" data-filter="#table_search" data-page-size="2000">
                <thead>
                    <tr class="footable-group-row">
                        <th data-group="group1" colspan="7" class="nodis">Suburb Information</th>
                        <th data-group="group2" colspan="3">Suburb Status</th>
                        <th data-group="group3" class="nodis">Suburb Action</th>
                    </tr>
                    <tr>
                        <th data-hide="phone" width="2%" data-sort-ignore="true" data-group="group1"><input type="checkbox" class="mbox_select_all" name="msg_sel_all"></th>
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('id', 'Id'); echo ($sort == 'id') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('continent_name', 'Continent'); echo ($sort == 'continent_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('TravelCountry.country_name', 'Country'); echo ($sort == 'TravelCountry.country_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('TravelCountry.province_name', 'Province'); echo ($sort == 'TravelCountry.province_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('TravelCity.city_name', 'City'); echo ($sort == 'TravelCity.city_name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>           
                        <th data-toggle="phone" data-sort-ignore="true" data-group="group1"><?php echo $this->Paginator->sort('name', 'Suburb'); echo ($sort == 'name') ? ($direction == 'asc') ? " <i class='icon-caret-up'></i>" : " <i class='icon-caret-down'></i>" : " <i class='icon-sort'></i>"; ?></th>
                  
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Status</th> 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">WTB Status</th> 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group2">Active</th> 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Hotel Count</th> 
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Area Count</th>
                        <th data-hide="phone" data-sort-ignore="true" data-group="group3">Action</th>   

                    </tr>
                </thead>
                <tbody>
                    <?php
                    //pr($TravelSuburbs);
                    //die;
                    $sum = 0;
                    $sum1 = 0;
                    $useless = 888888;                   
                    if (isset($TravelSuburbs) && count($TravelSuburbs) > 0):
                        foreach ($TravelSuburbs as $TravelSuburb):
                            $id = $TravelSuburb['TravelSuburb']['id'];
                            if ($TravelSuburb['TravelSuburb']['status'] == '1') {
                                $status = 'OK';
                                $tb_class = 'active';
                            } else {
                                $status = 'ERROR';
                                $tb_class = 'inactive';
                            }

                            if ($TravelSuburb['TravelSuburb']['wtb_status'] == '1') {
                                $wtb_status = 'OK';
                                $wtb_class = 'active';
                            } else {
                                $wtb_status = 'ERROR';
                                $wtb_class = 'inactive';
                            }
                            ?>
                            <tr>
                                <td class="tablebody"><?php											
                                echo $this->Form->checkbox('check', array('name' => 'data[TravelSuburb][check][]','class' => 'msg_select','readonly' => true,'hiddenField' => false,'value' => $id));
                                ?></td>
                               <td><?php echo $id; ?></td>
                               <td><?php echo $TravelSuburb['TravelSuburb']['continent_name']; ?></td>
                                <td><?php echo $TravelSuburb['TravelCountry']['country_name']; ?></td>
                                <td><?php echo $TravelSuburb['TravelSuburb']['province_name']; ?></td>
                                <td><?php echo $TravelSuburb['TravelCity']['city_name']; ?></td>
                                <td><?php echo $TravelSuburb['TravelSuburb']['name']; ?></td>                               

                                <td class="<?php echo $tb_class; ?>"><?php echo $status; ?></td>
                                <td class="<?php echo $wtb_class; ?>"><?php echo $wtb_status; ?></td>
                                <td><?php echo $TravelSuburb['TravelSuburb']['active']; ?></td>
                                <td><?php 
                                $sum = $sum + count($TravelSuburb['TravelHotelLookup']); 
                                //echo count($TravelSuburb['TravelHotelLookup']);
                                echo $this->Html->link(count($TravelSuburb['TravelHotelLookup']), array('controller' => 'reports', 'action' => 'hotel_summary/suburb_id:'.$TravelSuburb['TravelSuburb']['id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                ?></td>
                                <td><?php $sum1 = $sum1 + count($TravelSuburb['TravelArea']);  //echo count($value['TravelArea']);
echo $this->Html->link(count($TravelSuburb['TravelArea']), array('controller' => 'reports', 'action' => 'area_list/suburb_id:'.$TravelSuburb['TravelSuburb']['id'].'/city_id:'.$TravelSuburb['TravelSuburb']['city_id'].'/province_id:'.$TravelSuburb['TravelSuburb']['province_id'].'/country_id:'.$TravelSuburb['TravelSuburb']['country_id'].'/continent_id:'.$TravelSuburb['TravelSuburb']['continent_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
 ?></td>
                                <td width="10%" valign="middle" align="center">

                                    <?php if($user_id == '169'){                                    
                                    echo $this->Html->link('<span class="icon-pencil"></span>', array('controller' => 'reports', 'action' => 'suburb_edit/' . $id,), array('class' => 'act-ico', 'escape' => false));
                                   echo $this->Html->link('<span class="icon-remove"></span>', array('controller' => 'reports', 'action' => 'delete_suburb', $TravelSuburb['TravelSuburb']['id']), array('class' => 'act-ico', 'escape' => false), "Are you sure you wish to delete this suburb?");
                                   echo $this->Html->link('Mass Update', '/mass_operations/hotel/city_id:'.$TravelSuburb['TravelSuburb']['city_id'].'/country_id:'.$TravelSuburb['TravelSuburb']['country_id'].'/province_id:'.$TravelSuburb['TravelSuburb']['province_id'].'/continent_id:'.$TravelSuburb['TravelSuburb']['continent_id'].'/suburb_id:'.$TravelSuburb['TravelSuburb']['id'].'/area_id:'.$useless,array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));                                    
                                    }
                                    ?>
                                </td>


                            </tr>
                        <?php endforeach; ?>

                        <?php
                        //echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="11" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
            <table class="table toggle-square" style="margin-top:-16px !important">
<tbody>
                            <tr>
                                <td  width="61.29%">Total</td>
                               
                                <td width="7%"><?php 
                                echo $this->Html->link($sum, array('controller' => 'reports', 'action' => 'hotel_summary/city_id:'.$TravelSuburb['TravelSuburb']['city_id'].'/province_id:'.$TravelSuburb['TravelSuburb']['province_id'].'/country_id:'.$TravelSuburb['TravelSuburb']['country_id'].'/continent_id:'.$TravelSuburb['TravelSuburb']['continent_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));
                                ?></td>                                
                                
                                <td width="7%"><?php 
                                echo $this->Html->link($sum1, array('controller' => 'reports', 'action' => 'area_list/city_id:'.$TravelSuburb['TravelSuburb']['city_id'].'/province_id:'.$TravelSuburb['TravelSuburb']['province_id'].'/country_id:'.$TravelSuburb['TravelSuburb']['country_id'].'/continent_id:'.$TravelSuburb['TravelSuburb']['continent_id']), array('class' => 'act-ico', 'escape' => false,'target' => '_blank'));        
                                ?></td>
                                
                                <td  width="7%">&nbsp;</td>
                            </tr>

</tbody>
            </table>
            <?php echo $this->Form->end(); ?>
        </div> 
    </div>
</div>


<?php
$this->Js->get('#TravelSuburbContinentId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_country_by_continent_id/TravelSuburb/continent_id'
                ), array(
            'update' => '#TravelSuburbCountryId',
            'async' => true,
            'before' => 'loading("TravelSuburbCountryId")',
            'complete' => 'loaded("TravelSuburbCountryId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
        ))
);

$this->Js->get('#TravelSuburbCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_province_by_continent_country/Report/continent_id/country_id'
                ), array(
            'update' => '#TravelSuburbProvinceId',
            'async' => true,
            'before' => 'loading("TravelSuburbProvinceId")',
            'complete' => 'loaded("TravelSuburbProvinceId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $data
        ))
);
$this->Js->get('#TravelSuburbCountryId')->event('change', $this->Js->request(array(
            'controller' => 'all_functions',
            'action' => 'get_travel_city_by_country_id/TravelSuburb/country_id'
                ), array(
            'update' => '#TravelSuburbCityId',
            'async' => true,
            'before' => 'loading("TravelSuburbCityId")',
            'complete' => 'loaded("TravelSuburbCityId")',
            'method' => 'post',
            'dataExpression' => true,
            'data' => $this->Js->serializeForm(array(
                'isForm' => true,
                'inline' => true
            ))
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
                        var agree=confirm("WARNING! You are about to delete "+ numberOfChecked +" suburbs. Are you sure?");
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