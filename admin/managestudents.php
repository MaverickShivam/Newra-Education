<?php
session_start();

if(!isset($_SESSION["verified"]))
{

    ?>

    <script>

        window.open("index.php","_self");

    </script>

    <?php
    die;

}

$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
if(isset($_POST["update"]))
{
    $sql = "SELECT * FROM registered";
    $result = $conn->query($sql);
    date_default_timezone_set("Asia/Kolkata");
    while($row = $result->fetch_assoc()) {
        if(isset($_POST[$row["sino"]]) and $_POST[$row["sino"]]==1 )
        {
            $updatesql="update registered set complete=1 where sino=".$row["sino"];
            $resultnew = $conn->query($updatesql);
        }
        else
        {
            $updatesql="update registered set complete=0 where sino=".$row["sino"];
            $resultnew = $conn->query($updatesql);
        }
    }
    ?>
    <script>
        alert("Updated");
        window.location.reload("managestudents.php");
        window.history.back();
        
    </script>
    <?php
    
    
    
    
    
}

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
    </head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <body style="margin:0;padding:0;">
        <div style="width:100%;height:60px;background-color:black;color:white;text-align:center;">
        <div style="padding-top:20px;" >Student Details</div>
    </div>
        <?php
        $sql="select * from registered";
        $result = $conn->query($sql);
        $mytext='<form action="" method="post"><table style="width:100%;"><tr><th>USN and Name</th><th>Course</th><th>Attended</th><th>Blaclist</th></tr>';
        while($row = $result->fetch_assoc()) {
            $studentsql="select * from students where usn='".$row["usn"]."'";
            $nameresult=$conn->query($studentsql);
            $studentname=$nameresult->fetch_assoc();
            $studentname=$studentname["name"];
            if($row["complete"]==0)
            {
                $mytext=$mytext."<tr><td>".$row["usn"]."<br>".$studentname. "</td><td>".$row["coursecode"]."</td><td>".$row["totalattended"]."<br>".$row["lastattend"]."</td><td><input type='checkbox' style='height:30px;width:30px;'name=".$row["sino"]." value=1></td></tr>";
            }
            else
            {
                $mytext=$mytext."<tr><td>".$row["usn"]."<br>".$studentname. "</td><td>".$row["coursecode"]."</td><td>".$row["totalattended"]."<br>".$row["lastattend"]."</td><td><input type='checkbox' style='height:30px;width:30px;'name=".$row["sino"]." value=1 checked></td></tr>";
            }
        }
        $mytext=$mytext=$mytext."</table><br><center><button style='background-color:orange;color:white;border:2px solid black;height:50px;width:60%;' type='submit' name='update'>Mark Blacklisted</button></center></form>";
        echo $mytext;
        ?>
        <script>
        </script>
    </body>
</html>