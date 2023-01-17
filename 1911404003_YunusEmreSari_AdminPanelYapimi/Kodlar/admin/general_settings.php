<?php
  include("session_control.php");
  include "../dbConnect.php";

  if(@$_SESSION["user_id"])
  {
?>

<html lang="tr" dir="ltr">

  <head>
    <?php include "head.php"; ?>
    <link rel="stylesheet" type="text/css" href="css/general-settings.css">
    <link rel="stylesheet" type="text/css" href="css/base.css">
    <title>Game Shopping</title>
  </head>

  <body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">

    <?php include("top_menu.php"); ?>
    <?php include("left_menu.php"); ?>

    <div class="center">
      <div class="container">
        
          <div class="col">
            <div class="col-title">
            Delete All Steam Games
            </div>
            <?php
              $query = $db->query("SELECT * FROM games ", PDO::FETCH_ASSOC);
              $query1 = $db->query("SELECT * FROM game_prices where game_Edition!='Standard' and game_epic_app_id='' ", PDO::FETCH_ASSOC);
            ?>
            <div class="info-item wrap-text">Total Steam Games: <span style="color:var(--green); font-weight:bold"><?php echo $query ->rowCount(); ?></span></div>
            <div class="info-item wrap-text">Total Steam Game Editions: <span style="color:var(--green); font-weight:bold"><?php echo $query1 ->rowCount(); ?></span></div>
              <button class="btn-with-radius" style="background-color:var(--red)" onclick="deleteAllSteamGames(false)">Delete All Games</button>  
          </div>


          <div class="col">
            <div class="col-title">
            Clear Notifications
            </div>
            <?php
              $query = $db->query("SELECT * FROM notifications ", PDO::FETCH_ASSOC);
            ?>
            <div class="info-item wrap-text">Total Notification Count: <span style="color:var(--green); font-weight:bold"><?php echo $query ->rowCount(); ?></span></div>
              <button class="btn-with-radius" style="background-color:var(--red)" onclick="clearNotifications(false)">Clear Notifications</button>  
          </div>

      </div>
      
    </div>





  <script>

    // function deleteAllEpicGames(){
    //   showLoadingScreen();

    //   post_data = {
    //     'delete_epic_store_games' : 1,
    //   };

    //   $.ajax({
    //     type: "POST",
    //     url: 'ajax/ajax_general.php',
    //     data:  post_data,
    //     dataType:"json",
    //     success: function(result) {
    //       // console.log(result.length);
    //       arrayNotificationAdder(result);
    //       hideLoadingScreen();
    //     }
    //   });
    // }

    function deleteAllSteamGames(){
      showLoadingScreen();

      post_data = {
        'delete_steam_games' : 1,
      };

      $.ajax({
        type: "POST",
        url: 'ajax/ajax_general.php',
        data:  post_data,
        dataType:"json",
        success: function(result) {
          // console.log(result.length);
          arrayNotificationAdder(result);
          hideLoadingScreen();
        }
      });
    }


    function clearNotifications(){
      
      post_data = {
        'clear_notifications' : 1,
      };

      $.ajax({
        type: "POST",
        url: 'ajax/ajax_general.php',
        data:  post_data,
        dataType:"json",
        success: function(result) {
          // console.log(result.length);
          arrayNotificationAdder(result);
        }
      });

    }



    chooseLeftMenuItem(4);

  </script>




  </body>
</html>


<?php } ?>