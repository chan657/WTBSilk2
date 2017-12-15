<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('AppController', 'Controller');
class TravelLookUpsController extends AppController{
    var $uses = array('TravelLookupAmenityCategorie','TravelLookupAmenityType','TravelLookupReviewTopic','LogCall','User');
function beforeFilter(){     
             parent::beforeFilter();   
    $this->Auth->allow('index','updateAminityCategory','getAminityTypes','deleteAminityType','addAminityType','getAllAminityType','updateReviewsTopics','addAminityCategory','addReviewTopic','addAminityCategoryType','deleteAminityCategory','deleteReviewsTopics','deleteAminityCategoryTypes');
}

     
    public function index(){

        $this->set("foreignMachineRunningStatus",$this->IsService());
        $this->set("foreignMachineStatus","false");
        $categories = $this->TravelLookupAmenityCategorie->find('all',array('order' => 'TravelLookupAmenityCategorie.value asc'));
        $this->set(compact('categories'));
        $reviewsTopics = $this->TravelLookupReviewTopic->find('all',array('order' => 'TravelLookupReviewTopic.value asc'));
        $this->set(compact('reviewsTopics'));
        $amenities = $this->TravelLookupAmenityType->find('all', array(
        'fields' => array('TravelLookupAmenityType.amenity_category_id,TravelLookupAmenityType.id,GROUP_CONCAT(TravelLookupAmenityType.value separator " , ") AS amenity_name', 'TravelLookupAmenityCategorie.value'),
        'joins' => array(
        array(
        'table' => 'travel_lookup_amenity_categories',
        'alias' => 'TravelLookupAmenityCategorie',
        'type' => 'INNER',
        'conditions' => 'TravelLookupAmenityType.amenity_category_id = TravelLookupAmenityCategorie.id'
        )
        ),
        'order' => 'TravelLookupAmenityType.amenity_category_id',
        'group' => array('TravelLookupAmenityType.amenity_category_id')));
        $this->set(compact('amenities'));
    }


    public function addAminityCategory(){      
    $returnData['STATUS']="FAILED";
    $this->autoRender = false ;
    if ($this->request->is('ajax')) {
    if(!empty($this->request->data)){
    if ($this->request->data['aminity_value']!='') {
    $newData = array('value' =>$this->request->data['aminity_value'] );
    $saveData=$this->TravelLookupAmenityCategorie->save($newData);
    if($saveData){
    //save in foreign machine
    $aminityCategoryID=$this->TravelLookupAmenityCategorie->getLastInsertID();
    $aminityCategoryValue=$this->request->data['aminity_value'];
    $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
    $action_URL = 'http://www.travel.domain/ProcessXML';
    $user_id = $this->Auth->user('id');
    $xml_error = 'FALSE';
    $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
    $content_xml_str = '  <soap:Body>
    <ProcessXML xmlns="http://www.travel.domain/">
    <RequestInfo>
    <ResourceDataRequest>
    <RequestAuditInfo>
    <RequestType>PXML_WData_AmenityCategories</RequestType>
    <RequestTime>'.$CreatedDate.'</RequestTime>
    <RequestResource>Silkrouters</RequestResource>
    </RequestAuditInfo>
    <RequestParameters>
    <ResourceData>
    <ResourceDetailsData srno="1" actiontype="AddNew">
    <AmenityCategoriesId>'.$aminityCategoryID.'</AmenityCategoriesId>
    <AmenityCategory>'.$aminityCategoryValue.'</AmenityCategory>
    </ResourceDetailsData>
    </ResourceData>
    </RequestParameters>
    </ResourceDataRequest>
    </RequestInfo>
    </ProcessXML>
    </soap:Body>';

    $log_call_screen = 'Amenity Categories - Add';
    $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
    $client = new SoapClient(null, array(
    'location' => $location_URL,
    'uri' => '',
    'trace' => 1,
    ));

    try {
    $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
    $xml_arr = $this->xml2array($order_return);
    /*echo htmlentities($xml_string);
    pr($xml_arr);
    die;*/

    if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
    $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
    //update the status in local server
    $this->TravelLookupAmenityCategorie->updateAll(array('TravelLookupAmenityCategorie.wtb_status' => "'1'"), array('TravelLookupAmenityCategorie.id' => $aminityCategoryID));

    } else {

    $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
    $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
    $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
    $this->TravelLookupAmenityCategorie->updateAll(array('TravelLookupAmenityCategorie.wtb_status' => "'2'"), array('TravelLookupAmenityCategorie.id' => $aminityCategoryID));
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
      /*
    $Email = new CakeEmail();

    $Email->viewVars(array(
    'request_xml' => trim($xml_string),
    'respon_message' => $log_call_status_message,
    'respon_code' => $log_call_status_code,
    ));

    $to = 'biswajit@wtbglobal.com';
    $cc = 'infra@sumanus.com';

    $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date('d/m/y H:i:s') . ']')->send();
    */
    $returnData="Unable to add in foreign machine";
    }else{
      $returnData=$aminityCategoryID;
    }

    }else{
    $returnData= 'Unable to Save!';
    }
    }else{
    $returnData= 'Data and Id Must Not Empty!';
    }
    }else{
    $returnData= 'Data Must Not Empty!';
    }
    }else{
    $returnData= 'Not a Valid Request!';
    }
    echo $returnData;
    exit();
}
  


    public function updateAminityCategory(){
        $returnData=array();
        $returnData['STATUS']="FAILED";
        $this->autoRender = false ;
        if ($this->request->is('ajax')) {
        if(!empty($this->request->data)){
        if (($this->request->data['category_value']!='')&& ($this->request->data['category_id']!='')) {
        $updateData = array('id' => $this->request->data['category_id'], 'value' =>$this->request->data['category_value'] );
        $this->TravelLookupAmenityCategorie->id = $this->request->data['category_id'];
        $saveData=$this->TravelLookupAmenityCategorie->save($updateData);
        if($saveData){
        //update in foreign machine
        $aminityCategoryName=$this->request->data['category_value'];
        $aminityCategoryId=$this->request->data['category_id'];
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';
        $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
        $content_xml_str = '  <soap:Body>
        <ProcessXML xmlns="http://www.travel.domain/">
        <RequestInfo>
        <ResourceDataRequest>
        <RequestAuditInfo>
        <RequestType>PXML_WData_AmenityCategories</RequestType>
        <RequestTime>$CreatedDate</RequestTime>
        <RequestResource>yourcompanyname</RequestResource>
        </RequestAuditInfo>
        <RequestParameters>
        <ResourceData>
        <ResourceDetailsData srno="1" actiontype="Edit">
        <AmenityCategoriesId>'.$aminityCategoryName.'</AmenityCategoriesId>
        <AmenityCategory>'.$aminityCategoryId.'</AmenityCategory>
        </ResourceDetailsData>
        </ResourceData>
        </RequestParameters>
        </ResourceDataRequest>
        </RequestInfo>
        </ProcessXML>
        </soap:Body>';
        $log_call_screen = 'Amenity Categories - Update';
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
        $this->TravelLookupAmenityCategorie->updateAll(array('TravelLookupAmenityCategorie.wtb_status' => "'1'"), array('TravelLookupAmenityCategorie.id' => $aminityCategoryId));
        } else {

        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
        $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
        $this->TravelLookupAmenityCategorie->updateAll(array('TravelLookupAmenityCategorie.wtb_status' => "'2'"), array('TravelLookupAmenityCategorie.id' => $aminityCategoryId));
        $xml_error = 'TRUE';
        }
        } catch (SoapFault $exception) {
        //var_dump(get_class($exception));
        //var_dump($exception);
        $returnData['MESSAGE']='<div class="alert alert-warning">Aminity category updated successfully on local machine.<br>Foreign machine not updated successfully / '.$log_call_status_message.'.</div>';
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
        /*
        $Email = new CakeEmail();
        $Email->viewVars(array(
        'request_xml' => trim($xml_string),
        'respon_message' => $log_call_status_message,
        'respon_code' => $log_call_status_code,
        ));

        $to = 'biswajit@wtbglobal.com';
        $cc = 'infra@sumanus.com';

        $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date('d/m/y H:i:s') . ']')->send();
        */
        $returnData['MESSAGE']='<div class="alert alert-warning">Aminity category updated successfully in local machine.<br>Foreign machine not updated successfully / '.$log_call_status_message.'.</div>';
        $returnData['STATUS'] ='SUCCESS';
        }else{
        $returnData['STATUS'] ='SUCCESS';
        $returnData['MESSAGE']='<div class="alert alert-success">Aminity category updated successfully.<br>Foreign machine also updated successfully.</div>';
        }





        }else{
        $returnData['MESSAGE']='<div class="alert alert-danger">Unable to update aminity category<br></div>';
        }
        }else{
        $returnData['MESSAGE']='<div class="alert alert-danger">Aminity category must not be empty!<br></div>';
        }
        }else{
        $returnData['MESSAGE']='<div class="alert alert-danger">Data must not be empty!<br></div>';
        }
        }else{
        $returnData['MESSAGE']='<div class="alert alert-danger">Invalid request!<br></div>';
        }
        echo json_encode($returnData);
        exit();
    }

    public function getAminityTypes(){
      error_reporting(0);
      $returnData=array();
      $returnData['STATUS']="FAILED";
      $this->autoRender = false ;
      if ($this->request->is('ajax')) {
      if(!empty($this->request->data)){
      if (($this->request->data['category_id']!='')) {

      $allData= $this->TravelLookupAmenityType->find('all', array('conditions'=>array('amenity_category_id'=>$this->request->data['category_id'])));
      $returnData['DATA']='<ul class="list-group" id="aminityTypeAddListingULId">';
      if(!empty($allData)){
      foreach ($allData as $aminityType) {
      $returnData['DATA'].='<li class="list-group-item" id="aminityTypeDeleteListingId'.$aminityType['TravelLookupAmenityType']['id'].'" style="border: 1px solid #e5e5e5;">'.$aminityType['TravelLookupAmenityType']['value'].' <span class="badge" onclick="deleteAminityType('.$aminityType['TravelLookupAmenityType']['id'].')" style="color:red;font-weight:bold;cursor:pointer;"><span class="glyphicon glyphicon-remove"></span></span></li>';
      }
      }
      $returnData['STATUS']="SUCCESS";
      $returnData['DATA'].='</ul><br>Add New Amenity<br><input type="text" class="form-control" id="addNewAminityTypeInputBoxId"><button id="addNewAmenityTypeBtnId" onclick="addNewAmenityType('.$this->request->data['category_id'].')" type="button" class="btn btn-primary btn-sm">
      <span class="glyphicon glyphicon-plus"></span> ADD
      </button>';

      }else{
      $returnData['MESSAGE']= 'Data and Id Must Not Empty!';
      }
      }else{
      $returnData['MESSAGE']= 'Data Must Not Empty!';
      }
      }else{
      $returnData['MESSAGE']= 'Not a Valid Request!';
      }
      echo json_encode($returnData);
      exit();        
    }
    
    public function deleteAminityType(){
        $returnData="FAILED";
        $this->autoRender = false ;
        if ($this->request->is('ajax')) {
        if(!empty($this->request->data)){
        if($this->request->data['aminity_type_id']!='') {
        $deleteData=$this->TravelLookupAmenityType->delete($this->request->data['aminity_type_id']);
        if($deleteData){
        $returnData ='SUCCESS';


        $aminityCategoryTypeId=$this->request->data['aminity_type_id'];
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';

        $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');

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
        <ResourceDetailsData srno="1" lookuptype="AmenityType">
        <AmenityTypeId>'.$aminityCategoryTypeId.'</AmenityTypeId>                        
        </ResourceDetailsData>
        </ResourceData>
        </RequestParameters>
        </ResourceDataRequest>
        </RequestInfo>
        </ProcessXML>
        </soap:Body>';

        $log_call_screen = 'Amenity Categories Type- Delete';
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
        $this->TravelLookupAmenityCategorie->updateAll(array('TravelLookupAmenityCategorie.wtb_status' => "'1'"), array('TravelLookupAmenityCategorie.id' => $aminityCategoryId));
        } else {

        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_CITY']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
        $xml_msg = "There was a problem with foreign record updation [Code:$log_call_status_code]";
        $this->TravelLookupAmenityCategorie->updateAll(array('TravelLookupAmenityCategorie.wtb_status' => "'2'"), array('TravelLookupAmenityCategorie.id' => $aminityCategoryId));
        $xml_error = 'TRUE';
        }
        } catch (SoapFault $exception) {
        //var_dump(get_class($exception));
        //var_dump($exception);
        $returnData['MESSAGE']='<div class="alert alert-warning">Aminity category updated successfully on local machine.<br>Foreign machine not updated successfully / '.$log_call_status_message.'.</div>';
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
        /*
        $Email = new CakeEmail();
        $Email->viewVars(array(
        'request_xml' => trim($xml_string),
        'respon_message' => $log_call_status_message,
        'respon_code' => $log_call_status_code,
        ));

        $to = 'biswajit@wtbglobal.com';
        $cc = 'infra@sumanus.com';

        $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date('d/m/y H:i:s') . ']')->send();
        */
        $returnData['MESSAGE']='<div class="alert alert-warning">Aminity category updated successfully in local machine.<br>Foreign machine not updated successfully / '.$log_call_status_message.'.</div>';
        $returnData['STATUS'] ='SUCCESS';
        }else{
        $returnData['STATUS'] ='SUCCESS';
        $returnData['MESSAGE']='<div class="alert alert-success">Aminity category updated successfully.<br>Foreign machine also updated successfully.</div>';
        }

        }else{
        $returnData= 'Unable to Delete!';
        }
        }else{
        $returnData= 'Id Must Not Empty!';
        }
        }else{
        $returnData= 'Data Must Not Empty!';
        }
        }else{
        $returnData= 'Not a Valid Request!';
        }
        echo $returnData;
        exit();
    }

    public function addAminityType(){
        $returnData="FAILED";
        $this->autoRender = false ;
        if ($this->request->is('ajax')) {
        if(!empty($this->request->data)){
        if (($this->request->data['aminity_value']!='')&& ($this->request->data['category_id']!='')) {
        $newData = array('amenity_category_id' => $this->request->data['category_id'], 'value' =>$this->request->data['aminity_value'] );
        $saveData=true;//$this->TravelLookupAmenityType->save($newData);
        if($saveData){
        $returnData =$this->TravelLookupAmenityType->getLastInsertID();

        $aminityCategoryData=$this->AmenityCategory->find('first',array('conditions'=>array('AmenityCategory.amenity_category_id'=>$this->request->data['category_id'])));
        pr($aminityCategoryData);
        //save in foreign machine
        $aminityCategoryTypeID=$returnData;
        $aminityCategoryTypeValue=$this->request->data['aminity_value'];
        $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
        $action_URL = 'http://www.travel.domain/ProcessXML';
        $user_id = $this->Auth->user('id');
        $xml_error = 'FALSE';
        $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');


        $content_xml_str = '<soap:Body>
        <ProcessXML xmlns="http://www.travel.domain/">
        <RequestInfo>
        <ResourceDataRequest>
        <RequestAuditInfo>
        <RequestType>PXML_WData_AmenityTypes</RequestType>
        <RequestTime>'.$CreatedDate.'</RequestTime>
        <RequestResource>Silkrouters</RequestResource>
        </RequestAuditInfo>
        <RequestParameters>
        <ResourceData>
        <ResourceDetailsData srno="1" actiontype="AddNew">

        <AmenityTypesId>'.$CreatedDate.'</AmenityTypesId>
        <AmenityType>AmiTyp102</AmenityType>

        <AmenityCategoryId>5</AmenityCategoryId>
        <AmenityCategory>AmenityDetails</AmenityCategory>

        <!--
        <CreatedBy>1</CreatedBy>
        <ModifiedBy>1</ModifiedBy>
        <CreatedDate>2017-08-17T11:11:14</CreatedDate>
        <ModifiedDate>2017-08-17T11:11:14</ModifiedDate>-->

        </ResourceDetailsData>
        </ResourceData>
        </RequestParameters>
        </ResourceDataRequest>
        </RequestInfo>
        </ProcessXML>
        </soap:Body>';

        $log_call_screen = 'Amenity Categories Type- Add';
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

        if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
        $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
        //update the status in local server
        $this->TravelLookupAmenityCategorie->updateAll(array('TravelLookupAmenityCategorie.wtb_status' => "'1'"), array('TravelLookupAmenityCategorie.id' => $aminityCategoryID));

        } else {

        $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
        $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
        $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
        $this->TravelLookupAmenityCategorie->updateAll(array('TravelLookupAmenityCategorie.wtb_status' => "'2'"), array('TravelLookupAmenityCategorie.id' => $aminityCategoryID));
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
        /*
        $Email = new CakeEmail();

        $Email->viewVars(array(
        'request_xml' => trim($xml_string),
        'respon_message' => $log_call_status_message,
        'respon_code' => $log_call_status_code,
        ));

        $to = 'biswajit@wtbglobal.com';
        $cc = 'infra@sumanus.com';

        $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date('d/m/y H:i:s') . ']')->send();
        */
        $returnData="Unable to add in foreign machine";
        }else{
        $returnData=$aminityCategoryID;
        }
        }else{
        $returnData= 'Unable to Save!';
        }
        }else{
        $returnData= 'Data and Id Must Not Empty!';
        }
        }else{
        $returnData= 'Data Must Not Empty!';
        }
        }else{
        $returnData= 'Not a Valid Request!';
        }
        echo $returnData;
        exit();
    }


    public function getAllAminityType(){
      $returnData="FAILED";
      $this->autoRender = false ;
      if ($this->request->is('ajax')) {
      if(!empty($this->request->data)){
      if ($this->request->data['category_id']!='') {
      $allData=$this->TravelLookupAmenityType->find('all',array('conditions'=>array('TravelLookupAmenityType.amenity_category_id'=>$this->request->data['category_id']),'fields'=>array('TravelLookupAmenityType.value')));
      $innerDataArray=array();
      if(!empty($allData)){
      foreach ($allData as $aminity) {
      array_push($innerDataArray, $aminity['TravelLookupAmenityType']['value']);
      }
      }
      $returnData =implode(', ', $innerDataArray);

      }
      }
      }
      echo $returnData;
      exit();
    }



    public function updateReviewsTopics(){
        $returnData=array();
        $returnData['STATUS']="FAILED";
        $this->autoRender = false ;
        if ($this->request->is('ajax')) {
        if(!empty($this->request->data)){
        if (($this->request->data['review_value']!='')&& ($this->request->data['review_id']!='')) {
        $updateData = array('id' => $this->request->data['review_id'], 'value' =>$this->request->data['review_value'] );
        $this->TravelLookupReviewTopic->id = $this->request->data['review_id'];
        $saveData=$this->TravelLookupReviewTopic->save($updateData);
        if($saveData){
        //save in foreign machine
      $reviewTopicID=$this->request->data['review_id'];
      $reviewTopicValue=$this->request->data['review_value'];
      $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
      $action_URL = 'http://www.travel.domain/ProcessXML';
      $user_id = $this->Auth->user('id');
      $xml_error = 'FALSE';
      $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
      $content_xml_str = '  <soap:Body>
      <ProcessXML xmlns="http://www.travel.domain/">
      <RequestInfo>
      <ResourceDataRequest>
      <RequestAuditInfo>
      <RequestType>PXML_WData_ReviewTopics</RequestType>
      <RequestTime>'.$CreatedDate.'</RequestTime>
      <RequestResource>Silkrouters</RequestResource>
      </RequestAuditInfo>
      <RequestParameters>
      <ResourceData>
      <ResourceDetailsData srno="1" actiontype="Edit">
      <ReviewTopicsId>'.$reviewTopicID.'</ReviewTopicsId>
      <ReviewTopic>'.$reviewTopicValue.'</ReviewTopic>
      </ResourceDetailsData>
      </ResourceData>
      </RequestParameters>
      </ResourceDataRequest>
      </RequestInfo>
      </ProcessXML>
      </soap:Body>';
      $log_call_screen = 'Reviews Topics - Add';
      $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');
      $client = new SoapClient(null, array(
      'location' => $location_URL,
      'uri' => '',
      'trace' => 1,
      ));
      try {
      $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
      $xml_arr = $this->xml2array($order_return);
       echo htmlentities($xml_string);
       pr($xml_arr);
       die;
      if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
      $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
      $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
      $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
      //update the status in local server
      $this->TravelLookupReviewTopic->updateAll(array('TravelLookupReviewTopic.wtb_status' => "'1'"), array('TravelLookupReviewTopic.id' => $reviewTopicID));
      } else {
      $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
      $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
      $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
      $this->TravelLookupReviewTopic->updateAll(array('TravelLookupReviewTopic.wtb_status' => "'2'"), array('TravelLookupReviewTopic.id' => $reviewTopicID));
      $xml_error = 'TRUE';
      }
      } catch (SoapFault $exception) {
      /*var_dump(get_class($exception));
      var_dump($exception);*/
      $returnData['STATUS']="FAILED";
      $returnData['MESSAGE']="Unable to call the URL Using Soap";
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
      /*
      $Email = new CakeEmail();
      $Email->viewVars(array(
      'request_xml' => trim($xml_string),
      'respon_message' => $log_call_status_message,
      'respon_code' => $log_call_status_code,
      ));
      $to = 'biswajit@wtbglobal.com';
      $cc = 'infra@sumanus.com';
      $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date('d/m/y H:i:s') . ']')->send();
      */
      $returnData['STATUS']="SUCCESS";
      $returnData['MESSAGE']='<div class="alert alert-warning">Aminity category updated successfully in local machine.<br>Foreign machine not updated successfully / '.$log_call_status_message.'.</div>';$returnData['DATA']=$reviewTopicID;
      }else{
      $returnData['STATUS']="SUCCESS";
      $returnData['MESSAGE']='<div class="alert alert-success">Aminity category updated successfully.<br>Foreign machine also updated successfully.</div>';
      }
        }else{
        $returnData['MESSAGE']="Unable to Save!";
        }
        }else{
         $returnData['MESSAGE']="Data and Id Must Not Empty!";
        }
        }else{
        $returnData['MESSAGE']="Data Must Not Empty!";
        }
        }else{
        $returnData['MESSAGE']="Not a Valid Request!";
        }
        echo json_encode($returnData);
        exit();
    }

    
    public function addReviewTopic(){
      $returnData['STATUS']="FAILED";
      $this->autoRender = false ;
      if ($this->request->is('ajax')) {
      if(!empty($this->request->data)){
      if ($this->request->data['review_topic_value']!='') {
      $newData = array('value' =>$this->request->data['review_topic_value'] );
      $saveData=$this->TravelLookupReviewTopic->save($newData);
      if($saveData){
      //save in foreign machine
      $reviewTopicID=$this->TravelLookupReviewTopic->getLastInsertID();
      $reviewTopicValue=$this->request->data['review_topic_value'];
      $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
      $action_URL = 'http://www.travel.domain/ProcessXML';
      $user_id = $this->Auth->user('id');
      $xml_error = 'FALSE';
      $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');
      $content_xml_str = '  <soap:Body>
      <ProcessXML xmlns="http://www.travel.domain/">
      <RequestInfo>
      <ResourceDataRequest>
      <RequestAuditInfo>
      <RequestType>PXML_WData_ReviewTopics</RequestType>
      <RequestTime>'.$CreatedDate.'</RequestTime>
      <RequestResource>Silkrouters</RequestResource>
      </RequestAuditInfo>
      <RequestParameters>
      <ResourceData>
      <ResourceDetailsData srno="1" actiontype="AddNew">
      <ReviewTopicsId>'.$reviewTopicID.'</ReviewTopicsId>
      <ReviewTopic>'.$reviewTopicValue.'</ReviewTopic>
      </ResourceDetailsData>
      </ResourceData>
      </RequestParameters>
      </ResourceDataRequest>
      </RequestInfo>
      </ProcessXML>
      </soap:Body>';
      $log_call_screen = 'Reviews Topics - Add';
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
      if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
      $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
      $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
      $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
      //update the status in local server
      $this->TravelLookupReviewTopic->updateAll(array('TravelLookupReviewTopic.wtb_status' => "'1'"), array('TravelLookupReviewTopic.id' => $reviewTopicID));
      } else {
      $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
      $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
      $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
      $this->TravelLookupReviewTopic->updateAll(array('TravelLookupReviewTopic.wtb_status' => "'2'"), array('TravelLookupReviewTopic.id' => $reviewTopicID));
      $xml_error = 'TRUE';
      }
      } catch (SoapFault $exception) {
      /*var_dump(get_class($exception));
      var_dump($exception);*/
      $returnData['STATUS']="FAILED";
      $returnData['MESSAGE']="Unable to call the URL Using Soap";
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
      /*
      $Email = new CakeEmail();
      $Email->viewVars(array(
      'request_xml' => trim($xml_string),
      'respon_message' => $log_call_status_message,
      'respon_code' => $log_call_status_code,
      ));
      $to = 'biswajit@wtbglobal.com';
      $cc = 'infra@sumanus.com';
      $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date('d/m/y H:i:s') . ']')->send();
      */
      $returnData['STATUS']="SUCCESS";
      $returnData['MESSAGE']='<div class="alert alert-warning">Aminity category updated successfully in local machine.<br>Foreign machine not updated successfully / '.$log_call_status_message.'.</div>';$returnData['DATA']=$reviewTopicID;
      }else{
      $returnData['STATUS']="SUCCESS";
      $returnData['MESSAGE']="";
      $returnData['MESSAGE']='<div class="alert alert-success">Aminity category updated successfully.<br>Foreign machine also updated successfully.</div>';
      }


      }else{
      $returnData['MESSAGE']='<div class="alert alert-success">An error occured</div>';
      }
      }else{
      $returnData['MESSAGE']='<div class="alert alert-success">An error occured</div>';
      }
      }else{
      $returnData['MESSAGE']='<div class="alert alert-success">An error occured</div>';
      }
      }else{
      $returnData['MESSAGE']='<div class="alert alert-success">An error occured</div>';
      }
      echo json_encode($returnData);
      exit();
    }


    public function addAminityCategoryType(){
        $returnData="FAILED";
        $this->autoRender = false ;
        if ($this->request->is('ajax')) {
        if(!empty($this->request->data)){
        if (($this->request->data['aminity_type_value']!='') && ($this->request->data['category_id']!='') ) {
        $allTypes=explode(',', $this->request->data['aminity_type_value']);
        $dataToBeSave=array();
        foreach ($allTypes as $atype) {
        if(trim($atype) !=''){
        $checkExistance=$this->TravelLookupAmenityType->find('all',array('conditions'=>array('TravelLookupAmenityType.amenity_category_id'=>$this->request->data['category_id'],'value'=>$atype)));
        if(empty($checkExistance)){
        $innerData=array();
        $innerData['amenity_category_id']=$this->request->data['category_id'];
        $innerData['value']=$atype;
        array_push($dataToBeSave, $innerData);
        }
        }
        }
        $this->TravelLookupAmenityType->saveAll($dataToBeSave);
        $returnData="SUCCESS";
        }else{
        $returnData= 'Data and Id Must Not Empty!';
        }
        }else{
        $returnData= 'Data Must Not Empty!';
        }
        }else{
        $returnData= 'Not a Valid Request!';
        }
        echo $returnData;
        exit();
    }
    

    public function deleteAminityCategory(){
      $returnData="FAILED";
      $this->autoRender = false ;
      if ($this->request->is('ajax')) {
      if(!empty($this->request->data)){
      if($this->request->data['id']!='') {
      $deleteData=$this->TravelLookupAmenityCategorie->delete($this->request->data['id']);
      if($deleteData){


      //delete from foreign machine
      $deleteAminityCategoryID=$this->request->data['id'];
      $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
      $action_URL = 'http://www.travel.domain/ProcessXML';
      $user_id = $this->Auth->user('id');
      $xml_error = 'FALSE';
      $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');


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
      <ResourceDetailsData srno="1" lookuptype="AmenityCategory">
      <AmenityCategoryId>'.$deleteAminityCategoryID.'</AmenityCategoryId>                        
      </ResourceDetailsData>
      </ResourceData>
      </RequestParameters>
      </ResourceDataRequest>
      </RequestInfo>
      </ProcessXML>
      </soap:Body>';

      $log_call_screen = 'Amenity Categories - Delete';
      $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');

      $client = new SoapClient(null, array(
      'location' => $location_URL,
      'uri' => '',
      'trace' => 1,
      ));

      try {
      $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
      $xml_arr = $this->xml2array($order_return);
      echo htmlentities($xml_string);
      pr($xml_arr);
      die;

      if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
      $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
      $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
      $xml_msg = "Foreign record has been successfully created [Code:$log_call_status_code]";
      } else {

      $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
      $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_AMENITYCATEGORIES']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
      $xml_msg = "There was a problem with foreign record creation [Code:$log_call_status_code]";
      $xml_error = 'TRUE';
      }

      } catch (SoapFault $exception) {
      echo "XML Call Failed";
      exit();
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
      /*
      $Email = new CakeEmail();

      $Email->viewVars(array(
      'request_xml' => trim($xml_string),
      'respon_message' => $log_call_status_message,
      'respon_code' => $log_call_status_code,
      ));

      $to = 'biswajit@wtbglobal.com';
      $cc = 'infra@sumanus.com';

      $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date('d/m/y H:i:s') . ']')->send();
      */
      $returnData ='Unable to delete in foreigh machine';
      }else{
      $returnData ='SUCCESS';
      }
      }else{
      $returnData= 'Unable to Delete!';
      }
      }else{
      $returnData= 'Id Must Not Empty!';
      }
      }else{
      $returnData= 'Data Must Not Empty!';
      }
      }else{
      $returnData= 'Not a Valid Request!';
      }
      echo $returnData;
      exit();
    }

    public function deleteAminityCategoryTypes(){
      $returnData="FAILED";
      $this->autoRender = false ;
      if ($this->request->is('ajax')) {
      if(!empty($this->request->data)){
      if($this->request->data['id']!='') {
      $deleteData=$this->TravelLookupAmenityType->deleteAll(array('TravelLookupAmenityType.amenity_category_id'=>$this->request->data['id']),false);
      if($deleteData){
      $returnData ='SUCCESS';
      }else{
      $returnData= 'Unable to Delete!';
      }
      }else{
      $returnData= 'Id Must Not Empty!';
      }
      }else{
      $returnData= 'Data Must Not Empty!';
      }
      }else{
      $returnData= 'Not a Valid Request!';
      }
      echo $returnData;
      exit();
    }


    public function deleteReviewsTopics(){
      $returnData="FAILED";
      $this->autoRender = false ;
      if ($this->request->is('ajax')) {
      if(!empty($this->request->data)){
      if($this->request->data['id']!='') {
      $deleteData=$this->TravelLookupReviewTopic->delete($this->request->data['id']);
      if($deleteData){
      //delete from foreign machine
      $reviewTopicID=$this->request->data['id'];
      $location_URL = 'http://dev.wtbnetworks.com/TravelXmlManagerv001/ProEngine.Asmx';
      $action_URL = 'http://www.travel.domain/ProcessXML';
      $user_id = $this->Auth->user('id');
      $xml_error = 'FALSE';
      $CreatedDate = date('Y-m-d') . 'T' . date('h:i:s');


      $content_xml_str = ' <soap:Body>
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
      <ResourceDetailsData srno="1" lookuptype="ReviewTopic">
      <ReviewTopicId>'.$reviewTopicID.'</ReviewTopicId>                        
      </ResourceDetailsData>
      </ResourceData>
      </RequestParameters>
      </ResourceDataRequest>
      </RequestInfo>
      </ProcessXML>
      </soap:Body>';

      $log_call_screen = 'Review Topics - Delete';
      $xml_string = Configure::read('travel_start_xml_str') . $content_xml_str . Configure::read('travel_end_xml_str');

      $client = new SoapClient(null, array(
      'location' => $location_URL,
      'uri' => '',
      'trace' => 1,
      ));

      try {
      $order_return = $client->__doRequest($xml_string, $location_URL, $action_URL, 1);
      $xml_arr = $this->xml2array($order_return);
      echo htmlentities($xml_string);
      pr($xml_arr);
      die;

      if ($xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0] == '201') {
      echo 'hi';exit();
      $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0];
      $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['UPDATEINFO']['STATUS'][0];
      $xml_msg = "Foreign record has been successfully deleted [Code:$log_call_status_code]";

      } else {
      echo 'by';exit();
      $log_call_status_message = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['ERRORINFO']['ERROR'][0];
      $log_call_status_code = $xml_arr['SOAP:ENVELOPE']['SOAP:BODY']['PROCESSXMLRESPONSE']['PROCESSXMLRESULT']['RESOURCEDATA_REVIEWTOPICS']['RESPONSEAUDITINFO']['RESPONSEINFO']['RESPONSEID'][0]; // RESPONSEID
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

      if ($xml_error == 'TRUE') {
      /*
      $Email = new CakeEmail();

      $Email->viewVars(array(
      'request_xml' => trim($xml_string),
      'respon_message' => $log_call_status_message,
      'respon_code' => $log_call_status_code,
      ));

      $to = 'biswajit@wtbglobal.com';
      $cc = 'infra@sumanus.com';

      $Email->template('XML/xml', 'default')->emailFormat('html')->to($to)->cc($cc)->from('admin@silkrouters.com')->subject('XML Error [' . $log_call_screen . '] Open By [' . $this->User->Username($user_id) . '] Date [' . date('d/m/y H:i:s') . ']')->send();
      */
      $returnData= 'Unable to delete in foreign machine!';
      }else{
      $returnData ='SUCCESS';
      }

      }else{
      $returnData= 'Unable to Delete!';
      }
      }else{
      $returnData= 'Id Must Not Empty!';
      }
      }else{
      $returnData= 'Data Must Not Empty!';
      }
      }else{
      $returnData= 'Not a Valid Request!';
      }
      echo $returnData;
      exit();
    }


}
?>