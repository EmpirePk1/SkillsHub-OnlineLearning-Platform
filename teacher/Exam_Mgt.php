<?php
include"../config/connection.php";
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
    <title>Exams Management</title>
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
    
    <!--View Course card start-->
    <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">
                        Select Course 
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">S No.</th>
                                <th scope="col"> Course Title </th>
                                <th scope="col"> Course Catagory </th>
                                <th scope="col"> Description </th>
                                <th scope="col"> Select </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count=0;
                            $res = mysqli_query($link, "SELECT * FROM courses");
                            while($row = mysqli_fetch_array($res)) {
                                $count=$count+1;
                                ?>
                                    <tr class="table-striped">
                                        <th scope="row"><?php echo $count;?></th>
                                        <td><?php echo $row["CourseTitle"];?></td>
                                        <td><?php echo $row["courseCatagory"];?></td>
                                        <td><?php echo $row["courseDescription"];?></td>
                                        <td> <a href="Add_Exam.php?id=<?php echo $row["CourseID"];?>" class="btn btn-sm btn-primary"> Select  </a></td>
                                    </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>