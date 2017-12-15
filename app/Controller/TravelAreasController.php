<?php

/**
 * TravelArea controller.
 *
 * This file will render views from views/TravelAreas/
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
 * TravelArea controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TravelAreasController extends AppController {

    var $uses = array('TravelSuburb','Common', 'TravelCity', 'TravelCountry', 'LookupValueStatus', 'TravelArea', 'TravelLookupContinent', 'LogCall','Province');

    public function index() {


        $search_condition = array();
        $TravelCities = array();
        $TravelSuburbs = array();
        $TravelCountries = array();
        $area_name = '';
        $continent_id = '';
        $city_id = '';
        $country_id = '';
        $suburb_id = '';

        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['TravelArea']['area_name'])) {
                $area_name = $this->data['TravelArea']['area_name'];
                array_push($search_condition, array("TravelArea.area_name LIKE '%$area_name%'"));
            }
            if (!empty($this->data['TravelArea']['continent_id'])) {
                $continent_id = $this->data['TravelArea']['continent_id'];
                array_push($search_condition, array('TravelArea.continent_id' => $continent_id));
                $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $continent_id, 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
            }

            if (!empty($this->data['TravelArea']['country_id'])) {
                $country_id = $this->data['TravelArea']['country_id'];
                array_push($search_condition, array('TravelArea.country_id' => $country_id));
                $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $country_id, 'city_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'city_name ASC'));
            }

            if (!empty($this->data['TravelArea']['city_id'])) {
                $city_id = $this->data['TravelArea']['city_id'];
                array_push($search_condition, array('TravelArea.city_id' => $city_id));
                $TravelSuburbs = $this->TravelSuburb->find('list', array('fields' => 'id,name', 'conditions' => array('status' => 1, 'country_id' => $country_id, 'city_id' => $city_id), 'order' => 'name ASC'));
            }
            if (!empty($this->data['TravelArea']['suburb_id'])) {
                $suburb_id = $this->data['TravelArea']['suburb_id'];
                array_push($search_condition, array('TravelArea.suburb_id' => $suburb_id));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['area_name'])) {
                $area_name = $this->request->params['named']['area_name'];
                array_push($search_condition, array("TravelArea.area_name LIKE '%$area_name%'"));
            }

            if (!empty($this->request->params['TravelArea']['continent_id'])) {
                $continent_id = $this->request->params['TravelArea']['continent_id'];
                array_push($search_condition, array('TravelArea.continent_id' => $continent_id));
                $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $continent_id, 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
            }

            if (!empty($this->request->params['named']['country_id'])) {
                $country_id = $this->request->params['named']['country_id'];
                array_push($search_condition, array('TravelArea.country_id' => $country_id));
                $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $country_id, 'city_status' => 0), 'order' => 'city_name ASC'));
            }

            if (!empty($this->request->params['named']['city_id'])) {
                $city_id = $this->request->params['named']['city_id'];
                array_push($search_condition, array('TravelArea.city_id' => $city_id));
                $TravelSuburbs = $this->TravelSuburb->find('list', array('fields' => 'id,name', 'conditions' => array('status' => 1, 'country_id' => $country_id, 'city_id' => $city_id), 'order' => 'name ASC'));
            }
            if (!empty($this->request->params['named']['suburb_id'])) {
                $suburb_id = $this->request->params['named']['suburb_id'];
                array_push($search_condition, array('TravelArea.suburb_id' => $suburb_id));
            }
        }


        $this->paginate['order'] = array('TravelArea.name' => 'asc');
        $this->set('TravelAreas', $this->paginate("TravelArea", $search_condition));





        if (!isset($this->passedArgs['area_name']) && empty($this->passedArgs['area_name'])) {
            $this->passedArgs['area_name'] = (isset($this->data['TravelArea']['area_name'])) ? $this->data['TravelArea']['area_name'] : '';
        }
        if (!isset($this->passedArgs['continent_id']) && empty($this->passedArgs['continent_id'])) {
            $this->passedArgs['continent_id'] = (isset($this->data['TravelArea']['continent_id'])) ? $this->data['TravelArea']['continent_id'] : '';
        }
        if (!isset($this->passedArgs['country_id']) && empty($this->passedArgs['country_id'])) {
            $this->passedArgs['country_id'] = (isset($this->data['TravelArea']['country_id'])) ? $this->data['TravelArea']['country_id'] : '';
        }
        if (!isset($this->passedArgs['city_id']) && empty($this->passedArgs['city_id'])) {
            $this->passedArgs['city_id'] = (isset($this->data['TravelArea']['city_id'])) ? $this->data['TravelArea']['city_id'] : '';
        }
        if (!isset($this->passedArgs['suburb_id']) && empty($this->passedArgs['suburb_id'])) {
            $this->passedArgs['suburb_id'] = (isset($this->data['TravelArea']['suburb_id'])) ? $this->data['TravelArea']['suburb_id'] : '';
        }
        if (!isset($this->data) && empty($this->data)) {

            $this->data['TravelArea']['area_name'] = $this->passedArgs['area_name'];
            $this->data['TravelArea']['continent_id'] = $this->passedArgs['continent_id'];
            $this->data['TravelArea']['country_id'] = $this->passedArgs['country_id'];
            $this->data['TravelArea']['city_id'] = $this->passedArgs['city_id'];
            $this->data['TravelArea']['suburb_id'] = $this->passedArgs['suburb_id'];
        }


        $this->set(compact('TravelCountries'));
        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));
        $this->set(compact('TravelSuburbs'));
        $this->set(compact('TravelCities'));

        $this->set(compact('city_id'));
        $this->set(compact('continent_id'));
        $this->set(compact('country_id'));
        $this->set(compact('area_name'));
        $this->set(compact('suburb_id'));
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

            $this->request->data['TravelArea']['created_by'] = $user_id;
            $this->request->data['TravelArea']['area_status'] = '1';
            $this->request->data['TravelArea']['wtb_status'] = '1';
            $this->request->data['TravelArea']['area_active'] = 'TRUE';
            $this->TravelArea->create();
            if ($this->TravelArea->save($this->request->data)) {
                $AreaId = $this->TravelArea->getLastInsertId();
                $AreaName = $this->data['TravelArea']['area_name'];
                $SuburbId = $this->data['TravelArea']['suburb_id'];
                $SuburbName = $this->data['TravelArea']['suburb_name'];
                $CityId = $this->data['TravelArea']['city_id'];
                $CityName = $this->data['TravelArea']['city_name'];
                $CountryId = $this->data['TravelArea']['country_id'];
                $CountryName = $this->data['TravelArea']['country_name'];
                $ContinentId = $this->data['TravelArea']['continent_id'];
                $ContinentName = $this->data['TravelArea']['continent_name'];
                $AreaDescription = $this->data['TravelArea']['area_description'];
                $TopArea = strtolower($this->data['TravelArea']['top_area']);
                $ProvinceId = $this->data['TravelArea']['province_id'];
                $ProvinceName = $this->data['TravelArea']['province_name'];
                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
                $Active = 'true';



                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Area</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                             <ResourceDetailsData srno="1" actiontype="AddNew">
                                                                <AreaId>' . $AreaId . '</AreaId>
                                                                <AreaCode>NA</AreaCode>
                                                                <AreaName>' . $AreaName . '</AreaName>
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
                                                                <AreaMap></AreaMap>
                                                                <AreaMapSS></AreaMapSS>
                                                                <AreaComment></AreaComment>
                                                                <AreaDescription></AreaDescription>
                                                                <AreaActive>' . $Active . '</AreaActive>
                                                                <AreaDomainName></AreaDomainName>
                                                                <TopArea>' . $TopArea . '</TopArea>
                                                                <AreaStatus>true</AreaStatus>
                                                                <WtbStatus>true</WtbStatus>
                                                                <ActiveMap>true</ActiveMap>
                                                                <Isupdated>1</Isupdated>
                                                                <PFTActive>1</PFTActive>
                                                                <AreaNameURL></AreaNameURL>
                                                                <TopDestination>1</TopDestination>
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


                $log_call_screen = 'Area - Add';

                $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                $client = new SoapClient(null, array(
                    'location' => $location_URL,
                    'uri' => '',
                    'trace' => 1,
                ));

                try {
                    $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                    $xml_arr = $this->xml2array($order_return);
                    // pr($xml_arr);
                    //   die;


                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                        $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
                        $this->TravelArea->updateAll(array('TravelArea.wtb_status' => "'1'", 'TravelArea.is_update' => "'Y'"), array('TravelArea.id' => $AreaId));
                    } else {

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                        $this->TravelArea->updateAll(array('TravelArea.wtb_status' => "'2'"), array('TravelArea.id' => $AreaId));
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
                $message = 'Local record has been successfully added.<br />' . $xml_msg;
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
                $this->Session->setFlash('Unable to add Area.', 'failure');
            }
        }

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
        $this->set(compact('mode'));
        $xml_error = 'FALSE';

        if (!$id) {
            throw new NotFoundException(__('Invalid Suburb'));
        }

        $TravelAreas = $this->TravelArea->findById($id);

        if (!$TravelAreas) {
            throw new NotFoundException(__('Invalid suburb'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            
            $AreaName = $this->data['TravelArea']['area_name'];
                    $SuburbId = $this->data['TravelArea']['suburb_id'];
                    $SuburbName = $this->Common->getSuburbName($SuburbId);
                    $this->request->data['TravelArea']['suburb_name'] = $SuburbName;
                    $CityId = $this->data['TravelArea']['city_id'];
                    $CityName = $this->Common->getCityName($CityId);
                    $this->request->data['TravelArea']['city_name'] = $CityName;
                    $CountryId = $this->data['TravelArea']['country_id'];
                    $CountryName = $this->Common->getCountryName($CountryId);
                    $this->request->data['TravelArea']['country_name'] = $CountryName;
                    $ContinentId = $this->data['TravelArea']['continent_id'];
                    $ContinentName = $this->Common->getContinentName($ContinentId);
                    $this->request->data['TravelArea']['continent_name'] = $ContinentName;
                    $ProvinceId = $this->data['TravelArea']['province_id'];
                   
                    $ProvinceName = $this->Common->getProvinceName($ProvinceId);
                    
                    $this->request->data['TravelArea']['province_name'] = $ProvinceName;
                    
            $this->TravelArea->set($this->data);
            if ($this->TravelArea->validates() == true) {

                $this->TravelArea->id = $id;
                if ($this->TravelArea->save($this->request->data)) {
                    $AreaId = $id;
                    
                    $AreaDescription = $this->data['TravelArea']['area_description'];
                    $TopArea = strtolower($this->data['TravelArea']['top_area']);
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
                    $Active = 'true';
                    
                     $is_update = $TravelAreas['TravelArea']['is_update'];
                    
                    $AreaStatus = $TravelAreas['TravelArea']['area_status'];
                    if ($AreaStatus)
                        $AreaStatus = 'true';
                    else
                        $AreaStatus = 'false';

                    $WtbStatus = $TravelAreas['TravelArea']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';
            
                    if ($is_update == 'Y')
                        $actiontype = 'Update';
                    else
                        $actiontype = 'AddNew';



                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Area</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                             <ResourceDetailsData srno="1" actiontype="'.$actiontype.'">
                                                                <AreaId>' . $AreaId . '</AreaId>
                                                                <AreaCode>NA</AreaCode>
                                                                <AreaName>' . $AreaName . '</AreaName>
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
                                                                <AreaMap></AreaMap>
                                                                <AreaMapSS></AreaMapSS>
                                                                <AreaComment></AreaComment>
                                                                <AreaDescription></AreaDescription>
                                                                <AreaActive>' . $Active . '</AreaActive>
                                                                <AreaDomainName></AreaDomainName>
                                                                <TopArea>' . $TopArea . '</TopArea>
                                                                <AreaStatus>'.$AreaStatus.'</AreaStatus>
                                                                <WtbStatus>'.$WtbStatus.'</WtbStatus>
                                                                <ActiveMap>true</ActiveMap>
                                                                <Isupdated>1</Isupdated>
                                                                <PFTActive>1</PFTActive>
                                                                <AreaNameURL></AreaNameURL>
                                                                <TopDestination>1</TopDestination>
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


                    $log_call_screen = 'Area - Edit';

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
                        //  die;


                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelArea->updateAll(array('TravelArea.wtb_status' => "'1'"), array('TravelArea.id' => $AreaId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelArea->updateAll(array('TravelArea.wtb_status' => "'2'"), array('TravelArea.id' => $AreaId));
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
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Area.', 'failure');
                }
            }
        }


        $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $TravelAreas['TravelArea']['country_id'], 'city_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'city_name ASC'));
        //  $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
        $this->set(compact('TravelCities'));

        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $TravelAreas['TravelArea']['continent_id'], 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));

        $Provinces = $this->Province->find('list', array(
                'conditions' => array(
                    'Province.continent_id' => $TravelAreas['TravelArea']['continent_id'],
                    'Province.country_id' => $TravelAreas['TravelArea']['country_id'],
                    'Province.status' => '1',
                    'Province.wtb_status' => '1',
                    'Province.active' => 'TRUE'
                ),
                'fields' => array('Province.id', 'Province.name'),
                'order' => 'Province.name ASC'
            ));
        
        $TravelSuburbs = $this->TravelSuburb->find('list', array('fields' => 'id,name', 'conditions' => array('status' => 1, 'country_id' => $TravelAreas['TravelArea']['country_id'], 'city_id' => $TravelAreas['TravelArea']['city_id']), 'order' => 'name ASC'));
        $this->set(compact('TravelSuburbs'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents','Provinces'));

        $this->request->data = $TravelAreas;
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
            throw new NotFoundException(__('Invalid Suburb'));
        }

        $TravelAreas = $this->TravelArea->findById($id);

        if (!$TravelAreas) {
            throw new NotFoundException(__('Invalid suburb'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->TravelArea->validates() == true) {

                if ($this->TravelArea->updateAll(array('TravelArea.area_active' => '"' . $this->data['TravelArea']['area_active'] . '"'), array('TravelArea.id' => $id))) {
                    $AreaId = $id;
                    $AreaName = $TravelAreas['TravelArea']['area_name'];
                    $SuburbId = $TravelAreas['TravelArea']['suburb_id'];
                    $SuburbName = $TravelAreas['TravelArea']['suburb_name'];
                    $CityId = $TravelAreas['TravelArea']['city_id'];
                    $CityName = $TravelAreas['TravelArea']['city_name'];
                    $CountryId = $TravelAreas['TravelArea']['country_id'];
                    $CountryName = $TravelAreas['TravelArea']['country_name'];
                    $ContinentId = $TravelAreas['TravelArea']['continent_id'];
                    $ContinentName = $TravelAreas['TravelArea']['continent_name'];
                    $AreaDescription = $TravelAreas['TravelArea']['area_description'];
                    $TopArea = strtolower($TravelAreas['TravelArea']['top_area']);
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
                    $Active = strtolower($this->data['TravelArea']['area_active']);
                    $ProvinceId = $TravelAreas['TravelArea']['province_id'];
                    $ProvinceName = $TravelAreas['TravelArea']['province_name'];



                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Area</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                             <ResourceDetailsData srno="1" actiontype="Update">
                                                                <AreaId>' . $AreaId . '</AreaId>
                                                                <AreaCode>NA</AreaCode>
                                                                <AreaName>' . $AreaName . '</AreaName>
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
                                                                <AreaMap></AreaMap>
                                                                <AreaMapSS></AreaMapSS>
                                                                <AreaComment></AreaComment>
                                                                <AreaDescription></AreaDescription>
                                                                <AreaActive>' . $Active . '</AreaActive>
                                                                <AreaDomainName></AreaDomainName>
                                                                <TopArea>' . $TopArea . '</TopArea>
                                                                <AreaStatus>true</AreaStatus>
                                                                <WtbStatus>false</WtbStatus>
                                                                <ActiveMap>true</ActiveMap>
                                                                <Isupdated>1</Isupdated>
                                                                <PFTActive>1</PFTActive>
                                                                <AreaNameURL></AreaNameURL>
                                                                <TopDestination>1</TopDestination>
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


                    $log_call_screen = 'Area - ' . $ACTIVE_MSG;

                    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                    $client = new SoapClient(null, array(
                        'location' => $location_URL,
                        'uri' => '',
                        'trace' => 1,
                    ));

                    try {
                        $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                        $xml_arr = $this->xml2array($order_return);


                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelArea->updateAll(array('TravelArea.wtb_status' => "'1'"), array('TravelArea.id' => $AreaId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelArea->updateAll(array('TravelArea.wtb_status' => "'2'"), array('TravelArea.id' => $AreaId));
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
                    $this->Session->setFlash('Unable to update Area.', 'failure');
                }
            }
        }

        $Types = array($type);

        $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $TravelAreas['TravelArea']['country_id'], 'city_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'city_name ASC'));
        //  $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
        $this->set(compact('TravelCities', 'Types'));

        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $TravelAreas['TravelArea']['continent_id'], 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));

        $TravelSuburbs = $this->TravelSuburb->find('list', array('fields' => 'id,name', 'conditions' => array('status' => 1, 'country_id' => $TravelAreas['TravelArea']['country_id'], 'city_id' => $TravelAreas['TravelArea']['city_id']), 'order' => 'name ASC'));
        $this->set(compact('TravelSuburbs'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));

        $this->request->data = $TravelAreas;
    }

    public function retry($id = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if (!$id) {
            throw new NotFoundException(__('Invalid Suburb'));
        }

        $TravelAreas = $this->TravelArea->findById($id);

        if (!$TravelAreas) {
            throw new NotFoundException(__('Invalid suburb'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->TravelArea->validates() == true) {

                if ($this->TravelArea->updateAll(array('TravelArea.area_active' => "'FALSE'"), array('TravelArea.id' => $id))) {
                    $AreaId = $id;
                    $AreaName = $TravelAreas['TravelArea']['area_name'];
                    $SuburbId = $TravelAreas['TravelArea']['suburb_id'];
                    $SuburbName = $TravelAreas['TravelArea']['suburb_name'];
                    $CityId = $TravelAreas['TravelArea']['city_id'];
                    $CityName = $TravelAreas['TravelArea']['city_name'];
                    $CountryId = $TravelAreas['TravelArea']['country_id'];
                    $CountryName = $TravelAreas['TravelArea']['country_name'];
                    $ContinentId = $TravelAreas['TravelArea']['continent_id'];
                    $ContinentName = $TravelAreas['TravelArea']['continent_name'];
                    $AreaDescription = $TravelAreas['TravelArea']['area_description'];
                    $TopArea = strtolower($TravelAreas['TravelArea']['top_area']);
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
                    $Active = strtolower($TravelAreas['TravelArea']['area_active']);
                    $is_update = $TravelAreas['TravelArea']['is_update'];
                    if ($is_update == 'Y')
                        $actiontype = 'Update';
                    else
                        $actiontype = 'AddNew';
                    
                    $ProvinceId = $TravelAreas['TravelArea']['province_id'];
                    $ProvinceName = $TravelAreas['TravelArea']['province_name'];
                    
                    
                    $AreaStatus = $TravelAreas['TravelArea']['area_status'];
                    if ($AreaStatus)
                        $AreaStatus = 'true';
                    else
                        $AreaStatus = 'false';

                    $WtbStatus = $TravelAreas['TravelArea']['wtb_status'];
                    if ($WtbStatus)
                        $WtbStatus = 'true';
                    else
                        $WtbStatus = 'false';
            
                    



                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Area</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                             <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">
                                                                <AreaId>' . $AreaId . '</AreaId>
                                                                <AreaCode>NA</AreaCode>
                                                                <AreaName>' . $AreaName . '</AreaName>
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
                                                                <AreaMap></AreaMap>
                                                                <AreaMapSS></AreaMapSS>
                                                                <AreaComment></AreaComment>
                                                                <AreaDescription></AreaDescription>
                                                                <AreaActive>' . $Active . '</AreaActive>
                                                                <AreaDomainName></AreaDomainName>
                                                                <TopArea>' . $TopArea . '</TopArea>
                                                                <AreaStatus>'.$AreaStatus.'</AreaStatus>
                                                                <WtbStatus>'.$WtbStatus.'</WtbStatus>
                                                                <ActiveMap>true</ActiveMap>
                                                                <Isupdated>1</Isupdated>
                                                                <PFTActive>1</PFTActive>
                                                                <AreaNameURL></AreaNameURL>
                                                                <TopDestination>1</TopDestination>
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


                    $log_call_screen = 'Area - Re-try';

                    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                    $client = new SoapClient(null, array(
                        'location' => $location_URL,
                        'uri' => '',
                        'trace' => 1,
                    ));

                    try {
                        $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                        $xml_arr = $this->xml2array($order_return);

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->TravelArea->updateAll(array('TravelArea.wtb_status' => "'1'", 'TravelArea.is_update' => "'Y'"), array('TravelArea.id' => $AreaId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AREA']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->TravelArea->updateAll(array('TravelArea.wtb_status' => "'2'"), array('TravelArea.id' => $AreaId));
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
                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Area.', 'failure');
                }
            }
        }


        $TravelCities = $this->TravelCity->find('list', array('fields' => 'id,city_name', 'conditions' => array('country_id' => $TravelAreas['TravelArea']['country_id'], 'city_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'city_name ASC'));
        //  $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));
        $this->set(compact('TravelCities'));

        $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $TravelAreas['TravelArea']['continent_id'], 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
        $this->set(compact('TravelCountries'));

        $TravelSuburbs = $this->TravelSuburb->find('list', array('fields' => 'id,name', 'conditions' => array('status' => 1, 'country_id' => $TravelAreas['TravelArea']['country_id'], 'city_id' => $TravelAreas['TravelArea']['city_id']), 'order' => 'name ASC'));
        $this->set(compact('TravelSuburbs'));

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));

        $this->request->data = $TravelAreas;
    }

}

