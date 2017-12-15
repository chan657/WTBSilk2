<?php

$arrUserRole = array(1 => 'Super Admin', 2 => 'Admin', 3 => 'Business Admin', 4 => 'Administrator', 5 => 'Business Head', 6 => 'Transaction Leader', 7 => 'Transaction Advisor', 8 => 'Call Center Executive', 9 => 'Associate', 10 => 'Financial Controller', 11 => 'Collection Agent');
$config['user_role'] = $arrUserRole;


$arrRoleAccess = array(
    1 => array(
        0 => array(
            'controller' => 'users',
            'action' => array('all')
        ),
        1 => array(
            'controller' => 'city',
            'action' => array('all')
        ),
        2 => array(
            'controller' => 'channel',
            'action' => array('all')
        ),
        3 => array(
            'controller' => 'suburb',
            'action' => array('all')
        ),
        4 => array(
            'controller' => 'areas',
            'action' => array('all')
        ),
        5 => array(
            'controller' => 'builder',
            'action' => array('all')
        ),
        6 => array(
            'controller' => 'project',
            'action' => array('all')
        ),
        7 => array(
            'controller' => 'lead',
            'action' => array('all')
        ),
        8 => array(
            'controller' => 'events',
            'action' => array('all')
        ),
        9 => array(
            'controller' => 'roles',
            'action' => array('all')
        ),
        10 => array(
            'controller' => 'permission_sets',
            'action' => array('all')
        ),
        
        
    ),
    2 => array(
        0 => array(
            'controller' => 'users',
            'action' => array('all')
        ),
        1 => array(
            'controller' => 'city',
            'action' => array('all')
        ),
        2 => array(
            'controller' => 'channel',
            'action' => array('all')
        ),
        3 => array(
            'controller' => 'suburb',
            'action' => array('all')
        ),
        4 => array(
            'controller' => 'area',
            'action' => array('all')
        ),
        5 => array(
            'controller' => 'builder',
            'action' => array('all')
        ),
        6 => array(
            'controller' => 'project',
            'action' => array('all')
        ),
        7 => array(
            'controller' => 'lead',
            'action' => array('all')
        ),
        8 => array(
            'controller' => 'events',
            'action' => array('all')
        ),
    ),
    3 => array(
        0 => array(
            'controller' => 'users',
            'action' => array('login', 'logout', 'index')
        ),
        1 => array(
            'controller' => 'city',
            'action' => array('all')
        ),
        2 => array(
            'controller' => 'channel',
            'action' => array('all')
        ),
        3 => array(
            'controller' => 'suburb',
            'action' => array('all')
        ),
        4 => array(
            'controller' => 'area',
            'action' => array('all')
        ),
        5 => array(
            'controller' => 'builder',
            'action' => array('all')
        ),
        6 => array(
            'controller' => 'project',
            'action' => array('all')
        ),
        7 => array(
            'controller' => 'lead',
            'action' => array('index', 'edit')
        )
    ),
    4 => array(
        0 => array(
            'controller' => 'users',
            'action' => array('login', 'logout', 'index')
        ),
        1 => array(
            'controller' => 'city',
            'action' => array('all')
        ),
        2 => array(
            'controller' => 'channel',
            'action' => array('index')
        ),
        3 => array(
            'controller' => 'suburb',
            'action' => array('all')
        ),
        4 => array(
            'controller' => 'area',
            'action' => array('all')
        ),
        5 => array(
            'controller' => 'builder',
            'action' => array('all')
        ),
        6 => array(
            'controller' => 'project',
            'action' => array('all')
        ),
        7 => array(
            'controller' => 'lead',
            'action' => array('index')
        )
    ),
    5 => array(
        0 => array(
            'controller' => 'users',
            'action' => array('login', 'logout', 'index')
        ),
        1 => array(
            'controller' => 'city',
            'action' => array('index')
        ),
        2 => array(
            'controller' => 'channel',
            'action' => array('index')
        ),
        3 => array(
            'controller' => 'suburb',
            'action' => array('index')
        ),
        4 => array(
            'controller' => 'area',
            'action' => array('index')
        ),
        5 => array(
            'controller' => 'builder',
            'action' => array('all')
        ),
        6 => array(
            'controller' => 'project',
            'action' => array('all')
        ),
        7 => array(
            'controller' => 'lead',
            'action' => array('index', 'edit')
        )
    ),
    6 => array(
        0 => array(
            'controller' => 'users',
            'action' => array('login', 'logout', 'index')
        ),
        1 => array(
            'controller' => 'city',
            'action' => array('index')
        ),
        2 => array(
            'controller' => 'channel',
            'action' => array('index')
        ),
        3 => array(
            'controller' => 'suburb',
            'action' => array('index')
        ),
        4 => array(
            'controller' => 'area',
            'action' => array('index')
        ),
        5 => array(
            'controller' => 'builder',
            'action' => array('all')
        ),
        6 => array(
            'controller' => 'project',
            'action' => array('all')
        ),
        7 => array(
            'controller' => 'lead',
            'action' => array('index', 'edit')
        )
    ),
    7 => array(
        0 => array(
            'controller' => 'users',
            'action' => array('login', 'logout', 'index')
        ),
        1 => array(
            'controller' => 'city',
            'action' => array('index')
        ),
        2 => array(
            'controller' => 'channel',
            'action' => array('index')
        ),
        3 => array(
            'controller' => 'suburb',
            'action' => array('index')
        ),
        4 => array(
            'controller' => 'area',
            'action' => array('index')
        ),
        5 => array(
            'controller' => 'builder',
            'action' => array('all')
        ),
        6 => array(
            'controller' => 'project',
            'action' => array('all')
        ),
        7 => array(
            'controller' => 'lead',
            'action' => array('index', 'edit')
        )
    ),
    8 => array(
        0 => array(
            'controller' => 'users',
            'action' => array('login', 'logout', 'index')
        ),
        1 => array(
            'controller' => 'city',
            'action' => array('index')
        ),
        2 => array(
            'controller' => 'channel',
            'action' => array('index')
        ),
        3 => array(
            'controller' => 'suburb',
            'action' => array('index')
        ),
        4 => array(
            'controller' => 'area',
            'action' => array('index')
        ),
        5 => array(
            'controller' => 'builder',
            'action' => array('all')
        ),
        6 => array(
            'controller' => 'project',
            'action' => array('all')
        ),
        7 => array(
            'controller' => 'lead',
            'action' => array('all')
        )
    ),
    9 => array(
        0 => array(
            'controller' => 'users',
            'action' => array('login', 'logout', 'index')
        ),
        1 => array(
            'controller' => 'city',
            'action' => array('index')
        ),
        2 => array(
            'controller' => 'channel',
            'action' => array('index')
        ),
        3 => array(
            'controller' => 'suburb',
            'action' => array('index')
        ),
        4 => array(
            'controller' => 'area',
            'action' => array('index')
        ),
        5 => array(
            'controller' => 'builder',
            'action' => array('all')
        ),
        6 => array(
            'controller' => 'project',
            'action' => array('all')
        ),
        7 => array(
            'controller' => 'lead',
            'action' => array('all')
        )
    ),
);

$config['access_role'] = $arrRoleAccess;
?>