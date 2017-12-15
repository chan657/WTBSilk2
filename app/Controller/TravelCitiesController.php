<?php

/**
 * TravelCity controller.
 *
 * This file will render views from views/TravelCities/
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
 * TravelCity controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TravelCitiesController extends AppController {

    var $uses = array('TravelCountry', 'TravelCity', 'TravelLookupContinent', 'LogCall', 'TravelCitySupplier', 'User','Province');

    public function index() {

        $search_condition = array();
        $TravelCountries = array();
        $city_name = '';
        $continent_id = '';
        $country_id = '';
        $city_status = '';
        $wtb_status = '';
        $active = '';


        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['TravelCity']['city_name'])) {
                $city_name = $this->data['TravelCity']['city_name'];
                array_push($search_condition, array("TravelCity.city_name LIKE '%$city_name%'"));
            }
            if (!empty($this->data['TravelCity']['continent_id'])) {
                $continent_id = $this->data['TravelCity']['continent_id'];
                $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $continent_id, 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
                array_push($search_condition, array('TravelCity.continent_id' => $continent_id));
            }

            if (!empty($this->data['TravelCity']['country_id'])) {
                $country_id = $this->data['TravelCity']['country_id'];
                array_push($search_condition, array('TravelCity.country_id' => $country_id));
            }
            if (!empty($this->data['TravelCity']['city_status'])) {
                $city_status = $this->data['TravelCity']['city_status'];
                array_push($search_condition, array('TravelCity.city_status' => $city_status));
            }
            if (!empty($this->data['TravelCity']['wtb_status'])) {
                $wtb_status = $this->data['TravelCity']['wtb_status'];
                array_push($search_condition, array('TravelCity.wtb_status' => $wtb_status));
            }
            if (!empty($this->data['TravelCity']['active'])) {
                $active = $this->data['TravelCity']['active'];
                array_push($search_condition, array('TravelCity.active' => $active));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['city_name'])) {
                $city_name = $this->request->params['named']['city_name'];
                array_push($search_condition, array("TravelCity.city_name LIKE '%$city_name%'"));
            }
            if (!empty($this->request->params['named']['continent_id'])) {
                $continent_id = $this->request->params['named']['continent_id'];
                $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $continent_id, 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
                array_push($search_condition, array('TravelCity.continent_id' => $continent_id));
            }

            if (!empty($this->request->params['named']['country_id'])) {
                $country_id = $this->request->params['named']['country_id'];
                array_push($search_condition, array('TravelCity.country_id' => $country_id));
            }
            if (!empty($this->request->params['named']['city_status'])) {
                $city_status = $this->request->params['named']['city_status'];
                array_push($search_condition, array('TravelCity.city_status' => $city_status));
            }
            if (!empty($this->request->params['named']['wtb_status'])) {
                $wtb_status = $this->request->params['named']['wtb_status'];
                array_push($search_condition, array('TravelCity.wtb_status' => $wtb_status));
            }
            if (!empty($this->request->params['named']['active'])) {
                $active = $this->request->params['named']['active'];
                array_push($search_condition, array('TravelCity.active' => $active));
            }
        }
        $this->paginate['order'] = array('TravelCity.city_name' => 'asc');
        $this->set('TravelCities', $this->paginate("TravelCity", $search_condition));

        //$log = $this->TravelHotelLookup->getDataSource()->getLog(false, false);       
        //debug($log);


        if (!isset($this->passedArgs['city_name']) && empty($this->passedArgs['city_name'])) {
            $this->passedArgs['city_name'] = (isset($this->data['TravelCity']['city_name'])) ? $this->data['TravelCity']['city_name'] : '';
        }
        if (!isset($this->passedArgs['continent_id']) && empty($this->passedArgs['continent_id'])) {
            $this->passedArgs['continent_id'] = (isset($this->data['TravelCity']['continent_id'])) ? $this->data['TravelCity']['continent_id'] : '';
        }
        if (!isset($this->passedArgs['country_id']) && empty($this->passedArgs['country_id'])) {
            $this->passedArgs['country_id'] = (isset($this->data['TravelCity']['country_id'])) ? $this->data['TravelCity']['country_id'] : '';
        }
        if (!isset($this->passedArgs['city_status']) && empty($this->passedArgs['city_status'])) {
            $this->passedArgs['city_status'] = (isset($this->data['TravelCity']['city_status'])) ? $this->data['TravelCity']['city_status'] : '';
        }
        if (!isset($this->passedArgs['wtb_status']) && empty($this->passedArgs['wtb_status'])) {
            $this->passedArgs['wtb_status'] = (isset($this->data['TravelCity']['wtb_status'])) ? $this->data['TravelCity']['wtb_status'] : '';
        }
        if (!isset($this->passedArgs['active']) && empty($this->passedArgs['active'])) {
            $this->passedArgs['active'] = (isset($this->data['TravelCity']['active'])) ? $this->data['TravelCity']['active'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {

            $this->data['TravelCity']['city_name'] = $this->passedArgs['city_name'];
            $this->data['TravelCity']['continent_id'] = $this->passedArgs['continent_id'];
            $this->data['TravelCity']['country_id'] = $this->passedArgs['country_id'];
            $this->data['TravelCity']['city_status'] = $this->passedArgs['city_status'];
            $this->data['TravelCity']['wtb_status'] = $this->passedArgs['wtb_status'];
            $this->data['TravelCity']['active'] = $this->passedArgs['active'];
        }


        $this->set(compact('TravelCountries'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));

        $this->set(compact('city_name'));
        $this->set(compact('country_id'));
        $this->set(compact('continent_id'));
        $this->set(compact('city_status'));
        $this->set(compact('wtb_status'));
        $this->set(compact('active'));
    }

    public function add() {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if ($this->request->is('post')) {

            $this->request->data['TravelCity']['created_by'] = $user_id;
            $this->request->data['TravelCity']['city_status'] = '1';
            $this->request->data['TravelCity']['wtb_status'] = '1';
            $this->request->data['TravelCity']['active'] = 'TRUE';
            $this->TravelCity->create();
            if ($this->TravelCity->save($this->request->data)) {
                $CityId = $this->TravelCity->getLastInsertId();
                $CityName = $this->data['TravelCity']['city_name'];
                $CityCode = $this->data['TravelCity']['city_code'];               
                $CountryId = $this->data['TravelCity']['country_id'];
                $CountryCode = $this->data['TravelCity']['country_code'];
                $CountryName = $this->data['TravelCity']['country_name'];
                $ContinentId = $this->data['TravelCity']['continent_id'];
                $ContinentName = $this->data['TravelCity']['continent_name'];
                $ProvinceId = $this->data['TravelCity']['province_id'];
                $ProvinceName = $this->data['TravelCity']['province_name'];
                $CityDescription = $this->data['TravelCity']['city_description'];
                $TopCity = strtolower($this->data['TravelCity']['top_city']);
                $Active = 'true';

                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_City</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="AddNew">
                                                                <CityId>' . $CityId . '</CityId>
                                                                <CityCode><![CDATA[' . $CityCode . ']]></CityCode>
                                                                <CityName><![CDATA[' . $CityName . ']]></CityName>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode><![CDATA['.$CountryCode.']]></CountryCode>
                                                                <CountryName><![CDATA[' . $CountryName . ']]></CountryName>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName><![CDATA[' . $ContinentName . ']]></ContinentName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>
                                                                <RegionId></RegionId>
                                                                <CityNameJP></CityNameJP>
                                                                <CityNameFR></CityNameFR>
                                                                <CityNameDE>NA</CityNameDE>
                                                                <CityNameCN>NA</CityNameCN>
                                                                <CityNameCNT>NA</CityNameCNT>
                                                                <CityNameIT>NA</CityNameIT>
                                                                <CityNameES>NA</CityNameES>
                                                                <CityNameKR>NA</CityNameKR>
                                                                <CityNameTEMP1>NA</CityNameTEMP1>
                                                                <CityNameTEMP2>NA</CityNameTEMP2>
                                                                <CityNameTEMP3>NA</CityNameTEMP3>
                                                                <City_Keyword>NA</City_Keyword>
                                                                <CityURL>NA</CityURL>
                                                                <CityNameURL>NA</CityNameURL>
                                                                <CityURLTEMP1>NA</CityURLTEMP1>
                                                                <CityURLTEMP2>NA</CityURLTEMP2>
                                                                <CityURLTEMP3>NA</CityURLTEMP3>
                                                                <CityDomainName>NA</CityDomainName>
                                                                <CityTitle>NA</CityTitle>
                                                                <CityDescription><![CDATA['.$CityDescription.']]></CityDescription>
                                                                <CityKeyword>NA</CityKeyword>
                                                                <ActiveMap>false</ActiveMap>
                                                                <ActiveGuide>false</ActiveGuide>
                                                                <IsUpdated>0</IsUpdated>
                                                                <PFTActive>1</PFTActive>
                                                                <SSActive>true</SSActive>
                                                                <TopDestination>true</TopDestination>
                                                                <StateCode>NA</StateCode>
                                                                <IsXML>true</IsXML>
                                                                <Active>' . $Active . '</Active>
                                                                <TopCity>NA</TopCity>
                                                                <Status>true</Status>
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


                $log_call_screen = 'City - Add';

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
                    // die;

                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                        $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
                        $this->TravelCity->updateAll(array('TravelCity.wtb_status' => "'1'", 'TravelCity.is_update' => "'Y'"), array('TravelCity.id' => $CityId));
                    } else {

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                        $this->TravelCity->updateAll(array('TravelCity.wtb_status' => "'2'"), array('TravelCity.id' => $CityId));
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
                if ($xml_error == 'TRUE') {
                    $Email = new CakeEmail();

                    $Email->viewVars(array(
                        'request_xml' => trim($xml_string),
                        'respon_message' => $log_call_status_message,
                        'respon_code' => $log_call_status_code,
                    ));

                    $to = 'biswajit@wtbglobal.com';
                    $cc = 'infra@sumanus.com';

                    $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date('d/m/y H:i:s') . ']')->send();
                }


                $message = 'Local record has been successfully added.<br />' . $xml_msg;
                $this->Session->setFlash($message, 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add City.', 'failure');
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
            throw new NotFoundException(__('Invalid City'));
        }

        $TravelCities = $this->TravelCity->findById($id);

        if (!$TravelCities) {
            throw new NotFoundException(__('Invalid City'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelCity->set($this->data);
            if ($this->TravelCity->validates() == true) {

                $this->TravelCity->id = $id;
                if ($this->TravelCity->save($this->request->data)) {
                    $CityId = $id;
                    $CityName = $this->data['TravelCity']['city_name'];
                    $CityCode = $this->data['TravelCity']['city_code'];                   
                    $CountryId = $this->data['TravelCity']['country_id'];
                    $CountryCode = $this->data['TravelCity']['country_code'];
                    $CountryName = $this->data['TravelCity']['country_name'];
                    $ContinentId = $this->data['TravelCity']['continent_id'];
                    $ProvinceId = $this->data['TravelCity']['province_id'];
                    $ProvinceName = $this->data['TravelCity']['province_name'];
                    $ContinentName = $this->data['TravelCity']['continent_name'];
                    $CityDescription = $this->data['TravelCity']['city_description'];
                    $TopCity = strtolower($this->data['TravelCity']['top_city']);
                    $Active = strtolower($TravelCities['TravelCity']['active']);
                    $is_update = $TravelCities['TravelCity']['is_update'];
                    if ($is_update == 'Y')
                        $actiontype = 'Update';
                    else
                        $actiontype = 'AddNew';
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_City</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">
                                                                <CityId>' . $CityId . '</CityId>
                                                                <CityCode><![CDATA[' . $CityCode . ']]></CityCode>
                                                                <CityName><![CDATA[' . $CityName . ']]></CityName>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode><![CDATA['.$CountryCode.']]></CountryCode>
                                                                <CountryName><![CDATA[' . $CountryName . ']]></CountryName>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName><![CDATA[' . $ContinentName . ']]></ContinentName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>
                                                                <RegionId></RegionId>
                                                                <CityNameJP></CityNameJP>
                                                                <CityNameFR></CityNameFR>
                                                                <CityNameDE>NA</CityNameDE>
                                                                <CityNameCN>NA</CityNameCN>
                                                                <CityNameCNT>NA</CityNameCNT>
                                                                <CityNameIT>NA</CityNameIT>
                                                                <CityNameES>NA</CityNameES>
                                                                <CityNameKR>NA</CityNameKR>
                                                                <CityNameTEMP1>NA</CityNameTEMP1>
                                                                <CityNameTEMP2>NA</CityNameTEMP2>
                                                                <CityNameTEMP3>NA</CityNameTEMP3>
                                                                <City_Keyword>NA</City_Keyword>
                                                                <CityURL>NA</CityURL>
                                                                <CityNameURL>NA</CityNameURL>
                                                                <CityURLTEMP1>NA</CityURLTEMP1>
                                                                <CityURLTEMP2>NA</CityURLTEMP2>
                                                                <CityURLTEMP3>NA</CityURLTEMP3>
                                                                <CityDomainName>NA</CityDomainName>
                                                                <CityTitle>NA</CityTitle>
                                                                <CityDescription><![CDATA['.$CityDescription.']]></CityDescription>
                                                                <CityKeyword>NA</CityKeyword>
                                                                <ActiveMap>false</ActiveMap>
                                                                <ActiveGuide>false</ActiveGuide>
                                                                <IsUpdated>0</IsUpdated>
                                                                <PFTActive>1</PFTActive>
                                                                <SSActive>true</SSActive>
                                                                <TopDestination>true</TopDestination>
                                                                <StateCode>NA</StateCode>
                                                                <IsXML>true</IsXML>
                                                                <Active>' . $Active . '</Active>
                                                                <TopCity>' . $TopCity . '</TopCity>
                                                                <Status>true</Status>
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


                    $log_call_screen = 'City - Edit';

                    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                    $client = new SoapClient(null, array(
                        'location' => $location_URL,
                        'uri' => '',
                        'trace' => 1,
                    ));

                    try {
                        $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                        $xml_arr = $this->xml2array($order_return);
                        //   echo htmlentities($xml_string);
                        //   pr($xml_arr);
                        //   die;

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelCity->updateAll(array('TravelCity.wtb_status' => "'1'", 'TravelCity.is_update' => "'Y'"), array('TravelCity.id' => $CityId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelCity->updateAll(array('TravelCity.wtb_status' => "'2'"), array('TravelCity.id' => $CityId));
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
                    /*                     * *
                     * City mapping table
                     * 
                     */
                    $xml_error = 'FALSE';

                    $arrs = $this->TravelCitySupplier->find('all', array('conditions' => array('TravelCitySupplier.city_id' => $CityId)));
                    if (count($arrs) > 0) {
                        foreach ($arrs as $val) {
                            $Id = $val['TravelCitySupplier']['id'];
                            $this->request->data['TravelCitySupplier']['city_name'] = "'" . $CityName . "'";
                            $this->request->data['TravelCitySupplier']['city_country_id'] = "'" . $CountryId . "'";
                            $this->request->data['TravelCitySupplier']['city_country_name'] = "'" . $CountryName . "'";
                            $this->request->data['TravelCitySupplier']['city_continent_id'] = "'" . $ContinentId . "'";
                            $this->request->data['TravelCitySupplier']['city_continent_name'] = "'" . $ContinentName . "'";
                            $this->request->data['TravelCitySupplier']['province_id'] = "'" . $ProvinceId . "'";
                            $this->request->data['TravelCitySupplier']['province_name'] = "'" . $ProvinceName . "'";
                            $this->request->data['TravelCitySupplier']['supplier_coutry_code'] = "'" . $CountryCode . "'";
                            $this->request->data['TravelCitySupplier']['pf_city_code'] = "'" . $CityCode . "'";
                            $CityMappingName = strtoupper('[SUPP/CITY] | ' . $val['TravelCitySupplier']['supplier_code'] . ' | ' . $CountryCode . ' | ' . $CityCode . ' - ' . $CityName);
                            $this->request->data['TravelCitySupplier']['city_mapping_name'] = "'" . $CityMappingName . "'";
                            $this->TravelCitySupplier->updateAll($this->request->data['TravelCitySupplier'], array('TravelCitySupplier.id' => $Id));


                            $country_code = $CountryCode;
                            $city_code = $CityCode;
                            $SupplierCode = $val['TravelCitySupplier']['supplier_code'];
                            $Active = strtolower($val['TravelCitySupplier']['active']);
                            $Excluded = strtolower($val['TravelCitySupplier']['excluded']);
                            $SupplierCountryCode = $val['TravelCitySupplier']['supplier_coutry_code'];
                            $SupplierCityCode = $val['TravelCitySupplier']['supplier_city_code'];
                            $CityContinentName = $ContinentName;
                            $CityContinentId = $ContinentId;
                            $CityCountryName = $CountryName;
                            $CityCountryId = $CountryId;

                            $CityId = $CityId;

                            $CitySupplierStatus = $val['TravelCitySupplier']['city_supplier_status'];
                            if ($CitySupplierStatus)
                                $CitySupplierStatus = 'true';
                            else
                                $CitySupplierStatus = 'false';
                            $ApprovedBy = $val['TravelCitySupplier']['approved_by'];
                            $CreatedBy = $val['TravelCitySupplier']['created_by'];
                            $app_date = explode(' ', $val['TravelCitySupplier']['approved_date']);
                            $ApprovedDate = $app_date[0] . 'T' . $app_date[1];
                            $date = explode(' ', $val['TravelCitySupplier']['created']);
                            $created = $date[0] . 'T' . $date[1];
                            $is_update = $val['TravelCitySupplier']['is_update'];
                            

                            if ($is_update == 'Y') {
                                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_CityMapping</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="Update">
                                                                <Id>' . $Id . '</Id>
                                                                <CityCode><![CDATA['.$CityCode.']]></CityCode>
                                                                <CityName><![CDATA[' . $CityName . ']]></CityName>
                                                                <CityId>' . $CityId . '</CityId>                                
                                                                <SupplierCode><![CDATA[' . $SupplierCode . ']]></SupplierCode>
                                                                <SupplierCityCode><![CDATA[' . $SupplierCityCode . ']]></SupplierCityCode>
                                                                <PFCityCode><![CDATA[' . $city_code . ']]></PFCityCode>
                                                                <CityMappingName><![CDATA[' . $CityMappingName . ']]></CityMappingName>
                                                                <CityCountryCode><![CDATA[' . $country_code . ']]></CityCountryCode>
                                                                <CityCountryId>' . $CityCountryId . '</CityCountryId>
                                                                <CityCountryName><![CDATA[' . $CityCountryName . ']]></CityCountryName>
                                                                <CityContinentId>' . $CityContinentId . '</CityContinentId>
                                                                <CityContinentName><![CDATA[' . $CityContinentName . ']]></CityContinentName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>
                                                                <CitySupplierStatus>' . $CitySupplierStatus . '</CitySupplierStatus>
                                                                <SupplierCountryCode>' . $SupplierCountryCode . '</SupplierCountryCode>
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

                                $log_call_screen = 'Edit - City Mapping';
                                $RESOURCEDATA = 'RESOURCEDATA_CITYMAPPING';

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
                                        $this->TravelCitySupplier->updateAll(array('wtb_status' => "'1'", 'is_update' => "'Y'"), array('id' => $id));
                                    } else {

                                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                                        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                                        $this->TravelCitySupplier->updateAll(array('wtb_status' => "'2'"), array('id' => $id));
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
                            }
                        }
                    }


                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update City.', 'failure');
                }
            }
        }

        $TravelCitySuppliers = $this->TravelCitySupplier->find('all', array('conditions' => array('TravelCitySupplier.city_id' => $id)));
        //pr($TravelCitySuppliers);

        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $TravelCities['TravelCity']['continent_id'], 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries', 'TravelCitySuppliers'));
        
        $Provinces = $this->Province->find('list', array(
                'conditions' => array(
                    'Province.continent_id' => $TravelCities['TravelCity']['continent_id'],
                    'Province.country_id' => $TravelCities['TravelCity']['country_id'],
                    'Province.status' => '1',
                    'Province.wtb_status' => '1',
                    'Province.active' => 'TRUE'
                ),
                'fields' => array('Province.id', 'Province.name'),
                'order' => 'Province.name ASC'
            ));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents','Provinces'));


        $this->request->data = $TravelCities;
    }

    public function de_active($id = null, $type = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';
        $Provinces = array();

        if ($type == 'TRUE') {
            $type = 'FALSE';
            $ACTIVE_MSG = 'Active';
        } else {
            $type = 'TRUE';
            $ACTIVE_MSG = 'Inactive';
        }

        if (!$id) {
            throw new NotFoundException(__('Invalid City'));
        }



        $TravelCities = $this->TravelCity->findById($id);

        if (!$TravelCities) {
            throw new NotFoundException(__('Invalid City'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelCity->set($this->data);
            if ($this->TravelCity->validates() == true) {

                if ($this->TravelCity->updateAll(array('TravelCity.active' => '"' . $this->data['TravelCity']['active'] . '"'), array('TravelCity.id' => $id))) {
                    $CityId = $id;
                    $CityName = $TravelCities['TravelCity']['city_name'];
                    $CityCode = $TravelCities['TravelCity']['city_code'];                   
                    $CountryId = $TravelCities['TravelCity']['country_id'];
                    $CountryName = $TravelCities['TravelCity']['country_name'];
                    $CountryCode = $TravelCities['TravelCity']['country_code'];
                    $ContinentId = $TravelCities['TravelCity']['continent_id'];
                    $ContinentName = $TravelCities['TravelCity']['continent_name'];
                    $ProvinceId = $TravelCities['TravelCity']['province_id'];
                    $ProvinceName = $TravelCities['TravelCity']['province_name'];
                    $CityDescription = $TravelCities['TravelCity']['city_description'];
                    $TopCity = strtolower($TravelCities['TravelCity']['top_city']);
                    $Active = strtolower($this->data['TravelCity']['active']);
                    $is_update = $TravelCities['TravelCity']['is_update'];
                    if ($is_update == 'Y')
                        $actiontype = 'Update';
                    else
                        $actiontype = 'AddNew';
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_City</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">
                                                                <CityId>' . $CityId . '</CityId>
                                                                <CityCode><![CDATA[' . $CityCode . ']]></CityCode>
                                                                <CityName><![CDATA[' . $CityName . ']]></CityName>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode><![CDATA['.$CountryCode.']]></CountryCode>
                                                                <CountryName><![CDATA[' . $CountryName . ']]></CountryName>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName><![CDATA[' . $ContinentName . ']]></ContinentName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>
                                                                <RegionId></RegionId>
                                                                <CityNameJP></CityNameJP>
                                                                <CityNameFR></CityNameFR>
                                                                <CityNameDE>NA</CityNameDE>
                                                                <CityNameCN>NA</CityNameCN>
                                                                <CityNameCNT>NA</CityNameCNT>
                                                                <CityNameIT>NA</CityNameIT>
                                                                <CityNameES>NA</CityNameES>
                                                                <CityNameKR>NA</CityNameKR>
                                                                <CityNameTEMP1>NA</CityNameTEMP1>
                                                                <CityNameTEMP2>NA</CityNameTEMP2>
                                                                <CityNameTEMP3>NA</CityNameTEMP3>
                                                                <City_Keyword>NA</City_Keyword>
                                                                <CityURL>NA</CityURL>
                                                                <CityNameURL>NA</CityNameURL>
                                                                <CityURLTEMP1>NA</CityURLTEMP1>
                                                                <CityURLTEMP2>NA</CityURLTEMP2>
                                                                <CityURLTEMP3>NA</CityURLTEMP3>
                                                                <CityDomainName>NA</CityDomainName>
                                                                <CityTitle>NA</CityTitle>
                                                                <CityDescription><![CDATA['.$CityDescription.']]></CityDescription>
                                                                <CityKeyword>NA</CityKeyword>
                                                                <ActiveMap>false</ActiveMap>
                                                                <ActiveGuide>false</ActiveGuide>
                                                                <IsUpdated>0</IsUpdated>
                                                                <PFTActive>1</PFTActive>
                                                                <SSActive>true</SSActive>
                                                                <TopDestination>true</TopDestination>
                                                                <StateCode>NA</StateCode>
                                                                <IsXML>true</IsXML>
                                                                <Active>' . $Active . '</Active>
                                                                <TopCity>' . $TopCity . '</TopCity>
                                                                <Status>true</Status>
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


                    $log_call_screen = 'City - ' . $ACTIVE_MSG;

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

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelCity->updateAll(array('TravelCity.wtb_status' => "'1'", 'TravelCity.is_update' => "'Y'"), array('TravelCity.id' => $CityId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelCity->updateAll(array('TravelCity.wtb_status' => "'2'"), array('TravelCity.id' => $CityId));
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

                    /*                     * *
                     * Country mapping table
                     * 

                      $xml_error = 'FALSE';

                      $arrs = $this->TravelCitySupplier->find('all', array('conditions' => array('TravelCitySupplier.city_id' => $CityId)));
                      if (count($arrs) > 0) {
                      foreach ($arrs as $val) {
                      $Id = $val['TravelCitySupplier']['id'];
                      $this->TravelCitySupplier->updateAll(array('TravelCitySupplier.active' => '"' . $this->data['TravelCity']['active'] . '"'), array('TravelCitySupplier.id' => $Id));


                      $country_code = $val['TravelCitySupplier']['city_country_code'];
                      $city_code = $val['TravelCitySupplier']['pf_city_code'];
                      $SupplierCode = $val['TravelCitySupplier']['supplier_code'];

                      $Excluded = strtolower($val['TravelCitySupplier']['excluded']);
                      $SupplierCountryCode = $val['TravelCitySupplier']['supplier_coutry_code'];
                      $SupplierCityCode = $val['TravelCitySupplier']['supplier_city_code'];
                      $CityContinentName = $val['TravelCitySupplier']['city_continent_name'];
                      $CityContinentId = $val['TravelCitySupplier']['city_continent_id'];
                      $CityCountryName = $val['TravelCitySupplier']['city_country_name'];
                      $CityCountryId = $val['TravelCitySupplier']['city_country_id'];

                      $CityMappingName = $val['TravelCitySupplier']['city_mapping_name'];

                      $CityId = $val['TravelCitySupplier']['city_id'];

                      $CitySupplierStatus = $val['TravelCitySupplier']['city_supplier_status'];
                      if ($CitySupplierStatus)
                      $CitySupplierStatus = 'true';
                      else
                      $CitySupplierStatus = 'false';
                      $ApprovedBy = $val['TravelCitySupplier']['approved_by'];
                      $CreatedBy = $val['TravelCitySupplier']['created_by'];
                      $app_date = explode(' ', $val['TravelCitySupplier']['approved_date']);
                      $ApprovedDate = $app_date[0] . 'T' . $app_date[1];
                      $date = explode(' ', $val['TravelCitySupplier']['created']);
                      $created = $date[0] . 'T' . $date[1];
                      $is_update = $val['TravelCitySupplier']['is_update'];
                      if ($is_update == 'Y')
                      $city_actiontype = 'Update';
                      else
                      $city_actiontype = 'AddNew';

                      $content_xml_str = '<soap:Body>
                      <ProcessXML xmlns="http://www.travel.domain/">
                      <RequestInfo>
                      <ResourceDataRequest>
                      <RequestAuditInfo>
                      <RequestType>PXML_WData_CityMapping</RequestType>
                      <RequestTime>' . $CreatedDate . '</RequestTime>
                      <RequestResource>Silkrouters</RequestResource>
                      </RequestAuditInfo>
                      <RequestParameters>
                      <ResourceData>
                      <ResourceDetailsData srno="1" actiontype="' . $city_actiontype . '">
                      <Id>' . $Id . '</Id>
                      <CityCode>NA</CityCode>
                      <CityName>' . $CityName . '</CityName>
                      <CityId>' . $CityId . '</CityId>
                      <SupplierCode>' . $SupplierCode . '</SupplierCode>
                      <SupplierCityCode>' . $SupplierCityCode . '</SupplierCityCode>
                      <PFCityCode>' . $city_code . '</PFCityCode>
                      <CityMappingName>' . $CityMappingName . '</CityMappingName>
                      <CityCountryCode>' . $country_code . '</CityCountryCode>
                      <CityCountryId>' . $CityCountryId . '</CityCountryId>
                      <CityCountryName>' . $CityCountryName . '</CityCountryName>
                      <CityContinentId>' . $CityContinentId . '</CityContinentId>
                      <CityContinentName>' . $CityContinentName . '</CityContinentName>
                      <CitySupplierStatus>' . $CitySupplierStatus . '</CitySupplierStatus>
                      <SupplierCountryCode>' . $SupplierCountryCode . '</SupplierCountryCode>
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

                      $log_call_screen = 'City Mapping - ' . $ACTIVE_MSG;
                      $RESOURCEDATA = 'RESOURCEDATA_CITYMAPPING';

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
                      $this->TravelCitySupplier->updateAll(array('wtb_status' => "'1'", 'is_update' => "'Y'"), array('id' => $id));
                      } else {

                      $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                      $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                      $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                      $this->TravelCitySupplier->updateAll(array('wtb_status' => "'2'"), array('id' => $id));
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
                    $this->Session->setFlash('Unable to update City.', 'failure');
                }
            }
        }

        $Types = array($type);
        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $TravelCities['TravelCity']['continent_id'], 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));

        $Provinces = $this->Province->find('list', array(
                'conditions' => array(
                    'Province.continent_id' => $TravelCities['TravelCity']['continent_id'],
                    'Province.country_id' => $TravelCities['TravelCity']['country_id'],
                    'Province.status' => '1',
                    'Province.wtb_status' => '1',
                    'Province.active' => 'TRUE'
                ),
                'fields' => array('Province.id', 'Province.name'),
                'order' => 'Province.name ASC'
            ));
        
        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents', 'TravelCountries', 'Types','Provinces'));

        $this->request->data = $TravelCities;
    }

    public function retry($id = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';
        $Provinces = array();

        if (!$id) {
            throw new NotFoundException(__('Invalid City'));
        }

        $TravelCities = $this->TravelCity->findById($id);

        if (!$TravelCities) {
            throw new NotFoundException(__('Invalid City'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->TravelCity->set($this->data);
            if ($this->TravelCity->validates() == true) {

                if ($this->TravelCity->updateAll(array('TravelCity.active' => "'FALSE'"), array('TravelCity.id' => $id))) {
                    $CityId = $id;
                    $CityName = $TravelCities['TravelCity']['city_name'];
                    $CityCode = $TravelCities['TravelCity']['city_code'];
                    $CountryCode = $TravelCities['TravelCity']['country_code'];                    
                    $CountryId = $TravelCities['TravelCity']['country_id'];
                    $CountryName = $TravelCities['TravelCity']['country_name'];
                    $ContinentId = $TravelCities['TravelCity']['continent_id'];
                    $ContinentName = $TravelCities['TravelCity']['continent_name'];
                    $CityDescription = $TravelCities['TravelCity']['city_description'];
                    $TopCity = strtolower($TravelCities['TravelCity']['top_city']);
                    $Active = strtolower($TravelCities['TravelCity']['active']);
                    $is_update = $TravelCities['TravelCity']['is_update'];
                    $ProvinceId = $TravelCities['TravelCity']['province_id'];
                    $ProvinceName = $TravelCities['TravelCity']['province_name'];
                    if ($is_update == 'Y')
                        $actiontype = 'Update';
                    else
                        $actiontype = 'AddNew';
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_City</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">
                                                                <CityId>' . $CityId . '</CityId>
                                                                <CityCode>' . $CityCode . '</CityCode>
                                                                <CityName>' . $CityName . '</CityName>
                                                                <CountryId>' . $CountryId . '</CountryId>
                                                                <CountryCode>' . $CountryCode . '</CountryCode>
                                                                <CountryName>' . $CountryName . '</CountryName>
                                                                <ContinentId>' . $ContinentId . '</ContinentId>
                                                                <ContinentCode>NA</ContinentCode>
                                                                <ContinentName>' . $ContinentName . '</ContinentName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>
                                                                <RegionId></RegionId>
                                                                <CityNameJP></CityNameJP>
                                                                <CityNameFR></CityNameFR>
                                                                <CityNameDE>NA</CityNameDE>
                                                                <CityNameCN>NA</CityNameCN>
                                                                <CityNameCNT>NA</CityNameCNT>
                                                                <CityNameIT>NA</CityNameIT>
                                                                <CityNameES>NA</CityNameES>
                                                                <CityNameKR>NA</CityNameKR>
                                                                <CityNameTEMP1>NA</CityNameTEMP1>
                                                                <CityNameTEMP2>NA</CityNameTEMP2>
                                                                <CityNameTEMP3>NA</CityNameTEMP3>
                                                                <City_Keyword>NA</City_Keyword>
                                                                <CityURL>NA</CityURL>
                                                                <CityNameURL>NA</CityNameURL>
                                                                <CityURLTEMP1>NA</CityURLTEMP1>
                                                                <CityURLTEMP2>NA</CityURLTEMP2>
                                                                <CityURLTEMP3>NA</CityURLTEMP3>
                                                                <CityDomainName>NA</CityDomainName>
                                                                <CityTitle>NA</CityTitle>
                                                                <CityDescription><![CDATA['.$CityDescription.']]></CityDescription>
                                                                <CityKeyword>NA</CityKeyword>
                                                                <ActiveMap>false</ActiveMap>
                                                                <ActiveGuide>false</ActiveGuide>
                                                                <IsUpdated>0</IsUpdated>
                                                                <PFTActive>1</PFTActive>
                                                                <SSActive>true</SSActive>
                                                                <TopDestination>true</TopDestination>
                                                                <StateCode>NA</StateCode>
                                                                <IsXML>true</IsXML>
                                                                <Active>' . $Active . '</Active>
                                                                <TopCity>' . $TopCity . '</TopCity>
                                                                <Status>true</Status>
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


                    $log_call_screen = 'City - Re-try';

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

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelCity->updateAll(array('TravelCity.wtb_status' => "'1'", 'TravelCity.is_update' => "'Y'"), array('TravelCity.id' => $CityId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelCity->updateAll(array('TravelCity.wtb_status' => "'2'"), array('TravelCity.id' => $CityId));
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

                    /*                     * *
                     * Country mapping table
                     * 
                     */
                    $xml_error = 'FALSE';

                    $arrs = $this->TravelCitySupplier->find('all', array('conditions' => array('TravelCitySupplier.city_id' => $CityId)));
                    if (count($arrs) > 0) {
                        foreach ($arrs as $val) {
                            $Id = $val['TravelCitySupplier']['id'];
                            $this->request->data['TravelCitySupplier']['city_name'] = "'" . $CityName . "'";
                            $this->request->data['TravelCitySupplier']['city_country_id'] = "'" . $CountryId . "'";
                            $this->request->data['TravelCitySupplier']['city_country_name'] = "'" . $CountryName . "'";
                            $this->request->data['TravelCitySupplier']['city_continent_id'] = "'" . $ContinentId . "'";
                            $this->request->data['TravelCitySupplier']['city_continent_name'] = "'" . $ContinentName . "'";
                            $this->request->data['TravelCitySupplier']['supplier_coutry_code'] = "'" . $CountryCode . "'";
                            $this->request->data['TravelCitySupplier']['pf_city_code'] = "'" . $CityCode . "'";
                            $this->request->data['TravelCitySupplier']['province_id'] = "'" . $ProvinceId . "'";
                            $this->request->data['TravelCitySupplier']['province_name'] = "'" . $ProvinceName . "'";
                            $SupplierCityCode = $val['TravelCitySupplier']['supplier_city_code'];
                            $SupplierCode = $val['TravelCitySupplier']['supplier_code'];
                            $CityMappingName = strtoupper('[SUPP/CITY] | ' . $SupplierCode . ' | ' . $CountryCode . ' | ' . $CityCode . ' - ' . $CityName);
                            $this->request->data['TravelCitySupplier']['city_mapping_name'] = "'" . $CityMappingName . "'";
                            $this->TravelCitySupplier->updateAll($this->request->data['TravelCitySupplier'], array('TravelCitySupplier.id' => $Id));


                            $country_code = $CountryCode;
                            $city_code = $CityCode;

                            $Active = strtolower($val['TravelCitySupplier']['active']);
                            $Excluded = strtolower($val['TravelCitySupplier']['excluded']);
                            $SupplierCountryCode = $val['TravelCitySupplier']['supplier_coutry_code'];

                            $CityContinentName = $ContinentName;
                            $CityContinentId = $ContinentId;
                            $CityCountryName = $CountryName;
                            $CityCountryId = $CountryId;

                            $CityId = $CityId;

                            $CitySupplierStatus = $val['TravelCitySupplier']['city_supplier_status'];
                            if ($CitySupplierStatus)
                                $CitySupplierStatus = 'true';
                            else
                                $CitySupplierStatus = 'false';
                            $ApprovedBy = $val['TravelCitySupplier']['approved_by'];
                            $CreatedBy = $val['TravelCitySupplier']['created_by'];
                            $app_date = explode(' ', $val['TravelCitySupplier']['approved_date']);
                            $ApprovedDate = $app_date[0] . 'T' . $app_date[1];
                            $date = explode(' ', $val['TravelCitySupplier']['created']);
                            $created = $date[0] . 'T' . $date[1];
                            $is_update = $val['TravelCitySupplier']['is_update'];
                            if ($is_update == 'Y')
                                $city_actiontype = 'Update';
                            else
                                $city_actiontype = 'AddNew';

                            $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_CityMapping</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $city_actiontype . '">
                                                                <Id>' . $Id . '</Id>
                                                                <CityCode><![CDATA[' . $city_code . ']]></CityCode>
                                                                <CityName><![CDATA[' . $CityName . ']]></CityName>
                                                                <CityId>' . $CityId . '</CityId>                                
                                                                <SupplierCode><![CDATA[' . $SupplierCode . ']]></SupplierCode>
                                                                <SupplierCityCode><![CDATA[' . $SupplierCityCode . ']]></SupplierCityCode>
                                                                <PFCityCode><![CDATA[' . $city_code . ']]></PFCityCode>
                                                                <CityMappingName><![CDATA[' . $CityMappingName . ']]></CityMappingName>
                                                                <CityCountryCode><![CDATA[' . $country_code . ']]></CityCountryCode>
                                                                <CityCountryId>' . $CityCountryId . '</CityCountryId>
                                                                <CityCountryName><![CDATA[' . $CityCountryName . ']]></CityCountryName>
                                                                <CityContinentId>' . $CityContinentId . '</CityContinentId>
                                                                <CityContinentName><![CDATA[' . $CityContinentName . ']]></CityContinentName>
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>
                                                                <CitySupplierStatus>' . $CitySupplierStatus . '</CitySupplierStatus>
                                                                <SupplierCountryCode>' . $SupplierCountryCode . '</SupplierCountryCode>
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

                            $log_call_screen = 'Re-try - City Mapping';
                            $RESOURCEDATA = 'RESOURCEDATA_CITYMAPPING';

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
                                    $this->TravelCitySupplier->updateAll(array('wtb_status' => "'1'", 'is_update' => "'Y'"), array('id' => $id));
                                } else {

                                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                                    $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                                    $this->TravelCitySupplier->updateAll(array('wtb_status' => "'2'"), array('id' => $id));
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
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update City.', 'failure');
                }
            }
        }

        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $TravelCities['TravelCity']['continent_id'], 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));
        
        $Provinces = $this->Province->find('list', array(
                'conditions' => array(
                    'Province.continent_id' => $TravelCities['TravelCity']['continent_id'],
                    'Province.country_id' => $TravelCities['TravelCity']['country_id'],
                    'Province.status' => '1',
                    'Province.wtb_status' => '1',
                    'Province.active' => 'TRUE'
                ),
                'fields' => array('Province.id', 'Province.name'),
                'order' => 'Province.name ASC'
            ));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents','Provinces'));

        $this->request->data = $TravelCities;
    }

}