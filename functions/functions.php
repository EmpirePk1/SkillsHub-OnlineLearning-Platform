<?php
// Creating Database Connection
$link = mysqli_connect("localhost", "root", "", "skillshub_database");

function getCourses() {
    global $link;
    

    // Prepared statement for SELECT query to prevent SQL injection
    $get_course = mysqli_query($link, "SELECT * FROM courses ORDER BY 1 DESC LIMIT 0,8");

    while ($row = mysqli_fetch_array($get_course)) {
        $CourseID = $row['CourseID'];
        $CourseImg = $row['CourseImg'];
        $title = $row['CourseTitle'];
        $category = $row['courseCatagory'];
        $desc = $row['courseDescription'];

        // Check if the user is enrolled in this course
        $userID = $_SESSION['ID'];
        $enrolledQuery = mysqli_query($link, "SELECT * FROM enrollments WHERE userID = $userID AND CourseID = $CourseID");
        $isEnrolled = mysqli_num_rows($enrolledQuery) > 0;

        echo "
        <div class='col-md-3 col-sm-6'>
            <div class='card'>
                <div class='card-body'>
                    <img src='teacher/images/uploads/" . (!empty($CourseImg) ? $CourseImg : 'placeholder.jpg') . "' class='img-fluid' alt='Course Image'>
                    <h3>$title</h3>
                    <p>$category</p>
                    <p>$desc</p>
                </div>
                <div class='card-footer'>
        ";

        if ($isEnrolled) {
            // Show the "Start Course" button
            echo "
            <a href='learner/lectures.php?CourseID=$CourseID' class='btn btn-success btn-block'>Start Course</a>
            ";
        } else {
            // Show the "Enroll Now" button
            echo "
            <form method='POST'>
                <input type='hidden' name='CourseID' value='$CourseID'>
                <input type='hidden' name='CourseTitle' value='$title'>
                <button class='btn btn-primary btn-block' type='submit' name='Enroll'>Enroll Now</button>
            </form>
            ";
        }

        echo "
                </div>
            </div>
        </div>
        ";
    }

    // Handle enrollment
    if (isset($_POST['Enroll'])) {
        $courseID = $_POST['CourseID'];
        $courseTitle = $_POST['CourseTitle'];

        // Insert into enrollments table
        $stmt = mysqli_prepare($link, "INSERT INTO enrollments (userID, CourseID, CourseTitle) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "iis", $_SESSION['ID'], $courseID, $courseTitle);

        if (mysqli_stmt_execute($stmt)) {
            // Show success alert and redirect to prevent resubmission
            echo "
            <script>
                Swal.fire({
                    title: 'Congratulations!',
                    text: 'You are successfully enrolled in $courseTitle.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location = window.location.href;
                });
            </script>
            ";
            exit(); // Stop further execution to prevent looping
        } else {
            // Show error alert
            echo "
            <script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Unable to enroll in $courseTitle. Please try again later.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>
            ";
            // Optionally log the error for debugging purposes
            error_log("Enrollment error: " . mysqli_stmt_error($stmt));
        }
    }
}



// Function to Display Courses on Home/Index Page
function getCoursesView() {
    global $link;
    $get_course = mysqli_query($link, "SELECT * FROM courses ORDER BY 1 DESC LIMIT 0,8");
    while ($row = mysqli_fetch_array($get_course)) {
        $CourseID = $row['CourseID'];
        $CourseImg = $row['CourseImg'];
        $title = $row['CourseTitle'];
        $category = $row['courseCatagory'];
        $desc = $row['courseDescription'];

        echo "
        <div class='col-md-3 col-sm-6'>
            <div class='card'>
                <div class='card-body'>
                    <img src='teacher/images/uploads/$CourseImg' class='img-fluid' alt='Course Image' style='height:400px; widht:auto;'>
                    <h3>$title</h3>
                    <p>$category</p>
                    <p>$desc</p>
                </div>
            </div>
        </div>
        ";
    }
}

// Function to fetch and display quizzes
function getQuiz() {
    global $link;
    $userID = $_SESSION['ID']; // Assuming user ID is stored in the session.

    // Fetch quizzes only for the courses the user is enrolled in
    $query = "SELECT 
                q.QuizID,
                q.number,
                c.CourseTitle,
                c.CourseID,
                qr.ResultID
            FROM quizzes AS q
            JOIN courses AS c ON q.CourseID = c.CourseID
            LEFT JOIN quiz_results as qr
                ON q.QuizID = qr.QuizID
                AND qr.UserID = $userID
            WHERE q.CourseID IN (
                        SELECT CourseID FROM enrollments WHERE UserID = $userID
                    )
    ";

    $result = mysqli_query($link, $query);

    echo "
    <div class='table-responsive'>
        <table class='table table-bordered table-hover' style='width: 90%; margin: auto;'>
            <thead class='table-primary'>
                <tr>
                    <th class='text-center'>Quiz No.</th>
                    <th class='text-center'>Course</th>
                    <th class='text-center'>Action</th>
                </tr>
            </thead>
            <tbody>
    ";

    if (mysqli_num_rows($result) > 0) {
        $count=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $count=$count+1;
            $quizID = $row['QuizID'];
            $quizNo = $row['number'];
            $courseTitle = $row['CourseTitle'];
            $courseID = $row['CourseID'];
            $ResultID = $row['ResultID'];

            echo "
                <tr>
                    <td class='text-center'>$count</td>
                    <td class='text-center'>$courseTitle</td>
                    <td class='text-center'> ";
                    if($ResultID) {
                        echo "<a href='quiz_result.php?QuizID=$quizID&CourseID=$courseID' class='btn btn-sm btn-success'>View Resutls</a>"; 
                    } else {
                        echo "<a href='quiz.php?QuizID=$quizID&CourseID=$courseID' class='btn btn-sm btn-primary'>Take Quiz</a>";
                    }
                        
            echo "   
                    </td>
                </tr>
            ";
        }
    } else {
        echo "
            <tr>
                <td colspan='3' class='text-center'>No quizzes found for your enrolled courses.</td>
            </tr>
        ";
    }

    echo "
            </tbody>
        </table>
    </div>
    ";
}

// Function to fetch and display assignments
function getAssignment() {
    global $link;
    $userID = $_SESSION['ID'];

    $query ="SELECT 
                a.AssignmentID,
                a.AssignmentNo,
                c.CourseTitle,
                c.CourseID,
                ar.ResponseID
            FROM assignments AS a
            JOIN courses as c ON a.CourseID = c.CourseID
            LEFT JOIN assignment_responses AS ar
                ON a.AssignmentID = ar.AssignmentID
                AND ar.UserID = $userID
            WHERE a.CourseID IN (
                    SELECT CourseID FROM enrollments WHERE UserID = $userID
                    )
    ";

    $result = mysqli_query($link, $query);

    echo "
    <div class='table-responsive'>
        <table class='table table-bordered table-hover' style='width: 90%; margin: auto;'>
            <thead class='table-primary'>
                <tr>
                    <th class='text-center'>Assignment No.</th>
                    <th class='text-center'>Course</th>
                    <th class='text-center'>Action</th>
                </tr>
            </thead>
            <tbody>
    ";

    if (mysqli_num_rows($result) > 0) {
        $count=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $count=$count+1;
            $assignmentID = $row['AssignmentID'];
            $assignmentNo = $row['AssignmentNo'];
            $courseTitle = $row['CourseTitle'];
            $courseID = $row['CourseID'];
            $responseID = $row['ResponseID'];

            echo "
                <tr>
                    <td class='text-center'>$count</td>
                    <td class='text-center'>$courseTitle</td>
                    <td class='text-center'>";
                if($responseID) {
                    echo "<a href='assignment_result.php?AssignmentID=$assignmentID&CourseID=$courseID' class='btn btn-sm btn-success'>View Result</a>";
                } else {
                   echo "<a href='assignment.php?AssignmentID=$assignmentID&CourseID=$courseID' class='btn btn-sm btn-primary'>Submit</a>";
                }
                        
                echo "</td>
                </tr>
                    ";
        }
    } else {
        echo "
            <tr>
                <td colspan='3' class='text-center'>No assignments found for your enrolled courses.</td>
            </tr>
        ";
    }

    echo "
            </tbody>
        </table>
    </div>
    ";
}

// Function to fetch and display exams
function getExam() {
    global $link;
    $userID = $_SESSION['ID'];

    $query = "SELECT
                e.ExamID,
                c.CourseTitle,
                c.CourseID,
                er.ResultID
            FROM exams AS e
            JOIN courses AS c ON e.CourseID = c.CourseID
            LEFT JOIN exam_results AS er
                ON e.ExamID = er.ExamID
                AND er.UserID = $userID
            WHERE e.CourseID IN (
                        SELECT CourseID FROM enrollments WHERE UserID = $userID
                    )
            ";
    $result = mysqli_query($link, $query);

    echo "
    <div class='table-responsive'>
        <table class='table table-bordered table-hover' style='width: 90%; margin: auto;'>
            <thead class='table-primary'>
                <tr>
                    <th class='text-center'>Exam No.</th>
                    <th class='text-center'>Course</th>
                    <th class='text-center'>Action</th>
                </tr>
            </thead>
            <tbody>
    ";

    if (mysqli_num_rows($result) > 0) {
        $count=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $count=$count+1;
            $examID = $row['ExamID'];
            $courseTitle = $row['CourseTitle'];
            $courseID = $row['CourseID'];
            $ResultID = $row['ResultID'];

            echo "
                <tr>
                    <td class='text-center'>$count</td>
                    <td class='text-center'>$courseTitle</td>
                    <td class='text-center'> ";
                    if($ResultID) {
                        echo "<a href='exam_result.php?ExamID=$examID&CourseID=$courseID' class='btn btn-sm btn-success'>View Result</a>";
                    } else {
                        echo "<a href='exam.php?ExamID=$examID&CourseID=$courseID' class='btn btn-sm btn-primary'>Take Exam</a>";
                    }
            echo "            
                    </td>
                </tr>
            ";
        }
    } else {
        echo "
            <tr>
                <td colspan='3' class='text-center'>No exams found for your enrolled courses.</td>
            </tr>
        ";
    }

    echo "
            </tbody>
        </table>
    </div>
    ";
}
?>
