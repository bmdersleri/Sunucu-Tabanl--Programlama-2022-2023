<?php
    session_start();

    if(@$_SESSION["user_id"])
    {
        header("Refresh: 1; url=index.php");
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Login</title>
    <?php include "head.php"; ?>
</head>
<body>

    
    <section class="login-section">

        <div class="message-row">
            <?php
                // $random_hex = bin2hex(random_bytes(18));
             ?>
             

        </div>

        <div class="login-row">
            <div class="login-item">
                <div class="item-title">Username</div>
                <input type="text" name="user-name" class="input-rounded">
            </div>

            <div class="login-item">
                <div class="item-title">Password</div>
                <input type="password" name="user-password" class="input-rounded">
            </div>

            <button class="btn-with-radius" onclick="login()">Login</button>
        </div>

    </section>

    <script>

        function login(){

            post_data = {
            'user_name' : $("input[name=user-name] ").val(),
            'user_password' : $("input[name=user-password] ").val(),
            };

            $.ajax({
            type: "POST",
            url: 'ajax/ajax_login.php',
            data:  post_data,
            dataType:"json",
            success: function(result) {
                if(result.error){
                    $(".message-row ").css({"background-color":"var(--red)","display":"block"}).text(result.error);
                }
                else{
                    $(".message-row ").css({"background-color":"var(--green)","display":"block"}).text(result.success);
                    setTimeout(() => {window.location.replace("index.php");}, 1000);
                }
            },
            error:function(err){
                console.log(err.responseText);
            }
            });

        }


    </script>
    
</body>
</html>