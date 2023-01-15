<?php define("include",true); include("assets/blog_conf.php"); $url = htmlclean($_GET['url']); 
$sorgu = $db->prepare("select * from blog where sefurl=?"); $sorgu->execute(array($url)); if($sorgu->rowCount()=="0"){ header("Location:index.php"); }else{ $gelen = $sorgu->fetch(PDO::FETCH_ASSOC); ?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $print['description']; ?>">
    <meta name="keywords" content="<?php echo $print['keywords']; ?>">
    <meta name="author" content="hyPerdarKness - github.com/hyPerdarKness">
    
	<title><?php echo $gelen['baslik']; ?> | <?php echo $print['siteadi_title']; ?></title>
	
    <link rel="shortcut icon" href="assets/images/icon.png"> 
	<script defer src="assets/fontawesome/js/all.min.js"></script>
    <link id="theme-style" rel="stylesheet" href="assets/css/theme-<?php echo $print['color']; ?>.css">
<?php echo $print['analytics']; ?>	
</head> 
<body>
    
<?php include("assets/header.php"); ?>
    
    <div class="main-wrapper">
	    
		    <div class="container">
			    
				    <h2 class="title mb-2" style="color:#FFFFFF; text-align:; font-style: italic;"><?php echo $gelen['baslik']; ?></h2>
					<br><br>
					<label for="" style="color:#eea73b"><?php echo $gelen['icerik']; ?></label>
				
		    </div>
	  
	    	    
	   
    </div>
        
    <script src="assets/plugins/jquery-3.4.1.min.js"></script>
    <script src="assets/plugins/popper.min.js"></script> 
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 

</body>
</html>
<?php } ?>

<style class="css">
.container{
    width: 600px;
    height: 300px;
    padding: 20px;
    background-color:#303030;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -150px;
    margin-top: -125px;
    border-radius: 10px;
}
body{
    background:url(assets/images/backgr.jpg) center;
}



</style>