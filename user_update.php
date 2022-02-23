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

$fnamearr = $lnamearr = $emailarr = $pwarr = $cwarr = $genderarr = $agearr = $dojarr = $deptarr = $salarr = "";
$fname = $lname =$email = $pw = $cw = $gender = $age = $dept = $doj = $sal =$chkbox = $alldata= "";

 if(isset($_POST['submit'])){

    $id = $rows['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pw = $_POST['p_word'];
    $cw = $_POST['c_word'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $dept = $_POST['dept'];
    $doj = $_POST['doj'];
    $sal = $_POST['sal'];
    $chkbox = $_POST['hobby'];
    $alldata= explode(",",$chkbox);

      $target_dir = "image/";
    
      if(!file_exists($_FILES["file"]["tmp_name"])){
        $imagepath = $rows['img'];
      }else{
        $imagePath = $target_dir . basename($_FILES['file']['name']);
      }
      $chkfile = move_uploaded_file($_FILES['file']['tmp_name'], $imagepath);
   

    $update = "UPDATE EMPLOYEE SET fname='$fname',lname='$lname',p_word ='$pw',email ='$email',gender='$gender',age='$age',dept='$dept',
                                                                doj='$doj',sal='$sal',hobby='$alldata' where id=$id";
    $chk = mysqli_query($conn,$update);
    if($chk){
        header('location:user_welcome.php');
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
        
        <form action="" method="POST">
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
                <input type="password" name="p_word" class="form-control" value=<?php echo $rows['p_word'];?>><span class="error">* <?php echo $pwarr; ?></span>
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
                <option><?php echo $rows['dept'];?></option>
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
                <input type="checkbox" value="writing" name="hobby[]" value="<?php if(isset($_POST['hobby'])){
                    if(in_array('writing',$alldata)){
                        echo "checked";
                    }
                }  ?>">WRITING<br>
                <input type="checkbox" value="playing" name="hobby[]" value="<?php if(isset($_POST['hobby'])){
                    if(in_array('playing',$alldata)){
                        echo "checked";
                    }
                }  ?>">PLAYING<br>
                <input type="checkbox" value="cooking" name="hobby[]" value="<?php if(isset($_POST['hobby'])){
                    if(in_array('cooking',$alldata)){
                        echo "checked";
                    }
                }  ?>">COOKING<br>
                <input type="checkbox" value="reading" name="hobby[]" value="<?php if(isset($_POST['hobby'])){
                    if(in_array('reading',$alldata)){
                        echo "checked";
                    }
                }  ?>">READING<br>
            </div>

            <div class="form-group">
                <input type="file" name="file" value=<?php echo $rows['img'];?>>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-success" name="submit">UPDATE</button>
                <a href="user_welcome.php" class="btn btn-info">Back </a>
                
            </div>
        </form>       
    </div>
</body>
</html>