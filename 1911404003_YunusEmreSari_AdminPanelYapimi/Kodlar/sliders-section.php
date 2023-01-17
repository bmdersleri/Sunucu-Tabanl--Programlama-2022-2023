<link rel="stylesheet" href="slider/css/swiper-bundle.min.css" />
<link rel="stylesheet" href="slider/css/sliders-section.css" />

<script src="slider/js/swiper-bundle.min.js"></script>

<section class="sliders-section">
    <div class="slider-left">
        <div class="swiper top-swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">


                <?php 

                    $query = $db->query("SELECT DISTINCT game_prices.game_epic_app_id,game_prices.game_steam_app_id,game_prices.price_discount_percent,game_prices.price_final,game_prices.game_url FROM game_prices LEFT JOIN games ON games.game_steam_app_id = game_prices.game_steam_app_id where games.game_state!='0' and games.game_release_date >  now() - INTERVAL 5 year order by price_discount_percent desc limit 5", PDO::FETCH_ASSOC);
                    foreach( $query as $row ){
                        
                        $steam_app_id =$row["game_steam_app_id"]; 
                        $has_epic_id = ($row["game_epic_app_id"] !== "") ? true : false;
                        $discount_percent = $row["price_discount_percent"];
                        $initial_price = getInitialPrice($row["price_final"],$row["price_discount_percent"]);
                        $final_price = $row["price_final"];
                        $game_url = $row["game_url"];
                        if($final_price == $initial_price)
                            continue;

                        $games = $db->query("SELECT * FROM games where game_steam_app_id='$steam_app_id'order by game_steam_app_id desc")->fetch(PDO::FETCH_ASSOC);
                        $game_name = $games["game_name"];
                        $store_image = ($has_epic_id) ? "images/epic-games-1.png" : "images/steam-1.png";

                        $game_images = $db->query("SELECT * FROM game_images where game_steam_app_id='$steam_app_id' order by image_id desc")->fetch(PDO::FETCH_ASSOC);
                        $game_image = $game_images["image_full"];

                        echo '
                            <a href = "game-page.php?game='.$games["game_page_url"].'" class="url-click">
                                <div class="swiper-slide top-swiper-slider">
                                    <img src="'.$game_image.'">
                                    <div class="slider-game-info slider-left-info">
                                        <h1 class="title" >'.$game_name.'</h1>
                                        <a href="'.$game_url.'" target="_blank"><button class="go-to-store btn-cornered blue-back btn-width-150 anim-active-scale anim-hover-bright"><img src="'.$store_image.'" alt=""> Go To Store</button></a>
                                        <h4 class="price-initial" >$'.$initial_price.'</h4>
                                        <h2 class="price-final">$'.$final_price.'</h2>
                                    </div>
                                </div>
                            </a>
                        ';

                    }
                ?>


                <!-- Slides -->
                <!-- <div class="swiper-slide top-swiper-slider">
                    <img src="images/mbbannerlord-h.jpg">
                    <div class="slider-game-info slider-left-info">
                        <h1 class="title" >Mount Blade 2 Bannerlord</h1>
                        <button class="go-to-store btn-cornered blue-back btn-width-150 anim-active-scale anim-hover-bright"><img src="images/epic-games-1.png" alt=""> Go To Store</button>
                        <h4 class="price-initial" >$39,99</h4>
                        <h2 class="price-final">$29,99</h2>
                    </div>
                </div> -->


            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev swiper-button"></div>
            <div class="swiper-button-next swiper-button"></div>
        </div>
    </div>

    <div class="slider-right">
        <div class="swiper" >
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <!-- SELECT DISTINCT game_prices.game_epic_app_id,game_prices.game_steam_app_id,game_prices.price_discount_percent,game_prices.price_final FROM game_prices LEFT JOIN games ON games.game_steam_app_id = game_prices.game_steam_app_id WHERE price_discount_percent > 50 GROUP BY game_prices.game_steam_app_id ORDER BY games.game_release_date desc limit 10 -->
                    <?php 
                        $query = $db->query("SELECT DISTINCT game_prices.game_steam_app_id,games.game_name,game_prices.game_url,games.game_page_url,games.game_release_date FROM game_prices LEFT JOIN games ON games.game_steam_app_id = game_prices.game_steam_app_id where game_prices.price_final='0' order by games.game_release_date desc limit 5", PDO::FETCH_ASSOC);
                        foreach( $query as $row ){

                            $game_steam_app_id = $row["game_steam_app_id"];
                            $game_name = $row["game_name"];

                            $final_price = 0;
                            $store_image = "images/steam-1.png";

                            $game_images = $db->query("SELECT * FROM game_images where game_steam_app_id='$game_steam_app_id' order by image_id desc")->fetch(PDO::FETCH_ASSOC);
                            $game_image = $game_images["image_full"];

                            echo '
                            <a href="game-page.php?game='.$row["game_page_url"].'" class="url-click">
                            <div class="swiper-slide top-swiper-slider">
                                <img src="'.$game_image.'">
                                <div class="slider-game-info slider-right-info">
                                    <h1 class="title">'.$game_name.'</h1>
                                    <span class="free-span">Free</span> 
                                    <a href="'.$row["game_url"].'" target="_blank" ><button class="get-it-now btn-cornered purple-back btn-width-150 anim-active-scale anim-hover-bright">Get It Now</button></a>
                                </div>
                            </div>
                            </a>
                            ';

                        }
                    ?>
                    
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev swiper-button"></div>
                <div class="swiper-button-next swiper-button"></div>
            </div>
    </div>
    
</section>




<script>

const swiperTop = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    effect: 'fade',
    fadeEffect: {
    crossFade: true
    },

    autoplay: {
    delay: 5000000,
    disableOnInteraction:false
    },

    // If we need pagination
    pagination: {
    el: '.swiper-pagination',
    clickable:true,
    },

    // Navigation arrows
    navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
    },

});


</script>