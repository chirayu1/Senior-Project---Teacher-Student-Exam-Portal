<?php

$data = file_get_contents("php://input");
$data = json_encode($data);
/* CURL to the BACK END */

$url = "https://web.njit.edu/~fl7/rc/backReleaseExam.php";
//$url = "localhost/rc/backQuestion.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
echo $response;

?>