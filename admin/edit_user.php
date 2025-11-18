<?php
include ("../config/connection.php");
include ("includes/header.php");
$id=$_GET["id"];
$res = mysqli_query($link, "SELECT * FROM users WHERE ID=$id");
while($row=mysqli_fetch_array($res)){
    $username = $row["UserName"];
    $email = $row["Email"];
    $role = $row["Role"];
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
    <title>Update User</title>
</head>
<body>
    <div class="container">
        <!--Edit User Card start-->
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
                                <input type="text" name="username" class="form-control" placeholder="User Name" required value="<?php echo $username;?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="email" class="form-control"  placeholder="Email" required value="<?php echo $email;?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="role" class="form-control"  placeholder="Role" required value="<?php echo $role;?>">
                            </div> 
                            <div class="form-group">
                            <button type="submit" name="UpdateUser" value="Add" class="btn btn-success btn-block"> Update User </button>
                            </div>
                            

                            <div class="alert alert-success" id="success" style="display:none; margin-top:10px;">
                            <strong> Updated Succussfully! </strong>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--Edit User card end-->
       
    <?php
    if(isset($_POST["UpdateUser"])){
        mysqli_query($link, "UPDATE users SET UserName='$_POST[username]', Email='$_POST[email]', Role='$_POST[role]' WHERE ID=$id") or die(mysqli_error($link));

        ?>
        <script type="text/javascript">
            document.getElementById("success").style.display="block";
            window.location="usermgt.php"
        </script>
        <?php
    }
    ?>
</body>
</html>