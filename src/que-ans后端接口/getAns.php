<?php
header("Access-Control-Allow-Origin: *");//这个必写，否则报错
include_once './lib/fun.php';
session_start();
if(!empty($_POST['username'])) {
    $con = mysqli_connect('127.0.0.1', 'root', '', 'que-ans');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($con, "utf8");
    $content=mysqli_real_escape_string($con,trim($_POST['content']));
    $userid=trim($_POST['userid']);
    $username=mysqli_real_escape_string($con,trim($_POST['username']));
    $queid=trim($_POST['queid']);
    $now=$_SERVER['REQUEST_TIME'];

    if(!$userid){
        $res = array(
            "code" => 404,
            "msg" => "没有登录",
            "res" => Array()
        );
    }
    date_default_timezone_set("Asia/Shanghai");
    $now =date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);
//     $_SERVER['REQUEST_TIME'];
//检查上传文件是否合法
//    $namelength=mb_strlen($tltle,'utf-8');
//    if($namelength<=0||$namelength>30){
//        $res = array(
//            "code" => 404,
//            "msg" => "名称0-30",
//            "res" => Array()
//        );
//    }
//商品名称唯一性验证数据库处理
    $sql = "INSERT INTO pinglun (content,userid,create_time,updatetime,username,queid) values
 ('$content','$userid','$now','$now','$username','$queid')";
    $obj = mysqli_query($con, $sql);
    $pingid = mysqli_insert_id($con);
    if ($obj) {
        $sqlpl="update system set pinglun = pinglun +1 where id='$queid'LIMIT 1";
        $objpl=mysqli_query($con,$sqlpl);
        $res = array(
            "code" => 200,
            "msg" => "感谢指点迷津！谢谢您",
            "queid" => $queid
        );
    } else {
        $res = array(
            "code" => 404,
            "msg" => "出错了，sorry",
            "res" => Array()
        );
    }
}
echo(json_encode($res));
?>
