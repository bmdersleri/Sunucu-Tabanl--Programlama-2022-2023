<?php define("include",true); include("assets/blog_conf.php"); ?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $print['description']; ?>">
    <meta name="keywords" content="<?php echo $print['keywords']; ?>">
    <meta name="author" content="hyPerdarKness - github.com/hyPerdarKness">
    
	<title><?php echo $print['siteadi_title']; ?></title>
	
    <link rel="shortcut icon" href="assets/images/icon.png"> 
	<script defer src="assets/fontawesome/js/all.min.js"></script>
    <link id="theme-style" rel="stylesheet" href="assets/css/theme-<?php echo $print['color']; ?>.css">
<?php echo $print['analytics']; ?>	
</head> 
<body>
    
<?php include("assets/header.php"); ?>
    
    <div class="main-wrapper">
	    <section class="cta-section theme-bg-light py-5 border-bottom border-light">
		    <div class="container text-center">
			    <h2 class="heading"><?php echo $print['siteadi_head']; ?></h2>
			    <div class="intro"><?php echo $print['siteadi_intro']; ?></div>
		    </div>
	    </section>
	    <section class="blog-list px-3 py-5 p-md-5">
		    <div class="container">
<?php $limit = 6; $page = @$_GET["page"]; if(empty($page) or !is_numeric($page)){ $page = 1; }
$k = $db->prepare("select * from blog"); $k->execute(); $count = $k->rowCount();
$toplamsayfa = ceil($count / $limit); $baslangic = ($page-1)*$limit;
if($toplamsayfa < @$_GET["page"]){ echo '<meta http-equiv="refresh" content="0;URL=index.php">'; exit(); } 
$ver = $db->query("select * from blog order by id desc limit $baslangic,$limit"); foreach($ver as $yazdir){ ?>				
			    <div class="item mb-5">
				    <div class="media">
					    <img class="mr-3 img-fluid post-thumb d-none d-md-flex" src="<?php echo $yazdir['resim']; ?>" alt="<?php echo $yazdir['baslik']; ?>">
					    <div class="media-body">
							<!-- yazdımıgımız başlığı çekiyoruz -->
						    <h3 class="title mb-1"><a href="blog.php?url=<?php echo $yazdir['sefurl']; ?>"><?php echo $yazdir['baslik']; ?></a></h3>
							<!-- yazılan tarih çekliyor -->
						    <div class="meta mb-1"><span class="date"><i class="far fa-clock"></i> <?php echo timeConvert($yazdir['tarih']); ?></span></div> 
							<!-- içerik yazdırmak için kullanılıyor -->
						   <div class="intro"><?php echo htmlclean(kisalt($yazdir['icerik'], 200)); ?></div>  <!-- sadece 200 kelime yazdırmak için kullanıyoruz -->
						    <a class="more-link" href="blog.php?url=<?php echo $yazdir['sefurl']; ?>">Devamı &rarr;</a>
					    </div>
				    </div>
			    </div>
<?php } echo '<nav class="blog-nav nav nav-justified my-3">';

		if($count > $limit) : 
		
		$x = 2; $lastP = ceil($count/$limit); 

		if($page > 1){
		$onceki = $page-1;
		echo '<a class="nav-link-prev nav-item nav-link rounded" href="?page='.$onceki.'">Geri<i class="arrow-prev fas fa-long-arrow-alt-left"></i></a>&nbsp;&nbsp;'; 
		}
		
		if($page < $lastP){
		$sonraki = $page+1;
		echo '<a class="nav-link-next nav-item nav-link rounded" href="?page='.$sonraki.'">İleri<i class="arrow-next fas fa-long-arrow-alt-right"></i></a>'; 
		}

		endif; echo '</nav>';

?>
		    </div>
	    </section>
	    
	    <footer class="footer text-center py-2 theme-bg-dark">
		<small class="copyright">2023 </small> 

	    </footer>
    </div>
        
    <script src="assets/plugins/jquery-3.4.1.min.js"></script>
    <script src="assets/plugins/popper.min.js"></script> 
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 

</body>
</html>