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
                    ?></span> My Controllers</h4>
            <span class="search_panel_icon"><i class="icon-plus" id="toggle_search_panel"></i></span>
        </div>
        <div class="panel panel-default">

            <div class="panel_controls hideform">

                <div class="row" id="search_panel_controls">

                    <div class="col-sm-3 col-xs-6">
                        <label for="un_member">Controller Name:</label>
                        <select id="controllerSelectList" class="form-control" onchange="onChangeControllerSelectList(this.value)">
                            <option value="" disabled selected>Please select</option>
                            <?php
                            foreach ($allController as $controllerName) {
                                echo '<option value="'.$controllerName['ControllerSet']['controller_name'].'">'.$controllerName['ControllerSet']['controller_name'].'</option>';
                            }
                            ?>
                        </select>
                    </div>



                    <div class="col-sm-3 col-xs-6">
                        <label>Function Name</label>
                        <select id="controllerActionSelectList" class="form-control" onchange="onChangeControllerActionSelectList(this.value)">
                            <option value="" disabled selected>Please select</option>
                            
                        </select>
                    </div>
                </div>

            </div>

            <table id="resp_table" class="table toggle-square" data-filter="#table_search" data-page-size="100">
                <thead>
                    <tr>
                        <th data-sort-ignore="true" data-toggle="true">Controller Id</th>
                        <th data-sort-ignore="true" data-toggle="phone">Controller Name</th>
                        <th data-sort-ignore="true" data-hide="phone">Function Name</th>
                        <th data-sort-ignore="true" data-hide="phone">Function Slug</th>
                        <th data-sort-ignore="true" data-hide="phone">Active Roles </th>
                        <th data-sort-ignore="true">Action</th>        
                    </tr>
                </thead>
                <tbody>
<?php
if (isset($controllersets) && count($controllersets) > 0):
    foreach ($controllersets as $controllerset):
       
        ?>
                            <tr>
                                <td><?php echo $controllerset['ControllerSet']['id']; ?></td>   
                                <td><?php echo $controllerset['ControllerSet']['controller_name']; ?></td>
                                <td><?php echo $controllerset['ControllerSet']['action_name']; ?></td>
                                <td><?php echo $controllerset['ControllerSet']['slug']; ?></td>
                                <td><?php 
                                $allPermissionArray=array();
                                foreach ($controllerset['allPermissions'][0] as $permissionset) {
                                    array_push($allPermissionArray, $permissionset['PermissionSet']['role_id']);
                                }
                                echo implode(', ', $allPermissionArray);
                                 ?></td>
                                
                                <td width="10%" valign="middle" align="center">

                                    <?php
                                    //echo $this->Html->link('Edit',array('target'=>'_blank','escape' => false), array('controller' => '/my-permissions/edit-by-controller/'.$controllerset['ControllerSet']['id']));
                                    echo $this->Html->link(
                                                        '<span class="icon-pencil"></span>',
                                                        array('controller' =>'/my-permissions/edit-by-controller/'.$controllerset['ControllerSet']['id']),
                                                        array('class' => 'button', 'target' => '_blank','escape' => false)
                                                    );
                                    ?>
                                </td>
                               
                            </tr>
                            <?php endforeach; ?>

                        <?php echo $this->element('paginate'); ?>
                    <?php endif; ?>
                </tbody>
            </table>
           
        </div>
    </div>
</div>
<script type="text/javascript">
    function onChangeControllerSelectList(name) {
        $("#controllerActionSelectList").html('<option value="">Please wait...</option>');
        $.ajax({
            url:'<?php echo Router::url(array('controller' => 'permission_sets','action' => 'fetchControllerFunction', ));?>',
            type:'POST',
            data:'controller_name='+name,
            success:function(data) {
                try{
                returnData=JSON.parse(data);
                if(returnData['STATUS']=='SUCCESS'){
                    $("#controllerActionSelectList").html(returnData['DATA']);
                }else{
                    $("#controllerActionSelectList").html('<option value="">--Please Select One--</option>');
                }
               }catch(e){
                $("#controllerActionSelectList").html('<option value="">--Please Select One--</option>');
               }
            }
        })
    }
    function onChangeControllerActionSelectList(id) {
        if(id !=''){
        link='<?php echo Router::url(array('controller' => 'my-permissions/edit-by-controller/'));?>';
        var win = window.open(link+'/'+id, '_blank');
        win.focus();
    }
    }
</script>