<?php

/**
 * Properties controller.
 *
 * This file will render views from views/Properties/
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
 * Properties controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PropertiesController extends AppController {

    public $uses = array('Property', 'Area', 'Suburb', 'City', 'Remark', 'LookupPropCategory', 'LookupPropType', 'LookupPropSourcedFrom', 'LookupPropSourcedFor',
        'LookupProjectLandAreaUnit', 'LookupValueProjectUnitPreference', 'LookupPropAge', 'LookupPropOwnership', 'LookupPropFurnishing', 'LookupPropFacing',
        'LookupPropNegotiable', 'LookupPropAvailability', 'LookupPropCommissionType', 'LookupPropCommissionRent', 'LookupPropCommissionBasedOn', 'LookupPropCommissionEvent',
        'LookupBuilderContactLevel', 'LookupCompany', 'LookupValueLeadsCountry', 'Owner', 'Consultant');
    public $components = array('Sms', 'Image');
    public $uploadDir;

    public function beforeFilter() {
        parent::beforeFilter();
        $this->uploadDir = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . '/uploads/properties';
    }

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $city_id = $this->Auth->user('city_id');
        $role_id = $this->Session->read("role_id");
        $search_condition = array();


        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['Property']['owner_name'])) {
                $owner_name = $this->data['Property']['owner_name'];
                array_push($search_condition, array('Property.owner_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($owner_name))) . "%"));
            }
            if (!empty($this->data['Property']['owner_highendresidential'])) {
                $owner_highendresidential = $this->data['Property']['owner_highendresidential'];
                array_push($search_condition, array('Property.owner_highendresidential' => $owner_highendresidential));
            }

            if (!empty($this->data['Property']['owner_primarycity'])) {
                $owner_primarycity = $this->data['Property']['owner_primarycity'];
                array_push($search_condition, array('Property.owner_primarycity' => $owner_primarycity));
            }
            if (!empty($this->data['Property']['owner_residential'])) {
                $owner_residential = $this->data['Property']['owner_residential'];
                array_push($search_condition, array('Property.owner_residential' => $owner_residential));
            }
            if (!empty($this->data['Property']['owner_commercial'])) {
                $owner_commercial = $this->data['Property']['owner_commercial'];
                array_push($search_condition, array('Property.owner_commercial' => $owner_commercial));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['owner_name'])) {
                $owner_name = $this->request->params['named']['owner_name'];
                array_push($search_condition, array("Property.owner_name LIKE '%$owner_name%'"));
            }

            if (!empty($this->request->params['named']['owner_primarycity'])) {
                $owner_primarycity = $this->request->params['named']['owner_primarycity'];
                array_push($search_condition, array('Property.owner_primarycity' => $owner_primarycity));
            }

            if (!empty($this->request->params['named']['owner_highendresidential'])) {
                $owner_highendresidential = $this->request->params['named']['owner_highendresidential'];
                array_push($search_condition, array('Property.owner_highendresidential' => $owner_highendresidential));
            }

            if (!empty($this->request->params['named']['owner_residential'])) {
                $owner_residential = $this->request->params['named']['owner_residential'];
                array_push($search_condition, array('Property.owner_residential' => $owner_residential));
            }

            if (!empty($this->request->params['named']['owner_commercial'])) {
                $owner_commercial = $this->request->params['named']['owner_commercial'];
                array_push($search_condition, array('Property.owner_commercial' => $owner_commercial));
            }
        }




        if ($dummy_status) {
            array_push($search_condition, array('Property.dummy_status' => $dummy_status, 'Property.prop_status' => '1'));
        }
        if (count($this->params['pass'])) {

            $aaray = explode(':', $this->params['pass'][0]);
            $field = $aaray[0];
            $value = $aaray[1];
            array_push($search_condition, array('Property.' . $field => $value)); // when propertie is approve/pending
        }


        $this->paginate['order'] = array('Property.prop_approved' => 'asc');

        $this->set('properties', $this->paginate("Property", $search_condition));

        //$log = $this->Property->getDataSource()->getLog(false, false);       
        //debug($log);
        //die;







        if (!isset($this->passedArgs['owner_primarycity']) && empty($this->passedArgs['owner_primarycity'])) {
            $this->passedArgs['owner_primarycity'] = (isset($this->data['Property']['owner_primarycity'])) ? $this->data['Property']['owner_primarycity'] : '';
        }
        if (!isset($this->passedArgs['owner_name']) && empty($this->passedArgs['owner_name'])) {
            $this->passedArgs['owner_name'] = (isset($this->data['Property']['owner_name'])) ? $this->data['Property']['owner_name'] : '';
        }
        if (!isset($this->passedArgs['owner_residential']) && empty($this->passedArgs['owner_residential'])) {
            $this->passedArgs['owner_residential'] = (isset($this->data['Property']['owner_residential'])) ? $this->data['Property']['owner_residential'] : '';
        }
        if (!isset($this->passedArgs['owner_commercial']) && empty($this->passedArgs['owner_commercial'])) {
            $this->passedArgs['owner_commercial'] = (isset($this->data['Property']['owner_commercial'])) ? $this->data['Property']['owner_commercial'] : '';
        }
        if (!isset($this->passedArgs['owner_highendresidential']) && empty($this->passedArgs['owner_highendresidential'])) {
            $this->passedArgs['owner_highendresidential'] = (isset($this->data['Property']['owner_highendresidential'])) ? $this->data['Property']['owner_highendresidential'] : '';
        }
        if (!isset($this->data) && empty($this->data)) {
            $this->data['Property']['owner_primarycity'] = $this->passedArgs['owner_primarycity'];
            $this->data['Property']['owner_name'] = $this->passedArgs['owner_name'];
            $this->data['Property']['owner_residential'] = $this->passedArgs['owner_residential'];
            $this->data['Property']['owner_commercial'] = $this->passedArgs['owner_commercial'];
            $this->data['Property']['owner_highendresidential'] = $this->passedArgs['owner_highendresidential'];
        }

        $this->set(compact('owner_primarycity'));
        $this->set(compact('owner_name'));
        $this->set(compact('owner_residential'));
        $this->set(compact('owner_commercial'));
        $this->set(compact('owner_highendresidential'));



        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $suburb = $this->Suburb->find('list', array('fields' => array('Suburb.id, Suburb.suburb_name'), 'conditions' => array('Suburb.dummy_status' => $dummy_status, 'Suburb.suburb_status' => '1'), 'order' => 'Suburb.suburb_name ASC'));
        $this->set('suburbs', $suburb);

        $areas = $this->Area->find('list', array('fields' => array('Area.id, Area.area_name'), 'conditions' => array('Area.dummy_status' => $dummy_status, 'Area.area_status' => '1'), 'order' => 'Area.area_name ASC'));
        $this->set('areas', $areas);

        $categories = $this->LookupPropCategory->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('categories'));

        $types = $this->LookupPropType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set('types', $types);

        $prop_sourced_from = $this->LookupPropSourcedFrom->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_sourced_from'));

        $prop_sourced_for = $this->LookupPropSourcedFor->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_sourced_for'));
    }

    public function add() {

        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $condition_dummy_status = array('dummy_status =' . $dummy_status, 'id != 1');



        if ($this->request->is('post')) {



            $this->request->data['Property']['dummy_status'] = $dummy_status;
            $this->request->data['Property']['prop_approved'] = '2';
            $this->request->data['Property']['prop_status'] = '1';  // 1 for Yes of lookup_value_statuses
            $this->request->data['Property']['created_by'] = $user_id;

            $this->Property->create();

            $image1 = '';
            $image2 = '';
            $image3 = '';
            $image4 = '';
            $image5 = '';
            if (is_uploaded_file($this->request->data['Property']['prop_picture_1']['tmp_name'])) {
                $image1 = $this->Image->upload(null, $this->request->data['Property']['prop_picture_1'], $this->uploadDir);
            }
            if (is_uploaded_file($this->request->data['Property']['prop_picture_2']['tmp_name'])) {
                $image2 = $this->Image->upload(null, $this->request->data['Property']['prop_picture_2'], $this->uploadDir);
            }
            if (is_uploaded_file($this->request->data['Property']['prop_picture_3']['tmp_name'])) {
                $image3 = $this->Image->upload(null, $this->request->data['Property']['prop_picture_3'], $this->uploadDir);
            }
            if (is_uploaded_file($this->request->data['Property']['prop_picture_4']['tmp_name'])) {
                $image4 = $this->Image->upload(null, $this->request->data['Property']['prop_picture_4'], $this->uploadDir);
            }
            if (is_uploaded_file($this->request->data['Property']['prop_picture_5']['tmp_name'])) {
                $image5 = $this->Image->upload(null, $this->request->data['Property']['prop_picture_5'], $this->uploadDir);
            }
            unset($this->request->data['Property']['prop_picture_1']);
            unset($this->request->data['Property']['prop_picture_2']);
            unset($this->request->data['Property']['prop_picture_3']);
            unset($this->request->data['Property']['prop_picture_4']);
            unset($this->request->data['Property']['prop_picture_5']);
            $this->request->data['Property']['prop_picture_1'] = $image1;
            $this->request->data['Property']['prop_picture_2'] = $image2;
            $this->request->data['Property']['prop_picture_3'] = $image3;
            $this->request->data['Property']['prop_picture_4'] = $image4;
            $this->request->data['Property']['prop_picture_5'] = $image5;


            if ($this->Property->save($this->request->data['Property'])) {

                $property_id = $this->Property->getLastInsertId();
                if ($property_id) {

                    /*                     * ********************Property Remarks ******************************** */
                    $remarks['Remark']['property_id'] = $property_id;
                    $remarks['Remark']['remarks'] = 'New Property Record Created';
                    $remarks['Remark']['remarks_by'] = $user_id;
                    $remarks['Remark']['created_by'] = $user_id;
                    $remarks['Remark']['remarks_time'] = date('g:i A');
                    $remarks['Remark']['remarks_level'] = '13'; //13 for property from lookup_value_remarks_level
                    $remarks['Remark']['dummy_status'] = $dummy_status;
                    $this->Remark->save($remarks);




                    /*                     * ************************Property Action ********************** */
                    $action_item['ActionItem']['property_id'] = $property_id;
                    $action_item['ActionItem']['action_item_level_id'] = '18'; //  for Property 
                    $action_item['ActionItem']['type_id'] = '7'; // 7 for Submission For Approval
                    $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry
                    $action_item['ActionItem']['action_item_active'] = 'Yes';
                    $action_item['ActionItem']['action_item_status'] = '7'; //7 for Submitted For Approval table - lookup_value_action_item_statuses
                    $action_item['ActionItem']['description'] = 'New Property Record Created - Submission For Approval';
                    $action_item['ActionItem']['action_item_source'] = $role_id;
                    $action_item['ActionItem']['created_by_id'] = $user_id;
                    $action_item['ActionItem']['created_by'] = $user_id;
                    $action_item['ActionItem']['dummy_status'] = $dummy_status;
                    //$action_item['ActionItem']['next_action_by'] = $action_user_id;
                    $action_item['ActionItem']['next_action_by'] = '136';
                    $this->ActionItem->save($action_item);
                    $ActionId = $this->ActionItem->getLastInsertId();
                    $this->ActionItem->id = $ActionId;
                    $this->ActionItem->saveField('parent_action_item_id', $ActionId);



                    /* Email Logic */
                    /*
                      $to = 'neerajs@wtbglobal.com';
                      $Email = new CakeEmail();
                      $Email->viewVars(array(
                      'Property' => $this->data['Property']['owner_name'],
                      'Address' => $this->data['Property']['owner_corporateaddress'],
                      'Board_no' => $this->data['Property']['owner_boardnumber'],
                      'Board_email' => $this->data['Property']['owner_boardemail'],
                      'Status' => 'Submission For Approval',

                      ));
                      $Email->template('owner_template', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject('Silkrouters - Submission for Property')->send();
                     */
                    /* End Emial */
                    /* Phone API */
                    /*
                      $msg = $this->data['Property']['owner_name'].' | '.$this->data['Property']['owner_corporateaddress'].' | '.$this->data['Property']['owner_boardnumber'].' | '.$this->data['Property']['owner_boardemail'].' | Submission For Approval';
                      $authKey = Configure::read('sms_api_key');
                      $senderId = Configure::read('sms_sender_id');
                      // $mobileNumber = $channels[0]['User']['primary_mobile_number'];
                      $mobileNumber = "9833156460";
                      $message = urlencode($msg);
                      $route = "default";
                      $this->Sms->send_sms($authKey,$mobileNumber,$message,$senderId,$route);
                     */
                    /* End Phone */


                    $this->Session->setFlash('Property has been saved.', 'success');
                    $this->redirect(array('controller' => 'messages', 'action' => 'index', 'properties', 'my-properties'));
                }
            } else {
                $this->Session->setFlash('Unable to add property.', 'failure');
            }
        }

        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $types = $this->LookupPropType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set('types', $types);

        $owners = $this->Owner->find('list', array('fields' => 'id, owner_name', 'conditions' => array('owner_approved' => '1', 'owner_status' => '1'), 'order' => 'owner_name ASC'));
        $this->set(compact('owners'));

        $consultants = $this->Consultant->find('list', array('fields' => 'id, consultant_name', 'conditions' => array('consultant_approved' => '1', 'consultant_status' => '1'), 'order' => 'consultant_name ASC'));
        $this->set(compact('consultants'));

        $prop_sourced_from = $this->LookupPropSourcedFrom->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_sourced_from'));

        $prop_sourced_for = $this->LookupPropSourcedFor->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_sourced_for'));

        $area_units = $this->LookupProjectLandAreaUnit->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('area_units'));

        $unit_type = $this->LookupValueProjectUnitPreference->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set('unit_type', $unit_type);

        $prop_age = $this->LookupPropAge->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_age'));

        $prop_ownership = $this->LookupPropOwnership->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_ownership'));

        $prop_furnishing = $this->LookupPropFurnishing->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_furnishing'));

        $prop_facing = $this->LookupPropFacing->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_facing'));

        $prop_negotiable = $this->LookupPropNegotiable->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_negotiable'));

        $prop_availability = $this->LookupPropAvailability->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_availability'));

        $prop_commission_type = $this->LookupPropCommissionType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_commission_type'));

        $prop_commission_rentx = $this->LookupPropCommissionRent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_commission_rentx'));

        $prop_commission_based_on = $this->LookupPropCommissionBasedOn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_commission_based_on'));

        $prop_commission_event = $this->LookupPropCommissionEvent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_commission_event'));
    }

    function edit($id = null) {

        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $actio_itme_id = '';
        $flag = 0;
        $arr = explode('_', $id);
        $id = base64_decode($arr[0]);
        if (count($arr) > 1) {
            $actio_itme_id = $arr[1];
            $flag = 1;
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid Property'));
        }

        $properties = $this->Property->findById($id);


        if (!$properties) {
            throw new NotFoundException(__('Invalid owner'));
        }

        if ($this->request->data) {
            
            
            
            $image1 = '';
            $image2 = '';
            $image3 = '';
            $image4 = '';
            $image5 = '';
                if (is_uploaded_file($this->request->data['Property']['image1']['tmp_name'])) {
                    $image1 = $this->Image->upload($properties['Property']['prop_picture_1'], $this->request->data['Property']['image1'], $this->uploadDir, 'image1');
                    $this->request->data['Property']['prop_picture_1'] = $image1;
                } else {
                    unset($this->request->data['Property']['image1']);
                }
                
                if (is_uploaded_file($this->request->data['Property']['image2']['tmp_name'])) {
                    $image2 = $this->Image->upload($properties['Property']['prop_picture_2'], $this->request->data['Property']['image2'], $this->uploadDir, 'image2');
                    $this->request->data['Property']['prop_picture_2'] = $image2;
                } else {
                    unset($this->request->data['Property']['image2']);
                }
                
                if (is_uploaded_file($this->request->data['Property']['image3']['tmp_name'])) {
                    $image3 = $this->Image->upload($properties['Property']['prop_picture_3'], $this->request->data['Property']['image3'], $this->uploadDir, 'image3');
                    $this->request->data['Property']['prop_picture_3'] = $image3;
                } else {
                    unset($this->request->data['Property']['image3']);
                }
                
                if (is_uploaded_file($this->request->data['Property']['image4']['tmp_name'])) {
                    $image4 = $this->Image->upload($properties['Property']['prop_picture_4'], $this->request->data['Property']['image4'], $this->uploadDir, 'image4');
                    $this->request->data['Property']['prop_picture_4'] = $image4;
                } else {
                    unset($this->request->data['Property']['image4']);
                }
                
                if (is_uploaded_file($this->request->data['Property']['image5']['tmp_name'])) {
                    $image5 = $this->Image->upload($properties['Property']['prop_picture_5'], $this->request->data['Property']['image5'], $this->uploadDir, 'image5');
                    $this->request->data['Property']['prop_picture_5'] = $image5;
                } else {
                    unset($this->request->data['Property']['image5']);
                }
         
            $this->request->data['Property']['prop_approved'] = '2';


            /*             * ************************Property Action ********************** */
            $action_item['ActionItem']['property_id'] = $id;
            $action_item['ActionItem']['action_item_level_id'] = '18'; //  for Property
            $action_item['ActionItem']['type_id'] = '10'; // 10 for Re-Submission For Approval
            $action_item['ActionItem']['next_action_by'] = '148';
            $action_item['ActionItem']['action_item_active'] = 'Yes';
            $action_item['ActionItem']['action_item_status'] = '17'; //1 for created table - lookup_value_action_item_statuses
            $action_item['ActionItem']['description'] = 'Property Record Updated - Re-Submission For Approval';
            $action_item['ActionItem']['action_item_source'] = $role_id;
            $action_item['ActionItem']['created_by_id'] = $user_id;
            $action_item['ActionItem']['created_by'] = $user_id;
            $action_item['ActionItem']['dummy_status'] = $dummy_status;
            $action_item['ActionItem']['parent_action_item_id'] = $actio_itme_id;
            $action_item['ActionItem']['action_industry'] = '1'; // for realestate of lookup_value_activity_industry


            /*             * ********************Property Remarks ******************************** */
            $remarks['Remark']['property_id'] = $id;
            $remarks['Remark']['remarks'] = 'Edit Property Record';
            $remarks['Remark']['remarks_by'] = $user_id;
            $remarks['Remark']['created_by'] = $user_id;
            $remarks['Remark']['remarks_time'] = date('g:i A');
            $remarks['Remark']['remarks_level'] = '13'; //13 for Property from lookup_value_remarks_level
            $remarks['Remark']['dummy_status'] = $dummy_status;


            $this->Property->id = $id;
            if ($this->Property->save($this->request->data['Property'])) {

                $this->ActionItem->save($action_item);
                $ActionId = $this->ActionItem->getLastInsertId();
                $this->ActionItem->id = $ActionId;
                $this->ActionItem->saveField('parent_action_item_id', $ActionId);
                if ($actio_itme_id) {
                    $this->Remark->save($remarks);
                    $this->ActionItem->saveField('parent_action_item_id', $actio_itme_id);
                    $this->ActionItem->updateAll(array('ActionItem.action_item_active' => "'No'"), array('ActionItem.id' => $actio_itme_id));
                }
                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
            }

            if ($flag == 1)
                $this->redirect(array('controller' => 'action-items', 'action' => 'index'));
            else
                $this->redirect(array('controller' => 'messages','action' => 'index','properties','my-properties'));
                
        }


        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $suburbs = $this->Suburb->find('list', array('fields' => 'Suburb.id, Suburb.suburb_name', 'conditions' => array('Suburb.dummy_status' => $dummy_status, 'Suburb.suburb_status' => '1'), 'order' => 'Suburb.suburb_name ASC'));
        $this->set(compact('suburbs'));

        $areas = $this->Area->find('list', array('fields' => 'Area.id, Area.area_name', 'conditions' => array('Area.dummy_status' => $dummy_status, 'Area.area_status' => '1'), 'order' => 'Area.area_name ASC'));
        $this->set(compact('areas'));

        $categories = $this->LookupPropCategory->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('categories'));

        $types = $this->LookupPropType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set('types', $types);

        $owners = $this->Owner->find('list', array('fields' => 'id, owner_name', 'conditions' => array('owner_approved' => '1', 'owner_status' => '1'), 'order' => 'owner_name ASC'));
        $this->set(compact('owners'));

        $consultants = $this->Consultant->find('list', array('fields' => 'id, consultant_name', 'conditions' => array('consultant_approved' => '1', 'consultant_status' => '1'), 'order' => 'consultant_name ASC'));
        $this->set(compact('consultants'));

        $prop_sourced_from = $this->LookupPropSourcedFrom->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_sourced_from'));

        $prop_sourced_for = $this->LookupPropSourcedFor->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_sourced_for'));

        $area_units = $this->LookupProjectLandAreaUnit->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('area_units'));

        $unit_type = $this->LookupValueProjectUnitPreference->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set('unit_type', $unit_type);

        $prop_age = $this->LookupPropAge->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_age'));

        $prop_ownership = $this->LookupPropOwnership->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_ownership'));

        $prop_furnishing = $this->LookupPropFurnishing->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_furnishing'));

        $prop_facing = $this->LookupPropFacing->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_facing'));

        $prop_negotiable = $this->LookupPropNegotiable->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_negotiable'));

        $prop_availability = $this->LookupPropAvailability->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_availability'));

        $prop_commission_type = $this->LookupPropCommissionType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_commission_type'));

        $prop_commission_rentx = $this->LookupPropCommissionRent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_commission_rentx'));

        $prop_commission_based_on = $this->LookupPropCommissionBasedOn->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_commission_based_on'));

        $prop_commission_event = $this->LookupPropCommissionEvent->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('prop_commission_event'));

        $this->request->data = $properties;
    }

    function view($id = null) {

        $arr = explode('_', $id);
        $id = base64_decode($arr[0]);


        if (!$id) {
            throw new NotFoundException(__('Invalid Property'));
        }

        $propertie = $this->Property->findById($id);


        if (!$propertie) {
            throw new NotFoundException(__('Invalid propertie'));
        }


        $this->request->data = $propertie;
    }

}

