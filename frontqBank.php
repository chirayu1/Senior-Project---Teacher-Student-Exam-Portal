<?php

     /* CURL to the BACK END and RECEIVE DATA */
    $url = "https://web.njit.edu/~fl7/rc/backqBank.php";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($response, true);
?>

<!DOCTYPE html>
<html>
<head></head>
<style>
    .box{
        border: 1px solid black;
        float: right;
        width: 45%;
        margin-bottom: 10px;
        max-height: 600px;
        //margin-right: -85px;
        overflow-y: scroll;
        margin-top: -72px;
        
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin: 1px;
        margin-bottom: 10px;
    }
    
    form {
        float: right;        
    }
    input[type="text"]{
        margin-left: 5px;
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
    
    h1 {
        text-align: center;
    }
  
    </style>
<script>
    function searchTable() {
    var input; 
    var filter; 
    var found; 
    var table; 
    var tr; 
    var td; 
    var i; 
    var j;
    
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("questionTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
            if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                found = true;
            }
        }
        if (found) {
            tr[i].style.display = "";
            found = false;
        } else {
            if(tr[i].id != 'tableHeader')
            {
                tr[i].style.display = "none";
            }
            
        }
    }
}
</script>    
<body>
<div class="box">
  <h1>Question Bank
  <div>
    <input id="searchInput" onkeyup="searchTable()" type="text" placeholder="Search..." style="display: inline-block;">
  </div>
  </h1>
      <table id="questionTable">
        <tr id="tableHeader">
          <th></th>
          <th><strong>Question</strong></th>
          <th><strong>Type</strong></th>
          <th><strong>Difficulty</strong></th>
      </tr>
<?php 
    for($i=0; $i<sizeof($response); $i++){
?>
        <tr id=<?php echo $response[$i]['questionID'];?> >
          <td><input type="checkbox" style="display:block;"></td>
          <td><?php echo $response[$i]['question']; ?></td>
          <td><?php echo $response[$i]['type']; ?></td>
          <td><?php echo $response[$i]['difficulty'];?></td>
          <!--<td><input type="button" style="display:inline-block; position:relative;background-color: #d9534f; border-color:#d43f3a; padding: 6px 12px; font-size: 14px; cursor: pointer; border: 1px solid transparent; border-radius: 4px; color: white;" id="submit" name="submit" value="Remove" onclick=""</td>-->
        </tr>
<?php } ?>
      </table>
</div>
</html>