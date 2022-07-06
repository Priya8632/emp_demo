
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ajex</title>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body class="bg-light">

  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="#">Navbar</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-10  mt-2 rounded pb-3">
        <h1 class="text-primary p-2">live search using php my sql & ajax</h1>
        <hr>
        <div class="form-inline">
          <label for="" class="font-weight-bold lead text-dark mr-3">search Records</label>
          <input type="text" name="search" id="search_text" class="form-control form-control-lg rounded-0 border-primary" placeholder="search">
        </div>
        <hr>

        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'tutorial');
        $data = mysqli_query($conn, "SELECT * FROM employee1");
        ?>
        <table class="table table-hover" id="table-data">
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
            <?php while ($item = mysqli_fetch_assoc($data)) { ?>
              <tr>
                <td><?= $item['id']; ?></td>
                <td><?= $item['fname']; ?></td>
                <td><?= $item['lname']; ?></td>
                <td><?= $item['email']; ?></td>
                <td><?= $item['p_word']; ?></td>
                <td><?= $item['gender']; ?></td>
                <td><?= $item['age']; ?></td>
                <td><?= $item['dept']; ?></td>
                <td><?= $item['doj']; ?></td>
                <td><?= $item['sal']; ?></td>
                <td><?= $item['hobby']; ?></td>
                <td><img src="<?php echo $item['img']; ?>" width="60px"></td>
                <td><a href="update.php?update=<?php echo $item['id']; ?>" class="btn btn-primary" style="margin-right:5px;">UPDATE
                    <a href="delete.php?delete=<?php echo $item['id']; ?>" class="btn btn-danger">DELETE</a></td>
              </tr>
            <?php } ?>
          </tbody>
      </div>
    </div>
  </div>


  <script>
        $(document).ready(function() {
            $('#search_text').keyup(function()
            {
                var search = $(this).val();
                $.ajax({
                  url:'action.php',
                  method:'post',
                  data:{query:search},
                  success:function(result){
                    $("#table-data").html(result);
                  }
                });
            });
        });
  </script>
</body>

</html>