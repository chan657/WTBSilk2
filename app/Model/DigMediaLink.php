<?php

App::uses('AppModel', 'Model');

class DigMediaLink extends AppModel {

    public $name = 'DigMediaLink';
    
    public $belongsTo = array(
        'DigMediaLookupLinkType' => array(
            'className' => 'DigMediaLookupLinkType',            
            'foreignKey' => 'link_type_id'
        ),
        'DigMediaLookupLinkTier' => array(
            'className' => 'DigMediaLookupLinkTier',            
            'foreignKey' => 'link_tier_id'
        ),
    );

}

?>