<?php
$sid = $_GET["username"];
echo "Welcome $sid";
session_id($sid);
session_start(); 
$_SESSION['usr']=$sid;
?>
<html>
<head>
  <title>Quick Chat</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<script>
function showHint(str)
{
    if (str.length == 0)
    { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    }
    else
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("txtHint1").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "suggestion1.php", true);
        xmlhttp.send();
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("txtHint2").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "suggestion2.php", true);
        xmlhttp.send();
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("txtHint3").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "suggestion3.php", true);
        xmlhttp.send();
    }
    if(event.keyCode == 13)
    {
		writeTxt();
	}
}
function runPhp()
{
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                document.getElementById("chatBox").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("POST", "chatLog.php", true);
        xmlhttp.send();
        
        setTimeout(runPhp, 1000);
}
function writeTxt()
{
    var xmlhttp = new XMLHttpRequest();
    var message = document.getElementById("textBox").value;
    xmlhttp.open("GET", "write.php?message=" + message, true);
    xmlhttp.send();
    document.getElementById("textBox").value = "";
}
function sendSuggestion(str)
{
    var xmlhttp = new XMLHttpRequest();
    var message = str;
    xmlhttp.open("GET", "write.php?message=" + message, true);
    xmlhttp.send();
    document.getElementById("textBox").value = "";
}
</script>
</head>
<body onload="runPhp()">
<div class="container">
  <div class="row">
    <div class="col-sm-4">
      <p id="chatBox" style="font-size: 150%;"></p></br>
    </div>
    <div class="col-sm-4">
      <p></p>
    </div>
    <div class="col-sm-4">
    <!-- ooooooooookkkkkkk -->
    </div>
  </div>
</div>
<p class="hints">Suggestions: <button id="txtHint1" onclick="sendSuggestion(this.innerHTML)" class="btn-primary"></button><button id="txtHint2" onclick="sendSuggestion(this.innerHTML)" class="btn-primary"></button><button id="txtHint3" onclick="sendSuggestion(this.innerHTML)" class="btn-primary"></button></p>
<input type="text" onkeyup="showHint(this.value)" id="textBox" autocomplete="off" class="col-lg-11 col-xs-10">
<button id="send" onclick="writeTxt()" class="btn-success col-lg-1 col-xs-2">Send</button>
</body>
</html>

