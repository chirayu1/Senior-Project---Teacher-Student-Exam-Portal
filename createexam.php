<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Instructor Dashboard</title>
  <link rel="stylesheet" type="text/css" href="css/dashboard.css">
  <meta charset="UTF-8">
  <style>

    h1 {
        margin: 15px;
        padding: 5px;
    }
    div#status {
      border: 1px solid black;
      padding: 10px;
      position: absolute;
      //margin-top: 30px;
      background-color: darkslateblue;
      color: white;
      font-size: 20px;
      border-radius: 5px;
    }
    
    input#button
    {
      margin-top: 15px;
      margin-left:150px;
      background-color: #3F51B5; 
      border-color:#3F51B5; 
      padding: 6px 12px; 
      font-size: 14px; 
      cursor: pointer; border: 
      1px solid transparent; 
      border-radius: 4px; 
      color: white;
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
        <p class="student-name">Create an Exam</p>
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
    <fieldset style="background-color: #388E3C;float: left;padding: 20px;width: 35%;height: 71px;border: 1px solid transparent;border-radius: 4px;border-color: #388E3C;">
        <div id="nameExam">
          <label for="nameExam" style="color:white; font-family:cursive;">Name the Exam:</label>
          <input type="text" name="examName" id="examName">
        </div>
    </fieldset>
  </div>
  <!-- AJAX Code -->
<script>
function sendData()
    {
        var httpRequest = new XMLHttpRequest();
        var url = "frontExamProcess.php";
        var examName = document.getElementById("examName").value;
        var question = document.getElementsByClassName("question");
        var points = document.getElementsByClassName("points");
        var i;
        var counter = 0;
        //var arr = [];
        var scores = [];
        var questionid;
        var checkedBoxes = {};
        
        for(i=0; i < question.length; i++)
        {
            if(question[i].checked)
            {
              counter++;
              checkedBoxes[question[i].id] = 1;
            }
        }        
        
        for(i=0; i < points.length; i++) {
            questionid = points[i].getAttribute('data-product-id');
            if(checkedBoxes.hasOwnProperty(questionid))
            {
              checkedBoxes[questionid] = points[i].value;
              scores.push({
                'qid': parseInt(questionid),
                'points': parseInt(checkedBoxes[questionid])
                });
            }
        }
        
        
        var data = {
        "examName":examName,
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
                document.getElementById("status").innerHTML = return_data;
            }
        }
        var data = JSON.stringify(data);
        httpRequest.send(data);
    }
    
</script>

   
<!--Question bank-->

<!DOCTYPE html>
<html>
    <head></head>
<?php

     /* CURL to the BACK END and RECEIVE DATA */
    $url = "https://web.njit.edu/~fl7/rc/backqBank.php";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
<head></head>
<style>
    .box{
        border: 1px solid black;
        float: right;
        width: 48%;
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
    
    form {
        float: right;        
    }
    input[type="text"]{
        margin-left: 5px;
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
    
    h1 {
        text-align: center;
    }
    input[type="number"]
    {
      width: 36px;
    }
    
    #selectedBox
    {
      border: 1px solid black;
      float: left;
      position: absolute;
      height: 90px;
      width: 30%;
        
    }
    
    </style>
    
<body>
<script>
/*function add()
{
  var fieldset = document.getElementById("selectedBox");
  var question = document.getElementsByClassName("question");
  for(i =0; i < question.length; i++)
  {
    if(question[i].checked)
    {
      //document.getElementById("selectedBox").appendChild(question[i].value);
      fieldset.style.display = 'block'; 
    }
  }
}*/
</script>
<script>
    function searchTable() {
    var input; 
    var filter; 
    var found; 
    var table; 
    var tr; 
    var td; 
    var i; 
    var j;
    
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("questionTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            if(tr[i].id != 'tableHeader')
            {
                tr[i].style.display = "none";
            }
            
        }
    }
}
</script>
<div class="box">
  <h1>Question Bank
  <div>
    <input id="searchInput" onkeyup="searchTable()" type="text" placeholder="Search..." style="display: inline-block;">
  </div>
  </h1>
      <table id="questionTable">
        <tr id="tableHeader">
          <th></th>
          <th><strong>Question</strong></th>
          <th><strong>Type</strong></th>
          <th><strong>Difficulty</strong></th>
          <th><strong>Points</strong></th>
      </tr>
<?php 
    for($i=0; $i<sizeof($response); $i++){
?>
        <tr>
          <td><input type="checkbox" style="display:block;" value="<?php echo $response[$i]['question']; ?>" class="question" id=<?php echo $response[$i]['questionID'];?>></td>
          <td><?php echo $response[$i]['question']; ?></td>
          <td><?php echo $response[$i]['type']; ?></td>
          <td><?php echo $response[$i]['difficulty'];?></td>
          <td><input type="number" value="" class="points" data-product-id=<?php echo $response[$i]['questionID'];?>></td>
          <!--<td><input type="button" style="background-color: #5cb85c;border-color: #5cb85c;padding: 6px 12px;font-size: 14px;cursor: pointer;border: 1px solid transparent;border-radius: 4px; color:white;" value="Add" onClick="add()"></td>-->
          <!--<td><input type="button" style="background-color: #d9534f;border-color: #d9534f;padding: 6px 12px;font-size: 14px;cursor: pointer;border: 1px solid transparent;border-radius: 4px; color:white;" value="Delete"></td>-->
        </tr>
<?php } ?>
      </table>
</div>
</html>

<div>
    <input id="button" type="submit" name="submit" onClick="sendData()" value="Create Exam" style="padding: 10px; margin-top: 15px; margin-left: 155px;">
</div>
<br><br>
<div id="status"></div><br><br><br>
<fieldset style="display:none;" id="selectedBox"></fieldset>     
</body>