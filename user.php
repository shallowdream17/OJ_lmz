<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>上传图片</title>
</head>
<body>
<form action="Upimage_judge.php" method="post" enctype="multipart/form-data">
    <input type="file" name="userImg" >
    <input type="submit" value="上传">
</form>
<a align="center" class="blue" href="logout.php"><input type="submit" value="注销"/></a>
<a align="center" class="blue" href="read_photo.php"><input type="submit" value="我的上传"/></a>
</body>
</html>
<?php
session_start();
if (!(isset($_SESSION["judge"]) && $_SESSION["judge"] === true)){
    echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."请先登录"."\"".")".";"."</script>";
    echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";
}
?>