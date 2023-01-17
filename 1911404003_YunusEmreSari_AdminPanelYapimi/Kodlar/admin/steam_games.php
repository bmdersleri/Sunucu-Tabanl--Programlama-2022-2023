<?php
// include("session_control.php");
include "../dbConnect.php";
date_default_timezone_set('Europe/Istanbul');
$datetime_now = date("Y-m-d H:i:s");

$arr = array();
$is_latest = "";

//Eğer sadece son eklenen steam games lerin epic store daki karşılıkları bulunmak isteniyorsa
if(@$_GET["isLatest"])
{
    $is_latest = "WHERE game_epic_app_id != '-'";
}

$j = 1;

$min_hour_to_update = 24;
if(@$_GET["min_hour_to_update"])
{
    $min_hour_to_update = $_GET["min_hour_to_update"];
}

$query = $db->query("SELECT * FROM games".$is_latest, PDO::FETCH_ASSOC);
foreach( $query as $row ){
	
    $appId = $row["game_steam_app_id"];

    $hour_control = $db->query("SELECT * FROM game_prices where game_steam_app_id='$appId' order by price_id desc")->fetch(PDO::FETCH_ASSOC);
    // echo $hour_control["price_date"]."  -- ".$datetime_now;
    $hourdiff = (strtotime($datetime_now) - strtotime($hour_control["price_date"]))/3600;

    if($hourdiff < $min_hour_to_update)
    {
        // echo " Name: ".$row["game_name"]." Yallah: ".$hourdiff."<br>";
        continue;
    }

    $base_listed = false;

    $i = 1;

    if(@$_GET["filter"] == "standard_only"){
        $query1 = $db->query("SELECT DISTINCT game_edition,game_steam_app_id,game_epic_app_id FROM game_prices where game_steam_app_id='$appId' and game_epic_app_id='' and game_edition='Standard' and now() - INTERVAL $min_hour_to_update hour > game_prices.price_date  ", PDO::FETCH_ASSOC);
        if($query1->rowCount() <= 0)
        {
            $query1 = $db->query("SELECT DISTINCT game_edition,game_steam_app_id,game_epic_app_id FROM game_prices where game_steam_app_id='$appId' and game_epic_app_id='' and now() - INTERVAL $min_hour_to_update hour > game_prices.price_date ", PDO::FETCH_ASSOC);
        }
    }

    else{
        $query1 = $db->query("SELECT DISTINCT game_edition,game_steam_app_id,game_epic_app_id FROM game_prices where game_steam_app_id='$appId' and game_epic_app_id='' and now() - INTERVAL $min_hour_to_update hour > game_prices.price_date  ", PDO::FETCH_ASSOC);
        // $query1 = $db->query("SELECT DISTINCT game_edition,game_steam_app_id,game_epic_app_id FROM game_prices where game_steam_app_id='$appId' and game_epic_app_id='' and price_state='1' ", PDO::FETCH_ASSOC);
    }

    foreach($query1 as $row1){
        if(trim($row1["game_edition"]) != "Standard"){
            if(str_contains($row["game_name"],"Edition") == 1)
                $arr[$appId."edition".$i] = trim(htmlspecialchars_decode($row["game_name"]));
            else
                $arr[$appId."edition".$i] = trim(htmlspecialchars_decode($row["game_name"])." ".$row1["game_edition"]);
        }
        else if(!$base_listed)
        {
            $base_listed = true;
            $arr[$appId."base".$i] = htmlspecialchars_decode($row["game_name"]);
        }

        $i++;
        $j++;
    }

}


echo json_encode($arr);

//239140
//261550
//1811260
//812140
//255710

?>

