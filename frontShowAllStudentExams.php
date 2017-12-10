<?php

/* CURL to the BACK END */
$data = file_get_contents("php://input");
//echo $data;

$url = "https://web.njit.edu/~fl7/rc/backGetReleasedExamName.php";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
//echo $response;
echo "<br>";
$response = json_decode($response, true);
?>
<style>
table {
        border-collapse: collapse;
        width: 100%;
        margin: 1px;
        margin-bottom: 10px;
    }
    
    th {
        border: 1px solid #dddddd;
        text-align: center;
        padding: 8px;
    }
    
    td {
        
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    
    tr:nth-child(even){
        background-color: #dddddd;
    }
</style>

<br><br>
    <div id="examTable" style="display:block">
    <table>
        <tr>
          <th></th>
          <th><strong>Exam Name</strong></th>
        </tr>
        <?php for($i=0; $i < sizeof($response); $i++){?>
        <tr>
          <td><input type="radio" class="examid" style="display:block;" name="examids" id=<?php echo $response[$i]['examID'];?>></td>
          <td><?php echo $response[$i]['examTitle']; ?></td>
        </tr>
        <?php } ?>
    </table>
  </div>
  <br>
  <center>
      <input type="submit" style="display:block; background-color: #286090;border-color: #2e6da4;padding: 6px 12px;font-size: 14px;cursor: pointer;border: 1px solid transparent;border-radius: 4px; color:white;" id="submit" name="submit" value="Take Exam" onclick="takeExamID()">
  </center>
<?php
  
?>