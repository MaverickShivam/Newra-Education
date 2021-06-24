<?php
session_start();
?>
<html>
    <style>
    div.card
    {
        
        display:inline-block;
        width:40%;
        height:150px;
        border-bottom:1px solid #00bcd4; 
        border-radius:10px;
        background-color:white;
        position:relative;
        margin:2%;
        vertical-align:top;
        box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.05), 0 4px 20px 0 rgba(0, 0, 0, 0.20);
        
    }
    div.card:hover
    {
        border:1px solid orange;
    }
    div.card img
    {
        position:absolute;
        height:auto;
        border-bottom-right-radius:10px;
    }
    .myhead
    {
        text-align:left;
        padding:10px;
        font-size:12px;
        font-weight:900;
        color:#41444b;
    }
    .newracourse
    {
        width:84%;
        height:150px;
        border-bottom:1px solid #00bcd4; 
        border-radius:10px;
        background-color:white;
        position:relative;
        vertical-align:top;
        box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.05), 0 4px 20px 0 rgba(0, 0, 0, 0.20);
    }
    .newracourse:hover
    {
        border:1px solid orange;
    }
    
    
    </style>
    <meta name="theme-color" content="#132743" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="manifest" href="../smanifest.webmanifest">
    <body style="padding:0;margin:0;" >
        <div style="position:relative;color:white;">
            <img src='https://newratechnologies.com/edu/images/topwave-1.png' style="width:100%;height:auto;">
            
        
    
            <?php
                $conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
                if(isset($_SESSION["registeredusn"]))
                {
                    $sql="select * from students where usn='".$_SESSION["registeredusn"]."'";
                    $result = $conn->query($sql);
                    $array= $result->fetch_assoc();
                    echo "<div style='padding:5%;position:absolute;top:15%;font-size:20px;font-weight:600;'><div style='font-size:16px;margin-bottom:10px;font-style: italic;'>Welcome</div>".$array["name"]." !</div>";
                }
                else
                {
                    ?>
                    <script>
                        window.open("studentlogin.html","_self");
                    </script>
                    <?php
                }
            ?>
        </div>
    <br>
    <br>
    <div >
        <center>
            <div class="newracourse" onclick="opencourses()">
                <img style="max-width:45%;max-height:100%;margin:10px;position:absolute;left:10px;" src="https://newra.in/exp/illust1.png" id="myimg"><div style="margin:10px;position:absolute;left:55%;top:20%;" id="mydesc"></div>
            </div>
            <br>
            <br>
            <div style="" class="card" onclick="openactive()">
                <div class="myhead">Active Courses</div>
                <img src="../../images/sactive1.png" style="width:100px;bottom:0;right:1px;">
            </div>
            <div class="card" onclick="openregister()">
                <div class="myhead">Register New Course</div>
                <img src="../../images/sregister1.png" style="width:130px;bottom:-30;right:-7;">
            </div>
            <div class="card" onclick="openpending()">
                <div class="myhead">Awaiting Confirmation</div>
                <img  src="../../images/spending1.png" style="width:100px;bottom:0;right:1px;">
            </div>
            <div class="card" onclick="openyoga()">
                <div class="myhead">Yoga & Meditation</div>
                <img  src="../../images/yoga1.png" style="width:100px;bottom:-17;right:-20;">
            </div>
            <div class="card" onclick="openprofile()">
                <div class="myhead">Profile</div>
                <img  src="../../images/sprofile2.png" style="width:70px;bottom:-2;right:1px;">
            </div>
            <div class="card" onclick="openaboutus()">
                <div class="myhead">About Us</div>
                <img  src="../../images/aboutus1.png" style="width:90px;bottom:2px;right:1px;">
            </div><br><br><br><br>
            
            
        </center>
    
    </div>
    <script>
        window.onbeforeunload=function (){
            document.body.style["filter"]="opacity(30%)";
        };
        window.addEventListener('load',()=>{
            registerSW();
            
        });
        function opencourses()
        {
            alert("Coming Soon...");
            //window.open('https://newra.in/mycontent/',"_self");
        }
        function openactive()
        {
            
            window.open("activecourses.php","_self");
        }
        function openregister()
        {
            document.body.style["filter"]="opacity(30%)"
            window.open("registernewcourse.php","_self");
        }
        function openprofile()
        {
            document.body.style["filter"]="opacity(30%)"
            window.open("sprofile.php","_self");
        }
        function openpending()
        {
            document.body.style["filter"]="opacity(30%)"
            window.open("pendingcourses.php","_self");
        }
        function openyoga()
        {
            document.body.style["filter"]="opacity(30%)"
            window.open("yoga.php","_self");
        }
        function openaboutus()
        {
            window.open("https://newra.in/education","_self");
        }
        async function registerSW()
        {
            if('serviceWorker' in navigator)
            {
                try
                {
                    await navigator.serviceWorker.register("../sw.js");
                }
                catch(e)
                {
                    console.log("SW registration failed");
                }
            }
        }
        var ind=0;
        var images=["../../images/coding.png","../../images/appdev.png","https://newra.in/exp/illust1.png"]
        var desc=["Learn coding from IIT professors..","Want to develop your own app?","Online Learning by India's Top Teachers"]
        var t=0;
        changecontent();
        function changecontent()
        {
            document.getElementById("myimg").src=images[ind];
            t=0
            document.getElementById("mydesc").innerHTML="";
            typewriter();
            
        }
        
        function typewriter()
        {
            if(t<desc[ind].length)
            {
                document.getElementById("mydesc").innerHTML=document.getElementById("mydesc").innerHTML+desc[ind][t];
                t=t+1;
                setTimeout(typewriter,100);
            }
            else
            {
                
                ind=(ind+1)%3;
                setTimeout(changecontent,2000);
               
            }
            
        }
        
        
    </script>
    </body>
</html>