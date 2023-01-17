<?php

  include("php_settings_ajax.php");
  include("base_functions.php");


  // if(@$_POST["delete_epic_store_games"]){

  //   $data = [];

  //   $sonuc = $db->exec("DELETE FROM game_prices where game_epic_app_id!='' AND game_epic_sandbox_id!='' ");

  //   $db->exec("UPDATE games SET game_epic_app_id='' where game_epic_app_id='-'  ");
  //   $sonuc = $db->exec("DELETE FROM epic_free_games ");

  //   if($sonuc){
  //     $data_item = getNotificationArray("success","Deleted","All epic games deleted");
  //     array_push($data,$data_item);
  //   }else{
  //     $data_item = getNotificationArray("error","Fail","Something went wrong.<br>Please try again.");
  //     array_push($data,$data_item);
  //   }

  //   echo json_encode($data);
  // }

  if(@$_POST["delete_steam_games"]){

    $data = [];

    $sonuc = $db->exec("DELETE FROM games where game_steam_app_id!='' AND game_epic_sandbox_id='' ");
    $sonuc = $db->exec("DELETE FROM game_prices where game_steam_app_id!='' AND game_epic_sandbox_id='' ");
    $sonuc = $db->exec("DELETE FROM steam_game_pages ");
    $sonuc = $db->exec("DELETE FROM categories ");
    $sonuc = $db->exec("DELETE FROM game_images ");
    $sonuc = $db->exec("DELETE FROM genres ");
    $sonuc = $db->exec("DELETE FROM game_packages ");
    $sonuc = $db->exec("DELETE FROM game_recommendations ");
    $sonuc = $db->exec("DELETE FROM game_videos ");

    if($sonuc){
      $data_item = getNotificationArray("success","Deleted","All steam games deleted");
      array_push($data,$data_item);
    }else{
      $data_item = getNotificationArray("error","Fail","Something went wrong.<br>Please try again.");
      array_push($data,$data_item);
    }

    echo json_encode($data);
  }


  if(@$_POST["clear_notifications"]){

    $data = [];

    $sonuc = $db->exec("DELETE FROM notifications ");

    if($sonuc){
      $data_item = getNotificationArray("success","Cleared","Notifications cleared.");
      array_push($data,$data_item);
    }else{
      $data_item = getNotificationArray("error","Fail","Something went wrong.<br>Please try again.");
      array_push($data,$data_item);
    }

    echo json_encode($data);
  }


  
  if(@!$_POST){
    
    Redirect();

  }



?>
