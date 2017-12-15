<?php

/**
 * TravelLookupContinent controller.
 *
 * This file will render views from views/TravelLookupContinents/
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
 * TravelLookupContinent controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TravelLookupContinentsController extends AppController {

    var $uses = array('TravelLookupContinent', 'LogCall','TravelWtbError','Common');

    public function index() {

        $search_condition = array();
        $TravelCountries = array();
        $continent_name = '';

        $continent_status = '';
        $wtb_status = '';
        $active = '';

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['TravelLookupContinent']['continent_name'])) {
                $continent_name = $this->data['TravelLookupContinent']['continent_name'];
                array_push($search_condition, array("TravelLookupContinent.continent_name LIKE '%$continent_name%'"));
            }

            if (!empty($this->data['TravelLookupContinent']['continent_status'])) {
                $continent_status = $this->data['TravelLookupContinent']['continent_status'];
                array_push($search_condition, array('TravelLookupContinent.continent_status' => $continent_status));
            }
            if (!empty($this->data['TravelLookupContinent']['wtb_status'])) {
                $wtb_status = $this->data['TravelLookupContinent']['wtb_status'];
                array_push($search_condition, array('TravelLookupContinent.wtb_status' => $wtb_status));
            }
            if (!empty($this->data['TravelLookupContinent']['active'])) {
                $active = $this->data['TravelLookupContinent']['active'];
                array_push($search_condition, array('TravelLookupContinent.active' => $active));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['continent_name'])) {
                $continent_name = $this->request->params['named']['continent_name'];
                array_push($search_condition, array("TravelLookupContinent.continent_name LIKE '%$continent_name%'"));
            }


            if (!empty($this->request->params['named']['continent_status'])) {
                $continent_status = $this->request->params['named']['continent_status'];
                array_push($search_condition, array('TravelLookupContinent.continent_status' => $continent_status));
            }
            if (!empty($this->request->params['named']['wtb_status'])) {
                $wtb_status = $this->request->params['named']['wtb_status'];
                array_push($search_condition, array('TravelLookupContinent.wtb_status' => $wtb_status));
            }
            if (!empty($this->request->params['named']['active'])) {
                $active = $this->request->params['named']['active'];
                array_push($search_condition, array('TravelLookupContinent.active' => $active));
            }
        }

        $this->paginate['order'] = array('TravelLookupContinent.continent_name' => 'asc');
        $this->set('TravelLookupContinents', $this->paginate("TravelLookupContinent", $search_condition));
        // $log = $this->TravelLookupContinent->getDataSource()->getLog(false, false);       
        // debug($log);
        // die;

        if (!isset($this->passedArgs['continent_name']) && empty($this->passedArgs['continent_name'])) {
            $this->passedArgs['continent_name'] = (isset($this->data['TravelLookupContinent']['continent_name'])) ? $this->data['TravelLookupContinent']['continent_name'] : '';
        }

        if (!isset($this->passedArgs['continent_status']) && empty($this->passedArgs['continent_status'])) {
            $this->passedArgs['continent_status'] = (isset($this->data['TravelLookupContinent']['continent_status'])) ? $this->data['TravelLookupContinent']['continent_status'] : '';
        }
        if (!isset($this->passedArgs['wtb_status']) && empty($this->passedArgs['wtb_status'])) {
            $this->passedArgs['wtb_status'] = (isset($this->data['TravelLookupContinent']['wtb_status'])) ? $this->data['TravelLookupContinent']['wtb_status'] : '';
        }
        if (!isset($this->passedArgs['active']) && empty($this->passedArgs['active'])) {
            $this->passedArgs['active'] = (isset($this->data['TravelLookupContinent']['active'])) ? $this->data['TravelLookupContinent']['active'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {

            $this->data['TravelLookupContinent']['continent_name'] = $this->passedArgs['continent_name'];
            $this->data['TravelLookupContinent']['continent_status'] = $this->passedArgs['continent_status'];
            $this->data['TravelLookupContinent']['wtb_status'] = $this->passedArgs['wtb_status'];
            $this->data['TravelLookupContinent']['active'] = $this->passedArgs['active'];
        }


        $this->set(compact('continent_name'));
        $this->set(compact('continent_status'));
        $this->set(compact('wtb_status'));
        $this->set(compact('active'));
    }

    public function add() {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if ($this->request->is('post')) {

            $this->request->data['TravelLookupContinent']['continent_status'] = '1';
            $this->request->data['TravelLookupContinent']['wtb_status'] = '1';
            $this->request->data['TravelLookupContinent']['active'] = 'TRUE';

            $this->TravelLookupContinent->create();
            if ($this->TravelLookupContinent->save($this->request->data)) {
                $ContinentId = $this->TravelLookupContinent->getLastInsertId();
                $ContinentCode = $this->data['TravelLookupContinent']['continent_code'];
                $ContinentName = $this->data['TravelLookupContinent']['continent_name'];
                $ContinentStatus = 'true';
                $WtbStatus = 'true';
                $Active = 'true';

                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Continent</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="AddNew">
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>' . $ContinentCode . '</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <ContinentStatus>' . $ContinentStatus . '</ContinentStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                            </ResourceDetailsData>
     
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                $log_call_screen = 'Continent - Add';

                $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');

                $client = new SoapClient(null, array(
                    'location' => $location_URL,
                    'uri' => '',
                    'trace' => 1,
                ));

                try {
                    $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                    $xml_arr = $this->xml2array($order_return);
                    // echo htmlentities($xml_string);
                    //  pr($xml_arr);
                    // die;
                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                        $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
                        $this->TravelLookupContinent->updateAll(array('TravelLookupContinent.wtb_status' => "'1'", 'TravelLookupContinent.is_update' => "'Y'"), array('TravelLookupContinent.id' => $ContinentId));
                    } else {

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                        $this->TravelLookupContinent->updateAll(array('TravelLookupContinent.wtb_status' => "'2'"), array('TravelLookupContinent.id' => $ContinentId));
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
                $a = date('m/d/Y H:i:s', strtotime('-1 hour'));
                $date = new DateTime($a, new DateTimeZone('Asia/Calcutta'));
                $message = 'Local record has been successfully created.<br />' . $xml_msg;
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
                        $this->request->data['TravelWtbError']['error_topic'] = '30';
                        $this->request->data['TravelWtbError']['error_by'] = $user_id;
                        $this->request->data['TravelWtbError']['error_time'] = $this->Common->GetIndiaTime();                        
                        $this->request->data['TravelWtbError']['log_id'] = $log_id;
                        $this->request->data['TravelWtbError']['error_entity'] = $ContinentId;
                        $this->request->data['TravelWtbError']['error_type'] = '1'; // continent
                        $this->request->data['TravelWtbError']['error_status'] = '1';    
                        $this->TravelWtbError->create();
                        $this->TravelWtbError->save($this->request->data['TravelWtbError']);
                }
                $this->Session->setFlash($message, 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add Continent.', 'failure');
            }
        }

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));
    }

    public function edit($id = null, $mode = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $id = base64_decode($id);
        $xml_error = 'FALSE';

        $this->set(compact('mode'));
        if (!$id) {
            throw new NotFoundException(__('Invalid Continent'));
        }

        $TravelCountries = $this->TravelLookupContinent->findById($id);

        if (!$TravelCountries) {
            throw new NotFoundException(__('Invalid Continent'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelLookupContinent->set($this->data);
            if ($this->TravelLookupContinent->validates() == true) {

                $this->TravelLookupContinent->id = $id;
                if ($this->TravelLookupContinent->save($this->request->data)) {
                    $ContinentId = $id;
                    $ContinentCode = $this->data['TravelLookupContinent']['continent_code'];
                    $ContinentName = $this->data['TravelLookupContinent']['continent_name'];
                    $ContinentStatus = $TravelCountries['TravelLookupContinent']['continent_status'];
                    if ($ContinentStatus)
                        $ContinentStatus = 'true';
                    else
                        $ContinentStatus = 'false';

                    $WtbStatus = $TravelCountries['TravelLookupContinent']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';

                    $Active = strtolower($TravelCountries['TravelLookupContinent']['active']);


                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Continent</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>' . $ContinentCode . '</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <ContinentStatus>' . $ContinentStatus . '</ContinentStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                            </ResourceDetailsData>
     
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                    $log_call_screen = 'Continent - Edit';

                    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');

                    $client = new SoapClient(null, array(
                        'location' => $location_URL,
                        'uri' => '',
                        'trace' => 1,
                    ));

                    try {
                        $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                        $xml_arr = $this->xml2array($order_return);
                        // echo htmlentities($xml_string);
                        //  pr($xml_arr);
                        // die;
                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelLookupContinent->updateAll(array('TravelLookupContinent.wtb_status' => "'1'"), array('TravelLookupContinent.id' => $ContinentId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelLookupContinent->updateAll(array('TravelLookupContinent.wtb_status' => "'2'"), array('TravelLookupContinent.id' => $ContinentId));
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
                        $this->request->data['TravelWtbError']['error_topic'] = '31';
                        $this->request->data['TravelWtbError']['error_by'] = $user_id;
                        $this->request->data['TravelWtbError']['error_time'] = $this->Common->GetIndiaTime();                        
                        $this->request->data['TravelWtbError']['log_id'] = $log_id;
                        $this->request->data['TravelWtbError']['error_entity'] = $ContinentId;
                        $this->request->data['TravelWtbError']['error_type'] = '1'; // continent
                        $this->request->data['TravelWtbError']['error_status'] = '1';    
                        $this->TravelWtbError->create();
                        $this->TravelWtbError->save($this->request->data['TravelWtbError']);
                    }
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Continent.', 'failure');
                }
            }
        }
        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));


        $this->request->data = $TravelCountries;
    }

    public function de_active($id = null, $type = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if ($type == 'TRUE') {
            $type = 'FALSE';
            $ACTIVE_MSG = 'Active';
        } else {
            $type = 'TRUE';
            $ACTIVE_MSG = 'Inactive';
        }


        if (!$id) {
            throw new NotFoundException(__('Invalid Continent'));
        }

        $TravelCountries = $this->TravelLookupContinent->findById($id);

        if (!$TravelCountries) {
            throw new NotFoundException(__('Invalid Continent'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelLookupContinent->set($this->data);
            if ($this->TravelLookupContinent->validates() == true) {

                if ($this->TravelLookupContinent->updateAll(array('TravelLookupContinent.active' => '"' . $this->data['TravelLookupContinent']['active'] . '"'), array('TravelLookupContinent.id' => $id))) {
                    //$log = $this->TravelLookupContinent->getDataSource()->getLog(false, false);       
                    //debug($log);
                    // die;
                    $ContinentId = $id;
                    $ContinentCode = $TravelCountries['TravelLookupContinent']['continent_code'];
                    $ContinentName = $TravelCountries['TravelLookupContinent']['continent_name'];
                    $ContinentStatus = $TravelCountries['TravelLookupContinent']['continent_status'];
                    if ($ContinentStatus)
                        $ContinentStatus = 'true';
                    else
                        $ContinentStatus = 'false';

                    $WtbStatus = $TravelCountries['TravelLookupContinent']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';

                    $Active = strtolower($this->data['TravelLookupContinent']['active']);


                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Continent</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>' . $ContinentCode . '</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <ContinentStatus>' . $ContinentStatus . '</ContinentStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                            </ResourceDetailsData>
     
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                    $log_call_screen = 'Continent - ' . $ACTIVE_MSG;

                    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');

                    $client = new SoapClient(null, array(
                        'location' => $location_URL,
                        'uri' => '',
                        'trace' => 1,
                    ));

                    try {
                        $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                        $xml_arr = $this->xml2array($order_return);
                        // echo htmlentities($xml_string);
                        //  pr($xml_arr);
                        // die;
                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelLookupContinent->updateAll(array('TravelLookupContinent.wtb_status' => "'1'"), array('TravelLookupContinent.id' => $ContinentId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelLookupContinent->updateAll(array('TravelLookupContinent.wtb_status' => "'2'"), array('TravelLookupContinent.id' => $ContinentId));
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
                    }
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Continent.', 'failure');
                }
            }
        }


        $Types = array($type);

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents', 'Types'));

        $this->request->data = $TravelCountries;
    }

    public function retry($id = null,$wtb_error_id = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if (!$id) {
            throw new NotFoundException(__('Invalid Continent'));
        }

        $TravelCountries = $this->TravelLookupContinent->findById($id);

        if (!$TravelCountries) {
            throw new NotFoundException(__('Invalid Continent'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            $ContinentId = $id;
            $ContinentCode = $TravelCountries['TravelLookupContinent']['continent_code'];
            $ContinentName = $TravelCountries['TravelLookupContinent']['continent_name'];
            $ContinentStatus = $TravelCountries['TravelLookupContinent']['continent_status'];
            if ($ContinentStatus)
                $ContinentStatus = 'true';
            else
                $ContinentStatus = 'false';

            $WtbStatus = $TravelCountries['TravelLookupContinent']['wtb_status'];
            if ($WtbStatus)
                $WtbStatus = 'true';
            else
                $WtbStatus = 'false';

            $Active = strtolower($TravelCountries['TravelLookupContinent']['active']);


            $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
            $is_update = $TravelCountries['TravelLookupContinent']['is_updated'];
            if ($is_update == 'Y')
                $actiontype = 'Update';
            else
                $actiontype = 'AddNew';

            $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Continent</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>' . $ContinentCode . '</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <ContinentStatus>' . $ContinentStatus . '</ContinentStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                            </ResourceDetailsData>
     
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


            $log_call_screen = 'Continent - Re-try';

            $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');

            $client = new SoapClient(null, array(
                'location' => $location_URL,
                'uri' => '',
                'trace' => 1,
            ));

            try {
                $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                $xml_arr = $this->xml2array($order_return);
                // echo htmlentities($xml_string);
                //  pr($xml_arr);
                // die;
                if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                    $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                    $this->TravelLookupContinent->updateAll(array('TravelLookupContinent.wtb_status' => "'1'", 'TravelLookupContinent.is_update' => "'Y'"), array('TravelLookupContinent.id' => $ContinentId));
                    if($wtb_error_id)
                        $this->TravelWtbError->updateAll(array('TravelWtbError.fixed_by' => "'".$user_id."'", 'TravelWtbError.fixed_time' => "'".$this->Common->GetIndiaTime()."'"), array('TravelWtbError.id' => $wtb_error_id));
                } else {

                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CONTINENT']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                    $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                    $this->TravelLookupContinent->updateAll(array('TravelLookupContinent.wtb_status' => "'2'"), array('TravelLookupContinent.id' => $ContinentId));
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
            $message = $xml_msg;
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
            $this->Session->setFlash($message, 'success');
            $this->redirect(array('action' => 'index'));
        }

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));

        $this->request->data = $TravelCountries;
    }


}