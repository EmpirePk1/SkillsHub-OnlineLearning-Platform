<?php
include"../config/connection.php";
$id=$_GET["id"];
$res = mysqli_query($link, "SELECT * FROM courses WHERE CourseID=$id");
while($row=mysqli_fetch_array($res)){
    $CourseImg = $row['CourseImg'];
    $title = $row["CourseTitle"];
    $catagory = $row["courseCatagory"];
    $description = $row["courseDescription"];
}
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
    <title>Update Course</title>
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
    </div>
        <!--Navigation Menu End-->

        <!--Create course card start-->
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">
                        Update Course
                    </h4>
                </div>
                <div class="card-body">
                    <div style="width:600px; margin:0px auto;">
                        <form action="" method="post">
                        <div class="form-group pt-3">
                                <input type="text" name="CourseImgold" class="form-control" value="<?php echo $CourseImg;?>">
                            </div>
                            <div class="form-group pt-3">
                                <input type="file" name="CourseImg" class="form-control" style="padding-bottom: 35px;">
                            </div>
                            <div class="form-group pt-3">
                                <input type="text" name="title" class="form-control" placeholder="Course Title" required value="<?php echo $title;?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="category" class="form-control"  placeholder="Course Category" required value="<?php echo $catagory;?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="description" class="form-control"  placeholder=" Course Description" required value="<?php echo $description;?>">
                            </div> 
                            <div class="form-group">
                            <button type="submit" name="UpdtateCourse" value="Add" class="btn btn-success btn-block"> Update Course </button>
                            </div>
                            

                            <div class="alert alert-success" id="success" style="display:none; margin-top:10px;">
                            <strong> Updated Succussfully! </strong>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Create course card end-->
       
    <?php
    if(isset($_POST["UpdtateCourse"])){
        $title=$_POST['title'];
        $category=$_POST['category'];
        $description=$_POST['description'];

        $CourseImg = $_FILES['CourseImg']['name'];
        $tmp_name = $_FILES['CourseImg']['tmp_name'];
        $folder = "../teacher/images/uploads/".$CourseImg;
        move_uploaded_file($tmp_name, $folder);

        mysqli_query($link, "UPDATE courses SET CourseTitle ='$_POST[title]', CourseImg ='$_POST[CourseImg]', courseCatagory='$_POST[category]', courseDescription='$_POST[description]' WHERE CourseID=$id") or die(mysqli_error($link));

        ?>
        <script type="text/javascript">
            document.getElementById("success").style.display="block";
            window.location ="index.php";
        </script>
        <?php
    }
    ?>
</body>
</html>