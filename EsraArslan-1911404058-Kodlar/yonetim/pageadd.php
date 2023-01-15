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
            <div class="widget-header"><i class="icon-plus"></i>
              <h3>Sayfa Ekle</h3>
            </div>
            <div class="widget-content">
<?php if(isset($_POST['ekle'])){ $sef = temizle($_POST['baslik']);

if($_POST['sira']==""||$_POST['icon']==""||$_POST['baslik']==""||$_POST["icerik"]==""){ echo '<div class="alert alert-danger">Lütfen tüm alanları doldurun!</div>'; }else{

$kayit = $db->prepare("insert into sayfalar set sira=?,baslik=?,icon=?,icerik=?,sefurl=?"); 
$kayit->execute(array($_POST['sira'], $_POST['baslik'], $_POST['icon'], $_POST['icerik'], $sef));

echo '<div class="alert alert-success">Yeni sayfa eklendi...</div>'; echo '<meta http-equiv="refresh" content="2">'; } } ?>
<form method="post">
		<div class="control-group">											
			<label class="control-label">Sıra No</label>
			<div class="controls">
			<input type="number" min="1" max="99" class="span6" name="sira">
			<p class="help-block">Sıra numarası görüntülenme sırasını belirler</p>
			</div>				
		</div>

		<div class="control-group">											
			<label class="control-label">Sayfa Başlığı</label>
			<div class="controls">
			<input type="text" class="span6" name="baslik">
			</div>				
		</div>	
		
		<div class="control-group">											
			<label class="control-label">İcon</label>
			<div class="controls">
			<input type="text" class="span6" name="icon" placeholder="file, edit, bookmark">
			<p class="help-block"><a target="_blank" rel="nofollow" href="https://fontawesome.com/icons?m=free">font awesome icon</a> <-- linke tıklayıp istediğiniz icon'u ekleyin !!! sadece icon ismini yazın !!!</p>			
			</div>				
		</div>		
		
		<div class="control-group">											
			<label class="control-label">İçerik</label>
			<div class="controls">
			<textarea name="icerik" class="span6" rows="5"></textarea>			
			</div>				
		</div>		

		<div class="form-actions">
			<button type="submit" name="ekle" class="btn btn-success"><i class="icon-plus"></i> Ekle</button> 
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
    <script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/5/tinymce.min.js"></script>
<script>
tinymce.init({
  selector: 'textarea',
  height: 500,
  language: 'tr',
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | source code help',
  content_css: '//www.tiny.cloud/css/codepen.min.css'
});
</script>
  
</body>
</html>
<?php }else{ echo '<meta http-equiv="refresh" content="0;URL=../index.php">'; } ?>