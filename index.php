<?php
    include"includes/header.php";
    include"functions/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills Hub</title>

    <!--Important Files Including-->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>


</head>
<body>
    <div class="row" style="margin-top: 130px;">
        <!--Slider Start-->
        <div class="carousel slide" data-bs-ride="carousel" id="MySlider">
            <!--Slider Indicators-->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#MySlider" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#MySlider" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#MySlider" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#MySlider" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#MySlider" data-bs-slide-to="4"></button>
            </div>
            <!--Slider SlideShow-->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/slider/1.jpg" alt="Slide1">
                    <div class="carousel-caption">
                        <h4> SELF-PACED LEARNING </h4>
                        <p>Learners Have The Flexibility To Progress Through Wide Range Short Courses At Their Own Pace</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/slider/1.jpg" alt="Slide2">
                    <div class="carousel-caption">
                        <h4> AUTOMATED ASSESSMENT </h4>
                        <p>Automated Assessment Mechanisms, Including Quizzes, Assignments, and Exams </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/slider/1.jpg" alt="Slide3">
                    <div class="carousel-caption">
                        <h4> AUTOMATED ENROLLMENT </h4>
                        <p> We Are Supporting The Automated Enrollment of Learners </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/slider/1.jpg" alt="Slide4">
                    <div class="carousel-caption">
                        <h4> LATEST CONTENT </h4>
                        <p> We Are Committed To Deliver Latest Content </p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/slider/1.jpg" alt="Slide5">
                    <div class="carousel-caption">
                        <h4> DESIGNED AND DEVELOPED BY </h4>
                        <p> BC210203260 &amp; BC21020340 </p>
                    </div>
                </div>
            </div>
            <!--Slider Controls-->
            <button class="carousel-control-prev" type="button" data-bs-target="#MySlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#MySlider" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
        <!--Slider End-->
    </div>

    <!--Splitter-->
    <div class="row" style="height:50px;">
        <div class="container-fluid"> </div>
    </div>

    <!--Features Start-->
    <div class="row same-height" style="margin: 10px; justify-content: space-around;">
        <div class="col-md-3 ">
            <div class="card">
                <div class="card-body">
                    <a href="#" class="card-item text-success text-center" style="text-decoration: none;">
                        <h4>100&percnt;</h4>
                        <p><i class="fas fa-heart"></i> &nbsp; Free Courses</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="#" class="card-item text-success text-center" style="text-decoration: none;">
                        <h4>10000&plus;</h4>
                        <p> <i class="fas fa-heart"></i> &nbsp; Students</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="#" class="card-item text-success text-center" style="text-decoration: none;">
                        <h4>9000&plus;</h4>
                        <p> <i class="fas fa-heart"></i> &nbsp; Certificates</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--Features End-->

    <!--Splitter-->
    <div class="row" style="height:50px;">
        <div class="container bg-light pt-10 my-10 border">
            <h4 class="text-center text-primary" style="padding: 8px;">
                WE ARE OFFERING 
            </h4> 
        </div>
    </div>

    <!--Courses Start-->
    <div class="row" style="margin: 10px; padding: 10px;">
        <?php
       getCoursesView()
        ?>
    </div>
    <!--Courses End-->

    <!--Splitter-->
    <div class="row" style="height:50px;">
        <div class="container-fluid"> </div>
    </div>
</body>
</html>
<?php
    include "includes/footer.php";
?>