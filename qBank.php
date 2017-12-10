<?php

//$conn = mysqli_connect('localhost', 'root', '', 'new2017') or die(mysql_error());
$conn = mysqli_connect("sql2.njit.edu", "cp262", "qP7ApTGQ", "cp262") or die(mysqli_error());
?>

<?php
    $sql = "SELECT * FROM questions";

if(isset($_POST['search']))
{
    $search_term = mysqli_real_escape_string($conn, $_POST['search_box']);
    if($search_term == '')
    {
    }
    else
    {
        $sql .= " WHERE difficulty = '{$search_term}'";
        $sql .= " OR question = '{$search_term}'";
        $sql .= " OR qType = '{$search_term}'";
    }
}

$query = mysqli_query($conn, $sql) or die(mysql_error());
//if($query->num_rows > 0)
//{

?>
<!DOCTYPE html>
<html>
    <head></head>
    <style>
    .box{
        border: 1px solid black;
        float: right;
        width: 46%;
        margin-bottom: 10px;
        max-height: 600px;
        margin-right: -80px;
        overflow-y: scroll;
        margin-top: -471px;
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
<div class="box">
    <h1>Question Bank</h1>
    <form name="search_form" method="POST" action="create-question.php">
        <input type="text" name="search_box" value="" placeholder="Search" style="display:inline-block;">
        <input type="submit" name="search" value="Search" style="display:inline-block;">
    </form>
<table>
    <tr>
        <th></th>
        <th><strong>ID</strong></th>
        <th><strong>Question</strong></th>
        <th><strong>Type</strong></th>
        <th><strong>Difficulty</strong></th>
    </tr>
<?php while($row = mysqli_fetch_array($query))
{?>
    <tr>
        <td><input type="checkbox" style="display:block;"></td>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['question']; ?></td>
        <td><?php echo $row['qType']; ?></td>
        <td><?php echo $row['difficulty']; ?></td>
    </tr>
    
<?php } ?>

</table>
</div>
</html>
<?php
//}
$conn->close();

?>