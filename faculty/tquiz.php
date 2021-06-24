<?php
session_start();
if(!isset($_SESSION["registeredid"]))
{
    ?>
    <script>
        window.open("teacherlogin.html","_self");
    </script>
    <?php
}

if(!isset($_SESSION["coursecode"]))
{
    ?>
    <script>
        window.open("teachermenu.php","_self");
    </script>
    <?php
}
$conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
if(isset($_POST["deleteit"]))
{
    $deletesql="delete from filelinks where filelink='".$_POST["deleteit"]."' and id=".$_SESSION["registeredid"];
    if(strpos($_POST["deleteit"],"faculty")>0)
    {
        chmod($_POST["deleteit"], 0644);
        unlink($_POST["deleteit"]);
    }
    $deleteresult=$conn->query($deletesql);
    ?>
    <script>
        window.history.back();
    </script>
    <?php
}
else
{
    if(isset($_POST["1"]))
    {
        ?>
        <script>
            window.history.back();
            window.open('pdfviewer.php?pdflink=<?php echo $_POST["1"] ?>',"_blank"); 
        </script>
        <?php
       
    }
    if(isset($_POST["2"]))
    {
        ?>
        <script>
            window.history.back();
            window.open('<?php echo $_POST["2"] ?>',"_blank"); 
        </script>
        <?php
    }
    if(isset($_POST["6"]))
    {
        $_POST["6"]="driveviewer.php?fileurl=".$_POST["6"];
        header("Location:".$_POST["6"]);
        die;
    }
    if(isset($_POST["3"]))
    {
        $_POST["3"]="quiz.php?quizid=".$_POST["3"];
        header("Location:".$_POST["3"]);
        die;
    }
    if(isset($_POST["4"]))
    {
        $_POST["4"]="youtubeviewer.php?link=".$_POST["4"];
        header("Location:".$_POST["4"]);
        die;
    }
    if(isset($_POST["5"]))
    {
        header("Location:".$_POST["5"]);
        die;
    }
}
if(isset($_POST["adddoc"]))
{
    if($_POST["filetype"]==1 or $_POST["filetype"]==2)
    {
    if($_POST["filetype"]==1)
    {
        $myfilename='pdffile';
    }
    else if($_POST["filetype"]==2)
    {
        $myfilename='imagefile';
    }
    if(isset($_FILES[$myfilename]))
    {
      $errors= array();
      $file_name = $_FILES[$myfilename]['name'];
      $file_size =$_FILES[$myfilename]['size'];
      $file_tmp =$_FILES[$myfilename]['tmp_name'];
      $file_type=$_FILES[$myfilename]['type'];
      $file_ext=strtolower(end(explode('.',$_FILES[$myfilename]['name'])));
      if($file_size > 20000000){
         $errors[]='File size can not be above 20MB';
      }
      
      if(empty($errors)==true){
          $finallink="uploads/".round(microtime(true) * 1000).".".$file_ext;
         move_uploaded_file($file_tmp,$finallink);
      }
      else
      {
         print_r($errors);
         die;
      }
    }
    $_POST["linkinput"]="../faculty/".$finallink;
    }
    $insertsql="INSERT INTO filelinks VALUES(".$_SESSION["registeredid"].",'".$_SESSION["coursecode"]."','".$_POST["linkinput"]."',".$_POST["filetype"].",'".$_POST["titleinput"]."')";
    $insertresult=$conn->query($insertsql);
    ?>
    <script>
        window.history.back();
    </script>
    
    <?php
}
?>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="theme-color" content="#132743" />
</head>
<body style="margin:0;padding:0;height:100%;">
        <div style="width:100%;height:50px;background-color:rgba(47,85,151,1);color:white;text-align:left;">
            <div style="padding-top:15px;padding-left:20px;">
                <i class="fa fa-arrow-left" style="margin:0px 20px 0px 5px;" onclick="goback()"></i>
                Resources
                <b style="right:30px;position:absolute;border:2px solid white;padding:0px 10px 0px 10px;border-radius:10px;" onclick="openpopup()">+</b>
            </div>
        </div>
    <br>
    <form method="post" action="" >
    <?php
        $sql="select * from filelinks where coursecode='".$_SESSION["coursecode"]."'";
        $result=$conn->query($sql);
        $mytext="";
        while($row=$result->fetch_assoc())
        {
            $mytext=$mytext."<button style='width:100%;height:100px;background-color:#ccffff;color:black;text-align:left;border:none;border-bottom:2px solid orange;outline:none;' type='submit' name='".$row["filetype"]."' value='".$row["filelink"]."'> <div style='display:inline;'><img src='../../images/filetype".$row["filetype"].".png' height='80px' width='80px' style='margin-top:0px;margin-left:10px;'></div><div style='width:40%;height:80px;background-color:Transparent;display:inline-block;position:absolute;'><div style='padding:20px;'>".$row["filetitle"]."</div></div><button type='submit' style='position:absolute;right:20px;margin-top:35px;outline:none;background-color:Transparent;border:none;' name='deleteit' value='".$row["filelink"]."'><img src='../../images/delete1.png' height='25px' width='25px' style='position:absolute;right:10px;'></button></button><br><br>";
        }
        echo $mytext;
    ?>
    </form>
    <form method="post" action="" enctype="multipart/form-data" id="myform" onsubmit="return uploading()">
    <center><div id="popup" onblur="closepopup()" style="box-shadow: 5px 10px 18px #888888;border:1px solid lightgray;height:500px;width:80%;background-color:white;position:fixed;top:15%;left:10%;display:none;"><img src="cross.png" height='30px' width='30px' style="position:absolute;top:3;right:3;" onclick="closepopup()" >
    <br>
    <br>
    <div style="width:90%;height:70px;background-color:#fffcbb;padding:1%;">
    What Document you want to upload?
    <br>
    <br>
    <select name="filetype" id="filetype" onchange="checkfiletype()">
        <option value="0">Select</option>
        <option value="1">PDF</option>
        <option value="2">Image</option>
        <option value="3">G Form/Quiz</option>
        <option value="4">YouTube</option>
        <option value="5">Other</option>
    </select></div>
    <br>
    <div style="width:90%;height:70px;background-color:#fffcbb;padding:1%;display:none;" id="link">
        Document Link
        <br>
        <br>
        <input id="linkinput" oninput="checkurl()" name="linkinput">
    </div>
    <div style="width:90%;height:70px;background-color:#fffcbb;padding:1%;display:none;" id="uploadpdf">
        PDF File
        <br>
        <br>
        <input type="file" id="pdfuploader" style="width:100%;" name="pdffile" />
    </div>
    <div style="width:90%;height:70px;background-color:#fffcbb;padding:1%;display:none;" id="uploadimage">
        Image File
        <br>
        <br>
        <input type="file" id="imageuploader" style="width:100%;" name="imagefile" />
    </div>
    <br>
    <div style="width:90%;height:70px;background-color:#fffcbb;padding:1%;display:none;" id="title">
        Title
        <br>
        <br>
        <input id="titleinput" oninput="checktitle()" onfocusout="checktitle()" name="titleinput">
    </div>
    <br>
    <br>
    <br>
    <button id="adddoc" style="background-color:green;color:white;width:50%;height:50px;display:none;" name="adddoc" type="submit" >Submit</button>
    
    </form>
    </div></center>
    <script>
            window.onbeforeunload=function (){
                document.body.style["filter"]="opacity(30%)";
            };
            
            function goback()
            {
                window.history.back();
            }
    function uploading()
    {
        document.getElementById("adddoc").innerHTML="Please Wait...";
        return true;
    }
    function clearall()
    {
        document.getElementById("myform").reset();
    }
    
    function validURL(str) {
    var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
    '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return !!pattern.test(str);
    }
        function openpopup()
        {
            clearall();
            checkfiletype();
            document.getElementById("popup").style.display="block";
        }
        function closepopup()
        {
            document.getElementById("popup").style.display="none";
        }
        
        function checkfiletype()
        {
            if(document.getElementById("filetype").value!=0)
            {
                if(document.getElementById("filetype").value==1)
                {
                    document.getElementById("link").style.display="none";
                    document.getElementById("uploadimage").style.display="none";
                    document.getElementById("uploadpdf").style.display="block";
                }
                else if(document.getElementById("filetype").value==2)
                {
                    document.getElementById("link").style.display="none";
                    document.getElementById("uploadpdf").style.display="none";
                    document.getElementById("uploadimage").style.display="block";
                }
                else
                {
                    document.getElementById("uploadpdf").style.display="none";
                    document.getElementById("uploadimage").style.display="none";
                    document.getElementById("link").style.display="block";
                }
                
            }
            else
            {
                document.getElementById("link").style.display="none";
                document.getElementById("title").style.display="none";
                document.getElementById("adddoc").style.display="none";
                document.getElementById("uploadpdf").style.display="none";
                document.getElementById("uploadimage").style.display="none";
            }
            
        }
        
        $("#pdfuploader").change(function () {
            var fileExtension = ['pdf'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                document.getElementById("title").style.display="none";
                document.getElementById("adddoc").style.display="none";
                alert("Only formats are allowed : "+fileExtension.join(', '));
            }
            else
            {
                document.getElementById("uploadpdf").style.display="block";
                document.getElementById("title").style.display="block";
            }
            
        });
        $("#imageuploader").change(function () {
            var fileExtension = ['jpeg', 'jpg', 'png'];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                document.getElementById("title").style.display="none";
                document.getElementById("adddoc").style.display="none";
                alert("Only formats are allowed : "+fileExtension.join(', '));
            }
            else
            {
                document.getElementById("uploadimage").style.display="block";
                document.getElementById("title").style.display="block";
            }
        });
        function checkurl()
        {
            if(validURL(document.getElementById("linkinput").value))
            {
                document.getElementById("title").style.display="block";
            }
            else
            {
                document.getElementById("title").style.display="none";
                document.getElementById("adddoc").style.display="none";
            }
        }
        function checktitle()
        {
            if((document.getElementById("title").value)!="")
            {
                document.getElementById("adddoc").style.display="block";
            }
            else
            {
                document.getElementById("adddoc").style.display="none";
            }
        }
    </script>
</body>
</html>