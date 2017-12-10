  <?php
  
    $data = file_get_contents("php://input");
     /* CURL to the BACK END and RECEIVE DATA */
    $url = "https://web.njit.edu/~fl7/rc/backStudentsThatTookExam.php";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    //echo $response;
    $response = json_decode($response, true);
    //echo $response;
?>
<br>
 <table>
        <tr>
          <th></th>
          <th><strong>Last Name</strong></th>
          <th><strong>First Name</strong></th>
          <th><strong>Exam Name</strong></th>
        </tr>
      <?php 
        for($i=0; $i<sizeof($response{'studentArray'}); $i++){
      ?>
      <tr>
          <td><input type="radio" class="examIDS" style="display:block;" name="examids" data-product-id=<?php echo $response['studentArray'][$i]['ucid']; ?> id=<?php echo $response['examID'];?>></td>
          <td><?php echo $response['studentArray'][$i]['lname']; ?></td>
          <td><?php echo $response['studentArray'][$i]['fname']; ?></td>
          <td><?php echo $response['examName']; ?></td>
          <!--<input type="hidden" id="studentid" value=<?php echo $response['studentArray'][$i]['studentID']; ?>>-->
      </tr>
    <?php } ?>
</table>
<br>
<center>
<input type="submit" style="display:inline-block; position:relative;background-color: #5cb85c; border-color:#4cae4c; padding: 6px 12px; font-size: 14px; cursor: pointer; border: 1px solid transparent; border-radius: 4px; color: white;" id="submit" name="submit" value="View Student Submitted Exam" onclick="viewStudentExam()">
<center>