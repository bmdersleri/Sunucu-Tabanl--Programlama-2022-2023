<?php require "db.php"; ?>

<?php
// Oturumu başlatma
session_start();
$loggedin = false;

//Kullanıcının oturum açmış olup olmadığını kontrol edip açmışsa karşılama sayfasına yönlendirilir.
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
   $loggedin = true;
    
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo/flogo" sizes="32x32" type="image/png">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    