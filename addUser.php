<?php
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Methods:*');

$user_id = $_POST["user_id"];
$password = 123456;
$name = $_POST["username"];
$college = $_POST["college"];
$class =  $_POST["class"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$gender =  $_POST["sex"];
$description = $_POST["desc"];
$type = $_POST["type"];

//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}
mysqli_set_charset($mysqli, 'utf8');   //选择字符集
$sql = "insert into `t_user_real` (user_id, name, password, college, class, phone, email, gender, description, type) 
VALUES ('$user_id', '$name', '$password', '$college', '$class', '$phone', '$email', '$gender', '$description', '$type');";

if ($mysqli->query($sql) === TRUE) {
    $arr = array('status' => 200);
    echo json_encode($arr);
} else {
    $arr = array('status' => 500);
    echo json_encode($arr);
}

?>