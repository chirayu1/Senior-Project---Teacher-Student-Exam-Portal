



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
input[type="text"]
{
  width: 30%;
  border-radius: 4px;
  padding: 5px;
  margin-left: 16px;
}
</style>
<?php
  /*$data = file_get_contents("php://input");
  echo $data;*/
  
$data = file_get_contents("php://input");
$data = json_encode($data);
/* CURL to the BACK END */

$url = "https://web.njit.edu/~fl7/rc/backGetExam.php";
//$url = "localhost/rc/backQuestion.php";

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
$examName = $response{'examName'};
echo '<fieldset id="examBox">';
echo '<div class="examTitle">';
echo '<strong>'."Exam Name: " . $examName . '</strong>';
echo '</div>';
echo "<br><br>";
for($i=0; $i < sizeof($response{'qArray'}); $i++){
$question = $response{'qArray'}[$i]{'question'};
$possibleScore = $response{'qArray'}[$i]{'possibleScore'};
$type = $response{'qArray'}[$i]{'type'};
$choice1 = $response{'qArray'}[$i]{'choice1'};
$choice2 = $response{'qArray'}[$i]{'choice2'};
$choice3 = $response{'qArray'}[$i]{'choice3'};
$choice4 = $response{'qArray'}[$i]{'choice4'};
$answer = $response{'qArray'}[$i]{'answer'};

if($type == 'mc')
{
  echo '<div class="testquestions">';
  echo '<div class="questionName"><strong>' . $i.". " . $question . " " . '(' . $possibleScore .' Points)</strong></div>'; 
  echo "<br>";
  
  echo '<input type="radio" name="same" value="">';
  echo '<label>'.$choice1.'</label>';
  echo "<br>";
  echo '<input type="radio" name="same">';
  echo '<label>'.$choice2.'</label>';
  echo "<br>";
  echo '<input type="radio" name="same">';
  echo '<label>'.$choice3.'</label>';
  echo "<br>";
  echo '<input type="radio" name="same">';
  echo '<label>'.$choice4.'</label>';
  echo "<br>";
  echo '<input type="radio" name="same">';
  echo '<label>'.$answer.'</label>';
  echo "<br>";
  echo '</div>';
}

if($type == 'tf')
{
  echo '<div class="testquestions">';
  echo '<div class="questionName"><strong>' . $i.". " . $question . " " . '(' . $possibleScore .' Points)</strong></div>';
  echo "<br>";
  
    echo '<input type="radio" name="same1" value="">';
    echo '<label>'.$choice1.'</label>';
    echo "<br>";
    echo '<input type="radio" name="same1" value="">';
    echo '<label>'.$choice2.'</label>'; 

  echo '</div>';
}

if($type == 'fitb')
{
  echo '<div class="testquestions">';
  echo '<div class="questionName"><strong>' . $i.". " . $question . " " . '(' . $possibleScore .' Points)</strong></div>';
  echo "<br>";
  echo '<input type="text" name="same2" value="" placeholder="Enter answer here..">';
  echo '</div>';
}
echo "<br><br><br>";
}
echo "</fieldset>";
echo "<br><br><br>";
?>