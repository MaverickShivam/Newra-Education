<?php
session_start();
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if(!isset($_SESSION["registeredid"]))
{
    echo "please login";
    die;
}
else if(!isset($_SESSION["coursecode"]))
{
    echo "restart";
    die;
}
else if(isset($_POST["addquiz"]))
{
    if($_POST["title"]=="" or $_POST["totalq"]=="")
    {
        echo "All fields are mandatory... ";
        die;
    }
    $conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
    
    $uniquecode=generateRandomString();
    $sql="select count(*) from advquiz where quizcode='".$uniquecode."'";
    $result=$conn->query("$sql");
    $row=$result->fetch_assoc();
    $isunique=$row["count(*)"];
    
    while($isunique!=0)
    {
        echo "saturating";
        $uniquecode=generateRandomString();
    $sql="select count(*) from advquiz where quizcode='".$uniquecode."'";
    $result=$conn->query("$sql");
    $row=$result->fetch_assoc();
    $isunique=$row["count(*)"];
    }
    $title="";
    for($i=1;$i<=$_POST["totalq"];$i++)
    {
        $title=$_POST["title"];
        $questionsql="INSERT INTO `advquiz`(`quizcode`, `coursecode`, `id`, `title`, `qno`, `status`, `qtext`, `option1`, `option2`, `option3`, `option4`, `answer`, `time`, `link`) VALUES ('".$uniquecode."','".$_SESSION["coursecode"]."',".$_SESSION["registeredid"].",'".$_POST["title"]."',".$i.",0,'','','','','',0,60,'')";
        $conn->query($questionsql);
    }
    ?>
    <script>
        window.history.back();
    </script>
    <?php
    
}
?>