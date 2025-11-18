<?php
session_start();
include"includes/header.php";
include"functions/functions.php";

if(!isset($_SESSION['ID']) || $_SESSION['role'] !== 'Student'){
    echo "
        <script>
            window.location = 'login.php';
        </script>
    ";
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Important Files Including-->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Contact Us</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    <!--Courses Start-->
    <div class="row" style="margin: 130px;">
        <?php
        getCourses();
        ?>
    </div>
    <!--Courses End-->
  
</body>
</html>
<?php } ?>