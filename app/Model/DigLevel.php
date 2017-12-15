<?php

App::uses('AppModel', 'Model');

class DigLevel extends AppModel {

    public $name = 'DigLevel';

    
    public function getLevelName($id) {
        $level = $this->find('first', array('fields' => array('level_name'), 'conditions' => array('id' => $id)));
        return $level['DigLevel']['level_name'];
    }

}

?>