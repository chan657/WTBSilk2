<?php
/**
 * Custom Helper 
 *
 * For custom theme specific methods.
 *
 * If your theme requires custom methods,
 * copy this file to /app/views/themed/your_theme_alias/helpers/custom.php and modify.
 *
 * You can then use this helper from your theme's views using $custom variable.
 *
 * @category Helper
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
 App::uses('Helper', 'View');
 
class CustomHelper extends Helper {

/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */
    public $helpers = array();
    
    public function GetUserStatus($user_id = null)
    {
        $user_status = ClassRegistry::init('User')->find('first', array('conditions'=>array('User.id'=>$user_id),'fields'=>array('User.status')));
  	if($user_status['User']['status'] == 't') 
		{ 
			echo "Active"; 
		}else{
			echo "Deactive";
		};
    }
    
     public function alreadyExists($data, $table, $field){
        return ClassRegistry::init($table)->find('count', array('fields' => $table.'.id','conditions' => array($table.'.'.$field => $data)));
    }
    
    public function getSupplierName($supplier_id){
        $DataArray = ClassRegistry::init('TravelSupplier')->find('first', array('fields' => array('supplier_name'), 'conditions' => array('TravelSupplier.id' => $supplier_id)));
        return $DataArray['TravelSupplier']['supplier_name'];
    }
    public function getSupplierCode($supplier_id){
        $DataArray = ClassRegistry::init('TravelSupplier')->find('first', array('fields' => array('supplier_code'), 'conditions' => array('TravelSupplier.id' => $supplier_id)));
        return $DataArray['TravelSupplier']['supplier_code'];
    }
    public function getSupplierCountryName($country_id){
        $DataArray = ClassRegistry::init('SupplierCountry')->find('first', array('fields' => array('name'), 'conditions' => array('SupplierCountry.id' => $country_id)));
        return $DataArray['SupplierCountry']['name'];
    }
    
    public function getSupplierCityName($city_id){
        $DataArray = ClassRegistry::init('SupplierCity')->find('first', array('fields' => array('name'), 'conditions' => array('SupplierCity.id' => $city_id)));
        return $DataArray['SupplierCity']['name'];
    }

    public function getWTBErrorHotalReview($hotel_id){
        $DataArray = ClassRegistry::init('TravelWtbError')->find('count', array('conditions' => array('TravelWtbError.error_entity' => $hotel_id, 'TravelWtbError.error_type'=>13, 'TravelWtbError.error_status'=>1)));
        return $DataArray;
    }
    
    public function getSupplierCountryNameByCode($country_code){
        $DataArray = ClassRegistry::init('SupplierCountry')->find('first', array('fields' => array('name'), 'conditions' => array('SupplierCountry.code' => $country_code)));
        return $DataArray['SupplierCountry']['name'];
    }
    
    public function getSupplierCityNameByCode($city_code){
        $DataArray = ClassRegistry::init('SupplierCity')->find('first', array('fields' => array('name'), 'conditions' => array('SupplierCity.code' => $city_code)));
        return $DataArray['SupplierCity']['name'];
    }
    
    public function Hello(){
        return 'Hello';
    }
    
    public function Username($user_id) {
        $user = ClassRegistry::init('User')->find('first', array('fields' => array('fname', 'mname', 'lname'), 'conditions' => array('User.id' => $user_id)));
      //  return $user['User']['fname'] . ' ' . $user['User']['mname'] . ' ' . $user['User']['lname'];
	 $f_short =  substr($user['User']['fname'], 0, 1);
	  return $f_short.'.' .  ' ' . $user['User']['lname'];
    }
    
    public function getContinentName($continent_id) {
        $DataArray = ClassRegistry::init('TravelLookupContinent')->find('first', array('fields' => array('continent_name'), 'conditions' => array('TravelLookupContinent.id' => $continent_id)));
        return $DataArray['TravelLookupContinent']['continent_name'];
    }
    public function getCountryName($country_id) {
        $DataArray = ClassRegistry::init('TravelCountry')->find('first', array('fields' => array('country_name'), 'conditions' => array('TravelCountry.id' => $country_id)));
        return $DataArray['TravelCountry']['country_name'];
    }
    
    public function getProvinceName($province_id) {
        $DataArray = ClassRegistry::init('Province')->find('first', array('fields' => array('name'), 'conditions' => array('Province.id' => $province_id)));
        return $DataArray['Province']['name'];
    }
    
    public function getCitytName($city_id) {
        $DataArray = ClassRegistry::init('TravelCity')->find('first', array('fields' => array('city_name'), 'conditions' => array('TravelCity.id' => $city_id)));
        return $DataArray['TravelCity']['city_name'];
    }
    
    public function getSuburbName($suburb_id) {
        $DataArray = ClassRegistry::init('TravelSuburb')->find('first', array('fields' => array('name'), 'conditions' => array('TravelSuburb.id' => $suburb_id)));
        return $DataArray['TravelSuburb']['name'];
    }
    
    public function getAreaName($area_id) {
        $DataArray = ClassRegistry::init('TravelArea')->find('first', array('fields' => array('area_name'), 'conditions' => array('TravelArea.id' => $area_id)));
        return $DataArray['TravelArea']['area_name'];
    }
    
    public function getChainName($chain_id) {
        $DataArray = ClassRegistry::init('TravelChain')->find('first', array('fields' => array('chain_name'), 'conditions' => array('TravelChain.id' => $chain_id)));
        return $DataArray['TravelChain']['chain_name'];
    }
    
    public function getBrandName($brand_id) {
        $DataArray = ClassRegistry::init('TravelBrand')->find('first', array('fields' => array('brand_name'), 'conditions' => array('TravelBrand.id' => $brand_id)));
        return $DataArray['TravelBrand']['brand_name'];
    }
    
    public function getHotelName($hotel_id) {
        $DataArray = ClassRegistry::init('TravelHotelLookup')->find('first', array('fields' => array('hotel_name'), 'conditions' => array('TravelHotelLookup.id' => $hotel_id)));
        return $DataArray['TravelHotelLookup']['hotel_name'];
    }
    
    public function getHotelMappingName($hotel_mapping_id) {
        $DataArray = ClassRegistry::init('TravelHotelRoomSupplier')->find('first', array('fields' => array('hotel_mapping_name'), 'conditions' => array('TravelHotelRoomSupplier.id' => $hotel_mapping_id)));
        return $DataArray['TravelHotelRoomSupplier']['hotel_mapping_name'];
    }
    
    public function getCountryMappingName($country_mapping_id) {
        $DataArray = ClassRegistry::init('TravelCountrySupplier')->find('first', array('fields' => array('country_mapping_name'), 'conditions' => array('TravelCountrySupplier.id' => $country_mapping_id)));
        return $DataArray['TravelCountrySupplier']['country_mapping_name'];
    }
    
    public function getCityMappingName($city_mapping_id) {
        $DataArray = ClassRegistry::init('TravelCitySupplier')->find('first', array('fields' => array('city_mapping_name'), 'conditions' => array('TravelCitySupplier.id' => $hotel_mapping_id)));
        return $DataArray['TravelCitySupplier']['city_mapping_name'];
    }
    
   
    
    
   public function ConvertGMTToLocalTimezone($gmttime, $timezoneRequired) {
        $system_timezone = date_default_timezone_get();

        date_default_timezone_set("GMT");
        $gmt = date("Y-m-d h:i:s A");

        $local_timezone = $timezoneRequired;
        date_default_timezone_set($local_timezone);
        $local = date("Y-m-d h:i:s A");

        date_default_timezone_set($system_timezone);
        //$diff = (strtotime($local) - strtotime($gmt));
        $diff = 41400;
        $date = new DateTime($gmttime);
        $date->modify("+$diff seconds");
        $timestamp = $date->format("m-d-Y H:i:s");
        return $timestamp;
    }
    
    public function after_last($pattern, $inthat)
    {
        if (!is_bool($this->strrevpos($inthat, $pattern)))
        return substr($inthat, $this->strrevpos($inthat, $pattern)+strlen($pattern));
    }
    public function strrevpos($instr, $needle)
    {
        $rev_pos = strpos (strrev($instr), strrev($needle));
        if ($rev_pos===false) return false;
        else return strlen($instr) - $rev_pos - strlen($needle);
    } 
    
    public function getMissmatchHotelCount($country_id,$city_id){
        ClassRegistry::init('TravelHotelLookup')->find('all', array('fields' => array('id'),'conditions' => array('TravelHotelLookup.country_id' => $country_id)));
        return $DataArray['TravelHotelLookup'];
    }

    public function getHotalName($hotal_id){
        $DataArray = ClassRegistry::init('TravelHotelLookup')->find('first', array('fields' => array('hotel_name'),'conditions' => array('TravelHotelLookup.id' => $hotal_id)));
        return $DataArray['TravelHotelLookup']['hotel_name'];
    }
    public function getHotelNameSupplier($hotel_id){
        $DataArray = ClassRegistry::init('SupplierHotel')->find('first', array('fields' => array('hotel_name'),'conditions' => array('SupplierHotel.id' => $hotel_id)));
        return $DataArray['SupplierHotel']['hotel_name'];
    }
    public function getCityNameSupplier($city_code){
        $DataArray = ClassRegistry::init('SupplierCity')->find('first', array('fields' => array('name'),'conditions' => array('SupplierCity.code' => $city_code)));
        return $DataArray['SupplierCity']['name'];
    }    
    public function getCityIdSupplier($city_code){
        $DataArray = ClassRegistry::init('SupplierCity')->find('first', array('fields' => array('id'),'conditions' => array('SupplierCity.code' => $city_code)));
        return $DataArray['SupplierCity']['id'];
    }        
    public function getCountryNameSupplier($country_code){
        $DataArray = ClassRegistry::init('SupplierCountry')->find('first', array('fields' => array('name'),'conditions' => array('SupplierCountry.code' => $country_code)));
        return $DataArray['SupplierCountry']['name'];
    }    
    public function getCountryIdSupplier($country_code){
        $DataArray = ClassRegistry::init('SupplierCountry')->find('first', array('fields' => array('id'),'conditions' => array('SupplierCountry.code' => $country_code)));
        return $DataArray['SupplierCountry']['id'];
    }
    public function getHotalAddress($hotal_id){
        $DataArray = ClassRegistry::init('TravelHotelLookup')->find('first', array('fields' => array('address'),'conditions' => array('TravelHotelLookup.id' => $hotal_id)));
        return $DataArray['TravelHotelLookup']['address']; 
    }    
    public function getHotelAddressSupplier($hotel_id){
        $DataArray = ClassRegistry::init('SupplierHotel')->find('first', array('fields' => array('address'),'conditions' => array('SupplierHotel.id' => $hotel_id)));
        return $DataArray['SupplierHotel']['address'];
    }
    public function getHotelUnallocatedCnt($country_id,$city_id){
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('id'),'conditions' => array('TravelHotelLookup.country_id' => $country_id,'TravelHotelLookup.city_id' => $city_id,'TravelHotelLookup.province_id' => '0')));
        //return $DataArray['TravelHotelLookup'];
    }
    
    public function getHotePendingCnt($country_id,$city_id,$province_id){
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('id'),
            'conditions' => array('TravelHotelLookup.country_id' => $country_id,
                                    'TravelHotelLookup.city_id' => $city_id,
                                    'TravelHotelLookup.province_id ' => $province_id,
                                    'TravelHotelLookup.suburb_id ' => '0',
                                    'TravelHotelLookup.area_id ' => '0',
                                    'TravelHotelLookup.chain_id ' => '0',
                                    'TravelHotelLookup.brand_id ' => '0',
                                    'TravelHotelLookup.status ' => '2',
                                    'TravelHotelLookup.active ' => 'TRUE',)));
        //return $DataArray['TravelHotelLookup'];
    }
 
	
	
	
	public function getHoteSubmittedCnt($get_country_id,$get_province_id,$get_city_id,$get_creator,$get_level_id,$get_supplier_id ){
		
        $search_condition = array()	;
        $result_array = ClassRegistry::init('TravelHotelLookup')->find('all', array('fields' => array('id'),
        'conditions' => array('TravelHotelLookup.country_id' => $get_country_id,
                                'TravelHotelLookup.city_id' => $get_city_id,
                                'TravelHotelLookup.province_id ' => $get_province_id)));



	count($result_array);
//pr(count($result_array));
	$checkCondition = false;

	foreach( $result_array as  $results){

		$get_hotel_id = $results['TravelHotelLookup']['id'];	
		$conditions['or'][] = array('TravelActionItem.hotel_id =' => $get_hotel_id);

		$checkCondition = true;

	}
/*
	$conditions['or'][] = array('TravelActionItem.created_by_id' => $get_creator,
                                    'TravelActionItem.level_id' => $get_level_id,
                                    'TravelActionItem.type_id' => array('1','2'),
                                    'TravelActionItem.action_item_active' => 'Yes');		
			
	array_push($search_condition, $conditions);

	array_push($search_condition, array('TravelActionItem.created_by_id' => $get_creator));

//	array_push($search_condition, array('TravelActionItem.next_action_by' => $get_user_id));

	array_push($search_condition, array('TravelActionItem.level_id' => $get_level_id));

       	array_push($search_condition, array('TravelActionItem.type_id' => array('1','2')));

	array_push($search_condition, array('TravelActionItem.action_item_active' => 'Yes'));	
*/
        //pr($conditions);
        //die;
	if($checkCondition == true) {	
//            return ClassRegistry::init('TravelActionItem')->find('count', array('fields' => array('id'),'conditions' => $conditions));
              return ClassRegistry::init('TravelActionItem')->find('count', array('fields' => 
                    array('id'),'conditions' => array(
                                    'TravelActionItem.created_by_id' => $get_creator,
                                    'TravelActionItem.level_id' => $get_level_id,
                                    'TravelActionItem.type_id' => array('1','4'),
                                    'TravelActionItem.action_item_active' => 'Yes',
                                    $conditions )));
	} else {
		return 0;
	}
     /*    return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('id'),'conditions' => array('TravelHotelLookup.country_id' => $country_id,'TravelHotelLookup.city_id' => $city_id,'TravelHotelLookup.province_id !=' => '0',

             'TravelHotelLookup.suburb_id !=' => '0','TravelHotelLookup.area_id !=' => '0','TravelHotelLookup.chain_id !=' => '0','TravelHotelLookup.brand_id !=' => '0','TravelHotelLookup.status' => '4')));
			*/
    }
	
	
	
    
    public function getHoteApprovedCnt($country_id,$province_id,$city_id){
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('id'),
            'conditions' => array('TravelHotelLookup.country_id' => $country_id,
                                    'TravelHotelLookup.city_id' => $city_id,
                                    'TravelHotelLookup.province_id ' => $province_id,
                                    'TravelHotelLookup.suburb_id !=' => '0',
                                    'TravelHotelLookup.area_id !=' => '0',
                                    'TravelHotelLookup.chain_id !=' => '0',
                                    'TravelHotelLookup.brand_id !=' => '0',
                                    'TravelHotelLookup.status ' => '2',
                                    'TravelHotelLookup.active ' => 'TRUE',)));
/*        
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('id'),'conditions' => array('OR' => array('TravelHotelLookup.status' => array('2','8')),'TravelHotelLookup.country_id' => $country_id,'TravelHotelLookup.city_id' => $city_id,'TravelHotelLookup.province_id !=' => '0',
             'TravelHotelLookup.suburb_id !=' => '0','TravelHotelLookup.area_id !=' => '0','TravelHotelLookup.chain_id !=' => '0','TravelHotelLookup.brand_id !=' => '0')));
*/     
    }
    
    public function getHoteTotalCnt($country_id,$city_id){
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('id'),'conditions' => array('TravelHotelLookup.country_id' => $country_id,'TravelHotelLookup.city_id' => $city_id)));
     
    }
    
    public function getMappingPendingCnt($country_id,$city_id){
		$city_conditions ='';
		if($city_id!='')
		$city_conditions =  " AND `TravelHotelRoomSupplier`.hotel_city_id = ".$city_id;
	
	
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('id') 		
		
            ,'conditions' => array(
				 "TravelHotelLookup.id NOT IN (SELECT `TravelHotelRoomSupplier`.hotel_id FROM `travel_hotel_room_suppliers` AS `TravelHotelRoomSupplier` WHERE `TravelHotelRoomSupplier`.hotel_country_id = ".$country_id. $city_conditions ."  AND `TravelHotelRoomSupplier`.`hotel_supplier_status` IN ('1','2','7'))",
               
					'TravelHotelLookup.status' => array('2','8'),
					'TravelHotelLookup.country_id' => $country_id,
					'TravelHotelLookup.city_id' => $city_id,
					'TravelHotelLookup.province_id !=' => '0',
					'TravelHotelLookup.suburb_id !=' => '0',
					'TravelHotelLookup.area_id !=' => '0',
					'TravelHotelLookup.chain_id !=' => '0',
					'TravelHotelLookup.brand_id !=' => '0'
			 )));
    
    }
	/*public function getMappingPendingCnt($country_id,$city_id){

        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('id')                             

            ,'conditions' => array(

                "TravelHotelLookup.id NOT IN (SELECT `TravelHotelRoomSupplier`.hotel_id FROM `travel_hotel_room_suppliers` AS `TravelHotelRoomSupplier` WHERE `TravelHotelRoomSupplier`.hotel_country_id = ".$country_id." AND `TravelHotelRoomSupplier`.hotel_city_id = ".$city_id." AND `TravelHotelRoomSupplier`.`hotel_supplier_status` IN ('1','2','7'))",

                'TravelHotelLookup.status' => array('2','8'),'TravelHotelLookup.country_id' => $country_id,'TravelHotelLookup.city_id' => $city_id,'TravelHotelLookup.province_id !=' => '0',

             'TravelHotelLookup.suburb_id !=' => '0','TravelHotelLookup.area_id !=' => '0','TravelHotelLookup.chain_id !=' => '0','TravelHotelLookup.brand_id !=' => '0')));

    

    }*/
    
    public function getMappingSubmitCnt($country_id,$city_id){
        
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('id'),
            'joins' => array(
                    array(
                        'table' => 'travel_hotel_room_suppliers',
                        'alias' => 'TravelHotelRoomSupplier',
                        'type'  => 'INNER',
                        'foreignKey'    => false,
                        'conditions'    => array('TravelHotelLookup.id = TravelHotelRoomSupplier.hotel_id','TravelHotelRoomSupplier.hotel_supplier_status' => '1'),
                        ),
                )                   
            ,'conditions' => array('OR' => array('TravelHotelLookup.status' => array('2','8')),'TravelHotelLookup.country_id' => $country_id,'TravelHotelLookup.city_id' => $city_id,'TravelHotelLookup.province_id !=' => '0',
             'TravelHotelLookup.suburb_id !=' => '0','TravelHotelLookup.area_id !=' => '0','TravelHotelLookup.chain_id !=' => '0','TravelHotelLookup.brand_id !=' => '0')));
     
     
    }
    
    public function getMappingApproveCnt($country_id,$city_id){
        
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('id'),
            'joins' => array(
                    array(
                        'table' => 'travel_hotel_room_suppliers',
                        'alias' => 'TravelHotelRoomSupplier',
                        'type'  => 'INNER',
                        'foreignKey'    => false,
                        'conditions'    => array('TravelHotelLookup.id = TravelHotelRoomSupplier.hotel_id','TravelHotelRoomSupplier.hotel_supplier_status' => array('2','7')),
                        ),
                )                   
            ,'conditions' => array('OR' => array('TravelHotelLookup.status' => array('2','8')),'TravelHotelLookup.country_id' => $country_id,'TravelHotelLookup.city_id' => $city_id,'TravelHotelLookup.province_id !=' => '0',
             'TravelHotelLookup.suburb_id !=' => '0','TravelHotelLookup.area_id !=' => '0','TravelHotelLookup.chain_id !=' => '0','TravelHotelLookup.brand_id !=' => '0')));
     
     
    }
    
    public function getSupplierHotelTotalCnt($country_id,$city_id,$supplier_id){
         $getSupplierHotelTotalCnt = 0;
         $dataArray = ClassRegistry::init('TravelCitySupplier')->find('all', array('fields' => 
			array('TravelCitySupplier.supplier_coutry_code','TravelCitySupplier.supplier_city_code'),
				'conditions' => array('TravelCitySupplier.city_country_id' => $country_id,
										'TravelCitySupplier.city_id' => $city_id,
										'TravelCitySupplier.supplier_id' => $supplier_id,
										'TravelCitySupplier.wtb_status' => '1',
										'TravelCitySupplier.active' => 'TRUE',
										'TravelCitySupplier.city_supplier_status' => '2',
										'TravelCitySupplier.excluded' => 'FALSE')));
/*
         $supplier_country_code = $dataArray['TravelCitySupplier']['supplier_coutry_code'];
         $supplier_city_code = $dataArray['TravelCitySupplier']['supplier_city_code'];
         return ClassRegistry::init('SupplierHotel')->find('count', array('fields' => array('id'),
			'conditions' => array(
//                            'SupplierHotel.country_code' => $supplier_country_code,
			'SupplierHotel.city_code' => $supplier_city_code)));
*/
	foreach( $dataArray as  $results){         
                $supplier_city_code = $results['TravelCitySupplier']['supplier_city_code'];
                $getSupplierHotelTotalCnt += $getSupplierHotelTotalCnt_1 = ClassRegistry::init('SupplierHotel')->find('count', array('fields' => array('id'),
			'conditions' => array(
//                            'SupplierHotel.country_code' => $supplier_country_code,
			'SupplierHotel.city_code' => $supplier_city_code)));
									
		}
		return $getSupplierHotelTotalCnt;         
    }
    

	
    public function getSupplierHotelSubmitCnt($get_country_id,$get_province_id,$get_city_id,$get_creator,$get_level_id,$get_supplier_id ){
	$search_condition = array()	;
	$result_array = ClassRegistry::init('TravelHotelRoomSupplier')->find('all', array('fields' => array('id'),
			'conditions' => array(
//                                                                'TravelHotelRoomSupplier.hotel_country_id' => $get_country_id,
								'TravelHotelRoomSupplier.hotel_city_id' => $get_city_id,
								'TravelHotelRoomSupplier.supplier_id' => $get_supplier_id)));

	count($result_array);
	$checkCondition = false;

	foreach( $result_array as  $results){

		$get_id = $results['TravelHotelRoomSupplier']['id'];	
		$conditions['or'][] = array('TravelActionItem.hotel_supplier_id =' => $get_id);
		$checkCondition = true;

		}								

		if($checkCondition == true) {	
              return ClassRegistry::init('TravelActionItem')->find('count', array('fields' => 
                    array('id'),'conditions' => array(
                                    'TravelActionItem.created_by_id' => $get_creator,
                                    'TravelActionItem.level_id' => $get_level_id,
                                    'TravelActionItem.type_id' => array('1','4'),
                                    'TravelActionItem.action_item_active' => 'Yes',
                                    $conditions )));
		} else {
			return 0;
		}			

    }
	
    public function getSupplierHotelPendingCnt($country_id,$city_id,$supplier_id){
		 $getSupplierHotelPendingCntt =0;
//         $dataArray = ClassRegistry::init('TravelCitySupplier')->find('first', 
         $dataArray = ClassRegistry::init('TravelCitySupplier')->find('all', 		 
		 array('fields' => array('TravelCitySupplier.supplier_coutry_code','TravelCitySupplier.supplier_city_code'),
				'conditions' => array('TravelCitySupplier.city_country_id' => $country_id,
										'TravelCitySupplier.city_id' => $city_id,
										'TravelCitySupplier.supplier_id' => $supplier_id,
										'TravelCitySupplier.wtb_status' => '1',
										'TravelCitySupplier.active' => 'TRUE',
										'TravelCitySupplier.city_supplier_status' => '2',
										'TravelCitySupplier.excluded' => 'FALSE')));
	foreach( $dataArray as  $results){
         $supplier_country_code = $results['TravelCitySupplier']['supplier_coutry_code'];
         $supplier_city_code = $results['TravelCitySupplier']['supplier_city_code'];

		 $getSupplierHotelPendingCntt += $getSupplierHotelPendingCntt_1 = ClassRegistry::init('SupplierHotel')->find('count', array('fields' => array('id'),
//		 $getSupplierHotelPendingCntt += $getSupplierHotelPendingCntt_1 = $this->SupplierHotel->find('count', array('fields' => array('id'),                     
			'conditions' => array(
//                                                                        'SupplierHotel.country_code' => $supplier_country_code,
									'SupplierHotel.city_code' => $supplier_city_code,
									'SupplierHotel.status' => array('1','5','4','6'))));
									
		}
		return $getSupplierHotelPendingCntt;
    }
    
    public function getSupplierHotelCompeleteCnt($country_id,$city_id,$supplier_id){
         $getSupplierHotelCompeleteCnt = 0;
/*         
         $dataArray = ClassRegistry::init('TravelCitySupplier')->find('all', array('fields' => array('TravelCitySupplier.supplier_coutry_code','TravelCitySupplier.supplier_city_code'),'conditions' => array('TravelCitySupplier.city_country_id' => $country_id,'TravelCitySupplier.city_id' => $city_id,'TravelCitySupplier.supplier_id' => $supplier_id)));
//         $supplier_country_code = $dataArray['TravelCitySupplier']['supplier_coutry_code'];
         $supplier_city_code = $dataArray['TravelCitySupplier']['supplier_city_code'];
         return ClassRegistry::init('SupplierHotel')->find('count', array('fields' => array('id'),'conditions' => array('SupplierHotel.city_code' => $supplier_city_code,'SupplierHotel.status' => array('3','7'))));
//         return ClassRegistry::init('SupplierHotel')->find('count', array('fields' => array('id'),'conditions' => array('SupplierHotel.country_code' => $supplier_country_code,'SupplierHotel.city_code' => $supplier_city_code,'SupplierHotel.status' => array('3','7'))));         
*/
         $dataArray = ClassRegistry::init('TravelCitySupplier')->find('all', 		 
		 array('fields' => array('TravelCitySupplier.supplier_coutry_code','TravelCitySupplier.supplier_city_code'),
				'conditions' => array('TravelCitySupplier.city_country_id' => $country_id,
										'TravelCitySupplier.city_id' => $city_id,
										'TravelCitySupplier.supplier_id' => $supplier_id,
										'TravelCitySupplier.wtb_status' => '1',
										'TravelCitySupplier.active' => 'TRUE',
										'TravelCitySupplier.city_supplier_status' => '2',
										'TravelCitySupplier.excluded' => 'FALSE')));
         
	foreach( $dataArray as  $results){         
                $supplier_city_code = $results['TravelCitySupplier']['supplier_city_code'];
                $getSupplierHotelCompeleteCnt += $getSupplierHotelCompeleteCnt_1 = ClassRegistry::init('SupplierHotel')->find('count', array('fields' => array('id'),
			'conditions' => array(
//                            'SupplierHotel.country_code' => $supplier_country_code,
			'SupplierHotel.city_code' => $supplier_city_code,
                        'SupplierHotel.status' => array('3','7'))));
									
		}
		return $getSupplierHotelCompeleteCnt;         
    }
    public function getSupportTicketCnt($country_id,$city_id,$province_id,$user_id,$logged_user,$flag){

        $search_condition = array();
	$result_array = ClassRegistry::init('TravelHotelLookup')->find('all', array('fields' => array('id'),
	'conditions' => array('TravelHotelLookup.country_id' => $country_id,
							'TravelHotelLookup.city_id' => $city_id,
							'TravelHotelLookup.province_id ' => $province_id)));
	$checkCondition = false;
	foreach( $result_array as  $results){
	
		$hotel_id = $results['TravelHotelLookup']['id'];		
		$conditions['or'][] = array('SupportTicket.about LIKE' => "%Id: $hotel_id%");
		$checkCondition = true;
	}
        $search_condition = array('OR' => array('SupportTicket.created_by' => $logged_user, 'SupportTicket.next_action_by' => $logged_user, 'SupportTicket.approved_by' => $logged_user, 'SupportTicket.last_action_by' => $logged_user));
        
	if($checkCondition == true){

		if($flag == 'O'){
			return ClassRegistry::init('SupportTicket')->find('count', array('fields' => array('id'),'conditions' => array('SupportTicket.status' => '1','SupportTicket.created_by' => $user_id,$conditions,$search_condition )));
		} elseif ($flag == 'R'){
			return ClassRegistry::init('SupportTicket')->find('count', array('fields' => array('id'),'conditions' => array('SupportTicket.status' => '2','SupportTicket.created_by' => $user_id,$conditions,$search_condition )));			
		} else{

		return 0;
		}	
		
	}else{
		return 0;
	}
		
        

    }
    public function getDuplicateHotel($continent_id,$country_id,$province_id,$city_id,$hotel_name){
        
        $search_condition = array();
        $condition = array();
        
        ClassRegistry::init('TravelHotelLookup')->unbindModel(
                array('hasMany' => array('TravelHotelRoomSupplier'))
        );
        
        for ($indexOfFirstLetter = 0; $indexOfFirstLetter <= strlen($hotel_name); $indexOfFirstLetter++) {
                for ($indexOfLastLetter = $indexOfFirstLetter + 1; $indexOfLastLetter <= strlen($hotel_name); $indexOfLastLetter++) {
                    $new_arr[] = substr($hotel_name, $indexOfFirstLetter, 8);
                  
                    if (strlen($new_arr[$indexOfFirstLetter]) == '8') {
                        array_push($condition, array("TravelHotelLookup.hotel_name LIKE '%". mysql_escape_string(trim(strip_tags($new_arr[$indexOfFirstLetter]))) ."%'"));
                    }
                  
                    $indexOfFirstLetter++;
                }
            }
           
            array_push($search_condition, array('OR' => $condition, 'TravelHotelLookup.continent_id' => $continent_id, 'TravelHotelLookup.country_id' => $country_id, 'TravelHotelLookup.province_id' => $province_id, 'TravelHotelLookup.city_id' => $city_id));
           //return $this->paginate(ClassRegistry::init('TravelHotelLookup'), $search_condition);
         return ClassRegistry::init('TravelHotelLookup')->find('all', array('conditions' => $search_condition));
         
    }
 #add method by pc
 
 public function getHoteByDateCnt($country_id,$city_id,$fordate,$type){
	 
#For get today
if($fordate == 'today'){
	$sdate = date('y-m-d').' 00:00:00';
	$edate = date("y-m-d").' 23:59:59'; 	
}

#For get yesterday
elseif($fordate == 'yesterday'){
	$yesterday = date('y-m-d',strtotime("-1 days"));
	$sdate = $yesterday.' 00:00:00';
	$edate = $yesterday.' 23:59:59'; 	
}
	 
#For get this week
elseif($fordate == 'this_week'){
	$sdate = date('y-m-d', strtotime("last saturday")).' 00:00:00';
	$edate = date("y-m-d").' 23:59:59'; 	
}

#For get this month
elseif($fordate == 'this_month'){
	$sdate = date('y-m-01').' 00:00:00';
	$edate = date("y-m-d").' 23:59:59'; 
}

#For get this year
elseif($fordate == 'this_year'){
$sdate = date('y-01-01').' 00:00:00';
$edate = date("y-m-d").' 23:59:59';  
}	 
	 
#For get last year
elseif($fordate == 'last_year'){
$year =	date('y')-1;
$sdate = date("$year-01-01").' 00:00:00';
$edate = date("$year-12-t").' 23:59:59';  
}	 	 
	 
$type_id = '';	 
//Hotel Edited	 7
if($type == 'Hotel Edited')
{
		$type_id = 7;	 
}
//Mapping Submitted   4	 	
if($type == 'Mapping Submitted')
{
		$type_id = 4;	 
}	 

	 

        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('id'),
		
		'joins' => array(

                    array(

                        'table' => 'travel_action_items',
                        'alias' => 'TravelActionItem',
                        'type'  => 'INNER',
                        'foreignKey'    => false,
                        'conditions'    => array('TravelHotelLookup.id = TravelActionItem.hotel_id','TravelActionItem.action_item_active' => 'Yes','TravelActionItem.type_id' => "$type_id", 'date(TravelActionItem.created) BETWEEN ? AND ?' => array($sdate,$edate)),

                        ),

                ),
		
		'conditions' => array('TravelHotelLookup.country_id' => $country_id,'TravelHotelLookup.city_id' => $city_id)));

     

	 
	 /*
	 
	 $dataArray = ClassRegistry::init('TravelCitySupplier')->find('first', array('fields' => array('TravelCitySupplier.supplier_coutry_code','TravelCitySupplier.supplier_city_code'),'conditions' => array('TravelCitySupplier.city_country_id' => $country_id,'TravelCitySupplier.city_id' => $city_id,'TravelCitySupplier.supplier_id' => $supplier_id)));

         $supplier_country_code = $dataArray['TravelCitySupplier']['supplier_coutry_code'];

         $supplier_city_code = $dataArray['TravelCitySupplier']['supplier_city_code'];

         return ClassRegistry::init('SupplierHotel')->find('count', array('fields' => array('id'),'conditions' => array('SupplierHotel.country_code' => $supplier_country_code,'SupplierHotel.city_code' => $supplier_city_code,'SupplierHotel.status' => array('3','7'))));
	 */
	 
	 
	 
	 
	 
	 
    }

 public function getHotelEditActionByDateCnt($user_id,$country_id,$province_id,$city_id,$level_id,$sdate,$edate){
	 
        return ClassRegistry::init('TravelActionItem')->find('count', array('fields' => array('id'),
		
		'joins' => array(

                    array(

                        'table' => 'travel_hotel_lookups',
                        'alias' => 'TravelHotelLookupa',
                        'type'  => 'INNER',
                        'foreignKey'    => false,
                        'conditions'    => array('TravelHotelLookupa.id = TravelActionItem.hotel_id','TravelHotelLookupa.country_id' => $country_id,'TravelHotelLookupa.province_id' => $province_id,'TravelHotelLookupa.city_id' => $city_id),

                        ),

                ),
		
        	'conditions' => array('TravelActionItem.created_by' => $user_id,
                                        'TravelActionItem.level_id' => $level_id,
                                        'TravelActionItem.type_id' => '4',
                                        'TravelActionItem.next_action_by !=' => 'TravelActionItem.created_by',
                                        'date(TravelActionItem.created) BETWEEN ? AND ?' => array($sdate,$edate))));	



 
    }
   
 public function getHotelApprovedByDateCnt($user_id,$country_id,$province_id,$city_id,$level_id,$sdate,$edate){
	 
        return ClassRegistry::init('TravelActionItem')->find('count', array('fields' => array('id'),
		
		'joins' => array(

                    array(

                        'table' => 'travel_hotel_lookups',
                        'alias' => 'TravelHotelLookupb',
                        'type'  => 'INNER',
                        'foreignKey'    => false,
                        'conditions'    => array('TravelHotelLookupb.id = TravelActionItem.hotel_id','TravelHotelLookupb.country_id' => $country_id,'TravelHotelLookupb.province_id' => $province_id,'TravelHotelLookupb.city_id' => $city_id),

                        ),

                ),
		
		'conditions' => array('TravelActionItem.created_by' => $user_id,
                    'TravelActionItem.level_id' => $level_id,
                    'TravelActionItem.type_id' => '2' ,
                    'TravelActionItem.next_action_by' => NULL,
                    'date(TravelActionItem.created) BETWEEN ? AND ?' => array($sdate,$edate))));	 



 
    }

 public function getMappingSubmitByDateCnt($user_id,$country_id,$city_id,$supplier_id,$level_id,$sdate,$edate){
	 
        return ClassRegistry::init('TravelActionItem')->find('count', array('fields' => array('id'),
		
		'joins' => array(

                    array(

                        'table' => 'travel_hotel_room_suppliers',
                        'alias' => 'TravelHotelRoomSuppliera',
                        'type'  => 'INNER',
                        'foreignKey'    => false,
                        'conditions'    => array('TravelHotelRoomSuppliera.id = TravelActionItem.hotel_supplier_id','TravelHotelRoomSuppliera.hotel_country_id' => $country_id,'TravelHotelRoomSuppliera.hotel_city_id' => $city_id),'TravelHotelRoomSuppliera.supplier_id' => $supplier_id,

                        ),

                ),
		
		'conditions' => array('TravelActionItem.created_by' => $user_id,
                                        'TravelActionItem.level_id' => $level_id,
                                        'TravelActionItem.type_id' => '1',
                                        'TravelActionItem.next_action_by !=' => 'TravelActionItem.created_by',
                                        'date(TravelActionItem.created) BETWEEN ? AND ?' => array($sdate,$edate))));	 
}
    
 public function getMappingApprovedByDateCnt($user_id,$country_id,$city_id,$supplier_id,$level_id,$sdate,$edate){
	 
        return ClassRegistry::init('TravelActionItem')->find('count', array('fields' => array('id'),
		
		'joins' => array(

                    array(

                        'table' => 'travel_hotel_room_suppliers',
                        'alias' => 'TravelHotelRoomSupplierb',
                        'type'  => 'INNER',
                        'foreignKey'    => false,
                        'conditions'    => array('TravelHotelRoomSupplierb.id = TravelActionItem.hotel_supplier_id','TravelHotelRoomSupplierb.hotel_country_id' => $country_id,'TravelHotelRoomSupplierb.hotel_city_id' => $city_id),'TravelHotelRoomSupplierb.supplier_id' => $supplier_id,

                        ),

                ),
		
		'conditions' => array('TravelActionItem.created_by' => $user_id,
                                        'TravelActionItem.level_id' => $level_id,
                                        'TravelActionItem.type_id' => '2',
                                        'TravelActionItem.next_action_by' => NULL,
                                        'date(TravelActionItem.created) BETWEEN ? AND ?' => array($sdate,$edate))));	 
}

 public function getImageUploadedByDateCnt($user_id,$country_id,$province_id,$city_id,$sdate,$edate){
	 
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('id'),
		
		'conditions' => array('TravelHotelLookup.image_by' => $user_id,
                                        'TravelHotelLookup.country_id' => $country_id,
                                        'TravelHotelLookup.province_id' => $province_id,
                                        'TravelHotelLookup.city_id' => $city_id,
                                        'date(TravelHotelLookup.image_date) BETWEEN ? AND ?' => array($sdate,$edate))));	 
}

 public function getPageEditedByDateCnt($user_id,$country_id,$province_id,$city_id,$sdate,$edate){
	 
        return ClassRegistry::init('TravelHotelLookup')->find('count', array('fields' => array('id'),
		
		'conditions' => array('TravelHotelLookup.page_by' => $user_id,
                                        'TravelHotelLookup.country_id' => $country_id,
                                        'TravelHotelLookup.province_id' => $province_id,
                                        'TravelHotelLookup.city_id' => $city_id,
                                        'date(TravelHotelLookup.page_date) BETWEEN ? AND ?' => array($sdate,$edate))));	 
}


}



