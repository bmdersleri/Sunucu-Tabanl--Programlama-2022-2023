<?php

  include("php_settings_ajax.php");
  include("base_functions.php");


  if(@$_POST["update_query"]){

    $query_id = $_POST["query_id"];
    $query_name = $_POST["query_name"];
    $query_text = $_POST["query_text"];

    $data = [];
    
    $update= $db->exec("UPDATE section_queries SET query_name='$query_name',query='$query_text' where query_id='$query_id'  ");

    if($update){
      $data_item = getNotificationArray("success","Query Updated","Query Id: ".$query_id."<br>Query update was succesful");
      array_push($data,$data_item);
    }else{
      $data_item = getNotificationArray("error","Query Update Fail","Query Id: ".$query_id."<br>Something went wrong.<br>Please try again.");
      array_push($data,$data_item);
    }

    echo json_encode($data);
  }




  
  if(@!$_POST){
    
    Redirect();

  }



?>
