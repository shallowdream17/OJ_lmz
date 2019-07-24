<!DOCTYPE html>
<html>
<head>
    <style>
        .blue{
            color:deepskyblue;
            font-size:30px;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>注册用户</title>
</head>

<body background="http://pic.87g.com/upload/2018/1107/20181107083705759.jpg">
<img style="position:absolute;left:0px;top:0px;width:100%;height:100%;z-Index:-1; border=none; solid blue" src="http://pic.87g.com/upload/2018/1107/20181107083705759.jpg"  />
<?php
header("Content-Type: text/html;charset=utf-8");
//建立连接
$conn = mysqli_connect('139.196.160.174','root','woaixuexi.');
if($conn){
    $select = mysqli_select_db($conn,"user_login");		//选择数据库
    if(isset($_POST["subr"])){

        $user = $_POST["username"];
        $pass = $_POST["password"];
        $re_pass = $_POST["re_password"];

        if($user == ""||$pass == ""){
            //用户名or密码为空
            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."用户名或密码不能为空！"."\"".")".";"."</script>";
            echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."register.php"."\""."</script>";
            exit;
        }
        if($pass == $re_pass){
            //两次密码输入一致
            mysqli_set_charset($conn,'utf8');	//设置编码

            //sql语句
            $sql_select = "select username from users where username = '$user'";
            //sql语句执行
            $result = mysqli_query($conn,$sql_select);
            //判断用户名是否已存在
            $num = mysqli_num_rows($result);

            if($num){
                //用户名已存在
                echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."用户名已存在！"."\"".")".";"."</script>";
                echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."register.php"."\""."</script>";
                exit;
            }else{
                //用户名不存在
                $sql_insert = "insert into users(username,password) values('$user','$pass')";
                //插入数据
                $ret = mysqli_query($conn,$sql_insert);
                $row = mysqli_fetch_array($ret);
                //跳转注册成功页面
                echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."恭喜注册成功"."\"".")".";"."</script>";

                echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."registersucc.php"."\""."</script>";
            }
        }else{
            //两次密码输入不一致
            echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."两次密码输入不一致！"."\"".")".";"."</script>";
            echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."register.php"."\""."</script>";
        }
    }
    //关闭数据库
    mysqli_close($conn);
}else{
    //连接错误处理
    die('Could not connect:'.mysql_error());
}

?>
<form action = "register.php" method = "post">
    <p align="center" class="blue">用户名:<input type="text" name="username"></p>
    <p align="center" class="blue">密码:<input type="text" name="password"></p>
    <p align="center" class="blue">确认密码:<input type = "text" name = "re_password"></p>
    <p align="center"><input type="submit" value="立即注册" name="subr"></p>
</form>
</body>
</html>

