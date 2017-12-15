<?php
/*
@define("USERNAME", 'root'); //root //hbs200_admin 

@define("PASSWORD", '');//hbs200_lms

@define("DBNAME", 'wtbsilkone'); //silkrouters //hbs200_lms

@define("HOST", 'localhost');
$dbh = @mysql_connect(HOST, USERNAME, PASSWORD) or die('I cannot connect to the database because: ' . mysql_error());
$db = @mysql_select_db(DBNAME, $dbh) or die('I cannot connect to the database because: ' . mysql_error());
*/

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class DemoController extends AppController {

    var $components = array('RequestHandler');
    public $uses = array('Agent');
    

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }

    public function index() {
        $this->layout = FALSE;
        $this->autoRender = FALSE;
        Configure::write('debug', 2);
        $this->RequestHandler->respondAs('xml');
        App::import('Vendor', 'nusoap', array('file' => 'nusoap' . DS . 'lib' . DS . 'nusoap.php'));

        if (!isset($HTTP_RAW_POST_DATA))
            $HTTP_RAW_POST_DATA = file_get_contents('php://input');

        function hookTextBetweenTags($string, $tagname) {
            $pattern = "/<$tagname ?.*>(.*)<\/$tagname>/";
            preg_match($pattern, $string, $matches);
            return $matches[1];
        }

        $server = new soap_server();
        $namespace = "http://silkrouters.com/demo";
        $endpoint = "http://silkrouters.com/demo";
        $server->configureWSDL("web-service", $namespace, $endpoint);
        $server->wsdl->schemaTargetNamespace = $namespace;


        $server->register("add_agent", array("agent_name" => "xsd:string", "agent_incorporated_in_country" => "xsd:int", "agent_primary_city" => "xsd:int", "agent_secondary_city" => "xsd:int", "agent_tertiary_city" => "xsd:int", "agent_city4" => "xsd:int", "agent_city5" => "xsd:int", "agent_area" => "xsd:int", "agent_suburb" => "xsd:int", "agent_zip_code" => "xsd:int", "agent_time_zone" => "xsd:string", "agent_procurement_type" => "xsd:int", "agent_iata_approval_status" => "xsd:int", "agent_website" => "xsd:string", "agent_contact_number_code_landline" => "xsd:int", "agent_contact_number_landline" => "xsd:string", "agent_contact_number_code_mobile" => "xsd:int", "agent_contact_number_mobile" => "xsd:string", "agent_contact_email" => "xsd:string", "agent_corporate_address" => "xsd:string", "agent_nature_of_business" => "xsd:int"), array("return" => "xsd:string"), "urn:web-service", "urn:web-service#add_agent", "rpc", "encoded", "Agent Add");

        $server->register("hello", array("username" => "xsd:string"), array("return" => "xsd:string"), "urn:web-service", "urn:web-service#hello", "rpc", "encoded", "Just say hello");
        $server->register("finish", array("msg" => "xsd:string"), array("return" => "xsd:string"), "urn:web-service", "urn:web-service#hello", "rpc", "encoded", "Just say hello");

        function hello($username) {
            //Can query database and any other complex operation
            mysql_query($username);
            return 'Hiiii-' . $username;
            
        }
        function finish($username) {
            //Can query database and any other complex operation
            mysql_query($username);
            return 'Hiiii-' . $username;
            
        }
        
        

       

        $server->service($HTTP_RAW_POST_DATA);
    }

}