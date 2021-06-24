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

$sql = "SELECT * FROM courseregistration where id=".$_SESSION["registeredid"]." and coursecode='".$_SESSION["coursecode"]."' and status=0";

$result = $conn->query($sql);



$p=1;

while($row=$result->fetch_assoc())

{

    if(isset($_GET["button".$p]))

    {
        date_default_timezone_set("Asia/Kolkata");
        $sql="update courseregistration set status=1 where usn='".$row["usn"]."' and coursecode='".$_SESSION["coursecode"]."' and id=".$_SESSION["registeredid"]." and status=0";
		
        $resultnew = $conn->query($sql);
        $sql="INSERT INTO `registered`(`id`, `usn`, `coursecode`, `totalclasses`, `totalattended`, `i1`, `i2`, `i3`, `q1`, `q2`, `l1`, `l2`, `see`, `lastattend`, `complete`) VALUES (".$_SESSION["registeredid"].",'".$row["usn"]."','".$_SESSION["coursecode"]."',0,0,-1,-1,-1,-1,-1,-1,-1,-1,'".date('d-m-Y h:i:s A')."',0)";
        $resultnew = $conn->query($sql);
        ?>
        <script>
            window.history.back();
        </script>
        <?php

        die;

    }

    $p=$p+1;

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="theme-color" content="#132743" />

    </head>

    

    <body style="margin:0;padding:0;">
        <div style="width:100%;height:50px;background-color:rgba(47,85,151,1);color:white;text-align:left;">
            <div style="padding-top:15px;padding-left:20px;">
                <i class="fa fa-arrow-left" style="margin:0px 20px 0px 5px;" onclick="goback()"></i>
                <label id="localst"></label>
            </div>
        </div>

        <?php

        $sql = "SELECT * FROM courseregistration where id=".$_SESSION["registeredid"]." and coursecode='".$_SESSION["coursecode"]."' and status=0";
        $result = $conn->query($sql);

        $mytext='<form action="" method="get"><table style="width:100%;"><tr><th>Student Name</th><th>USN</th><th>Action</th> </tr>';

        $i=1;

        while($row = $result->fetch_assoc()) {
            $studentsql="select * from students where usn='".$row["usn"]."'";
            $nameresult=$conn->query($studentsql);
            $studentname=$nameresult->fetch_assoc();
            $studentname=$studentname["name"];
            $mytext=$mytext. "<tr><td> " . $studentname. "</td><td>".$row["usn"]. "</td><td><button style='background-color:orange;color:white;border:2px solid black;' name='button".$i."'>Approve</button></td></tr>";

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
    var codesarray=localStorage.getItem("allcoursescode").split(",");
    var namesarray=localStorage.getItem("allcoursesname").split(",");
    document.getElementById("localst").innerHTML=namesarray[codesarray.indexOf('<?php echo $_SESSION["coursecode"]; ?>')];

        </script>

    </body>

</html>