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
            margin:20px;
            padding:30px;
        }
        .a{
            margin:20px;
        }
    </style>
</head>
<body>
    
    <nav class="navbar bg-dark p-2">
        <button class="btn btn-warning">home</button>
    </nav>

    <div class="size">
    <div class="a">
        <img src="image/b.jpg" height="450px" width="650px"><br>
        <form action="" method="POST">
        <button value="submit" class="btn btn-warning" name="submit">USERS</button>
        </form>
    </div>
    <div class="a">
        <img src="image/s1.jpg" height="450px" width="650px"><br>
        <form action="" method="POST">
        <button value="submit" class="btn btn-warning" name="login">ADMIN</button>
        </form>
    </div>
    </div>
    

</body>
</html>