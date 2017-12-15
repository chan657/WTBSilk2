<?php

echo $this->Form->create(false, array( 
    'url' => array('controller' => 'permission_sets', 'action' => 'updatePermissionByRole')
));
?>
<div class="col-sm-12" id="mycl-det">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">Edit</h4>
        </div>
        <div class="panel-body">
            <fieldset>
                <legend><span>Edit Permission By Role</span></legend>
            </fieldset>
            <div class="row">

                <div class="col-sm-12">

                    <div class="row form-wrap">

                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('Role Id:', array('type'=>'text','disabled' => true,'lebel' => false,'div' => false,'value'=>$roleInfo['Role']['id']));
                                        ?> 
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="col-sm-10">
                                        <?php
                                        echo $this->Form->input('Role Name:', array('type' => 'text', 'disabled' => true,'lebel' => false,'div' => false,'value'=>$roleInfo['Role']['role_name']));
                                        ?> 
                                    </div>
                                </div>

                                
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                        <div class="col-sm-10">
                                            <?php
                                            echo $this->Form->input('Controller Name:', array('type' => 'text', 'disabled' => true,'lebel' => false,'div' => false,'value'=>$allActionUnderController[0]['ControllerSet']['controller_name']));
                                            ?></div>
                               </div>
                                <div class="form-group ">
                                    <div class="col-sm-10">
                                        <?php
                                        /*
                                        echo $this->Form->input('Controller Name:', array('type' => 'text', 'disabled' => true,'lebel' => false,'div' => false,'value'=>$allControllerActions[0]['controller_sets']['controller_name']));
                                        */
                                        ?></div>
                                </div>
                            </div>
                            

                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <div class="checkbox three-column">

                                    <div class="list-checkbox checkboxBlank">

                                        <?php
                                        $allactionArray=array();
                                        foreach ($allActionUnderController as $key => $action) {
                                            array_push($allactionArray, $action['ControllerSet']['id']);
                                            ?>
                                            <div class="form-control">
                                                <input name="data[allpermission][]" value="<?php echo $action['ControllerSet']['id']; ?>" id="permissionSetId<?php echo $key; ?>" <?php if (in_array($action['ControllerSet']['id'], $allowAction)) echo 'checked=checked'; ?> type="checkbox">
                                                <label for="permissionSetId<?php echo $key; ?>" style="margin-right:15px"><?php echo $action['ControllerSet']['action_name']; ?></label>
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
                            <input type="hidden" name="role_id" value="<?php echo $roleInfo['Role']['id'];?>">
                            <input type="hidden" name="allActions" value="<?php echo implode(',', $allactionArray);?>">
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
