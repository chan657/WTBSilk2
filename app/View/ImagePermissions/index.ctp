<?php $this->Html->addCrumb('Image Permissions', 'javascript:void(0);', array('class' => 'breadcrumblast')); 
?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo count($ImagePermissions);
                    ?></span>Image Permissions</h4>
            <span class="badge badge-circle add-client nomrgn"><i class="icon-plus"></i> <?php echo $this->Html->link('Add Image Permissions', '/image_permissions/add') ?></span>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">          
            <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="1000">
                <thead>
                    <tr>           
                        <th data-toggle="phone"  data-sort-ignore="true">User Name</th>   
                        <th data-toggle="phone"  data-sort-ignore="true">Continent</th>
                        <th data-toggle="phone"  data-sort-ignore="true">Country</th>
                       
                        <th data-toggle="phone"  data-sort-ignore="true">Province</th>  
                        
                        <th data-hide="phone" data-sort-ignore="true">Action</th>                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //pr($ImagePermissions);
                    //die;
                    if (isset($ImagePermissions) && count($ImagePermissions) > 0):
                        foreach ($ImagePermissions as $ImagePermission):
                            $user_id = $ImagePermission['ImagePermission']['user_id'];
                            $continent_id = $ImagePermission['ImagePermission']['continent_id'];
                            $country_id = $ImagePermission['ImagePermission']['country_id'];
                            ?>
                            <tr>
                              
                                <td><?php echo $ImagePermission['User']['fname'].' '.$ImagePermission['User']['lname']; ?></td>
                                <td><?php echo $ImagePermission['TravelLookupContinent']['continent_name']; ?></td>
                                <td><?php echo $ImagePermission['TravelCountry']['country_name']; ?></td>                               
                               
                                <td><?php echo $ImagePermission[0]['province_name']; ?></td>
                                
                                                                           
                                <td width="10%" valign="middle" align="center">
                                    <?php                                   
                                        echo $this->Html->link('Edit', '/image_permissions/edit/user_id:' . $user_id.'/continent_id:'.$continent_id.'/country_id:'.$country_id, array('class' => 'btn btn-success'));
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


