<?php
include"../config/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Admin Panel</title>
</head>
<body style="background-color:cornsilk;">
<div class="container">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark card-header">
            <a href="index.php" class="navbar-brand"><i class="fas fa-home mr-2"></i>Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>
    </div>
<div class="container">
    <div class="card ">
      <div class="card-header">
          <h3 class='text-center'>Admin Login</h3>
      </div>
      <div class="cad-body">
        <div style="width:600px; margin:0px auto">
          <form class="" action="" method="post">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username"  class="form-control">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
              <button type="submit" name="login" class="btn btn-success">Login</button>
            </div>
          </form>
        </div>
      </div>
      </div>
  </div>
    <?php
    if(isset($_POST["login"])){
        $count=0;
        $username=mysqli_real_escape_string($link, $_POST["username"]);
        $password=mysqli_real_escape_string($link, $_POST["password"]);

        $res=mysqli_query($link, "select * from admin_login where username='$username' && password='$password'");
        $count=mysqli_num_rows($res);

        if($count==0){
            ?>
            <script type="text/javascript">
                document.getElementById("failure").style.display="block";
            </script>
            <?php
        } else{
            ?>
            <script type="text/javascript">
                window.location="usermgt.php";
            </script>
            <?php
        }
    }
    ?>
    <script src="script.js"></script>
</body>
</html>