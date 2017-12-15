<?php

App::uses('AppModel', 'Model');

class TravelOwnerCompany extends AppModel {

    public $name = 'TravelOwnerCompany';
    public $validate = array(
        'owner_company_name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'message' => 'Please enter owner company name',
            ),
            'validChars' => array(
                'rule' => '/^[a-zA-Z\s]+$/',
                'message' => 'Owner company should only contain letters.'
            ),
        ),    
    );
}

?>