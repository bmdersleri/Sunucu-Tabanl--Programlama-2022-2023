<!-- Include Head -->
<?php include "assest/head.php"; ?>
<?php

// Kullanıcının oturum açmış olup olmadığını kontrol edilir. Açmışsa karşılama sayfasına yönlendirilir
if (!$loggedin) {
    header("location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM author");
$stmt->execute();
$authors = $stmt->fetchAll();
?>

<title>Tüm Yazarlar</title>
<link type="text/css" rel="stylesheet" href="css/style.css" />

<style>
    .fa-twitter,
    .fa-github,
    .fa-linkedin-square {
        font-size: 2.3rem;
    }
</style>
</head>

<body>

    <!-- Header -->
    <?php include "assest/header.php" ?>
    <!-- </Header> -->

    <!-- Main -->
    <main role="main" class="main">
        <div class="jumbotron text-center mb-0">
            <h1 class="display-3 font-weight-normal text-muted">Tüm Yazarlar</h1>
        </div>

        <div class="bg-white py-3 px-5">
            <div class="row">

                <div class="col-lg-12 text-center mb-3">
                    <a class="btn btn-info" href="add_author.php">Yazar Ekle</a>
                </div>

            </div>

            <div class="row">
                <table class='table table-striped table-bordered'>

                    <thead class='thead-dark'>
                        <tr>
                            <th scope='col'>ID</th>
                            <th scope='col'>Ad Soyad</th>
                            <th scope='col'>Açıklama</th>
                            <th scope='col'>Avatar</th>
                            <th scope='col'>Email</th>
                            <th scope='col'>Twitter</th>
                            <th scope='col'>Github</th>
                            <th scope='col'>Linkedin</th>
                            <th scope='col' colspan="2">Hareketler</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($authors as $author) :
                            echo "<tr>";
                            ?>

                            <td><?= $author['author_id'] ?></td>
                            <td><?= $author['author_fullname'] ?></td>
                            <td><?= $author['author_desc'] ?></td>
                            <td>
                                <img src="img/avatar/<?= $author['author_avatar'] ?>" style="width: 100px; height: auto;">
                            </td>
                            <td><?= $author['author_email'] ?></td>
                            <td class="text-center">
                                <a href="https://twitter.com/<?= $author['author_twitter'] ?>" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="https://github.com/<?= $author['author_github'] ?>" target="_blank">
                                    <i class="fa fa-github"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="https://www.linkedin.com/in/<?= $author['author_link'] ?>" target="_blank">
                                    <i class="fa fa-linkedin-square"></i>
                                </a>
                            </td>

                            <td>
                                <a class="btn btn-success" href="update_author.php?id=<?= $author['author_id'] ?>">
                                    <i class="fa fa-pencil " aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="assest/delete.php?type=author&id=<?= $author['author_id'] ?>">
                                    <i class="fa fa-trash " aria-hidden="true"></i>
                                </a>
                            </td>

                        <?php
                            echo "</tr>";
                        endforeach;
                        ?>
                    </tbody>

                </table>
            </div>

        </div>

    </main><!-- </Main> -->

    <!-- Footer -->
    <!-- <?php include "assest/footer.php" ?> -->

</body>

</html>