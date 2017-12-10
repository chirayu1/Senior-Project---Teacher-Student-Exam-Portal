<?php 
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/dashboard.css">
        <meta charset="UTF-8">
    <style>
        .sidebar {
            position:fixed;
        }
    </style>
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
                    <p class="student-name">Grades</p>
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
    </div>
    <div class="sub-headerx">
    <?php
         session_start();
         $ucid = $_SESSION["ucid"];
    ?>
    <a href="#" onclick="viewGrades()" style="cursor: pointer;">View Grades</a>
    
    
    <script>
    function viewGrades()
    {
       var httpRequest = new XMLHttpRequest();
        var url = "frontShowAllGrades.php";
        var ucid = document.getElementById("ucid").value;
        var data = {
        'ucid': ucid
        };
        console.log(data);
        
        httpRequest.open("POST", url, true);
        
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        httpRequest.onreadystatechange = function()
        {
            if (httpRequest.readyState == 4 && httpRequest.status == 200)
            {
                var return_data = httpRequest.responseText;
                document.getElementById("status").innerHTML = return_data;
            }
        }
        var data = JSON.stringify(data);
        httpRequest.send(data);   
    }
    </script>
    <script>
    function viewExamGrade()
    {
       var httpRequest = new XMLHttpRequest();
        var url = "sendGrade.php";
        var examid = document.getElementsByClassName("examid");
        var ucid = document.getElementById("ucid").value;
        var i;
        var ids = [];
        for(i=0; i < examid.length; i++)
        {
            if(examid[i].checked)
            {
              ids.push(parseInt(examid[i].id));
            }
        }       
        
        var data = {
        'examid': ids,
        'ucid': ucid
        };
        console.log(data);
        
        httpRequest.open("POST", url, true);
        
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        httpRequest.onreadystatechange = function()
        {
            if (httpRequest.readyState == 4 && httpRequest.status == 200)
            {
                var return_data = httpRequest.responseText;
                document.getElementById("status").innerHTML = return_data;
            }
        }

        var data = JSON.stringify(data);
        httpRequest.send(data);
    }
    </script>
    <input type="hidden" id="ucid" value=<?php echo $ucid;?>>
     <div id="status" style="display:block"></div> 
    </div>
    
</body>