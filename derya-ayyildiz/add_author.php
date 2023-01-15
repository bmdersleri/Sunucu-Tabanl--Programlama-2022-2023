<!-- Include Head -->
<?php include "assest/head.php"; ?>

<title>Yazar Ekle</title>
</head>

<body>

    <!-- Header -->
    <?php include "assest/header.php" ?>

    <!-- Main -->
    <main role="main" class="main">

        <div class="jumbotron text-center">
            <h1 class="display-3 font-weight-normal text-muted">Yazar Ekle</h1>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-lg-12 mb-4">
                    <!-- Form -->
                    <form action="assest/insert.php?type=author" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="authName">Ad Soyad</label>
                            <input type="text" class="form-control" name="authName" id="authName">
                        </div>

                        <div class="form-group">
                            <label for="authDesc">Açıklama</label>
                            <input type="text" class="form-control" name="authDesc" id="authDesc">
                        </div>

                        <div class="form-group">
                            <label for="authEmail">Email</label>
                            <input type="email" class="form-control" name="authEmail" id="authEmail">
                        </div>

                        <div class="form-group">
                            <label for="authImage">Avatar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="authImage" id="authImage">
                                <label class="custom-file-label" for="authImage">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="authTwitter">Twitter Kullanıcı Adı <span class="text-info">(isteğe bağlı)</span></label>
                            <input type="text" class="form-control" name="authTwitter" id="authTwitter" placeholder="Örn: deryaayyildiiz">
                        </div>
                        <div class="form-group">
                            <label for="authGithub">Github Kullanıcı Adı <span class="text-info">(isteğe bağlı)</span></label>
                            <input type="text" class="form-control" name="authGithub" id="authGithub" placeholder="Örn: deryaayyildiz">
                        </div>
                        <div class="form-group">
                            <label for="authLinkedin">Linkedin Kullanıcı Adı <span class="text-info">(isteğe bağlı)</span></label>
                            <input type="text" class="form-control" name="authLinkedin" id="authLinkedin" placeholder="Örn: DeryaAyyıldız">
                        </div>


                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success btn-lg w-25">Kaydet</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </main>

    <!-- Footer -->
    <!-- <?php include "assest/footer.php" ?> -->


</body>

</html>