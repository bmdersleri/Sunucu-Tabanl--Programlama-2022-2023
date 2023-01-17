<?php
  include("php_settings_ajax.php");

  if(@$_POST["user_name"])
  {

    $data = [];

    $user_name = $_POST["user_name"];
    $user_password = $_POST["user_password"];

    $query = $db->query("SELECT * FROM users WHERE user_name='$user_name' and user_password='$user_password'")->fetch(PDO::FETCH_ASSOC);
    if($query){
      $user_id = $query["user_id"];

      $_SESSION["user_id"] = $user_id;
      $data["success"] = "Correct!";
    }else{
      $data["error"] = "Wrong username or password!";
    }

    echo json_encode($data);


  }

  if(@!$_POST){
    
    Redirect();

  }



?>
