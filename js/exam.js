function showQuestions(questions){
    if(questions){
        var numBox = document.getElementById("numofQuestions");
        var numInput = numBox.options[numBox.selectedIndex].value;
        if(numInput == '' || numInput == '0'){
            document.getElementById("exambox").style.visiblity = 'hidden';
            document.getElementById("questionbox").style.visibility = 'hidden';
            document.getElementById("box1").style.display = 'none';
            document.getElementById("box2").style.display = 'none';
            document.getElementById("box3").style.display = 'none';
            document.getElementById("box4").style.display = 'none';
            document.getElementById("button").style.visibility = 'hidden';
        }
        if(numInput == '1'){
            document.getElementById("exambox").style.visiblity = 'visible';
            document.getElementById("questionbox").style.visibility = 'visible';
            document.getElementById("box1").style.display = 'block';
            document.getElementById("box2").style.display = 'none';
            document.getElementById("box3").style.display = 'none';
            document.getElementById("box4").style.display = 'none';
            document.getElementById("button").style.visibility = 'visible';
        }
        if(numInput == '2'){
            document.getElementById("exambox").style.visiblity = 'visible';
            document.getElementById("questionbox").style.visibility = 'visible';
            document.getElementById("box1").style.display = 'block';
            document.getElementById("box2").style.display = 'block';
            document.getElementById("box3").style.display = 'none';
            document.getElementById("box4").style.display = 'none';
            document.getElementById("button").style.visibility = 'visible';
        }
        if(numInput == '3'){
            document.getElementById("exambox").style.visiblity = 'visible';
            document.getElementById("questionbox").style.visibility = 'visible';
            document.getElementById("box1").style.display = 'block';
            document.getElementById("box2").style.display = 'block';
            document.getElementById("box3").style.display = 'block';
            document.getElementById("box4").style.display = 'none';
            document.getElementById("button").style.visibility = 'visible';
        }
        if(numInput == '4'){
            document.getElementById("exambox").style.visiblity = 'visible';
            document.getElementById("questionbox").style.visibility = 'visible';
            document.getElementById("box1").style.display = 'block';
            document.getElementById("box2").style.display = 'block';
            document.getElementById("box3").style.display = 'block';
            document.getElementById("box4").style.display = 'block';
            document.getElementById("button").style.visibility = 'visible';
        }
    }
}
function dragStart(event) {
    event.dataTransfer.setData("Text", event.target.id);
}

function allowDrop(event) {
    event.preventDefault();
}

function drop(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("Text");
    event.target.appendChild(document.getElementById(data));
}