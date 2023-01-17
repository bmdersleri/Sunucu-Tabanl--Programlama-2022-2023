 <h2>Portfolio</h2>
         <?php
         if(isset($_GET['msg'])){
             
  if($_GET['msg']=='updated'){
      ?>
      <div class="alert alert-success text-center" role="alert">
      Proje Başarıyla Eklendi!
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
         <form method="post" action="php/uportfolio.php" enctype="multipart/form-data">
  <div class="form-row">
  <div class="form-group col-md-6">
  <label>Proje Ekran Görüntüsü/Görüntüsü (Minimum 600px X 600px, Maxsize 2mb)</label>
  <div class="custom-file">
    <input type="file" name="projectpic" class="custom-file-input" id="profilepic">
    <label class="custom-file-label" for="projectpic">Resim Seçiniz...</label>
  </div></div>
  
   <div class="form-group col-md-6 mt-auto">
      <label for="name">Proje Adı</label>
      <input type="name" name="projectname" class="form-control" id="name" placeholder="Basket Oyunu">
    </div>
    
   
    
    <div class="form-group col-md-12">
      <label for="email">Proje Linki</label>
      <input type="text" name="projectlink" class="form-control" id="email" placeholder="https://github.com/mberayildiz/proje">
    </div>
    <div class="form-group col-md-2 ml-auto">
        <input type="submit" name="addtoportfolio" class="btn btn-primary" value="Ekle">
    </div>
  
</form>
<table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>Id</th>
              <th>Proje Resmi</th>
              <th>Proje Adı</th>
              <th>Eylem</th>
            </tr>
          </thead>
          <tbody>
         <?php
$query2="SELECT * FROM portfolio";
$queryrun2=mysqli_query($db,$query2);
$count=1;         
while($data2=mysqli_fetch_array($queryrun2)){
    ?>
     <tr>
         <div class="modal fade" id="modal<?=$data2['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Portfolyo Düzenle</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" action="php/uportfolio.php" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?=$data2['id']?>">
  <div class="form-row">
  <div class="form-group col-md-12">
      <img src="../assets/img/<?=$data2['projectpic']?>" class="oo img-thumbnail">
  </div>
  <div class="form-group col-md-6">
  <label>Proje Ekran Görüntüsü/Görüntüsü (Minimum 600px X 600px, Maxsize 2mb)</label>
  <div class="custom-file">
    <input type="file" name="projectpic" class="custom-file-input" id="profilepic">
    <label class="custom-file-label" for="projectpic">Resim Seç...</label>
  </div></div>
  
   <div class="form-group col-md-6 mt-auto">
      <label for="name">Proje Adı</label>
      <input type="name" name="projectname" value="<?=$data2['projectname']?>" class="form-control" id="name" placeholder="ToDo List Maker">
    </div>
    
   
    
    <div class="form-group col-md-12">
      <label for="email">Proje Linki</label>
      <input type="text" name="projectlink" value="<?=$data2['projectlink']?>" class="form-control" id="email" placeholder="https://whomonugiri.github.io/todo-list-maker/">
    </div>

      </div>
      
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <input type="submit" class="btn btn-primary" name="pupdate" value="Kaydet">
          </form>
      </div>
    </div>
  </div>
</div>   
          <td>#<?=$count?></td>
              <td><img src="../assets/img/<?=$data2['projectpic']?>" class="oo img-thumbnail"></td>
         <td><?=$data2['projectname']?></td>
         <td>
             <a href="<?=$data2['projectlink']?>"> <button type="button" class="btn btn-success btn-sm">Git</button></a>
         
         <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal<?=$data2['id']?>">
  Düzenle
</button> <a href="php/uportfolio.php?del=<?=$data2['id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
  Sil
             </button></a></td>
            </tr>            
         <?php $count++;
} ?>
             </tbody></table>  