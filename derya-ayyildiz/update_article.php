<!-- Include Head -->
<?php include "assest/head.php"; ?>
<?php

$article_id = $_GET["id"];

// Görüntülenecek blog verilerini alma
$stmt = $conn->prepare("SELECT * FROM article WHERE article_id = ?");
$stmt->execute([$article_id]);
$article = $stmt->fetch();

// Görüntülenecek kategori verilerini alma
$stmt = $conn->prepare("SELECT category_id, category_name FROM category");
$stmt->execute();
$categories = $stmt->fetchAll();

// Görüntülenecek yazar verilerini alma
$stmt = $conn->prepare("SELECT author_id, author_fullname FROM author");
$stmt->execute();
$authors = $stmt->fetchAll();

?>

<!-- JS TextEditor -->
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<title>Blog Güncelle</title>
</head>

<body>

    <!-- Header -->
    <?php include "assest/header.php" ?>


    <!-- Main -->
    <main role="main" class="main">

        <div class="jumbotron text-center">
            <h1 class="display-3 font-weight-normal text-muted">Yazar Güncelle</h1>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-lg-8 mb-4">
                    <!-- Form -->
                    <form action="assest/update.php?type=article&id=<?= $article_id ?>&img=<?= $article["article_image"] ?>" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="arTitle">Başlık</label>
                            <input type="text" class="form-control" name="arTitle" id="arTitle" value="<?= $article["article_title"] ?>">
                        </div>

                        <div class="form-group">
                            <label for="arContent">İçerik</label>
                            <textarea class="form-control" name="arContent" id="arContent" rows="3">
                            <?= $article["article_content"] ?>
                        </textarea>
                        </div>

                        <div class="form-group">
                            <label for="UploadImage">Resim</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="arImage" id="arImage">
                                <label class="custom-file-label" for="UploadImage"> <?= $article['article_image'] ?></label>
                            </div>

                        </div>

                        <div class="my-2" style="width: 200px;">
                            <img class="w-100 h-auto" src="img/article/<?= $article["article_image"] ?>" alt="">
                        </div>

                        <div class="form-group">
                            <label for="arCategory">Kategori</label>
                            <select class="custom-select" name="arCategory" id="arCategory">
                                <option disabled>-- Kategori Seç --</option>

                                <?php foreach ($categories as $category) : ?>

                                    <?php if ($article['id_categorie'] == $category['category_id']) : ?>

                                        <option value="<?= $category['category_id'] ?>" selected><?= $category['category_name'] ?></option>

                                    <?php else : ?>

                                        <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>

                                    <?php endif; ?>

                                <?php endforeach; ?>

                            </select>
                        </div>


                        <div class="form-group">
                            <label for="arauthor">Yazar</label>
                            <select class="custom-select" name="arAuthor" id="arAuthor">
                                <option disabled>-- Yazar Seç --</option>

                                <?php foreach ($authors as $author) : ?>

                                    <?php if ($article['id_author'] == $author['author_id']) : ?>

                                        <option value="<?= $author['author_id'] ?>" selected><?= $author['author_fullname'] ?></option>

                                    <?php else : ?>

                                        <option value="<?= $author['author_id'] ?>"><?= $author['author_fullname'] ?></option>

                                    <?php endif; ?>


                                <?php endforeach; ?>


                            </select>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="update" class="btn btn-success btn-lg w-25">Güncelle</button>
                        </div>


                    </form>
                </div>

                <div class="col-lg-4 mb-4">
                    <!-- <h1> Random Articles </h1>  -->
                </div>


            </div>
        </div>


    </main>

    <!-- Footer -->
    <!-- <?php include "assest/footer.php" ?> -->

    <!-- Text Editor Script -->
    <script>
        CKEDITOR.replace('arContent');
    </script>

</body>

</html>