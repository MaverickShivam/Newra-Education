<?php
session_start();
$quizcode=$_SESSION["quizcode"];
if(!isset($_SESSION["registeredid"]) or !isset($_SESSION["coursecode"]))
{

    ?>

    <script>

        window.open("teacherlogin.html","_self");

    </script>

    <?php

}
$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
$sql="select * from quizresult where quizcode='".$quizcode."'";
$result=$conn->query($sql);
?>

<html>
    <head>
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="theme-color" content="#132743" />
    </head>
    
    <body style="margin:0;padding:0;">
        <div style="width:100%;height:50px;background-color:rgba(47,85,151,1);color:white;text-align:left;">
            <div style="padding-top:15px;padding-left:20px;">
                <i class="fa fa-arrow-left" style="margin:0px 20px 0px 5px;" onclick="goback()"></i>
                Result
            </div>
        </div>
        <table style="width:100%;">
            <tr>
                <th>SNo</th><th>Student Name</th><th>USN</th><th>Score</th><th>Total</th>
            </tr>
        <?php
        $mytext="";
        $x=1;
        while($row=$result->fetch_assoc())
        {
            $namesql="Select name from students where usn='".$row["usn"]."'";
            $nameresult=$conn->query($namesql);
            $name=$nameresult->fetch_assoc();
            $mytext=$mytext.'<tr><td>'.$x.'</td><td>'.$name["name"].'</td><td>'.strtoupper($row["usn"]).'</td><td>'.$row["score"].'</td><td>'.$row["totalmarks"].'</td></tr>';
            $x=$x+1;
        }
        echo $mytext;
        ?>
        
            
            
        </table>
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