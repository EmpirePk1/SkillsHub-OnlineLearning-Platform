<?php
include ("../config/connection.php");
include ("includes/header.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/style.css">
    <title>Users Record</title>
</head>
<body>
<div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">
                    Registered Users 
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-primary text-center">
                            <th scope="col"> S No. </th>
                            <th scope="col"> User Name </th>
                            <th scope="col"> User Email </th>
                            <th scope="col"> User Phone </th>
                            <th scope="col"> Role </th>
                            <th scope="col"> Message </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count=0;
                        $res = mysqli_query($link, "select * from contactus");
                        while($row = mysqli_fetch_array($res)) {
                            $count=$count+1;
                            ?>
                                <tr class="table-striped">
                                    <th scope="row"><?php echo $count;?></th>
                                    <td><?php echo $row["SenderName"];?></td>
                                    <td><?php echo $row["SenderEmail"];?></td>
                                    <td><?php echo $row["SenderPhone"];?></td>
                                    <td><?php echo $row["SenderRole"];?></td>
                                    <td><?php echo $row["SenderMsg"];?></td>
                                </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>


