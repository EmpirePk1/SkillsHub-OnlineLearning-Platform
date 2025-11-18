<?php
include"../config/connection.php";
session_start();

// Initialize session for the current question index
if (!isset($_SESSION["current_question"])) {
    $_SESSION["current_question"] = 0;
}

// Validate `ExamID` and `CourseID` from GET parameters
if (isset($_GET['ExamID']) && isset($_GET['CourseID'])) {
    $examID = (int) $_GET['ExamID'];
    $courseID = (int) $_GET['CourseID'];

    // Verify the exam-course relationship
    $validateQuery = "SELECT * FROM exams WHERE ExamID = $examID AND CourseID = $courseID";
    $validateResult = mysqli_query($link, $validateQuery);

    if (mysqli_num_rows($validateResult) == 0) {
        die("Invalid exam or course relationship.");
    }
} else {
    die("Exam or course information missing.");
}

// Query to count total number of questions for the current exam
$total_questions_query = "SELECT COUNT(*) as total FROM exams WHERE CourseID = $courseID AND ExamID = $examID
";
$total_questions_result = mysqli_query($link, $total_questions_query);
$total = mysqli_fetch_assoc($total_questions_result)['total'];

// Handle Next and Previous button clicks
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['next']) && $_SESSION["current_question"] < $total - 1) {
        $_SESSION["current_question"]++;
    }

    if (isset($_POST['previous']) && $_SESSION["current_question"] > 0) {
        $_SESSION["current_question"]--;
    }
}

// Fetch the current question based on the current question index
$current_question_index = $_SESSION["current_question"];
$question_query = "SELECT * FROM exams WHERE CourseID = $courseID AND ExamID = $examID LIMIT $current_question_index, 1
";
$question_result = mysqli_query($link, $question_query);

if (mysqli_num_rows($question_result) > 0) {
    $question = mysqli_fetch_assoc($question_result);
} else {
    die("No questions available for this exam.");
}

//saving

if (isset($_POST['saveAnswer'])) {
    // Get the user's answer and other necessary data
    $userAnswer = $_POST['answer'];  // User's selected answer
    $userID = $_SESSION['ID'];  // User ID from session
    $examID = $_GET['ExamID'];
    $courseID = $_GET['CourseID'];

    // SQL Query to insert the answer into exam_submissions table
    $insertQuery = " INSERT INTO exam_results (ResultID, UserID, ExamID, CourseID, Response) 
        VALUES (NULL, '$userID', '$examID', '$courseID', '$userAnswer')
    ";

    // Execute the query
    mysqli_query($link, $insertQuery);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <title>Exam</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row bg-light">
            <div class="col-md-12">
                <h4 class="text-center">Exam</h4>
                <form action="" method="POST">
                    <h5>Question <?php echo $current_question_index + 1; ?> of <?php echo $total; ?></h5>
                    <p><?php echo htmlspecialchars($question['question']); ?></p> <!-- Changed to 'question' instead of 'statement' -->

                    <!-- Displaying the answer options -->
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="answer" value="OptA" id="optionA">
                        <label for="optionA" class="form-check-label"><?php echo htmlspecialchars($question['OptA']); ?></label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="answer" value="OptB" id="optionB">
                        <label for="optionB" class="form-check-label"><?php echo htmlspecialchars($question['OptB']); ?></label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="answer" value="OptC" id="optionC">
                        <label for="optionC" class="form-check-label"><?php echo htmlspecialchars($question['OptC']); ?></label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="answer" value="OptD" id="optionD">
                        <label for="optionD" class="form-check-label"><?php echo htmlspecialchars($question['OptD']); ?></label>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="mt-3">
                        <button class="btn btn-sm btn-primary" type="submit" name="previous" <?php if ($current_question_index == 0) echo 'disabled'; ?>>Previous</button>
                        <button class="btn btn-sm btn-primary" type="submit" name="next" <?php if ($current_question_index == $total - 1) echo 'disabled'; ?>>Next</button>
                        <input type="submit" name="saveAnswer" class="btn btn-sm btn-success" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
