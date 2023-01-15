<!-- Include Head -->
<?php include "assest/head.php"; ?>
<?php

$category_id = $_GET["id"];

// Görüntülenecek kategori Verilerini alma
$stmt = $conn->prepare("SELECT * FROM category WHERE category_id = ?");
$stmt->execute([$category_id]);
$category = $stmt->fetch();

?>

<title>Kategori Güncelle</title>
</head>

<body>

    <!-- Header -->
    <?php include "assest/header.php" ?>


    <!-- Main -->
    <main role="main" class="main">

        <div class="jumbotron text-center ">
            <h1 class="display-3 font-weight-normal text-muted">Kategori Güncelle</h1>
        </div>

        <div class="container">

            <div class="row">

                <div class="col-lg-12 mb-4">
                    <!-- Form -->
                    <form action="assest/update.php?type=category&id=<?= $category_id ?>&img=<?= $category["category_image"] ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="catName">Kategori Adı</label>
                            <input type="text" class="form-control" name="catName" id="catName" value="<?= $category["category_name"] ?>">
                        </div>

                        <div class="form-group">
                            <label for="catImage">Kategori Resmi</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="catImage" id="catImage">
                                <label class="custom-file-label" for="catImage"><?= $category["category_image"] ?></label>
                            </div>
                        </div>

                        <div class="my-2" style="width: 200px;">
                            <img class="w-100 h-auto" src="img/category/<?= $category["category_image"] ?>" alt="">
                        </div>

                        <div class="form-group">
                            <label for="catColor">Kategori Rengi</label>
                            <input type="color" id="catColor" name="catColor" value="<?= $category["category_color"] ?>">
                        </div>


                        <div class="text-center">
                            <button type="submit" name="update" class="btn btn-success btn-lg w-25">Güncelle</button>
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