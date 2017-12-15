<?php

/**
 * Permissions controller. 
 *
 * This file will render views from views/roles/
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
App::uses('AppController', 'Controller'); 

/**
 * Permissions controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PermissionSetsController extends AppController {

    var $uses = array('PermissionSet', 'Role', 'ControllerSet','Users');
    public $components = array('ControllerList');
	function beforeFilter(){     
             parent::beforeFilter();    
    $this->Auth->allow('index','set_perm','del_perm','byRoles','byController','byFunctions','editByController','updatePermission','fetchControllerFunction','editByRole','updatePermissionByRole','fetchAllControllerFunctionByRole');
}
	

    public function index() {
		//echo 'asd';
		//die;
      	$this->insert_controllers_actions_into_permission_table();
        $roles = $this->Role->find('all', array('order' => 'id', 'contain' => false, 'recursive' => -1));
        $this->set('roles', $roles);
        $action = $this->ControllerSet->find('all', array('order' => 'id', 'contain' => false, 'recursive' => -1));
        $this->set('actions', $action);
        $permission = $this->PermissionSet->find('all');
        $this->set('permissions', $permission);
        $this->set('foreignMachineInterAction','NO');
    }

    public function set_perm() {
        $this->layout = 'ajax';
        $data = array();
        $id = $this->data['id'];
        $arr = explode('_', $id);
        $controller_id = $arr[0];
        $role_id = $arr[1];

        $data = array('controller_id' => $controller_id, 'role_id' => $role_id);
        if ($this->PermissionSet->save($data)) {
            $name = $this->PermissionSet->getLastInsertId();
        } 
        $this->set('div_id', $id);
        $this->set('name', $name);

    }

    public function del_perm() {

        $this->layout = 'ajax';
        $data = array();
        $id = $this->data['id'];
        $permission_id = $this->data['permission_id'];
        $arr = explode('_', $id);
        $controller_id = $arr[0];
        $role_id = $arr[1];
        $div_id = $controller_id . '_' . $role_id;

        $this->PermissionSet->delete($permission_id);

        $this->set('div_id', $id);
    }
    
    private function insert_controllers_actions_into_permission_table () {
        

        //pr($this->ControllerList->getList(array('AllFunctionsController', 'AdminsController')));exit;
        //pr($this->ControllerList->getActions('AdminsController'));//exit;
        
        $permission_table = $this->ControllerSet->find('list', array('fields' => array('id', 'action_name', 'controller_name')));
      //  pr($permission_table);
       // die();
        $controllersToExclude = array('PagesController');
        // $controllers = $this->ControllerList->get();
        $controllers = $this->ControllerList->getControllerList();
        //$controler_db = array_diff($controllers, $permission_table);
        $save = array();
		
        foreach ($controllers as $controller => $actions) {
		if(count($actions) && !empty($actions)){
            foreach ($actions as $action) {
                if (!isset($permission_table[$controller]) || !in_array($action, $permission_table[$controller])) {
                 
                    $save[] = array('ControllerSet' => array(
                        'slug' => $controller.'_'.$action,
                        'title' => $controller.' '.$action,
                        'controller_name' => $controller,
                        'action_name' => $action     
                    ));
                }                    
            }
        }
		}
        //pr($save);  
        if (!empty($save))
            $this->ControllerSet->saveMany($save);
        
    }




   public function byController()
    {


       
        $this->set('foreignMachineInterAction','NO');
        $search_condition = array();

        if ($this->request->is('post') || $this->request->is('put')) {

            if (!empty($this->data['PermissionSet']['search_value'])) {
                $search = $this->data['PermissionSet']['search_value'];
                array_push($search_condition, array('OR' => array('ControllerSet.controller_name' . ' LIKE' => "" . mysql_escape_string(trim(strip_tags($search))) . "%")));
            }
        }

        //$this->ControllerSet->bindModel(array('belongsTo' => array('PermissionSet',array('foreignKey'=>'controller_id'))));
        $this->paginate['order'] = array('ControllerSet.id' => 'asc');
       $this->paginate['ControllerSet']['contain'][] = 'PermissionSet';
        //$this->paginate('ControllerSet', $search_condition);
        $allController=$this->ControllerSet->find('all',array('group'=>array('ControllerSet.controller_name'),'order' => array('ControllerSet.controller_name')));
        $this->set('allController',$allController);
        $d=$this->paginate("ControllerSet", $search_condition);
        foreach ($d as $key=>$value) {
            $e=$this->PermissionSet->find('all',array('conditions' => array(
            'PermissionSet.controller_id' => $value['ControllerSet']['id']
                                         )));
            $d[$key]['allPermissions']=array();
            array_push($d[$key]['allPermissions'], $e);
        }
        $this->set('controllersets', $d);
    
       
    }

    
    public function editByController($id='')
    {
        $this->set('foreignMachineInterAction','NO');
        if($id!=''){
            $controllerInfo=$this->ControllerSet->find('first',
                                            array(
                                                'conditions'=>array(
                                                    'ControllerSet.id'=>$id
                                                    )
                                                )
                                            );
            $this->set('controllerInfo',$controllerInfo);
            $allPermissionData=$this->PermissionSet->find('all',
                                            array(
                                                'conditions'=>array(
                                                    'PermissionSet.controller_id'=>$id
                                                    )
                                                )
                                            );
            $allAllowedPermission=array();
            foreach ($allPermissionData as $key => $permission) {
                array_push($allAllowedPermission, $permission['PermissionSet']['role_id']);
            }
            $this->set('allRoleData',$this->Role->find("all"));
            $this->set('allAllowedPermission',$allAllowedPermission);
        }else{
            $this->redirect(array('controller' => '/my-permissions/by-controller'));
        }
    }


    public function updatePermission()
    {
       if(!empty($this->request->data)){
        if($this->request->data['controller_id'] !=''){
         if($this->PermissionSet->deleteAll(array('controller_id' => $this->request->data['controller_id']))){
            if(!empty($this->request->data['allpermission'])){
                $dataToBeSave=array();
              foreach ($this->request->data['allpermission'] as $permission) {
                $innerData=array();
                $innerData['controller_id']=$this->request->data['controller_id'];
                $innerData['role_id']=$permission;
                array_push($dataToBeSave, $innerData);
             }
             $this->PermissionSet->saveAll($dataToBeSave);
           }

         }
         $this->redirect(array("controller" => "/my-permissions/edit-by-controller/".$this->request->data['controller_id']));
        }else{
           $this->redirect(array("controller" => "/my-permissions/by-controller/")); 
        }
       }
    }



    public function fetchControllerFunction()
    {
        error_reporting(0);
       $this->autoRender = false ;
       if ($this->request->is('ajax')) {
       $returnData['STATUS']='FAILED';
       if(!empty($this->request->data)){
        if ($this->request->data['controller_name']!='') {
           $allController=$this->ControllerSet->find('all',array('conditions'=>array('ControllerSet.controller_name'=>$this->request->data['controller_name'])));
           $returnData['DATA']='<option value="" disabled selected>Please select</option>';
            foreach ($allController as $controllerFunName) {
            $returnData['DATA'].= '<option value="'.$controllerFunName['ControllerSet']['id'].'">'.$controllerFunName['ControllerSet']['action_name'].'</option>';
            }
            $returnData['STATUS']='SUCCESS';
        }
       }
       echo json_encode($returnData);
       exit();
      }
    }


    public function byRoles() {
        $this->set('foreignMachineInterAction','NO');
        
        if((isset($this->request->data['search_filter'])) && ($this->request->data['search_filter']!='')){
         $search_condition=array('Role.id'=>$this->request->data['search_filter']);
        }else{
         $search_condition = array(); 
        }
        $this->paginate['order'] = array('Role.id' => 'asc');
        $this->paginate['limit'] = 20;
        $allRoleList=$this->paginate("Role", $search_condition);
        $this->set('uniqueRoleList',$this->Role->find('all'));
        $allControllerList=$this->ControllerSet->find("all",array('group'=>'ControllerSet.controller_name'));
        $finalArray=array();
        foreach ($allRoleList as $role) {
             $finalInnerArray=array();
             array_push($finalInnerArray, $role);
             $finalControllerArray=array();
            foreach ($allControllerList as $controllerName) {
                $finalInnerControllerArray=array();
                $sql = "SELECT * FROM `permission_sets` INNER JOIN controller_sets on permission_sets.controller_id=controller_sets.id WHERE role_id=".$role['Role']['id']." and controller_sets.controller_name='".$controllerName['ControllerSet']['controller_name']."'";
                $allpermissionUnderController =$this->PermissionSet->query($sql);
            if(!empty($allpermissionUnderController)){
                array_push($finalInnerControllerArray, $controllerName);
               array_push($finalInnerControllerArray, $allpermissionUnderController);
               array_push($finalControllerArray, $finalInnerControllerArray);
             }
            }
            array_push($finalInnerArray, $finalControllerArray);
            array_push($finalArray, $finalInnerArray);
            
        }
        $this->set('allRoleList',$finalArray);
    }



    public function editByRole($id='')
    {
        $this->set('foreignMachineInterAction','NO');
        if($id!=''){
            $controler_role_id=explode(':', $id);
            if((!empty($controler_role_id)) && (count($controler_role_id)>0) )
            {
                $role_id=$controler_role_id[0];
                $controller_id=$controler_role_id[1];
                $controllerInfo=$this->ControllerSet->find('first',
                array(
                    'conditions'=>array(
                        'ControllerSet.id'=>$controller_id
                        )
                    )
                );
                $allActionControllerInfo=$this->ControllerSet->find('all',
                array(
                    'conditions'=>array(
                        'ControllerSet.controller_name'=>$controllerInfo['ControllerSet']['controller_name']
                        )
                    )
                );
                $sql = "SELECT * FROM `permission_sets` inner join controller_sets on  permission_sets.controller_id=controller_sets.id WHERE controller_sets.controller_name='".$controllerInfo['ControllerSet']['controller_name']."' and permission_sets.role_id=$role_id";
                $allowControllerActions =$this->ControllerSet->query($sql);
                $this->set('controllerInfo',$controllerInfo['ControllerSet']['controller_name']);
                $allowControllerActionsArray=array();
                foreach ($allowControllerActions as $key => $actionName) {
                    array_push($allowControllerActionsArray, $actionName['permission_sets']['controller_id']);
                }
                $roleInfo=$this->Role->find('first',
                array(
                    'conditions'=>array(
                        'Role.id'=>$role_id
                        )
                    )
                );
                $this->set('roleInfo',$roleInfo);
                $this->set('allowAction',$allowControllerActionsArray);
                $this->set('allActionUnderController',$allActionControllerInfo);
            }else{
                $this->redirect(array('controller' => '/my-permissions/by-controller'));
               }
        }else{
            $this->redirect(array('controller' => '/my-permissions/by-controller'));
        }
    }


    public function updatePermissionByRole()
    {
        if(!empty($this->data)){
             if(!empty($this->request->data['allpermission'])){
                $dataToBeSave=array();
                $deleteIds= $this->request->data['allActions'];
            $deleteQuery="DELETE FROM `permission_sets` WHERE (controller_id IN($deleteIds)) and (role_id=".$this->request->data['role_id'].")";
           $this->PermissionSet->query($deleteQuery);
              foreach ($this->request->data['allpermission'] as $permission) {
                $innerData=array();
                $innerData['controller_id']=$permission;
                $innerData['role_id']=$this->request->data['role_id'];
                array_push($dataToBeSave, $innerData);
             }
             $this->PermissionSet->saveAll($dataToBeSave);
           $this->redirect(array("controller" => "/my-permissions/edit-by-role/".$this->request->data['role_id'].':'.$this->request->data['allpermission'][0]));
           }else{
            $this->redirect(array("controller" => "/my-permissions/by-roles/"));
        }
           
        }else{
            $this->redirect(array("controller" => "/my-permissions/by-role/"));
        }
    }

    public function fetchAllControllerFunctionByRole()
    {
       error_reporting(0);
       $this->autoRender = false ;
       if ($this->request->is('ajax')) {
       $returnData['STATUS']='FAILED';
       if(!empty($this->request->data)){
        if ($this->request->data['role_id']!='') {
           $allController=$this->PermissionSet->query('SELECT * FROM `permission_sets` inner join controller_sets on permission_sets.controller_id=controller_sets.id where permission_sets.role_id='.$this->request->data['role_id'].' GROUP by controller_sets.controller_name');
            $returnData['DATA']='<option value="" disabled selected>Please select</option>';
            if(!empty($allController)){
                foreach ($allController as $controller) {
                    $returnData['DATA'].='<option value="'.$controller['controller_sets']['id'].'">'.$controller['controller_sets']['controller_name'].'</option>';
                }
            }
           $returnData['STATUS']='SUCCESS';
        }
       }
       echo json_encode($returnData);
       exit();
      }
    }





}

?>
