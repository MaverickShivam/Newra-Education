<?php
//please read it carefullyy.........................!!!!!!!!!!!!!-------
session_start();
if(isset($_POST["send"]))
{
    if(isset($_SESSION["registeredusn"]))
    {
        date_default_timezone_set("Asia/Kolkata");
        $conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
        $sql="INSERT INTO `".$_SESSION["coursecode"]."`(`timestamp`, `name`, `type`, `message`) VALUES ('".date('d M h:i A')."','".$_SESSION["registeredusn"]."','text','".str_replace("'","^",$_POST["message"])."')";
        $conn->query($sql);
    }
    else if(isset($_SESSION["registeredid"]))
    {
        $conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
        $namesql="select * from teachers where id=".$_SESSION["registeredid"];
        $result=$conn->query($namesql);
        $row=$result->fetch_assoc();
        
        date_default_timezone_set("Asia/Kolkata");
        $sql="INSERT INTO `".$_SESSION["coursecode"]."`(`timestamp`, `name`, `type`, `message`) VALUES ('".date('d M h:i A')."','".$row["name"]."','text','".str_replace("'","`",$_POST["message"])."')";
        $conn->query($sql);
    }
    
}

?>
