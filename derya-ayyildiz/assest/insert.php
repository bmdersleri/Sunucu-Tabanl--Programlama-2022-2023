<?php require "db.php"; ?> 
<?php 
// php dosya eklemek için require kullanıldı


$type = $_GET['type'];

if ($conn) {

    if (isset($_POST["submit"])) {

        switch ($type) {
            case "article":
                // İmage Güncelleme
                uploadImage2("arImage", "../img/article/"); //yüklenmesi gerek dosya dizinni belirtiyoruz.

                $data = array(
                    "article_title" => test_input($_POST["arTitle"]),
                    "article_content" => $_POST["arContent"],
                    "article_image" => test_input($_FILES["arImage"]["name"]),
                    "article_created_time" => date('Y-m-d H:i:s'),
                    "id_categorie" => test_input($_POST["arCategory"]),
                    "id_author" => test_input($_POST["arAuthor"])
                );


                insertToDB($conn, $type, $data);

                header("Location: ../index.php", true, 301);
                exit;
                break;

            case "category":

                // image güncelle
                uploadImage2("catImage", "../img/category/");

                // Verileri DB'ye yerleştirmek için hazırlama
                 $data = array(
                    "category_name"  => test_input($_POST["catName"]),
                    "category_image" => test_input($_FILES["catImage"]["name"]),
                    "category_color" => test_input($_POST["catColor"]),
                );


                insertToDB($conn, $type, $data);

                header("Location: ../categories.php", true, 301);
                exit;
                break;

            case "author":

                // İmage Güncelleme
                uploadImage2("authImage", "../img/avatar/");

                $data = array(
                    "author_fullname" => test_input($_POST["authName"]),
                    "author_desc" => test_input($_POST["authDesc"]),
                    "author_email" =>  test_input($_POST["authEmail"]),
                    "author_twitter" =>  test_input($_POST["authTwitter"]),
                    "author_github" => test_input($_POST["authGithub"]),
                    "author_link" => test_input($_POST["authLinkedin"]),
                    "author_avatar" => test_input($_FILES["authImage"]["name"])
                );

                $tableName = 'author';

                insertToDB($conn, $tableName, $data);

                header("Location: ../author.php", true, 301);
                exit;
                break;

            case "comment":

                $id = test_input($_POST["id_article"]);

               
                $data = array(
                    "comment_username" => test_input($_POST["username"]),
                    "comment_content" => test_input($_POST["comment"]),
                    "comment_date" => date('Y-m-d H:i:s'),
                    "id_article" =>  test_input($_POST["id_article"])
                );

                $tableName = 'comment';

                insertToDB($conn, $tableName, $data);

                header("Location: ../single_article.php?id=$id", true, 301);
                exit;
                break;

            default:
                echo "ERROR";
                break;
        }
    }
} else {
    echo 'Error: ' . $e->getMessage();
}

function insertToDB($conn, $table, $data)
{

    $columns = implodeArray(array_keys($data));

    $prefixed_array = preg_filter('/^/', ':', array_keys($data));
    $values = implodeArray($prefixed_array);

    try {
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        $stmt = $conn->prepare($sql);

        // satır ekleme
        $stmt->execute($data);

        echo "Yeni kayıtlar başarıyla oluşturuldu";
    } catch (PDOException $error) {
        echo $error;
    }
}

function implodeArray($array)
{
    return implode(", ", $array);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



function uploadImage2($name, $dest)
{

    $target_dir = $dest;
    $target_file = $target_dir . basename($_FILES[$name]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Görüntü dosyasını kontrol ediyoruz
    $check = getimagesize($_FILES[$name]["tmp_name"]);
    if ($check !== false) {
        echo "Dosya bir resim : " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Lütfen, Resim Dosyası seçin.";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        echo "Dosya zaten mevcut";
        $uploadOk = 0;
    }
    // dosya boyutunu kontrol etme
    if ($_FILES[$name]["size"] > 500000) {
        echo "Dosya Boyutu çok büyük.";
        $uploadOk = 0;
    }
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "yalnızca JPG, JPEG, PNG ve GIF dosyalarına izin verilmektedir";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Dosya Yüklenmedi";
    } else {
        if (move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
            echo " " . basename($_FILES[$name]["name"]) . " yüklendi.";
        } else {
            echo "Dosya yüklenirken bir hata oluştu.";
        }
    }
}

?>