<?php

session_start();
$_SESSION["ucid"] = $ucid;

?>

<style>
#examBox
{
  padding: 20px;
  margin-right: 80px;
  margin-left: 80px;
}

.examTitle
{
  padding: 10px;
  text-align: left;
}

.testquestions
{
  text-align: left;
}
</style>


<?php
  $data = file_get_contents("php://input");
  $data = json_encode($data);
  /* CURL to the BACK END */

  $url = "https://web.njit.edu/~fl7/rc/backGetExam.php";
  //$url = "https://web.njit.edu/~fl7/rc/test.php";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);
  //echo $response;
  $response = json_decode($response, true);
  echo "<br>";
  /* Exam Format */
$examName = $response{'examName'};
$examID = $response{'examID'};?>
<fieldset id="examBox">
<input type="hidden" id="examTitle" value="<?php echo $examID;?>">
<?php echo "Exam Name: " . $examName;?>
</div>
<br><br>
<?php
for($i=0; $i < sizeof($response); $i++){
$question = $response{'qArray'}[$i]{'question'};
$type = $response{'qArray'}[$i]{'type'};
$choice1 = $response{'qArray'}[$i]{'choice1'};
$choice2 = $response{'qArray'}[$i]{'choice2'};
$choice3 = $response{'qArray'}[$i]{'choice3'};
$choice4 = $response{'qArray'}[$i]{'choice4'};
$answer = $response{'qArray'}[$i]{'answer'};
$questionID = $response{'qArray'}[$i]{'questionID'}; 
//echo var_dump($response{'qArray'});
if($type == 'mc')
{?>
  <div class="testquestions">
  <div class="question" id="<?php echo $questionID;?>" value="<?php echo $question; ?>"><?php echo $question; ?></div><br>
  <input type="radio" data-question="<?php echo $questionID;?>" class="choices" name="choice<?php echo $questionID;?>" value="<?php echo $choice1; ?>">
  <label><?php echo $choice1; ?></label>
  <br>
  <input type="radio" data-question="<?php echo $questionID;?>" class="choices" name="choice<?php echo $questionID;?>" value="<?php echo $choice2; ?>">
  <label><?php echo $choice2; ?></label>
  <br>
  <input type="radio" data-question="<?php echo $questionID;?>" class="choices" name="choice<?php echo $questionID;?>" value="<?php echo $choice3; ?>">
  <label><?php echo $choice3; ?></label>
  <br>
  <input type="radio" data-question="<?php echo $questionID;?>" class="choices" name="choice<?php echo $questionID;?>" value="<?php echo $choice4; ?>">
  <label><?php echo $choice4; ?> </label>
  <br>
  <input type="radio" data-question="<?php echo $questionID;?>" class="choices" name="choice<?php echo $questionID;?>" value="<?php echo $answer; ?>">
  <label><?php echo $answer; ?></label>
  <br>
  </div>
<?php } ?>
<?php
if($type == 'tf')
{?>
  <div class="testquestions">
  <div class="question" id="<?php echo $questionID;?>" value="<?php echo $question; ?>"><?php echo $question; ?></div><br>
  <input type="hidden" class="questionID" value="<?php echo $questionID;?>">
  <?php if($answer == 'true')
  {?>
    
    <input type="radio" data-question="<?php echo $questionID;?>" class="choices" name="choice<?php echo $questionID;?>" value="<?php echo $choice1; ?>">
    <label><?php echo $choice1; ?></label>
    <input type="radio" data-question="<?php echo $questionID;?>" class="choices" name="choice<?php echo $questionID;?>" value="<?php echo $answer; ?>">
    <label><?php echo $answer; ?></label>
  <?php } ?>
  <?php if($answer == 'false')
  {?>
    <input type="radio" data-question="<?php echo $questionID;?>" class="choices" name="choice<?php echo $questionID;?>" value="<?php echo $choice1; ?>">
    <label><?php echo $choice1; ?></label>
    <input type="radio" data-question="<?php echo $questionID;?>" class="choices" name="choice<?php echo $questionID;?>" value="<?php echo $answer; ?>">
    <label><?php echo $answer; ?></label>
   
  <?php } ?>
  </div>
<?php } ?>

<?php if($type == 'fitb')
{?>
  <div class="testquestions">
  <div class="question" id="<?php echo $questionID;?>" value="<?php echo $question; ?>"><?php echo $question; ?></div><br>
  <input type="hidden" class="questionID" value="<?php echo $questionID;?>">
  <br><br>
  <input type="text" data-question="<?php echo $questionID;?>" class="choices" name="choice<?php echo $questionID;?>" value="" placeholder="Enter answer here..">
  </div>
<?php } ?>
<br><br><br>
<?php }?>
</fieldset>

<br><br>
<center>
<input type="submit" value="Submit Exam" onClick="submitExam()">
<input type="hidden" id="ucid" value="<?php echo $ucid; ?>">
</center>
<br><br>
<div id="status"></div>
<script>
function submitExam()
{
  var answers={};
  document.querySelectorAll(".choices").forEach(function(choice){
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
  

  console.log(JSON.stringify(answers));
        // var httpRequest = new XMLHttpRequest();
        // var url = "test2.php";
        // var examid = document.getElementById("examTitle").value;
        // var choices = document.getElementsByClassName("choices");
        // var questionID = document.getElementsByClassName("questionID");
        // var ucid = document.getElementById("ucid").value;
        // var i;
        // var answer = [];
        // var qid = [];
        // for(j = 0; j < questionID.length; j++)
        // {
        //     qid.push(parseInt(questionID[j].value));
        // }
        
        // for(i=0; i < choices.length; i++)
        // {
        //     if(choices[i].type == 'radio')
        //     {
        //         if(choices[i].checked)
        //         {
        //             answer.push((choices[i].value))
        //         }
        //     }
        //     if(choices[i].type == 'text')
        //     {
        //         answer.push((choices[i].value))
        //     }
        // }
    
        // var json = {qid:qid, answer: answer};
        // console.log(json);
        
        // var data = {
        // 'examid': examid,
        // 'ucid':ucid,
        // 'json':json,
        // 'answers': answer,
        // 'qid':qid
        // };
        // console.log(data);
        
        // httpRequest.open("POST", url, true);
        // //we set this header so the server will know that this is json
        // httpRequest.setRequestHeader("Content-type", "application/json");
        
        // httpRequest.onreadystatechange = function()
        // {
        //     if (httpRequest.readyState == 4 && httpRequest.status == 200)
        //     {
        //         var return_data = httpRequest.responseText;
        //         document.getElementById("status").innerHTML = return_data;
        //     }
        // }

        // var data = JSON.stringify(data);
        // httpRequest.send(data);
}
</script>