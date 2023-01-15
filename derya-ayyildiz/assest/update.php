<?php require "db.php"; ?>
<?php

// Başlıktan yazı alma
$type = $_GET['type'];
$urlId = $_GET["id"];
$urlImage = $_GET['img'];

if ($conn) {

    if (isset($_POST["update"])) {

        switch ($type) {
            case "article":

                // Database Update İşlemleri
                $title = test_input($_POST["arTitle"]);
                $content = $_POST["arContent"];
                $categorie = test_input($_POST["arCategory"]);
                $author = test_input($_POST["arAuthor"]);
                $imageName = test_input($_FILES["arImage"]["name"]);

                //  Database  image Update İşlemleri
                if ($_FILES["arImage"]['error'] === 0) {
                    uploadImage2("arImage", "../img/article/");
                } else {
                    $imageName = $urlImage;
                }

                try {
                    $sql = "UPDATE `article`
                        SET `article_title`= ?, `article_content`= ?,`article_image`=?, `id_categorie`=?, `id_author`= ?
                        WHERE `article_id` = ?";

                    $stmt = $conn->prepare($sql);

                    $stmt->execute([$title, $content, $imageName, $categorie, $author, $urlId]);

                    // Güncelleme Başarılı ise ;
                    echo "Blog başarıyla Güncellendi";
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                
                header("Location: ../article.php", true, 301);
                exit;
                break;

            case "category":

                
                $name = test_input($_POST["catName"]);
                $color = test_input($_POST["catColor"]);
                $imageName = test_input($_FILES["catImage"]["name"]);

                // İmage Güncelleme
                if ($_FILES["catImage"]['error'] === 0) {
                    uploadImage2("catImage", "../img/category/");
                } else {
                    $imageName = $urlImage;
                }

                try {

                    $sql = "UPDATE `category`
                        SET `category_name`= ?, `category_image`= ?,`category_color`=?
                        WHERE `category_id` = ?";

                    $stmt = $conn->prepare($sql);

                    $stmt->execute([$name, $imageName, $color, $urlId]);

                    // Güncelleme başarılı ise;
                    echo "Category UPDATED successfully";
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                
                header("Location: ../categories.php", true, 301);
                exit;

                break;
            case "author":
                // Database Güncelleme
                $fullName = test_input($_POST["authName"]);
                $description = test_input($_POST["authDesc"]);
                $email = test_input($_POST["authEmail"]);
                $twitter = test_input($_POST["authTwitter"]);
                $github = test_input($_POST["authGithub"]);
                $linkedin = test_input($_POST["authLinkedin"]);
                $imageName = test_input($_FILES["authImage"]["name"]);

                // Database Resim Güncelleme
                if ($_FILES["authImage"]['error'] === 0) {
                    uploadImage2("authImage", "../img/avatar/");
                } else {
                    $imageName = $urlImage;
                }

                try {
                    $sql = "UPDATE `author`
                        SET `author_fullname`= ?, `author_desc`= ?,`author_email`=?, `author_twitter`=?, `author_github`= ?, `author_link`= ?, `author_avatar`= ?
                        WHERE `author_id` = ?";

                    $stmt = $conn->prepare($sql);

                    $stmt->execute([$fullName, $description, $email, $twitter, $github, $linkedin, $imageName, $urlId]);

                    // Güncelleme başarılı ise;
                    echo "yazar başarıyla güncellendi";
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

                header("Location: ../author.php", true, 301);
                exit;
                break;

            default:
                break;
        }
    }
} else {
    echo 'Error: ' . $e->getMessage();
}


function uploadImage2($name, $dest)
{

    $target_dir = $dest;
    $target_file = $target_dir . basename($_FILES[$name]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Resim dosyasını kontrol etme
    $check = getimagesize($_FILES[$name]["tmp_name"]);
    if ($check !== false) {
        echo "Dosya bir resim : " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Dosya bir resim değil.";
        $uploadOk = 0;
    }

    // Dosya var mı?
    if (file_exists($target_file)) {
        echo "Dosya zaten var.";
        $uploadOk = 0;
    }
    // Dosya Boyutunu Kontrol etme
    if ($_FILES[$name]["size"] > 500000) {
        echo "Dosya çok büyük.";
        $uploadOk = 0;
    }
    // Belirli Dosya biçimlerine izin verilir
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Yalnızca JPG, JPEG, PNG ve GIF dosyalarına izin verilmektedir.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Dosyanız yüklenmedi.";
    } else {
        move_uploaded_file($file, '../img/category/' . $yeniisim); 
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
