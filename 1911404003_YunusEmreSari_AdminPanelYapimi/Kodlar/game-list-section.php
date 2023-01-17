<link rel="stylesheet" href="css/game-list-section.css" />

<section class="game-list-section">
    
    <div class="games-col">
        <?php
        @$section_queries = $db->query("SELECT * FROM section_queries where query_id='$queries'")->fetch(PDO::FETCH_ASSOC);
        @$selected_query = $section_queries["query"];
        @$selected_query_name = $section_queries["query_name"];
        $queries++;
        ?>
        <h1 class="title"><?php echo $selected_query_name; ?></h1>
        <div class="game-list">
            <?php
                if($selected_query == NULL)
                    return;
                $query = $db->query($selected_query, PDO::FETCH_ASSOC);
                // $query = $db->query("SELECT DISTINCT games.game_steam_app_id,games.game_name,games.game_release_date FROM games LEFT JOIN game_prices ON games.game_steam_app_id = game_prices.game_steam_app_id WHERE price_discount_percent > 50 ORDER BY games.game_release_date desc limit 10", PDO::FETCH_ASSOC);
                foreach( $query as $row ){
                    
                    $steam_app_id =$row["game_steam_app_id"]; 
                    $game_prices = $db->query("SELECT * FROM game_prices where game_steam_app_id='$steam_app_id'order by price_id desc")->fetch(PDO::FETCH_ASSOC);

                    $has_epic_id = ($game_prices["game_epic_app_id"] !== "") ? true : false;
                    $discount_percent = $game_prices["price_discount_percent"];

                    // if($game_prices["price_final"] == "")
                    //     continue;
                    
                    $initial_price = getInitialPrice($game_prices["price_final"],$game_prices["price_discount_percent"]);
                    // $initial_price = 255;
                    $final_price = $game_prices["price_final"];

                    // if($final_price == $initial_price)
                    //     continue;

                    $game_name = $row["game_name"];
                    $store_name = ($has_epic_id) ? "Epic Games Store" : "Steam";

                    $game_images = $db->query("SELECT * FROM game_images where game_steam_app_id='$steam_app_id' order by image_id desc")->fetch(PDO::FETCH_ASSOC);
                    $game_image = $game_images["image_full"];

                    echo '
                        <div class="list-item">
                        <a href="game-page.php?game='.$row["game_page_url"].'" class="url-click">
                            <img src="'.$game_image.'" alt="">
                            <div class="item-info">
                                <h1 class="item-title wrap-text">'.$game_name.'</h1>
                                <h3 class="item-store wrap-text">'.$store_name.'</h3>
                            </div>
                            <div class="item-price wrap-text">
                                <h3>$'.$final_price.'</h3>
                            </div>
                        </a>
                        </div>
                        
                    ';
                }
            ?>
            
            <!-- <button class="browse-all btn-cornered btn-width-150 anim-active-scale anim-hover-bright">Browse All New Deals</button> -->
        </div>
    </div>


    
    <div class="games-col">
        <?php
        $section_queries = $db->query("SELECT * FROM section_queries where query_id='$queries'")->fetch(PDO::FETCH_ASSOC);
        $selected_query = $section_queries["query"];
        $selected_query_name = $section_queries["query_name"];
        $queries++;
        ?>
        <h1 class="title"><?php echo $selected_query_name; ?></h1>
        <div class="game-list">
            <?php
                $query = $db->query($selected_query, PDO::FETCH_ASSOC);
                // $query = $db->query("SELECT DISTINCT games.game_steam_app_id,games.game_name,games.game_release_date FROM games LEFT JOIN game_prices ON games.game_steam_app_id = game_prices.game_steam_app_id WHERE price_discount_percent > 50 ORDER BY games.game_release_date desc limit 10", PDO::FETCH_ASSOC);
                foreach( $query as $row ){
                    
                    $steam_app_id =$row["game_steam_app_id"]; 
                    $game_prices = $db->query("SELECT * FROM game_prices where game_steam_app_id='$steam_app_id'order by price_id desc")->fetch(PDO::FETCH_ASSOC);

                    $has_epic_id = ($game_prices["game_epic_app_id"] !== "") ? true : false;
                    $discount_percent = $game_prices["price_discount_percent"];
                    // if($game_prices["price_final"] == "")
                    //     continue;
                    
                    $initial_price = getInitialPrice($game_prices["price_final"],$game_prices["price_discount_percent"]);
                    // $initial_price = 255;
                    $final_price = $game_prices["price_final"];

                    // if($final_price == $initial_price)
                    //     continue;

                    $game_name = $row["game_name"];
                    $store_name = ($has_epic_id) ? "Epic Games Store" : "Steam";

                    $game_images = $db->query("SELECT * FROM game_images where game_steam_app_id='$steam_app_id' order by image_id desc")->fetch(PDO::FETCH_ASSOC);
                    $game_image = $game_images["image_full"];

                    echo '
                        <div class="list-item">
                        <a href="game-page.php?game='.$row["game_page_url"].'" class="url-click">
                            <img src="'.$game_image.'" alt="">
                            <div class="item-info">
                                <h1 class="item-title wrap-text">'.$game_name.'</h1>
                                <h3 class="item-store wrap-text">'.$store_name.'</h3>
                            </div>
                            <div class="item-price wrap-text">
                                <h3>$'.$final_price.'</h3>
                            </div>
                        </a>
                        </div>
                        
                    ';
                }
            ?>
            
            <!-- <button class="browse-all btn-cornered btn-width-150 anim-active-scale anim-hover-bright">Browse All New Deals</button> -->
        </div>
    </div>


    
    <div class="games-col">
        <?php
        $section_queries = $db->query("SELECT * FROM section_queries where query_id='$queries'")->fetch(PDO::FETCH_ASSOC);
        $selected_query = $section_queries["query"];
        $selected_query_name = $section_queries["query_name"];
        $queries++;
        ?>
        <h1 class="title"><?php echo $selected_query_name; ?></h1>
        <div class="game-list">
            <?php
                $query = $db->query($selected_query, PDO::FETCH_ASSOC);
                // $query = $db->query("SELECT DISTINCT games.game_steam_app_id,games.game_name,games.game_release_date FROM games LEFT JOIN game_prices ON games.game_steam_app_id = game_prices.game_steam_app_id WHERE price_discount_percent > 50 ORDER BY games.game_release_date desc limit 10", PDO::FETCH_ASSOC);
                foreach( $query as $row ){
                    
                    $steam_app_id =$row["game_steam_app_id"]; 
                    $game_prices = $db->query("SELECT * FROM game_prices where game_steam_app_id='$steam_app_id'order by price_id desc")->fetch(PDO::FETCH_ASSOC);

                    $has_epic_id = ($game_prices["game_epic_app_id"] !== "") ? true : false;
                    $discount_percent = $game_prices["price_discount_percent"];
                    // if($game_prices["price_final"] == "")
                    //     continue;
                    
                    $initial_price = getInitialPrice($game_prices["price_final"],$game_prices["price_discount_percent"]);
                    // $initial_price = 255;
                    $final_price = $game_prices["price_final"];

                    // if($final_price == $initial_price)
                    //     continue;

                    $game_name = $row["game_name"];
                    $store_name = ($has_epic_id) ? "Epic Games Store" : "Steam";

                    $game_images = $db->query("SELECT * FROM game_images where game_steam_app_id='$steam_app_id' order by image_id desc")->fetch(PDO::FETCH_ASSOC);
                    $game_image = $game_images["image_full"];

                    echo '
                        <div class="list-item">
                        <a href="game-page.php?game='.$row["game_page_url"].'" class="url-click">
                            <img src="'.$game_image.'" alt="">
                            <div class="item-info">
                                <h1 class="item-title wrap-text">'.$game_name.'</h1>
                                <h3 class="item-store wrap-text">'.$store_name.'</h3>
                            </div>
                            <div class="item-price wrap-text">
                                <h3>$'.$final_price.'</h3>
                            </div>
                        </a>
                        </div>
                        
                    ';
                }
            ?>
            
            <!-- <button class="browse-all btn-cornered btn-width-150 anim-active-scale anim-hover-bright">Browse All New Deals</button> -->
        </div>
    </div>


</section>



