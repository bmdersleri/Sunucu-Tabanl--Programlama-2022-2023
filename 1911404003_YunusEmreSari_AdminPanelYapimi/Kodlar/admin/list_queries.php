<?php
  include("session_control.php");
  include "../dbConnect.php";

  if(@$_SESSION["user_id"])
  {
?>

<html lang="tr" dir="ltr">

  <head>
    <?php include "head.php"; ?>
    <link rel="stylesheet" type="text/css" href="css/list-queries.css">
    <link rel="stylesheet" type="text/css" href="css/radio.css">
    <title>Game Shopping</title>
  </head>

  <body leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">

    <?php include("top_menu.php"); ?>
    <?php include("left_menu.php"); ?>

    <div class="center">
      <div class="container">

        <div class="list-queries">
        <h2>List Queries</h2>

          <?php

            
            $query = $db->query("SELECT * FROM section_queries ORDER BY query_id DESC", PDO::FETCH_ASSOC);
            foreach( $query as $row ){

              echo '
              <div class="query-item">
                <div class="query-name">
                  <input type="text" id="query-name-'.$row["query_id"].'" class="input-rounded" value="'.$row["query_name"].'">
                </div>
                <div class="query-text wrap-text">
                  <textarea name="" id="query-text-'.$row["query_id"].'" class="textarea-base">'.$row["query"].'</textarea>
                </div>
                <div class="query-controls">
                  <button class="btn-with-radius" onclick="updateQuery('.$row["query_id"].')">Update</button>
                </div>
              </div>
              ';
            }


          ?>


          

        </div>

        
      </div>
    </div>





  <script>



    function updateQuery(query_id){

      post_data = {
        'update_query' : 1,
        'query_id' : query_id,
        'query_name' : $("#query-name-"+query_id).val(),
        'query_text' : $("#query-text-"+query_id).val(),
      };

      // console.log(post_data);

      $.ajax({
        type: "POST",
        url: 'ajax/ajax_list_queries.php',
        data:  post_data,
        dataType:"json",
        success: function(result) {
          // console.log(result.length);
          arrayNotificationAdder(result);
        }
      });

      
    }



    chooseLeftMenuItem(3);

  </script>




  </body>
</html>


<?php } ?>