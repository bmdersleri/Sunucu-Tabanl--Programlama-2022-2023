<?php
  include("session_control.php");
  include "../dbConnect.php";
  if(@$_SESSION["user_id"])
  {
?>

<html lang="tr" dir="ltr">

  <head>
    <?php include "head.php"; ?>
    <link rel="stylesheet" type="text/css" href="css/update-games.css">
    <link rel="stylesheet" type="text/css" href="css/radio.css">
    <title>Game Shopping</title>
  </head>

  <body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">


    <?php include("top_menu.php"); ?>
    <?php include("left_menu.php"); ?>

    <div class="center">
      
      <div class="container">

        <div class="sum">
          <div class="sum-icon">
            <i class="fa-solid fa-arrows-rotate"></i>
          </div>
          <div class="sum-title">
          <h3>Last Game Update Time</h3>
          <?php
            $query = $db->query("SELECT * FROM game_prices where game_epic_app_id= '' and game_steam_app_id != '' ORDER BY price_id DESC ")->fetch(PDO::FETCH_ASSOC);
            echo @$query["price_date"];
          ?>
          </div>
        </div>

        <div class="sum">
          <div class="sum-icon">
            <i class="fa-solid fa-arrows-rotate"></i>
          </div>
          <div class="sum-title">
          <h3>Last Add Game Time</h3>
          <?php
            @$lastAddedGame = $db->query("SELECT * FROM games ORDER BY game_id DESC ")->fetch(PDO::FETCH_ASSOC); 
            @$game_id = $lastAddedGame["game_id"];
            $query = $db->query("SELECT * FROM game_prices LEFT JOIN games ON games.game_steam_app_id = game_prices.game_steam_app_id where games.game_id = '$game_id' ORDER BY price_id ASC ")->fetch(PDO::FETCH_ASSOC);
            echo @$query["price_date"];
          ?>
          </div>
        </div>

        <!-- <div class="sum">
          <div class="sum-icon">
            <i class="fa-solid fa-arrows-rotate"></i>
          </div>
          <div class="sum-title">
          <h3>Last Epic Games Update Time</h3>
          <?php
            $query = $db->query("SELECT * FROM game_prices where game_epic_app_id!= '' ORDER BY price_id DESC ")->fetch(PDO::FETCH_ASSOC);
            echo @$query["price_date"];
          ?>
          </div>
        </div>

        <div class="sum">
          <div class="sum-icon">
            <i class="fa-solid fa-arrows-rotate"></i>
          </div>
          <div class="sum-title">
          <h3>Last Epic Free Games Update Time</h3>
          <?php
            $query = $db->query("SELECT * FROM game_prices where game_edition='Free' ORDER BY price_id DESC ")->fetch(PDO::FETCH_ASSOC);
            echo @$query["price_date"];
          ?>
          </div>
        </div> -->
        
      </div>

      <div class="container">
        <div class="update-col">
          <h2>Update Steam Prices</h2>
          <div class="update-settings-row">
            <div class="settings-item">
              <h3>Minimum Hour To Update</h3>
              <input type="text" class="input-rounded" value="11" id="min-hour-to-update-steam">
            </div>
          <button class="btn-with-radius" onclick="updateSteamGames()">Run</button>
          </div>
        </div>

        <!-- <div class="update-col">
          <h2>Update Epic Prices</h2>
          <div class="update-settings-row">
            <div class="settings-item">
              <h3>Minimum Hour To Update</h3>
              <input type="text" class="input-rounded" value="11" id="min-hour-to-update-epic">
            </div>
          <button class="btn-with-radius" onclick="updateEpicGames()">Run</button>
          </div>
        </div>
         -->
      </div>
    </div>


  <script>
    
    function updateSteamGames () {
      showLoadingScreen();

      post_data = {
        'update_steam_games' : 1,
        'min_hour_to_update' : document.getElementById("min-hour-to-update-steam").value
      };


      $.ajax({
        type: "POST",
        url: 'ajax/ajax_update_games.php',
        data:  post_data,
        dataType:"json",
        success: function(result) {
          // console.log(result);
          multipleArrayNotificationAdder(result);
          hideLoadingScreen();
        }
      });
      
    }


    // function updateEpicGames () {
    //   showLoadingScreen();
    //   post_data = {
    //     'update_epic_games' : 1,
    //     'min_hour_to_update' : document.getElementById("min-hour-to-update-epic").value
    //   };
      
    //   $.ajax({
    //     type: "POST",
    //     url: 'ajax/ajax_update_games.php',
    //     data:  post_data,
    //     dataType:"json",
    //     success: function(result) {
    //       // console.log(result.length);
    //       multipleArrayNotificationAdder(result);
    //       hideLoadingScreen();
    //     }
    //   });
      
    // }

    chooseLeftMenuItem(2);

  </script>


  </body>
</html>

<?php } ?>