<?php

/**
 * ControllerSets model for Cake.
 *
 * Add your ControllerSets methods in the class below.
 *
 * @package       app.Model
 */
class ControllerSets extends AppModel { 
    var $name = 'ControllerSets';
      $hasMany = array(
        'PermissionSet' => array(
            'className' => 'PermissionSet',
            'foreignKey' => 'controller_id'
        )
    );

}

?>
