<?php

    include("php_settings_ajax.php");
    include("../admin/ajax/base_functions.php");

    if(@$_POST["search"]){

        $search_value = $_POST["search-value"];
        
        $result = "";
        $query = $db->query("SELECT * FROM games LEFT JOIN game_recommendations ON game_recommendations.game_steam_app_id = games.game_steam_app_id WHERE games.game_name LIKE '%$search_value%' ORDER BY game_recommendations.recommend_count DESC LIMIT 20", PDO::FETCH_ASSOC);

        if($query ->rowCount() <= 0)
            $result.='
        <div class="search-result-item anim-hover-bright">
            <div class="result-item-no-result">
            No Result Found
            </div>
        </div> 
        ';

        foreach( $query as $row ){

            $game_steam_app_id = $row["game_steam_app_id"];
            $images = $db->query("SELECT * FROM game_images where game_steam_app_id = '$game_steam_app_id'")->fetch(PDO::FETCH_ASSOC);
            $image = $images["image_thumbnail"];
            
            $prices = $db->query("SELECT * FROM game_prices where game_steam_app_id = '$game_steam_app_id' ")->fetch(PDO::FETCH_ASSOC);
            $inital_price = $prices["price_initial"];
            $final_price = $prices["price_final"];

            $result .=
            '
            <div class="search-result-item anim-hover-bright">
            <a href="game-page.php?game='.$row["game_page_url"].'" class="url-click">
                <div class="result-item-image">
                <img src="'.$image.'" alt="">
                </div>
                <div class="result-item-name wrap-text">
                '.$row["game_name"].'
                </div>
                <div class="result-item-price">
                <h5>'.$inital_price.'$</h5>
                <h3>'.$final_price.'$</h3>
                </div>
                </a>
            </div>';
        }

        echo $result;

    }


    if(@!$_POST){
    
        Redirect();
    
    }
    
?>