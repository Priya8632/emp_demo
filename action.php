<?php

include 'confing.php';
$output = '';
if(isset($_POST['query'])){
    $search = $_POST['query'];
    $data = mysqli_query($conn, "SELECT * FROM employee1 WHERE fname LIKE CONCAT('%',?,'%') OR lname LIKE CONCAT('%',?,'%')");
    // $data->bind_param('ss', $search,$search);
    // $item = mysqli_num_rows($data);
}
else{
    $data = mysqli_query($conn, "SELECT * FROM employee1");
    
}
$result = mysqli_num_rows($data);

if($result > 0){
    $output = "
        <thead>
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
          <tbpdy>";
          while($item = mysqli_fetch_assoc($data)){
                $output .= "
                <tr>
                <td>".$item['id']."</td>
                <td>".$item['fname']."</td>
                <td>".$item['lname']."</td>
                <td>".$item['email']."</td>
                <td>".$item['p_word']."</td>
                <td>".$item['gender']."</td>
                <td>".$item['age']."</td>
                <td>".$item['dept']."</td>
                <td>".$item['doj']."</td>
                <td>".$item['sal']."</td>
                <td>".$item['hobby']."</td>              
                </tr>
                ";
          }
          $output .= "</tbody>";
          echo $output;
}
else{
    echo "<h3> no records found</h3>";
}


?>