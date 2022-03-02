<?php

include 'config.php';
session_start();

if(!isset($_SESSION['id'])){
    header('location:user_login.php');
}
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = $_COOKIE['id'];
}


$id = $_SESSION['id'];
$sql =  "SELECT * FROM employee WHERE id ='$id'";
$result = mysqli_query($conn,$sql);
$myData = mysqli_fetch_assoc($result);

if (!$result) {
    echo mysqli_error($conn);
}
if (!$myData) {
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
        .container{
            margin-top:50px;
        }
        .error{
            color:red;
        }
        h2{
            float:right;
        }
    </style>
</head>
<body>

<nav class="bg-warning p-3">
    <div class="container-fluid">
    <h2>Welcome to: <?php  echo $myData['email']; ?></h2> 
    <a href="user_logout.php" class="btn btn-danger">log out</a>
    </div>
</nav>

    <div class="container">
        <h1>User Detalis</h1>
        <table class="table table-borderless table-dark">
            <tr>
                <th class="th-dark">Id</th>
                <td><?php echo $myData['id'];?> </td>
            </tr>
            <tr>
                <th>Fisrt_Name</th>
                <td><?php echo $myData['fname'];?> </td>
            </tr>
            <tr>
                <th>Last_Name</th>
                <td><?php echo $myData['lname']; ?> </td>
            </tr>
            <tr>
                <th>Age</th>
                <td><?php echo $myData['age']; ?> </td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php  echo $myData['gender']; ?> </td>
            </tr>
            <tr>
                <th>Department</th>
                <td><?php echo $myData['dept']; ?> </td>
            </tr>
            <tr>
                <th>Date Of Join</th>
                <td><?php echo $myData['doj']; ?> </td>
            </tr>
            <tr>
                <th>Salary</th>
                <td><?php echo $myData['sal']; ?> </td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $myData['email']; ?> </td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?php echo base64_decode($myData['p_word']); ?> </td>
            </tr>
            <tr>
                <th>Hobbies</th>
                <td><?php echo $myData['hobby']; ?> </td>
            </tr>
            <tr>
                <th>Photo</th>
                <!-- <td><?php echo $myData['img']; ?></td> -->
                <td><img src="<?php echo $myData['img']; ?>" alt="Network Error" hright='100px' width='100px'></td>
            </tr>
            <tr>
                <td colspan="2"><a href="user_update.php?update_id=<?php echo $myData['id'];?>"><button class="btn btn-warning">Update</button></a></td>
            </tr>

        </table>
    </div>
  
</body>
</html>