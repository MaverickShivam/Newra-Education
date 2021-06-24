<?php
session_start();
$mainid="";
if(isset($_GET["fileurl"]))
{
$filelink=$_GET["fileurl"];
$imparray=explode("/",$filelink);
for($i=0;$i<count($imparray);$i++)
{
    if($imparray[$i]=="d")
    {
        $mainid=$imparray[$i+1];
        break;
    }
}
if($mainid=="")
{
    $imparray2=explode("=",$filelink);
    $mainid=$imparray2[1];
}
$mainid="https://drive.google.com/file/d/".$mainid."/preview";
}
?>
<html>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <body bgcolor="black" style="height=100%;" >
        <center><div>Resources</div></center>
        <iframe src="<?php echo $mainid; ?>" width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" allowfullscreen="true" style="">Loading...</iframe>
        <div id="frame" style="margin-top:50px;">.</div>
        <script>
            window.setInterval(chalo,100);
            function chalo()
            {
                document.getElementById("frame").scrollIntoView();
            }
            
        </script>
    </body>
</html>