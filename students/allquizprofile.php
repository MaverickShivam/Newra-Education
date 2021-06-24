<?php
session_start();
if(!isset($_SESSION["registeredusn"]) or !isset($_SESSION["coursecode"]))
{
    echo "something went wrong";
    die;
}
if(isset($_POST["start"]))
{
    $_SESSION["quizcode"]=$_POST["start"];
    header("Location:myquiz.php");
    die;
}
$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
$sql="SELECT distinct quizcode,title,status FROM advquiz WHERE coursecode= '".$_SESSION["coursecode"]."' and status=1;";
$result=$conn->query($sql);
$mytext="";
while($row=$result->fetch_assoc())
{
    $durationsql="select sum(time) from advquiz where quizcode='".$row["quizcode"]."'";
    $durationresult=$conn->query($durationsql);
    $durationrow=$durationresult->fetch_assoc();
    $duration=$durationrow["sum(time)"];
    $mytext=$mytext."<button style='width:100%;height:100px;outline:none;border:none;background-color:#efefef;border-bottom:2px solid orange;padding-top:5px;text-align:center;' name='start' value='".$row["quizcode"]."'>".$row["title"]."<br><br>Time: ".round($duration/60)." minutes</button><br><br>";
}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="theme-color" content="#132743" />
    </head>
    
    <body style="margin:0;padding:0;margin-bottom:30px;">
    <div style="width:100%;height:50px;background-color:rgba(47,85,151,1);color:white;text-align:left;">
        <div style="padding-top:15px;padding-left:20px;"><i class="fa fa-arrow-left" style="margin:0px 20px 0px 5px;" onclick="goback()"></i>Online Exam</div>
    </div>
    <br>
    <br>
        <form action="" method="post">
        <?php echo $mytext; ?>
        </form>
        <script>
        window.onbeforeunload=function (){
            document.body.style["filter"]="opacity(30%)";
        };
        function goback()
        {
            window.history.back();
        }
        </script>
    </body>
</html>