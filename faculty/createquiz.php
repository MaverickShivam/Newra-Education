<?php
session_start();
if(!isset($_GET["quizcode"]) and isset($_SESSION["quizcode"]))
{
    $_GET["quizcode"]=$_SESSION["quizcode"];
}
if(!isset($_SESSION["registeredid"]))
{
    echo "please login";
    die;
}
else if(!isset($_SESSION["coursecode"]) or !isset($_GET["quizcode"]))
{
    echo "restart";
    die;
}

else
{
    $_SESSION["quizcode"]=$_GET["quizcode"];
    $conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
    $sql="SELECT * FROM advquiz WHERE quizcode= '".$_GET["quizcode"]."'";
    $result=$conn->query($sql);
    $mytext="";
    while($row=$result->fetch_assoc())
    {
    
        if(strlen($row["link"])<1)
        {
           $imagetext='<input type="file" name="'.$row["quizcode"].'file'.$row["qno"].'" accept="image/*" >'; 
        }
        else
        {
            $imagetext='<input type="file" name="'.$row["quizcode"].'file'.$row["qno"].'" accept="image/*" >'."<img src='".$row["link"]."' height='auto' width=98%>";
        }
        $mytext=$mytext.'<center><div style="width:90%;height:auto;background-color:#abebc6;padding-bottom:30px;border:2px solid black;"><div style="padding:2px;width:99%;height:20px;background-color:black;color:white; "><b>'."Qno. ".$row["qno"].'</b></div><br>'.$imagetext.'<br><br><textarea style="width:90%;height:150px;" name="'.$row["qno"]."qtext".'">'.$row["qtext"].'</textarea><br><br><div style="display:inline;">1. </div><div style="display:inline;"><textarea style="width:80%;" name="'.$row["qno"]."op1".'">'.$row["option1"].'</textarea></div><br><div style="display:inline;">2. </div><div style="display:inline;"><textarea style="width:80%;"  name="'.$row["qno"]."op2".'">'.$row["option2"].'</textarea></div><br><div style="display:inline;">3. </div><div style="display:inline;"><textarea style="width:80%;" name="'.$row["qno"]."op3".'">'.$row["option3"].'</textarea></div><br><div style="display:inline;">4. </div><div style="display:inline;"><textarea style="width:80%;" name="'.$row["qno"]."op4".'">'.$row["option4"].'</textarea></div><br>   <div style="margin-top:20px;"><div style="width:49%;display:inline;padding:30px;">Time:<input style="width:50px;height:20px;" type="number" value='.$row["time"].' name="'.$row["qno"]."time".'"></div><div style="width:49%;display:inline;padding:30px;">Correct:<input style="width:50px;height:20px;" type="number" value='.$row["answer"].' name="'.$row["qno"]."answer".'"></div></div>  </div></center><br><br>';
    }
    
}
?>
<html>
    <style>
    html,body {
    margin:0;
    padding:0;
    margin-bottom:25px;
    }
    textarea{
        resize:none;
    }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <body>
        <form method="post" action="upload.php" enctype="multipart/form-data">
            <br>
        <?php echo $mytext; ?>
        <button style="width:100%;height:50px;background-color:orange;color:white;position:fixed;bottom:0;border:none;outline:none;" type="submit" name="submit" id="update" onclick="pleasewait()">Update</button>
        </form>
        <script>
            window.onbeforeunload=function (){
            document.body.style["filter"]="opacity(30%)";
        };
            window.addEventListener( "pageshow", function ( event ) {
  var historyTraversal = event.persisted || 
                         ( typeof window.performance != "undefined" && 
                              window.performance.navigation.type === 2 );
  if ( historyTraversal ) {
    // Handle page restore.
    window.location.reload();
  }
});
            function pleasewait()
            {
                document.getElementById("update").innerHTML="Please Wait";
            }
        </script>
    </body>
</html>