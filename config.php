<?php 

$conn = mysqli_connect("localhost","root","");
if($conn){

    if(!mysqli_select_db($conn,"tutorial")){
        $createdb = " CREATE DATABASE TUTORIAL";
        if(mysqli_query($conn,$createdb)){
            mysqli_select_db($conn,"tutorial");
        }
    }
}
else{
    mysqli_connect_error();
}

?>

   