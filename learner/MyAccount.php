 <?php
include"includes/header.php";
include"../config/connection.php";
include"../functions/functions.php";

if(!isset($_SESSION['ID']) || $_SESSION['role'] !== 'Student'){
    echo "
        <script>
            window.location = '../login.php';
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
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <title>My Account</title>
</head>
<body>
    <div class="container col-md-10" style="margin-top: 130px;">
        <div class="second card ">
            <div class="new d-flex" style="justify-content: space-between;">
                <div class="fourth p-2">
                    <?php
                    // Fetch logged-in user's name
                    $userID = $_SESSION['ID']; // Ensure session_start() is at the top
                    $res = mysqli_query($link, "SELECT UserName FROM users WHERE ID = $userID");

                    if ($row = mysqli_fetch_array($res)) {
                        $username = $row['UserName'];
                        echo "<h6 class='text-center text-primary p-2' style='font-size: 30px;'>Welcome $username</h6>";
                    }
                    ?>

                </div>
                <div class="third text-end">
                    <img src="../images/112.png" alt="Profile Pic" class="rounded-circle" 
                         style="width: 80px; height: 80px; border: 2px solid blue; padding: 6px; margin: 20px;">
                </div>
            </div>
        </div>
    </div>

    <div class="container col-md-10" style="padding: 10px;">
        <div class="card" style="padding: 10px;">
            <h5 class="text-center text-primary">Quizzes</h5>
            <?php
            getQuiz();
            ?>
        </div>
    </div>

    <div class="container col-md-10" style="padding: 10px;">
        <div class="card" style="padding: 10px;">
            <h5 class="text-center text-primary">Assignments</h5>
            <?php
            getAssignment();
            ?>
        </div>
    </div>
    <div class="container col-md-10" style="padding: 10px;">
        <div class="card" style="padding: 10px;">
            <h5 class="text-center text-primary">Exams</h5>
            <?php
            getExam();
            ?>
        </div>
    </div>
</body>
</html>

<?php } ?>
<?php 
include ("includes/footer.php");
?>


