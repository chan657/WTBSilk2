<?php
/**
 * Province controller.
 *
 * This file will render views from views/Provinces/
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
 * Province controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class ProvincesController extends AppController {

    var $uses = array('TravelCountry', 'Province', 'TravelLookupContinent','LogCall','User','TravelWtbError','Common');

    public function index() {

        $search_condition = array();
        $TravelCountries = array();
        $name = '';
        $continent_id = '';
        $country_id = '';
        $status = '';
        $wtb_status = '';
        $active = '';


        if ($this->request->is('post') || $this->request->is('put')) {
            if (!empty($this->data['Province']['name'])) {
                $name = $this->data['Province']['name'];
                array_push($search_condition, array("Province.name LIKE '%$name%'"));
            }
            if (!empty($this->data['Province']['continent_id'])) {
                $continent_id = $this->data['Province']['continent_id'];
                $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $continent_id, 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
                array_push($search_condition, array('Province.continent_id' => $continent_id));
            }

            if (!empty($this->data['Province']['country_id'])) {
                $country_id = $this->data['Province']['country_id'];
                array_push($search_condition, array('Province.country_id' => $country_id));
            }
            if (!empty($this->data['Province']['status'])) {
                $status = $this->data['Province']['status'];
                array_push($search_condition, array('Province.status' => $status));
            }
            if (!empty($this->data['Province']['wtb_status'])) {
                $wtb_status = $this->data['Province']['wtb_status'];
                array_push($search_condition, array('Province.wtb_status' => $wtb_status));
            }
            if (!empty($this->data['Province']['active'])) {
                $active = $this->data['Province']['active'];
                array_push($search_condition, array('Province.active' => $active));
            }
        } elseif ($this->request->is('get')) {

            if (!empty($this->request->params['named']['name'])) {
                $name = $this->request->params['named']['name'];
                array_push($search_condition, array("Province.name LIKE '%$name%'"));
            }
            if (!empty($this->request->params['named']['continent_id'])) {
                $continent_id = $this->request->params['named']['continent_id'];
                $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id,country_name', 'conditions' => array('continent_id' => $continent_id, 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
                array_push($search_condition, array('Province.continent_id' => $continent_id));
            }

            if (!empty($this->request->params['named']['country_id'])) {
                $country_id = $this->request->params['named']['country_id'];
                array_push($search_condition, array('Province.country_id' => $country_id));
            }
            if (!empty($this->request->params['named']['status'])) {
                $status = $this->request->params['named']['status'];
                array_push($search_condition, array('Province.status' => $status));
            }
            if (!empty($this->request->params['named']['wtb_status'])) {
                $wtb_status = $this->request->params['named']['wtb_status'];
                array_push($search_condition, array('Province.wtb_status' => $wtb_status));
            }
            if (!empty($this->request->params['named']['active'])) {
                $active = $this->request->params['named']['active'];
                array_push($search_condition, array('Province.active' => $active));
            }
        }
        $this->paginate['order'] = array('Province.name' => 'asc');
        $this->set('Provinces', $this->paginate("Province", $search_condition));

        //$log = $this->Province->getDataSource()->getLog(false, false);       
        //debug($log);


        if (!isset($this->passedArgs['name']) && empty($this->passedArgs['name'])) {
            $this->passedArgs['name'] = (isset($this->data['Province']['name'])) ? $this->data['Province']['name'] : '';
        }
        if (!isset($this->passedArgs['continent_id']) && empty($this->passedArgs['continent_id'])) {
            $this->passedArgs['continent_id'] = (isset($this->data['Province']['continent_id'])) ? $this->data['Province']['continent_id'] : '';
        }
        if (!isset($this->passedArgs['country_id']) && empty($this->passedArgs['country_id'])) {
            $this->passedArgs['country_id'] = (isset($this->data['Province']['country_id'])) ? $this->data['Province']['country_id'] : '';
        }
        if (!isset($this->passedArgs['status']) && empty($this->passedArgs['status'])) {
            $this->passedArgs['status'] = (isset($this->data['Province']['status'])) ? $this->data['Province']['status'] : '';
        }
        if (!isset($this->passedArgs['wtb_status']) && empty($this->passedArgs['wtb_status'])) {
            $this->passedArgs['wtb_status'] = (isset($this->data['Province']['wtb_status'])) ? $this->data['Province']['wtb_status'] : '';
        }
        if (!isset($this->passedArgs['active']) && empty($this->passedArgs['active'])) {
            $this->passedArgs['active'] = (isset($this->data['Province']['active'])) ? $this->data['Province']['active'] : '';
        }

        if (!isset($this->data) && empty($this->data)) {

            $this->data['Province']['name'] = $this->passedArgs['name'];
            $this->data['Province']['continent_id'] = $this->passedArgs['continent_id'];
            $this->data['Province']['country_id'] = $this->passedArgs['country_id'];
            $this->data['Province']['status'] = $this->passedArgs['status'];
            $this->data['Province']['wtb_status'] = $this->passedArgs['wtb_status'];
            $this->data['Province']['active'] = $this->passedArgs['active'];
        }

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));

        $this->set(compact('name','country_id','continent_id','status','wtb_status','active','TravelCountries','TravelLookupContinents'));       
    }

    public function add() {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if ($this->request->is('post')) {

            $this->request->data['Province']['created_by'] = $user_id;
            $this->request->data['Province']['status'] = '1';
            $this->request->data['Province']['wtb_status'] = '1';
            $this->request->data['Province']['active'] = 'TRUE';
            $this->Province->create();
            if ($this->Province->save($this->request->data)) {
                $ProvinceId = $this->Province->getLastInsertId();
                $ProvinceName = $this->data['Province']['name'];              
                $CountryId = $this->data['Province']['country_id'];
                $CountryCode = $this->data['Province']['country_code'];
                $CountryName = $this->data['Province']['country_name'];
                $ContinentId = $this->data['Province']['continent_id'];
                $ContinentCode = $this->data['Province']['continent_code'];
                $ContinentName = $this->data['Province']['continent_name'];
                $ProvinceDescription = $this->data['Province']['description'];
                $TopProvince = strtolower($this->data['Province']['top_province']);
                $Active = 'true';

                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Province</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="AddNew">
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>
                                                                <CountryId>'.$CountryId.'</CountryId>
                                                                <CountryCode><![CDATA['.$CountryCode.']]></CountryCode>
                                                                <CountryName><![CDATA['.$CountryName.']]></CountryName>
                                                                <ContinentId>'.$ContinentId.'</ContinentId>
                                                                <ContinentCode><![CDATA['.$ContinentCode.']]></ContinentCode>
                                                                <ContinentName><![CDATA['.$ContinentName.']]></ContinentName>
                                                                <TopProvince>'.$TopProvince.'</TopProvince>
                                                                <ProvinceNameJP></ProvinceNameJP>
                                                                <ProvinceNameFR></ProvinceNameFR>
                                                                <ProvinceNameDE></ProvinceNameDE>
                                                                <ProvinceNameCN></ProvinceNameCN>
                                                                <ProvinceNameCNT></ProvinceNameCNT>
                                                                <ProvinceNameIT></ProvinceNameIT>
                                                                <ProvinceNameES></ProvinceNameES>
                                                                <ProvinceNameKR></ProvinceNameKR>
                                                                <ProvinceNameURL></ProvinceNameURL>
                                                                <ProvinceURLTEMP1></ProvinceURLTEMP1>
                                                                <ProvinceURLTEMP2></ProvinceURLTEMP2>
                                                                <ProvinceURLTEMP3></ProvinceURLTEMP3>
                                                                <ProvinceDescription><![CDATA['.$ProvinceDescription.']]></ProvinceDescription>
                                                                <ProvinceKeyword></ProvinceKeyword>
                                                                <Active>'.$Active.'</Active>
                                                                <WtbStatus>true</WtbStatus>
                                                                <Status>true</Status>
                                                                <CreatedBy>'.$user_id.'</CreatedBy>
                                                                <CreatedDate>'.$CreatedDate.'</CreatedDate>
                                                                <ModifiedDate>1111-01-01T00:00:00</ModifiedDate>
                                                            </ResourceDetailsData>                         
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                $log_call_screen = 'Province - Add';

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

                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                        $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
                        $this->Province->updateAll(array('Province.wtb_status' => "'1'", 'Province.is_update' => "'Y'"), array('Province.id' => $ProvinceId));
                    } else {

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
                        $this->Province->updateAll(array('Province.wtb_status' => "'2'"), array('Province.id' => $ProvinceId));
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
                    
                    /*
                         * WTB Error Information
                         */
                        $this->request->data['TravelWtbError']['error_topic'] = '32'; //travel_lookup_error_topics
                        $this->request->data['TravelWtbError']['error_by'] = $user_id;
                        $this->request->data['TravelWtbError']['error_time'] = $this->Common->GetIndiaTime();                        
                        $this->request->data['TravelWtbError']['log_id'] = $log_id;
                        $this->request->data['TravelWtbError']['error_entity'] = $ProvinceId;
                        $this->request->data['TravelWtbError']['error_type'] = '5'; // suburb
                        $this->request->data['TravelWtbError']['error_status'] = '3';   // Structuretravel_lookup_error_statuses  
                        $this->TravelWtbError->create();
                        $this->TravelWtbError->save($this->request->data['TravelWtbError']);
                }


                $message = 'Local record has been successfully added.<br />' . $xml_msg;
                $this->Session->setFlash($message, 'success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add Province.', 'failure');
            }
        }

        $TravelLookupContinents = $this->TravelLookupContinent->find('all', array('fields' => 'id,continent_name,continent_code', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $TravelLookupContinents = Set::combine($TravelLookupContinents, '{n}.TravelLookupContinent.id', array('%s - %s', '{n}.TravelLookupContinent.continent_code', '{n}.TravelLookupContinent.continent_name'));
        $this->set(compact('TravelLookupContinents'));
    }

    public function edit($id = null, $mode = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $id = base64_decode($id);
        $xml_error = 'FALSE';
        //$ModifiedDate = '1111-01-01T00:00:00';

        $this->set(compact('mode'));
        if (!$id) {
            throw new NotFoundException(__('Invalid Province'));
        }

        $Provinces = $this->Province->findById($id);

        if (!$Provinces) {
            throw new NotFoundException(__('Invalid Province'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Province->set($this->data);
            if ($this->Province->validates() == true) {

                $this->Province->id = $id;
                if ($this->Province->save($this->request->data)) {
                    $ProvinceId = $id;
                    $ProvinceName = $this->data['Province']['name'];                    
                    $CountryId = $this->data['Province']['country_id'];  
                    $CountryCode = $this->data['Province']['country_code'];  
                    $CountryName = $this->data['Province']['country_name'];                    
                    $ContinentId = $this->data['Province']['continent_id'];
                    $ContinentCode = $this->data['Province']['continent_code'];
                    $ContinentName = $this->data['Province']['continent_name'];
                    $ProvinceDescription = $this->data['Province']['description'];
                    $TopProvince = strtolower($this->data['Province']['top_province']);
                    $status = $Provinces['Province']['status'];
                    if($status == '1')
                        $status = 'true';
                    else
                        $status = 'false';
                    $Active = strtolower($Provinces['Province']['active']);
                    $is_update = $Provinces['Province']['is_update'];
                    if ($is_update == 'Y')
                        $actiontype = 'Update';
                    else
                        $actiontype = 'AddNew';
                    //$modified = explode(' ', $Provinces['Province']['modified']);
                      $ModifiedDate = '1111-01-01T00:00:00';
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Province</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="'.$actiontype.'">
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>
                                                                <CountryId>'.$CountryId.'</CountryId>
                                                                <CountryCode><![CDATA['.$CountryCode.']]></CountryCode>
                                                                <CountryName><![CDATA['.$CountryName.']]></CountryName>
                                                                <ContinentId>'.$ContinentId.'</ContinentId>
                                                                <ContinentCode><![CDATA['.$ContinentCode.']]></ContinentCode>
                                                                <ContinentName><![CDATA['.$ContinentName.']]></ContinentName>
                                                                <TopProvince>'.$TopProvince.'</TopProvince>
                                                                <ProvinceNameJP></ProvinceNameJP>
                                                                <ProvinceNameFR></ProvinceNameFR>
                                                                <ProvinceNameDE></ProvinceNameDE>
                                                                <ProvinceNameCN></ProvinceNameCN>
                                                                <ProvinceNameCNT></ProvinceNameCNT>
                                                                <ProvinceNameIT></ProvinceNameIT>
                                                                <ProvinceNameES></ProvinceNameES>
                                                                <ProvinceNameKR></ProvinceNameKR>
                                                                <ProvinceNameURL></ProvinceNameURL>
                                                                <ProvinceURLTEMP1></ProvinceURLTEMP1>
                                                                <ProvinceURLTEMP2></ProvinceURLTEMP2>
                                                                <ProvinceURLTEMP3></ProvinceURLTEMP3>
                                                                <ProvinceDescription><![CDATA['.$ProvinceDescription.']]></ProvinceDescription>
                                                                <ProvinceKeyword></ProvinceKeyword>
                                                                <Active>'.$Active.'</Active>
                                                                <WtbStatus>true</WtbStatus>
                                                                <Status>'.$status.'</Status>
                                                                <CreatedBy>'.$user_id.'</CreatedBy>
                                                                <CreatedDate>'.$CreatedDate.'</CreatedDate>
                                                                <ModifiedDate>'.$ModifiedDate.'</ModifiedDate>
                                                            </ResourceDetailsData>                         
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                    $log_call_screen = 'Province - Edit';

                    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                    $client = new SoapClient(null, array(
                        'location' => $location_URL,
                        'uri' => '',
                        'trace' => 1,
                    ));

                    try {
                        $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);

                        $xml_arr = $this->xml2array($order_return);
                          

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->Province->updateAll(array('Province.wtb_status' => "'1'", 'Province.is_update' => "'Y'"), array('Province.id' => $ProvinceId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->Province->updateAll(array('Province.wtb_status' => "'2'"), array('Province.id' => $ProvinceId));
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
                    

                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Province.', 'failure');
                }
            }
        }


        $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'id,country_name,country_code', 'conditions' => array('continent_id' => $Provinces['Province']['continent_id'], 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
        $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
     

        $TravelLookupContinents = $this->TravelLookupContinent->find('all', array('fields' => 'id,continent_name,continent_code', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $TravelLookupContinents = Set::combine($TravelLookupContinents, '{n}.TravelLookupContinent.id', array('%s - %s', '{n}.TravelLookupContinent.continent_code', '{n}.TravelLookupContinent.continent_name'));
        
        $this->set(compact('TravelLookupContinents','TravelCountries'));


        $this->request->data = $Provinces;
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
            throw new NotFoundException(__('Invalid Province'));
        }

        $Provinces = $this->Province->findById($id);

        if (!$Provinces) {
            throw new NotFoundException(__('Invalid Province'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Province->set($this->data);
            if ($this->Province->validates() == true) {

                if ($this->Province->updateAll(array('Province.active' => '"' . $this->data['Province']['active'] . '"'), array('Province.id' => $id))) {
                    $ProvinceId = $id;
                    $ProvinceName = $Provinces['Province']['name'];                  
                    $CountryId = $Provinces['Province']['country_id'];
                    $CountryCode = $Provinces['Province']['country_code']; 
                    $CountryName = $Provinces['Province']['country_name'];
                    $ContinentId = $Provinces['Province']['continent_id'];
                    $ContinentCode = $Provinces['Province']['continent_code'];
                    $ContinentName = $Provinces['Province']['continent_name'];
                    $ProvinceDescription = $Provinces['Province']['description'];
                    $TopProvince = strtolower($Provinces['Province']['top_province']);
                    $Active = strtolower($this->data['Province']['active']);
                    $is_update = $Provinces['Province']['is_update'];
                    if ($is_update == 'Y')
                        $actiontype = 'Update';
                    else
                        $actiontype = 'AddNew';
                    $status = $Provinces['Province']['status'];
                    if($status == '1')
                        $status = 'true';
                    else
                        $status = 'false';
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Province</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>
                                                                <CountryId>'.$CountryId.'</CountryId>
                                                                <CountryCode><![CDATA['.$CountryCode.']]></CountryCode>
                                                                <CountryName><![CDATA['.$CountryName.']]></CountryName>
                                                                <ContinentId>'.$ContinentId.'</ContinentId>
                                                                <ContinentCode><![CDATA['.$ContinentCode.']]></ContinentCode>
                                                                <ContinentName><![CDATA['.$ContinentName.']]></ContinentName>
                                                                <TopProvince>'.$TopProvince.'</TopProvince>
                                                                <ProvinceNameJP></ProvinceNameJP>
                                                                <ProvinceNameFR></ProvinceNameFR>
                                                                <ProvinceNameDE></ProvinceNameDE>
                                                                <ProvinceNameCN></ProvinceNameCN>
                                                                <ProvinceNameCNT></ProvinceNameCNT>
                                                                <ProvinceNameIT></ProvinceNameIT>
                                                                <ProvinceNameES></ProvinceNameES>
                                                                <ProvinceNameKR></ProvinceNameKR>
                                                                <ProvinceNameURL></ProvinceNameURL>
                                                                <ProvinceURLTEMP1></ProvinceURLTEMP1>
                                                                <ProvinceURLTEMP2></ProvinceURLTEMP2>
                                                                <ProvinceURLTEMP3></ProvinceURLTEMP3>
                                                                <ProvinceDescription><![CDATA['.$ProvinceDescription.']]></ProvinceDescription>
                                                                <ProvinceKeyword></ProvinceKeyword>
                                                                <Active>'.$Active.'</Active>
                                                                <WtbStatus>true</WtbStatus>
                                                                <Status>'.$status.'</Status>
                                                                <CreatedBy>'.$user_id.'</CreatedBy>
                                                                <CreatedDate>'.$CreatedDate.'</CreatedDate>
                                                                <ModifiedDate>1111-01-01T00:00:00</ModifiedDate>
                                                            </ResourceDetailsData>
                         
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                    $log_call_screen = 'Province - ' . $ACTIVE_MSG;

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

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->Province->updateAll(array('Province.wtb_status' => "'1'", 'Province.is_update' => "'Y'"), array('Province.id' => $ProvinceId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->Province->updateAll(array('Province.wtb_status' => "'2'"), array('Province.id' => $ProvinceId));
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
                  

                    $message = 'Local record has been successfully updated.<br />' . $xml_msg;
                    $this->Session->setFlash($message, 'success');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Unable to update Province.', 'failure');
                }
            }
        }

        $Types = array($type);
       $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'id,country_name,country_code', 'conditions' => array('continent_id' => $Provinces['Province']['continent_id'], 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
        $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
     

        $TravelLookupContinents = $this->TravelLookupContinent->find('all', array('fields' => 'id,continent_name,continent_code', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $TravelLookupContinents = Set::combine($TravelLookupContinents, '{n}.TravelLookupContinent.id', array('%s - %s', '{n}.TravelLookupContinent.continent_code', '{n}.TravelLookupContinent.continent_name'));
        $this->set(compact('TravelLookupContinents', 'TravelCountries', 'Types'));

        $this->request->data = $Provinces;
    }

    public function retry($id = null) {

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        if (!$id) {
            throw new NotFoundException(__('Invalid Province'));
        }

        $Provinces = $this->Province->findById($id);

        if (!$Provinces) {
            throw new NotFoundException(__('Invalid Province'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Province->set($this->data);
            if ($this->Province->validates() == true) {           
                    $ProvinceId = $id;
                    $ProvinceName = $Provinces['Province']['name'];                  
                    $CountryId = $Provinces['Province']['country_id'];
                    $CountryCode = $Provinces['Province']['country_code']; 
                    $CountryName = $Provinces['Province']['country_name'];
                    $ContinentId = $Provinces['Province']['continent_id'];
                    $ContinentCode = $Provinces['Province']['continent_code'];
                    $ContinentName = $Provinces['Province']['continent_name'];
                    $ProvinceDescription = $Provinces['Province']['description'];
                    $TopProvince = strtolower($Provinces['Province']['top_province']);
                    $Active = strtolower($Provinces['Province']['active']);
                    $is_update = $Provinces['Province']['is_update'];
                    if ($is_update == 'Y')
                        $actiontype = 'Update';
                    else
                        $actiontype = 'AddNew';
                    $status = $Provinces['Province']['status'];
                    if($status == '1')
                        $status = 'true';
                    else
                        $status = 'false';
                    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                    $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Province</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">
                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>
                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>
                                                                <CountryId>'.$CountryId.'</CountryId>
                                                                <CountryCode><![CDATA['.$CountryCode.']]></CountryCode>
                                                                <CountryName><![CDATA['.$CountryName.']]></CountryName>
                                                                <ContinentId>'.$ContinentId.'</ContinentId>
                                                                <ContinentCode><![CDATA['.$ContinentCode.']]></ContinentCode>
                                                                <ContinentName><![CDATA['.$ContinentName.']]></ContinentName>
                                                                <TopProvince>'.$TopProvince.'</TopProvince>
                                                                <ProvinceNameJP></ProvinceNameJP>
                                                                <ProvinceNameFR></ProvinceNameFR>
                                                                <ProvinceNameDE></ProvinceNameDE>
                                                                <ProvinceNameCN></ProvinceNameCN>
                                                                <ProvinceNameCNT></ProvinceNameCNT>
                                                                <ProvinceNameIT></ProvinceNameIT>
                                                                <ProvinceNameES></ProvinceNameES>
                                                                <ProvinceNameKR></ProvinceNameKR>
                                                                <ProvinceNameURL></ProvinceNameURL>
                                                                <ProvinceURLTEMP1></ProvinceURLTEMP1>
                                                                <ProvinceURLTEMP2></ProvinceURLTEMP2>
                                                                <ProvinceURLTEMP3></ProvinceURLTEMP3>
                                                                <ProvinceDescription><![CDATA['.$ProvinceDescription.']]></ProvinceDescription>
                                                                <ProvinceKeyword></ProvinceKeyword>
                                                                <Active>'.$Active.'</Active>
                                                                <WtbStatus>true</WtbStatus>
                                                                <Status>'.$status.'</Status>
                                                                <CreatedBy>'.$user_id.'</CreatedBy>
                                                                <CreatedDate>'.$CreatedDate.'</CreatedDate>
                                                                <ModifiedDate>1111-01-01T00:00:00</ModifiedDate>
                                                            </ResourceDetailsData>                         
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


                    $log_call_screen = 'Province - Re-try';

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

                        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                            $xml_msg = "Foreign record has been successfully updated [Code:$log_call_status_code]";
                            $this->Province->updateAll(array('Province.wtb_status' => "'1'", 'Province.is_update' => "'Y'"), array('Province.id' => $ProvinceId));
                        } else {

                            $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                            $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_PROVINCE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                            $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
                            $this->Province->updateAll(array('Province.wtb_status' => "'2'"), array('Province.id' => $ProvinceId));
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

                    $this->redirect(array('action' => 'index'));              
            }
        }

       $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'id,country_name,country_code', 'conditions' => array('continent_id' => $Provinces['Province']['continent_id'], 'country_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'country_name ASC'));
       $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));
       //pr($TravelCountries);

        $TravelLookupContinents = $this->TravelLookupContinent->find('all', array('fields' => 'id,continent_name,continent_code', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $TravelLookupContinents = Set::combine($TravelLookupContinents, '{n}.TravelLookupContinent.id', array('%s - %s', '{n}.TravelLookupContinent.continent_code', '{n}.TravelLookupContinent.continent_name'));
        $this->set(compact('TravelLookupContinents', 'TravelCountries'));

        $this->request->data = $Provinces;
    }

}