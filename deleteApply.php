<?php

header("Access-Control-Allow-Origin:*");


$apply_id = $_POST['apply_id'];

//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}
function deleteUser($mysqli, $apply_id)
{
    $sql = "DELETE FROM `apply` WHERE `apply_id` = '$apply_id';";
    if ($mysqli->query($sql)) {
        $arr = array('status' => 200);
        echo json_encode($arr);
    }
}
deleteUser($mysqli,$apply_id);