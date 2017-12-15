<?php

/** 
 * TravelHotelLookups controller.
 *
 * This file will render views from views/TravelHotelLookups/
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
App::uses('Xml', 'Utility');
/**
 * Email sender
 */
App::uses('AppController', 'Controller');

/**
 * Builder controller
 *
 * 
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class TravelHotelReviewsController extends AppController {

    public $uses = array('TravelHotelLookup', 'TravelHotelRoomSupplier', 'TravelCountry', 'TravelLookupContinent', 'TravelLookupValueContractStatus', 'TravelCity', 'TravelChain',
        'TravelSuburb', 'TravelArea', 'TravelBrand', 'TravelActionItem', 'TravelRemark', 'LogCall', 'User', 'Province', 'ProvincePermission', 'ReviewPermission', 'DeleteTravelHotelLookup', 'DeleteLogTable',
        'TravelLookupRateType', 'TravelLookupPropertyType', 'TravelCitySupplier', 'TravelHotelReview', 'TravelHotelAmenitie', 'TravelLookupAmenityCategorie','TravelLookupAmenityType', 'TravelHotelReviewItem', 'TravelLookupReviewTopic','Common','TravelWtbError');
    public $components = array('Sms', 'Image','RequestHandler');

    public $uploadDir;


    public function beforeFilter() {
        parent::beforeFilter();
        $this->uploadDir = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . '/uploads/hotels';
        $this->Auth->allow('index','test');
        $this->Width = '200';
        $this->Height = '200';
		
		
		$this->WidthFirst = '200';
        $this->HeightFirst = '150';
		
		$this->WidthSecond  = '100';
        $this->HeightSecond = '75';
    }

    public function index() {

        
        $city_id = $this->Auth->user('city_id');
        $user_id = $this->Auth->user('id');
        
        $search_condition = array();
        $service_status = '';
        $hotel_name = '';
        $continent_id = '';
        $country_id = '';
        $city_id = '';
		$is_page ='';                
		$mapping_status = '';
        $suburb_id = '';
        $area_id = '';
        $chain_id = '';
        $brand_id = '';
        $status = '';
        $wtb_status = '';
        $active = '';
        $province_id = '';
        $TravelCities = array();
        $TravelCountries = array();
        $TravelSuburbs = array();
        $TravelAreas = array();
        $TravelChains = array();
        $TravelBrands = array();
        $Provinces = array();
        $proArr = array();
        $conProvince = array();
        $TravelHotelLookups = array();


 
        //next($proArr);

        if(isset($_REQUEST['a'])){
            $service_status = "";
            $this->Session->setFlash('Hotel Review Submitted successfully.', 'success');
        } 
/*        
        else {
            if ($this->ServiceCheck() == 'true'){
               $service_status = "All services running normally.";
            }   else {
               $service_status = "Some services are offline. Please try later.";
            }  
        }
*/
            if($this->checkReviewProvince())

            $proArr = $this->checkReviewProvince();

        //if ($this->checkReviewProvince()) {
           
            array_push($search_condition, array('TravelHotelLookup.province_id' => $this->checkReviewProvince()));
            
        //}
$check = false;		
        
if(!empty($this->request->params['named']['continent_id'])){
  $continent_id = $this->request->params['named']['continent_id'];
   $this->request->data['TravelHotelLookup']['continent_id'] = $continent_id; 
  $check = true;	
}
if(!empty($this->request->params['named']['country_id'])){
  $country_id = $this->request->params['named']['country_id'];
  $this->request->data['TravelHotelLookup']['country_id'] = $country_id;
  $check = true;	
}

if(!empty($this->request->params['named']['province_id'])){
  $province_id = $this->request->params['named']['province_id'];
  $this->request->data['TravelHotelLookup']['province_id'] = $province_id;
  $check = true;	
}

if(!empty($this->request->params['named']['city_id'])){
  $city_id = $this->request->params['named']['city_id'];
  $this->request->data['TravelHotelLookup']['city_id'] = $city_id;
  $check = true;	
}

if(!empty($this->request->params['named']['is_page'])){
  $is_page = $this->request->params['named']['is_page'];
  $this->request->data['TravelHotelLookup']['is_page'] = $is_page;
  $check = true;	
}

if(!empty($this->request->params['named']['mapping_status'])){
  $mapping_status = $this->request->params['named']['mapping_status'];
  $this->request->data['TravelHotelLookup']['mapping_status'] = $mapping_status;
  $check = true;	
}

        if ($this->request->is('post') || $this->request->is('put') || $check == true) { 
            if (!empty($this->data['TravelHotelLookup']['hotel_name'])) {
                $hotel_name = $this->data['TravelHotelLookup']['hotel_name'];
                array_push($search_condition, array("SupplierHotel.hotel_name LIKE '%$hotel_name%'"));
            }

            if (!empty($this->data['TravelHotelLookup']['continent_id'])) {
                $continent_id = $this->data['TravelHotelLookup']['continent_id'];
                array_push($search_condition, array('TravelHotelLookup.continent_id' => $continent_id));
                $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'id, country_name,country_code', 'conditions' => array('TravelCountry.continent_id' => $continent_id,
                        'TravelCountry.country_status' => '1',
                        'TravelCountry.wtb_status' => '1',
                        'TravelCountry.active' => 'TRUE'), 'order' => 'country_code ASC'));
                $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));

            }



            if (!empty($this->data['TravelHotelLookup']['country_id'])) {

                $country_id = $this->data['TravelHotelLookup']['country_id'];
                $province_id = $this->data['TravelHotelLookup']['province_id'];
                array_push($search_condition, array('TravelHotelLookup.country_id' => $country_id));

                $TravelCities = $this->TravelCity->find('list', array('fields' => 'id, city_name', 'conditions' => array('TravelCity.province_id' => $province_id,

                        'TravelCity.city_status' => '1',
                        'TravelCity.wtb_status' => '1',
                        'TravelCity.active' => 'TRUE',), 'order' => 'city_name ASC'));
            }

            if (!empty($this->data['TravelHotelLookup']['province_id'])) {

                

                array_push($search_condition, array('TravelHotelLookup.province_id' => $province_id));

                $Provinces = $this->Province->find('list', array(

                'conditions' => array(

                    'Province.country_id' => $country_id,

                    'Province.continent_id' => $continent_id,

                    'Province.status' => '1',

                    'Province.wtb_status' => '1',

                    'Province.active' => 'TRUE',

                    'Province.id' => $proArr

                ),

                'fields' => array('Province.id', 'Province.name'),

                'order' => 'Province.name ASC'

            ));

            }

            if (!empty($this->data['TravelHotelLookup']['city_id'])) {

                $city_id = $this->data['TravelHotelLookup']['city_id'];

                array_push($search_condition, array('TravelHotelLookup.city_id' => $city_id));

            }
			
			if (!empty($this->data['TravelHotelLookup']['is_page'])) {



                $is_page = $this->data['TravelHotelLookup']['is_page'];

				if($is_page == 'N'){
					
					 array_push($search_condition, array('TravelHotelLookup.is_page' => ' '));
				}else{
					 array_push($search_condition, array('TravelHotelLookup.is_page' => $is_page));
				}

               



            }
			$joins = array();
			$checkMapped = '';
			
			if(!empty($this->data['TravelHotelLookup']['mapping_status']))
			{
				$mapping_status = $this->data['TravelHotelLookup']['mapping_status'];
				if($this->data['TravelHotelLookup']['mapping_status'] == 'Mapped')
				{				
					$checkMapped = 'TravelHotelRoomSupplier.hotel_code IS NOT NULL';	
				}
				if($this->data['TravelHotelLookup']['mapping_status'] == 'Unmapped')
				{				
					$checkMapped = 'TravelHotelRoomSupplier.hotel_code IS NULL';
				}
			
				$joins = array(
						array(
							'table' => 'travel_hotel_room_suppliers',
							'alias' => 'TravelHotelRoomSupplier',
							'type' => 'LEFT',
							'conditions' => array('TravelHotelRoomSupplier.hotel_id = TravelHotelLookup.id'),

						),
					);
			array_push($search_condition, array($checkMapped));
			$this->paginate['joins'] = $joins;
			}

			
            
            $TravelHotelLookups = $this->TravelHotelLookup->find('all', array(          
            'joins' => $joins,
            'conditions' => $search_condition,
            'order' => 'TravelHotelLookup.hotel_name',
            ));

      // $log = $this->TravelHotelLookup->getDataSource()->getLog(false, false);       
//
   //    debug($log);
     //  die;
            
            
        } 








        /*
          elseif(count($this->params['named'])){
          foreach($this->params['named'] as $key=>$val){
          array_push($search_condition, array('TravelHotelLookup.' .$key.' LIKE' => '%'.$val.'%')); // when builder is approve/pending
          }
          }
         * 
         */
        //array_push($search_condition, array('TravelHotelLookup.country_id' => '220'));

        



       
        if (!isset($this->passedArgs['continent_id']) && empty($this->passedArgs['continent_id'])) {
            $this->passedArgs['continent_id'] = (isset($this->data['TravelHotelLookup']['continent_id'])) ? $this->data['TravelHotelLookup']['continent_id'] : '';
        }
        if (!isset($this->passedArgs['country_id']) && empty($this->passedArgs['country_id'])) {
            $this->passedArgs['country_id'] = (isset($this->data['TravelHotelLookup']['country_id'])) ? $this->data['TravelHotelLookup']['country_id'] : '';
        }      
        if (!isset($this->passedArgs['province_id']) && empty($this->passedArgs['province_id'])) {
            $this->passedArgs['province_id'] = (isset($this->data['TravelHotelLookup']['province_id'])) ? $this->data['TravelHotelLookup']['province_id'] : '';
        }
        if (!isset($this->passedArgs['city_id']) && empty($this->passedArgs['city_id'])) {
            $this->passedArgs['city_id'] = (isset($this->data['TravelHotelLookup']['city_id'])) ? $this->data['TravelHotelLookup']['city_id'] : '';
        }
		
		if (!isset($this->passedArgs['is_page']) && empty($this->passedArgs['is_page'])) {
            $this->passedArgs['is_page'] = (isset($this->data['TravelHotelLookup']['is_page'])) ? $this->data['TravelHotelLookup']['is_page'] : '';
        }
		
		if (!isset($this->passedArgs['mapping_status']) && empty($this->passedArgs['mapping_status'])) {
            $this->passedArgs['mapping_status'] = (isset($this->data['TravelHotelLookup']['mapping_status'])) ? $this->data['TravelHotelLookup']['mapping_status'] : '';
        }



        if (!isset($this->data) && empty($this->data)) {
          
            $this->data['TravelHotelLookup']['continent_id'] = $this->passedArgs['continent_id'];
            $this->data['TravelHotelLookup']['country_id'] = $this->passedArgs['country_id'];
            $this->data['TravelHotelLookup']['province_id'] = $this->passedArgs['province_id'];
            $this->data['TravelHotelLookup']['city_id'] = $this->passedArgs['city_id'];
			$this->data['TravelHotelLookup']['is_page'] = $this->passedArgs['is_page'];
			$this->data['TravelHotelLookup']['mapping_status'] = $this->passedArgs['mapping_status'];
			
        }
		
		if ($this->request->is('post') || $this->request->is('put') || $check == true) { 
			$TravelHotelLookups = $this->paginate("TravelHotelLookup", $search_condition);
		}
		
        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'order' => 'continent_name ASC'));
        
		$PageStatus = array('Y'=>'Yes', 'N'=>'No');	
        $MappingStatus = array('Mapped'=>'Mapped', 'Unmapped'=>'Unmapped'); 
  
        
        $this->set(compact('hotel_name', 'continent_id','TravelHotelLookups', 'country_id', 'city_id', 'suburb_id', 'area_id', 'TravelChains', 'status', 'active', 'chain_id', 'brand_id', 'wtb_status', 'TravelCountries', 'TravelCities', 'TravelSuburbs', 'TravelAreas', 'TravelChains', 'TravelBrands', 'TravelLookupValueContractStatuses', 'TravelLookupContinents', 'mapped_count', 'srilanka_count', 'maldives_count', 'singapore_count', 'malaysia_count', 'new_zealand_count', 'melbourne_count', 'abu_dhabi_count', 'sharjah_count', 'dubai_count', 'uae_count', 'india_count', 'phuket_count', 'pattaya_count', 'bangkok_count', 'thailand_count', 'below_three_star_count', 'three_star_count', 'four_five_star', 'Provinces', 'province_id','service_status','user_id','PageStatus','MappingStatus','mapping_status','is_page')); 
    }

    public function ServiceCheck() {

        $headding = '';
        $order_return = '';
        $log_call_screen = '';
        $xml_msg = '';
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
        
                        $content_xml_str = '<soap:Body>

                                        <ProcessXML xmlns="http://www.travel.domain/">

                                            <RequestInfo>

                                                <ResourceDataRequest>

                                                    <RequestAuditInfo>

                                                        <RequestType>PXML_RequestServiceInfo</RequestType>

                                                        <RequestTime>' . $CreatedDate . '</RequestTime>

                                                        <RequestResource>Silkrouters</RequestResource>

                                                    </RequestAuditInfo>

                                                    <RequestParameters>                        

                                                        <ResourceData>

                                                            <ResourceDetailsData actiontype="CheckRequestAll">

                                                                <Language>UK/US-ENGLISH</Language>

                                                            </ResourceDetailsData>              

                                                    </ResourceData>

                                                    </RequestParameters>

                                                </ResourceDataRequest>

                                            </RequestInfo>

                                        </ProcessXML>

                                    </soap:Body>';


        $RESOURCEDATA = 'RESOURCEDATA_REQUESTSERVICEINFO';
        $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
                $client = new SoapClient(null, array(
                    'location' => $location_URL,
                    'uri' => '',
                    'trace' => 1,
                ));

                try {
                    $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
                    $xml_arr = $this->xml2array($order_return);
                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
                        return 'true';
                    } else {
                        return 'false';
                    }
                } catch (SoapFault $exception) {
                    var_dump(get_class($exception));
                    var_dump($exception);
                }
                
    }
  
    public function edit($id) {

        $is_service = '';           
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');

        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $actio_itme_id = '';
        $flag = 0;
 

        $TravelCountries = array();
        $TravelCities = array();
        $TravelSuburbs = array();
        $TravelAreas = array();
        $TravelBrands = array();
        $Provinces = array();
        $ConArry = array();
        
        $AmenityCategories = array();
        $AmenityTypes = array();        

        $arr = explode('_', $id);
        $id = $arr[0];

        if (!$id) {
            throw new NotFoundException(__('Invalid Hotel'));
        }

        $TravelHotelLookups = $this->TravelHotelLookup->findById($id);

        if (!$TravelHotelLookups) {
            throw new NotFoundException(__('Invalid Hotel'));
        }

        if ($this->IsService() == 'true'){
           $is_service = "All services running normally.";
        }   else {
           $is_service = "Some services are offline. Please try later.";
        } 
      
        $this->set(compact('is_service'));        

        //echo $next_action_by;
///ECHO '<PRE>';
//print_r($_POST); DIE;

$active_amenity = 'TRUE';
$active_review = 'TRUE';
$actiontype = $this->data['TravelHotelLookup']['action_type'];
$count_amenities = count($this->request->data['TravelHotelAmenitie']['amenity_type_id']);
$count_reviews = count($this->request->data['TravelHotelReviewItem']['review_topic_id']);
$HotelId = $id;
$action_amenity_type = 0;
$action_review_type = 0;
$action_other_type = 0;
$message = '';
$xml_msg = '';
$CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

$continent_id = $this->request->params['named']['continent_id'];    
  $country_id = $this->request->params['named']['country_id'];
  $province_id = $this->request->params['named']['province_id']; 
  $city_id = $this->request->params['named']['city_id'];
  $is_page = $this->request->params['named']['is_page']; 
  $mapping_status = $this->request->params['named']['mapping_status'];

        if ($this->request->is('post') || $this->request->is('put')) {
            /*var_dump($_POST);
            exit();*/
            
            /*             * *******************Amenity************************ */
           
            if ($action_amenity_type == '0') {

                if (count($this->request->data['TravelHotelAmenitie']['amenity_type_id']) > 0 && !empty($this->data['TravelHotelAmenitie']['amenity_type_id'])) {
                    if($this->TravelHotelAmenitie->deleteAll(array('TravelHotelAmenitie.hotel_id' => $id))) // delete project amenity by project id
					{
						// Amenity delete using xml call
						$content_xml_str = '<soap:Body>
											<ProcessXML xmlns="http://www.travel.domain/">
											  <RequestInfo>
												<ResourceDataRequest>
												  <RequestAuditInfo>
													<RequestType>PXML_WData_LookupDelete</RequestType>
													<RequestTime>'.$CreatedDate.'</RequestTime>
													<RequestResource>Silkrouters</RequestResource>
												  </RequestAuditInfo>
												  <RequestParameters>
													<ResourceData>
													  <ResourceDetailsData srno="1" lookuptype="HotelAmenityByHotel">
														<HotelAmenityByHotelId>'.$id.'</HotelAmenityByHotelId>       
													</ResourceDetailsData>
													</ResourceData>
												  </RequestParameters>
												</ResourceDataRequest>
											  </RequestInfo>
											</ProcessXML>
										  </soap:Body>';
										  
						$log_call_screen = 'Hotel Review Amenity - Delete';
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
							if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
								$xml_msg = "Foreign record has been successfully hotal review amenity deleted [Code:$log_call_status_code]";
							} else {
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
								$xml_msg = "There was a problem with foreign record hotal review amenity deletion [Code:$log_call_status_code]";
								$xml_error = 'TRUE';
							}

						} catch (SoapFault $exception) {
							var_dump(get_class($exception));
							var_dump($exception);
                            exit();
						}

						/*	$this->request->data['LogCall']['log_call_nature'] = 'Production';
							$this->request->data['LogCall']['log_call_type'] = 'Outbound';
							$this->request->data['LogCall']['log_call_parms'] = trim($xml_string);
							$this->request->data['LogCall']['log_call_status_code'] = $log_call_status_code;
							$this->request->data['LogCall']['log_call_status_message'] = $log_call_status_message;
							$this->request->data['LogCall']['log_call_screen'] = $log_call_screen;
							$this->request->data['LogCall']['log_call_counterparty'] = 'WTBNETWORKS';
							$this->request->data['LogCall']['log_call_by'] = $user_id;
							$this->LogCall->save($this->request->data['LogCall']);
							$LogId = $this->LogCall->getLastInsertId();
							$message .= 'Local record has been successfully deleted.<br />' . $xml_msg;
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

								$Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Log Id [' . $LogId . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
							}
*/						
						$countamenities = 0;
						$amentitiesdata = '';
						foreach ($this->data['TravelHotelAmenitie']['amenity_type_id'] as $val) { 
							$save_amenity[] = array('TravelHotelAmenitie' => array(
									'amenity_type_id' => $val,
									'hotel_id' => $id,                            
									'created_by' => $user_id,
									'modified_by' => $user_id,                            
									'active' => $active_amenity,                             
							)); 
							
							
							
							$countamenities++;
						}
                        
						if($this->TravelHotelAmenitie->saveMany($save_amenity)){
							// Amenity save using xml call
							
							// Get all inserted amenities
						$TravelHotelLookups = $this->TravelHotelLookup->find('first', array('conditions' => array('TravelHotelLookup.id ' => $id) ));
						$HotelName = $TravelHotelLookups['TravelHotelLookup']['hotel_name'];
						$HotelCode = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];
						$aminitetotal = $this->TravelHotelAmenitie->find('count', array('conditions'=>array('TravelHotelAmenitie.hotel_id' => $id)));
						$allamenties = $this->TravelHotelAmenitie->find('all', array('conditions'=>array('TravelHotelAmenitie.hotel_id' => $id)));
						$amcount =1;
						foreach($allamenties as $aamentiry){
							$amentitiesdata .= '<ResourceDetailsData srno="'.$amcount.'" actiontype="AddNew">
														<HotelAmenitiesId>'.$aamentiry['TravelHotelAmenitie']['id'].'</HotelAmenitiesId>
														<HotelId>'.$id.'</HotelId>
														<HotelCode>'.$HotelCode.'</HotelCode>
														<HotelName>'.$HotelName.'</HotelName>
														<AmenityTypeId>'.$val.'</AmenityTypeId>
														<AmenityType>AmenityDetails</AmenityType>
														<Active>'.$active_amenity.'</Active>
														<CreatedBy>'.$user_id.'</CreatedBy>
														<ModifiedBy>'.$user_id.'</ModifiedBy>
														<CreatedDate>'.$CreatedDate.'</CreatedDate>
														<ModifiedDate>'.$CreatedDate.'</ModifiedDate>
													  </ResourceDetailsData>';
													  
													  $amcount++;
						}
						
						$content_xml_str = '<soap:Body>
											<ProcessXML xmlns="http://www.travel.domain/">
											  <RequestInfo>
												<ResourceDataRequest>
												  <RequestAuditInfo>
													<RequestType>PXML_WData_HotelAmenitiesBulk</RequestType>
													<RequestTime>'.$CreatedDate.'</RequestTime>
													<RequestResource>Silkrouters</RequestResource>
												  </RequestAuditInfo>
												  <RequestParameters>
													<ResourceData>
													  <SelectedActionType>AddNew</SelectedActionType>
													  <SelectedCountIn>'.$aminitetotal.'</SelectedCountIn>
													  <MergeData>false</MergeData>
													  '.$amentitiesdata.'
													</ResourceData>
												  </RequestParameters>
												</ResourceDataRequest>
											  </RequestInfo>
											</ProcessXML>
										  </soap:Body>';
										  
						$log_call_screen = 'Hotel Review Amenity - Add';
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
							//echo '<pre>';
							// print_r($xml_arr);
							//die;
							$xml_error = 'FALSE';
							if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTELAMENITIESBULK']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTELAMENITIESBULK']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTELAMENITIESBULK']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
								$xml_msg = "Foreign record has been successfully hotal review amenity added [Code:$log_call_status_code]";
							} else {
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTELAMENITIESBULK']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTELAMENITIESBULK']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
								$xml_msg = "There was a problem with foreign record hotal review amenity added [Code:$log_call_status_code]";
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
							$message .= 'Local record has been successfully updated.<br />' . $xml_msg;
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

								$Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Log Id [' . $LogId . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
							
								/*
								 * WTB Error Information
								 */
								 $pageUrl = "editamenities/$id/continent_id:$continent_id/country_id:$country_id/province_id:$province_id/city_id:$city_id/is_page:$is_page/mapping_status:$mapping_status/hotal_reviews_type:aminities"; 
  
								$this->request->data['TravelWtbError']['error_topic'] = '33'; //travel_lookup_error_topics
								$this->request->data['TravelWtbError']['error_by'] = $user_id;
								$this->request->data['TravelWtbError']['error_time'] = $CreatedDate;                        
								$this->request->data['TravelWtbError']['log_id'] = $LogId;
								$this->request->data['TravelWtbError']['error_entity'] = $id;
								$this->request->data['TravelWtbError']['error_type'] = '13'; // suburb
								$this->request->data['TravelWtbError']['error_status'] = '1';   // Structuretravel_lookup_error_statuses  
								$this->request->data['TravelWtbError']['page_url'] = $pageUrl; // pageurl
								$this->TravelWtbError->create();
								$this->TravelWtbError->save($this->request->data['TravelWtbError']);
								//$redirectUrl = "/travel_hotel_reviews/index/continent_id:$continent_id/country_id:$country_id/province_id:$province_id/city_id:$city_id/is_page:$is_page/mapping_status:$mapping_status"; 
								//$this->redirect($redirectUrl);
								$this->Session->setFlash($message, 'success');

							}else{
								$action_review_type = 1;
							}
							
							$message .= 'SUCCESS::'.'['.$countamenities.']'.' Amenities Saved !!<br>';
							empty($save_amenity);
						}
					}                    
                     
                }
				                
            } 
			
			$hotal_reviews_other_action  = 0;
			
			if ($action_review_type == '1') {


                if (count($this->request->data['TravelHotelReviewItem']['review_topic_id']) > 0 && !empty($this->data['TravelHotelReviewItem']['review_topic_id'])) {
                    if($this->TravelHotelReviewItem->deleteAll(array('TravelHotelReviewItem.hotel_id' => $id))) // delete project amenity by project id
					{

						// Reviews delete using xml call
						$content_xml_str = '<soap:Body>
											<ProcessXML xmlns="http://www.travel.domain/">
											  <RequestInfo>
												<ResourceDataRequest>
												  <RequestAuditInfo>
													<RequestType>PXML_WData_LookupDelete</RequestType>
													<RequestTime>'.$CreatedDate.'</RequestTime>
													<RequestResource>Silkrouters</RequestResource>
												  </RequestAuditInfo>
												  <RequestParameters>
													<ResourceData>
													  <ResourceDetailsData srno="1" lookuptype="ReviewItemByHotel">
														<ReviewItemByHotelId>'.$id.'</ReviewItemByHotelId>
													</ResourceDetailsData>
													</ResourceData>
												  </RequestParameters>
												</ResourceDataRequest>
											  </RequestInfo>
											</ProcessXML>
										  </soap:Body>';
										  
						$log_call_screen = 'Hotel Review Reviews - Delete';
						$xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');

						$client = new SoapClient(null, array(
							'location' => $location_URL,
							'uri' => '',
							'trace' => 1,
						));

						try {
							$order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
							$xml_arr = $this->xml2array($order_return);
							$xml_error = 'FALSE';
							if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
								$xml_msg = "Foreign record has been successfully hotal review deleted [Code:$log_call_status_code]";
							} else {
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
								$xml_msg = "There was a problem with foreign record hotal review deletion [Code:$log_call_status_code]";
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
							$message .= 'Local record has been successfully deleted.<br />' . $xml_msg;
							$a = date('m/d/Y H:i:s', strtotime('-1 hour'));
							$date = new DateTime($a, new DateTimeZone('Asia/Calcutta'));
							/*if ($xml_error == 'TRUE') {
								$Email = new CakeEmail();

								$Email->viewVars(array(
									'request_xml' => trim($xml_string),
									'respon_message' => $log_call_status_message,
									'respon_code' => $log_call_status_code,
								));

								$to = 'biswajit@wtbglobal.com';
								$cc = 'infra@sumanus.com';

								$Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Log Id [' . $LogId . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
							}*/
						
						$counter = 0;
                       
						foreach ($this->data['TravelHotelReviewItem']['review_topic_id'] as $val) { 
							
							$review_score = $this->data['TravelHotelReviewItem']['review_score'][$val-1];        
							$no_of_reviews = $this->data['TravelHotelReviewItem']['no_of_reviews'][$val-1];
						
							$save_reviews[] = array('TravelHotelReviewItem' => array(
									'review_topic_id' => $val,
									'hotel_id' => $id, 
									'review_score' => $review_score, 
									'no_of_reviews' => $no_of_reviews,                             
									'created_by' => $user_id,
									'modified_by' => $user_id,                            
									'active' => $active_review,                              
							)); 
							$counter++;
						}
                        if($this->TravelHotelReviewItem->saveMany($save_reviews)){

							$TravelHotelLookups = $this->TravelHotelLookup->find('first', array('conditions' => array('TravelHotelLookup.id ' => $id) ));
							$HotelName = $TravelHotelLookups['TravelHotelLookup']['hotel_name'];
							$HotelCode = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];
							$reviewtotal = $this->TravelHotelReviewItem->find('count', array('conditions'=>array('TravelHotelReviewItem.hotel_id' => $id)));
							$allreviews = $this->TravelHotelReviewItem->find('all', array('conditions'=>array('TravelHotelReviewItem.hotel_id' => $id)));
							$reviewsxmldata = '';
							$reviewcount = 1;
							foreach($allreviews as $areview){
								$reviewsxmldata.='<ResourceDetailsData srno="'.$reviewcount.'" actiontype="AddNew">
														<ReviewItemsId>'.$areview['TravelHotelReviewItem']['id'].'</ReviewItemsId>
														<HotelId>'.$id.'</HotelId>
														<HotelCode>'.$HotelCode.'</HotelCode>
														<HotelName>'.$HotelName.'</HotelName>
														<ReviewTopicId>'.$areview['TravelHotelReviewItem']['review_topic_id'].'</ReviewTopicId>
														<ReviewTopic>ReviewsDetails</ReviewTopic>
														<ReviewScore>'.$areview['TravelHotelReviewItem']['review_score'].'</ReviewScore>
														<NoofReviews>'.$areview['TravelHotelReviewItem']['no_of_reviews'].'</NoofReviews>
														<CreatedBy>'.$user_id.'</CreatedBy>
														<ModifiedBy>'.$user_id.'</ModifiedBy>
														<CreatedDate>'.$CreatedDate.'</CreatedDate>
														<ModifiedDate>'.$CreatedDate.'</ModifiedDate>
													  </ResourceDetailsData>
													  ';
														  $reviewcount++;
							}
							// Reviews add using xml call
						$content_xml_str = '<soap:Body>
											<ProcessXML xmlns="http://www.travel.domain/">
											  <RequestInfo>
												<ResourceDataRequest>
												  <RequestAuditInfo>
													<RequestType>PXML_WData_ReviewItemsBulk</RequestType>
													<RequestTime>'.$CreatedDate.'</RequestTime>
													<RequestResource>Silkrouters</RequestResource>
												  </RequestAuditInfo>
												  <RequestParameters>
													<ResourceData>
													  <SelectedActionType>AddNew</SelectedActionType>
													  <SelectedCountIn>'.$reviewtotal.'</SelectedCountIn>
													  <MergeData>false</MergeData>
													  '.$reviewsxmldata.'
													</ResourceData>
												  </RequestParameters>
												</ResourceDataRequest>
											  </RequestInfo>
											</ProcessXML>
										  </soap:Body>
										';
									
						$log_call_screen = 'Hotel Review Reviews - Add';
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
							
							$xml_error = 'FALSE';
							if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWITEMSBULK']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWITEMSBULK']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWITEMSBULK']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
								$xml_msg = "Foreign record has been successfully hotal review reviews added [Code:$log_call_status_code]<br>";
							} else {
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWITEMSBULK']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWITEMSBULK']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
								$xml_msg = "There was a problem with foreign record hotal review reviews added [Code:$log_call_status_code]<br>";
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
							$message .= 'Local record has been successfully updated.<br />' . $xml_msg;
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

								$Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Log Id [' . $LogId . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
								
								/*
								 * WTB Error Information
								 */
								 $pageUrl = "editreviews/$id/continent_id:$continent_id/country_id:$country_id/province_id:$province_id/city_id:$city_id/is_page:$is_page/mapping_status:$mapping_status/hotal_reviews_type:reviewes"; 
  
								$this->request->data['TravelWtbError']['error_topic'] = '34'; //travel_lookup_error_topics
								$this->request->data['TravelWtbError']['error_by'] = $user_id;
								$this->request->data['TravelWtbError']['error_time'] = $CreatedDate;                        
								$this->request->data['TravelWtbError']['log_id'] = $LogId;
								$this->request->data['TravelWtbError']['error_entity'] = $id;
								$this->request->data['TravelWtbError']['error_type'] = '13'; // suburb
								$this->request->data['TravelWtbError']['error_status'] = '1';   // Structuretravel_lookup_error_statuses  
								$this->request->data['TravelWtbError']['page_url'] = $pageUrl; // pageurl
								$this->TravelWtbError->create();
								$this->TravelWtbError->save($this->request->data['TravelWtbError']);
								//$redirectUrl = "/travel_hotel_reviews/index/continent_id:$continent_id/country_id:$country_id/province_id:$province_id/city_id:$city_id/is_page:$is_page/mapping_status:$mapping_status"; 
								//$this->redirect($redirectUrl);
								$this->Session->setFlash($message, 'success');
							
							}else{
								$hotal_reviews_other_action = 1;
							}
							
							$message .= 'SUCCESS::'.'['.$count_reviews.']'.' Reviews Saved !!';
							empty($save_reviews);
						}
					}
   
                } 
                                 
            } 
			
  

            $HotelCode = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];
            $AreaId = $this->data['TravelHotelLookup']['area_id'];
            $AreaName = $this->data['TravelHotelLookup']['area_name'];
            $SuburbId = $this->data['TravelHotelLookup']['suburb_id'];
            $SuburbName = $this->data['TravelHotelLookup']['suburb_name'];
            $CityId = $this->data['TravelHotelLookup']['city_id'];
            $CityName = $this->data['TravelHotelLookup']['city_name'];
            $CityCode = $this->data['TravelHotelLookup']['city_code'];
            $CountryId = $TravelHotelLookups['TravelHotelLookup']['country_id'];
            $CountryName = $TravelHotelLookups['TravelHotelLookup']['country_name'];
            $CountryCode = $TravelHotelLookups['TravelHotelLookup']['country_code'];
            $ContinentId = $TravelHotelLookups['TravelHotelLookup']['continent_id'];
            $ContinentName = $TravelHotelLookups['TravelHotelLookup']['continent_name'];
            $ContinentCode = $TravelHotelLookups['TravelHotelLookup']['continent_code'];
            $BrandId = $this->data['TravelHotelLookup']['brand_id'];
            $BrandName = $this->data['TravelHotelLookup']['brand_name'];
            $ChainId = $this->data['TravelHotelLookup']['chain_id'];
            $ChainName = $this->data['TravelHotelLookup']['chain_name'];
            $HotelComment = $this->data['TravelHotelLookup']['hotel_comment'];
            $Star = $TravelHotelLookups['TravelHotelLookup']['star'];
            $Keyword = $TravelHotelLookups['TravelHotelLookup']['keyword'];
            $StandardRating = $TravelHotelLookups['TravelHotelLookup']['standard_rating'];
            $HotelRating = $TravelHotelLookups['TravelHotelLookup']['hotel_rating'];
            $FoodRating = $TravelHotelLookups['TravelHotelLookup']['food_rating'];
            $ServiceRating = $TravelHotelLookups['TravelHotelLookup']['service_rating'];
            $LocationRating = $TravelHotelLookups['TravelHotelLookup']['location_rating'];
            $ValueRating = $TravelHotelLookups['TravelHotelLookup']['value_rating'];
            $OverallRating = $TravelHotelLookups['TravelHotelLookup']['overall_rating'];
            $HotelImage1 = $this->data['TravelHotelLookup']['full_img1'];
            $HotelImage2 = $this->data['TravelHotelLookup']['full_img2'];
            $HotelImage3 = $this->data['TravelHotelLookup']['full_img3'];
            $HotelImage4 = $this->data['TravelHotelLookup']['full_img4'];
            $HotelImage5 = $this->data['TravelHotelLookup']['full_img5'];
            $HotelImage6 = $this->data['TravelHotelLookup']['full_img6'];
            $ThumbImage1 = $this->data['TravelHotelLookup']['thumb_img1'];
            $ThumbImage2 = $this->data['TravelHotelLookup']['thumb_img2'];
            $Logo = $TravelHotelLookups['TravelHotelLookup']['logo'];
            $Logo1 = $TravelHotelLookups['TravelHotelLookup']['logo1'];
            $BusinessCenter = $TravelHotelLookups['TravelHotelLookup']['business_center'];
            $MeetingFacilities = $TravelHotelLookups['TravelHotelLookup']['meeting_facilities'];
            $DiningFacilities = $TravelHotelLookups['TravelHotelLookup']['dining_facilities'];
            $BarLounge = $TravelHotelLookups['TravelHotelLookup']['bar_lounge'];
            $FitnessCenter = $TravelHotelLookups['TravelHotelLookup']['fitness_center'];
            $Pool = $TravelHotelLookups['TravelHotelLookup']['pool'];
            $Golf = $TravelHotelLookups['TravelHotelLookup']['golf'];
            $Tennis = $TravelHotelLookups['TravelHotelLookup']['tennis'];
            $Kids = $TravelHotelLookups['TravelHotelLookup']['kids'];
            $Handicap = $TravelHotelLookups['TravelHotelLookup']['handicap'];
            $URLHotel = $TravelHotelLookups['TravelHotelLookup']['url_hotel'];
            $Address = $this->data['TravelHotelLookup']['address'];
            $PostCode = $TravelHotelLookups['TravelHotelLookup']['post_code'];
            $NoRoom = $TravelHotelLookups['TravelHotelLookup']['no_room'];
            $Active = $TravelHotelLookups['TravelHotelLookup']['active'];
            if ($Active == 'TRUE')
                $Active = '1';
            else
                $Active = '0';
            $ReservationEmail = $TravelHotelLookups['TravelHotelLookup']['reservation_email'];
            $ReservationContact = $TravelHotelLookups['TravelHotelLookup']['reservation_contact'];
            $EmergencyContactName = $TravelHotelLookups['TravelHotelLookup']['emergency_contact_name'];
            $ReservationDeskNumber = $TravelHotelLookups['TravelHotelLookup']['reservation_desk_number'];
            $EmergencyContactNumber = $TravelHotelLookups['TravelHotelLookup']['emergency_contact_number'];
            $GPSPARAM1 = $TravelHotelLookups['TravelHotelLookup']['gps_prm_1'];
            $GPSPARAM2 = $TravelHotelLookups['TravelHotelLookup']['gps_prm_2'];
            $ProvinceId = $TravelHotelLookups['TravelHotelLookup']['province_id'];
            $ProvinceName = $TravelHotelLookups['TravelHotelLookup']['province_name'];
            $TopHotel = strtolower($TravelHotelLookups['TravelHotelLookup']['top_hotel']);
            $PropertyType = $TravelHotelLookups['TravelHotelLookup']['property_type'];
            $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

            $IsImage = $TravelHotelLookups['TravelHotelLookup']['is_image'];
            $IsPage = 'Y';
    
            $is_update = $TravelHotelLookups['TravelHotelLookup']['is_updated'];
            if ($is_update == 'Y')
                $actiontype = 'Update';
            else
                $actiontype = 'AddNew';
            
	$this->request->data['TravelHotelLookup']['page_by'] =  $user_id; 
	$this->request->data['TravelHotelLookup']['is_page'] =  'Y'; 
    // set page_date to system date
    $this->request->data['TravelHotelLookup']['page_date'] = $CreatedDate;
        $this->TravelHotelLookup->id = $id;
  if($hotal_reviews_other_action == 1){  
if ($this->TravelHotelLookup->save($this->request->data['TravelHotelLookup'])) {
	
$location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
$action_URL = 'http://www.travel.domain/ProcessXML';
	
$this->TravelHotelLookup->unbindModel(array('hasMany' => array('TravelHotelRoomSupplier','TravelActionItem')));
$TravelHotelLookups = $this->TravelHotelLookup->find('first', array('conditions' => array('TravelHotelLookup.id ' => $id) ));
$HotelName = $TravelHotelLookups['TravelHotelLookup']['hotel_name'];
    $HotelCode = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];
    $ContinentName = $TravelHotelLookups['TravelHotelLookup']['continent_name'];
    $ContinentId = $TravelHotelLookups['TravelHotelLookup']['continent_id'];
    $ContinentCode = $TravelHotelLookups['TravelHotelLookup']['continent_code'];
    $CountryName = $TravelHotelLookups['TravelHotelLookup']['country_name'];
    $CountryCode = $TravelHotelLookups['TravelHotelLookup']['country_code'];
    $CountryId = $TravelHotelLookups['TravelHotelLookup']['country_id'];
    $province_name = $TravelHotelLookups['TravelHotelLookup']['province_name'];
    $CityName = $TravelHotelLookups['TravelHotelLookup']['city_name'];
    $CityCode = $TravelHotelLookups['TravelHotelLookup']['city_code'];
    $CityId = $TravelHotelLookups['TravelHotelLookup']['city_id'];
    $ChainName = $TravelHotelLookups['TravelHotelLookup']['chain_name'];
    $ChainId = $TravelHotelLookups['TravelHotelLookup']['chain_id'];
    $BrandName = $TravelHotelLookups['TravelHotelLookup']['brand_name'];
    $BrandId = $TravelHotelLookups['TravelHotelLookup']['brand_id'];
    $AreaName = $TravelHotelLookups['TravelHotelLookup']['area_name'];
    $AreaId = $TravelHotelLookups['TravelHotelLookup']['area_id'];
    $SuburbName = $TravelHotelLookups['TravelHotelLookup']['suburb_name'];
    $SuburbId = $TravelHotelLookups['TravelHotelLookup']['suburb_id'];
    $address = $TravelHotelLookups['TravelHotelLookup']['address'];
    $HotelComment = $TravelHotelLookups['TravelHotelLookup']['hotel_comment'];
    $Star = $TravelHotelLookups['TravelHotelLookup']['star'];
    $Keyword = $TravelHotelLookups['TravelHotelLookup']['keyword'];
    $StandardRating = $TravelHotelLookups['TravelHotelLookup']['standard_rating'];
    $HotelRating = $TravelHotelLookups['TravelHotelLookup']['hotel_rating'];
    $FoodRating = $TravelHotelLookups['TravelHotelLookup']['food_rating'];
    $ServiceRating = $TravelHotelLookups['TravelHotelLookup']['service_rating'];
    $LocationRating = $TravelHotelLookups['TravelHotelLookup']['location_rating'];
    $ValueRating = $TravelHotelLookups['TravelHotelLookup']['value_rating'];
    $OverallRating = $TravelHotelLookups['TravelHotelLookup']['overall_rating'];
    $HotelImage1 = $TravelHotelLookups['TravelHotelLookup']['full_img1'];
    $HotelImage2 = $TravelHotelLookups['TravelHotelLookup']['full_img2'];
    $HotelImage3 = $TravelHotelLookups['TravelHotelLookup']['full_img3'];
    $HotelImage4 = $TravelHotelLookups['TravelHotelLookup']['full_img4'];
    $HotelImage5 = $TravelHotelLookups['TravelHotelLookup']['full_img5'];
    $HotelImage6 = $TravelHotelLookups['TravelHotelLookup']['full_img6'];
	$HotelImage7 = $TravelHotelLookups['TravelHotelLookup']['full_img7'];
	$HotelImage8 = $TravelHotelLookups['TravelHotelLookup']['full_img8'];
	$HotelImage9 = $TravelHotelLookups['TravelHotelLookup']['full_img9'];
	$HotelImage10 = $TravelHotelLookups['TravelHotelLookup']['full_img10'];
	$HotelImage11 = $TravelHotelLookups['TravelHotelLookup']['full_img11'];
	$HotelImage12 = $TravelHotelLookups['TravelHotelLookup']['full_img12'];
	$HotelImage13 = $TravelHotelLookups['TravelHotelLookup']['full_img13'];
	$HotelImage14 = $TravelHotelLookups['TravelHotelLookup']['full_img14'];
	$HotelImage15 = $TravelHotelLookups['TravelHotelLookup']['full_img15'];
	$HotelImage16 = $TravelHotelLookups['TravelHotelLookup']['full_img16'];
	$HotelImage17 = $TravelHotelLookups['TravelHotelLookup']['full_img17'];
	$HotelImage18 = $TravelHotelLookups['TravelHotelLookup']['full_img18'];
	$HotelImage19 = $TravelHotelLookups['TravelHotelLookup']['full_img19'];
	$HotelImage20 = $TravelHotelLookups['TravelHotelLookup']['full_img20'];
	
    $ThumbImage1 = $TravelHotelLookups['TravelHotelLookup']['thumb_img1'];
    $ThumbImage2 = $TravelHotelLookups['TravelHotelLookup']['thumb_img2'];
    
    $Logo = $TravelHotelLookups['TravelHotelLookup']['logo'];
    $Logo1 = $TravelHotelLookups['TravelHotelLookup']['logo1'];
    $BusinessCenter = $TravelHotelLookups['TravelHotelLookup']['business_center'];
    $MeetingFacilities = $TravelHotelLookups['TravelHotelLookup']['meeting_facilities'];
    $DiningFacilities = $TravelHotelLookups['TravelHotelLookup']['dining_facilities'];
    $BarLounge = $TravelHotelLookups['TravelHotelLookup']['bar_lounge'];
    $FitnessCenter = $TravelHotelLookups['TravelHotelLookup']['fitness_center'];
    $Pool = $TravelHotelLookups['TravelHotelLookup']['pool'];
    $Golf = $TravelHotelLookups['TravelHotelLookup']['golf'];
    $Tennis = $TravelHotelLookups['TravelHotelLookup']['tennis'];
    $Kids = $TravelHotelLookups['TravelHotelLookup']['kids'];
    $Handicap = $TravelHotelLookups['TravelHotelLookup']['handicap'];
    $URLHotel = $TravelHotelLookups['TravelHotelLookup']['url_hotel'];
    $Address = $TravelHotelLookups['TravelHotelLookup']['address'];
    $PostCode = $TravelHotelLookups['TravelHotelLookup']['post_code'];
    $NoRoom = $TravelHotelLookups['TravelHotelLookup']['no_room'];
    $HotelFormerName = $TravelHotelLookups['TravelHotelLookup']['hotel_former_name'];
    $Active = $TravelHotelLookups['TravelHotelLookup']['active'];	
	
    if ($Active == 'TRUE')
        $Active = '1';
    else
	$Active = '0';
    $ReservationEmail = $TravelHotelLookups['TravelHotelLookup']['reservation_email'];
    $ReservationContact = $TravelHotelLookups['TravelHotelLookup']['reservation_contact'];
    $EmergencyContactName = $TravelHotelLookups['TravelHotelLookup']['emergency_contact_name'];
    $ReservationDeskNumber = $TravelHotelLookups['TravelHotelLookup']['reservation_desk_number'];
    $EmergencyContactNumber = $TravelHotelLookups['TravelHotelLookup']['emergency_contact_number'];
    $GPSPARAM1 = $TravelHotelLookups['TravelHotelLookup']['gps_prm_1'];
    $GPSPARAM2 = $TravelHotelLookups['TravelHotelLookup']['gps_prm_2'];
    $ProvinceId = $TravelHotelLookups['TravelHotelLookup']['province_id'];
    $ProvinceName = $TravelHotelLookups['TravelHotelLookup']['province_name'];
    $TopHotel = strtolower($TravelHotelLookups['TravelHotelLookup']['top_hotel']);
    $PropertyType = $TravelHotelLookups['TravelHotelLookup']['property_type'];
    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

    $is_image = $TravelHotelLookups['TravelHotelLookup']['is_image'];
    if ($is_image == 'Y')
        $IsImage = 'true';
    else
        $IsImage = 'false';
    
    $IsPage = 'true';
    
    $is_update = $TravelHotelLookups['TravelHotelLookup']['is_updated'];
    if ($is_update == 'Y')
        $actiontype = 'Update';
    else
        $actiontype = 'AddNew';
   
   

          $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Hotel</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">
                                                                <HotelId>' . $HotelId . '</HotelId>
                                <HotelCode><![CDATA[' . $HotelCode . ']]></HotelCode>
                                <HotelName><![CDATA[' . $HotelName . ']]></HotelName>
                                <AreaId>' . $AreaId . '</AreaId>
                                <AreaCode>NA</AreaCode>
                                <AreaName><![CDATA[' . $AreaName . ']]></AreaName>
                                <SuburbId>' . $SuburbId . '</SuburbId>
                                <SuburbCode>NA</SuburbCode>
                                <SuburbName><![CDATA[' . $SuburbName . ']]></SuburbName>
                                <CityId>' . $CityId . '</CityId>
                                <CityCode><![CDATA[' . $CityCode . ']]></CityCode>
                                <CityName><![CDATA[' . $CityName . ']]></CityName>
                                <CountryId>' . $CountryId . '</CountryId>
                                <CountryCode><![CDATA[' . $CountryCode . ']]></CountryCode>
                                <CountryName><![CDATA[' . $CountryName . ']]></CountryName>
                                <ContinentId>' . $ContinentId . '</ContinentId>
                                <ContinentCode><![CDATA[' . $ContinentCode . ']]></ContinentCode>
                                <ContinentName><![CDATA[' . $ContinentName . ']]></ContinentName>
                                <ProvinceId>' . $ProvinceId . '</ProvinceId>
                                <ProvinceName><![CDATA[' . $ProvinceName . ']]></ProvinceName>
                                <BrandId>' . $BrandId . '</BrandId>
                                <BrandName><![CDATA[' . $BrandName . ']]></BrandName>
                                <ChainId>' . $ChainId . '</ChainId>
                                <ChainName><![CDATA[' . $ChainName . ']]></ChainName>
                                <HotelComment><![CDATA[' . $HotelComment . ']]></HotelComment>
                                <Star>' . $Star . '</Star>
                                <Keyword><![CDATA[' . $Keyword . ']]></Keyword>
                                <StandardRating>' . $StandardRating . '</StandardRating>
                                <HotelRating>' . $StandardRating . '</HotelRating>                                
                                <FoodRating>' . $FoodRating . '</FoodRating>
                                <ServiceRating>' . $ServiceRating . '</ServiceRating>
                                <LocationRating>' . $LocationRating . '</LocationRating>
                                <ValueRating>' . $ValueRating . '</ValueRating>
                                <OverallRating>' . $OverallRating . '</OverallRating>						
								
                                <HotelImage1Full><![CDATA[' . $HotelImage1 . ']]></HotelImage1Full>
                                <HotelImage2Full><![CDATA[' . $HotelImage2 . ']]></HotelImage2Full>
                                <HotelImage3Full><![CDATA[' . $HotelImage3 . ']]></HotelImage3Full>
                                <HotelImage4Full><![CDATA[' . $HotelImage4 . ']]></HotelImage4Full>
                                <HotelImage5Full><![CDATA[' . $HotelImage5 . ']]></HotelImage5Full>
                                <HotelImage6Full><![CDATA[' . $HotelImage6 . ']]></HotelImage6Full>
								<HotelImage7Full><![CDATA[' . $HotelImage7 . ']]></HotelImage7Full>
								<HotelImage8Full><![CDATA[' . $HotelImage8 . ']]></HotelImage8Full>
								<HotelImage9Full><![CDATA[' . $HotelImage9 . ']]></HotelImage9Full>
								<HotelImage10Full><![CDATA[' . $HotelImage10 . ']]></HotelImage10Full>
								<HotelImage11Full><![CDATA[' . $HotelImage11 . ']]></HotelImage11Full>
								<HotelImage12Full><![CDATA[' . $HotelImage12 . ']]></HotelImage12Full>
								<HotelImage13Full><![CDATA[' . $HotelImage13 . ']]></HotelImage13Full>
								<HotelImage14Full><![CDATA[' . $HotelImage14 . ']]></HotelImage14Full>
								<HotelImage15Full><![CDATA[' . $HotelImage15 . ']]></HotelImage15Full>
								<HotelImage16Full><![CDATA[' . $HotelImage16 . ']]></HotelImage16Full>
								<HotelImage17Full><![CDATA[' . $HotelImage17 . ']]></HotelImage17Full>
								<HotelImage18Full><![CDATA[' . $HotelImage18 . ']]></HotelImage18Full>
								<HotelImage19Full><![CDATA[' . $HotelImage19 . ']]></HotelImage19Full>
								<HotelImage20Full><![CDATA[' . $HotelImage20 . ']]></HotelImage20Full>								

                                <HotelImage1Thumb><![CDATA[' . $ThumbImage1 . ']]></HotelImage1Thumb>
                                <HotelImage2Thumb><![CDATA[' . $ThumbImage2 . ']]></HotelImage2Thumb>                             

                                <IsImage>' . $IsImage . '</IsImage>
                                <IsPage>' . $IsPage . '</IsPage>
								<HotelFormerName>' . $HotelFormerName . '</HotelFormerName>
                                <Logo>' . $Logo . '</Logo>
                                                                <Logo1>' . $Logo1 . '</Logo1>
                                                                <BusinessCenter>' . $BusinessCenter . '</BusinessCenter>
                                                                <MeetingFacilities>' . $MeetingFacilities . '</MeetingFacilities>
                                                                <DiningFacilities>' . $DiningFacilities . '</DiningFacilities>
                                                                <BarLounge>' . $BarLounge . '</BarLounge>
                                                                <FitnessCenter>' . $FitnessCenter . '</FitnessCenter>
                                                                <Pool>' . $Pool . '</Pool>
                                                                <Golf>' . $Golf . '</Golf>
                                                                <Tennis>' . $Tennis . '</Tennis>
                                                                <Kids>' . $Kids . '</Kids>
                                                                <Handicap>' . $Handicap . '</Handicap>
                                                                <URLHotel><![CDATA[' . $URLHotel . ']]></URLHotel>
                                                                <Address><![CDATA[' . $Address . ']]></Address>
                                                                <PostCode>' . $PostCode . '</PostCode>
                                                                <NoRoom>' . $NoRoom . '</NoRoom>
                                                                <Active>' . $Active . '</Active>
                                                                <ReservationEmail><![CDATA[' . $ReservationEmail . ']]></ReservationEmail>
                                                                <ReservationContact><![CDATA[' . $ReservationContact . ']]></ReservationContact>
                                                                <EmergencyContactName><![CDATA[' . $EmergencyContactName . ']]></EmergencyContactName>
                                                                <ReservationDeskNumber><![CDATA[' . $ReservationDeskNumber . ']]></ReservationDeskNumber>
                                                                <EmergencyContactNumber><![CDATA[' . $EmergencyContactNumber . ']]></EmergencyContactNumber>
                                                                <GPSPARAM1>' . $GPSPARAM1 . '</GPSPARAM1>
                                                                <GPSPARAM2>' . $GPSPARAM2 . '</GPSPARAM2>
                                                                <TopHotel>' . $TopHotel . '</TopHotel> 
                                                                <PropertyType>' . $PropertyType . '</PropertyType>
                                                                <ApprovedBy>0</ApprovedBy>
                                                                <ApprovedDate>1111-01-01T00:00:00</ApprovedDate>
                                                                <CreatedBy>0</CreatedBy>
                                                                <CreatedDate>' . $CreatedDate . '</CreatedDate>
                                                            </ResourceDetailsData>
                         
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


          $log_call_screen = 'Hotel Review - Edit';



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

                // pr($xml_arr);

                // die;


				$xml_error = 'FALSE';
                if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {

                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];

                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];

                    $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]<br>";

                   

                } else {



                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];

                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID

                    $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]<br>";

                   

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
                $message .= 'Local record has been successfully updated.<br />' . $xml_msg;
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

                    $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Log Id [' . $LogId . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
                
					/*
								 * WTB Error Information
								 */
								 $pageUrl = "editother/$id/continent_id:$continent_id/country_id:$country_id/province_id:$province_id/city_id:$city_id/is_page:$is_page/mapping_status:$mapping_status/hotal_reviews_type:otherinfo"; 
  
								$this->request->data['TravelWtbError']['error_topic'] = '35'; //travel_lookup_error_topics
								$this->request->data['TravelWtbError']['error_by'] = $user_id;
								$this->request->data['TravelWtbError']['error_time'] = $CreatedDate;                        
								$this->request->data['TravelWtbError']['log_id'] = $LogId;
								$this->request->data['TravelWtbError']['error_entity'] = $id;
								$this->request->data['TravelWtbError']['error_type'] = '13'; // suburb
								$this->request->data['TravelWtbError']['error_status'] = '1';   // Structuretravel_lookup_error_statuses  
								$this->request->data['TravelWtbError']['page_url'] = $pageUrl; // pageurl
								$this->TravelWtbError->create();
								$this->TravelWtbError->save($this->request->data['TravelWtbError']);
								
				
				}

                $this->Session->setFlash($message, 'success');
            }
  }   
  $continent_id = $this->request->params['named']['continent_id'];    
  $country_id = $this->request->params['named']['country_id'];
  $province_id = $this->request->params['named']['province_id']; 
  $city_id = $this->request->params['named']['city_id'];
  $is_page = $this->request->params['named']['is_page']; 
  $mapping_status = $this->request->params['named']['mapping_status'];
  $redirectUrl = "/travel_hotel_reviews/index/continent_id:$continent_id/country_id:$country_id/province_id:$province_id/city_id:$city_id/is_page:$is_page/mapping_status:$mapping_status"; 
  $this->redirect($redirectUrl);


           
        }

/*  
        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));
        $this->set(compact('TravelLookupContinents'));

        if ($TravelHotelLookups['TravelHotelLookup']['continent_id']) {
            $TravelCountries = $this->TravelCountry->find('list', array(
                'conditions' => array(
                    'TravelCountry.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],
                    'TravelCountry.country_status' => '1',
                    'TravelCountry.wtb_status' => '1',
                    'TravelCountry.active' => 'TRUE'
                ),
                'fields' => 'TravelCountry.id, TravelCountry.country_name',
                'order' => 'TravelCountry.country_name ASC'
            ));
        }
        $this->set(compact('TravelCountries'));

        if ($TravelHotelLookups['TravelHotelLookup']['country_id']) {
            $TravelCities = $this->TravelCity->find('all', array(
                'conditions' => array(
                    'TravelCity.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],
                    'TravelCity.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],
                    'TravelCity.city_status' => '1',
                    'TravelCity.wtb_status' => '1',
                    'TravelCity.active' => 'TRUE',
                    'TravelCity.province_id' => $TravelHotelLookups['TravelHotelLookup']['province_id'],
                ),
                'fields' => array('TravelCity.id', 'TravelCity.city_name', 'TravelCity.city_code'),
                'order' => 'TravelCity.city_name ASC'
            ));
            $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));


            $Provinces = $this->Province->find('list', array(
                'conditions' => array(
                    'Province.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],
                    'Province.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],
                    'Province.status' => '1',
                    'Province.wtb_status' => '1',
                    'Province.active' => 'TRUE'
                //'Province.id' => $proArr
                ),
                'fields' => array('Province.id', 'Province.name'),
                'order' => 'Province.name ASC'
            ));
        }

        $this->set(compact('TravelCities'));
*/
        if ($TravelHotelLookups['TravelHotelLookup']['city_id']) {
            $TravelSuburbs = $this->TravelSuburb->find('list', array(
                'conditions' => array(
                    'TravelSuburb.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],
                    'TravelSuburb.city_id' => $TravelHotelLookups['TravelHotelLookup']['city_id'],
                    'TravelSuburb.status' => '1',
                    'TravelSuburb.wtb_status' => '1',
                    'TravelSuburb.active' => 'TRUE'
                ),
                'fields' => 'TravelSuburb.id, TravelSuburb.name',
                'order' => 'TravelSuburb.name ASC'
            ));
        }

        $this->set(compact('TravelSuburbs'));

        if ($TravelHotelLookups['TravelHotelLookup']['suburb_id']) {
            $TravelAreas = $this->TravelArea->find('list', array(
                'conditions' => array(
                    'TravelArea.suburb_id' => $TravelHotelLookups['TravelHotelLookup']['suburb_id'],
                    'TravelArea.area_status' => '1',
                    'TravelArea.wtb_status' => '1',
                    'TravelArea.area_active' => 'TRUE'
                ),
                'fields' => 'TravelArea.id, TravelArea.area_name',
                'order' => 'TravelArea.area_name ASC'
            ));
        }

        $this->set(compact('TravelAreas'));

        $TravelChains = $this->TravelChain->find('list', array('fields' => 'id,chain_name', 'conditions' => array('chain_status' => 1, 'wtb_status' => 1, 'chain_active' => 'TRUE', array('NOT' => array('id' => 1))), 'order' => 'chain_name ASC'));
        $TravelChains = array('1' => 'No Chain') + $TravelChains;
        $this->set(compact('TravelChains'));
        
        if ($TravelHotelLookups['TravelHotelLookup']['chain_id'] > 1) {
            $TravelBrands = $this->TravelBrand->find('list', array(
                'conditions' => array(
                    'TravelBrand.brand_chain_id' => $TravelHotelLookups['TravelHotelLookup']['chain_id'],
                    'TravelBrand.brand_status' => '1',
                    'TravelBrand.wtb_status' => '1',
                    'TravelBrand.brand_active' => 'TRUE'
                ),
                'fields' => 'TravelBrand.id, TravelBrand.brand_name',
                'order' => 'TravelBrand.brand_name ASC'
            ));
        }
        $TravelBrands = array('1' => 'No Brand') + $TravelBrands;

        $TravelLookupPropertyTypes = $this->TravelLookupPropertyType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $TravelLookupRateTypes = $this->TravelLookupRateType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->find('all', array('conditions' => array('TravelHotelRoomSupplier.hotel_id' => $id)));
        $this->set(compact('TravelBrands', 'actio_itme_id', 'TravelHotelRoomSuppliers', 'Provinces', 'TravelLookupPropertyTypes', 'TravelLookupRateTypes'));

        $amenity = $this->TravelHotelAmenitie->find('list', array('fields' => array('amenity_type_id', 'amenity_type_id'), 'conditions' => array('hotel_id' => $id)));
        $this->set(compact('amenity')); 

        $categories = $this->TravelLookupAmenityCategorie->find('all');
        $this->set(compact('categories'));

        $review = $this->TravelHotelReviewItem->find('all', array('fields' => array('review_topic_id', 'review_score', 'no_of_reviews'), 'conditions' => array('hotel_id' => $id)));
        $this->set(compact('review')); 

        $reviewlist = $this->TravelHotelReviewItem->find('list', array('fields' => array('review_topic_id', 'review_topic_id'), 'conditions' => array('hotel_id' => $id)));
        $this->set(compact('reviewlist')); 
        
        $reviewtopics = $this->TravelLookupReviewTopic->find('all');
        $this->set(compact('reviewtopics'));
        
        $this->request->data = $TravelHotelLookups;
    }

 public function view($id) {       

        $user_id = $this->Auth->user('id');

        $role_id = $this->Session->read("role_id");

        $dummy_status = $this->Auth->user('dummy_status');

        $actio_itme_id = '';

        $flag = 0;

        $TravelCountries = array();

        $TravelCities = array();

        $TravelSuburbs = array();

        $TravelAreas = array();

        $TravelBrands = array();

        $Provinces = array();

        $ConArry = array();



        $arr = explode('_', $id);

        $id = $arr[0];



        if (!$id) {

            throw new NotFoundException(__('Invalid Hotel'));

        }



        $TravelHotelLookups = $this->TravelHotelLookup->findById($id);



        if (!$TravelHotelLookups) {

            throw new NotFoundException(__('Invalid Hotel'));

        }


        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));

        $this->set(compact('TravelLookupContinents'));



        $TravelChains = $this->TravelChain->find('list', array('fields' => 'id,chain_name', 'conditions' => array('chain_status' => 1, 'wtb_status' => 1, 'chain_active' => 'TRUE', array('NOT' => array('id' => 1))), 'order' => 'chain_name ASC'));

        $TravelChains = array('1' => 'No Chain') + $TravelChains;

        $this->set(compact('TravelChains'));



        if ($TravelHotelLookups['TravelHotelLookup']['continent_id']) {

            $TravelCountries = $this->TravelCountry->find('list', array(

                'conditions' => array(

                    'TravelCountry.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],

                    'TravelCountry.country_status' => '1',

                    'TravelCountry.wtb_status' => '1',

                    'TravelCountry.active' => 'TRUE'

                ),

                'fields' => 'TravelCountry.id, TravelCountry.country_name',

                'order' => 'TravelCountry.country_name ASC'

            ));

        }

        $this->set(compact('TravelCountries'));



        if ($TravelHotelLookups['TravelHotelLookup']['country_id']) {

            $TravelCities = $this->TravelCity->find('all', array(

                'conditions' => array(

                    'TravelCity.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],

                    'TravelCity.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],

                    'TravelCity.city_status' => '1',

                    'TravelCity.wtb_status' => '1',

                    'TravelCity.active' => 'TRUE',

                    'TravelCity.province_id' => $TravelHotelLookups['TravelHotelLookup']['province_id'],

                ),

                'fields' => array('TravelCity.id', 'TravelCity.city_name', 'TravelCity.city_code'),

                'order' => 'TravelCity.city_name ASC'

            ));

            $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));





            $Provinces = $this->Province->find('list', array(

                'conditions' => array(

                    'Province.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],

                    'Province.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],

                    'Province.status' => '1',

                    'Province.wtb_status' => '1',

                    'Province.active' => 'TRUE'

                //'Province.id' => $proArr

                ),

                'fields' => array('Province.id', 'Province.name'),

                'order' => 'Province.name ASC'

            ));

        }



        $this->set(compact('TravelCities'));



        if ($TravelHotelLookups['TravelHotelLookup']['city_id']) {

            $TravelSuburbs = $this->TravelSuburb->find('list', array(

                'conditions' => array(

                    'TravelSuburb.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],

                    'TravelSuburb.city_id' => $TravelHotelLookups['TravelHotelLookup']['city_id'],

                    'TravelSuburb.status' => '1',

                    'TravelSuburb.wtb_status' => '1',

                    'TravelSuburb.active' => 'TRUE'

                ),

                'fields' => 'TravelSuburb.id, TravelSuburb.name',

                'order' => 'TravelSuburb.name ASC'

            ));

        }



        $this->set(compact('TravelSuburbs'));



        if ($TravelHotelLookups['TravelHotelLookup']['suburb_id']) {

            $TravelAreas = $this->TravelArea->find('list', array(

                'conditions' => array(

                    'TravelArea.suburb_id' => $TravelHotelLookups['TravelHotelLookup']['suburb_id'],

                    'TravelArea.area_status' => '1',

                    'TravelArea.wtb_status' => '1',

                    'TravelArea.area_active' => 'TRUE'

                ),

                'fields' => 'TravelArea.id, TravelArea.area_name',

                'order' => 'TravelArea.area_name ASC'

            ));

        }



        $this->set(compact('TravelAreas'));



        if ($TravelHotelLookups['TravelHotelLookup']['chain_id'] > 1) {

            $TravelBrands = $this->TravelBrand->find('list', array(

                'conditions' => array(

                    'TravelBrand.brand_chain_id' => $TravelHotelLookups['TravelHotelLookup']['chain_id'],

                    'TravelBrand.brand_status' => '1',

                    'TravelBrand.wtb_status' => '1',

                    'TravelBrand.brand_active' => 'TRUE'

                ),

                'fields' => 'TravelBrand.id, TravelBrand.brand_name',

                'order' => 'TravelBrand.brand_name ASC'

            ));

        }

        $TravelBrands = array('1' => 'No Brand') + $TravelBrands;



        $TravelLookupPropertyTypes = $this->TravelLookupPropertyType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));

        $TravelLookupRateTypes = $this->TravelLookupRateType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));

        $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->find('all', array('conditions' => array('TravelHotelRoomSupplier.hotel_id' => $id)));

        $this->set(compact('TravelBrands', 'actio_itme_id', 'TravelHotelRoomSuppliers', 'Provinces', 'TravelLookupPropertyTypes', 'TravelLookupRateTypes'));




        $this->request->data = $TravelHotelLookups;

    }

    /*
    public function ImagefileCheck($file_type = null, $file_size = null) {
        $img_up_type = explode("/", $file_type);
        echo $img_up_type_firstpart = $img_up_type[0];
        if (($img_up_type_firstpart == "image" ) && ($file_size < 3000000)) {
            return 'true';
        } else {
            return 'false';
        }
    }*/
    
    public function test() {
        $this->layout = FALSE;
        $this->autoRender = FALSE;
        Configure::write('debug', 2);
        $this->RequestHandler->respondAs('xml');
        App::import('Vendor', 'nusoap', array('file' => 'nusoap' . DS . 'lib' . DS . 'nusoap.php'));

        if (!isset($HTTP_RAW_POST_DATA))
            $HTTP_RAW_POST_DATA = file_get_contents('php://input');

        function hookTextBetweenTags($string, $tagname) {
            $pattern = "/<$tagname ?.*>(.*)<\/$tagname>/";
            preg_match($pattern, $string, $matches);
            return $matches[1];
        }

        $server = new soap_server();
        $namespace = "http://silkrouters.com/travel_hotel_images/test";
        $endpoint = "http://silkrouters.com/travel_hotel_images/test";
        $server->configureWSDL("web-service", $namespace, $endpoint);
        $server->wsdl->schemaTargetNamespace = $namespace;

        
        $server->register("hello", array("username" => "xsd:string"), array("return" => "xsd:string"), "urn:web-service", "urn:web-service#hello", "rpc", "encoded", "Just say hello");
        $server->register("finish", array("msg" => "xsd:string"), array("return" => "xsd:string"), "urn:web-service", "urn:web-service#hello", "rpc", "encoded", "Just say hello");

        function hello($username) {
            //Can query database and any other complex operation
            mysql_query($username);
            return 'Hiiii-' . $username;
            
        }
        function finish($username) {
            //Can query database and any other complex operation
            mysql_query($username);
            return 'Hiiii-' . $username;
            
        }
        
        

       

        $server->service($HTTP_RAW_POST_DATA);
    }
	
	public function editamenities($id){
		$is_service = '';           
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');

        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $actio_itme_id = '';
        $flag = 0;
 

        $TravelCountries = array();
        $TravelCities = array();
        $TravelSuburbs = array();
        $TravelAreas = array();
        $TravelBrands = array();
        $Provinces = array();
        $ConArry = array();
        
        $AmenityCategories = array();
        $AmenityTypes = array();        

        $arr = explode('_', $id);
        $id = $arr[0];

        if (!$id) {
            throw new NotFoundException(__('Invalid Hotel'));
        }

        $TravelHotelLookups = $this->TravelHotelLookup->findById($id);

        if (!$TravelHotelLookups) {
            throw new NotFoundException(__('Invalid Hotel'));
        }

        if ($this->IsService() == 'true'){
           $is_service = "All services running normally.";
        }   else {
           $is_service = "Some services are offline. Please try later.";
        } 
       
        $this->set(compact('is_service'));        

        //echo $next_action_by;
		///ECHO '<PRE>';
		//print_r($_POST); DIE;

		$active_amenity = 'TRUE';
		$active_review = 'TRUE';
		$actiontype = $this->data['TravelHotelLookup']['action_type'];
		$count_amenities = count($this->request->data['TravelHotelAmenitie']['amenity_type_id']);
		$count_reviews = count($this->request->data['TravelHotelReviewItem']['review_topic_id']);
		$HotelId = $id;
		$action_amenity_type = 0;
		$action_review_type = 0;
		$action_other_type = 0;
		$message = '';
		$xml_msg = '';
		$CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

		$continent_id = $this->request->params['named']['continent_id'];    
		  $country_id = $this->request->params['named']['country_id'];
		  $province_id = $this->request->params['named']['province_id']; 
		  $city_id = $this->request->params['named']['city_id'];
		  $is_page = $this->request->params['named']['is_page']; 
		  $mapping_status = $this->request->params['named']['mapping_status'];

        if ($this->request->is('post') || $this->request->is('put')) {
			if (count($this->request->data['TravelHotelAmenitie']['amenity_type_id']) > 0 && !empty($this->data['TravelHotelAmenitie']['amenity_type_id'])) {
                    if($this->TravelHotelAmenitie->deleteAll(array('TravelHotelAmenitie.hotel_id' => $id))) // delete project amenity by project id
					{
						// Amenity delete using xml call
						$content_xml_str = '<soap:Body>
											<ProcessXML xmlns="http://www.travel.domain/">
											  <RequestInfo>
												<ResourceDataRequest>
												  <RequestAuditInfo>
													<RequestType>PXML_WData_LookupDelete</RequestType>
													<RequestTime>'.$CreatedDate.'</RequestTime>
													<RequestResource>Silkrouters</RequestResource>
												  </RequestAuditInfo>
												  <RequestParameters>
													<ResourceData>
													  <ResourceDetailsData srno="1" lookuptype="HotelAmenityByHotel">
														<HotelAmenityByHotelId>'.$id.'</HotelAmenityByHotelId>       
													</ResourceDetailsData>
													</ResourceData>
												  </RequestParameters>
												</ResourceDataRequest>
											  </RequestInfo>
											</ProcessXML>
										  </soap:Body>';
										  
						$log_call_screen = 'Hotel Review Amenity Re-try - Delete';
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
							 //echo '<pre>';
							 //print_r($xml_arr);
							 //die;

							if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
								$xml_msg = "Foreign record has been successfully hotal review amenity deleted [Code:$log_call_status_code]";
							} else {
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
								$xml_msg = "There was a problem with foreign record hotal review amenity deletion [Code:$log_call_status_code]";
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
							$message .= 'Local record has been successfully deleted.<br />' . $xml_msg;
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

								$Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Log Id [' . $LogId . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
							}
						
						$countamenities = 0;
						$amentitiesdata = '';
						foreach ($this->data['TravelHotelAmenitie']['amenity_type_id'] as $val) { 
							$save_amenity[] = array('TravelHotelAmenitie' => array(
									'amenity_type_id' => $val,
									'hotel_id' => $id,                            
									'created_by' => $user_id,
									'modified_by' => $user_id,                            
									'active' => $active_amenity,                             
							)); 
							
							
							
							$countamenities++;
						}
                        
						if($this->TravelHotelAmenitie->saveMany($save_amenity)){
							// Amenity save using xml call
							
							// Get all inserted amenities
						$TravelHotelLookups = $this->TravelHotelLookup->find('first', array('conditions' => array('TravelHotelLookup.id ' => $id) ));
						$HotelName = $TravelHotelLookups['TravelHotelLookup']['hotel_name'];
						$HotelCode = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];
						$aminitetotal = $this->TravelHotelAmenitie->find('count', array('conditions'=>array('TravelHotelAmenitie.hotel_id' => $id)));
						$allamenties = $this->TravelHotelAmenitie->find('all', array('conditions'=>array('TravelHotelAmenitie.hotel_id' => $id)));
						$amcount =1;
						foreach($allamenties as $aamentiry){
							$amentitiesdata .= '<ResourceDetailsData srno="'.$amcount.'" actiontype="AddNew">
														<HotelAmenitiesId>'.$aamentiry['TravelHotelAmenitie']['id'].'</HotelAmenitiesId>
														<HotelId>'.$id.'</HotelId>
														<HotelCode>'.$HotelCode.'</HotelCode>
														<HotelName>'.$HotelName.'</HotelName>
														<AmenityTypeId>'.$val.'</AmenityTypeId>
														<AmenityType>AmenityDetails</AmenityType>
														<Active>'.$active_amenity.'</Active>
														<CreatedBy>'.$user_id.'</CreatedBy>
														<ModifiedBy>'.$user_id.'</ModifiedBy>
														<CreatedDate>'.$CreatedDate.'</CreatedDate>
														<ModifiedDate>'.$CreatedDate.'</ModifiedDate>
													  </ResourceDetailsData>';
													  
													  $amcount++;
						}
						
						$content_xml_str = '<soap:Body>
											<ProcessXML xmlns="http://www.travel.domain/">
											  <RequestInfo>
												<ResourceDataRequest>
												  <RequestAuditInfo>
													<RequestType>PXML_WData_HotelAmenitiesBulk</RequestType>
													<RequestTime>'.$CreatedDate.'</RequestTime>
													<RequestResource>Silkrouters</RequestResource>
												  </RequestAuditInfo>
												  <RequestParameters>
													<ResourceData>
													  <SelectedActionType>AddNew</SelectedActionType>
													  <SelectedCountIn>'.$aminitetotal.'</SelectedCountIn>
													  <MergeData>false</MergeData>
													  '.$amentitiesdata.'
													</ResourceData>
												  </RequestParameters>
												</ResourceDataRequest>
											  </RequestInfo>
											</ProcessXML>
										  </soap:Body>';
										  
						$log_call_screen = 'Hotel Review Amenity Re-try - Add';
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
							//echo '<pre>';
							// print_r($xml_arr);
							//die;
							$xml_error = 'FALSE';
							if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTELAMENITIESBULK']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTELAMENITIESBULK']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTELAMENITIESBULK']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
								$xml_msg = "Foreign record has been successfully hotal review amenity added [Code:$log_call_status_code]";
							} else {
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTELAMENITIESBULK']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTELAMENITIESBULK']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
								$xml_msg = "There was a problem with foreign record hotal review amenity added [Code:$log_call_status_code]";
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
							$message .= 'Local record has been successfully updated.<br />' . $xml_msg;
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

								$Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Log Id [' . $LogId . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
							
								/*
								 * WTB Error Information
								 */
								
								$wtb_error_id = $this->request->params['named']['wtb_error_id'];  
								$this->TravelWtbError->updateAll(array('TravelWtbError.error_by' => "'".$user_id."'", 
								'TravelWtbError.log_id' => "'".$LogId."'", 
								'TravelWtbError.error_time' => "'".$CreatedDate."'", 
								), 
								array('TravelWtbError.id' => $wtb_error_id));

							}else{
								$wtb_error_id = $this->request->params['named']['wtb_error_id'];  
								$this->TravelWtbError->updateAll(array('TravelWtbError.fixed_by' => "'".$user_id."'", 
								'TravelWtbError.fixed_time' => "'".$CreatedDate."'", 
								'TravelWtbError.error_status' => "'2'"), 
								array('TravelWtbError.id' => $wtb_error_id));
							}
							$message .= 'SUCCESS::'.'['.$countamenities.']'.' Amenities Saved !!<br>';
							empty($save_amenity);
							$this->Session->setFlash($message, 'success');
							$redirectUrl = "/travel_wtb_errors"; 
							$this->redirect($redirectUrl);
						}
					}                    
                     
                }
        }
		
		
        if ($TravelHotelLookups['TravelHotelLookup']['city_id']) {
            $TravelSuburbs = $this->TravelSuburb->find('list', array(
                'conditions' => array(
                    'TravelSuburb.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],
                    'TravelSuburb.city_id' => $TravelHotelLookups['TravelHotelLookup']['city_id'],
                    'TravelSuburb.status' => '1',
                    'TravelSuburb.wtb_status' => '1',
                    'TravelSuburb.active' => 'TRUE'
                ),
                'fields' => 'TravelSuburb.id, TravelSuburb.name',
                'order' => 'TravelSuburb.name ASC'
            ));
        }

        $this->set(compact('TravelSuburbs'));

        if ($TravelHotelLookups['TravelHotelLookup']['suburb_id']) {
            $TravelAreas = $this->TravelArea->find('list', array(
                'conditions' => array(
                    'TravelArea.suburb_id' => $TravelHotelLookups['TravelHotelLookup']['suburb_id'],
                    'TravelArea.area_status' => '1',
                    'TravelArea.wtb_status' => '1',
                    'TravelArea.area_active' => 'TRUE'
                ),
                'fields' => 'TravelArea.id, TravelArea.area_name',
                'order' => 'TravelArea.area_name ASC'
            ));
        }

        $this->set(compact('TravelAreas'));

        $TravelChains = $this->TravelChain->find('list', array('fields' => 'id,chain_name', 'conditions' => array('chain_status' => 1, 'wtb_status' => 1, 'chain_active' => 'TRUE', array('NOT' => array('id' => 1))), 'order' => 'chain_name ASC'));
        $TravelChains = array('1' => 'No Chain') + $TravelChains;
        $this->set(compact('TravelChains'));
        
        if ($TravelHotelLookups['TravelHotelLookup']['chain_id'] > 1) {
            $TravelBrands = $this->TravelBrand->find('list', array(
                'conditions' => array(
                    'TravelBrand.brand_chain_id' => $TravelHotelLookups['TravelHotelLookup']['chain_id'],
                    'TravelBrand.brand_status' => '1',
                    'TravelBrand.wtb_status' => '1',
                    'TravelBrand.brand_active' => 'TRUE'
                ),
                'fields' => 'TravelBrand.id, TravelBrand.brand_name',
                'order' => 'TravelBrand.brand_name ASC'
            ));
        }
        $TravelBrands = array('1' => 'No Brand') + $TravelBrands;

        $TravelLookupPropertyTypes = $this->TravelLookupPropertyType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $TravelLookupRateTypes = $this->TravelLookupRateType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->find('all', array('conditions' => array('TravelHotelRoomSupplier.hotel_id' => $id)));
        $this->set(compact('TravelBrands', 'actio_itme_id', 'TravelHotelRoomSuppliers', 'Provinces', 'TravelLookupPropertyTypes', 'TravelLookupRateTypes'));

        $amenity = $this->TravelHotelAmenitie->find('list', array('fields' => array('amenity_type_id', 'amenity_type_id'), 'conditions' => array('hotel_id' => $id)));
        $this->set(compact('amenity')); 

        $categories = $this->TravelLookupAmenityCategorie->find('all');
        $this->set(compact('categories'));

        $review = $this->TravelHotelReviewItem->find('all', array('fields' => array('review_topic_id', 'review_score', 'no_of_reviews'), 'conditions' => array('hotel_id' => $id)));
        $this->set(compact('review')); 

        $reviewlist = $this->TravelHotelReviewItem->find('list', array('fields' => array('review_topic_id', 'review_topic_id'), 'conditions' => array('hotel_id' => $id)));
        $this->set(compact('reviewlist')); 
        
        $reviewtopics = $this->TravelLookupReviewTopic->find('all');
        $this->set(compact('reviewtopics'));
        
        $this->request->data = $TravelHotelLookups;
	}
	
	public function editreviews($id){
		$is_service = '';           
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');

        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $actio_itme_id = '';
        $flag = 0;
 

        $TravelCountries = array();
        $TravelCities = array();
        $TravelSuburbs = array();
        $TravelAreas = array();
        $TravelBrands = array();
        $Provinces = array();
        $ConArry = array();
        
        $AmenityCategories = array();
        $AmenityTypes = array();        

        $arr = explode('_', $id);
        $id = $arr[0];

        if (!$id) {
            throw new NotFoundException(__('Invalid Hotel'));
        }

        $TravelHotelLookups = $this->TravelHotelLookup->findById($id);

        if (!$TravelHotelLookups) {
            throw new NotFoundException(__('Invalid Hotel'));
        }

        if ($this->IsService() == 'true'){
           $is_service = "All services running normally.";
        }   else {
           $is_service = "Some services are offline. Please try later.";
        } 
       
        $this->set(compact('is_service'));        

        //echo $next_action_by;
		///ECHO '<PRE>';
		//print_r($_POST); DIE;

		$active_amenity = 'TRUE';
		$active_review = 'TRUE';
		$actiontype = $this->data['TravelHotelLookup']['action_type'];
		$count_amenities = count($this->request->data['TravelHotelAmenitie']['amenity_type_id']);
		$count_reviews = count($this->request->data['TravelHotelReviewItem']['review_topic_id']);
		$HotelId = $id;
		$action_amenity_type = 0;
		$action_review_type = 0;
		$action_other_type = 0;
		$message = '';
		$xml_msg = '';
		$CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

		$continent_id = $this->request->params['named']['continent_id'];    
		  $country_id = $this->request->params['named']['country_id'];
		  $province_id = $this->request->params['named']['province_id']; 
		  $city_id = $this->request->params['named']['city_id'];
		  $is_page = $this->request->params['named']['is_page']; 
		  $mapping_status = $this->request->params['named']['mapping_status'];

        if ($this->request->is('post') || $this->request->is('put')) {
			if (count($this->request->data['TravelHotelReviewItem']['review_topic_id']) > 0 && !empty($this->data['TravelHotelReviewItem']['review_topic_id'])) {
                    if($this->TravelHotelReviewItem->deleteAll(array('TravelHotelReviewItem.hotel_id' => $id))) // delete project amenity by project id
					{
						// Reviews delete using xml call
						$content_xml_str = '<soap:Body>
											<ProcessXML xmlns="http://www.travel.domain/">
											  <RequestInfo>
												<ResourceDataRequest>
												  <RequestAuditInfo>
													<RequestType>PXML_WData_LookupDelete</RequestType>
													<RequestTime>'.$CreatedDate.'</RequestTime>
													<RequestResource>Silkrouters</RequestResource>
												  </RequestAuditInfo>
												  <RequestParameters>
													<ResourceData>
													  <ResourceDetailsData srno="1" lookuptype="ReviewItemByHotel">
														<ReviewItemByHotelId>'.$id.'</ReviewItemByHotelId>
													</ResourceDetailsData>
													</ResourceData>
												  </RequestParameters>
												</ResourceDataRequest>
											  </RequestInfo>
											</ProcessXML>
										  </soap:Body>';
										  
						$log_call_screen = 'Hotel Review Reviews Re-try  - Delete';
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
							//echo '<pre>';
							// print_r($xml_arr);
							// die;

							if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
								$xml_msg = "Foreign record has been successfully hotal review deleted [Code:$log_call_status_code]";
							} else {
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
								$xml_msg = "There was a problem with foreign record hotal review deletion [Code:$log_call_status_code]";
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
							$message .= 'Local record has been successfully deleted.<br />' . $xml_msg;
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

								$Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Log Id [' . $LogId . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
							}
						
						$counter = 0;
						foreach ($this->data['TravelHotelReviewItem']['review_topic_id'] as $val) { 
							
							$review_score = $this->data['TravelHotelReviewItem']['review_score'][$counter];        
							$no_of_reviews = $this->data['TravelHotelReviewItem']['no_of_reviews'][$counter];
							
							$save_reviews[] = array('TravelHotelReviewItem' => array(
									'review_topic_id' => $val,
									'hotel_id' => $id, 
									'review_score' => $review_score, 
									'no_of_reviews' => $no_of_reviews,                             
									'created_by' => $user_id,
									'modified_by' => $user_id,                            
									'active' => $active_review,                              
							)); 
							$counter++;
						}
						
                        if($this->TravelHotelReviewItem->saveMany($save_reviews)){
							$TravelHotelLookups = $this->TravelHotelLookup->find('first', array('conditions' => array('TravelHotelLookup.id ' => $id) ));
							$HotelName = $TravelHotelLookups['TravelHotelLookup']['hotel_name'];
							$HotelCode = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];
							$reviewtotal = $this->TravelHotelReviewItem->find('count', array('conditions'=>array('TravelHotelReviewItem.hotel_id' => $id)));
							$allreviews = $this->TravelHotelReviewItem->find('all', array('conditions'=>array('TravelHotelReviewItem.hotel_id' => $id)));
							$reviewsxmldata = '';
							$reviewcount = 1;
							foreach($allreviews as $areview){
								$reviewsxmldata .= '<ResourceDetailsData srno="'.$reviewcount.'" actiontype="AddNew">
														<ReviewItemsId>'.$areview['TravelHotelReviewItem']['id'].'</ReviewItemsId>
														<HotelId>'.$id.'</HotelId>
														<HotelCode>'.$HotelCode.'</HotelCode>
														<HotelName>'.$HotelName.'</HotelName>
														<ReviewTopicId>'.$areview['TravelHotelReviewItem']['review_topic_id'].'</ReviewTopicId>
														<ReviewTopic>ReviewDetails</ReviewTopic>
														<ReviewScore>'.$areview['TravelHotelReviewItem']['review_score'].'</ReviewScore>
														<NoofReviews>'.$areview['TravelHotelReviewItem']['no_of_reviews'].'</NoofReviews>
														<CreatedBy>'.$user_id.'</CreatedBy>
														<ModifiedBy>'.$user_id.'</ModifiedBy>
														<CreatedDate>'.$CreatedDate.'</CreatedDate>
														<ModifiedDate>'.$CreatedDate.'</ModifiedDate>
													  </ResourceDetailsData>
													  ';
														  $reviewcount++;
							}
							
							// Amenity delete using xml call
						$content_xml_str = '<soap:Body>
											<ProcessXML xmlns="http://www.travel.domain/">
											  <RequestInfo>
												<ResourceDataRequest>
												  <RequestAuditInfo>
													<RequestType>PXML_WData_ReviewItemsBulk</RequestType>
													<RequestTime>'.$CreatedDate.'</RequestTime>
													<RequestResource>Silkrouters</RequestResource>
												  </RequestAuditInfo>
												  <RequestParameters>
													<ResourceData>
													  <SelectedActionType>AddNew</SelectedActionType>
													  <SelectedCountIn>'.$reviewtotal.'</SelectedCountIn>
													  <MergeData>false</MergeData>
													  '.$reviewsxmldata.'
													</ResourceData>
												  </RequestParameters>
												</ResourceDataRequest>
											  </RequestInfo>
											</ProcessXML>
										  </soap:Body>
										';
										  
						$log_call_screen = 'Hotel Review Reviews Re-try - Add';
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
							//echo '<pre>';
							// print_r($xml_arr);
							// die;
							$xml_error = 'FALSE';
							if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWITEMSBULK']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWITEMSBULK']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWITEMSBULK']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
								$xml_msg = "Foreign record has been successfully hotal review reviews added [Code:$log_call_status_code]<br>";
							} else {
								$log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWITEMSBULK']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
								$log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWITEMSBULK']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
								$xml_msg = "There was a problem with foreign record hotal review reviews added [Code:$log_call_status_code]<br>";
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
							$message .= 'Local record has been successfully updated.<br />' . $xml_msg;
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

								$Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Log Id [' . $LogId . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
								
								/*
								 * WTB Error Information
								 */
								
								$wtb_error_id = $this->request->params['named']['wtb_error_id'];  
								$this->TravelWtbError->updateAll(array('TravelWtbError.error_by' => "'".$user_id."'", 
								'TravelWtbError.log_id' => "'".$LogId."'", 
								'TravelWtbError.error_time' => "'".$CreatedDate."'", 
								), 
								array('TravelWtbError.id' => $wtb_error_id));
							
							}else{
								$wtb_error_id = $this->request->params['named']['wtb_error_id'];  
								$this->TravelWtbError->updateAll(array('TravelWtbError.fixed_by' => "'".$user_id."'", 
								'TravelWtbError.fixed_time' => "'".$CreatedDate."'", 
								'TravelWtbError.error_status' => "'2'"), 
								array('TravelWtbError.id' => $wtb_error_id));
							}
							
							$redirectUrl = "/travel_wtb_errors"; 
							$this->redirect($redirectUrl);
							
							$message .= 'SUCCESS::'.'['.$count_reviews.']'.' Reviews Saved !!';
							empty($save_reviews);
							$this->Session->setFlash($message, 'success');
						}
					}
   
                } 
        }
		
        if ($TravelHotelLookups['TravelHotelLookup']['city_id']) {
            $TravelSuburbs = $this->TravelSuburb->find('list', array(
                'conditions' => array(
                    'TravelSuburb.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],
                    'TravelSuburb.city_id' => $TravelHotelLookups['TravelHotelLookup']['city_id'],
                    'TravelSuburb.status' => '1',
                    'TravelSuburb.wtb_status' => '1',
                    'TravelSuburb.active' => 'TRUE'
                ),
                'fields' => 'TravelSuburb.id, TravelSuburb.name',
                'order' => 'TravelSuburb.name ASC'
            ));
        }

        $this->set(compact('TravelSuburbs'));

        if ($TravelHotelLookups['TravelHotelLookup']['suburb_id']) {
            $TravelAreas = $this->TravelArea->find('list', array(
                'conditions' => array(
                    'TravelArea.suburb_id' => $TravelHotelLookups['TravelHotelLookup']['suburb_id'],
                    'TravelArea.area_status' => '1',
                    'TravelArea.wtb_status' => '1',
                    'TravelArea.area_active' => 'TRUE'
                ),
                'fields' => 'TravelArea.id, TravelArea.area_name',
                'order' => 'TravelArea.area_name ASC'
            ));
        }

        $this->set(compact('TravelAreas'));

        $TravelChains = $this->TravelChain->find('list', array('fields' => 'id,chain_name', 'conditions' => array('chain_status' => 1, 'wtb_status' => 1, 'chain_active' => 'TRUE', array('NOT' => array('id' => 1))), 'order' => 'chain_name ASC'));
        $TravelChains = array('1' => 'No Chain') + $TravelChains;
        $this->set(compact('TravelChains'));
        
        if ($TravelHotelLookups['TravelHotelLookup']['chain_id'] > 1) {
            $TravelBrands = $this->TravelBrand->find('list', array(
                'conditions' => array(
                    'TravelBrand.brand_chain_id' => $TravelHotelLookups['TravelHotelLookup']['chain_id'],
                    'TravelBrand.brand_status' => '1',
                    'TravelBrand.wtb_status' => '1',
                    'TravelBrand.brand_active' => 'TRUE'
                ),
                'fields' => 'TravelBrand.id, TravelBrand.brand_name',
                'order' => 'TravelBrand.brand_name ASC'
            ));
        }
        $TravelBrands = array('1' => 'No Brand') + $TravelBrands;

        $TravelLookupPropertyTypes = $this->TravelLookupPropertyType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $TravelLookupRateTypes = $this->TravelLookupRateType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->find('all', array('conditions' => array('TravelHotelRoomSupplier.hotel_id' => $id)));
        $this->set(compact('TravelBrands', 'actio_itme_id', 'TravelHotelRoomSuppliers', 'Provinces', 'TravelLookupPropertyTypes', 'TravelLookupRateTypes'));

        $amenity = $this->TravelHotelAmenitie->find('list', array('fields' => array('amenity_type_id', 'amenity_type_id'), 'conditions' => array('hotel_id' => $id)));
        $this->set(compact('amenity')); 

        $categories = $this->TravelLookupAmenityCategorie->find('all');
        $this->set(compact('categories'));

        $review = $this->TravelHotelReviewItem->find('all', array('fields' => array('review_topic_id', 'review_score', 'no_of_reviews'), 'conditions' => array('hotel_id' => $id)));
        $this->set(compact('review')); 

        $reviewlist = $this->TravelHotelReviewItem->find('list', array('fields' => array('review_topic_id', 'review_topic_id'), 'conditions' => array('hotel_id' => $id)));
        $this->set(compact('reviewlist')); 
        
        $reviewtopics = $this->TravelLookupReviewTopic->find('all');
        $this->set(compact('reviewtopics'));
        
        $this->request->data = $TravelHotelLookups;
	}
	
	public function editother($id){
		$is_service = '';           
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');

        $role_id = $this->Session->read("role_id");
        $dummy_status = $this->Auth->user('dummy_status');
        $actio_itme_id = '';
        $flag = 0;
 

        $TravelCountries = array();
        $TravelCities = array();
        $TravelSuburbs = array();
        $TravelAreas = array();
        $TravelBrands = array();
        $Provinces = array();
        $ConArry = array();
        
        $AmenityCategories = array();
        $AmenityTypes = array();        

        $arr = explode('_', $id);
        $id = $arr[0];

        if (!$id) {
            throw new NotFoundException(__('Invalid Hotel'));
        }

        $TravelHotelLookups = $this->TravelHotelLookup->findById($id);

        if (!$TravelHotelLookups) {
            throw new NotFoundException(__('Invalid Hotel'));
        }

        if ($this->IsService() == 'true'){
           $is_service = "All services running normally.";
        }   else {
           $is_service = "Some services are offline. Please try later.";
        } 
       
        $this->set(compact('is_service'));        

        //echo $next_action_by;
		///ECHO '<PRE>';
		//print_r($_POST); DIE;

		$active_amenity = 'TRUE';
		$active_review = 'TRUE';
		$actiontype = $this->data['TravelHotelLookup']['action_type'];
		$count_amenities = count($this->request->data['TravelHotelAmenitie']['amenity_type_id']);
		$count_reviews = count($this->request->data['TravelHotelReviewItem']['review_topic_id']);
		$HotelId = $id;
		$action_amenity_type = 0;
		$action_review_type = 0;
		$action_other_type = 0;
		$message = '';
		$xml_msg = '';
		$CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

		$continent_id = $this->request->params['named']['continent_id'];    
		  $country_id = $this->request->params['named']['country_id'];
		  $province_id = $this->request->params['named']['province_id']; 
		  $city_id = $this->request->params['named']['city_id'];
		  $is_page = $this->request->params['named']['is_page']; 
		  $mapping_status = $this->request->params['named']['mapping_status'];

        if ($this->request->is('post') || $this->request->is('put')) {
			
            $HotelCode = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];
            $AreaId = $this->data['TravelHotelLookup']['area_id'];
            $AreaName = $this->data['TravelHotelLookup']['area_name'];
            $SuburbId = $this->data['TravelHotelLookup']['suburb_id'];
            $SuburbName = $this->data['TravelHotelLookup']['suburb_name'];
            $CityId = $this->data['TravelHotelLookup']['city_id'];
            $CityName = $this->data['TravelHotelLookup']['city_name'];
            $CityCode = $this->data['TravelHotelLookup']['city_code'];
            $CountryId = $TravelHotelLookups['TravelHotelLookup']['country_id'];
            $CountryName = $TravelHotelLookups['TravelHotelLookup']['country_name'];
            $CountryCode = $TravelHotelLookups['TravelHotelLookup']['country_code'];
            $ContinentId = $TravelHotelLookups['TravelHotelLookup']['continent_id'];
            $ContinentName = $TravelHotelLookups['TravelHotelLookup']['continent_name'];
            $ContinentCode = $TravelHotelLookups['TravelHotelLookup']['continent_code'];
            $BrandId = $this->data['TravelHotelLookup']['brand_id'];
            $BrandName = $this->data['TravelHotelLookup']['brand_name'];
            $ChainId = $this->data['TravelHotelLookup']['chain_id'];
            $ChainName = $this->data['TravelHotelLookup']['chain_name'];
            $HotelComment = $this->data['TravelHotelLookup']['hotel_comment'];
            $Star = $TravelHotelLookups['TravelHotelLookup']['star'];
            $Keyword = $TravelHotelLookups['TravelHotelLookup']['keyword'];
            $StandardRating = $TravelHotelLookups['TravelHotelLookup']['standard_rating'];
            $HotelRating = $TravelHotelLookups['TravelHotelLookup']['hotel_rating'];
            $FoodRating = $TravelHotelLookups['TravelHotelLookup']['food_rating'];
            $ServiceRating = $TravelHotelLookups['TravelHotelLookup']['service_rating'];
            $LocationRating = $TravelHotelLookups['TravelHotelLookup']['location_rating'];
            $ValueRating = $TravelHotelLookups['TravelHotelLookup']['value_rating'];
            $OverallRating = $TravelHotelLookups['TravelHotelLookup']['overall_rating'];
            $HotelImage1 = $this->data['TravelHotelLookup']['full_img1'];
            $HotelImage2 = $this->data['TravelHotelLookup']['full_img2'];
            $HotelImage3 = $this->data['TravelHotelLookup']['full_img3'];
            $HotelImage4 = $this->data['TravelHotelLookup']['full_img4'];
            $HotelImage5 = $this->data['TravelHotelLookup']['full_img5'];
            $HotelImage6 = $this->data['TravelHotelLookup']['full_img6'];
            $ThumbImage1 = $this->data['TravelHotelLookup']['thumb_img1'];
            $ThumbImage2 = $this->data['TravelHotelLookup']['thumb_img2'];
            $Logo = $TravelHotelLookups['TravelHotelLookup']['logo'];
            $Logo1 = $TravelHotelLookups['TravelHotelLookup']['logo1'];
            $BusinessCenter = $TravelHotelLookups['TravelHotelLookup']['business_center'];
            $MeetingFacilities = $TravelHotelLookups['TravelHotelLookup']['meeting_facilities'];
            $DiningFacilities = $TravelHotelLookups['TravelHotelLookup']['dining_facilities'];
            $BarLounge = $TravelHotelLookups['TravelHotelLookup']['bar_lounge'];
            $FitnessCenter = $TravelHotelLookups['TravelHotelLookup']['fitness_center'];
            $Pool = $TravelHotelLookups['TravelHotelLookup']['pool'];
            $Golf = $TravelHotelLookups['TravelHotelLookup']['golf'];
            $Tennis = $TravelHotelLookups['TravelHotelLookup']['tennis'];
            $Kids = $TravelHotelLookups['TravelHotelLookup']['kids'];
            $Handicap = $TravelHotelLookups['TravelHotelLookup']['handicap'];
            $URLHotel = $TravelHotelLookups['TravelHotelLookup']['url_hotel'];
            $Address = $this->data['TravelHotelLookup']['address'];
            $PostCode = $TravelHotelLookups['TravelHotelLookup']['post_code'];
            $NoRoom = $TravelHotelLookups['TravelHotelLookup']['no_room'];
            $Active = $TravelHotelLookups['TravelHotelLookup']['active'];
            if ($Active == 'TRUE')
                $Active = '1';
            else
                $Active = '0';
            $ReservationEmail = $TravelHotelLookups['TravelHotelLookup']['reservation_email'];
            $ReservationContact = $TravelHotelLookups['TravelHotelLookup']['reservation_contact'];
            $EmergencyContactName = $TravelHotelLookups['TravelHotelLookup']['emergency_contact_name'];
            $ReservationDeskNumber = $TravelHotelLookups['TravelHotelLookup']['reservation_desk_number'];
            $EmergencyContactNumber = $TravelHotelLookups['TravelHotelLookup']['emergency_contact_number'];
            $GPSPARAM1 = $TravelHotelLookups['TravelHotelLookup']['gps_prm_1'];
            $GPSPARAM2 = $TravelHotelLookups['TravelHotelLookup']['gps_prm_2'];
            $ProvinceId = $TravelHotelLookups['TravelHotelLookup']['province_id'];
            $ProvinceName = $TravelHotelLookups['TravelHotelLookup']['province_name'];
            $TopHotel = strtolower($TravelHotelLookups['TravelHotelLookup']['top_hotel']);
            $PropertyType = $TravelHotelLookups['TravelHotelLookup']['property_type'];
            $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

            $IsImage = $TravelHotelLookups['TravelHotelLookup']['is_image'];
            $IsPage = 'Y';
    
            $is_update = $TravelHotelLookups['TravelHotelLookup']['is_updated'];
            if ($is_update == 'Y')
                $actiontype = 'Update';
            else
                $actiontype = 'AddNew';
            
	$this->request->data['TravelHotelLookup']['page_by'] =  $user_id; 
	$this->request->data['TravelHotelLookup']['is_page'] =  'Y'; 
        $this->TravelHotelLookup->id = $id;
  if($hotal_reviews_other_action == 1){  
if ($this->TravelHotelLookup->save($this->request->data['TravelHotelLookup'])) {
	
$location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
$action_URL = 'http://www.travel.domain/ProcessXML';
	
$this->TravelHotelLookup->unbindModel(array('hasMany' => array('TravelHotelRoomSupplier','TravelActionItem')));
$TravelHotelLookups = $this->TravelHotelLookup->find('first', array('conditions' => array('TravelHotelLookup.id ' => $id) ));
$HotelName = $TravelHotelLookups['TravelHotelLookup']['hotel_name'];
    $HotelCode = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];
    $ContinentName = $TravelHotelLookups['TravelHotelLookup']['continent_name'];
    $ContinentId = $TravelHotelLookups['TravelHotelLookup']['continent_id'];
    $ContinentCode = $TravelHotelLookups['TravelHotelLookup']['continent_code'];
    $CountryName = $TravelHotelLookups['TravelHotelLookup']['country_name'];
    $CountryCode = $TravelHotelLookups['TravelHotelLookup']['country_code'];
    $CountryId = $TravelHotelLookups['TravelHotelLookup']['country_id'];
    $province_name = $TravelHotelLookups['TravelHotelLookup']['province_name'];
    $CityName = $TravelHotelLookups['TravelHotelLookup']['city_name'];
    $CityCode = $TravelHotelLookups['TravelHotelLookup']['city_code'];
    $CityId = $TravelHotelLookups['TravelHotelLookup']['city_id'];
    $ChainName = $TravelHotelLookups['TravelHotelLookup']['chain_name'];
    $ChainId = $TravelHotelLookups['TravelHotelLookup']['chain_id'];
    $BrandName = $TravelHotelLookups['TravelHotelLookup']['brand_name'];
    $BrandId = $TravelHotelLookups['TravelHotelLookup']['brand_id'];
    $AreaName = $TravelHotelLookups['TravelHotelLookup']['area_name'];
    $AreaId = $TravelHotelLookups['TravelHotelLookup']['area_id'];
    $SuburbName = $TravelHotelLookups['TravelHotelLookup']['suburb_name'];
    $SuburbId = $TravelHotelLookups['TravelHotelLookup']['suburb_id'];
    $address = $TravelHotelLookups['TravelHotelLookup']['address'];
    $HotelComment = $TravelHotelLookups['TravelHotelLookup']['hotel_comment'];
    $Star = $TravelHotelLookups['TravelHotelLookup']['star'];
    $Keyword = $TravelHotelLookups['TravelHotelLookup']['keyword'];
    $StandardRating = $TravelHotelLookups['TravelHotelLookup']['standard_rating'];
    $HotelRating = $TravelHotelLookups['TravelHotelLookup']['hotel_rating'];
    $FoodRating = $TravelHotelLookups['TravelHotelLookup']['food_rating'];
    $ServiceRating = $TravelHotelLookups['TravelHotelLookup']['service_rating'];
    $LocationRating = $TravelHotelLookups['TravelHotelLookup']['location_rating'];
    $ValueRating = $TravelHotelLookups['TravelHotelLookup']['value_rating'];
    $OverallRating = $TravelHotelLookups['TravelHotelLookup']['overall_rating'];
    $HotelImage1 = $TravelHotelLookups['TravelHotelLookup']['full_img1'];
    $HotelImage2 = $TravelHotelLookups['TravelHotelLookup']['full_img2'];
    $HotelImage3 = $TravelHotelLookups['TravelHotelLookup']['full_img3'];
    $HotelImage4 = $TravelHotelLookups['TravelHotelLookup']['full_img4'];
    $HotelImage5 = $TravelHotelLookups['TravelHotelLookup']['full_img5'];
    $HotelImage6 = $TravelHotelLookups['TravelHotelLookup']['full_img6'];
	$HotelImage7 = $TravelHotelLookups['TravelHotelLookup']['full_img7'];
	$HotelImage8 = $TravelHotelLookups['TravelHotelLookup']['full_img8'];
	$HotelImage9 = $TravelHotelLookups['TravelHotelLookup']['full_img9'];
	$HotelImage10 = $TravelHotelLookups['TravelHotelLookup']['full_img10'];
	$HotelImage11 = $TravelHotelLookups['TravelHotelLookup']['full_img11'];
	$HotelImage12 = $TravelHotelLookups['TravelHotelLookup']['full_img12'];
	$HotelImage13 = $TravelHotelLookups['TravelHotelLookup']['full_img13'];
	$HotelImage14 = $TravelHotelLookups['TravelHotelLookup']['full_img14'];
	$HotelImage15 = $TravelHotelLookups['TravelHotelLookup']['full_img15'];
	$HotelImage16 = $TravelHotelLookups['TravelHotelLookup']['full_img16'];
	$HotelImage17 = $TravelHotelLookups['TravelHotelLookup']['full_img17'];
	$HotelImage18 = $TravelHotelLookups['TravelHotelLookup']['full_img18'];
	$HotelImage19 = $TravelHotelLookups['TravelHotelLookup']['full_img19'];
	$HotelImage20 = $TravelHotelLookups['TravelHotelLookup']['full_img20'];
	
    $ThumbImage1 = $TravelHotelLookups['TravelHotelLookup']['thumb_img1'];
    $ThumbImage2 = $TravelHotelLookups['TravelHotelLookup']['thumb_img2'];
    
    $Logo = $TravelHotelLookups['TravelHotelLookup']['logo'];
    $Logo1 = $TravelHotelLookups['TravelHotelLookup']['logo1'];
    $BusinessCenter = $TravelHotelLookups['TravelHotelLookup']['business_center'];
    $MeetingFacilities = $TravelHotelLookups['TravelHotelLookup']['meeting_facilities'];
    $DiningFacilities = $TravelHotelLookups['TravelHotelLookup']['dining_facilities'];
    $BarLounge = $TravelHotelLookups['TravelHotelLookup']['bar_lounge'];
    $FitnessCenter = $TravelHotelLookups['TravelHotelLookup']['fitness_center'];
    $Pool = $TravelHotelLookups['TravelHotelLookup']['pool'];
    $Golf = $TravelHotelLookups['TravelHotelLookup']['golf'];
    $Tennis = $TravelHotelLookups['TravelHotelLookup']['tennis'];
    $Kids = $TravelHotelLookups['TravelHotelLookup']['kids'];
    $Handicap = $TravelHotelLookups['TravelHotelLookup']['handicap'];
    $URLHotel = $TravelHotelLookups['TravelHotelLookup']['url_hotel'];
    $Address = $TravelHotelLookups['TravelHotelLookup']['address'];
    $PostCode = $TravelHotelLookups['TravelHotelLookup']['post_code'];
    $NoRoom = $TravelHotelLookups['TravelHotelLookup']['no_room'];
    $HotelFormerName = $TravelHotelLookups['TravelHotelLookup']['hotel_former_name'];
    $Active = $TravelHotelLookups['TravelHotelLookup']['active'];	
	
    if ($Active == 'TRUE')
        $Active = '1';
    else
	$Active = '0';
    $ReservationEmail = $TravelHotelLookups['TravelHotelLookup']['reservation_email'];
    $ReservationContact = $TravelHotelLookups['TravelHotelLookup']['reservation_contact'];
    $EmergencyContactName = $TravelHotelLookups['TravelHotelLookup']['emergency_contact_name'];
    $ReservationDeskNumber = $TravelHotelLookups['TravelHotelLookup']['reservation_desk_number'];
    $EmergencyContactNumber = $TravelHotelLookups['TravelHotelLookup']['emergency_contact_number'];
    $GPSPARAM1 = $TravelHotelLookups['TravelHotelLookup']['gps_prm_1'];
    $GPSPARAM2 = $TravelHotelLookups['TravelHotelLookup']['gps_prm_2'];
    $ProvinceId = $TravelHotelLookups['TravelHotelLookup']['province_id'];
    $ProvinceName = $TravelHotelLookups['TravelHotelLookup']['province_name'];
    $TopHotel = strtolower($TravelHotelLookups['TravelHotelLookup']['top_hotel']);
    $PropertyType = $TravelHotelLookups['TravelHotelLookup']['property_type'];
    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

    $is_image = $TravelHotelLookups['TravelHotelLookup']['is_image'];
    if ($is_image == 'Y')
        $IsImage = 'true';
    else
        $IsImage = 'false';
    
    $IsPage = 'true';
    
    $is_update = $TravelHotelLookups['TravelHotelLookup']['is_updated'];
    if ($is_update == 'Y')
        $actiontype = 'Update';
    else
        $actiontype = 'AddNew';
   
   

          $content_xml_str = '<soap:Body>
                                        <ProcessXML xmlns="http://www.travel.domain/">
                                            <RequestInfo>
                                                <ResourceDataRequest>
                                                    <RequestAuditInfo>
                                                        <RequestType>PXML_WData_Hotel</RequestType>
                                                        <RequestTime>' . $CreatedDate . '</RequestTime>
                                                        <RequestResource>Silkrouters</RequestResource>
                                                    </RequestAuditInfo>
                                                    <RequestParameters>                        
                                                        <ResourceData>
                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">
                                                                <HotelId>' . $HotelId . '</HotelId>
                                <HotelCode><![CDATA[' . $HotelCode . ']]></HotelCode>
                                <HotelName><![CDATA[' . $HotelName . ']]></HotelName>
                                <AreaId>' . $AreaId . '</AreaId>
                                <AreaCode>NA</AreaCode>
                                <AreaName><![CDATA[' . $AreaName . ']]></AreaName>
                                <SuburbId>' . $SuburbId . '</SuburbId>
                                <SuburbCode>NA</SuburbCode>
                                <SuburbName><![CDATA[' . $SuburbName . ']]></SuburbName>
                                <CityId>' . $CityId . '</CityId>
                                <CityCode><![CDATA[' . $CityCode . ']]></CityCode>
                                <CityName><![CDATA[' . $CityName . ']]></CityName>
                                <CountryId>' . $CountryId . '</CountryId>
                                <CountryCode><![CDATA[' . $CountryCode . ']]></CountryCode>
                                <CountryName><![CDATA[' . $CountryName . ']]></CountryName>
                                <ContinentId>' . $ContinentId . '</ContinentId>
                                <ContinentCode><![CDATA[' . $ContinentCode . ']]></ContinentCode>
                                <ContinentName><![CDATA[' . $ContinentName . ']]></ContinentName>
                                <ProvinceId>' . $ProvinceId . '</ProvinceId>
                                <ProvinceName><![CDATA[' . $ProvinceName . ']]></ProvinceName>
                                <BrandId>' . $BrandId . '</BrandId>
                                <BrandName><![CDATA[' . $BrandName . ']]></BrandName>
                                <ChainId>' . $ChainId . '</ChainId>
                                <ChainName><![CDATA[' . $ChainName . ']]></ChainName>
                                <HotelComment><![CDATA[' . $HotelComment . ']]></HotelComment>
                                <Star>' . $Star . '</Star>
                                <Keyword><![CDATA[' . $Keyword . ']]></Keyword>
                                <StandardRating>' . $StandardRating . '</StandardRating>
                                <HotelRating>' . $StandardRating . '</HotelRating>                                
                                <FoodRating>' . $FoodRating . '</FoodRating>
                                <ServiceRating>' . $ServiceRating . '</ServiceRating>
                                <LocationRating>' . $LocationRating . '</LocationRating>
                                <ValueRating>' . $ValueRating . '</ValueRating>
                                <OverallRating>' . $OverallRating . '</OverallRating>						
								
                                <HotelImage1Full><![CDATA[' . $HotelImage1 . ']]></HotelImage1Full>
                                <HotelImage2Full><![CDATA[' . $HotelImage2 . ']]></HotelImage2Full>
                                <HotelImage3Full><![CDATA[' . $HotelImage3 . ']]></HotelImage3Full>
                                <HotelImage4Full><![CDATA[' . $HotelImage4 . ']]></HotelImage4Full>
                                <HotelImage5Full><![CDATA[' . $HotelImage5 . ']]></HotelImage5Full>
                                <HotelImage6Full><![CDATA[' . $HotelImage6 . ']]></HotelImage6Full>
								<HotelImage7Full><![CDATA[' . $HotelImage7 . ']]></HotelImage7Full>
								<HotelImage8Full><![CDATA[' . $HotelImage8 . ']]></HotelImage8Full>
								<HotelImage9Full><![CDATA[' . $HotelImage9 . ']]></HotelImage9Full>
								<HotelImage10Full><![CDATA[' . $HotelImage10 . ']]></HotelImage10Full>
								<HotelImage11Full><![CDATA[' . $HotelImage11 . ']]></HotelImage11Full>
								<HotelImage12Full><![CDATA[' . $HotelImage12 . ']]></HotelImage12Full>
								<HotelImage13Full><![CDATA[' . $HotelImage13 . ']]></HotelImage13Full>
								<HotelImage14Full><![CDATA[' . $HotelImage14 . ']]></HotelImage14Full>
								<HotelImage15Full><![CDATA[' . $HotelImage15 . ']]></HotelImage15Full>
								<HotelImage16Full><![CDATA[' . $HotelImage16 . ']]></HotelImage16Full>
								<HotelImage17Full><![CDATA[' . $HotelImage17 . ']]></HotelImage17Full>
								<HotelImage18Full><![CDATA[' . $HotelImage18 . ']]></HotelImage18Full>
								<HotelImage19Full><![CDATA[' . $HotelImage19 . ']]></HotelImage19Full>
								<HotelImage20Full><![CDATA[' . $HotelImage20 . ']]></HotelImage20Full>								

                                <HotelImage1Thumb><![CDATA[' . $ThumbImage1 . ']]></HotelImage1Thumb>
                                <HotelImage2Thumb><![CDATA[' . $ThumbImage2 . ']]></HotelImage2Thumb>                             

                                <IsImage>' . $IsImage . '</IsImage>
                                <IsPage>' . $IsPage . '</IsPage>
								<HotelFormerName>' . $HotelFormerName . '</HotelFormerName>
                                <Logo>' . $Logo . '</Logo>
                                                                <Logo1>' . $Logo1 . '</Logo1>
                                                                <BusinessCenter>' . $BusinessCenter . '</BusinessCenter>
                                                                <MeetingFacilities>' . $MeetingFacilities . '</MeetingFacilities>
                                                                <DiningFacilities>' . $DiningFacilities . '</DiningFacilities>
                                                                <BarLounge>' . $BarLounge . '</BarLounge>
                                                                <FitnessCenter>' . $FitnessCenter . '</FitnessCenter>
                                                                <Pool>' . $Pool . '</Pool>
                                                                <Golf>' . $Golf . '</Golf>
                                                                <Tennis>' . $Tennis . '</Tennis>
                                                                <Kids>' . $Kids . '</Kids>
                                                                <Handicap>' . $Handicap . '</Handicap>
                                                                <URLHotel><![CDATA[' . $URLHotel . ']]></URLHotel>
                                                                <Address><![CDATA[' . $Address . ']]></Address>
                                                                <PostCode>' . $PostCode . '</PostCode>
                                                                <NoRoom>' . $NoRoom . '</NoRoom>
                                                                <Active>' . $Active . '</Active>
                                                                <ReservationEmail><![CDATA[' . $ReservationEmail . ']]></ReservationEmail>
                                                                <ReservationContact><![CDATA[' . $ReservationContact . ']]></ReservationContact>
                                                                <EmergencyContactName><![CDATA[' . $EmergencyContactName . ']]></EmergencyContactName>
                                                                <ReservationDeskNumber><![CDATA[' . $ReservationDeskNumber . ']]></ReservationDeskNumber>
                                                                <EmergencyContactNumber><![CDATA[' . $EmergencyContactNumber . ']]></EmergencyContactNumber>
                                                                <GPSPARAM1>' . $GPSPARAM1 . '</GPSPARAM1>
                                                                <GPSPARAM2>' . $GPSPARAM2 . '</GPSPARAM2>
                                                                <TopHotel>' . $TopHotel . '</TopHotel> 
                                                                <PropertyType>' . $PropertyType . '</PropertyType>
                                                                <ApprovedBy>0</ApprovedBy>
                                                                <ApprovedDate>1111-01-01T00:00:00</ApprovedDate>
                                                                <CreatedBy>0</CreatedBy>
                                                                <CreatedDate>' . $CreatedDate . '</CreatedDate>
                                                            </ResourceDetailsData>
                         
                                                    </ResourceData>
                                                    </RequestParameters>
                                                </ResourceDataRequest>
                                            </RequestInfo>
                                        </ProcessXML>
                                    </soap:Body>';


          $log_call_screen = 'Hotel Review Re-try - Edit';



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

                // pr($xml_arr);

                // die;



                if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {

                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];

                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];

                    $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]<br>";

                   

                } else {



                    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];

                    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID

                    $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]<br>";

                   

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
                $message .= 'Local record has been successfully updated.<br />' . $xml_msg;
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

                    $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Log Id [' . $LogId . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date("m/d/Y H:i:s", $date->format('U')) . ']')->send();
                
					/*
								 * WTB Error Information
								 */
								
								$wtb_error_id = $this->request->params['named']['wtb_error_id'];  
								$this->TravelWtbError->updateAll(array('TravelWtbError.error_by' => "'".$user_id."'", 
								'TravelWtbError.log_id' => "'".$LogId."'", 
								'TravelWtbError.error_time' => "'".$CreatedDate."'", 
								), 
								array('TravelWtbError.id' => $wtb_error_id));
								
				
				}else{
					$wtb_error_id = $this->request->params['named']['wtb_error_id'];  
					$this->TravelWtbError->updateAll(array('TravelWtbError.fixed_by' => "'".$user_id."'", 
					'TravelWtbError.fixed_time' => "'".$CreatedDate."'", 
					'TravelWtbError.error_status' => "'2'"), 
					array('TravelWtbError.id' => $wtb_error_id));
				}

                $this->Session->setFlash($message, 'success');
            }
  }   
  $continent_id = $this->request->params['named']['continent_id'];    
  $country_id = $this->request->params['named']['country_id'];
  $province_id = $this->request->params['named']['province_id']; 
  $city_id = $this->request->params['named']['city_id'];
  $is_page = $this->request->params['named']['is_page']; 
  $mapping_status = $this->request->params['named']['mapping_status'];
  //$redirectUrl = "/travel_hotel_reviews/index/continent_id:$continent_id/country_id:$country_id/province_id:$province_id/city_id:$city_id/is_page:$is_page/mapping_status:$mapping_status"; 
  //$this->redirect($redirectUrl);
  $redirectUrl = "/travel_wtb_errors"; 
  $this->redirect($redirectUrl);
        }
		
        if ($TravelHotelLookups['TravelHotelLookup']['city_id']) {
            $TravelSuburbs = $this->TravelSuburb->find('list', array(
                'conditions' => array(
                    'TravelSuburb.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],
                    'TravelSuburb.city_id' => $TravelHotelLookups['TravelHotelLookup']['city_id'],
                    'TravelSuburb.status' => '1',
                    'TravelSuburb.wtb_status' => '1',
                    'TravelSuburb.active' => 'TRUE'
                ),
                'fields' => 'TravelSuburb.id, TravelSuburb.name',
                'order' => 'TravelSuburb.name ASC'
            ));
        }

        $this->set(compact('TravelSuburbs'));

        if ($TravelHotelLookups['TravelHotelLookup']['suburb_id']) {
            $TravelAreas = $this->TravelArea->find('list', array(
                'conditions' => array(
                    'TravelArea.suburb_id' => $TravelHotelLookups['TravelHotelLookup']['suburb_id'],
                    'TravelArea.area_status' => '1',
                    'TravelArea.wtb_status' => '1',
                    'TravelArea.area_active' => 'TRUE'
                ),
                'fields' => 'TravelArea.id, TravelArea.area_name',
                'order' => 'TravelArea.area_name ASC'
            ));
        }

        $this->set(compact('TravelAreas'));

        $TravelChains = $this->TravelChain->find('list', array('fields' => 'id,chain_name', 'conditions' => array('chain_status' => 1, 'wtb_status' => 1, 'chain_active' => 'TRUE', array('NOT' => array('id' => 1))), 'order' => 'chain_name ASC'));
        $TravelChains = array('1' => 'No Chain') + $TravelChains;
        $this->set(compact('TravelChains'));
        
        if ($TravelHotelLookups['TravelHotelLookup']['chain_id'] > 1) {
            $TravelBrands = $this->TravelBrand->find('list', array(
                'conditions' => array(
                    'TravelBrand.brand_chain_id' => $TravelHotelLookups['TravelHotelLookup']['chain_id'],
                    'TravelBrand.brand_status' => '1',
                    'TravelBrand.wtb_status' => '1',
                    'TravelBrand.brand_active' => 'TRUE'
                ),
                'fields' => 'TravelBrand.id, TravelBrand.brand_name',
                'order' => 'TravelBrand.brand_name ASC'
            ));
        }
        $TravelBrands = array('1' => 'No Brand') + $TravelBrands;

        $TravelLookupPropertyTypes = $this->TravelLookupPropertyType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $TravelLookupRateTypes = $this->TravelLookupRateType->find('list', array('fields' => 'id,value', 'order' => 'value ASC'));
        $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->find('all', array('conditions' => array('TravelHotelRoomSupplier.hotel_id' => $id)));
        $this->set(compact('TravelBrands', 'actio_itme_id', 'TravelHotelRoomSuppliers', 'Provinces', 'TravelLookupPropertyTypes', 'TravelLookupRateTypes'));

        $amenity = $this->TravelHotelAmenitie->find('list', array('fields' => array('amenity_type_id', 'amenity_type_id'), 'conditions' => array('hotel_id' => $id)));
        $this->set(compact('amenity')); 

        $categories = $this->TravelLookupAmenityCategorie->find('all');
        $this->set(compact('categories'));

        $review = $this->TravelHotelReviewItem->find('all', array('fields' => array('review_topic_id', 'review_score', 'no_of_reviews'), 'conditions' => array('hotel_id' => $id)));
        $this->set(compact('review')); 

        $reviewlist = $this->TravelHotelReviewItem->find('list', array('fields' => array('review_topic_id', 'review_topic_id'), 'conditions' => array('hotel_id' => $id)));
        $this->set(compact('reviewlist')); 
        
        $reviewtopics = $this->TravelLookupReviewTopic->find('all');
        $this->set(compact('reviewtopics'));
        
        $this->request->data = $TravelHotelLookups;
	}

}

