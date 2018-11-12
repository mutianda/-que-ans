<?php
header("Access-Control-Allow-Origin: *");//这个必写，否则报错
$userid=isset($_GET['userid'])&&is_numeric($_GET['userid'])?intval($_GET['userid']):'';
if(!$userid){
    $res = array(
        "code" => 404,
        "msg" => "id不能为空",
        "res" => Array()
    );
}
$mysqli=new mysqli('127.0.0.1','root','','que-ans');//根据自己的数据库填写
mysqli_set_charset($mysqli,"utf8");
$sql="select * from system where userid ='$userid' ORDER BY create_time DESC";
$res=$mysqli->query($sql);

$arr=array();
while ($row=$res->fetch_assoc()) {
    $arr[]=$row;
}
$res->free();
//关闭连接
$mysqli->close();

echo(json_encode($arr));//这里用echo而不是return

?>