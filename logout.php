<?php session_start();?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>session安全退出</title>
</head>

<body>
<?php
session_start();
//  这种方法是将原来注册的某个变量销毁
unset($_SESSION['admin']);
//  这种方法是销毁整个 Session 文件
session_destroy();
header("location:index.php");//跳转回去
?>
</body>
</html>