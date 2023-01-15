<?php
    session_start();
    include("ayar.php");

    if ($_SESSION["giris"] != sha1(md5("var")) || $_COOKIE["kullanici"] != "by") {
        header("Location: cikis.php");
    }

    if ($_POST) {
        $aciklama = $_POST["aciklama"];
        $sorgu = $baglan->query("delete from hakkimda");
        $sorgu = $baglan->query("insert into hakkimda (aciklama) values ('$aciklama')");
        echo "<script> window.location.href='hakkimda.php'; </script>";
    }

    $sorgu = $baglan->query("select * from hakkimda");
    $satir = $sorgu->fetch_object();

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Yönetim Paneli Hakkımda</title>
</head>
<body style="text-align:center;">

    <div style="text-align:center;">
        <a href="anasayfa.php">ANA SAYFA</a> - <a href="blog.php">BLOG</a> - <a href="hakkimda.php">HAKKIMDA</a> - <a href="hizmetler.php">HİZMETLER</a> - <a href="projelerim.php">PROJELERİM</a> - <a href="cikis.php" onclick="if (!confirm('Çıkış Yapmak İstediğinize Emin misiniz?')) return false;">ÇIKIŞ</a>
        <br><hr><br><br>
    </div>

    <form action="" method="post">
        <b>İçerik:</b><br><br>
        <textarea style="width:80%;height:300px;" name="aciklama"><?php echo $satir->aciklama; ?></textarea><br><br>
        <input type="submit" value="Kaydet">
    </form>

    

</body>
</html>