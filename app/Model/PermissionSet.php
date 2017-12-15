<?php

/**
 * PermissionSet model for Cake.
 *
 * Add your permission methods in the class below.
 *
 * @package       app.Model
 */
class PermissionSet extends AppModel { 
    var $name = 'PermissionSet';


    public $belongsTo = array(
         'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'role_id',
        ),
    );
    
   /*  public $validate = array(
        'role_id' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A role name is required'
            ),
           'unique' => array(
                'rule' => array('checkUnique', array('controller_id', 'role_id')),
                'message' => 'Program name alreay exits'
               )
        ),
    );*/
}

?>
