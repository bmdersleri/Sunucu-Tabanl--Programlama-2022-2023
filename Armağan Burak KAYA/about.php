<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Hakkımda</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Hakkımızda</h3>
    <p> <a href="home.php">Anasayfa</a> / Hakkımızda </p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/about-img-1.png" alt="">
        </div>

        <div class="content">
            <h3>Neden bizi seçin?</h3>
            <p>Günlük, düzenli ve özenli gönderim sağlıyoruz. Bir sıkıntı yaşadığınızda bize rahatça ulaşabiliyorsunuz.</p>
            <a href="shop.php" class="btn">Şimdi Alışveriş Yap</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>Biz ne sağlıyoruz ?</h3>
            <p>Güvenilirlik ve kaliteli ürünler sağlayarak, sevdiklerinize çiçek ile sevginizi ilan edebilmenize yardımcı oluyoruz.</p>
            <a href="contact.php" class="btn">İletişime Geçin</a>
        </div>

        <div class="image">
            <img src="images/about-img-2.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/about-img-3.jpg" alt="">
        </div>

        <div class="content">
            <h3>Biz kimiz ?</h3>
            <p>.... tarihininden bu yana, sevenlerin, sevdiklerinin kalbine ulaşabilmesini sağlayan, güzel ve saygın bir ekibiz.</p>
            <a href="#reviews" class="btn">Müşteri Görüşleri</a>
        </div>

    </div>

</section>

<section class="reviews" id="reviews">

    <h1 class="title">Müşteri Görüşleri</h1>

    <div class="box-container">

        <div class="box">
            <img src="images/pic-1.png" alt="">
            <p>Taze ve düzgün bir şekilde ulaştırıldı :)</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Captain America</h3>
        </div>

        <div class="box">
            <img src="images/pic-2.png" alt="">
            <p>Kendimi mutlu etmek isterken, onlar beni mutlu etti :)</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Black Widow</h3>
        </div>

        <div class="box">
            <img src="images/pic-3.png" alt="">
            <p>Beğendik !</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Harry Dean</h3>
        </div>

        <div class="box">
            <img src="images/pic-4.png" alt="">
            <p>Kokuları çok güzel..</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Zübeyde Ana</h3>
        </div>

        <div class="box">
            <img src="images/pic-5.png" alt="">
            <p>Önce gözlüğüme sonra da çiçeklere baktım ve ikiside çok güzeller :)</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Mr. Ego</h3>
        </div>

        <div class="box">
            <img src="images/pic-6.png" alt="">
            <p>Itoshi teru!</p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Loretta Bloom</h3>
        </div>

    </div>

</section>











<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>