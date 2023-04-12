<?php
header("Access-Control-Allow-Origin:*");
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
$date = new DateTime();
$applyTime = $date->format('Y-m-d H:i:s');
$sql2 = "insert into apply(sid, deviceid, time, flag, apply_nums) VALUES ('$sid', '$deviceid', '$applyTime', '未批准', '$borrow_nums');";
if ($mysqli->query($sql2) === TRUE) {
    $arr = array('status' => 200);
    echo json_encode($arr);
} else {
    $arr = array('status' => 500);
    echo json_encode($arr);
}

?>