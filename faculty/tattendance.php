<?php
session_start();

if(!isset($_SESSION["registeredid"]) or !isset($_SESSION["coursecode"]))
{

    ?>

    <script>

        window.open("teacherlogin.html","_self");

    </script>

    <?php

}

$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
if(isset($_POST["update"]))
{
    $sql = "SELECT * FROM registered where id=".$_SESSION["registeredid"]." and coursecode='".$_SESSION["coursecode"]."' and complete=0";
    $result = $conn->query($sql);
    date_default_timezone_set("Asia/Kolkata");
    while($row = $result->fetch_assoc()) {
        if(isset($_POST[$row["sino"]]) and $_POST[$row["sino"]]==1 )
        {
            $updatesql="update registered set totalclasses=".($row["totalclasses"]+1).", totalattended=".($row["totalattended"]+1).", lastattend='".date('d-m-Y h:i:s A')."' where sino=".$row["sino"];
            $resultnew = $conn->query($updatesql);
        }
        else
        {
            $updatesql="update registered set totalclasses=".($row["totalclasses"]+1)." where sino=".$row["sino"];
            $resultnew = $conn->query($updatesql);
        }
    }
    ?>
    <script>
        alert("Updated");
        window.history.back();
        
    </script>
    <?php
    
    
    
    
    
}

?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="theme-color" content="#132743" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <style>

            table, th, td {

              border: 1px solid black;
              font-size:12;
              border-collapse: collapse;

            }

            th, td {

              padding: 5px;

              text-align: left;

            }

        </style>
    </head>
    
    <body style="margin:0;padding:0;">
        <div style="width:100%;height:50px;background-color:rgba(47,85,151,1);color:white;text-align:left;">
            <div style="padding-top:15px;padding-left:20px;">
                <i class="fa fa-arrow-left" style="margin:0px 20px 0px 5px;" onclick="goback()"></i>
                <label id="localst"></label>
            </div>
        </div>
        <?php
        $sql="select * from registered where id=".$_SESSION["registeredid"]." and coursecode='".$_SESSION["coursecode"]."' and complete=0";
        $result = $conn->query($sql);
        $mytext='<form action="" method="post"><table style="width:100%;"><tr><th>USN and Name</th><th>Total</th><th>Attended</th><th>Present</th></tr>';
        while($row = $result->fetch_assoc()) {
            $studentsql="select * from students where usn='".$row["usn"]."'";
            $nameresult=$conn->query($studentsql);
            $studentname=$nameresult->fetch_assoc();
            $studentname=$studentname["name"];
            $mytext=$mytext."<tr><td>".$row["usn"]."<br>".$studentname. "</td><td>".$row["totalclasses"]."</td><td>".$row["totalattended"]."<br>".$row["lastattend"]."</td><td><input type='checkbox' style='height:30px;width:30px;'name=".$row["sino"]." value=1></td></tr>";
        }
        $mytext=$mytext=$mytext."</table><br><center><button style='background-color:orange;color:white;border:2px solid black;height:50px;width:60%;' type='submit' name='update'>Mark Attendance</button></center></form>";
        echo $mytext;
        ?>
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
        </script>
    </body>
</html>