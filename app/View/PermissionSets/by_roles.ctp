<?php

 //pr($controllersets); 
 //die();
?>

 <?php $this->Html->addCrumb('My Controllers', 'javascript:void(0);', array('class' => 'breadcrumblast')); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="table-heading">
            <h4 class="table-heading-title"><span class="badge badge-circle badge-success"> <?php
                    echo $this->Paginator->counter(array('format' => '{:count}'));
                    ?></span>Permission By Role</h4>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <div class="row" id="search_panel_controls">
                    <!-- <form action="<?php echo Router::url(array('controller' => 'my-permissions/by-roles'));?>" method="post"> -->
                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Role Name:</label>
                        
                        <select id="roleSelectListId" name="roleName" class="form-control" onchange="getAllControllerUnderRole(this.value)">
                            <option value="">--Please select one--</option>
                            <?php
                            
                            foreach ($uniqueRoleList as $rolename) {
                                echo '<option value="'.$rolename['Role']['id'].'">'.$rolename['Role']['role_name'].' / '.$rolename['Role']['id'].'</option>';
                            }
                            ?>
                        </select>


                        
                    </div>
                    <div class="col-sm-3 col-xs-6">
                    <!-- <label>&nbsp;</label>
                        <input type="submit" name="filter" class="btn btn-default btn-sm" value="Filter"> -->

                        <label for="un_member">Controller Name:</label>
                        
                        <select id="controllerSelectListId" name="controllerName" class="form-control" onchange="onChangeControllerSelectList(this.value)">
                            <option value="" >--Please select one--</option>
                        </select>
                        
                    </div>
                  <!-- </form> -->
                </div>

            </div>

            <table id="resp_table" class="table toggle-square allroleListingTable" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr>
                        <th data-sort-ignore="true" data-toggle="true">Role Id</th>
                        <th data-sort-ignore="true" data-hide="phone">Role Name</th>

                        <th data-sort-ignore="true" data-hide="phone">Permission</th>
                    </tr>
                </thead>
                <tbody>
<?php
if (isset($allRoleList) && count($allRoleList) > 0){
    foreach ($allRoleList as $role):
       
        ?>
                            <tr class="filterableTR" data-tableIDByRole="<?php echo $role[0]['Role']['role_name'].'-'.$role[0]['Role']['id']; ?>">
                                <td><?php echo $role[0]['Role']['id']; ?></td>   
                                <td title="<?php echo $role[0]['Role']['role_name']; ?>"><?php echo $role[0]['Role']['role_name']; ?></td>
                                <td>
                                    <table width="100%">
                                    <tr>
                                        <td><b>Controller Name</b></td>
                                        <td><b>Function Permitted</b></td>
                                        <td><b>Action</b></td>
                                    </tr>
                                        <?php
                                        foreach ($role[1] as $controller) {
                                          echo '<tr><td title="'.$controller[0]['ControllerSet']['controller_name'].'">'.$controller[0]['ControllerSet']['controller_name'].'</td>';
                                          echo '<td><table width="100%">';
                                          foreach ($controller[1] as $function) {
                                              echo '<tr><td>'.$function['controller_sets']['action_name'].'</td>
                                              
                                              </tr>';
                                          }
                                          echo '</table></td>';

                                          echo '<td>'.$this->Html->link(
                                                        '<span class="icon-pencil"></span>',
                                                        array('controller' =>'/my-permissions/edit-by-role/'.$role[0]['Role']['id'].':'.$controller[0]['ControllerSet']['id']),
                                                        array('class' => 'button', 'target' => '_blank','escape' => false)
                                                    ).'</td>';
                                         echo  '</tr>';
                                        }

                                        ?>
                                    </table>
                                </td>
                                
                                
                                
                            </tr>
                            <?php endforeach; ?>

                        <?php echo $this->element('paginate'); ?>
                    <?php }else{
                        echo '<tr><td colspan="3">No Data Found</td></tr>';
                        } ?>
                </tbody>
            </table>
           
        </div>
    </div>
</div>


<script type="text/javascript">
    
function getAllControllerUnderRole(id) {
    if(id!='')
    {
        $("#controllerSelectListId").html('<option>Please Wait...</option>');
        $.ajax({
            url:'<?php echo Router::url(array('controller' => 'permission_sets','action' => 'fetchAllControllerFunctionByRole', ));?>',
            type:'POST',
            data:'role_id='+id,
            success:function(data) {
                try{
                returnData=JSON.parse(data);
                if(returnData['STATUS']=='SUCCESS'){
                    $("#controllerSelectListId").html(returnData['DATA']);
                }else{
                    $("#controllerSelectListId").html('<option value="">--Please Select One--</option>');
                }
               }catch(e){
                $("#controllerSelectListId").html('<option value="">--Please Select One--</option>');
               }
            }
        });
    }
}

function onChangeControllerSelectList(id) {
        if(id !=''){
            var role_id=$("#roleSelectListId").val();
        link='<?php echo Router::url(array('controller' => 'my-permissions/edit-by-role/'));?>'+'/'+role_id+':'+id;
        var win = window.open(link, '_blank');
        win.focus();
    }
    }

</script>