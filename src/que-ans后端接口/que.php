<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 2018/11/9
 * Time: 10:13
 */
//date_default_timezone_set(‘Asia/Shanghai');
date_default_timezone_set("Asia/Shanghai");
echo date('Y-m-d H:i:s',$_SERVER['REQUEST_TIME']);