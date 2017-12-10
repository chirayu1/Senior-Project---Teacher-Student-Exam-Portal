<?php
$data = file_get_contents("php://input");
//echo $data;
//echo "Hello World!";
/* CURL to the BACK END */


//$url = "https://web.njit.edu/~fl7/rc/test.php";
$url = "https://web.njit.edu/~fl7/rc/backViewGradedExam.php";


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
echo "<br>";
/* Exam Result Format */
echo '<fieldset id="examBox">';
echo '<div class="examTitle">';
echo "<strong>"."Exam Name: " . $response['examName']."</strong>";
echo '</div>';
echo "<br><br>";
echo "<strong>"."Max Score: ". $response['maxScore']."</strong>" . "<br>";
echo "<strong>"."Points Awarded: ".$response['pointsAwarded']."</strong>" ."<br>";

for($i=0; $i<sizeof($response['qArray']); $i++)
{
   echo "<br>";
   echo "<strong>"."Question ". $i. ": ".$response['qArray'][$i]['question']."</strong>";
   echo "<br><br>";
   echo "Your Answer: ".$response['qArray'][$i]['studentAnswer'];
   echo "<br><br>";
   echo "Correct Answer: ".$response['qArray'][$i]['answer'];
   echo "<br><br>";
   echo "Points Earned: ".$response['qArray'][$i]['pointsEarned'];
   echo "<br><br>";
   echo "Possible Score: ".$response['qArray'][$i]['possibleScore'];
   echo "<br><br>";
}


echo "</fieldset>";
echo "<br><br><br>";
?>