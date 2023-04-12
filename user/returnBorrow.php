<?php
header("Access-Control-Allow-Origin:*");
$borrowid = $_POST["borrowid"];
$deviceid = $_POST["deviceid"];
$borrow_nums = $_POST["borrow_nums"];
//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}
mysqli_set_charset($mysqli, 'utf8');   //选择字符集

$sql1 = "update device set available_nums = available_nums + '$borrow_nums' where deviceid = '$deviceid'";

$date = new DateTime();
$returntime = $date->format('Y-m-d H:i:s');

$sql2 = "update borrow set returntime = '$returntime', flag = '已归还' where borrowid = '$borrowid';";

if ($mysqli->query($sql1) === TRUE && $mysqli->query($sql2) === TRUE) {
    $arr = array('status' => 200);
    echo json_encode($arr);
} else {
    $arr = array('status' => 500);
    echo json_encode($arr);
}

?>