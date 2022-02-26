 <?php

        include 'config.php';
        session_start(); 

        
        if (isset($_SESSION['id'])) {
            header('location:user_welcome.php');
        }
        if (isset($_COOKIE['id'])) {
            header('location:user_welcome.php');
        }

        if (isset($_POST['submit'])) {

           
            $email = $_POST['email'];
            $password = base64_encode($_POST['password']);

            $sql = "SELECT * FROM employee WHERE email='$email' AND p_word='$password'";
            $query = mysqli_query($conn, $sql);
            $arr = mysqli_fetch_assoc($query);
            $row = mysqli_num_rows($query);
            //echo $row;
         
            if ($row > 0) {
                    
                //echo $_POST['p_word'];
                    $_SESSION['id'] = $arr['id'];
                    setcookie('id', $arr['id'], time() + 60*10);
                    header('location:user_welcome.php');
                }
                else {
                    echo "invalid email password";

                }
            
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
        /* body{
            background-image: url("image/a.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        } */
        .container {
            margin-top: 30px;
            padding: 40px;
            border: 2px solid black;
            opacity: 0.8;
        }
        h2 {
            text-align: center;
        }
        .error{
            color: red;
        }
    </style>

</head>

<body>
    <div class="p-4"></div>
    <div class="p-5"></div>
    <div class="container bg-dark text-light">
        <form action="" method="POST">
            <h2>USER LOGIN</h2>
            <div class="form-group">
                <label for="">USER NAME</label>
                <input type="email" class="form-control" name="email">       
            </div>

            <div class="form-group">
                <label for="">PASSWORD</label>
                <input type="password" class="form-control" name="password">
            </div>
            <p class="login-register-text">Not have an account?<a href="ragister.php">Ragister here</a></p>

            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-info">
                <input type="reset" name="reset" class="btn btn-danger">
            </div>
        </form>
    </div>

</body>
</html>