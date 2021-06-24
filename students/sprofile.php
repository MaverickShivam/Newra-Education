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
$sql = "SELECT * FROM students where usn='".$_SESSION["registeredusn"]."'";
$result = $conn->query($sql);
$details=$result->fetch_assoc();


?>
<html>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="theme-color" content="#132743" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <body style="padding:0;margin:0;">
        <div>
            <div style="background-color:rgba(47,85,151,1);height:220px;width:100%">
                <center>
                    <img src="../../images/sprofile.png" height=100px width=100px style="margin-top:15px;border-radius:60px;border:5px solid white;background-color:white;">
                    <br>
                    <div style="font-size:20px;color:white;font-weight:600;margin-top:25px;"><?php echo $details["name"]; ?></div>
                </center>
            </div>
            
            
            
            <div>
                <div style="text-align:left;margin-top:15%;padding-left:40px;">
                    <label>
                        <i class="fa fa-mobile fa-2x" style="margin-right:10px;color:rgba(47,85,151,1);"></i>
                        <i style=""><?php echo $details["mobilenumber"]; ?></i>
                        
                    </label>
                    
                </div>
                <div style="text-align:left;margin-top:5%;padding-left:40px;">
                    <label>
                        <i class="fa fa-envelope fa-lg" style="margin-right:10px;color:rgba(47,85,151,1);"></i>
                        <i style=""><?php echo $details["email"]; ?></i>
                        
                    </label>
                    
                </div>
                <div style="text-align:left;margin-top:5%;padding-left:40px;">
                    <label>
                        <i class="fa fa-id-card fa-lg" style="margin-right:10px;color:rgba(47,85,151,1);"></i>
                        <i style=""><?php echo $details["usn"]; ?></i>
                        
                    </label>
                    
                </div>
                
            </div>
            <center>
                <button style="background-color:orange;outline:none;color:white;border:none;margin-top:70px;padding:10px 20px 10px 20px;" onclick="logout()">Log Out</button>
            </center>
            
        </div>
        <script>
            window.onbeforeunload=function (){
                document.body.style["filter"]="opacity(30%)";
            };
           function logout()
           {
               window.open("logout.php","_self");
           }
        </script>
    </body>
</html>