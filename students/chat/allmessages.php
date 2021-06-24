<?php
session_start();
if(isset($_POST["getmessage"]))
{
    $conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
    $sql="SELECT * FROM `".$_SESSION["coursecode"]."` order by ind";
    $result=$conn->query($sql);
    $jsonarray=array();
    $i=0;
    while($row=$result->fetch_assoc())
    {
        $jsonarray[$i]=$row;
        $i=$i+1;
    }
    print json_encode($jsonarray);
}
?>
