<?php

/**
 * TravelChain controller.
 *
 * This file will render views from views/TravelChains/
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
 * TravelChain controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TravelChainsController extends AppController {

    var $uses = array('TravelChain', 'TravelCountry', 'TravelCity', 'TravelLookupChainPresence', 'TravelLookupChainSegment', 'LogCall');

    public function index() {


        $search_condition = array();
        $chain_name = '';
        $chain_country = '';

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['TravelChain']['chain_name'])) {
                $chain_name = $this->data['TravelChain']['chain_name'];
                array_push($search_condition, array("TravelChain.chain_name LIKE '%$chain_name%'"));
            }

            if (!empty($this->data['TravelChain']['chain_home_country_id'])) {
                $chain_country = $this->data['TravelChain']['chain_home_country_id'];
                array_push($search_condition, array('TravelChain.chain_home_country_id' => $chain_country));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['chain_name'])) {
                $chain_name = $this->request->params['named']['chain_name'];
                array_push($search_condition, array("TravelChain.chain_name LIKE '%$chain_name%'"));
            }

            if (!empty($this->request->params['named']['chain_home_country_id'])) {
                $chain_country = $this->request->params['named']['chain_home_country_id'];
                array_push($search_condition, array('TravelChain.chain_home_country_id' => $chain_country));
            }
        }
        $this->paginate['order'] = array('TravelChain.chain_name' => 'asc');
        $this->set('TravelChains', $this->paginate("TravelChain", $search_condition));


        if (!isset($this->passedArgs['chain_name']) && empty($this->passedArgs['chain_name'])) {
            $this->passedArgs['chain_name'] = (isset($this->data['TravelChain']['chain_name'])) ? $this->data['TravelChain']['chain_name'] : '';
        }
        if (!isset($this->passedArgs['chain_country']) && empty($this->passedArgs['chain_country'])) {
            $this->passedArgs['chain_country'] = (isset($this->data['TravelChain']['chain_country'])) ? $this->data['TravelChain']['chain_country'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {

            $this->data['TravelChain']['chain_name'] = $this->passedArgs['chain_name'];
            $this->data['TravelChain']['chain_country'] = $this->passedArgs['chain_country'];
        }

        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));

        $this->set(compact('chain_country'));
        $this->set(compact('chain_name'));
    }

    public function add() {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if ($this->request->is('post')) {

            $this->request->data['TravelChain']['created_by'] = $user_id;
            $this->request->data['TravelChain']['chain_status'] = '1';
            $this->request->data['TravelChain']['wtb_status'] = '1';
            $this->request->data['TravelChain']['chain_active'] = 'TRUE';
            $this->TravelChain->create();
            if ($this->TravelChain->save($this->request->data)) {

                $ChainId = $this->TravelChain->getLastInsertId();
                $ChainOwnerCompany = $this->data['TravelChain']['chain_owner_company'];
                $ChainName = $this->data['TravelChain']['chain_name'];
                $ChainHQCityId = $this->data['TravelChain']['chain_hq_city_id'];
                $ChainHQCityName = $this->data['TravelChain']['chain_hq_city_name'];
                $ChainHomeCountryId = $this->data['TravelChain']['chain_home_country_id'];
                $ChainHomeCountryName = $this->data['TravelChain']['chain_home_country_name'];
                $ChainPresence = $this->data['TravelChain']['chain_presence'];
                $ChainSegment = $this->data['TravelChain']['chain_segment'];
                $ChainStatus = 'true';
                $WtbStatus = 'true';
                $TopChain = strtolower($this->data['TravelChain']['top_chain']);
                $ChainActive = 'true';
                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Chain</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="AddNew">
                                                                <ChainId>' . $ChainId . '</ChainId>
                                                                <ChainCode>NA</ChainCode>
                                                                <ChainName>' . $ChainName . '</ChainName>
                                                                <ChainOwnerCompany>' . $ChainOwnerCompany . '</ChainOwnerCompany>
                                                                <ChainHQCityId>' . $ChainHQCityId . '</ChainHQCityId>
                                                                <ChainHQCityName>' . $ChainHQCityName . '</ChainHQCityName>                              
                                                                <ChainHomeCountryId>' . $ChainHomeCountryId . '</ChainHomeCountryId>
                                                                <ChainHomeCountryName>' . $ChainHomeCountryName . '</ChainHomeCountryName>
                                                                <ChainPresence>' . $ChainPresence . '</ChainPresence>
                                                                <ChainSegment>' . $ChainSegment . '</ChainSegment>
                                                                <ChainStatus>' . $ChainStatus . '</ChainStatus>
                                                                 <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <ChainActive>' . $ChainActive . '</ChainActive>
                                                                <TopChain>' . $TopChain . '</TopChain>
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


                $log_call_screen = 'Chain - Add';

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
                    //  die;

                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                        $xml_msg = "Foreign record has been successfully added [Code:$log_call_status_code]";
                        $this->TravelChain->updateAll(array('TravelChain.wtb_status' => "'1'", 'TravelChain.is_update' => "'Y'"), array('TravelChain.id' => $ChainId));
                    } else {

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                        $xml_msg = "There was a problem with foreign record addition [Code:$log_call_status_code]";
                        $this->TravelChain->updateAll(array('TravelChain.wtb_status' => "'2'"), array('TravelChain.id' => $ChainId));
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
                $message = 'Local record has been successfully added.<br />' . $xml_msg;

                $this->Session->setFlash($message, 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add Chain.', 'failure');
            }
        }

        $TravelLookupChainPresences = $this->TravelLookupChainPresence->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupChainPresences'));

        $TravelLookupChainSegments = $this->TravelLookupChainSegment->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupChainSegments'));


        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id, country_name', 'order' => 'country_name ASC'));
        //$TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
        $this->set(compact('TravelCountries'));
    }

    public function edit($id = null, $mode = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $id = base64_decode($id);
        $this->set(compact('mode'));
        $xml_error = 'FALSE';

        if (!$id) {
            throw new NotFoundException(__('Invalid Cain'));
        }

        $TravelChains = $this->TravelChain->findById($id);

        if (!$TravelChains) {
            throw new NotFoundException(__('Invalid chain'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelChain->set($this->data);
            if ($this->TravelChain->validates() == true) {

                $this->TravelChain->id = $id;
                if ($this->TravelChain->save($this->request->data)) {
                    $ChainId = $id;
                    $ChainOwnerCompany = $this->data['TravelChain']['chain_owner_company'];
                    $ChainName = $this->data['TravelChain']['chain_name'];
                    $ChainHQCityId = $this->data['TravelChain']['chain_hq_city_id'];
                    $ChainHQCityName = $this->data['TravelChain']['chain_hq_city_name'];
                    $ChainHomeCountryId = $this->data['TravelChain']['chain_home_country_id'];
                    $ChainHomeCountryName = $this->data['TravelChain']['chain_home_country_name'];
                    $ChainPresence = $this->data['TravelChain']['chain_presence'];
                    $ChainSegment = $this->data['TravelChain']['chain_segment'];
                    $ChainStatus = $TravelChains['TravelChain']['chain_status'];
                    if ($ChainStatus)
                        $ChainStatus = 'true';
                    else
                        $ChainStatus = 'false';

                    $WtbStatus = $TravelChains['TravelChain']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';

                    $TopChain = strtolower($this->data['TravelChain']['top_chain']);
                    $ChainActive = strtolower($TravelChains['TravelChain']['chain_active']);
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Chain</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <ChainId>' . $ChainId . '</ChainId>
                                                                <ChainCode>NA</ChainCode>
                                                                <ChainName>' . $ChainName . '</ChainName>
                                                                <ChainOwnerCompany>' . $ChainOwnerCompany . '</ChainOwnerCompany>
                                                                <ChainHQCityId>' . $ChainHQCityId . '</ChainHQCityId>
                                                                <ChainHQCityName>' . $ChainHQCityName . '</ChainHQCityName>                              
                                                                <ChainHomeCountryId>' . $ChainHomeCountryId . '</ChainHomeCountryId>
                                                                <ChainHomeCountryName>' . $ChainHomeCountryName . '</ChainHomeCountryName>
                                                                <ChainPresence>' . $ChainPresence . '</ChainPresence>
                                                                <ChainSegment>' . $ChainSegment . '</ChainSegment>
                                                                <ChainStatus>' . $ChainStatus . '</ChainStatus>
                                                                 <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <ChainActive>' . $ChainActive . '</ChainActive>
                                                                <TopChain>' . $TopChain . '</TopChain>
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


                    $log_call_screen = 'Chain - Edit';

                    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                    $client = new SoapClient(null, array(
                        'location' => $location_URL,
                        'uri' => '',
                        'trace' => 1,
                    ));

                    try {
                        $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                        $xml_arr = $this->xml2array($order_return);
                        //  echo htmlentities($xml_string);
                        //   pr($xml_arr);
                        //   die;

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelChain->updateAll(array('TravelChain.wtb_status' => "'1'"), array('TravelChain.id' => $ChainId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelChain->updateAll(array('TravelChain.wtb_status' => "'2'"), array('TravelChain.id' => $ChainId));
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
                    $a =  date('m/d/Y H:i:s', strtotime('-1 hour'));
                    $date = new DateTime($a, new DateTimeZone('Asia/Kolkata'));
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
                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Chain.', 'failure');
                }
            }
        }

        $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $TravelChains['TravelChain']['chain_home_country_id'], 'city_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'city_name ASC'));
        $this->set(compact('TravelCities'));


        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));

        $TravelLookupChainPresences = $this->TravelLookupChainPresence->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupChainPresences'));

        $TravelLookupChainSegments = $this->TravelLookupChainSegment->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupChainSegments'));

        $this->request->data = $TravelChains;
    }

    public function de_active($id = null, $type = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FLASE';

        if ($type == 'TRUE') {
            $type = 'FALSE';
            $ACTIVE_MSG = 'Active';
        } else {
            $type = 'TRUE';
            $ACTIVE_MSG = 'Inactive';
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid Cain'));
        }

        $TravelChains = $this->TravelChain->findById($id);

        if (!$TravelChains) {
            throw new NotFoundException(__('Invalid chain'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelChain->set($this->data);
            if ($this->TravelChain->validates() == true) {


                if ($this->TravelChain->updateAll(array('TravelChain.chain_active' => '"' . $this->data['TravelChain']['chain_active'] . '"'), array('TravelChain.id' => $id))) {

                    $ChainId = $id;
                    $ChainOwnerCompany = $TravelChains['TravelChain']['chain_owner_company'];
                    $ChainName = $TravelChains['TravelChain']['chain_name'];
                    $ChainHQCityId = $TravelChains['TravelChain']['chain_hq_city_id'];
                    $ChainHQCityName = $TravelChains['TravelChain']['chain_hq_city_name'];
                    $ChainHomeCountryId = $TravelChains['TravelChain']['chain_home_country_id'];
                    $ChainHomeCountryName = $TravelChains['TravelChain']['chain_home_country_name'];
                    $ChainPresence = $TravelChains['TravelChain']['chain_presence'];
                    $ChainSegment = $TravelChains['TravelChain']['chain_segment'];
                    $ChainStatus = $TravelChains['TravelChain']['chain_status'];
                    if ($ChainStatus)
                        $ChainStatus = 'true';
                    else
                        $ChainStatus = 'false';

                    $WtbStatus = $TravelChains['TravelChain']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';

                    $TopChain = strtolower($TravelChains['TravelChain']['top_chain']);
                    $ChainActive = strtolower($this->data['TravelChain']['chain_active']);
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Chain</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <ChainId>' . $ChainId . '</ChainId>
                                                                <ChainCode>NA</ChainCode>
                                                                <ChainName>' . $ChainName . '</ChainName>
                                                                <ChainOwnerCompany>' . $ChainOwnerCompany . '</ChainOwnerCompany>
                                                                <ChainHQCityId>' . $ChainHQCityId . '</ChainHQCityId>
                                                                <ChainHQCityName>' . $ChainHQCityName . '</ChainHQCityName>                              
                                                                <ChainHomeCountryId>' . $ChainHomeCountryId . '</ChainHomeCountryId>
                                                                <ChainHomeCountryName>' . $ChainHomeCountryName . '</ChainHomeCountryName>
                                                                <ChainPresence>' . $ChainPresence . '</ChainPresence>
                                                                <ChainSegment>' . $ChainSegment . '</ChainSegment>
                                                                <ChainStatus>' . $ChainStatus . '</ChainStatus>
                                                                 <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <ChainActive>' . $ChainActive . '</ChainActive>
                                                                <TopChain>' . $TopChain . '</TopChain>
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


                    $log_call_screen = 'Chain - ' . $ACTIVE_MSG;

                    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                    $client = new SoapClient(null, array(
                        'location' => $location_URL,
                        'uri' => '',
                        'trace' => 1,
                    ));

                    try {
                        $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                        $xml_arr = $this->xml2array($order_return);
                        //  echo htmlentities($xml_string);
                        //   pr($xml_arr);
                        //   die;

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelChain->updateAll(array('TravelChain.wtb_status' => "'1'"), array('TravelChain.id' => $ChainId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelChain->updateAll(array('TravelChain.wtb_status' => "'2'"), array('TravelChain.id' => $ChainId));
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
                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Chain.', 'failure');
                }
            }
        }
        $Types = array($type);

        $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $TravelChains['TravelChain']['chain_home_country_id'], 'city_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'city_name ASC'));
        $this->set(compact('TravelCities', 'Types'));


        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));

        $TravelLookupChainPresences = $this->TravelLookupChainPresence->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupChainPresences'));

        $TravelLookupChainSegments = $this->TravelLookupChainSegment->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupChainSegments'));

        $this->request->data = $TravelChains;
    }

    public function retry($id = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if (!$id) {
            throw new NotFoundException(__('Invalid Cain'));
        }

        $TravelChains = $this->TravelChain->findById($id);

        if (!$TravelChains) {
            throw new NotFoundException(__('Invalid chain'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            $ChainId = $id;
            $ChainOwnerCompany = $TravelChains['TravelChain']['chain_owner_company'];
            $ChainName = $TravelChains['TravelChain']['chain_name'];
            $ChainHQCityId = $TravelChains['TravelChain']['chain_hq_city_id'];
            $ChainHQCityName = $TravelChains['TravelChain']['chain_hq_city_name'];
            $ChainHomeCountryId = $TravelChains['TravelChain']['chain_home_country_id'];
            $ChainHomeCountryName = $TravelChains['TravelChain']['chain_home_country_name'];
            $ChainPresence = $TravelChains['TravelChain']['chain_presence'];
            $ChainSegment = $TravelChains['TravelChain']['chain_segment'];
            $ChainStatus = $TravelChains['TravelChain']['chain_status'];
            if ($ChainStatus)
                $ChainStatus = 'true';
            else
                $ChainStatus = 'false';

            $WtbStatus = $TravelChains['TravelChain']['wtb_status'];
            if ($WtbStatus)
                $WtbStatus = 'true';
            else
                $WtbStatus = 'false';

            $TopChain = strtolower($TravelChains['TravelChain']['top_chain']);
            $ChainActive = strtolower($TravelChains['TravelChain']['chain_active']);
            $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

            $is_update = $TravelChains['TravelChain']['is_update'];
            if ($is_update == 'Y')
                $actiontype = 'Update';
            else
                $actiontype = 'AddNew';

            $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Chain</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">
                                                                <ChainId>' . $ChainId . '</ChainId>
                                                                <ChainCode>NA</ChainCode>
                                                                <ChainName>' . $ChainName . '</ChainName>
                                                                <ChainOwnerCompany>' . $ChainOwnerCompany . '</ChainOwnerCompany>
                                                                <ChainHQCityId>' . $ChainHQCityId . '</ChainHQCityId>
                                                                <ChainHQCityName>' . $ChainHQCityName . '</ChainHQCityName>                              
                                                                <ChainHomeCountryId>' . $ChainHomeCountryId . '</ChainHomeCountryId>
                                                                <ChainHomeCountryName>' . $ChainHomeCountryName . '</ChainHomeCountryName>
                                                                <ChainPresence>' . $ChainPresence . '</ChainPresence>
                                                                <ChainSegment>' . $ChainSegment . '</ChainSegment>
                                                                <ChainStatus>' . $ChainStatus . '</ChainStatus>
                                                                 <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <ChainActive>' . $ChainActive . '</ChainActive>
                                                                <TopChain>' . $TopChain . '</TopChain>
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


            $log_call_screen = 'Chain - Re-try';

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
                // pr($xml_arr);
                //   die;

                if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                    $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                    $this->TravelChain->updateAll(array('TravelChain.wtb_status' => "'1'", 'TravelChain.is_update' => "'Y'"), array('TravelChain.id' => $ChainId));
                } else {

                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CHAIN']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                    $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                    $this->TravelChain->updateAll(array('TravelChain.wtb_status' => "'2'"), array('TravelChain.id' => $ChainId));
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
            $LogId = $this->LogCall->getLastInsertId();
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

                $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Log Id [' . $LogId . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
            }
            $message = $xml_msg;
            $this->Session->setFlash($message, 'success');
            $this->redirect(array('action' => 'index'));
        }

        $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $TravelChains['TravelChain']['chain_home_country_id'], 'city_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'city_name ASC'));
        $this->set(compact('TravelCities'));


        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));

        $TravelLookupChainPresences = $this->TravelLookupChainPresence->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupChainPresences'));

        $TravelLookupChainSegments = $this->TravelLookupChainSegment->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupChainSegments'));

        $this->request->data = $TravelChains;
    }

}

