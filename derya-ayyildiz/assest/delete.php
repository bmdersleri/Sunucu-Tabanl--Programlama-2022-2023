<?php require "db.php"; ?>
<?php

// id & type alma 
$id = $_GET['id'];
$type = $_GET['type'];

if ($conn) {
    switch ($type) {
        case "article":
            delete($conn, $type, $id, "article.php");
            break;
        case "category":
            delete($conn, $type, $id, "categories.php");
            break;
        case "author":
            delete($conn, $type, $id, "author.php");
            break;
        default:
            break;
    }
} else {
    echo 'Error: ' . $e->getMessage();
}


function delete($conn, $table, $id, $goto)
{

    $col = $table . "_id";

    try {
        // sql kaydı silmek için
        $sql = "DELETE FROM $table WHERE $col = $id";

        $conn->exec($sql);
        echo "$table Başarıyla silindi
        ";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }

    $conn = null;

    header("Location: ../$goto", true, 301);
    exit;
}
?>