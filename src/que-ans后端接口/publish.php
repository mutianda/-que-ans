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
    $title=mysqli_real_escape_string($con,trim($_POST['title']));
    $username=mysqli_real_escape_string($con,trim($_POST['username']));
    $text=mysqli_real_escape_string($con,trim($_POST['quecont']));;
    $now=$_SERVER['REQUEST_TIME'];
    $id=trim($_POST['id']);
    if(!$id){
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
    $sql = "INSERT INTO system (content,userid,create_time,updatetime,username,title) values
 ('$text','$id','$now','$now','$username','$title')";
    $obj = mysqli_query($con, $sql);
    $queid = mysqli_insert_id($con);
    if ($obj) {
        $queid = mysqli_insert_id($con);
        $res = array(
            "code" => 200,
            "msg" => "发布成功！谢谢您",
            "res" => $queid
        );
    } else {
        $res = array(
            "code" => 404,
            "msg" => "failed insert",
            "res" => Array()
        );
    }
}
echo(json_encode($res));
?>
