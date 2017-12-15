<?php
class Post extends AppModel {
    var $useDbConfig = 'soap';
    var $useTable = false;

    function myTest($x,$y) {
        return $x+$y;
    }
}
?>