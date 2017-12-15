<?php

/**
 * TravelCountry controller.
 *
 * This file will render views from views/TravelCountries/
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
 * TravelCountry controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TravelCountriesController extends AppController {

    var $uses = array('TravelCountry', 'TravelLookupContinent', 'LogCall', 'TravelCountrySupplier', 'User');

    public function index() {

        $search_condition = array();
        $TravelCountries = array();
        $country_name = '';
        $continent_id = '';
        $country_status = '';
        $wtb_status = '';
        $active = '';

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['TravelCountry']['country_name'])) {
                $country_name = $this->data['TravelCountry']['country_name'];
                array_push($search_condition, array("TravelCountry.country_name LIKE '%$country_name%'"));
            }
            if (!empty($this->data['TravelCountry']['continent_id'])) {
                $continent_id = $this->data['TravelCountry']['continent_id'];
                array_push($search_condition, array('TravelCountry.continent_id' => $continent_id));
            }

            if (!empty($this->data['TravelCountry']['country_id'])) {
                $country_id = $this->data['TravelCountry']['country_id'];
                array_push($search_condition, array('TravelCountry.country_id' => $country_id));
            }
            if (!empty($this->data['TravelCountry']['country_status'])) {
                $country_status = $this->data['TravelCountry']['country_status'];
                array_push($search_condition, array('TravelCountry.country_status' => $country_status));
            }
            if (!empty($this->data['TravelCountry']['wtb_status'])) {
                $wtb_status = $this->data['TravelCountry']['wtb_status'];
                array_push($search_condition, array('TravelCountry.wtb_status' => $wtb_status));
            }
            if (!empty($this->data['TravelCountry']['active'])) {
                $active = $this->data['TravelCountry']['active'];
                array_push($search_condition, array('TravelCountry.active' => $active));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['country_name'])) {
                $country_name = $this->request->params['named']['country_name'];
                array_push($search_condition, array("TravelCountry.country_name LIKE '%$country_name%'"));
            }
            if (!empty($this->request->params['named']['continent_id'])) {
                $continent_id = $this->request->params['named']['continent_id'];
                array_push($search_condition, array('TravelCountry.continent_id' => $continent_id));
            }

            if (!empty($this->request->params['named']['country_status'])) {
                $country_status = $this->request->params['named']['country_status'];
                array_push($search_condition, array('TravelCountry.country_status' => $country_status));
            }
            if (!empty($this->request->params['named']['wtb_status'])) {
                $wtb_status = $this->request->params['named']['wtb_status'];
                array_push($search_condition, array('TravelCountry.wtb_status' => $wtb_status));
            }
            if (!empty($this->request->params['named']['active'])) {
                $active = $this->request->params['named']['active'];
                array_push($search_condition, array('TravelCountry.active' => $active));
            }
        }

        $this->paginate['order'] = array('TravelCountry.country_name' => 'asc');
        $this->set('TravelCountries', $this->paginate("TravelCountry", $search_condition));
        //$log = $this->TravelCountry->getDataSource()->getLog(false, false);       
        //debug($log);
        // die;

        if (!isset($this->passedArgs['country_name']) && empty($this->passedArgs['country_name'])) {
            $this->passedArgs['country_name'] = (isset($this->data['TravelCountry']['country_name'])) ? $this->data['TravelCountry']['country_name'] : '';
        }
        if (!isset($this->passedArgs['continent_id']) && empty($this->passedArgs['continent_id'])) {
            $this->passedArgs['continent_id'] = (isset($this->data['TravelCountry']['continent_id'])) ? $this->data['TravelCountry']['continent_id'] : '';
        }
        if (!isset($this->passedArgs['country_id']) && empty($this->passedArgs['country_id'])) {
            $this->passedArgs['country_id'] = (isset($this->data['TravelCountry']['country_id'])) ? $this->data['TravelCountry']['country_id'] : '';
        }
        if (!isset($this->passedArgs['country_status']) && empty($this->passedArgs['country_status'])) {
            $this->passedArgs['country_status'] = (isset($this->data['TravelCountry']['country_status'])) ? $this->data['TravelCountry']['country_status'] : '';
        }
        if (!isset($this->passedArgs['wtb_status']) && empty($this->passedArgs['wtb_status'])) {
            $this->passedArgs['wtb_status'] = (isset($this->data['TravelCountry']['wtb_status'])) ? $this->data['TravelCountry']['wtb_status'] : '';
        }
        if (!isset($this->passedArgs['active']) && empty($this->passedArgs['active'])) {
            $this->passedArgs['active'] = (isset($this->data['TravelCountry']['active'])) ? $this->data['TravelCountry']['active'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {

            $this->data['TravelCountry']['country_name'] = $this->passedArgs['country_name'];
            $this->data['TravelCountry']['continent_id'] = $this->passedArgs['continent_id'];
            $this->data['TravelCountry']['country_id'] = $this->passedArgs['country_id'];
            $this->data['TravelCountry']['country_status'] = $this->passedArgs['country_status'];
            $this->data['TravelCountry']['wtb_status'] = $this->passedArgs['wtb_status'];
            $this->data['TravelCountry']['active'] = $this->passedArgs['active'];
        }



        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));

        $this->set(compact('country_name'));
        $this->set(compact('country_id'));
        $this->set(compact('continent_id'));
        $this->set(compact('country_status'));
        $this->set(compact('wtb_status'));
        $this->set(compact('active'));
    }

    public function add() {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if ($this->request->is('post')) {

            $this->request->data['TravelCountry']['created_by'] = $user_id;
            $this->request->data['TravelCountry']['active'] = 'TRUE';
            $this->request->data['TravelCountry']['country_status'] = '1';
            $this->request->data['TravelCountry']['wtb_status'] = '1';
            $this->TravelCountry->create();
            if ($this->TravelCountry->save($this->request->data)) {
                $CountryId = $this->TravelCountry->getLastInsertId();
                $CountryName = $this->data['TravelCountry']['country_name'];
                $CountryCode = $this->data['TravelCountry']['country_code'];
                $ContinentId = $this->data['TravelCountry']['continent_id'];
                $ContinentName = $this->data['TravelCountry']['continent_name'];
                $CountryComment = $this->data['TravelCountry']['country_comment'];
                $Active = 'true';
                $CountryStatus = 'true';
                $WtbStatus = 'true';
                $TopCountry = strtolower($this->data['TravelCountry']['top_country']);
                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Country</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="AddNew">
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode>' . $CountryCode . '</CountryCode>
                                                                <CountryName>' . $CountryName . '</CountryName>
                                                                <CountryNameJP></CountryNameJP>
                                                                <CountryNameFR></CountryNameFR>
                                                                <CountryNameCN></CountryNameCN>
                                                                <CountryNameCNT></CountryNameCNT>
                                                                <CountryNameDE></CountryNameDE>
                                                                <CountryNameIT></CountryNameIT>
                                                                <CountryNameES></CountryNameES>
                                                                <CountryNameKR></CountryNameKR>
                                                                <CountryNameTEMP1></CountryNameTEMP1>
                                                                <CountryNameTEMP2></CountryNameTEMP2>
                                                                <CountryNameTEMP3></CountryNameTEMP3>
                                                                <CountryPhone></CountryPhone>
                                                                <RegionId></RegionId>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <CountryStatus>' . $CountryStatus . '</CountryStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                                <IsUpdate>false</IsUpdate>
                                                                <PFTActive>0</PFTActive>
                                                                <SSActive>false</SSActive>
                                                                <ActiveMap>false</ActiveMap>
                                                                <ActiveGuide>false</ActiveGuide>
                                                                <CountryComment>' . $CountryComment . '</CountryComment>
                                                                <CountryDescription></CountryDescription>
                                                                <Tax>0</Tax>
                                                                <Service>0</Service>
                                                                <CountryNameURL></CountryNameURL>
                                                                <CountryURLTEMP1></CountryURLTEMP1>
                                                                <CountryURLTEMP2></CountryURLTEMP2>
                                                                <CountryURLTEMP3></CountryURLTEMP3>
                                                                <Priority>0</Priority>
                                                                <TopDestination>false</TopDestination>
                                                                <IsUpdated>0</IsUpdated>
                                                                <CapitalCity></CapitalCity>
                                                                <TopCountry>false</TopCountry>
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


                $log_call_screen = 'Country - Add';

                $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                $client = new SoapClient(null, array(
                    'location' => $location_URL,
                    'uri' => '',
                    'trace' => 1,
                ));

                try {
                    $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                    $xml_arr = $this->xml2array($order_return);
                    //echo htmlentities($xml_string);
                    //pr($xml_arr);
                    //die;

                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                        $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
                        $this->TravelCountry->updateAll(array('TravelCountry.wtb_status' => "'1'", 'TravelCountry.is_update' => "'Y'"), array('TravelCountry.id' => $CountryId));
                    } else {

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                        $this->TravelCountry->updateAll(array('TravelCountry.wtb_status' => "'2'"), array('TravelCountry.id' => $CountryId));
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
                $a =  date('m/d/Y H:i:s', strtotime('-1 hour'));
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
                $this->Session->setFlash('Unable to add Country.', 'failure');
            }
        }

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));
    }

    public function edit($id = null, $mode = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';
        $id = base64_decode($id);

        $this->set(compact('mode'));
        if (!$id) {
            throw new NotFoundException(__('Invalid Country'));
        }

        $TravelCountries = $this->TravelCountry->findById($id);

        if (!$TravelCountries) {
            throw new NotFoundException(__('Invalid Country'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelCountry->set($this->data);
            if ($this->TravelCountry->validates() == true) {

                $this->TravelCountry->id = $id;
                if ($this->TravelCountry->save($this->request->data)) {
                    $CountryId = $id;
                    $CountryName = $this->data['TravelCountry']['country_name'];
                    $CountryCode = $this->data['TravelCountry']['country_code'];
                    $ContinentId = $this->data['TravelCountry']['continent_id'];
                    $ContinentName = $this->data['TravelCountry']['continent_name'];
                    $CountryComment = $this->data['TravelCountry']['country_comment'];
                    $Active = strtolower($TravelCountries['TravelCountry']['active']);

                    $CountryStatus = $TravelCountries['TravelCountry']['country_status'];
                    if ($CountryStatus)
                        $CountryStatus = 'true';
                    else
                        $CountryStatus = 'false';

                    $WtbStatus = $TravelCountries['TravelCountry']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';
                    $TopCountry = strtolower($this->data['TravelCountry']['top_country']);
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Country</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode>' . $CountryCode . '</CountryCode>
                                                                <CountryName>' . $CountryName . '</CountryName>
                                                                <CountryNameJP></CountryNameJP>
                                                                <CountryNameFR></CountryNameFR>
                                                                <CountryNameCN></CountryNameCN>
                                                                <CountryNameCNT></CountryNameCNT>
                                                                <CountryNameDE></CountryNameDE>
                                                                <CountryNameIT></CountryNameIT>
                                                                <CountryNameES></CountryNameES>
                                                                <CountryNameKR></CountryNameKR>
                                                                <CountryNameTEMP1></CountryNameTEMP1>
                                                                <CountryNameTEMP2></CountryNameTEMP2>
                                                                <CountryNameTEMP3></CountryNameTEMP3>
                                                                <CountryPhone></CountryPhone>
                                                                <RegionId></RegionId>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <CountryStatus>' . $CountryStatus . '</CountryStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                                <IsUpdate>false</IsUpdate>
                                                                <PFTActive>0</PFTActive>
                                                                <SSActive>false</SSActive>
                                                                <ActiveMap>false</ActiveMap>
                                                                <ActiveGuide>false</ActiveGuide>
                                                                <CountryComment>' . $CountryComment . '</CountryComment>
                                                                <CountryDescription></CountryDescription>
                                                                <Tax>0</Tax>
                                                                <Service>0</Service>
                                                                <CountryNameURL></CountryNameURL>
                                                                <CountryURLTEMP1></CountryURLTEMP1>
                                                                <CountryURLTEMP2></CountryURLTEMP2>
                                                                <CountryURLTEMP3></CountryURLTEMP3>
                                                                <Priority>0</Priority>
                                                                <TopDestination>false</TopDestination>
                                                                <IsUpdated>0</IsUpdated>
                                                                <CapitalCity></CapitalCity>
                                                                <TopCountry>false</TopCountry>
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


                    $log_call_screen = 'Country - Edit';

                    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                    $client = new SoapClient(null, array(
                        'location' => $location_URL,
                        'uri' => '',
                        'trace' => 1,
                    ));

                    try {
                        $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                        $xml_arr = $this->xml2array($order_return);
                        //echo htmlentities($xml_string);
                        //pr($xml_arr);
                        //die;

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelCountry->updateAll(array('TravelCountry.wtb_status' => "'1'", 'TravelCountry.is_update' => "'Y'"), array('TravelCountry.id' => $CountryId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelCountry->updateAll(array('TravelCountry.wtb_status' => "'2'"), array('TravelCountry.id' => $CountryId));
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
                    $this->LogCall->create();
                    $this->LogCall->save($this->request->data['LogCall']);
                    $a =  date('m/d/Y H:i:s', strtotime('-1 hour'));
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

                    /*                     * *
                     * Country mapping table
                     * 
                     */
                    $xml_error = 'FALSE';

                    $arrs = $this->TravelCountrySupplier->find('all', array('conditions' => array('TravelCountrySupplier.country_id' => $CountryId)));
                    if (count($arrs) > 0) {
                        foreach ($arrs as $val) {

                            $Id = $val['TravelCountrySupplier']['id'];
                            $this->request->data['TravelCountrySupplier']['country_name'] = "'" . $CountryName . "'";
                            $this->request->data['TravelCountrySupplier']['country_continent_id'] = "'" . $ContinentId . "'";
                            $this->request->data['TravelCountrySupplier']['country_continent_name'] = "'" . $ContinentName . "'";
                            $this->request->data['TravelCountrySupplier']['pf_country_code'] = "'" . $CountryCode . "'";
                            $SupplierCountryCode = $val['TravelCountrySupplier']['supplier_country_code'];
                            $SupplierCode = $val['TravelCountrySupplier']['supplier_code'];
                            $CountryMappingName = strtoupper('[SUPP/COUNTRY] | ' . $SupplierCode . ' | ' . $CountryCode . ' - ' . $CountryName);
                            $this->request->data['TravelCountrySupplier']['country_mapping_name'] = "'" . $CountryMappingName . "'";
                            $this->TravelCountrySupplier->updateAll($this->request->data['TravelCountrySupplier'], array('TravelCountrySupplier.id' => $Id));

                            
                            $CountryName = $CountryName;
                            $CountryId = $val['TravelCountrySupplier']['country_id'];
                            $CountryContinentId = $ContinentId;
                            $CountryContinentName = $ContinentName;
                            $CountrySupplierStatus = $val['TravelCountrySupplier']['country_suppliner_status'];
                            $Active = strtolower($val['TravelCountrySupplier']['active']);
                            $Excluded = strtolower($val['TravelCountrySupplier']['excluded']);
                            $ApprovedBy = $val['TravelCountrySupplier']['approved_by'];
                            $CreatedBy = $val['TravelCountrySupplier']['created_by'];
                            $app_date = explode(' ', $val['TravelCountrySupplier']['approved_date']);
                            $ApprovedDate = $app_date[0] . 'T' . $app_date[1];
                            $date = explode(' ', $val['TravelCountrySupplier']['created']);
                            $created = $date[0] . 'T' . $date[1];
                            $is_update = $val['TravelCountrySupplier']['is_update'];
                            if ($is_update == 'Y')
                                $country_actiontype = 'Update';
                            else
                                $country_actiontype = 'AddNew';

                            $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_CountryMapping</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $country_actiontype . '">
                                                                <Id>' . $Id . '</Id>
                                                                <CountryCode>' . $CountryCode . '</CountryCode>
                                                                <CountryName>' . $CountryName . '</CountryName>
                                                                <SupplierCode>' . $SupplierCode . '</SupplierCode>
                                                                <SupplierCountryCode>' . $SupplierCountryCode . '</SupplierCountryCode>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryContinentId>' . $CountryContinentId . '</CountryContinentId>
                                                                <CountryContinentName>' . $CountryContinentName . '</CountryContinentName>
                                                                <CountryMappingName>' . $CountryMappingName . '</CountryMappingName>
                                                                <BuyingCurrency>NA</BuyingCurrency>
                                                                <ApplyBuyingCurrency>NA</ApplyBuyingCurrency>
                                                                <CountrySupplierStatus>' . $CountrySupplierStatus . '</CountrySupplierStatus>
                                                                <WtbStatus>false</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                                <Excluded>' . $Excluded . '</Excluded>                             
                                                                <ApprovedBy>' . $ApprovedBy . '</ApprovedBy>
                                                                <ApprovedDate>' . $ApprovedDate . '</ApprovedDate>
                                                                <CreatedBy>' . $CreatedBy . '</CreatedBy>
                                                                <CreatedDate>' . $created . '</CreatedDate> 
                                                            </ResourceDetailsData>              
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';
                            $log_call_screen = 'Edit - Country Mapping';
                            $RESOURCEDATA = 'RESOURCEDATA_COUNTRYMAPPING';

                            $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');

                            $client = new SoapClient(null, array(
                                'location' => $location_URL,
                                'uri' => '',
                                'trace' => 1,
                            ));

                            try {
                                $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
//Get response from here
                                $xml_arr = $this->xml2array($order_return);

                                if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                                    $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
                                    $this->TravelCountrySupplier->updateAll(array('wtb_status' => "'1'", 'is_update' => "'Y'"), array('id' => $id));
                                } else {

                                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                                    $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                                    $this->TravelCountrySupplier->updateAll(array('wtb_status' => "'2'"), array('id' => $id));
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
                            $this->LogCall->create();
                            $this->LogCall->save($this->request->data['LogCall']);
                            $a =  date('m/d/Y H:i:s', strtotime('-1 hour'));
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
                        }
                    }




                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Country.', 'failure');
                }
            }
        }

        $TravelCountrySuppliers = $this->TravelCountrySupplier->find('all', array('conditions' => array('TravelCountrySupplier.country_id' => $id)));


        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents', 'TravelCountrySuppliers'));


        $this->request->data = $TravelCountries;
    }

    public function de_active($id = null, $type = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if (!$id) {
            throw new NotFoundException(__('Invalid Country'));
        }

        if ($type == 'TRUE') {
            $type = 'FALSE';
            $ACTIVE_MSG = 'Active';
        } else {
            $type = 'TRUE';
            $ACTIVE_MSG = 'Inactive';
        }

        $TravelCountries = $this->TravelCountry->findById($id);

        if (!$TravelCountries) {
            throw new NotFoundException(__('Invalid Country'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelCountry->set($this->data);
            if ($this->TravelCountry->validates() == true) {

                if ($this->TravelCountry->updateAll(array('TravelCountry.active' => '"' . $this->data['TravelCountry']['active'] . '"'), array('TravelCountry.id' => $id))) {
                    $CountryId = $id;
                    $CountryName = $TravelCountries['TravelCountry']['country_name'];
                    $CountryCode = $TravelCountries['TravelCountry']['country_code'];
                    $ContinentId = $TravelCountries['TravelCountry']['continent_id'];
                    $ContinentName = $TravelCountries['TravelCountry']['continent_name'];
                    $CountryComment = $TravelCountries['TravelCountry']['country_comment'];
                    $Active = strtolower($this->data['TravelCountry']['active']);

                    $CountryStatus = $TravelCountries['TravelCountry']['country_status'];
                    if ($CountryStatus)
                        $CountryStatus = 'true';
                    else
                        $CountryStatus = 'false';

                    $WtbStatus = $TravelCountries['TravelCountry']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';
                    $TopCountry = strtolower($TravelCountries['TravelCountry']['top_country']);
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Country</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode>' . $CountryCode . '</CountryCode>
                                                                <CountryName>' . $CountryName . '</CountryName>
                                                                <CountryNameJP></CountryNameJP>
                                                                <CountryNameFR></CountryNameFR>
                                                                <CountryNameCN></CountryNameCN>
                                                                <CountryNameCNT></CountryNameCNT>
                                                                <CountryNameDE></CountryNameDE>
                                                                <CountryNameIT></CountryNameIT>
                                                                <CountryNameES></CountryNameES>
                                                                <CountryNameKR></CountryNameKR>
                                                                <CountryNameTEMP1></CountryNameTEMP1>
                                                                <CountryNameTEMP2></CountryNameTEMP2>
                                                                <CountryNameTEMP3></CountryNameTEMP3>
                                                                <CountryPhone></CountryPhone>
                                                                <RegionId></RegionId>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <CountryStatus>' . $CountryStatus . '</CountryStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                                <IsUpdate>false</IsUpdate>
                                                                <PFTActive>0</PFTActive>
                                                                <SSActive>false</SSActive>
                                                                <ActiveMap>false</ActiveMap>
                                                                <ActiveGuide>false</ActiveGuide>
                                                                <CountryComment>' . $CountryComment . '</CountryComment>
                                                                <CountryDescription></CountryDescription>
                                                                <Tax>0</Tax>
                                                                <Service>0</Service>
                                                                <CountryNameURL></CountryNameURL>
                                                                <CountryURLTEMP1></CountryURLTEMP1>
                                                                <CountryURLTEMP2></CountryURLTEMP2>
                                                                <CountryURLTEMP3></CountryURLTEMP3>
                                                                <Priority>0</Priority>
                                                                <TopDestination>false</TopDestination>
                                                                <IsUpdated>0</IsUpdated>
                                                                <CapitalCity></CapitalCity>
                                                                <TopCountry>false</TopCountry>
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


                    $log_call_screen = 'Country - ' . $ACTIVE_MSG;

                    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                    $client = new SoapClient(null, array(
                        'location' => $location_URL,
                        'uri' => '',
                        'trace' => 1,
                    ));

                    try {
                        $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                        $xml_arr = $this->xml2array($order_return);
                        //echo htmlentities($xml_string);
                        //pr($xml_arr);
                        //die;

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelCountry->updateAll(array('TravelCountry.wtb_status' => "'1'", 'TravelCountry.is_update' => "'Y'"), array('TravelCountry.id' => $CountryId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelCountry->updateAll(array('TravelCountry.wtb_status' => "'2'"), array('TravelCountry.id' => $CountryId));
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
                    $this->LogCall->create();
                    $this->LogCall->save($this->request->data['LogCall']);
                    $a =  date('m/d/Y H:i:s', strtotime('-1 hour'));
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

                    /*                     * *
                     * Country mapping table
                     * 

                      $xml_error = 'FALSE';

                      $arrs = $this->TravelCountrySupplier->find('all', array('conditions' => array('TravelCountrySupplier.country_id' => $CountryId)));
                      if (count($arrs) > 0) {
                      foreach ($arrs as $val) {
                      $Id = $val['TravelCountrySupplier']['id'];

                      $this->TravelCountrySupplier->updateAll(array('TravelCountrySupplier.active' => '"' . $this->data['TravelCountry']['active'] . '"'), array('TravelCountrySupplier.id' => $Id));


                      $country_code = $val['TravelCountrySupplier']['pf_country_code'];
                      $SupplierCode = $val['TravelCountrySupplier']['supplier_code'];
                      $SupplierCountryCode = $val['TravelCountrySupplier']['supplier_country_code'];
                      $CountryName = $val['TravelCountrySupplier']['country_name'];
                      ;
                      $CountryId = $val['TravelCountrySupplier']['country_id'];
                      $CountryContinentId = $val['TravelCountrySupplier']['country_continent_id'];
                      ;
                      $CountryContinentName = $val['TravelCountrySupplier']['country_continent_name'];
                      ;
                      $CountryMappingName = $val['TravelCountrySupplier']['country_mapping_name'];
                      $CountrySupplierStatus = $val['TravelCountrySupplier']['country_suppliner_status'];
                      $Active = $Active;
                      $Excluded = strtolower($val['TravelCountrySupplier']['excluded']);
                      $ApprovedBy = $val['TravelCountrySupplier']['approved_by'];
                      $CreatedBy = $val['TravelCountrySupplier']['created_by'];
                      $app_date = explode(' ', $val['TravelCountrySupplier']['approved_date']);
                      $ApprovedDate = $app_date[0] . 'T' . $app_date[1];
                      $date = explode(' ', $val['TravelCountrySupplier']['created']);
                      $created = $date[0] . 'T' . $date[1];
                      $is_update = $val['TravelCountrySupplier']['is_update'];
                      if ($is_update == 'Y')
                      $country_actiontype = 'Update';
                      else
                      $country_actiontype = 'AddNew';

                      $content_xml_str = '<soap:Body>
                      <ProcessXML xmlns="http://www.travel.domain/">
                      <RequestInfo>
                      <ResourceDataRequest>
                      <RequestAuditInfo>
                      <RequestType>PXML_WData_CountryMapping</RequestType>
                      <RequestTime>' . $CreatedDate . '</RequestTime>
                      <RequestResource>Silkrouters</RequestResource>
                      </RequestAuditInfo>
                      <RequestParameters>
                      <ResourceData>
                      <ResourceDetailsData srno="1" actiontype="' . $country_actiontype . '">
                      <Id>' . $Id . '</Id>
                      <CountryCode>' . $country_code . '</CountryCode>
                      <CountryName>' . $CountryName . '</CountryName>
                      <SupplierCode>' . $SupplierCode . '</SupplierCode>
                      <SupplierCountryCode>' . $SupplierCountryCode . '</SupplierCountryCode>
                      <CountryId>' . $CountryId . '</CountryId>
                      <CountryContinentId>' . $CountryContinentId . '</CountryContinentId>
                      <CountryContinentName>' . $CountryContinentName . '</CountryContinentName>
                      <CountryMappingName>' . $CountryMappingName . '</CountryMappingName>
                      <BuyingCurrency>NA</BuyingCurrency>
                      <ApplyBuyingCurrency>NA</ApplyBuyingCurrency>
                      <CountrySupplierStatus>' . $CountrySupplierStatus . '</CountrySupplierStatus>
                      <WtbStatus>false</WtbStatus>
                      <Active>' . $Active . '</Active>
                      <Excluded>' . $Excluded . '</Excluded>
                      <ApprovedBy>' . $ApprovedBy . '</ApprovedBy>
                      <ApprovedDate>' . $ApprovedDate . '</ApprovedDate>
                      <CreatedBy>' . $CreatedBy . '</CreatedBy>
                      <CreatedDate>' . $created . '</CreatedDate>
                      </ResourceDetailsData>
                      </ResourceData>
                      </RequestParameters>
                      </ResourceDataRequest>
                      </RequestInfo>
                      </ProcessXML>
                      </soap:Body>';
                      $log_call_screen = 'Country Mapping - ' . $ACTIVE_MSG;
                      $RESOURCEDATA = 'RESOURCEDATA_COUNTRYMAPPING';

                      $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');

                      $client = new SoapClient(null, array(
                      'location' => $location_URL,
                      'uri' => '',
                      'trace' => 1,
                      ));

                      try {
                      $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
                      //Get response from here
                      $xml_arr = $this->xml2array($order_return);

                      if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                      $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                      $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                      $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
                      $this->TravelCountrySupplier->updateAll(array('wtb_status' => "'1'", 'is_update' => "'Y'"), array('id' => $id));
                      } else {

                      $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                      $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                      $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                      $this->TravelCountrySupplier->updateAll(array('wtb_status' => "'2'"), array('id' => $id));
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
                      $this->LogCall->create();
                      $this->LogCall->save($this->request->data['LogCall']);
                      if ($xml_error == 'TRUE') {
                      $Email = new CakeEmail();

                      $Email->viewVars(array(
                      'request_xml' => trim($xml_string),
                      'respon_message' => $log_call_status_message,
                      'respon_code' => $log_call_status_code,
                      ));

                      $to = 'biswajit@wtbglobal.com';
                      $cc = 'infra@sumanus.com';

                      $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . AppModel::ConvertGMTToLocalTimezone(date('d/m/y H:i:s'), 'Asia/Calcutta') . ']')->send();
                      }
                      }
                      }

                     */

                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Country.', 'failure');
                }
            }
        }

        $Types = array($type);

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents', 'Types'));

        $this->request->data = $TravelCountries;
    }

    public function retry($id = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if (!$id) {
            throw new NotFoundException(__('Invalid Country'));
        }

        $TravelCountries = $this->TravelCountry->findById($id);

        if (!$TravelCountries) {
            throw new NotFoundException(__('Invalid Country'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            $CountryId = $id;
            $CountryName = $TravelCountries['TravelCountry']['country_name'];
            $CountryCode = $TravelCountries['TravelCountry']['country_code'];
            $ContinentId = $TravelCountries['TravelCountry']['continent_id'];
            $ContinentName = $TravelCountries['TravelCountry']['continent_name'];
            $CountryComment = $TravelCountries['TravelCountry']['country_comment'];
            $Active = strtolower($TravelCountries['TravelCountry']['active']);

            $CountryStatus = $TravelCountries['TravelCountry']['country_status'];
            if ($CountryStatus)
                $CountryStatus = 'true';
            else
                $CountryStatus = 'false';

            $WtbStatus = $TravelCountries['TravelCountry']['wtb_status'];
            if ($WtbStatus)
                $WtbStatus = 'true';
            else
                $WtbStatus = 'false';
            $TopCountry = strtolower($TravelCountries['TravelCountry']['top_country']);
            $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

            $is_update = $TravelCountries['TravelCountry']['is_update'];
            if ($is_update == 'Y')
                $actiontype = 'Update';
            else
                $actiontype = 'AddNew';

            $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Country</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode>' . $CountryCode . '</CountryCode>
                                                                <CountryName>' . $CountryName . '</CountryName>
                                                                <CountryNameJP></CountryNameJP>
                                                                <CountryNameFR></CountryNameFR>
                                                                <CountryNameCN></CountryNameCN>
                                                                <CountryNameCNT></CountryNameCNT>
                                                                <CountryNameDE></CountryNameDE>
                                                                <CountryNameIT></CountryNameIT>
                                                                <CountryNameES></CountryNameES>
                                                                <CountryNameKR></CountryNameKR>
                                                                <CountryNameTEMP1></CountryNameTEMP1>
                                                                <CountryNameTEMP2></CountryNameTEMP2>
                                                                <CountryNameTEMP3></CountryNameTEMP3>
                                                                <CountryPhone></CountryPhone>
                                                                <RegionId></RegionId>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <CountryStatus>' . $CountryStatus . '</CountryStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                                <IsUpdate>false</IsUpdate>
                                                                <PFTActive>0</PFTActive>
                                                                <SSActive>false</SSActive>
                                                                <ActiveMap>false</ActiveMap>
                                                                <ActiveGuide>false</ActiveGuide>
                                                                <CountryComment>' . $CountryComment . '</CountryComment>
                                                                <CountryDescription></CountryDescription>
                                                                <Tax>0</Tax>
                                                                <Service>0</Service>
                                                                <CountryNameURL></CountryNameURL>
                                                                <CountryURLTEMP1></CountryURLTEMP1>
                                                                <CountryURLTEMP2></CountryURLTEMP2>
                                                                <CountryURLTEMP3></CountryURLTEMP3>
                                                                <Priority>0</Priority>
                                                                <TopDestination>false</TopDestination>
                                                                <IsUpdated>0</IsUpdated>
                                                                <CapitalCity></CapitalCity>
                                                                <TopCountry>false</TopCountry>
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


            $log_call_screen = 'Country - Re-try';

            $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
            $client = new SoapClient(null, array(
                'location' => $location_URL,
                'uri' => '',
                'trace' => 1,
            ));

            try {
                $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                $xml_arr = $this->xml2array($order_return);
                //echo htmlentities($xml_string);
                //pr($xml_arr);
                //die;

                if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                    $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                    $this->TravelCountry->updateAll(array('TravelCountry.wtb_status' => "'1'", 'TravelCountry.is_update' => "'Y'"), array('TravelCountry.id' => $CountryId));
                } else {

                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_COUNTRY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                    $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                    $this->TravelCountry->updateAll(array('TravelCountry.wtb_status' => "'2'"), array('TravelCountry.id' => $CountryId));
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
            $message = $xml_msg;
            $this->Session->setFlash($message, 'success');
            $a =  date('m/d/Y H:i:s', strtotime('-1 hour'));
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
            /*             * *
             * Country mapping table
             * 
             */
            $xml_error = 'FALSE';

            $arrs = $this->TravelCountrySupplier->find('all', array('conditions' => array('TravelCountrySupplier.country_id' => $CountryId)));
            if (count($arrs) > 0) {
                foreach ($arrs as $val) {
                    $Id = $val['TravelCountrySupplier']['id'];
                    $this->request->data['TravelCountrySupplier']['country_name'] = "'" . $CountryName . "'";
                    $this->request->data['TravelCountrySupplier']['country_continent_id'] = "'" . $ContinentId . "'";
                    $this->request->data['TravelCountrySupplier']['country_continent_name'] = "'" . $ContinentName . "'";
                    $this->request->data['TravelCountrySupplier']['pf_country_code'] = "'" . $CountryCode . "'";
                    $SupplierCountryCode = $val['TravelCountrySupplier']['supplier_country_code'];
                    $SupplierCode = $val['TravelCountrySupplier']['supplier_code'];
                    $CountryMappingName = strtoupper('[SUPP/COUNTRY] | ' . $SupplierCode . ' | ' . $CountryCode . ' - ' . $CountryName);
                    $this->request->data['TravelCountrySupplier']['country_mapping_name'] = "'" . $CountryMappingName . "'";
                    $this->TravelCountrySupplier->updateAll($this->request->data['TravelCountrySupplier'], array('TravelCountrySupplier.id' => $Id));
                    
                    $CountryName = $CountryName;
                    $CountryId = $val['TravelCountrySupplier']['country_id'];
                    $CountryContinentId = $ContinentId;
                    $CountryContinentName = $ContinentName;
                    $CountrySupplierStatus = $val['TravelCountrySupplier']['country_suppliner_status'];
                    $Active = strtolower($val['TravelCountrySupplier']['active']);
                    $Excluded = strtolower($val['TravelCountrySupplier']['excluded']);
                    $ApprovedBy = $val['TravelCountrySupplier']['approved_by'];
                    $CreatedBy = $val['TravelCountrySupplier']['created_by'];
                    $app_date = explode(' ', $val['TravelCountrySupplier']['approved_date']);
                    $ApprovedDate = $app_date[0] . 'T' . $app_date[1];
                    $date = explode(' ', $val['TravelCountrySupplier']['created']);
                    $created = $date[0] . 'T' . $date[1];
                    $is_update = $val['TravelCountrySupplier']['is_update'];
                    if ($is_update == 'Y')
                        $country_actiontype = 'Update';
                    else
                        $country_actiontype = 'AddNew';

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_CountryMapping</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $country_actiontype . '">
                                                                <Id>' . $Id . '</Id>
                                                                <CountryCode>' . $CountryCode . '</CountryCode>
                                                                <CountryName>' . $CountryName . '</CountryName>
                                                                <SupplierCode>' . $SupplierCode . '</SupplierCode>
                                                                <SupplierCountryCode>' . $SupplierCountryCode . '</SupplierCountryCode>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryContinentId>' . $CountryContinentId . '</CountryContinentId>
                                                                <CountryContinentName>' . $CountryContinentName . '</CountryContinentName>
                                                                <CountryMappingName>' . $CountryMappingName . '</CountryMappingName>
                                                                <BuyingCurrency>NA</BuyingCurrency>
                                                                <ApplyBuyingCurrency>NA</ApplyBuyingCurrency>
                                                                <CountrySupplierStatus>' . $CountrySupplierStatus . '</CountrySupplierStatus>
                                                                <WtbStatus>false</WtbStatus>
                                                                <Active>' . $Active . '</Active>
                                                                <Excluded>' . $Excluded . '</Excluded>                             
                                                                <ApprovedBy>' . $ApprovedBy . '</ApprovedBy>
                                                                <ApprovedDate>' . $ApprovedDate . '</ApprovedDate>
                                                                <CreatedBy>' . $CreatedBy . '</CreatedBy>
                                                                <CreatedDate>' . $created . '</CreatedDate> 
                                                            </ResourceDetailsData>              
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';
                    $log_call_screen = 'Edit - Country Mapping';
                    $RESOURCEDATA = 'RESOURCEDATA_COUNTRYMAPPING';

                    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');

                    $client = new SoapClient(null, array(
                        'location' => $location_URL,
                        'uri' => '',
                        'trace' => 1,
                    ));

                    try {
                        $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
//Get response from here
                        $xml_arr = $this->xml2array($order_return);

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
                            $this->TravelCountrySupplier->updateAll(array('wtb_status' => "'1'", 'is_update' => "'Y'"), array('id' => $id));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                            $this->TravelCountrySupplier->updateAll(array('wtb_status' => "'2'"), array('id' => $id));
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
                    $a =  date('m/d/Y H:i:s', strtotime('-1 hour'));
                    $date = new DateTime($a, new DateTimeZone('Asia/Calcutta'));
                    $this->LogCall->create();
                    $this->LogCall->save($this->request->data['LogCall']);
                    if ($xml_error == 'TRUE') {
                        $Email = new CakeEmail();

                        $Email->viewVars(array(
                            'request_xml' => trim($xml_string),
                            'respon_message' => $log_call_status_message,
                            'respon_code' => $log_call_status_code,
                        ));

                        $to = 'biswajit@wtbglobal.com';
                        $cc = 'infra@sumanus.com';

                        $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')). ']')->send();
                    }
                }
            }


            $this->redirect(array('action' => 'index'));
        }

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));

        $this->request->data = $TravelCountries;
    }

}