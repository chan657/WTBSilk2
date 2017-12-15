<?php

App::uses('AppModel', 'Model');

class TravelArea extends AppModel {

    public $name = 'TravelArea';
    public $validate = array(
        'area_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter area name',
            ),
        ),
    );
}

?>