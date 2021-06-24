<?php
session_start();
$message="";
if(isset($_POST["password"]))
{
    if($_POST["password"]=="SGTBadmin@newra")
    {
        $_SESSION["verified"]=1;
    }
    else
    {
        $message="Incorrect Password";
    }
}
if(isset($_SESSION["verified"]))
{
    $verified=1;
}
else
{
    $verified=0;
}

?>
<html>
    <head>
       
        <title>Institution Admin Panel</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta property="og:image" content="https://newra.in/logo.png" />
        
        <link rel="icon" href="https://newra.in/logo.png">
    </head>
    <style>
        table,tr,td,th
        {
            border:1px solid black;
        }
        .a
        {
            display:inline-block;
            vertical-align:top;
        }
    </style>
    <body style="margin:0;padding:0;background-color:white;">
        <div style="position:fixed;height:60px;width:100%;top:0;background-color:white;border-bottom:2px solid lightgray;box-shadow: 0 8px 6px -6px black;z-index:2;">
            <a href="https://newra.in/education"><img src="https://newra.in/flat-logo.png" style="position:absolute;height:40px;width:auto;top:10px;left:10px;"></a>
        </div>
        <center><div style="width:90%; max-width:400px;height:450px;margin-top:100px;box-shadow: 10px 10px 8px #888888;background-color:white;" id="loginbox">
            <form autocomplete="off" method="post" onsubmit="return validate()">
                <img src="../images/mylogo.png" height="150px" width="150px">
                <p>S.G.T.B. Khalsa Boys <br>Sr. Sec. School</p>
                <label style="color:red;" id="message"><?php echo $message; ?></label>
                <br>
                <br>
                <input style="border-radius:20px;width:70%;height:40px;outline:none;" type="password" placeholder="Enter Password" autocomplete="off" name="password" id="password" onfocus="clearmessage()">
                <br><br>
                <input type="checkbox" value="1" id="agree">I agree to all <a href="termsofservice.pdf">Terms & Conditions</a>
                <br><br>
                <button style="width:80%;height:50px;border:none;outline:none;background-color:orange;color:white;">Continue <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
            </form>
            
        </div></center>
        <center>
        <div id="maincontent" style="padding-top:80px;width:100%;display:none;background-color:#e1ffc2;padding-bottom:100px;">
            
            <div style="width:100%;height:auto;background-color:white;border-bottom:5px solid #221f3b;padding-bottom:20px;max-width:600px;">
                <div style="text-align:left;width:calc(100% - 5px);background-color:#221f3b;color:white;height:30px;font-size:20px;padding-top:10px;padding-left:5px;">Package Details</div>
                <table style="width:95%;margin-top:20px;">
                    <tr>
                        <th style="width:50%;">Features</th>
                        <th style="width:50%;">Max Limit</th>
                    </tr>
                    <tr>
                        <td style="width:50%;">Students</td>
                        <td style="width:50%;">800</td>
                    </tr>
                    <tr>
                        <td style="width:50%;">Teachers</td>
                        <td style="width:50%;">80</td>
                    </tr>
                    <tr>
                        <td style="width:50%;">Validity</td>
                        <td style="width:50%;">12 months</td>
                    </tr>
                    <tr>
                        <td style="width:50%;">Live Class</td>
                        <td style="width:50%;">Unlimited</td>
                    </tr>
                    <tr>
                        <td style="width:50%;">Online Test</td>
                        <td style="width:50%;">Unlimited</td>
                    </tr>
                    <tr>
                        <td style="width:50%;">Discussion</td>
                        <td style="width:50%;">1/course</td>
                    </tr>
                    <tr>
                        <td style="width:50%;">Resources</td>
                        <td style="width:50%;">PDF/Images/Youtube/Others</td>
                    </tr>
                </table>
                <br>
                <form><script src="https://cdn.razorpay.com/static/widget/payment-button.js" data-payment_button_id="pl_FaFCGK9G08V2Im"> </script> </form>
                <div style="text-align:left;padding:10px;"><b>Status: </b><label style="color:white;background-color:red;padding:2px;">InActive</label></div>
                <div style="text-align:left;padding:10px;"><b>No. of listings left: </b>3/3</div>
                <div style="text-align:left;padding:10px;"><b>Start Date: </b>13 September 2020</div>
                <div style="text-align:left;padding:10px;"><b>Membership till Date: </b>12 September 2021</div>
            </div>
            <br><br><br><br>
            
            <div style="width:100%;height:auto;background-color:white;margin-top:30px;border-bottom:5px solid #221f3b;padding-bottom:20px;max-width:600px;">
                <div style="text-align:left;width:calc(100% - 5px);background-color:#221f3b;color:white;height:30px;font-size:20px;padding-left:5px;padding-top:10px;">Admin Details</div>
                <div style="text-align:left;margin-top:20px;"><b>Name: </b>Mr. Jasvinder Singh</div><br>
                <div style="text-align:left;"><b>Mobile Number: </b><a href="tel://9717978065">9717978065</a></div><br>
                <div style="text-align:left;"><b>Email: </b><a href="mailto:sgtbkhalsaboys@yahoo.in">sgtbkhalsaboys@yahoo.in</a></div>
            </div>
            <br><br><br><br>
            
            <div style="width:100%;height:auto;background-color:white;margin-top:30px;border-bottom:5px solid #221f3b;padding-bottom:20px;max-width:600px;">
                <div style="text-align:left;width:calc(100% - 5px);background-color:#221f3b;color:white;height:30px;font-size:20px;padding-left:5px;padding-top:10px;">Other Features</div>
                <table style="width:95%;margin-top:20px;">
                    <tr>
                        <th style="width:50%;">Feature</th>
                        <th style="width:50%;">Action</th>
                    </tr>
                    <tr>
                        <td style="width:50%;">Manage Students</td>
                        <td style="width:50%;"><center><button onclick="openmanagestudents()" style="background-color:orange;color:white;outline:none;border:none;" disabled>Open</button></center></td>
                    </tr>
                    
                </table>
            </div>
            
        </div>
        </center>
        
        <div style="width:1000px;max-width:100%;background-color:white;padding-top:10px;margin-left:auto;margin-right:auto;" id="footer">
            <div style="width:350px;max-width:calc(100% - 20px);padding:10px;"class="a">
                <b>Our Moto</b>
                <br><br>
                <p style="color:#00bfd8;">
                    The motto of our company is to realize the problems around us in our society and to find innovative and realistic solutions to these problems. The goal of the company is to connect to as many sections of the society as possible . The solutions should be efficient and fast in execution and according to the needs of our Indian market. We at NEWRA believe no problem is too big not to be solved and our team has the courage to take any task head on no matter how tough it gets.
                </p>
            </div>
            <div style="width:350px;max-width:calc(100% - 20px);padding:10px;"class="a">
            <b>Important Links</b>
            <br>
            <p>
                <ul>
                    <li>
                        <a style="color:#00bfd8;" href="termsofservice.pdf">Terms and Conditions</a>
                    </li>
                    <li>
                        <a style="color:#00bfd8;" href="studentmanual.pdf">Student Manual</a>
                    </li>
                    <li>
                        <a style="color:#00bfd8;" href="facultymanual.pdf">Faculty Manual</a>
                    </li>
                    <li>
                        <a style="color:#00bfd8;" href="https://newra.in/education">Newra Education</a>
                    </li>
                                   
                </ul>
            </p>
            </div>
            <div style="width:200px;max-width:calc(100% - 20px);padding:10px;" class="a">
            <b>Contact Us</b>
            <br>
            <p>
                <div style="margin:auto;">
                    <a style="color:#00bfd8;padding:5px;" href="tel://+917691027248">+91 7691027248</a>
                    <br>
                    <br>
                    <a style="color:#00bfd8;padding:5px;" href="mailto:info@newra.in">info@newra.in</a>
                    <br>
                    <br>
                    <a style="color:#00bfd8;padding:5px;" href="https://www.linkedin.com/company/42678231/"><i class="fa fa-lg fa-linkedin-square" aria-hidden="true"  ></i></a>
                    <a style="color:#00bfd8;padding:5px;" href="https://www.instagram.com/newra_technologies/"><i class="fa fa-lg fa-instagram" aria-hidden="true" style="" ></i></a>
              
                                    
                </div>
            </p>
            </div>
            
        </div>
        <center><div style="padding:20px;border-top:2px solid lightgray;width:80%;font-size:12px;color:gray;margin-top:200px;">
            Copyright © 2020 Newra Education - All rights reserved
        </div></center>
        <script>
            function clearmessage()
            {
                document.getElementById("message").innerHTML="";
            }
            function validate()
            {
                if(document.getElementById("password").value.length==0)
                {
                    document.getElementById("message").innerHTML="Please Enter Your Password";
                    return false;
                }
                else if(document.getElementById("agree").checked==false)
                {
                    document.getElementById("message").innerHTML="Please tick the checkbox";
                    return false;
                }
                return true;
            }
            if(<?php echo $verified ?>==1)
            {
                document.getElementById("footer").style.display="block";
                document.getElementById("loginbox").style.display="none";
                document.getElementById("maincontent").style.display="block";
                document.body.style.backgroundColor="white";
                
            }
            else
            {
                document.body.style.backgroundColor="#e1ffc2"
                document.getElementById("footer").style.display="none";
                document.getElementById("loginbox").style.display="block";
                document.getElementById("maincontent").style.display="none";
            }
            function openmanagestudents()
            {
                window.open("managestudents.php","_self");
            }
            
        </script>
    </body>
</html>