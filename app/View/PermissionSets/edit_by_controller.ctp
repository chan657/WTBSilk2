<?php
echo $this->Form->create(false, array(
    'url' => array('controller' => 'permission_sets', 'action' => 'updatePermission')
)); 
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Edit</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Edit My Controller Action</span></legend>
            </fieldset>
            <div class="row">

                <div class="col-sm-12">

                    <div class="row form-wrap">

                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('Controller Id', array('type'=>'text','disabled' => true,'lebel' => false,'div' => false,'value'=>$controllerInfo['ControllerSet']['id']));
                                        ?> 
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('Controller Name', array('type' => 'text', 'disabled' => true,'lebel' => false,'div' => false,'value'=>$controllerInfo['ControllerSet']['controller_name']));
                                        ?> 
                                    </div>
                                </div>

                                
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('Function Name', array('type' => 'text', 'disabled' => true,'lebel' => false,'div' => false,'value'=>$controllerInfo['ControllerSet']['action_name']));
                                            ?></div>
                               </div>
                                <div class="form-group ">
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('Function Slug:', array('type' => 'text', 'disabled' => true,'lebel' => false,'div' => false,'value'=>$controllerInfo['ControllerSet']['slug']));
                                        ?></div>
                                </div>
                            </div>
                            

                        </div>
                        <div class="form-group">
                        <input type="hidden" name="controller_id" value="<?php echo $controllerInfo['ControllerSet']['id'];?>">
                            <div class="col-sm-12">
                                <div class="checkbox three-column">

                                    <div class="list-checkbox checkboxBlank">

                                        <?php
                                        foreach ($allRoleData as $key => $role) {
                                            ?>
                                            <div class="form-control">
                                                <input name="data[allpermission][]" value="<?php echo $role['Role']['id']; ?>" id="permissionSetId<?php echo $key; ?>" <?php if (in_array($role['Role']['id'], $allAllowedPermission)) echo 'checked=checked'; ?> type="checkbox">
                                                <label for="permissionSetId<?php echo $key; ?>" style="margin-right:15px"><?php echo $role['Role']['role_name'].' / '.$role['Role']['id']; ?></label>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>



                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="form_submit clearfix">
                        <div class="row">
                            <div class="col-sm-1">
                                <?php
                                echo $this->Form->submit('Update', array('class' => 'btn btn-success sticky_success', 'name' => 'add', 'value' => 'add'));
                                ?>
                            </div>                   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->Form->end();

?>
