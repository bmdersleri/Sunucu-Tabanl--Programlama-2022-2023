<?php session_start();
 if(isset($_SESSION['furtherup']))
 { define("include",true); include("../assets/blog_conf.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex">
	
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
            <div class="widget-header"><i class="icon-cog"></i>
              <h3>Ayarlar</h3>
            </div>
            <div class="widget-content">
<?php if(isset($_POST['kaydet'])){

if($_POST['siteadi_title']==""){ echo '<div class="alert alert-danger">Site Adı alanını boş bırakmayın! Gerisi not matters..</div>'; }else{

$kayit = $db->prepare("update settings set siteadi_title=?,siteadi_sidebar=?,siteadi_head=?,siteadi_intro=?,keywords=?,description=?,analytics=?,color=?,about=?,facebook=?,twitter=?,instagram=?,youtube=?,linkedin=?,pinterest=?,github=?,stackoverflow=?,codepen=?"); 
$kayit->execute(array($_POST['siteadi_title'], $_POST['siteadi_sidebar'], $_POST['siteadi_head'], $_POST['siteadi_intro'], $_POST['keywords'], $_POST['description'], $_POST['analytics'], $_POST['color'], $_POST['about'], $_POST['facebook'], $_POST['twitter'], $_POST['instagram'], $_POST['youtube'], $_POST['linkedin'], $_POST['pinterest'], $_POST['github'], $_POST['stackoverflow'], $_POST['codepen']));
echo '<div class="alert alert-success">Düzenleme kaydedildi..</div>'; echo '<meta http-equiv="refresh" content="2">'; } } ?>
	<form method="post">

	<div class="span5" style="float:left;">
	
		<div class="control-group">											
			<label class="control-label">Site Adı (Title)</label>
			<div class="controls">
			<input type="text" class="span5" name="siteadi_title" value="<?php echo $print['siteadi_title']; ?>">
			</div>				
		</div>
		
		<div class="control-group">											
			<label class="control-label">Site Adı (Sidebar)</label>
			<div class="controls">
			<input type="text" class="span5" name="siteadi_sidebar" value="<?php echo $print['siteadi_sidebar']; ?>">
			</div>				
		</div>	

		<div class="control-group">											
			<label class="control-label">Anahtar Kelimeler (keywords)</label>
			<div class="controls">
			<textarea class="span5" name="keywords"><?php echo $print['keywords']; ?></textarea>			
			</div>				
		</div>

		<div class="control-group">											
			<label class="control-label">Site Tanıtım (description)</label>
			<div class="controls">
			<textarea class="span5" name="description"><?php echo $print['description']; ?></textarea>			
			</div>				
		</div>		

		<div class="control-group">											
			<label class="control-label">Sayaç Kodu</label>
			<div class="controls">
			<textarea class="span5" name="analytics"><?php echo $print['analytics']; ?></textarea>
			<p class="help-block">analytics, metrica vb.</p>			
			</div>				
		</div>		
		
		<div class="control-group">											
			<label class="control-label">Facebook URL</label>
			<div class="controls">
			<input type="text" class="span5" name="facebook" value="<?php echo $print['facebook']; ?>">
			</div>				
		</div>		
		
		<div class="control-group">											
			<label class="control-label">Twitter URL</label>
			<div class="controls">
			<input type="text" class="span5" name="twitter" value="<?php echo $print['twitter']; ?>">
			</div>				
		</div>
		
		<div class="control-group">											
			<label class="control-label">Instagram URL</label>
			<div class="controls">
			<input type="text" class="span5" name="instagram" value="<?php echo $print['instagram']; ?>">
			</div>				
		</div>			

		<div class="control-group">											
			<label class="control-label">Youtube URL</label>
			<div class="controls">
			<input type="text" class="span5" name="youtube" value="<?php echo $print['youtube']; ?>">
			</div>				
		</div>			

	</div>
	
	<div class="span6" style="float:right;">
		<div class="control-group">											
			<label class="control-label">Renk</label>
			<div class="controls">
			<input type="radio" name="color" value="1"<?php if($print['color']=="1"){ echo ' checked'; } ?>> <img src="img/renk1.jpg">
			<input type="radio" name="color" value="2"<?php if($print['color']=="2"){ echo ' checked'; } ?>> <img src="img/renk2.jpg">
			<input type="radio" name="color" value="3"<?php if($print['color']=="3"){ echo ' checked'; } ?>> <img src="img/renk3.jpg">
			<input type="radio" name="color" value="4"<?php if($print['color']=="4"){ echo ' checked'; } ?>> <img src="img/renk4.jpg">
			<input type="radio" name="color" value="5"<?php if($print['color']=="5"){ echo ' checked'; } ?>> <img src="img/renk5.jpg">
			<input type="radio" name="color" value="6"<?php if($print['color']=="6"){ echo ' checked'; } ?>> <img src="img/renk6.jpg">
			<input type="radio" name="color" value="7"<?php if($print['color']=="7"){ echo ' checked'; } ?>> <img src="img/renk7.jpg">
			<input type="radio" name="color" value="8"<?php if($print['color']=="8"){ echo ' checked'; } ?>> <img src="img/renk8.jpg">
			</div>				
		</div>	
		
		<div class="control-group">											
			<label class="control-label">Hakkında</label>
			<div class="controls">
			<textarea class="span5" name="about"><?php echo $print['about']; ?></textarea>
			<p class="help-block">sol sidebar resim altındaki yazı alanı</p>			
			</div>				
		</div>	
	
		<div class="control-group">											
			<label class="control-label">Anasayfa Üst Başlık</label>
			<div class="controls">
			<input type="text" class="span5" name="siteadi_head" value="<?php echo $print['siteadi_head']; ?>">
			</div>				
		</div>

		<div class="control-group">											
			<label class="control-label">Anasayfa Üst Başlık Yazısı (hemen altı)</label>
			<div class="controls">
			<textarea class="span5" name="siteadi_intro"><?php echo $print['siteadi_intro']; ?></textarea>
			</div>				
		</div>
		
		<div class="control-group">											
			<label class="control-label">Github URL</label>
			<div class="controls">
			<input type="text" class="span5" name="github" value="<?php echo $print['github']; ?>">
			</div>				
		</div>	
		
		<div class="control-group">											
			<label class="control-label">Linkedin URL</label>
			<div class="controls">
			<input type="text" class="span5" name="linkedin" value="<?php echo $print['linkedin']; ?>">
			</div>				
		</div>	
		
		<div class="control-group">											
			<label class="control-label">Pinterest URL</label>
			<div class="controls">
			<input type="text" class="span5" name="pinterest" value="<?php echo $print['pinterest']; ?>">
			</div>				
		</div>	
		
		<div class="control-group">											
			<label class="control-label">Stackoverflow URL</label>
			<div class="controls">
			<input type="text" class="span5" name="stackoverflow" value="<?php echo $print['stackoverflow']; ?>">
			</div>				
		</div>		
		
		<div class="control-group">											
			<label class="control-label">Codepen URL</label>
			<div class="controls">
			<input type="text" class="span5" name="codepen" value="<?php echo $print['codepen']; ?>">
			</div>				
		</div>			
			
	</div>

		<div class="span11 form-actions">
			<button type="submit" name="kaydet" class="btn btn-success"><i class="icon-save"></i> Kaydet</button> 
			<a class="btn btn-danger" href="home.php"><i class="icon-remove-circle"></i> İptal</a>
		</div> 		
	</form>

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