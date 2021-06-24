<?php
session_start();
$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
if(isset($_POST["delete"]))
{
    $sql="select * from advquiz where quizcode='".$_POST["delete"]."'";
    $result=$conn->query($sql);
    while($row=$result->fetch_assoc())
    {   if(strlen($row["link"])>0)
        {
            chmod($row["link"], 0644);
            unlink($row["link"]);
        }
        
    }
    $deletesql="delete from advquiz where quizcode='".$_POST["delete"]."'";
    $conn->query($deletesql);
    ?>
            <script>
                window.history.back();
            </script>
    <?php
            die;
}
if(isset($_POST["result"]))
{
    $_SESSION["quizcode"]=$_POST["result"];
    header("Location:tmyquizresult.php");
}
if(!isset($_SESSION["registeredid"]))
{
    echo "please login";
    die;
}
else if(!isset($_SESSION["coursecode"]))
{
    echo "restart";
    die;
}
else
{
    $sql="SELECT distinct quizcode,title,status FROM advquiz WHERE coursecode= '".$_SESSION["coursecode"]."' and id=".$_SESSION["registeredid"];
    $result=$conn->query("$sql");
    $mytext="";
    while($row=$result->fetch_assoc())
    {
        
        if(isset($_POST["status"]) )
        {
            if($_POST["status"]==$row["quizcode"])
            {
            if($row["status"]==0)
            {
                $statussql="update advquiz set status=1 where quizcode='".$row["quizcode"]."'";
                $conn->query($statussql);
            }
            else
            {
                $statussql="update advquiz set status=0 where quizcode='".$row["quizcode"]."'";
                $conn->query($statussql);
            }
            ?>
            <script>
                window.history.back();
            </script>
            <?php
            die;
            }
            
        }
        
        
        
        if($row["status"]==1)
        {
            $srctext="quizon.png";
        }
        else
        {
            $srctext="quizoff.png";
        }
        $functiontext="editquiz('".$row["quizcode"]."')";
        $mytext=$mytext.'<div style="width:100%;height:200px;background-color:#efefef;border-bottom:2px solid orange;" ><button style="background-color:Transparent;outline:none;border:none;" type="submit" name="status" value="'.$row["quizcode"].'"><img src="../../images/'.$srctext.'" height="50px" width="50px"></button><div style="display:inline-block;vertical-align:top;float:right;margin:10px;"><i class="fa fa-lg fa-pencil-square-o" aria-hidden="true" onclick="'.$functiontext.'" style="padding:10px;"></i><button style="background-color:Transparent;outline:none;border:none;" name="delete" value="'.$row["quizcode"].'"><img src="../../images/delete1.png" height="30px" width="30px"></button></div><center><h2>'.$row["title"].'</h2><button style="color:green;" name="result" value="'.$row["quizcode"].'">Result</button></center></div><br>';
    }
}
?>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <body style="margin:0;padding:0;margin-bottom:50px;">
        <form method="post" action="">
        <?php echo $mytext; ?>
        </form>
        
        <div style="position:fixed;top:50px;width:80%;height:300px;background-color:white;left:10%;box-shadow: 10px 10px 8px #888888;display:none;margin-bottom:100px;" id="pop" >
            <img src="cross.png" height="30px" width="30px" style="position:absolute;top:5px;right:5px;" onclick="closepop()">
            <form style="margin-top:50px;" action="addnewquiz.php" method="post"><center>
                <input style="width:80%;height:50px;" placeholder="Title" name="title"><br><br>
                No of Questions: <input type="number" style="width:50px;height:50px;text-align:center;" name="totalq"><br><br>
                
                <button type="submit" name="addquiz" style="background-color:green;color:white;width:70%;height:50px;position:absolute;bottom:50px;left:15%;" id="mybutton">Add</button>
                </center>
            </form>
        </div>
        
            <button style="width:100%;position:fixed;height:50px;background-color:rgba(47,85,151,1);color:white;bottom:0;" onclick="openpop()">Add New Quiz</button>
        <script>
        window.onbeforeunload=function (){
            //document.getElementById("mybutton").style["display"]="none";
            document.body.style["filter"]="opacity(30%)";
            
        };
            function editquiz(quizcode)
            {
                window.open(("createquiz.php?quizcode="+quizcode),"_self");
            }
            function openpop()
            {
                document.getElementById("pop").style.display="block";
            }
            function closepop()
            {
                document.getElementById("pop").style.display="none";
            }
        </script>
    </body>
</html>

