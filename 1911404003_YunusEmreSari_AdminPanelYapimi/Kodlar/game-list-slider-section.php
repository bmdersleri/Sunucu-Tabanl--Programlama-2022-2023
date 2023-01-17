<link rel="stylesheet" href="css/game-list-slider-section.css" />

<section class="game-list-slider-section">

    <div class="swiper hor-list-slider">

        <div class="swiper-wrapper">

              <?php
                $i = 1;
                $query = $db->query("SELECT DISTINCT game_prices.game_steam_app_id,game_recommendations.recommend_count FROM game_prices LEFT JOIN game_recommendations ON game_recommendations.game_steam_app_id = game_prices.game_steam_app_id LEFT JOIN games ON games.game_steam_app_id = game_prices.game_steam_app_id where games.game_release_date >  now() - INTERVAL 15 year and game_prices.price_final != game_prices.price_initial ORDER BY game_recommendations.recommend_count desc limit 10", PDO::FETCH_ASSOC);
                foreach( $query as $row ){

                  $steam_app_id =$row["game_steam_app_id"]; 
                  $game_prices = $db->query("SELECT * FROM game_prices where game_steam_app_id = '$steam_app_id' ")->fetch(PDO::FETCH_ASSOC);
                    
                  $has_epic_id = ($game_prices["game_epic_app_id"] !== "") ? true : false;
                  $discount_percent = $game_prices["price_discount_percent"];
                  $initial_price = getInitialPrice($game_prices["price_final"],$game_prices["price_discount_percent"]);
                  $final_price = $game_prices["price_final"];

                  // if($final_price == $initial_price)
                  //     continue;

                  $games = $db->query("SELECT * FROM games where game_steam_app_id='$steam_app_id'order by game_steam_app_id desc")->fetch(PDO::FETCH_ASSOC);
                  $game_name = $games["game_name"];
                  $store_name = ($has_epic_id) ? "Epic Games Store" : "Steam";

                  $game_images = $db->query("SELECT * FROM game_images where game_steam_app_id='$steam_app_id' order by image_id desc")->fetch(PDO::FETCH_ASSOC);
                  $game_image = $game_images["image_full"];

                  $game_recommendations = $db->query("SELECT * FROM game_recommendations where game_steam_app_id='$steam_app_id'order by game_steam_app_id desc")->fetch(PDO::FETCH_ASSOC);
                  $recommend_count = $game_recommendations["recommend_count"];

                  echo '
                    
                    <div class="swiper-slide hor-list-swiper-slide anim-hover-bright">
                      <div class="hor-list-item-num">'.$i.'</div>
                      <a href="game-page.php?game='.$games["game_page_url"].'" class="url-click"><img src="'.$game_image.'">
                      <div class="hor-list-item">
                        <h3 class="hor-list-item-title">'.$game_name.'</h3>
                        <h3 class="hor-list-item-price"><span>from</span> $'.$final_price.'</h3>
                      </div>
                      </a>
                    </div>
                    
                  ';
                  $i++;
                }
              ?>




            <?php 
              for ($i=0; $i <0 ; $i++) { 
                echo '          <div class="swiper-slide hor-list-swiper-slide anim-hover-bright">
                <div class="hor-list-item-num">10</div>
                <img src="images/mbbannerlord-v.jpg">
                <div class="hor-list-item">
                  <h3 class="hor-list-item-title">Mount Blade 2 Bannerlord</h3>
                  <h3 class="hor-list-item-price"><span>from</span> $29,99</h3>
                </div>
              </div>';
              }
            ?>
        </div>

        <div class="swiper-pagination"></div>

    </div>

</section>


<script>

var width = screen.width;

const swiperParams = SwiperOptions = {
  slidesPerView: 5,
  slidesPerGroup: 5,
  loop: true,
  loopFillGroupWithBlank: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  }
};

if(width <= 768){
  swiperParams.slidesPerView = 1;
  swiperParams.slidesPerGroup = 1;
  swiperHorList = new Swiper(".hor-list-slider",swiperParams);
  }
  
$(window).resize(function() {
  width = screen.width;
  if(width <= 768){
  swiperParams.slidesPerView = 1;
  swiperParams.slidesPerGroup = 1;
  swiperHorList = new Swiper(".hor-list-slider",swiperParams);
  }else{
  swiperParams.slidesPerView = 5;
  swiperParams.slidesPerGroup = 5;
  swiperHorList = new Swiper(".hor-list-slider",swiperParams);
  }
});

var swiperHorList = new Swiper(".hor-list-slider",swiperParams);




</script>