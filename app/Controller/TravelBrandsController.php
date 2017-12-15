<?php

/**
 * TravelBrand controller.
 *
 * This file will render views from views/TravelBrands/
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
 * TravelBrand controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TravelBrandsController extends AppController {

    var $uses = array('TravelBrand', 'TravelCountry', 'TravelCity', 'TravelChain', 'TravelLookupBrandPresence', 'TravelLookupBrandSegment', 'LogCall');

    public function index() {


        $search_condition = array();
        $brand_name = '';
        $brand_country = '';

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['TravelBrand']['brand_name'])) {
                $brand_name = $this->data['TravelBrand']['brand_name'];
                array_push($search_condition, array("TravelBrand.brand_name LIKE '%$brand_name%'"));
            }

            if (!empty($this->data['TravelBrand']['brand_country_id'])) {
                $brand_country = $this->data['TravelBrand']['brand_country_id'];
                array_push($search_condition, array('TravelBrand.brand_country_id' => $brand_country));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['brand_name'])) {
                $brand_name = $this->request->params['named']['brand_name'];
                array_push($search_condition, array("TravelBrand.brand_name LIKE '%$brand_name%'"));
            }

            if (!empty($this->request->params['named']['brand_country_id'])) {
                $brand_country = $this->request->params['named']['brand_country_id'];
                array_push($search_condition, array('TravelBrand.brand_country_id' => $brand_country));
            }
        }
        $this->paginate['order'] = array('TravelBrand.brand_name' => 'asc');
        $this->set('TravelBrands', $this->paginate("TravelBrand", $search_condition));


        if (!isset($this->passedArgs['brand_name']) && empty($this->passedArgs['brand_name'])) {
            $this->passedArgs['brand_name'] = (isset($this->data['TravelBrand']['brand_name'])) ? $this->data['TravelBrand']['brand_name'] : '';
        }
        if (!isset($this->passedArgs['brand_country']) && empty($this->passedArgs['brand_country'])) {
            $this->passedArgs['brand_country'] = (isset($this->data['TravelBrand']['brand_country'])) ? $this->data['TravelBrand']['brand_country'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {

            $this->data['TravelBrand']['brand_name'] = $this->passedArgs['brand_name'];
            $this->data['TravelBrand']['brand_country'] = $this->passedArgs['brand_country'];
        }

        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));

        $this->set(compact('brand_country'));
        $this->set(compact('brand_name'));
    }

    public function add() {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if ($this->request->is('post')) {

            $this->request->data['TravelBrand']['created_by'] = $user_id;
            $this->request->data['TravelBrand']['brand_status'] = '1';
            $this->request->data['TravelBrand']['wtb_status'] = '1';
            $this->request->data['TravelBrand']['brand_active'] = 'TRUE';
            $this->TravelBrand->create();
            if ($this->TravelBrand->save($this->request->data)) {
                $BrandId = $this->TravelBrand->getLastInsertId();
                $BrandOwnerCompany = $this->data['TravelBrand']['brand_owner_company'];
                $BrandName = $this->data['TravelBrand']['brand_name'];
                $BrandChainId = $this->data['TravelBrand']['brand_chain_id'];
                $BrandChainName = $this->data['TravelBrand']['brand_chain_name'];
                $BrandHQCityId = $this->data['TravelBrand']['brand_hq_city_id'];
                $BrandHQCityName = $this->data['TravelBrand']['brand_hq_city_name'];
                $BrandCountryId = $this->data['TravelBrand']['brand_country_id'];
                $BrandCountryName = $this->data['TravelBrand']['brand_country_name'];
                $BrandPresence = $this->data['TravelBrand']['brand_presence'];
                $BrandSegment = $this->data['TravelBrand']['brand_segment'];
                $BrandDescription = $this->data['TravelBrand']['description'];
                $BrandStatus = 'true';
                $WtbStatus = 'true';
                $TopBrand = strtolower($this->data['TravelBrand']['top_brand']);
                $BrandActive = 'true';
                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Brand</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="AddNew">
                                                                <BrandId>' . $BrandId . '</BrandId>
                                                                <BrandCode>NA</BrandCode>
                                                                <BrandName>' . $BrandName . '</BrandName>
                                                                <BrandOwnerCompany>' . $BrandOwnerCompany . '</BrandOwnerCompany>
                                                                <BrandChainId>' . $BrandChainId . '</BrandChainId>
                                                                <BrandChainCode>NA</BrandChainCode>
                                                                <BrandChainName>' . $BrandChainName . '</BrandChainName>                              
                                                                <BrandHQCityId>' . $BrandHQCityId . '</BrandHQCityId>                              
                                                                <BrandHQCityName>' . $BrandHQCityName . '</BrandHQCityName>
                                                                <BrandCountryId>' . $BrandCountryId . '</BrandCountryId>                              
                                                                <BrandCountryName>' . $BrandCountryName . '</BrandCountryName>                              
                                                                <BrandPresence>' . $BrandPresence . '</BrandPresence>
                                                                <BrandSegment>' . $BrandSegment . '</BrandSegment>
                                                                <BrandStatus>' . $BrandStatus . '</BrandStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <BrandActive>' . $BrandActive . '</BrandActive>
                                                                <TopBrand>' . $TopBrand . '</TopBrand>
                                                                <BrandDescription>' . $BrandDescription . '</BrandDescription>
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


                $log_call_screen = 'Brand - Add';

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

                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                        $xml_msg = "Foreign record has been successfully added [Code:$log_call_status_code]";
                        $this->TravelBrand->updateAll(array('TravelBrand.wtb_status' => "'1'", 'TravelBrand.is_update' => "'Y'"), array('TravelBrand.id' => $BrandId));
                    } else {

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                        $xml_msg = "There was a problem with foreign record addition [Code:$log_call_status_code]";
                        $this->TravelBrand->updateAll(array('TravelBrand.wtb_status' => "'2'"), array('TravelBrand.id' => $BrandId));
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
                $message = 'Local record has been successfully added.<br />' . $xml_msg;
                $this->Session->setFlash($message, 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add Brand.', 'failure');
            }
        }



        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id, country_name', 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));

        $TravelChains = $this->TravelChain->find('list', array('fields' => 'id, chain_name', 'order' => 'chain_name ASC'));
        $this->set(compact('TravelChains'));

        $TravelLookupBrandPresences = $this->TravelLookupBrandPresence->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupBrandPresences'));

        $TravelLookupBrandSegments = $this->TravelLookupBrandSegment->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupBrandSegments'));
    }

    public function edit($id = null, $mode = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $id = base64_decode($id);
        $this->set(compact('mode'));
        $xml_error = 'FALSE';

        if (!$id) {
            throw new NotFoundException(__('Invalid Brand'));
        }

        $TravelBrands = $this->TravelBrand->findById($id);

        if (!$TravelBrands) {
            throw new NotFoundException(__('Invalid Brand'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelBrand->set($this->data);
            if ($this->TravelBrand->validates() == true) {

                $this->TravelBrand->id = $id;
                if ($this->TravelBrand->save($this->request->data)) {
                    $BrandId = $id;
                    $BrandOwnerCompany = $this->data['TravelBrand']['brand_owner_company'];
                    $BrandName = $this->data['TravelBrand']['brand_name'];
                    $BrandChainId = $this->data['TravelBrand']['brand_chain_id'];
                    $BrandChainName = $this->data['TravelBrand']['brand_chain_name'];
                    $BrandHQCityId = $this->data['TravelBrand']['brand_hq_city_id'];
                    $BrandHQCityName = $this->data['TravelBrand']['brand_hq_city_name'];
                    $BrandCountryId = $this->data['TravelBrand']['brand_country_id'];
                    $BrandCountryName = $this->data['TravelBrand']['brand_country_name'];
                    $BrandPresence = $this->data['TravelBrand']['brand_presence'];
                    $BrandSegment = $this->data['TravelBrand']['brand_segment'];
                    $BrandDescription = $this->data['TravelBrand']['description'];
                    $BrandStatus = $TravelBrands['TravelBrand']['brand_status'];
                    if ($BrandStatus)
                        $BrandStatus = 'true';
                    else
                        $BrandStatus = 'false';

                    $WtbStatus = $TravelBrands['TravelBrand']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';
                    $TopBrand = strtolower($this->data['TravelBrand']['top_brand']);
                    $BrandActive = strtolower($TravelBrands['TravelBrand']['brand_active']);
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Brand</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <BrandId>' . $BrandId . '</BrandId>
                                                                <BrandCode>NA</BrandCode>
                                                                <BrandName>' . $BrandName . '</BrandName>
                                                                <BrandOwnerCompany>' . $BrandOwnerCompany . '</BrandOwnerCompany>
                                                                <BrandChainId>' . $BrandChainId . '</BrandChainId>
                                                                <BrandChainCode>NA</BrandChainCode>
                                                                <BrandChainName>' . $BrandChainName . '</BrandChainName>                              
                                                                <BrandHQCityId>' . $BrandHQCityId . '</BrandHQCityId>                              
                                                                <BrandHQCityName>' . $BrandHQCityName . '</BrandHQCityName>
                                                                <BrandCountryId>' . $BrandCountryId . '</BrandCountryId>                              
                                                                <BrandCountryName>' . $BrandCountryName . '</BrandCountryName>                              
                                                                <BrandPresence>' . $BrandPresence . '</BrandPresence>
                                                                <BrandSegment>' . $BrandSegment . '</BrandSegment>
                                                                <BrandStatus>' . $BrandStatus . '</BrandStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <BrandActive>' . $BrandActive . '</BrandActive>
                                                                <TopBrand>' . $TopBrand . '</TopBrand>
                                                                <BrandDescription>' . $BrandDescription . '</BrandDescription>
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


                    $log_call_screen = 'Brand - Edit';

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

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelBrand->updateAll(array('TravelBrand.wtb_status' => "'1'"), array('TravelBrand.id' => $BrandId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelBrand->updateAll(array('TravelBrand.wtb_status' => "'2'"), array('TravelBrand.id' => $BrandId));
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
                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Brand.', 'failure');
                }
            }
        }


        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));

        $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $TravelBrands['TravelBrand']['brand_country_id'], 'city_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'city_name ASC'));
        $this->set(compact('TravelCities'));

        $TravelChains = $this->TravelChain->find('list', array('fields' => 'id, chain_name', 'conditions' => array(
                'TravelChain.chain_hq_city_id' => $TravelBrands['TravelBrand']['brand_hq_city_id'],
                'TravelChain.chain_status' => '1',
                'TravelChain.wtb_status' => '1',
                'TravelChain.chain_active' => 'TRUE'
            ), 'order' => 'chain_name ASC'));

        $this->set(compact('TravelChains'));

        $TravelLookupBrandPresences = $this->TravelLookupBrandPresence->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupBrandPresences'));

        $TravelLookupBrandSegments = $this->TravelLookupBrandSegment->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupBrandSegments'));

        $this->request->data = $TravelBrands;
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
            throw new NotFoundException(__('Invalid Brand'));
        }

        $TravelBrands = $this->TravelBrand->findById($id);

        if (!$TravelBrands) {
            throw new NotFoundException(__('Invalid Brand'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelBrand->set($this->data);
            if ($this->TravelBrand->validates() == true) {

                if ($this->TravelBrand->updateAll(array('TravelBrand.brand_active' => '"' . $this->data['TravelBrand']['brand_active'] . '"'), array('TravelBrand.id' => $id))) {
                    $BrandId = $id;
                    $BrandOwnerCompany = $TravelBrands['TravelBrand']['brand_owner_company'];
                    $BrandName = $TravelBrands['TravelBrand']['brand_name'];
                    $BrandChainId = $TravelBrands['TravelBrand']['brand_chain_id'];
                    $BrandChainName = $TravelBrands['TravelBrand']['brand_chain_name'];
                    $BrandHQCityId = $TravelBrands['TravelBrand']['brand_hq_city_id'];
                    $BrandHQCityName = $TravelBrands['TravelBrand']['brand_hq_city_name'];
                    $BrandCountryId = $TravelBrands['TravelBrand']['brand_country_id'];
                    $BrandCountryName = $TravelBrands['TravelBrand']['brand_country_name'];
                    $BrandPresence = $TravelBrands['TravelBrand']['brand_presence'];
                    $BrandSegment = $TravelBrands['TravelBrand']['brand_segment'];
                    $BrandDescription = $TravelBrands['TravelBrand']['description'];
                    $BrandStatus = $TravelBrands['TravelBrand']['brand_status'];
                    if ($BrandStatus)
                        $BrandStatus = 'true';
                    else
                        $BrandStatus = 'false';

                    $WtbStatus = $TravelBrands['TravelBrand']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';
                    $TopBrand = strtolower($TravelBrands['TravelBrand']['top_brand']);
                    $BrandActive = strtolower($this->data['TravelBrand']['brand_active']);
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Brand</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <BrandId>' . $BrandId . '</BrandId>
                                                                <BrandCode>NA</BrandCode>
                                                                <BrandName>' . $BrandName . '</BrandName>
                                                                <BrandOwnerCompany>' . $BrandOwnerCompany . '</BrandOwnerCompany>
                                                                <BrandChainId>' . $BrandChainId . '</BrandChainId>
                                                                <BrandChainCode>NA</BrandChainCode>
                                                                <BrandChainName>' . $BrandChainName . '</BrandChainName>                              
                                                                <BrandHQCityId>' . $BrandHQCityId . '</BrandHQCityId>                              
                                                                <BrandHQCityName>' . $BrandHQCityName . '</BrandHQCityName>
                                                                <BrandCountryId>' . $BrandCountryId . '</BrandCountryId>                              
                                                                <BrandCountryName>' . $BrandCountryName . '</BrandCountryName>                              
                                                                <BrandPresence>' . $BrandPresence . '</BrandPresence>
                                                                <BrandSegment>' . $BrandSegment . '</BrandSegment>
                                                                <BrandStatus>' . $BrandStatus . '</BrandStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <BrandActive>' . $BrandActive . '</BrandActive>
                                                                <TopBrand>' . $TopBrand . '</TopBrand>
                                                                <BrandDescription>' . $BrandDescription . '</BrandDescription>
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


                    $log_call_screen = 'Brand - ' . $ACTIVE_MSG;

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

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelBrand->updateAll(array('TravelBrand.wtb_status' => "'1'"), array('TravelBrand.id' => $BrandId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelBrand->updateAll(array('TravelBrand.wtb_status' => "'2'"), array('TravelBrand.id' => $BrandId));
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
                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Brand.', 'failure');
                }
            }
        }

        $Types = array($type);

        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries', 'Types'));

        $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $TravelBrands['TravelBrand']['brand_country_id'], 'city_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'city_name ASC'));
        $this->set(compact('TravelCities'));

        $TravelChains = $this->TravelChain->find('list', array('fields' => 'id, chain_name', 'order' => 'chain_name ASC'));
        $this->set(compact('TravelChains'));

        $TravelLookupBrandPresences = $this->TravelLookupBrandPresence->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupBrandPresences'));

        $TravelLookupBrandSegments = $this->TravelLookupBrandSegment->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupBrandSegments'));

        $this->request->data = $TravelBrands;
    }

    public function retry($id = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if (!$id) {
            throw new NotFoundException(__('Invalid Brand'));
        }

        $TravelBrands = $this->TravelBrand->findById($id);

        if (!$TravelBrands) {
            throw new NotFoundException(__('Invalid Brand'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

            $BrandId = $id;
            $BrandOwnerCompany = $TravelBrands['TravelBrand']['brand_owner_company'];
            $BrandName = $TravelBrands['TravelBrand']['brand_name'];
            $BrandChainId = $TravelBrands['TravelBrand']['brand_chain_id'];
            $BrandChainName = $TravelBrands['TravelBrand']['brand_chain_name'];
            $BrandHQCityId = $TravelBrands['TravelBrand']['brand_hq_city_id'];
            $BrandHQCityName = $TravelBrands['TravelBrand']['brand_hq_city_name'];
            $BrandCountryId = $TravelBrands['TravelBrand']['brand_country_id'];
            $BrandCountryName = $TravelBrands['TravelBrand']['brand_country_name'];
            $BrandPresence = $TravelBrands['TravelBrand']['brand_presence'];
            $BrandSegment = $TravelBrands['TravelBrand']['brand_segment'];
            $BrandDescription = $TravelBrands['TravelBrand']['description'];
            $BrandStatus = $TravelBrands['TravelBrand']['brand_status'];
            if ($BrandStatus)
                $BrandStatus = 'true';
            else
                $BrandStatus = 'false';

            $WtbStatus = $TravelBrands['TravelBrand']['wtb_status'];
            if ($WtbStatus)
                $WtbStatus = 'true';
            else
                $WtbStatus = 'false';
            $TopBrand = strtolower($TravelBrands['TravelBrand']['top_brand']);
            $BrandActive = strtolower($TravelBrands['TravelBrand']['brand_active']);
            $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
            $is_update = $TravelBrands['TravelBrand']['is_update'];
            if ($is_update == 'Y')
                $actiontype = 'Update';
            else
                $actiontype = 'AddNew';

            $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Brand</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">
                                                                <BrandId>' . $BrandId . '</BrandId>
                                                                <BrandCode>NA</BrandCode>
                                                                <BrandName>' . $BrandName . '</BrandName>
                                                                <BrandOwnerCompany>' . $BrandOwnerCompany . '</BrandOwnerCompany>
                                                                <BrandChainId>' . $BrandChainId . '</BrandChainId>
                                                                <BrandChainCode>NA</BrandChainCode>
                                                                <BrandChainName>' . $BrandChainName . '</BrandChainName>                              
                                                                <BrandHQCityId>' . $BrandHQCityId . '</BrandHQCityId>                              
                                                                <BrandHQCityName>' . $BrandHQCityName . '</BrandHQCityName>
                                                                <BrandCountryId>' . $BrandCountryId . '</BrandCountryId>                              
                                                                <BrandCountryName>' . $BrandCountryName . '</BrandCountryName>                              
                                                                <BrandPresence>' . $BrandPresence . '</BrandPresence>
                                                                <BrandSegment>' . $BrandSegment . '</BrandSegment>
                                                                <BrandStatus>' . $BrandStatus . '</BrandStatus>
                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>
                                                                <BrandActive>' . $BrandActive . '</BrandActive>
                                                                <TopBrand>' . $TopBrand . '</TopBrand>
                                                                <BrandDescription>' . $BrandDescription . '</BrandDescription>
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


            $log_call_screen = 'Brand - Re-try';

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

                if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                    $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                    $this->TravelBrand->updateAll(array('TravelBrand.wtb_status' => "'1'", 'TravelBrand.is_update' => "'Y'"), array('TravelBrand.id' => $BrandId));
                } else {

                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_BRAND']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                    $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                    $this->TravelBrand->updateAll(array('TravelBrand.wtb_status' => "'2'"), array('TravelBrand.id' => $BrandId));
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


        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));

        $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $TravelBrands['TravelBrand']['brand_country_id'], 'city_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'city_name ASC'));
        $this->set(compact('TravelCities'));

        $TravelChains = $this->TravelChain->find('list', array('fields' => 'id, chain_name', 'order' => 'chain_name ASC'));
        $this->set(compact('TravelChains'));

        $TravelLookupBrandPresences = $this->TravelLookupBrandPresence->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupBrandPresences'));

        $TravelLookupBrandSegments = $this->TravelLookupBrandSegment->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));
        $this->set(compact('TravelLookupBrandSegments'));

        $this->request->data = $TravelBrands;
    }

}

