<?php

header("Access-Control-Allow-Origin:*");


$uid = $_POST['user_id'];

//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}
function deleteUser($mysqli, $uid)
{
    $sql = "DELETE FROM `t_user_real` WHERE `user_id` = '$uid';";
    if ($mysqli->query($sql)) {
        $arr = array('status' => 200);
        echo json_encode($arr);
    }
}
deleteUser($mysqli,$uid);