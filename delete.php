<?php 

include 'config.php';
$id = $_GET['delete'];
$query = "DELETE FROM EMPLOYEE WHERE id=$id";

$result = mysqli_query($conn,$query);

if($result){
    header('location:dashboard.php');
}else{
     echo mysqli_connect_error($conn);
}

?>