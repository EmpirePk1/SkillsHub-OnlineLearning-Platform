<?php
include"includes/header.php";
include"config/connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Important Files Including-->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Contact Us</title>
</head>
<body>
    <div class="row justify-content-center" style="margin-top: 130px; padding:10px;">
        <div class="card col-md-9">
            <div class="card-header text-center">
                <h4>
                    Contact Us
                </h4>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Enter Your Full Name</label>
                        <input name="username" type="text" class="form-control" placeholder="User Name" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Select Your Role</label>
                        <select name="role" id="role" class="form-control">
                            <option value="Stucent">Student</option>
                            <option value="Teacher">Teacher</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Enter Your Email</label>
                        <input name="email" type="email" class="form-control" placeholder="abc@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Your Phone Number</label>
                      <input name="phone" type="text" class="form-control" placeholder="+923001234567" required>  
                    </div>
                    <div class="form-group">
                        <label for="suggestion"> Please describe the reason of contact</label>
                        <textarea name="suggestion" id="contact-suggesstions" class="form-control"></textarea>
                    </div><br>
                    <div class="form-group">
                        <input type="submit" class="form-control btn btn-primary" value="Contact Now" name="ContactUs">
                    </div>
                    <div class="alert alert-success" id="success" style="display:none; margin-top:10px;">
                        <strong> Ticket Generated! Please wait for the respone by system Administrator </strong>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_POST["ContactUs"])){
    $senderName = $_POST['username'];
    $senderEmail = $_POST['email'];
    $senderPhone = $_POST['phone'];
    $senderRole = $_POST['role'];
    $message = $_POST['suggestion'];

    mysqli_query($link, "INSERT into contactus (ID, SenderName, SenderEmail, SenderPhone, SenderRole, SenderMsg)
                         VALUES (NULL, '$senderName', '$senderEmail', '$senderPhone', '$senderRole', '$message')") or die(mysqli_error($link));

    ?>
    <script>
        document.getElementById('success').style.display="block";
    </script>
    <?php
}

?>
<?php
include"includes/footer.php";
?>