<?php
session_start();
include"config/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="css/stylesheet.css">
    <title>Log In</title>
</head>
<body style="background-image: url(images/loginB.jpg);">
    <div class="form-container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>
                <form action="login.php" method="post" name="form">
                    <div class="input-field">
                        <input type="text" placeholder="Username" name="username" required>
                        <i class="uil uil-user icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" name="password" placeholder="Password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <div class="input-field button">
                        <input type="submit" value="Login" name="login">
                    </div>

                    <!--Failure Alert-->
                    <div class="alert alert-danger" id="failure" style="margin-top: 10px; display:none">
                        <strong>Invalid! </strong> Invalid Username or Password.
                    </div>
                </form>
                <div class="login-register">
                    <span class="text">Not Regiserted?
                        <a href="register.php" class="text register-text"> Register Now </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <?php
    if(isset($_POST["login"])){
        $count=0;
        $res=mysqli_query($link, "SELECT * FROM users WHERE username='$_POST[username]' && password='$_POST[password]'");
        $count=mysqli_num_rows($res);
        $user = mysqli_fetch_assoc($res);

        if($count==0){
            ?>
            <script type="text/javascript">
                document.getElementById("failure").style.display="block";
            </script>
            <?php
        } else{
            $_SESSION['ID'] = $user['ID'];
            $_SESSION['role'] = $user['Role'];

            if ($user['Role'] == 'Teacher'){
                header('LOCATION: teacher/index.php');
            } else{
                header('LOCATION: learner/MyAccount.php');
            }
        }
        
    }
    ?>
    <script src="script.js"></script>
</body>
</html>