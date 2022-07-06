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
$rslt = mysqli_query($conn, $query);
$adarr = mysqli_fetch_array($rslt);

$selectTable = "SELECT * FROM employee1";
$result = mysqli_query($conn, $selectTable);

if (!$result) {
    echo mysqli_error($conn);
}

#fetch columns from database

// Query to get columns from table
$query = "SELECT * FROM employee1";
$result = mysqli_query($conn, $query);
$assoc = mysqli_fetch_assoc($result);


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
        body {
            margin: 0px;
        }

        h2 {
            color: white;
            float: left;
        }

        .container {
            float: right;
            margin: 20px;
        }
    </style>
    <!-- <script>
        function showUser(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    console.log('ready state', this.readyState);
                    if (this.readyState == 4 && this.status == 200) {
                       console.log(xmlhttp.status);
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "search_data.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script> -->

</head>

<body>

    <nav class="navbar bg-dark p-3">
        <div class="container-fluid">
            <h2><?php echo $adarr['username']; ?></h2>
            <a href="admin_logout.php" class="btn btn-danger">LOGOUT</a>
        </div>
    </nav>


<!-- search bar start -->
    <a href="add_user.php" class="btn btn-success" style="margin:20px;">ADD USER</a>
    <div class="container">
        <form class="form-inline my-2 my-lg-0" method="POST">
            <input class="form-control mr-sm-2" type="text" placeholder="Search  by " aria-label="Search" id="search" disabled onkeyup="searchData()">
            <div class="form-ckeck" width="5">

                <select class="form-control" id="search_dropdown" onchange="placeholder()">
                    <option value="" selected disabled>select from here</option>
                    <?php foreach ($assoc as $i => $key) {
                        if ($i == 'photo' || $i == 'password') {
                            continue;
                        }
                    ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php }   ?>
                </select>
            </div>
            <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
        </form>
    </div>
<!-- search bar end -->

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
            <tbody id="rows">
                <?php while ($data = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td><?php echo $data['fname']; ?></td>
                        <td><?php echo $data['lname']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                        <td><?php echo $data['p_word']; ?></td>
                        <td><?php echo $data['gender']; ?></td>
                        <td><?php echo $data['age']; ?></td>
                        <td><?php echo $data['dept']; ?></td>
                        <td><?php echo $data['doj']; ?></td>
                        <td><?php echo $data['sal']; ?></td>
                        <td><?php echo $data['hobby']; ?></td>
                        <td><img src="<?php echo $data['img']; ?>" width="60px"></td>
                        <td><a href="update.php?update=<?php echo $data['id']; ?>" class="btn btn-primary" style="margin-right:5px;">UPDATE
                            <a href="delete.php?delete=<?php echo $data['id']; ?>" class="btn btn-danger">DELETE</a></td>
                    </tr>
                <?php } ?>


            </tbody>
        </table>
    </div>

    <script>
        let searchbar = document.getElementById("search");
        let search_drop = document.getElementById("search_dropdown");

        function placeholder() {


            searchbar.placeholder = 'search by ' + search_drop.value;
            searchbar.disabled = false;
        }

        function searchData() {
            let str = {
                srch_input: searchbar.value,
                field: search_drop.value
            }
            str = JSON.stringify(str);
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("rows").innerHTML = this.response;
                }
            }

            xhr.open("GET", "search_data.php?q=" + str, true);
            xhr.send();
        }
    </script>


    <script src="serch.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


</body>

</html>