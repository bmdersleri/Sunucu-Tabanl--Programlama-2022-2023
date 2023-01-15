<?php
   session_start();
   include("ayar.php");

   if ($_SESSION["giris"] !== sha1(md5("var")) || $_COOKIE["kullanici"] !== "by" ) {
   	header("Location: cikis.php");
   }


?>


<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Yönetim Paneli Ana Sayfa</title>
</head>
<body>

	<div style="text-align:center;">
		<a href="anasayfa.php">ANA SAYFA</a>-<a href="blog.php">BLOG</a>-<a href="hakkimda.php">HAKKIMDA</a>-<a href="hizmetler.php">HİZMETLER</a>-<a href="projelerim.php">PROJELERİM</a>-<a href="cikis.php" onclick="if (!confirm('Çıkış yapmak istediğinizden emin misiniz?')) return false;">ÇIKIŞ</a>
		<br><hr><br><br>
	</div>

	<h2 style="text-align: center;">Menüden Seçim Yapınız</h2>

	
	
</body>
</html>
