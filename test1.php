<?php
  session_start();
  $ucid = $_SESSION["ucid"];
  
?>
    <a href="#" onclick="showAllExams()" style="cursor: pointer;">Show Exams</a>
   
      
    <script>
      /*function showAllExams() {
        var x = document.getElementById('examTable');
        var btn = document.getElementById('submit');
        if (x.style.display === 'none') {
          x.style.display = 'block';
          btn.style.display = 'block';
      } else {
          x.style.display = 'none';
          btn.style.display = 'none';
        }
      }*/
      
      function showAllExams()
    {
        var httpRequest = new XMLHttpRequest();
        var url = "frontShowAllStudentExams.php";
        var ucid = document.getElementById("ucid").value;
        var data = {
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
    <script>
function takeExamID()
{
        var httpRequest = new XMLHttpRequest();
        var url = "frontTakeExamID.php";
        var examid = document.getElementsByClassName("examid");
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
        'examid': ids
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
    <input type="hidden" id="ucid" value=<?php echo $ucid;?>>
    
  </div>  
  
  <div id="status" style="display:block"></div> 
  
