<?php
  include "dbConnect.php";
?>

<html lang="tr" dir="ltr">

  <head>
    <?php include "head.php"; ?>
    <link rel="stylesheet" type="text/css" href="css/game-page.css">
    <link rel="stylesheet" href="slider/css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="slider/css/sliders-section.css" />
    <script src="slider/js/swiper-bundle.min.js"></script>
    <title>Game Shopping</title>
  </head>

  <body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0" >



  <?php include("header.php"); ?>



  <?php

    $game_page_url = @$_GET["game"];
    $edition = @trim($_GET["edition"]);
    $is_epic_free_game = false;


    $game = $db->query("SELECT * FROM games where game_page_url='$game_page_url' ")->fetch(PDO::FETCH_ASSOC);
    @$app_id = $game["game_steam_app_id"];

    //Eğer free epic store ise
    // if(!$game)
    // {
    //   $game = $db->query("SELECT * FROM epic_free_games where game_page_url='$game_page_url' ")->fetch(PDO::FETCH_ASSOC);
    //   $app_id = $game["game_app_id"];
    //   $is_epic_free_game = true; 
    // }

    $images = $db->query("SELECT * FROM game_images where game_steam_app_id='$app_id' ORDER BY image_id DESC ")->fetch(PDO::FETCH_ASSOC);
    $game_prices = $db->query("SELECT * FROM game_prices where game_steam_app_id='$app_id' or game_epic_app_id = '$app_id' ")->fetch(PDO::FETCH_ASSOC);
    $game_reviews = $db->query("SELECT * FROM game_recommendations where game_steam_app_id='$app_id' ")->fetch(PDO::FETCH_ASSOC);

    if($edition == "" && !$is_epic_free_game){
      $edition = $game_prices["game_edition"];
    }
    else if($is_epic_free_game)
      $edition = "Free";


    $game_name = $game["game_name"];
    $game_description = $game["game_description"];
    $game_publisher = $game["game_publisher"];
    // $store_image = ($is_epic_free_game) ? "images/epic-games.png" : "images/steam.png";
    $game_image = $images["image_thumbnail"];
    $game_price = $game_prices["price_final"];
    @$game_release_date = $game["game_release_date"];
    @$game_review =  $game_reviews["recommend_count"];
  ?>


  <section class="top-section game-page-section">

    <div class="game-image">
      <img src="<?php echo $game_image; ?>" alt="">
      <!-- <img src="images/godofwar-h.webp" alt=""> -->
    </div>

    <div class="game-info">
      
      <h2 class="game-name"><?php echo $game_name; ?></h2>

      <h3 class="game-desc"><?php echo htmlspecialchars_decode($game_description); ?></h3>

      <!-- <h3 class="min-info">Release Date: <?php echo $game_release_date; ?></h3> -->
      <!-- <h3 class="last-update">Last Updated: 20.11.2022 14:26</h3> -->

    </div>

  </section>



  <section class="center-section game-page-section">

    <section class="center-left-section">

      <div class="game-editions">
        <ul>
          <?php
          $i = 0;
          $editions = [];
            $query = $db->query("SELECT DISTINCT game_edition,game_prices.price_id FROM game_prices WHERE game_steam_app_id='$app_id' or game_epic_app_id = '$app_id' order by price_id desc ", PDO::FETCH_ASSOC);
              foreach( $query as $row ){
                if(in_array($row["game_edition"], $editions))
                  continue;

                echo '<a href="?game='.$game_page_url.'&edition='.$row["game_edition"].'"><li edition="'.$row["game_edition"].'">'.$row["game_edition"].'</li></a>';
                $editions[$i]=$row["game_edition"];
                $i++;
              }
          ?>
        </ul>
      </div>


      <div class="game-prices">

        <?php

          $query = $db->query("SELECT DISTINCT game_edition,game_epic_app_id FROM game_prices where (game_steam_app_id='$app_id' or game_epic_app_id = '$app_id') and game_edition= '$edition' ", PDO::FETCH_ASSOC);
          foreach( $query as $row ){

            $game_edition = $row["game_edition"];
            $game_epic_app_id = $row["game_epic_app_id"];

            $game_prices = $db->query("SELECT * FROM game_prices WHERE game_edition='$game_edition' and game_steam_app_id='$app_id' and game_epic_app_id='$game_epic_app_id' ORDER BY price_id DESC ")->fetch(PDO::FETCH_ASSOC);
            
            $store_image = ($game_prices["game_epic_app_id"] != '') ? "images/epic-games.png" : "images/steam.png";
            $final_price = $game_prices["price_final"]; 
            $initial_price = $game_prices["price_initial"]; 
            $currency = "$";

            if($final_price == 0)
            {
              $final_price = "FREE";
              $currency = "";
            }
              
            $initial_price = $game_prices["price_initial"];
            $game_url = $game_prices["game_url"];

            echo '
            <div class="price anim-hover-bright">
              <div class="price-image">
                <img src="'.$store_image.'" alt="">
              </div>
              <div class="price-name">
                '.$game_name.' - '.$edition.' Edition
              </div>
              <div class="price-text">
                <h5>'.$initial_price.'<span>$</span></h5>
                '.$final_price.'<span>'.$currency.'</span>
              </div>
              <a href="'.$game_url.'" target="_blank"><button class="go-to-store btn-cornered blue-back btn-width-150 anim-active-scale anim-hover-bright">Go To Store</button></a>
            </div>
            ';

          }


        ?>


      </div>


      <div class="game-description-images">
          
        <div class="swiper game-detail-swiper">
          <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(-850px, 0px, 0px);">
          <?php
            $query = $db->query("SELECT * FROM game_images where game_steam_app_id='$app_id' ORDER BY image_id DESC ", PDO::FETCH_ASSOC);
            foreach( $query as $row ){
              echo '<div class="swiper-slide" ><img src="'.$row["image_full"].'"></div>';
            }
          ?>
          </div>
          <div class="swiper-button-next swiper-button"  ></div>
          <div class="swiper-button-prev swiper-button"  ></div>
          <div class="swiper-pagination"></div>
          <span class="swiper-notification"></span>
        </div>

        <div class="description">
            <?php echo htmlspecialchars_decode($game_description); ?>
        </div>

      </div>

    </section>




    <div class="game-detail-info">

      <div class="swiper game-detail-swiper">
        <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(-850px, 0px, 0px);">
        <?php
          $query = $db->query("SELECT * FROM game_images where game_steam_app_id='$app_id' ORDER BY image_id DESC ", PDO::FETCH_ASSOC);
          foreach( $query as $row ){
            echo '<div class="swiper-slide" ><img src="'.$row["image_full"].'"></div>';
          }
        ?>
        </div>
        <div class="swiper-button-next swiper-button"  ></div>
        <div class="swiper-button-prev swiper-button"  ></div>
        <div class="swiper-pagination"></div>
        <span class="swiper-notification"></span>
      </div>

      <div class="detail-info">
        <div class="info-item">
        <h4>Publisher</h4>
          <span><?php echo $game_publisher; ?></span>
        </div>

        <div class="info-item">
        <h4>Release Date</h4>
          <span><?php echo $game_release_date; ?></span>
        </div>

        <div class="info-item">
        <h4>Review Count</h4>
          <span><?php echo $game_review; ?></span>
        </div>

        <div class="info-item info-item-list">
          <h4>Genres</h4>
          <?php
            $query = $db->query("SELECT DISTINCT genre_id FROM game_genres where game_steam_app_id='$app_id' ORDER BY genre_id DESC", PDO::FETCH_ASSOC);
            foreach( $query as $row ){
              $genre_id = $row["genre_id"];

              $genre = $db->query("SELECT * FROM genres where genre_id ='$genre_id' ")->fetch(PDO::FETCH_ASSOC);
              echo '<div class="list-item">'.$genre["genre_name"].'</div>';
              
            }
          ?>
        </div>

      </div>
      
    </div>
  






  </section>

  <?php 
    include("footer.php");
  ?>


  <script>
    chooseGameEdition("<?php echo $edition; ?>");

    var swiper = new Swiper(".game-detail-swiper", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,
        keyboard: {
          enabled: true,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,

        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
  </script>


  </body>
</html>
