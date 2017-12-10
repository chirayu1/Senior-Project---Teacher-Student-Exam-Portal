<?php
  
$data = file_get_contents("php://input");
/* CURL to the BACK END */

//$url = "https://web.njit.edu/~fl7/rc/test.php";
$url = "https://web.njit.edu/~fl7/rc/backViewGradedExamNames.php";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
//echo $response;
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
<script>
function viewExamGrade()
{
        var httpRequest = new XMLHttpRequest();
        var url = "sendGrade.php";
        var examid = document.getElementsByClassName("examid");
        var ucid = document.getElementById("ucid").value;
        var i;
        var ids = [];
        for(i=0; i < examid.length; i++)
        {
            if(examid[i].checked)
            {
              ids.push(parseInt(examid[i].id));
            }
        }       
        
        var data = {
        'examid': ids,
        'ucid': ucid
        };
        console.log(data);
        
        httpRequest.open("POST", url, true);
        
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        httpRequest.onreadystatechange = function()
        {
            if (httpRequest.readyState == 4 && httpRequest.status == 200)
            {
                var return_data = httpRequest.responseText;
                document.getElementById("status").innerHTML = return_data;
            }
        }

        var data = JSON.stringify(data);
        httpRequest.send(data);
}
</script>
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
      <input type="submit" style="display:block; background-color: #673AB7; border-color:#673AB7; padding: 6px 12px; font-size: 14px; cursor: pointer; border: 1px solid transparent; border-radius: 4px; color: white;" id="submit" name="submit" value="View Grade" onclick="viewExamGrade()">
  </center>
  <br><br>