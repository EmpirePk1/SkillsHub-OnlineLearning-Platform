<?php
include"../config/connection.php";
include"includes/header.php";

session_start();
// Setting Student ID and Course ID
$studentID = $_SESSION['ID'];

// Validate `QuizID` and `CourseID` from GET parameters
if (isset($_GET['QuizID']) && isset($_GET['CourseID'])) {
    $quizID = (int) $_GET['QuizID'];
    $CourseID = (int) $_GET['CourseID'];

    // Verify the quiz-course relationship
    $validateQuery = "SELECT * FROM quizzes WHERE QuizID = $quizID AND CourseID = $CourseID";
    $validateResult = mysqli_query($link, $validateQuery);

    if (mysqli_num_rows($validateResult) == 0) {
        die("Invalid quiz or course relationship.");
    }
} else {
    die("Quiz or course information missing.");
}

//Fetching quizzes and student responses 
$resultsQry = "SELECT 
                    q.QuizID,
                    q.question,
                    q.Answer AS CorrectAnswer,
                    r.Answer AS StudentAnswer
                FROM 
                    quizzes q
                LEFT JOIN 
                    quiz_results r
                ON 
                    q.QuizID = r.QuizID AND r.UserID = $studentID AND r.CourseID = $CourseID
                WHERE 
                    q.CourseID = $CourseID AND q.QuizID = $quizID";

$results = $link->query($resultsQry);

//Initializing Variables 
$totalQuestions = 0;
$totalCorrect = 0;
$quizResult = [];

//Processing Results 
if($results->num_rows > 0) {
    while($row = $results->fetch_assoc()){
        $quizID = $row['QuizID'];
        $question = $row['question'];
        $correctAnswer  = $row['CorrectAnswer'];
        $studetnAnswer = $row['StudentAnswer'];

        //Calculating Points For Correct Answers
        $isCorrect = ($correctAnswer === $studetnAnswer);
        $totalCorrect += $isCorrect ? 1 : 0;
        $totalQuestions ++;

        //Storing the results 
        $quizResult [] = [
            'QuizID' => $quizID,
            'Question' => $question,
            'CorrectAnswer' => $correctAnswer,
            'StudentAnswer' => $studetnAnswer,
            'isCorrect' => $isCorrect,
        ];
    }
} else {
    echo "No Quiz Record Found";
    exit;
}

// Calculating Obtained Marks
$ObtainedMarks = $totalCorrect;
$totalMarks = $totalQuestions;
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
    <title>Results</title>
</head>
<body>
    <div class="container col-md-10" style="margin-top: 130px;">
        <div class="card" style="padding: 20px;">
            <h5 class="text-center text-primary">Quiz Result</h5>
            <p class="text-end text-success" style="font-weight: bold;">Total Marks : <?php echo $totalQuestions; ?> &nbsp; Obtained Marks : <?php echo $ObtainedMarks; ?></p>
            <h5 class="text-center text-light bg-success" style="padding: 5px;">DETAILS</h5>
            <table class="table table-bordered">
                <thead>
                    <tr class="table-primary text-center">
                        <th scope="col">Question </th>
                        <th scope="col">Correct Answer</th>
                        <th scope="col">Your Answer</th>
                        <th scope="col">Result</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($quizResult as $result): ?>
                        <tr class="text-center">
                            <td class="text-primary text-start"><?php echo $result['Question']; ?></td>
                            <td class="text-success"><?php echo $result['CorrectAnswer']; ?></td>
                            <td><?php echo $result['StudentAnswer'] ? $result['StudentAnswer'] : 'Not Attempted' ; ?></td>
                            <td class="text-info"><?php echo $result['isCorrect'] ? 'Correct' : 'Wrong' ; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>