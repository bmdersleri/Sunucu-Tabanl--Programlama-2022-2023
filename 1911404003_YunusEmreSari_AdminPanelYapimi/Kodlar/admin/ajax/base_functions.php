<?php 



function getFinalPrice($price_str){

    $first_part = "/(?!\d{3})\d/";
    $last_part = "/(?=\d{3})\d/";

    $first = implode("", preg_split($first_part, $price_str));
    $last = implode("", preg_split($last_part, $price_str));

    $price_float = floatval($first.".".$last);


    return $price_float;
}



function getEdition($title){

  $title = str_replace('\'','',$title);
  $regex = "/\w{0,} (?=Edition)/";
  $result = preg_match($regex,$title,$matches);

  if($result != 0){
    return trim($matches[0]);
  }else{
    return "Standard";
  }
}


function getPercent($text){

  $regex = "/\d{0,}(?=%)/";
  $result = preg_match($regex,$text,$matches);

  if($result == 1)
    return $matches[0];
  else
    return 0;

}


function getInitialPrice($final_price,$discount){

  // console.log("Final: "+$final_price+" Discount: "+$discount);

  $initial_price = $final_price * 100 / (100 - $discount + 0.00001);

  if($initial_price > 0)
      return number_format((float)$initial_price, 2, '.', '');
  else
      return 0;

}


  
function addToFailedGames($app_id,$page_num,$desc){
  global $db,$datetime_now,$date_now_str;

  $query1 = $db->prepare("SELECT * FROM games where game_steam_app_id =? ");
  $query1->execute(array($app_id));

  $query2 = $db->prepare("SELECT * FROM failed_to_add where game_steam_app_id =? ");
  $query2->execute(array($app_id));

  if(!$query1->rowCount() && !$query2->rowCount() ){
    $add=$db->query("insert into failed_to_add(fail_id,game_steam_app_id,page_num,fail_description,fail_date) values('','$app_id','$page_num','$desc','$datetime_now')"); 
  }

}


function generateSeoURL($string, $wordLimit = 0){ 
  $separator = '-'; 
    
  if($wordLimit != 0){ 
      $wordArr = explode(' ', $string); 
      $string = implode(' ', array_slice($wordArr, 0, $wordLimit)); 
  } 

  $quoteSeparator = preg_quote($separator, '#'); 

  $trans = array( 
      '&.+?;'                 => '', 
      '[^\w\d _-]'            => '', 
      '\s+'                   => $separator, 
      '('.$quoteSeparator.')+'=> $separator 
  ); 

  $string = strip_tags($string); 
  foreach ($trans as $key => $val){ 
      $string = preg_replace('#'.$key.'#iu', $val, $string); 
  } 

  $string = strtolower($string); 

  return trim(trim($string, $separator)); 
}


function getNotificationArray($type,$title,$desc){

  $data_item = [];
  $data_item["type"]= $type;
  $data_item["title"]= $title;
  $data_item["desc"]= $desc;

  return $data_item;

}


function Redirect(){
  echo "<h2>You Are Being Redirecting</h2>";
  header("Refresh: 1; url=http://smurfdeals.com");
}


function url_exists($url) {
  $array = get_headers($url);
  $string = $array[0];
  if(strpos($string,"200"))
  {
  return 1;
  }
  else
  {
  return 0;
  }
}

?>