<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- font awesome cdn  -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>

<style>
<p style="background-image: url('stu.png');">
</style>

    



<!-- Navigation menu -->
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#" style="font-size:36px;">
    <img src="https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.vecteezy.com%2Ffree-vector%2Fstudent-logo&psig=AOvVaw3xDRVo-Ud66IsixTbjMbeb&ust=1673786763468000&source=images&cd=vfe&ved=0CBAQjRxqFwoTCKiuut2Lx_wCFQAAAAAdAAAAABAJ" width="200"  class="d-inline-block align-top" alt="">
    E-Öğrencilerin Kaydı --- AnaSayfa
  </a>

  <form class="form-inline my-2 my-lg-0">
      <img src="images/user.png" style="width:50px; height: 50px; margin-right:10px" alt>
  <a href="login.php" class="btn btn-primary"><i class="fa fa-lock-open"></i> Giriş Yap</a>
    </form>
</nav>
    <p>

    <div class="container">
    
    <div class="page-header">
        <h1> <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Sitemize hoşgeldiniz.</h1>
    </div>
    <hr>
    </div>
        <a href="reset-password.php" class="btn btn-warning">E-Öğrenci Kaydı</a>
        
    </p>
	
	
	
	
	 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
</body>
</html>
