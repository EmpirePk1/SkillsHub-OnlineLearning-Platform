<?php
include"../config/connection.php";
include"includes/header.php";
session_start();

// Validate if AssignmentID and CourseID are provided
if (isset($_GET['AssignmentID']) && isset($_GET['CourseID'])) {
    $assignmentID = $_GET['AssignmentID'];
    $courseID = $_GET['CourseID'];

    // Fetch assignment details
    $query = "SELECT a.AssignmentNo, a.statement, c.CourseTitle 
              FROM assignments a 
              JOIN courses c ON a.CourseID = c.CourseID 
              WHERE a.AssignmentID = $assignmentID AND a.CourseID = $courseID";
    $result = mysqli_query($link, $query);

    // Check if the assignment exists
    if (mysqli_num_rows($result) > 0) {
        $assignment = mysqli_fetch_assoc($result);
        $assignmentNo = $assignment['AssignmentNo'];
        $statement = $assignment['statement'];
        $courseTitle = $assignment['CourseTitle'];
    } else {
        echo "Invalid Assignment or Course.";
        exit();
    }
} else {
    echo "Assignment or Course information missing.";
    exit();
}

if (isset($_POST['saveAssignment'])) {
    // Get the user's answer and other necessary data
    $userAnswer = $_POST['answer'];  // User's written answer
    $userID = $_SESSION['ID'];  // User ID from session
    $assignmentID = $_GET['AssignmentID'];
    $courseID = $_GET['CourseID'];

    // SQL Query to insert the answer into assignment_submissions table
    $insertQuery = " INSERT INTO assignment_responses (ResponseID, UserID, AssignmentID, CourseID, Response) 
        VALUES (NULL, '$userID', '$assignmentID', '$courseID', '$userAnswer')
    ";

    // Execute the 
    mysqli_query($link, $insertQuery);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container" style="margin-top: 130px;">
        <h4 class="text-center text-primary"><?php echo $courseTitle; ?></h4>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="text-primary text-center">Assignment No : &nbsp; <?php echo $assignmentNo; ?></h5>
                <p class="text-success"><strong>Statement : </strong> <?php echo $statement; ?></p>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="answer">Your Answer:</label>
                        <textarea class="form-control" id="answer" name="answer" rows="5" placeholder="Write your answer here..."></textarea>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success" name="saveAssignment">Save Assignment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
               
