<?php
include"../config/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Important Files Including-->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="../admin/assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../admin/assets/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../admin/assets/style.css">
    <script src="https://ajax.googleapis.com/ajax/lib/jquery/2.1.1/jquery.min.js"></script>
    <title>Course Content Management</title>
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
            <h5 class="card-title"> Course Conetent Management </h5>
        </div>
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title"> Enter the Title of Lecture </label>
                    <input name="title" type="text" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="CourseCat"> Please Select the Course </label>
                    <select name="CourseCat" id="category" class="form-control">
                        <option value=""> Select a Course  </option>
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
                    <label for="Topic"> Enter the Topic Details </label>
                    <textarea name="Topic" id="topic" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="video"> Upload Video Lecture </label>
                    <input type="file" id="video" class="form-control" name="video" accept="video/*" required style="padding-bottom: 35px;">
                </div>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-primary" value="Upload Lecture" name="uploadLecture">
                </div>
                <div class="alert alert-success" id="success" style="display:none; margin-top:10px;">
                    <strong> Uploaded! </strong>
                </div>
            </form> 
        </div>
    </div>
    </div>
</body>
</html>
<?php
if(isset($_POST["uploadLecture"])){
    $title = $_POST['title'];
    $topic = $_POST['Topic'];
    $CourseID = $_POST['CourseCat'];

    //Handling video upload
    $dir = "uploads/lectures/";
    if(!is_dir($dir)){
        mkdir($dir, 0777, true);
    }

    $videoname = basename($_FILES['video']['name']);
    $videopath = $dir . time() . "_" . $videoname;
    $videoType = strtolower(pathinfo($videopath, PATHINFO_EXTENSION));

    $allowedTypes = ['mp4', 'avi', 'mkv', 'mov', 'wmv'];
    if(!in_array($videoType, $allowedTypes)){
        die("Invalid Video Formate(MP4, AVI, MKV, MOV and WVM are Valid)");
    }

    if(move_uploaded_file($_FILES['video']['tmp_name'], $videopath)){
        $insertQry = "INSERT INTO lectures (lectureID, CourseID, Title, Topic, videopath)
                        VALUES(NULL, '$CourseID', '$title', '$topic', '$videopath')";
        $upload = $link->query($insertQry);
    }

    ?>
    <script type="text/javascript">
        document.getElementById("success").style.display="block";
    </script>
    <?php
}
?>