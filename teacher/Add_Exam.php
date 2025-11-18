<?php
include("../config/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="../admin/assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../admin/assets/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../admin/assets/style.css">
    <title>Add New Exam</title>
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
                    Add New Exam
                </h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="courses"> Please Select the Course for Exam </label>
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
                        <label for="exams_cat"> Please Select Exam Category</label>
                        <select name="exams_cat" id="exams_cat" class="form-control" required>
                            <option value=""> Select Exam Category </option>
                            <?php
                            $res=mysqli_query($link, "SELECT * FROM exams_cat");
                            while($row=mysqli_fetch_array($res)){
                                $id=$row['id'];
                                $category=$row['category'];
                                echo "<option value='$id'> $category </Option>";
                            }
                            ?>
                        </select>
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
                        <input type="submit" name="addExam" class="form-control btn btn-primary" value="Add Question">
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
if(isset($_POST["addExam"])){
    $CourseID = $_POST['courses'];
    $exams_cat = $_POST['exams_cat'];
    $question = $_POST['question'];
    $OptA = $_POST['OptionA'];
    $OptB = $_POST['OptionB'];
    $OptC = $_POST['OptionC'];
    $OptD = $_POST['OptionD'];
    $Answer = $_POST['Answer'];

    mysqli_query($link, "INSERT INTO exams (ExamID, CourseID,	exam_cat, question, OptA, OptB, OptC, OptD, Answer)
                         VALUES (NULL, '$CourseID', '$exams_cat',  '$question', '$OptA', '$OptB', '$OptC', '$OptD', '$Answer')") or die(mysqli_error($link));

    ?>
    <script type="text/javascript">
        document.getElementById("success").style.display="block";
    </script>
    <?php
}

?>