<?php
header("Access-Control-Allow-Origin: *");//这个必写，否则报错
//if(!empty($_GET['queid'])) {
//    $queid = trim($_GET['queid']);
//}
$queid=isset($_GET['queid'])&&is_numeric($_GET['queid'])?intval($_GET['queid']):'';
if(!$queid){
    $res = array(
        "code" => 404,
        "msg" => "id不能为空",
        "res" => Array()
    );
}else{

$mysqli=new mysqli('127.0.0.1','root','','que-ans');//根据自己的数据库填写
mysqli_set_charset($mysqli,"utf8");
    $quesql ="update system set view = view+1 where id ='$queid'LIMIT 1";
    $queview=$mysqli->query($quesql);
    $plsql ="update pinglun set view = view+1 where queid ='$queid'";
    $plview=$mysqli->query($plsql);
$sql="SELECT * from system where id ='$queid'LIMIT 1";
$queres=$mysqli->query($sql);
 $que = mysqli_fetch_assoc($queres);
$plsql="SELECT * from pinglun where queid ='$queid'";
$plres=$mysqli->query($plsql);

    $ans=array();
    while($anss = mysqli_fetch_assoc($plres)) {
        $ans[]=$anss;
    }
$res = array(
    "code" => 200,
    "msg" => "success",
    "id" =>$queid,
    "que" => $que,
    "ans" => $ans
);
    $mysqli->close();
}

echo(json_encode($res));




?>