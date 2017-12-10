<?php
    ini_set('display_errors', 0);  // turn off error reporting
    $udata = file_get_contents("php://input");

    $userdata = json_decode($udata);
    $ucid = $userdata->{'ucid'};
    $pass = $userdata->{'pass'};
    $json = array();

    //echo $ucid;

    //$conn = mysqli_connect("localhost", "root", "", "newdb") or die (mysqli_error());
    //$conn = mysqli_connect("sql2.njit.edu", "cp262", "qP7ApTGQ", "cp262") or die(mysqli_error());
    $conn = mysqli_connect("sql2.njit.edu","fl7", "vwkVA7h9C", "fl7") or die(mysqli_error()); 
    
    $ucid = mysqli_real_escape_string($conn, $ucid);
    $pass = mysqli_real_escape_string($conn, $pass);

    $query = mysqli_query($conn, "SELECT * FROM Users WHERE ucid = '".$ucid."' AND pass = '".$pass."'");
    $exists = mysqli_num_rows($query);
    
    $db_user = "";
    $db_pass = "";
    $status = "";
    $first_name = "";
    $last_name = "";

    if($exists > 0)
    {
        while($row = mysqli_fetch_assoc($query))
        {
            
            $db_user = $row['ucid'];
            $db_pass = $row['pass'];
            $status = $row['status'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
        }
        
        if(($ucid == $db_user) && ($pass == $db_pass))
        {
            if(($ucid == $db_user) && ($pass == $db_pass) && ($status == "Instructor"))
            {
                $json = array(
                    'ucid' => $ucid,
                    'status' => $status,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'valid' => 'true'
                );
            }
            else if(($ucid == $db_user) && ($pass == $db_pass) && ($status == "Student"))
            {
                $json = array(
                    'ucid' => $ucid,
                    'status' => $status,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'valid' => 'true'
                );
            }
            else
            {
                $json = array(
                    'valid' => 'false'
                );
            }
            echo json_encode($json);
        }
    }

?>