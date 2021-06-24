<?php
session_start();
?>
<html>
    <head>
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
        <link rel="manifest" href="../tmanifest.webmanifest">
        <meta name="theme-color" content="#132743" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    </head>

    <body style="padding:0;margin:0;" >
    
        <div style="position:relative;color:white;">
            <img src='https://newratechnologies.com/edu/images/topwave-1.png' style="width:100%;height:auto;">
    <?php
        $conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
        if(isset($_SESSION["registeredid"]))
        {
            $sql="select * from teachers where id='".$_SESSION["registeredid"]."'";
            $result = $conn->query($sql);
            $array= $result->fetch_assoc();
            echo "<div style='padding:5%;position:absolute;top:15%;font-size:20px;font-weight:600;'><div style='font-size:16px;margin-bottom:10px;font-style: italic;'>Welcome</div>".$array["name"]." !</div>";
        }
        else
        {
            ?>
            <script>
                window.open("teacherlogin.html","_self");
            </script>
            <?php
        }
    ?>
    </div>
    <br>
    <br>
    <div >
        <center>
            <div class="card" onclick="openclassroom()">
                <div class="myhead">ClassRooms</div>
                <img src="../../images/sactive1.png" style="width:100px;bottom:0;right:1px;">
            </div>
            <div class="card" onclick="openprofile()">
                <div class="myhead">Profile</div>
                <img  src="../../images/sprofile2.png" style="width:70px;bottom:0;right:1px;">
            </div>
        </center>
    </div>
    <br><br><br><br>
    <script>
        window.onbeforeunload=function (){
            document.body.style["filter"]="opacity(30%)";
        };
        window.addEventListener('load',()=>{
            registerSW();
            
        });
        function openclassroom()
        {
            document.body.style["filter"]="opacity(30%)"
            window.open("taddcourse.php","_self");
        }
        function openprofile()
        {
            document.body.style["filter"]="opacity(30%)"
            window.open("tprofile.php","_self");
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
    </script>
    </body>
</html>