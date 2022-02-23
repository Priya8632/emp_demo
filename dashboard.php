<?php 

include 'config.php';
session_start();

if (!isset($_SESSION['aid'])) {
    header('location:admin_login.php');
}
if (!isset($_SESSION['aid'])) {
    $_SESSION['aid'] = $_COOKIE['aid'];
}

$aid = $_SESSION['aid'];
$query = "SELECT * FROM admin WHERE id='$aid'";
$rslt = mysqli_query($conn,$query);
$adarr = mysqli_fetch_array($rslt);

$selectTable = "SELECT * FROM employee";
$result = mysqli_query($conn, $selectTable);

if (!$result) {
    echo mysqli_error($conn);
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
        body{
            margin:10px;
        }
        table{
            margin-top:50px;
        }
        h2{
            color:white;
            float:right;
        }
        
    </style>
</head>
<body>
<nav class="bg-dark p-3">
    <h2><?php echo $adarr['username'];?></h2>
    <div class="container-fluid">
        <a href="admin_logout.php" class="btn btn-danger">LOGOUT</a>
        <a href="add_user.php" class="btn btn-primary">ADD USER</a> 
    </div>
</nav>

    <div class="table-responsive"> 
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>FNAME</th>
                    <th>LNAME</th>
                    <th>EMAIL</th>
                    <th>PASSWORD</th>
                    <th>GENDER</th>
                    <th>AGE</th>
                    <th>DAPARTMENT</th>
                    <th>DATE OF JOIN</th>
                    <th>SALARY</th>
                    <th>HOBBIES</th>
                    <th>IMAGE</th>
                    <th>OPERATION</th>
                </tr>
            </thead>
            <tbody>
            <?php  while ( $data = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $data['id']; ?></td>
                    <td><?php echo $data['fname']; ?></td>
                    <td><?php echo $data['lname'];?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo base64_decode($data['p_word']); ?></td>
                    <td><?php echo $data['gender']; ?></td>
                    <td><?php echo $data['age']; ?></td>
                    <td><?php echo $data['dept']; ?></td>
                    <td><?php echo $data['doj']; ?></td>
                    <td><?php echo $data['sal']; ?></td>
                    <td><?php echo $data['hobby'];?></td>
                    <td><img src="<?php echo $data['img'];?>" width="60px"></td>
                    <td><a href="update.php?update=<?php echo $data['id'];?>"class="btn btn-primary">UPDATE
                    <a href="delete.php?delete=<?php echo $data['id'];?>" class="btn btn-danger">DELETE</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>  
</body>
</html>