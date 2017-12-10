<?php
session_start();

/* Data sent from index.html */
/* IF ucid and pass are set and not empty */

if((isset($_POST['ucid'])) && (!empty($_POST['ucid'])) && (isset($_POST['pass'])) && (!empty($_POST['pass'])))
{   
    $ucid = $_POST['ucid'];
    $pass = $_POST['pass'];
    
    /* Store the POST data into an array */
    
    $userdata = array(
        'ucid' => $ucid,
        'pass' => $pass
    );
    
    // ENCODE DATA WITH JSON
    
    $udata = json_encode($userdata);
    
    /* CURL to the MIDDLE END */
    
    //$url = "localhost/beta/middleLogin.php";
    $url = "https://web.njit.edu/~fl7/rc/middleLogin.php";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $udata);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;
    $response = json_decode($response, true);
    $valid = $response['valid'];
    $status = $response['status'];
    $ucid = $response['ucid'];
    $first_name = $response['first_name'];
    $last_name = $response['last_name'];
    
    if($valid == 'true')
    {
        $_SESSION["first_name"] = $first_name;
        $_SESSION["last_name"] = $last_name;
        $_SESSION["status"] = $status;
        $_SESSION["ucid"] = $ucid;
        
        if($status == 'Instructor')
        {
        
            header("Location: teacher.php");
        }
        else
        {
            header("Location: students.php");
        }
    }
    else
    {
        header("Location: index.html");
        echo '<script>alert("Failed")</script>';
    }
}
else
{
    echo '<script>alert("Variables are not set!")</script>';
}
?>