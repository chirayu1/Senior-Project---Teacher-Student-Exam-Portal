function showFunctionType(){
        var selectBox = document.getElementById("functiontype");
        var userInput = selectBox.options[selectBox.selectedIndex].value;
        if (userInput == 'num'){
            document.getElementById('numberfunctions').style.visibility='visible';
            document.getElementById("stringMethod").style.display = 'none';
            document.getElementById("stringName").style.display = 'none';
            document.getElementById("button").style.visibility = 'hidden';
        }
        else {
            document.getElementById('numberfunctions').style.visibility='hidden';
            document.getElementById('vartype').style.visibility='hidden';
            document.getElementById("Var1").style.display = "none";
            document.getElementById("Var2").style.display = "none";
            document.getElementById("Var3").style.display = "none";
            document.getElementById("Var4").style.display = "none";
            document.getElementById("displayText").style.display = "none";
            document.getElementById("subText").style.display = "none";
            document.getElementById("multiplyText").style.display = "none";
            document.getElementById("divideText").style.display = "none";
            document.getElementById("numVars").style.visibility='hidden';
            document.getElementById("button").style.visibility = 'hidden';
        }
        if (userInput == 'string'){
            document.getElementById('strfunctions').style.visibility='visible';
            document.getElementById("displayText").style.display = "none";
            document.getElementById("subText").style.display = "none";
            document.getElementById("multiplyText").style.display = "none";
            document.getElementById("divideText").style.display = "none";
            document.getElementById("numVars").style.visibility='hidden';
            document.getElementById("button").style.visibility = 'hidden';
        }    
        else {
            document.getElementById('strfunctions').style.visibility='hidden';
            document.getElementById("stringMethod").style.display = 'none';
            document.getElementById("stringName").style.display = 'none';
            document.getElementById("numVars").style.visibility='hidden';
            document.getElementById("Var1").style.display = "none";
            document.getElementById("Var2").style.display = "none";
            document.getElementById("Var3").style.display = "none";
            document.getElementById("Var4").style.display = "none";
            document.getElementById("begidx").style.display = 'none';
            document.getElementById("endidx").style.display = 'none';
            document.getElementById("button").style.visibility = 'hidden';
        }      
    }

        function addFunction(option)
        {
            if(option){
                var input = document.getElementById("addfunction").value;
                if(input == 'add'){
                    document.getElementById("displayText").style.display = "block";
                    document.getElementById("vartype").style.visibility='visible';
                }
                else {
                    document.getElementById("displayText").style.display = "none";
                    document.getElementById("vartype").style.visibility='hidden';
                    document.getElementById("numVars").style.visibility='hidden';
                    document.getElementById("Var1").style.display = "none";
                    document.getElementById("Var2").style.display = "none";
                    document.getElementById("Var3").style.display = "none";
                    document.getElementById("Var4").style.display = "none";
                    document.getElementById("button").style.visibility = "hidden";
                }
                if(input == 'sub'){
                    document.getElementById("subText").style.display = "block";
                    document.getElementById("vartype").style.visibility='visible';
                }
                else {
                    document.getElementById("subText").style.display = "none";
                    document.getElementById("vartype").style.visibility='none';
                }
                if(input == 'mult'){
                    document.getElementById("multiplyText").style.display = "block";
                    document.getElementById("vartype").style.visibility='visible';
                }
                else {
                    document.getElementById("multiplyText").style.display = "none";
                    document.getElementById("vartype").style.visibility='none';
                }
                if(input == 'divide'){
                    document.getElementById("divideText").style.display = "block";
                    document.getElementById("vartype").style.visibility='visible';
                }
                else {
                    document.getElementById("divideText").style.display = "none";
                    document.getElementById("vartype").style.visibility='none';
                }
            }
            else {
                document.getElementById("displayText").style.display = "none";
                document.getElementById("vartype").style.visibility='hidden';
                document.getElementById("numVars").style.visibility='hidden';
                document.getElementById("Var1").style.display = "none";
                document.getElementById("Var2").style.display = "none";
                document.getElementById("Var3").style.display = "none";
                document.getElementById("Var4").style.display = "none";
                document.getElementById("button").style.visibility = "hidden";
            }
        }
    
        function showVarType()
        {
            var varTypeBox = document.getElementById("vartype1");
            var varInput = varTypeBox.options[varTypeBox.selectedIndex].value;
            if (varInput == 'int' || varInput == 'double' || varInput == 'float' || varInput == 'char') {

                document.getElementById("numVars").style.visibility='visible';
            }
            else {
                document.getElementById("numVars").style.visibility='hidden';
                document.getElementById("Var1").style.display = "none";
                document.getElementById("Var2").style.display = "none";
                document.getElementById("Var3").style.display = "none";
                document.getElementById("Var4").style.display = "none";
                document.getElementById("button").style.visibility = 'hidden';
            }
        }    

        function showNumVars(number)
        {
            if(number){
                var numBox = document.getElementById("numSelect");
                var numInput = numBox.options[numBox.selectedIndex].value;
                if(numInput == '0' || numInput == ''){
                    document.getElementById("Var1").style.display = "none";
                    document.getElementById("Var2").style.display = "none";
                    document.getElementById("Var3").style.display = "none";
                    document.getElementById("Var4").style.display = "none";
                    document.getElementById("button").style.visibility = 'hidden';
                }
                else {
                    document.getElementById("Var1").style.display = "none";
                    document.getElementById("Var2").style.display = "none";
                    document.getElementById("Var3").style.display = "none";
                    document.getElementById("Var4").style.display = "none"; 
                    document.getElementById("button").style.visibility = 'hidden';
                }
                if(numInput == '1'){
                    document.getElementById("Var1").style.display = "block";
                    document.getElementById("button").style.visibility = 'visible';
                }
                if(numInput == '2'){
                    document.getElementById("Var1").style.display = "block";
                    document.getElementById("Var2").style.display = "block";
                    document.getElementById("button").style.visibility = 'visible';
                }
                if(numInput == '3'){
                    document.getElementById("Var1").style.display = "block";
                    document.getElementById("Var2").style.display = "block";
                    document.getElementById("Var3").style.display = "block";
                    document.getElementById("button").style.visibility = 'visible';
                }
                if(numInput == '4'){
                    document.getElementById("Var1").style.display = "block";
                    document.getElementById("Var2").style.display = "block";
                    document.getElementById("Var3").style.display = "block";
                    document.getElementById("Var4").style.display = "block";
                    document.getElementById("button").style.visibility = 'visible';
                }
            }
        }
    
        function showStringInput(stringOption)
        {
            if(stringOption){
                var stringBox = document.getElementById("strxfunctions");
                var stringInput = stringBox.options[stringBox.selectedIndex].value;
                if(stringInput == ''){
                    document.getElementById("stringMethod").style.display = 'none';
                    document.getElementById("stringName").style.display = 'none';
                    document.getElementById("numVars").style.visibility = 'hidden';
                    document.getElementById("begidx").style.display = 'none';
                    document.getElementById("endidx").style.display = 'none';
                    document.getElementById("Var1").style.display = "none";
                    document.getElementById("Var2").style.display = "none";
                    document.getElementById("Var3").style.display = "none";
                    document.getElementById("Var4").style.display = "none";
                    document.getElementById("button").style.visibility = 'hidden';
                }
                if(stringInput == 'length'){
                    document.getElementById("stringMethod").style.display = "block";
                    document.getElementById("stringName").style.display = 'block';
                    document.getElementById("numVars").style.visibility = 'hidden';
                    document.getElementById("begidx").style.display = 'none';
                    document.getElementById("endidx").style.display = 'none';
                    document.getElementById("Var1").style.display = "none";
                    document.getElementById("Var2").style.display = "none";
                    document.getElementById("Var3").style.display = "none";
                    document.getElementById("Var4").style.display = "none";
                    document.getElementById("button").style.visibility = 'visible';
                }
                if(stringInput == 'concat'){
                    document.getElementById("stringMethod").style.display = 'block';
                    document.getElementById("numVars").style.visibility = 'visible';
                    document.getElementById("stringName").style.display = 'none';
                    document.getElementById("begidx").style.display = 'none';
                    document.getElementById("endidx").style.display = 'none';
                    document.getElementById("button").style.visibility = 'hidden';
                }
                if(stringInput == 'substring'){
                    document.getElementById("stringMethod").style.display = 'block';
                    document.getElementById("stringName").style.display = 'block';
                    document.getElementById("begidx").style.display = 'block';
                    document.getElementById("endidx").style.display = 'block';
                    document.getElementById("numVars").style.visibility = 'hidden';
                    document.getElementById("Var1").style.display = "none";
                    document.getElementById("Var2").style.display = "none";
                    document.getElementById("Var3").style.display = "none";
                    document.getElementById("Var4").style.display = "none";
                    document.getElementById("button").style.visibility = 'visible';
                }
            }
        }