<h2>Bilgiler</h2>
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
         <form method="post" action="php/uhome.php" enctype="multipart/form-data">
  <div class="form-row">
  <div class="form-group col-md-6">
  <img src="../assets/img/<?=$data['profilepic']?>" class="oo img-thumbnail">
  <label>Profil Resmi (Minimum 600px X 600px, Maxsize 2mb)</label>
  <div class="custom-file">
    <input type="file" name="profile" class="custom-file-input" id="profilepic">
    <label class="custom-file-label" for="profilepic">Profil Resmini Seçiniz...</label>
  </div></div> 
  
   <div class="form-group col-md-6">
      <label for="name">İsim</label>
      <input type="name" name="name" value="<?=$data['name']?>" class="form-control" id="name" placeholder="M.Bera Yıldız">
    </div>    
    <div class="form-group col-md-6">
      <label for="email">Email</label>
      <input type="email" name="email" value="<?=$data['emailid']?>" class="form-control" id="email" placeholder="mberayildiz@gmail.com">
    </div>
    <div class="form-group col-md-6">
      <label for="twitter">Twitter</label>
      <input type="text" class="form-control" value="<?=$data['twitter']?>" name="twitter" id="twitter" placeholder="https://twitter.com/mberayildiz">
    </div>    
    <div class="form-group col-md-6">
      <label for="instagram">Instagram</label>
      <input type="text" class="form-control" value="<?=$data['instagram']?>" name="instagram" id="instagram" placeholder="https://instagram.com/mberayildiz">
    </div>    
    <div class="form-group col-md-6">
      <label for="linkedin">Linkedin</label>
      <input type="text" class="form-control" value="<?=$data['linkedin']?>" name="linkedin" id="linkedin" placeholder="https://linkedin.com/in/mberayildiz">
    </div>
    <div class="form-group col-md-6">
      <label for="github">Github</label>
      <input type="text" class="form-control"  value="<?=$data['github']?>" name="github" id="github" placeholder="https://github.com/mberayildiz">
    </div>
  </div>
  <div class="form-group">
    <label for="address">Adres</label>
    <input type="text" name="address" value="<?=$data['location']?>" class="form-control" id="address" placeholder="Konya/TURKEY">
  </div>
  <div class="form-row">
  <div class="form-group col-md-9">
    <label for="profession">Unvan</label>
    <input type="text" class="form-control" name="profession" value="<?=$data['professions']?>" id="profession" placeholder="Game Developer/Graphic Designer">
  </div>
  <div class="form-group col-md-3">
    <label for="mobile">Telefon</label>
    <input type="text" class="form-control" value="<?=$data['mobile']?>" name="mobile" id="mobile" placeholder="+90 531 456 16 97">
  </div>
             </div>
  <input type="submit" name="save" class="btn btn-primary" value="Kaydet">
</form>