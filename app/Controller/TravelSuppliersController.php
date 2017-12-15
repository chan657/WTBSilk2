<?php

/**
 * TravelSupplier controller.
 *
 * This file will render views from views/TravelSuppliers/
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
 * TravelSupplier controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TravelSuppliersController extends AppController {

    var $uses = array('TravelSupplier', 'TravelLookupContinent','TravelCountry', 'LogCall', 'TravelSupplierSupplier', 'User','Common');

    public function index() {

        $search_condition = array();
        $TravelSuppliers = array();
        $country_name = '';
        $continent_id = '';
        $country_status = '';
        $wtb_status = '';
        $active = '';

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['TravelSupplier']['country_name'])) {
                $country_name = $this->data['TravelSupplier']['country_name'];
                array_push($search_condition, array("TravelSupplier.country_name LIKE '%$country_name%'"));
            }
            if (!empty($this->data['TravelSupplier']['continent_id'])) {
                $continent_id = $this->data['TravelSupplier']['continent_id'];
                array_push($search_condition, array('TravelSupplier.continent_id' => $continent_id));
            }

            if (!empty($this->data['TravelSupplier']['country_id'])) {
                $country_id = $this->data['TravelSupplier']['country_id'];
                array_push($search_condition, array('TravelSupplier.country_id' => $country_id));
            }
            if (!empty($this->data['TravelSupplier']['country_status'])) {
                $country_status = $this->data['TravelSupplier']['country_status'];
                array_push($search_condition, array('TravelSupplier.country_status' => $country_status));
            }
            if (!empty($this->data['TravelSupplier']['wtb_status'])) {
                $wtb_status = $this->data['TravelSupplier']['wtb_status'];
                array_push($search_condition, array('TravelSupplier.wtb_status' => $wtb_status));
            }
            if (!empty($this->data['TravelSupplier']['active'])) {
                $active = $this->data['TravelSupplier']['active'];
                array_push($search_condition, array('TravelSupplier.active' => $active));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['country_name'])) {
                $country_name = $this->request->params['named']['country_name'];
                array_push($search_condition, array("TravelSupplier.country_name LIKE '%$country_name%'"));
            }
            if (!empty($this->request->params['named']['continent_id'])) {
                $continent_id = $this->request->params['named']['continent_id'];
                array_push($search_condition, array('TravelSupplier.continent_id' => $continent_id));
            }

            if (!empty($this->request->params['named']['country_status'])) {
                $country_status = $this->request->params['named']['country_status'];
                array_push($search_condition, array('TravelSupplier.country_status' => $country_status));
            }
            if (!empty($this->request->params['named']['wtb_status'])) {
                $wtb_status = $this->request->params['named']['wtb_status'];
                array_push($search_condition, array('TravelSupplier.wtb_status' => $wtb_status));
            }
            if (!empty($this->request->params['named']['active'])) {
                $active = $this->request->params['named']['active'];
                array_push($search_condition, array('TravelSupplier.active' => $active));
            }
        }

        $this->paginate['order'] = array('TravelSupplier.country_name' => 'asc');
        $this->set('TravelSuppliers', $this->paginate("TravelSupplier", $search_condition));
        //$log = $this->TravelSupplier->getDataSource()->getLog(false, false);       
        //debug($log);
        // die;

        if (!isset($this->passedArgs['country_name']) && empty($this->passedArgs['country_name'])) {
            $this->passedArgs['country_name'] = (isset($this->data['TravelSupplier']['country_name'])) ? $this->data['TravelSupplier']['country_name'] : '';
        }
        if (!isset($this->passedArgs['continent_id']) && empty($this->passedArgs['continent_id'])) {
            $this->passedArgs['continent_id'] = (isset($this->data['TravelSupplier']['continent_id'])) ? $this->data['TravelSupplier']['continent_id'] : '';
        }
        if (!isset($this->passedArgs['country_id']) && empty($this->passedArgs['country_id'])) {
            $this->passedArgs['country_id'] = (isset($this->data['TravelSupplier']['country_id'])) ? $this->data['TravelSupplier']['country_id'] : '';
        }
        if (!isset($this->passedArgs['country_status']) && empty($this->passedArgs['country_status'])) {
            $this->passedArgs['country_status'] = (isset($this->data['TravelSupplier']['country_status'])) ? $this->data['TravelSupplier']['country_status'] : '';
        }
        if (!isset($this->passedArgs['wtb_status']) && empty($this->passedArgs['wtb_status'])) {
            $this->passedArgs['wtb_status'] = (isset($this->data['TravelSupplier']['wtb_status'])) ? $this->data['TravelSupplier']['wtb_status'] : '';
        }
        if (!isset($this->passedArgs['active']) && empty($this->passedArgs['active'])) {
            $this->passedArgs['active'] = (isset($this->data['TravelSupplier']['active'])) ? $this->data['TravelSupplier']['active'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {

            $this->data['TravelSupplier']['country_name'] = $this->passedArgs['country_name'];
            $this->data['TravelSupplier']['continent_id'] = $this->passedArgs['continent_id'];
            $this->data['TravelSupplier']['country_id'] = $this->passedArgs['country_id'];
            $this->data['TravelSupplier']['country_status'] = $this->passedArgs['country_status'];
            $this->data['TravelSupplier']['wtb_status'] = $this->passedArgs['wtb_status'];
            $this->data['TravelSupplier']['active'] = $this->passedArgs['active'];
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

            $ContinentId = $this->data['TravelSupplier']['continent_id'];
            $CintinentName = $this->Common->getContinentName($ContinentId);
            $CintinentCode = $this->Common->getContinentCode($ContinentId);
            $CountryId = $this->data['TravelSupplier']['country_id'];
            $CountryName = $this->Common->getCountryName($CountryId);
            $CountryCode = $this->Common->getCountryCode($CountryId);
            $this->request->data['TravelSupplier']['country_name'] = $CountryName;
            $this->request->data['TravelSupplier']['country_code'] = $CountryCode;
            $this->request->data['TravelSupplier']['continent_code'] = $CintinentCode;
            $this->request->data['TravelSupplier']['continent_name'] = $CintinentName;
            $SupplierCode = $this->data['TravelSupplier']['supplier_code'];
            $SupplierName = $this->data['TravelSupplier']['supplier_name'];
            $feed = $this->data['TravelSupplier']['feed'];
            $this->request->data['TravelSupplier']['created_by'] = $user_id;
            $this->request->data['TravelSupplier']['active'] = 'TRUE';
            $this->request->data['TravelSupplier']['status'] = '1';
            $this->request->data['TravelSupplier']['wtb_status'] = '1';
            $this->TravelSupplier->create();
            if ($this->TravelSupplier->save($this->request->data)) {
                $SupplierId = $this->TravelSupplier->getLastInsertId();
                $Active = 'true';
                $CountryStatus = 'true';
                $WtbStatus = 'true';
                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Supplier</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="AddNew">
                                                                <SupplierId>'.$SupplierId.'</SupplierId>
                                                                <SupplierCode>'.$SupplierCode.'</SupplierCode>
                                                                <SupplierName>'.$SupplierName.'</SupplierName>
                                                                <Feed>'.$feed.'</Feed>
                                                                <Active>'.$Active.'</Active>
                                                                <WtbStatus>'.$WtbStatus.'</WtbStatus>
                                                                
                                                               
                                                            </ResourceDetailsData>             
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                $log_call_screen = 'Supplier - Add';

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

                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                        $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
                        $this->TravelSupplier->updateAll(array('TravelSupplier.wtb_status' => "'1'", 'TravelSupplier.is_update' => "'Y'"), array('TravelSupplier.id' => $SupplierId));
                    } else {

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                        $this->TravelSupplier->updateAll(array('TravelSupplier.wtb_status' => "'2'"), array('TravelSupplier.id' => $SupplierId));
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
            throw new NotFoundException(__('Invalid Supplier'));
        }

        $TravelSuppliers = $this->TravelSupplier->findById($id);

        if (!$TravelSuppliers) {
            throw new NotFoundException(__('Invalid Supplier'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelSupplier->set($this->data);
            if ($this->TravelSupplier->validates() == true) {

                $this->TravelSupplier->id = $id;
                if ($this->TravelSupplier->save($this->request->data)) {
                    $SupplierId = $id;
                    $ContinentId = $this->data['TravelSupplier']['continent_id'];
                    $CintinentName = $this->Common->getContinentName($ContinentId);
                    $CintinentCode = $this->Common->getContinentCode($ContinentId);
                    $CountryId = $this->data['TravelSupplier']['country_id'];
                    $CountryName = $this->Common->getCountryName($CountryId);
                    $CountryCode = $this->Common->getCountryCode($CountryId);
                    $SupplierCode = $this->data['TravelSupplier']['supplier_code'];
                    $SupplierName = $this->data['TravelSupplier']['supplier_name'];
                    $feed = $this->data['TravelSupplier']['feed'];
                    $this->request->data['TravelSupplier']['country_name'] = $CountryName;
                    $this->request->data['TravelSupplier']['country_code'] = $CountryCode;
                    $this->request->data['TravelSupplier']['continent_code'] = $CintinentCode;
                    $this->request->data['TravelSupplier']['continent_name'] = $CintinentName;
                    $Active = strtolower($TravelSuppliers['TravelSupplier']['active']);
                    $is_update = $TravelSuppliers['TravelSupplier']['is_update'];
                    if ($is_update == 'Y')
                        $actiontype = 'Update';
                    else
                        $actiontype = 'AddNew';

                    $Status = $TravelSuppliers['TravelSupplier']['status'];
                    if ($Status)
                        $Status = 'true';
                    else
                        $Status = 'false';

                    $WtbStatus = $TravelSuppliers['TravelSupplier']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';
                    
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Supplier</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="'.$actiontype.'">
                                                                <SupplierId>'.$SupplierId.'</SupplierId>
                                                                <SupplierCode>'.$SupplierCode.'</SupplierCode>
                                                                <SupplierName>'.$SupplierName.'</SupplierName>
                                                                 <Feed>'.$feed.'</Feed>   
                                                                <Active>'.$Active.'</Active>
                                                                <WtbStatus>'.$WtbStatus.'</WtbStatus>
                                                                
                                                                
                                                            </ResourceDetailsData>             
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                    $log_call_screen = 'Supplier - Edit';

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

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelSupplier->updateAll(array('TravelSupplier.wtb_status' => "'1'", 'TravelSupplier.is_update' => "'Y'"), array('TravelSupplier.id' => $SupplierId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelSupplier->updateAll(array('TravelSupplier.wtb_status' => "'2'"), array('TravelSupplier.id' => $SupplierId));
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
                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Supplier.', 'failure');
                }
            }
        }

        $TravelCountries = $this->TravelCountry->find('all', array(
                'conditions' => array(
                    'TravelCountry.continent_id' => $TravelSuppliers['TravelSupplier']['continent_id'],
                    'TravelCountry.country_status' => '1',
                    'TravelCountry.wtb_status' => '1',
                    'TravelCountry.active' => 'TRUE'
                ),
                'fields' => array('TravelCountry.id', 'TravelCountry.country_name', 'TravelCountry.country_code'),
                'order' => 'TravelCountry.country_name ASC'
            ));
       $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name')); 

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents','TravelCountries'));


        $this->request->data = $TravelSuppliers;
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

        $TravelSuppliers = $this->TravelSupplier->findById($id);

        if (!$TravelSuppliers) {
            throw new NotFoundException(__('Invalid Country'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelSupplier->set($this->data);
            if ($this->TravelSupplier->validates() == true) {

                if ($this->TravelSupplier->updateAll(array('TravelSupplier.active' => '"' . $this->data['TravelSupplier']['active'] . '"'), array('TravelSupplier.id' => $id))) {
                    $SupplierId = $id;
                    $SupplierCode = $TravelSuppliers['TravelSupplier']['supplier_code'];
                    $SupplierName = $TravelSuppliers['TravelSupplier']['supplier_name'];
                    
                   
                    $feed = $TravelSuppliers['TravelSupplier']['feed'];
                    $Active = strtolower($this->data['TravelSupplier']['active']);
                    
                    

                    $WtbStatus = $TravelSuppliers['TravelSupplier']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';
                   
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
                     if ($is_update == 'Y')
                            $actiontype = 'Update';
                        else
                            $actiontype = 'AddNew';

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Supplier</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceDetailsData srno="1" actiontype="'.$actiontype.'">
                                                                <SupplierId>'.$SupplierId.'</SupplierId>
                                                                <SupplierCode>'.$SupplierCode.'</SupplierCode>
                                                                <SupplierName>'.$SupplierName.'</SupplierName>
                                                                <Feed>'.$feed.'</Feed>
                                                                <Active>'.$Active.'</Active>
                                                                <WtbStatus>'.$WtbStatus.'</WtbStatus>
                                                                
                                                                
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

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelSupplier->updateAll(array('TravelSupplier.wtb_status' => "'1'", 'TravelSupplier.is_update' => "'Y'"), array('TravelSupplier.id' => $SupplierId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelSupplier->updateAll(array('TravelSupplier.wtb_status' => "'2'"), array('TravelSupplier.id' => $SupplierId));
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

                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Supplier.', 'failure');
                }
            }
        }

        $Types = array($type);
        $TravelCountries = $this->TravelCountry->find('all', array(
                'conditions' => array(
                    'TravelCountry.continent_id' => $TravelSuppliers['TravelSupplier']['continent_id'],
                    'TravelCountry.country_status' => '1',
                    'TravelCountry.wtb_status' => '1',
                    'TravelCountry.active' => 'TRUE'
                ),
                'fields' => array('TravelCountry.id', 'TravelCountry.country_name', 'TravelCountry.country_code'),
                'order' => 'TravelCountry.country_name ASC'
            ));
       $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name')); 

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents', 'Types','TravelCountries'));

        $this->request->data = $TravelSuppliers;
    }

    public function retry($id = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if (!$id) {
            throw new NotFoundException(__('Invalid Country'));
        }

        $TravelSuppliers = $this->TravelSupplier->findById($id);

        if (!$TravelSuppliers) {
            throw new NotFoundException(__('Invalid Country'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            $SupplierId = $id;
            $SupplierCode = $TravelSuppliers['TravelSupplier']['supplier_code'];
            $SupplierName = $TravelSuppliers['TravelSupplier']['supplier_name'];
            $Active = strtolower($TravelSuppliers['TravelSupplier']['active']);
            $feed = $TravelSuppliers['TravelSupplier']['feed'];
            

            $WtbStatus = $TravelSuppliers['TravelSupplier']['wtb_status'];
            if ($WtbStatus)
                $WtbStatus = 'true';
            else
                $WtbStatus = 'false';
            
            $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

            $is_update = $TravelSuppliers['TravelSupplier']['is_update'];
            if ($is_update == 'Y')
                $actiontype = 'Update';
            else
                $actiontype = 'AddNew';

            $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Supplier</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                        <ResourceDetailsData srno="1" actiontype="'.$actiontype.'">
                                                                <SupplierId>'.$SupplierId.'</SupplierId>
                                                                <SupplierCode>'.$SupplierCode.'</SupplierCode>
                                                                <SupplierName>'.$SupplierName.'</SupplierName>
                                                                <Feed>'.$feed.'</Feed>
                                                                <Active>'.$Active.'</Active>
                                                                <WtbStatus>'.$WtbStatus.'</WtbStatus>
                                                                
                                                                
                                                            </ResourceDetailsData>
                                                                       
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


            $log_call_screen = 'Supplier - Re-try';

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

                if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                    $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                    $this->TravelSupplier->updateAll(array('TravelSupplier.wtb_status' => "'1'", 'TravelSupplier.is_update' => "'Y'"), array('TravelSupplier.id' => $SupplierId));
                } else {

                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_SUPPLIER']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                    $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                    $this->TravelSupplier->updateAll(array('TravelSupplier.wtb_status' => "'2'"), array('TravelSupplier.id' => $SupplierId));
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
            $this->redirect(array('action' => 'index'));
        }

        $TravelCountries = $this->TravelCountry->find('all', array(
                'conditions' => array(
                    'TravelCountry.continent_id' => $TravelSuppliers['TravelSupplier']['continent_id'],
                    'TravelCountry.country_status' => '1',
                    'TravelCountry.wtb_status' => '1',
                    'TravelCountry.active' => 'TRUE'
                ),
                'fields' => array('TravelCountry.id', 'TravelCountry.country_name', 'TravelCountry.country_code'),
                'order' => 'TravelCountry.country_name ASC'
            ));
       $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name')); 
       
        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents','TravelCountries'));

        $this->request->data = $TravelSuppliers;
    }

}