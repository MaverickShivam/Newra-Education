<?php
session_start();

if(!isset($_GET["quizid"]))
{
    header("Location:studentmenu.php");
    die;
}

$ids=explode("/",$_GET["quizid"]);
$id="";
for($i=0;$i<count($ids);$i++)
{
    if($ids[$i]=="e")
    {
        $id=$ids[$i+1];
    }
}
if($id=="")
{
    ?>
    <script>
        window.alert("Invalid Link Format");
        window.history.back();
    </script>
    <?php
}
else
{
    $quizlink="https://docs.google.com/forms/d/e/".$id."/viewform?embedded=true";
}
?>

<html>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <style>
        .body,
.wrapper {
  /* Break the flow */
  position: absolute;
  top: 0%;

  /* Give them all the available space */
  width: 100%;
  height: 100%;

  /* Remove the margins if any */
  margin: 0;

  /* Allow them to scroll down the document */
  overflow-y: hidden;
}

.body {
  /* Sending body at the bottom of the stack */
  z-index: 1;
}

.wrapper {
  /* Making the wrapper stack above the body */
  z-index: 2;
}
    </style>
    
    <body class="body" bgcolor="white" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        
            
        <iframe src="<?php echo $quizlink; ?>" class="wrapper" width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" >Loading…</iframe>
        <div id="cheating">.</div>
        <script>
            
            document.body.onblur=function(){
                alert("please close");
            };
        </script>
    </body>
</html>