<?php
include "config/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <title>Register</title>
</head>
<body style="background-image: url(images/loginB.jpg);">
    <div class="form-container">
        <div class="forms">
            <div class="form login">
                <span class="title">Register</span>
                <form action="register.php" name="form" method="post">
                    <div class="input-field">
                        <input type="text" placeholder="User Name" name="username" required>
                        <i class="uil uil-user icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="Email" name="email" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" placeholder="Password" name="password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" name="qualification" placeholder="Enter Your Qualification" required>
                    </div><br>
                    <div class="role-content">
                        <input type="radio" id="student" name="role" value="Student" required>
                        <label for="student"> Student </label>
                        <input type="radio" id="Teacher" name="role" value="Teacher" required>
                        <label for="Teacher"> Teacher </label>
                    </div>
                  
                    <div class="input-field button">
                        <input type="submit" name="submit" value="Register">
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
                <div class="register-login">
                    <span class="text">Registered Member?
                        <a href="login.php" class="text login-text"> Login Now </a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST["submit"])){
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
            </script>
            <?php
        }
    }
    ?>
    <script src="js/script.js"></script>
</body>
</html>