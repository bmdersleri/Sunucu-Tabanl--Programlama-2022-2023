<?php

  include("php_settings_ajax.php");
  include("base_functions.php");

  $page_num = 0;
  $last_i = 0;

  if(@$_POST["get_steam_games"]){

    global $page_num;

    $page = $_POST["page"];
    $start_index = $_POST["start_index"];
    $def_count_per_page = $_POST["count_per_page"];
    $count_per_page = 0;//Üstteki defaulta göre buna değer atıyacaz aşağıda
    $min_review_count = $_POST["min_review_count"];
    $page_num = $page;

    // $url = "http://api.steampowered.com/ISteamApps/GetAppList/v1/";
    
    $url = "https://steamspy.com/api.php?request=all&page=".$page;
    $data = [];

    // if(url_exists($url) == 0){
    //   $data_item = getNotificationArray("error","No Page","No Page ".$page);
    //   array_push($data,$data_item);
    //   echo json_encode($data);
    //   return;
    // }

    @$json = file_get_contents($url);
    
    if(!$json || $json == null){
      $data_item = getNotificationArray("error","No Page","No Page: ".$page);
      array_push($data,$data_item);
      echo json_encode($data);
      return;
    }

    $json = json_decode($json,true);//array

    $keys = array_keys($json);
    
    //Steam Pages kısmına burda ilk defa ekliyoruz
    $length = count($keys);
    $query1 = $db->prepare("SELECT * FROM steam_game_pages WHERE page_num=?");
    $query1->execute(array($page));
    if(!$query1->rowCount()){
      $db->query("insert into steam_game_pages(page_id,page_num,last_control_index,page_max_game) values('','$page','1','$length')"); 
    }

    if($def_count_per_page == 0) 
      $count_per_page = count($keys);
    else
      $count_per_page = $def_count_per_page;
    
    sort($keys);
    
    $steam_game_pages = $db->query("SELECT * FROM steam_game_pages where page_num='$page' ")->fetch(PDO::FETCH_ASSOC);
    $last_control_index = $steam_game_pages["last_control_index"];

    $success_count = 0;
    $fail_count = 0;
    $none_count = 0;

    for ($i=$start_index; $i <$count_per_page + $start_index ; $i++) {

      if($i > count($keys))
      {
        $data_item = getNotificationArray("none","No Value","No Value Left");
        array_push($data,$data_item);
        break;
      }
      $last_i = $i;

      $game = $json[$keys[$i]];

      $query1 = $db->prepare("SELECT * FROM games WHERE game_steam_app_id=?");
      $query1->execute(array($game["appid"]));
      if($query1->rowCount()){
        $data_item = getNotificationArray("none","Already Added","Game already in database.<br>Game Id: ".$game["appid"]."<br>Game Name: ".$game["name"]);
        array_push($data,$data_item);

        $none_count++;
        increaseLastIndex($i);
        $db->exec("UPDATE steam_game_pages SET 	success_count=success_count+1 where page_num='$page' ");
        continue;
      }

      // if($game["price"] === "0" && $game["initialprice"] === "0" && $game["discount"] === "0" ){
      //   $data_item = getNotificationArray("none","Free Game","Free To Play game didn't add.<br>Game Id: ".$game["appid"]."<br>Game Name: ".$game["name"]."");
      //   array_push($data,$data_item);
      //   // echo "<span style='color:yellow; margin:0; padding:0; font-size:20px'>FREE TO PLAY</span> => FREE TO PLAY Id: ".$game["appid"]." Name: ".$game["name"]." <br>";
      //   $none_count++;
      //   increaseLastIndex($i);
      //   $db->exec("UPDATE steam_game_pages SET 	success_count=success_count+1 where page_num='$page' ");
      //   continue;
      // }


      if($game["positive"] + $game["negative"] >= $min_review_count){
        $game_added_succesfully = addGameValuesToDatabase($game["appid"]);
        if($game_added_succesfully){
          $success_count++;
          $db->exec("UPDATE steam_game_pages SET 	success_count=success_count+1 where page_num='$page' ");

          $data_item = getNotificationArray("success","Added","Game Id: ".$game["appid"]." Game Name: ".$game["name"]);
          array_push($data,$data_item);
          increaseLastIndex($i+1);
        }
        else{
          $fail_count++;
          $data_item = getNotificationArray("error","Couldn't Add","Game Id: ".$game["appid"]."<br>Game Name: ".$game["name"]);
          array_push($data,$data_item);
        }

      }

      // if($i%20 == 0){
      //   sleep(30);
      // }


    }

    $data_item = getNotificationArray("success","Success Count",$success_count);
    array_push($data,$data_item);

    $data_item = getNotificationArray("error","Fail Count",$fail_count);
    array_push($data,$data_item);

    $data_item = getNotificationArray("none","None Count",$none_count);
    array_push($data,$data_item);

    echo json_encode($data);
  }



  function addGameValuesToDatabase($app_id){

    global $db,$datetime_now,$date_now_str,$last_i,$page_num;

    // $app_id = "17300";

    $url = "https://store.steampowered.com/api/appdetails?appids=".$app_id."&l=en&cc=us";

    @$json = file_get_contents($url);
    if(!$json || $json == null)
    {
      addToFailedGames($app_id,$page_num,"No return json value");
      // increaseLastIndex($last_i);
      return false;
    }

    @$json = json_decode($json,true);//array

    @$game_name = htmlspecialchars($json[$app_id]["data"]["name"]);
    @$game_description = htmlspecialchars($json[$app_id]["data"]["detailed_description"]);
    @$game_supported_languages = htmlspecialchars($json[$app_id]["data"]["supported_languages"]);
    @$game_min_requirements = htmlspecialchars($json[$app_id]["data"]["pc_requirements"]["minimum"]);
    @$game_recommended_requirements = htmlspecialchars($json[$app_id]["data"]["pc_requirements"]["recommended"]);
    @$game_publisher = htmlspecialchars($json[$app_id]["data"]["publishers"][0]);
    @$game_release_date = $json[$app_id]["data"]["release_date"]["date"];
    @$game_categories = $json[$app_id]["data"]["categories"];
    @$game_genres = $json[$app_id]["data"]["genres"];
    // @$game_header_image = $json[$app_id]["data"]["header_image"];
    @$game_images = $json[$app_id]["data"]["screenshots"];
    @$game_videos = $json[$app_id]["data"]["movies"];
    @$price_overview = $json[$app_id]["data"]["price_overview"];
    @$price_groups= $json[$app_id]["data"]["package_groups"][0]["subs"];
    @$price_currency = $price_overview["currency"];
    
    if($price_currency == "") $price_currency = "USD";
    
    @$game_reviews = $json[$app_id]["data"]["recommendations"]["total"];
    @$game_url = "https://store.steampowered.com/app/".$app_id;
    @$packages = $json[$app_id]["data"]["packages"];
    @$game_page_url = generateSeoURL($game_name);

    $game_release_date = str_replace(",","",$game_release_date);
    $game_release_date_str = strtotime($game_release_date);
    $game_release_date = date("Y-m-d",$game_release_date_str);

    
    #region Game Base Details
    $query = $db->prepare("SELECT * FROM games WHERE game_steam_app_id=?");
    $query->execute(array($app_id));//Bu olmazsa $query->rowCount() hep 0 döndürüyor. Çoklu kontrol için bu şekide yapıyoruz
    //Eğer bu kategori daha önce eklenmediyse ekle
    if(!$query->rowCount() && $game_name != "" && $game_description != "" && $price_groups != "")
    {
      $db->query("insert into games(game_id,game_steam_app_id,game_epic_app_id,game_epic_sandbox_id, game_name, game_description, game_supported_languages, game_min_requirements, game_recommended_requirements, game_publisher, game_release_date, game_page_url, game_state) 
      values('','$app_id','','','$game_name','$game_description','$game_supported_languages','$game_min_requirements','$game_recommended_requirements','$game_publisher','$game_release_date','$game_page_url','1')");
    }
    else
    {
      addToFailedGames($app_id,$page_num,"Some values are empty!");
      increaseLastIndex($last_i);
      return false;
    }

    #endregion

    
    #region Reviews
    $query = $db->query("SELECT * FROM game_recommendations where game_steam_app_id = '$app_id' order by recommend_id desc")->fetch(PDO::FETCH_ASSOC);
    $diff_hour = 99;
    if($query)
    {
      $date_last_str = strtotime($query["recommend_date"]);
      $diff_hour = abs($date_now_str - $date_last_str)/(60*60);
    }
    // echo "Id: ".$query["recommend_id"]."<br>";
    // echo "Difference: ".$diff_hour."<br>";
    //Eğer son eklemenin üstünden 12 saat geçtiyse
    if($diff_hour > 12)
    {
      $add=$db->query("insert into game_recommendations(recommend_id,game_steam_app_id,recommend_count,recommend_date) values('','$app_id','$game_reviews','$datetime_now')");
    }
    #endregion


    #region Categories
    if($game_categories != null){
      for ($i=0; $i < count($game_categories); $i++) {

        $category_id = $game_categories[$i]["id"];
        $category_name = $game_categories[$i]["description"];

        $query = $db->prepare("SELECT * FROM categories WHERE category_id=?");
        $query->execute(array($category_id));//Bu olmazsa $query->rowCount() hep 0 döndürüyor. Çoklu kontrol için bu şekide yapıyoruz
        //Eğer bu kategori daha önce eklenmediyse ekle
        if(!$query->rowCount()){
          $add=$db->query("insert into categories(category_id,category_name) values('$category_id','$category_name')");
        }

        $query1 = $db->prepare("SELECT * FROM game_categories WHERE category_id=? and game_steam_app_id=? ");
        $query1->execute(array($category_id,$app_id));
        if(!$query1->rowCount()){
          $add=$db->query("insert into game_categories(category_id,game_steam_app_id) values('$category_id','$app_id')");
        }

      }
    }
    #endregion


    #region Genres
    if($game_genres != null){
      for ($i=0; $i <count($game_genres) ; $i++) {

        $genre_id = $game_genres[$i]["id"];
        $genre_name = $game_genres[$i]["description"];

        $query = $db->prepare("SELECT * FROM genres WHERE genre_id=? ");
        $query->execute(array($genre_id));
        if(!$query->rowCount()){
          $add=$db->query("insert into genres(genre_id,genre_name) values('$genre_id','$genre_name')");
        }

        $query1 = $db->prepare("SELECT * FROM game_genres WHERE genre_id=? and game_steam_app_id=? ");
        $query1->execute(array($genre_id,$app_id));
        if(!$query1->rowCount()){
          $add=$db->query("insert into game_genres(genre_id,game_steam_app_id) values('$genre_id','$app_id')");
        }

      }

    }
    #endregion
    

    #region Images
    if($game_images != null){

      // if($game_header_image != null)
      //   $db->query("insert into game_images(image_id,game_steam_app_id,image_thumbnail,image_full,image_date) VALUES ('','$app_id','','$game_header_image','$datetime_now') ");

      for ($i=0; $i < count($game_images) ; $i++) {


        $image_thumbnail = $game_images[$i]["path_thumbnail"];
        $image_full = $game_images[$i]["path_full"];

        $query = $db->prepare("SELECT * FROM game_images WHERE image_thumbnail=? and image_full=? ");
        $query->execute(array($image_thumbnail,$image_full));
        if(!$query->rowCount()){
          $add=$db->query("insert into game_images(image_id,game_steam_app_id,image_thumbnail,image_full,image_date) VALUES ('','$app_id','$image_thumbnail','$image_full','$datetime_now') ");
        }

      }
    }
    #endregion


    #region Videos
    if($game_videos != null){
      for ($i=0; $i < count($game_videos) ; $i++) {

        $movie_id = $game_videos[$i]["id"];
        $movie_url = $game_videos[$i]["mp4"]["480"];

        $query = $db->prepare("SELECT * FROM game_videos WHERE movie_id=? ");
        $query->execute(array($movie_id));
        if(!$query->rowCount()){
          $add=$db->query("insert into game_videos(movie_id,game_steam_app_id,movie_url,movie_date) VALUES ('$movie_id','$app_id','$movie_url','$datetime_now') ");
        }

      }
    }

    #endregion

    
    #region Prices 
    $query = $db->query("SELECT * FROM game_prices where game_steam_app_id = '$app_id' order by price_id desc")->fetch(PDO::FETCH_ASSOC);
    $diff_hour = 99;

    if($query)
    {
      $date_last_str = strtotime($query["price_date"]);
      $diff_hour = abs($date_now_str - $date_last_str)/(60*60);
    }

    if($diff_hour > 12 && $price_groups != null){
      for ($i=0; $i < count($price_groups) ; $i++) {

        $price_text = $price_groups[$i]["price_in_cents_with_discount"];
        $price_title = $price_groups[$i]["option_text"];
        $price_percent_saving = $price_groups[$i]["percent_savings_text"];
        
        $discount = getPercent($price_percent_saving);
        $final_price = getFinalPrice($price_text);
        $initial_price = getInitialPrice($final_price,$discount);
        $edition = getEdition($price_title);

        $hasEdition = $db->query("SELECT * FROM game_prices where game_steam_app_id ='$app_id' and game_edition = '$edition'  order by game_steam_app_id desc  ")->fetch(PDO::FETCH_ASSOC);

        if(!$hasEdition)
        {
          $add=$db->query("insert into game_prices(price_id, game_steam_app_id, game_epic_app_id,game_epic_sandbox_id, game_edition, price_currency, price_initial, price_final, price_discount_percent,game_url ,price_date,price_state)
        values('','$app_id','','','$edition','$price_currency','$initial_price','$final_price','$discount','$game_url','$datetime_now','0')");

          #region Packages
          //Package ler ekleniyor. Daha sonradan fiyat güncellemek için bunları kullanıcaz
          $package_id = $price_groups[$i]["packageid"];
          $db->query("insert into game_packages(game_steam_app_id,package_id) values('$app_id','$package_id')"); 
          #endregion


        }

        // echo $final_price."<br>";
        // echo "Initial: ".$initial_price."<br>Final: ".$final_price."<br>".$price_currency."<br>Edition: ".$edition."<br>Discount Percent: ".$discount."<br>";
        // echo "<br>";
      }
    }

    #endregion

    return true;

  }





  #region EPIC Games

  // if(@$_POST["get_epic_store_ids"]){

  //   @$latest = $_POST["isLatest"];
    
  //   $start = microtime(true);

  //   if($latest == "true"){
  //     $ret = exec("cd C:/xampp/htdocs/GameShopping/Epic Games Integration && node --no-warnings find-latest-add-epic-games.js 2>&1", $data, $err);
  //   }else{
  //     $ret = exec("cd C:/xampp/htdocs/GameShopping/Epic Games Integration && node --no-warnings find-all-epic-games.js 2>&1", $data, $err);
  //   }


  //   $time_elapsed_secs = microtime(true) - $start;

  //   // echo "Elapsed Time: ".$time_elapsed_secs."<br>";

  //   $json = json_decode($data[0],true);
  //   $data = [];

  //   $no_result_count = 0;
  //   $success_count = 0;

  //   for ($i=0; $i < count($json); $i++) { 

  //     $element = $json[$i];

  //     if($element === null){
  //       $data_item = getNotificationArray("none",$i.") Null","Result is null");
  //       array_push($data,$data_item);
  //       // echo $i.") <span style='color:red; margin:0; padding:0; font-size:20px'>Result Is Null</span> <br>";
  //       continue;
  //     }

  //     if(@isset($element["no-result"])){
  //       $no_result_count++;
  //       $game_steam_app_id = $element["no-result"];
  //       $update= $db->exec("UPDATE games SET game_epic_app_id='-' where game_steam_app_id='$game_steam_app_id' ");
  //       // echo $i.") <span style='color:red; margin:0; padding:0; font-size:20px'>No Result</span> => ".$element["no-result"]."<br>";
  //       continue;
  //     }

  //     $regex = "/(\w{0,})(?= Edition)/";
  //     preg_match($regex,$element["appName"],$matches);
  //     @$edition = $matches[0];

  //     if($edition == "")
  //       $edition = "Standard";
        
  //     $steam_app_id = $element["steamAppId"];
  //     $epic_app_id = $element["epicAppId"];
  //     $epic_sandbox_id = $element["epicSandboxId"];
  //     $epic_app_url = $element["epicAppUrl"];

  //     $data_item = getNotificationArray("success",$i.") Success","Epic Id Found.<br>Game Name: ".$element["appName"]."<br>Game Edition: ".$edition);
  //     array_push($data,$data_item);

  //     $success_count++;

  //     $hasEdition = $db->query("SELECT * FROM game_prices where game_steam_app_id='$steam_app_id' and game_epic_app_id='$epic_app_id' and game_edition='$edition' order by price_id desc")->fetch(PDO::FETCH_ASSOC);

  //     if(!$hasEdition)
  //       $add=$db->query("insert into game_prices(price_id, game_steam_app_id, game_epic_app_id,game_epic_sandbox_id, game_edition, price_currency, price_initial, price_final, price_discount_percent,game_url, price_date,price_state)
  //     values('','$steam_app_id','$epic_app_id','$epic_sandbox_id','$edition','','','','','$epic_app_url','$datetime_now','0')");
  
  //   }

  //   $data_item = getNotificationArray("none","No Result Count",$no_result_count);
  //   array_push($data,$data_item);

  //   $data_item = getNotificationArray("success","Success Count",$success_count);
  //   array_push($data,$data_item);

  //   echo json_encode($data);
    
  // }


  // if(@$_POST["get_epic_store_prices"]){

  //   global $db,$datetime_now,$date_now_str;

  //   $ret = exec("cd C:/xampp/htdocs/GameShopping/Epic Games Integration && node --no-warnings get-epic-game-prices.js 2>&1", $json, $err);

  //   $data = [];
  //   for ($i=0; $i < count($json); $i++) { 
  //     $brackets = array("[", "]");
  //     $withoutBrackets = str_replace($brackets, "", $json[$i]);
  //     $result = json_decode($withoutBrackets,JSON_INVALID_UTF8_IGNORE);

  //     $gameEpicAppId = $result["game_epic_app_id"];
  //     $gameEpicSandboxId = $result["game_epic_sandbox_id"];
  //     $priceCurrency = $result["price_currency"];
  //     $priceInitial = $result["price_initial"];
  //     $priceFinal = $result["price_final"];
  //     $priceDiscountPercent = $result["price_discount_percent"];

  //     $lastPriceQuery = $db->query("SELECT * FROM game_prices where game_epic_app_id='$gameEpicAppId' and game_epic_sandbox_id='$gameEpicSandboxId' order by price_id desc")->fetch(PDO::FETCH_ASSOC);
  //     $diff_hour = 99;

  //     if($lastPriceQuery)
  //     {
  //       $date_last_str = strtotime($lastPriceQuery["price_date"]);
  //       $diff_hour = abs($date_now_str - $date_last_str)/(60*60);
  //     }

  //     $update= $db->exec("UPDATE game_prices SET price_currency='$priceCurrency',price_initial='$priceInitial',price_final='$priceFinal',price_discount_percent='$priceDiscountPercent' where game_epic_app_id='$gameEpicAppId' and game_epic_sandbox_id='$gameEpicSandboxId'  ");

  //     if($update){
  //       $data_item = getNotificationArray("success","Success","Epic game price added.<br>Game Id: ".$gameEpicAppId);
  //       array_push($data,$data_item);
  //       // echo "<span style='color:green; margin:0; padding:0; font-size:20px'>SUCCESS</span> => Id: ".$gameEpicAppId."<br>";
  //     }else{
  //       // echo "<span style='color:red; margin:0; padding:0; font-size:20px'>Error</span> => Id: ".$gameEpicAppId."<br>";
  //       $data_item = getNotificationArray("error","Fail","Epic game price couldn't add.<br>Game Id: ".$gameEpicAppId);
  //       array_push($data,$data_item);
  //     }
  //   }

  //   echo json_encode($data);

  // }



  // if(@$_POST["get_epic_store_free_games"]){


  //   $ret = exec("cd C:/xampp/htdocs/GameShopping/Epic Games Integration && node --no-warnings get-epic-free-games.js 2>&1", $data, $err);

  //   $json = json_decode($data[0],true);


  //   $data = [];
  //   if(@$json["errors"])
  //   {
  //     $data_item = getNotificationArray("error","No Value","No value from JS<br>Please try again.");
  //     array_push($data,$data_item);
  //     echo json_encode($data);
  //     return;
  //   }

  //   $free_games = [];
  //   $count = 0;
  //   $elements = $json["data"]["Catalog"]["searchStore"]["elements"];
  //   for ($i=0; $i < count($elements); $i++) { 

  //     if(intval($elements[$i]["currentPrice"]) == 0 )
  //     {
  //       continue;
  //     }
  //     else{
  //       $free_games[$count] = $elements[$i];
  //       $count++;
  //     }
  //   }

  //   addEpicFreeGameToDatabase($free_games);

  // }


  // function addEpicFreeGameToDatabase($free_games){

  //   global $db,$datetime_now,$date_now_str;

  //   $data = [];
  //   for ($i=0; $i < count($free_games); $i++) { 

  //     $game = $free_games[$i];
      
  //     if($game == null){
  //       $data_item = getNotificationArray("error","Null","Null values");
  //       array_push($data,$data_item);
  //       continue;
  //     }

  //     $game_name = htmlspecialchars($game["title"]);
  //     $game_epic_app_id = $game["id"]; 
  //     $game_epic_sandbox_id = $game["namespace"]; 
  //     $game_description = htmlspecialchars($game["description"]); 
  //     $game_publisher = htmlspecialchars($game["publisherDisplayName"]);
  //     $game_price_currency = $game["price"]["totalPrice"]["currencyCode"]; 
  //     $game_initial_price = getFinalPrice($game["price"]["totalPrice"]["originalPrice"]);
  //     $game_final_price = ($game["price"]["totalPrice"]["discountPrice"]);
  //     $game_discount_percent = 100;
  //     $game_release_date = $game["pcReleaseDate"];
  //     $game_images = $game["keyImages"];
  //     $game_url = "https://store.epicgames.com/en-US/p/".$game["catalogNs"]["mappings"][0]["pageSlug"];
  //     @$game_page_url = generateSeoURL($game_name);


  //     $search  = array('T', '.000Z');
  //     $replace = array(' ', '');
  //     $game_offer_end_date = str_replace($search,$replace,$game["price"]["lineOffers"][0]["appliedRules"][0]["endDate"]);

  //     $query = $db->query("SELECT * FROM epic_free_games WHERE game_app_id='$game_epic_app_id' and game_sandbox_id='$game_epic_sandbox_id' ORDER BY game_offer_end_date DESC ");
  //     if($query->fetchColumn()){
  //       $data_item = getNotificationArray("error","Fail","Game already added.<br>Game Name: ".$game_name);
  //       array_push($data,$data_item);
  //       continue;
  //     }

  //     $db->query("insert into epic_free_games(game_app_id,game_sandbox_id,game_name,game_description,game_publisher,game_offer_end_date,game_page_url,game_state) 
  //     values('$game_epic_app_id','$game_epic_sandbox_id','$game_name','$game_description','$game_publisher','$game_offer_end_date','$game_page_url',1)"); 


  //     #region Price

  //     $add=$db->query("insert into game_prices(price_id, game_steam_app_id, game_epic_app_id,game_epic_sandbox_id, game_edition, price_currency, price_initial, price_final, price_discount_percent,game_url ,price_date,price_state)
  //     values('','','$game_epic_app_id','$game_epic_sandbox_id','Free','$game_price_currency','$game_initial_price','$game_final_price','$game_discount_percent','$game_url','$datetime_now','0')");

  //     if(!$add){
  //       $data_item = getNotificationArray("error","Fail","Game couldn't add. Game Name: ".$game_name);
  //       array_push($data,$data_item);
  //       // FailedToAdd($game_epic_app_id,$game_name,"Couldn't Add");
  //       continue;
  //     }

  //     #endregion


  //     #region Images

  //     if($game_images != null){

  //       $image_thumbnail = "";
  //       $image_full = "";
  //       for ($j=0; $j < count($game_images) ; $j++) { 
  //         if($game_images[$j]["type"] == "Thumbnail")
  //          $image_thumbnail = $game_images[$j]["url"];
          
  //         if($game_images[$j]["type"] == "OfferImageWide")
  //          $image_full = $game_images[$i]["url"];
  
  //         $query = $db->prepare("SELECT * FROM game_images WHERE image_thumbnail=? and image_full=? ");
  //         $query->execute(array($image_thumbnail,$image_full));
  //       }

  //       if(!$query->rowCount()){
  //         $add=$db->query("insert into game_images(image_id,game_steam_app_id,image_thumbnail,image_full,image_date) VALUES ('','$game_epic_app_id','$image_thumbnail','$image_full','$datetime_now') ");
  //       }
        
  //     }

  //     #endregion

  //     $data_item = getNotificationArray("success","Success","Game added.<br>Game Id: ".$game_epic_app_id."<br>Game Name: ".$game_name);
  //     array_push($data,$data_item);
  //   }

  //   echo json_encode($data);

  // }


  #endregion






  function increaseLastIndex($i){
    global $db,$page_num;
    $steam_game_pages = $db->query("SELECT * FROM steam_game_pages where page_num='$page_num' ")->fetch(PDO::FETCH_ASSOC);

    if($i > $steam_game_pages["last_control_index"])
      $db->exec("UPDATE steam_game_pages SET last_control_index=$i where page_num='$page_num'  ");
  }

  if(@!$_POST){

    // echo addGameValuesToDatabase("17570");
    Redirect();

  }



?>
