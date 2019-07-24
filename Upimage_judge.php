<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>上传图片</title>
</head>
<body>
<a align="center" class="blue" href="user.php"><input type="submit" value="再次上传"/></a>
</body>
</html>
<?php
//文件名：上传时间.随机数.文件后缀
header('content-type:text/html;charset=utf-8');
date_default_timezone_set("PRC");
session_start();
if (!(isset($_SESSION["judge"]) && $_SESSION["judge"] === true)){
    echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."请先登录"."\"".")".";"."</script>";
    echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";
}
$img=$_FILES['userImg'];
// echo "<pre>";
// var_dump($img);
// print_r($img);
// 服务器中文件的存放目录
$tmp_dir=$img['tmp_name'];
//用户上传的文件名（带后缀）
$fileName=$img['name'];
//用户上传的文件类型
$fileType=$img['type'];
//文件错误
$error=$img['error'];
//文件大小
$fileSize=$img['size'];

//允许的最大尺寸
$maxSize=2048*2000;
//文件允许的格式
$allow_type=array('image/jpeg','image/png','image/gif','image/jpg');

if($error!=0){
    echo '文件上传错误！';
    return;
}else if(!in_array($fileType,$allow_type)){//限制文件的格式
    echo '上传的文件类型错误！';
    return;
}else if($fileSize>$maxSize){
    echo "文件超过".$maxSize;
    return;
}else{
    //创建目录
    $fileDir='./upload/';
    if(!is_dir($fileDir)){
        mkdir($fileDir);
    }
    //文件名
    $newFileName = $_SESSION["user"]."_".(date('YmdHis',time()).rand(100,999));
    //文件后缀
    $FileExt=substr($fileName,strrpos($fileName,'.'));
    // echo $newFileName;

    //生成缩略图
    $img_info=getimagesize($tmp_dir);
    // var_dump($img_info);
    $width=$img_info[0]; //原图的宽
    $height=$img_info[1]; //原图的高
    $newWidth=$width*0.5;
    $newHeight=$height*0.5;

    //绘制画布
    $thumb=imagecreatetruecolor($newWidth, $newHeight);

    //移动源文件到指定的目录
    move_uploaded_file($tmp_dir,'./upload/'.$newFileName.$FileExt);
    echo '上传成功！';
}

?>