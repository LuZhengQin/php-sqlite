<?php
header("Access-Control-Allow-Origin:*");
$apply_id = $_POST["apply_id"];
$deviceid = $_POST["deviceid"];
$devicename = $_POST['devicename'];
$sid = $_POST["sid"];
$borrow_nums = $_POST["borrow_nums"];
//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}
mysqli_set_charset($mysqli, 'utf8');   //选择字符集

$sql = "DELETE FROM `apply` WHERE `apply_id` = '$apply_id';";

$sql1 = "update device set available_nums = available_nums - '$borrow_nums' where deviceid = '$deviceid'";

$date = new DateTime();
$borrow_time = $date->format('Y-m-d H:i:s');

$sql2 = "insert into borrow(sid, deviceid, devicename, borrowtime, flag, borrow_nums) 
VALUES ('$sid', '$deviceid', '$devicename', '$borrow_time',  '未归还', '$borrow_nums');";

if ($mysqli->query($sql) === TRUE && $mysqli->query($sql1) === TRUE && $mysqli->query($sql2) === TRUE) {
    $arr = array('status' => 200);
    echo json_encode($arr);
} else {
    $arr = array('status' => 500);
    echo json_encode($arr);
}

?>