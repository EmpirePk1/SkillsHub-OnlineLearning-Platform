<?php
session_start();
include"../config/connection.php";
if(!isset($_SESSION['ID']) || $_SESSION['role'] !== 'Teacher'){
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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="../admin/assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../admin/assets/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../admin/assets/style.css">
    <title>Course Management</title>
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
                    <a href="addCourse.php" class="nav-link"><i class="fas fa-plus mr-2"></i> Add Course </a>
                    </li>
                    <li class="nav-item">
                    <a href="contentMgt.php" class="nav-link"><i class="fas fa-upload mr-2"></i> Upload Lecture </a>
                    </li>
                    <li class="nav-item">
                    <a href="Add_Quiz.php" class="nav-link"><i class="fas fa-question mr-2"></i> Add Quiz </a>
                    </li>
                    <li class="nav-item">
                    <a href="Add_Assignment.php" class="nav-link"><i class="fas fa-copy mr-2"></i> Add Assignment </a>
                    </li>
                    <li class="nav-item">
                    <a href="Add_Exam.php" class="nav-link"><i class="fas fa-book mr-2"></i> Add Exam </a>
                    </li>
                    <li class="nav-item">
                    <a href="../logout.php" class="nav-link"><i class="fas fa-sign-out-alt mr-2"></i> Logout </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!--Navigation Menu End-->
    </div>

    <!--View Course card start-->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">
                    Courses Management
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">S No.</th>
                            <th scope="col"> Course Image </th>
                            <th scope="col"> Course Title </th>
                            <th scope="col"> Course Catagory </th>
                            <th scope="col"> Description </th>
                            <th scope="col"> Edit </th>
                            <th scope="col"> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count=0;
                        $res = mysqli_query($link, "select * from courses");
                        while($row = mysqli_fetch_array($res)) {
                            $count=$count+1;
                            ?>
                                <tr class="table-striped">
                                    <th scope="row"><?php echo $count;?></th>
                                    <td><?php echo $row["CourseImg"];?></td>
                                    <td><?php echo $row["CourseTitle"];?></td>
                                    <td><?php echo $row["courseCatagory"];?></td>
                                    <td><?php echo $row["courseDescription"];?></td>
                                    <td> <a href="edit_course.php?id=<?php echo $row["CourseID"];?>" class="btn btn-sm btn-primary"> Edit  </a></td>
                                    <td> <a href="delete_course.php?id=<?php echo $row["CourseID"];?>" class="btn btn-sm btn-danger"> Delete </a></td>
                                </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <!--View course card end-->
</body>
</html>
<?php } ?>