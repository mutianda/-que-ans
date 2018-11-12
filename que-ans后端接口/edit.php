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
    $queid=trim($_POST['id']);
    if(!$queid){
        $res = array(
            "code" => 404,
            "msg" => "没有此问题",
            "res" => Array()
        );
    }else{
    date_default_timezone_set("Asia/Shanghai");
    $now =date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);
    $sql = "update system set content = '$text',title= '$title',updatetime='$now'where id='$queid'LIMIT 1";
    $obj = mysqli_query($con, $sql);
    $queid = mysqli_insert_id($con);
    if ($obj) {
        $queid = mysqli_insert_id($con);
        $res = array(
            "code" => 200,
            "msg" => "修改成功！",
            "res" => $queid
        );
    } else {
        $res = array(
            "code" => 404,
            "msg" => "修改失败",
            "res" => Array()
        );
    }

    }
}
echo(json_encode($res));
?>
