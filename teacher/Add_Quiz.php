<?php
include("../config/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../admin/assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../admin/assets/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../admin/assets/style.css">
    <title>Add New Quiz</title>
</head>
<body>
    <div class="container">
        <!--Navigation Menu Start-->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a href="index.php" class="navbar-brand"><i class="fas fa-home mr-2"></i>Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a href="../logout.php" class="nav-link"><i class="fas fa-sign-out-alt mr-2"></i> Logout </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!--Navigation Menu End-->
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">
                    Add New Quiz
                </h4>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                       <label for="courses"> Please Select the Course for Quiz </label>
                        <select name="courses" id="courses" class="form-control" required>
                            <option value=""> Select a Course </option>
                            <?php
                            $res=mysqli_query($link, "SELECT * FROM courses");
                            while($row=mysqli_fetch_array($res)){
                                $id=$row['CourseID'];
                                $title=$row['CourseTitle'];
                                echo "<option value='$id'> $title </Option>";
                            }
                            ?>
                        </select> 
                    </div>
                    <div class="form-group">
                        <label for="quiz_cat"> Please Select Quiz Category</label>
                        <select name="quiz_cat" id="quiz_cat" class="form-control" required>
                            <option value=""> Select Quiz Category </option>
                            <?php
                            $res=mysqli_query($link, "SELECT * FROM quiz_cat");
                            while($row=mysqli_fetch_array($res)){
                                $id=$row['id'];
                                $quiz_cat=$row['quiz_cat'];
                                echo "<option value='$id'> $quiz_cat </Option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="number"> Enter the Quiz Number </label>
                        <input type="text" class="form-control" name="number" required>  
                    </div>
                    <div class="form-group">
                        <label for="question"> Enter the Question Statement </label>
                        <input type="text" class="form-control" name="question" required>
                    </div>
                    <div class="form-group">
                        <label for="OptionA"> Enter Option A </label>
                        <input type="text" class="form-control" name="OptionA" required> 
                    </div> 
                    <div class="form-group">
                        <label for="OptionB"> Enter Option B </label>
                        <input type="text" class="form-control" name="OptionB" required> 
                    </div>
                    <div class="form-group">
                        <label for="OptionC"> Enter Option C </label>
                        <input type="text" class="form-control" name="OptionC" required> 
                    </div>
                    <div class="form-group">
                        <label for="OptionD"> Enter Option D </label>
                        <input type="text" class="form-control" name="OptionD" required> 
                    </div>
                    <div class="form-group">
                        <label for="Answer"> Enter the Answer </label>
                        <input type="text" class="form-control" name="Answer" required> 
                    </div>
                    <div class="form-group">
                        <input type="submit" name="addQuiz" class="form-control btn btn-primary" value="Add Question">
                    </div>
                    <div class="alert alert-success" id="success" style="display:none; margin-top:10px;">
                        <strong> Added! </strong>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_POST["addQuiz"])){
    $CourseID = $_POST['courses'];
    $quiz_cat = $_POST['quiz_cat'];
    $quiz_num = $_POST['number'];
    $question = $_POST['question'];
    $OptA = $_POST['OptionA'];
    $OptB = $_POST['OptionB'];
    $OptC = $_POST['OptionC'];
    $OptD = $_POST['OptionD'];
    $Answer = $_POST['Answer'];

    mysqli_query($link, "INSERT INTO quizzes (QuizID, CourseID,	cat_id, number, question, OptA, OptB, OptC, OptD, Answer)
                         VALUES (NULL, '$CourseID', '$quiz_cat', '$quiz_num', '$question', '$OptA', '$OptB', '$OptC', '$OptD', '$Answer')") or die(mysqli_error($link));

    ?>
    <script type="text/javascript">
        document.getElementById("success").style.display="block";
    </script>
    <?php
}

?>