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
<?php echo "<strong>"."Exam Name: " . $examName . "</strong>";?>
</div>
<br><br>
<?php
for($i=0; $i < sizeof($response{'qArray'}); $i++){
$question = $response{'qArray'}[$i]{'question'};
$possibleScore = $response{'qArray'}[$i]{'possibleScore'};
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
  <div class="question" id="<?php echo $questionID;?>" value="<?php echo $question; ?>"><strong><?php echo $i . ". " . $question;?> (<?php echo $possibleScore;?> Points)</strong></div><br>
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
  <div class="question" id="<?php echo $questionID;?>" value="<?php echo $question; ?>"><strong><?php echo $i . ". " . $question;?> (<?php echo $possibleScore;?> Points)</strong></div><br>
  <input type="hidden" class="questionID" value="<?php echo $questionID;?>">

    <input type="radio" data-question="<?php echo $questionID;?>" class="choices" name="choice<?php echo $questionID;?>" value="<?php echo $choice1; ?>">
    <label><?php echo $choice1; ?></label>
    <br>
    <input type="radio" data-question="<?php echo $questionID;?>" class="choices" name="choice<?php echo $questionID;?>" value="<?php echo $choice2; ?>">
    <label><?php echo $choice2; ?></label>
  
  
  </div>
<?php } ?>

<?php if($type == 'fitb')
{?>
  <div class="testquestions">
  <div class="question" id="<?php echo $questionID;?>" value="<?php echo $question; ?>"><strong><?php echo $i . ". " . $question;?> (<?php echo $possibleScore;?> Points)</strong></div><br>
  <input type="hidden" class="questionID" value="<?php echo $questionID;?>">
  <input type="text" data-question="<?php echo $questionID;?>" class="choices" name="choice<?php echo $questionID;?>" value="" placeholder="Enter answer here..">
  </div>
<?php } ?>
<br><br><br>
<?php }?>
</fieldset>

<br><br>
<center>
<input type="submit" style="background-color: #5cb85c; border-color:#4cae4c; padding: 6px 12px; font-size: 14px; cursor: pointer; border: 1px solid transparent; border-radius: 4px; color: white;" value="Submit Exam" onClick="submitExam()">
<input type="hidden" id="ucid" value="<?php echo $ucid; ?>">
</center>
<br><br>
<div id="status"></div>
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