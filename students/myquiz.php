<?php
session_start();
$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
if(!isset($_SESSION["registeredusn"]))
{
    die;
}

else
{
    $resultsql="select count(*) from quizresult where quizcode='".$_SESSION["quizcode"]."' and usn='".$_SESSION["registeredusn"]."';";
    $resultresult=$conn->query($resultsql);
    $resultrow=$resultresult->fetch_assoc();
    if($resultrow['count(*)']>0)
    {
        ?>
        <script>
            window.history.back(alert("Test already submitted..."));
        </script>
        <?php
        die;
    }
    $sql="select * from advquiz where quizcode='".$_SESSION["quizcode"]."' order by rand()";
    $result=$conn->query($sql);
    $alllinks=[];
    $alltexts=[];
    $alloption1=[];
    $alloption2=[];
    $alloption3=[];
    $alloption4=[];
    $allqno=[];
    $alltimers=[];
    $i=-1;
    while($row=$result->fetch_assoc())
    {
        if($row["status"]==0)
        {
            echo "Quiz has been Ended by teacher";
            die;
        }
        $i=$i+1;
        $alllinks[$i]=$row["link"];
        $alltexts[$i]=$row["qtext"];
        $alloption1[$i]=$row["option1"];
        $alloption2[$i]=$row["option2"];
        $alloption3[$i]=$row["option3"];
        $alloption4[$i]=$row["option4"];
        $allqno[$i]=$row["qno"];
        $alltimers[$i]=$row["time"];
    }
 
}
?>
<!DOCTYPE html>
<html>
<style>
#myProgress {
  width: 100%;
  background-color: white;
  border-bottom:1px solid gray;
  position:fixed;
  top:0;
}

#myBar {
  width: 1%;
  height: 15px;
  background-color: #4CAF50;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<body style="margin:0;padding:0;" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div id="myProgress">
  <div id="myBar"></div>
</div>

<form method="post" action="myquizresult.php">
<?php
$mytext="";
for ($x=0;$x<=$i;$x++)
{
    if(strlen($alllinks[$x])>1)
    {
    $mytext=$mytext.'<div style="height:60%;width:100%;background-color:white;position:fixed;top:15px;left:-2px;display:none;" id="divqno'.$allqno[$x].'"><img  src="../faculty/'.$alllinks[$x].'" width="100%" height="auto" id="image" style="max-height:80%;"><div height="15%" width="100%" style="padding:2px;" id="qtext">'.$alltexts[$x].'</div></div>';
    }
    else
    {
        $mytext=$mytext.'<div style="height:60%;width:100%;background-color:white;position:fixed;top:15px;left:-2px;display:none" id="divqno'.$allqno[$x].'"><div height="15%" width="100%" style="padding:2px;" id="qtext">'.$alltexts[$x].'</div></div>';
    }
}
echo $mytext;
?>




<?php
$mytext="";
for ($x=0;$x<=$i;$x++)
{
$mytext=$mytext.'<div style="height:40%;width:100%;position:fixed;bottom:10px;background-color:#d0e0e3;border-top:2px solid black; display:none" id="divopno'.$allqno[$x].'"><br><div style="width:100%;border-bottom:2px solid white;" onclick="firstoption()" ><input type="checkbox" style="height:25px;width:25px;margin-left:10px;"id="'.$allqno[$x].'op1" name="'.$allqno[$x].'op1" onclick="firstoption()"><label style="height:25px;position:absolute;margin-top:1px;font-size:14px;" id="op1text">'.$alloption1[$x].'</label></div><br><div style="width:100%;border-bottom:2px solid white;" onclick="secondoption()"><input type="checkbox" style="height:25px;width:25px;margin-left:10px;" id="'.$allqno[$x].'op2" name="'.$allqno[$x].'op2" onclick="secondoption()"><label style="height:25px;position:absolute;margin-top:1px;font-size:14px;" id="op2text">'.$alloption2[$x].'</label></div><br><div style="width:100%;border-bottom:2px solid white;" onclick="thirdoption()"><input type="checkbox" style="height:25px;width:25px;margin-left:10px;" id="'.$allqno[$x].'op3" name="'.$allqno[$x].'op3" onclick="thirdoption()"><label style="height:25px;position:absolute;margin-top:1px;font-size:14px;" id="op3text">'.$alloption3[$x].'</label></div><br><div style="width:100%;border-bottom:2px solid white;" onclick="fourthoption()"><input type="checkbox" style="height:25px;width:25px;margin-left:10px;" id="'.$allqno[$x].'op4" name="'.$allqno[$x].'op4" onclick="fourthoption()"><label style="height:25px;position:absolute;margin-top:1px;font-size:14px;" id="op4text">'.$alloption4[$x].'</label></div><center><div style="width:100%;height:5%;background-color:black;color:white;position:fixed;bottom:0;padding:3px;" onclick="nextquestion()">Next</div></center></div>';
}
echo $mytext;
?>
<center>
<div style="width:80%;height:70%;background-color:lightgray;display:none;position:fixed;top:15%;left:10%;box-shadow: 10px 10px 8px 10px #888888;" id="popup">
    <img src="timeover.png" height="50%" width="80%">
    <br><br>
    <button type="submit" style="background-color:green;color:white;width:80%;height:10%;border:none;" onclick="pleasewait()" id="submit">Submit</button>
</div>
</center>
</form>


<script>
document.body.onblur=function(){
           alert("cheated");
       };


var allqno=<?php echo json_encode($allqno); ?>;
var alltimers=<?php echo json_encode($alltimers); ?>;
window.onbeforeunload = function (e) {
                var message = "Are you sure ?";
                var firefox = /Firefox[\/\s](\d+)/.test(navigator.userAgent);
                if (firefox) {
                    //Add custom dialog
                    //Firefox does not accept window.showModalDialog(), window.alert(), window.confirm(), and window.prompt() furthermore
                    var dialog = document.createElement("div");
                    document.body.appendChild(dialog);
                    dialog.id = "dialog";
                    dialog.style.visibility = "hidden";
                    dialog.innerHTML = message;
                    var left = document.body.clientWidth / 2 - dialog.clientWidth / 2;
                    dialog.style.left = left + "px";
                    dialog.style.visibility = "visible";
                    var shadow = document.createElement("div");
                    document.body.appendChild(shadow);
                    shadow.id = "shadow";
                    //tip with setTimeout
                    setTimeout(function () {
                        document.body.removeChild(document.getElementById("dialog"));
                        document.body.removeChild(document.getElementById("shadow"));
                    }, 0);
                }
                return message;
            };




function pleasewait()
{
    document.getElementById("submit").innerHTML="Please Wait";
}




var myinterval;
var tquestions=<?php echo $i; ?>;
var i=-1
function nextquestion()
{
    clearTimeout(myinterval);
    if(i<tquestions)
    {
        i=i+1;
        
    start();
    if(i>0)
    {
        document.getElementById("divqno"+allqno[(i-1)]).style.display="none";
        document.getElementById("divopno"+allqno[(i-1)]).style.display="none";
    }
    document.getElementById("divqno"+allqno[(i)]).style.display="block";
    document.getElementById("divopno"+allqno[(i)]).style.display="block";
    myinterval=window.setTimeout(nextquestion,(alltimers[i]*1000));
    
    }
    else
    {
        document.getElementById("divqno"+allqno[(tquestions)]).style.display="none";
        document.getElementById("divopno"+allqno[(tquestions)]).style.display="none";
        
        document.getElementById("myProgress").style.display="none";
        window.onbeforeunload=null;
        document.getElementById("popup").style.display="block";
    }
}
nextquestion();





var elem = document.getElementById("myBar");
var timer;
var width;
function move() 
{
  var now=new Date().getTime();
  if(width >= now)
  {
      elem.style.width = (((width-now)/(alltimers[i]*10))) + "%";
  }
  else
  {
      width=0;
      clearInterval(timer);
  }
  
}
function start()
{
    clearInterval(timer);
    width=parseInt(new Date().getTime())+parseInt(alltimers[i]*1000);
    timer=window.setInterval(move,100);
}


    
function firstoption()
{
    document.getElementById((allqno[i]+"op1")).checked=!document.getElementById((allqno[i]+"op1")).checked;
    document.getElementById((allqno[i]+"op2")).checked=false
    document.getElementById((allqno[i]+"op3")).checked=false;
    document.getElementById((allqno[i]+"op4")).checked=false;
}
function secondoption()
{
    document.getElementById(allqno[i]+"op1").checked=false;
    document.getElementById(allqno[i]+"op2").checked=!document.getElementById(allqno[i]+"op2").checked;
    document.getElementById(allqno[i]+"op3").checked=false;
    document.getElementById(allqno[i]+"op4").checked=false;
}
function thirdoption()
{
    document.getElementById(allqno[i]+"op1").checked=false;
    document.getElementById(allqno[i]+"op2").checked=false;
    document.getElementById(allqno[i]+"op3").checked=!document.getElementById(allqno[i]+"op3").checked;
    document.getElementById(allqno[i]+"op4").checked=false;
}
function fourthoption()
{
    
    document.getElementById(allqno[i]+"op1").checked=false;
    document.getElementById(allqno[i]+"op2").checked=false;
    document.getElementById(allqno[i]+"op3").checked=false;
    document.getElementById(allqno[i]+"op4").checked=!document.getElementById(allqno[i]+"op4").checked;
}

    
repeat();
window.setInterval(repeat,1000);
function repeat()
{
        if (window.navigator.onLine) {
            
            document.getElementById("submit").style["background-color"] ="green";
            document.getElementById("submit").disabled=false;
            
        }
        else
        {
            document.getElementById("submit").style["background-color"] ="red";
            document.getElementById("submit").disabled=true;
        }
        
}
</script>

</body>
</html>
