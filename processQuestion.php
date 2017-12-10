<?php
$qdata = file_get_contents("php://input");

//echo $qdata;
$type = $_POST['selectType'];
$qbox = $_POST['questionbox'];
$ch1 = $_POST['choice1'];
$ch2 = $_POST['choice2'];
$ch3 = $_POST['choice3'];
$ch4 = $_POST['choice4'];
//$ch5 = $_POST['choice5'];
$diff = $_POST['difficulty'];
$abox = $_POST['answerbox'];
//$fb = $_POST['feedback'];

/*if($type == '')
{
    $type = "";
    $qbox = "";
    $ch1 = "";
    $ch2 = "";
    $ch3 = "";   
    $ch4 = "";
    $ch5 = "";
    $diff = "";
    $abox = "";
}*/


if($type == 'tf')
{
    $ch1 = "";
    $ch2 = "";
    $ch3 = "";
    $ch4 = "";
    //$ch5 = "";
}

if($type == 'fitb')
{
    $ch1 = "";
    $ch2 = "";
    $ch3 = "";
    $ch4 = "";
    //$ch5 = "";
}

$data = array(
    'selectType' => $type,
    'questionbox' => $qbox,
    'choice1' => $ch1,
    'choice2' => $ch2,
    'choice3' => $ch3,
    'choice4' => $ch4,
    'difficulty' => $diff,
    'answerbox' => $abox
);

$data = json_encode($data);
//echo $data;

/* CURL to the BACK END */

$url = "https://web.njit.edu/~fl7/rc/backQuestion.php";
//$url = "localhost/rc/backQuestion.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
echo $response;