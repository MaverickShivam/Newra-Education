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
$sql="select * from registered where usn='".$_SESSION["registeredusn"]."' and coursecode='".$_SESSION["coursecode"]."'";
$result = $conn->query($sql);
$details=$result->fetch_assoc();
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="theme-color" content="#132743" />
        <style>
            .report
            {
                width:80%;
                border-radius:20px;
                box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.05), 0 4px 20px 0 rgba(0, 0, 0, 0.20);
                padding:10px;
                text-align:left;
                height:auto;
                position:relative;
                margin-bottom:20px;
                
            }
            .report img
            {
                width:70px;
                height:70px;
                position:absolute;
                top:10px;
                right:10px;
            }
            .report .heading
            {
                
                font-size:18px;
                color:black;
                font-weight:900;
                
                margin-bottom:20px;
                margin-top:20px;
            }
            .content
            {
                font-size:16px;
                color:gray;
                padding-left:30px;
                
                
            }
            .content label
            {
                line-height:25px;
            }
        </style>
    </head>
    <body style="margin:0;padding:0;">
        <div style="width:100%;height:50px;background-color:rgba(47,85,151,1);color:white;text-align:left;">
            <div style="padding-top:15px;padding-left:20px;"><i class="fa fa-arrow-left" style="margin:0px 20px 0px 5px;" onclick="goback()"></i>Attendance & Marks</div>
        </div>
    
        <br>
        <br>
        <center>
            <div class="report">
                <div class="heading">
                    Attendance
                </div>
                <img src="../../images/marks1.png">
                <div class="content">
                    <label ><b>Total Classes Held: </b><?php echo $details["totalclasses"] ?></label>
                    <br>
                    <label><b>Attended: </b><?php echo $details["totalattended"] ?></label>
                </div>
                <div class="heading">
                    Marks Scored
                </div>
                <div class="content">
                    <?php 
                        if($details["i1"]==-1 and $details["i2"]==-1 and $details["i3"]==-1 and $details["q1"]==-1 and $details["q2"]==-1 and $details["l1"]==-1 and$details["l2"]==-1 and $details["see"]==-1 )
                        {
                            echo "<label style='color:green;font-size:12;'>After Result, Marks will be uploaded here<label>";
                        }
                        else
                        {
                            $tests=array("i1","i2","i3","q1","q2","l1","l2","see");
                            $testnames=array("Ist Internal","IInd Internal","IIIrd Internal","Ist Quiz","IInd Quiz","Ist Lab","IInd Lab","SEE");
                            $mytext="";
                            for($z=0;$z<8;$z++)
                            {
                                if($details[$tests[$z]]>=0)
                                {
                                    $mytext=$mytext."<label><b>".$testnames[$z]." :</b> ".$details[$tests[$z]]."</label><br>";
                                }
                            }
                            echo $mytext;
                        }
                    ?>
                    <br>
                    <br>
                </div>
            </div>
        </center>
        
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
