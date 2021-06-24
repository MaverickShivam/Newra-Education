<?php
session_start();
?>
<html>
<body>
<div align="center" style="margin-top:40%;font-size:50px;">
<?php
$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
if($conn and isset($_POST['login']))
{
    $sql="select * from students where usn='".$_POST["usn"]."'";
    $result = $conn->query($sql);
    $array= $result->fetch_assoc();
    if($array["password"]==$_POST["password"] and $array['password']!=null)
    {
        $_SESSION["registeredusn"]=$_POST["usn"];
        ?>
        
        <script>
            window.open("studentmenu.php","_self");
        </script>
        <?php
    }
    else if($array['password']==null)
    {
        ?>
        <script>
            alert("Please Enter All Details");
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
            alert("Please Fill all Details");
            window.history.back();
        </script>
        <?php
}
?>
</div>
</body>
</html>