<?php
  include("session_control.php");
  include "../dbConnect.php";

  if(@$_SESSION["user_id"])
  {
?>

<html lang="tr" dir="ltr">

  <head>
    <?php include "head.php"; ?>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/radio.css">
    <title>Game Shopping</title>
  </head>

  <body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">


    <?php include("top_menu.php"); ?>
    <?php include("left_menu.php"); ?>

    <div class="center">

      <section class="container">

        <div class="sum">
          <div class="sum-icon">
            <img src="../images/steam.png" alt="">
          </div>
          <div class="sum-title">
          <h3>Total Steam Games</h3>
          <?php
            $query = $db->query("SELECT * FROM games ", PDO::FETCH_ASSOC);
          ?>
           <span style="color:var(--green); font-weight:bold"><?php echo $query ->rowCount(); ?></span>
          </div>
        </div>
        
        <!-- 
        <div class="sum">
          <div class="sum-icon">
          <img src="../images/epic-games.png" alt="">
          </div>
          <div class="sum-title">
          <h3>Total Epic Games</h3>
          <?php
            $query = $db->query("SELECT DISTINCT game_epic_app_id FROM game_prices where game_epic_app_id!='' ", PDO::FETCH_ASSOC);
          ?>
           <span style="color:var(--green); font-weight:bold"><?php echo $query ->rowCount(); ?></span>
          </div>
        </div>

        <div class="sum">
          <div class="sum-icon">
          <img src="../images/epic-games.png" alt="">
          </div>
          <div class="sum-title">
          <h3>Total Epic Free Games</h3>
          <?php
            $query = $db->query("SELECT * FROM epic_free_games ", PDO::FETCH_ASSOC);
          ?>
           <span style="color:var(--green); font-weight:bold"><?php echo $query ->rowCount(); ?></span>
          </div>
        </div>
         -->

        <div class="sum">
          <div class="sum-icon">
            <i class="fa-solid fa-gamepad"></i>
          </div>
          <div class="sum-title">
          <h3>Total Discounted Games</h3>
          <?php
            $query = $db->query("SELECT DISTINCT game_steam_app_id FROM game_prices where price_discount_percent!='0' ", PDO::FETCH_ASSOC);
          ?>
           <span style="color:var(--green); font-weight:bold"><?php echo $query ->rowCount(); ?></span>
          </div>
        </div>


        <div class="sum">
          <div class="sum-icon">
          <i class="fa-solid fa-circle-info"></i>
          </div>
          <div class="sum-title">
          <h3>Live Games (State = 1)</h3>
          <?php
            $query = $db->query("SELECT DISTINCT game_steam_app_id FROM games where game_state='1' ", PDO::FETCH_ASSOC);
          ?>
           <span style="color:var(--green); font-weight:bold"><?php echo $query ->rowCount(); ?></span>
          </div>
        </div>


        <div class="sum">
          <div class="sum-icon">
            <i class="fa-solid fa-circle-info"></i>
          </div>
          <div class="sum-title">
          <h3>NoLive Games (State = 0)</h3>
          <?php
            $query = $db->query("SELECT DISTINCT game_steam_app_id FROM games where game_state='0' ", PDO::FETCH_ASSOC);
          ?>
           <span style="color:var(--green); font-weight:bold"><?php echo $query ->rowCount(); ?></span>
          </div>
        </div>

      </section>

      <section class="container">
        <div class="game-list">

          <div class="title">
            <h1>Game List</h1>
          </div>

          <div class="pages">
            <div class="page-list">
              <ul>
          <?php

            $page = 1;
            if(@$_GET["page"])
            {
              $page = $_GET["page"];
            }

            $item_per_page = 100;
            $max_page_li = 5;

            $all_games = $db->query("SELECT * FROM games ORDER BY game_id DESC", PDO::FETCH_ASSOC);
            $number_of_page = ceil($all_games->rowCount() / $item_per_page);

            if($page > $number_of_page)
              $page = $number_of_page;

            //100 every page
            
            $page_first_result = ($page-1) * $item_per_page;  

            $page_query = $db->query("SELECT * FROM games ORDER BY game_id DESC LIMIT $page_first_result, $item_per_page ", PDO::FETCH_ASSOC);




            $prev = ($page - 1 < 0) ? 1 : ($page - 1);
            $next = ($page + 1 > $number_of_page) ? $number_of_page : $page + 1;

            $start_page_li = 1;

            echo '<a href="?page='.(1).'"><li><i class="fa-solid fa-backward-fast"></i></li></a>';
            echo '<a href="?page='.($prev).'"><li><i class="fa-solid fa-backward"></i></li></a>';

            $page_li = 0;
            for ($i=$page - (($max_page_li - 1) / 2); $i <= $number_of_page ; $i++) { 

              if($i < 1 || $page_li > $max_page_li - 1) continue;

              if($i == $page)
                echo '<a href="?page='.$i.'"><li class="active-page">'.$i.'</li></a>';
              else
                echo '<a href="?page='.$i.'"><li>'.$i.'</li></a>';

              $page_li++;
            }

            echo '<a href="?page='.($next).'"><li><i class="fa-solid fa-forward"></i></li></a>';
            echo '<a href="?page='.($number_of_page).'"><li><i class="fa-solid fa-forward-fast"></i></li></a>';

          ?>

              </ul>
            </div>
          </div>

          <div class="list">
            <?php



              $i = 0;
              $query = $db->query("SELECT * FROM games ORDER BY game_id DESC LIMIT $page,$item_per_page", PDO::FETCH_ASSOC);
              foreach( $query as $row ){

                $game_steam_app_id = $row["game_steam_app_id"];
                $images = $db->query("SELECT * FROM game_images WHERE game_steam_app_id='$game_steam_app_id' ")->fetch(PDO::FETCH_ASSOC);

                $game_prices = $db->query("SELECT * FROM game_prices WHERE game_steam_app_id='$game_steam_app_id' ORDER BY price_id DESC ")->fetch(PDO::FETCH_ASSOC);
                $epic_icon = ($game_prices["game_epic_app_id"] != "") ? '<img src="../images/epic-games.png">' : "";
                // $epic_icon = ($game_prices["game_epic_app_id"] != "") ? 'Epic Games' : "Only Steam";
                
                $state_class = ($row["game_state"] == 1) ? "active-item" : "inactive-item";
                $image = ($i < 10) ? $images["image_full"] : "../images/steam.png";
                $i++;

                  echo '
                  
                    <div class="list-item anim-hover-bright '.$state_class.'" id="item'.$row["game_id"].'">
                    <a href="../game-page.php?game='.$row["game_page_url"].'" target="_blank" class="url-click">
                    <div class="item-image">
                    <img src="'.$image.'" alt="">
                    </div>
                    <div class="item-name">
                      '.$epic_icon.'
                    '.$row["game_name"].'
                    </div>
                    </a>
                    <div class="control-buttons">
                      <button class="btn-with-radius" onclick="changeState('.$row["game_id"].')">Change State</button>
                      
                      <div class="input-part">
                      <h3>Initial Price</h3>
                      <input type="text" class="input-rounded" id="init'.$game_prices["price_id"].'" value="'.$game_prices["price_initial"].'" onkeypress="validate(event,value)" >
                      </div>

                      <div class="input-part">
                      <h3>Final Price</h3>
                      <input type="text" class="input-rounded" id="final'.$game_prices["price_id"].'" value="'.$game_prices["price_final"].'" onkeypress="validate(event,value)">
                      </div>

                      <button class="btn-with-radius" onclick="updatePrices('.$game_prices["price_id"].')">Update Prices</button>
                    </div>
                  </div>
                  
                  ';
                  // <button class="btn-with-radius" onclick="deleteItem('.$row["game_id"].')" style="background-color:var(--red)">Delete</button>

              }
            ?>
          </div>



            <!-- <button class="btn-with-radius" id="show-all" onclick="showAllGames()">Show All</button> -->

          <!-- <div class="list-item anim-hover-bright">
            <div class="item-image">
            <img src="../images/mbbannerlord-h.jpg" alt="">
            </div>
            <div class="item-name">
              <img src="../images/epic-games.png" alt="">
            Amnesia: The Dark Descent
            </div>
            <div class="control-buttons">
              <button class="btn-with-radius">Remove</button>
              <button class="btn-with-radius">Delete</button>
            </div>
          </div> -->

        </div>



      </section>


    </div>


  <script>

    function showAllGames() {
      $(".game-list .list").css("max-height", "none");
      $("#show-all").hide();
    }

    function changeState(gameId){

      post_data = {
        'change_state_item' : 1,
        'change_state_item_id' : gameId,
      };

      $.ajax({
        type: "POST",
        url: 'ajax/ajax_index.php',
        data:  post_data,
        dataType:"json",
        success: function(result) {
          arrayNotificationAdder(result);

          //Change Color
          if($("#item"+gameId).css("border-color").includes("218")){
            $("#item"+gameId).css("border-color","var(--red)");
          }else{
            $("#item"+gameId).css("border-color","var(--green)");
          }

        }

      });

    }

    function deleteItem(gameId){

      post_data = {
        'delete_item' : 1,
        'delete_item_id' : gameId,
      };

      $.ajax({
        type: "POST",
        url: 'ajax/ajax_index.php',
        data:  post_data,
        dataType:"json",
        success: function(result) {
          arrayNotificationAdder(result);
          $("#item"+gameId).css("display","none");
        }
      });

    }


    function updatePrices(price_id){

      
      post_data = {
        'update_prices' : 1,
        'price_id' : price_id,
        'price_initial' : $("#init"+price_id).val(),
        'price_final' : $("#final"+price_id).val(),
      };

      $.ajax({
        type: "POST",
        url: 'ajax/ajax_index.php',
        data:  post_data,
        dataType:"json",
        success: function(result) {
          console.log(result);
          arrayNotificationAdder(result);

        }

      });


    }



    chooseLeftMenuItem(0);




  </script>


  </body>
</html>

<?php } ?>