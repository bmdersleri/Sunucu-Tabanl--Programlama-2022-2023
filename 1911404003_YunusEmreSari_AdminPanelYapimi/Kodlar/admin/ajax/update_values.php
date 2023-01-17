<?php

  include("php_settings.php");



  if(@$_POST["get_steam_games"]){

    $page = $_POST["page"];
    $start_index = $_POST["start_index"];
    $def_count_per_page = $_POST["count_per_page"];
    $count_per_page = 0;//Üstteki defaulta göre buna değer atıyacaz aşağıda
    $min_review_count = $_POST["min_review_count"];

    #region Choosen Ids
    // $games_added = "";
    // // $games = ["239140","261550","1811260","812140","255710","208200"];
    // $games = ["1914860"];

    // for ($i=0; $i < count($games) ; $i++) { 
    //   $result = addGameValuesToDatabase($games[$i]);
    //   $games_added .= $games[$i]."<br>";
    // }
    // echo $result." ".$games_added;

    #endregion

    // $url = "http://api.steampowered.com/ISteamApps/GetAppList/v1/";

    $url = "https://steamspy.com/api.php?request=all&page=".$page;

    @$json = file_get_contents($url);

    $json = json_decode($json,true);//array

    // $all_apps = $json["applist"]["apps"]["app"];
    // $all_apps = $json["applist"];

    $keys = array_keys($json);
    
    //Steam Pages kısmına burda ilk defa ekliyoruz
    $length = count($keys);
    $query1 = $db->prepare("SELECT * FROM steam_game_pages WHERE page_num=?");
    $query1->execute(array($page));
    if(!$query1->rowCount()){
      $db->query("insert into steam_game_pages(id,page_num,received_game_count,page_max_game) values('','$page','0','$length')"); 
    }

    if($def_count_per_page == 0) 
      $count_per_page = count($keys);
    else
      $count_per_page = $def_count_per_page;
    
    sort($keys);

    $total = 0;
    for ($i=$start_index; $i <$count_per_page + $start_index ; $i++) {

      if($i > count($keys))
      {
        echo "Bitti Looo";
        break;
      }  
      $received_count = $i+1;
      $db->exec("UPDATE steam_game_pages SET received_game_count='$received_count' where page_num='$page'  ");

      $game = $json[$keys[$i]];
      $query1 = $db->prepare("SELECT * FROM games WHERE game_steam_app_id=?");
      $query1->execute(array($game["appid"]));
      if($query1->rowCount()){
        echo "<span style='color:orange; margin:0; padding:0; font-size:20px'>NONE</span> => Already In Database Id: ".$game["appid"]." Name: ".$game["name"]." <br>";
        continue;
      }

      if($game["price"] === "0" && $game["initialprice"] === "0" && $game["discount"] === "0" ){
        echo "<span style='color:yellow; margin:0; padding:0; font-size:20px'>FREE TO PLAY</span> => FREE TO PLAY Id: ".$game["appid"]." Name: ".$game["name"]." <br>";
        continue;
      }


      if($game["positive"] + $game["negative"] >= $min_review_count){
        $game_added_succesfully = addGameValuesToDatabase($game["appid"]);
        if($game_added_succesfully){
          echo "<span style='color:green; margin:0; padding:0; font-size:20px'>SUCCESS</span> => Id: ".$game["appid"]." Name: ".$game["name"]."<br>";
          $total++;
        }
        else
          echo "<span style='color:red; margin:0; padding:0; font-size:20px'>FAIL</span> => Id: ".$game["appid"]." Name: ".$game["name"]."<br>";

      }

    }
    echo $total." -------------------------------------------------------------------------------------------------------------------------------------------------------------------------<br>";

    $page++;


    $games_added = "";
    $games_couldnt_add = "";
    $added_game_count = 0;
  }


  if(@$_POST["update"]){

  }






  if(!$_POST)
  {

    #region Example1
      // header('Content-Type: application/json');

      // $url = "https://store.steampowered.com/api/appdetails?appids=261550";

      // //call api
      // $json = file_get_contents($url);
      // $json = json_decode($json,true);//array
      // echo json_encode($json,JSON_PRETTY_PRINT);

      // Prints something like: Monday 8th of August 2005 03:12:46 PM
      // echo date("Y-m-d H:i:s");

      // $first_part = "/(?!\d{3})\d/";
      // $last_part = "/(?=\d{3})\d/";

      // $first = implode("", preg_split($first_part, "69999"));
      // $last = implode("", preg_split($last_part, "69999"));


      // echo $first.",".$last;
      // echo getEdition("EA SPORTS™ FIFA 23 Ultimate Edition - 899,99 TL");





      // header('Content-Type: application/json');

      // $url = "http://api.steampowered.com/ISteamApps/GetAppList/v1/";
      // //call api
      // $json = file_get_contents($url);
      // // $json = substr($json, 0, strpos($json, "273130"));

      // $json = json_decode($json,true);//array
      // // echo json_encode($json,JSON_PRETTY_PRINT);

      // $all_apps = $json["applist"]["apps"]["app"];

      // $count = 0;
      // $i = 0;
      // while($count < 25){
      //   $app_id = $all_apps[$i]["appid"];
      //   $app_name = $all_apps[$i]["name"];
      //   if($app_name != "")
      //   {
      //     echo $app_name."<br>";
      //     $count++;
      //   }
      //   $i++;
      // }
    #endregion

    $game_release_date = "26 Oct, 2017";
    // echo $game_release_date;
    $game_release_date = str_replace(",","",$game_release_date);
    // echo $game_release_date;
    $str_time = strtotime($game_release_date);
    echo $str_time;

  }






  function AddToFailedGames($app_id){
    global $db,$datetime_now,$date_now_str;
    $add=$db->query("insert into failed_to_add(id,game_steam_app_id) values('','$app_id')"); 
  }

?>
