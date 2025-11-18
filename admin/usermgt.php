<?php
include ("../config/connection.php");
include ("includes/header.php");
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
    <title>Users Management</title>
</head>
<body>
        <!--Users Edit Delete card start-->
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">
                        Users Record
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">S No.</th>
                                <th scope="col"> User Name </th>
                                <th scope="col"> User Email </th>
                                <th scope="col"> Role </th>
                                <th scope="col"> Edit </th>
                                <th scope="col"> Delete </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count=0;
                            $res = mysqli_query($link, "select * from users");
                            while($row = mysqli_fetch_array($res)) {
                                $count=$count+1;
                                ?>
                                    <tr class="table-striped">
                                        <th scope="row"><?php echo $count;?></th>
                                        <td><?php echo $row["UserName"];?></td>
                                        <td><?php echo $row["Email"];?></td>
                                        <td><?php echo $row["Role"];?></td>
                                        <td> <a href="edit_user.php?id=<?php echo $row["ID"];?>" class="btn btn-sm btn-primary"> Edit  </a></td>
                                        <td> <a href="delete_user.php?id=<?php echo $row["ID"];?>" class="btn btn-sm btn-danger"> Delete </a></td>
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
        <!--Users Edit Delete card end-->

</body>
</html>