<?php

/**
 * Role model for Cake.
 *
 * Add your permission methods in the class below.
 *
 * @package       app.Model
 */
class Role extends AppModel {  
    var $name = 'Role';
    var $belongsTo = array(
        'GroupsUser' => array(
            'className' => 'GroupsUser',
            'foreignKey' => 'group_id'
        )
    ); 
     public $validate = array(
        'role_name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A role name is required'
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'Role name already exits.'
                
            )
        /*  'unique' => array(
                'rule' => array('checkUnique', array('role_name', 'group_id')),
                'message' => 'Your input violates a unique key constraint, check your input and try again.',
            )*/
        ),
         'group_id' => array(
             'required' => array(
                 'rule' => array('notEmpty'),
                 'message' => 'A group name is required'
             ),
            /*  'unique' => array(
                'rule' => array('isUnique', array('role_name', 'group_id')),
                'message' => 'Role name already exits.',
            )
             * 
             */
         )
    );
}

?>
