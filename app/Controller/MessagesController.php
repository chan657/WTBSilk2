<?php
App::uses('AppController', 'Controller');

/**

 * Roles controller

 *

 *

 * @package       app.Controller

 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html

 */
class MessagesController extends AppController {


    public function index($controller, $action) {

        //$this->Session->setFlash('fgh','success');
        $this->set('controller', $controller);

        $this->set('action', $action);
    }

    public function error() {
        
    }

    public function list_message() {
        
    }

}
?>

