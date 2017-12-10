<?php

/* CURL to the BACK END */
$data = file_get_contents("php://input");
//echo $data;

//$url = "https://web.njit.edu/~fl7/rc/test.php";
$url = "https://web.njit.edu/~fl7/rc/backReleaseScore.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
echo $response;