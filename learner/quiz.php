<?php
include"../config/connection.php";
session_start();

// Initialize session for the current question index
if (!isset($_SESSION["current_question"])) {
    $_SESSION["current_question"] = 0;
}

// Validate `QuizID` and `CourseID` from GET parameters
if (isset($_GET['QuizID']) && isset($_GET['CourseID'])) {
    $quizID = (int) $_GET['QuizID'];
    $courseID = (int) $_GET['CourseID'];

    // Verify the quiz-course relationship
    $validateQuery = "SELECT * FROM quizzes WHERE QuizID = $quizID AND CourseID = $courseID";
    $validateResult = mysqli_query($link, $validateQuery);

    if (mysqli_num_rows($validateResult) == 0) {
        die("Invalid quiz or course relationship.");
    }
} else {
    die("Quiz or course information missing.");
}

// Query to count total number of questions for the current quiz
$total_questions_query = "SELECT COUNT(*) as total 
    FROM quizzes WHERE CourseID = $courseID AND QuizID = $quizID";

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
$question_query = "SELECT * FROM quizzes 
    WHERE CourseID = $courseID AND QuizID = $quizID 
    LIMIT $current_question_index, 1
";
$question_result = mysqli_query($link, $question_query);

if (mysqli_num_rows($question_result) > 0) {
    $question = mysqli_fetch_assoc($question_result);
} else {
    die("No questions available for this quiz.");
}

// Getting Course details
$res = mysqli_query($link, "SELECT * FROM courses WHERE CourseID = $courseID");
while($row = mysqli_fetch_array($res)){
    $title = $row['CourseTitle'];
}
//saving
if (isset($_POST['saveAnswer'])) {
    // Get the user's answer and other necessary data
    $userAnswer = $_POST['answer'];  // User's selected answer
    $userID = $_SESSION['ID'];  // Assuming session contains UserID
    $quizID = $_GET['QuizID'];
    $courseID = $_GET['CourseID'];

    // SQL Query to insert the answer into quiz_responses table
    $insertQuery = " INSERT INTO quiz_results (ResultID, UserID, QuizID, CourseID, Answer) 
        VALUES (NULL, '$userID', '$quizID', '$courseID', '$userAnswer')
    ";
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
    <title>Quiz</title>
</head>
<body>
    <div class="container col-md-10" style="margin-top: 20px;">
        <div class="card" style="padding: 30px;">
                <h4 class="text-center text-primary"><?php echo $title; ?> Quiz</h4>
                <form action="" method="POST">
                    <h6 class="text-success">Question No <?php echo $current_question_index + 1; ?> of <?php echo $total; ?></h6>
                    <p class="text-primary" style="font-size: 20px;"><?php echo htmlspecialchars($question['question']); ?></p>
                    <div class="form-check text-primary">
                        <input type="radio" class="form-check-input" name="answer" value="OptA" id="optionA">
                        <label for="optionA" class="form-check-label"><?php echo htmlspecialchars($question['OptA']); ?></label>
                    </div>
                    <div class="form-check text-primary">
                        <input type="radio" class="form-check-input" name="answer" value="OptB" id="optionB">
                        <label for="optionB" class="form-check-label"><?php echo htmlspecialchars($question['OptB']); ?></label>
                    </div>
                    <div class="form-check text-primary">
                        <input type="radio" class="form-check-input" name="answer" value="OptC" id="optionC">
                        <label for="optionC" class="form-check-label"><?php echo htmlspecialchars($question['OptC']); ?></label>
                    </div>
                    <div class="form-check text-primary">
                        <input type="radio" class="form-check-input" name="answer" value="OptD" id="optionD">
                        <label for="optionD" class="form-check-label"><?php echo htmlspecialchars($question['OptD']); ?></label>
                    </div>
                    <div style="margin-top: 30px;">
                        <button class="btn btn-sm btn-primary" type="submit" name="previous" <?php if ($current_question_index == 0) echo 'disabled'; ?>>Previous</button>
                        <button class="btn btn-sm btn-primary" type="submit" name="next" <?php if ($current_question_index == $total - 1) echo 'disabled'; ?>>Next</button>
                        <input type="submit" name="saveAnswer" class="btn btn-sm btn-success" value="Save">
                    </div>
                </form>
        </div>
    </div>
</body>
</html>
