<?php

/**
 * This is ControllerList component to to get list of all controllers and actions.
 * 
 * 
 * First, you have to add the component to the $components array of your controller(s): public $components = array('ControllerList');.
 * 
 * Then you can use the component in your action(s) with: $this->ControllerList->getList(). 
 * You can also specify the controllers which should be excluded from the returned list: $this->Controller->getList(array('UsersController')). 
 * Please note that without this parameter, the PagesController is automatically excluded.
 */
class ControllerListComponent extends Component { 

    public function getList(Array $controllersToExclude = array('PagesController')) {
         $controllerClasses = App::objects('controller');
        $controllersToExclude[] = array('AppController');
    
        
      
        $result = array();
		
        foreach ($controllerClasses as $controller) {
		
            $controllerName = str_replace('Controller', '', $controller);
            $result[$controller]['name'] = $controllerName;
            $result[$controller]['displayName'] = Inflector::humanize(Inflector::underscore($controllerName));
            $result[$controller]['actions'] = $this->getActions($controller);
        }

        return $result;
    }
    
   public function getControllerList(Array $controllersToExclude = array()) {
        $controllersToExclude[] = 'AppController';
         $controllerClasses = App::objects('controller');
       
        
        $result = array();
		
        foreach ($controllerClasses as $controller) {
            $controllerName = str_replace('Controller', '', $controller);
			$re = '/# Match position between camelCase "words".
			(?<=[a-z])  # Position is after a lowercase,
			(?=[A-Z])   # and before an uppercase letter.
			/x';
			$controllerNameArr = preg_split($re, $controllerName);
			if(count($controllerNameArr) > 1){
				$controllerName = implode("_",$controllerNameArr);
			}
			$controllerName = strtolower($controllerName);
            $result[$controllerName] = $this->getActions($controller);
        }

        return $result;
    }

    public function getActions($controller) {
        App::uses($controller, 'Controller');
        $methods = get_class_methods($controller);
        $methods = $this->removeParentMethods($methods);
      //  $methods = $this->removePrivateActions($methods);

        return $methods;
    }

    private function removeParentMethods($methods) {
        $appControllerMethods = get_class_methods('AppController');
		if(count($methods))
        return array_diff($methods, $appControllerMethods);
    }

  /*  private function removePrivateActions($methods) {
        return array_filter($methods, function ($method) {
                    return $method{0} != '_';
                });
    }
   * 
   */


}

?>
