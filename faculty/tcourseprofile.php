<?php
session_start();
if(!isset($_SESSION["registeredid"]))
{
    ?>
    <script>
        window.open("teacherlogin.html","_self");
    </script>
    <?php
}
if(!isset($_GET["courseid"]))
{
    ?>
    <script>
        window.open("teachermenu.html","_self");
    </script>
    <?php
}
$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
$_SESSION["coursecode"]= strtoupper($_GET["courseid"]);

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
            
                border-bottom:1px solid rgba(47,85,151,1);
                box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.05), 0 4px 20px 0 rgba(0, 0, 0, 0.20);
                
                display:inline-block;
                margin:3%;
                position:relative;
                vertical-align:top;
                border-radius:10px;
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
<body style="margin:0;padding:0;">
    <div style="width:100%;height:50px;background-color:rgba(47,85,151,1);color:white;text-align:left;">
        <div style="padding-top:15px;padding-left:20px;">
            <i class="fa fa-arrow-left" style="margin:0px 20px 0px 5px;" onclick="goback()"></i>
            <label id="localst"></label>
            <i class="fa fa-trash fa-lg" aria-hidden="true" style="position:absolute;right:30px;top:15px;" onclick="deletethis()"></i>
        </div>
    </div>
    
    
    <br>
    <br>
    <center>
        <div class="myfeature" onclick="openattendance()">
            <div class="heading">Attendance</div>
            <img src="../../images/tattendance.png" >
        </div>
        
        <div class="myfeature"  onclick="openresources()">
            <div class="heading">Resources</div>
            <img src="../../images/resources1.png" >
        </div>
        
        <div class="myfeature" onclick="opendiscussion()">
            <div class="heading">Discussion</div>
            <img src="../../images/discussion.png" >
        </div>
        <div class="myfeature" onclick="openexam()">
            <div class="heading">Online Exam</div>
            <img src="../../images/exam.png" >
        </div>
        <div class="myfeature" onclick="openmarks()">
            <div class="heading">Update Marks</div>
            <img src="../../images/marks1.png">
        </div>
        <div class="myfeature" onclick="openpending()">
            <div class="heading">Pending Requests</div>
            <img src="../../images/spending.png" >
        </div>
        <div class="myfeature" onclick="openmeeting()">
            <div class="heading">Online Meeting</div>
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
    function goback()
    {
        window.history.back();
    }
    var codesarray=localStorage.getItem("allcoursescode").split(",");
    var namesarray=localStorage.getItem("allcoursesname").split(",");
    document.getElementById("localst").innerHTML=namesarray[codesarray.indexOf('<?php echo $_SESSION["coursecode"]; ?>')];
    function openpending()
    {
        document.body.style["filter"]="opacity(30%)";
        window.open("tpendingreq.php","_self");
    }
    function openattendance()
    {
        document.body.style["filter"]="opacity(30%)";
        window.open("tattendance.php","_self");
    }
    function openmarks()
    {
        document.body.style["filter"]="opacity(30%)";
        window.open("tmarks.php","_self");
    }
    function deletethis()
    {
        var mytext1="";
        var mytext2="";
        for(var i=1;i<codesarray.length;i++)
        {
            if(codesarray[i]=='<?php echo $_SESSION["coursecode"] ?>')
            {
                continue;
            }
            else
            {
                mytext1=mytext1+","+codesarray[i];
                mytext2=mytext2+","+namesarray[i];
            }
        }
        localStorage.setItem("allcoursescode",mytext1);
        localStorage.setItem("allcoursesname",mytext2);
        window.location.replace('teachermenu.php');
        window.history.back();
    }
    function opendiscussion()
    {
        document.body.style["filter"]="opacity(30%)";
        window.open("../students/chat/","_self");
    }
    function openresources()
    {
        document.body.style["filter"]="opacity(30%)";
        window.open("tquiz.php","_self");
    }
    function openexam()
    {
        document.body.style["filter"]="opacity(30%)";
        window.open("advquiz.php","_self");
    }
    function openmeeting()
    {
        document.body.style["filter"]="opacity(30%)";
        window.open("teachermeeting.php","_self")
    }
    function openhelp()
    {
        
    }
</script>
</body>
</html>