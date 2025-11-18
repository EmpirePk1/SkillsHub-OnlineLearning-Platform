<?php
include"../config/connection.php";
include"includes/header.php";
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
    <title>Add User</title>
</head>
<body>
  <div class="container">
    <div class="card ">
      <div class="card-header">
          <h3 class='text-center'>Add New User</h3>
      </div>
      <div class="cad-body">
        <div style="width:600px; margin:0px auto">
          <form class="" action="addUser.php" method="post">
            <div class="form-group">
              <label for="username">Your username</label>
              <input type="text" name="username"  class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" name="email"  class="form-control" required>
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
              <div class="form-group">
                <label for="role">Select user Role</label>
                <select class="form-control" name="role" id="role" required> 
                  <option value="Teacher">Teacher</option>
                  <option value="Student">Student</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <input type="submit" name="addUser" class="form-control btn btn-success" value="Add User">
            </div>

            <!--Success Alert-->
            <div class="alert alert-success" id="success" style="margin-top: 10px; display:none">
              <strong>Success! </strong> Registeration Successfull.
            </div>

            <!--Failure Alert-->
            <div class="alert alert-danger" id="failure" style="margin-top: 10px; display:none">
              <strong>Already Exist! </strong> Username already exist.
            </div>
            
          </form>
        </div>
      </div>
      </div>
  </div>
  <?php
        if(isset($_POST["addUser"])){
          $count=0;
          $res=mysqli_query($link, "select * from users where username='$_POST[username]'") or die(mysqli_error($link));
          $count=mysqli_num_rows($res);
  
          if($count>0){
              ?>
              <script type="text/javascript">
                  document.getElementById("success").style.display="none";
                  document.getElementById("failure").style.display="block";
              </script>
              <?php
          } else{
              mysqli_query($link, "insert into users values (NULL,'$_POST[username]','$_POST[email]','$_POST[password]','$_POST[role]')");
              ?>
              <script type="text/javascript">
                  document.getElementById("failure").style.display="none";
                  document.getElementById("success").style.display="block";
                  window.location="/SkillsHub/admin/usermgt.php"
              </script>
              <?php
          }
      }
      ?>
      <script src="../js/script.js"></script>
</body>
</html>