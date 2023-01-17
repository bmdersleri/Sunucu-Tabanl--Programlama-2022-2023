<?php
  include("session_control.php");
  include "../dbConnect.php";

  if(@$_SESSION["user_id"])
  {
?>


<html lang="tr" dir="ltr">

  <head>
    <?php include "head.php"; ?>
    <link rel="stylesheet" type="text/css" href="css/add-games.css">
    <link rel="stylesheet" type="text/css" href="css/radio.css">
    <title>Game Shopping</title>
  </head>

  <body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">

    <?php include("top_menu.php"); ?>
    <?php include("left_menu.php"); ?>

    <div class="center">
      <div class="container">
          <div class="col long-col">
            <div class="col-title">
              Get Steam Games
            </div>
            <?php
              $query = $db->query("SELECT * FROM games ", PDO::FETCH_ASSOC);
              $query1 = $db->query("SELECT * FROM game_prices where game_Edition!='Standard' and game_epic_app_id='' ", PDO::FETCH_ASSOC);
            ?>
            <div class="info-item wrap-text">Total Steam Games: <span style="color:var(--green); font-weight:bold"><?php echo $query ->rowCount(); ?></span></div>
            <div class="info-item wrap-text">Total Steam Game Editions: <span style="color:var(--green); font-weight:bold"><?php echo $query1 ->rowCount(); ?></span></div>
            <div class="steam-game-pages">
              <h3>Steam Game Pages</h3>
                <?php 
                  $query = $db->query("SELECT * FROM steam_game_pages order by page_num asc", PDO::FETCH_ASSOC);
                  if(!$query->rowCount())
                    echo '<div class="radio" style="text-align:center; padding:10px 0;">No Page Request Saved</div>';

                  foreach( $query as $row ){
                    echo '
                    <div class="radio">
                      <input  type="radio" id="radio'.$row["page_num"].'" name="checked-game-page" received-game-count="'.$row["last_control_index"].'" page-num="'.$row["page_num"].'" page-max-game="'.$row["page_max_game"].'" onclick="pageSelected('.$row["page_num"].')">
                      <label for="radio'.$row["page_num"].'" class="wrap-text"><span>Game Page '.$row["page_num"].' - Last Index: <strong style="color:var(--green)">'.$row["last_control_index"].'</strong> - Success: <strong style="color:var(--green)">'.$row["success_count"].'</strong>  - Max: <strong style="color:var(--green)">'.$row["page_max_game"].'</strong></span></label>
                    </div>
                    ';
                  }
                ?>
            </div>

              <div class ="steam-page-setttings">
                <div class="col-setting-row"><h3>Start Page</h3> <input type="text" id="page" class="input-rounded" value="0" onkeypress='validate(event,value)'> </div>
                <div class="col-setting-row"><h3>Start Index</h3> <input type="text" id="start-index" class="input-rounded" value="0" onkeypress='validate(event,value)'> </div>
                <!-- <div class="col-setting-row"><h3>Page Count</h3> <input type="text" id="page-count" class="input-rounded" value="1" onkeypress='validate(event,value)'> </div> -->
                <div class="col-setting-row"><h3>Count Per Page</h3> <input type="text" id="count-per-page" class="input-rounded" value="10" onkeypress='validate(event,value)'> </div>
                <button class="btn-with-radius" onclick="getSteamGames()">Run</button>
              </div>
          </div>

          <!-- <div class="col">
            <div class="col-title">
            Get Epic Store Ids
            </div>
            <div class="get-epic-ids">
              <?php
              $query = $db->query("SELECT DISTINCT game_epic_app_id FROM game_prices where game_epic_app_id!='' ", PDO::FETCH_ASSOC);
              ?>
              <div class="info-item wrap-text">Total Epic Games / Edition: <span style="color:var(--green); font-weight:bold"><?php echo $query ->rowCount(); ?></span></div>
              <button class="btn-with-radius" onclick="getEpicStoreIds(true)">Run For The Latest</button>  
              <button class="btn-with-radius" style="background-color:var(--red)" onclick="getEpicStoreIds(false)">Run For All Games</button>  
            </div>
          </div>

          <div class="col">
            <div class="col-title">
            Get Epic Store Prices
            </div>
            <div class="get-epic-prices">
            <?php
              $query1 = $db->query("SELECT DISTINCT game_epic_app_id  FROM game_prices where game_epic_app_id!='' and price_currency!='' and price_final!='' ", PDO::FETCH_ASSOC);
            ?>
              <div class="info-item wrap-text">Epic Games With Price: <span style="color:var(--green); font-weight:bold"><?php echo $query1 ->rowCount()?></span></div>
            </div>
              <button class="btn-with-radius" onclick="getEpicStorePrices()">Run</button>
          </div>

          <div class="col">
            <div class="col-title">
            Get Epic Store Free Games
            </div>
            <div class="get-epic-prices">
            <?php
              $query = $db->query("SELECT DISTINCT game_epic_app_id  FROM game_prices where game_epic_app_id!='' and price_final='0' ", PDO::FETCH_ASSOC);
            ?>
              <div class="info-item wrap-text">Epic Free Games: <span style="color:var(--green); font-weight:bold"><?php echo $query ->rowCount(); ?></span></div>
            </div>
              <button class="btn-with-radius" onclick="getEpicStoreFreeGames();">Run</button>
          </div> -->

      </div>
      
    </div>





  <script>

    function getSteamGames() {
      showLoadingScreen();

      post_data = {
        'get_steam_games' : 1,
        'page' : document.getElementById("page").value,
        'start_index' : document.getElementById("start-index").value,
        'count_per_page' : document.getElementById("count-per-page").value,
        'min_review_count':document.getElementById("min-review-count".value)
      };

      $.ajax({
        type: "POST",
        url: 'ajax/ajax_add_games.php',
        data:  post_data,
        dataType:"json",
        success: function(result) {
          // console.log(result.length);
          arrayNotificationAdder(result);
          hideLoadingScreen();
        }
      });
    }

    // function getEpicStoreIds(isLatest) {

    //   showLoadingScreen();

    //   post_data = {
    //     'get_epic_store_ids' : 1,
    //     'isLatest':isLatest
    //   };

    //   $.ajax({
    //     type: "POST",
    //     url: 'ajax/ajax_add_games.php',
    //     data:  post_data,
    //     dataType:"json",
    //     success: function(result) {
    //       // console.log(result.length);
    //       arrayNotificationAdder(result);
    //       hideLoadingScreen();
    //     }
    //   });
      
    // }



    // function getEpicStorePrices() {
    //   showLoadingScreen();

    //   post_data = {
    //     'get_epic_store_prices' : 1,
    //   };

    //   $.ajax({
    //     type: "POST",
    //     url: 'ajax/ajax_add_games.php',
    //     data:  post_data,
    //     dataType:"json",
    //     success: function(result) {
    //       // console.log(result[0].desc);
    //       arrayNotificationAdder(result);
    //       hideLoadingScreen();
    //     }
    //   });
      
    // }


    // function getEpicStoreFreeGames(){
    //   showLoadingScreen();
      
    //   post_data = {
    //     'get_epic_store_free_games' : 1,
    //   };

    //   $.ajax({
    //     type: "POST",
    //     url: 'ajax/ajax_add_games.php',
    //     data:  post_data,
    //     // dataType:"json",
    //     success: function(result) {
    //       console.log(result);
    //       // console.log(result.length);
    //       arrayNotificationAdder(result);
    //       hideLoadingScreen();
    //     }
    //   });
    // }




    function pageSelected(id){
      var receivedGameCount = document.querySelector("#radio"+id).getAttribute("received-game-count");
      var pageNum = document.querySelector("#radio"+id).getAttribute("page-num");
      var pageMaxGame = document.querySelector("#radio"+id).getAttribute("page-max-game");
      document.getElementById("page").value = pageNum;
      document.getElementById("start-index").value = receivedGameCount;
      // document.getElementById("count-per-page").value = pageMaxGame-receivedGameCount;
    }

    setTimeout(() => {
      document.getElementById("radio0").click();
    }, "1")


    chooseLeftMenuItem(1);

  </script>




  </body>
</html>

<?php } ?>
