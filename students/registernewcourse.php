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
if(isset($_POST["submit"]))
{
    $i=1;
    while(isset($_POST["ccode".$i]))
    {
        if($_POST["ccode".$i]=="")
        {
            $i=$i+1;
            continue;
        }
        $checksql="select count(*) from courseregistration where usn='".$_SESSION["registeredusn"]."' and id=".$_POST["faculty".$i]." and coursecode='".$_POST["ccode".$i]."'";
        $checkresult = $conn->query($checksql);
        $totalcount=$checkresult->fetch_assoc();
        if($totalcount["count(*)"]==0)
        {
        $sql="insert into courseregistration values('".$_SESSION["registeredusn"]."',".$_POST["sem"].",'".$_POST["ccode".$i]."','".$_POST["cname".$i]."',".$_POST["faculty".$i].",0)";
        $result = $conn->query($sql);
        }
        else
        {
            ?>
            <script>
                alert('<?php echo $_POST["ccode".$i] ?>'+" is already Pending");
            </script>
            <?php
        }
        $i=$i+1;
    }
    ?>
    <script>
       mywin= window.open("studentmenu.php","_self");
       window.open("pendingcourses.php");
       mywin.close();
    </script>
    <?php
    
}
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta name="theme-color" content="#132743" />
        <style>
            #dynamicdiv input
            {
                width:50%;
                height:35px;
                border-radius:30px;
                padding-left:20px;
                outline:none;
                border:1px solid rgba(47,85,151,1);
            }
        </style>
    </head>
    <body style="margin:0;padding:0;">
    <div style="width:100%;height:50px;background-color:rgba(47,85,151,1);color:white;text-align:left;">
            <div style="padding-top:15px;padding-left:20px;"><i class="fa fa-arrow-left" style="margin:0px 20px 0px 5px;" onclick="goback()"></i>Attendance & Marks</div>
    </div>
    <br>
        <div style="width:100%;margin-bottom:20%;">
            <div style="background-color:#ffff99;height:30px;padding-top:15px;padding-left:10px;">
                Total Courses: <input id="totalcourses" placeholder="Enter a number" style="background-color:Transparent;text-align:center;border:none;border-bottom:2px solid brown;outline:none;width:30%;">
                <button onclick="displayform()" style="margin-right:10px;width:15%;background-color:orange;color:white;border:none;border:2px solid black;float:right;margin-right:20px;">Add</button>
            </div>
            <br>
            <br>
            <form method="post" action="" id="coursesform" style="display:none;width:100%;" >
                <label style="margin-left:10px;">Class: </label><select name="sem">
                    <option value="6">6th</option>
                    <option value="7">7th</option>
                    <option value="8">8th</option>
                    <option value="9">9th</option>
                    <option value="10">10th</option>
                    <option value="11">11th</option>
                    <option value="12">12th</option>
                </select>
                <br>
                <br>
                <div id="dynamicdiv" style="width:100%;" >
                    
                </div>
                <br>
                <center><input type="submit" name="submit" style="border:2px solid black;outline:none;width:60%;height:40px;background-color:orange;color:white;"></center>
                
            </form>
           
        </div>
        <script>
            window.onbeforeunload=function (){
            document.body.style["filter"]="opacity(30%)";
        };
            var noofcourse=0;
            function displayform()
            {
                
                noofcourse=document.getElementById("totalcourses").value;
                if(noofcourse>0 && noofcourse<20)
                {
                    <?php
                        $sql="select * from teachers";
                        $result = $conn->query($sql);
                        $options="";
                        while($row= $result->fetch_assoc())
                        {
                            $options=$options. '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                        }
                    ?>
                    var mytext="";
                    for(var i=0;i<noofcourse;i++)
                    {
                        mytext=mytext+'<div style="padding:10px;background-color:lightgray;text-align:center;"><input name="cname'+(parseInt(i)+parseInt(1))+'" placeholder="Course Name"><br><br><input name="ccode'+(parseInt(i)+parseInt(1))+'" placeholder="Course Code"><br><br>Faculty: <select name="faculty'+(parseInt(i)+parseInt(1))+'">'
                    
                        mytext=mytext+'<?php echo $options ?>'+'</select></div><br>';
                    
                    }
                    
                    document.getElementById("dynamicdiv").innerHTML=mytext;
                    document.getElementById("coursesform").style.display="block";
                    
                }
                else
                {
                    alert("Please Enter Valid Number");
                }
            }
        function goback()
        {
            window.history.back();
        }
            
        </script>
    </body>
</html>