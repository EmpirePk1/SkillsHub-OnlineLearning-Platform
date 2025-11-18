-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 09:42 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skillshub_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `AssignmentID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `AssignmentNo` varchar(50) NOT NULL,
  `statement` text NOT NULL,
  `solution` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`AssignmentID`, `CourseID`, `AssignmentNo`, `statement`, `solution`) VALUES
(3, 56, '1', 'Write the sequence of html tags', 'html\r\nhead\r\nbody');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_responses`
--

CREATE TABLE `assignment_responses` (
  `ResponseID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `AssignmentID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `Response` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `assignment_responses`
--

INSERT INTO `assignment_responses` (`ResponseID`, `UserID`, `AssignmentID`, `CourseID`, `Response`) VALUES
(6, 51, 3, 56, 'html\r\nhead\r\nbody');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `ID` int(11) NOT NULL,
  `SenderName` text NOT NULL,
  `SenderEmail` text NOT NULL,
  `SenderPhone` text NOT NULL,
  `SenderRole` text NOT NULL,
  `SenderMsg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`ID`, `SenderName`, `SenderEmail`, `SenderPhone`, `SenderRole`, `SenderMsg`) VALUES
(3, 'Huraira', 'huraira@gmail.com', '+923001234876', 'Stucent', 'Facing issues while attempting quiz');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `CourseID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CourseTitle` varchar(100) NOT NULL,
  `CourseImg` text NOT NULL,
  `courseCatagory` varchar(100) NOT NULL,
  `courseDescription` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `UserID`, `CourseTitle`, `CourseImg`, `courseCatagory`, `courseDescription`) VALUES
(56, 52, 'Web Development', 'web-2.png', 'Frontend Development ', 'Web Development using HTML, CSS, Bootstrap and JavaScript');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `CourseTitle` varchar(100) NOT NULL,
  `EnrollDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`enrollment_id`, `userID`, `CourseID`, `CourseTitle`, `EnrollDate`) VALUES
(6, 51, 56, 'Web Development', '2024-11-28 14:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `ExamID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `exam_cat` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  `OptA` varchar(50) NOT NULL,
  `OptB` varchar(50) NOT NULL,
  `OptC` varchar(50) NOT NULL,
  `OptD` varchar(50) NOT NULL,
  `Answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`ExamID`, `CourseID`, `exam_cat`, `question`, `OptA`, `OptB`, `OptC`, `OptD`, `Answer`) VALUES
(3, 56, 1, 'We can write HTML code in?', 'VS Code', 'Notepad', 'Sublime', 'All are correct', 'OptD');

-- --------------------------------------------------------

--
-- Table structure for table `exams_cat`
--

CREATE TABLE `exams_cat` (
  `id` int(11) NOT NULL,
  `category` enum('Mid Term','Final Term') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exams_cat`
--

INSERT INTO `exams_cat` (`id`, `category`) VALUES
(1, 'Mid Term'),
(2, 'Final Term');

-- --------------------------------------------------------

--
-- Table structure for table `exam_results`
--

CREATE TABLE `exam_results` (
  `ResultID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ExamID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `Response` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exam_results`
--

INSERT INTO `exam_results` (`ResultID`, `UserID`, `ExamID`, `CourseID`, `Response`) VALUES
(1, 51, 3, 56, 'OptD');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `lectureID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `Title` text NOT NULL,
  `Topic` text NOT NULL,
  `videopath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`lectureID`, `CourseID`, `Title`, `Topic`, `videopath`) VALUES
(6, 56, 'Introduction', 'This lecture contain content about introduction of frontend development ', 'uploads/lectures/1732805435_VID_20211010100646.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `ProgressID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `LastCompletedLecture` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`ProgressID`, `CourseID`, `UserID`, `LastCompletedLecture`) VALUES
(55, 56, 51, 1);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `QuizID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `OptA` varchar(100) NOT NULL,
  `OptB` varchar(100) NOT NULL,
  `OptC` varchar(100) NOT NULL,
  `OptD` varchar(100) NOT NULL,
  `Answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`QuizID`, `CourseID`, `cat_id`, `number`, `question`, `OptA`, `OptB`, `OptC`, `OptD`, `Answer`) VALUES
(6, 56, 1, 1, 'File extension of HTML file is ?', '.php', '.css', '.html', '.py', 'OptC'),
(7, 56, 1, 2, 'All important links, styles and meta tags inserted into?', 'body', 'head', 'html', 'title', 'OptB');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_cat`
--

CREATE TABLE `quiz_cat` (
  `id` int(11) NOT NULL,
  `quiz_cat` enum('Mid Term','Final Term') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quiz_cat`
--

INSERT INTO `quiz_cat` (`id`, `quiz_cat`) VALUES
(1, 'Mid Term'),
(2, 'Final Term');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `ResultID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `QuizID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `Answer` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`ResultID`, `UserID`, `QuizID`, `CourseID`, `Answer`) VALUES
(1, 51, 6, 56, 'OptC'),
(4, 51, 7, 56, 'OptB');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('Teacher','Student') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `UserName`, `Email`, `Password`, `Role`) VALUES
(51, 'Huraira', 'huraira3@gmail.com', '1234', 'Student'),
(52, 'Ali', 'ali@gmail.com', '1234', 'Teacher');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`AssignmentID`),
  ADD KEY `course_assignment` (`CourseID`);

--
-- Indexes for table `assignment_responses`
--
ALTER TABLE `assignment_responses`
  ADD PRIMARY KEY (`ResponseID`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`CourseID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `user_enrollment` (`userID`),
  ADD KEY `course_enrollment` (`CourseID`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`ExamID`),
  ADD KEY `course_exam` (`CourseID`);

--
-- Indexes for table `exams_cat`
--
ALTER TABLE `exams_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_results`
--
ALTER TABLE `exam_results`
  ADD PRIMARY KEY (`ResultID`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`lectureID`),
  ADD KEY `courses_lecture` (`CourseID`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`ProgressID`),
  ADD KEY `Last_Lecture` (`LastCompletedLecture`),
  ADD KEY `course_progress` (`CourseID`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`QuizID`),
  ADD KEY `course_quiz` (`CourseID`);

--
-- Indexes for table `quiz_cat`
--
ALTER TABLE `quiz_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`ResultID`),
  ADD KEY `quiz_resutls` (`QuizID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `AssignmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assignment_responses`
--
ALTER TABLE `assignment_responses`
  MODIFY `ResponseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `CourseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `ExamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `exams_cat`
--
ALTER TABLE `exams_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exam_results`
--
ALTER TABLE `exam_results`
  MODIFY `ResultID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `lectureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `ProgressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `QuizID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quiz_cat`
--
ALTER TABLE `quiz_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `ResultID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `course_assignment` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_user` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `course_enrollment` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`),
  ADD CONSTRAINT `user_enrollment` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `course_exam` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`);

--
-- Constraints for table `lectures`
--
ALTER TABLE `lectures`
  ADD CONSTRAINT `courses_lecture` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`);

--
-- Constraints for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `course_quiz` FOREIGN KEY (`CourseID`) REFERENCES `courses` (`CourseID`);

--
-- Constraints for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD CONSTRAINT `quiz_resutls` FOREIGN KEY (`quizID`) REFERENCES `quizzes` (`QuizID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
