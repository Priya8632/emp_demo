<?php
include 'config.php';

$search_value = $_GET['q'];

$decode =json_decode($search_value);
  $input = $decode->srch_input;
  $field = $decode->field;
 

# search data from user table
$serch_qry = "SELECT * FROM employee1 WHERE $field LIKE '%$input%' ";
$result = mysqli_query($conn, $serch_qry);

while ( $data = mysqli_fetch_assoc($result)) { 
    ?>

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