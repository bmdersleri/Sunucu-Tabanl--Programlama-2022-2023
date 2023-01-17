<h2>SEO</h2>
         <?php
         if(isset($_GET['msg'])){
             
  if($_GET['msg']=='updated'){
      ?>
      <div class="alert alert-success text-center" role="alert">
      Başarıyla güncellendi !
</div>
      <?php
  }  
  if($_GET['msg']=='error'){
      ?>
      <div class="alert alert-danger text-center" role="alert">
      Resminizde bir sorun var. Lütfen dosya tipini veya boyutunu kontrol edin!
</div>
      <?php
  } } 
?>  
         <form method="post" action="php/useo.php" enctype="multipart/form-data">
  <div class="form-row">
  <div class="form-group col-md-12">
<img src="../assets/img/<?=$data['icon']?>" class="img-thumbnail ooo">
  </div>
  
  <div class="form-group col-md-6">
  <label>Site simgesi (Minimum 100px X 100px, Maxsize 2mb)</label>
  <div class="custom-file">
   
    <input type="file" name="siteicon" class="custom-file-input" id="profilepic">
    <label class="custom-file-label" for="projectpic">Resim Seç...</label>
  </div></div>
  
   <div class="form-group col-md-6 mt-auto">
      <label for="name">Web Sitesi Başlığı</label>
      <input type="name" name="title" value="<?=$data['title']?>" class="form-control" id="name" placeholder="Muhammed Bera Yıldız">
    </div>
    
   
    
    <div class="form-group col-md-12">
      <label for="email">Anahtar Kelimeler (',' ile ayırın)</label>
      <input type="text" name="keywords" value="<?=$data['keyword']?>" class="form-control" id="email" placeholder="web developer,php developer,graphic designer,freelancer">
    </div>
    <div class="form-group col-md-12">
      <label for="email">Site Açıklaması (160 Karakter önerilir)</label>
      <input type="text" value="<?=$data['description']?>" name="description" class="form-control" id="email" placeholder="Bu site portfolyo sitesidir.">
    </div>
    <div class="form-group ml-auto">
        <input type="submit" name="seo" class="btn btn-primary" value="Kaydet">
    </div>
  
</form>