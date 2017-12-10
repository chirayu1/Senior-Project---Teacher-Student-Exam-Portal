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
    <style>
      .sidebar {
          position: fixed;
      }
    </style>
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
                    <p class="student-name">Exams</p>
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
    <div class="sub-headerx">
    <style>
        .box{
        border: 1px solid black;
        float: right;
        width: 46%;
        margin-bottom: 10px;
        max-height: 600px;
        //margin-right: -80px;
        overflow-y: scroll;
        //margin-top: -471px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin: 1px;
        margin-bottom: 10px;
    }
    
    th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
    }
    
    td {
        
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    
    tr:nth-child(even){
        background-color: #dddddd;
    }
    div#status {
          border: 1px solid black;
          padding: 5px;
          position: absolute;
          //margin-top: 30px;
          background-color: darkslateblue;
          color: white;
          font-size: 20px;
          border-radius: 5px;
          margin-bottom: 10px;
        }
  </style>
  <script>
function sendExamID()
    {
        var httpRequest = new XMLHttpRequest();
        var url = "frontSendExamID.php";
        var examid = document.getElementsByClassName("examid");
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
        'examid': ids
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
function releaseExamID()
    {
        var httpRequest = new XMLHttpRequest();
        var url = "frontReleaseExamID.php";
        var examid = document.getElementsByClassName("examid");
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
        'examid': ids
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
function deleteExamID()
    {
        var httpRequest = new XMLHttpRequest();
        var url = "frontDeleteExamID.php";
        var examid = document.getElementsByClassName("examid");
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
        'examid': ids
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
  <?php

     /* CURL to the BACK END and RECEIVE DATA */
    $url = "https://web.njit.edu/~fl7/rc/backGetExamNames.php";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    //echo $response;
    $response = json_decode($response, true);
    //echo $response[0]['examTitle'];
    //echo $response[0]['examID'];
?>
    <a href="#" onclick="showCreatedExams()" style="cursor: pointer;">View Created Exams</a>
      <br><br>
      <div id="examTable" style="display:none">
      <table>
        <tr>
          <th></th>
          <th><strong>Exam Name</strong></th>
        </tr>
        <?php 
    for($i=0; $i<sizeof($response); $i++){
        ?>
        <tr>
          <td><input type="radio" class="examid" style="display:block;" name="examids" id=<?php echo $response[$i]['examID'];?>></td>
          <td><?php echo $response[$i]['examTitle']; ?></td>
        </tr>
    <?php } ?>
      </table>
    
      <center>
      <input type="submit" style="display:none; background-color: #286090;border-color: #2e6da4;padding: 6px 12px;font-size: 14px;cursor: pointer;border: 1px solid transparent;border-radius: 4px; color:white;" id="submit" name="submit" value="View Exam" onclick="sendExamID()">
      <input type="submit" style="display:inline-block; position:relative;background-color: #5cb85c; border-color:#4cae4c; padding: 6px 12px; font-size: 14px; cursor: pointer; border: 1px solid transparent; border-radius: 4px; color: white;" id="submit" name="submit" value="Release Exam" onclick="releaseExamID()">
      <input type="submit" style="display:inline-block; position:relative;background-color: #d9534f; border-color:#d43f3a; padding: 6px 12px; font-size: 14px; cursor: pointer; border: 1px solid transparent; border-radius: 4px; color: white;" id="submit" name="submit" value="Delete Exam" onclick="deleteExamID()">
      </div>
      <br>
      <div id="status" style="display:block;"></div>
      <br>
      <center>

    <script>
      function showCreatedExams() {
        var x = document.getElementById('examTable');
        var btn = document.getElementById('submit');
        var status = document.getElementById('status');
        if (x.style.display === 'none') {
          x.style.display = 'block';
          btn.style.display = 'inline-block';
      } else {
          x.style.display = 'none';
          btn.style.display = 'none';
          status.style.display = 'none';
        }
      }
    </script>
    </div>

</body>