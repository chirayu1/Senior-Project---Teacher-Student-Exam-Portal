<?php
    
    /* Receiving data from frontLogin.php */
    $udata = file_get_contents("php://input");
    
    //echo $udata;

    /* CURL to the BACK END */

    //$url = "localhost/beta/backLogin.php";
    $url = "https://web.njit.edu/~cp262/rc/backLogin.php";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $udata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;
?>