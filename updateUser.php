<?php
header("Access-Control-Allow-Origin:*");
$user_id = $_POST["user_id"];
$username = $_POST["username"];
$college = $_POST["college"];
$class =  $_POST["class"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$gender =  $_POST["sex"];
$description = $_POST["desc"];
$type = $_POST["type"];
$room = $_POST["room"];
$seat = $_POST["seat"];
//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980","root","Lzqzxc,.","dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}
mysqli_set_charset($mysqli, 'utf8');   //选择字符集
$sql = "Update `t_user_real` SET name = '$username', college = '$college', class = '$class', phone = '$phone', email = '$email', gender = '$gender', type = '$type', description = '$description',room = '$room',seat = '$seat' where user_id = '$user_id'";


if ($mysqli->query($sql) === TRUE) {
    $arr = array('status' => 200);
    echo json_encode($arr);
} else {
    $arr = array('status' => 500);
    echo json_encode($arr);
}

?>