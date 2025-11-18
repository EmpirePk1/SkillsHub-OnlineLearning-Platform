<?php
session_start();
include"../config/connection.php";
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
                    <a href="../logout.php" class="nav-link"><i class="fas fa-sign-out-alt mr-2"></i> Logout </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!--Navigation Menu End-->
    </div>
    <!--Create course card start-->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">
                    Create Course
                </h4>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title"> Course Title </label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="CourseImg"> Course Image </label>
                        <input type="file" name="CourseImg" class="form-control" required style="padding-bottom: 35px"> 
                    </div>
                    <div class="form-group">
                        <label for="category"> Course Category </label>
                        <input type="text" name="category" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Course Description</label>
                        <input type="text" name="description" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="addCourse"value="Add" class="btn btn-success btn-block"> Add Course </button>
                    </div>
                    <div class="alert alert-success" id="success" style="display:none; margin-top:10px;">
                        <strong> Added! </strong>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Create course card end-->
        
    <!--View Course card start-->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">
                    Courses Record
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
        <?php
        if(isset($_POST["addCourse"])){
            $title=$_POST['title'];
            $category=$_POST['category'];
            $description=$_POST['description'];

            $CourseImg=$_FILES['CourseImg']['name'];
            $tmp_name=$_FILES['CourseImg']['tmp_name'];
            $folder = "../teacher/images/uploads/".$CourseImg;
            move_uploaded_file($tmp_name, $folder);
            
            mysqli_query($link,"INSERT INTO courses (CourseID, UserID,  CourseTitle, CourseImg, courseCatagory, courseDescription)
                                VALUES(NULL, '$_SESSION[ID]', '$title', '$CourseImg', '$category', '$description' )") or die(mysqli_error($link));

        ?>
        <script type="text/javascript">
            document.getElementById("success").style.display="block";
            window.location.href=window.location.href;
        </script>
        <?php
        }
        ?>
</body>
</html>
