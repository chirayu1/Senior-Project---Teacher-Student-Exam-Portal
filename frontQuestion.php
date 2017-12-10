<!DOCTYPE html>
<html>
<head>
<script>
    function showQuestions(question)
    {
        if(question)
        {
            var numBox = document.getElementById("selectType");
            var inputType = numBox.options[numBox.selectedIndex].value;
            if(inputType == "")
            {
                document.getElementById("questionboxlabel").style.display = "none";
                document.getElementById("difficultylabel").style.display = "none";
                document.getElementById("difficulty").style.display = "none";
                document.getElementById("questionbox").style.display = "none";
                document.getElementById("choice1label").style.display = "none";
                document.getElementById("choice1").style.display = "none";
                document.getElementById("choice2label").style.display = "none";
                document.getElementById("choice2").style.display = "none";
                document.getElementById("choice3label").style.display = "none";
                document.getElementById("choice3").style.display = "none";
                document.getElementById("choice4label").style.display = "none";
                document.getElementById("choice4").style.display = "none";
                //document.getElementById("choice5label").style.display = "none";
                //document.getElementById("choice5").style.display = "none";
                document.getElementById("answerboxlabel").style.display = "none";
                document.getElementById("answerbox").style.display = "none";
                 //document.getElementById("feedbacklabel").style.display = "none";
                //document.getElementById("feedback").style.display = "none";
                document.getElementById("button").style.display = "none";
                document.getElementById("status").style.display = "none";
                //document.getElementById("box").style.position = '';
                //document.getElementById("box").style.marginTop = '0px';
            }
            
            if(inputType == "mc")
            {
                document.getElementById("questionboxlabel").style.display = "block";
                document.getElementById("difficultylabel").style.display = "block";
                document.getElementById("difficulty").style.display = "block";
                document.getElementById("questionbox").style.display = "block";
                document.getElementById("choice1label").style.display = "block";
                document.getElementById("choice1").style.display = "block";
                document.getElementById("choice2label").style.display = "block";
                document.getElementById("choice2").style.display = "block";
                document.getElementById("choice3label").style.display = "block";
                document.getElementById("choice3").style.display = "block";
                document.getElementById("choice4label").style.display = "block";
                document.getElementById("choice4").style.display = "block";
                //document.getElementById("choice5label").style.display = "block";
                //document.getElementById("choice5").style.display = "block";
                document.getElementById("answerboxlabel").style.display = "block";
                document.getElementById("answerbox").style.display = "block";
                //document.getElementById("feedbacklabel").style.display = "block";
                //document.getElementById("feedback").style.display = "block";
                document.getElementById("button").style.display = "block";
                //document.getElementById("box").style.position = 'relative';
                //document.getElementById("box").style.marginTop = '-889px';
                
            }
            
            if(inputType == "tf")
            {
                document.getElementById("questionboxlabel").style.display = "block";
                document.getElementById("difficultylabel").style.display = "block";
                document.getElementById("difficulty").style.display = "block";
                document.getElementById("questionbox").style.display = "block";
                document.getElementById("choice1label").style.display = "none";
                document.getElementById("choice1").style.display = "none";
                document.getElementById("choice2label").style.display = "none";
                document.getElementById("choice2").style.display = "none";
                document.getElementById("choice3label").style.display = "none";
                document.getElementById("choice3").style.display = "none";
                document.getElementById("choice4label").style.display = "none";
                document.getElementById("choice4").style.display = "none";
                document.getElementById("answerboxlabel").style.display = "block";
                document.getElementById("answerbox").style.display = "block";
                //document.getElementById("feedbacklabel").style.display = "block";
                //document.getElementById("feedback").style.display = "block";
                document.getElementById("button").style.display = "block";
                //document.getElementById("box").style.position = 'relative';
                //document.getElementById("box").style.marginTop = '-889px';
            }
            
            if(inputType == "fitb")
            {
                document.getElementById("questionboxlabel").style.display = "block";
                document.getElementById("difficultylabel").style.display = "block";
                document.getElementById("difficulty").style.display = "block";
                document.getElementById("questionbox").style.display = "block";
                document.getElementById("choice1label").style.display = "none";
                document.getElementById("choice1").style.display = "none";
                document.getElementById("choice2label").style.display = "none";
                document.getElementById("choice2").style.display = "none";
                document.getElementById("choice3label").style.display = "none";
                document.getElementById("choice3").style.display = "none";
                document.getElementById("choice4label").style.display = "none";
                document.getElementById("choice4").style.display = "none";
                document.getElementById("answerboxlabel").style.display = "block";
                document.getElementById("answerbox").style.display = "block";
                //document.getElementById("feedbacklabel").style.display = "block";
                //document.getElementById("feedback").style.display = "block";
                document.getElementById("button").style.display = "block";
                //document.getElementById("box").style.position = 'relative';
                //document.getElementById("box").style.marginTop = '-879px';
            }
        }
    }
    
    function sendData()
    {
        {
        var httpRequest = new XMLHttpRequest();
        var url = "processQuestion.php";
        var selectType = document.getElementById("selectType").value;
        var qbox = document.getElementById("questionbox").value;
        var choice1 = document.getElementById("choice1").value;
        var choice2 = document.getElementById("choice2").value;
        var choice3 = document.getElementById("choice3").value;
        var choice4 = document.getElementById("choice4").value;
        //var choice5 = document.getElementById("choice5").value;
        var diff = document.getElementById("difficulty").value;
        var abox = document.getElementById("answerbox").value;
        //var feedback = document.getElementById("feedback").value;
        var data = "selectType="+selectType+"&questionbox="+qbox+"&choice1="+choice1+"&choice2="+choice2+"&choice3="+choice3+"&choice4="+choice4+"&difficulty="+diff+"&answerbox="+abox;
        
        httpRequest.open("POST", url, true);
        
        httpRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        httpRequest.onreadystatechange = function()
        {
            if (httpRequest.readyState == 4 && httpRequest.status == 200)
            {
                var return_data = httpRequest.responseText;
}               document.getElementById("status").innerHTML = return_data;
            }
        }
        
        httpRequest.send(data);
    }
    


</script>
<style>
    fieldset
    {
        width: 45%;
        background-color: #c4fff1;
        position: absolute;
        margin-bottom: 10px;
        margin-left: -40px;
    }
    
    textarea
    {
        width: 520px;
        height: 200px;
    }
    
    input, label, textarea 
    {
        display: none;
    }
    
    div#status
    {
      position:absolute;
      //margin-right:480px;
      margin-top: 40px;
      border: 1px solid black;
      font-size: 20px;
      padding: 10px;
      background-color: darkslateblue;
      color: white;
      border-radius: 5px;
      margin-bottom: 10px;
      width: 97%;
      margin-left: -14px;
    }
    input#button
    {
      background-color: #5cb85c; 
      border-color:#4cae4c; 
      padding: 6px 12px; 
      font-size: 14px; 
      cursor: pointer; border: 
      1px solid transparent; 
      border-radius: 4px; 
      color: white;
    }
</style>
</head>
<body>
   <fieldset>
       <label for="selectTypelabel" style="display: block;">Select the type of question you would like to add: </label>
       <br>
       <select id="selectType" name="selectType" onchange="showQuestions(this);">
           <option value=""></option>
           <option value="mc">Multiple Choice</option>
           <option value="tf">True and False</option>
           <option value="fitb">Fill in the Blank</option>
       </select>
       <br><br>
       <select id="difficulty" name="difficulty" style="display:none; float:right; margin-right: 61px;">
           <option value="easy">Easy</option>
           <option value="medium">Medium</option>
           <option value="hard">Hard</option>
       </select>
       <label for="difficultylabel" id="difficultylabel" style="float:right; margin-right: 3px;">Difficulty: </label>
       <label for="questionboxlabel" id="questionboxlabel">Question: </label>
       <br><br>
       <textarea id="questionbox" name="questionbox" placeholder="Enter your question here..."></textarea>
       <br>
       <label for="choice1label" id="choice1label">Choice 1: </label>
       <br>
       <input type="text" id="choice1" name="choice1" placeholder="Choice 1">
       <br>
       <label for="choice2label" id="choice2label">Choice 2: </label>
       <br>
       <input type="text" id="choice2" name="choice2" placeholder="Choice 2">
       <br>
       <label for="choice3label" id="choice3label">Choice 3: </label>
       <br>
       <input type="text" id="choice3" name="choice3" placeholder="Choice 3">
       <br>
       <label for="choice4label" id="choice4label">Choice 4: </label>
       <br>
       <input type="text" id="choice4" name="choice4" placeholder="Choice 4">
       <br>
       <label for="answerboxlabel" id="answerboxlabel">Correct Answer: </label>
       <br>
       <textarea id="answerbox" name="answerbox" placeholder="Enter your answer here..."></textarea>
       <br>
       <input type="button" id="button" name="button" value="Create a Question" onClick="sendData()">
       <div id="status"></div>
    </fieldset>
    <!--<div id="status"></div>-->
    <br><br>
    <br><br>
    <div id="box">  
    <?php include("frontqBank.php"); ?>
    </div>
</body>
</html>