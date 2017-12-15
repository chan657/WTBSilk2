<?php $this->Html->addCrumb('Province Permissions', 'javascript:void(0);', array('class' => 'breadcrumblast')); 
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo count($ProvincePermissions);
                    ?></span>Province Permissions</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Province Permissions', '/province_permissions/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">          
            <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="1000">
                <thead>
                    <tr>           
                        <th data-toggle="phone"  data-sort-ignore="true">User Name</th>   
                        <th data-toggle="phone"  data-sort-ignore="true">Continent</th>
                        <th data-toggle="phone"  data-sort-ignore="true">Country</th>
                        <th data-toggle="phone"  data-sort-ignore="true">Approver</th>
                        <th data-toggle="phone"  data-sort-ignore="true">Mapping Approver</th>
                        <th data-toggle="phone"  data-sort-ignore="true">Province</th>  
                        
                        <th data-hide="phone" data-sort-ignore="true">Action</th>                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //pr($ProvincePermissions);
                    //die;
                    if (isset($ProvincePermissions) && count($ProvincePermissions) > 0):
                        foreach ($ProvincePermissions as $ProvincePermission):
                            $user_id = $ProvincePermission['ProvincePermission']['user_id'];
                            $continent_id = $ProvincePermission['ProvincePermission']['continent_id'];
                            $country_id = $ProvincePermission['ProvincePermission']['country_id'];
                            ?>
                            <tr>
                              
                                <td><?php echo $ProvincePermission['User']['fname'].' '.$ProvincePermission['User']['lname']; ?></td>
                                <td><?php echo $ProvincePermission['TravelLookupContinent']['continent_name']; ?></td>
                                <td><?php echo $ProvincePermission['TravelCountry']['country_name']; ?></td>
                                
                                <td><?php echo ($ProvincePermission['ProvincePermission']['maaping_approval_id']) ? $this->Custom->Username($ProvincePermission['ProvincePermission']['approval_id']) : ''; ?></td>
                                <td><?php echo ($ProvincePermission['ProvincePermission']['maaping_approval_id']) ? $this->Custom->Username($ProvincePermission['ProvincePermission']['maaping_approval_id']) : ''; ?></td>
                                <td><?php echo $ProvincePermission[0]['province_name']; ?></td>
                                
                                                                           
                                <td width="10%" valign="middle" align="center">
                                    <?php                                   
                                        echo $this->Html->link('Edit', '/province_permissions/edit/user_id:' . $user_id.'/continent_id:'.$continent_id.'/country_id:'.$country_id, array('class' => 'btn btn-success'));
                                    ?>
                                </td>                               
                            </tr>
                        <?php endforeach; ?>

                        <?php
                        //echo $this->element('paginate');
                    else:
                        echo '<tr><td colspan="3" class="norecords">No Records Found</td></tr>';
                    endif;
                    ?>
                </tbody>
            </table>
            

        </div>
    </div>
</div>


