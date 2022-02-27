<?php

session_start();
if(isset($_SESSION['id'])){
    header('location:user_welcome.php');
}
if(isset($_SESSION['aid'])){
    header('location:dashboard.php');
}

if(isset($_REQUEST['submit'])){
    header('location:ragister.php');
}
if(isset($_REQUEST['login'])){
    header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="bootstrap.min.css" rel="stylesheet">
    <style>
        form{
            padding:30px;
            text-align: center;
        }
        .size{
            display:flex;
            justify-content: center;
            margin-top:110px;
            padding:30px;
        }
        .a{
            padding:30px;
        }
        h1{
            color:white;
        }
        body{
            background-image: url("image/ocean.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
    
    <nav class="navbar p-2">
        <h1>ANGEL</h1>
        <!-- <button class="btn btn-warning">home</button> -->
    </nav>
    
    <div class="size">
    <div class="a">
        <img src="image/users.png" height="270px" width="330px" class="rounded-circle"><br>
        <form action="" method="POST">
        <button value="submit" class="btn btn-outline-warning btn-lg" name="submit">USERS</button>
        </form>
    </div>
    <div class="a">
        <img src="image/admin.png" height="270px" width="300px" class="rounded-circle"><br>
        <form action="" method="POST">
        <button value="submit" class="btn btn-outline-warning btn-lg" name="login">ADMIN</button>
        </form>
    </div>
    </div>
    

</body>
</html>