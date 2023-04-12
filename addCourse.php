<?php
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Methods:*');

$cosname = $_POST["cosname"];
$cosintro = $_POST["cosintro"];
$teach_time = $_POST["teach_time"];
//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}
mysqli_set_charset($mysqli, 'utf8');   //选择字符集
$sql = "insert into `course` (cosname, cosintro, teach_time) 
VALUES ('$cosname', '$cosintro', '$teach_time');";

if ($mysqli->query($sql) === TRUE) {
    $arr = array('status' => 200);
    echo json_encode($arr);
} else {
    $arr = array('status' => 500);
    echo json_encode($arr);
}

?>