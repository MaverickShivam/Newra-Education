<?php
session_start();
if(!isset($_SESSION["registeredid"]) and !!isset($_SESSION["coursecode"]))
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
    $tests=array("i1","i2","i3","q1","q2","l1","l2","see");
    while($row = $result->fetch_assoc()) {
        $updatesql="update registered set ";
        for ($z=0;$z<8;$z++)
        {
            if($_POST[$row["sino"].$tests[$z]]=="")
            {
                $updatesql=$updatesql.$tests[$z]."=-1";
            }
            else
            {
                $updatesql=$updatesql.$tests[$z]."=".$_POST[$row["sino"].$tests[$z]];
            }
            if($z<7)
            {
                $updatesql=$updatesql.", ";
            }
        }
        $updatesql=$updatesql." where sino=".$row["sino"];
        $updateresult=$conn->query($updatesql);
    }
    ?>
    <script>
        alert("Updated");
        window.history.back();
    </script>
    <?php
    die;
    
}
?>
<html>
    
    <head>
        <meta name="theme-color" content="#132743" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <style>

            table, th, td {

              border: 1px solid black;
              
              border-collapse: collapse;

            }

            th, td {

              padding: 10px;
              font-size:10;
              text-align: left;

            }
            button{
                width:100%;
                bottom:0;
                height:60px;
                position:fixed;
                background-color:orange;
                color:white;
            }
            body
            {
                margin-bottom:300px;
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
        $sql = "SELECT * FROM registered where id=".$_SESSION["registeredid"]." and coursecode='".$_SESSION["coursecode"]."' and complete=0";
        $result = $conn->query($sql);

        $mytext='<form action="" method="post"><table style="width:100%;"><tr><th>USN and Name</th><th>I1</th><th>I2</th><th>I3</th><th>Q1</th><th>Q2</th><th>L1</th><th>L2</th><th>SEE</th> </tr>';
        while($row = $result->fetch_assoc()) {
            $studentsql="select * from students where usn='".$row["usn"]."'";
            $nameresult=$conn->query($studentsql);
            $studentname=$nameresult->fetch_assoc();
            $studentname=$studentname["name"];
            $mytext=$mytext. "<tr><td>".$row["usn"]."<br>".$studentname. "</td>";
            $tests=array("i1","i2","i3","q1","q2","l1","l2","see");
            for($z=0;$z<8;$z++)
            {
                if($row[$tests[$z]]==-1)
                {
                    $mytext=$mytext."<td style='width:5%;padding:0;'><input type='number' name=".$row["sino"].$tests[$z]." value='' style='margin:0;padding:0;width:100%;outline:none;border:none;text-align:center;'></td>";
                }
                else
                {
                    $mytext=$mytext."<td style='width:5%;padding:0;'><input type='number' name=".$row["sino"].$tests[$z]." value=".$row[$tests[$z]]." style='margin:0;padding:0;width:100%;outline:none;border:none;text-align:center;'></td>";
                }
                
            }
            $mytext=$mytext."</tr>";
        }
        $mytext=$mytext."</table><button type='submit' name='update' >Update</button></form>";

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
