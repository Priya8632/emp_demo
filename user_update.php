<?php

include 'config.php';
session_start();

if (!isset($_SESSION['id'])) {
    header('location:user_login.php');
}

if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = $_COOKIE['id'];
}
$id = $_SESSION['id'];

$query = "SELECT * FROM EMPLOYEE WHERE id = $id";
$result = mysqli_query($conn,$query);
$rows = mysqli_fetch_assoc($result);

$fnamearr = $lnamearr = $emailarr = $pwarr = $cwarr = $genderarr = $agearr = $dojarr = $deptarr = $salarr = $imgarr ="";
$fname = $lname =$email = $pw = $cw = $gender = $age = $dept = $doj = $sal =$chkbox = $alldata= "";

 if(isset($_POST['submit'])){

    $filesize = $_FILES['file']['size'];   
    
    if(empty($_POST['fname'])){
        $fnamearr = "fname is required";}
    elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['fname'])){
        $fnamearr = "only character and letter ";    }
    elseif(empty($_POST['lname'])){
        $lnamearr = "lname is required";}
    elseif(!preg_match("/^[a-zA-Z-' ]*$/",$_POST['lname'])){
        $lnamearr = "only character and letter ";     }
    elseif(empty($_POST['email'])){
        $emailarr = "email is required";}
    elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $emailarr = "invaild formet";}
    elseif(empty($_POST['p_word'])){
        $pwarr = "password is required"; }
    elseif(!preg_match("/[a-z'@,!,#,$,%,^,&,*,+']+/",$_POST['p_word'])){
        $pwarr = "minimum 1 small";    }
    elseif(!preg_match("/[A-Z]+/",$_POST['p_word'])){
        $pwarr = "minum 1 capital"; }
    elseif(!preg_match("/[0-9]/",$_POST['p_word'])){
        $pwarr = "1 number";}
    elseif(strlen($_POST['p_word']) > 8 || strlen($_POST['p_word']) < 8 ){
        $pwarr = "8 length is required";}
    elseif(empty($_POST['gender'])){
        $genderarr = "gender is required";}
    elseif(empty($_POST['age'])){
        $agearr = "age is required";}
    elseif($_POST['age']<18){
        $agearr =" not eligibale for job ";}
    elseif(empty($_POST['doj'])){
        $dojarr = "doj is required";}
    elseif($_POST['doj']>date('Y-m-d')){
        $dojarr = "not valid future date";} 
    elseif(empty($_POST['sal'])){
        $salarr = "sal is required";}
    elseif($_POST['sal']<0){
        $salarr = "minus sal is not allow";}
    elseif(preg_match("/[a-zA_Z]/",$_POST['sal'])){
        $salarr ="alpha value is not allow";} 
    elseif(empty($_POST['hobby'])){
        $hobbiarr = "optional";}
    elseif($filesize > 1000000){
        $imgarr = "image file must be less than 1 mb"; } 
    elseif(empty($filesize)){
        $imgarr = "image file muat be required";}     

    else{

    $id = $rows['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pw = base64_encode($_POST['p_word']);
    $cw = $_POST['c_word'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $dept = $_POST['dept'];
    $doj = $_POST['doj'];
    $sal = $_POST['sal'];
    $chkbox = $_POST['hobby'];
    $alldata= implode(",",$chkbox);

      $target_dir = "image/";
      
      if(!file_exists($_FILES['file']['tmp_name'])){
        $imagepath = $rows['img'];
      }else{
        $imagePath = $target_dir . basename($_FILES['file']['name']);
      }
      $chkfile = move_uploaded_file($_FILES['file']['tmp_name'], $imagepath);
   

    $update = "UPDATE EMPLOYEE SET fname='$fname',lname='$lname',p_word ='$pw',email ='$email',gender='$gender',age='$age',dept='$dept',
                                                                doj='$doj',sal='$sal',hobby='$alldata',img='$imagePath' where id='$id'";
    $chk = mysqli_query($conn,$update);
    if($chk){
        header('location:user_welcome.php');
    }
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
        form{
            padding:30px;
            background-color:lightgray;  
        }
        .error{
            color:red;
        }
    </style>
</head>
<body>

    
    <div class="container" >
        
        <form action="" method="POST" enctype="multipart/form-data">
        <h2>Ragister Form</h2>

            <div class="form-group">
                <label>FNAME</label>
                <input type="text" name="fname" class="form-control" value=<?php  echo $rows['fname']?>><span class="error">* <?php echo $fnamearr; ?>
            </span>
            </div>

            <div class="form-group">
                <label>LNAME</label>
                <input type="text" name="lname" class="form-control" value=<?php echo $rows['lname']?>><span class="error">*<?php echo $lnamearr; ?></span>
            </div>
            <div class="form-group">
                <label for="">EMAIL</label>
                <input type="text" name="email" class="form-control" value=<?php echo $rows['email'];?>><span class="error">* <?php echo $emailarr;?></span>
            </div>

            <div class="form-group">
                <label for="">PASSWORD</label>
                <input type="password" name="p_word" class="form-control" value=<?php echo base64_decode($rows['p_word']);?>><span class="error">* <?php echo $pwarr; ?></span>
            </div>
            
            <div class="form-group">
                <label for="">CONFIRM PASSWORD</label>
                <input type="password" name="c_word" class="form-control" value=<?php echo $rows['c_word'];?>><span class="error">* <?php echo $cwarr;?></span>
            </div>

            <div class="form-group">
                <label>GENDER</label>
                <input type="radio" name="gender" value="male" <?php if($rows['gender'] == 'male') {?> checked <?php } ?> >MALE
                <input type="radio" name="gender" value="female" <?php if($rows['gender'] == 'female') {?> checked <?php } ?>>FEMALE
                <span class="error">*<?php echo $genderarr; ?></span>
            </div>

            <div class="form-group">
                <label>AGE</label>
                <input type="text" name="age" class="form-control" value=<?php echo $rows['age']?>><span class="error">*<?php echo $agearr; ?></span>
            </div>

            <div class="form-group">
                <label>DEPARTMENT</label>
                <select name="dept" class="form-control">
                <option value="<?php echo $rows['dept'];?>" selected><?php echo $rows['dept'];?></option>
                <option value="purchase">Purchase</option>
                <option value="sal">Sal</option>
                <option value="marketing">Marketing</option>
                </select>  
                <span class="error">*<?php echo $deptarr; ?></span>      
            </div>

            <div class="form-group">
                <label>DATE OF JOIN</label>
                <input type="date" name="doj" value=<?php echo $rows['doj']?>><span class="error">*<?php echo $dojarr; ?></span>
            </div>
            
            <div class="form-group">
                <label>SALARY</label>
                <input type="text" name="sal" class="form-control" value=<?php echo $rows['sal']?>><span class="error">*<?php echo $salarr; ?></span>
            </div>
            <div class="form-group">
                <label>HOBBIES</label><br>
                <input type="checkbox" value="writing" name="hobby[]" <?php if(in_array('writing',explode(',',$rows['hobby']))){ echo 'checked';}?> >WRITING<br>
                <input type="checkbox" value="playing" name="hobby[]" <?php if(in_array('playing',explode(',',$rows['hobby']))){ echo 'checked';}?> >PLAYING<br>
                <input type="checkbox" value="cooking" name="hobby[]" <?php if(in_array('cooking',explode(',',$rows['hobby']))){ echo 'checked';}?>>COOKING<br>
                <input type="checkbox" value="reading" name="hobby[]" <?php if(in_array('reading',explode(',',$rows['hobby']))){ echo 'checked';}?>>READING<br>
            </div>

            <div class="form-group">
                <input type="file" name="file"><span class="error">*<?php  echo $imgarr;?></span>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-success" name="submit">UPDATE</button>                
            </div>
        </form>       
    </div>
</body>
</html>
