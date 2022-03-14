<?php

include 'config.php';

$q = isset($_GET['q']);

$sql="SELECT * FROM employee WHERE fname = '$q' ";
$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
                    <td><?php echo $data['p_word']; ?></td>
                    <td><?php echo $data['gender']; ?></td>
                    <td><?php echo $data['age']; ?></td>
                    <td><?php echo $data['dept']; ?></td>
                    <td><?php echo $data['doj']; ?></td>
                    <td><?php echo $data['sal']; ?></td>
                    <td><?php echo $data['hobby'];?></td>
                    <td><img src="<?php echo $data['img'];?>" width="60px"></td>
                    <td><a href="update.php?update=<?php echo $data['id'];?>"class="btn btn-primary" style="margin-right:5px;">UPDATE
                    <a href="delete.php?delete=<?php echo $data['id'];?>" class="btn btn-danger">DELETE</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </div> 
</body>
</html>