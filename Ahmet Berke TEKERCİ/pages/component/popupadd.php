<div class="button-add-student">
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">add student</button>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Öğrenci Ekle</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="addstudent.php" enctype="multipart/form-data">
            <div class="">
              <label for="recipient-name" class="col-form-label">img:</label>
              <input type="file" class="form-control" id="recipient-name" accept=".jpg,.png,.jpeg" name="img">
            </div>
            <div class="">
              <label for="recipient-name" class="col-form-label">Ad:</label>
              <input type="text" class="form-control" id="recipient-name" name="Name">
            </div>
            <div class="">
              <label for="recipient-name" class="col-form-label">Email:</label>
              <input type="text" class="form-control" id="recipient-name" name="Email">
            </div>
            <div class="">
              <label for="recipient-name" class="col-form-label">Telefon:</label>
              <input type="text" class="form-control" id="recipient-name" name="Phone">
            </div>
            <div class="">
              <label for="recipient-name" class="col-form-label">Kayıt Numarası:</label>
              <input type="text" class="form-control" id="recipient-name" name="EnrollNumber">
            </div>
            <div class="">
              <label for="recipient-name" class="col-form-label">Kayıt Tarihi:</label>
              <input type="date" class="form-control" id="recipient-name" name="DateOfAdmission">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
              <button type="submit" name="submit" class="btn btn-primary">Öğrenci Ekle</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>