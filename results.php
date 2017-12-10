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
                    <p class="student-name">Results</p>
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
     <script>
function ReleaseScore()
    {
        var httpRequest = new XMLHttpRequest();
        var url = "frontReleaseScore.php";
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
  function ViewSubmittedExam()
  {
        var httpRequest = new XMLHttpRequest();
        var url = "frontViewSubmittedExam.php";
        var examid = document.getElementsByClassName("examID");
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
                document.getElementById("status1").innerHTML = return_data;
            }
        }

        var data = JSON.stringify(data);
        httpRequest.send(data);
  }
</script>
<script>
function viewStudentExam()
{
  
        var httpRequest = new XMLHttpRequest();
        var url = "test2.php";
        var examid = document.getElementsByClassName("examIDS");
        //var studentid = document.getElementById("studentid").value;
        var i;
        var ids = [];
        for(i=0; i < examid.length; i++)
        {
            if(examid[i].checked)
            {
              ids.push(parseInt(examid[i].id));
              var ucid = examid[i].getAttribute('data-product-id');
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
                document.getElementById("status3").innerHTML = return_data;
            }
        }

        var data = JSON.stringify(data);
        httpRequest.send(data);

}
</script>
<script>
    function releaseStudentScore()
    {
        var httpRequest = new XMLHttpRequest();
        var url = "frontReleaseStudentScore.php";
        var examid = document.getElementById("examIDSS");
        var ucid = document.getElementById("ucid").value;
        var question = document.getElementsByClassName("question");
        var points = document.getElementsByClassName("points");
        var i;
        var checkedBoxes = {};
        var questionid;
        var counter = 0;
        var totalPoints = 0;
        var scores = [];
        
        for(i=0; i < question.length; i++)
        {
            counter++;
            checkedBoxes[question[i].id] = 1;
        }
        
        for(i=0; i < points.length; i++)
        {
            questionid = points[i].getAttribute('data-product-id');
            if(checkedBoxes.hasOwnProperty(questionid))
            {
                checkedBoxes[questionid] = points[i].value;
                scores.push({
                    'qid': parseInt(questionid),
                    'pointsEarned': parseInt(checkedBoxes[questionid])
                });
                totalPoints += parseInt(checkedBoxes[questionid]);
            }
        }
        
        document.getElementById("totalScore").value = totalPoints;
        
        var data = {
            'examid': parseInt(examid.value),
            'ucid': ucid,
            'scores': scores
        };
        
        console.log(data);
        
        httpRequest.open("POST", url, true);
        
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        httpRequest.onreadystatechange = function()
        {
            if (httpRequest.readyState == 4 && httpRequest.status == 200)
            {
                var return_data = httpRequest.responseText;
                document.getElementById("status4").innerHTML = return_data;
            }
        }

        var data = JSON.stringify(data);
        httpRequest.send(data);

        
    }

</script>
<script>
    function addTotal()
    {
        var i;
        var checkedBoxes = {};
        var questionid;
        var counter = 0;
        var totalPoints = 0;
        var question = document.getElementsByClassName("question");
        var points = document.getElementsByClassName("points");
        
        for (i=0; i < question.length; i++)
        {
            counter++;
            checkedBoxes[question[i].id] = 1;
        }
        
        for(i=0; i < points.length; i++)
        {
            questionid = points[i].getAttribute('data-product-id');
            if(checkedBoxes.hasOwnProperty(questionid))
            {
                checkedBoxes[questionid] = points[i].value;
                totalPoints += parseInt(checkedBoxes[questionid]);
            }
        }
        
        document.getElementById("totalScore").value = totalPoints;
    }
</script>
    <?php

     /* CURL to the BACK END and RECEIVE DATA */
    $url = "https://web.njit.edu/~fl7/rc/backViewExamsNotScored.php";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    //echo $response;
    $response = json_decode($response, true);
?>

    <a href="#" onClick="showToReleaseExams()">Release Exams Scores</a>
    <br><br>
    <a href="#" onClick="showSubmittedExams()">Show Submitted Exams</a>
    <br><br>
      <div id="examTable" style="display:none">
      <table>
        <tr>
          <th></th>
          <th><strong>Exam Name</strong></th>
        </tr>
        <?php foreach(array_keys($response) as $key){ ?>
        <tr>
          <td><input type="radio" class="examid" style="display:block;" name="examidss" id=<?php echo $key;?>></td>
          <td><?php echo $response[$key]; ?></td>
        </tr>
      <?php } ?>
      </table>
      <center>
      <input type="submit" style="display:none; background-color: #286090;border-color: #2e6da4;padding: 6px 12px;font-size: 14px;cursor: pointer;border: 1px solid transparent;border-radius: 4px; color:white;" id="submit" name="submit" value="Release Score" onclick="ReleaseScore()">
      <br>
      <div id="status" style="display:block;"></div>
    </div>
<?php

     /* CURL to the BACK END and RECEIVE DATA */
    $url = "https://web.njit.edu/~fl7/rc/backSubmittedExamNames.php";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response2 = curl_exec($ch);
    curl_close($ch);
    //echo $response2;
    $response2 = json_decode($response2, true);
?>

    <div id="something" style="display:none;">
      <table>
        <tr>
          <th></th>
          <th><strong>Exam Name</strong></th>
        </tr>
      <?php 
        for($i=0; $i<sizeof($response2); $i++){
      ?>
      <tr>
          <td><input type="radio" class="examID" style="display:block;" name="examidsss" id=<?php echo $response2[$i]['examID'];?>></td>
          <td><?php echo $response2[$i]['examTitle']; ?></td>
        </tr>
    <?php } ?>
      </table>
      <center>
      <input type="submit" style="display:block; background-color: #286090;border-color: #286090;padding: 6px 12px;font-size: 14px;cursor: pointer;border: 1px solid transparent;border-radius: 4px; color:white;" id="button" name="button" value="View Submitted Exam" onclick="ViewSubmittedExam()">
      </center>
      <div id="status1" style="display:block;"></div>
      <br><br>
    </div>
    
    <script>
      function showToReleaseExams() {
        var x = document.getElementById('examTable');
        var btn = document.getElementById('submit');
        if (x.style.display === 'none') {
          x.style.display = 'block';
          btn.style.display = 'block';
      } else {
          x.style.display = 'none';
          btn.style.display = 'none';
        }
      }
    </script>
    <script>
    function showSubmittedExams()
    {
      var x = document.getElementById('examTable');
      var y = document.getElementById('something');
      if(y.style.display === 'none')
      {
        y.style.display = 'block';
        x.style.display = 'none';
      }
      else
      {
        y.style.display = 'none';
        x.style.display = 'none';
      }
    }
    </script>
    <div id="status3"></div>
</body>