<?php 
$this->Html->addCrumb('My Data','javascript:void(0);', array('class' => 'breadcrumblast'));

if ($foreignMachineRunningStatus == "true"){
$foreignMachineStatusMessage = "All services running normally.";
$foreignMachineStatusColor='#ffff42';
}else {
$foreignMachineStatusMessage = "Some services are offline. Please try later.";
$foreignMachineStatusColor='#d28abb'; 
}
        
?>
<div align="center" class="col-sm-12" style="font-size: 15px; font-family: sans-serif">
        <p style="color: black; background-color:<?php echo $foreignMachineStatusColor;?>">
        <?php 
        echo $foreignMachineStatusMessage;
         ?>
        </p>
    </div>

<div id="statusMessageBlock">
<div id="statusMessageBlockCloseBtn" onclick="closeStatusMessageBlock()">x</div>
<div id="statusMessageContent">
  
</div>
</div>
<style type="text/css">
  
.panel-heading .accordion-toggle:after {
    /* symbol for "opening" panels */
    font-family: 'Glyphicons Halflings';  /* essential for enabling glyphicon */
    content: "\e114";    /* adjust as needed, taken from bootstrap.css */
    float: right;        /* adjust as needed */
    color: grey;         /* adjust as needed */
}
.panel-heading .accordion-toggle.collapsed:after {
    /* symbol for "collapsed" panels */
    content: "\e080";    /* adjust as needed, taken from bootstrap.css */
}
div#statusMessageBlock {
    position: relative;
}
#statusMessageBlockCloseBtn{
  position: absolute;
    right: 5px;
    top: 22%;
    padding: 6px;
    border-radius: 10px;
    cursor: pointer;
}
.statusMessageBlockError {
    margin-bottom: 18px;
    border-left: 4px solid red;
    background-color: #f2dede;
    text-shadow: 0 1px 0 rgba(255,255,255,0.5);
    padding: 12px 20px 12px 14px;
    color: red;
}
.statusMessageBlockSuccess {
    margin-bottom: 18px;
    border-left: 4px solid green;
    background-color: #9ad49a;
    text-shadow: 0 1px 0 rgba(255,255,255,0.5);
    padding: 12px 20px 12px 14px;
    color: #6e1451;
}

</style>


 <!-- Modal -->
  <div class="modal fade" id="editAminityTypesModalId" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="top:15%;">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close onModalCloseUpdateAminityValuesColumnID" data-dismiss="modal" >&times;</button>
          <h4 class="modal-title" id="editAminityTypesModalTitleID">Edit</h4>
        </div>
        <p id="modalStatusMessage" style=" padding-left: 20px; "></p>
        <div class="modal-body" id="modalContentStart">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default onModalCloseUpdateAminityValuesColumnID" data-dismiss="modal" >Close</button>
        </div>
      </div>
      
    </div>
  </div>
  







<div class="row">
<div class="col-sm-12">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">Amenity & Review Data</h4>
</div>
<div class="panel-body">
<div class="row">

<div class="col-sm-12">
<div class="panel-group" id="accordion2">
<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc1_collapseone">
Amenity Categories
</a>
</h4>
</div>
<div id="acc1_collapseone" class="panel-collapse collapse">
<div class="panel-body">
 <button class="btn btn-success" onclick="openAddAminityCategoryModal()" >Add</button>
<table class="table" id="aminityCategoryTableId">
     <tr>
          <th width="10%">ID</th>
           <th width="70%">Value</th>
         <th width="13%">Action</th>
     </tr>
     <?php
           
          $i = 1;
     if (isset($categories) && count($categories) > 0):
         foreach ($categories as $category):
          //pr($category);die();
             $id = $category['TravelLookupAmenityCategorie']['id'];
             ?>
             <tr id="aminityCategoryTRID<?php echo $category['TravelLookupAmenityCategorie']['id']; ?>">
                <td align="left" valign="right" class="tablebody">
                <?php echo $category['TravelLookupAmenityCategorie']['id']; ?>
                  
                </td>
                <td align="left" valign="left" class="tablebody">
                <span id="amenityCategoryTextBox<?php echo $category['TravelLookupAmenityCategorie']['id']; ?>"><?php echo $category['TravelLookupAmenityCategorie']['value']; ?></span>
                  <input type="text" value="<?php echo $category['TravelLookupAmenityCategorie']['value']; ?>" class="hidden form-control" id="amenityCategoryInputField<?php echo $category['TravelLookupAmenityCategorie']['id']; ?>">
                </td>

                 <td align="center" valign="middle">
                 <button class="btn btn-success " id="amenityCategoryEditBtn<?php echo $category['TravelLookupAmenityCategorie']['id']; ?>" onclick="showAminityCategoryEditBox(<?php echo $category['TravelLookupAmenityCategorie']['id']; ?>)" >Edit</button>

                 <button class="btn btn-success hidden" id="amenityCategoryUpdateBtn<?php echo $category['TravelLookupAmenityCategorie']['id']; ?>" onclick="updateAminityCategory(<?php echo $category['TravelLookupAmenityCategorie']['id']; ?>)" >Update</button>

                 <button class="btn btn-danger " id="amenityCategoryDeleteBtn<?php echo $category['TravelLookupAmenityCategorie']['id']; ?>" onclick="deleteAminityCategory(<?php echo $category['TravelLookupAmenityCategorie']['id']; ?>)" >Delete</button>
                 
                 </td>
             </tr>
         
             <?php
             $i++;
         endforeach;
     endif;
     ?>
 </table>                                          
 
</div>
</div>
</div>


<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc1_collapseTwo">
Amenity Types
</a>
</h4>
</div>
<div id="acc1_collapseTwo" class="panel-collapse collapse">
<div class="panel-body">
 <button class="btn btn-success" onclick="openAddAminityCategoryTypeModal()" >Add</button>
<table class="table" id="aminityCategoryTypeTableId">
     <tr>
          <th width="10%">ID</th>
           <th width="10%">Value</th>
<th width="60%">Amenities</th>	
         <th width="13%">Action</th>
     </tr>
     <?php
   
          // pr($amenities);
          $i = 1;
     if (isset($amenities) && count($amenities) > 0):
         foreach ($amenities as $key => $amenitie) :
             $id = $amenities[$key]['TravelLookupAmenityType']['amenity_category_id'];
             ?>
             <tr id="aminityCategoryTypesTRID<?php echo $id;?>">
                <td align="left" valign="right" class="tablebody"><?php echo $i; ?></td>
                <td align="left" valign="right" class="tablebody" id="travelLookupAmenityTypeCategoryName<?php echo $i; ?>"><?php echo $amenities[$key]['TravelLookupAmenityCategorie']['value']; ?></td>
                <td align="left" valign="left" class="tablebody" id="allAminityTypeListingInTDID<?php echo $id; ?>"><?php echo $amenities[$key][0]['amenity_name']; ?></td>

                 <td align="center" valign="middle">
                 <button class="btn btn-success" id="amenityTypeEditBtn<?php echo $i; ?>" onclick="openEditAminityTypesPopup(<?php echo $id.','.$i; ?>)" >Edit</button>

                 <button class="btn btn-danger " id="amenityCategoryDeleteBtn<?php echo $category['TravelLookupAmenityCategorie']['id']; ?>" onclick="deleteAminityCategoryTypes(<?php echo $id; ?>)" >Delete</button>
                 </td>
             </tr>
         
             <?php
             $i++;
         endforeach;
     endif;
     ?>
 </table>                                          
 
</div>
</div>
</div>


<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#acc1_collapsethree">
Review Topics
</a>
</h4>
</div>
<div id="acc1_collapsethree" class="panel-collapse collapse">
<div class="panel-body">
 <button class="btn btn-success" onclick="openAddReviewTopicModal()" >Add</button>
<table class="table" id="reviewTopicTableId">
     <tr>
          <th width="10%">ID</th>
           <th width="70%">Value</th>
         <th width="13%">Action</th>
     </tr>
     <?php
           
          $i = 1;
     if (isset($reviewsTopics) && count($reviewsTopics) > 0):
         foreach ($reviewsTopics as $reviewsTopic):
          //pr($category);die();
             $id = $reviewsTopic['TravelLookupReviewTopic']['id'];
             ?>
             <tr id="reviewsTopicsTRID<?php echo $id;?>">
                <td align="left" valign="right" class="tablebody">
                <?php echo $reviewsTopic['TravelLookupReviewTopic']['id']; ?>
                  
                </td>
                <td align="left" valign="left" class="tablebody">
                <span id="reviewsTopicsTextBox<?php echo $reviewsTopic['TravelLookupReviewTopic']['id']; ?>"><?php echo $reviewsTopic['TravelLookupReviewTopic']['value']; ?></span>
                  <input type="text" value="<?php echo $reviewsTopic['TravelLookupReviewTopic']['value']; ?>" class="hidden form-control" id="reviewsTopicsInputField<?php echo $reviewsTopic['TravelLookupReviewTopic']['id']; ?>">
                </td>

                 <td align="center" valign="middle">
                 <button class="btn btn-success " id="reviewsTopicsEditBtn<?php echo $reviewsTopic['TravelLookupReviewTopic']['id']; ?>" onclick="showReviewsTopicsEditBox(<?php echo $reviewsTopic['TravelLookupReviewTopic']['id']; ?>)" >Edit</button>

                 <button class="btn btn-success hidden" id="reviewsTopicsUpdateBtn<?php echo $reviewsTopic['TravelLookupReviewTopic']['id']; ?>" onclick="updateReviewsTopics(<?php echo $reviewsTopic['TravelLookupReviewTopic']['id']; ?>)" >Update</button>

                 <button class="btn btn-danger " id="reviewsTopicsDeleteBtn<?php echo $category['TravelLookupAmenityCategorie']['id']; ?>" onclick="deleteReviewsTopics(<?php echo $id; ?>)" >Delete</button>
                 
                 </td>
             </tr>
         
             <?php
             $i++;
         endforeach;
     endif;
     ?>
 </table>                                          
 
   
</div>
</div>
</div>






</div>
</div>
</div>
</div>
</div>
</div>
</div>








<script type="text/javascript">

function closeStatusMessageBlock() {
  $("#statusMessageContent").html('');
}
function openModal(title,content) {
  $("#modalStatusMessage").html("");
  $("#editAminityTypesModalTitleID").text(title);
  $("#modalContentStart").html(content);
  $("#editAminityTypesModalId").modal();
}
function openAddAminityCategoryModal() {
  content='<label>Aminity Category Name</label><input type="text" id="newAminityCategoryAddTextBox" class="form-control" ><br><button class="btn btn-success" id="newAminityCategoryAddBtn" onclick="addAminityCategory()" >Add</button>';
  openModal('Add Aminity Category',content);
}
function addAminityCategory() {
  if($("#newAminityCategoryAddTextBox").val().trim() !=''){
    $("#newAminityCategoryAddBtn").text("Please wait...");
        $("#newAminityCategoryAddBtn").attr("disabled","disabled");
    textVal=$("#newAminityCategoryAddTextBox").val().trim();
    $.ajax({
      url:'<?php echo Router::url(array('controller' => 'travel_look_ups','action' => 'addAminityCategory'));?>',
      type:'POST',
      data:'aminity_value='+textVal,
      success:function(data) {
        console.log(data);
        $("#editAminityTypesModalId").modal('hide');
        if(data>0){
          $("#aminityCategoryTableId").append('<tr id="aminityCategoryTRID'+data+'"><td align="left" valign="right" class="tablebody">'+data+'</td><td align="left" valign="left" class="tablebody"><span id="amenityCategoryTextBox'+data+'">'+textVal+'</span><input type="text" value="'+textVal+'" class="hidden form-control" id="amenityCategoryInputField'+data+'"></td><td align="center" valign="middle"><button class="btn btn-success " id="amenityCategoryEditBtn'+data+'" onclick="showAminityCategoryEditBox('+data+')" >Edit</button><button class="btn btn-success hidden" id="amenityCategoryUpdateBtn'+data+'" onclick="updateAminityCategory('+data+')" >Update</button> <button class="btn btn-danger " id="amenityCategoryDeleteBtn'+data+'" onclick="deleteAminityCategory('+data+')" >Delete</button></td></tr>');
          $("#newAminityCategoryAddTextBox").val("");
          $("#modalStatusMessage").html('<span style="color:green">Aminity Category Added Successfully</span>');
        }else{
          $("#modalStatusMessage").html('<span style="color:red">Unable to Add Aminity Category!</span>');
        }
        setTimeout(function() {
        $('#modalStatusMessage').html('');
        }, 2000);
        $("#newAminityCategoryAddBtn").text("Add");
        $("#newAminityCategoryAddBtn").removeAttr("disabled");
      }
    });
  }
}



function openAddReviewTopicModal() {
  content='<label>Review Topic Name</label><input type="text" id="newReviewTopicAddTextBox" class="form-control" ><br><button class="btn btn-success" id="newReviewTopicAddBtn" onclick="addReviewTopic()" >Add</button>';
  openModal('Add Review Topic',content);
}
function addReviewTopic() {
  if($("#newReviewTopicAddTextBox").val().trim() !=''){
    $("#newReviewTopicAddBtn").text("Please wait...");
        $("#newReviewTopicAddBtn").attr("disabled","disabled");
    textVal=$("#newReviewTopicAddTextBox").val().trim();
    $.ajax({
      url:'<?php echo Router::url(array('controller' => 'travel_look_ups','action' => 'addReviewTopic'));?>',
      type:'POST',
      data:'review_topic_value='+textVal,
      success:function(data) {
        console.log(data);
        if(data>0){
          $("#reviewTopicTableId").append('<tr id="reviewsTopicsTRID'+data+'"><td align="left" valign="right" class="tablebody">'+data+'</td><td align="left" valign="left" class="tablebody"><span id="reviewsTopicsTextBox'+data+'">'+textVal+'</span><input type="text" value="'+textVal+'" class="hidden form-control" id="reviewsTopicsInputField'+data+'"></td><td align="center" valign="middle"><button class="btn btn-success " id="reviewsTopicsEditBtn'+data+'" onclick="showReviewsTopicsEditBox('+data+')" >Edit</button><button class="btn btn-success hidden" id="reviewsTopicsUpdateBtn'+data+'" onclick="updateReviewsTopics('+data+')" >Update</button><button class="btn btn-danger " id="reviewTopicDeleteBtn'+data+'" onclick="deleteReviewsTopics('+data+')" >Delete</button></td></tr>');
          $("#newReviewTopicAddTextBox").val("");
          $("#modalStatusMessage").html('<span style="color:green">Review Topic Arred Successfully</span>');
        }else{
          $("#modalStatusMessage").html('<span style="color:red">Unable to Add Review Topic!</span>');
        }
        setTimeout(function() {
        $('#modalStatusMessage').html('');
        }, 2000);
        $("#newReviewTopicAddBtn").text("Add");
        $("#newReviewTopicAddBtn").removeAttr("disabled");
      }
    });
  }
}



function openAddAminityCategoryTypeModal() {
  
  <?php
  $aOptions='';
  foreach ($categories as $categoryData) {
  
    $aOptions.='<option value="'.$categoryData['TravelLookupAmenityCategorie']['value'].'/'.$categoryData['TravelLookupAmenityCategorie']['id'].'">'.$categoryData['TravelLookupAmenityCategorie']['value'].' / '.$categoryData['TravelLookupAmenityCategorie']['id'].'</option>';
   
  }
  ?>
  content='<label>Aminity Category</label><select id="newAminityCategoryTypeAddSelectBox" class="form-control"><?php echo $aOptions;?></select><br><label>Aminity Type Name</label><input type="text" id="newAminityCategoryTypeAddTextBox" class="form-control" ><br><button class="btn btn-success" id="newAminityCategoryTypeAddBtn" onclick="addAminityCategoryType()" >Add</button>';
  openModal('Add Aminity Type',content);
}

function addAminityCategoryType() {
  if($("#newAminityCategoryTypeAddTextBox").val().trim() !=''){
    $("#newAminityCategoryTypeAddBtn").text("Please wait...");
    $("#newAminityCategoryTypeAddBtn").attr("disabled","disabled");
    textVal=$("#newAminityCategoryTypeAddTextBox").val().trim();
    category_data=$("#newAminityCategoryTypeAddSelectBox").val().split('/');
    aminity_category=category_data[1];
    category_name=category_data[0];
    $.ajax({
      url:'<?php echo Router::url(array('controller' => 'travel_look_ups','action' => 'addAminityCategoryType'));?>',
      type:'POST',
      data:'aminity_type_value='+textVal+'&category_id='+aminity_category,
      success:function(data) {

        console.log(data);
        if(data=="SUCCESS"){
          if($("#allAminityTypeListingInTDID"+aminity_category).length>0)
          {
            $("#allAminityTypeListingInTDID"+aminity_category).text($("#allAminityTypeListingInTDID"+aminity_category).text()+','+textVal);
          }else{
          $("#aminityCategoryTypeTableId").append('<tr id="aminityCategoryTypesTRID'+aminity_category+'"><td align="left" valign="right" class="tablebody">'+aminity_category+'</td><td align="left" valign="right" class="tablebody" id="travelLookupAmenityTypeCategoryName'+aminity_category+'">'+category_name+'</td><td align="left" valign="left" class="tablebody" id="allAminityTypeListingInTDID'+aminity_category+'">'+textVal+'</td><td align="center" valign="middle"><button class="btn btn-success" id="amenityTypeEditBtn'+aminity_category+'" onclick="openEditAminityTypesPopup('+aminity_category+','+aminity_category+')" >Edit</button> <button class="btn btn-danger " id="amenityCategoryDeleteBtn'+aminity_category+'" onclick="deleteAminityCategoryTypes(aminity_category)" >Delete</button></td></tr>');
         }

          $("#newAminityCategoryAddTextBox").val("");
          $("#modalStatusMessage").html('<span style="color:green">Aminity Type added successfully!</span>');
        }else{
           $("#modalStatusMessage").html('<span style="color:red">Unable to Add Aminity Type!</span>');
        }
        setTimeout(function() {
        $('#modalStatusMessage').html('');
        }, 2000);
        $("#newAminityCategoryTypeAddBtn").text("Add");
        $("#newAminityCategoryTypeAddBtn").removeAttr("disabled");
      }
    });
  }
}












  function showAminityCategoryEditBox(id) {
    $("#amenityCategoryTextBox"+id).addClass("hidden");
    $("#amenityCategoryEditBtn"+id).addClass("hidden");
    $("#amenityCategoryInputField"+id).removeClass("hidden");
    $("#amenityCategoryUpdateBtn"+id).removeClass("hidden");
  }

  function updateAminityCategory(id) {
    $("#amenityCategoryUpdateBtn"+id).text("Updating...");
    $("#amenityCategoryUpdateBtn"+id).attr("disabled","disabled");
    var text=$("#amenityCategoryInputField"+id).val();
    $.ajax({
      url:'<?php echo Router::url(array('controller' => 'travel_look_ups','action' => 'updateAminityCategory'));?>',
      type:'POST',
      data:'category_value='+text+'&category_id='+id,
      success:function(data) {
        console.log(data);
        try{
          returnData=JSON.parse(data);
          $("#amenityCategoryTextBox"+id).removeClass("hidden");
          $("#amenityCategoryEditBtn"+id).removeClass("hidden");
          $("#amenityCategoryInputField"+id).addClass("hidden");
          $("#amenityCategoryUpdateBtn"+id).addClass("hidden");
          $("#amenityCategoryUpdateBtn"+id).text("Update");
          $("#amenityCategoryUpdateBtn"+id).removeAttr("disabled");
          $("#statusMessageContent").html(returnData['MESSAGE']);
          if(returnData['STATUS']=="SUCCESS"){
          $("#amenityCategoryTextBox"+id).text(text);
          }
        }catch(e){
          $("#statusMessageContent").html('<div class="statusMessageBlockError">Unable to process your request!<br></div>');
        }
      }
    });
  }




  function openEditAminityTypesPopup(id,i) {
    $("#amenityTypeEditBtn"+i).text("Please Wait...");
    $("#editAminityTypesModalTitleID").text('Edit - '+$("#travelLookupAmenityTypeCategoryName"+i).text());
    $(".onModalCloseUpdateAminityValuesColumnID").attr("onclick","onModalCloseUpdateAminityValuesColumn("+id+")");
    $.ajax({
      url:'<?php echo Router::url(array('controller' => 'travel_look_ups','action' => 'getAminityTypes'));?>',
      type:'POST',
      data:'category_id='+id,
      success:function(data) {
        retData=JSON.parse(data);
        if(retData['STATUS']=="SUCCESS"){
          $("#amenityTypeEditBtn"+i).text("Edit");
          $("#editAminityTypesModalId").modal();
          $("#modalContentStart").html(retData['DATA']);
        }else{
          $("#editAminityTypesModalId").modal();
          $("#modalContentStart").html("Unable to fetch the data..");
        }
      }
    });
    
  }

function deleteAminityType(id) {
  var confirmation=confirm("Are you sure want to delete this record?");
  if(confirmation){
  $.ajax({
      url:'<?php echo Router::url(array('controller' => 'travel_look_ups','action' => 'deleteAminityType'));?>',
      type:'POST',
      data:'aminity_type_id='+id,
      success:function(data) {
        if(data=="SUCCESS"){
          $("#aminityTypeDeleteListingId"+id).remove();
        }else{
          alert("Unable to delete! Please try again..");
        }
      }
    });
  }
}

function addNewAmenityType(id) {
  $("#addNewAmenityTypeBtnId").text("Please wait...");
    $("#addNewAmenityTypeBtnId").attr("disabled","disabled");
  aminityText=$("#addNewAminityTypeInputBoxId").val().trim();
  if(aminityText!=''){
  $.ajax({
      url:'<?php echo Router::url(array('controller' => 'travel_look_ups','action' => 'addAminityType'));?>',
      type:'POST',
      data:'aminity_value='+aminityText+'&category_id='+id,
      success:function(data) {
        if(data>0){
          $("#aminityTypeAddListingULId").append('<li class="list-group-item" id="aminityTypeDeleteListingId'+data+'" style="border: 1px solid #e5e5e5;">'+aminityText+'<span class="badge" onclick="deleteAminityType('+data+')" style="color:red;font-weight:bold;cursor:pointer;"><span class="glyphicon glyphicon-remove"></span></span></li>');
          $("#addNewAminityTypeInputBoxId").val("");
          $("#modalStatusMessage").html('<span style="color:green">Aminity added successfully!</span>');
        }else{
          $("#modalStatusMessage").html('<span style="color:red">Unable to Add The Aminity!</span>');
        }
        setTimeout(function() {
        $('#modalStatusMessage').html('');
        }, 2000);
        $("#addNewAmenityTypeBtnId").text("Add");
        $("#addNewAmenityTypeBtnId").removeAttr("disabled");
      }
    });
  }
}


function onModalCloseUpdateAminityValuesColumn(id) {
  $("#modalContentStart").html('');
  $.ajax({
      url:'<?php echo Router::url(array('controller' => 'travel_look_ups','action' => 'getAllAminityType'));?>',
      type:'POST',
      data:'category_id='+id,
      success:function(data) {
        console.log(data);
        if(data!="FAILED"){
          $("#allAminityTypeListingInTDID"+id).html(data);
        }
      }
    });
}




function showReviewsTopicsEditBox(id) {
    $("#reviewsTopicsTextBox"+id).addClass("hidden");
    $("#reviewsTopicsEditBtn"+id).addClass("hidden");
    $("#reviewsTopicsInputField"+id).removeClass("hidden");
    $("#reviewsTopicsUpdateBtn"+id).removeClass("hidden");
  }

  function updateReviewsTopics(id) {
    $("#reviewsTopicsUpdateBtn"+id).text("Updating...");
    $("#reviewsTopicsUpdateBtn"+id).attr("disabled","disabled");
    var text=$("#reviewsTopicsInputField"+id).val().trim();
    $.ajax({
      url:'<?php echo Router::url(array('controller' => 'travel_look_ups','action' => 'updateReviewsTopics'));?>',
      type:'POST',
      data:'review_value='+text+'&review_id='+id,
      success:function(data) {
          console.log(data);
          try{
              returnData=JSON.parse(data);
        if(returnData['STATUS']=="SUCCESS"){
          $("#reviewsTopicsTextBox"+id).text(text);
          $("#reviewsTopicsTextBox"+id).removeClass("hidden");
          $("#reviewsTopicsEditBtn"+id).removeClass("hidden");
          $("#reviewsTopicsInputField"+id).addClass("hidden");
          $("#reviewsTopicsUpdateBtn"+id).addClass("hidden");
          $("#reviewsTopicsUpdateBtn"+id).text("Update");
          $("#reviewsTopicsUpdateBtn"+id).removeAttr("disabled");
          $("#statusMessageContent").html(returnData['MESSAGE']);
        }else{
          $("#statusMessageContent").html('Unable to Update!');
        }
      }catch(e){
         $("#statusMessageContent").html('Unable to Update! An error occured');
      }
    }
    });
  }



function deleteAminityCategory(id) {
  var confirmation=confirm("Are you sure want to delete this record?");
  if(confirmation){
  $.ajax({
      url:'<?php echo Router::url(array('controller' => 'travel_look_ups','action' => 'deleteAminityCategory'));?>',
      type:'POST',
      data:'id='+id,
      success:function(data) {
        console.log(data);
        if(data=="SUCCESS"){
          $("#aminityCategoryTRID"+id).remove();
        }else{
          alert("Unable to delete! Please try again..");
        }
      }
    });
  }
}

function deleteAminityCategoryTypes(id) {
  var confirmation=confirm("Are you sure want to delete this record?");
  if(confirmation){
  $.ajax({
      url:'<?php echo Router::url(array('controller' => 'travel_look_ups','action' => 'deleteAminityCategoryTypes'));?>',
      type:'POST',
      data:'id='+id,
      success:function(data) {
        if(data=="SUCCESS"){
          $("#aminityCategoryTypesTRID"+id).remove();
        }else{
          alert("Unable to delete! Please try again..");
        }
      }
    });
  }
}

function deleteReviewsTopics(id) {
  var confirmation=confirm("Are you sure want to delete this record?");
  if(confirmation){
  $.ajax({
      url:'<?php echo Router::url(array('controller' => 'travel_look_ups','action' => 'deleteReviewsTopics'));?>',
      type:'POST',
      data:'id='+id,
      success:function(data) {
        console.log(data);
        if(data=="SUCCESS"){
          $("#reviewsTopicsTRID"+id).remove();
        }else{
          alert("Unable to delete! Please try again..");
        }
      }
    });
  }
}

</script>