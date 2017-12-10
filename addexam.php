<?php 
    session_start();
    //include('checklogin.php');
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Instructor Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
        <meta charset="UTF-8">
    </head>
<body>
        <div class="sidebar">
            <div class="title">
                <div class="name">
                <p>Hi, <?php echo $_SESSION['first_name']; ?>!<a class="logout" href="logout.php"> Logout</a></p>
                </div>
            </div>
            <ul class="nav">
                <a href="teacher.php"><ul class="nav-item"><p>Home</p></ul></a>
                <a href="#"><ul class="nav-item"><p>Dashboard</p></ul></a>
                <a href="course.php"><ul class="nav-item"><p>Course</p></ul></a>
                <a href="addexam.php"><ul class="nav-item"><p>Exam</p></ul></a>
                <a href="#"><ul class="nav-item"><p>Question</p></ul></a>
                <a href="#"><ul class="nav-item"><p>Feedback</p></ul></a>
            </ul>
        </div>
    <div class="header">
        <a href="#"><img src="http://www.njit.edu/corporate/uicomponents/images/logoprint.png" alt="NJIT Logo" class="logo"></a>
    </div>
    <div class="sub-header">
            <div class="student">
                <div class="student-notation">
                    <p class="student-name">EXAM</p>
                    </div>
                </div>
                
                <div class="cb"></div>
                
                <ul class="header-menu">
                    <a href="create-question.php"><ul>Create a Question</ul></a>
                    <a href="createexam.php"><ul>Create an Exam</ul></a>
                    <a href="#"><ul>Notes</ul></a>
                    <a href="exams.php"><ul>Exams</ul></a>
                    <a href="results.php"><ul>Results</ul></a>
                </ul>
        </div>
</body>
    
    