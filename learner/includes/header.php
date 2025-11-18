<?php
session_start();
include"../config/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills Hub E-Learning</title>

    <!--Important Files Including-->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="fixed-top">
        <div class="row bg-primary text-center text-light">
            <h3>
                SKILLS HUB <br>
                Online E-learning Platform 
            </h3>
        </div>
        <!--Navigation Bar Start-->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
        
                    <div class="collapse navbar-collapse justify-content-end" id="myNavbar">
                        <ul class="navbar-nav">
                            <li class="nav-item"><a href="../index.php" class="nav-link"><i class="fas fa-home mr2"></i> Home </a></li>
                            <li class="nav-item"><a href="../contactus.php" class="nav-link"><i class="fas fa-envelope mr2"></i> Contact Us </a></li>
                            <li class="nav-item"><a href="../courses.php" class="nav-link"><i class="fas fa-book mr2"></i> Courses </a></li>
                            <li class="nav-item"><a href="MyAccount.php" class="nav-link"><i class="fas fa-user mr2"></i> My Account </a></li>
                            <li class="nav-item"><a href="../register.php" class="nav-link"><i class="fas fa-user-plus mr2"></i> Regiser </a></li>
                            <?php
                            if(!isset($_SESSION['ID'])){
                                echo "<li class='nav-item'><a href='login.php' class='nav-link'><i class='fas fa-sign-in-alt mr2'></i> Login </a></li>";
                            } else {
                                echo "<li class='nav-item'><a href='logout.php' class='nav-link'><i class='fas fa-sign-in-alt mr2'></i> Logout </a></li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        <!--Navigation Bar End-->
    </div>
</body>
</html>