<?php

$qdata = file_get_contents("php://input");
//echo $qdata;

/* Decode with JSON */
$questiondata = json_decode($qdata, true);

$qType = $questiondata{'selectType'};
$qbox = $questiondata{'questionbox'};
$ch1 = $questiondata{'choice1'};
$ch2 = $questiondata{'choice2'};
$ch3 = $questiondata{'choice3'};
$ch4 = $questiondata{'choice4'};
$ch5 = $questiondata{'choice5'};
$diff = $questiondata{'difficulty'};
$abox = $questiondata{'answerbox'};
$fb = $questiondata{'feedback'};

/*Connection with the database*/

//$conn = mysqli_connect("localhost", "root", "", "new2017") or die (mysqli_error());
$conn = mysqli_connect("sql2.njit.edu", "cp262", "qP7ApTGQ", "cp262") or die (mysqli_error());

/* To prevent from SQL INJECTION*/
$qType = mysqli_real_escape_string($conn, $qType);
$qbox = mysqli_real_escape_string($conn, $qbox);
$ch1 = mysqli_real_escape_string($conn, $ch1);
$ch2 = mysqli_real_escape_string($conn, $ch2);
$ch3 = mysqli_real_escape_string($conn, $ch3);
$ch4 = mysqli_real_escape_string($conn, $ch4);
$ch5 = mysqli_real_escape_string($conn, $ch5);
$diff = mysqli_real_escape_string($conn, $diff);
$abox = mysqli_real_escape_string($conn, $abox);
$fb = mysqli_real_escape_string($conn, $fb);

/* Select from questions table */
$query = mysqli_query($conn, "SELECT * FROM questions");
$exists = mysqli_num_rows($query);

$qType_db = "";
$qbox_db = "";
$ch1_db = "";
$ch2_db = "";
$ch3_db = "";
$ch4_db = "";
$ch5_db = "";
$diff_db = "";
$abox_db = "";
$fb_db = "";

if($exists >= 0)   // if num of rows is greater than or equal zero
{
    /* While row is grabs data from each row */
    while($row = mysqli_fetch_assoc($query)) 
    {
        $qType_db = $row['qType'];
        $qbox_db = $row['question'];
        $ch1_db = $row['ch1'];
        $ch2_db = $row['ch2'];
        $ch3_db = $row['ch3'];
        $ch4_db = $row['ch4'];
        $ch5_db = $row['ch5'];
        $diff_db = $row['difficulty'];
        $abox_db = $row['answer'];
        $fb_db = $row['feedback'];
    }
    /* If question already exists */
    if(($qType == $qType_db) || ($qbox == $qbox_db))
    {
        // Then echo Question aleady exists 
        //echo "<br>";
        echo "Question already exists! ";
    }
    // else 
    else
    {
        /* INSERT the data into the database*/
        $insert = "INSERT INTO questions (qType, question, ch1, ch2, ch3, ch4, ch5, difficulty, answer, feedback) VALUES ('$qType', '$qbox', '$ch1', '$ch2', '$ch3', '$ch4', '$ch5', '$diff', '$abox', '$fb')";

        /*Execute the query*/
        $query = mysqli_query($conn, $insert) or die (mysqli_error($conn));
        
        // echo Question has been saved!
        //echo "<br>";
        echo "Question has been saved!";

    }
}

?>