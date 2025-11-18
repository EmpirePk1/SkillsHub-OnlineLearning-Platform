<?php
include"../config/connection.php";
include"includes/header.php";
session_start();
$userID = $_SESSION['ID'];
$assignmentID = $_GET['AssignmentID'];

//Fetching assignments and user responses 
$query = "SELECT a.AssignmentNo, a.statement, a.solution, r.Response
          FROM assignments a
          JOIN assignment_responses r
          ON a.AssignmentID = r.AssignmentID
          WHERE r.UserID = $userID AND a.AssignmentID = $assignmentID
          ";
$result = $link->query($query);

if($result->num_rows > 0) {
    $data = $result->fetch_assoc();
} else {
    echo "No Results Found For this Assignment";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Important Files Including-->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>
    <title>Assignment Results</title>
</head>
<body>
    <div class="container col-md-10" style="padding: 20px; margin-top:130px;">
        <div class="card" style="padding:10px;">
            <h5 class="text-center text-primary">Assignment Results</h5> <br>
            <h5 class="text-center text-light bg-success" style="padding: 5px;">DETAILS</h5>
            <table class="table table-bordered">
                <thead class="table-info text-center">
                    <tr>
                        <th scope="col">Assignment No</th>
                        <th scope="col">Statement</th>
                        <th scope="col">Solution</th>
                        <th scope="col">Your Answer</th>
                        <th scope="col">Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center"><?php echo $data['AssignmentNo']?></td>
                        <td><?php echo $data['statement']?></td>
                        <td class="text-success"><?php echo $data['solution']?></td>
                        <td class="text-primary"><?php echo $data['Response']?></td>
                        <td class="text-center"><?php if(strtolower(trim($data['Response'])) === strtolower(trim($data['solution']))) {
                                        echo "<p class='text-success'><strong> Correct </strong></p>";
                                    } else {
                                        echo "<p class='text-danger'><strong><strong> Incorrect </strong></p>";
                        }?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>