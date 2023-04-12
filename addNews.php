<?php
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Methods:*');

$title = $_POST["title"];
$time = $_POST["time"];
$detail = $_POST["detail"];
//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}
mysqli_set_charset($mysqli, 'utf8');   //选择字符集
$sql = "insert into `news` (title, time, detail) 
VALUES ('$title', '$time', '$detail');";

if ($mysqli->query($sql) === TRUE) {
    $arr = array('status' => 200);
    echo json_encode($arr);
} else {
    $arr = array('status' => 500);
    echo json_encode($arr);
}

?>