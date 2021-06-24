<?php
if(isset($_GET["link"]))
{
    $array=explode("/",$_GET["link"]);
    $id=$array[(count($array)-1)];
    $link="https://www.youtube.com/embed/".$id."?rel=0";
}
else
{
    die;
}

?>
<html>
    
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body style="margin:0;padding:0;" bgcolor="black">
        <iframe width="100%" height="100%" src="<?php echo $link ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen="allowfullscreen"></iframe>
    
        </iframe>
    <div style="position:fixed;top:0;width:100%;height:100px;background-color:Transparent;"></div>
<script>
    $('body').mousedown(function (e) {
  if(e.button == 2) { // right click
    return false; // do nothing!
  }
}
window.onbeforeunload=function (){
            document.body.style["filter"]="opacity(30%)";
        };
</script>
    </body>
</html>
