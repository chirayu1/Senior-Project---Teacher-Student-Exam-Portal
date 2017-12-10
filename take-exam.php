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
        .sidebar{
            position: fixed;
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
                    <p class="student-name">TAKE AN EXAM</p>
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
    <script>
function sendStudentExamID()
    {
        var httpRequest = new XMLHttpRequest();
        var url = "frontSendStudentExamID.php";
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
    </style>
  <div class="sub-headerx">
    <?php
  session_start();
  $ucid = $_SESSION["ucid"];
  
?>
    <a href="#" onclick="showAllExams()" style="cursor: pointer;">Show Exams</a>
   
      
    <script>
      /*function showAllExams() {
        var x = document.getElementById('examTable');
        var btn = document.getElementById('submit');
        if (x.style.display === 'none') {
          x.style.display = 'block';
          btn.style.display = 'block';
      } else {
          x.style.display = 'none';
          btn.style.display = 'none';
        }
      }*/
      
      function showAllExams()
    {
        var httpRequest = new XMLHttpRequest();
        var url = "frontShowAllStudentExams.php";
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
function takeExamID()
{
        var httpRequest = new XMLHttpRequest();
        var url = "frontTakeExamID.php";
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
/*function submitExam()
{
    var httpRequest = new XMLHttpRequest();
    var url = "test4.php";
    var examid = document.getElementById("examTitle").value;
    var choices = document.getElementsByClassName("choices");
    var questionID = document.getElementsByClassName("questionID");
    var ucid = document.getElementById("ucid").value;
    var i;
    var answer = [];
    var qid = [];
    for(j=0; j < questionID.length; j++)
    {
        qid.push(parseInt(questionID[j].value));
    }
    
    for(i=0; i < choices.length; i++)
    {
        if(choices[i].type == 'radio')
        {
            if(choices[i].checked)
            {
                answer.push((choices[i].value))
            }
        }
        if(choices[i].type == 'text')
        {
            answer.push((choices[i].value))
        }
    }
    
    var json = {qid:qid, answer:answer};
    console.log(json);
    
    var data = {
        'examid': examid,
        'ucid':ucid,
        'json': json,
        'answers': answer,
        'qid': qid
    };
    console.log(data);
    
    httpRequest.open("POST", url, true);
    httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    httpRequest.onreadystatechange = function()
    {
        if(httpRequest.readyState == 4 && httpRequest.status == 200)
        {
            var return_data = httpRequest.responseText;
            document.getElementById("status").innerHTML = return_data;
        }
    }
    
    var data = JSON.stringify(data);
    httpRequest.send(data);
    
}*/
</script>
<script>
function submitExam()
{
  var answers={};
  var elems=document.querySelectorAll(".choices")
  console.log(elems.length)
  elems.forEach(function(choice){
    console.log(choice.getAttribute("type").toLowerCase())
    if(choice.getAttribute("type").toLowerCase()=="text"){
      //text input
      answers[choice.getAttribute("data-question")]=choice.value
    }else{
      //radio
      theAnswer=answers[choice.getAttribute("data-question")];
      if(theAnswer)return//if theres an answer already dont do anything
      else if(choice.checked){
        answers[choice.getAttribute("data-question")]=choice.value;
      }
      else answers[choice.getAttribute("data-question")]=""
      
    }
  });
  
var theResult={
  ucid:document.getElementById("ucid").value,
  examId:document.getElementById("examTitle").value,
  results:answers
}

  console.log(JSON.stringify(theResult));
  
  
  
  var httpRequest = new XMLHttpRequest();
        var url = "test4.php"
        httpRequest.open("POST", url, true);
        // //we set this header so the server will know that this is json
        httpRequest.setRequestHeader("Content-type", "application/json");
        httpRequest.onload=function(){
          //this is easier way to do it without checking status or ready state
          var return_data = httpRequest.responseText;
          document.getElementById("status").innerHTML = return_data;
          
        }
        httpRequest.send(JSON.stringify(theResult));
}
</script>

    <input type="hidden" id="ucid" value=<?php echo $ucid;?>>
     <div id="status" style="display:block"></div> 
  </div>  
  
 
  

  </div>   
</body>