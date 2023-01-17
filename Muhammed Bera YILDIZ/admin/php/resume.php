<h2>Özgeçmiş</h2>
         <?php
         if(isset($_GET['msg'])){
             
  if($_GET['msg']=='updated'){
      ?>
      <div class="alert alert-success text-center" role="alert">
      Başarıyla Eklendi !
</div>
      <?php
  }  
 } 
?> 
         <form action="php/uresume.php" method="post">
                 <div class="form-row">
                   <div class="form-group col-md-4">
                   <label>Kategori seç</label>
                    <select name="category" class="custom-select">
  <option value="e" selected>Eğitim</option>
  <option value="pe">Mesleki Deneyim</option>
</select></div>
                     <div class="form-group col-md-8">
    <label for="sn">Bölüm/Pozisyon Adı</label>
    <input type="text" name="title" class="form-control" id="website" placeholder="Bilgisayar Mühendisliği" required>
  </div>
   <div class="form-group col-md-8">
    <label for="website">Okul veya Şirket Adı</label>
    <input type="text" name="ogname" class="form-control" id="website" placeholder="Mehmet Akif Ersoy Üniversitesi" required>
  </div>
   <div class="form-group col-md-4">
    <label for="website">Süre</label>
    <input type="text" name="year" class="form-control" id="website" placeholder="2018-2022" required>
  </div>
   <div class="form-group col-md-2 ml-auto">
<!--     <label class="text-white">submi</label>-->
      <input type="submit" name="addtoresume" class="btn btn-primary form-control" value="Ekle"> 
   </div>
                
                 </div>
             </form>
         
         <table id="rlist" class="table table-striped table-sm .table-responsive ">
          <thead>
            <tr>
              <th>Id</th>
              <th>Kategori</th>
              <th>Bölüm/Pozisyon Adı</th>
              <th>Süre</th>
              <th>Okul veya Şirket Adı</th>
              <th>Eylem</th>
            </tr>
          </thead>
          <tbody>
         <?php
$query2="SELECT * FROM resume";
$queryrun2=mysqli_query($db,$query2);
$count=1;         
while($data2=mysqli_fetch_array($queryrun2)){
    $cat = $data2['category']=='e'?$cat="Education":$cat="Experience";
    ?>
     <tr>
         <div class="modal fade" id="modal<?=$data2['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Düzenle</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="skilleditbox">
       <form action="php/uresume.php" method="post">
                <input type="hidden" name="id" value="<?=$data2['id']?>">
                 <div class="form-row">
                   <div class="form-group col-md-4">
                   <label>Kategori seç</label>
                    <select name="category" class="custom-select">
                    <?php 
                        if($data2['category']=='e'){ ?>
                           <option value="e" selected>Eğitim</option>
  <option value="pe">Mesleki Deneyim</option> 
                      <?php  }else{ ?>
                            <option value="e">Eğitim</option>
  <option value="pe" selected>Mesleki Deneyim</option>
                    <?php    }
                        ?>
 
   
</select></div>
                     <div class="form-group col-md-8">
    <label for="sn">Bölüm/Pozisyon Adı</label>
    <input type="text" name="title" value="<?=$data2['title']?>" class="form-control" id="website" placeholder="Bilgisayar Mühendisliği" required>
  </div>
   <div class="form-group col-md-8">
    <label for="website">Okul veya Şirket Adı</label>
    <input type="text" name="ogname" value="<?=$data2['ogname']?>" class="form-control" id="website" placeholder="	Mehmet Akif Ersoy Üniversitesi" required>
  </div>
   <div class="form-group col-md-4">
    <label for="website">Süre</label>
    <input type="text" name="year" value="<?=$data2['year']?>" class="form-control" id="website" placeholder="2018-2022" required>
  </div>
   
                
                 </div>
             
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
        <input type="submit" class="btn btn-primary" name="rupdate" value="Kaydet">
    
      </div>
          </form>
    </div>
  </div>
</div>   
          <td>#<?=$count?></td>
              <td><?=$cat?></td>
         <td><?=$data2['title']?></td>
         <td><?=$data2['year']?></td>
         <td><?=$data2['ogname']?></td>
         
         <td>
         <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal<?=$data2['id']?>">
  Düzenle
</button> <a href="php/uresume.php?del=<?=$data2['id']?>"><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
  Sil
             </button></a></td>
            </tr>            
         <?php $count++;
} ?>
             </tbody></table>