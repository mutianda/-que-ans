
<?php
header("Access-Control-Allow-Origin: *");//这个必写，否则报错
session_start();
//echo 'hello';
$arr=array();
if(!empty($_GET['username'])) {
    $username = trim($_GET['username']);
    $password = trim($_GET['password']);

    if (!$username) {
        $res = array(
            "code" => 404,
            "msg" => "no username",
            "res" => array()
        );

    }
    if (!$password) {

        $res = array(
            "code" => 404,
            "msg" => "no password ",
            "res" => array()
        );
    }
    $con = mysqli_connect('127.0.0.1', 'root', '', 'que-ans');
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());

    }

    mysqli_set_charset($con, "utf8");
    $sql = "select * FROM user
    WHERE username = '$username' LIMIT 1";

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    if (is_array($row) && !empty($row)) {
        if ($password === $row['password']) {
            $_SESSION['user'] = $row;
            $arr[] = $row;
            mysqli_free_result($result);
            $res = array(
                "code" => 200,
                "msg" => "success",
                "res" => $arr
            );
        } else {
            $res = array(
                "code" => 404,
                "msg" => "Password error",
                "res" => array()
            );

        }

    }else{
        $res = array(
            "code" => 404,
            "msg" => "用户名错误",
            "res" => array()
        );
    }
    echo(json_encode($res));
}
?>