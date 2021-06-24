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
        window.open("studentmenu.html","_self");
    </script>
    <?php
}
$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="theme-color" content="#132743" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <style>
            .myfeature
            {
                height:150px;
                width:150;
                border:1px solid Transparent;
                border-bottom:1px solid rgba(47,85,151,1);
                box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.05), 0 4px 20px 0 rgba(0, 0, 0, 0.20);
                
                display:inline-block;
                margin:3%;
                position:relative;
                vertical-align:top;
                border-radius:10px;
            }
            .myfeature:hover
            {
                border:1px solid orange;
            }
            .myfeature img
            {
                position:absolute;
                bottom:5px;
                right:5px;
                width:70px;
                height:70px;
            }
            .myfeature .heading
            {
                font-size:14px;
                color:white;
                text-align:left;
                padding:15px;
                color:#4b5d67;
                font-weight:900;
                
            }
        </style>
    </head>
    
<body style="margin:0;padding:0;" >
    <div style="width:100%;height:50px;background-color:rgba(47,85,151,1);color:white;text-align:left;">
        <div style="padding-top:15px;padding-left:20px;"><i class="fa fa-arrow-left" style="margin:0px 20px 0px 5px;" onclick="goback()"></i><?php echo $_SESSION["coursecode"] ?></div>
    </div>
    <br>
    <br>
    <center>
        <div class="myfeature" onclick="openexam()">
            <div class="heading">Online Exam</div>
            <img src="../../images/exam.png" >
        </div>
        
        <div class="myfeature" onclick="openattendance()">
            <div class="heading">Attendance & Marks</div>
            <img src="../../images/marks1.png" >
        </div>
        
        <div class="myfeature" onclick="opendiscussion()">
            <div class="heading">Discussion</div>
            <img src="../../images/discussion.png">
        </div>
        
        <div class="myfeature" onclick="opensmaterials()">
            <div class="heading">Resources</div>
            <img src="../../images/resources1.png" >
        </div>
        
        <div class="myfeature" onclick="openmeeting()">
            <div class="heading">Live Class</div>
            <img src="../../images/zoom.png" >
        </div>
        
        <div class="myfeature" onclick="openhelp()">
            <div class="heading">Help</div>
            <div style="position:absolute;bottom:7px;right:5px;padding:17px 23px 17px 23px;background-color:black;color:white;border-radius:40px;font-size:20px;">?</div>
        </div>
    </center>
    
    
    
    <br>
    <br>
    <br>
    <br>
    <script>
        window.onbeforeunload=function (){
            document.body.style["filter"]="opacity(30%)";
        };
        
        function openattendance()
        {
            document.body.style["filter"]="opacity(30%)"
            window.open("smarksattend.php","_self");
        }
        function opendiscussion()
        {
            document.body.style["filter"]="opacity(30%)"
            window.open("chat/","_self");
        }
        function opensmaterials()
        {
            document.body.style["filter"]="opacity(30%)"
            window.open("squiz.php","_self");   
        }
        function openexam()
        {
            document.body.style["filter"]="opacity(30%)"
            window.open("allquizprofile.php","_self");
        }
        function openmeeting()
        {
            document.body.style["filter"]="opacity(30%)"
            window.open("studentmeeting.php","_self");
        }
        function openhelp()
        {
            
        }
        function goback()
        {
            window.history.back();
        }
    </script>
    
</body>
</html>