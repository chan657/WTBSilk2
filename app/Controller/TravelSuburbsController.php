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
class TravelSuburbsController extends AppController {

    var $uses = array('TravelSuburb','User','TravelWtbError','Common', 'TravelCity', 'TravelCountry', 'LookupValueStatus', 'TravelLookupContinent', 'LogCall','Province');

    public function index() {

        $dummy_status = $this->Auth->user('dummy_status');
        $condition_dummy_status = array('dummy_status' => $dummy_status);
        $search_condition = array();
        $TravelCities = array();
        $TravelCountries = ARRAY();
        $name = '';
        $city_id = '';
        $country_id = '';
        $continent_id = '';
        $top_neighborhood = '';
        $active = '';
        $status = '';

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['TravelSuburb']['name'])) {
                $name = $this->data['TravelSuburb']['name'];
                array_push($search_condition, array("TravelSuburb.name LIKE '%$name%'"));
            }
            if (!empty($this->data['TravelSuburb']['continent_id'])) {
                $continent_id = $this->data['TravelSuburb']['continent_id'];
                $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $continent_id, 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
                array_push($search_condition, array('TravelSuburb.continent_id' => $continent_id));
            }

            if (!empty($this->data['TravelSuburb']['country_id'])) {
                $country_id = $this->data['TravelSuburb']['country_id'];
                array_push($search_condition, array('TravelSuburb.country_id' => $country_id));
                $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $country_id, 'city_status' => 1, 'active' => 'TRUE'), 'order' => 'city_name ASC'));
            }

            if (!empty($this->data['TravelSuburb']['city_id'])) {
                $city_id = $this->data['TravelSuburb']['city_id'];
                array_push($search_condition, array('TravelSuburb.city_id' => $city_id));
            }
            if (!empty($this->data['TravelSuburb']['top_neighborhood'])) {
                $top_neighborhood = $this->data['TravelSuburb']['top_neighborhood'];
                array_push($search_condition, array('TravelSuburb.top_neighborhood' => $top_neighborhood));
            }
            if (!empty($this->data['TravelSuburb']['active'])) {
                $active = $this->data['TravelSuburb']['active'];
                array_push($search_condition, array('TravelSuburb.active' => $active));
            }
            if (!empty($this->data['TravelSuburb']['status'])) {
                $status = $this->data['TravelSuburb']['status'];
                array_push($search_condition, array('TravelSuburb.status' => $status));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['name'])) {
                $name = $this->request->params['named']['name'];
                array_push($search_condition, array("TravelSuburb.name LIKE '%$name%'"));
            }
            if (!empty($this->request->params['named']['continent_id'])) {
                $continent_id = $this->request->params['named']['continent_id'];
                $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $continent_id, 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
                array_push($search_condition, array('TravelSuburb.continent_id' => $continent_id));
            }

            if (!empty($this->request->params['named']['country_id'])) {
                $country_id = $this->request->params['named']['country_id'];
                array_push($search_condition, array('TravelSuburb.country_id' => $country_id));
                $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $country_id, 'city_status' => 0), 'order' => 'city_name ASC'));
            }

            if (!empty($this->request->params['named']['city_id'])) {
                $city_id = $this->request->params['named']['city_id'];
                array_push($search_condition, array('TravelSuburb.city_id' => $city_id));
            }
            if (!empty($this->request->params['TravelSuburb']['top_neighborhood'])) {
                $top_neighborhood = $this->request->params['TravelSuburb']['top_neighborhood'];
                array_push($search_condition, array('TravelSuburb.top_neighborhood' => $top_neighborhood));
            }
            if (!empty($this->request->params['TravelSuburb']['active'])) {
                $active = $this->request->params['TravelSuburb']['active'];
                array_push($search_condition, array('TravelSuburb.active' => $active));
            }
            if (!empty($this->request->params['TravelSuburb']['status'])) {
                $status = $this->request->params['TravelSuburb']['status'];
                array_push($search_condition, array('TravelSuburb.status' => $status));
            }
        }


        $this->paginate['order'] = array('TravelSuburb.name' => 'asc');
        $this->set('TravelSuburbs', $this->paginate("TravelSuburb", $search_condition));


        if (!isset($this->passedArgs['name']) && empty($this->passedArgs['name'])) {
            $this->passedArgs['name'] = (isset($this->data['TravelSuburb']['name'])) ? $this->data['TravelSuburb']['name'] : '';
        }
        if (!isset($this->passedArgs['continent_id']) && empty($this->passedArgs['continent_id'])) {
            $this->passedArgs['continent_id'] = (isset($this->data['TravelSuburb']['continent_id'])) ? $this->data['TravelSuburb']['continent_id'] : '';
        }
        if (!isset($this->passedArgs['country_id']) && empty($this->passedArgs['country_id'])) {
            $this->passedArgs['country_id'] = (isset($this->data['TravelSuburb']['country_id'])) ? $this->data['TravelSuburb']['country_id'] : '';
        }
        if (!isset($this->passedArgs['city_id']) && empty($this->passedArgs['city_id'])) {
            $this->passedArgs['city_id'] = (isset($this->data['TravelSuburb']['city_id'])) ? $this->data['TravelSuburb']['city_id'] : '';
        }
        if (!isset($this->passedArgs['top_neighborhood']) && empty($this->passedArgs['top_neighborhood'])) {
            $this->passedArgs['top_neighborhood'] = (isset($this->data['TravelSuburb']['top_neighborhood'])) ? $this->data['TravelSuburb']['top_neighborhood'] : '';
        }
        if (!isset($this->passedArgs['active']) && empty($this->passedArgs['active'])) {
            $this->passedArgs['active'] = (isset($this->data['TravelSuburb']['active'])) ? $this->data['TravelSuburb']['active'] : '';
        }
        if (!isset($this->passedArgs['status']) && empty($this->passedArgs['status'])) {
            $this->passedArgs['status'] = (isset($this->data['TravelSuburb']['status'])) ? $this->data['TravelSuburb']['status'] : '';
        }
        if (!isset($this->data) && empty($this->data)) {

            $this->data['TravelSuburb']['name'] = $this->passedArgs['name'];
            $this->data['TravelSuburb']['continent_id'] = $this->passedArgs['continent_id'];
            $this->data['TravelSuburb']['country_id'] = $this->passedArgs['country_id'];
            $this->data['TravelSuburb']['active'] = $this->passedArgs['active'];
            $this->data['TravelSuburb']['city_id'] = $this->passedArgs['city_id'];
            $this->data['TravelSuburb']['top_neighborhood'] = $this->passedArgs['top_neighborhood'];
            $this->data['TravelSuburb']['status'] = $this->passedArgs['status'];
        }


        $this->set(compact('TravelCountries'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));

        $this->set(compact('TravelCities'));

        $this->set(compact('city_id'));
        $this->set(compact('continent_id'));
        $this->set(compact('country_id'));
        $this->set(compact('name'));
        $this->set(compact('active'));
        $this->set(compact('top_neighborhood'));
        $this->set(compact('status'));
    }

    public function add() {

        $is_service = '';        
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if ($this->IsService() == 'true'){
           $is_service = "All services running normally.";
        }   else {
           $is_service = "Some services are offline. Please try later.";
        } 
        
        if ($this->request->is('post')) {

            $this->request->data['TravelSuburb']['created_by'] = $user_id;
            $this->request->data['TravelSuburb']['active'] = 'TRUE';
            $this->request->data['TravelSuburb']['status'] = '1';
            $this->request->data['TravelSuburb']['wtb_status'] = '1';

            $this->TravelSuburb->create();
            if ($this->TravelSuburb->save($this->request->data)) {
                $SuburbId = $this->TravelSuburb->getLastInsertId();
                $SuburbName = $this->data['TravelSuburb']['name'];
                $CityId = $this->data['TravelSuburb']['city_id'];
                $CityName = $this->data['TravelSuburb']['city_name'];
                $CountryId = $this->data['TravelSuburb']['country_id'];
                $CountryName = $this->data['TravelSuburb']['country_name'];
                $ContinentId = $this->data['TravelSuburb']['continent_id'];
                $ContinentName = $this->data['TravelSuburb']['continent_name'];
                $SuburbDescription = $this->data['TravelSuburb']['description'];
                $ProvinceId = $this->data['TravelSuburb']['province_id'];
                $ProvinceName = $this->data['TravelSuburb']['province_name'];
                $Active = 'true';
                $TopNeighborhood = strtolower($this->data['TravelSuburb']['top_neighborhood']);
                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Suburb</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="AddNew">
                                                                <SuburbId>' . $SuburbId . '</SuburbId>
                                                                <SuburbCode>NA</SuburbCode>
                                                                <SuburbName>' . $SuburbName . '</SuburbName>
                                                                <CityId>' . $CityId . '</CityId>
                                                                <CityCode>NA</CityCode>
                                                                <CityName>' . $CityName . '</CityName>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode>NA</CountryCode>
                                                                <CountryName>' . $CountryName . '</CountryName>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName>'.$ProvinceName.'</ProvinceName>
                                                                <SuburbDescription>' . $SuburbDescription . '</SuburbDescription>
                                                                <SuburbKeyword>NA</SuburbKeyword>
                                                                <Active>' . $Active . '</Active>
                                                                <TopNeighborhood>' . $TopNeighborhood . '</TopNeighborhood>
                                                                <SuburbStatus>true</SuburbStatus>
                                                                <WtbStatus>true</WtbStatus>
                                                                <ApprovedBy>0</ApprovedBy>
                                                                <ApprovedDate>1111-01-01T00:00:00</ApprovedDate>
                                                                <CreatedBy>' . $user_id . '</CreatedBy>
                                                                <CreatedDate>' . $CreatedDate . '</CreatedDate>                                 

                                                            </ResourceDetailsData>                        
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                $log_call_screen = 'Suburb - Add';

                $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                $client = new SoapClient(null, array(
                    'location' => $location_URL,
                    'uri' => '',
                    'trace' => 1,
                ));

                try {
                    $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                    $xml_arr = $this->xml2array($order_return);

                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                        $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
                        $this->TravelSuburb->updateAll(array('TravelSuburb.wtb_status' => "'1'", 'TravelSuburb.is_update' => "'Y'"), array('TravelSuburb.id' => $SuburbId));
                    } else {

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                        $this->TravelSuburb->updateAll(array('TravelSuburb.wtb_status' => "'2'"), array('TravelSuburb.id' => $SuburbId));
                        $xml_error = 'TRUE';
                    }
                } catch (SoapFault $exception) {
                    var_dump(get_class($exception));
                    var_dump($exception);
                }


                $this->request->data['LogCall']['log_call_nature'] = 'Production';
                $this->request->data['LogCall']['log_call_type'] = 'Outbound';
                $this->request->data['LogCall']['log_call_parms'] = trim($xml_string);
                $this->request->data['LogCall']['log_call_status_code'] = $log_call_status_code;
                $this->request->data['LogCall']['log_call_status_message'] = $log_call_status_message;
                $this->request->data['LogCall']['log_call_screen'] = $log_call_screen;
                $this->request->data['LogCall']['log_call_counterparty'] = 'WTBNETWORKS';
                $this->request->data['LogCall']['log_call_by'] = $user_id;
                $this->LogCall->save($this->request->data['LogCall']);
                $message = 'Local record has been successfully created.<br />' . $xml_msg;
                $this->Session->setFlash($message, 'success');
                $a = date('m/d/Y H:i:s', strtotime('-1 hour'));
                $date = new DateTime($a, new DateTimeZone('Asia/Calcutta'));
                if ($xml_error == 'TRUE') {
                    $Email = new CakeEmail();

                    $Email->viewVars(array(
                        'request_xml' => trim($xml_string),
                        'respon_message' => $log_call_status_message,
                        'respon_code' => $log_call_status_code,
                    ));

                    $to = 'biswajit@wtbglobal.com';
                    $cc = 'infra@sumanus.com';

                    $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
                }
                $this->redirect(array('action' => 'add'));
            } else {
                $this->Session->setFlash('Unable to add Suburb.', 'failure');
            }
        }



        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id, country_name', 'order' => 'country_name ASC'));
        //$TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
        $this->set(compact('TravelCountries'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));
        
        $this->set(compact('is_service'));
        
    }

    public function edit($id = null, $mode = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $dummy_status = $this->Auth->user('dummy_status');
        $id = base64_decode($id);
        $xml_error = 'FALSE';
        $this->set(compact('mode'));
        if (!$id) {
            throw new NotFoundException(__('Invalid Suburb'));
        }

        $TravelSuburbs = $this->TravelSuburb->findById($id);

        if (!$TravelSuburbs) {
            throw new NotFoundException(__('Invalid suburb'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            //    $this->TravelSuburb->set($this->data);
            if ($this->TravelSuburb->validates() == true) {

                $this->TravelSuburb->id = $id;
                if ($this->TravelSuburb->save($this->request->data)) {
                    $SuburbId = $id;
                    $SuburbName = $this->data['TravelSuburb']['name'];
                    $CityId = $this->data['TravelSuburb']['city_id'];
                    $CityName = $this->data['TravelSuburb']['city_name'];
                    $CountryId = $this->data['TravelSuburb']['country_id'];
                    $CountryName = $this->data['TravelSuburb']['country_name'];
                    $ContinentId = $this->data['TravelSuburb']['continent_id'];
                    $ContinentName = $this->data['TravelSuburb']['continent_name'];
                    $SuburbDescription = $this->data['TravelSuburb']['description'];
                    $Active = strtolower($TravelSuburbs['TravelSuburb']['active']);
                    $TopNeighborhood = strtolower($this->data['TravelSuburb']['top_neighborhood']);
                    $SuburbStatus = $TravelSuburbs['TravelSuburb']['status'];
                    $ProvinceId = $this->data['TravelSuburb']['province_id'];
                    $ProvinceName = $this->data['TravelSuburb']['province_name'];
                    if ($SuburbStatus)
                        $SuburbStatus = 'true';
                    else
                        $SuburbStatus = 'false';

                    $WtbStatus = $TravelSuburbs['TravelSuburb']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
                    
                    $is_update = $TravelSuburbs['TravelSuburb']['is_update'];
            
                    if ($is_update == 'Y')
                        $actiontype = 'Update';
                    else
                        $actiontype = 'AddNew';

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Suburb</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="'.$actiontype.'">
                                                                <SuburbId>' . $SuburbId . '</SuburbId>
                                                                <SuburbCode>NA</SuburbCode>
                                                                <SuburbName>' . $SuburbName . '</SuburbName>
                                                                <CityId>' . $CityId . '</CityId>
                                                                <CityCode>NA</CityCode>
                                                                <CityName>' . $CityName . '</CityName>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode>NA</CountryCode>
                                                                <CountryName>' . $CountryName . '</CountryName>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName>'.$ProvinceName.'</ProvinceName>
                                                                <SuburbDescription>' . $SuburbDescription . '</SuburbDescription>
                                                                <SuburbKeyword>NA</SuburbKeyword>
                                                                <Active>' . $Active . '</Active>
                                                                <TopNeighborhood>' . $TopNeighborhood . '</TopNeighborhood>
                                                                <SuburbStatus>' . $SuburbStatus . '</SuburbStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <ApprovedBy>0</ApprovedBy>
                                                                <ApprovedDate>1111-01-01T00:00:00</ApprovedDate>
                                                                <CreatedBy>' . $user_id . '</CreatedBy>
                                                                <CreatedDate>' . $CreatedDate . '</CreatedDate>                                 

                                                            </ResourceDetailsData>                        
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                    $log_call_screen = 'Suburb - Edit';

                    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                    $client = new SoapClient(null, array(
                        'location' => $location_URL,
                        'uri' => '',
                        'trace' => 1,
                    ));

                    try {
                        $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                        $xml_arr = $this->xml2array($order_return);

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelSuburb->updateAll(array('TravelSuburb.wtb_status' => "'1'"), array('TravelSuburb.id' => $SuburbId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updated [Code:$log_call_status_code]";
                            $this->TravelSuburb->updateAll(array('TravelSuburb.wtb_status' => "'2'"), array('TravelSuburb.id' => $SuburbId));
                            $xml_error = 'TRUE';
                        }
                    } catch (SoapFault $exception) {
                        var_dump(get_class($exception));
                        var_dump($exception);
                    }


                    $this->request->data['LogCall']['log_call_nature'] = 'Production';
                    $this->request->data['LogCall']['log_call_type'] = 'Outbound';
                    $this->request->data['LogCall']['log_call_parms'] = trim($xml_string);
                    $this->request->data['LogCall']['log_call_status_code'] = $log_call_status_code;
                    $this->request->data['LogCall']['log_call_status_message'] = $log_call_status_message;
                    $this->request->data['LogCall']['log_call_screen'] = $log_call_screen;
                    $this->request->data['LogCall']['log_call_counterparty'] = 'WTBNETWORKS';
                    $this->request->data['LogCall']['log_call_by'] = $user_id;
                    $this->LogCall->save($this->request->data['LogCall']);
                    $log_id = $this->LogCall->getLastInsertId();
                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $a = date('m/d/Y H:i:s', strtotime('-1 hour'));
                    $date = new DateTime($a, new DateTimeZone('Asia/Calcutta'));
                    if ($xml_error == 'TRUE') {
                        $Email = new CakeEmail();

                        $Email->viewVars(array(
                            'request_xml' => trim($xml_string),
                            'respon_message' => $log_call_status_message,
                            'respon_code' => $log_call_status_code,
                        ));

                        $to = 'biswajit@wtbglobal.com';
                        $cc = 'infra@sumanus.com';

                        $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
                        
                        /*
                         * WTB Error Information
                         */
                        $this->request->data['TravelWtbError']['error_topic'] = '12';
                        $this->request->data['TravelWtbError']['error_by'] = $user_id;
                        $this->request->data['TravelWtbError']['error_time'] = $this->Common->GetIndiaTime();                        
                        $this->request->data['TravelWtbError']['log_id'] = $log_id;
                        $this->request->data['TravelWtbError']['error_entity'] = $SuburbId;
                        $this->request->data['TravelWtbError']['error_type'] = '5'; // suburb
                        $this->request->data['TravelWtbError']['error_status'] = '1';    
                        $this->TravelWtbError->create();
                        $this->TravelWtbError->save($this->request->data['TravelWtbError']);
                    }
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Suburb.', 'failure');
                }
            }
        }


        $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $TravelSuburbs['TravelSuburb']['country_id'], 'city_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'city_name ASC'));
        //  $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
        $this->set(compact('TravelCities'));

        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $TravelSuburbs['TravelSuburb']['continent_id'], 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
        // $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
        $this->set(compact('TravelCountries'));
        
        $Provinces = $this->Province->find('list', array(
                'conditions' => array(
                    'Province.continent_id' => $TravelSuburbs['TravelSuburb']['continent_id'],
                    'Province.country_id' => $TravelSuburbs['TravelSuburb']['country_id'],
                    'Province.status' => '1',
                    'Province.wtb_status' => '1',
                    'Province.active' => 'TRUE'
                ),
                'fields' => array('Province.id', 'Province.name'),
                'order' => 'Province.name ASC'
            ));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents','Provinces'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));

        $this->request->data = $TravelSuburbs;
    }

    public function de_active($id = null, $type = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');

        if ($type == 'TRUE') {
            $type = 'FALSE';
            $ACTIVE_MSG = 'Active';
        } else {
            $type = 'TRUE';
            $ACTIVE_MSG = 'Inactive';
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid Suburb'));
        }

        $TravelSuburbs = $this->TravelSuburb->findById($id);

        if (!$TravelSuburbs) {
            throw new NotFoundException(__('Invalid suburb'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            //    $this->TravelSuburb->set($this->data);
            if ($this->TravelSuburb->validates() == true) {


                if ($this->TravelSuburb->updateAll(array('TravelSuburb.active' => '"' . $this->data['TravelSuburb']['active'] . '"'), array('TravelSuburb.id' => $id))) {


                    $SuburbId = $id;
                    $SuburbName = $TravelSuburbs['TravelSuburb']['name'];
                    $CityId = $TravelSuburbs['TravelSuburb']['city_id'];
                    $CityName = $TravelSuburbs['TravelSuburb']['city_name'];
                    $CountryId = $TravelSuburbs['TravelSuburb']['country_id'];
                    $CountryName = $TravelSuburbs['TravelSuburb']['country_name'];
                    $ContinentId = $TravelSuburbs['TravelSuburb']['continent_id'];
                    $ContinentName = $TravelSuburbs['TravelSuburb']['continent_name'];
                    $SuburbDescription = $TravelSuburbs['TravelSuburb']['description'];
                    $Active = strtolower($this->data['TravelSuburb']['active']);
                    $ProvinceId = $TravelSuburbs['TravelSuburb']['province_id'];
                    $ProvinceName = $TravelSuburbs['TravelSuburb']['province_name'];
                    $TopNeighborhood = strtolower($TravelSuburbs['TravelSuburb']['top_neighborhood']);
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Suburb</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <SuburbId>' . $SuburbId . '</SuburbId>
                                                                <SuburbCode>NA</SuburbCode>
                                                                <SuburbName>' . $SuburbName . '</SuburbName>
                                                                <CityId>' . $CityId . '</CityId>
                                                                <CityCode>NA</CityCode>
                                                                <CityName>' . $CityName . '</CityName>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode>NA</CountryCode>
                                                                <CountryName>' . $CountryName . '</CountryName>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName>'.$ProvinceName.'</ProvinceName>
                                                                <SuburbDescription>' . $SuburbDescription . '</SuburbDescription>
                                                                <SuburbKeyword>NA</SuburbKeyword>
                                                                <Active>' . $Active . '</Active>
                                                                <TopNeighborhood>' . $TopNeighborhood . '</TopNeighborhood>
                                                                <SuburbStatus>false</SuburbStatus>
                                                                <WtbStatus>false</WtbStatus>
                                                                <ApprovedBy>0</ApprovedBy>
                                                                <ApprovedDate>1111-01-01T00:00:00</ApprovedDate>
                                                                <CreatedBy>' . $user_id . '</CreatedBy>
                                                                <CreatedDate>' . $CreatedDate . '</CreatedDate>                                 

                                                            </ResourceDetailsData>                        
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                    $log_call_screen = 'Suburb - ' . $ACTIVE_MSG;

                    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                    $client = new SoapClient(null, array(
                        'location' => $location_URL,
                        'uri' => '',
                        'trace' => 1,
                    ));

                    try {
                        $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                        $xml_arr = $this->xml2array($order_return);

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelSuburb->updateAll(array('TravelSuburb.wtb_status' => "'1'"), array('TravelSuburb.id' => $SuburbId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updated [Code:$log_call_status_code]";
                            $this->TravelSuburb->updateAll(array('TravelSuburb.wtb_status' => "'2'"), array('TravelSuburb.id' => $SuburbId));
                        }
                    } catch (SoapFault $exception) {
                        var_dump(get_class($exception));
                        var_dump($exception);
                    }


                    $this->request->data['LogCall']['log_call_nature'] = 'Production';
                    $this->request->data['LogCall']['log_call_type'] = 'Outbound';
                    $this->request->data['LogCall']['log_call_parms'] = trim($xml_string);
                    $this->request->data['LogCall']['log_call_status_code'] = $log_call_status_code;
                    $this->request->data['LogCall']['log_call_status_message'] = $log_call_status_message;
                    $this->request->data['LogCall']['log_call_screen'] = $log_call_screen;
                    $this->request->data['LogCall']['log_call_counterparty'] = 'WTBNETWORKS';
                    $this->request->data['LogCall']['log_call_by'] = $user_id;
                    $this->LogCall->save($this->request->data['LogCall']);
                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Suburb.', 'failure');
                }
            }
        }

        $Types = array($type);

        $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('id' => $TravelSuburbs['TravelSuburb']['city_id']), 'order' => 'city_name ASC'));
        //  $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
        $this->set(compact('TravelCities'));

        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('id' => $TravelSuburbs['TravelSuburb']['country_id']), 'order' => 'country_name ASC'));
        // $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
        $this->set(compact('TravelCountries'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('id' => $TravelSuburbs['TravelSuburb']['continent_id']), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));

        $this->request->data = $TravelSuburbs;
    }

    public function retry($id = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if (!$id) {
            throw new NotFoundException(__('Invalid Suburb'));
        }

        $TravelSuburbs = $this->TravelSuburb->findById($id);

        if (!$TravelSuburbs) {
            throw new NotFoundException(__('Invalid suburb'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {


            $SuburbId = $id;
            $SuburbName = $TravelSuburbs['TravelSuburb']['name'];
            $CityId = $TravelSuburbs['TravelSuburb']['city_id'];
            $CityName = $TravelSuburbs['TravelSuburb']['city_name'];
            $CountryId = $TravelSuburbs['TravelSuburb']['country_id'];
            $CountryName = $TravelSuburbs['TravelSuburb']['country_name'];
            $ContinentId = $TravelSuburbs['TravelSuburb']['continent_id'];
            $ContinentName = $TravelSuburbs['TravelSuburb']['continent_name'];
            $SuburbDescription = $TravelSuburbs['TravelSuburb']['description'];
            $Active = strtolower($TravelSuburbs['TravelSuburb']['active']);
            $TopNeighborhood = strtolower($TravelSuburbs['TravelSuburb']['top_neighborhood']);
            $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
            $ProvinceId = $TravelSuburbs['TravelSuburb']['province_id'];
            $ProvinceName = $TravelSuburbs['TravelSuburb']['province_name'];
            $is_update = $TravelSuburbs['TravelSuburb']['is_update'];
            if ($is_update == 'Y')
                $actiontype = 'Update';
            else
                $actiontype = 'AddNew';

            $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Suburb</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">
                                                                <SuburbId>' . $SuburbId . '</SuburbId>
                                                                <SuburbCode>NA</SuburbCode>
                                                                <SuburbName>' . $SuburbName . '</SuburbName>
                                                                <CityId>' . $CityId . '</CityId>
                                                                <CityCode>NA</CityCode>
                                                                <CityName>' . $CityName . '</CityName>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode>NA</CountryCode>
                                                                <CountryName>' . $CountryName . '</CountryName>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName>'.$ProvinceName.'</ProvinceName>
                                                                <SuburbDescription>' . $SuburbDescription . '</SuburbDescription>
                                                                <SuburbKeyword>NA</SuburbKeyword>
                                                                <Active>' . $Active . '</Active>
                                                                <TopNeighborhood>' . $TopNeighborhood . '</TopNeighborhood>
                                                                <SuburbStatus>false</SuburbStatus>
                                                                <WtbStatus>false</WtbStatus>
                                                                <ApprovedBy>0</ApprovedBy>
                                                                <ApprovedDate>1111-01-01T00:00:00</ApprovedDate>
                                                                <CreatedBy>' . $user_id . '</CreatedBy>
                                                                <CreatedDate>' . $CreatedDate . '</CreatedDate>                                 

                                                            </ResourceDetailsData>                        
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


            $log_call_screen = 'Suburb - Re-try';

            $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
            $client = new SoapClient(null, array(
                'location' => $location_URL,
                'uri' => '',
                'trace' => 1,
            ));

            try {
                $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                $xml_arr = $this->xml2array($order_return);

                if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                    $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                    $this->TravelSuburb->updateAll(array('TravelSuburb.wtb_status' => "'1'", 'TravelSuburb.is_update' => "'Y'"), array('TravelSuburb.id' => $SuburbId));
                } else {

                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUBURB']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                    $xml_msg = "There was a problem with foreign record updated [Code:$log_call_status_code]";
                    $this->TravelSuburb->updateAll(array('TravelSuburb.wtb_status' => "'2'"), array('TravelSuburb.id' => $SuburbId));
                    $xml_error = 'TRUE';
                }
            } catch (SoapFault $exception) {
                var_dump(get_class($exception));
                var_dump($exception);
            }


            $this->request->data['LogCall']['log_call_nature'] = 'Production';
            $this->request->data['LogCall']['log_call_type'] = 'Outbound';
            $this->request->data['LogCall']['log_call_parms'] = trim($xml_string);
            $this->request->data['LogCall']['log_call_status_code'] = $log_call_status_code;
            $this->request->data['LogCall']['log_call_status_message'] = $log_call_status_message;
            $this->request->data['LogCall']['log_call_screen'] = $log_call_screen;
            $this->request->data['LogCall']['log_call_counterparty'] = 'WTBNETWORKS';
            $this->request->data['LogCall']['log_call_by'] = $user_id;
            $this->LogCall->save($this->request->data['LogCall']);
            $a = date('m/d/Y H:i:s', strtotime('-1 hour'));
            $date = new DateTime($a, new DateTimeZone('Asia/Calcutta'));
            if ($xml_error == 'TRUE') {
                $Email = new CakeEmail();

                $Email->viewVars(array(
                    'request_xml' => trim($xml_string),
                    'respon_message' => $log_call_status_message,
                    'respon_code' => $log_call_status_code,
                ));

                $to = 'biswajit@wtbglobal.com';
                $cc = 'infra@sumanus.com';

                $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
            }
            $message = $xml_msg;
            $this->Session->setFlash($message, 'success');
            $this->redirect(array('action' => 'index'));
        }


        $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('id' => $TravelSuburbs['TravelSuburb']['city_id']), 'order' => 'city_name ASC'));
        //  $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
        $this->set(compact('TravelCities'));

        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('id' => $TravelSuburbs['TravelSuburb']['country_id']), 'order' => 'country_name ASC'));
        // $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
        $this->set(compact('TravelCountries'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('id' => $TravelSuburbs['TravelSuburb']['continent_id']), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));

        $this->request->data = $TravelSuburbs;
    }

}

