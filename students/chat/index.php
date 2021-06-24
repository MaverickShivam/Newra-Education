<?php
session_start();
$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
$sql='select 1 from `'.$_SESSION["coursecode"].'` LIMIT 1';
$result=$conn->query($sql);
if($result== False)
{
    $sql = "CREATE TABLE ".$_SESSION["coursecode"]." (ind INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,timestamp VARCHAR(50) ,name VARCHAR(100) ,type VARCHAR(100),message VARCHAR(5000))";
    $conn->query($sql);
}
$userid;
if(!isset($_SESSION["registeredusn"]))
{
    if(!isset($_SESSION["registeredid"]))
    {
        die;
    }
    else
    {
        $namesql="select * from teachers where id=".$_SESSION["registeredid"];
        $nameresult=$conn->query($namesql);
        $namerow=$nameresult->fetch_assoc();
        $userid=$namerow["name"];
    }
    
}
else
{
    $userid=$_SESSION["registeredusn"];
}
if(!isset($_SESSION["coursecode"]))
{
    die;
}
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width,user-scalable=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    </head>
    
    <body style="margin:0;padding:0;" bgcolor="#d0f0c0">
        <div id="allmessages" style="width:100%;height:100%;" >
            <div id='sending' style='color:#d0f0c0;'>Sending...</div><br>
            <div style='margin:10px;margin-top:80px;color:#d0f0c0;' id='lastdiv'>.</div>
        </div>
        <div  style="position:fixed;width:100%;bottom:0;background-color:#d0f0c0;padding-bottom:20px;margin-bottom:0;" >
            <div style="width:80%;background-color:white;height:60px;border-radius:15px;">
                <input style="width:calc(100% - 30px);height:60px;border:none;border-radius:15px;outline:none;padding-left:10px;padding-right:10px" type="text" id="writemessage"  placeholder="Type a message" autocomplete="off" oninput="scrolltobottom();" onfocus="scrolltobottom()"><label for="imageselect"><i class="fa fa-lg fa-picture-o" aria-hidden="true" style="color:gray;" ></i>
            </div>
            
            
            <button style="width:18%;background-color:Transparent;outline:none;border:none;" onclick="sendmessage()"><img src="send.png"  height="auto" width=15% style="position:fixed;right:10px;bottom:20px;max-width:70px;"></button>
            <input id="imageselect" name="image_file" type="file" accept="image/*" style="display:none;">
        </div>
        <script>
        window.onbeforeunload=function (){
            document.body.style["filter"]="opacity(30%)";
        };
            var nmessage=20;
            window.setInterval(refresh,1000);
            document.getElementById("imageselect").onchange= function(){
                sendimage();
            };
            function sendmessage()
            {
                if(document.getElementById("writemessage").value.length==0)
                {
                    return false;
                }
                document.getElementById("sending").style.color='gray';
                document.getElementById("writemessage").focus();
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("sending").style.color='#d0f0c0';
                        refresh();
                    }
                };
                xhttp.open("POST", "send.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("send=true&message="+document.getElementById("writemessage").value);
                document.getElementById("writemessage").value="";
            }
            function sendimage()
            {
                document.getElementById("sending").style.color='gray';
                var data = new FormData();
                jQuery.each(jQuery('#imageselect')[0].files, function(i, file) {
                    data.append('image_file', file);
                });
                jQuery.ajax({
                    url: 'sendmedia.php',
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: 'POST',
                    type: 'POST', // For jQuery < 1.9
                    success: function(data){
                        document.getElementById("sending").style.color='#d0f0c0';
                    }
                });
            }
            var pageindex=0;
            function goup()
            {
                nmessage=nmessage+20;
                pageindex=1;
                
            }
            function refresh()
            {
                
                
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var jsontext=JSON.parse(this.responseText);
                        var myhtml="";
                        var tempn;
                        if(jsontext.length<20 || nmessage>=jsontext.length)
                        {
                            tempn=jsontext.length;
                        }
                        else
                        {
                            myhtml="<center><i class='fa fa-arrow-up fa-lg' aria-hidden='true' style='color:white;background-color:black;width:40px;height:40px;border-radius:20px;margin:10px;' onclick='goup()'></i></center>";
                            tempn=nmessage;
                        }
                        for (var i=jsontext.length-tempn;i<jsontext.length;i++)
                        {
                            if('<?php echo $userid ?>'==jsontext[i].name)
                            {
                                if(jsontext[i].type=='image')
                                {
                                    myhtml=myhtml+"<div style='width:80%;height:auto;padding:5px;background-color:skyblue;text-align:left;border-radius:10px;right:0;position:relative;'><div style='color:black;'>"+jsontext[i].name+" (You)</div><div style='width:100%;height:auto;background-color:white;border-radius:5px;padding-top:10px;padding-bottom:10px;word-wrap:break-word;'><a target='_blank' href='"+jsontext[i].message+"'><img style='width:100%;height:auto;' src='"+jsontext[i].message+"'></a><br> <div style='font-size:10px;width:100%;text-align:right;color:gray;'>"+jsontext[i].timestamp+"</div></div></div><br>";
                                }
                                else
                                {
                                    myhtml=myhtml+"<div style='width:80%;height:auto;padding:5px;background-color:skyblue;text-align:left;border-radius:10px;right:0;position:relative;'><div style='color:black;'>"+jsontext[i].name+" (You)</div><div style='width:100%;height:auto;background-color:white;border-radius:5px;padding-top:10px;padding-bottom:10px;word-wrap:break-word;'>"+jsontext[i].message+"<br> <div style='font-size:10px;width:100%;text-align:right;color:gray;'>"+jsontext[i].timestamp+"</div></div></div><br>";
                                }
                                
                            }
                            else
                            {
                                if(jsontext[i].type=='image')
                                {
                                    myhtml=myhtml+"<div style='width:80%;height:auto;padding:5px;background-color:orange;text-align:left;border-radius:10px;'><div style='color:black;'>"+jsontext[i].name+" (User)</div><div style='width:100%;height:auto;background-color:white;border-radius:5px;padding-top:10px;padding-bottom:10px;word-wrap:break-word;'><a target='_blank' href='"+jsontext[i].message+"'><img style='width:100%;height:auto;' src='"+jsontext[i].message+"'></a><br> <div style='font-size:10px;width:100%;text-align:right;color:gray;'>"+jsontext[i].timestamp+"</div></div></div><br>";
                                }
                                else
                                {
                                    myhtml=myhtml+"<div style='width:80%;height:auto;padding:5px;background-color:orange;text-align:left;border-radius:10px;'><div style='color:black;'>"+jsontext[i].name+" (User)</div><div style='width:100%;height:auto;background-color:white;border-radius:5px;padding-top:10px;padding-bottom:10px;word-wrap:break-word;'>"+jsontext[i].message+"<br> <div style='font-size:10px;width:100%;text-align:right;color:gray;'>"+jsontext[i].timestamp+"</div></div></div><br>";
                                }
                            }
                        }
                        var sendcolor=document.getElementById("sending").style.color;
                        myhtml=myhtml+"<div id='sending' style='color:"+sendcolor+";'>Sending...</div><br><div style='margin:10px;margin-top:50px;color:#d0f0c0;' id='lastdiv'>.</div>"
                        
                        var bottom=divvisible(document.getElementById("lastdiv"));
                        if(pageindex==1)
                        {
                            var prevheight=document.getElementById("allmessages").scrollHeight;
                        }
                        document.getElementById("allmessages").innerHTML=myhtml;
                        if(bottom==1)
                        {
                            window.setTimeout(scrolltobottom,300);
                            //scrolltobottom();
                        }
                        
                        if(pageindex==1)
                        {
                            window.scrollTo(0,document.getElementById("allmessages").scrollHeight-prevheight);
                            pageindex=0;
                        }
                        
                        
                    }
                };
                xhttp.open("POST", "allmessages.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("getmessage=true");
                
            }
            function isElementInViewport (el) {
            if (typeof jQuery === "function" && el instanceof jQuery) {
                el = el[0];
            }

            var rect = el.getBoundingClientRect();

            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && /* or $(window).height() */
                rect.right <= (window.innerWidth || document.documentElement.clientWidth) /* or $(window).width() */
            );
            }
            
            function divvisible(myel)
            {
                if(isElementInViewport (myel))
                {
                    return 1;
                }
                else
                {
                    return 0;
                }
            }
            
            function scrolltobottom()
            {
                window.scrollTo(0,document.getElementById("allmessages").scrollHeight);
            }
        </script>
    </body>
</html>