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

class TravelHotelLookupsController extends AppController {



    public $uses = array('TravelHotelLookup', 'TravelHotelRoomSupplier', 'TravelCountry', 'TravelLookupContinent', 'TravelLookupValueContractStatus', 'TravelCity', 'TravelChain',

        'TravelSuburb', 'TravelArea', 'TravelBrand', 'TravelActionItem', 'TravelRemark', 'LogCall','User','Province','ProvincePermission', 'DeleteTravelHotelLookup', 'DeleteLogTable',

        'TravelLookupRateType','TravelLookupPropertyType','TravelCitySupplier','Common','TravelWtbError');

    public $components = array('Sms', 'Image');

    public $uploadDir;  



    public function beforeFilter() {

        parent::beforeFilter();

        $this->uploadDir = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . '/uploads/hotels';

    }



    public function index() {

        



        $city_id = $this->Auth->user('city_id');

        $user_id = $this->Auth->user('id');

        $search_condition = array();

        $hotel_name = '';

        $continent_id = '';

        $country_id = '';

        $city_id = '';

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

        $msg_flag = '';
        
        $msg = '';        

            if($this->checkProvince())

            $proArr = $this->checkProvince();

            //next($proArr);

            

            

  

			

			if($this->hotelProvince()){

            array_push($search_condition, array('TravelHotelLookup.province_id' => $this->hotelProvince())); 

			$conProvince = array('TravelHotelLookup.province_id' => $this->hotelProvince());

			}



if(isset($_GET['country_id'])){

$get_country_id =	$_GET['country_id'];
$get_province_id =	$_GET['province_id'];
$get_city_id =	$_GET['city_id'];
$get_open_type = $_GET['open_type'];

$DataArray1 = ClassRegistry::init('TravelCountry')->find('first', array('fields' => array('country_name'), 'conditions' => array('TravelCountry.id' => $get_country_id)));
$get_country_name = $DataArray1['TravelCountry']['country_name'];

$DataArray2 = ClassRegistry::init('Province')->find('first', array('fields' => array('name'), 'conditions' => array('Province.id' => $get_province_id)));
$get_province_name = $DataArray2['Province']['name'];

$DataArray3 = ClassRegistry::init('TravelCity')->find('first', array('fields' => array('city_name'), 'conditions' => array('TravelCity.id' => $get_city_id)));
$get_city_name = $DataArray3['TravelCity']['city_name'];

$msg_flag = 'Y';


array_push($search_condition, array('TravelHotelLookup.city_id' => $get_city_id));
array_push($search_condition, array('TravelHotelLookup.province_id' => $get_province_id));
array_push($search_condition, array('TravelHotelLookup.country_id' => $get_country_id));	

if ($get_open_type == 1) {
array_push($search_condition, array('TravelHotelLookup.suburb_id ' => '0',
                                    'TravelHotelLookup.area_id ' => '0',
                                    'TravelHotelLookup.chain_id ' => '0',
                                    'TravelHotelLookup.brand_id ' => '0',
                                    'TravelHotelLookup.status ' => '2',
                                    'TravelHotelLookup.active ' => 'TRUE'));
$msg = '[WTB] Hotels [PENDING EDIT] From: [' . $get_country_name . " -> ". $get_province_name . " -> " . $get_city_name. "]";
} else {
$msg = '[WTB] Hotels [ALL] From: [' . $get_country_name . " -> ". $get_province_name . " -> " . $get_city_name. "]";
}

}	



        if ($this->request->is('post') || $this->request->is('put')) {

            // pr($this->request);

            //die;

            if (!empty($this->data['TravelHotelLookup']['hotel_name'])) {

                $hotel_name = $this->data['TravelHotelLookup']['hotel_name'];

                array_push($search_condition, array('OR' => array('TravelHotelLookup.id' . ' LIKE' => $hotel_name,'TravelHotelLookup.hotel_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_name))) . "%", 'TravelHotelLookup.hotel_code' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_name))) . "%", 'TravelHotelLookup.country_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_name))) . "%", 'TravelHotelLookup.city_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_name))) . "%", 'TravelHotelLookup.area_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_name))) . "%")));

            }

            if (!empty($this->data['TravelHotelLookup']['continent_id'])) {

                $continent_id = $this->data['TravelHotelLookup']['continent_id'];

                array_push($search_condition, array('TravelHotelLookup.continent_id' => $continent_id));

                $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id, country_name', 'conditions' => array('TravelCountry.continent_id' => $continent_id,

                        'TravelCountry.country_status' => '1',

                        'TravelCountry.wtb_status' => '1',

                        'TravelCountry.active' => 'TRUE'), 'order' => 'country_name ASC'));

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

                $TravelSuburbs = $this->TravelSuburb->find('list', array(

                    'conditions' => array(

                        'TravelSuburb.country_id' => $country_id,

                        'TravelSuburb.city_id' => $city_id,

                        'TravelSuburb.status' => '1',

                        'TravelSuburb.wtb_status' => '1',

                        'TravelSuburb.active' => 'TRUE'

                    ),

                    'fields' => 'TravelSuburb.id, TravelSuburb.name',

                    'order' => 'TravelSuburb.name ASC'

                ));

            }

            if (!empty($this->data['TravelHotelLookup']['suburb_id'])) {

                $suburb_id = $this->data['TravelHotelLookup']['suburb_id'];

                array_push($search_condition, array('TravelHotelLookup.suburb_id' => $suburb_id));

                $TravelAreas = $this->TravelArea->find('list', array(

                    'conditions' => array(

                        'TravelArea.suburb_id' => $suburb_id,

                        'TravelArea.area_status' => '1',

                        'TravelArea.wtb_status' => '1',

                        'TravelArea.area_active' => 'TRUE'

                    ),

                    'fields' => 'TravelArea.id, TravelArea.area_name',

                    'order' => 'TravelArea.area_name ASC'

                ));

            }





            if (!empty($this->data['TravelHotelLookup']['area_id'])) {

                $area_id = $this->data['TravelHotelLookup']['area_id'];

                array_push($search_condition, array('TravelHotelLookup.area_id' => $area_id));

            }

            if (!empty($this->data['TravelHotelLookup']['chain_id'])) {

                $chain_id = $this->data['TravelHotelLookup']['chain_id'];

                array_push($search_condition, array('TravelHotelLookup.chain_id' => $chain_id));

                $TravelBrands = $this->TravelBrand->find('list', array(

                    'conditions' => array(

                        'TravelBrand.brand_chain_id' => $chain_id,

                        'TravelBrand.brand_status' => '1',

                        'TravelBrand.wtb_status' => '1',

                        'TravelBrand.brand_active' => 'TRUE'

                    ),

                    'fields' => 'TravelBrand.id, TravelBrand.brand_name',

                    'order' => 'TravelBrand.brand_name ASC'

                ));

                $TravelBrands = array('1' => 'No Brand') + $TravelBrands;

            }

            if (!empty($this->data['TravelHotelLookup']['brand_id'])) {

                $brand_id = $this->data['TravelHotelLookup']['brand_id'];

                array_push($search_condition, array('TravelHotelLookup.brand_id' => $brand_id));

            }

            if (!empty($this->data['TravelHotelLookup']['status'])) {

                $status = $this->data['TravelHotelLookup']['status'];

                array_push($search_condition, array('TravelHotelLookup.status' => $status));

            }

            if (!empty($this->data['TravelHotelLookup']['wtb_status'])) {

                $wtb_status = $this->data['TravelHotelLookup']['wtb_status'];

                array_push($search_condition, array('TravelHotelLookup.wtb_status' => $wtb_status));

            }

            if (!empty($this->data['TravelHotelLookup']['active'])) {

                $active = $this->data['TravelHotelLookup']['active'];

                array_push($search_condition, array('TravelHotelLookup.active' => $active));

            }

        } elseif ($this->request->is('get')) {



            if (!empty($this->request->params['named']['hotel_name'])) {

                $hotel_name = $this->request->params['named']['hotel_name'];

                array_push($search_condition, array('OR' => array('TravelHotelLookup.hotel_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_name))) . "%", 'TravelHotelLookup.hotel_code' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_name))) . "%", 'TravelHotelLookup.country_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_name))) . "%", 'TravelHotelLookup.city_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_name))) . "%", 'TravelHotelLookup.area_name' . ' LIKE' => "%" . mysql_escape_string(trim(strip_tags($hotel_name))) . "%")));

            }



            if (!empty($this->request->params['named']['continent_id'])) {

                $continent_id = $this->request->params['named']['continent_id'];

                array_push($search_condition, array('TravelHotelLookup.continent_id' => $continent_id));

                $TravelCountries = $this->TravelCountry->find('list', array('fields' => 'id, country_name', 'conditions' => array('TravelCountry.continent_id' => $continent_id,

                        'TravelCountry.country_status' => '1',

                        'TravelCountry.wtb_status' => '1',

                        'TravelCountry.active' => 'TRUE'), 'order' => 'country_name ASC'));

            }



            if (!empty($this->request->params['named']['country_id'])) {

                $country_id = $this->request->params['named']['country_id'];

                $province_id = $this->request->params['named']['province_id'];

                array_push($search_condition, array('TravelHotelLookup.country_id' => $country_id));

                $TravelCities = $this->TravelCity->find('list', array('fields' => 'id, city_name', 'conditions' => array('TravelCity.province_id' => $province_id,

                        'TravelCity.city_status' => '1',

                        'TravelCity.wtb_status' => '1',

                        'TravelCity.active' => 'TRUE',), 'order' => 'city_name ASC'));

            }

            if (!empty($this->request->params['named']['province_id'])) {

                

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



            if (!empty($this->request->params['named']['city_id'])) {

                $city_id = $this->request->params['named']['city_id'];

                array_push($search_condition, array('TravelHotelLookup.city_id' => $city_id));

                $TravelSuburbs = $this->TravelSuburb->find('list', array(

                    'conditions' => array(

                        'TravelSuburb.country_id' => $country_id,

                        'TravelSuburb.city_id' => $city_id,

                        'TravelSuburb.status' => '1',

                        'TravelSuburb.wtb_status' => '1',

                        'TravelSuburb.active' => 'TRUE'

                    ),

                    'fields' => 'TravelSuburb.id, TravelSuburb.name',

                    'order' => 'TravelSuburb.name ASC'

                ));

            }



            if (!empty($this->request->params['named']['suburb_id'])) {

                $suburb_id = $this->request->params['named']['suburb_id'];

                array_push($search_condition, array('TravelHotelLookup.suburb_id' => $suburb_id));

                $TravelAreas = $this->TravelArea->find('list', array(

                    'conditions' => array(

                        'TravelArea.suburb_id' => $suburb_id,

                        'TravelArea.area_status' => '1',

                        'TravelArea.wtb_status' => '1',

                        'TravelArea.area_active' => 'TRUE'

                    ),

                    'fields' => 'TravelArea.id, TravelArea.area_name',

                    'order' => 'TravelArea.area_name ASC'

                ));

            }

            if (!empty($this->request->params['named']['area_id'])) {

                $area_id = $this->request->params['named']['area_id'];

                array_push($search_condition, array('TravelHotelLookup.area_id' => $area_id));

            }

            if (!empty($this->request->params['named']['chain_id'])) {

                $chain_id = $this->request->params['named']['chain_id'];

                array_push($search_condition, array('TravelHotelLookup.chain_id' => $chain_id));

                $TravelBrands = $this->TravelBrand->find('list', array(

                    'conditions' => array(

                        'TravelBrand.brand_chain_id' => $chain_id,

                        'TravelBrand.brand_status' => '1',

                        'TravelBrand.wtb_status' => '1',

                        'TravelBrand.brand_active' => 'TRUE'

                    ),

                    'fields' => 'TravelBrand.id, TravelBrand.brand_name',

                    'order' => 'TravelBrand.brand_name ASC'

                ));

                $TravelBrands = array('1' => 'No Brand') + $TravelBrands;

            }

            if (!empty($this->request->params['named']['brand_id'])) {

                $brand_id = $this->request->params['named']['brand_id'];

                array_push($search_condition, array('TravelHotelLookup.brand_id' => $brand_id));

            }

            if (!empty($this->request->params['named']['status'])) {

                $status = $this->request->params['named']['status'];

                array_push($search_condition, array('TravelHotelLookup.status' => $status));

            }

            if (!empty($this->request->params['named']['wtb_status'])) {

                $wtb_status = $this->request->params['named']['wtb_status'];

                array_push($search_condition, array('TravelHotelLookup.wtb_status' => $wtb_status));

            }

            if (!empty($this->request->params['named']['active'])) {

                $active = $this->request->params['named']['active'];

                array_push($search_condition, array('TravelHotelLookup.active' => $active));

            }

        }



        







            

//  pr($this->params);



        if (count($this->params['pass'])) {



            $aaray = explode(':', $this->params['pass'][0]);

            $field = $aaray[0];

            $value = $aaray[1];

            array_push($search_condition, array('TravelHotelLookup.' . $field . ' LIKE' => '%' . $value . '%')); // when builder is approve/pending                 

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



        $this->paginate['order'] = array('TravelHotelLookup.city_code' => 'asc');

        $this->set('TravelHotelLookups', $this->paginate("TravelHotelLookup", $search_condition));



        //$log = $this->TravelHotelLookup->getDataSource()->getLog(false, false);       

        //debug($log);

        //die;



        $hotel_count = $this->TravelHotelLookup->find('count',array('conditions' => $conProvince));

        $this->set(compact('hotel_count','msg_flag','msg'));


/*
        $active_count = $this->TravelHotelLookup->find('count', array('conditions' => array('active' => '1')+$conProvince));

        $this->set(compact('active_count'));



        $midd_east_count = $this->TravelHotelLookup->find('count', array('conditions' => array('continent_id LIKE' => '%ME%')+$conProvince));

        $this->set(compact('midd_east_count'));



        $direct_count = $this->TravelHotelLookup->find('count', array('conditions' => array('contract_status' => '2')+$conProvince));

        $this->set(compact('direct_count'));



        $europe_count = $this->TravelHotelLookup->find('count', array('conditions' => array('continent_id LIKE' => '%EU%')+$conProvince));

        $this->set(compact('europe_count'));



        $asia_count = $this->TravelHotelLookup->find('count', array('conditions' => array('continent_id LIKE' => '%AS%')+$conProvince));

        $apac_count = $asia_count + $europe_count;

        $this->set(compact('apac_count'));



        $mapped_count = $this->TravelHotelRoomSupplier->find('count', array(

            'joins' => array(

                array(

                    'table' => 'travel_hotel_lookups',

                    'alias' => 'TravelHotelLookup',

                    'conditions' => array(

                        'TravelHotelLookup.hotel_code = TravelHotelRoomSupplier.hotel_code'

                    )

                )

            )

        ));



        $four_star_count = $this->TravelHotelLookup->find('count', array('conditions' => array('star LIKE' => '%4%')+$conProvince));

        $five_star_count = $this->TravelHotelLookup->find('count', array('conditions' => array('star LIKE' => '%5%')+$conProvince));

        $four_five_star = $four_star_count + $five_star_count;

        $three_star_count = $this->TravelHotelLookup->find('count', array('conditions' => array('star LIKE' => '%3%')+$conProvince));

        $below_three_star_count = $this->TravelHotelLookup->find('count', array('conditions' => array('star >' => '3')+$conProvince));

        $thailand_count = $this->TravelHotelLookup->find('count', array('conditions' => array('country_code LIKE' => '%TH%')+$conProvince));

        $bangkok_count = $this->TravelHotelLookup->find('count', array('conditions' => array('city_code LIKE' => '%BKK%')+$conProvince));

        $pattaya_count = $this->TravelHotelLookup->find('count', array('conditions' => array('city_code LIKE' => '%PYX%')+$conProvince));

        $phuket_count = $this->TravelHotelLookup->find('count', array('conditions' => array('city_code LIKE' => '%HKT%')+$conProvince));

        $india_count = $this->TravelHotelLookup->find('count', array('conditions' => array('country_code LIKE' => '%IN%')+$conProvince));

        $uae_count = $this->TravelHotelLookup->find('count', array('conditions' => array('country_code LIKE' => '%AE%')+$conProvince));

        $dubai_count = $this->TravelHotelLookup->find('count', array('conditions' => array('city_code LIKE' => '%DUA%')+$conProvince));

        $sharjah_count = $this->TravelHotelLookup->find('count', array('conditions' => array('city_code LIKE' => '%SHH%')+$conProvince));

        $abu_dhabi_count = $this->TravelHotelLookup->find('count', array('conditions' => array('city_code LIKE' => '%AUH%')+$conProvince));

        $melbourne_count = $this->TravelHotelLookup->find('count', array('conditions' => array('city_code LIKE' => '%9AJ%')+$conProvince));

        $new_zealand_count = $this->TravelHotelLookup->find('count', array('conditions' => array('country_code LIKE' => '%NZ%')+$conProvince));

        $malaysia_count = $this->TravelHotelLookup->find('count', array('conditions' => array('country_code LIKE' => '%MY%')+$conProvince));

        $singapore_count = $this->TravelHotelLookup->find('count', array('conditions' => array('country_code LIKE' => '%SG%')+$conProvince));

        $maldives_count = $this->TravelHotelLookup->find('count', array('conditions' => array('country_code LIKE' => '%MV%')+$conProvince));

        $srilanka_count = $this->TravelHotelLookup->find('count', array('conditions' => array('country_code LIKE' => '%LK%')+$conProvince));
 * 
 * */
 

        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));

        $TravelLookupValueContractStatuses = $this->TravelLookupValueContractStatus->find('list', array('fields' => 'id, value', 'order' => 'value ASC'));

        $TravelChains = $this->TravelChain->find('list', array('fields' => 'id,chain_name', 'conditions' => array('chain_status' => 1, 'wtb_status' => 1, 'chain_active' => 'TRUE', array('NOT' => array('id' => 1))), 'order' => 'chain_name ASC'));

        $TravelChains = array('1' => 'No Chain') + $TravelChains;

         





        if (!isset($this->passedArgs['hotel_name']) && empty($this->passedArgs['hotel_name'])) {

            $this->passedArgs['hotel_name'] = (isset($this->data['TravelHotelLookup']['hotel_name'])) ? $this->data['TravelHotelLookup']['hotel_name'] : '';

        }

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

        if (!isset($this->passedArgs['suburb_id']) && empty($this->passedArgs['suburb_id'])) {

            $this->passedArgs['suburb_id'] = (isset($this->data['TravelHotelLookup']['suburb_id'])) ? $this->data['TravelHotelLookup']['suburb_id'] : '';

        }

        if (!isset($this->passedArgs['area_id']) && empty($this->passedArgs['area_id'])) {

            $this->passedArgs['area_id'] = (isset($this->data['TravelHotelLookup']['area_id'])) ? $this->data['TravelHotelLookup']['area_id'] : '';

        }

        if (!isset($this->passedArgs['chain_id']) && empty($this->passedArgs['chain_id'])) {

            $this->passedArgs['chain_id'] = (isset($this->data['TravelHotelLookup']['chain_id'])) ? $this->data['TravelHotelLookup']['chain_id'] : '';

        }

        if (!isset($this->passedArgs['brand_id']) && empty($this->passedArgs['brand_id'])) {

            $this->passedArgs['brand_id'] = (isset($this->data['TravelHotelLookup']['brand_id'])) ? $this->data['TravelHotelLookup']['brand_id'] : '';

        }

        if (!isset($this->passedArgs['status']) && empty($this->passedArgs['status'])) {

            $this->passedArgs['status'] = (isset($this->data['TravelHotelLookup']['status'])) ? $this->data['TravelHotelLookup']['status'] : '';

        }

        if (!isset($this->passedArgs['wtb_status']) && empty($this->passedArgs['wtb_status'])) {

            $this->passedArgs['wtb_status'] = (isset($this->data['TravelHotelLookup']['wtb_status'])) ? $this->data['TravelHotelLookup']['wtb_status'] : '';

        }

        if (!isset($this->passedArgs['active']) && empty($this->passedArgs['active'])) {

            $this->passedArgs['active'] = (isset($this->data['TravelHotelLookup']['active'])) ? $this->data['TravelHotelLookup']['active'] : '';

        }







        if (!isset($this->data) && empty($this->data)) {

            $this->data['TravelHotelLookup']['hotel_name'] = $this->passedArgs['hotel_name'];

            $this->data['TravelHotelLookup']['continent_id'] = $this->passedArgs['continent_id'];

            $this->data['TravelHotelLookup']['country_id'] = $this->passedArgs['country_id'];

            $this->data['TravelHotelLookup']['province_id'] = $this->passedArgs['province_id'];

            $this->data['TravelHotelLookup']['city_id'] = $this->passedArgs['city_id'];

            $this->data['TravelHotelLookup']['suburb_id'] = $this->passedArgs['suburb_id'];

            $this->data['TravelHotelLookup']['area_id'] = $this->passedArgs['area_id'];

            $this->data['TravelHotelLookup']['chain_id'] = $this->passedArgs['chain_id'];

            $this->data['TravelHotelLookup']['brand_id'] = $this->passedArgs['brand_id'];

            $this->data['TravelHotelLookup']['status'] = $this->passedArgs['status'];

            $this->data['TravelHotelLookup']['wtb_status'] = $this->passedArgs['wtb_status'];

            $this->data['TravelHotelLookup']['active'] = $this->passedArgs['active'];

        }



        $this->set(compact('hotel_name', 'continent_id', 'country_id', 'city_id', 'suburb_id', 'area_id', 'TravelChains', 'status', 'active', 'chain_id', 'brand_id', 'wtb_status', 'TravelCountries', 'TravelCities', 'TravelSuburbs', 'TravelAreas', 'TravelChains', 'TravelBrands', 'TravelLookupValueContractStatuses', 'TravelLookupContinents', 'mapped_count', 'srilanka_count', 'maldives_count', 'singapore_count', 'malaysia_count', 'new_zealand_count', 'melbourne_count', 'abu_dhabi_count', 'sharjah_count', 'dubai_count', 'uae_count', 'india_count', 'phuket_count', 'pattaya_count', 'bangkok_count', 'thailand_count', 'below_three_star_count', 'three_star_count', 'four_five_star','Provinces','province_id'));

    }



    public function add() {



        $user_id = $this->Auth->user('id');

        $role_id = $this->Session->read("role_id");

        $dummy_status = $this->Auth->user('dummy_status');

        $next_action_by = '165';

        

        



        if ($this->request->is('post')) {



            $image1 = '';

            $image2 = '';

            $image3 = '';

            $image4 = '';

            $image5 = '';

            $image6 = '';

            $logo = '';

            $logo1 = '';



            if (is_uploaded_file($this->request->data['TravelHotelLookup']['hotel_img1']['tmp_name'])) {

                $image1 = $this->Image->upload(null, $this->request->data['TravelHotelLookup']['hotel_img1'], $this->uploadDir, 'image1');

            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['hotel_img2']['tmp_name'])) {

                $image2 = $this->Image->upload(null, $this->request->data['TravelHotelLookup']['hotel_img2'], $this->uploadDir, 'image2');

            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['hotel_img3']['tmp_name'])) {

                $image3 = $this->Image->upload(null, $this->request->data['TravelHotelLookup']['hotel_img3'], $this->uploadDir, 'image3');

            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['hotel_img4']['tmp_name'])) {

                $image4 = $this->Image->upload(null, $this->request->data['TravelHotelLookup']['hotel_img4'], $this->uploadDir, 'image4');

            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['hotel_img5']['tmp_name'])) {

                $image5 = $this->Image->upload(null, $this->request->data['TravelHotelLookup']['hotel_img5'], $this->uploadDir, 'image5');

            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['hotel_img6']['tmp_name'])) {

                $image6 = $this->Image->upload(null, $this->request->data['TravelHotelLookup']['hotel_img6'], $this->uploadDir, 'image6');

            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['logo']['tmp_name'])) {

                $logo = $this->Image->upload(null, $this->request->data['TravelHotelLookup']['logo'], $this->uploadDir . '/logo', 'logo');

            }

            if (is_uploaded_file($this->request->data['TravelHotelLookup']['logo1']['tmp_name'])) {

                $logo1 = $this->Image->upload(null, $this->request->data['TravelHotelLookup']['logo1'], $this->uploadDir . '/logo', 'logo1');

            }

            unset($this->request->data['TravelHotelLookup']['hotel_img1']);

            unset($this->request->data['TravelHotelLookup']['hotel_img2']);

            unset($this->request->data['TravelHotelLookup']['hotel_img3']);

            unset($this->request->data['TravelHotelLookup']['hotel_img4']);

            unset($this->request->data['TravelHotelLookup']['hotel_img5']);

            unset($this->request->data['TravelHotelLookup']['hotel_img6']);

            unset($this->request->data['TravelHotelLookup']['logo']);

            unset($this->request->data['TravelHotelLookup']['logo1']);

            $this->request->data['TravelHotelLookup']['hotel_img1'] = $image1;

            $this->request->data['TravelHotelLookup']['hotel_img2'] = $image2;

            $this->request->data['TravelHotelLookup']['hotel_img3'] = $image3;

            $this->request->data['TravelHotelLookup']['hotel_img4'] = $image4;

            $this->request->data['TravelHotelLookup']['hotel_img5'] = $image5;

            $this->request->data['TravelHotelLookup']['hotel_img6'] = $image6;

            $this->request->data['TravelHotelLookup']['logo'] = $logo;

            $this->request->data['TravelHotelLookup']['logo1'] = $logo1;



            $this->request->data['TravelHotelLookup']['created_by'] = $user_id;

            $this->request->data['TravelHotelLookup']['active'] = 'TRUE';

            $this->request->data['TravelHotelLookup']['status'] = '1';

            //$this->TravelHotelLookup->create();

            if ($this->TravelHotelLookup->save($this->request->data)) {



                $HotelId = $this->TravelHotelLookup->getLastInsertId();

                /*                 * ************************TravelHotelLookup Action ********************** */

                $travel_action_item['TravelActionItem']['hotel_id'] = $HotelId;

                $travel_action_item['TravelActionItem']['level_id'] = '7';  // for hotel travel_action_remark_levels 

                $travel_action_item['TravelActionItem']['type_id'] = '1'; // for Submitted for approval of travel_action_item_types

                $travel_action_item['TravelActionItem']['next_action_by'] = $next_action_by;

                $travel_action_item['TravelActionItem']['action_item_active'] = 'Yes';

                $travel_action_item['TravelActionItem']['description'] = 'Hotel Record Added - Submission For Approval';

                $travel_action_item['TravelActionItem']['action_item_source'] = $role_id;

                $travel_action_item['TravelActionItem']['created_by_id'] = $user_id;

                $travel_action_item['TravelActionItem']['created_by'] = $user_id;

                $travel_action_item['TravelActionItem']['dummy_status'] = $dummy_status;

                // $travel_action_item['TravelActionItem']['parent_action_item_id'] = $actio_itme_id;





                /*                 * ********************TravelHotelLookup Remarks ******************************** */

                $travel_remarks['TravelRemark']['hotel_id'] = $HotelId;

                $travel_remarks['TravelRemark']['remarks'] = 'Add Hotel Record';

                $travel_remarks['TravelRemark']['created_by'] = $user_id;

                $travel_remarks['TravelRemark']['remarks_time'] = date('g:i A');

                $travel_remarks['TravelRemark']['remarks_level'] = '7';  // for hotel country travel_action_remark_levels 

                $travel_remarks['TravelRemark']['dummy_status'] = $dummy_status;



                $this->TravelActionItem->save($travel_action_item);

                $ActionId = $this->TravelActionItem->getLastInsertId();

                $ActionUpdateArr['TravelActionItem']['parent_action_item_id'] = "'" . $ActionId . "'";

                $this->TravelActionItem->updateAll($ActionUpdateArr['TravelActionItem'], array('TravelActionItem.id' => $ActionId));



                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');

                $this->redirect(array('controller' => 'messages', 'action' => 'index', 'travel_hotel_lookups', 'my-hotels'));

                /*

                  $HotelCode = $this->data['TravelHotelLookup']['hotel_code'];

                  $HotelName = $this->data['TravelHotelLookup']['hotel_name'];

                  $AreaId = $this->data['TravelHotelLookup']['area_id'];

                  $AreaName = $this->data['TravelHotelLookup']['area_name'];

                  $AreaCode = '';

                  $SuburbId = $this->data['TravelHotelLookup']['suburb_id'];

                  $SuburbName = $this->data['TravelHotelLookup']['suburb_name'];

                  $CityId = $this->data['TravelHotelLookup']['city_id'];

                  $CityName = $this->data['TravelHotelLookup']['city_name'];

                  $CityCode = '';

                  $CountryId = $this->data['TravelHotelLookup']['country_id'];

                  $CountryName = $this->data['TravelHotelLookup']['country_name'];

                  $CountryCode = '';

                  $ContinentId = $this->data['TravelHotelLookup']['continent_id'];

                  $ContinentName = $this->data['TravelHotelLookup']['continent_name'];

                  $ContinentCode = '';

                  $BrandId = $this->data['TravelHotelLookup']['brand_id'];

                  $BrandName = $this->data['TravelHotelLookup']['brand_name'];

                  $ChainId = $this->data['TravelHotelLookup']['chain_id'];

                  $ChainName = $this->data['TravelHotelLookup']['chain_name'];

                  $HotelComment = $this->data['TravelHotelLookup']['hotel_comment'];

                  $Star = $this->data['TravelHotelLookup']['star'];

                  $Keyword = '';

                  $StandardRating = $this->data['TravelHotelLookup']['standard_rating'];

                  $HotelRating = $this->data['TravelHotelLookup']['hotel_rating'];

                  $FoodRating = $this->data['TravelHotelLookup']['food_rating'];

                  $ServiceRating = $this->data['TravelHotelLookup']['service_rating'];

                  $LocationRating = $this->data['TravelHotelLookup']['location_rating'];

                  $ValueRating = $this->data['TravelHotelLookup']['value_rating'];

                  $OverallRating = $this->data['TravelHotelLookup']['overall_rating'];

                  $HotelImage1 = $image1;

                  $HotelImage2 = $image2;

                  $HotelImage3 = $image3;

                  $HotelImage4 = $image4;

                  $HotelImage5 = $image5;

                  $HotelImage6 = $image6;

                  $Logo = $logo;

                  $Logo1 = $logo1;

                  $BusinessCenter = $this->data['TravelHotelLookup']['business_center'];

                  $MeetingFacilities = $this->data['TravelHotelLookup']['meeting_facilities'];

                  $DiningFacilities = $this->data['TravelHotelLookup']['dining_facilities'];

                  $BarLounge = $this->data['TravelHotelLookup']['bar_lounge'];

                  $FitnessCenter = $this->data['TravelHotelLookup']['fitness_center'];

                  $Pool = $this->data['TravelHotelLookup']['pool'];

                  $Golf = $this->data['TravelHotelLookup']['golf'];

                  $Tennis = $this->data['TravelHotelLookup']['tennis'];

                  $Kids = $this->data['TravelHotelLookup']['kids'];

                  $Handicap = $this->data['TravelHotelLookup']['handicap'];

                  $URLHotel = $this->data['TravelHotelLookup']['url_hotel'];

                  $Address = $this->data['TravelHotelLookup']['address'];

                  $PostCode = $this->data['TravelHotelLookup']['post_code'];

                  $NoRoom = $this->data['TravelHotelLookup']['no_room'];

                  $Active = '1';



                  $ReservationEmail = $this->data['TravelHotelLookup']['reservation_email'];

                  $ReservationContact = $this->data['TravelHotelLookup']['reservation_contact'];

                  $EmergencyContactName = $this->data['TravelHotelLookup']['emergency_contact_name'];

                  $ReservationDeskNumber = $this->data['TravelHotelLookup']['reservation_desk_number'];

                  $EmergencyContactNumber = $this->data['TravelHotelLookup']['emergency_contact_number'];

                  $GPSPARAM1 = $this->data['TravelHotelLookup']['gps_prm_1'];

                  $GPSPARAM2 = $this->data['TravelHotelLookup']['gps_prm_2'];

                  $TopHotel = strtolower($this->data['TravelHotelLookup']['top_hotel']);

                  $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');



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

                  <ResourceDetailsData srno="1" actiontype="AddNew">

                  <HotelId>'.$HotelId.'</HotelId>

                  <HotelCode>'.$HotelCode.'</HotelCode>

                  <HotelName>'.$HotelName.'</HotelName>

                  <AreaId>'.$AreaId.'</AreaId>

                  <AreaCode>'.$AreaCode.'</AreaCode>

                  <AreaName>'.$AreaName.'</AreaName>

                  <SuburbId>'.$SuburbId.'</SuburbId>

                  <SuburbCode>NA</SuburbCode>

                  <SuburbName>'.$SuburbName.'</SuburbName>

                  <CityId>'.$CityId.'</CityId>

                  <CityCode>'.$CityCode.'</CityCode>

                  <CityName>'.$CityName.'</CityName>

                  <CountryId>'.$CountryId.'</CountryId>

                  <CountryCode>'.$CountryCode.'</CountryCode>

                  <CountryName>'.$CountryName.'</CountryName>

                  <ContinentId>'.$ContinentId.'</ContinentId>

                  <ContinentCode>'.$ContinentCode.'</ContinentCode>

                  <ContinentName>'.$ContinentName.'</ContinentName>

                  <BrandId>'.$BrandId.'</BrandId>

                  <BrandName>'.$BrandName.'</BrandName>

                  <ChainId>'.$ChainId.'</ChainId>

                  <ChainName>'.$ChainName.'</ChainName>

                  <HotelComment>![CDATA['.$HotelComment.']]</HotelComment>

                  <Star>'.$Star.'</Star>

                  <Keyword>'.$Keyword.'</Keyword>

                  <StandardRating>'.$StandardRating.'</StandardRating>

                  <HotelRating>'.$HotelRating.'</HotelRating>

                  <FoodRating>'.$FoodRating.'</FoodRating>

                  <ServiceRating>'.$ServiceRating.'</ServiceRating>

                  <LocationRating>'.$LocationRating.'</LocationRating>

                  <ValueRating>'.$ValueRating.'</ValueRating>

                  <OverallRating>'.$OverallRating.'</OverallRating>

                  <HotelImage1>'.$HotelImage1.'</HotelImage1>

                  <HotelImage2>'.$HotelImage2.'</HotelImage2>

                  <HotelImage3>'.$HotelImage3.'</HotelImage3>

                  <HotelImage4>'.$HotelImage4.'</HotelImage4>

                  <HotelImage5>'.$HotelImage5.'</HotelImage5>

                  <HotelImage6>'.$HotelImage6.'</HotelImage6>

                  <Logo>'.$Logo.'</Logo>

                  <Logo1>'.$Logo1.'</Logo1>

                  <BusinessCenter>'.$BusinessCenter.'</BusinessCenter>

                  <MeetingFacilities>'.$MeetingFacilities.'</MeetingFacilities>

                  <DiningFacilities>'.$DiningFacilities.'</DiningFacilities>

                  <BarLounge>'.$BarLounge.'</BarLounge>

                  <FitnessCenter>'.$FitnessCenter.'</FitnessCenter>

                  <Pool>'.$Pool.'</Pool>

                  <Golf>'.$Golf.'</Golf>

                  <Tennis>'.$Tennis.'</Tennis>

                  <Kids>'.$Kids.'</Kids>

                  <Handicap>'.$Handicap.'</Handicap>

                  <URLHotel>'.$URLHotel.'</URLHotel>

                  <Address>'.$Address.'</Address>

                  <PostCode>'.$PostCode.'</PostCode>

                  <NoRoom>'.$NoRoom.'</NoRoom>

                  <Active>'.$Active.'</Active>

                  <ReservationEmail>'.$ReservationEmail.'</ReservationEmail>

                  <ReservationContact>'.$ReservationContact.'</ReservationContact>

                  <EmergencyContactName>'.$EmergencyContactName.'</EmergencyContactName>

                  <ReservationDeskNumber>'.$ReservationDeskNumber.'</ReservationDeskNumber>

                  <EmergencyContactNumber>'.$EmergencyContactNumber.'</EmergencyContactNumber>

                  <GPSPARAM1>'.$GPSPARAM1.'</GPSPARAM1>

                  <GPSPARAM2>'.$GPSPARAM2.'</GPSPARAM2>

                  <TopHotel>'.$TopHotel.'</TopHotel>

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





                  $log_call_screen = 'Hotel - Add';



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

                  //die;



                  if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]=='201') {

                  $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];

                  $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];

                  $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";

                  $this->TravelHotelLookup->updateAll(array('TravelHotelLookup.wtb_status' => "'1'"), array('TravelHotelLookup.id' => $HotelId));

                  } else {



                  $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];

                  $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_HOTEL']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID

                  $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";

                  $this->TravelHotelLookup->updateAll(array('TravelHotelLookup.wtb_status' => "'2'"), array('TravelHotelLookup.id' => $HotelId));

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

                  $this->redirect(array('action' => 'index'));

                  } else {

                  $this->Session->setFlash('Unable to add Hotel.', 'failure');

                  }

                 * */

            }

        }



        $TravelLookupContinents = $this->TravelLookupContinent->find('list', array('fields' => 'id,continent_name', 'conditions' => array('continent_status' => 1, 'wtb_status' => 1, 'active' => 'TRUE'), 'order' => 'continent_name ASC'));

        $this->set(compact('TravelLookupContinents'));

        

        $TravelLookupPropertyTypes = $this->TravelLookupPropertyType->find('list', array('fields' => 'id,value','order' => 'value ASC'));

        $TravelLookupRateTypes = $this->TravelLookupRateType->find('list', array('fields' => 'id,value','order' => 'value ASC'));



        $TravelChains = $this->TravelChain->find('list', array('fields' => 'id,chain_name', 'conditions' => array('chain_status' => 1, 'wtb_status' => 1, 'chain_active' => 'TRUE', array('NOT' => array('id' => 1))), 'order' => 'chain_name ASC'));

        $TravelChains = array('1' => 'No Chain') + $TravelChains;

        $this->set(compact('TravelChains','TravelLookupPropertyTypes','TravelLookupRateTypes'));

    }



    public function edit($id) {



        $user_id = $this->Auth->user('id');

        $role_id = $this->Session->read("role_id");

        $dummy_status = $this->Auth->user('dummy_status');

        $actio_itme_id = '';

        $flag = 0;

        

        if($this->checkProvince())

            $proArr = $this->checkProvince();

        

  

         

        

        



        $TravelCountries = array();

        $TravelCities = array();

        $TravelSuburbs = array();

        $TravelAreas = array();

        $TravelBrands = array();

        $Provinces=array();

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

        $continent_id = $TravelHotelLookups['TravelHotelLookup']['continent_id'];

            $country_id = $TravelHotelLookups['TravelHotelLookup']['country_id'];

            $province_id = $TravelHotelLookups['TravelHotelLookup']['province_id'];

            

        $permissionArray = $this->ProvincePermission->find('first',array('conditions' => array('continent_id' => $continent_id,'country_id' => $country_id,'province_id' => $province_id,'user_id' => $user_id)));  

        if(isset($permissionArray['ProvincePermission']['approval_id']))

            $next_action_by = $permissionArray['ProvincePermission']['approval_id'];

        else

            $next_action_by = '165';

        

        

        if (count($arr) > 1) {

            $actio_itme_id = $arr[1];

            $flag = 1;

            $TravelActionItems = $this->TravelActionItem->findById($actio_itme_id);

            $next_action_by = $TravelActionItems['TravelActionItem']['next_action_by'];

            

        }

        else{

            $proArr = array();

            if($this->checkProvince())

            $proArr = $this->checkProvince();

            $ConArry = array('Province.id' => $proArr);

        }



        //echo $next_action_by;



        



        if ($this->request->is('post') || $this->request->is('put')) {



            

            //$continent_id = $this->data->request['TravelHotelLookup']['continent_id'];

            //$continent_id = $this->data->request['TravelHotelLookup']['continent_id'];

            

              //overseer 136 44 is sarika 152 - ojas

            

     



            $image1 = '';

            $image2 = '';

            $image3 = '';

            $image4 = '';





            if (is_uploaded_file($this->request->data['TravelHotelLookup']['image1']['tmp_name'])) {

                $image1 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['hotel_img1'], $this->request->data['TravelHotelLookup']['image1'], $this->uploadDir, 'image1');

                $this->request->data['TravelHotelLookup']['hotel_img1'] = $image1;

            } else {

                unset($this->request->data['TravelHotelLookup']['image1']);

            }



            if (is_uploaded_file($this->request->data['TravelHotelLookup']['image2']['tmp_name'])) {

                $image2 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['hotel_img2'], $this->request->data['TravelHotelLookup']['image2'], $this->uploadDir, 'image2');

                $this->request->data['TravelHotelLookup']['hotel_img2'] = $image2;

            } else {

                unset($this->request->data['TravelHotelLookup']['image2']);

            }



            if (is_uploaded_file($this->request->data['TravelHotelLookup']['image3']['tmp_name'])) {

                $image2 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['hotel_img3'], $this->request->data['TravelHotelLookup']['image3'], $this->uploadDir, 'image3');

                $this->request->data['TravelHotelLookup']['hotel_img3'] = $image2;

            } else {

                unset($this->request->data['TravelHotelLookup']['image3']);

            }



            if (is_uploaded_file($this->request->data['TravelHotelLookup']['image4']['tmp_name'])) {

                $image2 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['hotel_img4'], $this->request->data['TravelHotelLookup']['image4'], $this->uploadDir, 'image4');

                $this->request->data['TravelHotelLookup']['hotel_img4'] = $image2;

            } else {

                unset($this->request->data['TravelHotelLookup']['image4']);

            }



            if (is_uploaded_file($this->request->data['TravelHotelLookup']['image5']['tmp_name'])) {

                $image2 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['hotel_img5'], $this->request->data['TravelHotelLookup']['image5'], $this->uploadDir, 'image5');

                $this->request->data['TravelHotelLookup']['hotel_img5'] = $image2;

            } else {

                unset($this->request->data['TravelHotelLookup']['image5']);

            }



            if (is_uploaded_file($this->request->data['TravelHotelLookup']['image6']['tmp_name'])) {

                $image2 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['hotel_img6'], $this->request->data['TravelHotelLookup']['image6'], $this->uploadDir, 'image6');

                $this->request->data['TravelHotelLookup']['hotel_img6'] = $image2;

            } else {

                unset($this->request->data['TravelHotelLookup']['image6']);

            }



            if (is_uploaded_file($this->request->data['TravelHotelLookup']['logo_image1']['tmp_name'])) {

                $image3 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['logo'], $this->request->data['TravelHotelLookup']['logo_image2'], $this->uploadDir . '/logo', 'logo');

                $this->request->data['TravelHotelLookup']['logo'] = $image3;

            } else {

                unset($this->request->data['TravelHotelLookup']['image3']);

            }



            if (is_uploaded_file($this->request->data['TravelHotelLookup']['logo_image2']['tmp_name'])) {

                $image4 = $this->Image->upload($TravelHotelLookups['TravelHotelLookup']['logo1'], $this->request->data['TravelHotelLookup']['logo_image2'], $this->uploadDir . '/logo', 'logo1');

                $this->request->data['TravelHotelLookup']['logo1'] = $image4;

            } else {

                unset($this->request->data['TravelHotelLookup']['image4']);

            }





            $this->request->data['TravelHotelLookup']['active'] = 'FALSE';

            $this->request->data['TravelHotelLookup']['created_by'] = $user_id;

            $this->request->data['TravelHotelLookup']['status'] = '4';



            /*             * ************************TravelHotelLookup Action ********************** */

            $travel_action_item['TravelActionItem']['hotel_id'] = $id;

            $travel_action_item['TravelActionItem']['level_id'] = '7';  // for hotel travel_action_remark_levels 

            $travel_action_item['TravelActionItem']['type_id'] = '4'; // for Change Submitted of travel_action_item_types

            $travel_action_item['TravelActionItem']['next_action_by'] = $next_action_by;

            $travel_action_item['TravelActionItem']['action_item_active'] = 'Yes';

            $travel_action_item['TravelActionItem']['description'] = 'Hotel Record Updated - Re-Submission For Approval';

            $travel_action_item['TravelActionItem']['action_item_source'] = $role_id;

            $travel_action_item['TravelActionItem']['created_by_id'] = $user_id;

            $travel_action_item['TravelActionItem']['created_by'] = $user_id;

            $travel_action_item['TravelActionItem']['dummy_status'] = $dummy_status;

            $travel_action_item['TravelActionItem']['parent_action_item_id'] = $actio_itme_id;





            /*             * ********************TravelHotelLookup Remarks ******************************** */

            $travel_remarks['TravelRemark']['hotel_id'] = $id;

            $travel_remarks['TravelRemark']['remarks'] = 'Edit Hotel Record';

            $travel_remarks['TravelRemark']['created_by'] = $user_id;

            $travel_remarks['TravelRemark']['remarks_time'] = date('g:i A');

            $travel_remarks['TravelRemark']['remarks_level'] = '7';  // for hotel country travel_action_remark_levels 

            $travel_remarks['TravelRemark']['dummy_status'] = $dummy_status;





            $this->TravelHotelLookup->id = $id;

            if ($this->TravelHotelLookup->save($this->request->data['TravelHotelLookup'])) {

                $this->TravelActionItem->save($travel_action_item);

                $ActionId = $this->TravelActionItem->getLastInsertId();

                $this->TravelActionItem->id = $ActionId;

                $this->TravelActionItem->saveField('parent_action_item_id', $ActionId);

                $this->TravelRemark->save($travel_remarks);



                if ($actio_itme_id) {

                    $this->TravelActionItem->saveField('parent_action_item_id', $actio_itme_id);

                    $this->TravelActionItem->updateAll(array('TravelActionItem.action_item_active' => "'No'"), array('TravelActionItem.id' => $actio_itme_id));

                }

                $this->Session->setFlash('Your changes have been submitted. Waiting for approval at the moment...', 'success');

            }



            if ($flag == 1)

                $this->redirect(array('controller' => 'travel_action_items', 'action' => 'index'));

            else

                $this->redirect(array('controller' => 'travel_hotel_lookups', 'action' => 'index'));

            // $this->redirect(array('controller' => 'messages','action' => 'index','properties','my-properties'));

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

                    'Province.active' => 'TRUE',$ConArry

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



        $TravelLookupPropertyTypes = $this->TravelLookupPropertyType->find('list', array('fields' => 'id,value','order' => 'value ASC'));

        $TravelLookupRateTypes = $this->TravelLookupRateType->find('list', array('fields' => 'id,value','order' => 'value ASC'));

        $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->find('all', array('conditions' => array('TravelHotelRoomSupplier.hotel_id' => $id)));

        $this->set(compact('TravelBrands','actio_itme_id', 'TravelHotelRoomSuppliers','Provinces','TravelLookupPropertyTypes','TravelLookupRateTypes'));

        



        $this->request->data = $TravelHotelLookups;

    }



    public function de_active($id = null, $type = null) {



        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';

        $action_URL = 'http://www.travel.domain/ProcessXML';

        $user_id = $this->Auth->user('id');

        $TravelCountries = array();

        $TravelCities = array();

        $TravelSuburbs = array();

        $TravelAreas = array();

        $TravelBrands = array();

        $Provinces = array();

        $xml_error = 'FALSE';



        if ($type == 'TRUE') {

            $type = 'FALSE';

            $ACTIVE_MSG = 'Active';

        } else {

            $type = 'TRUE';

            $ACTIVE_MSG = 'Inactive';

        }



        if (!$id) {

            throw new NotFoundException(__('Invalid Hotel'));

        }



        $TravelHotelLookups = $this->TravelHotelLookup->findById($id);

        //pr($TravelHotelLookups);



        if (!$TravelHotelLookups) {

            throw new NotFoundException(__('Invalid Hotel'));

        }



        if ($this->request->is('post') || $this->request->is('put')) {

            $this->TravelHotelLookup->set($this->data);

            if ($this->TravelHotelLookup->validates() == true) {



                if ($this->TravelHotelLookup->updateAll(array('TravelHotelLookup.active' => '"' . $this->data['TravelHotelLookup']['active'] . '"'), array('TravelHotelLookup.id' => $id))) {



                    $HotelId = $id;

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

                    if ($this->data['TravelHotelLookup']['active'] == 'TRUE')

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





                    $log_call_screen = 'Hotel - ' . $ACTIVE_MSG;



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



                    /**

                     * Hotel Mapping Update



                      $xml_error = 'FALSE';



                      $arrs = $this->TravelHotelRoomSupplier->find('all', array('conditions' => array('TravelHotelRoomSupplier.hotel_id' => $CityId)));

                      if (count($arrs) > 0) {

                      foreach ($arrs as $val) {

                      $Id = $val['TravelHotelRoomSupplier']['id'];

                      $this->TravelHotelRoomSupplier->updateAll(array('TravelHotelRoomSupplier.active' => '"' . $this->data['TravelHotelLookup']['active'] . '"'), array('TravelHotelRoomSupplier.id' => $Id));







                      $country_code = trim($val['TravelHotelRoomSupplier']['hotel_country_code']);

                      $hotel_code = trim($val['TravelHotelRoomSupplier']['hotel_code']);

                      $city_code = $val['TravelHotelRoomSupplier']['hotel_city_code'];

                      $SupplierCode = $val['TravelHotelRoomSupplier']['supplier_code'];

                      $Active = strtolower($this->data['TravelHotelLookup']['active']);

                      $Excluded = strtolower($val['TravelHotelRoomSupplier']['excluded']);

                      $SupplierCountryCode = $val['TravelHotelRoomSupplier']['supplier_item_code4'];

                      $SupplierCityCode = $val['TravelHotelRoomSupplier']['supplier_item_code3'];

                      $SupplierHotelCode = $val['TravelHotelRoomSupplier']['supplier_item_code1'];

                      $HotelName = $val['TravelHotelRoomSupplier']['hotel_name'];

                      $CityId = $val['TravelHotelRoomSupplier']['hotel_city_id'];

                      $CityName = $val['TravelHotelRoomSupplier']['hotel_city_name'];

                      $SuburbId = $val['TravelHotelRoomSupplier']['hotel_suburb_id'];

                      $SuburbName = $val['TravelHotelRoomSupplier']['hotel_suburb_name'];

                      $AreaId = $val['TravelHotelRoomSupplier']['hotel_area_id'];

                      $AreaName = $val['TravelHotelRoomSupplier']['hotel_area_name'];

                      $BrandId = $val['TravelHotelRoomSupplier']['hotel_brand_id'];

                      $BrandName = $val['TravelHotelRoomSupplier']['hotel_brand_name'];

                      $ChainId = $val['TravelHotelRoomSupplier']['hotel_chain_id'];

                      $ChainName = $val['TravelHotelRoomSupplier']['hotel_chain_name'];

                      $CountryId = $val['TravelHotelRoomSupplier']['hotel_country_id'];

                      $CountryName = $val['TravelHotelRoomSupplier']['hotel_country_name'];

                      $ContinentId = $val['TravelHotelRoomSupplier']['hotel_continent_id'];

                      $ContinentName = $val['TravelHotelRoomSupplier']['hotel_continent_name'];

                      $ApprovedBy = $val['TravelHotelRoomSupplier']['approved_by'];

                      $CreatedBy = $val['TravelHotelRoomSupplier']['created_by'];

                      $app_date = explode(' ', $val['TravelHotelRoomSupplier']['approved_date']);

                      $ApprovedDate = $app_date[0] . 'T' . $app_date[1];

                      $date = explode(' ', $val['TravelHotelRoomSupplier']['created']);

                      $created = $date[0] . 'T' . $date[1];

                      $is_update = $val['TravelHotelRoomSupplier']['is_update'];

                      if ($is_update == 'Y')

                      $hotel_actiontype = 'Update';

                      else

                      $hotel_actiontype = 'AddNew';



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

                      <ResourceDetailsData srno="1" actiontype="' . $hotel_actiontype . '">

                      <Id>' . $Id . '</Id>

                      <HotelCode><![CDATA[' . $hotel_code . ']]></HotelCode>

                      <HotelName><![CDATA[' . $HotelName . ']]></HotelName>

                      <SupplierCode><![CDATA[' . $SupplierCode . ']]></SupplierCode>

                      <WtbStatus>false</WtbStatus>

                      <Active>' . $Active . '</Active>

                      <Excluded>' . $Excluded . '</Excluded>

                      <ContinentId>' . $ContinentId . '</ContinentId>

                      <ContinentCode>NA</ContinentCode>

                      <ContinentName><![CDATA[' . $ContinentName . ']]></ContinentName>

                      <CountryId>' . $CountryId . '</CountryId>

                      <CountryCode><![CDATA[' . $country_code . ']]></CountryCode>

                      <CountryName><![CDATA[' . $CountryName . ']]></CountryName>

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



                      $log_call_screen = 'Hotel Mapping - ' . $ACTIVE_MSG;

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

                      $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";

                      $this->TravelHotelRoomSupplier->updateAll(array('wtb_status' => "'1'", 'is_update' => "'Y'"), array('id' => $id));



                      } else {



                      $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];

                      $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID

                      $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";

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

                    $this->Session->setFlash('Unable to update Brand.', 'failure');

                }

            }

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

            $TravelCities = $this->TravelCity->find('list', array(

                'conditions' => array(

                    'TravelCity.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],

                    'TravelCity.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],

                    'TravelCity.city_status' => '1',

                    'TravelCity.wtb_status' => '1',

                    'TravelCity.active' => 'TRUE'

                ),

                'fields' => 'TravelCity.id, TravelCity.city_name',

                'order' => 'TravelCity.city_name ASC'

            ));

            

            $Provinces = $this->Province->find('list', array(

                'conditions' => array(

                    'Province.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],

                    'Province.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],

                    'Province.status' => '1',

                    'Province.wtb_status' => '1',

                    'Province.active' => 'TRUE'

                ),

                'fields' => array('Province.id', 'Province.name'),

                'order' => 'Province.name ASC'

            ));

        }



        $this->set(compact('TravelCities','Provinces'));



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

        $Types = array($type);

        //   pr($TravelBrands);

        $TravelBrands = array('1' => 'No Brand') + $TravelBrands;

        $this->set(compact('TravelBrands', 'Types'));



        $this->request->data = $TravelHotelLookups;

    }



    public function retry($id = null,$wtb_error_id = null) {



        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';

        $action_URL = 'http://www.travel.domain/ProcessXML';

        $user_id = $this->Auth->user('id');

        $TravelCountries = array();

        $TravelCities = array();

        $TravelSuburbs = array();

        $TravelAreas = array();

        $TravelBrands = array();

        $Provinces = array();

        $xml_error = 'FALSE';

        



        if (!$id) {

            throw new NotFoundException(__('Invalid Hotel'));

        }



        $TravelHotelLookups = $this->TravelHotelLookup->findById($id);

        //pr($TravelHotelLookups);



        if (!$TravelHotelLookups) {

            throw new NotFoundException(__('Invalid Hotel'));

        }



        if ($this->request->is('post') || $this->request->is('put')) {





            $HotelId = $id;

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





            $log_call_screen = 'Hotel - Re-try';



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

                    if($wtb_error_id)

                    $this->TravelWtbError->updateAll(array('TravelWtbError.fixed_by' => "'".$user_id."'", 'TravelWtbError.fixed_time' => "'".$this->Common->GetIndiaTime()."'", 'TravelWtbError.error_status' => "'2'"), array('TravelWtbError.id' => $wtb_error_id));

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

            $this->LogCall->save($this->request->data['LogCall']);

            $LogId = $this->LogCall->getLastInsertId();

            $message = 'Local record has been successfully updated.<br />' . $xml_msg;

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

                        $this->request->data['TravelHotelRoomSupplier']['hotel_chain_id'] = "'" . $ContinentId . "'";

                        $this->request->data['TravelHotelRoomSupplier']['hotel_chain_name'] = "'" . $ChainName . "'";

                        $this->request->data['TravelHotelRoomSupplier']['hotel_brand_id'] = "'" . $BrandId . "'";

                        $this->request->data['TravelHotelRoomSupplier']['hotel_brand_name'] = "'" . $BrandName . "'";

                        $this->request->data['TravelHotelRoomSupplier']['hotel_city_code'] = "'" . $CityCode . "'";

                        $this->request->data['TravelHotelRoomSupplier']['province_id'] = "'" . $ProvinceId . "'";

                        $this->request->data['TravelHotelRoomSupplier']['province_name'] = "'" . $ProvinceName . "'";

                        $this->request->data['TravelHotelRoomSupplier']['hotel_mapping_name'] = "'" . strtoupper('[SUPP/HOTEL] | ' . $val['TravelHotelRoomSupplier']['supplier_code'] . ' | ' . $CountryCode . ' | ' . $CityCode . ' | ' . $val['TravelHotelRoomSupplier']['hotel_code'] . ' - ' . $HotelName) . "'";



                        $this->TravelHotelRoomSupplier->updateAll($this->request->data['TravelHotelRoomSupplier'], array('TravelHotelRoomSupplier.id' => $Id));







                        $country_code = trim($CountryCode);

                        $hotel_code = trim($val['TravelHotelRoomSupplier']['hotel_code']);

                        $city_code = trim($CityCode);

                        $SupplierCode = $val['TravelHotelRoomSupplier']['supplier_code'];

                        $Active = strtolower($val['TravelHotelRoomSupplier']['active']);

                        $Excluded = strtolower($val['TravelHotelRoomSupplier']['excluded']);

                        $hotel_supplier_status = $val['TravelHotelRoomSupplier']['hotel_supplier_status'];

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



                        if($is_update == 'Y' && $hotel_supplier_status == '2'){

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

                                                                <WtbStatus><![CDATA[' . $WtbStatus . ']]></WtbStatus>

                                                                <Active><![CDATA[' . $Active . ']]></Active>

                                                                <Excluded><![CDATA[' . $Excluded . ']]></Excluded>

                                                                <ContinentId>' . $ContinentId . '</ContinentId>

                                                                <ContinentCode>NA</ContinentCode>

                                                                <ContinentName><![CDATA[' . $ContinentName . ']]></ContinentName>                              

                                                                <CountryId>' . $CountryId . '</CountryId>

                                                                <CountryCode><![CDATA[' . $country_code . ']]></CountryCode>

                                                                <CountryName><![CDATA[' . $CountryName . ']]></CountryName>

                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>

                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>

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



                        $log_call_screen = 'Hotel Mapping - Re-try';

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

                                $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";

                                $this->TravelHotelRoomSupplier->updateAll(array('wtb_status' => "'1'", 'is_update' => "'Y'"), array('id' => $id));

                            } else {



                                $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];

                                $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID

                                $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";

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

                        }

                    }

                }

            }

            */

            $this->Session->setFlash($message, 'success');

            if($wtb_error_id)

                $this->redirect(array('controller' => 'travel_wtb_errors','action' => 'index'));

            else

            $this->redirect(array('action' => 'index'));

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

            $TravelCities = $this->TravelCity->find('list', array(

                'conditions' => array(

                    'TravelCity.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],

                    'TravelCity.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],

                    'TravelCity.city_status' => '1',

                    'TravelCity.wtb_status' => '1',

                    'TravelCity.active' => 'TRUE'

                ),

                'fields' => 'TravelCity.id, TravelCity.city_name',

                'order' => 'TravelCity.city_name ASC'

            ));

            

            $Provinces = $this->Province->find('list', array(

                'conditions' => array(

                    'Province.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],

                    'Province.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],

                    'Province.status' => '1',

                    'Province.wtb_status' => '1',

                    'Province.active' => 'TRUE'

                ),

                'fields' => array('Province.id', 'Province.name'),

                'order' => 'Province.name ASC'

            ));

        }



        $this->set(compact('TravelCities','Provinces'));



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

        //   pr($TravelBrands);

        $TravelBrands = array('1' => 'No Brand') + $TravelBrands;

        $this->set(compact('TravelBrands'));



        $this->request->data = $TravelHotelLookups;

    }

    

        

    public function view_mapping($hotel_id = null){

        $this->layout = '';

        $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->find('all',array( 'conditions' => array('TravelHotelRoomSupplier.hotel_id' => $hotel_id)));

     

        $this->set(compact('TravelHotelRoomSuppliers','hotel_id'));

    }

    

    public function view_supplier_mapping($hotel_supplier_id = null){

        $this->layout = '';

        $TravelHotelRoomSuppliers = $this->TravelHotelRoomSupplier->find('all',array( 'conditions' => array('TravelHotelRoomSupplier.hotel_supplier_id' => $hotel_supplier_id)));

     

        $this->set(compact('TravelHotelRoomSuppliers','hotel_supplier_id'));

    }

    

    public function view_city_mapping($supplier_id = null,$city_id = null){

        $this->layout = '';

        $TravelCitySuppliers = $this->TravelCitySupplier->find('all',array( 'conditions' => array('TravelCitySupplier.supplier_id' => $supplier_id,'TravelCitySupplier.city_id' => $city_id)));

     

        $this->set(compact('TravelCitySuppliers'));

    }

    

    public function hotel_edit($id = null){

        

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';

        $action_URL = 'http://www.travel.domain/ProcessXML';

        $user_id = $this->Auth->user('id');

        $TravelCountries = array();

        $TravelCities = array();

        $TravelSuburbs = array();

        $TravelAreas = array();

        $TravelBrands = array();

        

        if (!$id) {

            throw new NotFoundException(__('Invalid Hotel'));

        }



        $TravelHotelLookups = $this->TravelHotelLookup->findById($id);



        if (!$TravelHotelLookups) {

            throw new NotFoundException(__('Invalid Hotel'));

        }



        if ($this->request->is('post') || $this->request->is('put')) {

            $this->request->data['TravelHotelLookup']['wtb_status'] = '1';

            //$this->request->data['TravelHotelLookup']['active'] = 'TRUE';

            $HotelId = $id;

            $HotelCode = $this->data['TravelHotelLookup']['hotel_code'];

            $HotelName = $this->data['TravelHotelLookup']['hotel_name'];

            $AreaId = $this->data['TravelHotelLookup']['area_id'];

           // $AreaCode = $this->data['TravelHotelLookup']['area_code'];

            



            $AreaName = $this->data['TravelHotelLookup']['area_name'];

            

            $SuburbId = $this->data['TravelHotelLookup']['suburb_id'];

           

            $SuburbName = $this->data['TravelHotelLookup']['suburb_name'];



            $CityId = $this->data['TravelHotelLookup']['city_id'];

           

            $CityName = $this->data['TravelHotelLookup']['city_name'];

            $CityCode = $this->data['TravelHotelLookup']['city_code'];

            $CountryId = $this->data['TravelHotelLookup']['country_id'];

            $CountryName = $this->data['TravelHotelLookup']['country_name'];

            $CountryCode = $this->data['TravelHotelLookup']['country_code'];

            $ContinentId = $this->data['TravelHotelLookup']['continent_id'];

            $ContinentName = $this->data['TravelHotelLookup']['continent_name'];

            $ContinentCode = $this->data['TravelHotelLookup']['continent_code'];

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

            $Address = $this->data['TravelHotelLookup']['address'];

            $PostCode = $TravelHotelLookups['TravelHotelLookup']['post_code'];

            $NoRoom = $TravelHotelLookups['TravelHotelLookup']['no_room'];

            $Active = $this->data['TravelHotelLookup']['active'];

            if ($Active == 'TRUE')

                $Active = '1';

            else

                $Active = '0';

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
                        
            $ReservationEmail = $TravelHotelLookups['TravelHotelLookup']['reservation_email'];

            $ReservationContact = $TravelHotelLookups['TravelHotelLookup']['reservation_contact'];

            $EmergencyContactName = $TravelHotelLookups['TravelHotelLookup']['emergency_contact_name'];

            $ReservationDeskNumber = $TravelHotelLookups['TravelHotelLookup']['reservation_desk_number'];

            $EmergencyContactNumber = $TravelHotelLookups['TravelHotelLookup']['emergency_contact_number'];

            $GPSPARAM1 = $TravelHotelLookups['TravelHotelLookup']['gps_prm_1'];

            $GPSPARAM2 = $TravelHotelLookups['TravelHotelLookup']['gps_prm_2'];

            $ProvinceId = $this->data['TravelHotelLookup']['province_id'];

            $ProvinceName = $this->data['TravelHotelLookup']['province_name'];

            $TopHotel = strtolower($TravelHotelLookups['TravelHotelLookup']['top_hotel']);

            $PropertyType = $TravelHotelLookups['TravelHotelLookup']['property_type'];

            $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');



            $is_update = $TravelHotelLookups['TravelHotelLookup']['is_updated'];

            if ($is_update == 'Y')

                $actiontype = 'Update';

            else

                $actiontype = 'AddNew';

          

            

            $this->TravelHotelLookup->id = $id;

            $this->TravelHotelLookup->save($this->request->data['TravelHotelLookup']); 

              

            

            

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





            $log_call_screen = 'Edit - Hotel';



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

            $this->LogCall->save($this->request->data['LogCall']);

            $LogId = $this->LogCall->getLastInsertId();

            $message = 'Local record has been successfully updated.<br />' . $xml_msg;

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



            /*

            $xml_error = 'FALSE';

            

            

            

            $arrs = $this->TravelHotelRoomSupplier->find('all', array('conditions' => array('TravelHotelRoomSupplier.hotel_id' => $id)));

                    if (count($arrs) > 0) {

                        $HotelCode = $this->data['TravelHotelLookup']['hotel_code'];

                        $HotelName = $this->data['TravelHotelLookup']['hotel_name'];

                        $AreaId = $this->data['TravelHotelLookup']['area_id'];

                        $AreaName = $this->data['TravelHotelLookup']['area_name'];

                        $SuburbId = $this->data['TravelHotelLookup']['suburb_id'];

                        $SuburbName = $this->data['TravelHotelLookup']['suburb_name'];

                        $CityId = $this->data['TravelHotelLookup']['city_id'];

                        $CityName = $this->data['TravelHotelLookup']['city_name'];

                        $CountryId = $this->data['TravelHotelLookup']['country_id'];

                        $CountryCode = $this->data['TravelHotelLookup']['country_code'];

                        $CountryName = $this->data['TravelHotelLookup']['country_name'];

                        $ContinentId = $this->data['TravelHotelLookup']['continent_id'];

                        $ContinentName = $this->data['TravelHotelLookup']['continent_name'];

                        $ProvinceId = $this->data['TravelHotelLookup']['province_id'];

                        $provinceName = $this->data['TravelHotelLookup']['province_name'];

                        $ChainId = $this->data['TravelHotelLookup']['chain_id'];

                        $ChainName = $this->data['TravelHotelLookup']['chain_name'];                        

                        $BrandId = $this->data['TravelHotelLookup']['brand_id'];

                        $BrandName = $this->data['TravelHotelLookup']['brand_name'];

                        $CityCode = $this->data['TravelHotelLookup']['city_code'];

                        

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

                            $this->request->data['TravelHotelRoomSupplier']['province_id'] = "'" . $ProvinceId . "'";

                            $this->request->data['TravelHotelRoomSupplier']['province_name'] = "'" . $provinceName . "'";

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

                        $Active = strtolower($val['TravelHotelRoomSupplier']['active']);

                        $Excluded = strtolower($val['TravelHotelRoomSupplier']['excluded']);

                        $hotel_supplier_status = $val['TravelHotelRoomSupplier']['hotel_supplier_status'];

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



                        if($is_update == 'Y' && $hotel_supplier_status == '2'){

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

                                                                <WtbStatus><![CDATA[' . $WtbStatus . ']]></WtbStatus>

                                                                <Active><![CDATA[' . $Active . ']]></Active>

                                                                <Excluded><![CDATA[' . $Excluded . ']]></Excluded>

                                                                <ContinentId>' . $ContinentId . '</ContinentId>

                                                                <ContinentCode>NA</ContinentCode>

                                                                <ContinentName><![CDATA[' . $ContinentName . ']]></ContinentName>                              

                                                                <CountryId>' . $CountryId . '</CountryId>

                                                                <CountryCode><![CDATA[' . $country_code . ']]></CountryCode>

                                                                <CountryName><![CDATA[' . $CountryName . ']]></CountryName>

                                                                <ProvinceId>'.$ProvinceId.'</ProvinceId>

                                                                <ProvinceName><![CDATA['.$ProvinceName.']]></ProvinceName>

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

                                $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";

                                $this->TravelHotelRoomSupplier->updateAll(array('wtb_status' => "'1'", 'is_update' => "'Y'"), array('id' => $id));

                            } else {



                                $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];

                                $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT'][$RESOURCEDATA]['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID

                                $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";

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

                        }

                            

                            

                            

                        }

                }

                */

                $this->Session->setFlash($xml_msg.'<br> Local record has been successfully updated.', 'success');

               

                

                //$this->Session->setFlash('Local record has been successfully updated.', 'success');

                //$this->redirect(array('reports/hotel_summary?city_id='.$CityId));

//                $this->redirect(array('controller' => 'reports', 'action' => 'hotel_summary'));
         return $this->redirect(array('controller' => 'reports', 'action' => 'support_hotel_summary/id:'.$id));                  
                

        }

        

        $TravelLookupContinents = $this->TravelLookupContinent->find('all', array('fields' => array('TravelLookupContinent.id','TravelLookupContinent.continent_name','TravelLookupContinent.continent_code'), 'conditions' => array('TravelLookupContinent.continent_status' => 1, 'TravelLookupContinent.wtb_status' => 1), 'order' => 'TravelLookupContinent.continent_name ASC'));

        $TravelLookupContinents = Set::combine($TravelLookupContinents, '{n}.TravelLookupContinent.id', array('%s - %s', '{n}.TravelLookupContinent.continent_code', '{n}.TravelLookupContinent.continent_name'));



        $TravelChains = $this->TravelChain->find('list', array('fields' => 'id,chain_name', 'conditions' => array('chain_status' => 1, 'wtb_status' => 1, 'chain_active' => 'TRUE', array('NOT' => array('id' => 1))), 'order' => 'chain_name ASC'));

        $TravelChains = array('1' => 'No Chain') + $TravelChains;

        $this->set(compact('TravelChains'));



        if ($TravelHotelLookups['TravelHotelLookup']['continent_id']) {

            $TravelCountries = $this->TravelCountry->find('all', array(

                'conditions' => array(

                    'TravelCountry.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],

                                       

                ),

                'fields' => array('TravelCountry.id', 'TravelCountry.country_name', 'TravelCountry.country_code'),

                'order' => 'TravelCountry.country_name ASC'

            ));

            

            $TravelCountries = Set::combine($TravelCountries, '{n}.TravelCountry.id', array('%s - %s', '{n}.TravelCountry.country_code', '{n}.TravelCountry.country_name'));

        }





  

            $TravelCities = $this->TravelCity->find('all', array(

                'conditions' => array(

                    'TravelCity.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],

                    //'TravelCity.continent_id' => $TravelHotelLookups['TravelHotelLookup']['continent_id'],                    

                ),

                'fields' => array('TravelCity.id', 'TravelCity.city_name', 'TravelCity.city_code'),

                'order' => 'TravelCity.city_name ASC'

            ));

            $TravelCities = Set::combine($TravelCities, '{n}.TravelCity.id', array('%s - %s', '{n}.TravelCity.city_code', '{n}.TravelCity.city_name'));

            

            $Provinces = $this->Province->find('list', array(

                'conditions' => array(

                    'Province.country_id' => $TravelHotelLookups['TravelHotelLookup']['country_id'],

                    'Province.status' => '1',

                    'Province.wtb_status' => '1',

                    'Province.active' => 'TRUE'

                ),

                'fields' => array('Province.id', 'Province.name'),

                'order' => 'Province.name ASC'

            ));

     

        

        





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

        $TravelLookupPropertyTypes = $this->TravelLookupPropertyType->find('list', array('fields' => 'id,value','order' => 'value ASC'));

        $TravelLookupRateTypes = $this->TravelLookupRateType->find('list', array('fields' => 'id,value','order' => 'value ASC'));

       

        $this->set(compact('TravelBrands','TravelAreas','TravelSuburbs','TravelCities','TravelCountries','Provinces','TravelLookupContinents','TravelLookupPropertyTypes','TravelLookupRateTypes'));

        

        $this->request->data = $TravelHotelLookups;

    }

    

    function delete($id = null) {

        

        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';

        $action_URL = 'http://www.travel.domain/ProcessXML';

        $user_id = $this->Auth->user('id');

        $log_call_screen = '';

        $xml_msg = '';

        $xml_error = 'FALSE';

        $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

        

        $TravelHotelLookups = $this->TravelHotelLookup->findById($id);



            $this->request->data['DeleteTravelHotelLookup']['id'] = $TravelHotelLookups['TravelHotelLookup']['id'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_code'] = $TravelHotelLookups['TravelHotelLookup']['hotel_code'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_name'] = $TravelHotelLookups['TravelHotelLookup']['hotel_name'];

            $this->request->data['DeleteTravelHotelLookup']['area_id'] = $TravelHotelLookups['TravelHotelLookup']['area_id'];

            $this->request->data['DeleteTravelHotelLookup']['area_name'] = $TravelHotelLookups['TravelHotelLookup']['area_name'];

            $this->request->data['DeleteTravelHotelLookup']['area_code'] = $TravelHotelLookups['TravelHotelLookup']['area_code'];

            $this->request->data['DeleteTravelHotelLookup']['suburb_id'] = $TravelHotelLookups['TravelHotelLookup']['suburb_id'];

            $this->request->data['DeleteTravelHotelLookup']['suburb_name'] = $TravelHotelLookups['TravelHotelLookup']['suburb_name'];

            $this->request->data['DeleteTravelHotelLookup']['city_id'] = $TravelHotelLookups['TravelHotelLookup']['city_id'];

            $this->request->data['DeleteTravelHotelLookup']['city_name'] = $TravelHotelLookups['TravelHotelLookup']['city_name'];

            $this->request->data['DeleteTravelHotelLookup']['city_code'] = $TravelHotelLookups['TravelHotelLookup']['city_code'];

            $this->request->data['DeleteTravelHotelLookup']['country_id'] = $TravelHotelLookups['TravelHotelLookup']['country_id'];

            $this->request->data['DeleteTravelHotelLookup']['country_name'] = $TravelHotelLookups['TravelHotelLookup']['country_name'];

            $this->request->data['DeleteTravelHotelLookup']['country_code'] = $TravelHotelLookups['TravelHotelLookup']['country_code'];

            $this->request->data['DeleteTravelHotelLookup']['continent_id'] = $TravelHotelLookups['TravelHotelLookup']['continent_id'];

            $this->request->data['DeleteTravelHotelLookup']['continent_name'] = $TravelHotelLookups['TravelHotelLookup']['continent_name'];

            $this->request->data['DeleteTravelHotelLookup']['continent_code'] = $TravelHotelLookups['TravelHotelLookup']['continent_code'];

            $this->request->data['DeleteTravelHotelLookup']['brand_id'] = $TravelHotelLookups['TravelHotelLookup']['brand_id'];

            $this->request->data['DeleteTravelHotelLookup']['brand_name'] = $TravelHotelLookups['TravelHotelLookup']['brand_name'];

            $this->request->data['DeleteTravelHotelLookup']['chain_id'] = $TravelHotelLookups['TravelHotelLookup']['chain_id'];

            $this->request->data['DeleteTravelHotelLookup']['chain_name'] = $TravelHotelLookups['TravelHotelLookup']['chain_name'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_comment'] = $TravelHotelLookups['TravelHotelLookup']['hotel_comment'];

            $this->request->data['DeleteTravelHotelLookup']['star'] = $TravelHotelLookups['TravelHotelLookup']['star'];

            $this->request->data['DeleteTravelHotelLookup']['keyword'] = $TravelHotelLookups['TravelHotelLookup']['keyword'];

            $this->request->data['DeleteTravelHotelLookup']['standard_rating'] = $TravelHotelLookups['TravelHotelLookup']['standard_rating'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_rating'] = $TravelHotelLookups['TravelHotelLookup']['hotel_rating'];

            $this->request->data['DeleteTravelHotelLookup']['food_rating'] = $TravelHotelLookups['TravelHotelLookup']['food_rating'];

            $this->request->data['DeleteTravelHotelLookup']['service_rating'] = $TravelHotelLookups['TravelHotelLookup']['service_rating'];

            $this->request->data['DeleteTravelHotelLookup']['location_rating'] = $TravelHotelLookups['TravelHotelLookup']['location_rating'];

            $this->request->data['DeleteTravelHotelLookup']['value_rating'] = $TravelHotelLookups['TravelHotelLookup']['value_rating'];

            $this->request->data['DeleteTravelHotelLookup']['overall_rating'] = $TravelHotelLookups['TravelHotelLookup']['overall_rating'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img1'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img1'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img2'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img2'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img3'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img3'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img4'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img4'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img5'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img5'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img6'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img6'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img7'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img7'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img8'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img8'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img9'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img9'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img10'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img10'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img11'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img11'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img12'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img12'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img13'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img13'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img14'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img14'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img15'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img15'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img16'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img16'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img17'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img17'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img18'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img18'];
            
            $this->request->data['DeleteTravelHotelLookup']['hotel_img19'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img19'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_img20'] = $TravelHotelLookups['TravelHotelLookup']['hotel_img20'];
            
            $this->request->data['DeleteTravelHotelLookup']['thumb_img1'] = $TravelHotelLookups['TravelHotelLookup']['thumb_img1'];

            $this->request->data['DeleteTravelHotelLookup']['thumb_img2'] = $TravelHotelLookups['TravelHotelLookup']['thumb_img2'];
            
            $this->request->data['DeleteTravelHotelLookup']['is_image'] = $TravelHotelLookups['TravelHotelLookup']['is_image'];

            $this->request->data['DeleteTravelHotelLookup']['is_page'] = $TravelHotelLookups['TravelHotelLookup']['is_page'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_former_name'] = $TravelHotelLookups['TravelHotelLookup']['hotel_former_name'];

            $this->request->data['DeleteTravelHotelLookup']['hotel_display_name'] = $TravelHotelLookups['TravelHotelLookup']['hotel_display_name'];
            
            $this->request->data['DeleteTravelHotelLookup']['logo'] = $TravelHotelLookups['TravelHotelLookup']['logo'];

            $this->request->data['DeleteTravelHotelLookup']['logo1'] = $TravelHotelLookups['TravelHotelLookup']['logo1'];

            $this->request->data['DeleteTravelHotelLookup']['business_center'] = $TravelHotelLookups['TravelHotelLookup']['business_center'];

            $this->request->data['DeleteTravelHotelLookup']['meeting_facilities'] = $TravelHotelLookups['TravelHotelLookup']['meeting_facilities'];

            $this->request->data['DeleteTravelHotelLookup']['dining_facilities'] = $TravelHotelLookups['TravelHotelLookup']['dining_facilities'];

            $this->request->data['DeleteTravelHotelLookup']['bar_lounge'] = $TravelHotelLookups['TravelHotelLookup']['bar_lounge'];

            $this->request->data['DeleteTravelHotelLookup']['fitness_center'] = $TravelHotelLookups['TravelHotelLookup']['fitness_center'];

            $this->request->data['DeleteTravelHotelLookup']['pool'] = $TravelHotelLookups['TravelHotelLookup']['pool'];

            $this->request->data['DeleteTravelHotelLookup']['golf'] = $TravelHotelLookups['TravelHotelLookup']['golf'];

            $this->request->data['DeleteTravelHotelLookup']['tennis'] = $TravelHotelLookups['TravelHotelLookup']['tennis'];

            $this->request->data['DeleteTravelHotelLookup']['kids'] = $TravelHotelLookups['TravelHotelLookup']['kids'];

            $this->request->data['DeleteTravelHotelLookup']['handicap'] = $TravelHotelLookups['TravelHotelLookup']['handicap'];

            $this->request->data['DeleteTravelHotelLookup']['url_hotel'] = $TravelHotelLookups['TravelHotelLookup']['url_hotel'];

            $this->request->data['DeleteTravelHotelLookup']['address'] = $TravelHotelLookups['TravelHotelLookup']['address'];

            $this->request->data['DeleteTravelHotelLookup']['post_code'] = $TravelHotelLookups['TravelHotelLookup']['post_code'];

            $this->request->data['DeleteTravelHotelLookup']['no_room'] = $TravelHotelLookups['TravelHotelLookup']['no_room'];

            $this->request->data['DeleteTravelHotelLookup']['active'] = $TravelHotelLookups['TravelHotelLookup']['active'];

            $this->request->data['DeleteTravelHotelLookup']['reservation_email'] = $TravelHotelLookups['TravelHotelLookup']['reservation_email'];

            $this->request->data['DeleteTravelHotelLookup']['reservation_contact'] = $TravelHotelLookups['TravelHotelLookup']['reservation_contact'];

            $this->request->data['DeleteTravelHotelLookup']['emergency_contact_name'] = $TravelHotelLookups['TravelHotelLookup']['emergency_contact_name'];

            $this->request->data['DeleteTravelHotelLookup']['reservation_desk_number'] = $TravelHotelLookups['TravelHotelLookup']['reservation_desk_number'];

            $this->request->data['DeleteTravelHotelLookup']['emergency_contact_number'] = $TravelHotelLookups['TravelHotelLookup']['emergency_contact_number'];

            $this->request->data['DeleteTravelHotelLookup']['gps_prm_1'] = $TravelHotelLookups['TravelHotelLookup']['gps_prm_1'];

            $this->request->data['DeleteTravelHotelLookup']['gps_prm_2'] = $TravelHotelLookups['TravelHotelLookup']['gps_prm_2'];

            $this->request->data['DeleteTravelHotelLookup']['province_id'] = $TravelHotelLookups['TravelHotelLookup']['province_id'];

            $this->request->data['DeleteTravelHotelLookup']['province_name'] = $TravelHotelLookups['TravelHotelLookup']['province_name'];

            $this->request->data['DeleteTravelHotelLookup']['top_hotel'] = $TravelHotelLookups['TravelHotelLookup']['top_hotel'];

            $this->request->data['DeleteTravelHotelLookup']['is_updated'] = $TravelHotelLookups['TravelHotelLookup']['is_updated'];

            $this->request->data['DeleteTravelHotelLookup']['approved_by'] = $TravelHotelLookups['TravelHotelLookup']['approved_by'];

            $this->request->data['DeleteTravelHotelLookup']['approved_date'] = $TravelHotelLookups['TravelHotelLookup']['approved_date'];

            $this->request->data['DeleteTravelHotelLookup']['created_by'] = $TravelHotelLookups['TravelHotelLookup']['created_by'];

            $this->request->data['DeleteTravelHotelLookup']['created'] = $TravelHotelLookups['TravelHotelLookup']['created'];

            $this->request->data['DeleteTravelHotelLookup']['modified'] = $TravelHotelLookups['TravelHotelLookup']['modified'];



            



        if ($this->TravelHotelLookup->delete($id)) {

            

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

                                                    <ResourceDetailsData srno="1" lookuptype="Hotel">

                                                      <HotelId>'.$id.'</HotelId>            

                                                  </ResourceDetailsData>

                                                  </ResourceData>

                                                </RequestParameters>

                                              </ResourceDataRequest>

                                            </RequestInfo>

                                          </ProcessXML>

                                    </soap:Body>';





                $log_call_screen = 'Delete - Hotel';



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

                   

                    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {

                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];

                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];

                        $xml_msg = "Foreign record has been successfully deleted [Code:$log_call_status_code]";

                        

                    } else {



                        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];

                        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_LOOKUPDELETE']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID

                        $xml_msg = "There was a problem with foreign record deletion [Code:$log_call_status_code]";

                        

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

                $message = 'Local record has been successfully deleted.<br />' . $xml_msg;

                

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

             $this->request->data['DeleteLogTable']['ip_address'] = $_SERVER['REMOTE_ADDR'];

            $this->request->data['DeleteLogTable']['created_by'] = $user_id;

            $this->DeleteLogTable->save($this->request->data['DeleteLogTable']);

            $LogId = $this->DeleteLogTable->getLastInsertId();

            $this->request->data['DeleteTravelHotelLookup']['log_id'] = $LogId;

            $this->DeleteTravelHotelLookup->create();

            $this->DeleteTravelHotelLookup->save($this->request->data['DeleteTravelHotelLookup']);

            $this->Session->setFlash($message, 'success');

            

            //$this->Session->setFlash('Local record has been successfully deleted.', 'success');

            

            //$this->redirect(array('action' => 'index'));

        } else {

            $this->Session->setFlash('Unable to delete Hotel.', 'failure');

            //$this->redirect(array('action' => 'index'));

        }

//        return $this->redirect(array('controller' => 'reports', 'action' => 'hotel_summary'));

          return $this->redirect(array('controller' => 'reports', 'action' => 'support_hotel_summary/id:'.$id));        

    }



}




