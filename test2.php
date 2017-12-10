<?php
  
$data = file_get_contents("php://input");
/* CURL to the BACK END */

$url = "https://web.njit.edu/~fl7/rc/backViewGradedExam.php";
//$url = "https://web.njit.edu/~fl7/test/echoReceived.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
//echo $response;
$response = json_decode($response, true);
//echo var_dump($response);
//echo $response;
/* Exam Result Format */
?>
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
<style>
    input[type=number]
    {
        width: 4%;
    }
</style>
<fieldset id="examBox">
  <input type="hidden" class="" id="examIDSS" value=<?php echo $response['examID']; ?>>
  <div><strong> Exam Name: <?php echo $response['examName']; ?> </strong></div>
  <br><br>
  <strong> Max Score: <?php echo $response['maxScore'];?> </strong><br>
  <strong> Points Awarded: <input type="number" id="totalScore" value=<?php echo $response['pointsAwarded']; ?>></strong><br>
<?php
for($i=0; $i<sizeof($response['qArray']); $i++)
{?>
   <br>
   <div><input type="hidden" class="question" id=<?php echo $response['qArray'][$i]['questionID']; ?>><strong> Question <?php echo $i; ?>: <?php echo $response['qArray'][$i]['question'];?></strong></div>
   <br>
   <div>Your Answer: <?php echo $response['qArray'][$i]['studentAnswer']; ?></div>
   <br>
   <div>Correct Answer: <?php echo $response['qArray'][$i]['answer']; ?></div>
   <br>
   <div>Points Earned: <input type="number" onkeyup="addTotal()" class="points" data-product-id=<?php echo $response['qArray'][$i]['questionID']; ?> value=<?php echo $response['qArray'][$i]['pointsEarned']; ?>></div>
   <br>
   <div>Possible Score: <?php echo $response['qArray'][$i]['possibleScore']; ?></div>
   <br>
<?php }?>


</fieldset>
<br>
<input type="hidden" id="ucid" value=<?php echo $response['ucid']; ?>>
<center>
<input type="submit" style="display:block; background-color: #673AB7; border-color:#673AB7; padding: 6px 12px; font-size: 14px; cursor: pointer; border: 1px solid transparent; border-radius: 4px; color: white;" id="submit" name="submit" value="Release Student Score" onClick="releaseStudentScore()">
</center>
<br><br>
<div id="status4" style="border: 1px solid black;padding: 5px;position: absolute;background-color: darkslateblue;color: white;font-size: 20px;border-radius: 5px;margin-bottom: 10px"></div>