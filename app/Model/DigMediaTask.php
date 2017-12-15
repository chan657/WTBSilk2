<?php

App::uses('AppModel', 'Model');

class DigMediaTask extends AppModel {

    public $name = 'DigMediaTask';
    public $validate = array(
        
    );
    
    public $belongsTo = array(
        'DigMediaProduct' => array(
            'className' => 'DigMediaProduct',
            'fields' => 'product_name',
            'foreignKey' => 'task_product_id'
        ),
        'DigMediaLookupUrgency' => array(
            'className' => 'DigMediaLookupUrgency',
            'fields' => 'value',
            'foreignKey' => 'task_urgency'
        ),
        'Channel' => array(
            'className' => 'Channel',
            'fields' => 'channel_name',
            'foreignKey' => 'task_channel'
        ),
        'DigTopic' => array(
            'className' => 'DigTopic',
            'fields' => 'topic_name',
            'foreignKey' => 'task_topic_id'
        ),
        
    );
    
}

?>