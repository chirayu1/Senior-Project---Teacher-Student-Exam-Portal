<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
        <meta charset="UTF-8">
    </head>
<body>
        <div class="sidebar">
            <div class="title">
                <div class="name">
                <p>Hi, <?php echo $_SESSION["first_name"];?>!<a class="logout" href="logout.php"> Logout</a></p>
                </div>
            </div>
            <ul class="nav">
                <a href="students.php"><ul class="nav-item"><p>Home</p></ul></a>
                <a href="#"><ul class="nav-item"><p>Dashboard</p></ul></a>
                <a href="student-course.php"><ul class="nav-item"><p>Course</p></ul></a>
                <a href="student-exam.php"><ul class="nav-item"><p>Exam</p></ul></a>
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
                    <a href="take-exam.php"><ul>Take an Exam</ul></a>
                    <a href="#"><ul>Practice</ul></a>
                    <a href="#"><ul>Notes</ul></a>
                    <a href="frontGrades.php"><ul>Grades</ul></a>
                    <a href="#"><ul>Feedback</ul></a>
                </ul>
        </div>
</body>
    
    