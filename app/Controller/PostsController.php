<?php

App::uses('Controller', 'Controller');
App::uses('Post', 'Model');  // Dont forgot to add this

class PostsController extends AppController {

    var $components = array('RequestHandler');
    public $uses = array('Agent');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

   public function myservice() {
        $this->layout = FALSE;
        $this->autoRender = FALSE;
        Configure::write('debug', 2);
        //ini_set("soap.wsdl_cache_enabled", "0");
        $this->RequestHandler->respondAs('xml');
        App::import('Vendor', 'nusoap', array('file' => 'nusoap' . DS . 'lib' . DS . 'nusoap.php'));
        
        
        $server = new nusoap_server();
        $namespace = "http://localhost/silkrouters";
        $accion = "http://localhost/silkrouters/posts/myservice";

        $server->debug_flag = false;
        $server->configureWSDL("nombre_wsdl", $namespace,$accion);
        $server->wsdl->schemaTargetNamespace = $namespace;

        $server->register("entrada_exterior",
        array("entro"=>"xsd:string"),
        array("return" => "xsd:string"),
        "http://localhost/silkrouters",
        $accion."/entrada_exterior");
         function entrada_exterior($entro=null)
            {
            
            return PostsController::TestFunc($entro);
            }
        $HTTP_RAW_POST_DATA = isset($GLOBALS["HTTP_RAW_POST_DATA"]) ? $GLOBALS["HTTP_RAW_POST_DATA"] : "";
        $server->service($HTTP_RAW_POST_DATA);
       
    }
    
    public function TestFunc($entro)
        {
            $this->layout = FALSE;
        $this->autoRender = FALSE;
            $this->Agent->create();
            return $entro;
        }
    
 

}