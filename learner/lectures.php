<?php
session_start();
include"../config/connection.php";
include"includes/header.php";

// Setting Student ID and Course ID
$studentID = $_SESSION['ID'];
if(isset($_GET['CourseID'])){
    $CourseID = intval($_GET['CourseID']);
    $_SESSION['CourseID'] = $CourseID;
} elseif (isset($_SESSION['CourseID'])) {
    $CourseID = $_SESSION['CourseID'];
} else {
    die("Course Is Not Uploaded");
}

// Counting Total Lectures for Navigation
$totalLecQry = "SELECT COUNT(*) as total FROM lectures WHERE CourseID = $CourseID";
$totalRes = $link->query($totalLecQry);
$total = $totalRes->fetch_assoc()['total'];

//Fetching last Completed Lecutre
$progressQuery = "SELECT LastCompletedLecture FROM progress WHERE UserID=$studentID AND CourseID = $CourseID";
$progressResult = $link->query($progressQuery);
if($progressResult->num_rows > 0){
    $last_Lecture =$progressResult->fetch_assoc()['LastCompletedLecture'];
} else {
    $last_Lecture = 0;
}

// Determining Initial Lecture Index
if(!isset($_SESSION['current_lecture'])){
    $_SESSION['current_lecture'] = $last_Lecture + 1;
}

// Handling Navigation of Lectures
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['next'])){
        $completedLecture = $_SESSION['current_lecture'];
        if($completedLecture > $last_Lecture) {
            $updateProgress = "INSERT INTO progress (ProgressID, CourseID, UserID, LastCompletedLecture)
            VALUES(NULL, '$CourseID', '$studentID', '$completedLecture')
            ON DUPLICATE KEY UPDATE LastCompletedLecture = $completedLecture";
            $link->query($updateProgress);
        }
        if($_SESSION['current_lecture'] < $total) {
            $_SESSION['current_lecture']++;
        }
    }
    if(isset($_POST['previous'])){
        if($_SESSION['current_lecture'] > 1) {
            $_SESSION['current_lecture']--;
        }  
    }
}

//validating current lecture index
if($_SESSION['current_lecture'] > $total){
    $_SESSION['current_lecture'] = $total;
}
if($_SESSION['current_lecture'] < 1){
    $_SESSION['current_lecture'] = 1;
}

//Fetching Current Lecture Index
$currentLecture = $_SESSION['current_lecture'];
$lectureQuery = "SELECT * FROM lectures WHERE CourseID = $CourseID ORDER BY lectureID LIMIT 1 OFFSET " . ($currentLecture - 1);
$lectureResult = $link->query($lectureQuery);

if($lectureResult->num_rows > 0){
    $lecture = $lectureResult->fetch_assoc();
} else {
    echo "No Lecture Uploaded Yet";
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Important Files Including-->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Lectures</title>
</head>
<body>
    <?php 



    ?>
    <div class="container col-md-10" style="margin-top: 100px;">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center text-primary"> Lecture No <?php echo $currentLecture;?> : <?php echo $lecture['Title'];?></h4>
            </div>
            <div class="card-body">
                <video controls width="100%" height="auto">
                    <source src="<?php echo "../teacher/" . $lecture['videopath']; ?>" type="video/mp4">
                    Your Browser not supported videos 
                </video> <br><br>
                <h5> Reading Content</h5>
                <p style="font-size: 20px;"><?php echo $lecture['Topic']; ?></p>
            </div>
            <div class="card-footer">
                <form action="" method="POST" enctype="multipart/form-data">
                    <button type="submit" class="btn btn-sm btn-primary" name="previous" <?php if($currentLecture == 1) echo 'disabled';?>> Previous </button>
                    <button type="submit" class="btn btn-sm btn-primary" name="next" <?php if($currentLecture == $total) echo 'disabled';?>> Next </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include"includes/footer.php";
?>
