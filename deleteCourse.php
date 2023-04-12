<?php
$cosid = $_GET['cosid'];

//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}
function deleteCourse($mysqli, $cosid)
{
    $sql = "DELETE FROM `course` WHERE `cosid` = '$cosid';";
    if ($mysqli->query($sql)) {
        $arr = array('status' => 200);
        echo json_encode($arr);
    }
}
deleteCourse($mysqli,$cosid);