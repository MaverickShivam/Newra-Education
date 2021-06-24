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
$sql = "SELECT * FROM courseregistration where usn='".$_SESSION["registeredusn"]."' and status=0";
$result = $conn->query($sql);

$p=1;
while($row=$result->fetch_assoc())
{
    if(isset($_GET["button".$p]))
    {
        $sql="delete from courseregistration where usn='".$_SESSION["registeredusn"]."' and coursecode='".$row["coursecode"]."' and coursename='".$row["coursename"]."'and status=0";
        $resultnew = $conn->query($sql);
        ?>
        <script>
            window.history.back();
        </script>
        <?php
    }
    $p=$p+1;
}



?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="theme-color" content="#132743" />
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
    </head>
    
    <body style="margin:0;padding:0;">
    <div style="width:100%;height:50px;background-color:rgba(47,85,151,1);color:white;text-align:left;">
            <div style="padding-top:15px;padding-left:20px;"><i class="fa fa-arrow-left" style="margin:0px 20px 0px 5px;" onclick="goback()"></i>Pending Requests</div>
    </div>
        <?php
        $sql = "SELECT * FROM courseregistration where usn='".$_SESSION["registeredusn"]."' and status=0";
        $result = $conn->query($sql);
        $mytext='<form action="" method="get"><table style="width:100%;"><tr><th>Course Name</th><th>Course Code</th><th>Action</th> </tr>';
        $i=1;
        while($row = $result->fetch_assoc()) {
            $mytext=$mytext. "<tr><td> " . $row["coursename"]. "</td><td>". $row["coursecode"]. "</td><td><button style='background-color:orange;color:white;outline:none;border:2px solid black;' name='button".$i."'>Cancel</button></td></tr>";
            $i=$i+1;
        }
        $mytext=$mytext."</table></form>";
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
        </script>
    </body>
</html>