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
    <title>Add Assignments</title>
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
                    Add New Assignment
                </h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="courses"> Please Select the Course for Assignment </label>
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
                        <label for="AssignmentNo"> Enter the Assignment Number </label>
                        <input type="text" class="form-control" name="AssignmentNo" required>
                    </div>
                    <div class="form-group">
                        <label for="statement"> Enter the Problem Statements </label>
                        <textarea name="statement" id="statement" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="solution"> Enter The Solution of Problem Statements </label>
                       <textarea name="solution" id="solution" class="form-control"></textarea> 
                    </div>
                    <div class="form-group">
                      <input type="submit" name="addAssignment" class="form-control btn btn-primary" value="Add Assignment">  
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
if(isset($_POST["addAssignment"])){
    $CourseID = $_POST['courses'];
    $AssignmentNo = $_POST['AssignmentNo'];
    $statement = $_POST['statement'];
    $solution = $_POST['solution'];

    mysqli_query($link, "INSERT INTO assignments (AssignmentID, CourseID,	AssignmentNo, statement, solution)
                         VALUES (NULL, '$CourseID', '$AssignmentNo',  '$statement', '$solution')") or die(mysqli_error($link));

    ?>
    <script type="text/javascript">
        document.getElementById("success").style.display="block";
    </script>
    <?php
}

?>