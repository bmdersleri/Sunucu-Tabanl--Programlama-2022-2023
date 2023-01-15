<!-- Include Head -->
<?php include "assest/head.php"; ?>

<title>Kategori Ekle</title>
</head>

<body>

    <!-- Header -->
    <?php include "assest/header.php" ?>

    <!-- Main -->
    <main role="main" class="main">

        <div class="jumbotron text-center">
            <h1 class="display-3 font-weight-normal text-muted">Kategoriyi Kaydet</h1>
        </div>

        <div class="container">

            <div class="row">

                <div class="col-lg-12 mb-4">
                    <!-- Form -->
                    <form action="assest/insert.php?type=category" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="catName">Kategori Adı</label>
                            <input type="text" class="form-control" name="catName" id="catName">
                        </div>

                        <div class="form-group">
                            <label for="catImage">Kategori Resmi</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="catImage" id="catImage">
                                <label class="custom-file-label" for="catImage">Dosya Seç</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="catColor">Kategori Rengi</label>
                            <input type="color" id="catColor" name="catColor" value="#0f88e1">
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