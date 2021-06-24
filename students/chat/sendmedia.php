<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $file_name = $_FILES["image_file"]["name"];
    $file_type = $_FILES["image_file"]["type"];
    $temp_name = $_FILES["image_file"]["tmp_name"];
    $file_size = $_FILES["image_file"]["size"];
    $error = $_FILES["image_file"]["error"];
    if (!$temp_name)
    {
        echo "ERROR: Please browse for file before uploading";
        exit();
    }
    
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
       
        date_default_timezone_set("Asia/Kolkata");
        $conn=mysqli_connect("localhost","yngvbtgj_maverickshivam","Vaishmaverick@123","yngvbtgj_edusgtb");
        if(isset($_SESSION["registeredusn"]))
        {
            $sql="INSERT INTO `".$_SESSION["coursecode"]."`(`timestamp`, `name`, `type`, `message`) VALUES ('".date('d M h:i A')."','".$_SESSION["registeredusn"]."','image','".$destination_url."')";
            $conn->query($sql);
            echo "Image uploaded successfully.";
        }
        else if(isset($_SESSION["registeredid"]))
        {
            $namesql="select * from teachers where id=".$_SESSION["registeredid"];
            $result=$conn->query($namesql);
            $row=$result->fetch_assoc();
            
            $sql="INSERT INTO `".$_SESSION["coursecode"]."`(`timestamp`, `name`, `type`, `message`) VALUES ('".date('d M h:i A')."','".$row["name"]."','image','".$destination_url."')";
            $conn->query($sql);
            echo "Image uploaded successfully.";
        }
        
    }
    if ($error > 0)
    {
        echo $error;
    }
    else if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
    {
        $filename = compress_image($temp_name, "uploads/" .round(microtime(true) * 1000).".". array_pop(explode(".",$file_name)), 20);
    }
    else
    {
        echo "Uploaded image should be jpg or gif or png.";
    }
} ?>
