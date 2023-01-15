<?php session_start(); if(isset($_SESSION['furtherup'])){ define("include",true); include("../assets/blog_conf.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex">
	<meta name="author" content="hyPerdarKness - github.com/hyPerdarKness">
	
    <title><?php echo $print['siteadi_title']; ?> Yönetim Paneli</title>
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/pages/dashboard.css" rel="stylesheet">

</head>
<body>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="home.php"><?php echo $print['siteadi_title']; ?> Yönetim Paneli</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
		<li><a href="../index.php" target="_blank">Siteyi Görüntüle <i class="icon-chevron-right"></i></a></li>		
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="yonetim.php?id=<?php echo $_SESSION['furtherup']; ?>">Şifre Değiştir</a></li>
              <li><a href="logout.php">Çıkış Yap</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php include("plug/menu.php"); ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
          <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
            </div>
            <div class="widget-content">
              <div class="shortcuts">
        <a href="blogs.php" class="shortcut"><i class="shortcut-icon icon-list"></i><span class="shortcut-label">Blog Yazıları</span></a>
        <a href="pages.php" class="shortcut"><i class="shortcut-icon icon-file"></i><span class="shortcut-label">Sayfalar</span></a>
        <a href="ayarlar.php" class="shortcut"><i class="shortcut-icon icon-cog"></i><span class="shortcut-label">Ayarlar</span></a>
        <a href="yonetim.php?id=<?php echo $_SESSION['furtherup']; ?>" class="shortcut"><i class="shortcut-icon icon-user"></i><span class="shortcut-label">Yönetim</span></a>
		<p style="margin-top:50px;"><img src=""></a></p>
				</div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>



	<script src="js/jquery-1.7.2.min.js"></script> 
	<script src="js/bootstrap.js"></script>
	<script src="js/base.js"></script> 
	
</body>
</html>
<?php }else{ echo '<meta http-equiv="refresh" content="0;URL=../index.php">'; } ?>