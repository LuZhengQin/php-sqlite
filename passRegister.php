<?php

header("Access-Control-Allow-Origin:*");

$user_id = $_POST["user_id"];
$username = $_POST["username"];
$college = $_POST["college"];
$class = $_POST["class"];
$phone = $_POST["phone"];
$email = $_POST["email"];
$gender = $_POST["sex"];
$description = $_POST["desc"];
$room = $_POST["room"];
$seat = $_POST["seat"];

//$conn
$mysqli = mysqli_connect("bj-cynosdbmysql-grp-nofx4lqu.sql.tencentcdb.com:25980", "root", "Lzqzxc,.", "dainsai");

//如果有错误，存在错误号
if (mysqli_errno($mysqli)) {

    echo mysqli_error($mysqli);

    exit;
}

mysqli_set_charset($mysqli, 'utf8');   //选择字符集


$sql1 = "DELETE FROM `t_user` WHERE `user_id` = '$user_id';";
if ($mysqli->query($sql1)) {
    $sql2 = "insert into `t_user_real` (user_id, name, password, college, class, phone, email, gender, description, type, room, seat) 
                VALUES ('$user_id', '$username', '123456', '$college', '$class', '$phone', '$email', '$gender', '$description', '0', '$room', '$seat');";

    if ($mysqli->query($sql2) === TRUE) {
        $arr = array('status' => 200);
        echo json_encode($arr);
    } else {
        $arr = array('status' => 500);
        echo json_encode($arr);
    }
}
