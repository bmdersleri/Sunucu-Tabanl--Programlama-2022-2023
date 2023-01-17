<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_wishlist'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   
   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_wishlist_numbers) > 0){
       $message[] = 'zaten istek listesinde';
   }elseif(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'zaten karta eklendi';
   }else{
       mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
       $message[] = 'product added to wishlist';
   }

}

if(isset($_POST['add_to_cart'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'zaten kart eklendi';
   }else{

       $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

       if(mysqli_num_rows($check_wishlist_numbers) > 0){
           mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
       }

       mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'ürün karta eklendi';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>anasayfa</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="home">

   <div class="content">
      <h3>Yeni Koleksiyonlar</h3>
      <p>Yeni ve daha geniş çiçek yelpazemiz için tıklayın.</p>
      <a href="about.php" class="btn">Daha Fazla Keşfet</a>
   </div>

</section>

<section class="products">

   <h1 class="title">Son Ürünler</h1>

   <div class="box-container">

            <form action="" method="POST" class="box">
         <a href="view_page.php?pid=13" class="fas fa-eye"></a>
         <div class="price">$12/-</div>
         <img src="flowers/pink roses.jpg" alt="" class="image">
         <div class="name">pembe gül</div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="13">
         <input type="hidden" name="product_name" value="pembe gül">
         <input type="hidden" name="product_price" value="12">
         <input type="hidden" name="product_image" value="pink roses.jpg">
         <input type="submit" value="istek listesine ekle" name="add to wishlist" class="option-btn">
         <input type="submit" value="sepete ekle" name="add to cart" class="btn">
      </form>
            <form action="" method="POST" class="box">
         <a href="view_page.php?pid=15" class="fas fa-eye"></a>
         <div class="price">$15/-</div>
         <img src="flowers/beach florist.jpg" alt="" class="image">
         <div class="name">yazlık gül</div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="15">
         <input type="hidden" name="product_name" value="yazlık gül">
         <input type="hidden" name="product_price" value="15">
         <input type="hidden" name="product_image" value="cottage rose.jpg">
         <input type="submit" value="istek listesine ekle" name="add to wishlist" class="option-btn">
         <input type="submit" value="sepete ekle" name="add to cart" class="btn">
      </form>
            <form action="" method="POST" class="box">
         <a href="view_page.php?pid=16" class="fas fa-eye"></a>
         <div class="price">$13/-</div>
         <img src="flowers/lavendor rose.jpg" alt="" class="image">
         <div class="name">lavanta gülü</div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="16">
         <input type="hidden" name="product_name" value="lavanta gülü">
         <input type="hidden" name="product_price" value="13">
         <input type="hidden" name="product_image" value="lavendor rose.jpg">
         <input type="submit" value="istek listesine ekle" name="add to wishlist" class="option-btn">
         <input type="submit" value="sepete ekle" name="add to cart" class="btn">
      </form>
            <form action="" method="POST" class="box">
         <a href="view_page.php?pid=17" class="fas fa-eye"></a>
         <div class="price">$14/-</div>
         <img src="flowers/yellow tulipa.jpg" alt="" class="image">
         <div class="name">sarı lale</div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="17">
         <input type="hidden" name="product_name" value="sarı lale">
         <input type="hidden" name="product_price" value="14">
         <input type="hidden" name="product_image" value="yellow tulipa.jpg">
         <input type="submit" value="istek listesine ekle" name="add to wishlist" class="option-btn">
         <input type="submit" value="add to cart" name="add to cart" class="btn">
      </form>
            <form action="" method="POST" class="box">
         <a href="view_page.php?pid=18" class="fas fa-eye"></a>
         <div class="price">$11/-</div>
         <img src="flowers/red tulipa.jpg" alt="" class="image">
         <div class="name">kırmızı lale</div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="18">
         <input type="hidden" name="product_name" value="kırmızı lale">
         <input type="hidden" name="product_price" value="11">
         <input type="hidden" name="product_image" value="red tulipa.jpg">
         <input type="submit" value="istek listesine ekle" name="add to wishlist" class="option-btn">
         <input type="submit" value="sepete ekle" name="add to cart" class="btn">
      </form>
            <form action="" method="POST" class="box">
         <a href="view_page.php?pid=19" class="fas fa-eye"></a>
         <div class="price">$15/-</div>
         <img src="flowers/pink bouquet.jpg" alt="" class="image">
         <div class="name">pembe buket</div>
         <input type="number" name="product_quantity" value="1" min="0" class="qty">
         <input type="hidden" name="product_id" value="19">
         <input type="hidden" name="product_name" value="pembe buket">
         <input type="hidden" name="product_price" value="15">
         <input type="hidden" name="product_image" value="pink bouquet.jpg">
         <input type="submit" value="istek listesine ekle" name="add to wishlist" class="option-btn">
         <input type="submit" value="sepete ekle" name="add to cart" class="btn">
      </form>
      
   </div>

   <div class="more-btn">
      <a href="shop.php" class="option-btn">daha fazla yükle</a>
   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>Kafanıza takılanlar mı var ?</h3>
      <p>Bizimle iletişime geçmek için vakit kaybetmeyin. Telefon, mail ya da sosyal medyalarımızda bizlere hemen ulaşın</p>
      <a href="contact.php" class="btn">Bizimle irtibata geçin</a>
   </div>

</section>




<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>