<?php
   
   session_start();
   include("ayar.php");
 
   if ($_POST) {

   	  $kullanici = $_POST["kullanici"];
   	  $sifre = $_POST["sifre"];

   	  $q="SELECT * FROM kullanici WHERE (kullanici='$kullanici' && sifre='$sifre')";
        //echo $q;


        $sorgu = $baglan-> query($q);
   	  
        
        $kayitsay = $sorgu-> num_rows;
       

   	  if ($kayitsay > 0) {
         setcookie("kullanici","by", time()+60*60);

      	$_SESSION["giris"] = sha1(md5("var"));
   	  	echo 	"<script> window.location.href='anasayfa.php'; </script>";

         echo "Giriş başarılı";
   	  } else{
   	   echo 
   	  	"<script> alert('HATALI KULLANICI BİLGİSİ!'); window.location.href='cikis.php';
   	  	</script>";
         echo "giriş başarısız";

   	}

   }
?>


<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Yönetim Paneli Giriş</title>
</head>
<body style="text-align: center;padding-top: 50px;">

	<form action="" method="post">
		<b>Kullanıcı Adı:</b><br>
		<input type="text" name="kullanici" required><br>
		<b>Parola:</b><br>
		<input type="password" name="sifre" required><br><br>
		<input type="submit" value="Giriş Yap">	
	</form>
	
</body>
</html>

