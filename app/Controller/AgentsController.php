<?php
/**
 * Agent controller.
 *
 * This file will render views from views/agents/
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
 * Agent controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class AgentsController extends AppController {

    public $uses = array('Agent', 'City', 'Event', 'User', 'LookupValueActivityType', 'LookupValueActivityDetail', 'LookupValueActivityLevel', 'TravelActionItemType', 'LookupValueTravelAllocation', 'Suburb', 'Area', 'LookupAgentStatus', 'LookupValueStatus', 'Channel', 'TravelRemark', 'TravelActionItem', 'LookupAgentBusinessType', 'CwrCountry', 'LookupAgentNatureOfBusiness', 'LookupAgentProcurementType', 'LookupAgentSource', 'LookupValueLeadsCountry', 'Timezone');

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $role_id = $this->Session->read("role_id");
        $search_condition = array();
        $channel_id = $this->Session->read("channel_id");
        $channel_id = $this->Channel->findById($channel_id);
        $city_id = $channel_id['Channel']['city_id'];
        $agent_name = '';
        $agent_incorporated_in_country = '';
        $agent_primary_city = '';
        $agent_suburb = '';
        $agent_area = '';
        $agent_status = '';
        $agent_procurement_type = '';
        $agent_nature_of_business = '';
        $agent_multicity = '';
        $agent_whitelabel = '';
        $agent_xml = '';
        $agent_source = '';
        $agent_business_type = '';
        $suburbs = array();
        $areas = array();

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['Agent']['agent_name'])) {
                $agent_name = $this->data['Agent']['agent_name'];
                array_push($search_condition, array('Agent.agent_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($agent_name))) . "%"));
            }

            if (!empty($this->data['Agent']['agent_incorporated_in_country'])) {
                $agent_incorporated_in_country = $this->data['Agent']['agent_incorporated_in_country'];
                array_push($search_condition, array('Agent.agent_incorporated_in_country' => $agent_incorporated_in_country));
            }
            if (!empty($this->data['Agent']['agent_primary_city'])) {
                $agent_primary_city = $this->data['Agent']['agent_primary_city'];
                array_push($search_condition, array('Agent.agent_primary_city' => $agent_primary_city));
            }
            if (!empty($this->data['Agent']['agent_suburb'])) {
                $agent_suburb = $this->data['Agent']['agent_suburb'];
                array_push($search_condition, array('Agent.agent_suburb' => $agent_suburb));
            }
            if (!empty($this->data['Agent']['agent_area'])) {
                $agent_area = $this->data['Agent']['agent_area'];
                array_push($search_condition, array('Agent.agent_area' => $agent_area));
            }
            if (!empty($this->data['Agent']['agent_status'])) {
                $agent_status = $this->data['Agent']['agent_status'];
                array_push($search_condition, array('Agent.agent_status' => $agent_status));
            }
            if (!empty($this->data['Agent']['agent_procurement_type'])) {
                $agent_procurement_type = $this->data['Agent']['agent_procurement_type'];
                array_push($search_condition, array('Agent.agent_procurement_type' => $agent_procurement_type));
            }
            if (!empty($this->data['Agent']['agent_nature_of_business'])) {
                $agent_nature_of_business = $this->data['Agent']['agent_nature_of_business'];
                array_push($search_condition, array('Agent.agent_nature_of_business' => $agent_nature_of_business));
            }
            if (!empty($this->data['Agent']['agent_multicity'])) {
                $agent_multicity = $this->data['Agent']['agent_multicity'];
                array_push($search_condition, array('Agent.agent_multicity' => $agent_multicity));
            }
            if (!empty($this->data['Agent']['agent_business_type'])) {
                $agent_business_type = $this->data['Agent']['agent_business_type'];
                array_push($search_condition, array('Agent.agent_business_type' => $agent_business_type));
            }
            if (!empty($this->data['Agent']['agent_source'])) {
                $agent_source = $this->data['Agent']['agent_source'];
                array_push($search_condition, array('Agent.agent_source' => $agent_source));
            }
            if (!empty($this->data['Agent']['agent_xml'])) {
                $agent_xml = $this->data['Agent']['agent_xml'];
                array_push($search_condition, array('Agent.agent_xml' => $agent_xml));
            }
            if (!empty($this->data['Agent']['agent_whitelabel'])) {
                $agent_whitelabel = $this->data['Agent']['agent_whitelabel'];
                array_push($search_condition, array('Agent.agent_whitelabel' => $agent_whitelabel));
            }

            $suburbs = $this->Suburb->find('list', array('conditions' => array('Suburb.city_id' => $agent_primary_city,
                    'Suburb.dummy_status' => $dummy_status,
                    'Suburb.suburb_status' => '1'
                ),
                'fields' => 'Suburb.id, Suburb.suburb_name',
                'order' => 'Suburb.suburb_name ASC'
            ));


            $areas = $this->Area->find('list', array(
                'conditions' => array(
                    'Area.suburb_id' => $this->data['Agent']['agent_suburb'],
                    'Area.dummy_status' => $dummy_status,
                    'Area.area_status' => '1'
                ),
                'fields' => 'Area.id, Area.area_name',
                'order' => 'Area.area_name ASC'
            ));
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['agent_name'])) {
                $agent_name = $this->request->params['named']['agent_name'];
                array_push($search_condition, array("Agent.agent_name LIKE '%$agent_name%'"));
            }

            if (!empty($this->request->params['named']['agent_incorporated_in_country'])) {
                $agent_incorporated_in_country = $this->request->params['named']['agent_incorporated_in_country'];
                array_push($search_condition, array('Agent.agent_incorporated_in_country' => $agent_incorporated_in_country));
            }
            if (!empty($this->request->params['named']['agent_primary_city'])) {
                $agent_primary_city = $this->request->params['named']['agent_primary_city'];
                array_push($search_condition, array('Agent.agent_primary_city' => $agent_primary_city));
            }
            if (!empty($this->request->params['named']['agent_suburb'])) {
                $agent_suburb = $this->request->params['named']['agent_suburb'];
                array_push($search_condition, array('Agent.agent_suburb' => $agent_suburb));
            }
            if (!empty($this->request->params['named']['agent_area'])) {
                $agent_area = $this->request->params['named']['agent_area'];
                array_push($search_condition, array('Agent.agent_area' => $agent_area));
            }
            if (!empty($this->request->params['named']['agent_status'])) {
                $agent_status = $this->request->params['named']['agent_status'];
                array_push($search_condition, array('Agent.agent_status' => $agent_status));
            }
            if (!empty($this->request->params['named']['agent_procurement_type'])) {
                $agent_procurement_type = $this->request->params['named']['agent_procurement_type'];
                array_push($search_condition, array('Agent.agent_procurement_type' => $agent_procurement_type));
            }
            if (!empty($this->request->params['named']['agent_nature_of_business'])) {
                $agent_nature_of_business = $this->request->params['named']['agent_nature_of_business'];
                array_push($search_condition, array('Agent.agent_nature_of_business' => $agent_nature_of_business));
            }
            if (!empty($this->request->params['named']['agent_multicity'])) {
                $agent_multicity = $this->request->params['named']['agent_multicity'];
                array_push($search_condition, array('Agent.agent_multicity' => $agent_multicity));
            }
            if (!empty($this->request->params['named']['agent_business_type'])) {
                $agent_business_type = $this->request->params['named']['agent_business_type'];
                array_push($search_condition, array('Agent.agent_business_type' => $agent_business_type));
            }
            if (!empty($this->request->params['named']['agent_source'])) {
                $agent_source = $this->request->params['named']['agent_source'];
                array_push($search_condition, array('Agent.agent_source' => $agent_source));
            }
            if (!empty($this->request->params['named']['agent_xml'])) {
                $agent_xml = $this->request->params['named']['agent_xml'];
                array_push($search_condition, array('Agent.agent_xml' => $agent_xml));
            }
            if (!empty($this->request->params['named']['agent_whitelabel'])) {
                $agent_whitelabel = $this->request->params['named']['agent_whitelabel'];
                array_push($search_condition, array('Agent.agent_whitelabel' => $agent_whitelabel));
            }
        }

        if ($city_id <> '1') { // Not a Global City
            array_push($search_condition, array('Agent.agent_primary_city' => $city_id));
            $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1', 'City.id' => $city_id), 'order' => 'City.city_name ASC'));
            $this->set('city', $city);
        } else {
            $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
            $this->set('city', $city);
        }

        if ($dummy_status)
            array_push($search_condition, array('NOT' => array('Agent.agent_status' => '11'), 'Agent.dummy_status' => $dummy_status));

        if (count($this->params['pass'])) {

            $aaray = explode(':', $this->params['pass'][0]);
            $field = $aaray[0];
            $value = $aaray[1];
            array_push($search_condition, array('Agent.' . $field => $value)); // when builder is approve/pending
        }


        $this->paginate['order'] = array('Agent.created' => 'asc');
        $this->set('Agents', $this->paginate("Agent", $search_condition));

        $countries = $this->CwrCountry->find('list', array('fields' => 'CwrCountry.id, CwrCountry.name', 'conditions' => array('CwrCountry.id' => '113'), 'order' => 'CwrCountry.name ASC'));
        $this->set(compact('countries'));



        $ProcurementTypes = $this->LookupAgentProcurementType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('ProcurementTypes'));

        $NatureOfBusinesses = $this->LookupAgentNatureOfBusiness->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('NatureOfBusinesses'));

        $LookupValueStatuses = $this->LookupValueStatus->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('LookupValueStatuses'));

        $LookupAgentStatuses = $this->LookupAgentStatus->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('LookupAgentStatuses'));

        $AgentSourcees = $this->LookupAgentSource->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('AgentSourcees'));

        $AgentBusinessTypes = $this->LookupAgentBusinessType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('AgentBusinessTypes'));


        if (!isset($this->passedArgs['agent_name']) && empty($this->passedArgs['agent_name'])) {
            $this->passedArgs['agent_name'] = (isset($this->data['Agent']['agent_name'])) ? $this->data['Agent']['agent_name'] : '';
        }
        if (!isset($this->passedArgs['agent_incorporated_in_country']) && empty($this->passedArgs['agent_incorporated_in_country'])) {
            $this->passedArgs['agent_incorporated_in_country'] = (isset($this->data['Agent']['agent_incorporated_in_country'])) ? $this->data['Agent']['agent_incorporated_in_country'] : '';
        }
        if (!isset($this->passedArgs['agent_primary_city']) && empty($this->passedArgs['agent_primary_city'])) {
            $this->passedArgs['agent_primary_city'] = (isset($this->data['Agent']['agent_primary_city'])) ? $this->data['Agent']['agent_primary_city'] : '';
        }
        if (!isset($this->passedArgs['agent_suburb']) && empty($this->passedArgs['agent_suburb'])) {
            $this->passedArgs['agent_suburb'] = (isset($this->data['Agent']['agent_suburb'])) ? $this->data['Agent']['agent_suburb'] : '';
        }
        if (!isset($this->passedArgs['agent_area']) && empty($this->passedArgs['agent_area'])) {
            $this->passedArgs['agent_area'] = (isset($this->data['Agent']['agent_area'])) ? $this->data['Agent']['agent_area'] : '';
        }
        if (!isset($this->passedArgs['agent_status']) && empty($this->passedArgs['agent_status'])) {
            $this->passedArgs['agent_status'] = (isset($this->data['Agent']['agent_status'])) ? $this->data['Agent']['agent_status'] : '';
        }
        if (!isset($this->passedArgs['agent_procurement_type']) && empty($this->passedArgs['agent_procurement_type'])) {
            $this->passedArgs['agent_procurement_type'] = (isset($this->data['Agent']['agent_procurement_type'])) ? $this->data['Agent']['agent_procurement_type'] : '';
        }
        if (!isset($this->passedArgs['agent_nature_of_business']) && empty($this->passedArgs['agent_nature_of_business'])) {
            $this->passedArgs['agent_nature_of_business'] = (isset($this->data['Agent']['agent_nature_of_business'])) ? $this->data['Agent']['agent_nature_of_business'] : '';
        }
        if (!isset($this->passedArgs['agent_multicity']) && empty($this->passedArgs['agent_multicity'])) {
            $this->passedArgs['agent_multicity'] = (isset($this->data['Agent']['agent_multicity'])) ? $this->data['Agent']['agent_multicity'] : '';
        }
        if (!isset($this->passedArgs['agent_business_type']) && empty($this->passedArgs['agent_business_type'])) {
            $this->passedArgs['agent_business_type'] = (isset($this->data['Agent']['agent_business_type'])) ? $this->data['Agent']['agent_business_type'] : '';
        }
        if (!isset($this->passedArgs['agent_source']) && empty($this->passedArgs['agent_source'])) {
            $this->passedArgs['agent_source'] = (isset($this->data['Agent']['agent_source'])) ? $this->data['Agent']['agent_source'] : '';
        }
        if (!isset($this->passedArgs['agent_xml']) && empty($this->passedArgs['agent_xml'])) {
            $this->passedArgs['agent_xml'] = (isset($this->data['Agent']['agent_xml'])) ? $this->data['Agent']['agent_xml'] : '';
        }
        if (!isset($this->passedArgs['agent_whitelabel']) && empty($this->passedArgs['agent_whitelabel'])) {
            $this->passedArgs['agent_whitelabel'] = (isset($this->data['Agent']['agent_whitelabel'])) ? $this->data['Agent']['agent_whitelabel'] : '';
        }


        if (!isset($this->data) && empty($this->data)) {
            $this->data['Agent']['agent_name'] = $this->passedArgs['agent_name'];
            $this->data['Agent']['agent_incorporated_in_country'] = $this->passedArgs['agent_incorporated_in_country'];
            $this->data['Agent']['agent_primary_city'] = $this->passedArgs['agent_primary_city'];
            $this->data['Agent']['agent_suburb'] = $this->passedArgs['agent_suburb'];
            $this->data['Agent']['agent_area'] = $this->passedArgs['agent_area'];
            $this->data['Agent']['agent_status'] = $this->passedArgs['agent_status'];
            $this->data['Agent']['agent_procurement_type'] = $this->passedArgs['agent_procurement_type'];
            $this->data['Agent']['agent_nature_of_business'] = $this->passedArgs['agent_nature_of_business'];
            $this->data['Agent']['agent_multicity'] = $this->passedArgs['agent_multicity'];
            $this->data['Agent']['agent_business_type'] = $this->passedArgs['agent_business_type'];
            $this->data['Agent']['agent_source'] = $this->passedArgs['agent_source'];
            $this->data['Agent']['agent_xml'] = $this->passedArgs['agent_xml'];
            $this->data['Agent']['agent_whitelabel'] = $this->passedArgs['agent_whitelabel'];
        }

        $this->set(compact('agent_name'));
        $this->set(compact('agent_incorporated_in_country'));
        $this->set(compact('agent_primary_city'));
        $this->set(compact('agent_suburb'));
        $this->set(compact('agent_area'));
        $this->set(compact('agent_status'));
        $this->set(compact('agent_procurement_type'));
        $this->set(compact('agent_nature_of_business'));
        $this->set(compact('agent_multicity'));
        $this->set(compact('suburbs'));
        $this->set(compact('areas'));
        $this->set(compact('agent_business_type'));
        $this->set(compact('agent_source'));
        $this->set(compact('agent_xml'));
        $this->set(compact('agent_whitelabel'));
    }

    public function add() {


        $user_id = $this->Auth->user('id');
        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $channel_id = $this->Session->read("channel_id");
        $channel_id = $this->Channel->findById($channel_id);
        $city_id = $channel_id['Channel']['city_id'];



        if ($this->request->is('post') || $this->request->is('put')) {

            $next_action_by = '136';  //overseer
            $to = 'infra@sumanus.com';
            $this->request->data['Agent']['dummy_status'] = $dummy_status;
            $this->request->data['Agent']['agent_approved'] = '2'; // 2 for No of lookup_value_statuses
            $this->request->data['Agent']['agent_status'] = '9';  //  for Submitted for Approval of lookup_agent_statuses
            $this->request->data['Agent']['created_by'] = $user_id;
            if ($this->data['Agent']['agent_contact_number_landline'] == '')
                $this->request->data['Agent']['agent_contact_number_code_landline'] = '';


            $this->Agent->set($this->data['Agent']);
            if ($this->Agent->validates() == true) {
                if ($this->Agent->save($this->request->data['Agent'])) {

                    $agent_id = $this->Agent->getLastInsertId();
                    if ($agent_id) {

                        /*
                         * ***************** Remarks *******************
                         */
                        $tr_remarks['TravelRemark']['agent_id'] = $agent_id;
                        $tr_remarks['TravelRemark']['remarks'] = 'New Agent Record Created';
                        $tr_remarks['TravelRemark']['created_by'] = $user_id;
                        $tr_remarks['TravelRemark']['remarks_time'] = date('g:i A');
                        $tr_remarks['TravelRemark']['remarks_level'] = '1'; // for agent from travel_action_remark_levels
                        $tr_remarks['TravelRemark']['dummy_status'] = $dummy_status;
                        $this->TravelRemark->save($tr_remarks);




                        /*
                         * ********************** Action *********************
                         */
                        $tr_action_item['TravelActionItem']['agent_id'] = $agent_id;
                        $tr_action_item['TravelActionItem']['level_id'] = '1'; // for agent travel_action_remark_levels 
                        $tr_action_item['TravelActionItem']['type_id'] = '1'; // for agent from travel_action_remark_levels
                        $tr_action_item['TravelActionItem']['action_item_active'] = 'Yes';
                        $tr_action_item['TravelActionItem']['description'] = 'New Agent Record Created - Submission For Approval';
                        $tr_action_item['TravelActionItem']['action_item_source'] = $role_id;
                        $tr_action_item['TravelActionItem']['created_by_id'] = $user_id;
                        $tr_action_item['TravelActionItem']['created_by'] = $user_id;
                        $tr_action_item['TravelActionItem']['dummy_status'] = $dummy_status;
                        $tr_action_item['TravelActionItem']['next_action_by'] = $next_action_by;
                        $tr_action_item['TravelActionItem']['parent_action_item_id'] = '';
                        $this->TravelActionItem->save($tr_action_item);
                        $ActionId = $this->TravelActionItem->getLastInsertId();
                        $ActionUpdateArr['TravelActionItem']['parent_action_item_id'] = "'" . $ActionId . "'";
                        $this->TravelActionItem->updateAll($ActionUpdateArr['TravelActionItem'], array('TravelActionItem.id' => $ActionId));

                        $AgentUpdateArr['Agent']['agent_action_parent_id'] = "'" . $ActionId . "'";
                        $this->Agent->updateAll($AgentUpdateArr['Agent'], array('Agent.id' => $agent_id));

                        /*
                         * Email Logic
                         */
                        $Agents = $this->Agent->findById($agent_id);
                        if ($Agents['Agent']['agent_multicity'])
                            $agent_multicity = 'YES';
                        else
                            $agent_multicity = 'NO';
                        $Email = new CakeEmail();


                        $Email->viewVars(array(
                            'AgentName' => strtoupper($Agents['Agent']['agent_name']),
                            'PrimaryCity' => strtoupper($Agents['PrimaryCity']['city_name']),
                            'MultiCity' => $agent_multicity,
                            'ProcurementType' => strtoupper($Agents['ProcurementType']['value']),
                            'AgentBusinessNature' => strtoupper($Agents['AgentBusinessNature']['value']),
                            'AgentBusinessType' => strtoupper($Agents['AgentBusinessType']['value']),
                            'CreatedBy' => $Agents['Agent']['created_by'],
                            'Status' => strtoupper($Agents['AgentStatus']['value']),
                            'NextActionBy' => $next_action_by
                        ));

                        $Email->template('Agents/add', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject(' ADD AGENT ')->send();
                        /* End Emial */
                        /* Phone API */
                        /*
                          $msg = $this->data['Builder']['builder_name'].' | '.$this->data['Builder']['builder_corporateaddress'].' | '.$this->data['Builder']['builder_boardnumber'].' | '.$this->data['Builder']['builder_boardemail'].' | Submission For Approval';
                          $authKey = Configure::read('sms_api_key');
                          $senderId = Configure::read('sms_sender_id');
                          // $mobileNumber = $channels[0]['User']['primary_mobile_number'];
                          $mobileNumber = "9833156460";
                          $message = urlencode($msg);
                          $route = "default";
                          $this->Sms->send_sms($authKey,$mobileNumber,$message,$senderId,$route);
                         */
                        /* End Phone */

                        $this->Session->setFlash('Data have been submitted. Waiting for approval at the moment...', 'success');
                        $this->redirect(array('controller' => 'messages', 'action' => 'index', 'agents', 'my-agents'));
                    }
                }
            } else {
                $this->Session->setFlash('Unable to add data.', 'failure');
            }
        }

        $countries = $this->CwrCountry->find('list', array('fields' => 'CwrCountry.id, CwrCountry.name', 'conditions' => array('CwrCountry.id' => '113'), 'order' => 'CwrCountry.name ASC'));
        $this->set(compact('countries'));

        if ($city_id <> '1') { // Not a Global City
            $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1', 'City.id' => $city_id), 'order' => 'City.city_name ASC'));
            $this->set('city', $city);
        } else {
            $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
            $this->set('city', $city);
        }

        $ProcurementTypes = $this->LookupAgentProcurementType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('ProcurementTypes'));

        $NatureOfBusinesses = $this->LookupAgentNatureOfBusiness->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('NatureOfBusinesses'));

        $AgentSourcees = $this->LookupAgentSource->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('AgentSourcees'));

        $AgentBusinessTypes = $this->LookupAgentBusinessType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('AgentBusinessTypes'));

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $timezone = $this->Timezone->find('all', array('fields' => array('Timezone.id', 'Timezone.timezone_location', 'Timezone.gmt')));
        $timezone = Set::combine($timezone, '{n}.Timezone.id', array('%s %s', '{n}.Timezone.gmt', '{n}.Timezone.timezone_location'));
        $this->set(compact('timezone'));




        // $this->set('timezone', $timezoneTable);
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
            throw new NotFoundException(__('Invalid Agent'));
        }

        $Agents = $this->Agent->findById($id);


        if (!$Agents) {
            throw new NotFoundException(__('Invalid Agent'));
        }

        if ($this->request->data) {


            $oversing_user = array();

            //$this->request->data['Agent']['agent_approved'] = '2'; // 2 No
            $this->request->data['Agent']['parent_action_item_id'] = $Agents['Agent']['agent_action_parent_id'];
            $this->request->data['Agent']['agent_status'] = '10';  //  for Re-Submission For Approval of lookup_agent_statuses

            /*             * ************************* Action ********************** */
            $travel_action_item['TravelActionItem']['agent_id'] = $id;
            $travel_action_item['TravelActionItem']['level_id'] = '1';  // for agent travel_action_remark_levels 
            $travel_action_item['TravelActionItem']['type_id'] = '4'; // for Change Submitted of travel_action_item_types
            $travel_action_item['TravelActionItem']['next_action_by'] = '136';
            $travel_action_item['TravelActionItem']['action_item_active'] = 'Yes';
            $travel_action_item['TravelActionItem']['description'] = 'Agent Record Updated - Re-Submission For Approval';
            $travel_action_item['TravelActionItem']['action_item_source'] = $role_id;
            $travel_action_item['TravelActionItem']['created_by_id'] = $Agents['Agent']['created_by'];
            $travel_action_item['TravelActionItem']['created_by'] = $user_id;
            $travel_action_item['TravelActionItem']['dummy_status'] = $dummy_status;
            $travel_action_item['TravelActionItem']['parent_action_item_id'] = $Agents['Agent']['agent_action_parent_id'];


            /*             * ********************* Remarks ******************************** */
            $travel_remarks['TravelRemark']['agent_id'] = $id;
            $travel_remarks['TravelRemark']['remarks'] = 'Edit Agnet Record';
            $travel_remarks['TravelRemark']['created_by'] = $user_id;
            $travel_remarks['TravelRemark']['remarks_time'] = date('g:i A');
            $travel_remarks['TravelRemark']['remarks_level'] = '1';  // for agent travel_action_remark_levels 
            $travel_remarks['TravelRemark']['dummy_status'] = $dummy_status;
            $this->TravelRemark->save($travel_remarks);

            if ($this->data['Agent']['action_type'] == '0') {

                $this->request->data['Agent']['agent_active_primary'] = '1';
                $travel_action_item['TravelActionItem']['screen_no'] = 'SC-1';
            } else if ($this->data['Agent']['action_type'] == '1') {
                $travel_action_item['TravelActionItem']['screen_no'] = 'SC-2';
                $this->request->data['Agent']['agent_active_preference'] = '1';
            }
            $this->Agent->id = $id;
            if ($this->Agent->save($this->request->data['Agent'])) {
                $this->TravelActionItem->save($travel_action_item);
                $ActionId = $this->TravelActionItem->getLastInsertId();
                if ($actio_itme_id) {
                    $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));
                }


                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');
            }

            $this->set('action_type', $this->data['Agent']['action_type']);
            //$log = $this->Agent->getDataSource()->getLog(false, false);       
            //debug($log);
            //die;

            if ($flag == 1)
                $this->redirect(array('controller' => 'travel_action_items', 'action' => 'index'));
        }

        $suburbs = $this->Suburb->find('list', array('conditions' => array('Suburb.city_id' => $Agents['Agent']['agent_primary_city'],
                'Suburb.dummy_status' => $dummy_status,
                'Suburb.suburb_status' => '1'
            ),
            'fields' => 'Suburb.id, Suburb.suburb_name',
            'order' => 'Suburb.suburb_name ASC'
        ));
        $this->set(compact('suburbs'));

        $areas = $this->Area->find('list', array(
            'conditions' => array(
                'Area.suburb_id' => $Agents['Agent']['agent_suburb'],
                'Area.dummy_status' => $dummy_status,
                'Area.area_status' => '1'
            ),
            'fields' => 'Area.id, Area.area_name',
            'order' => 'Area.area_name ASC'
        ));
        $this->set(compact('areas'));

        $countries = $this->CwrCountry->find('list', array('fields' => 'CwrCountry.id, CwrCountry.name', 'conditions' => array('CwrCountry.id' => '113'), 'order' => 'CwrCountry.name ASC'));
        $this->set(compact('countries'));

        $city = $this->City->find('list', array('fields' => 'City.id, City.city_name', 'conditions' => array('City.dummy_status' => $dummy_status, 'City.city_status' => '1'), 'order' => 'City.city_name ASC'));
        $this->set('city', $city);

        $ProcurementTypes = $this->LookupAgentProcurementType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('ProcurementTypes'));

        $NatureOfBusinesses = $this->LookupAgentNatureOfBusiness->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('NatureOfBusinesses'));

        $AgentSourcees = $this->LookupAgentSource->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('AgentSourcees'));

        $AgentBusinessTypes = $this->LookupAgentBusinessType->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('AgentBusinessTypes'));

        $codes = $this->LookupValueLeadsCountry->find('all', array('fields' => array('LookupValueLeadsCountry.id', 'LookupValueLeadsCountry.value', 'LookupValueLeadsCountry.code')));
        $codes = Set::combine($codes, '{n}.LookupValueLeadsCountry.id', array('%s: %s', '{n}.LookupValueLeadsCountry.value', '{n}.LookupValueLeadsCountry.code'));
        $this->set(compact('codes'));

        $timezone = $this->Timezone->find('all', array('fields' => array('Timezone.id', 'Timezone.timezone_location', 'Timezone.gmt')));
        $timezone = Set::combine($timezone, '{n}.Timezone.id', array('%s %s', '{n}.Timezone.gmt', '{n}.Timezone.timezone_location'));
        $this->set(compact('timezone'));


        $this->request->data = $Agents;
    }

    function view($id = null) {

        $id = base64_decode($id);
        if (!$id) {
            throw new NotFoundException(__('Invalid Agent'));
        }
        $Agents = $this->Agent->findById($id);
        if (!$Agents) {
            throw new NotFoundException(__('Invalid Agent'));
        }
        $this->request->data = $Agents;
    }

    function action_transaction($id = null) {

        $this->layout = 'ajax';
        $dummy_status = $this->Auth->user('dummy_status');
        $channel_id = $this->Session->read("channel_id");
        $channels = $this->Channel->findById($channel_id);
        $channel_head = $channels['Channel']['channel_head'];
        $city_id = $channels['Channel']['city_id'];
        $role_id = $this->Session->read("role_id");
        $user_id = $this->Auth->user('id');

        $Agents = $this->Agent->findById($id, array('Agent.agent_name', 'Agent.created_by', 'Agent.agent_action_parent_id'));
        $parent_action_item_id = $Agents['Agent']['agent_action_parent_id'];

        if ($this->request->is('post') || $this->request->is('put')) {

            $next_action_by = '136';  //overseer
            $to = 'infra@sumanus.com';
            /*
             * Define Agent Data
             */
            $this->request->data['Agent']['agent_status'] = '12';
            /*
             * Define Event variable
             */
            $this->request->data['Event']['activity_past'] = 'No';
            $start_date = date('Y-m-d', strtotime($this->request->data['Event']['date1'])) . " " . date("H:i", strtotime($this->data['Event']['start_time']));
            $end_date = date('Y-m-d', strtotime($this->request->data['Event']['date2'])) . " " . date("H:i", strtotime($this->data['Event']['end_time']));
            $this->request->data['Event']['start_date'] = $start_date;
            $this->request->data['Event']['end_date'] = $end_date;
            $this->request->data['Event']['creator_id'] = $user_id;
            $this->request->data['Event']['user_id'] = $user_id;
            $this->request->data['Event']['active'] = '1';
            $this->request->data['Event']['role_city'] = $city_id; // Role city
            $this->request->data['Event']['activity_industry'] = '2'; //  for Travel
            $this->request->data['Event']['activity_closed'] = 'No'; //  
            $this->request->data['Event']['activity_completed'] = '2';    // NO 
            $this->request->data['Event']['activity_status'] = '2'; //  for No
            $this->request->data['Event']['event_type'] = '1'; //1 for general event 
            $this->request->data['Event']['dummy_status'] = $dummy_status;
            $this->request->data['Event']['description'] = $this->data['Event']['start_time'] . '-' . $this->data['Event']['end_time'];



            /*             * ************************* Action ********************** */
            $this->request->data['TravelActionItem']['agent_id'] = $id;
            $this->request->data['TravelActionItem']['level_id'] = '1';  // for agent travel_action_remark_levels 
            $this->request->data['TravelActionItem']['next_action_by'] = $next_action_by;
            $this->request->data['TravelActionItem']['action_item_active'] = 'Yes';
            $this->request->data['TravelActionItem']['action_item_source'] = $role_id;
            $this->request->data['TravelActionItem']['created_by_id'] = $Agents['Agent']['created_by'];
            $this->request->data['TravelActionItem']['created_by'] = $user_id;
            $this->request->data['TravelActionItem']['dummy_status'] = $dummy_status;
            $this->request->data['TravelActionItem']['parent_action_item_id'] = $Agents['Agent']['agent_action_parent_id'];


            /*             * ********************* Remarks ******************************** */
            $travel_remarks['TravelRemark']['agent_id'] = $id;
            $travel_remarks['TravelRemark']['remarks'] = 'Agent Action Record Updated - Allocation For Approval';
            $travel_remarks['TravelRemark']['created_by'] = $user_id;
            $travel_remarks['TravelRemark']['remarks_time'] = date('g:i A');
            $travel_remarks['TravelRemark']['remarks_level'] = '1';  // for agent travel_action_remark_levels 
            $travel_remarks['TravelRemark']['dummy_status'] = $dummy_status;

            $this->Agent->id = $id;
            if ($this->Agent->save($this->request->data['Agent'])) {
                $this->TravelActionItem->save($this->request->data['TravelActionItem']); // data save of travel_action_items table
                $tarvel_action_id = $this->TravelActionItem->getLastInsertId();
                $this->Event->save($this->request->data['Event']); // data save of event table
                $event_id = $this->Event->getLastInsertId();
                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');

                /*
                 * Email Logic
                 */
                $Agents = $this->Agent->findById($id);
                $TravelActionItems = $this->TravelActionItem->findById($tarvel_action_id);
                $eventArray = $this->Event->findById($event_id);
                if ($Agents['Agent']['agent_multicity'])
                    $agent_multicity = 'YES';
                else
                    $agent_multicity = 'NO';
                $Email = new CakeEmail();


                $Email->viewVars(array(
                    'AgentName' => strtoupper($Agents['Agent']['agent_name']),
                    'PrimaryCity' => strtoupper($Agents['PrimaryCity']['city_name']),
                    'MultiCity' => $agent_multicity,
                    'ProcurementType' => strtoupper($Agents['ProcurementType']['value']),
                    'AgentBusinessNature' => strtoupper($Agents['AgentBusinessNature']['value']),
                    'AgentBusinessType' => strtoupper($Agents['AgentBusinessType']['value']),
                    'CreatedBy' => $Agents['Agent']['created_by'],
                    'Status' => strtoupper($Agents['AgentStatus']['value']),
                    'NextActionBy' => $next_action_by,
                    'ActionAllocationReason' => strtoupper($TravelActionItems['AllocationReason']['value']),
                    'ActionRemark' => strtoupper($TravelActionItems['TravelActionItem']['description']),
                    'ActivityFrom' => date("F j, Y, g:i a", strtotime($eventArray['Event']['start_date'])),
                    'ActivityTo' => date("F j, Y, g:i a", strtotime($eventArray['Event']['end_date'])),
                    'ActivityLevel' => strtoupper($eventArray['ActivityLevel']['value']),
                    'ActivityWith' => strtoupper($eventArray['Agent']['agent_name']),
                    'ActivityType' => strtoupper($eventArray['ActivityType']['value']),
                    'ActivityDetails' => strtoupper($eventArray['Details']['value']),
                    'ActivityDescription' => strtoupper($eventArray['Event']['event_level_desc']),
                ));

                $Email->template('Agents/allocation', 'default')->emailFormat('html')->to($to)->from('admin@silkrouters.com')->subject('REQUEST FOR ALLOCATION')->send();
                /* End Emial */
            } else {
                $this->Session->setFlash('Unable to update data.', 'failure');
            }

            echo '<script>
                    var objP=parent.document.getElementsByClassName("mfp-bg");
                    var objC=parent.document.getElementsByClassName("mfp-wrap");
                    objP[0].style.display="none";
                    objC[0].style.display="none";
                    parent.location.reload(true);</script>';
        }


        $type = $this->TravelActionItemType->find('list', array('fields' => array('id', 'value'), 'conditions' => array('id' => '6')));
        $this->set(compact('type'));

        $allocation_reason = $this->LookupValueTravelAllocation->find('list', array('fields' => array('id', 'value')));
        $this->set(compact('allocation_reason'));

        $activity_levels = $this->LookupValueActivityLevel->find('list', array('fields' => 'id,value', 'conditions' => array('id' => array('6')), 'order' => 'id ASC'));
        $this->set('activity_levels', $activity_levels);

        $agents = $this->Agent->find('list', array('fields' => array('Agent.id', 'Agent.agent_name'), 'conditions' => array('Agent.agent_status' => '1', 'Agent.dummy_status' => $dummy_status)));
        $this->set(compact('agents'));

        $activity_types = $this->LookupValueActivityType->find('list', array('fields' => 'id,value', 'conditions' => array('id' => array('4', '10')), 'order' => 'id ASC'));
        $this->set(compact('activity_types'));

        $activity_deatils = $this->LookupValueActivityDetail->find('list', array('fields' => 'id,value', 'conditions' => array('type_id' => array('6', '0')), 'order' => 'id ASC'));
        $this->set(compact('activity_deatils'));

        /*
          $attendes = $this->User->find('all', array('fields' => array('User.id', 'User.fname', 'User.lname'),
          'conditions' => array('User.exu_channel_id' => $channel_id)));

          $attendes = Set::combine($attendes, '{n}.User.id', array('%s %s', '{n}.User.fname', '{n}.User.lname'));
          $this->set(compact('attendes'));
         * 
         */

        $this->request->data = $Agents;
    }

}

