<?php
session_start();
if(!isset($_SESSION["registeredusn"]))
{
    ?>
    <script>
        window.open("studentlogin.html","_self");
    </script>
    <?php
}
$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
if(isset($_GET["coursecode"]))
{
    $_SESSION["coursecode"]=strtoupper($_GET["coursecode"]);
    header("Location:scourseprofile.php");
    die;
}
?>
<html>
    <head>
        <style>
            table, th, td {
              border: 1px solid black;
              border-collapse: collapse;
            }
            th, td {
              padding: 15px;
              text-align: left;
            }
        </style>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="theme-color" content="#132743" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    </head>
    
<body style="margin:0;padding:0;">
    <div style="width:100%;height:50px;background-color:rgba(47,85,151,1);color:white;text-align:left;">
        <div style="padding-top:15px;padding-left:20px;"><i class="fa fa-arrow-left" style="margin:0px 20px 0px 5px;" onclick="goback()"></i>Active Courses</div>
    </div>
    <br>
    <div>
        <form method="get" action="" onsubmit="return blurbody()">
            <center>
    <?php
        $mytext="";
        $sql="select * from registered where complete=0 and usn='".$_SESSION["registeredusn"]."'";
        $result = $conn->query($sql);
        $mycolors=array("#322f3d","#ffa931","#c70039","#62760c","#035aa6");
        $tempi=0;
        while($row = $result->fetch_assoc()) {
            $teachersql="select * from teachers where id=".$row["id"];
            $teacherresult=$conn->query($teachersql);
            $teachername=$teacherresult->fetch_assoc();
            $teachername=$teachername["name"];
            $mytext=$mytext."<button type='submit' style='outline:none;width:90%;text-align:center;background-color:".$mycolors[$tempi%5].";height:20%;border:none;color:white;border-radius:10px;' name='coursecode' value='".$row["coursecode"]."'><div style='padding:25px;'>".$row["coursecode"]."<br><br>".$teachername."</div></button><br><br>";
            $tempi=$tempi+1;
        }
        echo $mytext;
    ?>
            </center>
        </form>
    </div>
    <script>
        window.onbeforeunload=function (){
            document.body.style["filter"]="opacity(30%)";
        };
        function blurbody()
        {
            document.body.style["filter"]="opacity(30%)";
            return true;
        }
        function goback()
        {
            window.history.back();
        }
    </script>
</body>
</html>