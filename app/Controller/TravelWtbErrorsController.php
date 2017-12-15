<?php

/**
 * TravelSuburb controller.
 *
 * This file will render views from views/TravelSuburbs/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('CakeEmail', 'Network/Email');
/**
 * Email sender
 */
App::uses('AppController', 'Controller');

/**
 * TravelSuburb controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TravelWtbErrorsController extends AppController {

    var $uses = array('TravelWtbError');

    public function index() {     
        $search_condition = array();
        $this->paginate['order'] = array('TravelWtbError.error_time' => 'asc');
        $this->set('TravelWtbErrors', $this->paginate("TravelWtbError", $search_condition));


    }

}

