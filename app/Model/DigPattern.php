<?php

App::uses('AppModel', 'Model');

class DigPattern extends AppModel {

    public $name = 'DigPattern';

    
    public function getPatternName($id) {
        $pattern = $this->find('first', array('fields' => array('pattern_name'), 'conditions' => array('id' => $id)));
        return $pattern['DigPattern']['pattern_name'];
    }

}

?>