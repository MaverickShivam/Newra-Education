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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <body style="margin:0;padding:0;" bgcolor="black">
        <iframe width="100%" height="50%" src="<?php echo $link ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
</iframe>
    </body>
</html>
