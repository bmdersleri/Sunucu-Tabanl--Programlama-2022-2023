<?php

include("php_settings.php");

$arr = array();


$query = $db->query("SELECT DISTINCT game_epic_app_id,game_epic_sandbox_id,game_edition,price_final FROM game_prices where game_epic_app_id!='' and game_edition != 'Free' and price_state = '0' ", PDO::FETCH_ASSOC);
foreach( $query as $row ){
	
    $app_info = array();
    $epic_app_id = $row["game_epic_app_id"];
    $epic_sandbox_id = $row["game_epic_sandbox_id"];
    $epic_edition = $row["game_edition"];
    $price_final = $row["price_final"];

    $app_info["epic_app_id"] = $epic_app_id;
    $app_info["epic_sandbox_id"] = $epic_sandbox_id;
    $app_info["epic_edition"] = $epic_edition;
    $app_info["price_final"] = $price_final;
    
    $arr[count($arr)] = $app_info;
}


echo json_encode($arr);

//239140
//261550
//1811260
//812140
//255710

?>

