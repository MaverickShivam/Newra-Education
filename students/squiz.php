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

if(!isset($_SESSION["coursecode"]))
{
    ?>
    <script>
        window.open("studentmenu.php","_self");
    </script>
    <?php
}
$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");

    if(isset($_POST["1"]))
    {
        ?>
        <script>
            window.history.back();
            window.open('pdfviewer.php?pdflink=<?php echo $_POST["1"] ?>','_blank'); 
        </script>
        <?php
       
    }
    if(isset($_POST["2"]))
    {
        ?>
        <script>
            window.history.back();
            window.open('<?php echo $_POST["2"] ?>',"_blank"); 
        </script>
        <?php
    }
    if(isset($_POST["6"]))
    {
        $_POST["6"]="driveviewer.php?fileurl=".$_POST["6"];
        header("Location:".$_POST["6"]);
        die;
    }
    if(isset($_POST["3"]))
    {
        $_POST["3"]="quiz.php?quizid=".$_POST["3"];
        header("Location:".$_POST["3"]);
        die;
    }
    if(isset($_POST["4"]))
    {
        $_POST["4"]="youtubeviewer.php?link=".$_POST["4"];
        header("Location:".$_POST["4"]);
        die;
    }
    if(isset($_POST["5"]))
    {
        header("Location:".$_POST["5"]);
        die;
    }
?>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="theme-color" content="#132743" />
    </head>

<body style="margin:0;padding:0;height:100%;">
    <div style="width:100%;height:50px;background-color:rgba(47,85,151,1);color:white;text-align:left;">
        <div style="padding-top:15px;padding-left:20px;"><i class="fa fa-arrow-left" style="margin:0px 20px 0px 5px;" onclick="goback()"></i>Resources</div>
    </div>
    <br>
    <form method="post" action="" >
    <?php
        $sql="select * from filelinks where coursecode='".$_SESSION["coursecode"]."'";
        $result=$conn->query($sql);
        $mytext="";
        while($row=$result->fetch_assoc())
        {
            $mytext=$mytext."<button style='width:100%;height:100px;background-color:#ccffff;color:black;text-align:left;border:none;border-bottom:2px solid orange;outline:none;' type='submit' name='".$row["filetype"]."' value='".$row["filelink"]."'> <div style='display:inline;'><img src='../../images/filetype".$row["filetype"].".png' height='80px' width='80px' style='margin-top:0px;margin-left:10px;'></div><div style='width:40%;height:80px;background-color:Transparent;display:inline-block;position:absolute;'><div style='padding:20px;'>".$row["filetitle"]."</div></div></button><br><br>";
        }
        echo $mytext;
    ?>
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