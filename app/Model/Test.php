<?php
	App::uses('AppModel', 'Model');
	
	class Test extends AppModel {
	
	 var $useDbConfig = 'soap';
    var $useTable = false;

    function myTest($x,$y) {
        return $x+$y;
    }
}
?>