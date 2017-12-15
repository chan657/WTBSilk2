<?php

 

/**

 * Travel Action controller.

 *

 * This file will render views from views/actions/

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

App::uses('Xml', 'Utility');



/**

 * Travel Action controller

 *

 *

 * @package       app.Controller

 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html

 */

class TravelActionItemsController extends AppController {



    var $uses = array('TravelActionItem', 'User', 'TravelSupplier', 'TravelCountry', 'TravelActionItemType', 'DuplicateMappinge', 'Agent', 'TravelRemark', 'LookupValueActionItemRejection', 'LookupValueActionItemReturn',

        'TravelCountrySupplier', 'TravelCitySupplier', 'TravelHotelRoomSupplier', 'LogCall', 'Mappinge', 'TravelCity',

        'TravelHotelLookup', 'TravelBrand', 'TravelChain', 'TravelSuburb', 'TravelArea', 'Province', 'TravelLookupContinent', 'SupplierCountry',

        'SupplierCity', 'SupplierHotel', 'Common', 'SupportTicket','TravelWtbError','TravelActionRemarkLevel');



    public function index() {



        $dummy_status = $this->Auth->user('dummy_status');

        $role_id = $this->Session->read("role_id");

        $user_id = $this->Auth->user('id');

        $search_condition = array();
        
        $msg_flag = '';
        
        $msg = '';

        if ($this->request->is('post') || $this->request->is('put')) {



            if (!empty($this->data['TravelActionItem']['global_search'])) {

                $search = $this->data['TravelActionItem']['global_search'];

                array_push($search_condition, array('OR' => array('TravelActionItem.id' => mysql_escape_string(trim(strip_tags($search))), 'TravelHotelLookup.hotel_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%", 'Agent.agent_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%", 'TravelCountrySupplier.country_mapping_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%", 'TravelHotelRoomSupplier.hotel_mapping_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%", 'TravelCitySupplier.city_mapping_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($search))) . "%")));

                //array_push($search_condition, array('TravelActionItem.id' => mysql_escape_string(trim(strip_tags($search)))));

            }



            if (!empty($this->data['ActionItem']['action_item_level_id'])) {

                $search = $this->data['ActionItem']['action_item_level_id'];

                array_push($search_condition, array('ActionItem.action_item_level_id' => mysql_escape_string(trim(strip_tags($search)))));

            }



            if (!empty($this->data['ActionItem']['type_id'])) {

                $search = $this->data['ActionItem']['type_id'];

                array_push($search_condition, array('ActionItem.type_id' => mysql_escape_string(trim(strip_tags($search)))));

            }



            if (!empty($this->data['ActionItem']['lead_status'])) {

                $search = $this->data['ActionItem']['lead_status'];

                array_push($search_condition, array('Lead.lead_status' => mysql_escape_string(trim(strip_tags($search)))));

            }

			

			if(isset($this->request->data['filter']))

			{

				

				if($this->request->data['TravelActionItem']['level_id'] !='')

				{

					array_push($search_condition, array('TravelActionItem.level_id' => $this->request->data['TravelActionItem']['level_id']));

				}

				if($this->request->data['TravelActionItem']['created_by'] !='')

				{

					array_push($search_condition, array('TravelActionItem.created_by' => $this->request->data['TravelActionItem']['created_by']));

				}

			}

        }



        if ($dummy_status)

            array_push($search_condition, array('TravelActionItem.dummy_status' => $dummy_status));


$get_user_id =$user_id;

if(isset($_GET['country_id'])){

$get_country_id =	$_GET['country_id'];
$get_province_id =	$_GET['province_id'];
$get_city_id =	$_GET['city_id'];
$get_creator =	$_GET['creator'];
$get_level_id =	$_GET['level_id'];
$get_supplier_id =	$_GET['supplier_id'];
$get_creator_name = 'XXX';
$get_country_name = 'XXX';
$get_province_name = 'XXX';
$get_city_name = 'XXX';

if ($get_level_id==7) {

$msg_flag = 'Y';
$msg = 'Showing [HOTEL EDIT] Actions Submitted by: ['. $get_creator_name . "] For: [" . $get_country_name . " -> ". $get_province_name . " -> " . $get_city_name. "]";

$result_array = ClassRegistry::init('TravelHotelLookup')->find('all', array('fields' => array('id'),
    'conditions' => array('TravelHotelLookup.country_id' => $get_country_id,
                            'TravelHotelLookup.city_id' => $get_city_id,
                            'TravelHotelLookup.province_id ' => $get_province_id)));
 
count($result_array);
//pr(count($result_array));
if (count($result_array) == 0){
        array_push($search_condition, array('TravelActionItem.id' => 'No Records Found Situation'));    
} else {
	$checkCondition = false;

	foreach( $result_array as  $results){
		$get_hotel_id = $results['TravelHotelLookup']['id'];		
		$conditions['or'][] = array('TravelActionItem.hotel_id =' => $get_hotel_id);   
		$checkCondition = true;
	}
	}
}

if ($get_level_id==4) {

$msg_flag = 'Y';
$msg = 'Showing [HOTEL EDIT] Actions Submitted by: ['. $get_creator_name . "] For: [" . $get_country_name . " -> ". $get_province_name . " -> " . $get_city_name. "]";
    
$result_array = ClassRegistry::init('TravelHotelRoomSupplier')->find('all', array('fields' => array('id'),
    'conditions' => array('TravelHotelRoomSupplier.hotel_country_id' => $get_country_id,
                            'TravelHotelRoomSupplier.hotel_city_id' => $get_city_id,
                            'TravelHotelRoomSupplier.supplier_id' => $get_supplier_id)));

count($result_array);
//pr(count($result_array));
if (count($result_array) == 0){
        array_push($search_condition, array('TravelActionItem.id' => 'No Records Found Situation'));    
} else {
	$checkCondition = false;

	foreach( $result_array as  $results){
		$get_id = $results['TravelHotelRoomSupplier']['id'];			
		$conditions['or'][] = array('TravelActionItem.hotel_supplier_id =' => $get_id);
		$checkCondition = true;
	}
	}        
}

array_push($search_condition, array('TravelActionItem.created_by_id' => $get_creator));
array_push($search_condition, array('TravelActionItem.next_action_by' => $get_user_id));
array_push($search_condition, array('TravelActionItem.level_id' => $get_level_id));
array_push($search_condition, array('TravelActionItem.action_item_active' => 'Yes'));

array_push($search_condition, $conditions);
        //pr($search_condition);
        //die;

}
 elseif (count($this->params['pass'])) {



            $aaray = explode(':', $this->params['pass'][0]);

            $field = $aaray[0];

            $value = $aaray[1];

            array_push($search_condition, array('TravelActionItem.' . $field => $value)); // when builder is approve/pending

}

        if ($role_id == '61') {

		// change level_id 4 to 7 by pc // Reverted this change 21/11/16.

            $this->paginate['conditions'][0] = "TravelActionItem.action_item_active='Yes' AND TravelActionItem.level_id='4' AND TravelActionItem.next_action_by = " . $user_id . "";

        } elseif ($role_id == '62') {

            $this->paginate['conditions'][0] = "TravelActionItem.action_item_active='Yes' AND TravelActionItem.level_id='7' AND TravelActionItem.next_action_by = " . $user_id . "";    

        } else {

            $this->paginate['conditions'][0] = "TravelActionItem.action_item_active='Yes' AND TravelActionItem.next_action_by = " . $user_id . "";        

        }

// level lists 	

       $action_levels = $this->TravelActionRemarkLevel->find('all');

	   $action_level = array();

	   foreach($action_levels as $loop)

	   {

		 $action_level[$loop['TravelActionRemarkLevel']['id']] = $loop['TravelActionRemarkLevel']['value'];

	   }

	  

// users lists	  

	$user_lists = $this->User->find('all', array('fields' => array('User.id','User.fname','User.lname')));

	$user_list =array();

		foreach($user_lists as $u){

			$user_list[$u['User']['id']] = $u['User']['fname'] .' '.$u['User']['lname'];

		}

        $this->paginate['conditions'][1] = $search_condition;

        $this->paginate['order'] = array('TravelActionItem.id' => 'desc');

        $this->set('travel_actionitems', $this->paginate("TravelActionItem"));

	$this->set(compact('action_level','user_list','msg_flag','msg'));

    }



    public function agent_action($actio_itme_id = null) {

        $this->layout = '';





        /*         * *******Checking user*********** */

        $dummy_status = $this->Auth->user('dummy_status');

        $user_id = $this->Auth->user('id');

        $role_id = $this->Session->read("role_id");



        $travel_actionitems = $this->TravelActionItem->findById($actio_itme_id);



        if ($this->request->is('post') || $this->request->is('put')) {





            /*             * ************This data is common features **************************************** */



            $this->request->data['TravelActionItem']['parent_action_item_id'] = $actio_itme_id;

            $this->request->data['TravelActionItem']['dummy_status'] = $dummy_status;

            $this->request->data['TravelActionItem']['action_item_created'] = date('Y-m-d');

            $this->request->data['TravelActionItem']['created_by_id'] = $travel_actionitems['TravelActionItem']['created_by_id'];

            $this->request->data['TravelActionItem']['level_id'] = $travel_actionitems['TravelActionItem']['level_id'];

            $this->request->data['TravelActionItem']['agent_id'] = $travel_actionitems['TravelActionItem']['agent_id'];

            $this->request->data['TravelActionItem']['action_item_active'] = 'Yes';

            $this->request->data['TravelActionItem']['created_by'] = $user_id;

            $this->request->data['TravelActionItem']['action_item_source'] = $role_id;



            $agents['Agent']['agent_action_parent_id'] = "'" . $travel_actionitems['TravelActionItem']['parent_action_item_id'] . "'";

            $agents['Agent']['agent_active_primary'] = '0'; // screen primary info.

            $agents['Agent']['agent_active_preference'] = '0'; // screen details.



            $this->request->data['TravelRemark']['remarks_time'] = date('g:i A');

            $this->request->data['TravelRemark']['created_by'] = $user_id;

            $this->request->data['TravelRemark']['agent_id'] = $travel_actionitems['TravelActionItem']['agent_id'];

            $this->request->data['TravelRemark']['remarks_date'] = date('Y-m-d');

            $this->request->data['TravelRemark']['dummy_status'] = $dummy_status;

            $this->request->data['TravelRemark']['remarks_level'] = $travel_actionitems['TravelActionItem']['level_id'];



            $type_id = $this->data['TravelActionItem']['type_id'];

            if ($type_id == '2') { // Approval

                $agents['Agent']['agent_status'] = '1'; //  for active for Approval of lookup_agent_statuses

                $agents['Agent']['agent_approved'] = '1';

                $agents['Agent']['agent_approved_by'] = "'" . $user_id . "'";

                $agents['Agent']['agent_approved_date'] = "'" . date('Y-m-d h:i:s') . "'";

                $this->request->data['TravelRemark']['remarks'] = 'Approve Agent';

                $this->request->data['TravelActionItem']['description'] = 'Approve Agent';

            } elseif ($type_id == '3') { // Return

                $agents['Agent']['agent_status'] = '6'; // Returned

                $this->request->data['TravelRemark']['remarks'] = 'Returned Agent';

                $this->request->data['TravelActionItem']['description'] = 'Returned Agent';

                $this->request->data['TravelActionItem']['next_action_by'] = $travel_actionitems['TravelActionItem']['created_by_id'];

            } elseif ($type_id == '5') { // Rejection

                $agents['Agent']['agent_status'] = '11'; // Rejection

                $this->request->data['TravelRemark']['remarks'] = 'Rejection Agent';

                $this->request->data['TravelActionItem']['description'] = 'Rejection Agent';

            } elseif ($type_id == '7') { // Allocation

                $agents['Agent']['agent_status'] = '3'; //  for Allocated for Approval of lookup_agent_statuses

                $agents['Agent']['agent_approved'] = '1';

                $agents['Agent']['agent_approved_by'] = "'" . $user_id . "'";

                $agents['Agent']['agent_approved_date'] = "'" . date('Y-m-d h:i:s') . "'";

                $this->request->data['TravelRemark']['remarks'] = 'Allocation Agent';

                $this->request->data['TravelActionItem']['description'] = 'Allocation Agent';

            }





            $this->TravelActionItem->create();

            if ($this->TravelActionItem->save($this->data['TravelActionItem'])) {

                $last_action_id = $this->TravelActionItem->getLastInsertId();

                $this->TravelRemark->save($this->data['TravelRemark']);

                $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));

                $this->Agent->updateAll($agents['Agent'], array('Agent.id' => $travel_actionitems['TravelActionItem']['agent_id']));

                //$log = $this->Agent->getDataSource()->getLog(false, false);

                //debug($log);

                //die;

                $this->Session->setFlash('Data have been submitted.', 'success');

            } else {

                $this->Session->setFlash('This action is already added, check your input and try again...', 'failure');

            }





            echo '<script>

                        var objP=parent.document.getElementsByClassName("mfp-bg");

                        var objC=parent.document.getElementsByClassName("mfp-wrap");

                        objP[0].style.display="none";

                        objC[0].style.display="none";

                        parent.location.reload(true);</script>';

        }



        if ($travel_actionitems['TravelActionItem']['type_id'] == '6') {

            $type = $this->TravelActionItemType->find('list', array('fields' => array('id', 'value'), 'conditions' => 'id = 5 OR id = 3 OR id = 7', 'order' => 'value asc'));

            $travel_actionitems['ActionAgent'] = $this->Agent->findById($travel_actionitems['TravelActionItem']['agent_id']);

            $travel_actionitems['AgentEvent'] = $this->Event->find('first', array('conditions' => array('Event.agent_id' => $travel_actionitems['TravelActionItem']['agent_id'])));

        } else

            $type = $this->TravelActionItemType->find('list', array('fields' => array('id', 'value'), 'conditions' => 'id = 2 OR id = 3 OR id = 5', 'order' => 'value asc'));

        $this->set(compact('type'));



        $reject_cond = array('type' => array('0'));

        $rejections = $this->LookupValueActionItemRejection->find('list', array('fields' => 'id, value', 'conditions' => $reject_cond, 'order' => 'value ASC'));

        $this->set(compact('rejections'));



        $retrun_cond = array('type' => array('0'));

        $returns = $this->LookupValueActionItemReturn->find('list', array('fields' => 'id, value', 'conditions' => $retrun_cond, 'order' => 'value ASC'));

        $this->set(compact('returns'));



        if (!$this->request->data) {

            $this->request->data = $travel_actionitems;

        }

    }



    public function submit_action($actio_itme_id = null) {


        //  $this->layout = '';



        $headding = '';

        $order_return = '';

        $log_call_screen = '';

        $xml_msg = '';

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';

        $action_URL = 'http://www.travel.domain/ProcessXML';



        /*         * *******Checking user*********** */

        $dummy_status = $this->Auth->user('dummy_status');

        $channel_id = $this->Session->read("channel_id");

        $user_id = $this->Auth->user('id');

        $role_id = $this->Session->read("role_id");

        $xml_error = 'FALSE';







        $travel_actionitems = $this->TravelActionItem->findById($actio_itme_id);

        $level_id = $travel_actionitems['TravelActionItem']['level_id'];

        $action_type_id = $travel_actionitems['TravelActionItem']['type_id'];



        /*

          if ($travel_actionitems['TravelActionItem']['type_id'] == '1' || $travel_actionitems['TravelActionItem']['type_id'] == '8')

          $actiontype = 'AddNew';

          elseif ($travel_actionitems['TravelActionItem']['type_id'] == '4')

          $actiontype = 'Update';

         * 

         */



        $rejection_cond = array();

        $Provinces = array();



        if ($level_id == '2') { // mapping country

            $retrun_cond = array('type' => array('0', '4')); // 0=other 4=mapping

            $headding = 'Mapping Country';

            $this->set('mapping_type', '1');

            $country_supplier_id = $travel_actionitems['TravelActionItem']['country_supplier_id'];

            $TravelCountrySuppliers = $this->TravelCountrySupplier->findById($country_supplier_id);

            $SupplierCountries = $this->SupplierCountry->findById($TravelCountrySuppliers['TravelCountrySupplier']['country_supplier_id']);

            $TravelCountries = $this->TravelCountry->findById($TravelCountrySuppliers['TravelCountrySupplier']['country_id']);

            $type = $this->TravelActionItemType->find('list', array('fields' => array('id', 'value'), 'conditions' => 'id = 2 OR id = 3'));

            $this->set(compact('SupplierCountries', 'TravelCountries'));

        } elseif ($level_id == '3') { // mapping city

            $retrun_cond = array('type' => array('0', '5')); // 0=other 4=mapping

            $rejection_cond = array('type' => array('0', '4')); // 0=other 4=mapping

            $headding = 'Mapping City';

            $this->set('mapping_type', '2');

            $TravelCitySuppliers = $this->TravelCitySupplier->findById($travel_actionitems['TravelActionItem']['city_supplier_id']);

            $SupplierCities = $this->SupplierCity->findById($TravelCitySuppliers['TravelCitySupplier']['city_supplier_id']);

            $TravelCities = $this->TravelCity->findById($TravelCitySuppliers['TravelCitySupplier']['city_id']);

            $type = $this->TravelActionItemType->find('list', array('fields' => array('id', 'value'), 'conditions' => 'id = 2 OR id = 3 OR id = 5'));



            $is_update = $TravelCitySuppliers['TravelCitySupplier']['is_update'];

            if ($is_update == 'Y')

                $actiontype = 'Update';

            else

                $actiontype = 'AddNew';



            $city_name_arr = $this->TravelCity->findByCityCode($TravelCitySuppliers['TravelCitySupplier']['pf_city_code'], array('fields' => 'city_name'));

            $city_name = $city_name_arr['TravelCity']['city_name'];



            $condition = '';



            for ($indexOfFirstLetter = 0; $indexOfFirstLetter <= strlen($city_name); $indexOfFirstLetter++) {



                for ($indexOfLastLetter = $indexOfFirstLetter + 1; $indexOfLastLetter <= strlen($city_name); $indexOfLastLetter++) {

                    $new_arr[] = substr($city_name, $indexOfFirstLetter, 3);

                    //  echo $arr[$indexOfFirstLetter];



                    $condition .= "(city_name LIKE '%" . $new_arr[$indexOfFirstLetter] . "%')";

                    if ($indexOfFirstLetter < strlen($city_name) - 1)

                        $condition .= 'OR';

                    $indexOfFirstLetter++;

                }

            }

            $Mappinges = $this->TravelCitySupplier->find

                    (

                    'all', array

                (

                'conditions' => array

                    (

                    'TravelCitySupplier.city_id IN (SELECT id FROM travel_cities WHERE country_id = "' . $TravelCitySuppliers['TravelCitySupplier']['city_country_id'] . '")',

                    'TravelCitySupplier.city_country_id' => $TravelCitySuppliers['TravelCitySupplier']['city_country_id'], 'TravelCitySupplier.city_id' => $TravelCitySuppliers['TravelCitySupplier']['city_id'], 'TravelCitySupplier.id <>' . $travel_actionitems['TravelActionItem']['city_supplier_id']

                ),

                'order' => 'TravelCitySupplier.city_country_code ASC',

            ));



            $this->set(compact('TravelCitySuppliers', 'SupplierCities', 'TravelCities'));

            $this->set('Mappinges', $Mappinges);



            //$log = $this->TravelCitySupplier->getDataSource()->getLog(false, false);       

            //debug($log);

            //die;



            $TravelSuppliers = $this->TravelSupplier->find('all', array('fields' => 'supplier_code, supplier_name', 'conditions' => array('active' => 'TRUE'), 'order' => 'supplier_name ASC'));

            $TravelSuppliers = Set::combine($TravelSuppliers, '{n}.TravelSupplier.supplier_code', array('%s - %s', '{n}.TravelSupplier.supplier_code', '{n}.TravelSupplier.supplier_name'));

            $this->set(compact('TravelSuppliers'));



            $TravelCountries = $this->TravelCountry->find('all', array('fields' => 'country_code, country_name', 'conditions' => array('country_code' => $TravelCitySuppliers['TravelCitySupplier']['city_country_code']), 'order' => 'country_name ASC'));

            $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));



            $this->set(compact('TravelCountries'));







            $TravelCities = $this->TravelCity->find('all', array('fields' => 'city_code, city_name', 'conditions' => array('city_code' => $TravelCitySuppliers['TravelCitySupplier']['pf_city_code']), 'order' => 'city_name ASC'));

            $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));



            $Provinces = $this->Province->find('list', array(

                'conditions' => array(

                    'Province.country_id' => $TravelCitySuppliers['TravelCitySupplier']['city_country_id'],

                    'Province.continent_id' => $TravelCitySuppliers['TravelCitySupplier']['city_continent_id'],

                    'Province.status' => '1',

                    'Province.wtb_status' => '1',

                    'Province.active' => 'TRUE'

                ),

                'fields' => array('Province.id', 'Province.name'),

                'order' => 'Province.name ASC'

            ));



            $this->set(compact('TravelCities', 'Provinces'));



            // $this->request->data = $TravelCitySuppliers;

            //  pr($TravelSuppliers);

        }

       

        elseif ($level_id == '4') { // mapping hotel

            $retrun_cond = array('type' => array('0', '6')); // 0=other 4=mapping

            $rejection_cond = array('type' => array('0', '5')); // 0=other 4=mapping

            $headding = 'Mapping Hotel';

            $this->set('mapping_type', '3');

            

            if($action_type_id == '9')

                $type = $this->TravelActionItemType->find('list', array('fields' => array('id', 'value'), 'conditions' => 'id = 10 OR id = 5'));

            else

            $type = $this->TravelActionItemType->find('list', array('fields' => array('id', 'value'), 'conditions' => 'id = 2 OR id = 9'));

            $condition = '';

            $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->findById($travel_actionitems['TravelActionItem']['hotel_supplier_id']);

            $SupplierHotels = $this->SupplierHotel->findById($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_supplier_id']);

            $TravelHotelLookups = $this->TravelHotelLookup->findById($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_id']);

            if ($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_supplier_id']) {



                $hotel_name = $SupplierHotels['SupplierHotel']['hotel_name'];

                $country_name = $SupplierHotels['SupplierHotel']['country_name'];

                $city_name = $SupplierHotels['SupplierHotel']['city_name'];

                $search_condition = array();

                $condition = array();



                for ($indexOfFirstLetter = 0; $indexOfFirstLetter <= strlen($hotel_name); $indexOfFirstLetter++) {

                    for ($indexOfLastLetter = $indexOfFirstLetter + 1; $indexOfLastLetter <= strlen($hotel_name); $indexOfLastLetter++) {

                        $new_arr[] = substr($hotel_name, $indexOfFirstLetter, 4);

                        //pr($new_arr);

                        //array_push($search_condition, ARRAY('OR'));

                        if (strlen($new_arr[$indexOfFirstLetter]) == '4') {

                            array_push($condition, array("TravelHotelLookup.hotel_name LIKE '%$new_arr[$indexOfFirstLetter]%'"));

                        }



                        $indexOfFirstLetter++;

                    }

                }



                //pr($condition);

                //die;

                array_push($search_condition, array('OR' => $condition, 'TravelHotelLookup.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'], 'TravelHotelLookup.city_id' => $TravelHotelLookups['TravelHotelLookup']['city_id'], 'TravelHotelLookup.id != ' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_id']));

                $DuplicateHotels = $this->TravelHotelLookup->find('all', array('conditions' => $search_condition));
//                $DuplicateHotels = $this->TravelHotelLookup->find('all', array('conditions' => $search_condition,'limit'=>10));                

                //$this-TravelHotelLookup->find('all',array('conditions' => $search_condition));

                //$this->paginate['order'] = array('TravelHotelLookup.hotel_name' => 'asc');

                //$this->set('DuplicateHotels', $this->paginate("TravelHotelLookup", $search_condition));

                $this->set(compact('DuplicateHotels'));

                //$log = $this->TravelHotelLookup->getDataSource()->getLog(false, false);       

                //debug($log);

                //die;

            }

            $hotel_code = $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_code'];

            $hotel_name_arr = $this->TravelHotelLookup->findByHotelCode($hotel_code, array('fields' => 'hotel_name'));

            $hotel_name = $hotel_name_arr['TravelHotelLookup']['hotel_name'];

            $is_update = $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['is_update'];

            if ($is_update == 'Y')

                $actiontype = 'Update';

            else

                $actiontype = 'AddNew';



            /*

              for ($indexOfFirstLetter = 0; $indexOfFirstLetter <= strlen($hotel_name); $indexOfFirstLetter++) {

              for ($indexOfLastLetter = $indexOfFirstLetter + 1; $indexOfLastLetter <= strlen($hotel_name); $indexOfLastLetter++) {

              $hotel_arr[] = substr($hotel_name, $indexOfFirstLetter, 3);

              $condition .= "(hotel_name LIKE '%" . $hotel_arr[$indexOfFirstLetter] . "%')";

              if ($indexOfFirstLetter < strlen($hotel_name) - 1)

              $condition .= 'OR';

              $indexOfFirstLetter++;

              }

              }

             * 

             */





            $Mappinges = $this->TravelHotelRoomSupplier->find

                    (

                    'all', array

                (

                'conditions' => array

                    (

                    //'TravelHotelRoomSupplier.hotel_id IN (SELECT id FROM travel_hotel_lookups WHERE country_id = "' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_country_id'] . '" AND city_id = "' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_city_id'] . '")',

                    'TravelHotelRoomSupplier.hotel_city_id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_city_id'],

                    'TravelHotelRoomSupplier.supplier_id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['supplier_id'],

                    'TravelHotelRoomSupplier.hotel_id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_id'],

                    'TravelHotelRoomSupplier.hotel_country_id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_country_id'], 'TravelHotelRoomSupplier.id <> ' . $travel_actionitems['TravelActionItem']['hotel_supplier_id']

                ),

                'order' => 'TravelHotelRoomSupplier.hotel_city_code ASC',

                    )

            );



            //$log = $this->TravelHotelRoomSupplier->getDataSource()->getLog(false, false);       

            //debug($log);

            //die;

            $this->set('Mappinges', $Mappinges);



            $TravelSuppliers = $this->TravelSupplier->find('all', array('fields' => 'supplier_code, supplier_name', 'conditions' => array('active' => 'TRUE'), 'order' => 'supplier_name ASC'));

            $TravelSuppliers = Set::combine($TravelSuppliers, '{n}.TravelSupplier.supplier_code', array('%s - %s', '{n}.TravelSupplier.supplier_code', '{n}.TravelSupplier.supplier_name'));

            $this->set(compact('TravelSuppliers', 'SupplierHotels'));



            $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE', 'id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_continent_id']), 'order' => 'continent_name ASC'));
            
            $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id, country_name', 'conditions' => array('id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_country_id']), 'order' => 'country_name ASC'));

//            $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.country_code', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));

            $this->set(compact('TravelCountries', 'TravelLookupContinents'));



            $TravelCities = $this->TravelCity->find('list', array('fields' => 'id, city_name', 'conditions' => array('id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_city_id']), 'order' => 'city_name ASC'));

//            $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));

            $this->set(compact('TravelCities'));



            $TravelHotelLookups = $this->TravelHotelLookup->find('all', array('fields' => 'hotel_code, hotel_name', 'conditions' => array('hotel_code' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_code']), 'order' => 'hotel_name ASC'));

            $TravelHotelLookups = Set::combine($TravelHotelLookups, '{n}.TravelHotelLookup.hotel_code', array('%s - %s', '{n}.TravelHotelLookup.hotel_code', '{n}.TravelHotelLookup.hotel_name'));

            $this->set(compact('TravelHotelLookups'));



            $TravelAreas = $this->TravelArea->find('list', array(

                'conditions' => array(

                    'TravelArea.id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_area_id'],

                ),

                'fields' => 'TravelArea.id, TravelArea.area_name',

                'order' => 'TravelArea.area_name ASC'

            ));





            $TravelSuburbs = $this->TravelSuburb->find('list', array(

                'conditions' => array(

                    'TravelSuburb.id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_suburb_id'],

                ),

                'fields' => 'TravelSuburb.id, TravelSuburb.name',

                'order' => 'TravelSuburb.name ASC'

            ));



            $TravelChains = $this->TravelChain->find('list', array(

                'conditions' => array(

                    'TravelChain.id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_chain_id'],

                ),

                'fields' => 'TravelChain.id, TravelChain.chain_name',

                'order' => 'TravelChain.chain_name ASC'

            ));



            $TravelBrands = $this->TravelBrand->find('list', array(

                'conditions' => array(

                    'TravelBrand.id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_brand_id'],

                ),

                'fields' => 'TravelBrand.id, TravelBrand.brand_name',

                'order' => 'TravelBrand.brand_name ASC'

            ));



            $HotelUrl = $this->TravelHotelLookup->find('first', array('conditions' => array('hotel_code' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_code']), 'fields' => array('url_hotel', 'address', 'id', 'hotel_code')));

            $Provinces = $this->Province->find('list', array(

                'conditions' => array(

                    'Province.country_id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_country_id'],

                    'Province.continent_id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_continent_id'],

                    'Province.status' => '1',

                    'Province.wtb_status' => '1',

                    'Province.active' => 'TRUE'

                ),

                'fields' => array('Province.id', 'Province.name'),

                'order' => 'Province.name ASC'

            ));

            $this->set(compact('TravelHotelRoomSuppliers', 'SupplierHotels', 'TravelHotelLookups', 'TravelCountries', 'TravelSuppliers', 'TravelAreas', 'TravelSuburbs', 'TravelChains', 'TravelBrands', 'HotelUrl', 'Provinces'));

            // $this->request->data = $TravelHotelRoomSuppliers;

        }

        

        



        if ($this->request->is('post') || $this->request->is('put')) {





            /*             * ************This data is common features **************************************** */

            $flag = 0;

            $success = 0;

            $xml_msg = '';

            $this->request->data['TravelActionItem']['parent_action_item_id'] = $actio_itme_id;

            $this->request->data['TravelActionItem']['dummy_status'] = $dummy_status;

            $this->request->data['TravelActionItem']['action_item_created'] = date('Y-m-d');

            $this->request->data['TravelActionItem']['created_by_id'] = $travel_actionitems['TravelActionItem']['created_by_id'];

            $this->request->data['TravelActionItem']['level_id'] = $travel_actionitems['TravelActionItem']['level_id'];



            $this->request->data['TravelActionItem']['action_item_active'] = 'Yes';

            $this->request->data['TravelActionItem']['created_by'] = $user_id;

            $this->request->data['TravelActionItem']['action_item_source'] = $role_id;



            $this->request->data['TravelRemark']['remarks_time'] = date('g:i A');

            $this->request->data['TravelRemark']['created_by'] = $user_id;

            $this->request->data['TravelRemark']['agent_id'] = $travel_actionitems['TravelActionItem']['agent_id'];

            $this->request->data['TravelRemark']['remarks_date'] = date('Y-m-d');

            $this->request->data['TravelRemark']['dummy_status'] = $dummy_status;

            $this->request->data['TravelRemark']['remarks_level'] = $travel_actionitems['TravelActionItem']['level_id'];



            $type_id = $this->data['TravelActionItem']['type_id'];





            if ($type_id == '2' && $level_id == '2') { // Approval in mapping country

                $this->request->data['TravelActionItem']['country_supplier_id'] = $travel_actionitems['TravelActionItem']['country_supplier_id'];

                $agents['TravelCountrySupplier']['country_suppliner_status'] = '2';  // 2 for approve of travel_action_item_types

                $agents['TravelCountrySupplier']['active'] = 'TRUE'; // for approve of travel_action_item_types

                $agents['TravelCountrySupplier']['approved_by'] = "'" . $user_id . "'";

                $agents['TravelCountrySupplier']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";



                $mapping['Mappinge']['status'] = '2';  // 2 for approve of travel_action_item_types

                if ($TravelCountrySuppliers['TravelCountrySupplier']['country_supplier_id'])

                    $this->SupplierCountry->updateAll(array('SupplierCountry.status' => "'3'"), array('SupplierCountry.id' => $TravelCountrySuppliers['TravelCountrySupplier']['country_supplier_id']));

                $this->request->data['TravelRemark']['country_supplier_id'] = $travel_actionitems['TravelActionItem']['country_supplier_id'];

                $this->request->data['TravelRemark']['remarks'] = 'Approve Mapping Country';

                $this->request->data['TravelActionItem']['description'] = 'Approve Mapping Country';

                $this->request->data['TravelActionItem']['next_action_by'] = '';







                $flag = '22';

            } elseif ($type_id == '2' && $level_id == '3') { // Approval in mapping city

                $this->request->data['TravelActionItem']['city_supplier_id'] = $travel_actionitems['TravelActionItem']['city_supplier_id'];

                $agents['TravelCitySupplier']['city_supplier_status'] = '2';  // 2 for approve of travel_action_item_types

                $agents['TravelCitySupplier']['active'] = 'TRUE'; // for approve of travel_action_item_types

                $agents['TravelCitySupplier']['approved_by'] = "'" . $user_id . "'";

                $agents['TravelCitySupplier']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";

                $mapping['Mappinge']['status'] = '2';  // 2 for approve of travel_action_item_types

                if ($TravelCitySuppliers['TravelCitySupplier']['city_supplier_id'])

                    $this->SupplierCity->updateAll(array('SupplierCity.status' => "'3'"), array('SupplierCity.id' => $TravelCitySuppliers['TravelCitySupplier']['city_supplier_id']));

                $this->request->data['TravelRemark']['city_supplier_id'] = $travel_actionitems['TravelActionItem']['city_supplier_id'];

                $this->request->data['TravelRemark']['remarks'] = 'Approve Mapping City';

                $this->request->data['TravelActionItem']['description'] = 'Approve Mapping City';

                $this->request->data['TravelActionItem']['next_action_by'] = '';

                $flag = '23';

            } elseif ($type_id == '2' && $level_id == '4') { // Approval in mapping hotel

                $this->request->data['TravelActionItem']['hotel_supplier_id'] = $travel_actionitems['TravelActionItem']['hotel_supplier_id'];

                $agents['TravelHotelRoomSupplier']['hotel_supplier_status'] = '2';  // 2 for approve of travel_action_item_types

                $agents['TravelHotelRoomSupplier']['active'] = 'TRUE'; // for approve of travel_action_item_types

                $agents['TravelHotelRoomSupplier']['approved_by'] = "'" . $user_id . "'";

                $agents['TravelHotelRoomSupplier']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";

                $mapping['Mappinge']['status'] = '2';  // 2 for approve of travel_action_item_types

                if ($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_supplier_id'])

                    $this->SupplierHotel->updateAll(array('SupplierHotel.status' => "'3'"), array('SupplierHotel.id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_supplier_id']));

                $this->request->data['TravelRemark']['hotel_supplier_id'] = $travel_actionitems['TravelActionItem']['hotel_supplier_id'];

                $this->request->data['TravelRemark']['remarks'] = 'Approve Mapping Hotel';

                $this->request->data['TravelActionItem']['description'] = 'Approve Mapping Hotel';

                $this->request->data['TravelActionItem']['next_action_by'] = '';

                $flag = '24';

            }



            if ($type_id == '3' && $level_id == '2') { // Return in mapping country

                $this->request->data['TravelActionItem']['country_supplier_id'] = $travel_actionitems['TravelActionItem']['country_supplier_id'];

                $agents['TravelCountrySupplier']['country_suppliner_status'] = '3';  // 2 for approve of travel_action_item_types

                $agents['TravelCountrySupplier']['active'] = 'FALSE'; // for FALSE of travel_action_item_types

                $agents['TravelCountrySupplier']['approved_by'] = "'" . $user_id . "'";

                $agents['TravelCountrySupplier']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";

                $mapping['Mappinge']['status'] = '3';  //3 for RETURN of travel_action_item_types



                $this->request->data['TravelRemark']['country_supplier_id'] = $travel_actionitems['TravelActionItem']['country_supplier_id'];

                $this->request->data['TravelRemark']['remarks'] = 'Return Mapping Country';

                $this->request->data['TravelActionItem']['description'] = 'Return Mapping Country';

                $this->request->data['TravelActionItem']['next_action_by'] = $travel_actionitems['TravelActionItem']['created_by_id'];

                $flag = '32';

            } elseif ($type_id == '3' && $level_id == '3') {// Return in mapping city

                $this->request->data['TravelActionItem']['city_supplier_id'] = $travel_actionitems['TravelActionItem']['city_supplier_id'];

                $agents['TravelCitySupplier']['city_supplier_status'] = '3';  // 2 for approve of travel_action_item_types

                $agents['TravelCitySupplier']['active'] = 'FALSE'; // for FALSE of travel_action_item_types

                $agents['TravelCitySupplier']['approved_by'] = "'" . $user_id . "'";

                $agents['TravelCitySupplier']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";

                $mapping['Mappinge']['status'] = '3';  //3 for RETURN of travel_action_item_types



                $this->request->data['TravelRemark']['city_supplier_id'] = $travel_actionitems['TravelActionItem']['city_supplier_id'];

                $this->request->data['TravelRemark']['remarks'] = 'Return Mapping City';

                $this->request->data['TravelActionItem']['description'] = 'Return Mapping City';

                $this->request->data['TravelActionItem']['next_action_by'] = $travel_actionitems['TravelActionItem']['created_by_id'];

                $flag = '33';

            } elseif ($type_id == '3' && $level_id == '4') {// Return in mapping hotel

                $this->request->data['TravelActionItem']['hotel_supplier_id'] = $travel_actionitems['TravelActionItem']['hotel_supplier_id'];

                $agents['TravelHotelRoomSupplier']['hotel_supplier_status'] = '3';  // 2 for approve of travel_action_item_types

                $agents['TravelHotelRoomSupplier']['active'] = 'FALSE'; // for FALSE of travel_action_item_types

                $agents['TravelHotelRoomSupplier']['approved_by'] = "'" . $user_id . "'";

                $agents['TravelHotelRoomSupplier']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";

                $mapping['Mappinge']['status'] = '3';  //3 for RETURN of travel_action_item_types



                $this->request->data['TravelRemark']['hotel_supplier_id'] = $travel_actionitems['TravelActionItem']['hotel_supplier_id'];

                $this->request->data['TravelRemark']['remarks'] = 'Return Mapping Hotel';

                $this->request->data['TravelActionItem']['description'] = 'Return Mapping Hotel';

                $this->request->data['TravelActionItem']['next_action_by'] = $travel_actionitems['TravelActionItem']['created_by_id'];

                $flag = '34';

            } elseif ($type_id == '5' && $level_id == '3') {// Rejection in mapping city

                $this->request->data['TravelActionItem']['city_supplier_id'] = $travel_actionitems['TravelActionItem']['city_supplier_id'];





                $mapping['Mappinge']['status'] = '5';  //3 for RETURN of travel_action_item_types



                /* Email Logic */

                $to = array('administrator@silkrouters.com', 'data@silkrouters.com');

                // $to = array('biswa.mee@gmail.com', 'biswajit.das801@gmail.com');

                $cc = 'infra@sumanus.com';

                //$cc = 'biswajit@wtbglobal.com';

                $Email = new CakeEmail();

                $subject = strtoupper('MAPPING | ' . $TravelCitySuppliers['TravelCitySupplier']['city_mapping_name'] . ' | REJECTED BY - ' . $this->User->Username($user_id));

                $Email->viewVars(array(

                    'MappingName' => strtoupper($TravelCitySuppliers['TravelCitySupplier']['city_mapping_name']),

                    'Supplier' => strtoupper($TravelCitySuppliers['TravelCitySupplier']['supplier_code']),

                    'Country' => strtoupper($TravelCitySuppliers['TravelCitySupplier']['city_country_code']),

                    'City' => strtoupper($TravelCitySuppliers['TravelCitySupplier']['pf_city_code']),

                    'CreatedBy' => $TravelCitySuppliers['TravelCitySupplier']['created_by'],

                    'Description' => strtoupper($this->data['TravelActionItem']['other_rejection']),

                ));

                $Email->template('DuplicateMappinges/template', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject($subject)->send();



                /* End Emial */



                $this->TravelCitySupplier->delete($travel_actionitems['TravelActionItem']['city_supplier_id']);

                $this->Mappinge->deleteAll(array('Mappinge.city_supplier_id' => $travel_actionitems['TravelActionItem']['city_supplier_id']));



                $flag = '534';

            } elseif ($type_id == '5' && $level_id == '4') {// Rejection in mapping hotel

                $supplier_hotel_id = $this->data['SupplierHotel']['supplier_hotel_id'];

                $mapping['Mappinge']['status'] = '5';  //3 for RETURN of travel_action_item_types



                /* Email Logic */

                $to = array('administrator@silkrouters.com', 'data@silkrouters.com');

                // $to = array('biswa.mee@gmail.com', 'biswajit.das801@gmail.com');

                $cc = 'infra@sumanus.com';

                // $cc = 'biswajit@wtbglobal.com';

                $Email = new CakeEmail();

                $subject = strtoupper('MAPPING | ' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_mapping_name'] . ' | REJECTED BY - ' . $this->User->Username($user_id));

                $Email->viewVars(array(

                    'MappingName' => strtoupper($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_mapping_name']),

                    'Supplier' => strtoupper($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['supplier_code']),

                    'Country' => strtoupper($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_country_code']),

                    'City' => strtoupper($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_city_code']),

                    'Hotel' => strtoupper($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_code']),

                    'CreatedBy' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['created_by'],

                    'Description' => strtoupper($this->data['TravelActionItem']['other_rejection']),

                ));

                $Email->template('DuplicateMappinges/hotel', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject($subject)->send();



                /* End Emial */





                $this->TravelHotelLookup->updateAll(array('TravelHotelLookup.active' => "'FALSE'", 'TravelHotelLookup.status' => '5'), array('TravelHotelLookup.id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_id']));

                $this->TravelHotelRoomSupplier->delete($travel_actionitems['TravelActionItem']['hotel_supplier_id']);

                $this->Mappinge->deleteAll(array('Mappinge.hotel_supplier_id' => $travel_actionitems['TravelActionItem']['hotel_supplier_id']));

                $flag = '534';

                if ($supplier_hotel_id)

                        $this->SupplierHotel->updateAll(array('SupplierHotel.status' => "'8'"), array('SupplierHotel.id' => $supplier_hotel_id));

                /**

                 * Hotel rejection xml fire - active = false

                 */

                $TravelHotelLookups = $this->TravelHotelLookup->findById($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_id']);



                $HotelId = $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_id'];

                $HotelCode = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];

                $HotelName = $TravelHotelLookups['TravelHotelLookup']['hotel_name'];

                $AreaId = $TravelHotelLookups['TravelHotelLookup']['area_id'];

                $AreaName = $TravelHotelLookups['TravelHotelLookup']['area_name'];

                $AreaCode = $TravelHotelLookups['TravelHotelLookup']['area_code'];

                $SuburbId = $TravelHotelLookups['TravelHotelLookup']['suburb_id'];

                $SuburbName = $TravelHotelLookups['TravelHotelLookup']['suburb_name'];

                $CityId = $TravelHotelLookups['TravelHotelLookup']['city_id'];

                $CityName = $TravelHotelLookups['TravelHotelLookup']['city_name'];

                $CityCode = $TravelHotelLookups['TravelHotelLookup']['city_code'];

                $CountryId = $TravelHotelLookups['TravelHotelLookup']['country_id'];

                $CountryName = $TravelHotelLookups['TravelHotelLookup']['country_name'];

                $CountryCode = $TravelHotelLookups['TravelHotelLookup']['country_code'];

                $ContinentId = $TravelHotelLookups['TravelHotelLookup']['continent_id'];

                $ContinentName = $TravelHotelLookups['TravelHotelLookup']['continent_name'];

                $ContinentCode = $TravelHotelLookups['TravelHotelLookup']['continent_code'];

                $BrandId = $TravelHotelLookups['TravelHotelLookup']['brand_id'];

                $BrandName = $TravelHotelLookups['TravelHotelLookup']['brand_name'];

                $ChainId = $TravelHotelLookups['TravelHotelLookup']['chain_id'];

                $ChainName = $TravelHotelLookups['TravelHotelLookup']['chain_name'];

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

            $IsImageLocal = $TravelHotelLookups['TravelHotelLookup']['is_image'];
            $IsPageLocal = $TravelHotelLookups['TravelHotelLookup']['is_page'];   
            
            if ($IsImageLocal == 'Y')
                $IsImage = 'TRUE';
            else
                $IsImage = 'FALSE';            
            
            if ($IsPageLocal == 'Y')
                $IsPage = 'TRUE';
            else
                $IsPage = 'FALSE';  

            $FormerName = $TravelHotelLookups['TravelHotelLookup']['hotel_former_name'];

            $DisplayName = $TravelHotelLookups['TravelHotelLookup']['hotel_display_name'];

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

                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $xml_error = 'FALSE';

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

                                                                <AreaCode><![CDATA[' . $AreaCode . ']]></AreaCode>

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

                                                                <Keyword>' . $Keyword . '</Keyword>

                                                                <StandardRating>' . $StandardRating . '</StandardRating>

                                                                <HotelRating>' . $HotelRating . '</HotelRating>

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

                                                                <HotelFormerName><![CDATA[' . $FormerName . ']]></HotelFormerName>
                                                                    
                                                                <HotelDisplayName><![CDATA[' . $DisplayName . ']]></HotelDisplayName>

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





                $log_call_screen = 'Hotel - Rejected';



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

                        $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";

                        $this->TravelHotelLookup->updateAll(array('TravelHotelLookup.wtb_status' => "'1'", 'TravelHotelLookup.is_updated' => "'Y'"), array('TravelHotelLookup.id' => $HotelId));

                    } else {



                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];

                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID

                        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";

                        $this->TravelHotelLookup->updateAll(array('TravelHotelLookup.wtb_status' => "'2'"), array('TravelHotelLookup.id' => $HotelId));

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

                $LogId = $this->LogCall->getLastInsertId();

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

            } elseif ($type_id == '9') { //Submit For Review for Hotel Mapping

                //pr($this->data);

                //die;

                if (isset($this->data['TravelHotelLookup']['hotel_id'])) {

                    $supplier_hotel_id = $this->data['SupplierHotel']['supplier_hotel_id'];

                    $hotel_room_supplier_id = $this->data['TravelHotelRoomSupplier']['hotel_room_supplier_id'];

                    $hotel_id = $this->data['TravelHotelLookup']['hotel_id'];

                    $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->findById($hotel_room_supplier_id);

                    $SupplierHotels = $this->SupplierHotel->findById($supplier_hotel_id);

                    $TravelHotelLookups = $this->TravelHotelLookup->findById($hotel_id);



                    //$next_action_by = '169';  //overseer 136 44 is sarika 152 - ojas

                    $flag = 0;

                    $search_condition = array();

                    $condition = '';

                    $success = '';



                    $this->request->data['Mappinge']['supplier_code'] = "'" . $SupplierHotels['SupplierHotel']['supplier_code'] . "'";

                    $this->request->data['Mappinge']['mapping_type'] = '3'; // supplier hotel

                    $this->request->data['Mappinge']['hotel_wtb_code'] = "'" . $TravelHotelLookups['TravelHotelLookup']['hotel_code'] . "'";

                    $this->request->data['Mappinge']['hotel_supplier_code'] = "'" . $SupplierHotels['SupplierHotel']['hotel_code'] . "'";

                    $this->request->data['Mappinge']['city_wtb_code'] = "'" . $TravelHotelLookups['TravelHotelLookup']['city_code'] . "'";

                    $this->request->data['Mappinge']['country_wtb_code'] = "'" . $TravelHotelLookups['TravelHotelLookup']['country_code'] . "'";



                    $this->request->data['TravelHotelRoomSupplier']['hotel_supplier_status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types

                    $this->request->data['TravelHotelRoomSupplier']['active'] = 'FALSE'; // 2 for No of lookup_value_statuses

                    $this->request->data['TravelHotelRoomSupplier']['excluded'] = 'FALSE'; // 2 for No of lookup_value_statuses

                    $this->request->data['TravelHotelRoomSupplier']['wtb_status'] = '1'; // 1 = true

                    $this->request->data['TravelHotelRoomSupplier']['hotel_code'] = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];

                    $this->request->data['TravelHotelRoomSupplier']['supplier_code'] = $SupplierHotels['SupplierHotel']['supplier_code'];

                    $this->request->data['TravelHotelRoomSupplier']['supplier_id'] = $SupplierHotels['SupplierHotel']['supplier_id'];

                    //$hotel_name_arr = $this->TravelHotelLookup->findByHotelCode($this->data['Mapping']['hotel_code'], array('fields' => 'hotel_name', 'id'));

                    $this->request->data['TravelHotelRoomSupplier']['hotel_mapping_name'] = strtoupper('[SUPP/HOTEL] | ' . $SupplierHotels['SupplierHotel']['supplier_code'] . ' | ' . $TravelHotelLookups['TravelHotelLookup']['country_code'] . ' | ' . $TravelHotelLookups['TravelHotelLookup']['city_code'] . ' | ' . $TravelHotelLookups['TravelHotelLookup']['hotel_code'] . ' - ' . $TravelHotelLookups['TravelHotelLookup']['hotel_name']);

                    $this->request->data['TravelHotelRoomSupplier']['hotel_name'] = $TravelHotelLookups['TravelHotelLookup']['hotel_name'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_id'] = $TravelHotelLookups['TravelHotelLookup']['id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_country_code'] = $TravelHotelLookups['TravelHotelLookup']['country_code'];

                    $this->request->data['TravelHotelRoomSupplier']['supplier_item_code1'] = $SupplierHotels['SupplierHotel']['hotel_code'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_country_code'] = $TravelHotelLookups['TravelHotelLookup']['country_code'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_city_code'] = $TravelHotelLookups['TravelHotelLookup']['city_code'];

                    //$TravelAreas = $this->TravelArea->find('first', array('fields' => array('area_name'), 'conditions' => array('id' => $this->data['Mapping']['hotel_area_id'])));

                    $this->request->data['TravelHotelRoomSupplier']['hotel_area_id'] = $TravelHotelLookups['TravelHotelLookup']['area_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_area_name'] = $TravelHotelLookups['TravelHotelLookup']['area_name'];

                    //$TravelBrands = $this->TravelBrand->find('first', array('fields' => array('TravelBrand.brand_name'), 'conditions' => array('TravelBrand.id' => $this->data['Mapping']['hotel_brand_id'])));

                    $this->request->data['TravelHotelRoomSupplier']['hotel_brand_id'] = $TravelHotelLookups['TravelHotelLookup']['brand_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_brand_name'] = $TravelHotelLookups['TravelHotelLookup']['brand_name'];

                    //$TravelSuburbs = $this->TravelSuburb->find('first', array('fields' => array('TravelSuburb.name'), 'conditions' => array('TravelSuburb.id' => $this->data['Mapping']['hotel_suburb_id'])));

                    $this->request->data['TravelHotelRoomSupplier']['hotel_suburb_id'] = $TravelHotelLookups['TravelHotelLookup']['suburb_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_suburb_name'] = $TravelHotelLookups['TravelHotelLookup']['suburb_name'];

                    //$TravelChains = $this->TravelChain->find('first', array('fields' => array('TravelChain.chain_name'), 'conditions' => array('TravelChain.id' => $this->data['Mapping']['hotel_chain_id'])));        

                    $this->request->data['TravelHotelRoomSupplier']['hotel_chain_id'] = $TravelHotelLookups['TravelHotelLookup']['chain_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_chain_name'] = $TravelHotelLookups['TravelHotelLookup']['chain_name'];

                    $this->request->data['TravelHotelRoomSupplier']['created_by'] = $user_id;

                    $this->request->data['TravelHotelRoomSupplier']['province_id'] = $TravelHotelLookups['TravelHotelLookup']['province_id'];

                    $this->request->data['TravelHotelRoomSupplier']['province_name'] = $TravelHotelLookups['TravelHotelLookup']['province_name'];



                    //$supp_country_code = $this->TravelCountrySupplier->find('first', array('fields' => array('supplier_country_code', 'country_id', 'country_name', 'country_continent_id', 'country_continent_name'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_country_code' => $this->data['Mapping']['hotel_country_code'])));

                    //$supp_country_code = $this->TravelCountrySupplier->find('first', array('fields' => array('supplier_country_code'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_country_code' => $this->data['Mapping']['hotel_country_code'])));

                    $this->request->data['TravelHotelRoomSupplier']['supplier_item_code4'] = $SupplierHotels['SupplierHotel']['country_code'];

                    $this->request->data['Mappinge']['country_supplier_code'] = "'" . $SupplierHotels['SupplierHotel']['country_code'] . "'";

                    $this->request->data['TravelHotelRoomSupplier']['hotel_country_id'] = $TravelHotelLookups['TravelHotelLookup']['country_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_country_name'] = $TravelHotelLookups['TravelHotelLookup']['country_name'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_continent_id'] = $TravelHotelLookups['TravelHotelLookup']['continent_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_continent_name'] = $TravelHotelLookups['TravelHotelLookup']['continent_name'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_supplier_id'] = $SupplierHotels['SupplierHotel']['id'];



                    //$supp_city_code = $this->TravelCitySupplier->find('first', array('fields' => array('supplier_city_code', 'city_id', 'city_name'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_city_code' => $this->data['Mapping']['hotel_city_code'], 'city_country_code' => $this->data['Mapping']['hotel_country_code'])));

                    $this->request->data['TravelHotelRoomSupplier']['supplier_item_code3'] = $SupplierHotels['SupplierHotel']['city_code'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_city_id'] = $TravelHotelLookups['TravelHotelLookup']['city_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_city_name'] = $TravelHotelLookups['TravelHotelLookup']['city_name'];

                    $this->request->data['Mappinge']['city_supplier_code'] = "'" . $SupplierHotels['SupplierHotel']['city_code'] . "'";



                    $tr_remarks['TravelRemark']['remarks_level'] = '4'; // for Mapping City from travel_action_remark_levels

                    $tr_remarks['TravelRemark']['remarks'] = "'New Supplier Hotel Record Created'";



                    $tr_action_item['TravelActionItem']['level_id'] = '4'; // for agent travel_action_remark_levels                 

                    $tr_action_item['TravelActionItem']['description'] = 'New Supplier Hotel Record Created - Submission For Approval';



                    /*

                      $permissionArray = $this->ProvincePermission->find('first',array('conditions' => array('continent_id' => $supp_country_code['TravelCountrySupplier']['country_continent_id'],'country_id' => $supp_country_code['TravelCountrySupplier']['country_id'],'province_id' => $this->data['Mapping']['hotel_province_id'],'user_id' => $user_id)));

                      if(isset($permissionArray['ProvincePermission']['approval_id']))

                      $next_action_by = $permissionArray['ProvincePermission']['approval_id'];

                      else

                     * 

                     */

                    $next_action_by = '169'; //overseer APC

                    $this->TravelHotelRoomSupplier->id = $hotel_room_supplier_id;

                    $this->TravelHotelRoomSupplier->save($this->request->data['TravelHotelRoomSupplier']);

                    //$this->TravelHotelLookup->updateAll(array('TravelHotelLookup.active' => "'FALSE'"), array('TravelHotelLookup.id' => $hotel_name_arr['TravelHotelLookup']['id']));

                    $hotel_supplier_id = $this->TravelHotelRoomSupplier->getLastInsertId();

                    if ($hotel_room_supplier_id) {

                        $this->request->data['Mappinge']['hotel_supplier_id'] = "'" . $hotel_room_supplier_id . "'";

                        $tr_remarks['TravelRemark']['hotel_supplier_id'] = "'" . $hotel_room_supplier_id . "'";

                        $tr_action_item['TravelActionItem']['hotel_supplier_id'] = $hotel_room_supplier_id;

                        $flag = 1;

                    }



                    $this->request->data['Mappinge']['created_by'] = "'" . $user_id . "'";

                    $this->request->data['Mappinge']['status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types

                    $this->request->data['Mappinge']['exclude'] = '2'; // 2 for No of lookup_value_statuses

                    $this->request->data['Mappinge']['dummy_status'] = "'" . $dummy_status . "'";

                    //$this->Mappinge->hotel_supplier_id = $hotel_room_supplier_id;

                    //$this->Mappinge->save($this->request->data['Mappinge']);

                    $this->Mappinge->updateAll($this->request->data['Mappinge'], array('Mappinge.hotel_supplier_id' => $hotel_room_supplier_id));

                    $tr_remarks['TravelRemark']['created_by'] = "'" . $user_id . "'";

                    $tr_remarks['TravelRemark']['remarks_time'] = "'" . date('g:i A') . "'";



                    $tr_remarks['TravelRemark']['dummy_status'] = "'" . $dummy_status . "'";

                    $this->TravelRemark->updateAll($tr_remarks['TravelRemark'], array('TravelRemark.hotel_supplier_id' => $hotel_room_supplier_id));

                    //$this->TravelRemark->save($tr_remarks);



                    /*

                     * ********************** Action *********************

                     */



                    $tr_action_item['TravelActionItem']['type_id'] = '9'; // 1 for Submission For Approval [None] of the travel_action_item_types

                    $tr_action_item['TravelActionItem']['action_item_active'] = 'Yes';

                    $tr_action_item['TravelActionItem']['action_item_source'] = $role_id;

                    $tr_action_item['TravelActionItem']['created_by_id'] = $user_id;

                    $tr_action_item['TravelActionItem']['created_by'] = $user_id;

                    $tr_action_item['TravelActionItem']['dummy_status'] = $dummy_status;

                    $tr_action_item['TravelActionItem']['next_action_by'] = $next_action_by;

                    $tr_action_item['TravelActionItem']['parent_action_item_id'] = $this->data['TravelActionItem']['parent_action_item_id'];

                    $this->TravelActionItem->save($tr_action_item);

                    $ActionId = $this->TravelActionItem->getLastInsertId();

                    $ActionUpdateArr['TravelActionItem']['parent_action_item_id'] = "'" . $ActionId . "'";

                    $this->TravelActionItem->updateAll($ActionUpdateArr['TravelActionItem'], array('TravelActionItem.id' => $ActionId));

                    $this->SupplierHotel->updateAll(array('SupplierHotel.status' => "'6'"), array('SupplierHotel.id' => $SupplierHotels['SupplierHotel']['id']));

                    $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');

                    //$log = $this->TravelHotelLookup->getDataSource()->getLog(false, false);

                    //debug($log);

                    //die;

                    $this->redirect(array('action' => 'index'));

                }

                else{

                    //echo 'Test';

                    //die;

                    $supplier_hotel_id = $this->data['SupplierHotel']['supplier_hotel_id'];

                    $hotel_room_supplier_id = $this->data['TravelHotelRoomSupplier']['hotel_room_supplier_id'];

                    $this->request->data['TravelActionItem']['hotel_supplier_id'] = $travel_actionitems['TravelActionItem']['hotel_supplier_id'];

                    $agents['TravelHotelRoomSupplier']['hotel_supplier_status'] = '3';  // 2 for approve of travel_action_item_types

                    $agents['TravelHotelRoomSupplier']['active'] = 'FALSE'; // for FALSE of travel_action_item_types

                    $agents['TravelHotelRoomSupplier']['approved_by'] = "'" . $user_id . "'";

                    $agents['TravelHotelRoomSupplier']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";

                    $mapping['Mappinge']['status'] = '4';  //3 for RETURN of travel_action_item_types

                    $this->SupplierHotel->updateAll(array('SupplierHotel.status' => "'6'"), array('SupplierHotel.id' => $supplier_hotel_id));

                    $this->request->data['TravelRemark']['hotel_supplier_id'] = $travel_actionitems['TravelActionItem']['hotel_supplier_id'];

                    $this->request->data['TravelRemark']['remarks'] = 'Submit Review For Mapping Hotel (R)';

                    $this->request->data['TravelActionItem']['description'] = 'Submit Review For Mapping Hotel(R)';

                    $this->request->data['TravelActionItem']['next_action_by'] = '169';

                    $flag = '34';

                    

                }

            }

            

            elseif ($type_id == '10') { // Mapping Approved

                $supplier_hotel_id = $this->data['SupplierHotel']['supplier_hotel_id'];

                $hotel_room_supplier_id = $this->data['TravelHotelRoomSupplier']['hotel_room_supplier_id'];

                if (isset($this->data['TravelHotelLookup']['hotel_id'])) {

                    

                    $hotel_id = $this->data['TravelHotelLookup']['hotel_id'];

                    $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->findById($hotel_room_supplier_id);

                    $SupplierHotels = $this->SupplierHotel->findById($supplier_hotel_id);

                    $TravelHotelLookups = $this->TravelHotelLookup->findById($hotel_id);



                    //$next_action_by = '169';  //overseer 136 44 is sarika 152 - ojas

                    $flag = 0;

                    $search_condition = array();

                    $condition = '';

                    $success = '';



                    $this->request->data['Mappinge']['supplier_code'] = "'" . $SupplierHotels['SupplierHotel']['supplier_code'] . "'";

                    $this->request->data['Mappinge']['mapping_type'] = '3'; // supplier hotel

                    $this->request->data['Mappinge']['hotel_wtb_code'] = "'" . $TravelHotelLookups['TravelHotelLookup']['hotel_code'] . "'";

                    $this->request->data['Mappinge']['hotel_supplier_code'] = "'" . $SupplierHotels['SupplierHotel']['hotel_code'] . "'";

                    $this->request->data['Mappinge']['city_wtb_code'] = "'" . $TravelHotelLookups['TravelHotelLookup']['city_code'] . "'";

                    $this->request->data['Mappinge']['country_wtb_code'] = "'" . $TravelHotelLookups['TravelHotelLookup']['country_code'] . "'";



                    $this->request->data['TravelHotelRoomSupplier']['hotel_supplier_status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types

                    $this->request->data['TravelHotelRoomSupplier']['active'] = 'FALSE'; // 2 for No of lookup_value_statuses

                    $this->request->data['TravelHotelRoomSupplier']['excluded'] = 'FALSE'; // 2 for No of lookup_value_statuses

                    $this->request->data['TravelHotelRoomSupplier']['wtb_status'] = '1'; // 1 = true

                    $this->request->data['TravelHotelRoomSupplier']['hotel_code'] = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];

                    $this->request->data['TravelHotelRoomSupplier']['supplier_code'] = $SupplierHotels['SupplierHotel']['supplier_code'];

                    $this->request->data['TravelHotelRoomSupplier']['supplier_id'] = $SupplierHotels['SupplierHotel']['supplier_id'];

                    //$hotel_name_arr = $this->TravelHotelLookup->findByHotelCode($this->data['Mapping']['hotel_code'], array('fields' => 'hotel_name', 'id'));

                    $this->request->data['TravelHotelRoomSupplier']['hotel_mapping_name'] = strtoupper('[SUPP/HOTEL] | ' . $SupplierHotels['SupplierHotel']['supplier_code'] . ' | ' . $TravelHotelLookups['TravelHotelLookup']['country_code'] . ' | ' . $TravelHotelLookups['TravelHotelLookup']['city_code'] . ' | ' . $TravelHotelLookups['TravelHotelLookup']['hotel_code'] . ' - ' . $TravelHotelLookups['TravelHotelLookup']['hotel_name']);

                    $this->request->data['TravelHotelRoomSupplier']['hotel_name'] = $TravelHotelLookups['TravelHotelLookup']['hotel_name'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_id'] = $TravelHotelLookups['TravelHotelLookup']['id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_country_code'] = $TravelHotelLookups['TravelHotelLookup']['country_code'];

                    $this->request->data['TravelHotelRoomSupplier']['supplier_item_code1'] = $SupplierHotels['SupplierHotel']['hotel_code'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_country_code'] = $TravelHotelLookups['TravelHotelLookup']['country_code'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_city_code'] = $TravelHotelLookups['TravelHotelLookup']['city_code'];

                    //$TravelAreas = $this->TravelArea->find('first', array('fields' => array('area_name'), 'conditions' => array('id' => $this->data['Mapping']['hotel_area_id'])));

                    $this->request->data['TravelHotelRoomSupplier']['hotel_area_id'] = $TravelHotelLookups['TravelHotelLookup']['area_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_area_name'] = $TravelHotelLookups['TravelHotelLookup']['area_name'];

                    //$TravelBrands = $this->TravelBrand->find('first', array('fields' => array('TravelBrand.brand_name'), 'conditions' => array('TravelBrand.id' => $this->data['Mapping']['hotel_brand_id'])));

                    $this->request->data['TravelHotelRoomSupplier']['hotel_brand_id'] = $TravelHotelLookups['TravelHotelLookup']['brand_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_brand_name'] = $TravelHotelLookups['TravelHotelLookup']['brand_name'];

                    //$TravelSuburbs = $this->TravelSuburb->find('first', array('fields' => array('TravelSuburb.name'), 'conditions' => array('TravelSuburb.id' => $this->data['Mapping']['hotel_suburb_id'])));

                    $this->request->data['TravelHotelRoomSupplier']['hotel_suburb_id'] = $TravelHotelLookups['TravelHotelLookup']['suburb_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_suburb_name'] = $TravelHotelLookups['TravelHotelLookup']['suburb_name'];

                    //$TravelChains = $this->TravelChain->find('first', array('fields' => array('TravelChain.chain_name'), 'conditions' => array('TravelChain.id' => $this->data['Mapping']['hotel_chain_id'])));        

                    $this->request->data['TravelHotelRoomSupplier']['hotel_chain_id'] = $TravelHotelLookups['TravelHotelLookup']['chain_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_chain_name'] = $TravelHotelLookups['TravelHotelLookup']['chain_name'];

                    $this->request->data['TravelHotelRoomSupplier']['created_by'] = $user_id;

                    $this->request->data['TravelHotelRoomSupplier']['province_id'] = $TravelHotelLookups['TravelHotelLookup']['province_id'];

                    $this->request->data['TravelHotelRoomSupplier']['province_name'] = $TravelHotelLookups['TravelHotelLookup']['province_name'];



                    //$supp_country_code = $this->TravelCountrySupplier->find('first', array('fields' => array('supplier_country_code', 'country_id', 'country_name', 'country_continent_id', 'country_continent_name'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_country_code' => $this->data['Mapping']['hotel_country_code'])));

                    //$supp_country_code = $this->TravelCountrySupplier->find('first', array('fields' => array('supplier_country_code'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_country_code' => $this->data['Mapping']['hotel_country_code'])));

                    $this->request->data['TravelHotelRoomSupplier']['supplier_item_code4'] = $SupplierHotels['SupplierHotel']['country_code'];

                    $this->request->data['Mappinge']['country_supplier_code'] = "'" . $SupplierHotels['SupplierHotel']['country_code'] . "'";

                    $this->request->data['TravelHotelRoomSupplier']['hotel_country_id'] = $TravelHotelLookups['TravelHotelLookup']['country_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_country_name'] = $TravelHotelLookups['TravelHotelLookup']['country_name'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_continent_id'] = $TravelHotelLookups['TravelHotelLookup']['continent_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_continent_name'] = $TravelHotelLookups['TravelHotelLookup']['continent_name'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_supplier_id'] = $SupplierHotels['SupplierHotel']['id'];



                    //$supp_city_code = $this->TravelCitySupplier->find('first', array('fields' => array('supplier_city_code', 'city_id', 'city_name'), 'conditions' => array('supplier_code' => $this->data['Mapping']['hotel_supplier_code'], 'pf_city_code' => $this->data['Mapping']['hotel_city_code'], 'city_country_code' => $this->data['Mapping']['hotel_country_code'])));

                    $this->request->data['TravelHotelRoomSupplier']['supplier_item_code3'] = $SupplierHotels['SupplierHotel']['city_code'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_city_id'] = $TravelHotelLookups['TravelHotelLookup']['city_id'];

                    $this->request->data['TravelHotelRoomSupplier']['hotel_city_name'] = $TravelHotelLookups['TravelHotelLookup']['city_name'];

                    $this->request->data['Mappinge']['city_supplier_code'] = "'" . $SupplierHotels['SupplierHotel']['city_code'] . "'";



                    $tr_remarks['TravelRemark']['remarks_level'] = '4'; // for Mapping City from travel_action_remark_levels

                    $tr_remarks['TravelRemark']['remarks'] = "'New Supplier Hotel Record Created'";



                    $tr_action_item['TravelActionItem']['level_id'] = '4'; // for agent travel_action_remark_levels                 

                    $tr_action_item['TravelActionItem']['description'] = 'New Supplier Hotel Record Created - Submission For Approval';



                   

                    $this->TravelHotelRoomSupplier->id = $hotel_room_supplier_id;

                    $this->TravelHotelRoomSupplier->save($this->request->data['TravelHotelRoomSupplier']);

                    //$this->TravelHotelLookup->updateAll(array('TravelHotelLookup.active' => "'FALSE'"), array('TravelHotelLookup.id' => $hotel_name_arr['TravelHotelLookup']['id']));

                    $hotel_supplier_id = $this->TravelHotelRoomSupplier->getLastInsertId();

                    if ($hotel_room_supplier_id) {

                        $this->request->data['Mappinge']['hotel_supplier_id'] = "'" . $hotel_room_supplier_id . "'";

                        $tr_remarks['TravelRemark']['hotel_supplier_id'] = "'" . $hotel_room_supplier_id . "'";

                        $tr_action_item['TravelActionItem']['hotel_supplier_id'] = $hotel_room_supplier_id;

                        $flag = 1;

                    }



                    $this->request->data['Mappinge']['created_by'] = "'" . $user_id . "'";

                    $this->request->data['Mappinge']['status'] = '1'; // 1 for Submission For Approval [None] of the travel_action_item_types

                    $this->request->data['Mappinge']['exclude'] = '2'; // 2 for No of lookup_value_statuses

                    $this->request->data['Mappinge']['dummy_status'] = "'" . $dummy_status . "'";

                    //$this->Mappinge->hotel_supplier_id = $hotel_room_supplier_id;

                    //$this->Mappinge->save($this->request->data['Mappinge']);

                    $this->Mappinge->updateAll($this->request->data['Mappinge'], array('Mappinge.hotel_supplier_id' => $hotel_room_supplier_id));

                    $tr_remarks['TravelRemark']['created_by'] = "'" . $user_id . "'";

                    $tr_remarks['TravelRemark']['remarks_time'] = "'" . date('g:i A') . "'";



                    $tr_remarks['TravelRemark']['dummy_status'] = "'" . $dummy_status . "'";

                    $this->TravelRemark->updateAll($tr_remarks['TravelRemark'], array('TravelRemark.hotel_supplier_id' => $hotel_room_supplier_id));

                    //$this->TravelRemark->save($tr_remarks);



                    /*

                     * ********************** Action *********************

                     */



                    $this->request->data['TravelActionItem']['hotel_supplier_id'] = $travel_actionitems['TravelActionItem']['hotel_supplier_id'];

                $agents['TravelHotelRoomSupplier']['hotel_supplier_status'] = '7';  // 2 for approve of travel_action_item_types

                $agents['TravelHotelRoomSupplier']['active'] = 'TRUE'; // for approve of travel_action_item_types

                $agents['TravelHotelRoomSupplier']['approved_by'] = "'" . $user_id . "'";

                $agents['TravelHotelRoomSupplier']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";

                $mapping['Mappinge']['status'] = '7';  // 2 for approve of travel_action_item_types

                if ($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_supplier_id'])

                    $this->SupplierHotel->updateAll(array('SupplierHotel.status' => "'7'"), array('SupplierHotel.id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_supplier_id']));

                $this->request->data['TravelRemark']['hotel_supplier_id'] = $travel_actionitems['TravelActionItem']['hotel_supplier_id'];

                $this->request->data['TravelRemark']['remarks'] = 'Approve Mapping Hotel';

                $this->request->data['TravelActionItem']['description'] = 'Approve Mapping Hotel';

                $this->request->data['TravelActionItem']['next_action_by'] = '';

                $flag = '24';

                }

                else{

                    //echo 'Test';

                    //die;

                   $this->request->data['TravelActionItem']['hotel_supplier_id'] = $travel_actionitems['TravelActionItem']['hotel_supplier_id'];

                    $agents['TravelHotelRoomSupplier']['hotel_supplier_status'] = '2';  // 2 for approve of travel_action_item_types

                    $agents['TravelHotelRoomSupplier']['active'] = 'TRUE'; // for approve of travel_action_item_types

                    $agents['TravelHotelRoomSupplier']['approved_by'] = "'" . $user_id . "'";

                    $agents['TravelHotelRoomSupplier']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";

                    $mapping['Mappinge']['status'] = '2';  // 2 for approve of travel_action_item_types

                    if ($supplier_hotel_id)

                        $this->SupplierHotel->updateAll(array('SupplierHotel.status' => "'7'"), array('SupplierHotel.id' => $supplier_hotel_id));

                    $this->request->data['TravelRemark']['hotel_supplier_id'] = $travel_actionitems['TravelActionItem']['hotel_supplier_id'];

                    $this->request->data['TravelRemark']['remarks'] = 'Approve Mapping Hotel';

                    $this->request->data['TravelActionItem']['description'] = 'Approve Mapping Hotel';

                    $this->request->data['TravelActionItem']['next_action_by'] = '';

                    $flag = '24';

                    

                }

            }





            $this->TravelActionItem->create();

            $mapping['Mappinge']['approved_by'] = "'" . $user_id . "'";

            $mapping['Mappinge']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";



            if ($flag == '22' || $flag == '32') { // country

                $table = 'TravelCountrySupplier';

                $table_id = $travel_actionitems['TravelActionItem']['country_supplier_id'];

                if ($this->TravelActionItem->save($this->data['TravelActionItem'])) {



                    $last_action_id = $this->TravelActionItem->getLastInsertId();

                    $this->TravelRemark->create();

                    $this->TravelRemark->save($this->data['TravelRemark']);

                    $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));

                    $this->Mappinge->updateAll($mapping['Mappinge'], array('Mappinge.country_supplier_id' => $travel_actionitems['TravelActionItem']['country_supplier_id']));

                    $this->TravelCountrySupplier->updateAll($agents['TravelCountrySupplier'], array('TravelCountrySupplier.id' => $travel_actionitems['TravelActionItem']['country_supplier_id']));

                    $success = 1;

                }

            }

            if ($flag == '22') { // country

                /*                 * *******************XML Logic********************************** */

                $TravelCountrySuppliers = $this->TravelCountrySupplier->findById($travel_actionitems['TravelActionItem']['country_supplier_id']);

                $is_update = $TravelCountrySuppliers['TravelCountrySupplier']['is_update'];

                if ($is_update == 'Y')

                    $actiontype = 'Update';

                else

                    $actiontype = 'AddNew';



                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $date = explode(' ', $TravelCountrySuppliers['TravelCountrySupplier']['created']);

                $created = $date[0] . 'T' . $date[1];



                $WtbStatus = $TravelCountrySuppliers['TravelCountrySupplier']['wtb_status'];

                if ($WtbStatus)

                    $WtbStatus = 'true';

                else

                    $WtbStatus = 'false';





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

                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">

                                                                <Id>' . $TravelCountrySuppliers['TravelCountrySupplier']['id'] . '</Id>

                                                                <CountryCode><![CDATA[' . $TravelCountrySuppliers['TravelCountrySupplier']['pf_country_code'] . ']]></CountryCode>

                                                                <CountryName><![CDATA[' . $TravelCountrySuppliers['TravelCountrySupplier']['country_name'] . ']]></CountryName>

                                                                <SupplierCode><![CDATA[' . $TravelCountrySuppliers['TravelCountrySupplier']['supplier_code'] . ']]></SupplierCode>

                                                                <SupplierCountryCode><![CDATA[' . $TravelCountrySuppliers['TravelCountrySupplier']['supplier_country_code'] . ']]></SupplierCountryCode>

                                                                <CountryId>' . $TravelCountrySuppliers['TravelCountrySupplier']['country_id'] . '</CountryId>

                                                                <CountryContinentId>' . $TravelCountrySuppliers['TravelCountrySupplier']['country_continent_id'] . '</CountryContinentId>

                                                                <CountryContinentName><![CDATA[' . $TravelCountrySuppliers['TravelCountrySupplier']['country_continent_name'] . ']]></CountryContinentName>

                                                                <CountryMappingName><![CDATA[' . $TravelCountrySuppliers['TravelCountrySupplier']['country_mapping_name'] . ']]></CountryMappingName>

                                                                <BuyingCurrency>NA</BuyingCurrency>

                                                                <ApplyBuyingCurrency>NA</ApplyBuyingCurrency>

                                                                <CountrySupplierStatus>' . $TravelCountrySuppliers['TravelCountrySupplier']['country_suppliner_status'] . '</CountrySupplierStatus>

                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>

                                                                <Active>' . strtolower($TravelCountrySuppliers['TravelCountrySupplier']['active']) . '</Active>

                                                                <Excluded>' . strtolower($TravelCountrySuppliers['TravelCountrySupplier']['excluded']) . '</Excluded>                             

                                                                <ApprovedBy>' . $user_id . '</ApprovedBy>

                                                                <ApprovedDate>' . $CreatedDate . '</ApprovedDate>

                                                                <CreatedBy>' . $TravelCountrySuppliers['TravelCountrySupplier']['created_by'] . '</CreatedBy>

                                                                <CreatedDate>' . $created . '</CreatedDate> 

                                                            </ResourceDetailsData>              

                                                    </ResourceData>

                                                    </RequestParameters>

                                                </ResourceDataRequest>

                                            </RequestInfo>

                                        </ProcessXML>

                                    </soap:Body>';



                $log_call_screen = 'Approval - Supplier Country Mapping';

                $RESOURCEDATA = 'RESOURCEDATA_COUNTRYMAPPING';

                $error_topic = '29';

                $error_entity =  $TravelCountrySuppliers['TravelCountrySupplier']['id'];

                $error_type = '12';

                /*                 * *******************End XML************************************** */

            } elseif ($flag == '23' || $flag == '33') { // city mapping & city return

                $table = 'TravelCitySupplier';

                $table_id = $travel_actionitems['TravelActionItem']['city_supplier_id'];

                if ($this->TravelActionItem->save($this->data['TravelActionItem'])) {

                    $last_action_id = $this->TravelActionItem->getLastInsertId();

                    $this->TravelRemark->save($this->data['TravelRemark']);

                    $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));

                    $this->TravelCitySupplier->updateAll($agents['TravelCitySupplier'], array('TravelCitySupplier.id' => $travel_actionitems['TravelActionItem']['city_supplier_id']));

                    $this->Mappinge->updateAll($mapping['Mappinge'], array('Mappinge.city_supplier_id' => $travel_actionitems['TravelActionItem']['city_supplier_id']));



                    $success = 1;

                }

            }

            if ($flag == '23') { // city mapping



                /*                 * *******************XML Logic********************************** */

                $TravelCitySuppliers = $this->TravelCitySupplier->findById($travel_actionitems['TravelActionItem']['city_supplier_id']);



                $CitySupplierStatus = $TravelCitySuppliers['TravelCitySupplier']['city_supplier_status'];

                if ($CitySupplierStatus)

                    $CitySupplierStatus = 'true';

                else

                    $CitySupplierStatus = 'false';



                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $date = explode(' ', $TravelCitySuppliers['TravelCitySupplier']['created']);

                $created = $date[0] . 'T' . $date[1];



                $WtbStatus = $TravelCitySuppliers['TravelCitySupplier']['wtb_status'];

                if ($WtbStatus)

                    $WtbStatus = 'true';

                else

                    $WtbStatus = 'false';





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

                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">

                                                                <Id>' . $TravelCitySuppliers['TravelCitySupplier']['id'] . '</Id>

                                                                <CityCode><![CDATA[' . $TravelCitySuppliers['TravelCitySupplier']['pf_city_code'] . ']]></CityCode>

                                                                <CityName><![CDATA[' . $TravelCitySuppliers['TravelCitySupplier']['city_name'] . ']]></CityName>

                                                                <CityId>' . $TravelCitySuppliers['TravelCitySupplier']['city_id'] . '</CityId>                                

                                                                <SupplierCode><![CDATA[' . $TravelCitySuppliers['TravelCitySupplier']['supplier_code'] . ']]></SupplierCode>

                                                                <SupplierCityCode><![CDATA[' . $TravelCitySuppliers['TravelCitySupplier']['supplier_city_code'] . ']]></SupplierCityCode>

                                                                <PFCityCode><![CDATA[' . $TravelCitySuppliers['TravelCitySupplier']['pf_city_code'] . ']]></PFCityCode>

                                                                <CityMappingName><![CDATA[' . $TravelCitySuppliers['TravelCitySupplier']['city_mapping_name'] . ']]></CityMappingName>

                                                                <CityCountryCode><![CDATA[' . $TravelCitySuppliers['TravelCitySupplier']['city_country_code'] . ']]></CityCountryCode>

                                                                <CityCountryId>' . $TravelCitySuppliers['TravelCitySupplier']['city_country_id'] . '</CityCountryId>

                                                                <CityCountryName><![CDATA[' . $TravelCitySuppliers['TravelCitySupplier']['city_country_name'] . ']]></CityCountryName>

                                                                <CityContinentId>' . $TravelCitySuppliers['TravelCitySupplier']['city_continent_id'] . '</CityContinentId>

                                                                <CityContinentName><![CDATA[' . $TravelCitySuppliers['TravelCitySupplier']['city_continent_name'] . ']]></CityContinentName>

                                                                <ProvinceId>' . $TravelCitySuppliers['TravelCitySupplier']['province_id'] . '</ProvinceId>

                                                                <ProvinceName><![CDATA[' . $TravelCitySuppliers['TravelCitySupplier']['province_name'] . ']]></ProvinceName>                                                                

                                                                <CitySupplierStatus>' . $CitySupplierStatus . '</CitySupplierStatus>

                                                                <SupplierCountryCode><![CDATA[' . $TravelCitySuppliers['TravelCitySupplier']['supplier_coutry_code'] . ']]></SupplierCountryCode>

                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>

                                                                <Active>' . strtolower($TravelCitySuppliers['TravelCitySupplier']['active']) . '</Active>

                                                                <Excluded>' . strtolower($TravelCitySuppliers['TravelCitySupplier']['excluded']) . '</Excluded>                             

                                                                <ApprovedBy>' . $user_id . '</ApprovedBy>

                                                                <ApprovedDate>' . $CreatedDate . '</ApprovedDate>

                                                                <CreatedBy>' . $TravelCitySuppliers['TravelCitySupplier']['created_by'] . '</CreatedBy>

                                                                <CreatedDate>' . $created . '</CreatedDate> 

                                                            </ResourceDetailsData>              

                                                    </ResourceData>

                                                    </RequestParameters>

                                                </ResourceDataRequest>

                                            </RequestInfo>

                                        </ProcessXML>

                                    </soap:Body>';



                $log_call_screen = 'Approval - Supplier City Mapping';

                $RESOURCEDATA = 'RESOURCEDATA_CITYMAPPING';

                $error_topic = '28';

                $error_entity =  $TravelCitySuppliers['TravelCitySupplier']['id'];

                $error_type = '11';



                /*                 * *******************End XML************************************** */

            } elseif ($flag == '24' || $flag == '34') { // hotel mapping & hotel return

                $table = 'TravelHotelRoomSupplier';

                $table_id = $travel_actionitems['TravelActionItem']['hotel_supplier_id'];

                if ($this->TravelActionItem->save($this->data['TravelActionItem'])) {

                    $last_action_id = $this->TravelActionItem->getLastInsertId();

                    $this->TravelRemark->create();

                    $this->TravelRemark->save($this->data['TravelRemark']);

                    $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));

                    $this->TravelHotelRoomSupplier->updateAll($agents['TravelHotelRoomSupplier'], array('TravelHotelRoomSupplier.id' => $travel_actionitems['TravelActionItem']['hotel_supplier_id']));

                    $this->Mappinge->updateAll($mapping['Mappinge'], array('Mappinge.hotel_supplier_id' => $travel_actionitems['TravelActionItem']['hotel_supplier_id']));



                    $success = 1;

                }

            }

            if ($flag == '24') { // hotel mapping



                /*                 * *******************XML Logic********************************** */

                $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->findById($travel_actionitems['TravelActionItem']['hotel_supplier_id']);



                //$this->TravelHotelLookup->updateAll(array('TravelHotelLookup.active' => "'TRUE'"), array('TravelHotelLookup.id' => $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_id']));



                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $date = explode(' ', $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['created']);

                $created = $date[0] . 'T' . $date[1];



                $WtbStatus = $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['wtb_status'];

                if ($WtbStatus)

                    $WtbStatus = 'true';

                else

                    $WtbStatus = 'false';



                $content_xml_str = '<soap:Body>

                                        <ProcessXML xmlns="http://www.travel.domain/">

                                            <RequestInfo>

                                                <ResourceDataRequest>

                                                    <RequestAuditInfo>

                                                        <RequestType>PXML_WData_HotelMapping</RequestType>

                                                        <RequestTime>' . $CreatedDate . '</RequestTime>

                                                        <RequestResource>Silkrouters</RequestResource>

                                                    </RequestAuditInfo>

                                                    <RequestParameters>                        

                                                        <ResourceData>

                                                            <ResourceDetailsData srno="1" actiontype="' . $actiontype . '">

                                                                <Id>' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['id'] . '</Id>

                                                                <HotelCode><![CDATA[' . trim($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_code']) . ']]></HotelCode>

                                                                <HotelName><![CDATA[' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_name'] . ']]></HotelName>

                                                                <SupplierCode><![CDATA[' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['supplier_code'] . ']]></SupplierCode>

                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>

                                                                <Active>' . strtolower($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['active']) . '</Active>

                                                                <Excluded>' . strtolower($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['excluded']) . '</Excluded>

                                                                <ContinentId>' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_continent_id'] . '</ContinentId>

                                                                <ContinentCode>NA</ContinentCode>

                                                                <ContinentName><![CDATA[' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_continent_name'] . ']]></ContinentName>                                                                                        

                                                                <CountryId>' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_country_id'] . '</CountryId>

                                                                <CountryCode><![CDATA[' . trim($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_country_code']) . ']]></CountryCode>

                                                                <CountryName><![CDATA[' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_country_name'] . ']]></CountryName>

                                                                <ProvinceId>' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['province_id'] . '</ProvinceId>

                                                                <ProvinceName><![CDATA[' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['province_name'] . ']]></ProvinceName>    

                                                                <CityId>' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_city_id'] . '</CityId>

                                                                <CityCode><![CDATA[' . trim($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_city_code']) . ']]></CityCode>

                                                                <CityName><![CDATA[' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_city_name'] . ']]></CityName>

                                                                <SuburbId>' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_suburb_id'] . '</SuburbId>

                                                                <SuburbCode>NA</SuburbCode>

                                                                <SuburbName><![CDATA[' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_suburb_name'] . ']]></SuburbName>

                                                                <AreaId>' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_area_id'] . '</AreaId>

                                                                <AreaName><![CDATA[' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_area_name'] . ']]></AreaName>

                                                                <BrandId>' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_brand_id'] . '</BrandId>

                                                                <BrandName><![CDATA[' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_brand_name'] . ']]></BrandName>

                                                                <ChainId>' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_chain_id'] . '</ChainId>

                                                                <ChainName><![CDATA[' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_chain_name'] . ']]></ChainName> 

                                                                <SupplierCountryCode><![CDATA[' . trim($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['supplier_item_code4']) . ']]></SupplierCountryCode>

                                                                <SupplierCityCode><![CDATA[' . trim($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['supplier_item_code3']) . ']]></SupplierCityCode>

                                                                <SupplierHotelCode><![CDATA[' . trim($TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['supplier_item_code1']) . ']]></SupplierHotelCode>                              

                                                                <SupplierHotelRoomCode></SupplierHotelRoomCode>

                                                                <SupplierItemCode5></SupplierItemCode5>

                                                                <SupplierItemCode6></SupplierItemCode6>                              

                                                                <SupplierSuburbCode></SupplierSuburbCode>

                                                                <SupplierAreaCode></SupplierAreaCode>                              

                                                                <ApprovedBy>' . $user_id . '</ApprovedBy>

                                                                <ApprovedDate>' . $CreatedDate . '</ApprovedDate>

                                                                <CreatedBy>' . $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['created_by'] . '</CreatedBy>

                                                                <CreatedDate>' . $created . '</CreatedDate> 

                                                              </ResourceDetailsData>              

                                                    </ResourceData>

                                                    </RequestParameters>

                                                </ResourceDataRequest>

                                            </RequestInfo>

                                        </ProcessXML>

                                    </soap:Body>';





                

                

                $log_call_screen = 'Approval - Supplier Hotel Mapping';

                $RESOURCEDATA = 'RESOURCEDATA_HOTELMAPPING';

                $error_topic = '27';

                $error_entity =  $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['id'];

                $error_type = '10';

                

                /*                 * *******************End XML************************************** */

            } elseif ($flag == '534') {

                $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));



                $success = 1;

            }



            if ($flag == '22' || $flag == '23' || $flag == '24') { // XML calling

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



                    //echo htmlentities($xml_string);

                    //pr($xml_arr);

                    //die;





                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {

                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];

                        $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";

                        $this->$table->updateAll(array('wtb_status' => "'1'", 'is_update' => "'Y'"), array('id' => $table_id));

                    } else {



                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];

                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID

                        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";

                        $this->$table->updateAll(array('wtb_status' => "'2'"), array('id' => $table_id));

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

                        $this->request->data['TravelWtbError']['error_topic'] = $error_topic;

                        $this->request->data['TravelWtbError']['error_by'] = $user_id;

                        $this->request->data['TravelWtbError']['error_time'] = $this->Common->GetIndiaTime();                        

                        $this->request->data['TravelWtbError']['log_id'] = $LogId;

                        $this->request->data['TravelWtbError']['error_entity'] = $error_entity;

                        $this->request->data['TravelWtbError']['error_type'] = $error_type;

                        $this->request->data['TravelWtbError']['error_status'] = '1';    

                        $this->TravelWtbError->create();

                        $this->TravelWtbError->save($this->request->data['TravelWtbError']);

                }

            }



            $message = 'Local record has been successfully updated.<br />' . $xml_msg;



            if ($success)

                $this->Session->setFlash($message, 'success');

            else

                $this->Session->setFlash('Unable to add Action item.', 'failure');



            $this->redirect(array('controller' => 'travel_action_items', 'action' => 'index'));



            /*

              echo '<script>

              var objP=parent.document.getElementsByClassName("mfp-bg");

              var objC=parent.document.getElementsByClassName("mfp-wrap");

              objP[0].style.display="none";

              objC[0].style.display="none";

              parent.location.reload(true);</script>';

             * 

             */

        }
$travelCities = '';
$check_mapp = 'FALSE';
 $supplier_id =  $SupplierHotels['SupplierHotel']['supplier_id'] ;
//ECHO '<bR>';
 $supplier_city_id	 =  $SupplierHotels['SupplierHotel']['city_id'];
//ECHO '<bR>'; 
 $supplier_country_code  =  $SupplierHotels['SupplierHotel']['country_code'];
// THIS PART IS FOR JUST DISPLAYING THE CITY MAPPINGS FOR THE PASSED COUNTRY+CITY+SUPPLIER.

if(count($SupplierHotels)>0)
{
$check_mapp = 'TRUE';

	 		
   $TravelCityIds = $this->TravelCitySupplier->find('first', ARRAY('fields' => 'city_id', 'conditions' =>
		array('supplier_id' => $supplier_id, 'supplier_coutry_code' => $supplier_country_code, 'city_supplier_id' => $supplier_city_id)));
	//print_R(  $TravelCityIds); die;		
//array_push($travelConditions, array('TravelCity.id' => $TravelCityIds)); 
	if(count($TravelCityIds)>0)
	{		
//echo 'testing';
echo $TravelCityIds['TravelCitySupplier']['city_id'];
$options['conditions'] = array('TravelCity.id' => $TravelCityIds['TravelCitySupplier']['city_id'])	;
$options['group'] = array('TravelCity.id')	;
$options['fields'] = array('TravelCity.id,TravelCitySupplier.id,TravelCity.city_name,TravelCity.country_id,TravelCity.city_code,TravelCity.wtb_status,TravelCity.city_status,Province.name,Province.id,TravelCountry.country_name,TravelCountry.id,TravelCountry.country_code,TravelCitySupplier.city_mapping_name,TravelCitySupplier.active,TravelCitySupplier.excluded')	;	
$options['joins'] = array(
						array('table' => 'travel_countries',
							'alias' => 'TravelCountry',
							'type' => 'INNER',
							'conditions' => array('TravelCountry.id = TravelCity.country_id')
						  ),
						  array('table' => 'provinces',
							'alias' => 'Province',
							'type' => 'INNER',
							'conditions' => array('TravelCity.province_id = Province.id')
						  ),
						   array('table' => 'travel_city_suppliers',
							'alias' => 'TravelCitySupplier',
							'type' => 'INNER',
							'conditions' => array('TravelCitySupplier.city_id = TravelCity.id')
						  ),
						);
		
		
		
		$travelCities = $this->TravelCity->find('all',$options);
	}	
}




        $this->set(compact('headding'));



        // $type = $this->TravelActionItemType->find('list', array('fields' => array('id', 'value'), 'conditions' => 'id = 2 OR id = 3'));

        $this->set(compact('type'));





        $returns = $this->LookupValueActionItemReturn->find('list', array('fields' => 'id, value', 'conditions' => $retrun_cond, 'order' => 'value ASC'));

        $this->set(compact('returns'));



        $rejections = $this->LookupValueActionItemRejection->find('list', array('fields' => 'id, value', 'conditions' => $rejection_cond, 'order' => 'value ASC'));

        $this->set(compact('rejections','check_mapp','travelCities'));

    }



    public function duplicate_city_supplier_action($actio_itme_id = null, $duplicate_city_supplier_id = null) {

        $this->layout = '';

        /*         * *******Checking user*********** */

        $dummy_status = $this->Auth->user('dummy_status');

        $channel_id = $this->Session->read("channel_id");

        $user_id = $this->Auth->user('id');

        $role_id = $this->Session->read("role_id");





        $travel_actionitems = $this->TravelActionItem->findById($actio_itme_id);

        $ListDuplicateMappinges = $this->DuplicateMappinge->findById($duplicate_city_supplier_id);

        $Mappinge = $this->TravelCitySupplier->findById($ListDuplicateMappinges['DuplicateMappinge']['duplicate_id']);

        $this->set(compact('Mappinge'));

        if ($this->request->is('post') || $this->request->is('put')) {

            /*             * ************This data is common features **************************************** */

            $flag = '';

            $success = 0;

            $this->request->data['TravelActionItem']['parent_action_item_id'] = $actio_itme_id;

            $this->request->data['TravelActionItem']['dummy_status'] = $dummy_status;

            $this->request->data['TravelActionItem']['action_item_created'] = date('Y-m-d');

            $this->request->data['TravelActionItem']['created_by_id'] = $travel_actionitems['TravelActionItem']['created_by_id'];

            $this->request->data['TravelActionItem']['level_id'] = $travel_actionitems['TravelActionItem']['level_id'];

            $this->request->data['TravelActionItem']['duplicate_city_supplier_id'] = $travel_actionitems['TravelActionItem']['duplicate_city_supplier_id'];

            $this->request->data['TravelActionItem']['action_item_active'] = 'Yes';

            $this->request->data['TravelActionItem']['created_by'] = $user_id;

            $this->request->data['TravelActionItem']['action_item_source'] = $role_id;



            $this->request->data['TravelRemark']['remarks_time'] = date('g:i A');

            $this->request->data['TravelRemark']['created_by'] = $user_id;

            $this->request->data['TravelRemark']['duplicate_city_supplier_id'] = $travel_actionitems['TravelActionItem']['duplicate_city_supplier_id'];

            $this->request->data['TravelRemark']['remarks_date'] = date('Y-m-d');

            $this->request->data['TravelRemark']['dummy_status'] = $dummy_status;

            $this->request->data['TravelRemark']['remarks_level'] = $travel_actionitems['TravelActionItem']['level_id'];



            $type_id = $this->data['TravelActionItem']['type_id'];

            $level_id = $travel_actionitems['TravelActionItem']['level_id'];



            if ($type_id == '2' && $level_id == '5') { // Approval in mapping country

                $DuplicateMappinges['DuplicateMappinge']['status'] = '2';  // 2 for approve of travel_action_item_types



                $DuplicateMappinges['DuplicateMappinge']['approved_by'] = "'" . $user_id . "'";

                $DuplicateMappinges['DuplicateMappinge']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";







                $this->request->data['TravelRemark']['remarks'] = 'Approve Duplicate City Supplier';

                $this->request->data['TravelActionItem']['description'] = 'Approve Duplicate City Supplier';

                $this->request->data['TravelActionItem']['next_action_by'] = '';

            }

            if ($type_id == '5' && $level_id == '5') { // Reject 

                $DuplicateMappinges['DuplicateMappinge']['status'] = '5';  // 5 for Rejecttion of travel_action_item_types



                $DuplicateMappinges['DuplicateMappinge']['approved_by'] = "'" . $user_id . "'";

                $DuplicateMappinges['DuplicateMappinge']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";

                $DuplicateMappinges['DuplicateMappinge']['description'] = "'" . $this->data['TravelActionItem']['other_rejection'] . "'";

                $DuplicateMappinges['DuplicateMappinge']['rejection_id'] = "'" . $this->data['TravelActionItem']['lookup_rejection_id'] . "'";







                $this->request->data['TravelRemark']['remarks'] = 'Rejection Duplicate City Supplier';

                $this->request->data['TravelActionItem']['description'] = 'Rejection Duplicate City Supplier';

                $this->request->data['TravelActionItem']['next_action_by'] = '';

                $flag = '1';

            }



            if ($this->TravelActionItem->save($this->data['TravelActionItem'])) {

                $last_action_id = $this->TravelActionItem->getLastInsertId();

                $this->TravelRemark->save($this->data['TravelRemark']);

                $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));

                $this->DuplicateMappinge->updateAll($DuplicateMappinges['DuplicateMappinge'], array('DuplicateMappinge.id' => $travel_actionitems['TravelActionItem']['duplicate_city_supplier_id']));



                $this->Session->setFlash('Local record has been successfully updated.', 'success');

                $flag .= '2';

            } else

                $this->Session->setFlash('Unable to add Action item.', 'failure');



            if ($flag == '12') {



                $this->TravelCity->updateAll(array('TravelCity.city_status' => "'0'"), array('TravelCity.city_code LIKE' => $ListDuplicateMappinges['DuplicateMappinge']['city_wtb_code']));



                /* Email Logic */

                $to = array('administrator@silkrouters.com', 'data@silkrouters.com');

                // $to = array('biswa.mee@gmail.com', 'biswajit.das801@gmail.com');

                $cc = 'infra@sumanus.com';

                // $cc = 'biswajit@wtbglobal.com';

                $Email = new CakeEmail();

                $subject = strtoupper('DUPLICATE ENTRY | ' . $ListDuplicateMappinges['DuplicateMappinge']['mapping_name'] . ' | REJECTED BY - ' . $this->User->Username($user_id));

                $Email->viewVars(array(

                    'MappingName' => strtoupper($ListDuplicateMappinges['DuplicateMappinge']['mapping_name']),

                    'Supplier' => strtoupper($ListDuplicateMappinges['DuplicateMappinge']['supplier_code']),

                    'Country' => strtoupper($ListDuplicateMappinges['DuplicateMappinge']['country_wtb_code']),

                    'City' => strtoupper($ListDuplicateMappinges['DuplicateMappinge']['city_wtb_code']),

                    'CreatedBy' => $user_id,

                    'Description' => strtoupper($this->data['TravelActionItem']['other_rejection']),

                ));

                $Email->template('DuplicateMappinges/template', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject($subject)->send();



                /* End Emial */

            }



            // $this->redirect(array('controller' => 'travel_action_items', 'action' => 'index'));    



            echo '<script>

                var objP=parent.document.getElementsByClassName("mfp-bg");

                var objC=parent.document.getElementsByClassName("mfp-wrap");

                objP[0].style.display="none";

                objC[0].style.display="none";

                parent.location.reload(true);</script>';

        }



        $TravelCities = $this->TravelCity->find

                (

                'first', array

            (

            'fields' => array('TravelCity.city_code', 'TravelCity.city_name'),

            'conditions' => array

                (

                'TravelCity.city_code' => $ListDuplicateMappinges['DuplicateMappinge']['city_wtb_code']

            ),

                )

        );







        //  $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.city_code', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));

        // pr($TravelCities);

        $this->set(compact('TravelCities'));



        $type = $this->TravelActionItemType->find('list', array('fields' => array('id', 'value'), 'conditions' => 'id = 2 OR id = 5'));

        $this->set(compact('type'));



        $retrun_cond = array('type' => array('0', '6')); // 0=other 4=mapping

        $returns = $this->LookupValueActionItemRejection->find('list', array('fields' => 'id, value', 'conditions' => $retrun_cond, 'order' => 'value ASC'));

        $this->set(compact('returns'));

    }



    public function duplicate_hotel_supplier_action($actio_itme_id = null, $duplicate_city_supplier_id = null) {

        $this->layout = '';

        /*         * *******Checking user*********** */

        $dummy_status = $this->Auth->user('dummy_status');

        $channel_id = $this->Session->read("channel_id");

        $user_id = $this->Auth->user('id');

        $role_id = $this->Session->read("role_id");





        $travel_actionitems = $this->TravelActionItem->findById($actio_itme_id);

        $ListDuplicateMappinges = $this->DuplicateMappinge->findById($duplicate_city_supplier_id);

        $Mappinge = $this->TravelHotelRoomSupplier->findById($ListDuplicateMappinges['DuplicateMappinge']['duplicate_id']);

        $this->set(compact('Mappinge'));

        if ($this->request->is('post') || $this->request->is('put')) {

            /*             * ************This data is common features **************************************** */

            $flag = '';

            $success = 0;

            $this->request->data['TravelActionItem']['parent_action_item_id'] = $actio_itme_id;

            $this->request->data['TravelActionItem']['dummy_status'] = $dummy_status;

            $this->request->data['TravelActionItem']['action_item_created'] = date('Y-m-d');

            $this->request->data['TravelActionItem']['created_by_id'] = $travel_actionitems['TravelActionItem']['created_by_id'];

            $this->request->data['TravelActionItem']['level_id'] = $travel_actionitems['TravelActionItem']['level_id'];

            $this->request->data['TravelActionItem']['duplicate_city_supplier_id'] = $travel_actionitems['TravelActionItem']['duplicate_city_supplier_id'];

            $this->request->data['TravelActionItem']['action_item_active'] = 'Yes';

            $this->request->data['TravelActionItem']['created_by'] = $user_id;

            $this->request->data['TravelActionItem']['action_item_source'] = $role_id;



            $this->request->data['TravelRemark']['remarks_time'] = date('g:i A');

            $this->request->data['TravelRemark']['created_by'] = $user_id;

            $this->request->data['TravelRemark']['duplicate_city_supplier_id'] = $travel_actionitems['TravelActionItem']['duplicate_city_supplier_id'];

            $this->request->data['TravelRemark']['remarks_date'] = date('Y-m-d');

            $this->request->data['TravelRemark']['dummy_status'] = $dummy_status;

            $this->request->data['TravelRemark']['remarks_level'] = $travel_actionitems['TravelActionItem']['level_id'];



            $type_id = $this->data['TravelActionItem']['type_id'];

            $level_id = $travel_actionitems['TravelActionItem']['level_id'];



            if ($type_id == '2' && $level_id == '6') { // Approval in mapping country

                $DuplicateMappinges['DuplicateMappinge']['status'] = '2';  // 2 for approve of travel_action_item_types



                $DuplicateMappinges['DuplicateMappinge']['approved_by'] = "'" . $user_id . "'";

                $DuplicateMappinges['DuplicateMappinge']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";







                $this->request->data['TravelRemark']['remarks'] = 'Approve Duplicate City Supplier';

                $this->request->data['TravelActionItem']['description'] = 'Approve Duplicate City Supplier';

                $this->request->data['TravelActionItem']['next_action_by'] = '';

            }

            if ($type_id == '5' && $level_id == '6') { // Reject 

                $DuplicateMappinges['DuplicateMappinge']['status'] = '5';  // 5 for Rejecttion of travel_action_item_types



                $DuplicateMappinges['DuplicateMappinge']['approved_by'] = "'" . $user_id . "'";

                $DuplicateMappinges['DuplicateMappinge']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";

                $DuplicateMappinges['DuplicateMappinge']['description'] = "'" . $this->data['TravelActionItem']['other_rejection'] . "'";

                $DuplicateMappinges['DuplicateMappinge']['rejection_id'] = "'" . $this->data['TravelActionItem']['lookup_rejection_id'] . "'";







                $this->request->data['TravelRemark']['remarks'] = 'Rejection Duplicate Hotel Supplier';

                $this->request->data['TravelActionItem']['description'] = 'Rejection Duplicate Hotel Supplier';

                $this->request->data['TravelActionItem']['next_action_by'] = '';

                $flag = '1';

            }



            if ($this->TravelActionItem->save($this->data['TravelActionItem'])) {

                $last_action_id = $this->TravelActionItem->getLastInsertId();

                $this->TravelRemark->save($this->data['TravelRemark']);

                $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));

                $this->DuplicateMappinge->updateAll($DuplicateMappinges['DuplicateMappinge'], array('DuplicateMappinge.id' => $travel_actionitems['TravelActionItem']['duplicate_city_supplier_id']));



                $this->Session->setFlash('Local record has been successfully updated.', 'success');

                $flag .= '2';

            } else

                $this->Session->setFlash('Unable to add Action item.', 'failure');



            if ($flag == '12') {



                $this->TravelHotelLookup->updateAll(array('TravelHotelLookup.active' => "'FALSE'", 'TravelHotelLookup.status' => "7"), array('TravelHotelLookup.hotel_code LIKE' => $ListDuplicateMappinges['DuplicateMappinge']['hotel_wtb_code']));

                // $hotel_code = $ListDuplicateMappinges['DuplicateMappinge']['hotel_wtb_code'];

                //  $hotel_name_arr = $this->TravelHotelLookup->findByHotelCode($hotel_code, array('fields' => 'hotel_name'));

                //$city_name = substr(trim($city_name_arr['TravelCity'  ]['city_name']), 0, 2);

                //  $hotel_name = $hotel_name_arr['TravelHotelLookup']['hotel_name']; 

                $subject = strtoupper('DUPLICATE ENTRY | ' . $ListDuplicateMappinges['DuplicateMappinge']['mapping_name'] . ' | REJECTED BY - ' . $this->User->Username($user_id));

                /* Email Logic */

                $to = array('administrator@silkrouters.com', 'data@silkrouters.com');

                // $to = array('biswa.mee@gmail.com', 'biswajit.das801@gmail.com');

                $cc = 'infra@sumanus.com';

                // $cc = 'biswajit@wtbglobal.com';

                $Email = new CakeEmail();

                $Email->viewVars(array(

                    'MappingName' => strtoupper($ListDuplicateMappinges['DuplicateMappinge']['mapping_name']),

                    'Supplier' => strtoupper($ListDuplicateMappinges['DuplicateMappinge']['supplier_code']),

                    'Country' => strtoupper($ListDuplicateMappinges['DuplicateMappinge']['country_wtb_code']),

                    'City' => strtoupper($ListDuplicateMappinges['DuplicateMappinge']['city_wtb_code']),

                    'Hotel' => strtoupper($ListDuplicateMappinges['DuplicateMappinge']['hotel_wtb_code']),

                    'CreatedBy' => $ListDuplicateMappinges['DuplicateMappinge']['created_by'],

                    'Description' => strtoupper($this->data['TravelActionItem']['other_rejection']),

                ));

                $Email->template('DuplicateMappinges/hotel', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject($subject)->send();



                /* End Emial */



                /**

                 * Hotel duplicate xml fire - active = false

                 */

                $TravelHotelLookups = $this->TravelHotelLookup->findByHotelCode($ListDuplicateMappinges['DuplicateMappinge']['hotel_wtb_code']);



                $HotelId = $TravelHotelRoomSuppliers['TravelHotelRoomSupplier']['hotel_id'];

                $HotelCode = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];

                $HotelName = $TravelHotelLookups['TravelHotelLookup']['hotel_name'];

                $AreaId = $TravelHotelLookups['TravelHotelLookup']['area_id'];

                $AreaName = $TravelHotelLookups['TravelHotelLookup']['area_name'];

                $AreaCode = $TravelHotelLookups['TravelHotelLookup']['area_code'];

                $SuburbId = $TravelHotelLookups['TravelHotelLookup']['suburb_id'];

                $SuburbName = $TravelHotelLookups['TravelHotelLookup']['suburb_name'];

                $CityId = $TravelHotelLookups['TravelHotelLookup']['city_id'];

                $CityName = $TravelHotelLookups['TravelHotelLookup']['city_name'];

                $CityCode = $TravelHotelLookups['TravelHotelLookup']['city_code'];

                $CountryId = $TravelHotelLookups['TravelHotelLookup']['country_id'];

                $CountryName = $TravelHotelLookups['TravelHotelLookup']['country_name'];

                $CountryCode = $TravelHotelLookups['TravelHotelLookup']['country_code'];

                $ContinentId = $TravelHotelLookups['TravelHotelLookup']['continent_id'];

                $ContinentName = $TravelHotelLookups['TravelHotelLookup']['continent_name'];

                $ContinentCode = $TravelHotelLookups['TravelHotelLookup']['continent_code'];

                $BrandId = $TravelHotelLookups['TravelHotelLookup']['brand_id'];

                $BrandName = $TravelHotelLookups['TravelHotelLookup']['brand_name'];

                $ChainId = $TravelHotelLookups['TravelHotelLookup']['chain_id'];

                $ChainName = $TravelHotelLookups['TravelHotelLookup']['chain_name'];

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

            $IsImageLocal = $TravelHotelLookups['TravelHotelLookup']['is_image'];
            $IsPageLocal = $TravelHotelLookups['TravelHotelLookup']['is_page'];   
            
            if ($IsImageLocal == 'Y')
                $IsImage = 'TRUE';
            else
                $IsImage = 'FALSE';            
            
            if ($IsPageLocal == 'Y')
                $IsPage = 'TRUE';
            else
                $IsPage = 'FALSE';  

            $FormerName = $TravelHotelLookups['TravelHotelLookup']['hotel_former_name'];

            $DisplayName = $TravelHotelLookups['TravelHotelLookup']['hotel_display_name'];

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

                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $xml_error = 'FALSE';

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

                                                                <AreaCode><![CDATA[' . $AreaCode . ']]></AreaCode>

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

                                                                <Keyword>' . $Keyword . '</Keyword>

                                                                <StandardRating>' . $StandardRating . '</StandardRating>

                                                                <HotelRating>' . $HotelRating . '</HotelRating>

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

                                                                <HotelFormerName><![CDATA[' . $FormerName . ']]></HotelFormerName>
                                                                    
                                                                <HotelDisplayName><![CDATA[' . $DisplayName . ']]></HotelDisplayName>

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





                $log_call_screen = 'Hotel - Duplicated';



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

                        $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";

                        $this->TravelHotelLookup->updateAll(array('TravelHotelLookup.wtb_status' => "'1'", 'TravelHotelLookup.is_updated' => "'Y'"), array('TravelHotelLookup.id' => $HotelId));

                    } else {



                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];

                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID

                        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";

                        $this->TravelHotelLookup->updateAll(array('TravelHotelLookup.wtb_status' => "'2'"), array('TravelHotelLookup.id' => $HotelId));

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

                $LogId = $this->LogCall->getLastInsertId();

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

            }



            //$log = $this->TravelHotelLookup->getDataSource()->getLog(false, false);

            //  debug($log);

            // die;





            echo '<script>

                var objP=parent.document.getElementsByClassName("mfp-bg");

                var objC=parent.document.getElementsByClassName("mfp-wrap");

                objP[0].style.display="none";

                objC[0].style.display="none";

                parent.location.reload(true);</script>';

        }



        $TravelHotelLookups = $this->TravelHotelLookup->find('first', array('fields' => 'hotel_code, hotel_name', 'conditions' => array('hotel_code like' => $ListDuplicateMappinges['DuplicateMappinge']['hotel_wtb_code']), 'order' => 'hotel_name ASC'));

        $this->set(compact('TravelHotelLookups'));



        $type = $this->TravelActionItemType->find('list', array('fields' => array('id', 'value'), 'conditions' => 'id = 2 OR id = 5'));

        $this->set(compact('type'));



        $retrun_cond = array('type' => array('0', '7')); // 0=other 4=mapping

        $returns = $this->LookupValueActionItemRejection->find('list', array('fields' => 'id, value', 'conditions' => $retrun_cond, 'order' => 'value ASC'));

        $this->set(compact('returns'));

    }



    public function hotel_action($actio_itme_id = null) {

        $this->layout = '';

        $is_service = '';  



        /*         * *******Checking user*********** */

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';

        $action_URL = 'http://www.travel.domain/ProcessXML';

        $user_id = $this->Auth->user('id');

        $dummy_status = $this->Auth->user('dummy_status');

        $role_id = $this->Session->read("role_id");

        $flag = '';

        $typeCon = ARRAY();

        $xml_msg = '';

        $xml_error = 'FALSE';



        $travel_actionitems = $this->TravelActionItem->findById($actio_itme_id);

        if ($this->IsService() == 'true'){
           $is_service = "All services running normally.";
        }   else {
           $is_service = "Some services are offline. Please try later.";
        }  

        if ($this->request->is('post') || $this->request->is('put')) {





            /*             * ************This data is common features **************************************** */



            $this->request->data['TravelActionItem']['parent_action_item_id'] = $actio_itme_id;

            $this->request->data['TravelActionItem']['dummy_status'] = $dummy_status;

            $this->request->data['TravelActionItem']['action_item_created'] = date('Y-m-d');

            $this->request->data['TravelActionItem']['created_by_id'] = $travel_actionitems['TravelActionItem']['created_by_id'];

            $this->request->data['TravelActionItem']['level_id'] = $travel_actionitems['TravelActionItem']['level_id'];

            $this->request->data['TravelActionItem']['hotel_id'] = $travel_actionitems['TravelActionItem']['hotel_id'];

            $this->request->data['TravelActionItem']['action_item_active'] = 'Yes';

            $this->request->data['TravelActionItem']['created_by'] = $user_id;

            $this->request->data['TravelActionItem']['action_item_source'] = $role_id;



            $this->request->data['TravelRemark']['remarks_time'] = date('g:i A');

            $this->request->data['TravelRemark']['created_by'] = $user_id;

            $this->request->data['TravelRemark']['hotel_id'] = $travel_actionitems['TravelActionItem']['hotel_id'];

            $this->request->data['TravelRemark']['remarks_date'] = date('Y-m-d');

            $this->request->data['TravelRemark']['dummy_status'] = $dummy_status;

            $this->request->data['TravelRemark']['remarks_level'] = $travel_actionitems['TravelActionItem']['level_id'];



            $type_id = $this->data['TravelActionItem']['type_id'];



            if ($type_id == '2') { // Approval

                if($user_id == '169')

                    $TravelHotelLookups['TravelHotelLookup']['status'] = '8'; 

                else

                    $TravelHotelLookups['TravelHotelLookup']['status'] = '2'; //  for active for Approval of lookup_agent_statuses

                $TravelHotelLookups['TravelHotelLookup']['active'] = "'TRUE'";

                $TravelHotelLookups['TravelHotelLookup']['approved_by'] = "'" . $user_id . "'";

                $TravelHotelLookups['TravelHotelLookup']['approved_date'] = "'" . date('Y-m-d h:i:s') . "'";

                $this->request->data['TravelRemark']['remarks'] = 'Approve Hotel';

                $this->request->data['TravelActionItem']['description'] = 'Approve Hotel';

                $flag = '2';

            } elseif ($type_id == '3') { // Return

                $TravelHotelLookups['TravelHotelLookup']['status'] = '3'; // Returned

                $this->request->data['TravelRemark']['remarks'] = 'Returned Hotel';

                $this->request->data['TravelActionItem']['description'] = 'Returned Hotel';

                $this->request->data['TravelActionItem']['next_action_by'] = $travel_actionitems['TravelActionItem']['created_by_id'];

            }

            elseif ($type_id == '9') { // Submit for review

                $TravelHotelLookups['TravelHotelLookup']['status'] = '6'; // Submit For Review

                $this->request->data['TravelRemark']['remarks'] = 'Hotel Review';

                $this->request->data['TravelActionItem']['description'] = 'Hotel Review';

                $this->request->data['TravelActionItem']['next_action_by'] = '169';

            }

              $message = 'Local hotel record has been successfully updated.';

            //$TravelHotelLookups['TravelHotelLookup']['is_updated'] = 'Y';

            $this->TravelActionItem->create();

            if ($this->TravelActionItem->save($this->data['TravelActionItem'])) {

                $last_action_id = $this->TravelActionItem->getLastInsertId();

                $this->TravelRemark->save($this->data['TravelRemark']);

                $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));

                $this->TravelHotelLookup->updateAll($TravelHotelLookups['TravelHotelLookup'], array('TravelHotelLookup.id' => $travel_actionitems['TravelActionItem']['hotel_id']));

                $success = '1';

            }

            if ($flag == '2') {

                $HotelArray = $this->TravelHotelLookup->findById($travel_actionitems['TravelActionItem']['hotel_id']);

                //pr($HotelArray);



                $HotelId = $HotelArray['TravelHotelLookup']['id'];

                $HotelCode = $HotelArray['TravelHotelLookup']['hotel_code'];

                $HotelName = $HotelArray['TravelHotelLookup']['hotel_name'];

                $AreaId = $HotelArray['TravelHotelLookup']['area_id'];

                $AreaName = $HotelArray['TravelHotelLookup']['area_name'];

                $AreaCode = $HotelArray['TravelHotelLookup']['area_code'];

                $SuburbId = $HotelArray['TravelHotelLookup']['suburb_id'];

                $SuburbName = $HotelArray['TravelHotelLookup']['suburb_name'];



                $CityId = $HotelArray['TravelHotelLookup']['city_id'];

                $CityName = $HotelArray['TravelHotelLookup']['city_name'];

                $CityCode = $HotelArray['TravelHotelLookup']['city_code'];

                $CountryId = $HotelArray['TravelHotelLookup']['country_id'];

                $CountryName = $HotelArray['TravelHotelLookup']['country_name'];

                $CountryCode = $HotelArray['TravelHotelLookup']['country_code'];

                $ContinentId = $HotelArray['TravelHotelLookup']['continent_id'];

                $ContinentName = $HotelArray['TravelHotelLookup']['continent_name'];

                $ContinentCode = $HotelArray['TravelHotelLookup']['continent_code'];

                $BrandId = $HotelArray['TravelHotelLookup']['brand_id'];

                $BrandName = $HotelArray['TravelHotelLookup']['brand_name'];

                $ChainId = $HotelArray['TravelHotelLookup']['chain_id'];

                $ChainName = $HotelArray['TravelHotelLookup']['chain_name'];

                $HotelComment = $HotelArray['TravelHotelLookup']['hotel_comment'];

                $Star = $HotelArray['TravelHotelLookup']['star'];

                $Keyword = $HotelArray['TravelHotelLookup']['keyword'];

                $StandardRating = $HotelArray['TravelHotelLookup']['standard_rating'];

                $HotelRating = $HotelArray['TravelHotelLookup']['hotel_rating'];

                $FoodRating = $HotelArray['TravelHotelLookup']['food_rating'];

                $ServiceRating = $HotelArray['TravelHotelLookup']['service_rating'];

                $LocationRating = $HotelArray['TravelHotelLookup']['location_rating'];

                $ValueRating = $HotelArray['TravelHotelLookup']['value_rating'];

                $OverallRating = $HotelArray['TravelHotelLookup']['overall_rating'];

    $HotelImage1 = $HotelArray['TravelHotelLookup']['full_img1'];
    $HotelImage2 = $HotelArray['TravelHotelLookup']['full_img2'];
    $HotelImage3 = $HotelArray['TravelHotelLookup']['full_img3'];
    $HotelImage4 = $HotelArray['TravelHotelLookup']['full_img4'];
    $HotelImage5 = $HotelArray['TravelHotelLookup']['full_img5'];
    $HotelImage6 = $HotelArray['TravelHotelLookup']['full_img6'];
    $HotelImage7 = $HotelArray['TravelHotelLookup']['full_img7'];
    $HotelImage8 = $HotelArray['TravelHotelLookup']['full_img8'];
    $HotelImage9 = $HotelArray['TravelHotelLookup']['full_img9'];
    $HotelImage10 = $HotelArray['TravelHotelLookup']['full_img10'];
    $HotelImage11 = $HotelArray['TravelHotelLookup']['full_img11'];
    $HotelImage12 = $HotelArray['TravelHotelLookup']['full_img12'];
    $HotelImage13 = $HotelArray['TravelHotelLookup']['full_img13'];
    $HotelImage14 = $HotelArray['TravelHotelLookup']['full_img14'];
    $HotelImage15 = $HotelArray['TravelHotelLookup']['full_img15'];
    $HotelImage16 = $HotelArray['TravelHotelLookup']['full_img16'];
    $HotelImage17 = $HotelArray['TravelHotelLookup']['full_img17'];
    $HotelImage18 = $HotelArray['TravelHotelLookup']['full_img18'];
    $HotelImage19 = $HotelArray['TravelHotelLookup']['full_img19'];
    $HotelImage20 = $HotelArray['TravelHotelLookup']['full_img20'];
    
    $ThumbImage1 = $HotelArray['TravelHotelLookup']['thumb_img1'];
    $ThumbImage2 = $HotelArray['TravelHotelLookup']['thumb_img2'];

            $IsImageLocal = $HotelArray['TravelHotelLookup']['is_image'];
            $IsPageLocal = $HotelArray['TravelHotelLookup']['is_page'];   
            
            if ($IsImageLocal == 'Y')
                $IsImage = 'TRUE';
            else
                $IsImage = 'FALSE';            
            
            if ($IsPageLocal == 'Y')
                $IsPage = 'TRUE';
            else
                $IsPage = 'FALSE';  

            $FormerName = $HotelArray['TravelHotelLookup']['hotel_former_name'];

            $DisplayName = $HotelArray['TravelHotelLookup']['hotel_display_name'];

                $Logo = $HotelArray['TravelHotelLookup']['logo'];

                $Logo1 = $HotelArray['TravelHotelLookup']['logo1'];

                $BusinessCenter = $HotelArray['TravelHotelLookup']['business_center'];

                $MeetingFacilities = $HotelArray['TravelHotelLookup']['meeting_facilities'];

                $DiningFacilities = $HotelArray['TravelHotelLookup']['dining_facilities'];

                $BarLounge = $HotelArray['TravelHotelLookup']['bar_lounge'];

                $FitnessCenter = $HotelArray['TravelHotelLookup']['fitness_center'];

                $Pool = $HotelArray['TravelHotelLookup']['pool'];

                $Golf = $HotelArray['TravelHotelLookup']['golf'];

                $Tennis = $HotelArray['TravelHotelLookup']['tennis'];

                $Kids = $HotelArray['TravelHotelLookup']['kids'];

                $Handicap = $HotelArray['TravelHotelLookup']['handicap'];

                $URLHotel = $HotelArray['TravelHotelLookup']['url_hotel'];

                $Address = $HotelArray['TravelHotelLookup']['address'];

                $PostCode = $HotelArray['TravelHotelLookup']['post_code'];

                $NoRoom = $HotelArray['TravelHotelLookup']['no_room'];

                $Active = $HotelArray['TravelHotelLookup']['active'];

                if ($Active == 'TRUE')

                    $Active = '1';

                else

                    $Active = '0';

                $ReservationEmail = $HotelArray['TravelHotelLookup']['reservation_email'];

                $ReservationContact = $HotelArray['TravelHotelLookup']['reservation_contact'];

                $EmergencyContactName = $HotelArray['TravelHotelLookup']['emergency_contact_name'];

                $ReservationDeskNumber = $HotelArray['TravelHotelLookup']['reservation_desk_number'];

                $EmergencyContactNumber = $HotelArray['TravelHotelLookup']['emergency_contact_number'];

                $GPSPARAM1 = $HotelArray['TravelHotelLookup']['gps_prm_1'];

                $GPSPARAM2 = $HotelArray['TravelHotelLookup']['gps_prm_2'];

                $ProvinceId = $HotelArray['TravelHotelLookup']['province_id'];

                $ProvinceName = $HotelArray['TravelHotelLookup']['province_name'];

                $PropertyType = $HotelArray['TravelHotelLookup']['property_type'];

                $TopHotel = strtolower($HotelArray['TravelHotelLookup']['top_hotel']);

                $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

                $date = explode(' ', $HotelArray['TravelHotelLookup']['created']);

                $CreatedBy = $HotelArray['TravelHotelLookup']['created_by'];

                $created = $date[0] . 'T' . $date[1];



                $is_update = $HotelArray['TravelHotelLookup']['is_updated'];

                if ($is_update == 'Y') {

                    $actiontype = 'Update';

                    $ACTIVE_MSG = 'Edit';

                } else {

                    $actiontype = 'AddNew';

                    $ACTIVE_MSG = 'Add';

                }



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

                                                                <AreaCode><![CDATA[' . $AreaCode . ']]></AreaCode>

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

                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>

                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>

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

                                                                <HotelFormerName><![CDATA[' . $FormerName . ']]></HotelFormerName>
                                                                    
                                                                <HotelDisplayName><![CDATA[' . $DisplayName . ']]></HotelDisplayName>

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

                                                                <PropertyType>'.$PropertyType.'</PropertyType>

                                                                <ApprovedBy>' . $user_id . '</ApprovedBy>

                                                                <ApprovedDate>' . $CreatedDate . '</ApprovedDate>

                                                                <CreatedBy>' . $CreatedBy . '</CreatedBy>

                                                                <CreatedDate>' . $created . '</CreatedDate>

                                                            </ResourceDetailsData>

                         

                                                    </ResourceData>

                                                    </RequestParameters>

                                                </ResourceDataRequest>

                                            </RequestInfo>

                                        </ProcessXML>

                                    </soap:Body>';





                $log_call_screen = '[Approval] Hotel - ' . $ACTIVE_MSG;



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

                    //   pr($xml_arr);

                    //   die;



                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {

                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];

                        $xml_msg = "Foreign hotel record has been successfully updated [Code:$log_call_status_code]";

                        $this->TravelHotelLookup->updateAll(array('TravelHotelLookup.wtb_status' => "'1'", 'TravelHotelLookup.is_updated' => "'Y'"), array('TravelHotelLookup.id' => $HotelId));

                    } else {



                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];

                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID

                        $xml_msg = "There was a problem with foreign hotel record updation [Code:$log_call_status_code]";

                        $this->TravelHotelLookup->updateAll(array('TravelHotelLookup.wtb_status' => "'2'"), array('TravelHotelLookup.id' => $HotelId));

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

                $LogId = $this->LogCall->getLastInsertId();

                $message = 'Local hotel record has been successfully updated.<br />' . $xml_msg;

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

                        $this->request->data['TravelWtbError']['error_topic'] = '1';

                        $this->request->data['TravelWtbError']['error_by'] = $user_id;

                        $this->request->data['TravelWtbError']['error_time'] = $this->Common->GetIndiaTime();                        

                        $this->request->data['TravelWtbError']['log_id'] = $LogId;

                        $this->request->data['TravelWtbError']['error_entity'] = $HotelId;

                        $this->request->data['TravelWtbError']['error_type'] = '9'; //hotel

                        $this->request->data['TravelWtbError']['error_status'] = '1';    

                        $this->TravelWtbError->create();

                        $this->TravelWtbError->save($this->request->data['TravelWtbError']);

                }



                /**

                 * Hotel mapping update section.

                 */

                /*

                $xml_error = 'FALSE';



                if ($actiontype == 'Update') {





                    $arrs = $this->TravelHotelRoomSupplier->find('all', array('conditions' => array('TravelHotelRoomSupplier.hotel_id' => $HotelId)));

                    if (count($arrs) > 0) {

                        foreach ($arrs as $val) {



                            $Id = $val['TravelHotelRoomSupplier']['id'];

                            $this->request->data['TravelHotelRoomSupplier']['hotel_code'] = "'" . $HotelCode . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_name'] = "'" . $HotelName . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_area_id'] = "'" . $AreaId . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_area_name'] = "'" . $AreaName . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_suburb_id'] = "'" . $SuburbId . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_suburb_name'] = "'" . $SuburbName . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_city_id'] = "'" . $CityId . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_city_name'] = "'" . $CityName . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_country_id'] = "'" . $CountryId . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_country_code'] = "'" . $CountryCode . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_country_name'] = "'" . $CountryName . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_continent_id'] = "'" . $ContinentId . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_continent_name'] = "'" . $ContinentName . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_chain_id'] = "'" . $ChainId . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_chain_name'] = "'" . $ChainName . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_brand_id'] = "'" . $BrandId . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_brand_name'] = "'" . $BrandName . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_city_code'] = "'" . $CityCode . "'";

                            $this->request->data['TravelHotelRoomSupplier']['hotel_mapping_name'] = "'" . strtoupper('[SUPP/HOTEL] | ' . $val['TravelHotelRoomSupplier']['supplier_code'] . ' | ' . $CountryCode . ' | ' . $CityCode . ' | ' . $val['TravelHotelRoomSupplier']['hotel_code'] . ' - ' . $HotelName) . "'";



                            $this->TravelHotelRoomSupplier->updateAll($this->request->data['TravelHotelRoomSupplier'], array('TravelHotelRoomSupplier.id' => $Id));







                            $country_code = trim($CountryCode);

                            $hotel_code = trim($HotelCode);

                            $city_code = trim($CityCode);

                            $SupplierCode = $val['TravelHotelRoomSupplier']['supplier_code'];

                            $hotel_supplier_status = $val['TravelHotelRoomSupplier']['hotel_supplier_status'];



                            $Active = strtolower($val['TravelHotelRoomSupplier']['active']);

                            $Excluded = strtolower($val['TravelHotelRoomSupplier']['excluded']);

                            $SupplierCountryCode = $val['TravelHotelRoomSupplier']['supplier_item_code4'];

                            $SupplierCityCode = $val['TravelHotelRoomSupplier']['supplier_item_code3'];

                            $SupplierHotelCode = $val['TravelHotelRoomSupplier']['supplier_item_code1'];

                            $HotelName = $HotelName;

                            $CityId = $CityId;

                            $CityName = $CityName;

                            $SuburbId = $SuburbId;

                            $SuburbName = $SuburbName;

                            $AreaId = $AreaId;

                            $AreaName = $AreaName;

                            $BrandId = $BrandId;

                            $BrandName = $BrandName;

                            $ChainId = $ContinentId;

                            $ChainName = $ChainName;

                            $CountryId = $CountryId;

                            $CountryName = $CountryName;

                            $ContinentId = $ContinentId;

                            $ContinentName = $ContinentName;

                            $ApprovedBy = $val['TravelHotelRoomSupplier']['approved_by'];

                            $CreatedBy = $val['TravelHotelRoomSupplier']['created_by'];

                            $ProvinceId = $val['TravelHotelRoomSupplier']['province_id'];

                            $ProvinceName = $val['TravelHotelRoomSupplier']['province_name'];

                            $app_date = explode(' ', $val['TravelHotelRoomSupplier']['approved_date']);

                            $ApprovedDate = $app_date[0] . 'T' . $app_date[1];

                            $date = explode(' ', $val['TravelHotelRoomSupplier']['created']);

                            $created = $date[0] . 'T' . $date[1];

                            $is_update = $val['TravelHotelRoomSupplier']['is_update'];



                            $WtbStatus = $val['TravelHotelRoomSupplier']['wtb_status'];

                            if ($WtbStatus)

                                $WtbStatus = 'true';

                            else

                                $WtbStatus = 'false';



                            if ($is_update == 'Y' && $hotel_supplier_status == '2') {

                                $content_xml_str = '<soap:Body>

                                        <ProcessXML xmlns="http://www.travel.domain/">

                                            <RequestInfo>

                                                <ResourceDataRequest>

                                                    <RequestAuditInfo>

                                                        <RequestType>PXML_WData_HotelMapping</RequestType>

                                                        <RequestTime>' . $CreatedDate . '</RequestTime>

                                                        <RequestResource>Silkrouters</RequestResource>

                                                    </RequestAuditInfo>

                                                    <RequestParameters>                        

                                                        <ResourceData>

                                                            <ResourceDetailsData srno="1" actiontype="Update">

                                                                <Id>' . $Id . '</Id>

                                                                <HotelCode><![CDATA[' . $hotel_code . ']]></HotelCode>

                                                                <HotelName><![CDATA[' . $HotelName . ']]></HotelName>

                                                                <SupplierCode><![CDATA[' . $SupplierCode . ']]></SupplierCode>

                                                                <WtbStatus>' . $WtbStatus . '</WtbStatus>

                                                                <Active><![CDATA[' . $Active . ']]></Active>

                                                                <Excluded><![CDATA[' . $Excluded . ']]></Excluded>

                                                                <ContinentId>' . $ContinentId . '</ContinentId>

                                                                <ContinentCode>NA</ContinentCode>

                                                                <ContinentName><![CDATA[' . $ContinentName . ']]></ContinentName>                              

                                                                <CountryId>' . $CountryId . '</CountryId>

                                                                <CountryCode><![CDATA[' . $country_code . ']]></CountryCode>

                                                                <CountryName><![CDATA[' . $CountryName . ']]></CountryName>

                                                                <ProvinceId>' . $ProvinceId . '</ProvinceId> 

                                                                <ProvinceName><![CDATA[' . $ProvinceName . ']]></ProvinceName>

                                                                <CityId>' . $CityId . '</CityId>

                                                                <CityCode><![CDATA[' . $city_code . ']]></CityCode>

                                                                <CityName><![CDATA[' . $CityName . ']]></CityName>

                                                                <SuburbId>' . $SuburbId . '</SuburbId>

                                                                <SuburbCode>NA</SuburbCode>

                                                                <SuburbName><![CDATA[' . $SuburbName . ']]></SuburbName>

                                                                <AreaId>' . $AreaId . '</AreaId>

                                                                <AreaName><![CDATA[' . $AreaName . ']]></AreaName>

                                                                <BrandId>' . $BrandId . '</BrandId>

                                                                <BrandName><![CDATA[' . $BrandName . ']]></BrandName>

                                                                <ChainId>' . $ChainId . '</ChainId>

                                                                <ChainName><![CDATA[' . $ChainName . ']]></ChainName>    

                                                                <SupplierCountryCode><![CDATA[' . $SupplierCountryCode . ']]></SupplierCountryCode>

                                                                <SupplierCityCode><![CDATA[' . $SupplierCityCode . ']]></SupplierCityCode>

                                                                <SupplierHotelCode><![CDATA[' . $SupplierHotelCode . ']]></SupplierHotelCode>                              

                                                                <SupplierHotelRoomCode></SupplierHotelRoomCode>

                                                                <SupplierItemCode5></SupplierItemCode5>

                                                                <SupplierItemCode6></SupplierItemCode6>                              

                                                                <SupplierSuburbCode></SupplierSuburbCode>

                                                                <SupplierAreaCode></SupplierAreaCode>                              

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



                                $log_call_screen = 'Edit - Hotel Mapping';

                                $RESOURCEDATA = 'RESOURCEDATA_HOTELMAPPING';



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

                                        $xml_msg = "Foreign hotel mapping record has been successfully updated [Code:$log_call_status_code]";

                                        $this->TravelHotelRoomSupplier->updateAll(array('wtb_status' => "'1'", 'is_update' => "'Y'"), array('id' => $id));

                                    } else {



                                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];

                                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID

                                        $xml_msg = "There was a problem with foreign hotel mapping record updation [Code:$log_call_status_code]";

                                        $this->TravelHotelRoomSupplier->updateAll(array('wtb_status' => "'2'"), array('id' => $id));

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

                                $LogId = $this->LogCall->getLastInsertId();

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

                                $message .= '<br /> Local hotel mapping record has been successfully updated.<br />' . $xml_msg;

                            }

                        }

                    }

                }

                

                */



                //$this->TravelHotelLookup->updateAll(array('TravelHotelLookup.is_updated' => "'Y'"), array('TravelHotelLookup.id' => $HotelId));

//$log = $this->Agent->getDataSource()->getLog(false, false);

                //debug($log);

                //die;

                // $this->Session->setFlash('Data have been submitted.', 'success');

            }





            if ($success) {

                //$message = 'Local record has been successfully updated.<br />' . $xml_msg;

                $this->Session->setFlash($message, 'success');

            } else

                $this->Session->setFlash('This action is already added, check your input and try again...', 'failure');





            echo '<script>

                        var objP=parent.document.getElementsByClassName("mfp-bg");

                        var objC=parent.document.getElementsByClassName("mfp-wrap");

                        objP[0].style.display="none";

                        objC[0].style.display="none";

                        parent.location.reload(true);</script>';

        }

        



        if($user_id == '169')

            $typeCon = array('TravelActionItemType.id' => '2');

        else 

            $typeCon = array('OR' => array('TravelActionItemType.id' => array('2','3','9')));

      

        

        $type = $this->TravelActionItemType->find('list', array('fields' => array('id', 'value'), 'conditions' => $typeCon, 'order' => 'value asc'));

        $this->set(compact('type'));



        $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->find('all', array('conditions' => array('TravelHotelRoomSupplier.hotel_id' => $travel_actionitems['TravelActionItem']['hotel_id'])));





        $retrun_cond = array('type' => array('0'));

        $returns = $this->LookupValueActionItemReturn->find('list', array('fields' => 'id, value', 'conditions' => $retrun_cond, 'order' => 'value ASC'));

        $this->set(compact('returns', 'TravelHotelRoomSuppliers','is_service'));



        if (!$this->request->data) {

            $this->request->data = $travel_actionitems;

        }

    }



    

}



?>
