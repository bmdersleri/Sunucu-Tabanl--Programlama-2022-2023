<?php

  include("php_settings_ajax.php");
  include("base_functions.php");


  if(@$_POST["update_steam_games"]){

    $min_hour_to_update = $_POST["min_hour_to_update"];
    $game_ids = getSteamGameIds($min_hour_to_update);
    $data = [];

    for ($i=0; $i < count($game_ids); $i++) {
      $data_item = updateSteamGameWithDetails($game_ids[$i],$min_hour_to_update); 
      array_push($data,$data_item);
    }

    echo json_encode($data);

  }



  function getSteamGameIds($min_hour_to_update){

    // $url = "http://localhost/SmurfDeals/admin/steam_games.php?filter=standard_only&min_hour_to_update=".$min_hour_to_update;
    $url = "http://smurfdeals.com/admin/steam_games.php?filter=standard_only&min_hour_to_update=".$min_hour_to_update;

    @$json = file_get_contents($url);
    @$json = json_decode($json,true);//array

    $json_keys = array_keys($json);

    $game_ids = [];

    for ($i=0; $i < count($json_keys); $i++) { 

      $regex = "/\w{0,}(?=edition|base)/";
      $result = preg_match($regex,$json_keys[$i],$matches);
  
      if($result != 0){
        $game_ids[$i]=$matches[0];
      }else{
        continue;
      }
    }

    return $game_ids;
  }



  function updateSteamGameWithDetails($app_id,$min_hour_to_update){
    
    global $db,$datetime_now,$date_now_str;

    $url = "https://store.steampowered.com/api/appdetails?appids=".$app_id."&l=en&cc=us";

    $data = [];
    
    @$json = file_get_contents($url);
    if($json === FALSE)
    {
      // AddToFailedGames($app_id);
      return false;
    }
    @$json = json_decode($json,true);//array

    @$price_overview = $json[$app_id]["data"]["price_overview"];
    @$price_groups= $json[$app_id]["data"]["package_groups"][0]["subs"];
    @$price_currency = $price_overview["currency"];
    @$game_url = "https://store.steampowered.com/app/".$app_id;


    #region Prices 

    if($price_groups != null){
      for ($i=0; $i < count($price_groups) ; $i++) {

        $price_text = $price_groups[$i]["price_in_cents_with_discount"];
        $price_title = $price_groups[$i]["option_text"];
        $price_percent_saving = $price_groups[$i]["percent_savings_text"];
        
        $discount = getPercent($price_percent_saving);
        $final_price = getFinalPrice($price_text);
        $initial_price = getInitialPrice($final_price,$discount);
        $edition = getEdition($price_title);
        // echo $edition." - Id: ".$app_id;
        $diff_hour = 99;
        $query = $db->query("SELECT * FROM game_prices where game_steam_app_id = '$app_id' and game_edition='$edition' order by price_id desc")->fetch(PDO::FETCH_ASSOC);

        if($query)
        {
          $date_last_str = strtotime($query["price_date"]);
          $diff_hour = abs($date_now_str - $date_last_str)/(60*60);
        }

        if($diff_hour < $min_hour_to_update){
          // echo "<span style='color:orange; margin:0; padding:0; font-size:20px'>None</span> => Price Already Added ".$diff_hour." hour ago. Id: ".$app_id." Edition: ".$edition."<br>";
          $data_item = getNotificationArray("none","Price Already Added","Price Already Added ".$diff_hour." hour ago.<br>Game Id: ".$app_id."<br>Game Edition: ".$edition);
          array_push($data,$data_item);
          continue;
        }

        // $hasEdition = $db->query("SELECT * FROM game_prices where game_steam_app_id ='$app_id' and game_edition = '$edition'  order by game_steam_app_id desc  ")->fetch(PDO::FETCH_ASSOC);

        // if(!$hasEdition)
        
        $add=$db->query("insert into game_prices(price_id, game_steam_app_id, game_epic_app_id,game_epic_sandbox_id, game_edition, price_currency, price_initial, price_final, price_discount_percent,game_url, price_date,price_state)
        values('','$app_id','','','$edition','$price_currency','$initial_price','$final_price','$discount','$game_url','$datetime_now','0')");

        if(@$add){
          // echo "<span style='color:var(--green); margin:0; padding:0; font-size:20px'>Success</span> => Price Added. Id: ".$app_id."<br>";
          $data_item = getNotificationArray("success","Success","Steam game price added.<br>Game Id: ".$app_id);
          array_push($data,$data_item);
        }else{
          // echo "<span style='color:red; margin:0; padding:0; font-size:20px'>Error</span> => Something went wrong. Id: ".$app_id."<br>";
          $data_item = getNotificationArray("error","Fail","Something went wrong.<br>Game Id: ".$app_id);
          array_push($data,$data_item);
        }
      }
    }
    

    #endregion
    
  return $data;

  }




  #region Epic


  // if(@$_POST["update_epic_games"]){


  //   $min_hour_to_update = $_POST["min_hour_to_update"];

  //   // echo "Something went wrong. Please try again.";

  //   $ret = exec("cd C:/xampp/htdocs/GameShopping/Epic Games Integration && node --no-warnings get-epic-game-prices.js 2>&1", $json, $err);

  //   $data = [];

  //   if(count($json) == 0){
  //     // echo "Something went wrong. Please try again.";
  //     $data_item = getNotificationArray("error","Fail","Something went wrong. Please try again.");
  //     array_push($data,$data_item);
  //   }

  //   for ($i=0; $i < count($json); $i++) { 
  //     $brackets = array("[", "]");
  //     $withoutBrackets = str_replace($brackets, "", $json[$i]);
  //     $result = json_decode($withoutBrackets,JSON_INVALID_UTF8_IGNORE);

  //     $gameEpicAppId = $result["game_epic_app_id"];
  //     $gameEpicSandboxId = $result["game_epic_sandbox_id"];
  //     $priceCurrency = $result["price_currency"];
  //     $priceInitial = $result["price_initial"];
  //     $priceFinal = $result["price_final"];
  //     $priceDiscountPercent = $result["price_discount_percent"];
  //     $game_url = $result["game_url"];

  //     $lastPriceQuery = $db->query("SELECT * FROM game_prices where game_epic_app_id='$gameEpicAppId' and game_epic_sandbox_id='$gameEpicSandboxId' order by price_id desc")->fetch(PDO::FETCH_ASSOC);
  //     $diff_hour = 99;

  //     if($lastPriceQuery)
  //     {
  //       $date_last_str = strtotime($lastPriceQuery["price_date"]);
  //       $diff_hour = abs($date_now_str - $date_last_str)/(60*60);
  //     }

  //     if(($diff_hour < $min_hour_to_update)){
  //       // echo "<span style='color:orange; margin:0; padding:0; font-size:20px'>None</span> => Price Already Added ".$diff_hour." hour ago. Id: ".$gameEpicAppId."<br>";
  //       $data_item = getNotificationArray("none","Price Already Added","Price Already Added ".$diff_hour." hour ago.<br>Epic Game Id: ".$gameEpicAppId);
  //       array_push($data,$data_item);
  //       continue;
  //     }

  //     // $update= $db->exec("UPDATE game_prices SET price_currency='$priceCurrency',price_initial='$priceInitial',price_final='$priceFinal',price_discount_percent='$priceDiscountPercent' where game_epic_app_id='$gameEpicAppId' and game_epic_sandbox_id='$gameEpicSandboxId'  ");

  //     $query = $db->query("SELECT * FROM game_prices where game_epic_app_id='$gameEpicAppId' and game_epic_sandbox_id='$gameEpicSandboxId' order by price_id desc")->fetch(PDO::FETCH_ASSOC);
  //     $steam_app_id = $query["game_steam_app_id"];
  //     $edition = $query["game_edition"];

  //     $add=$db->query("insert into game_prices(price_id, game_steam_app_id, game_epic_app_id,game_epic_sandbox_id, game_edition, price_currency, price_initial, price_final, price_discount_percent,game_url, price_date,price_state)
  //     values('','$steam_app_id','$gameEpicAppId','$gameEpicSandboxId','$edition','$priceCurrency','$priceInitial','$priceFinal','$priceDiscountPercent','$game_url','$datetime_now','0')");

  //     if(@$add){
  //       // echo "<span style='color:var(--green); margin:0; padding:0; font-size:20px'>Success</span> => Price Added. Id: ".$app_id."<br>";
  //       $data_item = getNotificationArray("success","Success","Steam game price added.<br>Epic Game Id: ".$gameEpicAppId);
  //       array_push($data,$data_item);
  //     }else{
  //       // echo "<span style='color:red; margin:0; padding:0; font-size:20px'>Error</span> => Something went wrong. Id: ".$app_id."<br>";
  //       $data_item = getNotificationArray("error","Fail","Something went wrong.<br>Epic Game Id: ".$gameEpicAppId);
  //       array_push($data,$data_item);
  //     }
  //   }

  //   echo json_encode($data);

  // }


  // function getEpicGameIds(){

  //   $url = "http://localhost/GameShopping/admin/epic_games.php";

  //   @$json = file_get_contents($url);
  //   @$json = json_decode($json,true);//array

  //   return $json;

  //   // for ($i=0; $i < count($json_keys); $i++) { 

  //   //   $regex = "/\w{0,}(?=edition|base)/";
  //   //   $result = preg_match($regex,$json_keys[$i],$matches);
  
  //   //   if($result != 0){
  //   //     $game_ids[$i]=$matches[0];
  //   //   }else{
  //   //     continue;
  //   //   }
  //   // }

  //   return $game_ids;
  // }




  #endregion






  if(!$_POST)
  {
    // $game_release_date = "26 Oct, 2017";
    // // echo $game_release_date;
    // $game_release_date = str_replace(",","",$game_release_date);
    // // echo $game_release_date;
    // $str_time = strtotime($game_release_date);
    // echo $str_time;

    // header.location("",500)

    Redirect();

  }



?>
