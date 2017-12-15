<?php

/**
 * XmlTest controller.
 *
 * This file will render views from views/XmlTests/
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
App::uses('AppController', 'Controller');

// App::uses('Xml', 'Utility');
/**
 * XmlTest controller
 *
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class XmlTestsController extends AppController {

    public $uses = array('LogCall');

    public function index() {
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $log_call_screen = '';
        $user_id = $this->Auth->user('id');

        if ($this->request->is('post')) {

            if ($this->data['Test']['mapping_type'] == '1') {

                $SupplierCode = $this->data['Test']['country_supplier_code'];
                $Active = $this->data['Test']['country_active'];
                $Exclude = $this->data['Test']['country_exclude'];
                $CountryCode = $this->data['Test']['pf_country_code'];
                $SupplierCountryCode = $this->data['Test']['supplier_country_code'];

                $content_xml_str = '<MappingDetailsData srno="1" mappingtype="countrysupplier">
                                <SupplierCode>' . $SupplierCode . '</SupplierCode>
                                <Active>' . $Active . '</Active>
                                <Exclude>' . $Exclude . '</Exclude>                                
                                <CountryCode>' . $CountryCode . '</CountryCode>                                
                                <SupplierCountryCode>' . $SupplierCountryCode . '</SupplierCountryCode>                            
                                </MappingDetailsData>';
                $log_call_screen = 'Test Mapping Country';
                $message = "SupplierCode = $SupplierCode, Active= $Active, Exclude=  $Exclude, CountryCode = $CountryCode,SupplierCountryCode= $SupplierCountryCode";
            } elseif ($this->data['Test']['mapping_type'] == '2') {

                $SupplierCode = $this->data['Test']['city_supplier_code'];
                $Active = $this->data['Test']['city_active'];
                $Exclude = $this->data['Test']['city_exclude'];
                $CountryCode = $this->data['Test']['city_country_code'];
                $CityCode = $this->data['Test']['pf_city_code'];
                $SupplierCountryCode = $this->data['Test']['supplier_city_country_code'];
                $SupplierCityCode = $this->data['Test']['supplier_city_code'];

                $content_xml_str = '<MappingDetailsData srno="1" mappingtype="citysupplier">
                               <SupplierCode>' . $SupplierCode . '</SupplierCode>
                                <Active>' . $Active . '</Active>
                                <Exclude>' . $Exclude . '</Exclude>
                                <CountryCode>' . $CountryCode . '</CountryCode>
                                <CityCode>' . $CityCode . '</CityCode>
                                <SupplierCountryCode>' . $SupplierCountryCode . '</SupplierCountryCode>
                                <SupplierCityCode>' . $SupplierCityCode . '</SupplierCityCode>                          
                                </MappingDetailsData>';
                $log_call_screen = 'Test Mapping City';
                $message = "SupplierCode = $SupplierCode, Active= $Active, Exclude=  $Exclude, CountryCode = $CountryCode,CityCode = $CityCode, SupplierCountryCode= $SupplierCountryCode, SupplierCityCode= $SupplierCityCode, SupplierCityCode= $SupplierCityCode";
            } elseif ($this->data['Test']['mapping_type'] == '3') {

                $SupplierCode = $this->data['Test']['hotel_supplier_code'];
                $Active = $this->data['Test']['hotel_active'];
                $Exclude = $this->data['Test']['hotel_exclude'];
                $CountryCode = $this->data['Test']['hotel_country_code'];
                $CityCode = $this->data['Test']['hotel_city_code'];
                $SupplierCountryCode = $this->data['Test']['hotel_supplier_country_code'];
                $SupplierCityCode = $this->data['Test']['hotel_supplier_city_code'];
                $HotelCode = $this->data['Test']['hotel_code'];
                $SupplierHotelCode = $this->data['Test']['hotel_supplier_hotel_code'];

                $content_xml_str = '<MappingDetailsData srno="1" mappingtype="hotelsupplier">
                               <SupplierCode>' . $SupplierCode . '</SupplierCode>
                                <Active>' . $Active . '</Active>
                                <Exclude>' . $Exclude . '</Exclude>                               
                                <CountryCode>' . $CountryCode . '</CountryCode>
                                <CityCode>' . $CityCode . '</CityCode>
                                <HotelCode>' . $HotelCode . '</HotelCode>                                                    
                                <SupplierCountryCode>' . $SupplierCountryCode . '</SupplierCountryCode>
                                <SupplierCityCode>' . $SupplierCityCode . '</SupplierCityCode>
                                <SupplierHotelCode>' . $SupplierHotelCode . '</SupplierHotelCode>                              
                                </MappingDetailsData>';
                $log_call_screen = 'Test Mapping Hotel';
                $message = "SupplierCode = $SupplierCode, Active= $Active, Exclude=  $Exclude, CountryCode = $CountryCode,CityCode = $CityCode, SupplierCountryCode= $SupplierCountryCode, SupplierCityCode= $SupplierCityCode, HotelCode= $HotelCode, SupplierHotelCode= $SupplierHotelCode";
            }




            $xml_string = Configure::read('start_xml_str') . $content_xml_str . Configure::read('end_xml_str');



            $client = new SoapClient(null, array(
                'location' => $location_URL,
                'uri' => '',
                'trace' => 1,
            ));

            try {
                $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
//Get response from here
                $xml_arr = $this->xml2array($order_return);
                if (isset($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['SUPPLIERMAPPINGRESPONSE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0])) {
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['SUPPLIERMAPPINGRESPONSE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['SUPPLIERMAPPINGRESPONSE']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
                } else {

                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['SUPPLIERMAPPINGREQUEST']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['SUPPLIERMAPPINGREQUEST']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
                }
                $mess_str = $message . '<br>' . $order_return;
                $this->Session->setFlash($mess_str, 'success');
            } catch (SoapFault $exception) {
                var_dump(get_class($exception));
                var_dump($exception);
            }

            $this->request->data['LogCall']['log_call_nature'] = 'Test';
            $this->request->data['LogCall']['log_call_type'] = 'Outbound';
            $this->request->data['LogCall']['log_call_parms'] = trim($xml_string);
            $this->request->data['LogCall']['log_call_status_code'] = $log_call_status_code;
            $this->request->data['LogCall']['log_call_status_message'] = $log_call_status_message;
            $this->request->data['LogCall']['log_call_screen'] = $log_call_screen;
            $this->request->data['LogCall']['log_call_counterparty'] = 'WTBNETWORKS';
            $this->request->data['LogCall']['log_call_by'] = $user_id;
            $this->LogCall->save($this->request->data['LogCall']);
        }
    }

}