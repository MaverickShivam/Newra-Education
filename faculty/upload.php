<?php
session_start();
    // copied function
    //old code

if(isset($_POST["submit"]))
{
    $conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
    $sql="SELECT * FROM advquiz WHERE quizcode= '".$_SESSION["quizcode"]."'";
    $result=$conn->query($sql);
    
    
    
    function compress_image($source_url, $destination_url, $quality)
    {
        $info = getimagesize($source_url);
        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
        
        if(function_exists('exif_read_data'))
        {
            $exif=exif_read_data($source_url);
            if(!empty($exif) && isset($exif['Orientation']))
            {
                $orientation=$exif['Orientation'];
                $deg=0;
                switch ($orientation) {
                    case 3:
                        $deg = 180;
                        break;
                    case 6:
                        $deg = 270;
                        break;
                    case 8:
                        $deg = 90;
                        break;
                }
                
                $image = imagerotate($image, $deg, 0);  
                imagejpeg($image, $destination_url, $quality);
                
            }
            else
            {
                imagejpeg($image, $destination_url, $quality);
            }
        }
        else
        {
            imagejpeg($image, $destination_url, $quality);
        }
    }
    
    
    while($row=$result->fetch_assoc())
    {   
        if($_FILES[$row["quizcode"].'file'.$row["qno"]]["error"]!=0)
        {
            continue;
        }
        $file_name=$_FILES[$row["quizcode"].'file'.$row["qno"]]["name"];
        $file_type=$_FILES[$row["quizcode"].'file'.$row["qno"]]["type"];
        $temp_name=$_FILES[$row["quizcode"].'file'.$row["qno"]]["tmp_name"];
        if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
        {
            if(strlen($row["link"])>0)
            {
                unlink($row["link"]);
            }
            $file_ext=explode(".",$file_name);
            $file_name="uploads/" .round(microtime(true) * 1000).".".end($file_ext);
            $filename = compress_image($temp_name, $file_name, 20);
            $linksql="update advquiz set link='".$file_name."' where quizcode='".$row["quizcode"]."' and qno=".$row["qno"];
            $linkresult=$conn->query($linksql);
        }
    }
    $sql="SELECT * FROM advquiz WHERE quizcode= '".$_SESSION["quizcode"]."'";
    $result=$conn->query($sql);
    while($row=$result->fetch_assoc())
    { 
        $updatesql="update advquiz set qtext='".$_POST[$row["qno"]."qtext"]."',option1='".$_POST[$row["qno"]."op1"]."',option2='".$_POST[$row["qno"]."op2"]."',option3='".$_POST[$row["qno"]."op3"]."',option4='".$_POST[$row["qno"]."op4"]."',time=".$_POST[$row["qno"]."time"].",answer=".$_POST[$row["qno"]."answer"]." where quizcode='".$row["quizcode"]."' and qno=".$row["qno"];
        $conn->query($updatesql);
    }
    ?>
    <script>
        alert("updated");
        window.location.reload(window.history.back());
    </script>
    <?php
    
    
}
?>
