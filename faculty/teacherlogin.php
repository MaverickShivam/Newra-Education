<?php
session_start();
$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
if($conn and isset($_POST['login']) and strlen($_POST["id"])>0)
{
    $sql="select * from teachers where id=".$_POST["id"].";";
    $result = $conn->query($sql);
    $array= $result->fetch_assoc();
    if($array["password"]==$_POST["password"] and $array['password']!=null)
    {
        $_SESSION["registeredid"]=$_POST["id"];
        ?>
        
        <script>
            window.open("teachermenu.php","_self");
        </script>
        <?php
    }
    else if($array['password']==null)
    {
        ?>
        <script>
            alert("Please Enter Correct Details");
             window.history.back();
        </script>
        <?php
        
    }
    else
    {
        ?>
        <script>
            alert("Incorrect Password");
             window.history.back();
        </script>
        <?php
    }
}
else
{
    ?>
    <script>
        alert("Please Enter Correct Details");
        window.history.back();
    </script>
    <?php
}
?>