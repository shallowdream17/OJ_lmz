<div style="width: 90%; margin: 10px auto; border: 1px solid #ccc; text-align: center">
    <a align="center" class="blue" href="logout.php"><input type="submit" value="注销"/></a>
    <?php
    header("Content-Type: text/html;charset=utf-8");
    session_start();
    if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) {
        $page = isset($_GET['page']) ? $_GET['page'] : 0;//从零开始

        $imgnums = 1;    //每页显示的图片数

        $path = "upload";   //图片保存的目录

        $handle = opendir($path);


        $i = 0;

        while (false !== ($file = readdir($handle))) {

            list($filesname, $ext) = explode(".", $file);

            if ($ext == "gif" or $ext == "jpg" or $ext == "JPG" or $ext == "GIF" or $ext == "png") {

                if (!is_dir('./' . $file)) {

                    $array[] = $file;//保存图片名称

                    ++$i;

                }

            }

        }


        if ($array) {

            rsort($array);//修改日期倒序排序

        }


        for ($j = $imgnums * $page; $j < ($imgnums * $page + $imgnums) && $j < $i; ++$j) {

            echo '<div>';

            echo $array[$j], '<br />';

            echo "<img width=200 height=200 src=" . $path . "/" . $array[$j] . "><br />";//'<img widht=200 height=200 src="'.$v.'">'

            echo '</div>';

        }


        $realpage = @ceil($i / $imgnums) - 1;

        $Prepage = $page - 1;

        $Nextpage = $page + 1;

        if ($Prepage < 0) {

            echo "上一页 ";

            echo "<a href=?page=$Nextpage>下一页</a> ";

            echo "<a href=?page=$realpage>最末页</a> ";

        } elseif ($Nextpage >= $realpage) {

            echo "<a href=?page=0>首页</a> ";

            echo " <a href=?page=$Prepage>上一页</a> ";

            echo " 下一页";

        } else {

            echo "<a href=?page=0>首页</a> ";

            echo "<a href=?page=$Prepage>上一页</a> ";

            echo "<a href=?page=$Nextpage>下一页</a> ";

            echo "<a href=?page=$realpage>最末页</a> ";

        }
    }
    else{
        echo"<script type="."\""."text/javascript"."\"".">"."window.alert"."("."\""."请先登录"."\"".")".";"."</script>";
        echo"<script type="."\""."text/javascript"."\"".">"."window.location="."\""."index.php"."\""."</script>";
    }
    ?>

</div>
