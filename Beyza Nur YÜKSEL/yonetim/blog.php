<?php
    session_start();
    include("ayar.php");

    if ($_SESSION["giris"] != sha1(md5("var")) || $_COOKIE["kullanici"] != "by") {
        header("Location: cikis.php");
    }

    $islem = isset($_GET["islem"]);

    if ($islem == "sil") {
        $id = isset($_GET["id"]);
        $sorgu = $baglan->query("delete from blog where (id='$id')");
        echo "<script> window.location.href='blog.php'; </script>";
    }

    if ($islem == "ekle") {
        $baslik = $_POST["baslik"];
        $resim = "img/".$_FILES["resim"][name];
        move_uploaded_file($_FILES["resim"][tmp_name], $resim);
        $sorgu = $baglan->query("insert into blog (baslik,resim) values ('$baslik','../$resim')");
        echo "<script> window.location.href='blog.php'; </script>";
    }

     

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Yönetim Paneli Blog</title>
</head>
<body style="text-align:center;">

    <div style="text-align:center;">
        <a href="anasayfa.php">ANA SAYFA</a> - <a href="blog.php">BLOG</a> - <a href="hakkimda.php">HAKKIMDA</a> - <a href="hizmetler.php">HİZMETLER</a> - <a href="projelerim.php">PROJELERİM</a> - <a href="cikis.php" onclick="if (!confirm('Çıkış Yapmak İstediğinize Emin misiniz?')) return false;">ÇIKIŞ</a>
        <br><hr><br><br>
    </div>

    <table width="100%" border="1">
        <tr align="center">
            <th>S. No</th>
            <th>Başlık</th>
            <th>Sil</th>
        </tr>
        <?php
            $sirano = 0;
            $sorgu = $baglan->query("select * from blog");
            while ($satir = $sorgu->fetch_object()) {
                $sirano++;
                echo "<tr align='center'>
                <td>$sirano</td>
                <td>$satir->baslik</td>
                <td><a href='blog.php?islem=sil&id=$satir->id'>Sil</td>
                </tr>";
            }
        ?>
    </table>

    <br><br>

    <form action="blog.php?islem=ekle" enctype="multipart/form-data" method="post">
        <b>Başlık:</b><input type="text" size="20" name="baslik"> 
        <b>Resim:</b><input type="file" name="resim"> 
        <input type="submit" value="Kaydet">
    </form>



    

</body>
</html>