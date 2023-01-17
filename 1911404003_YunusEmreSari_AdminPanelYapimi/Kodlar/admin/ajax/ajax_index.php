<?php

  include("php_settings_ajax.php");
  include("base_functions.php");



  if(@$_POST["change_state_item"]){

    $game_id = $_POST["change_state_item_id"];
    $change_to = 0;

    $data = [];

    $games = $db->query("SELECT * FROM games WHERE game_id='$game_id' ")->fetch(PDO::FETCH_ASSOC);

    if($games["game_state"] == 1)
    {
      $change_to = 0;
    }
    else
    {
      $change_to = 1;
    }
    
    $update= $db->exec("UPDATE games SET game_state='$change_to' where game_id='$game_id'  ");

    if($update){
      $data_item = getNotificationArray("success","Remove Game","Game Id: ".$game_id." başarıyla durumu ".$change_to." olarak değiştirildi.");
      array_push($data,$data_item);
    }
    else
    {
      $data_item = getNotificationArray("error","Remove Game","Game Id: ".$game_id." ".$change_to." durumuna değiştirilirken bir hata oluştu.");
      array_push($data,$data_item);
    }

    echo json_encode($data);

  }



  if(@$_POST["delete_item"]){
    
    $game_id = $_POST["delete_item_id"];

    $sonuc = $db->exec("DELETE FROM games WHERE game_id='$game_id' ");
    $data = [];

    if($sonuc){
      $data_item = getNotificationArray("success","Delete Game","Game Id: ".$game_id." succesfully deleted.");
      array_push($data,$data_item);
    }
    else
    {
      $data_item = getNotificationArray("error","Delete Game","Game Id: ".$game_id." error ocurred while deleting.");
      array_push($data,$data_item);
    }

    echo json_encode($data);

  }



  if(@$_POST["update_notifications"]){

    $query = $db->query("SELECT * FROM notifications ORDER BY notification_id DESC LIMIT 100", PDO::FETCH_ASSOC);
    if($query ->rowCount() == 0)
    echo '
    <div class="notification-item">
      <h3 style="text-align:center">Nothing Here</h3>
    </div>
    ';
    foreach( $query as $row ){
      if($row["notification_type"] === "gap"){
          echo '
          <div class="notification-item '.$row["notification_type"].'">
              <h3>------------------------------------------------</h3>
          </div>
          ';
          continue;    
      }
      echo '
      <div class="notification-item '.$row["notification_type"].'">
          <h3>'.htmlspecialchars_decode($row["notification_title"]).'</h3>
          '.htmlspecialchars_decode($row["notification_desc"]).'
           <h4>'.$row["notification_date"].'</h4>
      </div>
      ';
    }
  }



  if(@$_POST["add_notification"]){

    $notification_type = $_POST["notification_type"];
    
    $notification_title = htmlspecialchars($_POST["notification_title"]);
    $notification_desc = htmlspecialchars($_POST["notification_desc"]);
    $notification_state = 0;

    $notification_date = "";
    if($notification_type != "gap")
      $notification_date = $datetime_now;
    
    $ekle=$db->query("insert into notifications(notification_id,notification_type,notification_title,notification_desc,notification_date,notification_state) 
    values('','$notification_type','$notification_title','$notification_desc','$notification_date','$notification_state')");
    
  }




  if(@$_POST["update_prices"]){

    $price_id = $_POST["price_id"];
    $price_initial = $_POST["price_initial"];
    $price_final = $_POST["price_final"];

    // echo $price_id."<br>";
    // echo $price_initial."<br>";
    // echo $price_final."<br>";

    $update = $db->exec("UPDATE game_prices SET price_initial='$price_initial', price_final='$price_final' where price_id='$price_id'  ");

    $data = [];

    if($update){
      $data_item = getNotificationArray("success","Update Game Prices","Price Id: ".$price_id." prices updated.");
      array_push($data,$data_item);
    }
    else
    {
      $data_item = getNotificationArray("error","Update Game Prices","Price Id: ".$price_id." error ocurred while updating.");
      array_push($data,$data_item);
    }

    echo json_encode($data);

  }



  if(@!$_POST){

    Redirect();

    // echo $update = $db->exec("UPDATE game_prices SET price_initial=19,price_final=19 where price_id=136  ");


  }

?>