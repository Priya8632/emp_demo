<?php

include 'config.php';
session_start();

if (isset($_SESSION['id'])) {    
    header('location:user_welcome.php');
}
$error="";
$fnamearr = $lnamearr =$pwarr = $cwarr = $genderarr = $agearr = $dojarr = $deptarr = $salarr = $hobbiarr= $emailarr = $imgarr="";
$fname = $lname = $email = $gender = $age = $dept = $doj = $sal = $pw = $cw ="";

$query = "SELECT * FROM EMPLOYEE";
if(isset($_REQUEST['submit'])){
    if(!mysqli_query($conn,$query)){
    
    $createtbl = "CREATE TABLE EMPLOYEE(
        id int(10) auto_increment primary key,
        fname text,
        lname text,
        email text,
        p_word varchar(30),
        c_word varchar(30),
        gender text,
        age int(3),
        dept text,
        doj date,
        sal int(5),
        hobby text,
        img longblob
    )";
    $tblchk = mysqli_query($conn,$createtbl);
    if(!$tblchk){
        echo mysqli_error($conn);
    }
}

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
    elseif($_POST['c_word'] != $_POST['p_word']){
        $cwarr = "both password is not same..";}
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

    $imagepath = $target_dir.basename($_FILES['file']['name']);
    $chkfile = move_uploaded_file($_FILES['file']['tmp_name'], $imagepath);

    // $email = "SELECT * FROM EMPLOYEE WHERE email ='$email'";
    // $emailchk = mysqli_query($conn,$email);
    // $result = mysqli_num_rows($emailchk);
    // if($result > 0){
    //     $emailarr = "alredy exist your email";
    // }
    
        $insert = "INSERT INTO EMPLOYEE
        (`fname`,`lname`,`email`,`p_word`,`c_word`,`gender`,`age`,`dept`,`doj`,`sal`,`hobby`,`img`) VALUES 
        ('$fname','$lname','$email','$pw','$cw','$gender','$age','$dept','$doj','$sal','$alldata','$imagepath')";
    
        if(mysqli_query($conn,$insert)){
            header('location:user_login.php');
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
    <div class="container">
        
        <form action="" method="POST" enctype="multipart/form-data">
        <h2>Ragister Form</h2>
            <span class="error">* <?php echo $error; ?></span>
            <div class="form-group">
                <label>FNAME</label>
                <input type="text" name="fname" class="form-control" value="<?php if(isset($_POST['fname'])) { echo $_POST['fname'];}?>">
                <span class="error">* <?php echo $fnamearr;?>
            </span>
           </div>

            <div class="form-group">
                <label>LNAME</label>
                <input type="text" name="lname" class="form-control" value="<?php if(isset($_POST['lname'])) { echo $_POST['lname'];}?>">
                <span class="error">*<?php echo $lnamearr; ?></span>
            </div>
            <div class="form-group">
                <label>EMAIL</label>
                <input type="text" name="email" class="form-control" value="<?php if(isset($_POST['email'])) { echo $_POST['email'];}?>">
                <span class="error">* <?php echo $emailarr;?></span>
            </div>

            <div class="form-group">
                <label for="">PASSWORD</label>
                <input type="password" name="p_word" class="form-control"value="<?php if(isset($_POST['p_word'])) { echo $_POST['p_word'];} ?>">
                <span class="error">* <?php echo $pwarr; ?></span>
            </div>
            
            <div class="form-group">
                <label for="">CONFIRM PASSWORD</label>
                <input type="password" name="c_word" class="form-control" value="<?php if(isset($_POST['c_word'])) { echo $_POST['c_word'];}?>">
                <span class="error">* <?php echo $cwarr;?></span>
            </div>

            <div class="form-group">
                <label>GENDER</label>
                <input type="radio" name="gender" value="male" <?php if(isset($_POST['gender']) == 'male') { echo 'checked';}?>>MALE
                <input type="radio" name="gender" value="female" <?php if(isset($_POST['gender']) == 'female') { echo 'checked';}?>>FEMALE
                <span class="error">*<?php echo $genderarr; ?></span>
            </div>

            <div class="form-group">
                <label>AGE</label>
                <input type="text" name="age" class="form-control" value="<?php if(isset($_POST['age'])) { echo $_POST['age'];}?>">
                <span class="error">*<?php echo $agearr; ?></span>
            </div>

            <div class="form-group">
                <label>DEPARTMENT</label>
                <select name="dept" class="form-control">
                    
                    <option value="select"
                    ><?php if(isset($_POST['dept'])) { echo $_POST['dept'];}?></option>
                    <option value="purchase">Purchase</option>
                    <option value="sal">Sal</option>
                    <option value="marketing">Marketing</option>
                </select>  
                <span class="error">*<?php echo $deptarr; ?></span>      
            </div>

            <div class="form-group">
                <label>DATE OF JOIN</label>
                <input type="date" name="doj" value="<?php if(isset($_POST['doj'])) { echo $_POST['doj'];}?>"><br>
                <span class="error">*<?php echo $dojarr; ?></span>
            </div>
            
            <div class="form-group">
                <label>SALARY</label>
                <input type="text" name="sal" class="form-control" value="<?php if(isset($_POST['sal'])) { echo $_POST['sal'];}?>">
                <span class="error">*<?php echo $salarr; ?></span>
            </div>
            <div class="form-group">
                <label>HOBBIES</label><br><span class="error">*<?php echo $hobbiarr; ?></span><br>
                <input type="checkbox" name="hobby[]" value="reading" <?php if(isset($_POST['hobby']) && in_array("reading",$_POST['hobby']))
                echo 'checked = "checked"'; ?> 
                >READING<br>
                <input type="checkbox" name="hobby[]" value="writing" <?php if(isset($_POST['hobby']) && in_array("writing",$_POST['hobby']))
                echo 'checked = "checked"'; ?> 
                  >WRITING<br>
                <input type="checkbox" name="hobby[]" value="playing" <?php if(isset($_POST['hobby']) && in_array("playing",$_POST['hobby']))
                echo 'checked = "checked"'; ?> 
                 >PLAYING<br>
                <input type="checkbox" name="hobby[]" value="cooking"<?php if(isset($_POST['hobby']) && in_array("cooking",$_POST['hobby']))
                echo 'checked = "checked"'; ?> 
                >COOKING<br>
            </div>

            <div class="form-group">
                <input type="file" name="file">
                <span class="error">* <?php echo $imgarr; ?></span>
            </div>
            <p class="login-register-text">Alredy have an account?<a href="user_login.php">Login here</a></p>

            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="submit">SUBMIT</button>
                <button type="reset" class="btn btn-danger" name="reset">RESET</button>
            </div>

        </form>       
    </div>
</body>
</html>
