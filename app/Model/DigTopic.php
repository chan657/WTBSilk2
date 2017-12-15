<?php

App::uses('AppModel', 'Model');

class DigTopic extends AppModel {

    public $name = 'DigTopic';
    public $validate = array(
        
    );
    
    public $belongsTo = array(
        'Channel' => array(
            'className' => 'Channel',
            'fields' => 'channel_name',
            'foreignKey' => 'topic_channel'
        ),
       
    );
    
}

?>