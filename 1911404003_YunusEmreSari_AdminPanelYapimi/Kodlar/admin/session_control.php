<?php
session_start();
//   include("ajax/base_functions.php");

if(!@$_SESSION["user_id"])
{
    echo "<h2>You Are Being Redirecting</h2>";
    header("Refresh: 1; url=../index.php");
}


?>