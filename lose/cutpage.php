<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .blue{
            color:gold;
            font-size:30px;
        }
    </style>
    <meta charset="UTF-8">
    <title>登录</title>
</head>
<body >
<img style="position:absolute;left:0px;top:0px;width:100%;height:100%;z-Index:-1; border=none; solid blue" src="http://pic.bizhi360.com/bbpic/27/6727.jpg"  />
<a align="center" class="blue" href="logout.php"><input type="submit" value="注销"/></a>
<a align="center" class="blue" href="lose/choose.php"><input type="submit" value="图片上传"/></a>
</body>
</html>
<?php
session_start();
if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
    header("Content-Type: text/html;charset=utf-8");
//数据库服务器
    define('DB_HOST', 'localhost');
//数据库用户名
    define('DB_USER', 'root');
//数据库密码
    define('DB_PWD', 'root');
//库名
    define('DB_NAME', 'user_login');
//字符集
    define('DB_CHARSET', 'utf8');
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_NAME);
    if (mysqli_errno($conn)) {
        mysqli_error($conn);
        exit;
    }
    mysqli_set_charset($conn, DB_CHARSET);


    $count_sql = 'select count(username) as c from users';

    $result = mysqli_query($conn, $count_sql);

    $data = mysqli_fetch_assoc($result);

//得到总的用户数
    $count = $data['c'];

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

//每页显示数

    $num = 5;

//这是总页数
    $total = ceil($count / $num);

    if ($page <= 1) {
        $page = 1;
    }

    if ($page >= $total) {
        $page = $total;
    }


    $offset = ($page - 1) * $num;

    $sql = "select username,password from users order by username desc limit $offset , $num";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result)) {

        //存在数据则循环将数据显示出来
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo '<table border="1" cellpadding="3" cellspacing="0" style="width: 60%;margin:auto">';

        while ($row = mysqli_fetch_assoc($result)) {

            echo '<tr>';
            echo '<td alion="center" valign="center">' . $row['username'] . '</td>';
            echo '<td alion="center" valign="center">' . $row['password'] . '</td>';
            echo '</tr>';
        }

        echo '<tr><td colspan="5"><a href="cutpage.php?page=1">首页</a>  <a href="cutpage.php?page=' . ($page - 1) . '">上一页</a>   <a href="cutpage.php?page=' . ($page + 1) . '">下一页</a>  <a href="cutpage.php?page=' . $total . '">尾页</a>  当前是第 ' . $page . '页  共' . $total . '页 </td></tr>';

        echo '</table>';

    } else {
        echo '没有数据';
    }

    mysqli_close($conn);
}
else{
    echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."请先登录"."\"".")".";"."</script>";
    echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";
}