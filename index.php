<?php
header("Content-Type: text/html;charset=utf-8");
//建立连接
$conn = mysqli_connect('139.196.160.174/localhost','root','woaixuexi.');
session_start();
$_SESSION["admin"] = null;
$_SESSION["user"] = null;
$_SESSION["judge"] = null;
if($conn){
    //数据库连接成功
    $select = mysqli_select_db($conn,"user_login");		//选择数据库
    if($select){
        //数据库选择成功
        if(isset($_POST["subl"])){

            $user = $_POST["username"];
            $pass = $_POST["password"];
            if($user == ""||$pass == ""){
                //用户名or密码为空
                //弹窗提示信息并返回登陆页面
                echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."用户名或密码不能为空！"."\"".")".";"."</script>";
                echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";
                exit;
            }

            //sql语句
            $sql_select = "select username,password from users where username = '$user' and password = '$pass'";
            //设置编码
            mysqli_query($conn,'SET NAMES UTF8');
            //执行sql语句
            $ret = mysqli_query($conn,$sql_select);
            $row = mysqli_fetch_array($ret);
            if($user != $row['username']||$pass != $row['password']){
                //用户名or密码错误
                //弹窗提示信息并返回登陆页面
                echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."用户名或密码错误"."\"".")".";"."</script>";
                echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";
                exit;
            }
            //用户密码正确
            if($user == $row['username']&&$pass == $row['password']){
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                if($user=="a_0000") {


                    $_SESSION["admin"] = true;
                    //跳转登陆成功页面
                    header("Location:admin.php");
                }else{
                    $_SESSION["user"] = $user;
                    $_SESSION["judge"] = true;
                    header("Location:user.php");
                }
            }else{
                //跳转登陆失败页面,已写好
                header("Location:loginfal.php");
            }
        }
    }
    //关闭数据库
    mysqli_close($conn);
}else{
    //连接错误处理
    die('Could not connect:'.mysql_error());
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>颜如玉·登陆</title>
    <link rel="stylesheet" href="layui/css/layui.css" media="all"/>
    <link rel="stylesheet" href="css/login.css" media="all"/>
    <style>
        /* 覆盖原框架样式 */
        .layui-elem-quote{background-color: inherit!important;}
        .layui-input, .layui-select, .layui-textarea{background-color: inherit; padding-left: 30px;}
    </style>
</head>
<body>

<!-- Head -->
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-sm12 layui-col-md12 zyl_mar_01">
            <blockquote class="layui-elem-quote">颜如玉登录注册界面</blockquote>
        </div>
    </div>
</div>
<!-- Head End -->

<!-- Carousel -->
<div class="layui-row">
    <div class="layui-col-sm12 layui-col-md12">
        <div class="layui-carousel zyl_login_height" id="zyllogin" lay-filter="zyllogin">
            <div carousel-item="">
                <div>
                    <div class="zyl_login_cont"></div>
                </div>
                <div>
                    <img src="img/carousel/01.jpg" />
                </div>
                <div>
                    <div class="background">
                        <span></span><span></span><span></span>
                        <span></span><span></span><span></span>
                        <span></span><span></span><span></span>
                        <span></span><span></span><span></span>
                    </div>
                </div>
                <div>
                    <img src="img/carousel/03.jpg" />
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->

<!-- Footer -->
<div class="layui-row">
    <div class="layui-col-sm12 layui-col-md12 zyl_center zyl_mar_01">
        © 2019 - 登录注册界面 || 颜如玉登录注册界面版权所有
    </div>
</div>
<!-- Footer End -->



<!-- LoginForm -->

<div class="zyl_lofo_main">
    <fieldset class="layui-elem-field layui-field-title zyl_mar_02">
        <legend>欢迎登陆 - 颜如玉管理平台</legend>

    </fieldset>
    <div class="layui-row layui-col-space15">
        <form class="layui-form zyl_pad_01" action="index.php" method = "post">

            <div class="layui-col-sm12 layui-col-md12">
                <div class="layui-form-item">
                    <input type="text" name="username"  placeholder="账号" class="layui-input">
                    <i class="layui-icon layui-icon-username zyl_lofo_icon"></i>
                </div>
            </div>
            <br/><br/>
            <div class="layui-col-sm12 layui-col-md12">
                <div class="layui-form-item">
                    <input type="text" name="password" lay-verify="required|pass" autocomplete="off" placeholder="密码" class="layui-input">
                    <i class="layui-icon layui-icon-password zyl_lofo_icon"></i>
                </div>
            </div>

            <div class="layui-col-sm12 layui-col-md12">
                <div class="layui-row">
                    <div class="layui-col-xs4 layui-col-sm4 layui-col-md4">
                        <div class="layui-form-item">
                            <input type="text" name="vercode" id="vercode" lay-verify="required|vercodes" autocomplete="off" placeholder="验证码" class="layui-input" maxlength="4">
                            <i class="layui-icon layui-icon-vercode zyl_lofo_icon"></i>
                        </div>
                    </div>
                    <div class="layui-col-xs4 layui-col-sm4 layui-col-md4">
                        <div class="zyl_lofo_vercode zylVerCode" onclick="zylVerCode()"></div>
                    </div>
                </div>
            </div>
            <br/><br/>
            <div class="layui-col-sm12 layui-col-md12">
                <br/>
                <button class="layui-btn layui-btn-fluid"  type = "submit"  name = "subl">立即登录</button>
                <br/><br/>
                <p align="center" class="blue"></palign><a href = "register.php">没有账号，立即注册</a> </p>
            </div>
        </form>
    </div>
</div>
<!-- LoginForm End -->


<!-- Jquery Js -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- Layui Js -->
<script type="text/javascript" src="layui/layui.js"></script>
<!-- Jqarticle Js -->
<script type="text/javascript" src="assembly/jqarticle/jparticle.min.js"></script>
<!-- ZylVerificationCode Js-->
<script type="text/javascript" src="assembly/zylVerificationCode/zylVerificationCode.js"></script>
<script>
    layui.use(['carousel', 'form'], function(){
        var carousel = layui.carousel
            ,form = layui.form;

        //自定义验证规则
        form.verify({
            userName: function(value){
                if(value.length < 5){
                    return '账号至少得5个字符';
                }
            }
            ,pass: [/^[\S]{6,12}$/,'密码必须6到12位，且不能出现空格']
            ,vercodes: function(value){
                //获取验证码
                var zylVerCode = $(".zylVerCode").html();
                if(value!=zylVerCode){
                    return '验证码错误（区分大小写）';
                }
            }
            ,content: function(value){
                layedit.sync(editIndex);
            }
        });




        //设置轮播主体高度
        var zyl_login_height = $(window).height()/1.3;
        var zyl_car_height = $(".zyl_login_height").css("cssText","height:" + zyl_login_height + "px!important");


        //Login轮播主体
        carousel.render({
            elem: '#zyllogin'//指向容器选择器
            ,width: '100%' //设置容器宽度
            ,height:'zyl_car_height'
            ,arrow: 'always' //始终显示箭头
            ,anim: 'fade' //切换动画方式
            ,autoplay: true //是否自动切换false true
            ,arrow: 'hover' //切换箭头默认显示状态||不显示：none||悬停显示：hover||始终显示：always
            ,indicator: 'none' //指示器位置||外部：outside||内部：inside||不显示：none
            ,interval: '5000' //自动切换时间:单位：ms（毫秒）
        });

        //监听轮播--案例暂未使用
        carousel.on('change(zyllogin)', function(obj){
            var loginCarousel = obj.index;
        });

        //粒子线条
        $(".zyl_login_cont").jParticle({
            background: "rgba(0,0,0,0)",//背景颜色
            color: "#fff",//粒子和连线的颜色
            particlesNumber:100,//粒子数量
            //disableLinks:true,//禁止粒子间连线
            //disableMouse:true,//禁止粒子间连线(鼠标)
            particle: {
                minSize: 1,//最小粒子
                maxSize: 3,//最大粒子
                speed: 30,//粒子的动画速度
            }
        });

    });

</script>
</body>

</html>
