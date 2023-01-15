<?php include "assest/head.php"; ?>
<?php

// Kullanıcının oturum açmış olup olmadığını kontrol edilir. Açmışsa karşılama sayfasına yönlendirilir
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

// değişkenleri tanımlayıp boş değer ataması
$username = $password = "";
$username_err = $password_err = "";

// Form gönderildiğinde form verileri işleniyor
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Kullanıcı adının boş olup olmadığını kontrol etme
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Parolanın boş olup olmadığını kontrol etmw.
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Kimlik bilgilerini doğrulama
    if (empty($username_err) && empty($password_err)) {
        
        $sql = "SELECT * FROM users WHERE username = :username";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            $param_username = trim($_POST["username"]);

            if ($stmt->execute()) {
                //Kullanıcı adının var olup olmadığını kontrol edilir. Varsa şifre doğrulanır.
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if (password_verify($password, $hashed_password)) {
                            //  Şifre doğru oturum başlatılır.
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Kullanı karşılama sayfasına yönlendirilir
                            header("location: index.php");
                        } else {
                            // Şifre geçerli değilse hata mesajı
                            $password_err = "Girilen şifre geçerli değil.";
                        }
                    }
                } else {
                    // Kullanıcı adı mevcut değilse hata mesajı gösterilir
                    $username_err = "Bu kullanıcı adıyla hesap bulunamadı.";
                }
            } else {
                echo "Lütfen daha sonra tekrar deneyiniz.";
            }

         
            unset($stmt);
        }
    }

   
    unset($pdo);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo/flogo.png" sizes="32x32" type="image/png">

    <!-- Bootstrap, FontAwesome, Custom Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link type="text/css" rel="stylesheet" href="css/style.css" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet">


    <title>Giriş</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Header -->
    <?php include "assest/header.php" ?>
    <!-- </Header> -->

    <!-- Main -->
    <main class="main">

        <!-- Latest Articles -->
        <div class="section jumbotron mb-0 h-100">
            <!-- container -->
            <div class="container d-flex flex-column justify-content-center align-items-center h-100">

                <div class="wrapper my-0 pt-3 bg-white w-50 text-center">
                    <img src="img/logo/logo.png" alt="dev culture logo" style="width: 100px;height: auto;">
                </div>

                <!-- row -->
                <div class="wrapper bg-white rounded px-4 py-4 w-50">

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="form-group">
                            <label>Kullanıcı Adı</label>
                            <input type="text" name="username" class="form-control <?= (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="">
                            <span class="invalid-feedback"><?= $username_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Şifre</label>
                            <input type="password" name="password" class="form-control <?= (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                            <span class="invalid-feedback"><?= $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Giriş">
                        </div>
                        <p><a href="#" class="text-muted">Şifreni mi unuttun?</a></p>
                    </form>
                </div>

                <!-- /row -->

            </div>
            <!-- /container -->
        </div>


    </main><!-- </Main> -->

    <!-- Footer -->
    <!-- <?php include "assest/footer.php" ?> -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>